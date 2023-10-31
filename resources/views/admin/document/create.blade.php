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
                    <form id="form_data" action="{{ route('admin.document.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="document_name" class="required">Document Name</label>
                                    <input required id="document_name" placeholder="Enter Document Name" min="1" max="100" type="text"
                                        name="document_name" class="form-control form-control-sm ">
                                </div>
                            </div>
                         
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="document_type" class="required">Document Type</label>
                                    <select name="document_type" class="form-control" id="document_type">
                                        <option value="">Select Option</option>
                                        @foreach($documentType as $data)
                                            <option value="{{ $data->id }}" {{ old('document_type') == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    {{-- <select required id="document_type"  name="document_type" class="form-control form-control-sm " >
                                        <option value="">Select Document Type</option>
                                        <option value="onbording">Onbording</option>
                                        <option value="other">Other</option>
                                    </select> --}}
                                    <!-- <input required id="document_type" placeholder="Enter Document type of Document" min="1" max="100" type="text"
                                        name="document_type" class="form-control form-control-sm "> -->
                                </div>
                            </div>
                           
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="document" class="required">Document</label>
                                    <input required id="document" placeholder="Enter Document  of Document" min="1" max="100" type="file"
                                        name="document" class="form-control form-control-sm ">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Add
                                {{ $page }}</button>
                        </div>
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
