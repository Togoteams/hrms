@extends('layouts.app')
@push('styles')
    <style>
        .table-nowrap td,
        .table-nowrap th {
            white-space: normal !important;
        }
    </style>
@endpush
@section('content')
    <main id="content" role="main" class="main card ">
        <!-- Content -->
        <div class="container-fluid">
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
                <div class="p-5 card">
                    <form id="form_data" action="{{ route('admin.employee-kra.store') }}">
                        @csrf
                        <input type="hidden" name="created_at" value="{{ date('Y-m-d h:s:i') }}">

                        <div class="row">
                            <div class="mb-2 col-sm-4">
                                <div class="form-group">
                                    <label for="name">Select Employees</label>
                                    <select required onchange="show_user()" id="gender"
                                        placeholder="Enter correct gender   " name="user_id"
                                        class="form-control form-control-sm select2 ">
                                        <option selected disabled> - Select Employees- </option>
                                        @foreach ($all_users as $au)
                                            <option value="{{ $au->user->id }}">{{ $au->user->name }} -
                                                {{ $au->ec_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive-lg" style="display: none" id="table_data">
                                <table class="table table-bordered table-nowrap table-align-middle card-table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>ATTRIBUTES </th>
                                            <th>COMMENT OF REPORTING AUTHORITY</th>
                                            <th>MAX. MARKS</th>
                                            <th>MARKS AWARDED BY REPORTING AUTHORITY</th>
                                            <th>MARKS AWARDED BY REVIEWING AUTHORITY </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kra_attributes as $kra)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td style="max-width:220px;"> <b>{{ $kra->name }} -
                                                        {{ $kra->description }}</b>

                                                    <input required type="hidden" name="attribute_name[]"
                                                        value="{{ $kra->name }}">
                                                    <input required type="hidden" name="attribute_description[]"
                                                        value="{{ $kra->description }}">
                                                </td>
                                                <td>
                                                    <textarea required type="text" class="form-control form-control-sm" name="commects[]"></textarea>
                                                </td>
                                                <td>{{ $kra->max_marks }}
                                                    <input required type="hidden" name="max_marks[]"
                                                        value="{{ $kra->max_marks }}">
                                                </td>
                                                <td><input required type="number" maxlength="2"
                                                        class="form-control form-control-sm"
                                                        name="marks_by_reporting_autheority[]"></td>
                                                <td><input required type="number" maxlength="2"
                                                        class="form-control form-control-sm"
                                                        name="marks_by_review_autheority[]"> </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="text-center " style="display: none" id="table_data_btn">
                            @if (count($kra_attributes) <= 0)
                                Go to ->
                                <a href="{{ route('admin.kra-attributes.index') }}"
                                    class="text-danger errormax_marks fw-bolder"><u> Create KRA </u></a>
                                Attribute(s) first
                            @else
                                <button type="button" onclick="ajaxCall('form_data')" class="btn btn-white"
                                    {{ count($kra_attributes) > 0 ? '' : 'disabled' }}>
                                    Add {{ $page }}
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

<script>
    function show_user() {
        document.getElementById('table_data').style.display = "block";
        document.getElementById('table_data_btn').style.display = "block";
    }
</script>
