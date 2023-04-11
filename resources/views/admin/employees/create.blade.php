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
                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input required placeholder="Enter correct Emplooye  id " type="number"
                                        name="emp_id" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Name</label>
                                    <input required placeholder="Enter correct Emplooye  Name " type="text"
                                        name="name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee User Name</label>
                                    <input required placeholder="Enter correct Emplooye  User Name " type="text"
                                        name="username" class="form-control form-control-sm ">
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
                                        type="number" name="mobile" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="password">password </label>
                                    <input required id="password" placeholder="Enter correct password   "
                                        type="text" name="password" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="password_confirmation">confirm password </label>
                                    <input required id="password_confirmation" placeholder="Enter correct password_confirmation   "
                                        type="password" name="password_confirmation" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="designatin_id">designatin </label>
                                    <select required id="designatin_id" placeholder="Enter correct Emplooye   " 
                                        name="designatin_id" class="form-control form-control-sm ">
                                        <option selected disabled> -Select Designation- </option>
                                        @foreach ($designation as $deg)
                                            <option value="{{ $deg->id }}">{{ $deg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="gender">gender </label>
                                    <select required id="gender" placeholder="Enter correct gender   " 
                                        name="gender" class="form-control form-control-sm ">
                                        <option selected disabled> - Select Gender- </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="id_number">id_number </label>
                                    <input required id="id_number" placeholder="Enter correct id_number   " type="text"
                                        name="id_number" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="contract_duration">contract_duration </label>
                                    <input required id="contract_duration" placeholder="Enter correct contract_duration   "
                                        type="text" name="contract_duration"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="basic_salary">basic_salary </label>
                                    <input required id="basic_salary" placeholder="Enter correct basic_salary   "
                                        type="number" name="basic_salary" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="date_of_current_basic">date_of_current_basic </label>
                                    <input required id="date_of_current_basic"
                                        placeholder="Enter correct date_of_current_basic   " type="text"
                                        name="date_of_current_basic" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="date_of_birth">date_of_birth </label>
                                    <input required id="date_of_birth" placeholder="Enter correct date_of_birth   "
                                        type="date" name="date_of_birth" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="start_date">start_date </label>
                                    <input required id="start_date" placeholder="Enter correct start_date   " type="date"
                                        name="start_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="branch_id">branch  </label>
                                    <select required id="branch_id" placeholder="Enter correct branch_id   " name="branch_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Branch - </option>
                                    @foreach ($branch as $br )
                                        <option value="{{$br->id}}">{{$br->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="pension_contribution">pension_contribution </label>
                                    <input required id="pension_contribution"
                                        placeholder="Enter correct pension_contribution   " type="number"
                                        name="pension_contribution" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="unique_membership_id">unique membership  </label>
                                    <select required id="unique_membership_id"
                                        placeholder="Enter correct unique_membership_id   "
                                        name="unique_membership_id" class="form-control form-control-sm ">
                                        <option selected disabled> - Select unique_membership_id - </option>
                                        @foreach ($membership as $mem)
                                            <option value="{{$mem->id}}">{{$mem->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label
                                        for="amount_payable_to_bomaind_each_year">amount_payable_to_bomaind_each_year
                                    </label>
                                    <input required id="amount_payable_to_bomaind_each_year"
                                        placeholder="Enter correct amount_payable_to_bomaind_each_year   "
                                        type="text" name="amount_payable_to_bomaind_each_year"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="currency">currency </label>
                                    <input required id="currency" placeholder="Enter correct currency   " type="text"
                                        name="currency" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="bank_name">bank_name </label>
                                    <input required id="bank_name" placeholder="Enter correct bank_name   " type="text"
                                        name="bank_name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="bank_account_number">bank_account_number </label>
                                    <input required id="bank_account_number" placeholder="Enter correct bank_account_number   "
                                        type="text" name="bank_account_number"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="bank_holder_name">bank_holder_name </label>
                                    <input required id="bank_holder_name" placeholder="Enter correct bank_holder_name   "
                                        type="text" name="bank_holder_name" class="form-control form-control-sm ">
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
