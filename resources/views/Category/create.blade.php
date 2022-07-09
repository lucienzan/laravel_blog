@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Category</li>
                </ol>
            </div>
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card p-0">
                        <div class="card-body">

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                @endforeach
                            @endif

                            <h3>Add New Category</h3>
                            <form class="row g-3" action="{{ route('category.store') }}" method="post">
                                @csrf
                                <div class="mb-2 ">
                                    <label class="form-label" for="Name">Name</label>
                                    <input type="text" id="Name"
                                        class="form-control caName @error('title') is-invalid @enderror" name="title">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-2 ">
                                    <label class="form-label" for="slug">Slug</label>
                                    <input type="text" id="slug"
                                        class="form-control caSlug @error('slug') is-invalid @enderror" name="slug">
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <p class="text-black-50">The “slug” is the URL-friendly version of the name. It is
                                        usually all lowercase and contains only letters, numbers, and hyphens.</p>
                                </div>
                                <div>
                                    <button class="btn btn-primary" id="categoryBtn" type="submit">Add New Category</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                </div>
            </div>
        </div>
    @endsection
