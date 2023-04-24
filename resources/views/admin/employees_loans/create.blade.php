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
                                    <label for="name">Select Employees </label>
                                    <select required id="gender" placeholder="Enter correct gender   " name="user_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Employees- </option>
                                        @foreach ($all_users as $au)
                                            <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                                {{ $au->user->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="username"> Select Loans</label>
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
                                    <label for="start_date">start_date </label>
                                    <input required id="start_date" placeholder="Enter correct start_date   "
                                        type="date" name="start_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="end_date">end_date </label>
                                    <input required id="end_date" placeholder="Enter correct end_date   "
                                        type="date" name="end_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="principal_amount">principal_amount </label>
                                    <input required id="principal_amount"
                                        placeholder="Enter correct principal_amount   " type="number"
                                        name="principal_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="maturity_amount">maturity_amount </label>
                                    <input required id="maturity_amount" placeholder="Enter correct maturity_amount   "
                                        type="number" name="maturity_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="tenure">tenure </label>
                                    <input required id="tenure" placeholder="Enter correct tenure   " type="number"
                                        name="tenure" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="sanctioned">sanctioned </label>
                                    <input required id="sanctioned" placeholder="Enter correct sanctioned   "
                                        type="number" name="sanctioned" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="sanctioned_amount">sanctioned_amount </label>
                                    <input required id="sanctioned_amount"
                                        placeholder="Enter correct sanctioned_amount   " type="number"
                                        name="sanctioned_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">Designation </label>
                                    <textarea required id="description" placeholder="Enter Short Description of Designation   " type="text"
                                        name="description" class="form-control form-control-sm "></textarea>
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
