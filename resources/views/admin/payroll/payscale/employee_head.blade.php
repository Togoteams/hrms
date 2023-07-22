<div class="row">
    @foreach ($emp_head as $head)
        <div class="col-sm-4 mb-2">
            <div class="form-group">
                <label class="required" for="{{ $head->name }}">{{ $head->name }}</label>
                <input required id="{{ $head->name }}" placeholder="{{ $head->placeholder ?? 'Enter'. $head->name . 'of' . $page . ''}}"
                    type="text" name="{{ strtolower($head->name) }}" class="form-control form-control-sm ">
            </div>
        </div>
    @endforeach
</div>

<div class="text-center ">
    <button onclick="ajaxCall('form_data','','POST')" type="button" class="btn btn-white">Update
        {{ $page }}</button>
</div>
