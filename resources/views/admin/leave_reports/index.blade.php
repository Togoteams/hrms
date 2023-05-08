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
                <div class="col-3">

                </div>
                {{-- <div class="col-sm-6 p-3">
                    <form action="{{ route('admin.leave_reports.index') }}">

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="star_date"> Start Date</label>
                                    <input id="star_date" name="start_date" type="date"
                                        class="form-control form-control-sm">

                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="end_date"> End Date</label>
                                    <input id="end_date" name="end_date" type="date"
                                        class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary btn-sm  mt-4">Go</button>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <div class="col-sm-3">
                    <div class="mb-2 col-auto">

                    </div>
                </div>
            </div>
            <div class="text-center p-1">
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    @foreach ($leave_type as $lt)
                        @php
                            // by user
                            if (isemplooye()) {
                                $total_approved_leave = DB::table('leave_applies')
                                    ->where('user_id', auth()->user()->id)
                                    ->where('leave_type_id', $lt->id)
                                    ->where('status', 'approved')
                                    ->count('*');
                            } else {
                                $total_approved_leave = DB::table('leave_applies')
                                    ->where('leave_type_id', $lt->id)
                                    ->where('status', 'approved')
                                    ->count('*');
                            }
                        @endphp

                        <button type="button" class="btn btn-outline-primary text-orenge">{{ $lt->name }} <br>
                            {{ $total_approved_leave }}</button>
                    @endforeach

                </div>
            </div> <!-- Card -->
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
                                <th>From </th>
                                <th>To</th>
                                <th>Balance Leave</th>
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

                            ajax: "{{ route('admin.leave_reports.index') }}",
                            data: {
                                start_date: "test"
                            },
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
                                    data: 'start_date',
                                    name: 'start_date'
                                },
                                {
                                    data: 'end_date',
                                    name: 'end_date'
                                },
                                {
                                    data: 'remaining_leave',
                                    name: 'remaining_leave'
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
