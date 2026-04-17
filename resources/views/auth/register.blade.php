@extends('layouts.app') {{-- Ganti dengan nama file layout utama kamu --}}

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-5">
                <div class="text-muted text-center mt-2 mb-3"><small>Sign up with credentials</small></div>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
                <form method="POST" action="{{ route('register') }}" role="form">
                    @csrf

                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input id="name" class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Name" type="text" name="name" 
                                   value="{{ old('name') }}" required autofocus autocomplete="name">
                        </div>
                        @error('name')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="Email" type="email" name="email" 
                                   value="{{ old('email') }}" required autocomplete="email">
                        </div>
                        @error('email')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="password" class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="Password" type="password" name="password" 
                                   required autocomplete="new-password">
                        </div>
                        @error('password')
                            <small class="text-danger mt-1">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="password_confirmation" class="form-control" 
                                   placeholder="Confirm Password" type="password" 
                                   name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Create account</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <a href="{{ route('login') }}" class="text-light"><small>Already registered? Sign in</small></a>
            </div>
        </div>
    </div>
</div>
@endsection
