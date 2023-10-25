@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xxl-9 col-xl-8 border border-1 border-color rounded  mx-3">

                                <div class="tab-content" id="v-pills-tabContent">

                                    <div class=" ">
                                        <div class="container mt-2 mb-2 ms-1">
                                            <div class="row">
                                                <div class="col-md-10 py-4">
                                                    <div class="left-div">
                                                        <div class="tab-content" id="v-pills-tabContent">
                                                                <form id="form_edit" action="{{ route('admin.personal.info.passport.update') }}">
                                                                @csrf
                                                                <input type="hidden" name="id"
                                                                    value="{{ $data ? ( $data->id) : '' }}">
                                                                <input type="hidden" name="user_id"
                                                                    value="{{ !empty($data) ? $data->user_id : '' }}">
                        
                                                                <div class="p-3 pb-4 row text-dark">
                                                                    <div class="mb-2 col-sm-3">
                                                                        <div class="form-group">
                                                                            <label for="type" class="required">Type</label>
                                                                            <select name="type" class=" form-control" id="type" placeholder="Employee type">
                                                                                <option value="">Select Option</option>
                                                                                <option value="passport" {{ $data->type == 'passport' ? 'selected' : '' }}>Passport</option>
                                                                                <option value="omang" {{ $data->type == 'omang' ? 'selected' : '' }}>Omang</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                        <div class="mb-2 col-sm-3 passport_data">
                                                                            <div class="form-group">
                                                                                <label for="certificate_no">Passport No.</label>
                                                                                <input id="certificate_no" placeholder="Enter Passport No." type="number"
                                                                                    value="{{ $data ? ($data->certificate_no) : '' }}" name="certificate_no"
                                                                                    class="form-control form-control-sm ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2 col-sm-3 passport_data">
                                                                            <div class="form-group">
                                                                                <label for="certificate_issue_date">Passport Issue</label>
                                                                                <input id="certificate_issue_date" placeholder="Enter Passport Expiry"
                                                                                    type="date" value="{{ $data ? ($data->certificate_issue_date) : '' }}"
                                                                                    name="certificate_issue_date" class="form-control form-control-sm ">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-2 col-sm-3 passport_data">
                                                                            <div class="form-group">
                                                                                <label for="certificate_expiry_date">Passport Expiry</label>
                                                                                <input id="certificate_expiry_date" placeholder="Enter Passport Expiry"
                                                                                    type="date" value="{{ $data ? ($data->certificate_expiry_date) : '' }}"
                                                                                    name="certificate_expiry_date" class="form-control form-control-sm ">
                                                                            </div>
                                                                        </div>
                                                                    <div class="mb-2 col-sm-3 country_data">
                                                                        <div class="form-group">
                                                                            <label for="country">Country</label>
                                                                            <input id="country" placeholder="Enter Country"
                                                                                type="text" value="{{ $data ? ($data->country) : '' }}"
                                                                                name="country" class="form-control form-control-sm ">
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
                                    <div class="row">
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="type" class="required">Type</label>
                                                <select name="type" class="type form-control" id="type" placeholder="Employee type">
                                                    <option value="">Select Option</option>
                                                    <option value="passport" @if(old('type', $data->type) === 'passport') selected @endif>Passport</option>
                                                    <option value="omang" @if(old('type', $data->type) === 'omang') selected @endif>OMANG</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 passport_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="passport_no">Passport No.</label>
                                                <input id="passport_no" placeholder="Enter Passport No." type="number"
                                                    value="{{ $data->passport_no ?? '' }}" name="passport_no"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 passport_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="passport_expiry">Passport Expiry</label>
                                                <input id="passport_expiry" placeholder="Enter Date of Passport Expiry"
                                                    type="date" value="{{ $data->passport_expiry ?? '' }}"
                                                    name="passport_expiry" class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 omang_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="omang_no">OMANG No.</label>
                                                <input id="omang_no" placeholder="Enter omang No." type="number"
                                                    value="{{ $data->omang_no ?? '' }}" name="omang_no"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2 omang_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="omang_expiry">OMANG Expiry</label>
                                                <input id="omang_expiry" placeholder="Enter Date of OMANG Expiry"
                                                    type="date" value="{{ $data->omang_expiry ?? '' }}"
                                                    name="omang_expiry" class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                    </div>
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
{{-- <script>
    $(document).ready(function(){
      $('.type').change(function(){
              var type = $(this).val();
              if(type == "omang"){
                   $('.passport_data').hide();
                   $('.omang_data').show();
              }else if (type === "passport"){
                   $('.passport_data').show();
                   $('.omang_data').hide();
              }
         });
   });
   </script> --}}
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

