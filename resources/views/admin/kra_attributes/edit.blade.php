<form id="form_edit" action="{{ route('admin.kra-attributes.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input value="{{ $data->name }}" required id="name" placeholder="Enter Name of Kra Attributes "
                    type="text" name="name" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="max_marks">max_marks</label>
                <input value="{{ $data->max_marks }}" required id="max_marks"
                    placeholder="Enter max_marks of Kra Attributes " type="text" name="max_marks"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="min_marks">min_marks</label>
                <input value="{{ $data->min_marks }}" required id="min_marks"
                    placeholder="Enter min_marks of Kra Attributes " type="text" name="min_marks"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="status">status</label>
                <select required id="status" name="status" class="form-control form-control-sm ">
                    <option {{ $data->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                    <option {{ $data->status == 'inactive' ? 'selected' : '' }} value="inactive">In Active</option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea required id="description" placeholder="Enter Short Description of Kra Attributes   " type="text"
                    name="description" class="form-control form-control-sm ">{{$data->description}}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
