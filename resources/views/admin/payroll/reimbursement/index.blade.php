@extends('layouts.app')
@push('styles')
@endpush
@section('content')
<main id="content" role="main" class="main">
    <!-- Content -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="mt-2 border-bottom">
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
                    <div class="col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                        {{-- <a class="text-white btn btn-white" href="{{ route('admin.payroll.reimbursement.create') }}">
                        Add {{ $page }}
                        </a> --}}
                        @can('add-reimbursement')
                        <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                            <th>Type</th>
                            <th>Reimbursement For</th>
                            <th>Empolyee Code</th>
                            <th>Empolyee Name</th>
                            <th>Financial Year</th>
                            <th>Expense Currency</th>
                            <th>Expense Amount</th>
                            <th>Claim date</th>
                            <th>Claim month</th>
                         
                            <th>Notes</th>
                            <th>Status</th>
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
                                data: 'reimbursement_for_name',
                                name: 'reimbursement_for_name'
                            },
                            {
                                data: 'user.employee.ec_number',
                                name: 'user.employee.ec_number'
                            },
                            {
                                data: 'user.name',
                                name: 'user.name'
                            },
                            {
                                data: 'financial_year',
                                name: 'financial_year'
                            },

                            {
                                data: 'expenses_currency',
                                name: 'expenses_currency'
                            },
                            {
                                data: 'expenses_amount',
                                name: 'expenses_amount'
                            },

                            {
                                data: 'claim_date',
                                name: 'claim_date'
                            },
                            {
                                data: 'claim_details',
                                name: 'claim_details',
                               
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
        <div class="modal fade" id="modaledit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputName">Status<sup class="text-danger">*</sup></label>
                                    <select name="status" class="form-control form-control-sm" id="status">
                                        <option value="" disabled>Selected Option</option>
                                        <option value="pending"> Pending</option>
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
                            <div class="col-sm-6">
                                <label for="reimbursement_currency">Reimbursement Currency <small
                                        class="required-field">*</small></label>

                                <select id="reimbursement_currency" placeholder="Select Reimbursement Currency"
                                    name="reimbursement_currency" class="form-control form-control-sm" required>
                                    <option selected disabled> - Select Currency - </option>
                                    <option value="usd">USD</option>
                                    <option value="pula">PULA</option>
                               

                                </select>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reimbursement_amount" class="required">Reimbursement Amount</label>
                                    <input type="number" step="0.001" required name="reimbursement_amount" id="reimbursement_amount" class="form-control form-control-sm" placeholder="Reimbursement amount" value="{{ old('reimbursement_amount') }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="expenses">Approval Reason</label>
                                    <textarea name="reimbursement_reason" id="reimbursement_reason" cols="30" rows="3" class="form-control form-control-sm" placeholder="Approval Reason"></textarea>
                                </div>
                                <span class="text-danger">
                                    @error('reimbursement_reason')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $(document).on('click', '.status_change', function(e) {
        // $(".alert").show();
        // e.preventDefault();
        var stat_id = $(this).val();
        // alert(stat_id);
        // $("#input").val(text);
        $('#status_id').val(stat_id);
        $('#statusModal').modal('show');
    });
    $(document).on('change', '#reimbursement_for', function(e) {
        // $(".alert").show();
        // e.preventDefault();
        var reimbursement_for = $(this).val();
        // claim_date_section
        if(reimbursement_for ==1)
        {
            $(".claim_date_section").css('display','block');
            $(".reimbursement_amount_section").css('display','none');
            $(".reimbursement_currency_section").css('display','none');
            $(".claim_for_period_to_month_section").css('display','block');
            $(".claim_for_period_from_month_section").css('display','block');

        }else if(reimbursement_for ==2)
        {
            $(".claim_date_section").css('display','block');
            $(".reimbursement_amount_section").css('display','block');
            $(".reimbursement_currency_section").css('display','block');
            $(".claim_for_period_to_month_section").css('display','block');
            $(".claim_for_period_from_month_section").css('display','block');
        }else if(reimbursement_for ==3)
        {
            $(".claim_date_section").css('display','none');
            $(".reimbursement_amount_section").css('display','block');
            $(".reimbursement_currency_section").css('display','block');
            $(".claim_for_period_to_month_section").css('display','none');
            $(".claim_for_period_from_month_section").css('display','none');
        }
       
    });
</script>
