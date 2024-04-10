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
                    <form id="form_data" action="{{ route('admin.branch.store') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required id="name" placeholder="Enter Name of Branch" type="text"
                                        name="name" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="code">code</label>
                                    <input id="code" placeholder="Enter Code of Branch" type="text"
                                        name="code" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="is_main_branch">Is Main branch</label>
                                    <select id="is_main_branch" name="is_main_branch" class="form-control form-control-sm">
                                        <option value="">--select--</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="city">city</label>
                                    <input id="city" placeholder="Enter City of Branch" type="text"
                                        name="city" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="state">state</label>
                                    <input id="state" placeholder="Enter State of Branch" type="text"
                                        name="state" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input id="country" placeholder="Enter Country of Branch " type="text"
                                        name="country" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="landmark">landmark</label>
                                    <input id="landmark" placeholder="Enter Landmark of Branch "
                                        type="text" name="landmark" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="status">status</label>
                                    <select id="status" name="status"
                                        class="form-control form-control-sm ">
                                        <option value="active">Active</option>
                                        <option value="inactive">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea id="address" placeholder="Enter Short Address of Branch   " type="text" name="address"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea required id="description" placeholder="Enter Short Description of Branch   " type="text" name="description"
                                        class="form-control form-control-sm "></textarea>
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
