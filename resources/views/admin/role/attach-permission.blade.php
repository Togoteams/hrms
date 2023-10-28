@extends('layouts.app')
@push('styles')
@endpush
@section('content')
    <main id="content" role="main" class="main">
        <!-- Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="mb-2 col-sm mb-sm-0">
                        <h1 class="page-header-title">Allow Permission of ({{$roleData->name}})</h1>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            <!-- Card -->
            <div class="card">
                <div class="p-5 b-t b-slate-200">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2 col">
                            <div class="bg-white rounded-sm col-span-full sm:col-span-6 xl:col-span-4 s b b-slate-200">
                                <div class="flex flex-col h-full">
                                    <!-- Card top -->
                                    <div class="p-3 grow">
                                        <!-- Bio -->
                                        <div class="mt-2">
                                            <label class="flex items-center">
                                                <input type="checkbox" class="form-checkbox" name="permission[]"
                                                    value="view-dashboard"
                                                    @if ($roleData->hasPermission('view-dashboard')) checked @endif />
                                                <span class="ml-2 text-sm">View Dashboard Page</span>
                                            </label>
                                            <div class="ml-2 text-sm text-muted">
                                                * N.B: If This is Not checked user will be redirected to Accounts Page
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6">
                            <!-- Users cards -->
                            @forelse ($permissions as $key => $chunk)
                                <!-- Card 1 -->
                                <div class="bg-white rounded-sm col-span-full sm:col-span-6 xl:col-span-3 s b b-slate-200">
                                    <div class="flex flex-col h-full">
                                        <!-- Card top -->
                                        <div class="p-3 grow">
                                            <h4>{{$key}}</h4>
                                            @forelse ($chunk as $permission)
                                                <div class="mt-2 text-justify">
                                                    <div class="text-sm">
                                                        <label class="flex items-center">
                                                            <input type="checkbox" class="form-checkbox" name="permission[]"
                                                                value="{{ $permission->slug }}"
                                                                @if ($roleData->hasPermission($permission->slug)) checked @endif />
                                                            <span class="ml-2">{{ $permission->name }}</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                            
                        </div>
                        <div class="mt-8 space-y-8">
                            <div class="">
                                <!-- Add Admin button -->
                                <button class="btn btn-white" type="submit">
                                    <span class="hidden ml-2 xs:block">Save Permission</span>
                                </button>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Content -->

    </main>



@endsection
