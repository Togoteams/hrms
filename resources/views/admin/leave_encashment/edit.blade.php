<form id="form_edit" action="{{ route('admin.leave_encashment.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">




        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="no_of_days">no_of_days.. </label>
                <input required id="no_of_days" placeholder="Enter correct no_of_days..   " type="text"
                    value="{{ $data->no_of_days }}" name="no_of_days" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="description">description </label>
                <textarea rows="12" required id="description" placeholder="Enter correct description   " name="description"
                    class="form-control form-control-sm ">{{ $data->description}}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-primary">Update
            {{ $page }}</button>
    </div>
</form>
