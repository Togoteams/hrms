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
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <form id="form_id" class="formsubmit" method="post"
                                        action="{{ route('admin.employee.passportOmang.post') }}">
                                        @csrf
                                        <input type="hidden" name="id"
                                            value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->id : '') : '' }}">
                                        <input type="hidden" name="user_id"
                                            value="{{ !empty($employee) ? $employee->user_id : '' }}">

                                        <div class="row pb-4 p-3 text-dark">
                                            <div class="mb-2 col-sm-3">
                                                <div class="form-group">
                                                    <label for="type" class="required">Type</label>
                                                    <select name="type" class=" form-control" id="type" placeholder="Employee type">
                                                        <option value="">Select Option</option>
                                                        <option value="passport" {{ old('type', ($employee->passportOmang->type ?? '') == 'passport' ? 'selected' : '') }}>Passport</option>
                                                        <option value="omang" {{ old('type', ($employee->passportOmang->type ?? '') == 'omang' ? 'selected' : '') }}>OMANG</option>
                                                    </select>
                                                </div>
                                            </div>
                                                <div class="col-sm-3 mb-2 passport_data">
                                                    <div class="form-group">
                                                        <label for="certificate_no">Passport No.</label>
                                                        <input id="certificate_no" placeholder="Enter Passport No." type="number"
                                                            value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->certificate_no : '') : '' }}" name="certificate_no"
                                                            class="form-control form-control-sm ">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 mb-2 passport_data">
                                                    <div class="form-group">
                                                        <label for="certificate_issue_date">Passport Issue</label>
                                                        <input id="certificate_issue_date" placeholder="Enter Date of Passport Expiry"
                                                            type="date" value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->certificate_issue_date : '') : '' }}"
                                                            name="certificate_issue_date" class="form-control form-control-sm ">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 mb-2 passport_data">
                                                    <div class="form-group">
                                                        <label for="certificate_expiry_date">Passport Expiry</label>
                                                        <input id="certificate_expiry_date" placeholder="Enter Date of Passport Expiry"
                                                            type="date" value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->certificate_expiry_date : '') : '' }}"
                                                            name="certificate_expiry_date" class="form-control form-control-sm ">
                                                    </div>
                                                </div>
                                            <div class="col-sm-3 mb-2 country_data">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <input id="country" placeholder="Enter Country Name"
                                                        type="text" value="{{ $employee ? ($employee->passportOmang ? $employee->passportOmang->country : '') : '' }}"
                                                        name="country" class="form-control form-control-sm ">
                                                </div>
                                            </div>

                                            <div class="text-center pt-5">
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
        // Get references to relevant elements
        var typeSelect = $('#type');
        var labelCertificateNo = $('label[for="certificate_no"]');
        var labelCertificateIssueDate = $('label[for="certificate_issue_date"]');
        var labelCertificateExpiryDate = $('label[for="certificate_expiry_date"]');

        // Initial label texts
        var defaultLabelTexts = {
            certificateNo: labelCertificateNo.text(),
            certificateIssueDate: labelCertificateIssueDate.text(),
            certificateExpiryDate: labelCertificateExpiryDate.text()
        };

        // Change label texts based on selected type
        typeSelect.on('change', function () {
            var selectedType = $(this).val();
            if (selectedType === 'omang') {
                labelCertificateNo.text('OMANG No.');
                labelCertificateIssueDate.text('OMANG Issue');
                labelCertificateExpiryDate.text('OMANG Expiry');
            } else if (selectedType === 'passport') {
                labelCertificateNo.text('Passport No.');
                labelCertificateIssueDate.text('Passport Issue');
                labelCertificateExpiryDate.text('Passport Expiry');
            } else {
                labelCertificateNo.text(defaultLabelTexts.certificateNo);
                labelCertificateIssueDate.text(defaultLabelTexts.certificateIssueDate);
                labelCertificateExpiryDate.text(defaultLabelTexts.certificateExpiryDate);
            }
        });

        // Trigger the change event initially
        typeSelect.trigger('change');
    });
</script>


@endpush
