<form id="form_edit" action="{{ route('admin.tax.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="name">name </label>
                <input required value="{{ $data->name }}" id="name" placeholder="Enter Name of Tax "
                    type="text" name="name" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="type">type </label>
                <select onchange="chagne_type(this.value)" required id="type" placeholder="Enter type of Tax "
                    type="text" name="type" class="form-control form-control-sm ">
                    <option disabled> - Select Type - </option>
                    <option {{ $data->type == 'percentage' ? 'selected' : '' }} value="percentage"> Percentage</option>
                    <option {{ $data->type == 'flat' ? 'selected' : '' }} value="flat">Flat</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label id="type_id" for="value">value </label>
                <input value="{{ $data->value}}" required id="value" placeholder="Enter value " type="text" name="value"
                    class="form-control form-control-sm ">
            </div>
        </div>


        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="description">Designation </label>
                <textarea required id="description" placeholder="Enter Short Description of Designation   " type="text"
                    name="description" class="form-control form-control-sm "> {{ $data->description }} </textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-primary">Update
            {{ $page }}</button>
    </div>
</form>
