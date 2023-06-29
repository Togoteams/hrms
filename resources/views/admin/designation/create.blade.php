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
                    <form id="form_data" action="{{ route('admin.designation.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required id="name" placeholder="Enter Name of Designation "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>


                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">Designation</label>
                                    <textarea required id="description" placeholder="Enter Short Description of Designation   " type="text"
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
