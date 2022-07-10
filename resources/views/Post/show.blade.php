@php
    use App\Models\User;
    use App\Models\Category;
@endphp
@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Posts</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail Post</li>
                </ol>
              </div>
        <div class="card p-0">
            <div class="card-body">
                <h3 class="fw-bolder">Post Details</h3>
                <hr>
                <h2>{{ $post->title }}</h2>
                <div class="mt-3">
                    <span>{{ $post->created_at->format('d M Y') }} | </span>
                    <span>{{ User::find($post->user_id)->name }} | </span>
                    <span>{{ Category::find($post->category_id)->title }}</span>
                </div>
                <div class="mt-3">
                    <p>{{ $post->description }}</p>
                </div>
                @isset($post->feature_img)
                <img src="{{ asset('storage/'.$post->feature_img )}}" class="w-100 mt-3 rounded" alt="">
                @endisset
            </div>
        </div>
    </div>
@endsection