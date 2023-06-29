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
                    <form id="form_data" action="{{ route('admin.tax.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="name">name</label>
                                    <input required id="name" placeholder="Enter Name of Tax " type="text"
                                        name="name" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="type">type</label>
                                    <select onchange="chagne_type(this.value)" required id="type"
                                        placeholder="Enter type of Tax " type="text" name="type"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> - Select Type - </option>
                                        <option value="percentage"> Percentage</option>
                                        <option value="flat">Flat</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label id="type_id" for="value">value</label>
                                    <input required id="value" placeholder="Enter value " type="text"
                                        name="value" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea required id="description" placeholder="Enter Short Description of Tax   " type="text" name="description"
                                        class="form-control form-control-sm "></textarea>
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
    <script>
        function chagne_type(data) {
            if (data == "flat") {
                document.getElementById('type_id').innerText = data + " amount"
            } else {
                document.getElementById('type_id').innerText = data

            }
        }
    </script>
