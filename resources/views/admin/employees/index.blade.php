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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add {{ $page }}
                        </button>
                    </div>
                </div>
            </div>
            @include('admin.employees.create')
            <!-- Card -->
            <div class="card mb-3 mb-lg-5">
                <div class="table-responsive mt-3 p-2">
                    <table id="datatable"
                        class="table data-table  table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
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

                        var table = $('.data-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('admin.employees.index') }}",
                            columns: [{
                                    data: 'id',
                                    name: 'id'
                                },

                                {
                                    data: 'emp_id',
                                    name: 'emp_id'
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


        </div>

    </main>
@endsection
