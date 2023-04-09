<form id="form_edit" action="{{ route('admin.membership.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="name">Name </label>
                <input required id="name" placeholder="Enter Name of Designation " value="{{ $data->name}}" type="text" name="name"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="amount">amount </label>
                <input required id="amount" placeholder="Enter amount of Designation " value="{{ $data->amount}}" type="text" name="amount"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="type">type </label>
                <input required id="type" placeholder="Enter type of Designation " value="{{ $data->type}}" type="text" name="type"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="membership_code">membership code </label>
                <input required id="membership_code" placeholder="Enter membership_code of Designation " value="{{ $data->membership_code}}" type="text"
                    name="membership_code" class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="description">Description </label>
                <textarea required id="description" placeholder="Enter Short Description of Designation   " type="text"
                    name="description" class="form-control form-control-sm ">{{ $data->description}}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-primary">Update
            {{ $page }}</button>
    </div>
</form>
