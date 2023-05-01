<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link text-left {{ Request::is('admin/personal-info/employee-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/personal-info/employee-details') }}';">
        Employee Details
    </button>

    <button class="nav-link text-left {{ Request::is('admin/personal-info/contact-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/contact-details') }}';">
        Contact Details
    </button>

    <button class="nav-link text-left {{ Request::is('admin/personal-info/address-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/address-details') }}';">
        Address Details
    </button>

    <button class="nav-link text-left {{ Request::is('admin/personal-info/dob-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/dob-details') }}';">
        DOB Details
    </button>

    <button class="nav-link text-left {{ Request::is('admin/personal-info/passport-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/passport-details') }}';">
        Passport Details
    </button>

    <button
        class="nav-link text-left {{ Request::is('admin/personal-info/emergency-contact-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill"
        onclick="window.location.href='{{ url('admin/personal-info/emergency-contact-details') }}';">
        Emergency Contact
    </button>
</div>
