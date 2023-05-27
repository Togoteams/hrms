@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class=" border-bottom mt-2 mb-2">
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
                <div class="col-sm-3 text-right auto mb-5 mt-2">

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            Add {{ $page }}
                        </button>

                </div>
            </div>
            @include('admin.branch.create')


            <!-- Card -->
            <div class="card mb-3 mb-lg-5">


                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr class="pl-2">

                                <th>S.no</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>address</th>
                                <th>city</th>
                                <th>state</th>
                                <th>country</th>
                                <th>landmark</th>
                                <th>description</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>
                                        {{ $loop->index + 1 }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->state }}</td>
                                    <td>{{ $item->country }}</td>
                                    <td>{{ $item->landmark }}</td>
                                    <td>{{ $item->description }}</td>

                                    <td>


                                        <form id="edit{{ $item->id }}"
                                            action="{{ route('admin.branch.destroy', $item->id) }}">
                                            <button type="button"
                                                onclick="editForm('{{ route('admin.branch.edit', $item->id) }}', 'edit')"
                                                href="#" data-bs-toggle="modal" data-bs-target="#modaledit"
                                                class="btn btn-warning btn-sm"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></button>
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="button" id="delete{{ $item->id }}"
                                                onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
                                                class="btn btn-danger btn-sm"><i class="fas fa-trash-alt" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i>
                                            </button>

                                            <button type="button"
                                                onclick="changeStatus('{{ route('admin.branch.status', $item->id) }}','status{{ $item->id }}')"
                                                id="status{{ $item->id }}"
                                                class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm">
                                                @if ($item->status == 'active')
                                                    <i class="fas fa-check-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Permission"></i>
                                                @else
                                                    <i class="fas fa-times-circle"></i>
                                                @endif
                                            </button>
                                        </form>
                                        {{-- <button target="_blank" href="{{ route('admin.branch.edit', $item->id) }}"
                                            class="btn btn-warning btn-sm"><i class="far fa-show"></i></button> --}}


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
