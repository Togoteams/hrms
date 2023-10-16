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
                    <div class="col">
                        <h1 class="page-header-title">{{ $page }}</h1>
                    </div>
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
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="mt-2 mb-2 text-right col-sm-3 auto">
                     {{-- @can('add-payroll-head')
                    <button type="button" class="btn btn-white btn-sm" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        Add {{ $page }}
                    </button>
                    @endcan --}}

                </div>
            </div>
            @include('admin.payroll.payroll_head.create')


            <!-- Card -->
            <div class="mb-3 card mb-lg-5">


                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-strippedtable-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>

                                <th>S.no</th>
                                <th>Name</th>
                                {{-- <th>Slug</th> --}}
                                <th>Placeholder</th>
                                <th>Employment type</th>
                                <th>Type</th>
                                <th>for</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="table-column-pe-0">
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    {{-- <td>{{ $item->slug }}</td> --}}
                                    <td>{{ $item->placeholder }}</td>
                                    <td>{{ $item->employment_type }}</td>
                                    <td>{{ $item->head_type }}</td>
                                    <td>{{ $item->for }}</td>
                                    <td>
                                        <form id="edit{{ $item->id }}"
                                            action="{{ route('admin.payroll.head.destroy', $item->id) }}">
                                            @can('edit-payroll-head')
                                            <button type="button"
                                                onclick="editForm('{{ route('admin.payroll.head.edit', $item->id) }}', 'edit')"
                                                href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                                class="btn btn-edit btn-sm"><i class="fas fa-edit"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit"></i>
                                            </button>
                                            @endcan
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            @can('delete-payroll-head')
                                            <button type="button" id="delete{{ $item->id }}"
                                                onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                                                class="btn btn-delete btn-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Delete"><i class="fas fa-trash-alt"></i>
                                            </button>
                                            @endcan
                                            @can('status-payroll-head')
                                            <button type="button"
                                                onclick="changeStatus('{{ route('admin.payroll.head.status', $item->id) }}','status{{ $item->id }}')"
                                                id="status{{ $item->id }}"
                                                class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm">
                                                @if ($item->status == 'active')
                                                    <i class="fas fa-check-circle" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Permission"></i>
                                                @else
                                                    <i class="fas fa-times-circle"></i>
                                                @endif
                                            </button>
                                            @endcan
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
