<form id="form_edit" action="{{ route('admin.payroll.tax-slab-setting.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label class="required" for="from">from</label>
                <input required id="from" placeholder="Enter from of Tax " type="text"
                   value="{{ $data->from}}" name="from" class="form-control form-control-sm ">
            </div>
        </div>
     
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label class="required" for="to">to</label>
                <input required id="to" placeholder="Enter to of Tax " type="text"
                value="{{ $data->to}}"   name="to" class="form-control form-control-sm ">
            </div>
        </div>
       
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label class="required" for="tax">tax</label>
                <input required id="tax" placeholder="Enter tax of Tax " type="text"
                value="{{ $data->tax}}"  name="tax" class="form-control form-control-sm ">
            </div>
        </div>
       
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label class="required" for="description">description</label>
                <textarea required id="description" placeholder="Enter Short Description of Tax   " type="text" name="description"
                    class="form-control form-control-sm ">{{ $data->description}}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
