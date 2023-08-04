@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
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
            @include('admin.payroll.reimbursement.create')


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                    {{-- <a class="text-white btn btn-white" href="{{ route('admin.payroll.reimbursement.create') }}">
                        Add {{ $page }}
                    </a> --}}
                    <button type="button" class="btn btn-white" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add {{ $page }}
                        </button>

                    </div>
                </div>
             </div>
                   {{-- Table --}}
                   <div class="p-2 mt-3 table-responsive">
                    <table class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>SI.</th>
                                <th>Type</th>
                                <th>Bill Amount</th>
                                <th>Expenses Date</th>
                                <th>Reimbursement Amount</th>
                                <th>reimbursement_notes</th>
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
                            ajax: "{{ route('admin.payroll.reimbursement.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },

                             
                                {
                                    data: 'reimbursementype.type',
                                    name: 'reimbursementype.type'
                                },

                                {
                                    data: 'bill_amount',
                                    name: 'bill_amount'
                                },
                                {
                                    data: 'expenses_date',
                                    name: 'expenses_date'
                                },
                                {
                                    data: 'reimbursement_amount',
                                    name: 'reimbursement_amount'
                                },

                               
                                {
                                    data: 'reimbursement_notes',
                                    name: 'reimbursement_notes'
                                },
                               
                              
                                {
                                    data: 'status',
                                    name: 'status'
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
            {{-- edit form model end  --}}

            {{-- edit form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="modalshow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
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
                    <form class="formSubmit" action="{{route('admin.payroll.status')}}" method="POST">
                       @csrf
                        <div class="modal-body">
                        <input type="hidden" value="" id="status_id" name="payroll_id">
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
                                <label for="expenses">Reimbursement Reason</label>
                                <textarea name="reimbursement_reason" id="reimbursement_reason" cols="30" rows="10" class="form-control" placeholder="reimbursement_reason"></textarea>
                            </div>
                            <span class="text-danger">
                                @error('reimbursement_reason')
                                {{$message}}
                                @enderror
                            </span>
                        </div>
                        </div>  
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-primary status_add " id="">Add</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
             {{-- End Status Modal --}}

        </div>

    </main>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
     $(document).on('click','.status_change',function(e){
        // $(".alert").show();
        // e.preventDefault();
        var stat_id = $(this).val();
        // alert(stat_id);
        // $("#input").val(text); 
        $('#status_id').val(stat_id);
        $('#statusModal').modal('show');
      });


</script>
