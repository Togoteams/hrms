<form id="form_edit" action="{{ route('admin.payroll.salary-increment-setting.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label class="required" for="increment_percentage">Salary Increment %</label>
                <input required id="increment_percentage" placeholder="Enter Increment Percentage of Salary " type="text"
                    name="increment_percentage" class="form-control form-control-sm" value="{{$data->increment_percentage}}">
            </div>
        </div>
     
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label class="required" for="employment_type">Employment Type</label>
                <select required id="employment_type" name="employment_type" value="local"
                    class="form-control form-control-sm">
                    <option  disabled=""> - Select employment type- </option>
                    <option {{ $data->employment_type=="both"? "selected" :""}} value="both">All</option>
                    <option {{ $data->employment_type=="local"? "selected" :""}} value="local">Local</option>
                    <option {{ $data->employment_type=="expatriate"? "selected" :""}} value="expatriate">Expatriate</option>
                    <option {{ $data->employment_type=="local-contractual"? "selected" :""}} value="local-contractual">Local-Contractual </option>
                </select>
            </div>
        </div>
       
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="effective_from">Effective From</label>
                <input required id="effective_from" placeholder="Enter Effective From  of salary " type="date"
                    name="effective_from" class="form-control form-control-sm " value="{{$data->effective_from}}">
            </div>
        </div>
       
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="effective_to">Effective To</label>
                <input required id="effective_to" placeholder="Enter Effective To of salary " type="date"
                    name="effective_to" class="form-control form-control-sm " value="{{$data->effective_to}}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="financial_year">Financial year</label>
                <select required id="financial_year" name="financial_year" value="local"
                    class="form-control form-control-sm">
                    <option selected disabled=""> - Select financial year- </option>
                    <option {{ $data->financial_year=="2021"? "selected" :""}} value="2021">2021</option>
                    <option {{ $data->financial_year=="2022"? "selected" :""}} value="2022">2022</option>
                    <option {{ $data->financial_year=="2023"? "selected" :""}} value="2023">2023</option>
                    <option {{ $data->financial_year=="2024"? "selected" :""}} value="2024">2024</option>
                    <option {{ $data->financial_year=="2025"? "selected" :""}} value="2025">2025</option>
                </select>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>