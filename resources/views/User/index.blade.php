@php
    use App\Models\User;
@endphp
@extends('layouts.app')
@section('content')
    <div class="row px-3">
        <div class="row px-3">
            <div aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
              </div>
        <div class="card p-0">
            <div class="card-body">
                <form method="get" action="{{ route('user.index') }}" class="d-flex justify-content-between align-items-center">
                    <h3>User Lists</h3>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created_at</th>
                        <th>Control</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->roleName }}</td>
                        <td class="text-nowrap">
                            <p class="small mb-0 text-black-50">{{ $user->created_at->format('d M Y') }}</p>
                            <p class="small mb-0 text-black-50">{{ $user->created_at->format('h : m A') }}</p>
                        </td>
                        <td class="text-nowrap"> 
                            {{-- @can('delete',$user) --}}
                            <form class="d-inline-block" action="{{ route('user.destroy',$user->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            {{-- @endcan --}}
                            {{-- @can('update',$user) --}}
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-info"><i class="bi bi-pencil"></i></a>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="5">No users are added.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
                
            {{ $users->links() }} 

            </div>
        </div>
    </div>
@endsection
