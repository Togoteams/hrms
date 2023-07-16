<!DOCTYPE>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@200;300;400;500&display=swap"
        rel="stylesheet" />
    <title>Bank of baroda </title>
    <style>
        body>*:not(.print) page {
            background-color: #fff;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        page[size="A4"][layout="landscape"] {
            width: 29.7cm;
            height: 21cm;
        }

        * {
            box-sizing: border-box;
        }

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        [class*="col-"] {
            float: left;
            padding: 15px;
        }


        body {
            font-family: "Libre Franklin", sans-serif !important;
        }

        .logo {
            margin: auto;

        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            div.page-break-after {
                display: block !important;
                page-break-after: always;
            }

            .centers {
                padding: 30px !important;
            }

            .table td {
                padding: 0.75rem !important;
                vertical-align: top !important;
                border-top: 1px solid #363636 !important;
            }
        }
    </style>
</head>
<page size="A4">

    <body>
        <div class="container">
            <div class="centers">
                <center>
                    <div class="logo">
                        <img src="https://companieslogo.com/img/orig/BANKBARODA.NS-6790b239.png?t=1604067029"
                            style="width: 5%; height: auto;" />
                        <h3>Annual Performance Review Report<br>As on
                            {{ date('d-M-Y', strtotime($data[0]->created_at)) }}</h3>
                    </div>
                </center>

                <div class="row">

                    <div class='page-break-after'>
                        <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                            <tr>
                                <td>
                                    <h4>For Local/Citizen staff only</h4>
                                </td>
                            </tr>
                        </table>


                        <div style="width: 100%;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                                <tr>
                                    <td>
                                        <p><strong>(A)</strong> Name of the Appraise: <strong>
                                                {{ $data[0]->user->name }} </strong> </p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-4" style="width: 33.33%; padding: 0px; margin-top: 1em;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>EC No: <strong> {{ $data[0]->employee->ec_number }} </strong></td>
                                    <td></td>
                                </tr>
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>Branch: <strong>{{ $data[0]->employee->branch->name }}</strong> </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-4" style="width: 33.33%">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>Designation: <strong> {{ $data[0]->employee->designation->name }}</strong> </td>
                                    <td></td>
                                </tr>
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>Department: </td>
                                    <td></td>
                                </tr>
                            </table>

                        </div>

                        <div class="col-4" style="width: 33.33%">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>Since:</td>
                                    <td></td>
                                </tr>
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>DOJ: <strong>{{ $data[0]->employee->start_date }}</strong> </td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>
                                        <p>Working under the reporting Official since:</p>
                                    </td>
                                </tr>
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>
                                        <p>Status of Disciplinary action initiated: </p>
                                    </td>
                                </tr>
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>
                                        <p>Current Basic Pay:</p>
                                    </td>
                                </tr>
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>
                                        <p>Position regarding BIOB Banking certificate:</p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%;">

                            <div class="col-4" style="width: 50%; padding: 0px; margin-top: 2em;">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td>Reporting Authority: <strong>
                                            {{ $data[0]->user->name }} </strong></td>
                                        <td></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td>Branch/office: <strong>{{ $data[0]->employee->branch->name }}</strong> </td>
                                        <td></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td>Reviewing Authority: </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-4" style="width: 50%; padding: 0px; margin-top: 2em;">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td>Designation: <strong> {{ $data[0]->employee->designation->name }}</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td>EC No:  <strong> {{ $data[0]->employee->ec_number }} </strong></td>
                                        <td></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td>Accepting Authority: </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <br><br>

                        <div style="width: 100%; margin-top:2em; padding-top: 2em;">
                            <table
                                style="border-collapse: collapse; margin-left: 5.704pt; width: 100%; margin-top: 2em;"
                                cellspacing="0">
                                <tr style="height: 19pt; line-height: 24px">
                                    <td>
                                        <p><strong>(B)</strong> PROMOTIONS DETAILS:</p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%;">
                            <table
                                style="border-collapse: collapse; margin-left: 5.704pt; width: 100%; margin-top: 1em;"
                                cellspacing="0">
                                <thead>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <th
                                            style="width:25%; font-weight: 400; text-align: left; padding: 10px; border:1px solid #b4b4b4;">
                                            Sr No. </th>
                                        <th
                                            style="width:25%; font-weight: 400; text-align: left; padding: 10px; border:1px solid #b4b4b4;">
                                            From Cadre/Scale</th>
                                        <th
                                            style="width:25%; font-weight: 400; text-align: left; padding: 10px; border:1px solid #b4b4b4;">
                                            To Cadre/Scale</th>
                                        <th
                                            style="width:25%; font-weight: 400; text-align: left; padding: 10px; border:1px solid #b4b4b4;">
                                            Date of effect</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">1</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">2</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">3</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!------------------------------------------------------------->

                    <div class='page-break-after'>

                        <div style="width: 100%; margin-top: 2em; text-align: center;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%" cellspacing="0">
                                <tr>
                                    <td>
                                        <p class="text-align:center"><strong> KRA’s (Key Responsibility Areas)</strong>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%; margin-top: 0.5em; text-align: center;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                cellspacing="0">
                                <tr>
                                    <td>
                                        <p class="text-align:center; margin-top:0px;">Name of the staff: <strong>
                                                {{ $data[0]->user->name }}</strong></p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%;">
                            <td style="padding:8px; border:1px solid #b4b4b4;"></td>
                            <table
                                style="border-collapse: collapse; margin-left: 5.704pt; width: 100%; margin-top: 1em;"
                                cellspacing="0">
                                <thead>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <th
                                            style="font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Sr No. </th>
                                        <th
                                            style="font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Attributes</th>
                                        <th
                                            style="font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Comment Of Reporting Authority</th>
                                        <th
                                            style="font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Max. Marks</th>
                                        <th
                                            style="font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Marks Awarded By Reporting Authority</th>
                                        <th
                                            style="font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Marks Awarded By Reviewing Authority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_max_marks = 0;
                                        $total_marks_by_reporting_autheority = 0;
                                        $total_marks_by_review_autheority = 0;
                                    @endphp
                                    @foreach ($data as $d)
                                        @php
                                            $total_max_marks = $total_max_marks + $d->max_marks;
                                            $total_marks_by_reporting_autheority = $total_marks_by_reporting_autheority + $d->marks_by_reporting_autheority;
                                            $total_marks_by_review_autheority = $total_marks_by_review_autheority + $d->marks_by_review_autheority;
                                        @endphp
                                        <tr style="height: 19pt; line-height: 24px">
                                            <td style="padding:8px; border:1px solid #b4b4b4;">{{ $loop->index + 1 }}
                                            </td>
                                            <td style="padding:8px; border:1px solid #b4b4b4;"><span
                                                    style="font-weight:700">{{ $d->attribute_name }}-
                                                </span>{{ $d->attribute_description }}
                                            </td>
                                            <td style="padding:8px; border:1px solid #b4b4b4;">{{ $d->commects }}
                                            </td>
                                            <td style="padding:8px; border:1px solid #b4b4b4;">{{ $d->max_marks }}
                                            </td>
                                            <td style="padding:8px; border:1px solid #b4b4b4;">
                                                {{ $d->marks_by_reporting_autheority }}</td>
                                            <td style="padding:8px; border:1px solid #b4b4b4;">
                                                {{ $d->marks_by_review_autheority }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <div class="signature" style="margin-top: 3em;">
                            <div class="col-4" style="width: 33.33%; padding: 0px; margin-top: 1em;">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <p style="font-weight:500;">Date <strong> {{ date('d-M-Y') }} </strong> </p>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-4" style="width: 33.33%">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <p style="font-weight:500;">Signature of Reporting Authority
                                            <strong>{{ auth()->user()->name }} </strong>
                                        </p>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-4" style="width: 33.33%">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <p style="font-weight:500;">Signature of Reviewing Authority</p>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>



                    <!-- ------------------------------------------------------- -->


                    <div class='page-break-after'>

                        <div style="width: 100%; margin-top: 2em; text-align: center;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                cellspacing="0">
                                <tr>
                                    <td>
                                        <p class="text-align:center"><strong>OVERALL ASSESSMENT OF
                                                PERPERFORMANCE</strong>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%; margin-top: 0.5em; text-align: center;">
                            <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                cellspacing="0">
                                <tr>
                                    <td>
                                        <p class="text-align:center; margin-top:0px;">Name of the staff: <strong>
                                                {{ $data[0]->user->name }}</strong></p>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div style="width: 100%;">
                            <table
                                style="border-collapse: collapse; margin-left: 5.704pt; width: 100%; margin-top: 1em;"
                                cellspacing="0">
                                <thead>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <th
                                            style="width:25%; font-weight: 500; text-align: left; padding:8px; border:1px solid #b4b4b4; font-size: 16px;">
                                        </th>
                                        <th
                                            style="width:25%; font-weight: 500; text-align: left; padding:8px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Max. Marks</th>
                                        <th
                                            style="width:25%; font-weight: 500; text-align: left; padding:8px; border:1px solid #b4b4b4; font-size: 16px;">
                                            By Reporting Authority </th>
                                        <th
                                            style="width:25%; font-weight: 500; text-align: left; padding:8px; border:1px solid #b4b4b4; font-size: 16px;">
                                            By Reviewing Authority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Key Responsibility Areas
                                            (Refer
                                            page no. 2)</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ $total_max_marks }}</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">
                                            {{ $total_marks_by_reporting_autheority }}</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">
                                            {{ $total_marks_by_review_autheority }}</td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Total Marks</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ $total_max_marks }}</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">
                                            {{ $total_marks_by_reporting_autheority }}</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">
                                            {{ $total_marks_by_review_autheority }}</td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td colspan="2" style="padding:8px; border:1px solid #b4b4b4;">Average of
                                            Marks
                                        </td>

                                        <td colspan="2" style="padding:8px; border:1px solid #b4b4b4;">
                                            @php
                                               $all_total= ($total_max_marks + $total_marks_by_reporting_autheority + $total_marks_by_review_autheority)/3
                                            @endphp
                                            {{ ($all_total) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="width: 100%;">
                            <table
                                style="border-collapse: collapse; margin-left: 5.704pt; width: 100%; margin-top: 1em;"
                                cellspacing="0">
                                <thead>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <th colspan="2"
                                            style="width:25%; font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            FINAL RATING TO BE TICK MARKED</th>
                                        <th
                                            style="width:25%; font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                        </th>
                                        <th
                                            style="width:25%; font-weight: 500; text-align: left; padding: 10px; border:1px solid #b4b4b4; font-size: 16px;">
                                            Final Marks </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">A</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Outstanding</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">(90-100)</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ max_min_range(90,100,$all_total) }}</td>

                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">B</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Very Good</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">(75-89)</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ max_min_range(90,100,$all_total) }}</td>

                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">C </td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Good</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">(60-74)</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ max_min_range(60,74,$all_total) }}</td>

                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">D </td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Average</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">(40-59)</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ max_min_range(40,59,$all_total) }}</td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="padding:8px; border:1px solid #b4b4b4;">E </td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">Below Average</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">(Below 40)</td>
                                        <td style="padding:8px; border:1px solid #b4b4b4;">{{ max_min_range(0,40,$all_total) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div style="width: 100%;">
                            <div class="col-4" style="width: 50%; padding: 0px; margin-top: 4em;">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Signature of Reporting Authority</td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Name: <strong> {{ auth()->user()->name }}</strong> </td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Designation: </td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-4" style="width: 50%; padding: 0px; margin-top: 4em;">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Signature of Reviewing Authority</td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Name:  <strong> {{ auth()->user()->name }}</strong></td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Designation:</td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-12" style="width: 100%; padding: 0px; margin-top: 4em;">
                                <table style="border-collapse: collapse; margin-left: 5.704pt; width: 100%"
                                    cellspacing="0">
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Signature of the Accepting Authority</td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Name:  <strong> {{ auth()->user()->name }}</strong> </td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                    <tr style="height: 19pt; line-height: 24px">
                                        <td style="font-weight: 500;">Designation: </td>
                                        <td style="font-weight: 500;"></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>
</page>

</html>

<script>

window.print();
</script>
