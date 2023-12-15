<form id="form_edit" action="{{ route('admin.branch.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="name">Name</label>
                <input required id="name" placeholder="Enter Name of Designation " type="text" name="name"
                    class="form-control form-control-" value="{{ $data->name }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="code">code</label>
                <input required id="code" placeholder="Enter Code of Branch " type="text" name="code"
                    class="form-control form-control-" value="{{ $data->code }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="is_main_branch">Is Main branch ?</label>
                <select required id="is_main_branch" name="is_main_branch" class="form-control form-control-sm">
                    <option value="">--select--</option>
                    <option value="1" @if($data->is_main_branch==1) selected @endif>Yes</option>
                    <option value="0" @if($data->is_main_branch==0) selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="city">city</label>
                <input required id="city" placeholder="Enter City of Branch " type="text" name="city"
                    class="form-control form-control-" value="{{ $data->city }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="state">state</label>
                <input required id="state" placeholder="Enter State of Branch " type="text" name="state"
                    class="form-control form-control-" value="{{ $data->state }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="country">Country</label>
                <input required id="country" placeholder="Enter Country of Branch " type="text" name="country"
                    class="form-control form-control-" value="{{ $data->country }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="landmark">landmark</label>
                <input required id="landmark" placeholder="Enter Landmark of Branch " type="text" name="landmark"
                    class="form-control form-control-" value="{{ $data->landmark }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="status">status</label>
                <select required id="status" name="status" class="form-control form-control-"
                    value="{{ $data->status }}">
                    <option value="active">Active</option>
                    <option value="inactive">InActive</option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="address">Address</label>
                <textarea required id="address" placeholder="Enter Short Address of Branch   " type="text" name="address"
                    class="form-control form-control-">{{ $data->name }}</textarea>
            </div>
        </div>
        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea required id="description" placeholder="Enter Short Description of Designation   " type="text"
                    name="description" class="form-control form-control-" value="{{ $data->name }}">{{ $data->description }}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
