@extends('layouts.app')
@push('styles')
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
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
                        </a>/ Branch wise Employee Report 
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
                            <h2 class="page-header-title">EMPLOYEES REPORT -  BRANCH</h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.branch-wise-employee-report') }}" method="get">
                                <div class="row">


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fileUploadPassbook">Branch  <i class="text-danger">*</i> </label>
                                            <select class="form-control select2" name="branch_id" id="branch_id"
                                                required>
                                                <option value="">--select--</option>
                                                @foreach ($branches as $key => $branch)
                                                    <option value="{{ $branch->id }}" @if($branch_id==$branch->id) {{'selected'}} @endif>{{ $branch?->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

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
                        <div class="report-display-section">
                            @if ($employees)
                            <table>
                                <tr>
                                    <td colspan="6">
                                        EMPLOYEES REPORT -  BRANCH </td>
                                </tr>
                                <tr>
                                    <td> Name of Branch</td>
                                    <td>Employees Name</td>
                                    <td>Gender</td>
                                    <td>EC Number</td>
                                    <td> Designation</td>
                                    <td>Date of Joining</td>
                                    <td>Employment type</td>
                                    <td>Union membership
                                        Yes/No</td>
                                    <td>Pension contribution 
                                        Yes/No</td>
                                    <td>Is Bomaid/ Medical insurance 
                                        Yes/ No</td>
                                    <td>IBO/Local</td>
                                </tr>
                                @foreach($employees as $key => $employe)
                                    <tr>
                                        <td>{{ $employe?->branch?->name}}</td>
                                        <td>{{ $employe?->user?->name}}</td>
                                        <td>{{ $employe?->gender}}</td>
                                        <td>{{ $employe?->ec_number}}</td>
                                        <td>{{ $employe?->designation?->name}}</td>
                                        <td>{{ $employe?->start_date}}</td>
                                        <td>{{ $employe?->employment_type}}</td>
                                        <td>{{ $employe?->salaryHistory?->first()?->union_membership_id}}</td>
                                        <td>{{ $employe?->salaryHistory?->first()?->pension_opt}}</td>
                                        <td>{{ $employe?->salaryHistory?->first()?->is_medical_insuarance ? "Yes":"No"}}</td>
                                        <td>{{ $employe?->ec_number}}</td>

                                    </tr>
                                @endforeach
                            </table>
                            @endif
                           
                        </div>

                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
