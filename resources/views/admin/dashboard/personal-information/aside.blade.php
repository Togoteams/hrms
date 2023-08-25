<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link text-left mb-2 {{ Request::is('admin/personal-info/employee-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/personal-info/employee-details') }}';">
        Employee
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/personal-info/family-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/personal-info/family-details') }}';">
        Family Details
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/personal-info/document-details') ? 'active-class' : '' }}"
    type="button" onclick="window.location.href='{{ url('admin/personal-info/document-details') }}';">
    Document Details
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/personal-info/contact-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/contact-details') }}';">
        Contact
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/personal-info/address-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/address-details') }}';">
        Address
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/personal-info/passport-details') ? 'active-class' : '' }}"
        data-bs-toggle="pill" onclick="window.location.href='{{ url('admin/personal-info/passport-details') }}';">
        Passport / Omang
    </button>
</div>
