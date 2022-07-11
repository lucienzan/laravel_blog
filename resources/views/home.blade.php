@extends('layouts.app')

@section('content')

            <div class="row px-3">
                <div aria-label="breadcrumb" class="breadcrumb-nav">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                  </div>
                <div class="card p-0">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
    
                        {{ __('You are logged in!') }}
                        {{-- <p> @abc(true) you know @endabc | @myName('star') </p> --}}
                    </div>
                </div>
            </div>

@endsection
