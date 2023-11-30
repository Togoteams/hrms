{{-- Model --}}
<form id="form_edit" action="{{ route('admin.account.update', $account->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="account_number" class="required">Account Number</label>
                <input type="text" required pattern="[0-9]+" maxlength="16" minlength="12" name="account_number"
                    id="account_number" class="form-control" placeholder="Enter Account Number"
                    value="{{ $account->account_number }}">
            </div>
        </div>
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="name" class="required">Account Name</label>
                <input type="text" required name="name" id="name" class="form-control"
                    placeholder="Enter Account Name" value="{{ $account->name }}">
            </div>
        </div>



        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="account_type">Account Type</label>
                <select name="account_type" class="form-control" id="account_type">
                    <option value="">Select Option</option>
                    <option value="employee"
                        {{ $account->account_type === 'employee' ? 'selected' : '' }}>Employee</option>
                    <option value="office" {{ $account->office === 'office' ? 'selected' : '' }}>
                        Office</option>
                </select>
            </div>
        </div>

        <div class="mb-2 col-sm-12">
            <div class="form-group">
                <label for="description" class="required">Description</label>
                <textarea class="form-control" name="description" id="description" cols="20" rows="5" required>{{ $account->description }}</textarea>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
