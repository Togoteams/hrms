@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class=" border-bottom mt-2 mb-2">
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

            @include('admin.kra_attributes.create')


            <!-- Card -->
            <div class="card mb-3 mb-lg-5">

            <div class="page-header">
                <div class="row">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h2 class="page-header-title">{{ $page }}</h2>
                    </div>
                    <div class="col-sm-auto">
                        @can('add-attributes')
                        <button type="button" class="btn btn-white" data-bs-toggle="modal"
                                data-bs-target="#staticBackdrop">
                                Add {{ $page }}
                            </button>
                        @endcan
                    </div>
                </div>
            </div>
                <!-- Table -->
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-strippedtable-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr class="pl-2">


                                <th>S.no</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Max Marks</th>
                                <th>Min Marks</th>

                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td style="padding-left: 20px !important;">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->max_marks }}</td>
                                    <td>{{ $item->min_marks }}</td>

                                    <td class="text-right">


                                        <form id="edit{{ $item->id }}"
                                            action="{{ route('admin.kra-attributes.destroy', $item->id) }}">
                                            @can('edit-attributes')
                                            <button type="button"
                                                onclick="editForm('{{ route('admin.kra-attributes.edit', $item->id) }}', 'edit')"
                                                href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                                class="btn btn-edit btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i>
                                            </button>
                                            @endcan
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            @can('delete-attributes')
                                            <button type="button" id="delete{{ $item->id }}"
                                                onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                                                class="btn btn-delete btn-sm"><i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                            </button>
                                            @endcan

                                            @can('change-status-attributes')
                                            {{-- <button type="button"
                                                onclick="changeStatus('{{ route('admin.kra-attributes.status', $item->id) }}','status{{ $item->id }}')"
                                                id="status{{ $item->id }}"
                                                class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm">
                                                @if ($item->status == 'active')
                                                    <i class="fas fa-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Permission"></i>
                                                @else
                                                    <i class="fas fa-times-circle"></i>
                                                @endif
                                            </button> --}}
                                            <button type="button" data-table="kra-attributes" data-uuid="{{$item->id}}"
                                                @if($item->status=="active") data-value="inactive" data-message="Inactive"  @else data-value="active" data-message="Active" @endif
                                                class="btn btn-edit btn-sm changeStatus" ><i class="fas  @if($item->status=="active") fa-toggle-on  @else fa-toggle-off @endif"
                                                    @if($item->status=="active") title="Active"  @else title="Inactive" @endif  data-bs-toggle="tooltip"  ></i>
                                            </button>
                                            @endcan
                                        </form>
                                        {{-- <button target="_blank" href="{{ route('admin.kra-attributes.edit', $item->id) }}"
                                            class="btn btn-edit btn-sm"><i class="far fa-show"></i></button> --}}


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
        </div>

    </main>
@endsection
