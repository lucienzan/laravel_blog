@php 
use App\Models\Category;
@endphp
@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Posts</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
                </ol>
              </div>
        <div class="card p-0">
            <div class="card-body">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                @endforeach
            @endif
                <h3>Edit Post</h3>
                <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data" id="postUpdateForm">
                    @csrf
                    @method('put')
                </form>
                   <div class="mb-4">
                    <label class="form-label" for="">Title</label>
                    <input type="text" value="{{ old('title',$post->title) }}" name="title" id="title" class="form-control @error('title') is-invalid @enderror" form="postUpdateForm">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                   </div>
                   <div class="mb-4">
                    <label class="form-label" for="category">Select Categories</label>
                    <select type="text" name="category" id="category" form="postUpdateForm" class="form-select @error('category') is-invalid @enderror">
                        <option selected disabled>Select Categories</option>
                    @foreach ( Category::all() as $category )
                        <option value="{{ $category->id }}" 
                            {{ $category->id == old('category',$post->category_id)? 'selected' : ""  }}  >
                            {{ $category->title }}
                        </option>
                    @endforeach
                    </select>
                    @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                   </div>
                   <div class="mb-4">
                    <div>
                        <label class="form-label" for="photos">Post Photos</label>
                    <input type="file" name="photos[]" form="postUpdateForm" id="photos" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                    @error('photos.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="mt-3 d-flex">
                        @foreach ($post->Photos as $photo )
                            <div class=" position-relative me-2">
                                <img src="{{ asset('storage/'.$photo->name) }}" height="60px" class="rounded" alt="">
                                <form class="d-inline-block" action="{{ route('photo.destroy',$photo->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="border-0 bg-transparent position-absolute bottom-0 end-0" >
                                        <i  class="bi bi-trash text-danger d-inline-block"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                   </div>
                   <div class="mb-4">
                    <label for="describe">Description</label>
                    <textarea name="description" form="postUpdateForm" id="describe" class="form-control @error('description')
                        is-invalid
                    @enderror" cols="30" rows="10">{{ old('description',$post->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                   </div>
                   <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-center align-items-center">
                        @isset($post->feature_img)
                        <img src="{{ asset('storage/'.$post->feature_img )}}" height="60px" class=" rounded mt-2 me-3" alt="">
                        @endisset
                       <div>
                        <label class="form-label" for="feature_image">Feature Image</label>
                        <input type="file" form="postUpdateForm"  name="feature_image" id="feature_image" class="form-control @error('feature_image') is-invalid @enderror">
                        @error('feature_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                       </div>
                       </div>
                       <button class="btn btn-lg btn-primary" form="postUpdateForm">Update Post</button>
                   </div>
            </div>
        </div>
    </div>
@endsection