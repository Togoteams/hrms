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
    <div class="content container-fluid mr-2p">
        <h3 class="text-center font-weight-bold txt-color .mr-m-2p">Profile Update</h3>
        <div class="row mx-auto justify-content-center">
            <div class="col-8 bg-white card form-div auto">
                <form action="{{ route('admin.profile.update') }}" method="post" enctype='multipart/form-data'>
                    {{ csrf_field() }}

                    <div class="form-group" id="image_preview_section">
                        @if (!empty(Auth::user()->media))
                            <img class="img-profile rounded-circle" id="user_img" style="height: 70px;"
                                src="{{ Auth::user()->media->getUrl() }}">
                        @else
                            <img class="img-profile rounded-circle" id="user_img" style="height: 70px;" src="">
                        @endif
                    </div>
                    <div class="form-group mr-bot">

                        <label for="image" class="required">Profile Pic </label>
                        <input type="file" name="image" id="image" accept="image/*" onchange="validateimg(this)" required>
                        @error('image')
                            <div class=" text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mr-bot">
                        <label for="name">Name<span style="color:red;">*</span></label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="form-control capitalize" id="name" required>
                        <p class="invalid-feedback" id="name_error"></p>
                    </div>

                    <div class="form-group mr-bot">
                        <label for="email">Email<span style="color:red;">*</span></label>
                        <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control"
                            id="email" required>
                        <p class="invalid-feedback" id="email_error"></p>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-sm btn-primary" id="formSubmit"
                            onclick="return formValidate();">
                            Update
                        </button>
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

    {{-- Profile Update Validation --}}
    <script>
        'use strict';

        var name_error = true;
        var email_error = true;

        $(document).ready(function() {
            $(document).on("change", "#name", function(e) {
                nameValidate();
            });
            $(document).on("change", "#email", function(e) {
                emailValidate();
            });
        });

        //Name Validation
        function nameValidate() {
            let regex = /^[a-zA-Z' ']*$/;
            let name = $.trim($("#name").val());
            if (!name) {
                name_error = true;
                $("#name").addClass('is-invalid');
                return $("#name_error").html('Name is Required');
            } else if (!regex.test(name)) {
                name_error = true;
                $("#name").addClass('is-invalid');
                return $("#name_error").html('Only Alphabets are Allowed');
            }
            name_error = false;
            $("#name").removeClass('is-invalid');
            $("#name_error").html('');
        }

        //Email Validation
        function emailValidate() {
            let email = $.trim($("#email").val());
            let validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            if (!email) {
                email_error = true;
                $("#email").addClass('is-invalid');
                return $("#email_error").html('Email is Required');
            } else if (!email.match(validRegex)) {
                email_error = true;
                $("#email").addClass('is-invalid');
                return $("#email_error").html('Email Format is Invalid');
            }
            email_error = false;
            $("#email").removeClass('is-invalid');
            $("#email_error").html('');
        }

        function formValidate() {
            nameValidate();
            emailValidate();

            if (name_error || email_error) {
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
@endpush
