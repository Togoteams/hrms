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
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="name">Name </label>
                                    <input required id="name" placeholder="Enter Name of Branch "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="code">code </label>
                                    <input required id="code" placeholder="Enter code of Branch "
                                        type="text" name="code" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="city">city </label>
                                    <input required id="city" placeholder="Enter city of Branch "
                                        type="text" name="city" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="state">state </label>
                                    <input required id="state" placeholder="Enter state of Branch "
                                        type="text" name="state" class="form-control form-control-sm ">
                                </div>
                            </div>     <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="countery">countery </label>
                                    <input required id="countery" placeholder="Enter countery of Branch "
                                        type="text" name="countery" class="form-control form-control-sm ">
                                </div>
                            </div>     <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="landmark">landmark </label>
                                    <input required id="landmark" placeholder="Enter landmark of Branch "
                                        type="text" name="landmark" class="form-control form-control-sm ">
                                </div>
                            </div>     <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="status">status </label>
                                    <select required id="status" placeholder="Enter status of Branch "
                                        name="status" class="form-control form-control-sm ">
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="address">Address </label>
                                    <textarea required id="address" placeholder="Enter Short address of Branch   " type="text"
                                        name="address" class="form-control form-control-sm "></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">Description </label>
                                    <textarea required id="description" placeholder="Enter Short Description of Branch   " type="text"
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
