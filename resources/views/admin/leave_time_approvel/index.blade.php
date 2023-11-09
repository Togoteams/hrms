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

            @include('admin.leave_time_approvel.create')

            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    {{-- <div class="col-sm-auto">
                    <a class="text-white btn btn-white" href="{{ route('admin.payroll.reimbursement_type.create') }}">
                        Add {{ $page }}
                    </a>

                    </div> --}}
                    <div class="col-sm-auto">
                        @can('add-leave-type-approval')
                        <button type="button" class="btn btn-white" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Add {{ $page }}
                         </button>
                         @endcan

                    </div>

                </div>
             </div>
              {{-- Table --}}
              <div class="p-2 mt-3 table-responsive">
                <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                       <thead>
                            <tr>
                                <th>SI.</th>
                                <th>Employee Name</th>
                                <th>Request date</th>
                                <th>From date</th>
                                <th>To date</th>
                                <th>Reason</th>
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
                            ajax: "{{ route('admin.leave_time_approved.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name',
                                },
                                {
                                    data: 'request_date',
                                    name: 'request_date'
                                },
                                {
                                    data: 'start_date',
                                    name: 'start_date'
                                },
                                {
                                    data: 'end_date',
                                    name: 'end_date'
                                },
                                // {
                                //     data: 'document',
                                //     name: 'document',
                                //     render: function (data, type, row) {
                                //         if (data) {
                                //             return '<a href="' + "{{ asset('assets/leave_document/') }}" + '/' + data + '" download>Download</a>';
                                //         } else {
                                //             return 'No Document Available';
                                //         }
                                //     }
                                // },
                                {
                                    data: 'reason',
                                    name: 'reason'
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
                <div class="modal-dialog modal-md">
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

               {{--start status Modal  --}}
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Status change of {{ $page }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="formSubmit" action="{{route('admin.leave_approval.status')}}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" value="" id="status_id" name="leave_id">
                            <div class="mb-2 col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Status<sup class="text-danger">*</sup></label>
                                    <select name="status" class="form-control" id="status">
                                        <option value="">Selected Option</option>
                                        <option value="pending">Pending</option>
                                        <option value="approved">Approved</option>
                                        <option value="rejected">Rejected</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('status')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <div class="form-group">
                                    <label for="expenses">Description Reason</label>
                                    <textarea name="description_reason" id="description_reason" cols="30" rows="10" class="form-control" placeholder="Description Reason"></textarea>
                                </div>
                                {{-- <span class="text-danger">
                                    @error('description_reason')
                                    {{$message}}
                                    @enderror
                                </span> --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            <button type="submit" class="btn btn-primary status_add " id="">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- End Status Modal --}}

        </div>

    </main>
@endsection
@push('custom-scripts')
<script>
    $(document).ready(function () {
        $('#user_id').change(function () {
            const selectedEmployeeType = $('#user_id option:selected').data('employee-type');
            $('#leave_type_id option').each(function () {
                const leaveTypeEmployeeType = $(this).data('employee-type');
                console.log("leaveTypeEmployeeType",leaveTypeEmployeeType);
                console.log("selectedEmployeeType",selectedEmployeeType);
                if (selectedEmployeeType === 'local') {
                    if(leaveTypeEmployeeType == 1)
                    {
                        $(this).show();
                    }else
                    {
                        $(this).hide();
                    }
                } else {
                    if(leaveTypeEmployeeType == 0)
                    {
                        $(this).show();
                    }else
                    {
                        $(this).hide();
                    }
                }
            });
        });
    });
</script>
{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
<script>
   $(document).on('click', '.status_change', function(e) {
        var stat_id = $(this).val();
        $('#status_id').val(stat_id);
        $('#statusModal').modal('show');
});
</script>

@endpush


