<form id="form_edit" action="{{ route('admin.leave_encashment.status', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="status">Leave Status</label>
                <select required id="status" placeholder="Enter correct status   " type="text" name="status"
                    class="form-control form-control-sm ">
                    <option disabled> -Select Leave Types- </option>
                    <option {{ $data->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                    <option {{ $data->status == 'approved' ? 'selected' : '' }} value="approved">Approved</option>
                    <option {{ $data->status == 'reject' ? 'selected' : '' }} value="reject">Reject</option>
                </select>

            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="status_remarks"> Status remark</label>
                <textarea rows="12" required id="status_remarks" placeholder="Enter correct status_remarks   "
                    name="status_remarks" class="form-control form-control-sm ">{{ $data->status_remarks }}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-primary">Change Status
            {{ $page }}</button>
    </div>
</form>
