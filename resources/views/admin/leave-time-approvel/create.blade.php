<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content ">
            <div class="modal-header ">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form  class="formsubmit fileupload" action="{{ route('admin.leave-time-approved.store') }}" id="leave_store">
                    @csrf
                    {{-- <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}"> --}}
                    <input type="hidden" name="request_date" readonly id="request_date"
                    class="form-control" value="{{ old('request_date', now()->format('Y-m-d')) }}">

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="user_id" class="required">Employee</label>
                                <select name="user_id" id="user_id" class="form-control form-control-sm">
                                    <option value="">- Select -</option>
                                    @foreach ($Employees as $employee)
                                        <option value="{{ $employee->user_id }}"
                                            data-employee-type="{{ $employee->employment_type }}">
                                            {{ $employee->user->name }}({{ $employee->ec_number }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="leave_type_id" class="required">Leave Type</label>
                                <select name="leave_type_id" id="leave_type_id" class="form-control form-control-sm" >
                                    <option value="">- Select -</option>
                                    @foreach ($leave_setting as $setting)
                                        <option value="{{ $setting->id }}"
                                            data-employee-type="{{ $setting->emp_type }}">
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
                                    class="form-control form-control-sm" value="">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="end_date">To date</label>
                                <input type="date" name="end_date"  id="end_date"
                                    class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="document">Document</label>
                                <input type="file" accept="application/pdf" name="document"  id="document"
                                    class="form-control form-control-sm" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reason">Reason</label>
                                <input type="text" name="reason" id="reason" class="form-control form-control-sm" placeholder="Enter Reason...">
                            </div>
                        </div>
                        <div class="mb-12 col-sm-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control form-control-sm" placeholder="Enter Description..."></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="text-center ">
                            <button  type="submit" class="btn btn-white">Add
                                {{ $page }}</button>
                        </div>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
