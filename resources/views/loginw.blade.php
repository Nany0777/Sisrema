<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('layout/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('layout/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('layout/css/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('layout/css/auth.css') }}">

</head>

<body>
    <script src="{{ asset('layout/static/js/initTheme.js') }}"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img src="{{ asset('img/logo_1.jpg') }}" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Ingresar</h1>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" 
                                   class="form-control form-control-xl" 
                                   name="email"  
                                   placeholder="Email"
                                   value="{{ old('email') }}"
                                   required 
                                   autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" 
                                   class="form-control form-control-xl" 
                                   name="password"  
                                   placeholder="Contraseña"
                                   required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Ingresar</button>
                    </form>

                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('layout/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('layout/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('layout/compiled/js/app.js') }}"></script>
</body>

</html>
