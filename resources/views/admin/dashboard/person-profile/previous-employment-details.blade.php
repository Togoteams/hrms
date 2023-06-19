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
                    <span class="name-title">Person Profile</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.person-profile.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary btn-sm"
                                                onclick="addForm({{ Auth::user()->id }})">
                                                Add Previous Employment
                                            </button>
                                        </div>
                                    </div>
                                    @foreach ($datas as $key => $data)
                                        <div class="row">
                                            <div class="col-xl-12 col-xxl-10 pb-4">
                                                <div class="card p-3">
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <div class="row">
                                                                <div class="col-5 pt-1">Company Name:</div>
                                                                <div class="col-5 pt-1">
                                                                    {{ $data->company_name }}
                                                                </div>

                                                                <div class="col-5 pt-3">Period of employment:</div>
                                                                <div class="col-5 pt-3">
                                                                    {{ date_format(date_create_from_format('Y-m-d', $data->start_date), 'd/m/Y') }}
                                                                    -
                                                                    {{ date_format(date_create_from_format('Y-m-d', $data->end_date), 'd/m/Y') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <div class="right-div">
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm bt editButton"
                                                                    title="Edit" data-id="{{ $data->id }}"
                                                                    data-user_id="{{ Auth::user()->id }}"
                                                                    data-company_name="{{ $data->company_name }}"
                                                                    data-start_date="{{ $data->start_date }}"
                                                                    data-end_date="{{ $data->end_date }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

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
                                                <label for="passport_no">Company Name </label>
                                                <input type="text" id="company_name" name="company_name"
                                                    placeholder="Enter Insurance Company Name"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="form-group">
                                                <label for="">Period of employment </label>
                                                <input required value="" id="start_date" name="start_date"
                                                    placeholder="Start Year" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <label for=""></label>
                                            <input required value="" id="end_date" name="end_date"
                                                placeholder="End Year" type="date" class="form-control form-control-sm">
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="passport_expiry">Period of employment </label>
                                            <div class="form-row">
                                                <div class="col-6 float-start">
                                                    <input required value="" id="start_date" name="start_date"
                                                        placeholder="Start Year" type="date"
                                                        class="form-control form-control-sm">
                                                </div>
                                                <div class="col-6 float-start">
                                                    -
                                                </div>
                                                <div class="col-6 float-start">
                                                    <input required value="" id="end_date" name="end_date"
                                                        placeholder="End Year" type="date"
                                                        class="form-control form-control-sm">
                                                </div>
                                            </div>



                                        </div> --}}
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_add','','POST')" type="button"
                                            class="btn btn-primary" id="btnSave">
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

    @if (!empty(Session::get('success')))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ Session::get('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
        @php
            Session::forget('success');
        @endphp
    @endif

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

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#company_name").val(company_name);
                $("#start_date").val(start_date);
                $("#end_date").val(end_date);
            });
        });
    </script>

@endpush
