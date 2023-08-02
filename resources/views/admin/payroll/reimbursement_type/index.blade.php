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
           

            <!-- Card -->
            <div class="mb-3 card mb-lg-5">
            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                    <a class="text-white btn btn-white" href="{{ route('admin.payroll.reimbursement_type.create') }}">
                        Add {{ $page }}
                    </a>

                    </div>
                </div>
             </div>
                    @if(session('status'))
                       <div class="alert alert-success" id="status-message">{{ session('status') }}</div>
                   @endif
                <div class="p-2 mt-3 table-responsive">
                    <table id="example" class="table data-table table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead>
                            <tr>
                                <th>SI.</th>
                                <th>Type Name</th>
                                <th>status</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($reimbursement) > 0)
                            @foreach ($reimbursement as $key =>$item) 
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$item->type}}</td>
                                <td>
                                    @if ($item->status=="0")
                                    <span class = "btn btn-primary btn-sm"><b>Active</b></span>
                                    @elseif ($item->status=="1")
                                    <span class = "btn btn-danger btn-sm"><b>Inactive</b></span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('admin.payroll.reimbursement_type.edit',$item->id) }}" class = "btn btn-edit btn-sm" style="margin-right: 6px;"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.payroll.reimbursement_type.destroy',$item->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <button type="submit" class="btn btn-delete btn-sm"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                             @endforeach  
                             @else
                             <tr>
                                 <td class="text-center">No Data Available In Table</td>
                             </tr>
                            @endif
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
                <div class="modal-dialog modal-xl">
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

        </div>

    </main>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    setTimeout(() => {
                 $('#status-message').text('').removeClass('alert alert-success');
               
               }, 2000);

               $(document).ready(function () {
    $('#example').DataTable();
});
</script>