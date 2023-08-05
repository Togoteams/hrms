   
   
<form id="form_edit" action="{{ route('admin.payroll.reimbursement.update',$reimbursement->id) }}">
     @csrf
    <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
        <div class="row">
            <div class="mb-2 col-sm-3">
                <div class="form-group">
                    <label class="required" for="type_id">Type <sup class="text-danger">*</sup></label>
                    <select name="type_id" class="form-control" id="type_id" placeholder="Reimbursement type">
                        <option value="">Select Option</option>
                            @foreach($reimbursementType as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $reimbursement->type_id ? 'selected' : '' }}>
                            {{ $data->type }}
                        </option>                                        
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-2 col-sm-3">
                <div class="form-group">
                    <label class="required" for="bill_amount">Bill Amount</label>
                    <input type="text" name="bill_amount" id="bill_amount" class="form-control" placeholder="bill_amount" value="{{$reimbursement->bill_amount}}">
                    <span class="text-danger">
                        @error('bill_amount')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="mb-2 col-sm-3">
                <div class="form-group">
                    <label class="required" for="expenses_date">Expenses Date</label>
                    <input type="date" name="expenses_date" id="expenses_date" class="form-control" placeholder="expenses_date" value="{{$reimbursement->expenses_date}}">
                    <span class="text-danger">
                        @error('expenses_date')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="mb-2 col-sm-3">
                <div class="form-group">
                    <label class="required" for="reimbursement_amount">Reimbursement Amount</label>
                    <input type="text" name="reimbursement_amount" id="reimbursement_amount" class="form-control" placeholder="reimbursement_amount" value="{{$reimbursement->reimbursement_amount}}">
                    <span class="text-danger">
                        @error('reimbursement_amount')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="mb-2 col-sm-3">
                <div class="form-group">
                    <label class="required" for="reimbursement_notes">Reimbursement notes</label>
                    <input type="text" name="reimbursement_notes" id="reimbursement_notes" class="form-control" placeholder="reimbursement_notes" value="{{$reimbursement->reimbursement_notes}}">
                    <span class="text-danger">
                        @error('reimbursement_notes')
                        {{$message}}
                        @enderror
                    </span>
                </div>
            </div>
            <div class="text-center ">
                <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
                    {{ $page }}</button>
            </div>
        </div>
        
 </form>


