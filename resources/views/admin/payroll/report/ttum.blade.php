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
                            @can('export-report-ttum-report')
                                <button type="button" class="btn btn-white" data-bs-toggle="modal"
                                    data-bs-target="#reportReport">
                                    Export Report
                                </button>
                            @endcan


                        </div>
                    </div>
                </div>
                <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Branch</th>
                                <th>TTUM Month</th>
                                <th>Account Name</th>
                                <th>Account Number No.</th>
                                <th>Transacation Type</th>
                                <th>Transacation Amount</th>
                                <th>Transacation Currency</th>

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
                            ajax: "{{ route('admin.payroll.reports.ttum.list') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'branch_name',
                                    name: 'branch_name'
                                },
                                {
                                    data: 'ttum_month',
                                    name: 'ttum_month'
                                },
                                {
                                    data: 'account.name',
                                    name: 'account.name'
                                },
                                {
                                    data: 'account.account_number',
                                    name: 'account.account_number'
                                },

                                {
                                    data: 'transaction_type',
                                    name: 'transaction_type'
                                },
                                {
                                    data: 'transaction_amount',
                                    name: 'transaction_amount'
                                },
                                {
                                    data: 'transaction_currency',
                                    name: 'transaction_currency'
                                }
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


            {{-- edit form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="reportReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Report {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <form id="form_data" method="post"
                                    action="{{ route('admin.payroll.reports.ttum.exports') }}">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gender">Report Date </label>
                                            <input type="month" class="form-control" name="transaction_at" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="branch_id">Branch <sup class="text-danger">*</sup></label>
                                            <select name="branch_id" class="form-control" id="branch_id" required>
                                                <option value="">--select--</option>
                                                @foreach ($branches as $branch )
                                                    <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary-outline btn-success" name="export">Export Report</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}

        </div>

    </main>
@endsection
