<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register | {{ config('app.name') }}</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="{{ asset('argon/assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <link href="{{ asset('argon/assets/css/argon-dashboard.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="main-content">
        <div class="header bg-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-5">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Daftar Akun</h1>
                            <p class="text-lead text-white">Isi data di bawah ini agar bisa masuk.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt--8 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative border-0 shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-hat-3 text-primary"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Nama Lengkap" type="text" name="name" value="{{ old('name') }}" required autofocus>
                                    </div>
                                    @error('name') <small class="text-danger pl-2">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative border-0 shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-email-83 text-primary"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                                    </div>
                                    @error('email') <small class="text-danger pl-2">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative border-0 shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-primary"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Password" type="password" name="password" required>
                                    </div>
                                    @error('password') <small class="text-danger pl-2">{{ $message }}</small> @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative border-0 shadow">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-lock-circle-open text-primary"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Konfirmasi Password" type="password" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 my-4 shadow-lg">REGISTER</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('login') }}" class="text-primary font-weight-bold"><small>Already registered? Sign in</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('argon/assets/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('argon/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('argon/assets/js/argon-dashboard.min.js') }}"></script>
</body>
</html>
