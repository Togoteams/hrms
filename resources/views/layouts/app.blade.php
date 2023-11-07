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

    .required-field{
        color: red;
    }
</style>
@stack('styles')

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">

    <script src="{{ asset('assets/js/hs.theme-appearance.js') }}"></script>

    <script src="{{ asset('assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js') }}">
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
    
    @stack('custom-scripts')
    <script type="text/javascript" src="{{ URL::asset('assets/js/admin/role.js') }}">
    </script>
</body>

</html>
