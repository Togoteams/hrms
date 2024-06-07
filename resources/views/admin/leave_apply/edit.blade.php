<form id="form_edit" action="{{ route('admin.leave_apply.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">
    <input type="hidden" id="edit_user_id" name="user_id" value="{{ $data->user_id }}">
    <input type="hidden" id="employment_type" value="{{ $data->user->employee->employment_type }}">

    <div class="row">
        @if(!empty($data->approval_authority))
        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label for="Reason">Approval Authority</label>
                <select id="approval_authority" placeholder="Select Authority"
                    name="approval_authority" class="form-control form-control-sm approval_authority">
                    <option selected disabled> - Select - </option>
                    @foreach ($approvalAuthority as $key => $value)
                        <option value="{{ $value->user_id }}" @if($data->approval_authority==$value->user_id) {{'selected'}} @endif>{{ $value->user->name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="Reason">leave_reason</label>
                <input required id="leave_reason" placeholder="Enter correct leave_reason   "
                    value="{{ $data->leave_reason }}" type="text" name="leave_reason"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="remark">Describe the Leave reason (optional)</label>
                <textarea rows="3"  id="remark" placeholder="Enter correct remark   " name="remark"
                    class="form-control form-control-sm ">{{ $data->remark }}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
