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
                   <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-strippedtable-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
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
                            @foreach ($reimbursement as $key =>$item) 
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{ $item['reimbursementype']['type'] ?? 'N/A' }}</td>
                                <td>{{$item['bill_amount']}}</td>
                                <td>{{$item['expenses_date']}}</td>
                                <td>{{$item['reimbursement_amount']}}</td>
                                <td>{{$item['reimbursement_notes']}}</td>
                                <td>
                                    {{-- @if ($item['status']=="0")
                                    <span class = "btn btn-primary btn-sm"><b>Pending</b></span>
                                    @elseif ($item['status']=="1")
                                    <span class = "btn btn-danger btn-sm"><b>Approved</b></span>
                                    @elseif ($item['status']=="2")
                                    <span class = "btn btn-danger btn-sm"><b>Reject</b></span>
                                    @endif --}}{{$item['status']}}
                                </td>
                                {{-- <td class="d-flex">
                                    <a href="{{ route('admin.payroll.reimbursement.edit',$item['id']) }}" class = "btn btn-primary btn-sm" style="margin-right: 6px;"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.payroll.reimbursement.destroy',$item['id']) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                    <button type="button" value="{{$item['id']}}" class="@if($item['status']=='pending') status_change @endif btn btn-danger btn-sm">{{ucfirst($item['status'])}}</button>
                                </td> --}}
                                <td style="text-align:right;">
                                    <form id="edit{{ $item['id'] }}"
                                        action="{{ route('admin.payroll.reimbursement.destroy', $item['id']) }}">
                                        <button type="button"
                                            onclick="editForm('{{ route('admin.payroll.reimbursement.edit',$item['id']) }}', 'edit')"
                                            href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                            class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></button>
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete{{ $item['id'] }}"
                                            onclick="deleteRow('edit{{ $item['id'] }}','delete{{ $item['id'] }}')"
                                            class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
                                        </button>
                                        <button type="button" value="{{$item['id']}}" class="@if($item['status']=='pending') status_change @endif btn btn-success btn-sm">{{ucfirst($item['status'])}}</button>
                                    </form>
                                </td>
                            </tr>
                             @endforeach  
                        </tbody>
                    </table>
                </div>
                {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

                <script type="text/javascript">
                    $(function() {
                        var i = 1;
                        var table = $('.data-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: "{{ route('admin.payroll.payscale.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },

                             
                                {
                                    data: 'employee.emp_id',
                                    name: 'employee.emp_id'
                                },

                                {
                                    data: 'employee.ec_number',
                                    name: 'employee.ec_number'
                                },
                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                },
                                {
                                    data: 'basic',
                                    name: 'basic'
                                },

                               
                                {
                                    data: 'net_take_home',
                                    name: 'net_take_home'
                                },
                               
                              
                                {
                                    data: 'total_deduction',
                                    name: 'total_deduction'
                                },
                                {
                                    data: 'gross_earning',
                                    name: 'gross_earning'
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
                </script> --}}
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
{{-- <script>
    setTimeout(() => {
                 $('#status-message').text('').removeClass('alert alert-success');
               
               }, 2000);

               $(document).ready(function () {
    $('#example').DataTable();
   });
</script> --}}
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
