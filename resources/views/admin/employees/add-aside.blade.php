@php
    $empId = !empty($employee) ? $employee->emp_id : '';
    $isBomaid = !empty($employee) ? $employee->getLatestSalary()?->is_medical_insuarance ?? 0 : '';
@endphp

<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/user-details*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.userDetails.form', $empId) }}';">
        Login Details
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/employee-details*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.employeeDetails.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Employee Details
    </button>
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/salary-history*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.salary-history.list', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Salary Revisions
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/current-leaves*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.current-leaves.list', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Available Leaves
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/address*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.address.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Address
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/domicile*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.domicile.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Domicile
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/passport-omang*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.passportOmang.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Passport / OMANG
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/qualification*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.qualification.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Qualification
    </button>
    @if($isBomaid)
    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/employee/medical-insuarance-bomaid*') ? 'active-class' : '' }}"
        type="button"
        onclick="window.location.href='{{ route('admin.employee.medicalInsuaranceBomaid.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Medical Insurance / Bomaid
    </button>
    @endif

    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/employee/department-history*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.departmentHistory.form', $empId) }}';"
        {{ empty($empId) ? 'disabled' : '' }}>
        Department History
    </button>
</div>
