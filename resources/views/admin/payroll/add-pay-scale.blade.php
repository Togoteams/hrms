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

                <!-- End Row -->
            </div>
            <div class="row card">
                <form id="form_data" action="{{ route('admin.payroll.pay-scale.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                    <div class="row py-4 px-5">
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select required id="user_id" placeholder="Enter correct Emplooye" name="user_id"
                                    class="form-control form-control-sm ">
                                    <option selected disabled> -Select User- </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} -
                                            {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="basic">basic</label>
                                <input required id="basic" placeholder="Enter correct basic" type="text"
                                    name="basic" class="form-control form-control-sm ">
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="hra">hra</label>
                                <input required id="hra" placeholder="Enter correct hra" type="text" name="hra"
                                    class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="overtime">overtime</label>
                                <input required id="overtime" placeholder="Enter correct overtime" type="text"
                                    name="overtime" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="arrear">arrear</label>
                                <input required id="arrear" placeholder="Enter correct arrear" type="text"
                                    name="arrear" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="union_membership">union membership</label>
                                <select required id="union_membership" placeholder="Enter correct union_membership"
                                    name="union_membership" class="form-control form-control-sm ">
                                    <option selected disabled> - Select union membership - </option>
                                    @foreach ($membership as $mem)
                                        <option value="{{ $mem->id }}">{{ $mem->name }} -
                                            {{ $mem->amount }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="pf_per">pf_per</label>
                                <input required id="pf_per" placeholder="Enter correct pf_per" type="text"
                                    name="pf_per" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="pf_amount">pf_amount</label>
                                <input required id="pf_amount" placeholder="Enter correct pf_amount" type="text"
                                    name="pf_amount" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="pension_per">pension_per</label>
                                <input required id="pension_per" placeholder="Enter correct pension_per" type="text"
                                    name="pension_per" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="pension_amount">pension_amount</label>
                                <input required id="pension_amount" placeholder="Enter correct pension_amount"
                                    type="text" name="pension_amount" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="loans_deduction">loans_deduction</label>
                                <input required id="loans_deduction" placeholder="Enter correct loans_deduction"
                                    type="text" name="loans_deduction" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="no_of_working_days">no_of_working_days</label>
                                <input required id="no_of_working_days" placeholder="Enter correct no_of_working_days"
                                    type="text" name="no_of_working_days" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="no_of_paid_leaves">no_of_paid_leaves</label>
                                <input required id="no_of_paid_leaves" placeholder="Enter correct no_of_paid_leaves"
                                    type="text" name="no_of_paid_leaves" class="form-control form-control-sm ">
                            </div>
                        </div>


                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="shift">shift</label>
                                <input required id="shift" placeholder="Enter correct shift" type="text"
                                    name="shift" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="working_hours_start">working_hours_start</label>
                                <input required id="working_hours_start" placeholder="Enter correct working_hours_start"
                                    type="text" name="working_hours_start" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="working_hours_end">working_hours_end</label>
                                <input required id="working_hours_end" placeholder="Enter correct working_hours_end"
                                    type="text" name="working_hours_end" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="no_of_payable_days">no_of_payable_days</label>
                                <input required id="no_of_payable_days" placeholder="Enter correct no_of_payable_days"
                                    type="text" name="no_of_payable_days" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="conveyance">conveyance</label>
                                <input required id="conveyance" placeholder="Enter correct conveyance" type="text"
                                    name="conveyance" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="special">special</label>
                                <input required id="special" placeholder="Enter correct special" type="text"
                                    name="special" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="mobile">mobile</label>
                                <input required id="mobile" placeholder="Enter correct mobile" type="text"
                                    name="mobile" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="bonus">bonus</label>
                                <input required id="bonus" placeholder="Enter correct bonus" type="text"
                                    name="bonus" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="transportation">transportation</label>
                                <input required id="transportation" placeholder="Enter correct transportation"
                                    type="text" name="transportation" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="food">food</label>
                                <input required id="food" placeholder="Enter correct food" type="text"
                                    name="food" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="medical">medical</label>
                                <input required id="medical" placeholder="Enter correct medical" type="text"
                                    name="medical" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="gross_earning">gross_earning</label>
                                <input required id="gross_earning" placeholder="Enter correct gross_earning"
                                    type="text" name="gross_earning" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="esi_per">esi_per</label>
                                <input required id="esi_per" placeholder="Enter correct esi_per" type="text"
                                    name="esi_per" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="esi_amount">esi_amount</label>
                                <input required id="esi_amount" placeholder="Enter correct esi_amount" type="text"
                                    name="esi_amount" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="income_tax_deductions">income_tax_deductions</label>
                                <input required id="income_tax_deductions"
                                    placeholder="Enter correct income_tax_deductions" type="text"
                                    name="income_tax_deductions" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="penalty_deductions">penalty_deductions</label>
                                <input required id="penalty_deductions" placeholder="Enter correct penalty_deductions"
                                    type="text" name="penalty_deductions" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="fixed_deductions">fixed_deductions</label>
                                <input required id="fixed_deductions" placeholder="Enter correct fixed_deductions"
                                    type="text" name="fixed_deductions" class="form-control form-control-sm ">
                            </div>
                        </div>

                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="other_deductions">other_deductions</label>
                                <input required id="other_deductions" placeholder="Enter correct other_deductions"
                                    type="text" name="other_deductions" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="net_take_home">net_take_home</label>
                                <input required id="net_take_home" placeholder="Enter correct net_take_home"
                                    type="text" name="net_take_home" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="ctc">ctc</label>
                                <input required id="ctc" placeholder="Enter correct ctc" type="text"
                                    name="ctc" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="total_employer_contribution">total_employer_contribution</label>
                                <input required id="total_employer_contribution"
                                    placeholder="Enter correct total_employer_contribution" type="text"
                                    name="total_employer_contribution" class="form-control form-control-sm ">
                            </div>
                        </div>
                        <div class="col-sm-4 mb-2">
                            <div class="form-group">
                                <label for="total_deduction">total_deduction</label>
                                <input required id="total_deduction" placeholder="Enter correct total_deduction"
                                    type="text" name="total_deduction" class="form-control form-control-sm ">
                            </div>
                        </div>



                        <div class="text-center">
                            <button type="submit" class="btn btn-white btn-sm" title="Submit">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
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
