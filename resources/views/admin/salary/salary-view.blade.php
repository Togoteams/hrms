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
                <div class="row">
                    <div class="table-responsive mt-4 pt-4">
                        <table
                            class="table data-table table-pay-scale  table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Employee Name</th>
                                    <th>Employee Email</th>
                                    <th>Employee Phone</th>
                                    <th>Basic Payment</th>
                                    <th>Total Deduction</th>
                                    <th>Total Tax Deduction</th>
                                    <th>Total Salary</th>
                                    <th>Total Amount</th>
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
                                ajax: "{{ route('admin.salary.list') }}",

                                columns: [{
                                        "render": function() {
                                            return i++;
                                        }
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
                                ]
                            });

                        });
                    </script>
                    <!-- End Table -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>
        </div>

    </main>
@endsection
