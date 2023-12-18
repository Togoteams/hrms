<form id="form_edit" action="{{ route('admin.leave_encashment.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="balance_leave1">Total Balance Leave</label>
                <input required id="balance_leave1" readonly
                    placeholder="Enter correct balance_leave" type="number" name="balance_leave"
                    class="form-control form-control-sm " value="{{ $data->balance_leave }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="available_leave_for_encashment">Available Leave For Encashment</label>
                <input required id="available_leave_for_encashment" readonly
                    placeholder="Enter correct available_leave_for_encashment" type="number"
                    name="available_leave_for_encashment" value="{{ $data->available_leave_for_encashment }}" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="request_leave_for_encashement">Request Leave for Encashement</label>
                <input required id="request_leave_for_encashement"
                    placeholder="Enter correct request_leave_for_encashement" type="number"
                    name="request_leave_for_encashement" value="{{ $data->request_leave_for_encashement }}" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description">description</label>
                <textarea rows="3" required id="description" placeholder="Enter correct description   " name="description"
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
