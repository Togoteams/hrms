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
                    <span class="name-title">Personal Information
                    </span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content this-div" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                            <button type="button" class="btn btn-white btn-sm"
                                                onclick="addForm({{ Auth::user()->id }})">
                                                Add Family Details
                                            </button>
                                        </div>
                                    </div>
                                    @if (count($datas) > 0)
                                        @foreach ($datas as $key => $data)
                                            <div class="row">
                                                <div class="pb-4">
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="pt-1 col-3 fw-semibold">Relation:</div>
                                                                    <div class="pt-1 col-3">
                                                                        {{ ucfirst($data->relation) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Date of Birth:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ $data->date_of_birth }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Name:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->name) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Depended:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->depended) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Marital status:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->marital_status) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Gender:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->gender) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Occupations:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->occupations) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Monthly Income:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ $data->monthly_income }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Is Bank of Baroda Employee:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->bank_of_baroda_employee) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Address Line 1:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->address_line1) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Address Line 2:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->address_line2) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">State:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->state) }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Country:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ $data->country }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Email Id:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ $data->email }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Phone number:</div>
                                                                    <div class="pt-3 col-3">
                                                                      +267 {{ $data->number }}
                                                                    </div>

                                                                    <div class="pt-3 col-3 fw-semibold">Nationality:</div>
                                                                    <div class="pt-3 col-3">
                                                                        {{ ucfirst($data->nationality) }}
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="col-3 text-end">
                                                                <div class="right-div">
                                                                    <button type="button"
                                                                        class="btn btn-edit btn-sm bt editButton"
                                                                        title="Edit" data-id="{{ $data->id }}"
                                                                        data-user_id="{{ Auth::user()->id }}"
                                                                        data-relation="{{ $data->relation }}"
                                                                        data-date_of_birth="{{ $data->date_of_birth }}"
                                                                        data-name="{{ $data->name }}"
                                                                        data-depended="{{ $data->depended }}"
                                                                        data-marital_status="{{ $data->marital_status }}"
                                                                        data-gender="{{ $data->gender }}"
                                                                        data-occupations="{{ $data->occupations }}"
                                                                        data-monthly_income="{{ $data->monthly_income }}"
                                                                        data-bank_of_baroda_employee="{{ $data->bank_of_baroda_employee }}"
                                                                        data-address_line1="{{ $data->address_line1 }}"
                                                                        data-address_line2="{{ $data->address_line2 }}"
                                                                        data-state="{{ $data->state }}"
                                                                        data-country="{{ $data->country }}"
                                                                        data-email="{{ $data->email }}"
                                                                        data-number="{{ $data->number }}"
                                                                        data-nationality="{{ $data->nationality }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-delete btn-sm bt deleteRecord"
                                                                        title="Delete" data-id="{{ $data->id }}"
                                                                        data-token="{{ csrf_token() }}"
                                                                        data-action="{{ route('admin.personal.info.family.details.delete') }}">
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
                                        <div class="p-3 mb-5 card">No data to show</div>
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
                            <div class="modal-body" id="">
                                <form id="form_add"
                                    action="{{ route('admin.personal.info.family.details.save') }}">
                                    @csrf
                                    <input type="hidden" id="id" name="id" value="">
                                    <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">
                                    <div class="row">
                                        <div class="mb-2 col-sm-6">
                                            <div class="form-group">
                                                <label for="relation" class="required">Relation</label>
                                                <select name="relation" class=" form-control" id="relation" placeholder="Employee relation">
                                                    <option value="">Select Option</option>
                                                    <option value="father">Father</option>
                                                    <option value="mother">Mother</option> 
                                                    <option value="brother">Brother</option> 
                                                    <option value="sister">Sister</option> 
                                                    <option value="child">Child</option> 
                                                    <option value="spouse">Spouse</option> 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="date_of_birth" class="required">Date of Birth</label>
                                                <input required value="" id="date_of_birth" name="date_of_birth"
                                                    placeholder=" Enter date_of_birth" type="date"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <label for="name" class="required">Name</label>
                                            <input required value="" id="name" name="name"
                                                placeholder="name" type="text"
                                                class="form-control form-control-sm">
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="depended" class="required">Depended</label>
                                                        <select name="depended" class=" form-control" id="depended" placeholder="Employee depended">
                                                            <option value="">Select Option</option>
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option> 
                                                        </select>
                                             </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="marital_status" class="required">Marital status</label>
                                                        <select name="marital_status" class=" form-control" id="marital_status" placeholder="Employee marital_status">
                                                            <option value="">Select Option</option>
                                                            <option value="unmarried">Unmarried</option>
                                                            <option value="married">Married</option> 
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="gender" class="required">Gender</label>
                                                        <select name="gender" class=" form-control" id="gender" placeholder="Employee gender">
                                                            <option value="">Select Option</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option> 
                                                            <option value="other">Other</option> 
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="occupations" class="required">Occupations</label>
                                                <input type="text" id="occupations" name="occupations"
                                                    placeholder="Enter occupations of Family"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="monthly_income" class="required">Monthly Income</label>
                                                <input type="text" id="monthly_income" name="monthly_income"
                                                    placeholder="Enter Monthly Income Of Family"
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="bank_of_baroda_employee" class="required">Is Bank of Baroda Employee</label>
                                                        <select name="bank_of_baroda_employee" class=" bank_of_baroda_employee form-control" id="bank_of_baroda_employee" placeholder="Employee bank_of_baroda_employee">
                                                            <option value="">Select Option</option>
                                                            <option value="yes">yes</option>
                                                            <option value="no">No</option> 
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="address_line1" class="required">Address Line 1</label>
                                                <textarea id="address_line1" placeholder="Enter address_line1..." name="address_line1" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="address_line2">Address Line 2</label>
                                                <textarea id="address_line2" placeholder="Enter address_line2..." name="address_line2" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="state" class="required">State</label>
                                                <input type="text" id="state" name="state"
                                                    placeholder="Enter state Name "
                                                    class="form-control form-control-sm" required>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="country" class="required">Country</label>
                                                <select name="country" id="country" class="form-control form-control-sm" placeholder="Enter country Name" required>
                                                    <option value="">Select</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->name}}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email Id</label>
                                                <input type="text" id="email" name="email"
                                                    placeholder="Enter email Name"
                                                    class="form-control form-control-sm">
                                            </div>
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="number" class="required">Phone number</label>
                                                {{-- <input type="number" id="number" name="number"
                                                    placeholder="Enter number"
                                                    class="form-control form-control-sm" required> --}}
                                            </div>
                                            <div class="col-12 d-flex">
                                                <label for="number" class="pt-2">+267</label>
                                                <input id="number"   maxlength="8" minlength="7"  pattern="[0-9]+"
                                                    placeholder="Enter Mobile No" type="text"
                                                    name="number" class="form-control form-control-sm">
                                            </div>
                                            {{-- <div class="col-4">
                                                <input id="mobile"   maxlength="8" minlength="7"  pattern="[0-9]+"
                                                    placeholder="Enter Mobile No" type="text"
                                                    value="{{ !empty($employee) ? $employee->user->mobile : '' }}"
                                                    name="mobile" class="form-control form-control-sm">
                                            </div> --}}
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <div class="form-group">
                                                <label for="nationality" class="required">Nationality</label>
                                                <input type="text" id="nationality" name="nationality"
                                                    placeholder="Enter Nationality"
                                                    class="form-control form-control-sm" required>
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
            $("#modalTitle").html("Add: Family Details");
            $("#btnSave").html("CREATE");
            $("#user_id").val(user_id);
        }
        $(document).ready(() => {
            $(document).on("click", ".editButton", (event) => {
                $('#formModal').modal('show');
                $("#modalTitle").html("Edit: Family Details");
                $("#btnSave").html("Update");

                let id = $(event.currentTarget).data("id");
                let user_id = $(event.currentTarget).data("user_id");
                let relation = $(event.currentTarget).data("relation");
                let date_of_birth = $(event.currentTarget).data("date_of_birth");
                let name = $(event.currentTarget).data("name");
                let depended = $(event.currentTarget).data("depended");
                let marital_status = $(event.currentTarget).data("marital_status");
                let gender = $(event.currentTarget).data("gender");
                let occupations = $(event.currentTarget).data("occupations");
                let monthly_income = $(event.currentTarget).data("monthly_income");
                let bank_of_baroda_employee = $(event.currentTarget).data("bank_of_baroda_employee");
                let address_line1 = $(event.currentTarget).data("address_line1");
                let address_line2 = $(event.currentTarget).data("address_line2");
                let state = $(event.currentTarget).data("state");
                let country = $(event.currentTarget).data("country");
                let email = $(event.currentTarget).data("email");
                let number = $(event.currentTarget).data("number");
                let nationality = $(event.currentTarget).data("nationality");
               

                $("#id").val(id);
                $("#user_id").val(user_id);
                $("#relation").val(relation);
                $("#date_of_birth").val(date_of_birth);
                $("#name").val(name);
                $("#depended").val(depended);
                $("#marital_status").val(marital_status);
                $("#gender").val(gender);
                $("#occupations").val(occupations);
                $("#monthly_income").val(monthly_income);
                $("#bank_of_baroda_employee").val(bank_of_baroda_employee);
                $("#address_line1").val(address_line1);
                $("#address_line2").val(address_line2);
                $("#state").val(state);
                $("#country").val(country);
                $("#email").val(email);
                $("#number").val(number);
                $("#nationality").val(nationality);
              

            });
        });

    //     $(document).ready(function(){
    //    $('.bank_of_baroda_employee').change(function(){
    //            var bank_of_baroda_employee = $(this).val();
    //            if(bank_of_baroda_employee == "yes"){
    //                 $('.emp').show();

    //            }else if (bank_of_baroda_employee === "no"){ 
    //                 $('.emp').hide();
    //            }
    //       });
    //     });
    </script>

@endpush
