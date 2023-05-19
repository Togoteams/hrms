<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/place-of-domicile') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/place-of-domicile') }}';">
        Place of Domicile
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/qualifications') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/qualifications') }}';">
        Qualifications
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/training-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/training-details') }}';">
        Training Details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/union-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/union-details') }}';">
        Union Details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/permanent-contractual') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/permanent-contractual') }}';">
        Permanent/ Contractual
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/sports-cultural-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/sports-cultural-details') }}';">
        Sports / Cultural Details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/awards-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/awards-details') }}';">
        Awards Details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/medical-insurance-bomaid-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/medical-insurance-bomaid-details') }}';">
        Medical Insurance / Bomaid Details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/driving-license-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/driving-license-details') }}';">
        Driving License Details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/previous-employment-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/previous-employment-details') }}';">
        Previous Employment details
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/language-known') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/language-known') }}';">
        Language known
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/functional-competancy-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/functional-competancy-details') }}';">
        Functional Competancy details
    </button>
</div>
