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
                            <h2 class="page-header-title">Database {{ $page }}</h2>
                        </div>
                        {{-- <div class="col-sm-auto">
                    <a class="text-white btn btn-white" href="{{ route('admin.payroll.reimbursement_type.create') }}">
                        Add {{ $page }}
                    </a>

                    </div> --}}
                        <div class="col-sm-auto">
                            {{-- @can('add-document-type') --}}
                            <form id="downloadForm" action="{{ route('admin.backups.store') }}" method="post">
                                @csrf
                                <button id="downloadButton" type="button" class="btn btn-white"
                                    title="Download backup file">
                                    <i class="fas fa-cloud-download-alt"></i> Download {{ $page }}
                                </button>
                            </form>
                            {{-- @endcan --}}
                        </div>

                    </div>
                </div>
                {{-- Table --}}
                <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date & Time</th>
                                <th>File Name</th>
                                <th>Creator</th>
                                <th>Action</th>
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
                            ajax: "{{ route('admin.backups.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'date_time',
                                    name: 'date_time'
                                },
                                {
                                    data: 'name',
                                    name: 'name'
                                },
                                {
                                    data: 'backup_by',
                                    name: 'backup_by'
                                },
                                {
                                    data: 'action',
                                    name: 'action'
                                },
                            ]
                        });

                    });
                </script>
                <!-- End Table -->

                <script>
                    $(document).ready(function() {
                        $('#downloadButton').click(function() {
                            $.ajax({
                                url: '{{ route('admin.backups.store') }}',
                                method: 'POST',
                                data: $('#downloadForm').serialize(),
                                success: function(response) {
                                    if (response.success) {
                                        window.open(response.download_url, '_blank');
                                        location.reload();
                                    } else {
                                        alert('Failed to create backup: ' + response.error);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    alert('Failed to create backup: ' + error);
                                }
                            });
                        });
                    });
                </script>

            </div>

        </div>

    </main>
@endsection
