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
                        </a>/ Employee Arrear report
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
                            <h2 class="page-header-title">Employee Arrear report </h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.employee-arrear-report') }}" method="get">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="required" for="financial_year">Financial year</label>
                                            <select required id="financial_year" name="financial_year"
                                                class="form-control form-control-sm">
                                                <option selected disabled=""> - Select financial year- </option>
                                                @php
                                                    $currentYear = date('Y');
                                                @endphp
                                                <option value="{{ $currentYear - 1 }}-{{ $currentYear }}"
                                                    @if ($financial_year == $currentYear - 1 . '-' . $currentYear) {{ 'selected' }} @endif>
                                                    {{ $currentYear - 1 }}-{{ $currentYear }}</option>
                                                <option value="{{ $currentYear }}-{{ $currentYear + 1 }}"
                                                    @if ($financial_year == $currentYear . '-' . $currentYear + 1) {{ 'selected' }} @endif>
                                                    {{ $currentYear }}-{{ $currentYear + 1 }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fileUploadPassbook">Employee <i class="text-danger">*</i> </label>
                                            <select class="form-control select2" name="employee_id" id="employee_id"
                                                required>
                                                <option value="">--select--</option>
                                                @foreach ($employees as $key => $employee)
                                                    <option value="{{ $employee->id }}"
                                                        @if ($employee_id == $employee->id) {{ 'selected' }} @endif>
                                                        {{ $employee?->user?->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mt-3 form-group">
                                            <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
                                                <span class="text">Search</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        @if ($financial_year && $employee_id)
                            <div class="report-display-section">
                                <table>
                                    <tr>
                                        <td colspan="6">
                                            Arrear calculation sheet </td>
                                    </tr>
                                    <tr>
                                        <td> Name of Employee : {{ $empData?->user?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td> EC Number : {{ $empData?->ec_number }}</td>
                                    </tr>
                                    <tr>
                                        <td> Name of Branch : {{ $empData?->branch?->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Employee Account number : {{ $empData?->bank_account_number }}</td>
                                    </tr>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
