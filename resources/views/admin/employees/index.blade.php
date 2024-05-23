@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="mt-2 mb-2 border-bottom">
                <div class="row align-items-center">

                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/ {{ $page }}
                    </div>
                    <!-- End Col -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>

            @include('admin.employees.create')
            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
                <div class="page-header">
                    <div class="row">
                        <div class="mb-2 col-sm mb-sm-0">
                            <h2 class="page-header-title">{{ $page }}</h2>
                        </div>
                        <div class="col-sm-auto">
                            @can('add-employees')
                                {{-- <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> --}}
                                <a type="button" class="btn btn-white" href="{{ route('admin.employee.userDetails.form') }}"
                                    title="Add Employee">
                                    Add {{ $page }}
                                </a>
                                {{-- </button> --}}
                            @endcan
                            <button class="btn btn-primary btn-sm " data-bs-toggle="modal" data-action="add"
                                data-bs-target="#importEmployeeModal">Import</button>
                        </div>
                    </div>
                </div>
                <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Employment Type</th>
                                <th>DOJ</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

                <script type="text/javascript">
                    $(function() {
                        var i = 1;
                        var table = $('.data-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('admin.employees.index') }}",

                            columns: [{
                                    "render": function() {
                                        return i++;
                                    },
                                },

                                {
                                    data: 'ec_number',
                                    name: 'ec_number'
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                }, {
                                    data: 'user.email',
                                    name: 'user.email'
                                },
                                {
                                    data: 'user.mobile',
                                    name: 'user.mobile'
                                },
                                {
                                    data: 'gender',
                                    name: 'gender'
                                },
                                {
                                    data: 'employment_type',
                                    name: 'employment_type'
                                },

                                {
                                    data: 'start_date',
                                    name: 'start_date'
                                },
                                {
                                    data: 'action',
                                    name: 'action',
                                    orderable: false,
                                    searchable: true
                                },
                            ]
                        });

                    });
                </script>
                <!-- End Table -->


            </div>
            <!-- End Card -->
            {{-- edit form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="edit">

                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}

            {{-- edit form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="modalshow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content ">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabel">Edit {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="show">

                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}

        </div>
         {{-- Import Employee  --}}
         <div class="modal" id="importEmployeeModal">
            <div class="modal-dialog">
                <div class="modal-content">
    
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title">Import Employee <span class="action_name"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
    
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <form action="{{ route('admin.employees.import') }}" class="formsubmit fileupload"
                                id="employee_form" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fileUploadPassbook">Import Excel Sheet <i class="text-danger">*</i></label>
                                        <input type="file" name="import_employee" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ asset('admin/assets/excel-formate/Hrms-Data-Master-Format.xlsx') }}"
                                            for="fileUploadPassbook">Download Execel Formate</a>
                                    </div>
                                </div>
                                <div class="col-md-12"> 
                                    <button type="submit" class="btn btn-primary btn-icon-split">
                                        <span class="text">Import & Proceed</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
    
    
                    </form>
                </div>
            </div>
        </div>
    

    </main>
@endsection
@push('custom-scripts')
    <script>
      

        function show_hide(input, data, id) {
            if (input.value == data) {
                document.getElementById(id).style.display = "block";
            } else {
                document.getElementById(id).style.display = "none";
            }
            if (input.value == "yes") {
                pention_contribution();

            }
        }

        function pention_contribution() {
            var basic = document.getElementById('basic_salary').value;
            document.getElementById('pension_contribution').value = Number(basic) * 0.01;
        }
    </script>
@endpush
