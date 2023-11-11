{{-- Model --}}
<form id="form_edit" action="{{ route('admin.currency_settings.update', $currency->id) }}">
    @csrf
    <input type="hidden" name="_method" value="PUT">
    <input type="hidden" name="updated_at" value="{{ date('Y-m-d h:s:i') }}">

    <div class="row">
        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="currency_name_from" class="required">Currency Name From</label>
                <select name="currency_name_from" id="currency_name_from" class="form-control">
                    <option value="">Select Currency Name From</option>
                    <option value="usd" @if ($currency->currency_name_from == 'USD') selected @endif>USD</option>
                    <option value="pula" @if ($currency->currency_name_from == 'PULA') selected @endif>PULA</option>
                </select>
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="currency_amount_from" class="required">Currency Amount From</label>
                <input type="text" maxlength="7" minlength="3" pattern="[0-9]+" required
                    name="currency_amount_from" id="currency_amount_from" value="{{ $currency->currency_amount_from }}"
                    class="form-control" placeholder="Enter Currency Amount From">
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="currency_name_to" class="required">Currency Name To</label>
                <select name="currency_name_to" id="currency_name_to" class="form-control">
                    <option value="">Select Currency Name To</option>
                    <option value="usd" @if ($currency->currency_name_to == 'usd') selected @endif>USD</option>
                    <option value="pula" @if ($currency->currency_name_to == 'pula') selected @endif>PULA</option>
                </select>
            </div>
        </div>

        <div class="mb-2 col-sm-6">
            <div class="form-group">
                <label for="currency_amount_to" class="required">Currency Amount To</label>
                <input type="text" required maxlength="7" minlength="3" pattern="[0-9]+" name="currency_amount_to"
                    id="currency_amount_to" value="{{ $currency->currency_amount_to }}" class="form-control"
                    placeholder="Enter Currency Amount To">
            </div>
        </div>
    </div>
    <hr>
    <div class="text-center ">
        <button onclick="ajaxCall('form_edit','','POST')" type="button" class="btn btn-white">Update
            {{ $page }}</button>
    </div>
</form>
