<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>Salary Slip</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
    />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Ubuntu&family=Wix+Madefor+Display&display=swap" rel="stylesheet">
   <style>

    body{
        font-family: 'Wix Madefor Display', sans-serif;
    }

  @media (min-width:700px){
     body{
        max-width: 700px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        margin-top: 30px;
        margin-bottom: 30px;
    }
  }
   span{
    font-size: 14px;
   }

    .text-orange{
      color: #EF7418;
    }
    .bg-orange{
      background-color: #EF7418;
    }

    thead th{
        font-size: 15px;
    }

    tbody th{
        font-size: 13px;
    }

    tbody td{
        font-size: 13px;
    }
   </style>
  </head>
  <body class="mx-auto">
   <div class="container-fluid px-5 pt-4 pb-5">
    <div><img src="{{ asset('assets/img/logo-cropped.svg') }}" width="200px"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="text-center lh-1 mb-5">
                <h4 class="fw-bold text-orange">Salary Slip</h4> <span class="fw-normal">Salary slip for the month of June 2021</span>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="row">
                      <div class="col-6">
                            <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">{{$dataSet['emp_name']}}</small> </div>
                        </div>
                        <div class="col-6">
                            <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">{{$dataSet['emp_code']}}</small> </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div> <span class="fw-bolder">PF No.</span> <small class="ms-3">101523065714</small> </div>
                        </div>
                        <div class="col-6">
                            <div> <span class="fw-bolder">Designation</span> <small class="ms-3">Marketing Staff (MK)</small> </div>
                        </div>

                    </div>
                    <div class="row">
                       <div class="col-6">
                            <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******0701</small> </div>
                        </div>
                        <div class="col-6">

                            <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">SBI</small> </div>
                        </div>
                    </div>

                </div>
                <table class="mt-4 table table-bordered">
                    <thead class="bg-orange text-white">
                        <tr>
                            <th scope="col">Earnings</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Deductions</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Basic</th>
                            <td>{{$data['basic']}}</td>
                            <td class="fw-bolder">PF</td>
                            <td>{{$data['pf_amount']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">HRA</th>
                            <td>{{$data['hra']}}</td>
                            <td class="fw-bolder">ESI</td>
                            <td>{{$data['esi_amount']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Overtime</th>
                            <td>{{$data['overtime']}}</td>
                            <td class="fw-bolder">Pension</td>
                            <td>{{$data['pension_amount']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Arrear</th>
                            <td>{{$data['arrear']}}</td>
                            <td class="fw-bolder">Union Membership</td>
                            <td>{{$data['union_membership']}}</td>
                        </tr>

                        <tr>
                            <th scope="row">Conveyance</th>
                            <td>{{$data['conveyance']}}</td>
                            <td class="fw-bolder">Loans</td>
                            <td>{{$data['loans_deduction']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Special</th>
                            <td>{{$data['special']}}</td>
                            <td class="fw-bolder">Income Tax</td>
                            <td>{{$data['income_tax_deductions']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Mobile</th>
                            <td>{{$data['mobile']}}</td>
                            <td class="fw-bolder">Penalty</td>
                            <td>{{$data['penalty_deductions']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Bonus</th>
                            <td>{{$data['bonus']}}</td>
                            <td class="fw-bolder">Fixed</td>
                            <td>{{$data['fixed_deductions']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Leave Encashment</th>
                            <td>00.00</td>
                            <td class="fw-bolder">Other</td>
                            <td>{{$data['other_deductions']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Transportation</th>
                            <td>{{$data['transportation']}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th scope="row">Food</th>
                            <td>{{$data['food']}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th scope="row">Medical</th>
                            <td>{{$data['medical']}}</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr class="border-top">
                            <th scope="row">Total Earning</th>
                            <td>{{$dataSet['total_earning']}}</td>
                            <td class="fw-bolder">Total Deductions</td>
                            <td>{{$dataSet['total_deductions']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-4"> <br> <span class="fw-bold text-orange">Net Pay :</span><span class="fw-bolder"> {{$dataSet['net_pay']}}</span> </div>
                <div class=" col-md-8">
                    <div class="d-flex flex-column"> <span class="fw-bold text-orange">In Words</span> <span>Twenty Five thousand nine hundred seventy only</span> </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="d-flex flex-column mt-2"> <span class="fw-bolder text-orange">For Bank of Baroda</span> <span class="mt-4">Authorised Signature</span> </div>
            </div>
        </div>
    </div>
</div>
  </body>
</html>
