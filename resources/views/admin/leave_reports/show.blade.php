<div class="row">


    <div class="col-sm-6 mb-2">
        <div class="form-group">
            <label for="employee_name">employee_name</label>
            <input disabled required id="employee_name" placeholder="Enter correct employee_name   "
                value="{{ $data->user->name }}" type="text" name="employee_name" class="form-control form-control-sm ">
        </div>
    </div>

    <div class="col-sm-6 mb-2">
        <div class="form-group">
            <label for="employee_email">employee_email</label>
            <input disabled required id="employee_email" placeholder="Enter correct employee_email   "
                value="{{ $data->user->email }}" type="text" name="employee_email"
                class="form-control form-control-sm ">
        </div>
    </div>



    <div class="col-sm-6 mb-2">
        <div class="form-group">
            <label for="leave_applies_for">leave_applies_for</label>
            <input disabled required id="leave_applies_for" placeholder="Enter correct leave_applies_for   "
                value="{{ $data->leave_applies_for }}" type="text" name="leave_applies_for"
                class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-6 mb-2">
        <div class="form-group">
            <label for="leave_type_id">Leave Types</label>
            <select disabled required id="leave_type_id" placeholder="Enter correct leave_type_id   " type="text"
                name="leave_type_id" class="form-control form-control-sm ">
                <option disabled> -Select Leave Types- </option>
                @foreach ($leave_type as $l_type)
                    <option {{ $l_type->id == $data->leave_type_id ? 'selected' : '' }} value="{{ $l_type->id }}">
                        {{ $l_type->name }}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="col-sm-6 mb-2">
        <div class="form-group">
            <label for="remaining_leave">remaining_leave</label>
            <input disabled required id="remaining_leave" placeholder="Enter correct remaining_leave   "
                value="{{ $data->remaining_leave }}" type="text" name="remaining_leave"
                class="form-control form-control-sm ">
        </div>
    </div>

    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="start_date">start_date</label>
            <input disabled required id="start_date" placeholder="Enter correct start_date   " type="date"
                value="{{ $data->start_date }}" name="start_date" class="form-control form-control-sm ">
        </div>
    </div>
    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label for="end_date">end_date</label>
            <input disabled required id="end_date" placeholder="Enter correct end_date   " type="date"
                value="{{ $data->end_date }}" name="end_date" class="form-control form-control-sm ">
        </div>
    </div>

    <div class="col-sm-4 mb-2">
        <div class="form-group">
            <label>Required Document</label>
            <div class="row">

                @if ($data->doc != '')
                    <iframe class="img-fluid" src="{{ asset('upload/leave_doc/' . $data->doc) }}"
                        frameborder="1"></iframe>
                @endif
            </div>
        </div>
    </div>

    <div class="col-sm-12 mb-2">
        <div class="form-group">
            <label for="Reason">leave_reason</label>
            <input disabled required id="leave_reason" placeholder="Enter correct leave_reason   "
                value="{{ $data->leave_reason }}" type="text" name="leave_reason"
                class="form-control form-control-sm ">
        </div>
    </div>

    <div class="col-sm-12 mb-2">
        <div class="form-group">
            <label for="remark">remark</label>
            <textarea disabled rows="12" required id="remark" placeholder="Enter correct remark   " name="remark"
                class="form-control form-control-sm ">{{ $data->remark }}</textarea>
        </div>
    </div>
</div>
<hr>
