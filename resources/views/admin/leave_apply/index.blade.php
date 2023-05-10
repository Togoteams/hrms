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
                <div class="col-sm-3">
                    <div class="mb-2 col-auto">
                        {{-- @can('add-leaves') --}}
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            {{ $page }}
                        </button>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
            @include('admin.leave_apply.create')
            <!-- Card -->
            <div class="text-center p-1">
                <a href="{{ route('admin.leave_apply.index') }}" class="btn btn-primary ">Total Leave Applied -
                    {{ $data->count('*') }}</a>
                <a href="{{ route('admin.leave_apply.request_history') }}" class="btn btn-warning ">Total Leave Pedding -
                    {{ $total_pedding }} </a>
                <a href="{{ route('admin.leave_apply.get_rejected_leave') }}" class="btn btn-danger ">Total Leave Rejected -
                    {{ $total_approved }} </a>
                <a href="{{ route('admin.leave_apply.balance_history') }}" class="btn btn-success ">Total Leave Approved -
                    {{ $total_reject }} </a>
                @if (isemplooye())
                    <a class="btn btn-info ">Total Remaining Leave - {{ total_remaining_leave(auth()->user()->id) }} </a>
                @endif

            </div>
            <hr>

            <div class="card mb-3 mb-lg-5">
                <div class="table-responsive mt-3 p-2">
                    <table class="table data-table  table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee name</th>
                                <th>Employee Email</th>
                                <th>Employee Phone</th>
                                <th>leave type</th>
                                <th>Balance Leave</th>
                                <th>From </th>
                                <th>To</th>
                                <th>Paid/Unpaid</th>
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
                            ajax: "{{ route('admin.leave_apply.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
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
                                    data: 'leave_type.name',
                                    name: 'leave_type.name'
                                },
                                {
                                    data: 'remaining_leave',
                                    name: 'remaining_leave'
                                },
                                {
                                    data: 'start_date',
                                    name: 'start_date'
                                },
                                {
                                    data: 'end_date',
                                    name: 'end_date'
                                },
                                {
                                    data: 'is_paid',
                                    name: 'is_paid'
                                },
                                {
                                    data: 'status',
                                    name: 'status'
                                },

                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: false,
                                    searchable: false
                                },
                            ]
                        });



                    });



                    // Apply the search
                </script>
                <!-- End Table -->
                <script type="text/javascript">
                    window.onload = function() { //from ww  w . j  a  va2s. c  o  m
                        var today = new Date().toISOString().split('T')[0];
                        document.getElementsByName("start_date")[0].setAttribute('min', today);
                        document.getElementsByName("end_date")[0].setAttribute('min', today);
                        document.getElementsByName("start_date1")[0].setAttribute('min', today);
                        document.getElementsByName("end_date1")[0].setAttribute('min', today);
                    }
                </script>

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
                            <h5 class="modal-title" id="staticBackdropLabel"> Show {{ $page }}</h5>
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
                            <h5 class="modal-title" id="staticBackdropLabel"> Status chnage of {{ $page }}</h5>
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
