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
                                    <select name="emp_id" class="form-control select2" id="emp_id" placeholder="Employee Name">
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
                                    <select name="transfer_type" class="transfer_type form-control" id="transfer_type" placeholder="Employee transfer_type">
                                        <option value="">Select Option</option>
                                        <option value="department">Department</option>
                                        <option value="branch">Branch</option> 
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6 both_data department_data" style="display: none;">
                                <div class="form-group">
                                    <label for="department_id" class="required">Department</label>
                                    <select name="department_id" class="form-control" id="department_id" placeholder="Employee department">
                                        <option value="">Select Option</option>
                                        @foreach($department as $data)
                                        <option value="{{ $data->id }}" {{ old('department_id') == $data->id ? 'selected' : '' }}>
                                           {{ $data->name }}
                                       </option>
                                       @endforeach 
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6 branch" style="display: none;">
                                <div class="form-group">
                                    <label for="branch_id" class="required">Branch</label>
                                    <select name="branch_id" class="form-control" id="branch_id" placeholder="Employee branch" >
                                        <option value="">Select Option</option>
                                        @foreach($branch as $data)
                                        <option value="{{ $data->id }}" {{ old('branch_id') == $data->id ? 'selected' : '' }}>
                                           {{ $data->name }}
                                       </option> 
                                       @endforeach 
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4 col-sm-12">
                                <div class="form-group">
                                    <label for="transfer_reason" class="required">Transfer Reason</label>
                                    <textarea name="transfer_reason" id="transfer_reason" cols="30" rows="3" class="form-control" placeholder=" Enter Transfer Reason"></textarea>
                                </div>
                            </div>
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
        function change_type(data) {
            if (data === "flat") {
                document.getElementById('type_id').innerText = data + " amount";
            } else {
                document.getElementById('type_id').innerText = data;
            }
        }
     $(document).ready(function(){
       $('.transfer_type').change(function(){
               var transfer_type = $(this).val();
               if(transfer_type == "branch"){
                    $('.both_data').hide();
                    $('.branch').show();
                    $('.department_data').show();

               }else if (transfer_type === "department"){
                    $('.both_data').show();
                    $('.branch').hide();
               }
          });
        });
    </script>
    

        
