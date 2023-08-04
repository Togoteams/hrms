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
             <form id="form_data" action="{{ route('admin.payroll.reimbursement_type.store') }}">
                        @csrf
                        {{-- <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}"> --}}

                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="type" class="required">Reimbursement Type</label>
                                    <input type="text" name="type" id="type" class="form-control" placeholder="Reimbursement type">
                                </div>
                            </div>
                           
                            {{-- <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="exampleInputName">Status<sup class="text-danger">*</sup></label>
                                    <select name="status" class="form-control" id="exampleInputName">
                                        <option value="">Selected Option</option>
                                        <option value="0">Active</option>
                                        <option value="1">Inactive</option>
                                    </select>
                                </div>
                            </div> --}}
                            <hr>
                            <div class="text-center ">
                                <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Add
                                    {{ $page }}</button>
                            </div>
                        </div>
                       
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

