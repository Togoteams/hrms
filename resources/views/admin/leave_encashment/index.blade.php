@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="mt-2 mb-2 border-bottom">
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
                    {{-- @can('add-leaves') --}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        {{ $page }}
                    </button>

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
                <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee name</th>
                                <th>Employee ID</th>
                                <th>Employee Phone</th>
                                <th>Ec number</th>
                                <th>Designation</th>
                                <th>Join Date</th>
                                <th>Apply Date</th>
                                <th>No of Days</th>
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
                                    "render": function() {
                                        return i++;
                                    }
                                },

                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                }, {
                                    data: 'employee.emp_id',
                                    name: 'employee.emp_id'
                                },
                                {
                                    data: 'user.mobile',
                                    name: 'user.mobile'
                                },

                                {
                                    data: 'employee.ec_number',
                                    name: 'employee.ec_number'
                                },
                                {
                                    data: 'employee.designation.name',
                                    name: 'employee.designation.name'
                                },
                                {
                                    data: 'employee.start_date',
                                    name: 'employee.start_date'
                                },
                                {
                                    data: 'apply_date',
                                    name: 'apply_date'
                                },

                                {
                                    data: 'no_of_days',
                                    name: 'no_of_days'
                                },

                                {
                                    data: 'status',
                                    name: 'status'
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
