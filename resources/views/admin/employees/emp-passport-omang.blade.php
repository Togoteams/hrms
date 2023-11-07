@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <span class="name-title">Employee Form</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.passportOmang.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="p-3 pb-4 row text-dark">
                                            <div class="mb-2 col-sm-3">
                                                <div class="form-group">
                                                    <label for="type" >Type</label>
                                                    <select name="type" class=" form-control" id="type" placeholder="Employee type">
                                                        <option value="">Select Option</option>
                                                        <option value="passport" {{ old('type', ($employee->passportOmang->type ?? '') == 'passport' ? 'selected' : '') }}>Passport</option>
                                                        <option value="omang" {{ old('type', ($employee->passportOmang->type ?? '') == 'omang' ? 'selected' : '') }}>OMANG</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-sm-3 passport_data">
                                                <div class="form-group">
                                                    <label for="certificate_no" id="certificate_no_label">Passport No.</label>
                                                    <input id="certificate_no" data-placeholder-passport="Enter Passport No." data-placeholder-omang="Enter OMANG No." type="text"
                                                        placeholder="Enter Passport No." 
                                                        value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->certificate_no : '') : '' }}" name="certificate_no"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="mb-2 col-sm-3 passport_data">
                                                <div class="form-group">
                                                    <label for="certificate_issue_date" id="certificate_issue_date_label">Passport Issue</label>
                                                    <input id="certificate_issue_date" data-placeholder-passport-issue="Enter Passport Issue" data-placeholder-omang-issue="Enter OMANG Issue"
                                                        placeholder="Enter Passport Issue" type="date"
                                                        value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->certificate_issue_date : '') : '' }}"
                                                        name="certificate_issue_date" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-2 col-sm-3 passport_data">
                                                <div class="form-group">
                                                    <label for="certificate_expiry_date" id="certificate_expiry_date_label">Passport Expiry</label>
                                                    <input id="certificate_expiry_date" data-placeholder-passport-expiry="Enter Passport Expiry" data-placeholder-omang-expiry="Enter OMANG Expiry"
                                                        placeholder="Enter Passport Expiry" type="date"
                                                        value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->certificate_expiry_date : '') : '' }}"
                                                        name="certificate_expiry_date" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="mb-2 col-sm-3 country_data">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <select name="country" id="country" class="form-control form-control-sm" required>
                                                        <option value="">- Select -</option>
                                                        @foreach ($countries as $country)
                                                            <option value="{{ $country->name }}"
                                                                {{ $employee && $employee->passportOmang && $employee->passportOmang->country == $country->name ? 'selected' : '' }}>
                                                                {{ $country->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="pt-5 text-center">
                                                <button type="submit" class="btn btn-white btn-sm">SUBMIT</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- End Stats -->
                    </div>

    </main>
@endsection
@push('custom-scripts')
<script>
   $(document).ready(function () {
    var typeSelect = $('#type');
    var certificateNoInput = $('#certificate_no');
    var issueDateInput = $('#certificate_issue_date');
    var expiryDateInput = $('#certificate_expiry_date');

    var certificateNoLabel = $('#certificate_no_label');
    var issueDateLabel = $('#certificate_issue_date_label');
    var expiryDateLabel = $('#certificate_expiry_date_label');

    var defaultPlaceholderNo = certificateNoInput.attr('placeholder');
    var defaultPlaceholderIssue = issueDateInput.attr('placeholder');
    var defaultPlaceholderExpiry = expiryDateInput.attr('placeholder');

    typeSelect.on('change', function () {
        var selectedType = $(this).val();

        if (selectedType === 'omang') {
            certificateNoLabel.text('OMANG No.');
            certificateNoInput.attr('placeholder', certificateNoInput.data('placeholder-omang'));
            issueDateLabel.text('OMANG Issue');
            issueDateInput.attr('placeholder', issueDateInput.data('placeholder-omang-issue'));
            expiryDateLabel.text('OMANG Expiry');
            expiryDateInput.attr('placeholder', expiryDateInput.data('placeholder-omang-expiry'));
        } else if (selectedType === 'passport') {
            certificateNoLabel.text('Passport No.');
            certificateNoInput.attr('placeholder', certificateNoInput.data('placeholder-passport'));
            issueDateLabel.text('Passport Issue');
            issueDateInput.attr('placeholder', issueDateInput.data('placeholder-passport-issue'));
            expiryDateLabel.text('Passport Expiry');
            expiryDateInput.attr('placeholder', expiryDateInput.data('placeholder-passport-expiry'));
        } else {
            certificateNoLabel.text('Passport No.');
            certificateNoInput.attr('placeholder', defaultPlaceholderNo);
            issueDateLabel.text('Passport Issue');
            issueDateInput.attr('placeholder', defaultPlaceholderIssue);
            expiryDateLabel.text('Passport Expiry');
            expiryDateInput.attr('placeholder', defaultPlaceholderExpiry);
        }
    });

    typeSelect.trigger('change');
});

</script>






@endpush
