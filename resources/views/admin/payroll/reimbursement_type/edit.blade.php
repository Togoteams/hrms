{{-- Model --}}
                        <form id="form_edit" action="{{ route('admin.payroll.reimbursement_type.update',$reimbursement->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="gender">Reimbursement Type</label>
                                    <input type="text" name="type" class="form-control" placeholder="Reimbursement type" value="{{$reimbursement->type}}">
                                </div>
                            </div>
                    
                            {{-- <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="exampleInputName">Status<sup class="text-danger">*</sup></label>
                                    <select name="status" class="form-control" id="exampleInputName">
                                        <option value="">Selected Option</option>
                                        <option @if ($reimbursement->status == '0') selected  @endif value="0">Active</option>
                                        <option @if ($reimbursement->status == '1') selected  @endif value="1">Inactive</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div> --}}
                           

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
                                {{ $page }}</button>
                        </div>
                    </form>
              