    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">Asign Employee Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <form id="form_data" action="{{ route('admin.document.asign') }}" enctype="multipart/form-data"> --}}
                     <form id="form_data" action="{{ route('admin.document.asign') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead>
                                    <tr>
                                        <th>Emp Name</th>
                                        <th>Select all <input type="checkbox" id="select-all"> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="document_id" value="" class="document_id">
                                    @foreach ($all_users as $user)
                                    <tr>
                                        <td>{{$user->user->name}}</td>
                                        <td>
                                            {{-- <input type="checkbox" name="emp_id" value="{{ $user->id }}"> --}}
                                            <input type="checkbox" class="emp-checkbox" id="emp_id" name="emp_id[]" value="{{ $user->user->id }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        <hr>
                        <div class="text-center ">
                            {{-- <button onclick="ajaxCall('form_data')" type="button" class="btn btn-white">Submit --}}
                            <button onclick="ajaxCall('form_data')" type="submit" class="btn btn-white">Submit
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#select-all').change(function () {
                $('.emp-checkbox').prop('checked', $(this).prop('checked'));
            });
        });


        $(document).ready(function () {
        $('#select-all').change(function () {
            $('.emp-checkbox').prop('checked', $(this).prop('checked'));
        });

        // Assuming ajaxCall is defined correctly
        $('#form_data').submit(function (e) {
            e.preventDefault(); 
            var formData = $(this).serializeArray();
            
            // Extract selected checkbox values
            var selectedEmpIds = $('.emp-checkbox:checked').map(function () {
                return $(this).val();
            }).get();

            // Add the selectedEmpIds to the formData array
            selectedEmpIds.forEach(function (empId) {
                formData.push({ name: 'emp_id[]', value: empId });
            });

           
            ajaxCall(formData);
        });
});

    </script>
    
