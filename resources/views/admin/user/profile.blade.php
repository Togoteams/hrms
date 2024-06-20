@extends('layouts.app')
@push('styles')
<link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .mr-2p {
            margin-top: 10%;
        }

        .form-div {
            background-color: white;
            max-width: 400px;
            min-width: 300px;
            border-radius: 20px;
            padding: 20px;
        }

        .form-profile-image {
            height: 155px;
            width: 155px;
            align-items: center;
            text-align: center;
            border-radius: 50%;
            box-shadow: 1px 1px 1rem 1px rgb(220 161 131 / 29%);
        }

        .profile-image-text {
            font-size: 10px;
        }

        @media only screen and (max-width: 768px) {

            /* For mobile phones: */
            .mr-m-2p {
                margin-top: 25%;
            }
        }
    </style>
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">

            <div class=" row justify-content-center">
                @can('profile-update')
                @endcan
                @can('change-password')
                    <div class="col-3">
                    </div>
                    <div class="col-6">


                        <div class="card">
                            <div class="p-3 card-body">
                                <h3 class="text-center font-weight-bold txt-color">Profile Update</h3>
                                <div class="form-group" id="image_preview_sectionggg">

                                </div>
                                <form action="{{ route('admin.image.update') }}" method="post" enctype='multipart/form-data'>
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                @if ($data->image && file_exists(public_path('assets/profile/' . $data->image)))
                                                    <img class="form-profile-image"
                                                        src="{{ asset('assets/profile/' . $data->image) }}" alt="Profile Image"
                                                        id="user_img">
                                                @else
                                                    <img class="form-profile-image"
                                                        src="{{ asset('assets/profile/profileImage.png') }}" alt="Default Icon"
                                                        id="user_img">
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-md-8">
                                            <div class="mt-1">
                                                <input type="file" name="image" id="image" accept="image/*"
                                                    onchange="validateimg(this)" required>
                                                @error('image')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                @enderror
                                                <p class="profile-image-text">Allowed JPG, GIF or PNG. Max size of 800KB</p>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <h6 class="mt-1 card-subtitle">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Update Profile
                                                </button>
                                            </h6>
                                        </div>


                                    </div>
                                </form>
                                {{-- <hr> --}}
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{-- <h5 class="card-title fw-semibold">Update Password</h5> --}}
                                        {{-- <p class="card-subtitle">To change your password please confirm here</p> --}}
                                        <form action="{{ route('admin.password.reset') }}" method="post">
                                            @csrf()


                                            <div class="mb-1 form-group">

                                                <!-- Label -->
                                                <label class="" for="password" />
                                                Current Password<span style="color:red;">*</span>
                                                </label>

                                                <!-- Input group -->
                                                <div class="input-group">
                                                    <!-- Input -->
                                                    <input class="form-control" type="password" id="current_password"
                                                        placeholder="Enter current password" minlength="8"
                                                        name="current_password" required autocomplete="off" />
                                                        <button class="btn btn-light btn-eye password-addon" type="button" id="password-addon">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </button>
                                                    <p class="invalid-feedback" id="password_error"></p>
                                                    @error('current_password')
                                                        <span class="d-block invalid-feedback">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-1 form-group">

                                                <!-- Label -->
                                                <label class="" for="password" />
                                                New Password<span style="color:red;">*</span>
                                                </label>

                                                <!-- Input group -->
                                                <div class="input-group">
                                                    <!-- Input -->
                                                    <input class="form-control" type="password" id="password"
                                                        placeholder="Enter New password" minlength="8" name="password" required
                                                        autocomplete="off" />
                                                        <button class="btn btn-light btn-eye password-addon" type="button" id="">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </button>
                                                    <p class="invalid-feedback" id="password_error"></p>
                                                    @error('password')
                                                        <span class="d-block invalid-feedback">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mr-bot">

                                                <!-- Label -->
                                                <label class="" for="password_confirmation">
                                                    Confirm Password<span style="color:red;">*</span>
                                                </label>

                                                <!-- Input group -->
                                                <div class="input-group">
                                                    <!-- Input -->
                                                    <input class="form-control" type="password" id="password_confirmation"
                                                        placeholder="Confirm Your Password" name="password_confirmation"
                                                        required autocomplete="off" />
                                                        <button class="btn btn-light btn-eye password-addon" type="button" id="">
                                                            <i class="mdi mdi-eye-outline"></i>
                                                        </button>
                                                    <p class="invalid-feedback" id="password_confirmation_error"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <center>
                                                        <button type="submit" class="mt-2 btn btn-sm btn-primary" id="formSubmit"
                                                            onclick="return formValidate();">
                                                            Reset Password
                                                        </button>
                                                    </center>

                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-3">
                    </div>
                @endcan
            </div>

        </div>
        </div>
    @endsection
    @push('custom-scripts')
    <script src="http://127.0.0.1:8000/admin/assets/js/app.js"></script>

        @if (!empty(Session::get('success')))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            @php
                Session::forget('success');
            @endphp
        @endif

        {{-- Profile Update Validation --}}
        <script>
            'use strict';









            function validateimg(ctrl) {
                var fileUpload = ctrl;
                var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.PNG|.JPG|.jpeg|.png)$");
                if (regex.test(fileUpload.value.toLowerCase())) {
                    if (typeof(fileUpload.files) != "undefined") {
                        var reader = new FileReader();
                        reader.readAsDataURL(fileUpload.files[0]);
                        reader.onload = function(e) {
                            var image = new Image();
                            image.src = e.target.result;
                            image.onload = function() {
                                var height = this.height;
                                var width = this.width;
                                // if (height < 500 || width < 500) {
                                //     alert("At least you can upload a 500*500 photo size.");
                                //     return false;
                                // } else {
                                // alert("Uploaded image has valid Height and Width.");
                                var validExtensions = ['jpg', 'png', 'jpeg', 'PNG',
                                    'JPG'
                                ]; //array of valid extensions
                                var fileName = fileUpload.files[0].name;
                                var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
                                if ($.inArray(fileNameExt, validExtensions) == -1) {
                                    fileUpload.type = ''
                                    fileUpload.type = 'file'
                                    $('#user_img').attr('src', "");
                                    // fileUpload.val()
                                    alert("Only these file types are accepted : " + validExtensions.join(', '));
                                } else {
                                    if (fileUpload.files || fileUpload.files[0]) {
                                        var filerdr = new FileReader();
                                        filerdr.onload = function(e) {
                                            $('#user_img').attr('src', e.target.result);
                                        }
                                        filerdr.readAsDataURL(fileUpload.files[0]);
                                    }
                                    // }
                                    // return true;
                                }
                            };
                        }
                    } else {
                        alert("This browser does not support HTML5.");
                        return false;
                    }
                } else {
                    alert("Please select a valid Image file.");
                    return false;
                }
            }
        </script>

        @if (!empty(Session::get('success')))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '{{ Session::get('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
            @php
                Session::forget('success');
            @endphp
        @endif
        {{-- Passwords Update Validation --}}

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
                    Swal.fire({
                        icon: 'error',
                        title: 'Please Fill Carefully!',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    @endpush
