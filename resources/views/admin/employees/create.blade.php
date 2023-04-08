    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.employees.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-4 mb-2">
                                <div class="form-group">
                                    <label for="user_id">Employee Id</label>
                                    <input placeholder="Enter correct Emplooye  id " type="number" name="emp_id"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center ">
                            <button type="button" class="btn btn-primary">Add {{ $page }}</button>
                        </div>
                    </form>

                

                </div>

            </div>
        </div>
    </div>
