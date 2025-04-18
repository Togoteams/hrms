{{-- Model --}}


<form id="form_edit" action="{{ route('admin.country.update', $country->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="mb-6 col-sm-6">
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    placeholder="Enter medical card name" value="{{ $country->name }}">
            </div>
        </div>
        <div class="mb-6 col-sm-6">
            <div class="form-group">
                <label for="std_code" class="required">Std Code</label>
                <input type="text" required name="std_code" id="std_code" class="form-control"
                placeholder="Enter Std Code "  value="{{ $country->std_code }}">
            </div>
        </div>

        <div class="mb-12 col-sm-12">
            <div class="form-group">
                <label for="description" class="required">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description...">{{ $country->description }}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
