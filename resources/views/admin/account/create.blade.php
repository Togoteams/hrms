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
             <form id="form_data" action="{{ route('admin.account.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="account_number" class="required">Account Number</label>
                                    <input type="text" required name="account_number" id="account_number" class="form-control" placeholder="Enter Account Number">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="name" class="required">Account Name</label>
                                    <input type="text" required name="name" id="name" class="form-control" placeholder="Enter Account Name">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="opening_amount" class="required">Opening Amount</label>
                                    <input type="number" required name="opening_amount" id="opening_amount" class="form-control" placeholder="Enter Opening Amount">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="closing_amount" class="required">Closing Amount</label>
                                    <input type="number" required name="closing_amount" id="closing_amount" class="form-control" placeholder="Enter Closing Amount">
                                </div>
                            </div>
                           
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="account_type">Account Type</label>
                                    <select name="account_type" class="form-control" id="account_type">
                                        <option value="">Selected Option</option>
                                        <option value="nominal account">Nominal Account</option>
                                        <option value="assets account">Assets Account</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="description" class="required">Description</label>
                                     <textarea  class="form-control" name="description" id="description" cols="20" rows="5" required></textarea>                                </div>
                            </div>

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

