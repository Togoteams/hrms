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
                    <div class="col-sm mb-2 mb-sm-0">
                        <h1 class="page-header-title">Roles: Attach Permission</h1>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Page Header -->
            <!-- Card -->
            <div class="card">
                <div class="border-t border-slate-200">
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col mb-2">
                            <div
                                class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-slate-200">
                                <div class="flex flex-col h-full">
                                    <!-- Card top -->
                                    <div class="grow p-3">
                                        <!-- Bio -->
                                        <div class="mt-2">
                                            <label class="flex items-center">
                                                <input type="checkbox" class="form-checkbox" name="permission[]"
                                                    value="view-dashboard"
                                                    @if ($roleData->hasPermission('view-dashboard')) checked @endif />
                                                <span class="text-sm ml-2">View Dashboard Page</span>
                                            </label>
                                            <div class="text-sm text-muted ml-2">
                                                * N.B: If This is Not checked user will be redirected to Accounts Page
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-6">
                            <!-- Users cards -->
                            @forelse ($permissions as $chunk)
                                <!-- Card 1 -->
                                <div
                                    class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200">
                                    <div class="flex flex-col h-full">
                                        <!-- Card top -->
                                        <div class="grow p-3">
                                            @forelse ($chunk as $permission)
                                                <div class="text-justify mt-2">
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
                            <div class="col-span-full sm:col-span-6 xl:col-span-3 bg-white shadow-lg rounded-sm border border-slate-200">
                                <div class="flex flex-col h-full">
                                    <!-- Card top -->
                                    <div class="grow p-3">
                                        <div class="text-justify mt-2">
                                            <div class="text-sm">
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="permission[]"
                                                        value="view-delivery"
                                                        @if ($roleData->hasPermission('view-delivery')) checked @endif />
                                                    <span class="ml-2">View Delivery</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-justify mt-2">
                                            <div class="text-sm">
                                                <label class="flex items-center">
                                                    <input type="checkbox" class="form-checkbox" name="permission[]"
                                                        value="edit-delivery"
                                                        @if ($roleData->hasPermission('edit-delivery')) checked @endif />
                                                    <span class="ml-2">Edit Delivery</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 space-y-8">
                            <div class="">
                                <!-- Add Admin button -->
                                <button class="btn btn-primary" type="submit">
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
