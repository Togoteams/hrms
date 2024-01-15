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
                    <form id="form_data" action="{{ route('admin.leave_apply.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                        <div class="row">
                            @if (!isemplooye())
                                <div class="mb-2 col-sm-4">
                                    <div class="form-group">
                                        <label for="user_id">Employee</label>
                                        <select
                                            onchange="selectDrop('form_data','{{ route('admin.leave_apply.get_leave') }}', 'leave_type_id')"
                                            required id="user_id" placeholder="Enter correct user_id" type="text"
                                            name="user_id" class="form-control form-control-sm user_id">
                                            <option selected disabled> -Select Employee - </option>
                                            @foreach ($all_user as $user)
                                                <option value="{{ $user->user->id }}"
                                                    data-employment_type="{{ $user->employment_type }}">
                                                    {{ $user->user->name }} -
                                                    {{ $user->ec_number }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="leave_type_id">Leave Types</label>
                                    <select required id="leave_type_id" onchange="change_leave()"
                                        placeholder="Enter correct leave_type_id   " type="text" name="leave_type_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> -Select Leave Types- </option>
                                        @foreach ($leave_type as $l_type)
                                            <option value="{{ $l_type->id }}" data-leave_slug="{{ $l_type->slug }}">
                                                {{ $l_type->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="mb-2 col-sm-4 ibo-pay-type" style="display: none">
                                <div class="form-group">
                                    <label for="pay_type">Pay Type</label>
                                    <select id="pay_type" placeholder="Enter correct pay_type " type="text"
                                        name="pay_type" class="form-control form-control-sm ">
                                        <option selected disabled> -Select Types- </option>
                                        <option value="half_pay">Half Pay</option>
                                        <option value="full_pay">Full Pay</option>
                                    </select>

                                </div>
                            </div>
                            <div class="mb-2 col-sm-4 balance_leave_section">
                                <div class="form-group">
                                    <label for="balance_leave1">balance_leave</label>
                                    <input readonly required id="balance_leave1"
                                        placeholder="Enter correct balance_leave" type="text" name="remaining_leave"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="start_date">start_date</label>
                                    <input required id="start_date" placeholder="Enter correct start_date   "
                                        onchange="change_leave()" type="date" name="start_date"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="end_date">end_date</label>
                                    <input required id="end_date" placeholder="Enter correct end_date   "
                                        type="date" onchange="change_leave()" name="end_date"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="leave_applies_for">leave_applies_for</label>
                                    <input required readonly id="leave_applies_for"
                                        placeholder="Enter correct leave_applies_for " value="0" type="text"
                                        name="leave_applies_for" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="doc">Required Document</label>
                                    <input accept="application/pdf" id="doc"
                                        placeholder="Enter correct Document   " type="file" name="doc1"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="Reason">Approval Authority</label>
                                    <select id="approval_authority" placeholder="Select Authority"
                                        name="approval_authority" required class="form-control form-control-sm approval_authority">
                                        <option selected disabled> - Select - </option>
                                        @foreach ($approvalAuthority as $key => $value)
                                            <option value="{{ $value->user_id }}">{{ $value->user->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="Reason">leave_reason</label>
                                    <input required id="leave_reason"
                                        placeholder="eg:- i want to 2 days leave for my sister marriage  "
                                        type="text" name="leave_reason" class="form-control form-control-sm ">
                                </div>
                            </div>
                           

                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="remark"> Describe the Leave reason (optional)</label>
                                    <textarea rows="3" id="remark" placeholder="Describe the Leave reason  " name="remark"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center ">
                            <button type="button" onclick="ajaxCall('form_data'),change_leave(this)"
                                class="btn btn-white submit">
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
                getDays();
                var leaveSlug = $("#leave_type_id").find(':selected').data('leave-slug');
                var employment_type = $("#user_id").find(':selected').data('employment_type');
                var leave_applies_for = $("#leave_applies_for").val() ?? 1;
                console.log(leave_applies_for);
                if (employment_type == "expatriate" && leaveSlug == "sick-leave" && leave_applies_for >= 2) {
                    document.getElementById('doc').setAttribute("required", "");
                    console.log("expatriate");
                } else if (employment_type == "local" && (leaveSlug == "sick-leave" || leaveSlug == "maternity-leave")) {
                    document.getElementById('doc').setAttribute("required", "");
                    console.log("local");
                } else {
                    document.getElementById('doc').removeAttribute("required", "");
                }
                var getBalanceUrl = "{{ route('admin.leave_apply.get_balance_leave') }}";
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
                                $(".balance_leave_section").css('display', 'none');
                            } else {
                                $("#balance_leave1").val(data.remaining_leave);
                                $(".balance_leave_section").css('display', '');
                            }

                            if (data.is_ibo_sick_leave) {
                                $(".ibo-pay-type").css('display', 'block');
                            } else {
                                $(".ibo-pay-type").css('display', 'none');
                            }

                        } else {
                            $("#balance_leave1").val(0);
                        }
                        //    amount_cal(e);
                    },
                });
            }

            $("#start_date").on('change', function() {
                dt = new Date($(this).val());
                dt.setDate(dt.getDate() + 1);
                var month = dt.getMonth() + 1;
                var day = dt.getDate();
                if (month < 10) {
                    month = "0" + month;
                }

                if (day < 10) {
                    day = "0" + day;
                }
                $("#end_date").val(dt.getFullYear() + "-" + (month) + "-" + day);
                getDays();
            });
            $("#end_date").on('change', function() {
                getDays();
            });
            $("#user_id").on('change', function() {
                getApprovalAuthrity();
            });
            function getApprovalAuthrity()
            {
                var getAuthorityUrl = "{{ route('admin.leave_apply.get_approval_authority') }}";
                var user_id = $(".user_id").val();
                $.ajax({
                    url: getAuthorityUrl,
                    type: "get",
                    data: {
                        "user_id": user_id,
                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result);
                        if (result.status == true) {
                            var data = result.data;
                            var obj = `<option value="">-Select-</option>`;
                            $.each(data, function (key, val) {
                                obj +=`<option value="${val.user_id}" >${val.user.name}</option>`;
                            });
                            console.log(obj);
                            $(".approval_authority").html(obj);
                        } else {
                            
                        }
                        //    amount_cal(e);
                    },
                });   
            }
            function getDays() {
                date1 = new Date($("#start_date").val());
                date2 = new Date($("#end_date").val());
                $("#leave_applies_for").val(0);
                var milli_secs = date1.getTime() - date2.getTime();
                var days = 0;
                days = Math.round(Math.abs(milli_secs / (1000 * 3600 * 24))) + 1;
                // Convert the milli seconds to Days
                if (days.toString() == "NaN") {
                    days = 0;
                }
                $("#leave_applies_for").val(Number(days));
            }
        </script>
    @endpush
