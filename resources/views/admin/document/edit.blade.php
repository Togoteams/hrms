<form id="form_edit" action="{{ route('admin.document.update', $data->id) }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="document_name" class="required">Document Name</label>
                <input required id="document_name" placeholder="Enter Document Name of Document" min="1" max="100" type="text"
                    name="document_name" class="form-control form-control-sm " value="{{$data->document_name}}">
            </div>
        </div>
     
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="document_type" class="required">Document Type</label>
                <select required id="document_type"  name="document_type" class="form-control form-control-sm">
                    <option value="">Select Document Type </option>
                    <option @if($data->document_type=="onbording") {{"selected"}} @endif value="onbording">Onbording</option>
                    <option  @if($data->document_type=="other") {{"select"}} @endif value="other">Other</option>
                </select>
            </div>
        </div>
       
        {{-- <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="current_document" class="required">Current Document</label> <br>
                <img src="{{asset('asset/img/'.$data->document)}}" alt="image" width="70px" height="70px">
            </div>
        </div> --}}
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="current_document" class="required">Current Document</label> <br>
                @if (in_array(pathinfo(asset('asset/img/'.$data->document), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                    <img src="{{ asset('asset/img/'.$data->document) }}" alt="image" width="70px" height="70px">
                @elseif (in_array(pathinfo(asset('asset/img/'.$data->document), PATHINFO_EXTENSION), ['pdf']))
                    <a href="{{ asset('asset/img/'.$data->document) }}" target="_blank">
                        <img src="{{ asset('asset/img/') }}" alt="{{$data->document}}" width="70px" height="70px">
                    </a>
                @endif
            </div>
        </div>
        
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="document">Replace Document</label>
                <input id="document" type="file" name="document"class="form-control form-control-sm">
            </div>
        </div>
        

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>