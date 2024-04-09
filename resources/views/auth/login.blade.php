<!doctype html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Bank of Baroda (Botswana) Ltd. </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Togoteams" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('admin/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <style>
        .login-btn {
            border: 2px solid #f85109;
            color: #f85109;
            transition: all 0.3s ease-in-out;
        }

        .login-btn:hover {
            background-color: #f85109;
            color: #fff;
        }

        .btn-eye {
            border: 1px solid #ced4da;
        }
        .btn-eye:hover {
            border: 1px solid #ced4da;
        }
    </style>
    <div class="my-5 account-pages pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="overflow-hidden card">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-8">
                                    <div class="p-4 text-primary">
                                        <h5 class="text-primary">{{ __('Hrms Login') }}</h5>
                                        <p>BANK OF BARODA (Botswana) LTD.</p>
                                    </div>
                                </div>
                                <div class="col-4 align-self-end">
                                    <img src="{{ asset('admin/assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="pt-0 card-body">
                            <div class="auth-logo">
                                <a href="index.html" class="auth-logo-light">
                                    <div class="mb-4 avatar-md profile-user-wid">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('admin/assets/images/logo.webp') }}" alt=""
                                                class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="{{ asset('admin/assets/images/logo/logo.png') }}" class="auth-logo-dark">
                                    <div class="mb-4 avatar-md profile-user-wid">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('admin/assets/images/logo/logo.png') }}" alt=""
                                                class="rounded-circle" height="60">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                        <input input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus
                                            placeholder="eg. abc@xyz.com">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('forgot.password') }}" class="text-muted">
                                                Forgot password?
                                            </a>
                                        </div>
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" id="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                placeholder="Enter Password">
                                            <button class="btn btn-light btn-eye" type="button" id="password-addon">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    <center>
                                        <div class="mt-3">
                                            <button class="btn btn-white waves-effect waves-light login-btn"
                                                type="submit">{{ __('Login') }}</button>
                                        </div>
                                        <div class="mt-1">
                                            Version 1.1.0
                                        </div>
                                    </center>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <div>
                            <p>©
                                {{ date('Y') }} BANK OF BARODA (Botswana) LTD Crafted with <i
                                    class="mdi mdi-heart text-danger"></i>
                                by <a href="https://togoteams.com">TogoTeams
                                </a>Powered By <a href="https://www.adsparkwebtech.com/">Adspark Webtech Private
                                    Limited</a>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('admin/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
</body>

<!-- Mirrored from themesbrand.com/skote/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 10 Mar 2022 05:51:25 GMT -->

</html>
