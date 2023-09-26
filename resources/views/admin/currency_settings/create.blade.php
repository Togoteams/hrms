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
             <form id="form_data" action="{{ route('admin.currency_settings.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="currency_name_from" class="required">Currency Name From</label>
                                    <select name="currency_name_from" id="currency_name_from" class="form-control">
                                        <option value="">Select Currency Name From</option>
                                        <option value="INR">INR</option>
                                        <option value="USD">USD</option>
                                        <option value="PULA">PULA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="currency_amount_from" class="required">Currency Amount From</label>
                                    <input type="number" required name="currency_amount_from" id="currency_amount_from" class="form-control" placeholder="Enter Currency Amount From">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="currency_name_to" class="required">Currency Name To</label>
                                    <select name="currency_name_to" id="currency_name_to" class="form-control">
                                        <option value="">Select Currency Name To</option>
                                        <option value="INR">INR</option>
                                        <option value="USD">USD</option>
                                        <option value="PULA">PULA</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="currency_amount_to" class="required">Currency Amount To</label>
                                    <input type="number" required name="currency_amount_to" id="currency_amount_to" class="form-control" placeholder="Enter Currency Amount To">
                                </div>
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

