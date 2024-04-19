@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <span class="name-title">Employee Form</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-2 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.current-leaves.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($leaves) ? $leaves->id : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">
                                        <input type="hidden" name="employee_id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="employee_type"
                                        value="{{$employee->employment_type }}">
                                        <input type="hidden" name="is_local"
                                            value="{{ !empty($employee) ? ($employee->employment_type == 'local' ? true : false) : false }}">

                                        <div class="p-3 pb-4 row text-dark">
                                            @foreach ($empLeaveTypes as $key=>  $empLeaveType)
                                                <div class="pt-3 col-2 fw-semibold">
                                                    <label for="{{$empLeaveType->slug}}">{{$empLeaveType->name}}<small
                                                            class="required-field">*</small></label>
                                                </div>
                                                <input type="hidden" name="emp_leave_component[{{$key}}][leave_type_id]"
                                                value="{{$empLeaveType->id }}">
                                                <div class="pt-2 col-4">
                                                    <input id="{{$empLeaveType->slug}}" placeholder="Enter {{$empLeaveType->name}}" max="100" type="number"
                                                        name="emp_leave_component[{{$key}}][leave_count]" required
                                                        value="{{ $empLeaveType->leave_count }}"
                                                        class="form-control form-control-sm">
                                                </div>
                                            @endforeach
                                            {{-- <div class="pt-3 col-2 fw-semibold">
                                                <label for="sick_leave">Sick Leave<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <input id="sick_leave" placeholder="Enter Sick Leave" max="100" type="number"
                                                    name="sick_leave" required
                                                    value="{{ !empty($leaves) ? $leaves->sick_leave : '' }}"
                                                    class="form-control form-control-sm">
                                            </div>

                                            <div class="pt-3 col-2 fw-semibold">
                                                <label for="maternity_leave">Maternity Leave<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4">
                                                <input id="maternity_leave" placeholder="Enter Maternity Leave"  max="100"
                                                    type="number" name="maternity_leave" required
                                                    value="{{ !empty($leaves) ? $leaves->maternity_leave : '' }}"
                                                    class="form-control form-control-sm ">
                                            </div>

                                            

                                            <div class="pt-3 col-2 fw-semibold local d-none">
                                                <label for="earned_leave">Earned Leave<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4 local d-none">
                                                <input id="earned_leave" placeholder="Enter Earned Leave"  max="100" type="number"
                                                    name="earned_leave"
                                                    value="{{ !empty($leaves) ? $leaves->earned_leave : '' }}"
                                                    class="form-control form-control-sm local-input">
                                            </div>

                                            <div class="pt-3 col-2 fw-semibold local d-none">
                                                <label for="bereavement_leave">Bereavement Leave<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4 local d-none">
                                                <input id="bereavement_leave"  max="100" placeholder="Enter Bereavement Leave"
                                                    type="number" name="bereavement_leave"
                                                    value="{{ !empty($leaves) ? $leaves->bereavement_leave : '' }}"
                                                    class="form-control form-control-sm local-input">
                                            </div>

                                            <div class="pt-3 col-2 fw-semibold ibo d-none">
                                                <label for="casual_leave">Casual Leave<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4 ibo d-none">
                                                <input id="casual_leave"  max="100" placeholder="Enter Casual Leave" type="number"
                                                    name="casual_leave"
                                                    value="{{ !empty($leaves) ? $leaves->casual_leave : '' }}"
                                                    class="form-control form-control-sm ibo-input">
                                            </div>

                                            <div class="pt-3 col-2 fw-semibold ibo d-none">
                                                <label for="privileged_leave">Privileged Leave<small
                                                        class="required-field">*</small></label>
                                            </div>
                                            <div class="pt-2 col-4 ibo d-none">
                                                <input id="privileged_leave"  max="100" placeholder="Enter Privileged Leave"
                                                    type="number" name="privileged_leave"
                                                    value="{{ !empty($leaves) ? $leaves->privileged_leave : '' }}"
                                                    class="form-control form-control-sm ibo-input">
                                            </div> --}}

                                            <div class="pt-5 text-center">
                                                <button type="submit" class="btn btn-white btn-sm">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- End Stats -->
                    </div>

    </main>
@endsection
@push('custom-scripts')
   

@endpush
