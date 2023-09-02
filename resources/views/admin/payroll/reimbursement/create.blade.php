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
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="type" class="required">Type</label>
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
                                <div class="form-group">
                                    <label for="bill_amount" class="required">Bill Amount</label>
                                    <input type="number" name="bill_amount" id="bill_amount" class="form-control" placeholder="bill_amount">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="expenses_date" class="required">Expenses Date</label>
                                    <input type="date" name="expenses_date" id="expenses_date" class="form-control" placeholder="expenses_date" value="{{ old('expenses_date') }}">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <label for="currency">Currency<small
                                        class="required-field">*</small></label>
                            
                                <select id="currency" placeholder="Select Currency"
                                    name="currency" class="form-control form-control-sm">
                                    <option selected disabled> - Select Currency - </option>
                                    <option
                                        {{ !empty($employee) ? ($employee->currency == 'pula' ? 'selected' : '') : '' }}
                                        value="pula">Pula( P )</option>
                                    <option
                                        {{ !empty($employee) ? ($employee->currency == 'inr' ? 'selected' : '') : '' }}
                                        value="inr">INR( ₹ )</option>
                                    <option
                                        {{ !empty($employee) ? ($employee->currency == 'dollar' ? 'selected' : '') : '' }}
                                        value="dollar">Dollar( $ )</option>
                                </select>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="reimbursement_amount" class="required">Reimbursement Amount</label>
                                    <input type="number" name="reimbursement_amount" id="reimbursement_amount" class="form-control" placeholder="reimbursement_amount" value="{{ old('reimbursement_amount') }}">
                                </div>
                            </div>
                            <div class="mb-4 col-sm-12">
                                <div class="form-group">
                                    <label for="reimbursement_notes" class="required">Reimbursement notes</label>
                                    <textarea name="reimbursement_notes" id="reimbursement_notes" cols="30" rows="10" class="form-control" placeholder="reimbursement_notes"></textarea>
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
