{{-- Model --}}
                        <form id="form_edit" action="{{ route('admin.payroll.reimbursement_type.update',$reimbursement->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label class="required" for="type">Reimbursement Type</label>
                                    <input type="text" name="type" id="type" class="form-control" placeholder="Reimbursement type" value="{{$reimbursement->type}}">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="type" class="required">Account No</label>
                                    <input type="text"  name="account_no" id="account_no" class="form-control" placeholder="Account No." value="{{$reimbursement->account_no}}">
                                </div>
                            </div>
                    
                            <div class="mb-2 col-sm-3">
                                <div class="form-group">
                                    <label for="is_tax_exempt">Is Tax Exempt<sup class="text-danger">*</sup></label>
                                    <select name="is_tax_exempt" class="form-control" id="is_tax_exempt">
                                        <option value="">Selected Option</option>
                                        <option @if ($reimbursement->is_tax_exempt == '1') selected  @endif value="1">Yes</option>
                                        <option @if ($reimbursement->is_tax_exempt == '0') selected  @endif value="0">No</option>
                                    </select>
                                </div>
                            </div>
                           

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
                                {{ $page }}</button>
                        </div>
                    </form>
              