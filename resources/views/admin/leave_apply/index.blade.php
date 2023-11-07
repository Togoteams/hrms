@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="mb-2 border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title">{{ $page }}</h1>
                </div>
                <!-- End Col -->
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
        
        @include('admin.leave_apply.create')
       
        <!-- Card -->
        @include('admin.leave_apply.type_of_leave')
        <div class="row">
            <div class="col-sm-9"></div>
            
        </div>
        <div class="mb-3 card mb-lg-5">
            {{-- <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="flex accordion-header col-lg-3 filters">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Advanced Filters
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="py-5 row">
                                <div class="col-3">
                                    <select class="px-2 py-2 filter" width="full">
                                        <option>
                                            Filter 1
                                        </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="px-2 py-2 filter" width="full">
                                        <option>
                                            Filter 2
                                        </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="px-2 py-2 filter" width="full">
                                        <option>
                                            Filter 3
                                        </option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="px-2 py-2 filter" width="full">
                                        <option>
                                            Filter 4
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="p-2 mt-3 table-responsive">
                <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Employee name</th>
                            <th>EC Number</th>
                            <th>leave type</th>
                            <th>Apply for</th>
                            <th>From </th>
                            <th>To</th>
                            <th>Paid/Unpaid</th>
                            <th>status</th>
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
                        ajax: "{{ route('admin.leave_apply.index') }}",
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'user.name',
                                name: 'user.name'
                            }, {
                                data: 'user.employee.ec_number',
                                name: 'user.employee.ec_number'
                            },
                            {
                                data: 'leave_type.name',
                                name: 'leave_type.name'
                            },
                            {
                                data: 'leave_applies_for',
                                name: 'leave_applies_for'
                            },
                           
                            {
                                data: 'start_date',
                                name: 'start_date'
                            },
                            {
                                data: 'end_date',
                                name: 'end_date'
                            },
                            {
                                data: 'is_paid',
                                name: 'is_paid'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },

                            {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ]
                    });



                });



                // Apply the search
            </script>
            <!-- End Table -->
           
        </div>
        <!-- End Card -->
        {{-- edit form model start --}}
        <!-- Modal -->
        <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
        <div class="modal fade" id="modalshow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="staticBackdropLabel"> Show {{ $page }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="show">

                    </div>

                </div>
            </div>
        </div>

        {{-- edit form model end  --}}

        {{-- status form model start --}}
        <!-- Modal -->
        <div class="modal fade" id="modalstatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content ">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="staticBackdropLabel"> Status change of {{ $page }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="statuschange">

                    </div>

                </div>
            </div>
        </div>

        {{-- status form model end  --}}

    </div>

</main>
@endsection
@push('custom-scripts')

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    // date picker
    $( document ).ready(function() {
        // $("#start_date").datepicker({ minDate: '0',dateFormat: 'dd-mm-yy' });
        // $("#end_date").datepicker({ dateFormat: 'dd-mm-yy' });
    
        // $("#start_date").on("change", function () {
        //     var fromdate = $(this).val();
        //     console.log("fromdate",fromdate.replace(/-/g,"/"));
        //     // var end = new Date(fromdate.replace(/-/g,"/"));
        //     // console.log(end);
        //     // $("#end_date").datepicker({ minDate: end });

        // });
    }); 
    // date picker
    </script>
    <script>
        //  window.onload = function() { //from ww  w . j  a  va2s. c  o  m
        //     var today = new Date().toISOString().split('T')[0];
        //     document.getElementsByName("start_date_edit")[0].setAttribute('min', today);
        //     document.getElementsByName("end_date_edit")[0].setAttribute('min', today);
        // }
          $(document).ready(function() {
            $(document).on('change',"#start_date_edit",function() {
                console.log("sdsd");
                getEditDays();
            });
            $(document).on('change',"#end_date_edit",function() {
                console.log("sdsdsdsdsd");
            // $("#end_date_edit").on('change', function() {
                getEditDays();
            });

        });

        function getEditDays() {
            date1 = new Date($("#start_date_edit").val());
            date2 = new Date($("#end_date_edit").val());
            var milli_secs = date1.getTime() - date2.getTime();

            // Convert the milli seconds to Days 
            var days = milli_secs / (1000 * 3600 * 24);
            // document.getElementById("ans").innerHTML =
            $("#leave_applies_for_edit").val(Math.round(Math.abs(days)) + 1);
        }
    </script>
@endpush