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
                    <span class="name-title">Personal Information: Address</span>
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
                                                    @if (!empty($data))
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Address Type</div>
                                                                    <div class="col-3">
                                                                        {{ ucwords(str_replace('_', ' ', $data->address_type)) }}
                                                                    </div>



                                                                    <div class="col-3 fw-semibold">
                                                                        @if ($data->address_type == 'postal_address' || $data->address_type == 'permanent')
                                                                            Plot Number
                                                                        @else
                                                                            PO Box
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-3">{{ ucfirst($data->post_box) }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">State</div>
                                                                    <div class="col-3">{{ ucfirst($data->state) }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Country</div>
                                                                    <div class="col-3">
                                                                        {{ $data->country }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Address</div>
                                                                    <div class="col-9">{{ ucfirst($data->address) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    <button class="btn btn-edit btn-sm bt" title="Edit"
                                                                        id="editButton" data-id="{{ $data->id }}"
                                                                        data-address_type="{{ $data->address_type }}"
                                                                        data-address="{{ $data->address }}"
                                                                        data-post_box="{{ $data->post_box }}"
                                                                        data-city="{{ $data->city }}"
                                                                        data-state="{{ $data->state }}"
                                                                        data-country="{{ $data->country }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    {{-- <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $data->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.employee.address.delete') }}">

                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button> --}}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        No data to show
                                                    @endif
                                                </div>
                                                <div class="col-md-2 text-end">
                                                    
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
               
    </main>
    {{-- Add form model start --}}
    <!-- Modal -->
    <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header ">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="add">
                    <form id="form_id" class="formsubmit" method="post"
                        action="{{ route('admin.personal.info.address.post') }}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" id="user_id">

                        <div class="row">
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="address_type">Address Type<small class="required-field">*</small></label>
                                    <select id="address_type" placeholder="Enter Address Type" type="text"
                                        name="address_type" class="form-control form-control-sm">
                                        <option disabled>--select--</option>
                                        <option value="present">Present</option>
                                        <option value="permanent">Permanent</option>
                                        <option value="postal_address">Postal Address</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="post_box" id="po_box_lable"><span>Plot Number</span></label>
                                    <input id="post_box" placeholder="Enter Plot Number" type="text" name="post_box"
                                        class="form-control form-control-sm" value="">
                                </div>
                            </div>

                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="city">City<small class="required-field">*</small></label>
                                    <input id="city" placeholder="Enter city" type="text" name="city"
                                        class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="state">State<small class="required-field">*</small></label>
                                    <input id="state" placeholder="Enter state " type="text" name="state"
                                        class="form-control form-control-sm" value="">
                                </div>
                            </div>
                            <div class="mb-2 col-sm-6">
                                <div class="form-group">
                                    <label for="country">Country<small class="required-field">*</small></label>
                                    <select name="country" id="country" class="form-control form-control-sm" required>
                                        <option value="">- Select -</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->name }}">
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2 col-sm-12">
                                <div class="form-group">
                                    <label for="address">address<small class="required-field">*</small></label>
                                    <textarea id="address" placeholder="Enter Address" name="address" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center ">
                            <button type="submit" class="btn btn-white" id="btnSave">
                            </button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
@push('custom-scripts')
    <script>
        $(document).ready(() => {
            $(document).on("click", "#editButton", (event) => {
                $('#form_id').trigger("reset");
                $("#modalTitle").html("Edit: Address");
                $("#btnSave").html("UPDATE");

                let id = $(event.currentTarget).data("id");
                let country = $(event.currentTarget).data("country");
                let address = $(event.currentTarget).data("address");
                let post_box = $(event.currentTarget).data("post_box");
                let city = $(event.currentTarget).data("city");
                let state = $(event.currentTarget).data("state");

                $("#id").val(id);
                $("#country").val(country);
                $("#address").val(address);
                $("#post_box").val(post_box);
                $("#city").val(city);
                $("#state").val(state);

                $('#formModal').modal('show');
            });
            $(document).on("change", "#address_type", (event) => {
                var addressType = $("#address_type").val();
                console.log(addressType);
                if (addressType == "postal_address") {
                    console.log("PO");
                    $("#po_box_lable").text("PO Box");
                    $("#post_box").attr("placeholder", "Enter PO Box Number");
                } else {
                    console.log("Plot");
                    $("#po_box_lable").text("Plot Number");
                    $("#post_box").attr("placeholder", "Enter Plot Number");

                }
            });
        });
    </script>
@endpush
