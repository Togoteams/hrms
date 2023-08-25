@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="col-xxl-2 col-xl-3  border border-1 border-color rounded py-4">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            {{-- <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-left">
                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="card p-3">
                                                <div class="row">
                                                    <div class="col-10 text-dark">
                                                        @if (count($datas) > 0)
                                                        @foreach ($datas as $key => $data)
                                                            <div class="row">
                                                                <div class="pb-4">
                                                                    <div class="card p-3">
                                                                        <div class="row">
                                                                            <div class="col-9">
                                                                                <div class="row text-dark">
                                                                                    <div class="col-3 fw-semibold pt-1">Document Name:</div>
                                                                                    <div class="col-3 pt-1">
                                                                                        {{ $data->document_name }}
                                                                                    </div>
                
                                                                                    
                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="card p-3 mb-5">No data to show</div>
                                                    @endif
                                                    </div>
                                                    <div class="col-2 text-end">
                                                        <div class="right-div">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-xl-8 col-xxl-9 border border-1 border-color rounded mx-3">

                                <div class="tab-content this-div" id="v-pills-tabContent">
                                    <div class="row py-3">
                                        <div class="text-left">
                                            {{-- <button type="button" class="btn btn-white btn-sm"
                                                onclick="addForm({{ Auth::user()->id }})">
                                                Add 
                                            </button> --}}
                                        </div>
                                    </div>
                                    @if (count($datas) > 0)
                                        @foreach ($datas as $key => $data)
                                            <div class="row">
                                                <div class="pb-4">
                                                    <div class="card p-3">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="col-3 fw-semibold pt-1">Document Name:</div>
                                                                    <div class="col-3 pt-1">
                                                                        {{ $data->document_name }}
                                                                    </div>
                                                                   
                                                                    <div class="col-3 fw-semibold pt-1">Document Type:</div>
                                                                    <div class="col-3 pt-1">
                                                                        {{ $data->document_type }}
                                                                    </div>                                                                                                                      
                                                                   
                                                                    <div class="col-3 fw-semibold pt-1">Document:</div>
                                                                    <div class="col-3 pt-1">
                                                                        <a href="{{ asset('assets/document/' . $data->document) }}" download>Download</a>
                                                                    </div> 

                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card p-3 mb-5">No data to show</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End Stats -->
                </div>

    </main>
@endsection
@push('custom-scripts')
@endpush
