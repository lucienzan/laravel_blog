@php
    use App\Models\User;
    use App\Models\Category;
    use App\Models\Photo;
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
                @isset($post->feature_img)
                <img src="{{ asset('storage/'.$post->feature_img )}}" class="w-100 mt-3 rounded" alt="">
                @endisset
                <div class="mt-3">
                    <span>{{ $post->created_at->format('d M Y') }} | </span>
                    {{-- <span>{{ User::find($post->user_id)->name }} | </span> --}}
                    <span>{{ $post->User->name }} | </span>
                    {{-- <span>{{ Category::find($post->category_id)->title }}</span> --}}
                    <span>{{ $post->Category->title }}</span> {{-- make a method in models --}}
                </div>
                <div class="mt-3">
                    <p>{{ $post->description }}</p>
                </div>
               
                   {{-- <img src="{{ asset('storage/'.$photo->name) }}" class="w-100 mt-3 rounded" alt=""> --}}
                   {{-- <p>{{ $post->id }}</p> --}}
                   <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @foreach ($post->Photos as $photo )
                      <div class="carousel-item">
                        <img src="{{ asset('storage/'.$photo->name) }}" height="100%" class="d-block w-100" alt="...">
                      </div>
                     @endforeach
                    </div>                      
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                  </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        showCarousel();
    </script>
@endpush