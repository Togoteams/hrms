    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.payroll.head.store') }}">
                        @csrf
                        <div class="row">

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label class="required" for="employment_type">employment type</label>
                                    <select required id="employment_type" name="employment_type" value="local"
                                        class="form-control form-control-sm">
                                        <option selected disabled=""> - Select employment type- </option>
                                        <option value="both">All</option>
                                        <option value="local">Local</option>
                                        <option value="expatriate">Expatriate</option>
                                        <option value="local-contractual">Local-Contractual </option>
                                        <option value="both">Local and Expatriate </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label class="required" for="for">Type</label>
                                    <select required id="head_type" name="head_type" class="form-control form-control-sm">
                                        <option value="both"> - All- </option>
                                        <option  value="deduction">Deduction</option>
                                        <option  value="income">Income</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label class="required" for="for">For</label>
                                    <select required id="for" name="for" class="form-control form-control-sm">
                                        <option selected disabled=""> - Select for type- </option>
                                        <option value="payscale">Payscale</option>
                                        <option value="salary">Salary</option>
                                        <option value="both">Payscal and Salary </option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label class="required" for="name">Name</label>
                                    <input required id="name" placeholder="Enter Name of {{ $page }} "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label class="required" for="placeholder">Placeholder</label>
                                    <input required id="placeholder"
                                        placeholder="Enter placeholder of {{ $page }} " type="text"
                                        name="placeholder" class="form-control form-control-sm ">
                                </div>
                            </div>


                            {{-- <div class="mb-2 col-sm-8">
                                <div class="form-group">
                                    <label class="optional" for="slug">Slug</label>
                                    <input id="slug" placeholder="Enter slug of {{ $page }} "
                                        type="text" name="slug" class="form-control form-control-sm ">
                                </div>
                            </div> --}}
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label class="required" for="is_dropdown">Is DropDown</label>
                                    <select required id="is_dropdown" name="is_dropdown"
                                        class="form-control form-control-sm">
                                        <option value="no">no</option>
                                        <option value="yes">yes</option>
                                    </select>
                                </div>
                            </div>
                          

                            {{-- <hr>
                            <h5>Validation</h5>
                            <div class="mb-2 col-sm-2">
                                <div class="form-group">
                                    <input id="required" type="checkbox" name="valid[]" value="required">
                                    <label for="required">Required</label>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-2">
                                <div class="form-group">
                                    <input id="numeric" type="checkbox" name="valid[]" value="numeric">
                                    <label for="numeric">Number</label>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-2">
                                <div class="form-group">
                                    <input id="string" type="checkbox" name="valid[]" value="string">
                                    <label for="string">String</label>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-2">
                                <div class="form-group">
                                    <input id="double" type="checkbox" name="valid[]" value="double">
                                    <label for="double">double</label>
                                </div>
                            </div> --}}


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
