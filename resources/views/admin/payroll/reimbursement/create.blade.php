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
    <main id="content" role="main" class="main card ">
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
                <!-- Button trigger modal -->
                @if(session('status'))
                <div class="alert alert-success" id="status-message">{{ session('status') }}</div>
               @endif
                <div class="p-5 card">
                    {{-- <form id="form_data" action="{{ route('admin.payroll.salary.store') }}"> --}}
                        <form action="{{ route('admin.payroll.reimbursement.store') }}" method="post">
                        @csrf
                        {{-- <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}"> --}}

                        <div class="row">
                            <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputName">Type <sup class="text-danger">*</sup></label>
                                    <select name="type_id" class="form-control" id="exampleInputName" placeholder="Reimbursement type">
                                        <option value="">Select Option</option>
                                         @foreach($reimbursementType as $data)
                                         <option value="{{ $data->id }}" {{ old('type_id') == $data->id ? 'selected' : '' }}>
                                            {{ $data->type }}
                                        </option>                                         
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('type_id')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="bill">Bill Amount</label>
                                    <input type="text" name="bill_amount" class="form-control" placeholder="bill_amount" value="{{ old('bill_amount') }}">
                                    <span class="text-danger">
                                        @error('bill_amount')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="expenses">Expenses Date</label>
                                    <input type="date" name="expenses_date" class="form-control" placeholder="expenses_date" value="{{ old('expenses_date') }}">
                                    <span class="text-danger">
                                        @error('expenses_date')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="expenses">Reimbursement Amount</label>
                                    <input type="text" name="reimbursement_amount" class="form-control" placeholder="reimbursement_amount" value="{{ old('reimbursement_amount') }}">
                                    <span class="text-danger">
                                        @error('reimbursement_amount')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="expenses">Reimbursement notes</label>
                                    <input type="text" name="reimbursement_notes" class="form-control" placeholder="reimbursement_notes" value="{{ old('reimbursement_notes') }}">
                                    <span class="text-danger">
                                        @error('reimbursement_notes')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputName">Status<sup class="text-danger">*</sup></label>
                                    <select name="status" class="form-control" id="exampleInputName">
                                        <option value="">Selected Option</option>
                                        <option value="0">Pending</option>
                                        <option value="1">Approved</option>
                                        <option value="2">Reject</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}
                            <span id="edit">
                            </span>

                            <div class="text-center" id="table_data_btn">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="text-center" style="display: none" id="table_data_btn">
                            <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary">Add
                                {{ $page }}</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
<script>
    setTimeout(() => {
                 $('#status-message').text('').removeClass('alert alert-success');
               
               }, 2000);
</script>

{{-- <script>
    function setId(id, value) {
        document.getElementById(id).value = value;
    }

    function getValue(id) {
        return Number(document.getElementById(id).value);
    }


    function amount_cal(data, operator = null) {
        var total_gross_amount = 0;
        var total_deduction = 0;
        var totalEarning = 0;
        var totalDeduction = 0;
        
        employmentType = document.getElementById('employment_type').value;
        if(employmentType=="local")
        {
            console.log("local");
            totalEarning = getValue('basic') + getValue('allowance') + getValue('others_arrears');
            totalDeduction = getValue('tax')
            + getValue('bomaid')
             + getValue('pension')
              + getValue('union_fee')  + getValue('other_deductions')

        }else
        {
            console.log("exp");
            totalEarning = getValue('basic')+
         getValue('entertainment_expenses')+
             getValue('house_up_keep_allow')+  getValue('education_allowance');
             totalDeduction = getValue('provident_fund')
             + getValue('other_deductions');
        }

        setId('gross_earning', totalEarning);
        setId('total_deduction', totalDeduction);
        setId('net_take_home', totalEarning-totalDeduction);

    }
</script> --}}