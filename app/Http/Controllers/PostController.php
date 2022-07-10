<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdatePostRequest;

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
        })->latest('id')->paginate(5)->withQueryString(); //use withQuerystring for pagination when ever you add search 
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
        Storage::delete('public/'.$post->feature_img);
        $post->delete();
        return to_route('post.index');
    }
}
