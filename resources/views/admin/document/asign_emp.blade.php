    <!-- Modal -->
    <div class="modal-body">
        <form id="form_data_assign" action="{{ route('admin.document.asign') }}" method="POST">
            @csrf

            {{-- <form id="form_edit_assign" action="{{ route('admin.document.asign', $data->id) }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}"> --}}
            <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                <thead>
                    <tr>
                        <th>Emp Name</th>
                        <th>Select all <input type="checkbox" id="select-all">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" name="document_id" value="{{ $data->id }}" class="document_id">

                    @foreach ($all_users as $user)
                        <?php
                        $cond = [
                            'document_id' => $data->id,
                            'emp_id' => $user->id,
                        ];
                        $check = DB::table('document_emps')->where($cond)->select('emp_id')->first();
                        
                        if (!empty($check)) {
                            $checked = 'checked';
                        } else {
                            $checked = '';
                        }
                        ?>
                        <tr>
                            <td>{{ $user->user->name }}</td>
                            <td>
                                <input type="checkbox" class="emp-checkbox" id="emp_id" name="emp_id[]"
                                    value="{{ $user->user->id }}" {{ $checked }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>
            <div class="text-center ">
                <button onclick="ajaxCall('form_data_assign')" type="button" class="btn btn-white">Submit
                </button>
                {{-- <button onclick="ajaxCall('form_edit_assign','','POST')" type="button" class="btn btn-white">submit
                </button> --}}
            </div>
        </form>
    </div>
    @push('custom-scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                console.log("test");
                $('#select-all').click(function() {
                    console.log("test");
                    $('.emp-checkbox').prop('checked', $(this).prop('checked'));
                });
            });
        </script>
    @endpush
