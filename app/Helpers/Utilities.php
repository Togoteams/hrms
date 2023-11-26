<?php

use App\Models\CurrencySetting;
use App\Models\Role;
use App\Models\UsersRoles;
use Illuminate\Support\Str;
use Intervention\Image\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\LeaveApply;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\LeaveEncashment;
use App\Models\MedicalCard;
use App\Models\LeaveTimeApprovel;
use App\Models\OvertimeSetting;
use App\Models\PayrollSalaryIncrement;
use App\Models\Reimbursement;
use App\Models\LeaveSetting;
use App\Models\EmplooyeLoans;
use App\Models\Holiday;
use App\Models\LeaveDate;

if (!function_exists('isSluggable')) {
    function isSluggable($value)
    {
        return Str::slug($value);
    }
}

if (!function_exists('splitName')) {
    function splitName($name)
    {
        $name_arr = [];
        if (!empty($name)) {
            $name_arr2 = explode(" ", $name);

            $name_arr[] = trim($name_arr2[0]);
            $name_arr[] = trim(!empty($name_arr2[1]) ? substr($name, strlen($name_arr2[0]) + 1) : '');
        }

        return $name_arr;
    }
}
if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number)
    {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convertNumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convertNumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . convertNumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= convertNumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }
}

/**
 * Calculate the difference in months between two dates (v1 / 18.11.2013)
 *
 * @param \DateTime $date1
 * @param \DateTime $date2
 * @return int
 */
if (!function_exists('diffInMonths')) {
    function diffInMonths($startDate, $endDate)
    {

        // function diffInMonths(\DateTime $date1, \DateTime $date2)
        // {
        $retval = "";

        // Assume YYYY-mm-dd - as is common MYSQL format
        $splitStart = explode('-', date('Y-m-d', strtotime($startDate)));
        $splitEnd = explode('-', date('Y-m-d', strtotime($endDate)));

        if (is_array($splitStart) && is_array($splitEnd)) {
            $difYears = $splitEnd[0] - $splitStart[0];
            $difMonths = $splitEnd[1] - $splitStart[1];
            $difDays = $splitEnd[2] - $splitStart[2];

            $retval = ($difDays > 0) ? $difMonths : $difMonths - 1;
            $retval += $difYears * 12;
        }
        return $retval;
        // return (int) round($months);
    }
}

if (!function_exists('isMobileDevice')) {
    function isMobileDevice()
    {
        return preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
                            |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        );
    }
}

if (!function_exists('formateDate')) {
    function formateDate($date, $format = 'd-m-Y')
    {

        $formatData = date($format, strtotime($date));
        return  $formatData;
    }
}
if (!function_exists('pulaToUsd')) {
    function pulaToUsd($amount)
    {
        $pula = 13.06;
        $usd = $amount / $pula;
        return $usd;
    }
}
if (!function_exists('usdToPula')) {
    function usdToPula($amount)
    {
        $usd = 13.06;
        $pula = $amount * $usd;
        return $pula;
    }
}
if (!function_exists('inrToUsd')) {
    function inrToUsd($amount)
    {
        $inr = 82.04;
        $usd = $amount / $inr;
        return $usd;
    }
}

if (!function_exists('sidebar_open')) {
    function sidebar_open($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? 'text-indigo-500' : 'text-slate-200';
    }
}
if (!function_exists('slide_down')) {
    function slide_down($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? '!block' : 'hidden';
    }
}
if (!function_exists('arrow_down')) {
    function arrow_down($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? 'rotate-180' : 'rotate-0';
    }
}
if (!function_exists('sidebar_inner_open')) {
    function sidebar_inner_open($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? 'text-indigo-500' : 'text-slate-400';
    }
}

if (!function_exists('sidebar_menu_open')) {
    function sidebar_menu_open($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? 'bg-slate-900' : '';
    }
}

if (!function_exists('auth_sidebar')) {
    function auth_sidebar($routes = [])
    {
        $currRoute = Route::currentRouteName();
        $open = false;
        foreach ($routes as $route) {
            if (str_contains($route, '*')) {
                if (str_contains($currRoute, substr($route, 0, strpos($route, '*')))) {
                    $open = true;
                    break;
                }
            } else {
                if ($currRoute === $route) {
                    $open = true;
                    break;
                }
            }
        }

        return $open ? 'active' : '';
    }
}

if (!function_exists('getS3URL')) {
    function getS3URL($filePath, $fileType = '', $fileAccessMode = 'private')
    {
        $storageDisk = Storage::disk('s3');

        if ($storageDisk->exists($filePath)) {
            if ($fileAccessMode == 'public') {
                $url = $storageDisk->url($filePath);
            } else if ($fileAccessMode == 'private') {
                $url = $storageDisk->temporaryUrl(
                    $filePath,
                    now()->addMinutes(10080)
                );
            }

            return $url;
        } else {
            if ($fileType == 'profilePicture') {
                return asset('assets/frontend/images/no-profile-picture.jpeg');
            } else if ($fileType == 'postImage') {
                //return 'https://dummyimage.com/540x400/ffffff/2a3680.png&text=Unable+to+load+this+file';
                return asset('assets/frontend/images/no-image-medium.png');
            } else if ($fileType == 'collectionImage') {
                //return 'https://dummyimage.com/150x150/ffffff/2a3680.png&text=Unable+to+load+this+file';
                return asset('assets/frontend/images/no-image-small.png');
            } else if ($fileType == 'profilePhotoId') {
                return asset('assets/frontend/images/file-not-found.png');
            } else if ($fileType == 'cityImage') {
                return asset('assets/frontend/images/location-placeholder.jpeg');
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('imageResizeAndSave')) {
    function imageResizeAndSave($imageUrl, $type = 'post/image', $filename = null)
    {
        if (!empty($imageUrl)) {


            Storage::disk('public')->makeDirectory($type . '/60x60');
            $path60X60     = storage_path('app/public/' . $type . '/60x60/' . $filename);
            $image = Image::make($imageUrl)->resize(
                null,
                60,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            );
            //$canvas->insert($image, 'center');
            $image->save($path60X60, 70);

            //save 350X350 image
            Storage::disk('public')->makeDirectory($type . '/350x350');
            $path350X350     = storage_path('app/public/' . $type . '/350x350/' . $filename);
            $image = Image::make($imageUrl)->resize(
                null,
                350,
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            );

            $image->save($path350X350, 75);

            return $filename;
        } else {
            return false;
        }
    }
}

if (!function_exists('siteSetting')) {
    function siteSetting($key = '')
    {
        return \App\Models\Setting::where('key', $key)->value('value');
    }
}

if (!function_exists('uuidtoid')) {
    function uuidtoid($uuid, $table)
    {
        $dbDetails = DB::table($table)
            ->select('id')
            ->where('uuid', $uuid)->first();

        if ($dbDetails) {
            return $dbDetails->id;
        } else {
            abort(404);
        }
    }
}

if (!function_exists('customfind')) {
    function customfind($id, $table)
    {
        $dbDetails = DB::table($table)
            ->find($id);
        if ($dbDetails) {
            return $dbDetails;
        } else {
            abort(404);
        }
    }
}

if (!function_exists('safe_b64encode')) {
    function safe_b64encode($string)
    {
        $pretoken = "";
        $posttoken = "";

        $codealphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codealphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codealphabet .= "0123456789";
        $max = strlen($codealphabet); // edited

        for ($i = 0; $i < 3; $i++) {
            $pretoken .= $codealphabet[rand(0, $max - 1)];
        }

        for ($i = 0; $i < 3; $i++) {
            $posttoken .= $codealphabet[rand(0, $max - 1)];
        }

        $string = $pretoken . $string . $posttoken;
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }
}

if (!function_exists('safe_b64decode')) {
    function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }

        $data = base64_decode($data);
        $data = substr($data, 3);
        $data = substr($data, 0, -3);

        return $data;
    }
}
if (!function_exists('getCurrencyIcon')) {
    function getCurrencyIcon($currency)
    {
        $data =$currency;
        if(strtolower($currency)=='usd')
        {
            $data ="$";
        }elseif(strtolower($currency)=='inr'){
            $data ='₹';
        }else
        {
            $data ="P";
        }

        return $data;
    }
}

if (!function_exists('getLeavesSalary')) {
    function getLeavesSalary($emp,$salaryMonth)
    {
        $salaryStartDate = date('Y-'.$salaryMonth.'-01');
        $salaryEndDate = date('Y-'.$salaryMonth.'-31');
        $totalAvailLeave = 0;
        $noOfPaidLeave = DB::table("leave_applies")->where('start_date',">=",$salaryStartDate)->where('end_date','<=',$salaryEndDate)->where(['user_id'=>$emp])->where('is_approved',1)->get();
        $noOfUnpaidLeave = DB::table("leave_applies")->where('start_date',">=",$salaryStartDate)->where('end_date','<=',$salaryEndDate)->where(['user_id'=>$emp])->where('is_approved',1)->get();
         //dd($leavebalance);
        //  $noOfPaidLeave = 0;
        //  $noOfUnpaidLeave = 0;
        return ['total_avail_leave_count'=>$totalAvailLeave,'no_of_paid_leave'=>$noOfPaidLeave,'no_of_unpaid_leave'=>$noOfUnpaidLeave];
        
    }
}
if (!function_exists('getHeadValue')) {
    function getHeadValue($emp, $headSlug,$type="payscale",$basic=0,$orginalValue=0,$salary_month="")
    {
        $basicAmout = $basic;
        $startDate =date("Y-m-20", strtotime("-1 month"));
        $endDate = date("Y-m-20");
        /**
         * If Salary Month is empty then salary will be make as for current month
         */
        if(!empty($salary_month))
        {
            $startDate = date("Y-m-d", strtotime("-1 months",strtotime($salary_month."-20")));
            $endDate = date("Y-m-d", strtotime($salary_month."-20"));
        }
        $employmentType = $emp->employment_type ;
        $multipleValue = 1;
        if($employmentType=="expatriate")
        {
            $currencySeeting = CurrencySetting::where('currency_name_from','usd')->where('currency_name_to','pula')->where('status','active')->first();
            $multipleValue = $currencySeeting->currency_amount_to;
        }
        // if($basic==0)
        // {
        //     $basicAmout = $emp->basic_salary * $multipleValue;
        // }
        if ($headSlug == "bomaid") {
            $bomaidAmount = 0;
            $bomaidTypeId = $emp->amount_payable_to_bomaind_each_year;
            $bomaid = MedicalCard::find($bomaidTypeId);
            if (!empty($bomaid)) {
                $bomaidAmount = $bomaid->amount / 2;
            }
            return $bomaidAmount;
        } elseif ($headSlug == "pension") {
            $isPensionApplied = $emp->pension_contribution;
            if ($isPensionApplied == "yes") {
                $pensionAmount = ($basicAmout / 100) * $emp->pension_opt;
                return $pensionAmount;
            }
        } elseif ($headSlug == "provident_fund") {
            $inrBasicAmount = $emp->basic_salary_for_india;

            if($emp->salary_type=="npfs")
            {
                $inrBasicAmount = $emp->basic_salary_for_india  +  ((($inrBasicAmount / 100)) * $emp->da) ;
            }
            $inrToPulaAmount = 1;
            $pulaToUSDAmount = 1;
            $currencySeeting = CurrencySetting::where('currency_name_from','inr')->where('currency_name_to','pula')->first();
            if(!empty($currencySeeting))
            {
                $inrToPulaAmount = $currencySeeting->currency_amount_to;
            }
            $currencySeeting = CurrencySetting::where('currency_name_from','pula')->where('currency_name_to','usd')->first();
            if(!empty($currencySeeting))
            {
                $pulaToUSDAmount = $currencySeeting->currency_amount_to;
            }
            // if ($isPensionApplied == "yes") {
            $providentFound = ((($inrBasicAmount / 100)) * 10);
            $providentFound = $providentFound * number_format($inrToPulaAmount * $pulaToUSDAmount,3,'.',"");
            return number_format($providentFound,2,'.',"");
            // }
        }elseif ($headSlug == "house_up_keep_allow") {
            $houseUpKeepAllow = 0;
            $houseUpKeepAllow = ($basicAmout / 100) * 10;
            return $houseUpKeepAllow;
        } elseif ($headSlug == "union_fee") {
            $isUnionFee = $emp->union_membership_id;
            $unionFee = 0;
            if ($isUnionFee == "yes") {
                $unionFee = ($basicAmout / 100);
            }
            return $unionFee;
        } elseif ($headSlug == "over_time") {
            $hoursInMonth = 192;
            $perHoursRate = $basicAmout / $hoursInMonth;
            $overTimeAmount = 0;
            $overtimes = OvertimeSetting::where('date',">=",$startDate)->where('user_id',$emp->user_id)->where('date','<=',$endDate)->get();
            foreach($overtimes  as $key => $overtime)
            {
                if($overtime->overtime_type=="holiday")
                {
                    $overTimeAmount = $overTimeAmount + $overtime->working_hours * ($perHoursRate*2);  
                }else
                {
                    $overTimeAmount = $overTimeAmount + $overtime->working_hours * ($perHoursRate*1.5);  
                }
            }
            return number_format($overTimeAmount,'.',"");
        
        } elseif ($headSlug == "others_arrears") {
           $currentYear = date('Y');
           $currentMonth = date('m');
           $arrearsAmount = 0;
           $salaryIncrement = PayrollSalaryIncrement::where('financial_year',$currentYear)->
           whereBetween('effective_from', array($startDate, $endDate))
        //    ->where('effective_from','>=',date('Y-m-d'))->where('effective_to','<=',date('Y-m-d'))
           ->where('employment_type',$emp->employment_type)->first();
            if(!empty($salaryIncrement))
            {
                // $noOfPendingMonth = $currentMonth;
                $arrearsAmount = (($basicAmout / 100) * $salaryIncrement->increment_percentage) * $currentMonth;
            }
            return $arrearsAmount;
        } elseif ($headSlug == "reimbursement") {
            $reimbursementAmount = 0;
            $reimbursements = Reimbursement::whereBetween('claim_date', array($startDate, $endDate))

            // ->where('user_id',$emp->user_id)
            ->where('status','approved')
            ->get();
            foreach($reimbursements as $reimbursement)
            {
                if($reimbursement->reimbursement_currency=="usd")
                {
                    $reimbursementAmount = $reimbursementAmount + $reimbursement->reimbursement_amount * $multipleValue;
                }else
                {
                    $reimbursementAmount = $reimbursementAmount + $reimbursement->reimbursement_amount;
                }
            }
            return $reimbursementAmount;
         }elseif ($headSlug == "loan") {
            $loanAmount = 0;
            $loan = EmplooyeLoans::
            where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($q1) use ($startDate, $endDate) {
                    $q1->whereBetween('emi_start_date', array($startDate, $endDate));
                })
                ->orWhere(function ($q2) use ($startDate, $endDate) {
                    $q2->where('emi_start_date', '<=', $startDate)
                    ->where('emi_end_date', '>=', $endDate);
                })
                ->orWhere(function ($q3) use ($startDate, $endDate) {
                    $q3->whereBetween('emi_end_date', array($startDate, $endDate));
                })
                ;
            })->
            where('user_id',$emp->user_id)
            ->first();
            $loanAmount = $loan->emi_amount ?? 0;
            return $loanAmount;
         }
        return $orginalValue;
    }
}
if (!function_exists('customEcho')) {
    function customEcho($str, $length)
    {
        if (strlen($str) <= $length) return $str;
        else return substr($str, 0, $length) . '...';
    }
}

if (!function_exists('trasactionPriceBreakUp')) {
    function trasactionPriceBreakUp($purchaseItemPrice)
    {
        $purchaseItemVatPrice = 0;

        $purchaseItemVatPrice = 0;


        $purchaseItemTotalPrice = ($purchaseItemPrice + $purchaseItemVatPrice);

        return [
            'purchaseItemPrice'      => $purchaseItemPrice,
            'purchaseItemVatPrice'   => $purchaseItemVatPrice,
            'purchaseItemTotalPrice' => $purchaseItemTotalPrice
        ];
    }
}

if (!function_exists('formatTime')) {
    function formatTime($time)
    {
        return Carbon::parse($time)->format('dS M, Y, \\a\\t\\ g:i A');
    }
}

if (!function_exists('getSiteSetting')) {
    function getSiteSetting($key)
    {
        return \App\Models\Setting::where('key', $key)->value('value');
    }
}

if (!function_exists('mime_check')) {
    function mime_check($path)
    {
        if ($path) {
            $typeArray = explode('.', $path);
            $fileType = strtolower($typeArray[count($typeArray) - 1]) ?? 'jpg';
            if ($fileType == 'png') {
                return 'image/png';
            } elseif ($fileType == 'jpg' || $fileType == 'jpeg') {
                return 'image/jpg';
            } elseif ($fileType == 'webp') {
                return 'image/webp';
            } elseif ($fileType == 'mp4') {
                return 'video/mp4';
            } elseif ($fileType == 'webm') {
                return 'video/webm';
            }
        }
        return 'image/*';
    }
}

function show($all_routes)
{
    // checking route is exits or not 
    foreach ($all_routes as $routes) {
        if (Route::getCurrentRoute()->getName() == 'admin.' . $routes) {
            echo "show";
            break;
        }
    }
}

function isemplooye()
{
    try {
        $id = Auth::user()->id;
        $check = Role::where('id', UsersRoles::where('user_id', $id)->first()->role_id)->whereNotIn('short_code', ['SA'])->first();
        if ($check != '') {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        return  false;
    }
}

function total_remaining_leave($user_id = '')
{
    if ($user_id == '') {
        // for autheticated user
        $user_id = auth()->user()->id;
    }
    $totalNoOfLeaveInBucket=0;
    $emp = Employee::where('user_id', $user_id)->first();

    $leaveSettings = LeaveSetting::where('emp_type', getEmpType($emp->employment_type))->get();
    foreach ($leaveSettings as $key => $leaveSetting) {
      $totalNoOfLeaveInBucket = $totalNoOfLeaveInBucket + balance_leave_by_typeForEmp($leaveSetting->id,$user_id);
    }
    return $totalNoOfLeaveInBucket;
}
function balance_leave_by_typeForEmp($leave_type_id, $user_id = '', $action = "")
{
    if ($user_id == '') {
        $user_id = auth()->user()->id;
      }
      $total_apply_leave = 0;
      $emp = Employee::where('user_id', $user_id)->first();
  
      $totalNoOfLeaveInBucket = 0;
      $leaveSetting = LeaveSetting::find($leave_type_id);
      $perYearLeave = $leaveSetting->total_leave_year;
      $isProRata = $leaveSetting->is_pro_data;
      $dateOfJoining = date("Y-m-d", strtotime($emp->start_date));
      $currentDate = date("Y-m-d");
  
      $diff = abs(strtotime($dateOfJoining) - strtotime($currentDate));
  
      $years = floor($diff / (365 * 60 * 60 * 24));
  
      $months = floor(($diff - $years  * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
      $total_leave = 0;
  
      switch ($leaveSetting->slug) {
        case 'sick-leave':
  
          if($emp->employment_type=="expatriate")
          {
            $total_leave = $perYearLeave;
            if($years>1)
            {
              $total_leave = $years * $perYearLeave;
            }
          }else
          {
            if($years>1)
            {
              $totalWorkingMonths = (date('m') -1);
            }else
            {
              $totalWorkingMonths = ($months -1);
            }
            $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
          }
          break;
        case "earned-leave":
          if($years>=1)
          {
            $totalWorkingMonths  = $years * 12 + $months;
            if ($emp->designation->slug == "tea_lady" || $emp->designation->slug == "messenger_driver") {
              $maxEarnedLeave = 45;
              $perYearLeave = 15; // if any change in default leave 
            } else {
              $maxEarnedLeave = 54;
            }
            $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
            if ($total_leave >= $maxEarnedLeave) {
              $total_leave = $maxEarnedLeave;
            }
          }
          break;
        case "maternity-leave":
          $isMaternityLeave = LeaveTimeApprovel::where('leave_type_id',$leave_type_id)->where('user_id',$user_id)->where('status','approved')->first();
          if(!empty($isMaternityLeave))
          {
            $total_leave = $perYearLeave;
          }
          break;
        case "casual-leave":
          $totalWorkingMonths =( date('m') -1);
          $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
          break;
        case "privileged-leave":
          $maxEarnedLeave = 90;
          
          if($years>=1)
          {
            $totalWorkingMonths  = ($years-1) * 12 + $months;
            // echo $totalWorkingMonths/12;
            $total_leave = ceil(($perYearLeave / 12) * $totalWorkingMonths);
            if ($total_leave >= $maxEarnedLeave) {
              $total_leave = $maxEarnedLeave;
            }
          }
         
          break;
        default:  
        
          $total_leave = $perYearLeave;
      }
  
      $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
      $balanceLeaveHideArr =['leave-without-pay','bereavement-leave'];
  
      $ignoreLeaveIds = LeaveSetting::whereIn('slug',$balanceLeaveHideArr)->pluck('id')->toArray();
  
      if ($action == "update_status") {

        $total_apply_leave = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
          $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject','pending']);
        })->count();
  
      } else {
        
        $total_apply_leave = LeaveDate::with('leaveApply')->whereHas('leaveApply', function($q) use ($user_id,$leave_type_id,$ignoreLeaveIds) {
          $q->where('user_id',$user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('leave_type_id',$ignoreLeaveIds)->whereNotIn('status',['reject']);
        })->count();
      }
  
  
    //   if (count($total_apply_leaves) > 0) {
    //     foreach ($total_apply_leaves as  $value) {
  
    //       $no_of_days = get_day($value->start_date, $value->end_date);
    //       $total_apply_leave = $total_apply_leave + $no_of_days;
    //     }
    //     $total_apply_leave = $total_apply_leave + 1;
    //   }
      $total_apply_leave = $total_apply_leave + 1;

      // echo $total_apply_leave;
      $encash_leave = LeaveEncashment::where('user_id', $user_id)->where('leave_type_id', $leave_type_id)->whereNotIn('status', ['reject'])->sum('no_of_days');
      $total = $total_leave - $total_apply_leave -  $encash_leave;
      return $total;
}

function islocal()
{
    $user_id = auth()->user()->id;
    if (Employee::where('user_id', $user_id)->first()->employment_type == "local") {
        return true;
    } else {
        return  false;
    }
}

function get_day($date1, $date2)
{
    $date1 = date_create($date1);
    $date2 = date_create($date2);
    $diff = date_diff($date1, $date2);
    return (int)round($diff->format("%R%a"));
}

function max_min_range($max, $min, $number)
{
    if ($max < $number && $min > $number) {
        return $number;
    }
}

function getAllDates($startingDate, $endingDate)
{
    $datesArray = [];

    $startingDate = strtotime($startingDate);
    $endingDate = strtotime($endingDate);
         
    for ($currentDate = $startingDate; $currentDate <= $endingDate; $currentDate += (86400)) {
        $date = date('Y-m-d', $currentDate);
        $datesArray[] = $date;
    }

    return $datesArray;
}

function isHolidayDate($date)
{
    $isHoliday = false;
    $holidayArray=['Sun','Sat'];
    $dayName = date('D',strtotime($date));
    $holiday = Holiday::where('date',$date)->first();
    if(!empty($holiday))
    {
        $holidayName = date('D',strtotime($holiday->date));  
        $holidayArray[] = $holidayName;
    }
    if(in_array($dayName,$holidayArray))
    {
        $isHoliday = true;
    }
    return $isHoliday;
}


function getEmpType($type)
{
    $text =0;
    if($type=="local")
    {
        $text =1;
    }
    return $text;
}
function getPaidString($type)
{
    $text ="paid";
    if($type==1)
    {
        $text ="unpaid";
    }
    return $text;
}

