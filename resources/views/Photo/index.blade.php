@php
    use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.app')

@section('content')

<div class="row px-3">
    <div class="row px-3">
        <div aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">All Photos</li>
            </ol>
          </div>
    <div class="card p-0">
        <div class="card-body overflow-hidden">
            <h3>Your Gallery</h3>
            <hr>
            <div class="gallery">
                @forelse ( Auth::user()->Photos as $photo )
                    <img src="{{ asset('storage/'.$photo->name) }}" class="w-100 mb-3 rounded" alt="">
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
