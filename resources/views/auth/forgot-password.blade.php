@include('layouts.partials.header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<div class="row " style="    background-color: #f2f3f8;">
    <div class="col-4"></div>
    <div class="p-4 mt-5 bg-white col-4">
        <div class="mt-2 mb-3 text-center">
            <h1
                style="color:#1e1e2d; font-weight:500; margin:0;font-size:22px;font-family:'Work Sans', sans-serif!important;">
                Password Reset</h1>
        </div>
        <div class="text-center">
            <i class="fa fa-unlock" style="font-size:70px"></i>

        </div>
        <p style="color:#455056; margin:0;">
            Someone requested that password for your saas account to be reset.
        </p>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" class="form-control " type="email" name="email" :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger font-12" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button
                    style="background:#006ecd;text-decoration:none !important; font-weight:500; margin-top:20px; color:#fff;font-size:14px;padding:10px 24px;display:inline-block;border-radius:20px;">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>

    </div>
    <div class="col-4"></div>
    <p class="text-center">
        &copy; <strong>www.togoteams.com</strong></p>

    <p style="text-align: center; font-size: 13px; color: #999;">This email template was sent to
        you becouse we want to make the world a better place.<br> You could change your
        subscription settings anytime.</p>


    <footer class="text-center">
        <div class="rounded-social-buttons">
            <a class="social-button facebook" href="https://www.facebook.com/" target="_blank"><i
                    class="fab fa-facebook-f"></i></a>
            <a class="social-button twitter" href="https://www.twitter.com/" target="_blank"><i
                    class="fab fa-twitter"></i></a>
            <a class="social-button linkedin" href="https://www.linkedin.com/" target="_blank"><i
                    class="fab fa-linkedin"></i></a>
            <a class="social-button youtube" href="https://www.youtube.com/" target="_blank"><i
                    class="fab fa-youtube"></i></a>
            <a class="social-button instagram" href="https://www.instagram.com/" target="_blank"><i
                    class="fab fa-instagram"></i></a>
        </div>
    </footer>
    @include('layouts.partials.footer')

</div>

<style>
    .social-button {
        padding: 10px;
        background: white;
        border-radius: 90%;

    }

    .font-12 {
        font-size: 12px;
    }
</style>
