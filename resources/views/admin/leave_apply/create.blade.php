    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                                    <select onchange="selectDrop('form_data','{{ route('admin.leave_apply.get_leave') }}', 'leave_type_id')" required id="user_id" placeholder="Enter correct user_id   " type="text" name="user_id" class="form-control form-control-sm ">
                                        <option selected disabled> -Select Employee - </option>
                                        @foreach ($all_user as $user)
                                        <option value="{{ $user->user->id }}">{{ $user->user->name }} -
                                            {{ $user->user->email }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="leave_type_id">Leave Types</label>
                                    <select required id="leave_type_id" onchange="change_leave(this)" placeholder="Enter correct leave_type_id   " type="text" name="leave_type_id" class="form-control form-control-sm ">
                                        <option selected disabled> -Select Leave Types- </option>
                                        @foreach ($leave_type as $l_type)
                                        <option value="{{ $l_type->id }}">{{ $l_type->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="balance_leave1">balance_leave</label>
                                    <input readonly required id="balance_leave1" placeholder="Enter correct balance_leave" type="text" name="remaining_leave" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="start_date">start_date</label>
                                    <input required id="start_date" placeholder="Enter correct start_date   " type="date" name="start_date" class="form-control form-control-sm ">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="end_date">end_date</label>
                                    <input required id="end_date" placeholder="Enter correct end_date   " type="date" name="end_date" class="form-control form-control-sm ">
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
                                    <input accept="application/pdf" id="doc" placeholder="Enter correct Document   " type="file" name="doc1" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="Reason">leave_reason</label>
                                    <input required id="leave_reason" placeholder="Enter correct leave_reason ex - i want to 2 days for my sister merage  " type="text" name="leave_reason" class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="remark"> Describe the Leave reason (optional)</label>
                                    <textarea rows="12" id="remark" placeholder="Describe the Leave reason  " name="remark" class="form-control form-control-sm "></textarea>
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
         
    window.onload = function() { //from ww  w . j  a  va2s. c  o  m
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("start_date1")[0].setAttribute('min', today);
        document.getElementsByName("end_date1")[0].setAttribute('min', today);
    }
        function change_leave(e) {
            var text = e.options[e.selectedIndex].text;
            if (text == "SICK LEAVE") {
                document.getElementById('doc').setAttribute("required", "");

            } else {
                document.getElementById('doc').removeAttribute("required", "");

            }
            selectDrop('form_data', '{{ route('admin.leave_apply.get_balance_leave') }}', 'balance_leave1')
        }
         
        $("#start_date").on('change',function(){
            getDays();
        });
        $("#end_date").on('change',function(){
            getDays();
        });
        function getDays() {
            date1 = new Date( $("#start_date").val());
            date2 = new Date($("#end_date").val());
            var milli_secs = date1.getTime() - date2.getTime();
             
            // Convert the milli seconds to Days 
            var days = milli_secs / (1000 * 3600 * 24);
            // document.getElementById("ans").innerHTML =
            $("#leave_applies_for").val(Math.round(Math.abs(days))+1);
        }
    </script>
    @endpush