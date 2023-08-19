   
   
<form id="form_edit" action="{{ route('admin.employee-transfer.update',$item->id) }}">
    @csrf
   <input type="hidden" name="_method" value="PUT">
       <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">
       <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="emp_id" class="required">Employee Name</label>
                <select name="emp_id" class="form-control" id="emp_id" placeholder="Employee Name">
                    <option value="">Select Option</option>
                    @foreach ($all_users as $user)
                    <option value="{{ $user->user->id }}" @if ($item->emp_id == $user->user->id) selected @endif>
                        {{ $user->user->name }}
                    </option>
                @endforeach
                </select>
            </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="date" class="required">Date</label>
                    <input type="date" name="date" id="date" class="form-control" placeholder="Enter date of overtime" value="{{$item->date}}">
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="working_hours" class="required">Working Hours</label>
                    <input type="number" name="working_hours" id="working_hours" class="form-control" placeholder="Enter working hours of overtime" min="0" value="{{$item->working_hours}}">
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="working_min" class="required">Working Min</label>
                    <input type="number"   name="working_min" id="working_min" class="form-control" placeholder="Enter working min of overtime"  min="0" max="59" value="{{$item->working_min}}">
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="overtime_type" class="required">Overtime Type</label>
                    <select name="overtime_type" class=" form-control" id="overtime_type" placeholder="Employee overtime type">
                        <option value="">Select Option</option>
                        <option value="holiday" @if(old('overtime_type', $item->overtime_type) === 'holiday') selected @endif>Holiday</option>
                        <option value="extra time" @if(old('overtime_type', $item->overtime_type) === 'extra time') selected @endif>Extra time</option>


                    </select>
                </div>
            </div>
        {{-- <span id="edit">
        </span> --}}

        <div class="text-center ">
            <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
                {{ $page }}</button>
        </div>
    </div>
    <hr>
       
</form>


