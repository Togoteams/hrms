@extends('layouts.app')
@push('styles')
<style>
    table, th, td {
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
                                            <label for="fileUploadPassbook">Employee  <i class="text-danger">*</i> </label>
                                            <select class="form-control select2" name="employee_id" id="employee_id"
                                                required>
                                                <option value="">--select--</option>
                                                @foreach ($employees as $key => $employee)
                                                    <option value="{{ $employee->user_id }}" @if($employee_id==$employee->user_id) {{'selected'}} @endif>{{ $employee?->user?->name }}
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
                                            <option value="{{$currentYear-1}}-{{$currentYear}}" @if($financial_year==(($currentYear-1)."-".$currentYear)) {{'selected'}} @endif>{{$currentYear-1}}-{{$currentYear}}</option>
                                            <option value="{{$currentYear}}-{{$currentYear+1}}"  @if($financial_year==(($currentYear)."-".$currentYear+1)) {{'selected'}} @endif>{{$currentYear}}-{{$currentYear+1}}</option>
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
                            <table >
                                <tr>
                                    <th colspan="15">
                                        ANNUAL SALARY REPORT
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="15">
                                        Name of The Employee : {{$employee_data?->user?->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="15">
                                        EC No :  {{$employee_data?->ec_number}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="15">
                                        Branch :{{$employee_data?->branch?->name}}
                                    </td> 
                                </tr>
                                <tr>
                                    <td colspan="8">Earning</td>
                                    <td colspan="7">Deduction</td>
                                </tr>
                                <tr>
                                    <td>
                                        Month
                                    </td>
                                    <td>
                                        Basic
                                    </td>
                                    <td>
                                        Bomaid contribution by Bank 50%
                                    </td>
                                    <td>
                                        Penstion contribution by Bank i.e.
                                        15% of Basic
                                    </td>
                                    <td>
                                        Other allowance
                                    </td>
                                    <td>
                                        Other Arrears
                                    </td>
                                    <td>
                                        Over time
                                    </td>
                                    <td>
                                        Gross Earning
                                    </td>
                                    <td>
                                        Bomain contribution by employee 50%
                                    </td>
                                    <td>
                                        Penstion contribution by employee 5%
                                    </td>
                                    <td>
                                        Union Fee
                                    </td>
                                    <td>
                                        TAX
                                    </td>
                                    <td>
                                        Other Deduction
                                    </td>
                                    <td>
                                        Total Deduction
                                    </td>
                                    <td>
                                        Net Salary
                                    </td>
                                </tr>
                                @foreach ($emp_annual_pay_report as  $salary)
                                <tr>
                                    <td>
                                       {{$salary['month_lable']}}
                                    </td>
                                    <td>
                                       {{$salary['data']?->basic}}
                                    </td>
                                    @if(!empty($salary['data']) && !empty($salary['data']->payrollSalaryHead))
                                        @foreach ($salary['data']->payrollSalaryHead as $key => $value)
                                            @if ($value->payroll_head->head_type == 'income')
                                            <td style="text-align: right;">1
                                                @if ($value->payroll_head->slug == 'bomaid_bank')
                                                     {{ $value->value }}
                                                @endif
                                                @if ($value->payroll_head->slug == 'pension_bank')
                                                     {{ $value->value }}
                                                @endif
                                                 @if ($value->payroll_head->slug == 'allowance')
                                                    {{ $value->value }}
                                                @endif
                                                 @if ($value->payroll_head->slug == 'others_arrears')
                                                   {{ $value->value }}
                                                @endif
                                                 @if ($value->payroll_head->slug == 'over_time')
                                                     {{ $value->value }}
                                                @endif
                                                income
                                            </td>
                                            @endif
                                        @endforeach
                                    @endif
                                    <td>
                                        {{$salary['data']?->gross_earning}}
                                    </td>
                                    <td>
                                        @if(!empty($salary['data']) && !empty($salary['data']->payrollSalaryHead))
                                        @foreach ($salary['data']->payrollSalaryHead as $key => $value)
                                            @if ($value->payroll_head->head_type == 'deduction')
                                            <td style="text-align: right;">ddd
                                                @if ($value->payroll_head->slug == 'bomaid')
                                                    {{ $value->value }}
                                                
                                                @endif
                                                @if ($value->payroll_head->slug == 'pension_own')
                                                    {{ $value->value }}
                                                
                                                @endif
                                                @if ($value->payroll_head->slug == 'union_fee')
                                                    {{ $value->value }}
                                                
                                                @endif
                                                @if ($value->payroll_head->slug == 'tax')
                                                    {{ $value->value }}
                                                
                                                @endif
                                                @if ($value->payroll_head->slug == 'other_deductions')
                                                   {{ $value->value }}</td>
                                                
                                                @endif
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                    </td>
                                    <td>
                                        {{$salary['data']?->net_take_home}}
                                    </td>
                                </tr>
                                @endforeach
                               
                                
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
