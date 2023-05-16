@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="mt-2 mb-2">
                <div class="row align-items-center">
                    <div class="col">
                        <h1 class="page-header-title">Add Salary</h1>
                    </div>
                    <!-- End Col -->
                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/ Add Salary
                    </div>
                    <!-- End Col -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>
            <div class="row card">
            <div class="row py-4 px-5">
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>Employee Id </label>
                        <input required  placeholder="Enter correct Emplooye Id  "
                        class="form-control form-control-sm ">

                    </div>
                </div>


                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>basic </label>
                        <input required  placeholder="Enter correct basic   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>

                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>hra </label>
                        <input required  placeholder="Enter correct hra   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label >overtime </label>
                        <input required  placeholder="Enter correct overtime   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>arrear </label>
                        <input required  placeholder="Enter correct arrear   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>unique membership </label>
                        <input required
                            placeholder="Enter correct union_membership   "
                            class="form-control form-control-sm ">

                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>pf_per </label>
                        <input required placeholder="Enter correct pf_per   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label >pf_amount </label>
                        <input required  placeholder="Enter correct pf_amount   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>pension_per </label>
                        <input required  placeholder="Enter correct pension_per   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label >pension_amount </label>
                        <input required  placeholder="Enter correct pension_amount   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label >loans_deduction </label>
                        <input required
                            placeholder="Enter correct loans_deduction   " type="text"
                            class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label >no_of_working_days </label>
                        <input required
                            placeholder="Enter correct no_of_working_days   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label >no_of_paid_leaves </label>
                        <input required
                            placeholder="Enter correct no_of_paid_leaves   " type="text"
                            class="form-control form-control-sm ">
                    </div>
                </div>


                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>shift </label>
                        <input required  placeholder="Enter correct shift   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>working_hours_start </label>
                        <input required
                            placeholder="Enter correct working_hours_start   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>working_hours_end </label>
                        <input required
                            placeholder="Enter correct working_hours_end   " type="text"
                         class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>no_of_payable_days </label>
                        <input required
                            placeholder="Enter correct no_of_payable_days   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>conveyance </label>
                        <input required placeholder="Enter correct conveyance   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>special </label>
                        <input required placeholder="Enter correct special   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>mobile </label>
                        <input required placeholder="Enter correct mobile   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>bonus </label>
                        <input required placeholder="Enter correct bonus   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>transportation </label>
                        <input required placeholder="Enter correct transportation   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label for="food">food </label>
                        <input required id="food" placeholder="Enter correct food   "
                            type="text" name="food" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>medical </label>
                        <input required placeholder="Enter correct medical   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>gross_earning </label>
                        <input required placeholder="Enter correct gross_earning   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>esi_per </label>
                        <input required placeholder="Enter correct esi_per   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>esi_amount </label>
                        <input required placeholder="Enter correct esi_amount   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>income_tax_deductions </label>
                        <input required
                            placeholder="Enter correct income_tax_deductions   " type="text"
                         class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>penalty_deductions </label>
                        <input required
                            placeholder="Enter correct penalty_deductions   " type="text"
                     class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>fixed_deductions </label>
                        <input required
                            placeholder="Enter correct fixed_deductions   " type="text"
                         class="form-control form-control-sm ">
                    </div>
                </div>

                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>other_deductions </label>
                        <input required
                            placeholder="Enter correct other_deductions   " type="text"
                         class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>net_take_home </label>
                        <input required placeholder="Enter correct net_take_home   "
                            type="text" class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>ctc </label>
                        <input required placeholder="Enter correct ctc   " type="text"
                         class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>total_employer_contribution </label>
                        <input required
                            placeholder="Enter correct total_employer_contribution   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>
                <div class="col-sm-4 mb-2">
                    <div class="form-group">
                        <label>total_deduction </label>
                        <input required
                            placeholder="Enter correct total_deduction   " type="text"
                             class="form-control form-control-sm ">
                    </div>
                </div>





            </div>
            </div>

            {{-- edit form model end  --}}

            {{-- edit form model start --}}
            <!-- Modal -->

            {{-- edit form model end  --}}

            {{-- status form model start --}}


            {{-- status form model end  --}}

        </div>

    </main>
@endsection
