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
                                            <option value="{{ $currentYear - 1 }}-{{ $currentYear }}" @if($financial_year==$currentYear - 1 . '-' . $currentYear) {{ 'selected'
                                                }} @endif>
                                                {{ $currentYear - 1 }}-{{ $currentYear }}</option>
                                            <option value="{{ $currentYear }}-{{ $currentYear + 1 }}" @if($financial_year==$currentYear . '-' . $currentYear + 1) {{ 'selected'
                                                }} @endif>
                                                {{ $currentYear }}-{{ $currentYear + 1 }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="employee_id">Employee <i class="text-danger">*</i> </label>
                                        <select class="form-control select2" name="employee_id" id="employee_id"
                                            required>
                                            <option value="">--select--</option>
                                            @foreach ($employees as $key => $employee)
                                            <option value="{{ $employee->id }}" @if ($employee_id==$employee->id) {{
                                                'selected' }} @endif>
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
                                <td colspan="{{(count($earningHead)*2 + 5)+ count($deductionHead)*2+ 2}}">
                                    Arrear calculation sheet </td>
                            </tr>
                            <tr>
                                <td colspan="{{(count($earningHead)*2 + 5)+ count($deductionHead)*2+ 2}}"> Name of
                                    Employee : {{ $empData?->user?->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="{{(count($earningHead)*2 + 5)+ count($deductionHead)*2+ 2}}"> EC Number :
                                    {{ $empData?->ec_number }}</td>
                            </tr>
                            <tr>
                                <td colspan="{{(count($earningHead)*2 + 5)+ count($deductionHead)*2+ 2}}"> Name of
                                    Branch : {{ $empData?->branch?->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="{{(count($earningHead)*2 + 5)+ count($deductionHead)*2+ 2}}">Employee
                                    Account number : {{ $empData?->bank_account_number }}</td>
                            </tr>
                            <tr>
                                <td colspan="{{ count($earningHead)*2 + 5 }}"
                                    style="background-color: #fcd7aa;text-align:center;font-size:16px;">
                                    <b>Earning</b>
                                </td>
                                <td colspan="{{ count($deductionHead)*2 + 2 }}"
                                    style="background-color: #fcd7aa;text-align:center;font-size:16px;">
                                    <b>Deduction</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Month
                                </td>
                                <td>
                                    Old Basic
                                </td>
                                <td>
                                    New Basic
                                </td>
                                @foreach ($earningHead as $earning)
                                <td>
                                    Old {{ $earning->name }}
                                    @php
                                    $total_old = 0;
                                    $total_new = 0;
                                    @endphp
                                </td>
                                <td>
                                    New {{ $earning->name }}
                                </td>
                                @endforeach
                                <td>
                                 Old   Gross Earning
                                </td>
                                <td>
                                    New Gross Earning
                                </td>
                                @foreach ($deductionHead as $deduction)
                                <td>
                                    Old {{ $deduction->name }}
                                    @php
                                    $total_old = 0;
                                    $total_new = 0;
                                    @endphp
                                </td>
                                <td>
                                    New {{ $deduction->name }}
                                </td>
                                @endforeach
                                <td>
                                    Total Deduction
                                </td>
                                <td>
                                    Net Salary
                                </td>
                            </tr>
                            @php
                            $totalOldBasicAmount = 0;
                            $totalNewBasicAmount = 0;
                            $totalOldGrossEarning = 0;
                            $totalNewGrossEarning = 0;
                            @endphp
                            @foreach ($reportArray as $key => $report)
                            @php
                            $incrementPer = ($report['increament_per']/100);
                            @endphp
                            <tr>
                                <td>{{ $report['month'] }}</td>
                                @php
                                $oldBasicAmount = $report['data']?->basic ?? 0;
                                $totalOldBasicAmount += $oldBasicAmount;
                                $newBasicAmount = $oldBasicAmount + ($oldBasicAmount * $incrementPer);
                                $totalNewBasicAmount += $newBasicAmount;
                                @endphp
                                <td>
                                    {{ $oldBasicAmount }}
                                </td>
                                <td>
                                    {{ $newBasicAmount }}
                                </td>
                                @if (!empty($report['data']) && !empty($report['data']->payrollSalaryHead))
                                @foreach ($report['data']->payrollSalaryHead as $key => $value)
                                @if ($value->payroll_head->head_type == 'income')
                                @php
                                $oldAmount = $value->value ?? 0
                             

                                @endphp
                                <td style="text-align: right;"> {{ $oldAmount }}
                                </td>
                                <td style="text-align: right;"> {{  $oldAmount + $oldAmount*$incrementPer}}
                                </td>
                                @endif
                                @endforeach
                                @else
                                @foreach ($earningHead as $earning)
                                <td style="text-align: right;"> 0
                                </td>
                                <td style="text-align: right;"> 0
                                </td>
                                @endforeach
                                @endif
                                <td>
                                    @php
                                        $grossEarning = $report['data']?->gross_earning;
                                        $totalOldGrossEarning +=$grossEarning;
                                        $newGrossEarning = $grossEarning + $grossEarning * $incrementPer;
                                        $totalNewGrossEarning +=$newGrossEarning;
                                    @endphp
                                    {{ $grossEarning }}
                                </td>
                                <td>
                                    {{ $newGrossEarning }}
                                </td>
                                @if (!empty($report['data']) && !empty($report['data']->payrollSalaryHead))
                                @foreach ($report['data']->payrollSalaryHead as $keyd => $valued)
                                @if ($valued->payroll_head->head_type == 'deduction')
                                @php
                                $oldDeduction = $valued->value ?? 0;
                               

                                @endphp
                                <td style="text-align: right;"> {{ $oldDeduction }}
                                </td>
                                <td style="text-align: right;"> {{ $oldDeduction + $oldDeduction*$incrementPer }}
                                </td>
                                @endif
                                @endforeach
                                @else
                                @foreach ($deductionHead as $deduction)
                                <td style="text-align: right;"> 0
                                </td>
                                <td style="text-align: right;"> 0
                                </td>
                                @endforeach
                                @endif
                                <td>
                                    {{ $report['data']?->total_deduction ?? 0 }}
                                </td>
                                <td>
                                    {{ $report['data']?->net_take_home ?? 0 }}
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>Total </td>
                                <td>{{$totalOldBasicAmount}} </td>
                                <td>{{$totalNewBasicAmount}} </td>
                                @foreach ($earningHead as $earning)
                                <td>
                                   
                                </td>
                                <td>
                                  
                                </td>
                                @endforeach
                                <td>
                                    {{$totalOldGrossEarning}}
                                </td>
                                <td>
                                    {{$totalNewGrossEarning}}
                                </td>
                                @foreach ($deductionHead as $deduction)
                                <td>
                                  
                                </td>
                                <td>
                                  
                                </td>
                                @endforeach
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