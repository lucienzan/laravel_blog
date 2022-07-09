@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
              </div>
        <div class="card p-0">
            <div class="card-body">
             <h3>Category Lists</h3>
            <table class="table ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Created_at</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $key => $category)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="text-nowrap">
                            <p class="small mb-0 text-black-50">{{ $category->created_at->format('d M Y') }}</p>
                            <p class="small mb-0 text-black-50">{{ $category->created_at->format('h : m A') }}</p>
                        </td>
                        <td class="text-nowrap"> 
                           <form class="d-inline-block" action="{{ route('category.destroy',$category->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-info"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>No categories are added.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
                
            {{ $categories->links() }} 

            </div>
        </div>
    </div>
@endsection
