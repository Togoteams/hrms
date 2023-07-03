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
                    <form id="form_data" action="{{ route('admin.leave_type.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="leave_for">Leave For</label>
                                    <select required id="leave_for" placeholder="Enter leave_for of leave_type "
                                        type="text" name="leave_for" class="form-control form-control-sm ">
                                        <option selected disabled> - Select - </option>
                                        <option value="local">Local</option>
                                        <option value="expatriate">Expatriate</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required id="name" placeholder="Enter Name of leave_type "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="nature_of_leave">nature_of_leave</label>
                                    <select required id="nature_of_leave" name="nature_of_leave"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Nature of Leave - </option>
                                        <option value="paid"> Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="no_of_days">no_of_days</label>
                                    <input required id="no_of_days" placeholder="Enter no_of_days of leave_type "
                                        type="text" value="0" name="no_of_days"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea required id="description" placeholder="Enter Short Description of leave_type   " type="text"
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
