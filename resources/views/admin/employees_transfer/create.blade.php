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
                    <form id="form_data" action="{{ route('admin.employee-transfer.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="emp_id" class="required">Employee Name</label>
                                    <select name="emp_id" class="form-control" id="emp_id" placeholder="Employee Name">
                                        <option value="">Select Option</option>
                                        @foreach ($all_users as $user)
                                        <option value="{{ $user->user->id }}">{{ $user->user->name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="transfer_type" class="required">Transfer Type</label>
                                    <input type="number" name="bill_amount" id="bill_amount" class="form-control" placeholder="bill_amount">
                                </div>
                            </div>
                            <div class="mb-4 col-sm-12">
                                <div class="form-group">
                                    <label for="transfer_reason" class="required">Transfer Reason</label>
                                    <textarea name="transfer_reason" id="transfer_reason" cols="30" rows="10" class="form-control" placeholder=" Enter Transfer Reason"></textarea>
                                </div>
                            </div>
                            <span id="edit">
                            </span>

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
