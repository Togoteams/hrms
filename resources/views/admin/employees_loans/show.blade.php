<div class="row">
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="name">Employees Name</label>
            <select disabled required id="gender" placeholder="Enter correct gender   " name="user_id"
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
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="username"> Type Of Loan</label>
            <select disabled required id="loan_id" name="loan_id" class="form-control form-control-sm ">
                <option selected> - Select Loans- </option>
                @foreach ($loans as $loan)
                    <option {{ $data->loan_id == $loan->id ? 'selected' : '' }} value="{{ $loan->id }}">
                        {{ $loan->name }} -
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="loan_amount">Loan Amount</label>
            <input required id="loan_amount" placeholder="Enter loan_amount   " type="number"
                name="loan_amount" value="{{ $data->loan_amount }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="emi_amount">Emi Amount</label>
            <input required id="emi_amount" placeholder="Enter emi_amount   " type="number"
                name="emi_amount" value="{{ $data->emi_amount }}" class="form-control form-control-sm ">
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="emi_start_date">Emi Start Date</label>
            <input required id="emi_start_date" placeholder="Enter emi_start_date   "
                type="date" value="{{ $data->emi_start_date }}" name="emi_start_date" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="emi_end_date">Emi End Date</label>
            <input required id="emi_end_date" placeholder="Enter emi_end_date"
                type="date" value="{{ $data->emi_end_date }}" name="emi_end_date" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="tenure">tenure</label>
            <input value="{{ $data->tenure }}" required id="tenure" placeholder="Enter correct tenure   "
                type="number" name="tenure" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="last_emi_amount">Last Emi Amount</label>
            <input required id="last_emi_amount" placeholder="Enter last_emi_amount  "
                type="number" name="last_emi_amount" value="{{ $data->last_emi_amount }}" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea disabled required id="description" placeholder="Enter Short Description of Designation   " name="description"
                class="form-control form-control-sm ">{{ $data->description }}</textarea>
        </div>
    </div>
</div>
<hr>
