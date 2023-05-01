    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $page }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_data" action="{{ route('admin.leave_encashment.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">


                        <div class="row">

                            @if (!isemplooye())
                                <div class="col-sm-6 mb-2">
                                    <div class="form-group">
                                        <label for="user_id"> </label>
                                        <select required id="user_id" placeholder="Enter correct user_id   "
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



                            <div class="col-sm-6 mb-2">
                                <div class="form-group">
                                    <label for="no_of_days">no_of_days.. </label>
                                    <input required id="no_of_days" placeholder="Enter correct no_of_days..   "
                                        type="text" value="{{ '0' }}" name="no_of_days"
                                        class="form-control form-control-sm ">
                                </div>
                            </div>

                            <div class="col-sm-12 mb-2">
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
