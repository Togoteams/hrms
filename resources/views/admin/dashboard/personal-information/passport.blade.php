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
                                                        @if (!empty($data->passport_no) || !empty($data->omang_no))
                                                            <div class="row text-dark">
                                                                @if (!empty($data->passport_no))
                                                                    <div class="col-3 fw-semibold">Passport No</div>
                                                                    <div class="col-3">{{ $data->passport_no ?? '' }}</div>

                                                                    <div class="col-3 fw-semibold">Passport Expiry</div>
                                                                    <div class="col-3">
                                                                        {{ !empty($data->passport_expiry) ? date_format(date_create_from_format('Y-m-d', $data->passport_expiry), 'd/m/Y') : '' }}
                                                                    </div>
                                                                @endif
                                                                {{-- <br><br> --}}

                                                                @if (!empty($data->omang_no))
                                                                    <div class="col-3 fw-semibold">OMANG No</div>
                                                                    <div class="col-3">{{ $data->omang_no ?? '' }}</div>

                                                                    <div class="col-3 fw-semibold">OMANG Expiry</div>
                                                                    <div class="col-3">
                                                                        {{ !empty($data->omang_expiry) ? date_format(date_create_from_format('Y-m-d', $data->omang_expiry), 'd/m/Y') : '' }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @else
                                                            No data to show
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    <div class="pt-2">
                                                        <!-- Your content for right div goes here -->
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
                                                    </div>
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
                                <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}/ OMANG</h5>
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
                                        <div class="mb-2 col-sm-6 passport_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="passport_no">Passport No.</label>
                                                <input id="passport_no" placeholder="Enter Passport No." type="number"
                                                    value="{{ $data->passport_no ?? '' }}" name="passport_no"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6 passport_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="passport_expiry">Passport Expiry</label>
                                                <input id="passport_expiry" placeholder="Enter Date of Passport Expiry"
                                                    type="date" value="{{ $data->passport_expiry ?? '' }}"
                                                    name="passport_expiry" class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6 omang_data" style="display: none;">
                                            <div class="form-group">
                                                <label for="omang_no">OMANG No.</label>
                                                <input id="omang_no" placeholder="Enter omang No." type="number"
                                                    value="{{ $data->omang_no ?? '' }}" name="omang_no"
                                                    class="form-control form-control-sm ">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-sm-6 omang_data" style="display: none;">
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
<script>
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
   </script>
@endpush

