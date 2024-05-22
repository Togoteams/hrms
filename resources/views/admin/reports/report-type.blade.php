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
                  
                    <!-- End Col -->
                    <div class="col-auto">
                        <a class="text-link">
                            Home
                        </a>/Reports
                    </div>
                    <!-- End Col -->
                </div>
                <!-- Button trigger modal -->

                <!-- End Row -->
            </div>
           

            <!-- Card -->
            <div class="mb-3 mb-lg-5">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">     
                      <h5 class="card-title">Salary Report</h5>
                      <a href="{{route('admin.reports.salary-report')}}" class="btn btn-primary">Go</a>
                    </div>
                  </div>
            </div>
                

        </div>

    </main>
@endsection
@push('custom-scripts')
@include('admin.payroll.payscale.payroll-payscale-js')
@endpush
