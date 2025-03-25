@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="mt-2 border-bottom">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/ Salary Settings
                    </div>
                    <!-- End Col -->
                </div>
            </div>

            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm mb-sm-0">
                            <h2 class="page-header-title">Salary Settings</h2>
                        </div>
                    </div>
                </div>
                <div class="card card-body pt-50">
                    <div class="row">

                        <form id="form_data" class="formsubmit" action="{{ route('admin.payroll.salary_setting.store') }}" method="post">
                            @csrf

                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="bank_pension_contribution">Bank Pension Contribution(%)<span
                                                class="text-danger">*</span></label>
                                        <input type="text"  min="1" max="99"  id="bank_pension_contribution"
                                            name="bank_pension_contribution" class="form-control"
                                            placeholder="Enter Bank Pension Contribution " required
                                            value="{{ $salarysetting?->bank_pension_contribution }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 contact-name">
                                        <label for="local_bank_bomaid_contribution"> Bank Bomaid Contribution For Local(%)<span
                                                class="text-danger">*</span></label>
                                        <input type="number" min="1" max="99" id="local_bank_bomaid_contribution" name="local_bank_bomaid_contribution"
                                            class="form-control" placeholder="Enter Bank Bomaid Contribution " required
                                            value="{{ $salarysetting?->local_bank_bomaid_contribution }}">
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="mb-3 contact-name">
                                        <label for="da_per"> DA(%)(For NPS)<span
                                                class="text-danger">*</span></label>
                                        <input type="number" min="1" max="99" step="0.01" id="da_per" name="da_per"
                                            class="form-control" placeholder="Enter Bank Bomaid Contribution " required
                                            value="{{ $salarysetting?->da_per }}">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="mb-3 contact-name">
                                        <label for="ibo_bank_bomaid_contribution">Local Bank Bomaid Contribution For IBO(%)<span
                                                class="text-danger">*</span></label>
                                        <input type="number" min="1" max="100" id="ibo_bank_bomaid_contribution" name="ibo_bank_bomaid_contribution"
                                            class="form-control" placeholder="Enter Bank Bomaid Contribution " required
                                            value="{{ $salarysetting?->ibo_bank_bomaid_contribution }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3 contact-name">
                                        <label for="salary_date">Salary Date of Each Month<span class="text-danger">*</span></label>
                                        <input type="number" id="salary_date" min="1" max="30" name="salary_date" class="form-control"
                                            placeholder="Enter Salary Date " required
                                            value="{{ $salarysetting?->salary_date }}">
                                    </div>
                                </div> --}}


                                <div class="text-center ">
                                    <button type="submit" class="btn btn-white">Update
                                        Salary Settings</button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>



            </div>

        </div>

    </main>
@endsection
