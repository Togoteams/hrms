@extends('layouts.app')
@push('styles')
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
                        </a>/ Salary Report
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
                            <h2 class="page-header-title">Salary Report</h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.salary') }}" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="pay_for_month_year" class="required">Salary For Month</label>
                                        <input type="month" class="form-control form-control-sm" name="pay_for_month_year" id="pay_for_month_year" required>
                                    </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fileUploadPassbook">Employee <i class="text-danger">*</i> </label>
                                            <select class="form-control select2" name="employee_id" id="employee_id"
                                                required>
                                                <option value="">--select--</option>
                                                @foreach ($employees as $key => $employee)
                                                    <option value="{{ $employee->user_id }}">{{ $employee?->user?->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Search Type</label>
                                            </br>
                                            <select name="search_type" id="search_type"  class="form-control select2 form-control-user">
                                                <option value="">--select--</option>
                                                <option value="export-payslip" @if($search_type=="export-payslip") {{'selected'}} @endif>Export Payslip</option>
                                                <option value="export-excel" @if($search_type=="export-excel") {{'selected'}} @endif>Export Excel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-2 form-group">
                                            <button type="submit" class="btn btn-primary btn-icon-split">
                                                <span class="text">Search</span>
                                            </button>
                                        </div>
                                        
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="col-sm-auto">
                            <div class="p-2 mt-3 table-responsive">
                                <table
                                    class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Salary Month</th>
                                            <th>Employee Code</th>
                                            <th>Employee Name</th>
                                            <th>Basic</th>
                                            <th>Gross Earning</th>
                                            <th>Total Deduction</th>
                                            <th>Net Take Home</th>
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
                                        ajax: {
                                        "url": "{{ route('admin.reports.salary') }}",
                                        "type": "get",
                                        "data": function(d) {
                                            // Add your parameters here
                                            d.employee_id = "{{ $employee_id }}"
                                            d.pay_for_month_year = "{{ $pay_for_month_year }}"
                                            // Add more parameters as needed
                                        }
                                    },
                                        columns: [{
                                                data: 'DT_RowIndex',
                                                name: 'DT_RowIndex',
                                                orderable: false,
                                                searchable: false
                                            },
                                            {
                                                data: 'pay_for_month_year',
                                                name: 'pay_for_month_year'
                                            },

                                            {
                                                data: 'employee.ec_number',
                                                name: 'employee.ec_number'
                                            },
                                            {
                                                data: 'user.name',
                                                name: 'user.name'
                                            },
                                            {
                                                data: 'basic',
                                                name: 'basic'
                                            },

                                            {
                                                data: 'gross_earning',
                                                name: 'gross_earning'
                                            },
                                            {
                                                data: 'total_deduction',
                                                name: 'total_deduction'
                                            },
                                            {
                                                data: 'net_take_home',
                                                name: 'net_take_home'
                                            }
                                        ]
                                    });

                                });
                            </script>
                            <!-- End Table -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
