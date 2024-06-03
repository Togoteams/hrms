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
                        </a>/ Annual Tax deducted report
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
                            <h2 class="page-header-title">Annual Tax deducted report </h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.annula-tax-deduction') }}" method="get">
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
                        @if($financial_year)
                        <div class="report-display-section">
                            <table>
                                <tr>
                                    <td colspan="6">
                                        Annual Tax deducted report </td>
                                </tr>
                                <tr>
                                    <td> Name of Employee</td>
                                    <td> EC Number</td>
                                    <td> Name of Branch</td>
                                    @php
                                    $financialYears = explode("-",$financial_year);
                                    @endphp
                                    <td> Gross Earning
                                        from 01.07.{{$financialYears[0]}} to 30.06.{{$financialYears[1]}}</td>
                                    <td> Tax Deducted
                                        from 01.07.{{$financialYears[0]}} to 30.06.{{$financialYears[1]}}</td>
                                    <td> Net Earning
                                        from 01.07.{{$financialYears[0]}} to 30.06.{{$financialYears[1]}}</td>
                                </tr>
                                @foreach ($emp_annual_tax_report as $key => $report)
                                    <tr>
                                        <td>{{ $report['emp_name'] }}</td>
                                        <td>{{ $report['ec_number'] }}</td>
                                        <td>{{ $report['name_of_branch'] }}</td>
                                        <td>{{ $report['gross_earning'] }}</td>
                                        <td>{{ $report['tax_deduction'] }}</td>
                                        <td>{{ $report['net_earning'] }}</td>

                                    </tr>
                                @endforeach
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
