<div class="row">
    <div class="mb-2 col-sm-6">
        <div class="form-group">
            <label for="leave_type_id">Leave Types :- </label>
            <label for="leave_type_id"> {{ $data->leave_type->name }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="start_date">start_date</label>
            <label for="start_date">{{ date('d-m-Y', strtotime($data->start_date)) }}</label>
        </div>
    </div>
    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="end_date">end_date</label>
            <label for="end_date">{{ date('d-m-Y', strtotime($data->end_date)) }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-4">
        <div class="form-group">
            <label for="doc">Required Document</label>
            <label>

                @if ($data->doc != '')
                    <iframe class="img-fluid" src="{{ asset('upload/leave_doc/' . $data->doc) }}"
                        frameborder="1"></iframe>
                @endif
            </label>
        </div>
    </div>

    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="Reason">leave Reason :- </label>
            <label for="Reason">{{ $data->leave_reason }}</label>
        </div>
    </div>

    <div class="mb-2 col-sm-12">
        <div class="form-group">
            <label for="remark">remark</label>
            <label for="remark">{{ $data->remark }}</label>
        </div>
    </div>
</div>
<hr>
