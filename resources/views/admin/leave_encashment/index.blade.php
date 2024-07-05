@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />

@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="mt-2 mb-2 text-right col-sm-3 auto">
                    @if (isemplooye())
                        @php
                            $emp = DB::table('employees')
                                ->where('user_id', auth()->user()->id)
                                ->first();
                        @endphp
                        @if (get_day($emp->start_date, date('Y-m-d')) >= 730)
                            @include('admin.leave_encashment.create')
                        @else
                            @include('admin.leave_encashment.error')
                        @endif
                    @else
                        @include('admin.leave_encashment.create')
                    @endif

                    {{-- @endcan --}}

                </div>
            </div>
            <!-- Card -->
            <div class="mb-3 card mb-lg-5">

                <div class="page-header">
                    <div class="row">
                        <div class="mb-2 col-sm mb-sm-0">
                            <h2 class="page-header-title">{{ $page }}</h2>
                        </div>
                        <div class="col-sm-auto">
                            @can('add-leave-encashment')
                                <button type="button" class="btn btn-white" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    {{ $page }}
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
                                <th>Employee name</th>
                                <th>Ec number</th>
                                <th>Leave Type</th>
                                {{-- <th>Designation</th> --}}
                                <th>Apply Date</th>
                                <th>Balance Leave</th>
                                <th>Requested Leave </th>
                                <th>status</th>
                                <th width="100px">Action</th>
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
                            ajax: "{{ route('admin.leave_encashment.index') }}",

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
                                    data: 'employee.ec_number',
                                    name: 'employee.ec_number'
                                },
                                {
                                    data: 'leave_settings.name',
                                    name: 'leave_settings.name'
                                },

                                {
                                    data: 'apply_date',
                                    name: 'apply_date'
                                },

                                {
                                    data: 'balance_leave',
                                    name: 'balance_leave'
                                },
                                {
                                    data: 'request_leave_for_encashement',
                                    name: 'request_leave_for_encashement'
                                },

                                {
                                    data: 'status',
                                    name: 'status'
                                },

                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: false,
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
                            <h5 class="modal-title" id="staticBackdropLabel">Show {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="show">

                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}

            {{-- status form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="modalstatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content ">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel"> Status change of {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="statuschange">

                        </div>

                    </div>
                </div>
            </div>

            {{-- status form model end  --}}

        </div>

    </main>
@endsection
@push('custom-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"

@endpush