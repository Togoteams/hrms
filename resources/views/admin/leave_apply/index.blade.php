@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css" />

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
                                <th>SL</th>
                                <th>Employee name</th>
                                <th>EC Number</th>
                                <th>leave type</th>
                                {{-- <th>Apply for</th> --}}
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
                            autoWidth: false,
                            ajax: "{{ route('admin.leave_apply.index') }}",
                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    width: '4%',
                                    searchable: false
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name',
                                    width: '13%'
                                },
                                {
                                    data: 'user.employee.ec_number',
                                    width: '10%',
                                    name: 'user.employee.ec_number'
                                },
                                {
                                    data: 'leave_type.name',
                                    width: '14%',
                                    // className: 'dt-left',
                                    name: 'leave_type.name'
                                },
                                {
                                    data: 'start_date',
                                    className: 'dt-left',
                                    width: '10%',
                                    name: 'start_date'
                                },
                                {
                                    data: 'end_date',
                                    className: 'dt-left',
                                    width: '10%',
                                    name: 'end_date'
                                },
                                {
                                    data: 'is_paid',
                                    width: '10%',
                                    name: 'is_paid'
                                },
                                {
                                    data: 'status',
                                    width: '10%',
                                    name: 'status'
                                },

                                {
                                    data: 'action',
                                    name: 'action',
                                    width: '20%',
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
            <div class="modal fade" id="modalstatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
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
    <script>
        function change_leave_edit() {
            getDaysEdit();
            var leaveSlug = $("#edit_leave_type_id").find(':selected').data('leave-slug');
            var employment_type = $("#employment_type").val();
            var leave_applies_for = $("#leave_applies_for_edit").val() ?? 1;
            console.log(leave_applies_for);
            if (employment_type == "expatriate" && leaveSlug == "sick-leave" && leave_applies_for >= 2) {
                document.getElementById('edit_doc').setAttribute("required", "");
                console.log("expatriate");
            } else if (employment_type == "local" && (leaveSlug == "sick-leave" || leaveSlug == "maternity-leave")) {
                document.getElementById('edit_doc').setAttribute("required", "");
                console.log("local");
            } else {
                document.getElementById('edit_doc').removeAttribute("required", "");
            }
            var getBalanceUrl = "{{ route('admin.leave_apply.get_balance_leave') }}";
            var user_id = $("#edit_user_id").val();
            console.log(user_id);
            var leave_type_id = $("#edit_leave_type_id").val();
            console.log(leave_type_id);
            // $.ajax({
            // url: getBalanceUrl,
            // type: "get",
            // data:{"user_id":user_id,'leave_type_id':leave_type_id},
            // dataType: "json",
            //     success: function (result) {
            //     if(result.status==true)
            //     {
            //         var data = result.data;
            //         if(data.is_balance_leave_hide)
            //         {
            //             $("#edit_balance_leave1").val(0);
            //             $(".balance_leave_section").css('display','none');
            //         }else
            //         {
            //             $("#edit_balance_leave1").val(data.remaining_leave);
            //             $(".balance_leave_section").css('display','');
            //         }

            //         if(data.is_ibo_sick_leave)
            //         {
            //             $(".ibo-pay-type").css('display','block');
            //         }else
            //         {
            //             $(".ibo-pay-type").css('display','none');
            //         }
            //     }else
            //     {
            //         $("#edit_balance_leave1").val(0);
            //     }
            //     },
            // });
        }

        $("#start_date_edit").on('change', function() {
            dt = new Date($(this).val());
            dt.setDate(dt.getDate() + 1);
            var month = dt.getMonth() + 1;
            var day = dt.getDate();
            if (month < 10) {
                month = "0" + month;
            }

            if (day < 10) {
                day = "0" + day;
            }
            $("#end_date_edit").val(dt.getFullYear() + "-" + (month) + "-" + day);
            getDaysEdit();
        });
        $("#end_date_edit").on('change', function() {
            getDaysEdit();
        });

        function getDaysEdit() {
            date1 = new Date($("#start_date_edit").val());
            date2 = new Date($("#end_date_edit").val());
            $("#leave_applies_for_edit").val(0);
            var milli_secs = date1.getTime() - date2.getTime();
            var days = 0;
            days = Math.round(Math.abs(milli_secs / (1000 * 3600 * 24))) + 1;
            // Convert the milli seconds to Days
            if (days.toString() == "NaN") {
                days = 0;
            }
            $("#leave_applies_for_edit").val(Number(days));
        }
    </script>
    <script>
        var reverseLeaveWithoutPayUrl = "{{ route('admin.leave_apply.reverse_leave_without_pay') }}";

        function reverseLeaveWithoutPay(leaveId) {
            var leaveId = leaveId;
            var d = confirm("Are you sure you want to Reverse this leave?");
            if (d) {
                $.ajax({
                    url: reverseLeaveWithoutPayUrl,
                    type: "get",
                    data: {
                        "leave_id": leaveId
                    },
                    dataType: "json",
                    success: function(result) {
                        console.log(result);
                        if (result.status == true) {
                            Swal.fire({
                                icon: "success",
                                title: result.message,
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "We are facing some technical issue now.",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                        }
                    },
                });
            }

        }
    </script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
      ></script>
      <script>
          $(document).ready(function() {
              $(".select-search").selectize({ sortField: 'text' });
          });
      </script>
@endpush
