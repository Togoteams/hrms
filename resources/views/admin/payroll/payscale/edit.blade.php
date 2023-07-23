<form id="form_edit" action="{{ route('admin.payroll.payscale.edit') }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $data[0]->user_id }}" ,>
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

   
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-primary">Update
            {{ $page }}</button>
    </div>
</form>
