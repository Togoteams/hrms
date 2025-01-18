@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <span class="name-title">Insuarance Details of {{ !empty($employee) ? $employee->user->name : '' }}</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-2 border-1 border-color">
                                @include('admin.employees.add-aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-9 col-xxl-9 border-1 border-color">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">

                                            <button type="button" class="btn btn-white btn-sm"
                                                title="Add Emp Medical Insuarance"
                                                onclick="addInsurance({{ !empty($employee) ? $employee->user_id : '' }})">
                                                Add Medical Insuarance
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row this-div">

                                        @if (!empty($medicalInsuarances))
                                            @forelse  ($medicalInsuarances as $medicalInsuarance)
                                                <div class="pb-4">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-10">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold">Insurances Date
                                                                    </div>
                                                                    <div class="col-3">
                                                                        {{ date("d-m-Y",strtotime($medicalInsuarance->medical_insurances_date)) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Insurance Montly Charge
                                                                    </div>
                                                                    <div class="col-3">
                                                                        {{ $medicalInsuarance->amount }}
                                                                    </div>

                                                                    <div class="col-3 fw-semibold">Company Name</div>
                                                                    <div class="col-3">
                                                                        {{ ucfirst($medicalInsuarance->company_name) }}
                                                                    </div>
                                                                    <div class="col-3 fw-semibold">Insurance ID</div>
                                                                    <div class="col-3">
                                                                        {{ $medicalInsuarance->insurance_id ?? "N/A" }}
                                                                    </div>



                                                                    <div class="col-3 fw-semibold">Status</div>
                                                                    <div class="col-3">
                                                                        {{ ucfirst($medicalInsuarance->status) }}
                                                                    </div>



                                                                </div>
                                                            </div>
                                                            <div class="col-2 text-end">
                                                                <div class="right-div">
                                                                    <!-- Your content for right div goes here -->
                                                                    <button class="btn btn-edit btn-sm bt" title="Edit"
                                                                        id="editButton"
                                                                        data-id="{{ $medicalInsuarance->id }}"
                                                                        data-user_id="{{ $employee->user_id }}"
                                                                        data-insurance_id="{{ $medicalInsuarance->insurance_id }}"
                                                                        data-medical_insurances_date="{{ $medicalInsuarance->medical_insurances_date }}"
                                                                        data-company_name="{{ $medicalInsuarance->company_name }}"
                                                                        data-amount="{{ $medicalInsuarance->amount }}"
                                                                        data-status="{{ $medicalInsuarance->status }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete"
                                                                        data-id="{{ $medicalInsuarance->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.employee.medicalInsuaranceBomaid.delete') }}">

                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="pb-4">
                                                    <div class="p-3 card">Medical Insurance is Not Added</div>
                                                </div>
                                            @endforelse
                                        @endif
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- End Stats -->
                    </div>
                </div>
            </div>
        </div>
    </main>




    {{-- Add form model start --}}
    <!-- Modal -->
    <div class="modal fade" id="formModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                   
                        <h5 class="modal-title" id="modalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  
                </div>
                <div class="modal-body" id="add">
                    <form id="form_id" class="formsubmit" method="post"
                        action="{{ route('admin.employee.medicalInsuaranceBomaid.post') }}">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="user_id" value="{{ !empty($employee) ? $employee->user_id : '' }}">

                        <div class="p-3 pb-4 row text-dark">

                            <div class="pt-3 col-3 fw-semibold">
                                <label for="medical_insurances_date">Insurance Date<small class="required-field">*</small></label>
                            </div>
                            <div class="pt-2 col-3">
                                <input type="date" id="medical_insurances_date" name="medical_insurances_date"
                                    placeholder="Enter" class="form-control form-control-sm">
                            </div>
                            <div class="pt-3 col-3 fw-semibold">
                                <label for="amount">Insurance Monthly Charge <small class="required-field">*</small></label>
                            </div>
                            <div class="pt-2 col-3">
                                <input type="number" id="amount" name="amount"
                                    placeholder="Enter" class="form-control form-control-sm">
                            </div>
                            <div class="pt-3 col-3 fw-semibold">
                                <label for="company_name">Insurance Company Name<small
                                        class="required-field">*</small></label>
                            </div>
                            <div class="pt-2 col-3">
                                <input type="text" id="company_name" name="company_name" placeholder="Enter" class="form-control form-control-sm">
                            </div>

                            <div class="pt-3 col-3 fw-semibold">
                                <label for="insurance_id">Insurance ID</label>
                            </div>
                            <div class="pt-2 col-3">
                                <input type="text" id="insurance_id" name="insurance_id"
                                    placeholder="Enter Insurance ID" class="form-control form-control-sm">
                            </div>

                            <div class="pt-5 text-center">
                                <button type="submit" class="btn btn-white btn-sm">SUBMIT</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

@endsection
@push('custom-scripts')
    <script>
        function addInsurance(user_id) {
            $('#form_id').trigger("reset");
            $("#id").val("");
            $('#formModal').modal('show');
            $('#form_id').find('.err_message').remove();
            $('#form_id').find('.form-control').removeClass('is-invalid');
            $("#modalTitle").html("Add: Medical Insuarance");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", "#editButton", (event) => {
                $('#form_id').trigger("reset");
                $("#modalTitle").html("Edit: Medical Insuarance");
                $("#btnSave").html("UPDATE");
                $('#form_id').find('.err_message').remove();
                $('#form_id').find('.form-control').removeClass('is-invalid');

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let insurance_id = $(event.currentTarget).data("insurance_id");
                let company_name = $(event.currentTarget).data("company_name");
                let amount = $(event.currentTarget).data("amount");
                let medical_insurances_date = $(event.currentTarget).data("medical_insurances_date");
                let status = $(event.currentTarget).data("status");

                $("#id").val(id);
                $("#user_id").val(user_id);
               

                $("#company_name").val(company_name);
                $("#amount").val(amount);
                $("#insurance_id").val(insurance_id);
                $("#medical_insurances_date").val(medical_insurances_date);
                $("#status").val(status);
               
                $('#formModal').modal('show');
            });
        });
    </script>
@endpush
