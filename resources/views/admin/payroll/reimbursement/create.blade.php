{{-- Model --}}

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.payroll.reimbursement.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d H:i:s') }}">
                        
                        <div class="row">
                            @if (!isemplooye())
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="user_id" class="required">Employee</label>
                                    <select name="user_id" class="form-control" id="user_id">
                                        <option value="">- Select -</option>
                                        @foreach ($Employees as $employee)
                                            <option value="{{ $employee->user->id }}">
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
                                         <option value="{{ $data->id }}" {{ old('type_id') == $data->id ? 'selected' : '' }}>
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
                                    name="expenses_currency" class="form-control form-control-sm" required>
                                    <option selected disabled> - Select - </option>
                                    @foreach ($expenseCurrency  as  $currency)
                                    <option value="{{$currency->currency_name_from}}">{{getCurrencyIcon($currency->currency_name_from)}}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="expenses_amount" class="required">Expense Amount</label>
                                    <input type="number" required name="expenses_amount" id="expenses_amount" class="form-control" placeholder="Expenses Amount" value="{{ old('expenses_amount') }}">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="claim_date" class="required">Claim date</label>
                                    <input type="date" name="claim_date"  required id="claim_date" class="form-control" placeholder="claim_date" value="{{ old('claim_date', now()->format('Y-m-d')) }}">
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
                                        <option value="{{$currentYear-1}}-{{$currentYear}}">{{$currentYear-1}}-{{$currentYear}}</option>
                                        <option value="{{$currentYear}}-{{$currentYear+1}}">{{$currentYear}}-{{$currentYear+1}}</option>
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="claim_from_month" class="required">Claim for period from month</label>
                                    <select name="claim_from_month" id="claim_from_month" class="form-control"  required>
                                        <option value="">Select From Month</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="claim_to_month" class="required">Claim for period to month</label>
                                    <select name="claim_to_month" id="claim_to_month" class="form-control" required >
                                        <option value="">Select To Month</option>
                                       
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                    </select>
                                </div>
                            </div>
                           
                            <div class="mb-4 col-sm-12">
                                <div class="form-group">
                                    <label for="reimbursement_notes" class="required">Reimbursement notes</label>
                                    <textarea name="reimbursement_notes" required id="reimbursement_notes" cols="10" rows="5" class="form-control" placeholder="Reimbursement Notes..."></textarea>
                                </div>
                            </div>
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
                                <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Add
                                    {{ $page }}</button>
                            </div>
                        </div>
                        <hr>
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
