<form id="form_edit" action="{{ route('admin.payroll.salary.update',$data->id) }}">
    @csrf
    @method('PUT')
    <input type="hidden" name="user_id" value="{{ $data->user_id }}">
    <input type="hidden" name="pay_for_month_year" value="{{ $salary_month }}"> 
    <input type="hidden" name="payroll_payscales_id" value="{{ $data->id }}"> 
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">


    {!! $html !!}
</form>
