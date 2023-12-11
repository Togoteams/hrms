{{-- Model --}}


<form id="form_edit" action="{{ route('admin.medical-card.update', $medical->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="mb-12 col-sm-12">
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control"
                    placeholder="Enter medical card name" value="{{ $medical->name }}">
            </div>
        </div>

        <div class="mb-6 col-sm-6">
            <div class="form-group">
                <label for="currency" class="required">Currency</label>
                <select name="currency" id="currency" class="form-control">  
                    <option value="" >--select--</option>   
                    @foreach ($currencies as $currency)
                        <option value="{{$currency['slug']}}" @if($medical->currency==$currency['slug']) {{"selected"}} @endif>{{$currency['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-6 col-sm-6">
            <div class="form-group">
                <label for="amount" class="required">Amount</label>
                <input type="text" required maxlength="7" minlength="3" pattern="[0-9]+" name="amount"
                    id="amount" class="form-control" placeholder="Enter amount of medical card"
                    value="{{ $medical->amount }}">
            </div>
        </div>


        <div class="mb-12 col-sm-12">
            <div class="form-group">
                <label for="description" class="required">Description</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Description...">{{ $medical->description }}</textarea>
            </div>
        </div>

    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
