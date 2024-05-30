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
                        </a>/ 13th Cheque Report 
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
                            <h2 class="page-header-title">13th Cheque Report</h2>
                        </div>
                        <div>
                            <form action="{{ route('admin.reports.thirteen-cheque-report') }}" method="get">
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
                                            <button type="submit" class="mt-3 btn btn-sm btn-primary">
                                                Search
                                            </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                        @if($financial_year)
                        <div class="report-display-section">
                            @if ($employees)
                            <table>
                                <tr>
                                    <td colspan="6">
                                        Payment of 13th Cheque {{$financial_year_text}}</td>
                                </tr>
                                <tr>
                                    <td>Employees Name</td>
                                    <td>EC Number</td>
                                    <td> Name of Branch</td>
                                    @foreach ($months as $keyM => $month )
                                    <td>{{$month['month']['lable']."-".$month['year']}} Basic</td>
                                    @endforeach
                                    <td> Total</td>
                                    <td> Average</td>
                                    <td> I.Tax</td>
                                    <td> Net payable</td>
                                    <td> Account No.</td>
                                    
                                </tr>
                                @foreach($emp13ChequeReport as $key => $employe)
                                    <tr>
                                        <td>{{ $employe['name_of_employee']}}</td>
                                        <td>{{ $employe['ec_number']}}</td>
                                        <td>{{ $employe['branch_name']}}</td>
                                        @foreach ($employe['months'] as $keyM => $month )
                                        <td> {{$month['basic']}}</td>
                                        @endforeach
                                        <td> {{ $employe['total_amount']}}</td>
                                        <td>{{ $employe['average_amount']}}</td>
                                        <td>{{ $employe['total_i_tax_amount']}}</td>
                                        <td>{{ $employe['net_payable_amount']}}</td>
                                        <td>{{ $employe['bank_account_number']}}</td>

                                    </tr>
                                @endforeach
                            </table>
                            @endif
                           
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Card -->


        </div>

    </main>
@endsection
