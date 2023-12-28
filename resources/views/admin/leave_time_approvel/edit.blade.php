{{-- Model --}}


<form id="form_edit" action="{{ route('admin.leave_time_approved.update', $leave->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="user_id" class="required">Employee</label>
                <select name="user_id" id="user_id" class="form-control form-control-sm">
                    <option value="">- Select -</option>
                    @foreach ($Employees as $employee)
                    <option value="{{ $employee->user_id }}" data-employee-type="{{ $employee->employee_type }}" {{ old('user_id', $leave->user_id) == $employee->user_id ? 'selected' : '' }}>
                        {{ $employee->user->name }} ({{ $employee->ec_number }})
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="leave_type_id" class="required">Leave Type</label>
                <select name="leave_type_id" id="edit_leave_type_id" class="form-control form-control-sm" required>
                    <option value="">- Select -</option>
                    @foreach ($leave_setting as $setting)
                    <option value="{{ $setting->id }}" data-employee-type="{{ $setting->emp_type }}" {{ old('leave_type_id', $leave->leave_type_id) == $setting->id ? 'selected' : '' }}>
                        {{ $setting->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                <label for="start_date">From date</label>
                <input type="date" name="start_date" id="start_date"
                    class="form-control form-control-sm" value="{{$leave->start_date}}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="end_date">To date</label>
                <input type="date" name="end_date"  id="end_date"
                    class="form-control form-control-sm" value="{{$leave->end_date}}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="current_document" class="required">Current Document</label> <br>
                @if (in_array(pathinfo(asset('assets/leave_document/'.$leave->document), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('assets/leave_document/'.$leave->document) }}" alt="image" width="70px" height="70px">
                @elseif (in_array(pathinfo(asset('assets/leave_document/'.$leave->document), PATHINFO_EXTENSION), ['pdf']))
                    <a href="{{ asset('assets/leave_document/'.$leave->document) }}" target="_blank">
                        <img src="{{ asset('asset/img/pdf.png') }}" alt="{{$leave->document}}" width="40px" height="27px">{{$leave->document}}
                    </a>
                @endif
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="document">Replace Document</label>
                <input id="document" type="file" name="document" class="form-control form-control-sm">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="reason">Reason</label>
                <input type="text" name="reason" id="reason" class="form-control form-control-sm" placeholder="Enter Reason..."
                value="{{ $leave->reason }}">
            </div>
        </div>

        <div class="mb-12 col-sm-12">
            <div class="form-group">
                <label for="description" class="required">Description</label>
                <textarea name="description" id="description" class="form-control form-control-sm" placeholder="Enter Description...">{{ $leave->description }}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
