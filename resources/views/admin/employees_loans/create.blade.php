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
                    <form id="form_data" action="{{ route('admin.employees_loans.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="name">Employee Name</label>
                                    <select required id="gender" placeholder="Enter correct gender   " name="user_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Employee- </option>
                                        @foreach ($all_users as $au)
                                            <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                                {{ $au->user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="username">Type Of Loan</label>
                                    <select required id="loan_id" name="loan_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Loans- </option>
                                        @foreach ($loans as $loan)
                                            <option value="{{ $loan->id }}">{{ $loan->name }} -
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="loan_amount">Loan Amount</label>
                                    <input required id="loan_amount"
                                        placeholder="Enter loan_amount   " type="number"
                                        name="loan_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="emi_amount">EMI Amount</label>
                                    <input required id="emi_amount"
                                        placeholder="Enter emi_amount   " type="number"
                                        name="emi_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="emi_start_date">EMI Start Date</label>
                                    <input required id="emi_start_date" placeholder="Enter emi_start_date   "
                                        type="date" name="emi_start_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="emi_end_date">EMI End Date</label>
                                    <input required id="emi_end_date" placeholder="Enter emi_end_date"
                                        type="date" name="emi_end_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="tenure">Tenure</label>
                                    <input required id="tenure" placeholder="Enter correct tenure   " type="number"
                                        name="tenure" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="last_emi_amount">Last EMI Amount</label>
                                    <input required id="last_emi_amount" placeholder="Enter last_emi_amount  "
                                        type="number" name="last_emi_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea  id="description" placeholder="Enter  Description..." type="text"
                                        name="description" class="form-control form-control-sm "></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center ">
                            <button type="button" onclick="ajaxCall('form_data')" class="btn btn-white">Add
                                {{ $page }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
