<form id="form_edit" action="{{ route('admin.payroll.head.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="row">

        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label class="required" for="employment_type">employment type</label>
                <select required id="employment_type" name="employment_type" value="local"
                    class="form-control form-control-sm">
                    <option  disabled=""> - Select employment type- </option>
                    <option {{ $data->employment_type=="local"? "selected" :""}} value="local">Local</option>
                    <option {{ $data->employment_type=="expatriate"? "selected" :""}} value="expatriate">Expatriate</option>
                    <option {{ $data->employment_type=="local-contractual"? "selected" :""}} value="local-contractual">Local-Contractual </option>
                </select>
            </div>
        </div>

        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label class="required" for="for">For</label>
                <select required id="for" name="for" class="form-control form-control-sm">
                    <option  disabled=""> - Select employment type- </option>
                    <option {{ $data->for=="payscale"? "selected" :""}}  value="payscale">Payscale</option>
                    <option {{ $data->for=="salary"? "selected" :""}}  value="salary">Salary</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input required id="name" placeholder="Enter Name of {{ $page }} " type="text"
                  value="{{ $data->name}}"  name="name" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label class="required" for="placeholder">Placeholder</label>
                <input required id="placeholder" placeholder="Enter placeholder of {{ $page }} " type="text"
                value="{{ $data->placeholder}}"    name="placeholder" class="form-control form-control-sm ">
            </div>
        </div>


        <div class="col-sm-8 mb-2">
            <div class="form-group">
                <label class="optional" for="slug">Slug</label>
                <input id="slug" placeholder="Enter slug of {{ $page }} " type="text" name="slug"
                value="{{ $data->slug}}"  class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label class="required" for="is_dropdown">Is DropDown</label>
                <select required id="is_dropdown" name="is_dropdown" class="form-control form-control-sm">
                    <option {{ $data->is_dropdown=="no"? "selected" :""}} value="no">no</option>
                    <option {{ $data->is_dropdown=="yes"? "selected" :""}} value="yes">yes</option>
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
