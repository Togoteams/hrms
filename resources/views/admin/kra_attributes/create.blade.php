    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.kra-attributes.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required id="name" placeholder="Enter Name of Kra Attributes "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="max_marks">max_marks</label>
                                    <input required id="max_marks" placeholder="Enter max_marks of Kra Attributes "
                                        type="text" name="max_marks" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="min_marks">min_marks</label>
                                    <input required id="min_marks" placeholder="Enter min_marks of Kra Attributes "
                                        type="text" name="min_marks" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="status">status</label>
                                    <select required id="status" name="status"
                                        class="form-control form-control-sm ">
                                        <option value="active">Active</option>
                                        <option value="inactive">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea required id="description" placeholder="Enter Short Description of Kra Attributes   " type="text"
                                        name="description" class="form-control form-control-sm "></textarea>
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button onclick="ajaxCall('form_data')" type="button" class="btn btn-primary">Add
                                {{ $page }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
