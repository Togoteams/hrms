<!DOCTYPE html>
<html lang="en" dir="" class="h-100">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Login | HRMS</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/font/bootstrap-icons.css') }}">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
</head>

<body class="d-flex align-items-center min-h-100">
    <!-- ========== HEADER ========== -->
    <header id="header" class="navbar navbar-expand navbar-light navbar-absolute-top">
        <div class="container-fluid">
            <nav class="navbar-nav-wrap">



            </nav>
        </div>
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="flex-grow-1">
        <!-- Form -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-xl-4 d-none d-lg-flex justify-content-center align-items-center min-vh-lg-100 position-relative bg-dark"
                    style="background-image: url(assets/svg/components/wave-pattern-light.svg);">
                    <div class="flex-grow-1 p-5">
                        <!-- Blockquote -->
                        <figure class="text-center">
                            <div class="mb-4">
                                <img src="{{ asset('assets/img/logo.svg') }}" alt="Logo">
                            </div>

                            <!-- <blockquote class="blockquote blockquote-light">“ Welcome To HRMS ”</blockquote> -->

                            <!-- <figcaption class="blockquote-footer blockquote-light">
                <div class="mb-3">
                  <img class="avatar avatar-circle" src="{{ asset('assets/img/160x160/img9.jpg') }}" alt="Image Description">
                </div>
              </figcaption>         -->
                        </figure>
                        <!-- End Blockquote -->


                    </div>
                </div>
                <!-- End Col -->

                <div class="col-lg-7 col-xl-8 d-flex justify-content-center align-items-center min-vh-lg-100">
                    <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">
                        <!-- Heading -->
                        <div class="text-center mb-5 mb-md-7">
                            <h1 class="h2">Welcome back</h1>
                            <p>Login to manage your account.</p>
                        </div>
                        <!-- End Heading -->

                        <!-- Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="signupModalFormLoginEmail">Your email</label>
                                <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" name="email" id="signupModalFormLoginEmail"
                                    placeholder="email@site.com" aria-label="email@site.com" required>
                                <span class="invalid-feedback">Please enter a valid email address.</span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label" for="signupModalFormLoginPassword">Password</label>

                                    <a class="form-label-link" href="{{ route('password.request') }}">Forgot Password?</a>
                                </div>


                                <div class="input-group input-group-merge" data-hs-validation-validate-class>
                                    <input type="password" class="js-toggle-password form-control form-control-lg"
                                        name="password" id="signupModalFormLoginPassword"
                                        placeholder="8+ characters required" aria-label="8+ characters required"
                                        required minlength="8"
                                        data-hs-toggle-password-options='{
                         "target": "#changePassTarget",
                         "defaultClass": "bi-eye-slash",
                         "showClass": "bi-eye",
                         "classChangeTarget": "#changePassIcon"
                       }'>
                                    <a id="changePassTarget" class="input-group-append input-group-text"
                                        href="javascript:;">
                                        <i id="changePassIcon" class="bi-eye"></i>
                                    </a>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <span class="invalid-feedback">Please enter a valid password.</span>
                            </div>
                            <!-- End Form -->

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-white btn-lg">Log in</button>
                            </div>


                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Form -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- JS Global Compulsory  -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- JS Implementing Plugins -->
    <script src="{{ asset('assets/vendor/hs-toggle-password/dist/js/hs-toggle-password.js') }}"></script>

    <!-- JS Front -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>

    <!-- JS Plugins Init. -->
    <script>
        (function() {
            // INITIALIZATION OF BOOTSTRAP VALIDATION
            // =======================================================
            HSBsValidation.init('.js-validate', {
                onSubmit: data => {
                    data.event.preventDefault()
                    alert('Submited')
                }
            })


            // INITIALIZATION OF TOGGLE PASSWORD
            // =======================================================
            new HSTogglePassword('.js-toggle-password')
        })()
    </script>
</body>

</html>
