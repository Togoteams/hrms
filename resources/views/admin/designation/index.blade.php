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
                    <!-- <div class="col">
                        <h1 class="page-header-title">{{ $page }}</h1>
                    </div> -->
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
            
            @include('admin.designation.create')


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">

            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                        @can('add-designations')
                       <button type="button" class="btn btn-white" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add {{ $page }}
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-stripped table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>

                                <th>S.no</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="table-column-pe-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                               
                                    <td style="text-align:right;">
                                        
                                     

                                            
                                        <form id="edit{{ $item->id }}"
                                            action="{{ route('admin.designation.destroy', $item->id) }}">
                                            <button type="button" data-table="designations" data-uuid="{{$item->id}}"
                                                @if($item->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
                                                class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($item->status=="active") fa-toggle-on  @else fa-toggle-off @endif" @if($item->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"  ></i>
                                            </button>
                                            @can('edit-designations')
                                            <button type="button"
                                                onclick="editForm('{{ route('admin.designation.edit', $item->id) }}', 'edit')"
                                                href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                                class="btn btn-edit btn-sm" ><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                            </button>
                                            @endcan
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            @can('delete-designations')
                                            <button type="button" id="delete{{ $item->id }}"
                                                onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                                                class="btn btn-delete btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
                                            </button>
                                            @endcan
                                        </form>
                                        {{-- <button target="_blank" href="{{ route('admin.designation.edit', $item->id) }}"
                                            class="btn btn-edit btn-sm"><i class="far fa-show"></i></button> --}}

                                        {{-- <button href="{{ route('admin.designation.status', $item->id) }}"
                                            class="btn @if ($item->status == 1) btn-success @endif btn-secondary  btn-sm">
                                            @if ($item->status == 1)
                                                Active
                                            @else
                                                Deactive
                                            @endif
                                        </button> --}}
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
