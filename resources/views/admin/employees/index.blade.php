@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class=" border-bottom mt-2 mb-2">
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
            <div class="card mb-3 mb-lg-5">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                    @can('add-employees')
                        {{-- <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> --}}
                        <a type="button" class="btn btn-white" href="{{route('admin.employee.userDetails.form')}}" title="Add Employee">
                            Add {{ $page }}
                        </a>
                        {{-- </button> --}}
                    @endcan
                    </div>
                </div>
            </div>
                <div class="table-responsive mt-3 p-2">
                    <table class="table data-table  table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Employee Id</th>
                                <th>Employee name</th>
                                <th>Employee Email</th>
                                <th>Employee username</th>
                                <th>Employee Phone</th>
                                <th>Employee Gender</th>
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
                                    }
                                },

                                {
                                    data: 'emp_id',
                                    name: 'emp_id'
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                }, {
                                    data: 'user.email',
                                    name: 'user.email'
                                }, {
                                    data: 'user.username',
                                    name: 'user.username'
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
                                    data: 'action',
                                    name: 'action',
                                    orderable: true,
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

    </main>
@endsection
@push('custom-scripts')
    <script>
        // $(document).ready(function() {
        //     //For Creation Time
        //     $("#contractDiv").hide();

        //     //For Edit Time
        //     $("#employment_type_edit").val() == "local-contractual" ?
        //         $("#contractDivEdit").show() && $("#contract_duration_edit").prop("required", true) :
        //         $("#contractDivEdit").hide() && $("#contract_duration").val("");
        // });

        // //For Creation Time
        // $("#employment_type").change(() => {
        //     $("#employment_type").val() == "local-contractual" ?
        //         $("#contractDiv").show() && $("#contract_duration").prop("required", true) :
        //         $("#contractDiv").hide() && $("#contract_duration").val("") &&
        //         $("#contract_duration").removeAttr("required");
        // });

        // //For Edit Time
        // $("#employment_type_edit").change(() => {
        //     $("#employment_type_edit").val() == "local-contractual" ?
        //         $("#contractDivEdit").show() :
        //         $("#contractDivEdit").hide() && $("#contract_duration").val("");
        // });

        function show_hide(input,data,id){
          if(input.value==data){
            document.getElementById(id).style.display="block";
          }  else{
            document.getElementById(id).style.display="none";
          }
          if(input.value=="yes"){
            pention_contribution();

          }
        }

        function pention_contribution(){
            var basic= document.getElementById('basic_salary').value;
            document.getElementById('pension_contribution').value=Number(basic)*0.01;
        }

    </script>
@endpush
