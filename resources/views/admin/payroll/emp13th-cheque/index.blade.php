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
                            <h2 class="page-header-title">{{ $page }}</h2>
                        </div>
                        <div class="col-sm-auto">
                        @can('add-salary')
                        <a class="text-white btn btn-white" href="{{ route('admin.payroll.emp-13th-cheque.create') }}">
                            Add {{ $page }}
                        </a>
                        @endcan
                        </div>
                    </div>
                </div>
                {{-- Table --}}
                <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>SI.</th>
                                <th>Employee Name</th>
                                <th>Employee Code</th>
                                <th>Total Salary</th>
                                <th>Average Amount</th>
                                <th>13th Cheques Amount</th>
                                <th>Cheques Month Year</th>
                                {{-- <th>Status</th> --}}

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
                            ajax: "{{ route('admin.payroll.emp-13th-cheque.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                },
                                {
                                    data: 'user.employee.ec_number',
                                    name: 'user.employee.ec_number'
                                },
                                {
                                    data: 'total_amount',
                                    name: 'total_amount'
                                },
                                {
                                    data: 'average_amount',
                                    name: 'average_amount'
                                },
                                {
                                    data: 'net_payable_amount',
                                    name: 'net_payable_amount'
                                },
                                {
                                    data: 'cheques_month_year',
                                    name: 'cheques_month_year'
                                }
                                // ,
                                // {
                                //     data: 'status',
                                //     name: 'status'
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
                <div class="modal-dialog modal-md">
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
