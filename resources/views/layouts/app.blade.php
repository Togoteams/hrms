<!DOCTYPE html>
<html lang="en">

@include('layouts.partials.header')

<style>
    .pointer {
        cursor: pointer;
    }

    .pointer:hover {
        color: #f85109;
    }

    .btn-bg-color {
        background-color: #f85109d6 !important;
    }

    .required-field {
        color: red;
    }

    /* DATATABLE SPACE IMPLEMENTATION */
    .dataTables_length,
    .dataTables_info,
    .dataTables_paginate {
        margin-top: 20px;
    }

    .dataTables_wrapper .dataTables_filter input {
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>

@stack('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">

   
    </script>


    @include('layouts.partials.navbar')

    <!-- ========== MAIN CONTENT ========== -->

    @include('layouts.partials.sidebar')

    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>

    @yield('content')




    @include('layouts.partials.footer')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var APP_URL = "{{ url('/') }}";
    </script>
    <script src="{{ asset('assets/js/admin/common.js') }}"></script>
    <!-- End Style Switcher JS -->
    <script src="{{ asset('assets/js/method.js') }}"></script>

   
    <script>
         $(document).ready(function() {
            $('.number-input').on('input', function() {
            // Remove non-numeric characters
                var numericValue = $(this).val().replace(/[^0-9]/g, '');
                // Update the input field with the numeric value
                $(this).val(numericValue);
            });
        });
    </script>
    @stack('custom-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    @if (session()->get('success') != '')
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "Success!",
                text: "{{ session()->get('success') }}",
                icon: "success",
            });
        });
    </script>
    <?php session()->forget('success'); ?>
    @endif
    @if (session()->get('danger') != '')
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "Error Occured!",
                text: "{{ session()->get('danger') }}",
                icon: "error",
            });
        });
    </script>
    <?php session()->forget('danger'); ?>
    @endif
    @if ($errors != '')
    @foreach ($errors->all() as $message)
    <script>
        $(document).ready(function() {
            Swal.fire({
                title: "Validation error!",
                text: "{{ $message }}",
                icon: "error",
            });
        });
    </script>
    @endforeach
    @endif

    <script type="text/javascript" src="{{ URL::asset('assets/js/admin/role.js') }}"></script>
</body>

</html>
