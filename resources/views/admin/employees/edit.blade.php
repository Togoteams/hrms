<form id="form_edit" action="{{ route('admin.employees.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="user_id">Employee Id</label>
                <input disabled required placeholder="Enter correct Emplooye  id " value="{{ $data->emp_id }}" readonly
                    type="text" name="emp_id" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="user_id">Employee Name</label>
                <input disabled required placeholder="Enter correct Emplooye  Name " value="{{ $data->user->name }}"
                    type="text" name="name" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="user_id">Employee User Name</label>
                <input disabled required placeholder="Enter correct Emplooye  User Name "
                    value="{{ $data->user->username }}" type="text" name="username"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="email">Email</label>
                <input disabled required id="email" placeholder="Enter correct email   "
                    value="{{ $data->user->email }}" type="email" name="email"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="mobile">Mobile No</label>
                <input disabled required id="mobile" placeholder="Enter correct Mobile No   "
                    value="{{ $data->user->mobile }}" type="number" name="mobile"
                    class="form-control form-control-sm ">
            </div>
        </div>
        {{-- <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="password">password</label>
                <input required id="password" placeholder="Enter correct password   " type="text" name="password"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="password_confirmation">confirm password</label>
                <input required id="password_confirmation" placeholder="Enter correct password confirmation   "
                    type="password" name="password_confirmation" class="form-control form-control-sm ">
            </div>
        </div> --}}
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="designation_id">designatin</label>
                <select required id="designation_id" placeholder="Enter correct Emplooye   " name="designation_id"
                    class="form-control form-control-sm ">
                    <option disabled> -Select Designation- </option>
                    @foreach ($designation as $deg)
                        <option {{ $deg->id == $data->designation_id ? 'selected' : '' }} value="{{ $deg->id }}">
                            {{ $deg->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="ec_number">ec number</label>
                <input required id="ec_number" placeholder="Enter correct ec number   " value="{{ $data->ec_number }}"
                    type="text" name="ec_number" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="gender">gender</label>
                <select required id="gender" placeholder="Enter correct gender   " name="gender"
                    class="form-control form-control-sm ">
                    <option disabled> - Select Gender- </option>
                    <option {{ $data->gender == 'male' ? 'selected' : '' }} value="male">Male</option>
                    <option {{ $data->gender == 'female' ? 'selected' : '' }} value="female">Female</option>
                    <option {{ $data->gender == 'others' ? 'selected' : '' }} value="others">others</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4 mb-2 ">
            <div class="form-group">
                <label for="employment_type">employment_type </label>
                <select required id="employment_type_edit" placeholder="Enter correct employment_type   "
                    name="employment_type" class="form-control form-control-sm ">
                    <option disabled> - Select employment type- </option>
                    <option {{ $data->employment_type == 'local' ? 'selected' : '' }} value="local">Local</option>
                    <option {{ $data->employment_type == 'expatriate' ? 'selected' : '' }} value="expatriate">
                        Expatriate</option>
                    <option {{ $data->employment_type == 'local-contractual' ? 'selected' : '' }}
                        value="local-contractual">Local-Contractual </option>

                </select>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="id_number">id number </label>
                <input required id="id_number" placeholder="Enter correct id number   " value="{{ $data->id_number }}"
                    type="text" name="id_number" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2" id="contractDivEdit">
            <div class="form-group">
                <label for="contract_duration">contract duration</label>
                <input required id="contract_duration_edit" placeholder="Enter correct contract duration   "
                    type="text" value="{{ $data->contract_duration }}" name="contract_duration"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="basic_salary">basic salary </label>
                <input required id="basic_salary" placeholder="Enter correct basic salary   " type="number"
                    value="{{ $data->basic_salary }}" name="basic_salary" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="date_of_current_basic">date of current basic</label>
                <input required id="date_of_current_basic" placeholder="Enter correct date of current_basic   "
                    value="{{ $data->date_of_current_basic }}" type="datetime-local" name="date_of_current_basic"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="date_of_birth">date of birth</label>
                <input required id="date_of_birth" placeholder="Enter correct date of birth   " type="date"
                    value="{{ $data->date_of_birth }}" name="date_of_birth" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="start_date">start date</label>
                <input required id="start_date" placeholder="Enter correct start date   " type="date"
                    value="{{ $data->start_date }}" name="start_date" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="branch_id">branch</label>
                <select required id="branch_id" name="branch_id" class="form-control form-control-sm ">
                    <option selected disabled> - Select Branch - </option>
                    @foreach ($branch as $br)
                        <option {{ $br->id == $data->branch_id ? 'selected' : '' }} value="{{ $br->id }}">
                            {{ $br->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="pension_contribution">pension contribution </label>
                <input required id="pension_contribution" placeholder="Enter correct pension_contribution   "
                    value="{{ $data->pension_contribution }}" type="number" name="pension_contribution"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="unique_membership_id">unique membership</label>
                <select required id="unique_membership_id" placeholder="Enter correct unique membership id   "
                    name="unique_membership_id" class="form-control form-control-sm ">
                    <option selected disabled> - Select unique_membership_id - </option>
                    @foreach ($membership as $mem)
                        <option {{ $mem->id == $data->unique_membership_id ? 'selected' : '' }}
                            value="{{ $mem->id }}">{{ $mem->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="amount_payable_to_bomaind_each_year">amount payable to bomaind each year
                </label>
                <input required id="amount_payable_to_bomaind_each_year"
                    value="{{ $data->amount_payable_to_bomaind_each_year }}"
                    placeholder="Enter correct amount payable to bomaind each year   " type="text"
                    name="amount_payable_to_bomaind_each_year" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="currency">currency</label>
                <input required id="currency" placeholder="Enter correct currency   " type="text"
                    value="{{ $data->currency }}" name="currency" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="bank_account_number">bank account number</label>
                <input required id="bank_account_number" placeholder="Enter correct bank account number   "
                    value="{{ $data->bank_account_number }}" type="text" name="bank_account_number"
                    class="form-control form-control-sm ">
            </div>
        </div>
        {{-- <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="bank_name">bank name</label>
                <input required id="bank_name" placeholder="Enter correct bank_name   " type="text"
                    value="{{ $data->bank_name }}" name="bank_name" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="bank_holder_name">bank holder name</label>
                <input required id="bank_holder_name" placeholder="Enter correct bank holder name   " type="text"
                    value="{{ $data->bank_holder_name }}" name="bank_holder_name"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="ifsc">ifsc</label>
                <input required id="ifsc" placeholder="Enter correct ifsc   " type="text" name="ifsc"
                    value="{{ $data->ifsc }}" class="form-control form-control-sm ">
            </div>
        </div> --}}

    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
