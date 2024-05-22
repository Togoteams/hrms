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
                        </a>/ Leave Report
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
                            <h2 class="page-header-title">Leave Report</h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.leave') }}" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">From Date</label>
                                            </br>
                                            <input type="date" class="form-control" name="from_date"
                                                value="{{ $from_date }}" id="from_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">To Date</label>
                                            </br>
                                            <input type="date" class="form-control" name="to_date"
                                                value="{{ $to_date }}" id="to_date">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fileUploadPassbook">Employee <i class="text-danger">*</i> </label>
                                            <select class="form-control select2" name="employee_id" id="employee_id"
                                                required>
                                                <option value="">--select--</option>
                                                @foreach ($employees as $key => $employee)
                                                    <option value="{{ $employee->user_id }}">{{ $employee?->user?->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="bmd-label-floating">Report Type</label>
                                            </br>
                                            <select name="search_type" id="search_type"  class="form-control select2 form-control-user">
                                                <option value="">--select--</option>
                                                <option value="available-leave-report" @if($search_type=="available-leave-report") {{'selected'}} @endif>Avaiable-Leave</option>
                                                <option value="full-report" @if($search_type=="export-excel") {{'selected'}} @endif>Full Report</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-2">
                                        <div class="mt-2 form-group">
                                            <button type="submit" class="btn btn-primary btn-icon-split">
                                                <span class="text">Search</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
