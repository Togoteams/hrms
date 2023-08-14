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
                                    <label class="required" for="local_tax_per">Local Tax %</label>
                                    <input required id="local_tax_per" placeholder="Enter Local tax of Tax " type="number"
                                        name="local_tax_per" value="{{ $data->local_tax_per}}"  class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="additional_local_amount">Additional Local Amount</label>
                                    <input required id="additional_local_amount" placeholder="Enter Local tax of Tax " type="number"
                                        name="additional_local_amount" value="{{ $data->additional_local_amount}}"  class="form-control form-control-sm ">
                                </div>
                            </div>
                            
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="ibo_tax_per">IBO Tax %</label>
                                    <input required id="ibo_tax_per" placeholder="Enter IBO tax of Tax " type="number"
                                        name="ibo_tax_per" value="{{ $data->ibo_tax_per}}"  class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="additional_ibo_amount">Additional IBO Amount</label>
                                    <input required id="additional_ibo_amount" placeholder="Enter Additional IBO Amount " type="number"
                                        name="additional_ibo_amount" value="{{ $data->additional_ibo_amount}}"  class="form-control form-control-sm ">
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
