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
            
             @include('admin.payroll.salary_increment_setting.create')


            <!-- Card -->
            <div class="card mb-3 mb-lg-5">

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
                <!-- Table -->
                <div class="table-responsive datatable-custom">
                    <table id="datatable"
                        class="table table-strippedtable-thead-bordered table-nowrap table-align-middle card-table">
                        <thead class="thead-light">
                            <tr>

                                <th>S.no</th>
                                <th>Increment Percentage</th>
                                <th>Employment Type</th>
                                <th>Effective From</th>
                                <th>Effective to</th>
                                <th>Financial Year</th>
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
                                <td>{{$item->increment_percentage}}</td>
                                <td>{{$item->employment_type}}</td>
                                <td>{{$item->effective_from}}</td>
                                <td>{{$item->effective_to}}</td>
                                <td>{{$item->financial_year}}</td>
                                <td>
                                    <div class="success-badges changeStatus" data-table="payroll_salary_increments" data-uuid="{{$item->id}}"
                                    data-message="inactive" @if($item->status=="active") data-value="active" @else data-value="inactive" @endif ><span class="legend-indicator bg-success">
                                    </span>{{ $item->status ?? 'Active' }}</div>
                                </td>
                                <td style="text-align:right;">
                                    <form id="edit{{ $item->id }}"
                                        action="{{ route('admin.payroll.salary-increment-setting.destroy', $item->id) }}">
                                        <button type="button"
                                            onclick="editForm('{{ route('admin.payroll.salary-increment-setting.edit', $item->id) }}', 'edit')"
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
