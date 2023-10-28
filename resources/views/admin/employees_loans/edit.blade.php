<form id="form_edit" action="{{ route('admin.employees_loans.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="name">Employees Name</label>
                <select required id="gender" placeholder="Enter correct gender   " name="user_id"
                    class="form-control form-control-sm ">
                    <option disabled> - Select Employees- </option>
                    @foreach ($all_users as $au)
                        <option {{ $data->user_id == $au->user->id ? 'selected' : '' }} value="{{ $au->user->id }}">
                            {{ $au->user->name }} -
                            {{ $au->user->email }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="username">Type Of Loan</label>
                <select required id="loan_id" name="loan_id" class="form-control form-control-sm ">
                    <option selected> - Select Loans- </option>
                    @foreach ($loans as $loan)
                        <option {{ $data->loan_id == $loan->id ? 'selected' : '' }} value="{{ $loan->id }}">
                            {{ $loan->name }} -
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="loan_amount">Loan Amount</label>
                <input required id="loan_amount" placeholder="Enter loan_amount   " type="number"
                    name="loan_amount" value="{{ $data->loan_amount }}" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="emi_amount">EMI Amount</label>
                <input required id="emi_amount" placeholder="Enter emi_amount   " type="number"
                    name="emi_amount" value="{{ $data->emi_amount }}" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="emi_start_date">EMI Start Date</label>
                <input required id="emi_start_date" placeholder="Enter emi_start_date   "
                    type="date" value="{{ $data->emi_start_date }}" name="emi_start_date" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="emi_end_date">EMI End Date</label>
                <input required id="emi_end_date" placeholder="Enter emi_end_date"
                    type="date" value="{{ $data->emi_end_date }}" name="emi_end_date" class="form-control form-control-sm ">
            </div>
        </div>
        
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="tenure">Tenure</label>
                <input value="{{ $data->tenure }}" required id="tenure" placeholder="Enter correct tenure   "
                    type="number" name="tenure" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="last_emi_amount">Last EMI Amount</label>
                <input required id="last_emi_amount" placeholder="Enter last_emi_amount  "
                    type="number" name="last_emi_amount" value="{{ $data->last_emi_amount }}" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea required id="description" placeholder="Enter Short Description of Designation   " name="description"
                    class="form-control form-control-sm ">{{ $data->description }}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
