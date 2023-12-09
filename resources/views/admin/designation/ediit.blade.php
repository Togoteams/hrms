<form id="form_edit" action="{{ route('admin.designation.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="name">Name</label>
                <input required id="name" placeholder="Enter Name of Designation " type="text"
                    value="{{ $data->name }}" name="name" class="form-control form-control-sm ">
            </div>
        </div>


        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description">Designation</label>
                <textarea required id="description" placeholder="Enter Short Description of Designation   " type="text"
                    name="description" class="form-control form-control-sm "> {{ $data->description }} </textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
