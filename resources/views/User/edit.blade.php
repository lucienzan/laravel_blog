@php 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
@endphp
@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User Lists</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
              </div>
        <div class="card p-0">
            <div class="card-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    @endforeach
                @endif

                <h3>Edit Categories</h3>
                <form class="row g-3" action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-2 ">
                        <label class="form-label" for="Name">Name</label>
                        <input type="text" id="Name"
                            class="form-control caName @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name',$user->name) }}"
                            >
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2 ">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email"
                            class="form-control caSlug @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email',$user->email) }}"
                            >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="role">Select Roles</label>
                        <select type="text" name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                            <option selected disabled>Select Roles</option>
                            @php
                            $roles = array('Admin','Editor','Author');
                            foreach($roles as $key => $role){
                            @endphp
                            <option value="{{ $key }}" {{ $role == $user->roleName ? "selected" : "" }}>{{ $role }}</option>
                            @php
                            };
                            @endphp
                            {{-- <option value="0"{{ Auth::user()->role == $user->role  ? "selected": "" }}>Admin</option>
                            <option value="1" {{ Auth::user()->role == $user->role ? "selected": "" }}>Editor</option>
                            <option value="2" {{ Auth::user()->role == $user->role ? "selected": "" }}>Author</option> --}}
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                       </div>
                    <div>
                        <button class="btn btn-primary" id="categoryBtn" type="submit">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
@endsection