<?php

namespace App\Http\Controllers\Admin\Payroll;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\Emp13thCheque;
use App\Models\Employee;
use App\Models\PayrollSalary;
use App\Traits\PayrollTraits;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
class Emp13thChequeController extends BaseController
{
    //
     /**
     * Display a listing of the resource.
     */
    public $page_name = "13th Cheque";
    use PayrollTraits;
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Emp13thCheque::with('user','user.employee');
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('cheques_month_year', function ($data) {
                    return \Carbon\Carbon::parse($data->cheques_month_year)->isoFormat('MM-YYYY');
                })
                ->make(true);
            }
        return view('admin.payroll.emp13th-cheque.index', ['page' => $this->page_name]);
    }
    public function create13Cheque(Request $request)
    {
        $employees = Employee::getList()->where('employment_type','local')->getActiveEmp()->get();
        $branch = Branch::get();
        return view('admin.payroll.emp13th-cheque.create', ['page' => $this->page_name,'employees'=>$employees,'branches'=>$branch]);
    }
    public function genrate13Cheque(Request $request)
    {
        $search_text = $request->search_text;
        $user_id = $request->user_id;
        $branch_id = $request->branch_id;
        $search_type = $request->search_type;
        $from_date = $request->from_date;
        $financial_year = $request->financial_year;

        $to_date = $request->to_date;
        $branch = Branch::find($branch_id);
        if(!empty($user_id))
        {
            $employees = Employee::getList()->where('employment_type','local')->where('user_id',$user_id)->where('branch_id',$branch_id)->getActiveEmp()->get();
        }else
        {
            $employees = Employee::getList()->where('employment_type','local')->where('branch_id',$branch_id)->getActiveEmp()->get();
        }
        $emp13ChequeReport =[];
        $financial_year_text ="";
        $months =[];
        $employee_data ="";
        if($financial_year)
        {
            $financialYears = explode("-",$financial_year);
            $financial_year_text = "Dec- ".$financialYears[0]." to Nov- ".$financialYears[1];
            $months =[
                ["month"=>["key"=>"12","lable"=>"Dec"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-12'],
                ["month"=>["key"=>"01","lable"=>"Jan"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-01'],
                ["month"=>["key"=>"02","lable"=>"Feb"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-02'],
                ["month"=>["key"=>"03","lable"=>"March"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-03'],
                ["month"=>["key"=>"04","lable"=>"April"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-04'],
                ["month"=>["key"=>"05","lable"=>"May"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-05'],
                ["month"=>["key"=>"06","lable"=>"June"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-06'],
                ["month"=>["key"=>"07","lable"=>"July"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-07'],
                ["month"=>["key"=>"08","lable"=>"Aug"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-08'],
                ["month"=>["key"=>"09","lable"=>"Sep"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-09'],
                ["month"=>["key"=>"10","lable"=>"Oct"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-10'],
                ["month"=>["key"=>"11","lable"=>"Nov"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-11'],
            ];
            
            foreach($employees as $ekey => $employe){
                $emp13ChequeReport[$ekey]['name_of_employee'] = $employe->user?->name;
                $emp13ChequeReport[$ekey]['ec_number'] = $employe->ec_number;
                $emp13ChequeReport[$ekey]['user_id'] = $employe->user_id;
                $emp13ChequeReport[$ekey]['branch_name'] = $employe->branch?->name;
                $emp13ChequeReport[$ekey]['bank_account_number'] = $employe->bank_account_number;
                $totalBasicAmount = 0;
                $totalITaxAmount = 0;
                foreach($months as $key => $month)
                {   $basicAmount =0;
                    $data = PayrollSalary::where('pay_for_month_year',$month['year']."-".$month['month']['key'])->where('employee_id',$employe->id)->first();
                    $basicAmount = $data?->basic ?? 0;
                    $taxAmount = $data?->tax_amount_in_pula ?? 0;
                    $totalBasicAmount +=$basicAmount;
                    // $totalITaxAmount +=$taxAmount;
                    $emp13ChequeReport[$ekey]['months'][$key]['basic'] = $basicAmount;
                    $emp13ChequeReport[$ekey]['months'][$key]['month_key'] = $month['month']['key'];
                }
                $emp13ChequeReport[$ekey]['total_amount'] = $totalBasicAmount;
                $emp13ChequeReport[$ekey]['average_amount'] = ($totalBasicAmount/12);
                $totalITaxAmount = $this->getTaxAmount(['taxable_amount'=>$totalBasicAmount,'employment_type'=>$employe->employment_type])['tax_amount'];
                $emp13ChequeReport[$ekey]['total_i_tax_amount'] = ($totalITaxAmount);
                $emp13ChequeReport[$ekey]['net_payable_amount'] = ($totalBasicAmount/12 - $totalITaxAmount);
            }
        }
        $view = View::make('admin.payroll.emp13th-cheque.preview-genrate-form',  [
            'employees' => $employees,
            'search_type' => $search_type,
            'to_date' => $to_date,
            'branch' => $branch,
            'months' => $months,
            'emp13ChequeReport' => $emp13ChequeReport,
            'financial_year' => $financial_year,
            'financial_year_text' =>$financial_year_text ,
            'from_date' => $from_date,
            'search_text' => $search_text
        ]);
        $renderedView = $view->render();
        return $this->responseJson(true,200,"dsd",['html_view'=>$renderedView]);
    }
    public function save13Cheque(Request $request)
    {
            $branch_id = $request->branch_id;
            $financial_year = $request->financial_year;
            $user_id = $request->user_id;
            $employee_users_ids = $request->employee_users_ids;
            $financialYears = explode("-",$financial_year);

            $months =[
                ["month"=>["key"=>"12","lable"=>"Dec"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-12'],
                ["month"=>["key"=>"01","lable"=>"Jan"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-01'],
                ["month"=>["key"=>"02","lable"=>"Feb"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-02'],
                ["month"=>["key"=>"03","lable"=>"March"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-03'],
                ["month"=>["key"=>"04","lable"=>"April"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-04'],
                ["month"=>["key"=>"05","lable"=>"May"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-05'],
                ["month"=>["key"=>"06","lable"=>"June"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-06'],
                ["month"=>["key"=>"07","lable"=>"July"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-07'],
                ["month"=>["key"=>"08","lable"=>"Aug"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-08'],
                ["month"=>["key"=>"09","lable"=>"Sep"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-09'],
                ["month"=>["key"=>"10","lable"=>"Oct"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-10'],
                ["month"=>["key"=>"11","lable"=>"Nov"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-11'],
            ];
            $saveData =[];
            foreach($employee_users_ids  as $ekey => $employeid)
            {
                $saveData[$ekey] = [
                    'user_id' => $employeid,
                    'branch_id' => $branch_id,
                    'financial_year' => $financial_year,
                    'currency' => 'pula',
                    'total_amount' => $request->total_amount__[$employeid] ?? 0,
                    'average_amount' => $request->average_amount__[$employeid] ?? 0,
                    'total_i_tax_amount' => $request->total_i_tax_amount__[$employeid] ?? 0,
                    'net_payable_amount' => $request->net_payable_amount__[$employeid] ?? 0,
                ];
            
                foreach ($months as $keyM => $month) {
                    $monthKey = Str::lower($month['month']['lable']) . '_salary';
                    $saveData[$ekey][$monthKey] = $request->month_[$month['month']['key']][$employeid] ?? 0;
                }
            }
            if (!empty($saveData)) {
                Emp13thCheque::insert($saveData);
            }
            $redirectUrl = route('admin.payroll.emp-13th-cheque.index');
            return $this->responseJson(true, 200, "Saved Successfully",['redirect_url'=>$redirectUrl]);


    }
    private function getMonths($financialYears)
    {
        return [
            ["month"=>["key"=>"12","lable"=>"Dec"],"year"=>$financialYears[0],'pay_for_month_year'=>$financialYears[0].'-12'],
            ["month"=>["key"=>"01","lable"=>"Jan"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-01'],
            ["month"=>["key"=>"02","lable"=>"Feb"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-02'],
            ["month"=>["key"=>"03","lable"=>"March"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-03'],
            ["month"=>["key"=>"04","lable"=>"April"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-04'],
            ["month"=>["key"=>"05","lable"=>"May"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-05'],
            ["month"=>["key"=>"06","lable"=>"June"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-06'],
            ["month"=>["key"=>"07","lable"=>"July"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-07'],
            ["month"=>["key"=>"08","lable"=>"Aug"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-08'],
            ["month"=>["key"=>"09","lable"=>"Sep"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-09'],
            ["month"=>["key"=>"10","lable"=>"Oct"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-10'],
            ["month"=>["key"=>"11","lable"=>"Nov"],"year"=>$financialYears[1],'pay_for_month_year'=>$financialYears[1].'-11'],
        ];
    }
}
