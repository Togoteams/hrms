@extends('layouts.app')
@push('styles')
<style>
    table, th, td {
  border: 1px solid black;
}
</style>
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="mt-2 mb-2 border-bottom">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/ Leave Report
                    </div>
                    <!-- End Col -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
                <div class="page-header">
                    <div class="row">
                        <div class="mb-2 col-sm mb-sm-0">
                            <h2 class="page-header-title">Leave Report</h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.leave-report') }}" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">From Date</label>
                                            </br>
                                            <input type="date" class="form-control" name="from_date"
                                                value="{{ $from_date }}" id="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">To Date</label>
                                            </br>
                                            <input type="date" class="form-control" name="to_date"
                                                value="{{ $to_date }}" id="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fileUploadPassbook">Employee <i class="text-danger">*</i> </label>
                                            <select class="form-control select2" name="employee_id" id="employee_id"
                                                required>
                                                <option value="">--select--</option>
                                                @foreach ($employees as $key => $employee)
                                                    <option value="{{ $employee->id }}" @if($employee_id==$employee->id) {{'selected'}} @endif>{{ $employee?->user?->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <div class="mt-3 form-group">
                                            <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
                                                <span class="text">Search</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        @if($employee_id && $from_date && $to_date)
                        <div class="report-display-section">
                            <table >
                                <tr>
                                    <th colspan="7">
                                        LEAVE REPORT
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        Name of The Employee : {{$employee_data?->user?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        EC No :  {{$employee_data?->ec_number}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        Branch :{{$employee_data?->branch?->name}}
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        Leave report as on {{date("d-m-Y",strtotime($from_date))}} to {{date("d-m-Y",strtotime($to_date))}}
                                    </td>
                                </tr>
                                <tr>
                                    LOCAL EMPLOYEES
                                </tr>
                                <tr>
                                    <td>Leave Type</td>
                                    <td>Opening Balance</td>
                                    <td>Accural</td>
                                    <td>Adjustment</td>
                                    <td>Leave Availed</td>
                                    <td>Leave Balance</td>
                                    <td>Expiry Date</td>
                                </tr>
                                @foreach($leaveReportArr as $leave)
                                <tr>
                                    <td>{{$leave['leave_type_name']}}</td>
                                    <td>{{$leave['opening_balance']}}</td>
                                    <td>{{$leave['accural']}}</td>
                                    <td>{{$leave['adjustment']}}</td>
                                    <td>{{$leave['leave_availed']}}</td>
                                    <td>{{$leave['leave_balance']}}</td>
                                    <td>{{$leave['expiry_date_message']}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
