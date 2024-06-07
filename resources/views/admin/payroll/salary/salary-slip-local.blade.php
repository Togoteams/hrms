<!DOCTYPE html>

<body>
    <html lang="et">

    <head>
        <title>Payslip</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">
        {{-- 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script> --}}
        <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body {
                background: #eceff1;
                font-family: 'Public Sans';
                color: #3f3f3f;
                font-size: 14px;
            }

            thead,
            tbody,
            tfoot,
            tr,
            td,
            th {
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
                    width: 210mm;
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
                text-align: left;
            }

            .payslipcard td {
                text-align: left;
                padding-left: 2px;
                padding-top: 4px;
                padding-bottom: 4px;
                font-weight: 300;
            }

            .slipAlign {
                padding: 8px;
            }

            .payslip {
                padding: 1px 3px 4px 9px;
            }

            .payslipcard {
                border: 1px solid #fff;
                padding: 6px;
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
                                <h3 class="mb-2 text-left text-dark" style="font-weight: 800;color: #f94f00!important;">
                                    Bank of Baroda Ltd.
                                    <br>
                                    <span>(Botswana)</span>
                                </h3>
                                <p class="mb-0 text-left" style="text-align: left;">
                                    PAYSLIP For the month of -
                                    {{ strtoupper(date('M-Y', strtotime($data->pay_for_month_year))) }}</p>
                            </td>
                            <td style="text-align: right;">
                                <img src="{{ asset('assets/img/logo-cropped.svg') }}" class="img-fluid"
                                    style="height: auto; width: 200px;">

                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr>

                <table class="mt-4 mb-4" width="100%" border="0" style="font-size: 18px;font-weight: bold;padding:0px">
                    <thead>
                        <tr>
                            <td class="payslip" colspan="3"><strong><u>EMPLOYEE DETAILS</u></strong>
                            </td>
                        </tr>
                        <tr>
                            @if (!empty($data['user']->name))
                                <td class="payslip">Employee Name :</td>
                                <td class="payslip">{{ $data['user']->name }}</td>
                            @endif

                            @if (!empty($data['employee']->ec_number))
                                <td class="payslip"> EC Number. :</td>
                                <td class="payslip">{{ $data['employee']->ec_number }}</td>
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
                <table class="mt-4 mb-4" width="100%" border="0" style="font-size: 18px;font-weight: bold; padding:0px">
                    <thead>
                        <tr>
                            <td class="payslip" colspan="3"><strong><u>OTHER DETAILS</u></strong>
                            </td>
                        </tr>

                        <tr>
                            <td class="payslip" style="width: 25%">Loss Of Pay :</td>
                            <td class="payslip">{{ $data->total_loss_of_pay }}</td>

                            {{-- <td class="payslip">&nbsp;&nbsp;&nbsp;</td>
                            <td class="payslip">&nbsp;&nbsp;&nbsp;</td> --}}

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td  style="width: 50%">
                                <table class="payslipcard" border="1" style="font-size: 18px;font-weight: bold; padding:0px">
                                    <tbody>
                                        <tr>
                                            <th class="slipAlign">EARNINGS </th>
                                            <!-- <th style="text-align: right;">PAY SCALE</th> -->
                                            <th style="text-align: right;">Amount</th>
                                        </tr>
                                        @php
                                            $noOfIncome = 0;
                                            $totalIncomeAmount = $data->basic;
                                        @endphp

                                        @php
                                            $noOfIncome = 0;
                                            $noOfDeduction = 0;
                                            foreach ($data['payrollSalaryHead'] as $key => $value) {
                                                if ($value->payroll_head->head_type == 'income') {
                                                    $noOfIncome++;
                                                }
                                                if ($value->payroll_head->head_type == 'deduction') {
                                                    $noOfDeduction++;
                                                }
                                            }
                                            $extraIncomes = 0;
                                            $extraDeduction = 0;
                                            if ($noOfIncome > $noOfDeduction) {
                                                $extraDeduction = $noOfIncome - $noOfDeduction;
                                            } else {
                                                # code...
                                                $extraIncomes = $noOfDeduction - $noOfIncome;
                                            }
                                        @endphp
                                        <tr>
                                            <td style="font-weight: 600;"><strong>Basic</strong></td>
                                            <td style="text-align: right;">{{ $data->basic }} </td>
                                        </tr>
                                        @foreach ($data['payrollSalaryHead'] as $key => $value)
                                            @if ($value->payroll_head->head_type == 'income')
                                                @php
                                                    $noOfIncome = $noOfIncome + 1;
                                                    $totalIncomeAmount = $totalIncomeAmount + $value->value;
                                                @endphp
                                                <tr>
                                                    <td style="font-weight: 600;">
                                                        <strong>{{ $value->payroll_head->name }}</strong>
                                                    </td>
                                                    <!-- <td style="text-align: right;">{{ $value->value }}</td> -->
                                                    <td style="text-align: right;">{{ $value->value }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @for ($j = 0; $j < $extraIncomes - 1; $j++)
                                            <tr>
                                                <td style="font-weight: 600;">
                                                    <strong>&nbsp; &nbsp;</strong>
                                                </td>
                                                <td style="text-align: right;">&nbsp; &nbsp;</td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <th style="font-weight: 600;"><strong>Gross Earning</strong></th>
                                            <!-- <th style="text-align: right;">{{ $totalIncomeAmount }}</th> -->
                                            <th style="text-align: right;">{{ $totalIncomeAmount }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td  style="width: 50%">
                                <table class="payslipcard" border="1" style="font-size: 18px;font-weight: bold;padding:0px ">
                                    <tbody>
                                        <tr>
                                            <th class="slipAlign">DEDUCTIONS</th>
                                            <th  class="" style="text-align: right;">Amount</th>
                                        </tr>
                                        @php
                                            $noOfDescription = 0;
                                            $totalDeductionAmount = 0;
                                        @endphp

                                        @foreach ($data['payrollSalaryHead'] as $key => $value)
                                            @if ($value->payroll_head->head_type == 'deduction')
                                                @php
                                                    $noOfDescription = $noOfDescription + 1;
                                                    $totalDeductionAmount = $totalDeductionAmount + $value->value;
                                                @endphp
                                                <tr>
                                                    <td style="font-weight: 600; ">
                                                        <strong>{{ $value->payroll_head->name }}</strong>
                                                    </td>
                                                    <td style="text-align: right;">{{ $value->value }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        @for ($i = 0; $i < $extraDeduction; $i++)
                                            <tr>
                                                <td style="font-weight: 600;">
                                                    <strong> &nbsp; &nbsp;</strong>
                                                </td>
                                                <td style="text-align: right;">&nbsp; &nbsp;</td>
                                            </tr>
                                        @endfor

                                        <tr>
                                            <th style="font-weight: 600;">Total Deduction
                                            </th>
                                            <th style="text-align: right;">{{ $totalDeductionAmount }}</th>

                                        </tr>
                                    </tbody>
                                </table>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="4">
                                <table class="payslipcard" width="100%" border="0"
                                    style="font-size: 18px;font-weight: bold;">
                                    <tbody>
                                        <tr>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                        </tr>
                                        <tr>

                                            <th style="padding-left: 1%;">Net Take Home (Gross Earning - Total
                                                Deduction) :P {{ $data->net_take_home }} <span
                                                    style="font-weight: 100;">(
                                                    {{ convertNumberToWords($data->net_take_home) }} PULA )</span></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>

                        </tr>
                    </tbody>
                </table>


                <p class="mt-3 mb-0 text-dark" style="font-weight: 600; text-align: left;">Note:</p>
                <ul style="padding-left: 12px;">
                    <li>This is computer generated pay slip.</li>
                </ul>
            </div>
        </page>
    </body>
    <html>
