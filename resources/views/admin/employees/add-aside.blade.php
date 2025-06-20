@php
    $ecNumber = !empty($employee) ? $employee->ec_number : '';
    $ecId = !empty($employee) ? $employee->id : '';
    $isBomaid = !empty($employee) ? $employee->getLatestSalary()?->is_medical_insuarance ?? 0 : '';
@endphp

<div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    @can('employee-login-details')
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/user-details*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.userDetails.form', $ecNumber) }}';">
        Login Details
    </button>
    @endcan
    
    @can('employee-details')
    <button class="nav-link text-left {{ $ecId }} mb-2 {{ Request::is('admin/employee/employee-details*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.employeeDetails.form', $ecId) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Employee Details  
    </button>
    @endcan
    @canany(['list-employee-salary-revision', 'add-employee-salary', 'delete-employee-salary'])
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/salary-history*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.salary-history.list', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Salary History
    </button>
    @endcanany
    @canany(['list-employee-loan', 'add-employee-loan', 'edit-employee-loan','delete-employee-loan'])
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/loan-history*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.loan-history.list', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Loan History
    </button>
    @endcanany
    @canany(['employee-current-leave', 'employee-credit-current-leave'])
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/current-leaves*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.current-leaves.list', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Available Leaves
    </button>
    @endcanany
    @canany(['list-employee-address', 'add-employee-address','edit-employee-address','delete-employee-address'])
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/address*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.address.form', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Address
    </button>
    @endcanany

    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/domicile*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.domicile.form', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Domicile
    </button>
    @canany(['update-employee-passport-omang'])
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/passport-omang*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.passportOmang.form', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Passport / OMANG
    </button>
    @endcanany
    @canany(['list-employee-qualification','add-employee-qualification','edit-employee-qualification','delete-employee-qualification'])
    <button class="nav-link text-left mb-2 {{ Request::is('admin/employee/qualification*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.qualification.form', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Qualification
    </button>
    @endcanany
    @canany(['add-employee-medical-insuarance','edit-employee-medical-insuarance','delete-employee-medical-insuarance','list-employee-medical-insuarance'])
    @if($isBomaid)
    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/employee/medical-insuarance-bomaid*') ? 'active-class' : '' }}"
        type="button"
        onclick="window.location.href='{{ route('admin.employee.medicalInsuaranceBomaid.form', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Medical Insurance / Bomaid
    </button>
    @endif
    @endcanany
    @canany(['employee-add-department-history','employee-edit-department-history','employee-delete-department-history'])
    <button
        class="nav-link text-left mb-2 {{ Request::is('admin/employee/department-history*') ? 'active-class' : '' }}"
        type="button" onclick="window.location.href='{{ route('admin.employee.departmentHistory.form', $ecNumber) }}';"
        {{ empty($ecNumber) ? 'disabled' : '' }}>
        Department History
    </button>
    @endcanany

</div>
