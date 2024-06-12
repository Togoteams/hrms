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
                        </a>/ Annual Pay Report
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
                            <h2 class="page-header-title">Annual Pay Report</h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.annual-pay-report') }}" method="get">
                                <div class="row">

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
                        @if ($financial_year && $employee_id)
                            <div class="report-display-section">
                                <table>
                                    <tr>
                                        <th colspan="{{ count($earningHead) + count($deductionHead) + 7 }}">
                                            ANNUAL SALARY REPORT
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="{{ count($earningHead) + count($deductionHead) + 7 }}">
                                            Name of The Employee : <b>{{ $employee_data?->user?->name }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="{{ count($earningHead) + count($deductionHead) + 7 }}">
                                            EC No : <b>{{ $employee_data?->ec_number }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="{{ count($earningHead) + count($deductionHead) + 7 }}">
                                            Branch : <b>{{ $employee_data?->branch?->name }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="{{ count($earningHead) + 3 }}"
                                            style="background-color: #fcd7aa;text-align:center;font-size:16px;">
                                            <b>Earning</b></td>
                                        <td colspan="{{ count($deductionHead) + 1 }}"
                                            style="background-color: #fcd7aa;text-align:center;font-size:16px;">
                                            <b>Deduction</b></td>
                                        <td colspan="3"
                                        style="background-color: #fcd7aa;text-align:center;font-size:16px;">
                                        <b></b></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Month
                                        </td>
                                        <td>
                                            Basic
                                        </td>
                                        @foreach ($earningHead as $earning)
                                            <td>
                                                {{ $earning->name }}
                                            </td>
                                        @endforeach
                                        <td>
                                            Gross Earning
                                        </td>
                                        @foreach ($deductionHead as $deduction)
                                            <td>
                                                {{ $deduction->name }}
                                            </td>
                                        @endforeach
                                        <td>
                                            Total Deduction
                                        </td>
                                        <td>
                                            Net Salary
                                        </td>
                                        <td>
                                            Net Salary(In PULA)
                                        </td>
                                        <td>
                                           Tax Amount(In PULLA)
                                        </td>
                                    </tr>
                                    @foreach ($emp_annual_pay_report as $salary)
                                        <tr>
                                            <td>
                                                {{ $salary['month_lable'] }}
                                            </td>
                                            <td>
                                                {{ $salary['data']?->basic ?? 0 }}
                                            </td>
                                            @if (!empty($salary['data']) && !empty($salary['data']->payrollSalaryHead))
                                                @foreach ($salary['data']->payrollSalaryHead as $key => $value)
                                                    @if ($value->payroll_head->head_type == 'income')
                                                        <td style="text-align: right;"> {{ $value->value ?? 0 }}
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($earningHead as $earning)
                                                    <td style="text-align: right;"> 0
                                                    </td>
                                                @endforeach
                                            @endif
                                            <td>
                                                {{ $salary['data']?->gross_earning }}
                                            </td>
                                            @if (!empty($salary['data']) && !empty($salary['data']->payrollSalaryHead))
                                                @foreach ($salary['data']->payrollSalaryHead as $keyd => $valued)
                                                    @if ($valued->payroll_head->head_type == 'deduction')
                                                        <td style="text-align: right;"> {{ $valued->value ?? 0 }}
                                                        </td>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($deductionHead as $deduction)
                                                    <td style="text-align: right;"> 0
                                                    </td>
                                                @endforeach
                                            @endif
                                            <td>
                                                {{ $salary['data']?->total_deduction ?? 0 }}
                                            </td>
                                            <td>
                                                {{ $salary['data']?->net_take_home ?? 0 }}
                                            </td>
                                            <td>
                                                {{ $salary['data']?->net_take_home_in_pula ?? 0 }}
                                            </td>
                                            <td>
                                                {{ $salary['data']?->tax_amount_in_pula ?? 0 }}
                                            </td>
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
