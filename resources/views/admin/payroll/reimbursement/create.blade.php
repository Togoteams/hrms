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
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="type">Type <sup class="text-danger">*</sup></label>
                                    <select name="type_id" class="form-control" id="type_id" placeholder="Reimbursement type">
                                        <option value="">Select Option</option>
                                         @foreach($reimbursementType as $data)
                                         <option value="{{ $data->id }}" {{ old('type_id') == $data->id ? 'selected' : '' }}>
                                            {{ $data->type }}
                                        </option>                                         
                                        @endforeach
                                    </select>
                                    {{-- <span class="text-danger">
                                        @error('type_id')
                                        {{$message}}
                                        @enderror
                                    </span> --}}
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="bill_amount">Bill Amount</label>
                                    <input type="number" name="bill_amount" id="bill_amount" class="form-control" placeholder="bill_amount" value="{{ old('bill_amount') }}">
                                    {{-- <span class="text-danger">
                                        @error('bill_amount')
                                        {{$message}}
                                        @enderror
                                    </span> --}}
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="expenses_date">Expenses Date</label>
                                    <input type="date" name="expenses_date" id="expenses_date" class="form-control" placeholder="expenses_date" value="{{ old('expenses_date') }}">
                                    {{-- <span class="text-danger">
                                        @error('expenses_date')
                                        {{$message}}
                                        @enderror
                                    </span> --}}
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="reimbursement_amount">Reimbursement Amount</label>
                                    <input type="number" name="reimbursement_amount" id="reimbursement_amount" class="form-control" placeholder="reimbursement_amount" value="{{ old('reimbursement_amount') }}">
                                    {{-- <span class="text-danger">
                                        @error('reimbursement_amount')
                                        {{$message}}
                                        @enderror
                                    </span> --}}
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="reimbursement_notes">Reimbursement notes</label>
                                    <input type="text" name="reimbursement_notes" id="reimbursement_notes" class="form-control" placeholder="reimbursement_notes" value="{{ old('reimbursement_notes') }}">
                                    {{-- <span class="text-danger">
                                        @error('reimbursement_notes')
                                        {{$message}}
                                        @enderror
                                    </span> --}}
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
                            <span id="edit">
                            </span>

                            <div class="text-center ">
                                <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Add
                                    {{ $page }}</button>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="text-center" style="display: none" id="table_data_btn">
                            <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary">Add
                                {{ $page }}</button>
                        </div> --}}
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
