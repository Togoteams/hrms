<form id="form_edit" action="{{ route('admin.leave_apply.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="leave_type_id">Leave Types</label>
                <select required id="leave_type_id" placeholder="Enter correct leave_type_id   " type="text"
                    name="leave_type_id" class="form-control form-control-sm ">
                    <option disabled> -Select Leave Types- </option>
                    @foreach ($leave_type as $l_type)
                        <option {{ $l_type->id == $data->leave_type_id ? 'selected' : '' }} value="{{ $l_type->id }}">
                            {{ $l_type->name }}</option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label for="start_date1">start_date</label>
                <input required id="start_date_edit" placeholder="Enter correct start_date   " type="date"
                    value="{{ $data->start_date }}" name="start_date" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label for="end_date1">end_date</label>
                <input required id="end_date_edit" placeholder="Enter correct end_date   " type="date"
                    value="{{ $data->end_date }}" name="end_date" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label for="leave_applies_for">leave_applies_for</label>
                <input required readonly id="leave_applies_for_edit" placeholder="Enter correct leave_applies_for"
                    onchange="change_leave(this)" value="{{ $data->leave_applies_for }}" type="text"
                    name="leave_applies_for" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label for="doc">Required Document</label>
                <div class="row">
                    <div class="col-6">
                        <input accept="application/pdf" id="doc" placeholder="Enter correct Document"
                            type="file" name="doc1" class="form-control form-control-sm ">
                    </div>

                    @if ($data->doc != '')
                        <a class="col-6" href="{{ asset('upload/leave_doc/' . $data->doc) }}"> <iframe
                                class="img-fluid" src="{{ asset('upload/leave_doc/' . $data->doc) }}"
                                frameborder="0"></iframe> </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="Reason">leave_reason</label>
                <input required id="leave_reason" placeholder="Enter correct leave_reason   "
                    value="{{ $data->leave_reason }}" type="text" name="leave_reason"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="remark">remark</label>
                <textarea rows="3" required id="remark" placeholder="Enter correct remark   " name="remark"
                    class="form-control form-control-sm ">{{ $data->remark }}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button type="button" onclick="ajaxCall('form_edit')" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
@push('custom-scripts')
    <script type="text/javascript">
       

        function change_leave(e) {
            var text = e.options[e.selectedIndex].text;
            if (text == "SICK LEAVE") {
                document.getElementById('doc').setAttribute("required", "");

            } else {
                document.getElementById('doc').removeAttribute("required", "");

            }
            selectDrop('form_data', '{{ route('admin.leave_apply.get_balance_leave') }}', 'balance_leave1')
        }

      
    </script>
@endpush
