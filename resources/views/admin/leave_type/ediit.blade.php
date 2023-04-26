<form id="form_edit" action="{{ route('admin.leave_type.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="leave_for">Leave For </label>
                <select required id="leave_for" placeholder="Enter leave_for of leave_type " type="text"
                    name="leave_for" class="form-control form-control-sm ">
                    <option  disabled> - Select - </option>
                    <option {{ $data->leave_for=="local"?'selected':''}} value="local">Local</option>
                    <option {{ $data->leave_for=="expatriate"?'selected':''}} value="expatriate">Expatriate</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="name">Name </label>
                <input required id="name" placeholder="Enter Name of leave_type " type="text"
                    value="{{ $data->name }}" name="name" class="form-control form-control-sm ">
            </div>
        </div>


        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="description">description </label>
                <textarea required id="description" placeholder="Enter Short Description of leave_type   " type="text"
                    name="description" class="form-control form-control-sm "> {{ $data->description }} </textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-primary">Update
            {{ $page }}</button>
    </div>
</form>
