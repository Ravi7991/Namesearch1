@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Police Records Management System</h4>
                </div>
                <div class="card-body text-center">
                    <h5 class="mb-4">Enhancing Search and Retrieval Accuracy in Police Records</h5>
                    <p>This system allows for efficient management of police records with enhanced search capabilities using manual phonetic coding.</p>
                    
                    <div class="mt-4">
                        @if (Route::has('login'))
                            <div>
                                @auth
                                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>

                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn btn-outline-primary ms-2">Register</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
