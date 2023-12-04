<form id="form_edit" action="{{ route('admin.payroll.payscale.update',$data->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ $data->user_id }}">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">


    {!! $html !!}
</form>
