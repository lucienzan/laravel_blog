@php 
use App\Models\Category;
@endphp
@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">All Posts</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create Post</li>
                </ol>
              </div>
        <div class="card p-0">
            <div class="card-body">
                <h3>Add Posts</h3>
                <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   <div class="mb-4">
                    <label class="form-label" for="title">Title</label>
                    <input type="text" value="{{ old('title') }}" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                   </div>
                   <div class="mb-4">
                    <label class="form-label" for="category">Select Categories</label>
                    <select type="text" name="category" id="category" class="form-select @error('category') is-invalid @enderror">
                        <option selected disabled>Select Categories</option>
                    @foreach ( Category::all() as $category )
                        <option value="{{ $category->id }}" 
                            {{ $category->id == old('category')? 'selected' : ""  }}  >
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
                    <label class="form-label" for="photos">Post Photos</label>
                    <input type="file" name="photos[]" id="photos" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                    @error('photos.*')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                   </div>
                   <div class="mb-4">
                    <label for="describe">Description</label>
                    <textarea name="description" id="describe" class="form-control @error('description')
                        is-invalid
                    @enderror" cols="30" rows="10">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                   </div>
                   <div class="d-flex justify-content-between align-items-center">
                    <div class="">
                        <label class="form-label" for="feature_image">Feature Image</label>
                        <input type="file" name="feature_image" id="feature_image" class="form-control @error('feature_image') is-invalid @enderror">
                        @error('feature_image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                       </div>
                       <button class="btn btn-lg btn-primary">Create Post</button>
                   </div>
                </form>
            </div>
        </div>
    </div>
@endsection