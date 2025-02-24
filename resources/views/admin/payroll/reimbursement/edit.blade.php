

<input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">
        <input type="hidden" name="reimbursement_id" value="{{$reimbursement->id}}">


    <input type="hidden" name="created_at" value="{{ date('Y-m-d H:i:s') }}">
    
    <div class="row">
        @if (!isemplooye())
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="reimbursement_for" class="required">Reimbursement For</label>
                <select name="reimbursement_for" class="form-control" id="reimbursement_for">
                    <option value="">- Select -</option>
                    @foreach ($reimbursementFor as $key=> $for)
                        <option value="{{ $for['value'] }}" {{ @$editData?->reimbursement_for == $for['value'] ? 'selected' : '' }}>
                            {{ $for['lable'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="user_id" class="required">Employee</label>
                <select name="user_id" class="form-control" id="user_id">
                    <option value="">- Select -</option>
                    @foreach ($Employees as $employee)
                        <option value="{{ $employee->user->id }}" {{ @$editData?->reimbursement_for == $employee->user->id ? 'selected' : '' }}>
                            {{ $employee->user->name }}({{ $employee->ec_number }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        @else
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        @endif
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="type" class="required">Reimbursement Type</label>
                <select name="type_id" class="form-control" id="type_id" placeholder="Reimbursement type">
                    <option value="">Select Option</option>
                     @foreach($reimbursementType as $data)
                     <option value="{{ $data->id }}" {{ $data->id == @$editData?->type_id ? 'selected' : '' }} {{ old('type_id') == $data->id ? 'selected' : '' }}>
                        {{ $data->type }}
                    </option>                                         
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <label for="expenses_currency">Expense Currency<small
                    class="required-field">*</small></label>
        
            <select id="expenses_currency" placeholder="Select Currency"
                name="expenses_currency" class="form-control form-control-sm" >
                <option selected disabled> - Select - </option>
                @foreach ($expenseCurrency  as  $currency)
                <option value="{{$currency->currency_name_from}}" {{ @$editData?->expenses_currency == $currency->currency_name_from ? 'selected' : '' }}>{{(ucfirst($currency->currency_name_from))}}</option>
            @endforeach
            </select>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="expenses_amount" class="required">Expense Amount</label>
                <input type="number"  name="expenses_amount" id="expenses_amount" step="0.001" class="form-control" placeholder="Expenses Amount" value="{{@$editData?->expenses_amount}}">
            </div>
        </div>
        
        <div class="col-sm-6 reimbursement_currency_section " @if ($editData?->reimbursement_for ==1)
            style="display: none;"
        @endif>
            <label for="reimbursement_currency">Reimbursement Currency <small
                    class="required-field">*</small></label>

            <select id="reimbursement_currency" placeholder="Select Reimbursement Currency"
                name="reimbursement_currency" class="form-control form-control-sm" >
                <option selected disabled> - Select Currency - </option>
                <option value="usd"  {{ @$editData?->reimbursement_currency =='usd' ? 'selected' : '' }}>USD</option>
                <option value="pula" {{ @$editData?->reimbursement_currency =='pula' ? 'selected' : '' }}>PULA</option>
            </select>
        </div>
        <div class="mb-2 col-sm-6 reimbursement_amount_section" @if ($editData?->reimbursement_for ==1)
            style="display: none;"
        @endif>
            <div class="form-group">
                <label for="reimbursement_amount" class="required">Reimbursement Amount</label>
                <input type="number"  name="reimbursement_amount" id="reimbursement_amount" step="0.001" class="form-control" placeholder="Reimbursement Amount" value="{{ @$editData?->reimbursement_amount }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6 claim_date_section">
            <div class="form-group">
                <label for="claim_date" class="required">Claim date</label>
                <input type="date" name="claim_date"   id="claim_date" class="form-control" placeholder="claim_date" value="{{@$editData?->claim_date ?? now()->format('Y-m-d')}}">
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
                    <option value="{{$currentYear-1}}-{{$currentYear}}" @if(@$editData?->financial_year== (($currentYear-1)."-".$currentYear)) selected @endif>{{$currentYear-1}}-{{$currentYear}}</option>
                    <option value="{{$currentYear}}-{{$currentYear+1}}"  @if(@$editData?->financial_year== (($currentYear)."-".$currentYear+1)) selected @endif>{{$currentYear}}-{{$currentYear+1}}</option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-6 claim_for_period_from_month_section">
            <div class="form-group">
                <label for="claim_from_month" class="required">Claim for period from month</label>
                <select name="claim_from_month" id="claim_from_month" class="form-control" >
                    <option value="">Select From Month</option>
                    <option value="7" {{@$editData?->claim_from_month == 7 ? 'selected' : ''}}>July</option>
                    <option value="8"  {{@$editData?->claim_from_month == 8 ? 'selected' : ''}}>August</option>
                    <option value="9"  {{@$editData?->claim_from_month == 9 ? 'selected' : ''}}>September</option>
                    <option value="10"  {{@$editData?->claim_from_month == 10 ? 'selected' : ''}}>October</option>
                    <option value="11"  {{@$editData?->claim_from_month == 11 ? 'selected' : ''}}>November</option>
                    <option value="12"  {{@$editData?->claim_from_month == 12 ? 'selected' : ''}}>December</option>
                    <option value="1"  {{@$editData?->claim_from_month == 1 ? 'selected' : ''}}>January</option>
                    <option value="2"  {{@$editData?->claim_from_month ==2 ? 'selected' : ''}}>February</option>
                    <option value="3" {{@$editData?->claim_from_month == 3 ? 'selected' : ''}}>March</option>
                    <option value="4" {{@$editData?->claim_from_month == 4 ? 'selected' : ''}}>April</option>
                    <option value="5" {{@$editData?->claim_from_month == 5 ? 'selected' : ''}}>May</option>
                    <option value="6" {{@$editData?->claim_from_month == 6 ? 'selected' : ''}}>June</option>
                </select>
            </div>
        </div>
        <div class="mb-2 col-sm-6 claim_for_period_to_month_section">
            <div class="form-group">
                <label for="claim_to_month" class="required">Claim for period to month</label>
                <select name="claim_to_month" id="claim_to_month" class="form-control"  >
                    <option value="">Select To Month</option>
                   
                    <option value="7" {{@$editData?->claim_to_month == 7 ? 'selected' : ''}}>July</option>
                    <option value="8" {{@$editData?->claim_to_month == 8 ? 'selected' : ''}}>August</option>
                    <option value="9" {{@$editData?->claim_to_month == 9 ? 'selected' : ''}}>September</option>
                    <option value="10" {{@$editData?->claim_to_month == 10 ? 'selected' : ''}}>October</option>
                    <option value="11" {{@$editData?->claim_to_month == 11 ? 'selected' : ''}}>November</option>
                    <option value="12" {{@$editData?->claim_to_month == 12 ? 'selected' : ''}}>December</option>
                    <option value="1" {{@$editData?->claim_to_month == 1 ? 'selected' : ''}}>January</option>
                    <option value="2" {{@$editData?->claim_to_month == 2 ? 'selected' : ''}}>February</option>
                    <option value="3" {{@$editData?->claim_to_month == 3 ? 'selected' : ''}}>March</option>
                    <option value="4" {{@$editData?->claim_to_month == 4 ? 'selected' : ''}}>April</option>
                    <option value="5" {{@$editData?->claim_to_month == 5 ? 'selected' : ''}}>May</option>
                    <option value="6" {{@$editData?->claim_to_month == 6 ? 'selected' : ''}}>June</option>
                </select>
            </div>
        </div>
       
        <div class="mb-4 col-sm-12">
            <div class="form-group">
                <label for="reimbursement_notes" class="required">Reimbursement notes</label>
                <textarea name="reimbursement_notes"  id="reimbursement_notes" cols="10" rows="5" class="form-control" placeholder="Reimbursement Notes...">{{@$editData?->reimbursement_notes}}</textarea>
            </div>
        </div>
        <div class="mb-2 col-sm-4">
            <div class="form-group">
                <label for="document_file">Document</label>
                <input accept="application/pdf" id="document_file"
                    placeholder="Enter reimbursement Document " type="file" name="document_file"
                    class="form-control form-control-sm ">
            </div>
        </div>
        @if (@$editData?->document_file != '')
            <div class="mb-2 col-sm-4">
                <div class="">
                    <label>Document</label>
                    <label>
                        <iframe class="img-fluid" src="{{ asset('upload/document_file/' . @$editData?->document_file) }}"
                            frameborder="1"></iframe>
                    </label>
                </div>
            </div>
        @endif
        {{-- <div class="mb-2 col-sm-3">
            <div class="form-group">
                <label for="exampleInputName">Status<sup class="text-danger">*</sup></label>
                <select name="status" class="form-control" id="exampleInputName">
                    <option value="">Selected Option</option>
                    <option value="0">Pending</option>
                    <option value="1">Approved</option>
                    <option value="2">Reject</option>
                </select>
                <span class="text-danger">
                    @error('status')
                    {{$message}}
                    @enderror
                </span>
            </div>
        </div> --}}
        {{-- <span id="edit">
        </span> --}}

        <div class="text-center ">
            <button  type="submit" class="btn btn-white">Submit
                {{ $page }}</button>
        </div>
    </div>
    <hr>


