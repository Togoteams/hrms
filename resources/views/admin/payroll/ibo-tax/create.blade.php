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
                    <form id="form_data" action="{{ route('admin.payroll.tax-for-ibo.calculate') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="financial_year" class="required">Financial Year</label>
                                    @php
                                    $currentYear = date('Y');
                                @endphp 
                                    <select required   id="financial_year" placeholder="Enter correct gender" name="financial_year"
                                    class="form-control form-control-sm ">
                                    <option selected disabled="" value=""> - Select Financial year- </option>
                                       
                                        <option value="{{$currentYear-2}}-{{$currentYear-1}}">{{$currentYear-2}}-{{$currentYear-1}}</option>
                                        <option value="{{$currentYear-1}}-{{$currentYear}}">{{$currentYear-1}}-{{$currentYear}}</option>
                                        <option value="{{$currentYear}}-{{$currentYear+1}}">{{$currentYear}}-{{$currentYear+1}}</option>
                                        <option value="{{$currentYear+1}}-{{$currentYear+2}}">{{$currentYear+1}}-{{$currentYear+2}}</option>
                                        <option value="{{$currentYear+2}}-{{$currentYear+3}}">{{$currentYear+2}}-{{$currentYear+3}}</option>
                                        <option value="{{$currentYear+3}}-{{$currentYear+4}}">{{$currentYear+3}}-{{$currentYear+4}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="gender">Select Employees</label>
                                    <select required 
                                        id="select_employee" placeholder="Enter correct gender  " name="user_id"
                                        class="form-control form-control-sm ">
                                        <option selected value="" > - Select Employees- </option>
                                        @foreach ($all_users as $au)
                                            <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                                {{ $au->ec_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="mt-4 form-group">
                                    <button type="button" onclick="callEditMethod()" class="btn btn-primary btn-sm">Calculate</button>
                                </div>
                            </div>
                            <span id="edit">
                            </span>
                        </div>
                        <hr>
                        <div class="text-center" style="display: none" id="table_data_btn">
                        <button type="button"  class="btn btn-primary ">Calculate</button>
                        <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary">Add
                            {{ $page }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('custom-scripts')

<script>
    const editUrl="{{ route('admin.payroll.tax-for-ibo.show') }}/";
    function callEditMethod()
    {
        var empId = $("#select_employee").val();
        console.log(empId);
        $(".err_message").removeClass("d-block").hide();
        var financial_year = $("#financial_year").val();
        var empError = false;
        var financialYearError = false;
        console.log(financial_year);
        if(empId==null || empId=="" )
        {
            let empErrMessage ="Please Select Employee";
            $("#select_employee").after("<p class='d-block text-danger err_message'>" + empErrMessage + "</p>");
            empError = true;
        }
        if(financial_year=="" || financial_year==null)
        {
            let valueMessage="Please Select Financial Year";
            $("#financial_year").after("<p class='d-block text-danger err_message'>" +valueMessage +"</p>");
            financialYearError = true;
        }
        if(!empError && !financialYearError){
            editForm(editUrl+empId+"/"+financial_year, 'edit');
        }
    }
</script>

@endpush
