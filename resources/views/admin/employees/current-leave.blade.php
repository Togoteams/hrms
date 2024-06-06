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
                                    @if ($isCurrentLeaveFound)
                                    <button type="button" class="btn btn-white btn-sm" title="Add Emp Salary History"
                                        onclick="addSalaryhistory({{ !empty($employee) ? $employee->user_id : '' }})">
                                        Creadit Leave
                                    </button>
                                    @endif
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.current-leaves.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ !empty($leaves) ? $leaves->id : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">
                                        <input type="hidden" name="employee_id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="employee_type" value="{{ $employee->employment_type }}">
                                        <input type="hidden" name="is_local"
                                            value="{{ !empty($employee) ? ($employee->employment_type == 'local' ? true : false) : false }}">

                                        <div class="p-3 pb-4 row text-dark">
                                            @foreach ($empLeaveTypes as $key => $empLeaveType)
                                                <div class="pt-3 col-2 fw-semibold">
                                                    <label for="{{ $empLeaveType->slug }}">{{ $empLeaveType->name }} <small
                                                            class="required-field">*</small></label>
                                                </div>
                                                <input type="hidden"
                                                    name="emp_leave_component[{{ $key }}][leave_type_id]"
                                                    value="{{ $empLeaveType->id }}">
                                                <div class="pt-2 col-4">
                                                    <input id="{{ $empLeaveType->slug }}"
                                                        placeholder="Enter {{ $empLeaveType->name }}" max="100"
                                                        type="number"
                                                        name="emp_leave_component[{{ $key }}][leave_count]"
                                                        required value="{{ $empLeaveType->leave_count }}"
                                                        class="form-control form-control-sm">
                                                </div>
                                            @endforeach

                                            @if ($isCurrentLeaveFound == 0)
                                                <div class="pt-5 text-center">
                                                    <button type="submit" class="btn btn-white btn-sm">SUBMIT</button>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                                @if ($isCurrentLeaveFound)
                                <div class="p-2 mt-3 table-responsive">
                                    <div>
                                        <h3> Leave Log  of {{$employee?->user?->name}}  </h3>
                                    </div>
                                    <table
                                        class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                                        <thead>
                                            <tr>
                                                
                                                <th>Date</th>
                                                <th>Leave</th>
                                                <th>Count</th>
                                                <th>Transaction Type</th>
                                                {{-- <th>Description</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
                                <script type="text/javascript">
                                    $(function() {
                                        var i = 1;
                                        var table = $('.data-table').DataTable({
                                            processing: true,
                                            serverSide: true,
                                            autowidth: false,
                                            ajax: {
                                                "url": "{{ route('admin.employee.current-leaves-log.list') }}",
                                                "type": "get",
                                                "data": function(d) {
                                                    // Add your parameters here
                                                    d.employee_id = "{{ $employee->id }}"
                                                    d.user_id = "{{ $employee->user_id }}"
    
                                                    // Add more parameters as needed
                                                }
                                            },
                                            columns: [
                                                {
                                                    data: 'activity_at',
                                                    width: '12%',
                                                    name: 'activity_at'
                                                },
                                                {
                                                    data: 'leave_type.name',
                                                    width: '12%',
                                                    name: 'leave_type.name'
                                                },
                                                {
                                                    data: 'leave_count',
                                                    width: '12%',
                                                    name: 'leave_count'
                                                },
                                                {
                                                    data: 'leave_transaction_type',
                                                    width: '12%',
                                                    name: 'leave_transaction_type'
                                                },
                                                
                                               
                                            ]
                                        });
    
                                    });
                                </script>
                                @endif
                            </div>
                           

                        </div>
                        <!-- End Stats -->
                    </div>


                    {{-- Add form model start --}}
                    <!-- Modal -->
                    <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content ">
                                <div class="modal-header ">
                                    <h5 class="modal-title" id="modalTitle"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body" id="add">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.credit-leaves.post') }}">
                                        @csrf
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">
                                        <input type="hidden" name="employee_id"
                                            value="{{ !empty($employee) ? $employee->id : '' }}">
                                        <input type="hidden" name="employee_type"
                                            value="{{ $employee->employment_type }}">
                                        <div class="row">
                                            <div class="mb-2 col-sm-6">
                                                <div class="form-group">
                                                    <label for="leave_type_id">Leave Type</label>
                                                    <small class="required-field">*</small>
                                                    <select name="leave_type_id" class="form-control">
                                                        @foreach ($empLeaveTypes as $leaveType)
                                                            <option value="{{ $leaveType->id }}">{{ $leaveType->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-6">
                                                <div class="form-group">
                                                    <label for="date_of_current_basic">Credit Type</label>
                                                    <small class="required-field">*</small>
                                                    <select name="leave_credit_type" id="leave_credit_type"
                                                        class="form-control">
                                                        <option value="credit">Credit</option>
                                                        <option value="adjustment">Adjustment</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-6">
                                                <div class="form-group">
                                                    <label for="date_of_current_basic">Leave Count</label>
                                                    <small class="required-field">*</small>
                                                    <input type="number" name="leave_count" id="leave_count"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-6">
                                                <div class="form-group">
                                                    <label for="date_of_current_basic">Credit Reason </label>
                                                    <small class="required-field">*</small>
                                                    <input type="text" name="credit_reason" id="credit_reason"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-white" id="btnSave">
                                                Submit
                                            </button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>



    </main>
@endsection
@push('custom-scripts')
    <script>
        function addSalaryhistory(user_id) {
            $('#form_id').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Leave Credit");
            $("#btnSave").html("Submit");
            $("#user_id").val(user_id);
        }
    </script>
@endpush
