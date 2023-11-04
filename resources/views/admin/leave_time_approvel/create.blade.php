<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-md">
    <div class="modal-content ">
        <div class="modal-header ">
            <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">  
             <form id="form_data" action="{{ route('admin.leave_time_approved.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-6 col-sm-6">
                                <div class="form-group">
                                    <label for="user_id" class="required">Employee</label>
                                    <select name="user_id" id="user_id"  class="form-control">
                                        <option value="">- Select -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-6 col-sm-6">
                                <div class="form-group">
                                    <label for="leave_type_id" class="required">Leave Type</label>
                                    <select name="leave_type_id" id="leave_type_id" class="form-control" required>
                                        <option value="">- select -</option>
                                        @foreach ($leave_setting as $setting)
                                            <option value="{{ $setting->id }}">{{ $setting->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-12 col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="Enter Description..."></textarea>
                                </div>
                            </div>

                            <hr>
                            <div class="text-center ">
                                <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Add
                                    {{ $page }}</button>
                            </div>
                        </div>
                       
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

