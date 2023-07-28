<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Reset Password | Bank of Baroda Ltd. (Botswana)</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
    <meta name="description" content="Reset Password | Bank of Baroda Ltd. (Botswana)">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;1,500&display=swap"
        rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'Work Sans', sans-serif !important;
        }

        a:hover {
            text-decoration: underline !important;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            white-space: nowrap;
        }

        .svg-inline--fa {
            vertical-align: -0.200em;
        }

        .rounded-social-buttons {
            text-align: center;
        }

        .rounded-social-buttons .social-button {
            display: inline-block;
            position: relative;
            cursor: pointer;
            width: 32px;
            height: 32px;
            border: 0.125rem solid transparent;
            padding: 0;
            text-decoration: none;
            text-align: center;
            color: #fefefe;
            font-size: 1.5625rem;
            font-weight: normal;
            line-height: 1em;
            border-radius: 1.6875rem;
            transition: all 0.5s ease;
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }


        .rounded-social-buttons .fa-twitter,
        .fa-facebook-f,
        .fa-linkedin,
        .fa-youtube,
        .fa-instagram {
            font-size: 15px;
        }

        .rounded-social-buttons .social-button.facebook {
            background: #3b5998;
        }


        .rounded-social-buttons .social-button.twitter {
            background: #55acee;
        }


        .rounded-social-buttons .social-button.linkedin {
            background: #007bb5;
        }


        .rounded-social-buttons .social-button.youtube {
            background: #bb0000;
        }



        .rounded-social-buttons .social-button.instagram {
            background: #125688;
        }

        .form-control {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .hyperlink {
            text-decoration: none;
            color: inherit;
        }

        .invalid-feedback {
            color: #9f005d;
        }
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!--100% body table-->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Work Sans', sans-serif!important;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                   
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="">
                                        <h1
                                            style="color:#1e1e2d; font-weight:500; margin:0;font-size:22px;font-family:'Work Sans', sans-serif!important;">
                                            Forgot Password?
                                        </h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img width="80"
                                            src="https://cdn-icons-png.flaticon.com/512/6587/6587395.png" title=""
                                            alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">

                                        <span style="display:inline-block; vertical-align:middle;  width:100px;"></span>
                                        <p style="color:#455056; font-size:12px;line-height:12px; margin:0;">
                                            Please enter your email address.
                                        </p>
                                        <br>

                                        <form action="{{ route('reset.password.post') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data['id']}}">
                                            <input id="password" class="form-control " type="password" name="password"
                                                placeholder="Enter new password" required autofocus />
                                            <p class="invalid-feedback" id="password_error"></p>
                                            @error('password')
                                                <p class="d-block invalid-feedback">{{ $message }}</p>
                                            @enderror
                                            <input id="password_confirmation" class="form-control " type="password"
                                                name="password_confirmation" placeholder="Enter your password again"
                                                required autofocus />
                                            <br>
                                            <p class="invalid-feedback" id="password_confirmation_error"></p>

                                            <button id="formSubmit" onclick="return formValidate();"
                                                style="background:#006ecd;text-decoration:none !important; font-weight:500;
                                                margin-top:20px; color:#fff; font-size:14px; padding:10px 24px;
                                                display:inline-block;border-radius:20px; border: none; cursor:pointer;">
                                                Reset Password
                                            </button>

                                        </form>

                                        <p
                                            style="color:#455056; font-size:12px;line-height:24px; margin:0; margin: 12px; line-height: 18px;">
                                            You will receive a link to create a new password via email.
                                        </p>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    <tr>
                        <td style="height:10px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p
                                style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">
                                &copy; {{ date('Y') }} Bank of Baroda Ltd. (Botswana) Crafted by
                                <strong>
                                    <a class="hyperlink" href="https://togoteams.com">TogoTeams</a>
                                </strong>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p style="text-align: center; font-size: 13px; color: #999; margin-bottom:20px;">
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"
                                integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous">
                            </script>


                            <footer>
                                <div class="rounded-social-buttons">
                                    <a class="social-button facebook" href="https://www.facebook.com/"
                                        target="_blank"><i class="fab fa-facebook-f"></i></a>
                                    <a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="social-button linkedin" href="https://www.linkedin.com/"
                                        target="_blank"><i class="fab fa-linkedin"></i></a>
                                    <a class="social-button youtube" href="https://www.youtube.com/"
                                        target="_blank"><i class="fab fa-youtube"></i></a>
                                    <a class="social-button instagram" href="https://www.instagram.com/"
                                        target="_blank"><i class="fab fa-instagram"></i></a>
                                </div>
                            </footer>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:40px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->

    {{-- Passwords Update Validation --}}
    {{-- Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        'use strict';

        let password_error = true;
        let password_confirmation_error = true;

        $(document).ready(function() {
            $(document).on("change", "#password", function(e) {
                passwordValidate();
            });
            $(document).on("change", "#password_confirmation", function(e) {
                confirmPasswordValidate();
            });
            $(document).on("submit", "#formSubmit", function(e) {
                paswordsMatch();
            });
        });

        //Password Validation
        function passwordValidate() {
            let password = $.trim($("#password").val());
            if (!password) {
                password_error = true;
                $("#password").addClass("is-invalid");
                return $("#password_error").html("Password is Required");
            } else if (password.length < 8) {
                password_error = true;
                $("#password").addClass("is-invalid");
                return $("#password_error").html(
                    "Password must be of 8 characters"
                );
            }
            password_error = false;
            $("#password").removeClass("is-invalid");
            $("#password_error").html("");
        }

        //Confirm Password Validation
        function confirmPasswordValidate() {
            let password_confirmation = $.trim(
                $("#password_confirmation").val()
            );
            if (!password_confirmation) {
                password_confirmation_error = true;
                $("#password_confirmation").addClass("is-invalid");
                return $("#password_confirmation_error").html(
                    "Confirm Password is Required"
                );
            }
            password_confirmation_error = false;
            $("#password_confirmation").removeClass("is-invalid");
            $("#password_confirmation_error").html("");
        }

        // Passwords Matching Validation
        function paswordsMatch() {
            let password = $.trim($("#password").val());
            let password_confirmation = $.trim(
                $("#password_confirmation").val()
            );
            if (password != password_confirmation) {
                password_confirmation_error = true;
                $("#password_confirmation").addClass("is-invalid");
                return $("#password_confirmation_error").html(
                    "Password And Confirm Password must be Same"
                );
            }
            password_confirmation_error = false;
            $("#password_confirmation").removeClass("is-invalid");
            $("#password_confirmation_error").html("");
        }

        function formValidate() {
            passwordValidate();
            confirmPasswordValidate();
            paswordsMatch();

            if (password_error || password_confirmation_error) {
                swal("Please Fill Carefully!", "", "error");
                return false;
            } else {
                return true;
            }
        }
    </script>

    {{-- SWEETALERT --}}
    @if (session('success'))
        <script>
            swal({
                title: 'Success!',
                text: '{{ session('success') }}',
                type: 'success',
                icon: "success",
                confirmButtonText: 'OK'
            });
        </script>
    @endif
</body>

</html>
