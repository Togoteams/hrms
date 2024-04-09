@extends('layouts.app')
@section('content')
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

        .fe {
            color: black;
        }

        .mr-bot {
            margin-bottom: 20px;
        }

        @media only screen and (max-width: 768px) {

            /* For mobile phones: */
            .mr-m-2p {
                margin-top: 25%;
            }
        }
    </style>
    <div class="container-fluid mr-2p">
        <div class="mx-auto row justify-content-center">
            <div class="bg-white col-6 form-div card">
                <h3 class="text-center font-weight-bold txt-color mr-m-2p">Password Reset</h3>

                <form action="{{ route('admin.password.reset') }}" method="post">
                    @csrf()

                    <!-- Current Password -->
                    <div class="form-group mr-bot">

                        <!-- Label -->
                        <label class="" for="current_password" />
                        Current Password<span style="color:red;">*</span>
                        </label>

                        <!-- Input group -->
                        <div class="input-group">
                            <!-- Input -->
                            <input class="form-control" type="password" id="current_password"
                                placeholder="Enter New password" minlength="8" name="current_password" required
                                autocomplete="off" />
                            <p class="invalid-feedback" id="password_error"></p>
                            @error('current_password')
                                <span class="d-block invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="form-group mr-bot">

                        <!-- Label -->
                        <label class="" for="password" />
                        New Password<span style="color:red;">*</span>
                        </label>

                        <!-- Input group -->
                        <div class="input-group">
                            <!-- Input -->
                            <input class="form-control" type="password" id="password" placeholder="Enter New password"
                                minlength="8" name="password" required autocomplete="off" />
                            <p class="invalid-feedback" id="password_error"></p>
                            @error('password')
                                <span class="d-block invalid-feedback">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mr-bot">

                        <!-- Label -->
                        <label class="" for="password_confirmation">
                            Confirm Password<span style="color:red;">*</span>
                        </label>

                        <!-- Input group -->
                        <div class="input-group">
                            <!-- Input -->
                            <input class="form-control" type="password" id="password_confirmation"
                                placeholder="Confirm Your Password" name="password_confirmation" required />
                            <p class="invalid-feedback" id="password_confirmation_error"></p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <button class="mb-3 btn btn-sm btn-primary" id="formSubmit"
                                            onclick="return formValidate();">
                                            Reset
                                        </button>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
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
