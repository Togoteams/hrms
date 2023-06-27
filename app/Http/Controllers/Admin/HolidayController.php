<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Holiday\HolidayService;
use DB;

class HolidayController extends BaseController
{
    protected $holidayService;
    public function __construct(HolidayService $holidayService)
    {
        $this->holidayService = $holidayService;
    }
    public function viewholiday()
    {
        $filterConditions = [];
        $holidays = $this->holidayService->listholidays($filterConditions, 'id', 'asc');
        return view('admin.holiday.holidays', compact('holidays'));
    }

    public function addholiday(Request $request)
    {
        $holidayId = $request->holiday_id ?? NULL;
        if (!empty($holidayId)) {
            $message = "holiday  Updated Successfully";
        } else {
            $message = "holiday Created Successfully";
        }

        $request->validate([
            'name'     =>  'required|string',
            'date' => 'required',
            'is_optional' => 'required|boolean',
        ]);


        $isholidayCreated = $this->holidayService->createOrUpdateholiday($request->except('_token'), $holidayId);
        if ($isholidayCreated) {
            return   $this->responseJson($isholidayCreated, $message);
        }
    }

    public function deleteholiday(Request $request, $holidayId)
    {
        DB::beginTransaction();
        try {
            $holiday = $this->model::find($holidayId);
            if (!empty($holiday)) {
                $isholidayDeleted = $holiday->delete();
                if ($isholidayDeleted) {
                    DB::commit();
                    $message = 'holiday  deleted successfully';
                    return $this->responseJson('admin.holidays.list', $message);
                }
            } else {
                $message = 'holiday  not found';
                return $this->responseJson('admin.holidays.list', $message);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return   $this->sendError($e->getMessage());
            logger($e->getMessage() . ' -- ' . $e->getLine() . ' -- ' . $e->getFile());
        }
    }
}
