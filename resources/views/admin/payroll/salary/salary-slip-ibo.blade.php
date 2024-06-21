<!DOCTYPE html>

<body>
    <html lang="et">

    <head>
        <title>Payslip</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />


        <style>
            body {
                background: #eceff1;
                font-family: 'Public Sans';
                color: #3f3f3f;
                font-size: 14px;
            }
            thead, tbody, tfoot, tr, td, th
            {
                /* border-color: inherit !important;
                border-style:none !important; */
                font-size: 12px !important;
            }

            page {
                background: #fff;
                display: block;
                margin: 0 auto;
                margin-bottom: 5mm;
                margin-top: 5mm;
            }

            page[size="A4"] {
                width: 21cm;
                height: 29.7cm;
            }

            @page {
                size: 210mm 297mm;
                margin: 0;
            }

            @media print {

                /* Print settings */
                html,
                body,
                page {
                    /* width: 210mm; */
                    height: 100%;
                    margin: 0 !important;
                    padding: 0 !important;
                    overflow: hidden;
                }

                .no-overflow {
                    overflow: hidden;
                }
            }

            thead,
            tbody,
            tfoot,
            tr,
            td,
            th {
                /* border-color: inherit;
                border-style: solid; */
                font-size: 12px;
            }

            .payslipcard th {
                font-weight: 800;
                color: #000;
                /* background: #f2f0f8; */
                text-align: left;
                background: #dce2e8;
                /* border: 1px solid #a1a1a1; */
            }

            .payslipcard td {
                text-align: left;
                padding-left: 2px;
                padding-top: 4px;
                padding-bottom: 4px;
                font-weight: 300;
                border: 1px solid #a1a1a1;
            }

            .marksheetAlign {
                padding: 8px;
            }

           

            .payslipcard {
                /* border: 1px solid #fff; */
                color: #000;
                font-size: 12px;
                width: 100%;
                text-align: left;
            }

            .report-table th td {
                border: none !important;
            }

            .clear {
                clear: both;
            }

            p {
                text-align: center;
            }

            .page-layout {
                /* width: 210mm; */
                height: 297mm;
                background: #fff;
                padding: 25px;
            }

            

            @media print {

                .no-print,
                .no-print * {
                    display: none !important;
                }
            }

            
        </style>
    </head>

    <body id="top">
        <!--Page 1-->
        <page size="A4">

            <div class="page-layout">

                <table class="mt-4" width="100%" border="0" style="font-size: 18px;font-weight: bold;">
                    <tbody>
                        <tr>

                            <td>
                                <h3 class="mb-2 text-left text-dark"
                                    style="font-weight: 800;
                                color: #f94f00!important;     font-size: 25px;">
                                    Bank of Baroda Ltd.
                                    <br>
                                    <span>(Botswana)</span>
                                </h3>
                                <p class="mb-0 text-left text-uppercase" style="text-align: left;text-transform: uppercase;">
                                    PAYSLIP For the month of
                                    <u>{{ strtoupper(date('F-Y', strtotime($data->pay_for_month_year))) }}</u></p>
                            </td>
                            <td style="text-align: right;">
                                <img src="{{ asset('assets/img/logo-cropped.svg') }}" class="img-fluid"
                                    style="height: auto; width: 16rem;">

                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr>

                <table class="mt-4 mb-4" width="100%" border="0" style="font-size: 18px;font-weight: bold;">
                    <thead>
                        <tr>
                            <td class=" payslip" colspan="3" style="padding-bottom: 6px;"><strong><u>EMPLOYEE DETAILS</u></strong>
                            </td>
                        </tr>
                        <tr>
                            @if (!empty($data['user']->name))
                                <td class="payslip" style="width: 20%;">Employee Name :</td>
                                <td class="" style="width: 40%;">{{ $data['user']->name }}</td>
                            @endif

                            @if (!empty($data['employee']->ec_number))
                                <td class="payslip" style="width: 20%;"> EC Number. :</td>
                                <td class="" style="width: 40%;">{{ $data['employee']->ec_number }}</td>
                            @endif


                        </tr>
                        <tr>
                            @if (!empty($data['employee']->designation))
                                <td class="payslip"> Designation :</td>
                                <td class="payslip">{{ $data['employee']->designation->name }}</td>
                            @endif
                            <td class="payslip">Bank Details :</td>
                            <td>{{ $data['employee']->bank_account_number }}</td>
                        </tr>

                    </thead>
                </table>
                <hr>
                <table class="mt-4 mb-4" width="100%" border="0" style="font-size: 18px;font-weight: bold;">
                    <thead>
                        <tr>
                            <td class="payslip" colspan="3" style="padding-bottom: 6px;"><strong><u>OTHER DETAILS</u></strong>
                            </td>
                        </tr>
                        <tr>
                            {{-- <td class="payslip">Salary Date :</td>
                            <td class="payslip">{{date("d-m-Y",strtotime($data->created_at))}}</td> --}}
                            {{-- <td class="payslip">No. of Payable days :</td>
                            <td class="payslip">{{$data->no_of_payable_days}}</td>
                            <td class="payslip">Annual Balanced Leave :</td>
                            <td class="payslip">{{$data->annual_balanced_leave}}</td> --}}
                        </tr>
                        <tr>


                            <td class="payslip" width="20%">Loss Of Pay :</td>
                            <td class="payslip">{{ $data->total_loss_of_pay }}</td>
                            {{-- <td class="payslip">    </td> --}}
                            {{-- <td class="payslip">Total Absent : </td>
                            <td class="payslip">0</td> --}}
                            {{-- <td class="payslip">No. Availed Leave :</td>
                            <td class="payslip">{{$data->no_availed_leave}}</td> --}}
                        </tr>
                        <tr><td colspan="3" ></td></tr>
                    </thead>
                </table>
                <hr>
                @php
                $noOfIncome=0;
                $noOfDeduction=0;
                foreach($data['payrollSalaryHead'] as $key => $value)
                {
                    if ($value->payroll_head->head_type == 'income')
                    {  
                        $noOfIncome++;
                    }
                    if ($value->payroll_head->head_type == 'deduction')
                    {
                        $noOfDeduction++;
                    }
                }
                $extraIncomes = 0;
                $extraDeduction = 0;
                if($noOfIncome > $noOfDeduction)
                {
                    $extraDeduction =  $noOfIncome -  $noOfDeduction;
                }else {
                    # code...
                    $extraIncomes =  $noOfDeduction -  $noOfIncome;
                }
            @endphp
                <table width="100%">
                    <tr>
                        <td class=" payslip" colspan="3" style="padding-bottom: 6px;"><strong><u>SALARY DETAILS</u></strong>
                        </td>
                    </tr>
                    <tr>
                        <td width="50%">
                            <table class="payslipcard" width="100%" border="1"
                            style="font-size: 18px;font-weight: bold;border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <th class="marksheetAlign" style="padding-left: 10%;">EARNINGS </th>
                                    <!-- <th style="text-align: right;">PAY SCALE</th> -->
                                    <th style="text-align: right; padding-right: 5%;">AMOUNT</th>
                                </tr>
                                @php
                                    $noOfIncome = 0;
                                    $totalIncomeAmount = $data->basic;
                                @endphp
                                <tr>
                                    <td style=" padding-left: 10%;">Basic</td>
                                    <td style="text-align: right;padding-right: 5%;">{{ number_format($data->basic,2) }}</td>
                                </tr>
                                @foreach ($data['payrollSalaryHead'] as $key => $value)
                                    @if ($value->payroll_head->head_type == 'income')
                                        @php
                                            $noOfIncome = $noOfIncome + 1;
                                            $edu_allow = $value->value;
                                            if ($value->payroll_head->slug == 'education_allowance') {
                                                $edu_allow = number_format($value->value / $usdToInrAmount,2);
                                                $totalIncomeAmount = $totalIncomeAmount + $edu_allow;
                                            } else {
                                                $totalIncomeAmount = $totalIncomeAmount + $edu_allow;
                                            }
                                        @endphp
                                        <tr>
                                            @if ($value->payroll_head->slug == 'education_allowance')
                                                <td style=" padding-left: 10%;">
                                                    {{ $value->payroll_head->name }}
                                                </td>
                                                <!-- <td style="text-align: right;">{{ $value->value }}</td> -->
                                                <td style="text-align: right;padding-right: 5%;">{{ number_format($edu_allow,2) }}
                                                </td>
                                            @else
                                                <td style="padding-left: 10%;">
                                                    {{ $value->payroll_head->name }}
                                                </td>
                                                <!-- <td style="text-align: right;">{{ $value->value }}</td> -->
                                                <td style="text-align: right;padding-right: 5%;">{{ number_format($value->value,2) }}</td>
                                            @endif

                                        </tr>
                                    @endif
                                @endforeach
                                    @for ($j = 0; $j < $extraIncomes-1; $j++)
                                    <tr>
                                        <td style=" padding-left: 10%;">
                                            <strong>&nbsp; &nbsp;</strong>
                                        </td>
                                        <td style="text-align: right; padding-right: 5%; ">&nbsp; &nbsp;</td>
                                    </tr>
                                    @endfor
                                <tr>
                                    <th class="marksheetAlign" style=" padding-left: 10%; font-size: 15px !important;">Gross Earning
                                    </th>
                                    <!-- <th style="text-align: right;">{{ $totalIncomeAmount }}</th> -->
                                    <th style="text-align: right;padding-right: 5%;">{{ number_format($totalIncomeAmount,2) }}</th>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                        <td>
                            <table class="payslipcard" width="100%" border="1" 
                            style="font-size: 18px;font-weight: bold; border-collapse: collapse;">
                            <tbody>
                                <tr>
                                    <th class="marksheetAlign" style="padding-left: 10%;">DEDUCTIONS</th>
                                    <th style="text-align: right;padding-right: 5%;">AMOUNT</th>
                                </tr>
                                @php
                                    $noOfDescription = 0;
                                    $totalDeductionAmount = 0;
                                @endphp

                                @foreach ($data['payrollSalaryHead'] as $key => $value)
                                    @if ($value->payroll_head->head_type == 'deduction')
                                        @php
                                            $noOfDescription = $noOfDescription + 1;
                                            $otherDeducation = 0;
                                            if ($value->payroll_head->slug == 'other_deductions') {
                                                $otherDeducation = number_format($value->value / $usdToPulaAmount,2);
                                                $totalDeductionAmount = $totalDeductionAmount + $otherDeducation;
                                            } else {
                                                $totalDeductionAmount = $totalDeductionAmount + $value->value;
                                            }
                                        @endphp
                                        <tr>
                                            @if ($value->payroll_head->slug == 'other_deductions')
                                                <td style=" padding-left: 10%;">
                                                    {{ $value->payroll_head->name }}
                                                </td>
                                                <td style="text-align: right;padding-right: 5%;">{{ $otherDeducation }}
                                                </td>
                                            @else
                                                <td style=" padding-left: 10%;">
                                                    {{ $value->payroll_head->name }}
                                                </td>
                                                <td style="text-align: right;padding-right: 5%;">{{ number_format($value->value,2) }}</td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                @for ($i = 0; $i < $extraDeduction; $i++)
                                    <tr>
                                        <td style="">
                                            &nbsp; &nbsp;
                                        </td>
                                        <td style="text-align: right;padding-right: 5%;">&nbsp; &nbsp;</td>
                                    </tr>
                                @endfor
                                <tr>
                                    <th class="marksheetAlign" style=" padding-left: 10%;font-size: 15px !important;">Total Deduction
                                    </th>
                                    <th style="text-align: right;padding-right: 5%;">{{ number_format($totalDeductionAmount,2) }}</th>
                                </tr>
                            </tbody>
                        </table>
                        </td>
                    </tr>
                </table>
              
                <div class="row" style="padding-top:1em">
                    <hr>
                    <div class="col-md-12">
                        <table class="payslipcard" width="100%" border="0"
                            style="font-size: 18px;font-weight: bold;">
                            <tbody>
                              
                                <tr>
                                    <th style="padding-left: 1%;background:white !important">Net Take Home (Gross Earning - Total Deduction) : $
                                        {{ number_format($data->net_take_home,2) }} <span
                                            style="font-weight: 100;">({{ convertNumberToWords($data->net_take_home) }}
                                            )</span></th>
                                </tr>
                                <tr>
                                    <th style="padding-left: 1%; background:white !important">Net Take Home (In Pula) (Gross Earning - Total
                                        Deduction) : P {{ number_format($data->net_take_home_in_pula, 2) }}
                                        <span
                                            style="font-weight: 100;">({{ convertNumberToWords(number_format($data->net_take_home_in_pula, 2, '.', '')) }}
                                            )</span></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <p class="mt-4 mb-0 text-dark" style=" text-align: left;">Note:</p>
                <ul style="padding-left: 12px;">
                    {{-- <li>1. The student are expected to keep this cardneat and clean</li>
                    <li>2. In case the card is lost the duplicate card will be issued on payment of extra report card
                        free.</li>
                    <li>3. Promotion will be granted on the weight of both examination. To pass the monthly test is also
                        compulsary.</li> --}}
                    <li>This is computer generated pay slip.</li>
                    {{-- <li style="text-align: center">  **********************************************</li> --}}
                </ul>
                <br>
                <p style="text-align: center">  ***************************************************************************</p>
            </div>
        </page>
    </body>
    <html>
