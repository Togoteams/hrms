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
                                    <th>No</th>
                                    <th>Employee Id</th>
                                    <th>Employee name</th>
                                    <th>Employee Email</th>
                                    <th>Employee username</th>
                                    <th>Employee Phone</th>
                                    <th>Employee Gender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>No</td>
                                    <td>Employee Id</td>
                                    <td>Employee name</td>
                                    <td>Employee Email</td>
                                    <td>Employee username</td>
                                    <td>Employee Phone</td>
                                    <td>Employee Gender</th>

                                </tr>
                                <tr>
                                    <td>No</td>
                                    <td>Employee Id</td>
                                    <td>Employee name</td>
                                    <td>Employee Email</td>
                                    <td>Employee username</td>
                                    <td>Employee Phone</td>
                                    <td>Employee Gender</th>

                                </tr>
                                <tr>
                                    <td>No</td>
                                    <td>Employee Id</td>
                                    <td>Employee name</td>
                                    <td>Employee Email</td>
                                    <td>Employee username</td>
                                    <td>Employee Phone</td>
                                    <td>Employee Gender</th>

                                </tr>
                                <tr>
                                    <td>No</td>
                                    <td>Employee Id</td>
                                    <td>Employee name</td>
                                    <td>Employee Email</td>
                                    <td>Employee username</td>
                                    <td>Employee Phone</td>
                                    <td>Employee Gender</th>

                                </tr>
                            </tbody>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>
        </div>

    </main>
@endsection
