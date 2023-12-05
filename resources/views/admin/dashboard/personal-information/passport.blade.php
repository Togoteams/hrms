@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xxl-9 col-xl-8 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class="">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <div class="row">
                                                <div class="py-4 col-md-10">
                                                    <div class="left-div">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                                <form id="form_edit" action="{{ route('admin.personal.info.passport.update') }}">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $data ? ( $data->id) : '' }}">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ !empty($data) ? $data->user_id : auth()->user()->id }}">
                        
                                                                <div class="p-3 pb-4 text-dark">
                                                                    <div class="row">
                                                                        <div class="mb-2 col-sm-3">
                                                                            <div class="form-group">
                                                                                <label for="type" >Type</label>
                                                                                <select name="type" class=" form-control" id="type" placeholder="Employee type">
                                                                                    <option value="">Select Option</option>
                                                                                    <option value="passport" @if($data && $data->type === 'passport') selected @endif>Passport</option>
                                                                                    <option value="omang" @if($data && $data->type === 'omang') selected @endif>OMANG</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2 col-sm-3 passport_data">
                                                                            <div class="form-group">
                                                                                <label for="certificate_no" id="certificate_no_label">Passport No.</label>
                                                                                <input id="certificate_no" data-placeholder-passport="Enter Passport No."
                                                                                 data-placeholder-omang="Enter OMANG No." type="text"
                                                                                 maxlength="12"
                                                                                 minlength="8"
                                                                                    placeholder="Enter Passport No."
                                                                                    value="{{ $data->certificate_no ?? '' }}" name="certificate_no"
                                                                                    class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                
                                
                                                                        <div class="mb-2 col-sm-3 passport_data">
                                                                            <div class="form-group">
                                                                                <label for="certificate_issue_date" id="certificate_issue_date_label">Passport Issue</label>
                                                                                <input id="certificate_issue_date" data-placeholder-passport-issue="Enter Passport Issue" data-placeholder-omang-issue="Enter OMANG Issue"
                                                                                    placeholder="Enter Passport Issue" type="date"
                                                                                    value="{{ $data->certificate_issue_date ?? '' }}"
                                                                                    name="certificate_issue_date" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                
                                                                        <div class="mb-2 col-sm-3 passport_data">
                                                                            <div class="form-group">
                                                                                <label for="certificate_expiry_date" id="certificate_expiry_date_label">Passport Expiry</label>
                                                                                <input id="certificate_expiry_date" data-placeholder-passport-expiry="Enter Passport Expiry" data-placeholder-omang-expiry="Enter OMANG Expiry"
                                                                                    placeholder="Enter Passport Expiry" type="date"
                                                                                    value="{{ $data->certificate_expiry_date ?? '' }}"
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
                                                                                            {{ $data && $data->country == $country->name ? 'selected' : '' }}>
                                                                                            {{ $country->name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center ">
                                                                        <button onclick="ajaxCall('form_edit','','POST')" type="button"
                                                                            class="btn btn-white">Update
                                                                            {{ $page }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    {{-- <div class="pt-2">
                                                        @if (!empty($data->id))
                                                            <button class="btn btn-edit btn-sm bt" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="btn btn-white btn-sm"
                                                                title="Add" data-bs-toggle="modal"
                                                                data-bs-target="#modaledit">
                                                                Add
                                                            </button>
                                                        @endif
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>
                {{-- edit form model start --}}
                <!-- Modal -->
                <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}/OMANG</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="edit">
                                <form id="form_edit" action="{{ route('admin.personal.info.passport.update') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ !empty($data) ? $data->id : '' }}">
                                    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                   
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_edit','','POST')" type="button"
                                            class="btn btn-white">Update
                                            {{ $page }}</button>
                                    </div>
                                </form>

                            </div>

                        </div>
                    </div>
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
        console.log(selectedType);
        if (selectedType === 'omang') {
            console.log(selectedType,"omng");
            certificateNoLabel.text('OMANG No.');
            certificateNoInput.attr('placeholder', certificateNoInput.data('placeholder-omang'));
            issueDateLabel.text('OMANG Issue');
            issueDateInput.attr('placeholder', issueDateInput.data('placeholder-omang-issue'));
            expiryDateLabel.text('OMANG Expiry');
            expiryDateInput.attr('placeholder', expiryDateInput.data('placeholder-omang-expiry'));
        } else if (selectedType === 'passport') {
            console.log(selectedType,"Passport");
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

