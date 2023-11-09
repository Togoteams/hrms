<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="user_id">Employee :- </label>
            <label for="">{{ $data->user->name }} ({{ $data->user->employee->ec_number }})
            </label>

        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="leave_type_id" class="required">Leave Type</label>
            <label for="leave_type_id" class="required">Leave Type</label>
            <select name="leave_type_id" id="edit_leave_type_id" class="form-control" required>
                <option value="">- Select -</option>
                @foreach ($leave_setting as $setting)
                <option value="{{ $setting->id }}" data-employee-type="{{ $setting->emp_type }}" {{ old('leave_type_id', $data->leave_type_id) == $setting->id ? 'selected' : '' }}>
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
                class="form-control" value="{{$data->start_date}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="end_date">To date</label>
            <input type="date" name="end_date"  id="end_date"
                class="form-control" value="{{$data->end_date}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="approved_at">Approved date</label>
            <input type="date" name="approved_at"  id="approved_at"
                class="form-control" value="{{ $data->approved_at}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="rejected_at">Rejected date</label>
            <input type="date" name="rejected_at"  id="rejected_at"
                class="form-control" value="{{$data->rejected_at}}">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" name="status"  id="status"
                class="form-control" value="{{$data->status}}">
        </div>
    </div>
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="document">Required Document</label>
            <div class="row">

                @if ($data->document != '')
                    <iframe class="img-fluid" src="{{ asset('assets/leave_document/' . $data->document) }}"
                        frameborder="1"></iframe>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="document">Document Download</label>
            <br>
            @if($data)
            <a href="{{ asset('assets/leave_document/') . '/' . $data->document }}" download>Download</a>
            @else
                No Document Available
            @endif
         </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="reason">Reason</label>
            <input type="text" name="reason" id="reason" class="form-control" placeholder="Enter Reason..."
            value="{{ $data->reason }}">
        </div>
    </div>

    <div class="mb-12 col-sm-12">
        <div class="form-group">
            <label for="description" class="required">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter Description...">{{ $data->description }}</textarea>
        </div>
    </div>

</div>
