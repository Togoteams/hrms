<form id="form_edit" action="{{ route('admin.leave_apply.status', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">


        <div class="table-responsive">
            Total Employee on the leave - <strong class="text-bob">{{ $leave_emp_data->count('*') }}</strong> between
            <span class="text-bob">{{ date('d-M-Y', strtotime($data->start_date)) }}</span> to <span
                class="text-bob">{{ date('d-M-Y', strtotime($data->end_date)) }}</span>
            @if ($leave_emp_data->count('*') > 0)
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name </th>
                            <th>email</th>
                            <th>from</th>
                            <th>to</th>
                            <th>Days</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leave_emp_data as $leave_data)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $leave_data->user->name }}</td>
                                <td>{{ $leave_data->user->email }}</td>
                                <td>{{ date('d-M-Y', strtotime($leave_data->start_date)) }}</td>
                                <td>{{ date('d-M-Y', strtotime($leave_data->end_date)) }}</td>
                                <td>{{ get_day($leave_data->start_date, $leave_data->end_date) + 1 }}</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @endif
        </div>


        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="remaining_leave"> Balance Leave</label>
                <input rows="12" required id="remaining_leave" placeholder="Enter correct remaining_leave   "
                    name="remaining_leave" type="text" readonly value="{{ $remaining_leave }}"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="remaining_leave"> Applied Leave</label>
                <input rows="12" required id="applied_leave" placeholder="Enter correct remaining_leave   "
                    disabled type="text" readonly value="{{ get_day($data->start_date, $data->end_date) + 1 }}"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="status">Leave Status</label>
                <input type="hidden" name="leave_type_id" value="{{ $data->leave_type_id }}">

                <select required id="status" placeholder="Enter correct status   " type="text" name="status"
                    class="form-control form-control-sm ">
                    <option disabled> -Select Leave Types- </option>
                    <option {{ $data->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                    <option {{ $data->status == 'approved' ? 'selected' : '' }} value="approved">Approved</option>
                    <option {{ $data->status == 'reject' ? 'selected' : '' }} value="reject">Reject</option>
                </select>

            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="status_remarks"> Status remark</label>
                <textarea rows="12" required id="status_remarks" placeholder="Enter correct status_remarks   "
                    name="status_remarks" class="form-control form-control-sm ">{{ $data->status_remarks }}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-primary">Change Status
            {{ $page }}</button>
    </div>
</form>
