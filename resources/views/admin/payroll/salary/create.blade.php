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
            <div class="p-5 card">
                <form id="form_data" action="{{ route('admin.payroll.salary.store') }}">
                    @csrf
                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                    <div class="row">
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="gender">Select Employees</label>
                                <select required onchange="editForm('{{ route('admin.payroll.salary.emp.head') }}/'+this.value, 'edit')" id="employee" placeholder="Enter correct Employee  " name="user_id" class="form-control form-control-sm ">
                                    <option selected disabled> - Select Employees- </option>
                                    @foreach ($all_users as $au)
                                    <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                        {{ $au->user->email }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="gender">Salary Month</label>
                                <select required onchange="callEditMethod()" id="gender" placeholder="Enter correct gender  " name="user_id" class="form-control form-control-sm ">
                                    
                                </select>
                            </div>
                        </div> --}}
                        <span id="edit">

                        </span>
                    </div>
                    <hr>
                    <div class="text-center" style="display: none" id="table_data_btn">
                        <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary">Add
                            {{ $page }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection


<script>
    function setId(id, value) {
        document.getElementById(id).value = value;
    }

    function getValue(id) {
        return Number(document.getElementById(id).value);
    }

    function taxCalCalculation(e) {
        employmentType = document.getElementById('employment_type').value;
        var basicAmount = getValue('basic');
        var taxCalcUrl = "{{route('admin.payroll.payscale.tax.cal')}}";
        var taxAbleAmount = 0;
        if (employmentType == "local") {
            taxAbleAmount = (basicAmount + getValue('allowance')) - (getValue('bomaid'));
        } else {
            // taxAbleAmount = (basicAmount + getValue('entertainment_expenses') + getValue('house_up_keep_allow') + getValue('education_allowance')) - (getValue('bomaid') + getValue('pension'));
        }

        $.ajax({
            url: taxCalcUrl,
            type: "get",
            data: {
                "taxable_amount": taxAbleAmount,
                'employment_type': employmentType
            },
            dataType: "json",
            success: function(result) {
                console.log(result);
                if (result.status == true) {
                    var data = result.data;
                    if(employmentType=="local") {
                    $("#tax").val(data.tax_amount);
                    }
                    console.log(data.tax_amount);
                } else {
                    if(employmentType=="local") {
                    $("#tax").val(0);
                    }
                }
                amount_cal(e);
            },
        });
    }


    function amount_cal(data, operator = null) {
        var total_gross_amount = 0;
        var total_deduction = 0;
        var totalEarning = 0;
        var totalDeduction = 0;

        var employmentType = document.getElementById('employment_type').value;
        var unionFee = 0;
        console.log(employmentType);
        var basicAmount = getValue('basic');
        if (employmentType == "local") {
            var taxAmount = getValue('tax');
            if (basicAmount) {
                unionFee = basicAmount / 100;
            }
            totalEarning = basicAmount + getValue('allowance') + getValue('others_arrears')+ getValue('over_time');
            totalDeduction = taxAmount + getValue('bomaid') + getValue('pension') + unionFee + getValue('other_deductions');
            setId('union_fee', unionFee);

        } else {
            totalEarning = basicAmount + getValue('entertainment_expenses') +
                getValue('house_up_keep_allow') + getValue('education_allowance');
            totalDeduction = getValue('provident_fund') + getValue('other_deductions');
        }

        setId('gross_earning', totalEarning);
        setId('total_deduction', totalDeduction);
        setId('net_take_home', totalEarning - totalDeduction);

    }
    
    // const editUrl="{{ route('admin.payroll.salary.emp.head') }}/";
    // function callEditMethod()
    // {
    //     var empId = 
    //     editForm(editUrl+this.value, 'edit');
    // }
</script>