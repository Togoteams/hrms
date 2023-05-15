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
                                        <button class="btn add-btn btn-sm bt" data-bs-toggle="modal"
                                        data-bs-target="#formModal" title="Add">
                                        <i class="bi bi-plus-lg"></i>Add Qualification
                                    </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                    @foreach ($datas as $data)

                                                    <div class="col-xl-6 col-xxl-4 pb-4">
                                                        <div class="card p-3">
                                                            <div class="row">
                                                            <div class="col-10">
                                                                <div class="row">
                                                                <div class="col-6">Exam Name:</div>
                                                                <div class="col-6">{{ $data->exam_name }}</div>

                                                                <div class="col-6">Specialization:</div>
                                                                <div class="col-6">{{ $data->specialization }}</div>

                                                                <div class="col-6">Institute Name:</div>
                                                                <div class="col-6">{{ $data->institute_name }}</div>

                                                                <div class="col-6">University:</div>
                                                                <div class="col-6">{{ $data->university }}</div>

                                                                <div class="col-6">Year of passing:</div>
                                                                <div class="col-6">{{ $data->year_of_passing }}</div>

                                                                <div class="col-6">marks Name:</div>
                                                                <div class="col-6">{{ $data->marks }}</div>
                                                            </div>
                                                            </div>
                                                            <div class="col-1 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->

                                                                    <button class="btn btn-warning btn-sm bt" data-bs-toggle="modal"
                                                                        onclick="editQualification('{{ route('admin.person.profile.qualification.edit', $data->id) }}',
                                                                                                    '{{ route('admin.person.profile.qualification.update') }}')"
                                                                        title="Edit">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
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

                    </div>
                    <!-- End Stats -->
                </div>

                {{-- Add form model start --}}
                <!-- Modal -->
                <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header ">
                                <h5 class="modal-title" id="staticBackdropLabel">Add Qualification</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="add">
                                <form id="form_id" action="{{ route('admin.person.profile.qualification.add') }}">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="">
                                    <input type="hidden" name="user_id" id="user_id" value="{{ $datas[0]->user_id }}">

                                    <div class="row">
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="exam_name">Exam Name</label>
                                                <input required id="exam_name" placeholder="Enter exam name" type="text"
                                                    name="exam_name" class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="specialization">Specialization</label>
                                                <input required id="specialization" placeholder="Enter specialization"
                                                    type="text" name="specialization" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="institute_name">Institute Name</label>
                                                <input required id="institute_name" placeholder="Enter institute name"
                                                    type="text" name="institute_name" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="university">University</label>
                                                <input required id="university" placeholder="Enter university"
                                                    type="text" name="university" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="year_of_passing">Year of Passing </label>
                                                <input required id="year_of_passing" placeholder="Enter year of passing"
                                                    type="text" name="year_of_passing"
                                                    class="form-control form-control-" value="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-2">
                                            <div class="form-group">
                                                <label for="marks">Marks(%)</label>
                                                <input required id="marks" placeholder="Enter marks in percentage"
                                                    type="text" name="marks" class="form-control form-control-"
                                                    value="">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center ">
                                        <button onclick="ajaxCall('form_id','','POST')" type="button"
                                            class="btn btn-primary" id="buttonName">Add Qualification
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
        function editQualification(editURL, updateURL) {
            $('#formModal').trigger("reset");
            $.ajax({
                url: editURL,
                method: "GET",
                contentType: 'application/json',
                dataType: "json",
                success: function(data) {
                    $('#id').val(data.data.id);
                    $('#exam_name').val(data.data.exam_name);
                    $('#specialization').val(data.data.specialization);
                    $('#institute_name').val(data.data.institute_name);
                    $('#university').val(data.data.university);
                    $('#year_of_passing').val(data.data.year_of_passing);
                    $('#marks').val(data.data.marks);
                }
            });
            $("#buttonName").html("Edit Qualification");
            $('#formModal').modal('show');
            $('#form_id').attr('action', updateURL);
        }
    </script>
@endpush
