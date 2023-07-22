@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class=" border-bottom mt-2 mb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">{{ $page }}</h1>
                    </div>
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
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3 text-right auto mb-5 mt-2">
                    {{-- @can('add-employees_payscale') --}}
                    <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Add {{ $page }}
                    </button>
                    {{-- @endcan --}}

                </div>
            </div>
            @include('admin.employees_payscale.create')
            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <div class="table-responsive mt-3 p-2">
                    <table class="table data-table  table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee Id</th>
                                <th>Employee name</th>
                                <th>Employee Email</th>
                                <th>Employee Phone</th>
                                <th>Basic Payment</th>
                                <th>Total Deduction</th>
                                <th>Total Tax Deduction</th>
                                <th>Total Salary</th>
                                <th>Total Amount</th>
                                <th class="text-right">Action</th>
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
                            ajax: "{{ route('admin.employees-payscale.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    'orderable': false,
                                    'searchable': false
                                }, 

                                {
                                    data: 'employee.emp_id',
                                    name: 'employee.emp_id'
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                }, {
                                    data: 'user.email',
                                    name: 'user.email'
                                }, 
                                {
                                    data: 'user.mobile',
                                    name: 'user.mobile'
                                },
                                {
                                    data: 'basic',
                                    name: 'basic'
                                },
                                {
                                    data: 'total_deduction',
                                    name: 'total_deduction'
                                },
                                {
                                    data: 'income_tax_deductions',
                                    name: 'income_tax_deductions'
                                },
                                {
                                    data: 'gross_earning',
                                    name: 'gross_earning'
                                },
                                {
                                    data: 'gross_earning',
                                    name: 'gross_earning'
                                },
                              
                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: true,
                                    searchable: true
                                },
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
                <div class="modal-dialog modal-xl">
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
                <div class="modal-dialog modal-xl">
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
