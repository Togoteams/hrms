<?php

use Carbon\Carbon;

/*
| Tripwires for the Carbon 2 -> 3 jump (mandatory from Laravel 12).
| Carbon 3's diffIn*() returns signed floats instead of absolute ints.
| If these fail after upgrading, fix the call sites listed below, not the test.
*/

afterEach(fn () => Carbon::setTestNow());

it('diffInDays is a non-negative int even when the start date is in the future', function () {
    // PayRollPayscaleCotroller.php:84 passes this into getTaxAmount() as no_of_joining_days
    Carbon::setTestNow('2026-09-27 00:00:00');
    $futureJoin = Carbon::parse('2026-10-07');

    $days = $futureJoin->diffInDays(Carbon::today());

    expect($days)->toBeInt()->toBe(10);
});

it('diffInMinutes is a whole number for the 15-minute reset-link check', function () {
    // UserAccountController.php:73
    Carbon::setTestNow('2026-09-27 10:15:30');
    $generatedAt = Carbon::parse('2026-09-27 10:00:00');

    expect($generatedAt->diffInMinutes(Carbon::now()))->toBeInt()->toBe(15);
});

it('diffInMonths helper counts whole months between Y-m-d dates', function (string $from, string $to, int $expected) {
    expect(diffInMonths($from, $to))->toBe($expected);
})->with([
    // NOTE: pins current behaviour, which looks off-by-one (feeds arrears in PayrollSalaryController:218/463).
    'same day (returns -1)'   => ['2026-01-15', '2026-01-15', -1],
    'exact month (returns 0)' => ['2026-01-15', '2026-02-15', 0],
    'one day short'        => ['2026-01-15', '2026-02-14', 0],
    'one month and a day'  => ['2026-01-15', '2026-02-16', 1],
    'across a year'        => ['2025-11-10', '2026-02-11', 3],
]);
