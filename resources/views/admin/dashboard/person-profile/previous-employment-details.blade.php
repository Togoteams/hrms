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
                    <span class="name-title">Personal Profile</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content this-div" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-left">
                                            <button type="button" class="btn btn-white btn-sm"
                                                onclick="addForm({{ Auth::user()->id }})">
                                                Add Previous Employment
                                            </button>
                                        </div>
                                    </div>
                                    @if (count($datas) > 0)
                                        @foreach ($datas as $key => $data)
                                            <div class="row">
                                                <div class="pb-4">
                                                    <div class="card p-3">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="col-4 fw-semibold pt-1">Company Name</div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ $data->company_name }}
                                                                    </div>

                                                                    <div class="col-4 fw-semibold pt-1">
                                                                        Period of employment:
                                                                    </div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->start_date), 'd/m/Y') }}
                                                                        -
                                                                        {{ date_format(date_create_from_format('Y-m-d', $data->end_date), 'd/m/Y') }}
                                                                    </div>

                                                                    @if (!empty($data->description))
                                                                        <div class="col-4 fw-semibold pt-1">
                                                                            Description
                                                                        </div>
                                                                        <div class="col-6 pt-1">
                                                                            {{ $data->description }}
                                                                        </div>
                                                                    @endif

                                                                    <div class="col-4 fw-semibold pt-1">Reasons of Leaving</div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ $data->reason }}
                                                                    </div>

                                                                    <div class="col-4 fw-semibold pt-1">Designation</div>
                                                                    <div class="col-6 pt-1">
                                                                        {{ $data->designation->name }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <button type="button"
                                                                        class="btn btn-edit btn-sm bt editButton"
                                                                        title="Edit" data-id="{{ $data->id }}"
                                                                        data-user_id="{{ Auth::user()->id }}"
                                                                        data-company_name="{{ $data->company_name }}"
                                                                        data-start_date="{{ $data->start_date }}"
                                                                        data-end_date="{{ $data->end_date }}"
                                                                        data-reason="{{ $data->reason }}"
                                                                        data-designation_id="{{ $data->designation_id }}"
                                                                        data-description="{{ $data->description }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $data->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.person.profile.previous.employment.details.delete') }}">
                                                                        <i class="fa-solid fa-trash fa-lg"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card p-3 mb-5">No data to show</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>

                {{-- edit form model start --}}
                <!-- Modal -->
                <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="edit">
                                <form id="form_add"
                                    action="{{ route('admin.person.profile.previous.employment.details.post') }}">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" id="user_id" name="user_id">
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="passport_no">Company Name<small
                                                        class="required-field">*</small></label>
                                                <input type="text" id="company_name" name="company_name"
                                                    placeholder="Enter Insurance Company Name"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-group">
                                                <label for="">Period of employment<small
                                                        class="required-field">*</small></label>
                                                <input required value="" id="start_date" name="start_date"
                                                    placeholder="Start Year" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label for=""></label>
                                            <input required value="" id="end_date" name="end_date"
                                                placeholder="End Year" type="date"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label for="reason_of_leaving">Reasons of Leaving</label>
                                            <input required value="" id="reason" name="reason"
                                                placeholder="Enter Reasons of leaving" type="text"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="designation">Designation</label>
                                                <select name="designation_id" class="form-control" id="designation" placeholder="Employee designation">
                                                    <option value="">Select Option</option>
                                                    @foreach($designation as $designationdata)
                                                    <option value="{{ $designationdata->id }}" {{ !empty($data) && $data->designation_id == $designationdata->id ? 'selected' : '' }}>
                                                       {{ $designationdata->name }}
                                                   </option>
                                                   @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea id="description" placeholder="Enter Description..." name="description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_add','','POST')" type="button"
                                            class="btn btn-white" id="btnSave">
                                            Add
                                        </button>
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
        function addForm(user_id) {
            $('#form_add').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $("#modalTitle").html("Add: Previous Employment");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", ".editButton", (event) => {
                $('#formModal').modal('show');
                $("#modalTitle").html("Edit: Previous Employment");
                $("#btnSave").html("Update");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let company_name = $(event.currentTarget).data("company_name");
                let start_date = $(event.currentTarget).data("start_date");
                let end_date = $(event.currentTarget).data("end_date");
                let reason = $(event.currentTarget).data("reason");
                let designation_id = $(event.currentTarget).data("designation_id");
                let description = $(event.currentTarget).data("description");

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#company_name").val(company_name);
                $("#start_date").val(start_date);
                $("#end_date").val(end_date);
                $("#reason").val(reason);
                $("#designation_id").val(designation_id);
                $("#description").val(description);
            });
        });
    </script>

@endpush
