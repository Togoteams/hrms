<form id="form_edit" action="{{ route('admin.leave_type.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="leave_for">Leave For</label>
                <select required id="leave_for" placeholder="Enter leave_for of leave_type " type="text"
                    name="leave_for" class="form-control form-control-sm ">
                    <option disabled> - Select - </option>
                    <option {{ $data->leave_for == 'local' ? 'selected' : '' }} value="local">Local</option>
                    <option {{ $data->leave_for == 'expatriate' ? 'selected' : '' }} value="expatriate">Expatriate
                    </option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="name">Name</label>
                <input required id="name" placeholder="Enter Name of leave_type " type="text"
                    value="{{ $data->name }}" name="name" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="nature_of_leave">nature_of_leave</label>
                <select required id="nature_of_leave" placeholder="Enter nature_of_leave of leave_type " type="text"
                    name="nature_of_leave" class="form-control form-control-sm ">
                    <option disabled> - Select Nature of Leave - </option>
                    <option {{ $data->nature_of_leave == 'paid' ? 'selected' : '' }} value="paid">Paid</option>
                    <option {{ $data->nature_of_leave == 'unpaid' ? 'selected' : '' }} value="unpaid">Unpaid</option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="no_of_days">no_of_days</label>
                <input required id="no_of_days" placeholder="Enter no_of_days of leave_type "
                    value="{{ $data->no_of_days }}" type="text" name="no_of_days"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description">description</label>
                <textarea required id="description" placeholder="Enter Short Description of leave_type   " type="text"
                    name="description" class="form-control form-control-sm "> {{ $data->description }} </textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
