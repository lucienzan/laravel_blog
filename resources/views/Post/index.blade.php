@php
    use Illuminate\Support\Str;
    use App\Models\Category;
    use App\Models\User;
@endphp
@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">All Posts</li>
                </ol>
              </div>
        <div class="card p-0 overflow-scroll" >
            <div class="card-body">
                <form method="get" action="{{ route('post.index') }}" class="d-flex justify-content-between">
                    <h3>Post Lists</h3>
                    <div class="d-flex align-items-center input-group w-25">
                        <input type="text" class="form-control" value="{{ old('keyword',request('keyword')) }}" name="keyword">
                        <button type="submit" class="btn btn-secondary">
                            <i class="bi bi-search "></i>
                        </button>
                    </div>
                </form>
                <hr>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Feature_Image</th>
                            <th>Category</th>
                            @isAuthor
                            <th>User</th>
                            @endisAuthor
                            <th>Created_at</th>
                            <th>Control</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts as $key => $post)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->excerpt }}</td>
                            <td>{{ $post->feature_img }}</td>
                            {{-- <td>{{ Category::find($post->category_id)->title }}</td> --}}
                            <td>{{ $post->Category->title }}</td>
                            @isAuthor                            
                            {{-- <td>{{ User::find( $post->user_id )->name }}</td> --}}
                            <td>{{ $post->User->name }}</td>
                            @endisAuthor
                            <td class="text-nowrap">
                                <p class="small mb-0 text-black-50">{{ $post->created_at->format('d M Y') }}</p>
                                <p class="small mb-0 text-black-50">{{ $post->created_at->format('h : m A') }}</p>
                            </td>
                            <td  class="text-nowrap"> 
                               @can('delete',$post)
                               <form class="d-inline-block" action="{{ route('post.destroy',$post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                               @endcan
                               @can('update',$post)
                               <a href="{{ route('post.edit', $post->id) }}" class="btn btn-outline-info"><i class="bi bi-pencil"></i></a>
                               @endcan
                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-outline-warning"><i class="bi bi-info-circle"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan=8>No categories are added.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                    
                {{ $posts->onEachSide(1)->links() }} 
                    
            </div>
        </div>
    </div>
@endsection