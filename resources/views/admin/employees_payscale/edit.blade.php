<form id="form_edit" action="{{ route('admin.employees-payscale.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input  type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="user_id">User</label>
                <select required id="user_id" placeholder="Enter correct Emplooye   " name="user_id"
                    class="form-control form-control-sm ">
                    <option  disabled> -Select User- </option>
                    @foreach ($users as $user)
                        <option {{ $data->user_id ==$user->id ? "selected":"" }} value="{{ $user->id }}">{{ $user->name }} -
                            {{ $user->email }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="basic">basic</label>
                <input  value="{{ $data->basic }}"  required id="basic" placeholder="Enter correct basic   " type="text" name="basic"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="hra">hra</label>
                <input  value="{{ $data->hra }}" required id="hra" placeholder="Enter correct hra   " type="text" name="hra"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="overtime">overtime</label>
                <input  value="{{ $data->overtime }}" required id="overtime" placeholder="Enter correct overtime   " type="text" name="overtime"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="arrear">arrear</label>
                <input  value="{{ $data->arrear }}" required id="arrear" placeholder="Enter correct arrear   " type="text" name="arrear"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="union_membership">unique membership</label>
                <select required id="union_membership" placeholder="Enter correct union_membership   "
                name="union_membership" class="form-control form-control-sm ">
                    <option  disabled> - Select unique membership - </option>
                    @foreach ($membership as $mem)
                        <option  {{ $data->union_membership ==$mem->id ? "selected":"" }}  value="{{ $mem->id }}">{{ $mem->name }} -
                            {{ $mem->amount }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="pf_per">pf_per</label>
                <input  value="{{ $data->pf_per }}" required id="pf_per" placeholder="Enter correct pf_per   " type="text" name="pf_per"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="pf_amount">pf_amount</label>
                <input  value="{{ $data->pf_amount }}" required id="pf_amount" placeholder="Enter correct pf_amount   " type="text" name="pf_amount"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="pension_per">pension_per</label>
                <input  value="{{ $data->pension_per }}" required id="pension_per" placeholder="Enter correct pension_per   " type="text"
                    name="pension_per" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="pension_amount">pension_amount</label>
                <input  value="{{ $data->pension_amount }}" required id="pension_amount" placeholder="Enter correct pension_amount   " type="text"
                    name="pension_amount" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="loans_deduction">loans_deduction</label>
                <input  value="{{ $data->loans_deduction }}" required id="loans_deduction" placeholder="Enter correct loans_deduction   " type="text"
                    name="loans_deduction" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="no_of_working_days">no_of_working_days</label>
                <input  value="{{ $data->no_of_working_days }}" required id="no_of_working_days" placeholder="Enter correct no_of_working_days   "
                    type="text" name="no_of_working_days" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="no_of_paid_leaves">no_of_paid_leaves</label>
                <input  value="{{ $data->no_of_paid_leaves }}" required id="no_of_paid_leaves" placeholder="Enter correct no_of_paid_leaves   "
                    type="text" name="no_of_paid_leaves" class="form-control form-control-sm ">
            </div>
        </div>


        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="shift">shift</label>
                <input  value="{{ $data->shift }}" required id="shift" placeholder="Enter correct shift   " type="text" name="shift"
                    class="form-control form-control-sm ">
            </div>
        </div>
        {{-- <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="working_hours_start">working_hours_start</label>
                <input  value="{{ $data->basic }}" required id="working_hours_start"
                    placeholder="Enter correct working_hours_start   " type="text"
                    name="working_hours_start" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="working_hours_end">working_hours_end</label>
                <input  value="{{ $data->basic }}" required id="working_hours_end"
                    placeholder="Enter correct working_hours_end   " type="text"
                    name="working_hours_end" class="form-control form-control-sm ">
            </div>
        </div> --}}
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="no_of_payable_days">no_of_payable_days</label>
                <input  value="{{ $data->no_of_payable_days }}" required id="no_of_payable_days" placeholder="Enter correct no_of_payable_days   "
                    type="text" name="no_of_payable_days" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="conveyance">conveyance</label>
                <input  value="{{ $data->conveyance }}" required id="conveyance" placeholder="Enter correct conveyance   " type="text"
                    name="conveyance" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="special">special</label>
                <input  value="{{ $data->special }}" required id="special" placeholder="Enter correct special   " type="text" name="special"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="mobile">mobile</label>
                <input  value="{{ $data->mobile }}" required id="mobile" placeholder="Enter correct mobile   " type="text" name="mobile"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="bonus">bonus</label>
                <input  value="{{ $data->bonus }}" required id="bonus" placeholder="Enter correct bonus   " type="text" name="bonus"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="transportation">transportation</label>
                <input  value="{{ $data->transportation }}" required id="transportation" placeholder="Enter correct transportation   " type="text"
                    name="transportation" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="food">food</label>
                <input  value="{{ $data->food }}" required id="food" placeholder="Enter correct food   " type="text" name="food"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="medical">medical</label>
                <input  value="{{ $data->medical }}" required id="medical" placeholder="Enter correct medical   " type="text" name="medical"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="gross_earning">gross_earning</label>
                <input  value="{{ $data->gross_earning }}" required id="gross_earning" placeholder="Enter correct gross_earning   " type="text"
                    name="gross_earning" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="esi_per">esi_per</label>
                <input  value="{{ $data->esi_per }}" required id="esi_per" placeholder="Enter correct esi_per   " type="text" name="esi_per"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="esi_amount">esi_amount</label>
                <input  value="{{ $data->esi_amount }}" required id="esi_amount" placeholder="Enter correct esi_amount   " type="text"
                    name="esi_amount" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="income_tax_deductions">income_tax_deductions</label>
                <input  value="{{ $data->income_tax_deductions }}" required id="income_tax_deductions" placeholder="Enter correct income_tax_deductions   "
                    type="text" name="income_tax_deductions" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="penalty_deductions">penalty_deductions</label>
                <input  value="{{ $data->penalty_deductions }}" required id="penalty_deductions" placeholder="Enter correct penalty_deductions   "
                    type="text" name="penalty_deductions" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="fixed_deductions">fixed_deductions</label>
                <input  value="{{ $data->fixed_deductions }}" required id="fixed_deductions" placeholder="Enter correct fixed_deductions   " type="text"
                    name="fixed_deductions" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="other_deductions">other_deductions</label>
                <input  value="{{ $data->other_deductions }}" required id="other_deductions" placeholder="Enter correct other_deductions   " type="text"
                    name="other_deductions" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="net_take_home">net_take_home</label>
                <input  value="{{ $data->net_take_home }}" required id="net_take_home" placeholder="Enter correct net_take_home   " type="text"
                    name="net_take_home" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="ctc">ctc</label>
                <input  value="{{ $data->ctc }}" required id="ctc" placeholder="Enter correct ctc   " type="text" name="ctc"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="total_employer_contribution">total_employer_contribution</label>
                <input  value="{{ $data->total_employer_contribution }}" required id="total_employer_contribution"
                    placeholder="Enter correct total_employer_contribution   " type="text"
                    name="total_employer_contribution" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label for="total_deduction">total_deduction</label>
                <input  value="{{ $data->total_deduction }}" required id="total_deduction" placeholder="Enter correct total_deduction   " type="text"
                    name="total_deduction" class="form-control form-control-sm ">
            </div>
        </div>


    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-primary">Update
            {{ $page }}</button>
    </div>
</form>
