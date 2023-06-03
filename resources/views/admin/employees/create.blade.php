    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.employees.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="name">Employee Name</label>
                                    <input  id="name" required placeholder="Enter correct Emplooye  Name "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="username">Employee User Name</label>
                                    <input id="username" required placeholder="Enter correct Emplooye  User Name "
                                        type="text" name="username" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="email">Email </label>
                                    <input required id="email" placeholder="Enter correct email   " type="email"
                                        name="email" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="mobile">Mobile No </label>
                                    <input required id="mobile" placeholder="Enter correct Mobile No   "
                                        type="tel" name="mobile" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="password">password </label>
                                    <input required id="password" placeholder="Enter correct password   "
                                        type="password" name="password" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm password </label>
                                    <input required id="password_confirmation"
                                        placeholder="Enter correct password confirmation" type="password"
                                        name="password_confirmation" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="designation_id">designatin </label>
                                    <select required id="designation_id" placeholder="Enter correct Emplooye   "
                                        name="designation_id" class="form-control form-control-sm ">
                                        <option selected disabled> -Select Designation- </option>
                                        @foreach ($designation as $deg)
                                            <option value="{{ $deg->id }}">{{ $deg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="ec_number">ec number </label>
                                    <input required id="ec_number" placeholder="Enter correct ec number   "
                                        type="text" name="ec_number" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="gender">gender </label>
                                    <select required id="gender" placeholder="Enter correct gender   " name="gender"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Gender- </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="employment_type">employment_type </label>
                                    <select required id="employment_type" placeholder="Enter correct employment_type   " name="employment_type"
                                    class="form-control form-control-sm ">
                                    <option selected disabled> - Select employment type- </option>
                                    <option value="local">Local</option>
                                    <option value="expatriate">Expatriate</option>
                                    <option value="local-contractual ">Local-Contractual </option>

                                </select>
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="id_number">id number </label>
                                    <input required id="id_number" placeholder="Enter correct id number   "
                                        type="text" name="id_number" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="contract_duration">contract duration </label>
                                    <input required id="contract_duration"
                                        placeholder="Enter correct contract duration   " type="text"
                                        name="contract_duration" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="basic_salary">basic salary </label>
                                    <input required id="basic_salary" placeholder="Enter correct basic salary   "
                                        type="number" name="basic_salary" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="date_of_current_basic">date of current basic </label>
                                    <input required id="date_of_current_basic"
                                        placeholder="Enter correct date of current_basic   " type="datetime-local"
                                        name="date_of_current_basic" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="date_of_birth">date of birth </label>
                                    <input required id="date_of_birth" placeholder="Enter correct date of birth   "
                                        type="date" name="date_of_birth" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="start_date">start date </label>
                                    <input required id="start_date" placeholder="Enter correct start date   "
                                        type="date" name="start_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="branch_id">branch </label>
                                    <select required id="branch_id" name="branch_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Branch - </option>
                                        @foreach ($branch as $br)
                                            <option value="{{ $br->id }}">{{ $br->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="pension_contribution">pension contribution </label>
                                    <input required id="pension_contribution"
                                        placeholder="Enter correct pension contribution   " type="number"
                                        name="pension_contribution" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="unique_membership_id">union membership </label>
                                    <select required id="unique_membership_id"
                                        placeholder="Enter correct union_membership_id   "
                                        name="unique_membership_id" class="form-control form-control-sm ">
                                        <option selected disabled> - Select unique_membership_id - </option>
                                        @foreach ($membership as $mem)
                                            <option value="{{ $mem->id }}">{{ $mem->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="amount_payable_to_bomaind_each_year">amount payable to bomaind each
                                        year
                                    </label>
                                    <input required id="amount_payable_to_bomaind_each_year"
                                        placeholder="Enter correct amount_payable to bomaind each year   "
                                        type="text" name="amount payable to bomaind each year"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="currency">currency </label>
                                    <input required id="currency" placeholder="Enter correct currency   "
                                        type="text" name="currency" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="bank_name">bank name </label>
                                    <input required id="bank name" placeholder="Enter correct bank_name   "
                                        type="text" name="bank name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="bank_account_number">bank account number </label>
                                    <input required id="bank_account_number"
                                        placeholder="Enter correct bank account number   " type="text"
                                        name="bank_account_number" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="bank_holder_name">bank holder name </label>
                                    <input required id="bank_holder_name"
                                        placeholder="Enter correct bank holder name   " type="text"
                                        name="bank_holder_name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="ifsc">ifsc </label>
                                    <input required id="ifsc" placeholder="Enter correct ifsc   " type="text"
                                        name="ifsc" class="form-control form-control-sm ">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary">Add
                                {{ $page }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
