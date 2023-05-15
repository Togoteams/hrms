<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link text-left mb-2 {{ Request::is('admin/person-profile/qualifications') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ url('admin/person-profile/qualifications') }}';">
        Qualifications
    </button>
</div>
