<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/qualifications') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/qualifications') }}';">
        Qualifications
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/place-of-domicile') ? 'active-class' : '' }}"
        {{-- type="button" onclick="window.location.href='{{ url('admin/person-profile/place-of-domicile') }}';"> --}}
        type="button" href="#">
        Place of Domicile
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/training-details') ? 'active-class' : '' }}"
        {{-- type="button" onclick="window.location.href='{{ url('admin/person-profile/training-details') }}';"> --}}
        type="button" href="#">
        Training
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/union-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/union-details') }}';">
        Union
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/permanent-contractual') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/permanent-contractual') }}';">
        Permanent/ Contractual
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/medical-insurance-bomaid-details') ? 'active-class' : '' }}"
        type="button"
        onclick="window.location.href='{{ url('admin/person-profile/medical-insurance-bomaid-details') }}';">
        Medical Insurance / Bomaid
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/driving-license-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/driving-license-details') }}';">
        Driving License
    </button>

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/previous-employment-details') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/previous-employment-details') }}';">
        Previous Employment
    </button>
</div>
