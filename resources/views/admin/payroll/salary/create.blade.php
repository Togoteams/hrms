@extends('layouts.app')
@push('styles')
<style>
    .table-nowrap td,
    .table-nowrap th {
        white-space: normal !important;
    }
</style>
@endpush
@section('content')
<main id="content" role="main" class="main card">
    <!-- Content -->
    <div class="container-fluid">
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
            <div class="p-5 card">
                <form id="form_data" action="{{ route('admin.payroll.salary.store') }}">
                    @csrf
                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                    <div class="row">
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="pay_for_month_year" class="required">Pay For Month</label>
                                <input type="month" class="form-control form-control-sm" name="pay_for_month_year" id="pay_for_month_year" required>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="gender">Select Employees</label>
                                <select required  id="select_employee" placeholder="Enter correct Employee" name="user_id" class="form-control select2 form-control-sm ">
                                    <option selected disabled> - Select Employees- </option>
                                    @foreach ($all_users as $au)
                                    <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                        {{ $au->ec_number }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4">
                            <div class="mt-4 form-group">
                                <button type="button" onclick="callEditMethod()" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                        <span id="edit">

                        </span>
                    </div>
                    <hr>
                    <div class="mt-1 text-center" style="display: none" id="table_data_btn">
                        <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary btn-sm">Add
                            {{ $page }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('custom-scripts')
@include('admin.payroll.salary.payroll-salary-js')
@endpush

