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
            
            @include('admin.payroll.taxs_slab_setting.create')


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">

            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                    @can('add-tax-slab-settings')
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
                                <th>S.no</th>
                                <th>From </th>
                                <th>To</th>
                                <th>For Local Emp Tax</th>
                                <th>For IBO Emp Tax</th>
                                <th>Description</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                           @foreach ($data as $item)
                                <tr>
                                    <td class="table-column-pe-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $item->from }}</td>
                                    <td>{{ $item->to }}</td>
                                    <td>{{$item->additional_local_amount}}+{{ $item->local_tax_per }}%</td>
                                    <td>{{$item->additional_ibo_amount}}+{{ $item->ibo_tax_per }}%</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <form id="edit{{ $item->id }}"
                                            action="{{ route('admin.payroll.tax-slab-setting.destroy', $item->id) }}">
                                            @can('edit-tax-slab-settings')
                                            <button type="button"
                                                onclick="editForm('{{ route('admin.payroll.tax-slab-setting.edit', $item->id) }}', 'edit')"
                                                href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                                class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                            </button>
                                            @endcan
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>                                     
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                
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
        </div>

    </main>
@endsection
