    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel"> Apply {{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.leave_encashment.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                        <div class="row">


                            @if (!isemplooye())
                                <div class="mb-2 col-sm-6">
                                    <div class="form-group">
                                        <label for="user_id">Employee</label>
                                        <select
                                            onchange="selectDrop('form_data','{{ route('admin.leave_apply.get_encash_leave') }}', 'leave_type_id')"
                                            required id="user_id" placeholder="Enter correct user_id   "
                                            type="text" name="user_id">
                                            <option selected disabled> -Select User - </option>
                                            @foreach ($allowedEmps as $user)
                                                <option value="{{ $user->user_id }}">{{ $user->user->name }} -
                                                    {{ $user->ec_number }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="leave_type_id">Leave Types</label>
                                    <select required id="leave_type_id" onchange="change_leave()"
                                        placeholder="Enter correct leave_type_id   " type="text" name="leave_type_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> -Select Leave Types- </option>
                                        @foreach ($leave_type as $l_type)
                                            <option value="{{ $l_type->id }}">{{ $l_type->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="balance_leave1">Total Balance Leave</label>
                                    <input required id="balance_leave1" readonly
                                        placeholder="Enter correct balance_leave" type="number" name="balance_leave"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="available_leave_for_encashment">Available Leave For Encashment</label>
                                    <input required id="available_leave_for_encashment" readonly
                                        placeholder="Enter correct available_leave_for_encashment" type="number"
                                        name="available_leave_for_encashment" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="request_leave_for_encashement">Request Leave for Encashement</label>
                                    <input required id="request_leave_for_encashement"
                                        placeholder="Enter correct request_leave_for_encashement" type="number"
                                        name="request_leave_for_encashement" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="description">description</label>
                                    <textarea rows="3" id="description" placeholder="Enter correct description   " name="description"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center ">
                            <button type="button" onclick="ajaxCall('form_data')" class="btn btn-white">
                                {{ $page }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @push('custom-scripts')
        <script>
            function change_leave() {
                var getBalanceUrl = "{{ route('admin.leave_encashment.get_balance_encah_leave') }}";
                var user_id = $("#user_id").val();
                var leave_type_id = $("#leave_type_id").val();
                $.ajax({
                    url: getBalanceUrl,
                    type: "get",
                    data: {
                        "user_id": user_id,
                        'leave_type_id': leave_type_id
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.status == true) {
                            var data = result.data;
                            if (data.is_balance_leave_hide) {
                                $("#balance_leave1").val(0);
                                $("#available_leave_for_encashment").val(0);
                            } else {
                                $("#balance_leave1").val(data.remaining_leave);
                                $("#available_leave_for_encashment").val(Math.round(Number(data.remaining_leave /
                                    2)));
                            }
                        } else {
                            $("#balance_leave1").val(0);
                            $("#available_leave_for_encashment").val(0);
                        }
                        //    amount_cal(e);
                    },
                });
            }
            $(document).ready(function() {
                $('#user_id').selectize();
               
            });
        </script>
        
    @endpush
