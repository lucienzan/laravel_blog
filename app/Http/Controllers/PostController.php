<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Photo;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::when(request('keyword'),function($q){
            $keyword = request("keyword");
            $q->orWhere('title','like',"%$keyword%")
            ->orWhere('description','like',"%$keyword%");
        })
        ->when(Auth::user()->roleName === "Author",fn($q)=>$q->where("user_id",Auth::id()))
        ->latest('id')
        ->with(['Category','User'])
        ->paginate(5)->withQueryString(); //use withQuerystring for pagination when ever you added search 
        return view('Post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //save posts
        $posts = new Post();
        $posts->title = $request->title;
        $posts->slug = Str::slug($request->title);
        $posts->description = $request->description;
        $posts->excerpt = Str::words($request->description,40,'...');
        $posts->user_id = Auth::id();
        $posts->category_id = $request->category;
        //send file to db
        if($request->hasFile('feature_image')){
            $newName = uniqid()."feature_image.".$request->file('feature_image')->extension();
            $request->file('feature_image')->storeAs('public',$newName);
            $posts->feature_img = $newName ;
        }
        $posts->save();

        // return $posts this has includes all data

        //save photos
        foreach($request->photos as $photo){
            $newName = uniqid()."_post_image.".$photo->extension();
            $photo->storeAs("public",$newName);

            $photos = new Photo();
            $photos->post_id = $posts->id;
            $photos->name = $newName;
            $photos->save();
        };




        // return redirect()->route('post.index')->with('status','New post added');
        return to_route('post.index')->with('status','New post added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // return $post->User;
        Gate::authorize('view',$post);
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        Gate::authorize('update',$post);
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // return $request;
        if(Gate::denies('update',$post)){
            return abort('403','you are not allowed to update');
        };
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->description = $request->description;
        $post->excerpt = Str::words($request->description,40,'...');
        $post->user_id = Auth::id();
        $post->category_id = $request->category;
        //send file to db
        if($request->hasFile('feature_image')){

            //delete image
            Storage::delete('public/'.$post->feature_img);

            //upload & update image
            $newName = uniqid()."feature_image.".$request->file('feature_image')->extension();
            $request->file('feature_image')->storeAs('public',$newName);
            $post->feature_img = $newName ;
        }
        $post->update();
        //save photos
            if($request->hasFile('photos')){
                foreach($request->photos as $photo){
                    $newName = uniqid()."_post_image.".$photo->extension();
                    $photo->storeAs("public",$newName);
        
                    $photos = new Photo();
                    $photos->post_id = $post->id;
                    $photos->name = $newName;
                    $photos->save();
            }
            }
        return to_route('post.index')->with('status', 'Current post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(Gate::denies('delete',$post)){
            return abort('403','you are not allowed to delete');
        };

        Storage::delete('public/'.$post->feature_img);

        foreach($post->Photos as $photo){
        Storage::delete('public/'.$photo->name);
        $photo->delete();
        }

        $post->delete();
        return to_route('post.index');
    }
}
