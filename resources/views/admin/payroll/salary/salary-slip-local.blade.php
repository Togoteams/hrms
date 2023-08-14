<!DOCTYPE html>

<body>
    <html lang="et">

    <head>
        <title>Payslip</title>
        <meta name="viewport" content="width=device-width" />
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            body {
                background: #eceff1;
                font-family: 'Public Sans';
                color: #3f3f3f;
                font-size: 14px;
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
                height: 45.7cm;
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
                border-color: inherit;
                border-style: solid;
                font-size: 12px;
            }

            .payslipcard th {
                font-weight: 800;
                color: #000;
                background: #f2f0f8;
                text-align: left;
            }

            .payslipcard td {
                text-align: left;
                padding-left: 2px;
                padding-top: 4px;
                padding-bottom: 4px;
                font-weight: 300;
            }

            .marksheetAlign {
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
                width: 210mm;
                height: 297mm;
                background: #fff;
                padding: 25px;
            }

            button {
                background-color: black;
                width: 245px;
                border: none;
                outline: 0;
                color: #fff;
                font-family: 'Public Sans';
                font-size: 16px;
                font-weight: bold;
                padding: 8px 20px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                margin: 0px 550px;
                cursor: pointer;
            }

            @media print {

                .no-print,
                .no-print * {
                    display: none !important;
                }
            }

            #button {
                width: 210mm;
                height: 40px;
                position: fixed;
                z-index: 10;
                background: #bae2ff;
                top: 0px;
            }
        </style>
    </head>

    <body id="top">
        <!--Page 1-->
        <page size="A4">

            <div class="page-layout">


                <table class="mt-4" width="100%" border="0" style="font-size: 18Px;font-weight: bold;">
                    <tbody>
                        <tr>

                            <td>
                                <h3 class="mb-2 text-left text-dark" style="font-weight: 800;
                                color: #f94f00!important;
                            }">Bank of Baroda Ltd.
                                    <br>
                                    <span>(Botswana)</span>
                                </h3>
                                <p class="mb-0 text-left" style="text-align: left;">
                                    PAYSLIP For the month of - {{ \Carbon\Carbon::now()->format('F') }}</p>
                            </td>
                            <td style="text-align: right;">
                                <img src="https://cdn.moneytransfers.com/tr:orig-true,fo-auto/uploads/2023/01/1674731299-Bank%20of%20Baroda%20TR.svg" class="img-fluid" style="height: auto; width: 200px;">

                            </td>
                        </tr>

                    </tbody>
                </table>
                <hr>

                <table class="mt-4 mb-4" width="100%" border="0" style="font-size: 18Px;font-weight: bold;">
                    <thead>
                        <tr>
                            <td class="payslip" colspan="3"><strong><u>EMPLOYEE DETAILS</u></strong>
                            </td>
                        </tr>
                        <tr>
                            @if (!empty($data['user']->name))
                            <td class="payslip">Employee Name :</td>
                            <td class="payslip">{{$data['user']->name}}</td>
                            @endif

                            @if (!empty($data['employee']->ec_number))
                            <td class="payslip">Employee Id. :</td>
                            <td class="payslip">{{$data['employee']->ec_number}}</td>
                            @endif

                            @if (!empty($data['employee']->designation->name))
                            <td class="payslip"> Designation :</td>
                            <td class="payslip">{{$data['employee']->designation->name}}</td>
                            @endif


                        </tr>
                        <tr>
                            <td class="payslip"> Department :</td>
                            <td class="payslip"></td>

                            <td class="payslip">P.F. No :</td>
                            <td class="payslip"></td>

                            <td class="payslip">ESIC No : </td>
                            <td class="payslip"></td>


                        </tr>
                        <tr>
                            <td class="payslip"> UAN No. :</td>
                            <td class="payslip"></td>

                            <td class="payslip">PAN No. :</td>
                            <td class="payslip"></td>

                            <td class="payslip">Aadhar Card No. :</td>
                            <td class="payslip"></td>

                        </tr>
                        <tr>
                            <td class="payslip">Bank Details :</td>
                            <td>{{$data['employee']->bank_account_number}}</td>
                        </tr>

                    </thead>
                </table>

                <hr>

                <table class="mt-4 mb-4" width="100%" border="0" style="font-size: 18Px;font-weight: bold;">
                    <thead>
                        <tr>
                            <td class="payslip" colspan="3"><strong><u>OTHER DETAILS</u></strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="payslip">Salary Date :</td>
                            <td class="payslip"></td>


                            <td class="payslip">No. of Days in Month :</td>
                            <td class="payslip"></td>

                            <td class="payslip">No. of Working Days :</td>
                            <td class="payslip">28</td>


                        </tr>
                        <tr>
                            <td class="payslip">No. of Payable Leaves :</td>
                            <td class="payslip"></td>

                            <td class="payslip">Total Attendance :</td>
                            <td class="payslip"></td>

                            <td class="payslip">Total Absent : </td>
                            <td class="payslip">0</td>


                        </tr>
                        <tr>
                            <td class="payslip"> No. of Over Time (Hours) :</td>
                            <td class="payslip"></td>


                        </tr>

                    </thead>
                </table>




                <table class="payslipcard" width="100%" border="0" style="font-size: 18Px;font-weight: bold;">
                    <tbody>
                        <tr>
                            <th class="marksheetAlign">EARNINGS </th>
                            <th style="text-align: right;">PAY SCALE</th>
                            <th style="text-align: right;">EARNED</th>
                            <th style="padding-left: 10%;">DEDUCTIONS</th>
                            <th></th>

                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Basic </strong></td>
                            <td style="text-align: right;">{{$salary->basic ?? 0}}</td>
                            <td style="text-align: right;">600</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>EPF @ 12.00%</strong></td>
                            <td style="text-align: right;">72</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>HRA </strong></td>
                            <td style="text-align: right;">{{$salary->hra ?? 0}}</td>
                            <td style="text-align: right;">154</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>ESI @1.75%
                                </strong></td>
                            <td style="text-align: right;">72</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Conveyance </strong></td>
                            <td style="text-align: right;">{{$salary->conveyance ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td style="font-weight: 600;padding-left: 10%;"><strong>ESI @1.75%
                                </strong></td>
                            <td style="text-align: right;">0</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Special
                                </strong></td>
                            <td style="text-align: right;">{{$salary->special ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>Loan Deduction (if any)

                                </strong></td>
                            <td style="text-align: right;">0</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Mobile
                                </strong></td>
                            <td style="text-align: right;">{{$salary->mobile ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>Income Tax Deductions (if any)


                                </strong></td>
                            <td style="text-align: right;">0</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Bonus
                                </strong></td>
                            <td style="text-align: right;">{{$salary->bonus ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>Penalty Deductions (if any)
                                </strong></td>
                            <td style="text-align: right;">0</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Transportation

                                </strong></td>
                            <td style="text-align: right;">{{$salary->transportation ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>Fixed Deductions (if any)

                                </strong></td>
                            <td style="text-align: right;">0</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Food


                                </strong></td>
                            <td style="text-align: right;">{{$salary->food ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td style="font-weight: 600; padding-left: 10%;"><strong>Other Deductions (if any)


                                </strong></td>
                            <td style="text-align: right;">0</td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Medical
                                </strong></td>
                            <td style="text-align: right;">{{$salary->medical ?? 0}}</td>
                            <td style="text-align: right;">0</td>

                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Over Time
                                </strong></td>
                            <td style="text-align: right;">{{$salary->overtime ?? 0}}</td>
                            <td style="text-align: right;">0</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <td style="font-weight: 600;"><strong>Earnings
                                </strong></td>
                            <td style="text-align: right;">0</td>
                            <td style="text-align: right;">0</td>
                            <td colspan="2"></td>
                        </tr>
                        <tr>
                            <th style="font-weight: 600;"><strong>Gross Earning

                                </strong></th>
                            <th style="text-align: right;">19600
                            </th>
                            <th style="text-align: right;">754
                            </th>
                            <th style="font-weight: 600; padding-left: 10%;">Total Deduction
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <th colspan="5" style="font-weight: 600; padding: 10px;"><strong>Net Take Home (Gross Earning - Total Deduction) : 1735 <span style="font-weight: 100;"><br>(Rupees One Thousand Seven Hundreds Thirty )</span></strong></th>
                        </tr>
                    </tbody>
                </table>
                <p class="mt-3 mb-0 text-dark" style="font-weight: 600; text-align: left;">Note:</p>
                <ul style="padding-left: 12px;">
                    <li>1. The student are expected to keep this cardneat and clean</li>
                    <li>2. In case the card is lost the duplicate card will be issued on payment of extra report card
                        free.</li>
                    <li>3. Promotion will be granted on the weight of both examination. To pass the monthly test is also
                        compulsary.</li>
                    <li>4. This is computer generated pay slip.</li>
                </ul>
            </div>
        </page>
    </body>
    <html>