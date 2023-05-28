    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
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
                                        <label for="user_id">Employee </label>
                                        <select
                                            onchange="selectDrop('form_data','{{ route('admin.leave_apply.get_encash_leave') }}', 'leave_type_id')"
                                            required id="user_id" placeholder="Enter correct user_id   "
                                            type="text" name="user_id" class="form-control form-control-sm ">
                                            <option selected disabled> -Select User - </option>
                                            @foreach ($all_user as $user)
                                                <option value="{{ $user->user->id }}">{{ $user->user->name }} -
                                                    {{ $user->user->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="leave_type_id">Leave Types </label>
                                    <select required id="leave_type_id"
                                        onchange=" selectDrop('form_data','{{ route('admin.leave_encashment.get_balance_encah_leave') }}', 'balance_leave1')"
                                        placeholder="Enter correct leave_type_id   " type="text" name="leave_type_id"
                                        class="form-control form-control-sm ">
                                        <option selected disabled> -Select Leave Types- </option>
                                        @foreach ($leave_type as $l_type)
                                            @if (islocal() && $l_type->name == 'EARNED LEAVE' && $l_type->leave_for == 'local')
                                                <option value="{{ $l_type->id }}">{{ $l_type->name }}</option>
                                            @elseif ($l_type->name == 'PRIVILEGED LEAVE' && $l_type->leave_for != 'local')
                                                <option value="{{ $l_type->id }}">{{ $l_type->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="balance_leave1">balance_leave </label>
                                    <input   required id="balance_leave1"
                                     {{ isemplooye()? "readonly" : ""}}   placeholder="Enter correct balance_leave" type="text" name="no_of_days"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="description">description </label>
                                    <textarea rows="12" required id="description" placeholder="Enter correct description   " name="description"
                                        class="form-control form-control-sm "></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center ">
                            <button type="button" onclick="ajaxCall('form_data')" class="btn btn-primary">
                                {{ $page }}</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
