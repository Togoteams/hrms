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
            
             @include('admin.document.create')


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">

            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
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
                                <th>S.no</th>
                                <th>Document Name</th>
                                <th>Document Type</th>
                                <th>Document</th>
                                <th>status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                              @foreach ($data as $item)
                              <tr>
                                <td class="table-column-pe-0">
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>{{$item->document_name}}</td>
                                <td>{{$item->document_type}}</td>
                                {{-- <td>{{$item->document}}</td> --}}
                                <td>
                                    @if($item->document)
                                        <a href="{{ asset('asset/img/' . $item->document) }}" download>Download</a>
                                    @else
                                        No Document Available
                                    @endif
                                </td>
                                <td>
                                    <div class="success-badges changeStatus" data-table="documents" data-uuid="{{$item->id}}"
                                    data-message="inactive" @if($item->status=="active") data-value="inactive" @else data-value="active" @endif ><span class="legend-indicator bg-success">
                                    </span>{{ $item->status ?? 'Active' }}</div>
                                </td>
                                <td style="text-align:right;">
                                    
                                    <form id="edit{{ $item->id }}"
                                        action="{{ route('admin.document.destroy', $item->id) }}">
                                            <button type="button" class="btn btn-white assign_doc" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop1" onclick="editForm('{{ route('admin.document.get.asign', $item->id) }}', 'assign_doc')" doc_id="{{$item->id}}">
                                                    Asign Employee Document
                                                </button>
                                        <button type="button"
                                            onclick="editForm('{{ route('admin.document.edit', $item->id) }}', 'edit')"
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
                              @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}

                {{-- <script type="text/javascript">
                  $(function() {
                      var i = 1;
                      var table = $('.data-table').DataTable({
                          processing: true,
                          serverSide: true,
                          ajax: "{{ route('admin.payroll.salary-increment-setting.index') }}",

                          columns: [{
                                  data: 'DT_RowIndex',
                                  name: 'DT_RowIndex',
                                  orderable: false,
                                  searchable: false
                              },

                           
                              {
                                  data: 'increment_percentage',
                                  name: 'increment_percentage'
                              },
                              {
                                  data: 'employment_type',
                                  name: 'employment_type'
                              },
                              {
                                  data: 'effective_from',
                                  name: 'effective_from'
                              },
                              {
                                  data: 'effective_to',
                                  name: 'effective_to'
                              },
                              {
                                  data: 'financial_year',
                                  name: 'financial_year'
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
            {{-- assign form model start --}}
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel1" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content ">
                        <div class="modal-header ">
                            <h5 class="modal-title" id="staticBackdropLabels1">Asign {{ $page }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="assign_doc">

                        </div>

                    </div>
                </div>
            </div>

            {{-- edit form model end  --}}
        </div>

    </main>

    <script>
        // $('.assign_doc').on('click', function(){

        //     var doc_d = $(this).attr('doc_id');
        //     if(doc_d !=''){
        //         $('.document_id').val(doc_d);
        //         $('#staticBackdrop1').modal('show');
        //     }
        // });
    </script>
@endsection
