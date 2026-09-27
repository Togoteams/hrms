<?php

use App\Models\User;
use Illuminate\Routing\Route;

/*
| Upgrade safety net: logs in as the seeded admin (id 1) and hits every
| parameterless GET route, asserting none of them blow up with a 5xx.
| Runs against the in-memory SQLite DB configured in phpunit.xml.
*/

// Routes that touch the filesystem/shell or are known-broken targets.
const SMOKE_SKIP = [
    'admin/backups',
    'admin/backups/create',
    'sanctum/csrf-cookie',
    '_ignition/health-check',
];

// Routes that already 5xx on Laravel 10 (baseline captured 2026-09-27).
// The test fails only on routes NOT in this list; remove entries as they get fixed.
const SMOKE_KNOWN_BROKEN = [
    // Real bugs
    'admin/leaves',                                   // App\Http\Controllers\Admin\LeaveController does not exist
    'admin/leaves/add',                               // same
    'admin/leave_reports',                            // leave_types table has no migration
    'admin/leave_reports/create',                     // LeaveReportsController::create() missing
    'admin/reports/reports',                          // view uses undefined route admin.reports.salary-report
    'admin/reports/salary-report',                    // ReportController:35 ->getActiveEmp missing ()
    'admin/payroll/reports/ttum-delete',              // no null check when no report exists
    'admin/payroll/reports/export-payroll-salary-ttum', // same
    'admin/payroll/payscale/tax/cal',                 // no null check on missing input
    // Fail because the seeded admin (id 1) has no Employee record
    'admin/personal-info/contact-details',
    'admin/person-profile/place-of-domicile',
    'admin/employees/list',
    'admin/get_balance_leave',
    'admin/get_approval_authority',
];

function adminGetRoutes(): array
{
    return collect(app('router')->getRoutes()->getRoutes())
        ->filter(fn (Route $r) => in_array('GET', $r->methods())
            && str_starts_with($r->uri(), 'admin/')
            && ! str_contains($r->uri(), '{')
            && ! in_array($r->uri(), SMOKE_SKIP))
        ->map(fn (Route $r) => $r->uri())
        ->values()
        ->all();
}

beforeEach(function () {
    $this->seed();
    $this->admin = User::findOrFail(1);
});

it('redirects guests away from the admin area', function () {
    $this->get('/admin/dashboard')->assertRedirect();
});

it('serves every parameterless admin GET route without a server error', function () {
    $failures = [];

    foreach (adminGetRoutes() as $uri) {
        $response = $this->actingAs($this->admin)->get('/'.$uri);

        if ($response->getStatusCode() >= 500 && ! in_array($uri, SMOKE_KNOWN_BROKEN)) {
            $e = $response->exception;
            $failures[] = sprintf(
                '%d /%s  %s',
                $response->getStatusCode(),
                $uri,
                $e ? class_basename($e).': '.str($e->getMessage())->limit(140) : ''
            );
        }
    }

    expect($failures)->toBe([], "Routes returning 5xx:\n".implode("\n", $failures));
});
