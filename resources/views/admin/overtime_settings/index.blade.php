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

            @include('admin.overtime_settings.create')

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
                            @can('add-overtime-setting')
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
                                <th>Ec Number</th>
                                <th>Date</th>
                                <th>working Hours</th>
                                <th>Overtime Type</th>
                                {{-- <th>status</th> --}}
                                <th width="100px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->date}}</td>
                                <td>{{$item->working_hours}}</td>
                                <td>{{$item->working_min}}</td>
                                <td>{{$item->overtime_type}}</td>
                                <td>
                                    <div class="success-badges changeStatus" data-table="reimbursement_types" data-uuid="{{$item->id}}"
                                        data-message="inactive" @if ($item->status == 'active') data-value="inactive" @else data-value="active" @endif ><span class="legend-indicator bg-success">
                                        </span>{{ $item->status ?? 'Active' }}</div>
                                </td>
                                <td style="text-align:right;">
                                    <form id="edit{{ $item->id }}"
                                        action="{{ route('admin.payroll.reimbursement_type.destroy', $item->id) }}">
                                        <button type="button"
                                            onclick="editForm('{{ route('admin.payroll.reimbursement_type.edit', $item->id) }}', 'edit')"
                                            href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                            class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></button>
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="button" id="delete{{ $item->id }}"
                                            onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                                            class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                             @endforeach   --}}
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
                            ajax: "{{ route('admin.overtime-settings.index') }}",

                            columns: [{
                                    data: 'DT_RowIndex',
                                    name: 'DT_RowIndex',
                                    orderable: false,
                                    searchable: false
                                },


                                {
                                    data: 'user.name',
                                    name: 'user.name'
                                },
                                {
                                    data: 'user.employee.ec_number',
                                    name: 'user.employee.ec_number'
                                },

                                {
                                    data: 'date',
                                    name: 'date'
                                },
                                {
                                    data: 'working_hours',
                                    name: 'working_hours'
                                },
                                {
                                    data: 'overtime_type',
                                    name: 'overtime_type'
                                },


                                // {
                                //     data: 'status',
                                //     name: 'status'
                                // },


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
></script>
<script>
    $(document).ready(function() {
        $(".select-search").selectize({ sortField: 'text' });
    });
</script>
@endpush
