{{-- Model --}}
<form id="form_edit" action="{{ route('admin.account.update',$account->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="account_number" class="required">Account Number</label>
                <input type="text" required name="account_number" id="account_number" class="form-control" placeholder="Enter Account Number" value="{{$account->account_number}}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="name" class="required">Account Name</label>
                <input type="text" required name="name" id="name" class="form-control" placeholder="Enter Account Name" value="{{$account->name}}">
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="opening_amount" class="required">Opening Amount</label>
                <input type="number" required name="opening_amount" id="opening_amount" class="form-control" placeholder="Enter Opening Amount" value="{{$account->opening_amount}}">
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="closing_amount" class="required">Closing Amount</label>
                <input type="number" required name="closing_amount" id="closing_amount" class="form-control" placeholder="Enter Closing Amount" value="{{$account->closing_amount}}">
            </div>
        </div>
       
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="account_type">Account Type</label>
                <select name="account_type" class="form-control" id="account_type">
                    <option value="">Select Option</option>
                    <option value="nominal account" {{ $account->account_type === 'nominal account' ? 'selected' : '' }}>Nominal Account</option>
                    <option value="assets account" {{ $account->account_type === 'assets account' ? 'selected' : '' }}>Assets Account</option>
                </select>
            </div>
        </div>

        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description" class="required">Description</label>
                 <textarea  class="form-control" name="description" id="description" cols="20" rows="5" required>{{$account->description}}</textarea>    
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
