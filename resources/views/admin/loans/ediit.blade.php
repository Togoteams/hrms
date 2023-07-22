<form id="form_edit" action="{{ route('admin.loans.update', $data->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="name">Name</label>
                <input required id="name" placeholder="Enter Name of leave_type " type="text"
                    value="{{ $data->name }}" name="name" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="start_amount ">start_amount</label>
                <input required id="start_amount " placeholder="Enter start_amount  of Loans  " type="text"
                    value="{{ $data->start_amount }}" name="start_amount" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="end_amount ">end_amount</label>
                <input required id="end_amount " placeholder="Enter end_amount  of Loans  " type="text"
                    value="{{ $data->end_amount }}" name="end_amount" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="late_fine_amount ">late_fine_amount</label>
                <input required id="late_fine_amount " placeholder="Enter late_fine_amount  of Loans  " type="text"
                    value="{{ $data->late_fine_amount }}" name="late_fine_amount" class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="late_fine_amount_type ">late_fine_amount_type</label>
                <input required id="late_fine_amount_type " placeholder="Enter late_fine_amount_type  of Loans  "
                    type="text" value="{{ $data->late_fine_amount_type }}" name="late_fine_amount_type"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="no_min_installment ">no_min_installment</label>
                <input required id="no_min_installment " placeholder="Enter no_min_installment  of Loans  "
                    type="text" value="{{ $data->no_min_installment }}" name="no_min_installment"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="no_max_installment ">no_max_installment</label>
                <input required id="no_max_installment " placeholder="Enter no_max_installment  of Loans  "
                    type="text" value="{{ $data->no_max_installment }}" name="no_max_installment"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="max_installment_amount ">max_installment_amount</label>
                <input required id="max_installment_amount " placeholder="Enter max_installment_amount  of Loans  "
                    type="text" value="{{ $data->max_installment_amount }}" name="max_installment_amount"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="min_installment_amount ">min_installment_amount</label>
                <input required id="min_installment_amount " placeholder="Enter min_installment_amount  of Loans  "
                    type="text" value="{{ $data->min_installment_amount }}" name="min_installment_amount"
                    class="form-control form-control-sm ">
            </div>
        </div>
        <div class="col-sm-6 mb-2">
            <div class="form-group">
                <label for="rate_of_interest ">rate_of_interest</label>
                <input required id="rate_of_interest " placeholder="Enter rate_of_interest  of Loans  " type="text"
                    value="{{ $data->rate_of_interest }}" name="rate_of_interest"
                    class="form-control form-control-sm ">
            </div>
        </div>

        <div class="col-sm-12 mb-2">
            <div class="form-group">
                <label for="description">description</label>
                <textarea required id="description" placeholder="Enter Short Description of leave_type   " type="text"
                    value="{{ $data->name }}" name="description" class="form-control form-control-sm "> {{ $data->description }} </textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
