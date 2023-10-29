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
                    <form id="form_data" action="{{ route('admin.payroll.payscale.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="pay_for_month" class="required">Pay For</label>
                                    <select name="pay_for_month" id="pay_for_month" class="form-control form-control-sm"  required>
                                        <option value="">-Select Month-</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="gender">Select Employees</label>
                                    <select required  onchange="editForm('{{ route('admin.payroll.payscale.emp.head') }}/'+this.value, 'edit')"
                                        id="gender" placeholder="Enter correct gender  " name="user_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Employees- </option>
                                        @foreach ($all_users as $au)
                                            <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                                {{ $au->user->email }}</option>
                                        @endforeach
                                    </select>
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
@include('admin.payroll.payscale.payroll-payscale-js')
@endpush

<script>
    // window.addEventListener("DOMContentLoaded", (event) => {
    //     const el = document.getElementById('gross_earning');
    //     if (el) {
    //         el.addEventListener('keyup', myFunction, false);
    //     }
    // });

    // function myFunction() {
    //     console.log("testing");
    // }
</script>
