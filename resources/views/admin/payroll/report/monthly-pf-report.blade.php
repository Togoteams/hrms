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
                        </a>/ {{ $page }}
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
                        <h2 class="page-header-title">IBO PF Report</h2>
                    </div>
                    
                </div>
            </div>
                <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>SI.</th>
                                <th>Financial Year</th>
                                <th>Employee Code</th>
                                <th>Employee Name</th>
                                <th>Salary Amount(USD)</th>
                                {{-- <th>Reimbursement Amount</th> --}}
                                <th>Pf Contribution(PULA) </th>
                                <th>Pf Contribution Bank(PULA)</th>
                                <th>Pf Contribution(INR) </th>
                                <th>Pf Contribution Bank(INR)</th>
                                {{-- <th class="text-right">Action</th> --}}
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
                            ajax: "{{ route('admin.payroll.tax-for-ibo.report') }}",
                            columns: [
                                {
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
                                    data: 'user.employee.ec_number',
                                    name: 'user.employee.ec_number'
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                },
                                {
                                    data: 'gross_earning',
                                    name: 'gross_earning'
                                },
                               
                                {
                                    data: 'pf_contribution_emp',
                                    name: 'pf_contribution_emp'
                                },
                                {
                                    data: 'pf_contribution_bank',
                                    name: 'pf_contribution_bank'
                                },
                                {
                                    data: 'pf_contribution_emp_inr',
                                    name: 'pf_contribution_emp_inr'
                                },
                                {
                                    data: 'pf_contribution_bank_inr',
                                    name: 'pf_contribution_bank_inr'
                                },
                                // {
                                //     data: 'action',
                                //     name: 'action',
                                //     orderable: true,
                                //     searchable: true
                                // }
                            ]
                        });

                    });
                </script>
                <!-- End Table -->


            </div>
            <!-- End Card -->
            {{-- edit form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="edit">

                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}

            {{-- edit form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="modalshow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="show">

                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}

        </div>

    </main>
@endsection
@push('custom-scripts')
@include('admin.payroll.payscale.payroll-payscale-js')
@endpush
