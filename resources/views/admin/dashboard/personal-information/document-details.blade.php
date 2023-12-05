@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">

                    <!-- End Col -->
                    <!-- End Page Header -->

                    <!-- Stats -->
                    <span class="name-title">Personal Information</span>
                    <div class="mt-5">
                        <div class="row d-flex align-items-start">
                            <div class="py-4 border rounded col-xxl-2 col-xl-3 border-1 border-color">
                                @include('admin.dashboard.personal-information.aside')
                                <div class="tab-pane fade ms-5 show active">
                                </div>
                            </div>
                            {{-- <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="py-3 row">
                                        <div class="text-left">
                                           
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="pb-4">
                                            <div class="p-3 card">
                                                <div class="row">
                                                    <div class="col-10 text-dark">
                                                        @if (count($datas) > 0)
                                                        @foreach ($datas as $key => $data)
                                                            <div class="row">
                                                                <div class="pb-4">
                                                                    <div class="p-3 card">
                                                                        <div class="row">
                                                                            <div class="col-9">
                                                                                <div class="row text-dark">
                                                                                    <div class="pt-1 col-3 fw-semibold">Document Name:</div>
                                                                                    <div class="pt-1 col-3">
                                                                                        {{ $data->document->document_name }}
                                                                                    </div>
                
                                                                                    
                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="p-3 mb-5 card">No data to show</div>
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
                            <div class="mx-3 border rounded col-xl-8 col-xxl-9 border-1 border-color">

                                <div class="tab-content this-div" id="v-pills-tabContent">
                                    <div class="py-3 row">
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
                                                    <div class="p-3 card">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="row text-dark">
                                                                    <div class="pt-1 col-3 fw-semibold">Document Name:</div>
                                                                    <div class="pt-1 col-3">
                                                                        {{ ucfirst($data->document->document_name) }}
                                                                    </div>
                                                                   
                                                                    <div class="pt-1 col-3 fw-semibold">Document Type:</div>
                                                                    <div class="pt-1 col-3">
                                                                        {{ ucfirst($data->document->documentType->name) }}
                                                                    </div>                                                                                                                      
                                                                   
                                                                    <div class="pt-1 col-3 fw-semibold">Document:</div>
                                                                    <div class="pt-1 col-3">
                                                                        <a href="{{ asset('assets/document/' . $data->document->document) }}" download>Download</a>
                                                                    </div> 

                                                                    <div class="pt-1 col-3 fw-semibold">Document View</div>
                                                                    <div class="pt-1 col-3">
                                                                        @if (in_array(pathinfo(asset('assets/document/'.$data->document->document), PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                        <img src="{{ asset('assets/document/'.$data->document->document) }}" alt="image" width="70px" height="70px">
                                                                    @elseif (in_array(pathinfo(asset('assets/document/'.$data->document->document), PATHINFO_EXTENSION), ['pdf']))
                                                                        <a href="{{ asset('assets/document/'.$data->document->document) }}" target="_blank">
                                                                            <img src="{{ asset('assets/document/') }}" alt="{{$data->document->document}}" width="70px" height="70px">
                                                                        </a>
                                                                    @endif                                                                    </div>

                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="p-3 mb-5 card">Document is not assigned </div>
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
