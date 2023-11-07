@extends('layouts.app')
@push('styles')
@endpush
@section('content')
<main id="content" role="main" class="main">
    <div class="container-fluid">
        <div class="mt-2 mb-2 border-bottom">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="page-header-title text-dark ">Setting</h1>
                </div>

                <div class="col-auto">
                    <a class="text-link">
                        Home
                    </a>/ Setting
                </div>
            </div>
        </div>

        <div class="px-2 py-4 row card">
            <div class="cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Payroll Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Payroll Enabled</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Payroll Dat</td>
                                    <td class="fw-semibold text-dark">-NA-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Payroll AutoPilot </td>
                                    <td class="fw-semibold text-dark">No</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Advance Salary Requests</td>
                                    <td class="fw-semibold text-dark">Enabled</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Default Salary Structure</td>
                                    <td class="text-right fw-medium text-danger">Edit</td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Employee Notifications</td>
                                    <td class="text-right fw-medium text-danger">Edit</td>
                                </tr>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Payments & Compliance Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Automated 24Q Filing	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Automated 26Q Filing	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">TDS Payment (employees)	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">TDS Payment (contractors)	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">PF Payment	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark">ESI Payment	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark">Professional Tax Payment	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">TDS Filing Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Automated 24Q Filing	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Automated 26Q Filing	</td>
                                    <td class="fw-semibold text-dark">No</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Employee Data</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Employee ID Prefix	</td>
                                    <td class="fw-semibold text-gray">-NA-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Employee Directory	</td>
                                    <td class="fw-semibold text-dark">Enable</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Additional Info Requested	</td>
                                    <td class="fw-semibold text-grey">-NA-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Separate contractor ID series	</td>
                                    <td class="fw-semibold text-dark">Disabled</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Holidays, Leaves & Attendance</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Attendance Enabled	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Weekend</td>
                                    <td class="fw-semibold text-grey">-NA-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Types of Leaves	</td>
                                    <td class="fw-semibold text-grey">-NA-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Holidays</td>
                                    <td class="fw-semibold text-dark">0</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Track Shift Timings	</td>
                                    <td class="fw-semibold text-dark">No</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Tax Deductions Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Updates Require Admin Approval	</td>
                                    <td class="fw-semibold text-dark">No</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">XPayroll Verification of Tax Deductions	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Tax Calculations to be done on	</td>
                                    <td class="fw-semibold text-dark">Amount declared by the employee</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">FBP Allowances taxable by default	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Financial Year	</td>
                                    <td class="fw-semibold text-dark">Auto Select</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Reimbursements Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Reimbursements Enabled	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Pay Reimbursements with Salary	</td>
                                    <td class="fw-semibold text-dark">Yes</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Attachments compulsory	</td>
                                    <td class="fw-semibold text-dark">No</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Documents Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Compulsory Documents	</td>
                                    <td class="fw-semibold text-dark">None</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Contractor Payments Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Invoices Compulsory	</td>
                                    <td class="fw-semibold text-dark">No</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">API Access</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">API Key		</td>
                                    <td class="fw-semibold text-dark">Not Set</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">User Roles</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">CREATE/EDIT ROLES</button>

                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-12 col-sm-12">
                        <h4 class="text-dark">Collaborators</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Collaborators: <span class="text-grey">Username</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Document Templates</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Available Templates	</td>
                                    <td class="fw-semibold text-dark">7</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Integrations</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">KlaarHQ</td>
                                    <td class="fw-semibold text-dark">Disabled</td>
                                    <td class="text-right fw-semibold text-danger">Edit</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">XPayroll	</td>
                                    <td class="fw-semibold text-dark">Disabled</td>
                                    <td class="text-right fw-semibold text-danger">Edit</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 cards">
                <div class="row">
                    <div class="mb-2 col-md-8 col-sm-12">
                        <h4 class="text-dark">Employee Resignation Setup</h4>
                    </div>
                    <div class="mb-2 text-right border-b-2 col-md-4 col-sm-12">
                        <button type="button" class="btn btn-delete btn-sm">Edit</button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-right text-dark" style="width:25%">Enabled</td>
                                    <td class="fw-semibold text-dark">No</td>
                                    <td class="text-right fw-semibold text-danger">Edit</td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('custom-scripts')
@endpush