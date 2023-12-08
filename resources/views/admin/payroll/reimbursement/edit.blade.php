

<form id="form_edit" action="{{ route('admin.payroll.reimbursement.update',$reimbursement->id) }}">
     @csrf
    <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
        <div class="row">
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label class="required" for="type_id">Reimbursement Type</label>
                    <select name="type_id" class="form-control" id="type_id" placeholder="Reimbursement type" required>
                        <option value="">Select Option</option>
                            @foreach($reimbursementType as $data)
                            <option value="{{ $data->id }}" {{ $data->id == $reimbursement->type_id ? 'selected' : '' }}>
                            {{ $data->type }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <label for="expenses_currency">Expense Currency  <small
                        class="required-field">*</small></label>
                <select id="expenses_currency" placeholder="Select Currency"
                    name="expenses_currency" class="form-control form-control-sm" required>
                    <option selected disabled> - Select - </option>
                    @foreach ($currencies  as  $currency)
                    <option value="{{$currency->currency_name_from}}" {{ $reimbursement->expenses_currency == $currency->currency_name_from ? 'selected' : '' }}>{{getCurrencyIcon($currency->currency_name_from)}}</option>
                    @endforeach
                    {{-- <option value="pula" {{ !empty($employee) && $employee->expenses_currency == 'pula' ? 'selected' : '' }}>Pula( P )</option>
                    <option value="dollar" {{ !empty($employee) && $employee->expenses_currency == 'dollar' ? 'selected' : '' }}>Dollar( $ )</option> --}}
                </select>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="expenses_amount" class="required">Expense Amount</label>
                    <input type="number" required name="expenses_amount" id="expenses_amount" class="form-control" placeholder="Expenses Amount" value="{{$reimbursement->expenses_amount}}">
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="claim_date" class="required">Claim date</label>
                    <input type="date" name="claim_date" required id="claim_date" class="form-control" placeholder="claim_date" value="{{$reimbursement->claim_date}}">
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label class="required" for="financial_year">Financial year</label>
                    <select required id="financial_year" name="financial_year"
                        class="form-control form-control-sm">
                        <option selected disabled=""> - Select financial year- </option>
                        @php
                            $currentYear = date('Y');
                        @endphp 
                        <option value="{{$currentYear-1}}-{{$currentYear}}" @if($reimbursement->financial_year== (($currentYear-1)."-".$currentYear)) selected @endif >{{$currentYear-1}}-{{$currentYear}}</option>
                        <option value="{{$currentYear}}-{{$currentYear+1}}" @if($reimbursement->financial_year== (($currentYear)."-".$currentYear+1)) selected @endif >{{$currentYear}}-{{$currentYear+1}}</option>
                       
                    </select>
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="claim_from_month" class="required">Claim For Period From Month {{$reimbursement->claim_from_month}}</label>
                    <select name="claim_from_month" id="claim_from_month" class="form-control"  required>
                        <option value="">Select From Month</option>
                        
                        <option value="7" {{$reimbursement->claim_from_month == 7 ? 'selected' : ''}}>July</option>
                        <option value="8" {{$reimbursement->claim_from_month == 8 ? 'selected' : ''}}>August</option>
                        <option value="9" {{$reimbursement->claim_from_month == 9 ? 'selected' : ''}}>September</option>
                        <option value="10" {{$reimbursement->claim_from_month == 10 ? 'selected' : ''}}>October</option>
                        <option value="11" {{$reimbursement->claim_from_month == 11 ? 'selected' : ''}}>November</option>
                        <option value="12" {{$reimbursement->claim_from_month == 12 ? 'selected' : ''}}>December</option>
                        <option value="1" {{$reimbursement->claim_from_month == 1 ? 'selected' : ''}}>January</option>
                        <option value="2" {{$reimbursement->claim_from_month == 2 ? 'selected' : ''}}>February</option>
                        <option value="3" {{$reimbursement->claim_from_month == 3 ? 'selected' : ''}}>March</option>
                        <option value="4" {{$reimbursement->claim_from_month == 4 ? 'selected' : ''}}>April</option>
                        <option value="5" {{$reimbursement->claim_from_month == 5 ? 'selected' : ''}}>May</option>
                        <option value="6" {{$reimbursement->claim_from_month == 6 ? 'selected' : ''}}>June</option>
                    </select>
                </div>
            </div>
            <div class="mb-2 col-sm-6">
                <div class="form-group">
                    <label for="claim_to_month" class="required">Claim For Period To Month</label>
                    <select name="claim_to_month" id="claim_to_month" class="form-control" required >
                        <option value="">Select To Month</option>
                        <option value="7" {{$reimbursement->claim_to_month == 7 ? 'selected' : ''}}>July</option>
                        <option value="8" {{$reimbursement->claim_to_month == 8 ? 'selected' : ''}}>August</option>
                        <option value="9" {{$reimbursement->claim_to_month == 9 ? 'selected' : ''}}>September</option>
                        <option value="10" {{$reimbursement->claim_to_month == 10 ? 'selected' : ''}}>October</option>
                        <option value="11" {{$reimbursement->claim_to_month == 11 ? 'selected' : ''}}>November</option>
                        <option value="12" {{$reimbursement->claim_to_month == 12 ? 'selected' : ''}}>December</option>
                        <option value="1" {{$reimbursement->claim_to_month == 1 ? 'selected' : ''}}>January</option>
                        <option value="2" {{$reimbursement->claim_to_month == 2 ? 'selected' : ''}}>February</option>
                        <option value="3" {{$reimbursement->claim_to_month == 3 ? 'selected' : ''}}>March</option>
                        <option value="4" {{$reimbursement->claim_to_month == 4 ? 'selected' : ''}}>April</option>
                        <option value="5" {{$reimbursement->claim_to_month == 5 ? 'selected' : ''}}>May</option>
                        <option value="6" {{$reimbursement->claim_to_month == 6 ? 'selected' : ''}}>June</option>
                    </select>
                </div>
            </div>
            <br>
            <div class="mb-2 col-sm-12">
                <div class="form-group">
                    <label class="required" for="reimbursement_notes">Reimbursement notes</label>
                    <textarea name="reimbursement_notes" id="reimbursement_notes" required cols="10" rows="5" class="form-control" placeholder="reimbursement_notes">{{$reimbursement->reimbursement_notes}}</textarea>
                </div>
            </div>
            <div class="text-center ">
                <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
                    {{ $page }}</button>
            </div>
        </div>

 </form>


