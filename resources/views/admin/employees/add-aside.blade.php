@php
    $empId = !empty($employee) ? $employee->emp_id : '';
@endphp

<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/user-details*') ? 'active-class' : '' }}"
        type="button"
        onclick="window.location.href='{{ route('admin.employee.userDetails.form', $empId) }}';">
        User Details
    </button>

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/employee-details*') ? 'active-class' : '' }}"
        type="button"
        onclick="window.location.href='{{ route('admin.employee.employeeDetails.form', $empId) }}';">
        Employee Details
    </button>
</div>
