    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.payroll.tax-slab-setting.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label class="required" for="from">from</label>
                                    <input required id="from" placeholder="Enter from of Tax " type="text"
                                        name="from" class="form-control form-control-sm ">
                                </div>
                            </div>
                         
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label class="required" for="to">to</label>
                                    <input required id="to" placeholder="Enter to of Tax " type="text"
                                        name="to" class="form-control form-control-sm ">
                                </div>
                            </div>
                           
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="local_tax_per">Local Tax %</label>
                                    <input required id="local_tax_per" placeholder="Enter Local tax of Tax " type="number"
                                        name="local_tax_per" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="additional_local_amount">Additional Local Amount</label>
                                    <input required id="additional_local_amount" placeholder="Enter Local tax of Tax " type="number"
                                        name="additional_local_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                            
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="ibo_tax_per">IBO Tax %</label>
                                    <input required id="ibo_tax_per" placeholder="Enter IBO tax of Tax " type="number"
                                        name="ibo_tax_per" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label class="required" for="additional_ibo_amount">Additional IBO Amount</label>
                                    <input required id="additional_ibo_amount" placeholder="Enter Additional IBO Amount " type="number"
                                        name="additional_ibo_amount" class="form-control form-control-sm ">
                                </div>
                            </div>
                           
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label  class="required"for="description">description</label>
                                    <textarea required id="description" placeholder="Enter Short Description of Tax   " type="text" name="description"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Add
                                {{ $page }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        function chagne_type(data) {
            if (data == "flat") {
                document.getElementById('type_id').innerText = data + " amount"
            } else {
                document.getElementById('type_id').innerText = data

            }
        }
    </script>
