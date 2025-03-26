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
                <form class="formsubmit" action="{{ route('admin.payroll.emp-13th-cheque.save') }}" method="post">
                    @csrf
                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                    
                    <div class="row">
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="financial_year" class="required">Financial year</label>
                                <select required id="financial_year" name="financial_year"
                                    class="form-control form-control-sm">
                                    <option selected disabled=""> - Select financial year- </option>
                                    @php
                                        $currentYear = date('Y');
                                    @endphp
                                    <option value="{{ $currentYear - 1 }}-{{ $currentYear }}"
                                       >
                                        {{ $currentYear - 1 }}-{{ $currentYear }}</option>
                                    <option value="{{ $currentYear }}-{{ $currentYear + 1 }}"
                                       >
                                        {{ $currentYear }}-{{ $currentYear + 1 }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="gender">Select Branch</label>
                                <select required  id="branch_id" placeholder="Enter correct Branch" name="branch_id" class="form-control select2 form-control-sm ">
                                    <option selected disabled> - Select Branch- </option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4">
                            <div class="form-group">
                                <label for="gender">Select Employees</label>
                                <select required  id="user_id" placeholder="Enter correct Employee" name="user_id" class="form-control select2 form-control-sm ">
                                    <option selected disabled> - Select Employees- </option>
                                    @foreach ($employees as $au)
                                    <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                        {{ $au->ec_number }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-4" id="generate_btn">
                            <div class="mt-4 form-group">
                                <button type="button" onclick="generate()" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                        <span id="append_data">

                        </span>
                    </div>
                    <hr>
                    <div class="mt-1 text-center" id="table_data_btn">
                        <button type="submit" class="btn btn-primary btn-sm">Save 13 Cheque</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@push('custom-scripts')
<script>
    function generate()
    {
        var url = "{{route('admin.payroll.emp-13th-cheque.generate')}}"
        $.ajax({
            type: "get",
            url: url,
            data: { 
                    financial_year: $('#financial_year').val(),
                    branch_id: $('#branch_id').val(), 
                    user_id: $('#user_id').val(), 
                },
            cache: false,
            dataType: "json",
            beforeSend: function () {},
            success: function (response) {
                if (response.status) {
                    $("#append_data")
                        .html(response.data.html_view);
                 $("#table_data_btn").css('display','block');
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "We are facing some technical issue now.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            },
            error: function (response) {
                Swal.fire({
                    icon: "error",
                    title: "We are facing some technical issue now. Please try again after some time",
                    showConfirmButton: false,
                    timer: 1500,
                });
            },
            /* ,
            complete: function(response){
                location.reload();
            } */
        });
    }
</script>
@endpush

