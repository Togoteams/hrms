

<div class="row">
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="name">Select Employees </label>
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
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="username"> Select Loans</label>
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

    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="start_date">start_date </label>
            <input disabled  required id="start_date" placeholder="Enter correct start_date   " type="date"
                value="{{ $data->start_date }}" name="start_date" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="end_date">end_date </label>
            <input disabled value="{{ $data->end_date }}" required id="end_date" placeholder="Enter correct end_date   "
                type="date" name="end_date" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="principal_amount">principal_amount </label>
            <input disabled value="{{ $data->principal_amount }}" required id="principal_amount"
                placeholder="Enter correct principal_amount   " type="number" name="principal_amount"
                class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="maturity_amount">maturity_amount </label>
            <input disabled value="{{ $data->maturity_amount }}"  required id="maturity_amount" placeholder="Enter correct maturity_amount   " type="number"
                name="maturity_amount" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="tenure">tenure </label>
            <input disabled value="{{ $data->tenure }}" required id="tenure" placeholder="Enter correct tenure   "
                type="number" name="tenure" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="sanctioned">sanctioned </label>
            <input disabled value="{{ $data->sanctioned }}" required id="sanctioned"
                placeholder="Enter correct sanctioned   " type="number" name="sanctioned"
                class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="sanctioned_amount">sanctioned_amount </label>
            <input disabled required id="sanctioned_amount" placeholder="Enter correct sanctioned_amount   " type="number"
              value="{{ $data->sanctioned_amount }}"   name="sanctioned_amount" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-12 mb-2">
        <div class="form-group">
            <label for="description">Designation </label>
            <textarea disabled required id="description" placeholder="Enter Short Description of Designation   " name="description"
                class="form-control form-control-sm ">{{ $data->description }}</textarea>
        </div>
    </div>
</div>
    <hr>
