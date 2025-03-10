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
                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input required id="name" placeholder="Enter Name of Designation "
                                        type="text" name="name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            {{-- <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="order">Select Order</label>
                                    <select id="order" name="order" class="form-control form-control-sm">
                                        <option value="">Select Designation Order</option>
                                        @foreach ($data as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea required id="description" placeholder="Enter Short Description of Designation" type="text"
                                        name="description" class="form-control form-control-sm" rows="3"></textarea>
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
