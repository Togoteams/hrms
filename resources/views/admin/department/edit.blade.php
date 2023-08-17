{{-- Model --}}
                       

<form id="form_edit" action="{{ route('admin.department.update',$department->id) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label class="required" for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter department name" value="{{$department->name}}">
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="text-center ">
                            <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
                                {{ $page }}</button>
                        </div>
                    </form>
              