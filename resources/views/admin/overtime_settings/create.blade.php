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
                <form id="form_data" class="formsubmit" action="{{ route('admin.overtime-settings.store') }}">
                    @csrf
                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                    <div class="row">
                        <div class="mb-2 col-sm-6">
                            <div class="form-group">
                                <label for="user_id" class="required">Employee Name</label>
                                <select name="user_id" class="select-search employees" id="user_id" required
                                    placeholder="Employee Name">
                                    <option value="">Select Option</option>
                                    @foreach ($all_users as $user)
                                        <option value="{{ $user->user_id }}">
                                            {{ $user->user->name }}({{ $user->ec_number }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 col-sm-6">
                            <div class="form-group">
                                <label for="date" class="required">Date</label>
                                <input type="date" name="date" id="date"  class="form-control"
                                    placeholder="Enter date of overtime">
                            </div>
                        </div>
                        <div class="mb-2 col-sm-6">
                            <div class="form-group">
                                <label for="working_hours" class="required">Working Hours</label>
                                <input type="number" name="working_hours"  id="working_hours"
                                    class="form-control" placeholder="Enter working hours" min="0" step="0.001">
                            </div>
                        </div>
                        {{-- <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="working_min" class="required">Working Minute</label>
                                    <input type="number"   name="working_min" id="working_min" class="form-control" placeholder="Enter working min of overtime"  min="0" max="59">
                                </div>
                            </div> --}}
                        <div class="mb-2 col-sm-6">
                            <div class="form-group">
                                <label for="overtime_type" class="required">Overtime Type</label>
                                <select name="overtime_type" class=" form-control"  id="overtime_type"
                                    placeholder="Employee overtime type">
                                    <option value="">Select Option</option>
                                    <option value="holiday">Holiday</option>
                                    <option value="over time">Over time</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center ">
                            <button  type="sumit" class="btn btn-white">Add
                                {{ $page }}</button>
                        </div>
                    </div>

            </div>

        </div>
    </div>
</div>
<script>
    function chagne_type(data) {
        if (data == "flat") {
            document.getElementById('type_id').innerText = data + " amount"
        } else {
            document.getElementById('type_id').innerText = data

        }
    }
</script>
