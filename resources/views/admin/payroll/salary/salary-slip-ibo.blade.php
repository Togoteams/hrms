<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        page {
            display: block;
            margin: 0 auto;
        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
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
            font-family: 'Rubik', sans-serif !important;
        }

        .logo {
            margin: auto;

        }

        .fa {
            padding: 9px;
            font-size: 15px;
            width: 34px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .fa-facebook {
            background: #3B5998;
            color: white;
        }

        .fa-linkedin {
            background: #007bb5;
            color: white;
        }

        .fa-instagram {
            background: #bb0000;
            color: white;
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

<body>
    <page size="A4">

        <div class='page-break-after'>
            <div style="padding: 10px; border: 1px solid #ffe3d8;">
                <div style="width: 100%;">
                    <div class="col-12"
                        style="width: 100%;
                    padding: 0px;
                    padding-top: 1em;
                    padding-bottom: 1em;
                    background: #ffecde;">

                        <center> <img
                                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRYlll95BBQ4rlb16xmoOeCF8IeO36pq8MA4Bt00AZ7MI3B6TMevwRQVcbXHL6V40vbuQ&usqp=CAU"
                                alt="" class="img-fluid" style="height: auto; width: 30%;"></center>
                    </div>
                </div>
                <div style="width: 100%;">
                    <table style="border-collapse: collapse; width: 100%; margin-top: 4em;" cellspacing="0">

                        <tbody>

                            <tr>
                                <td colspan="6"
                                    style="padding:8px; border:1px solid #fff9f9; text-align:left; vertical-align: middle; font-weight: 700;">
                                    <p>SALARY - FOR JUNE 2023</p>
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:rgb(255, 236, 222); padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left; font-weight: 700;">
                                    Name of the staff:
                                </td>
                                <td
                                    style="background-color:rgb(255, 236, 222); padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:left; font-weight: 700;">
                                    {{$data['user']->name}}
                                </td>

                            </tr>

                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    EC No:
                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    {{$data['employee']->ec_number}}
                                </td>
                            </tr>
                            
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Salary
                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    {{$data->basic}}
                                </td>

                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Entertainment Expenses


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    2,000.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    House Up Keep Allow
                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    0.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Total USD
                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    0.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:rgb(255, 236, 222);padding:6px; font-size:14px; border:1px solid #fff9f9; font-weight: 700; text-align: left;">
                                    Provident Fund



                                </td>
                                <td
                                    style="background-color:rgb(255, 236, 222);padding:6px; font-size:14px; border:1px solid #fff9f9; font-weight: 700; text-align:center;">
                                    2,000.00


                                </td>
                            </tr>


                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Net Salary in USD


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    {{$data->net_take_home}}


                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Amount in Pula


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    {{$data->net_take_home}}
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Education Allowance


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    00.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Other Deduction


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    300.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Net Salary


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    00.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; font-weight: 700; border:1px solid #fff9f9; text-align: left;">
                                    Credited to Account


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; font-weight: 700; border:1px solid #fff9f9; text-align:center;">
                                    {{$data->net_take_home}}
                                </td>
                            </tr>

                            <tr style="height: 19pt; line-height: 24px">
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align: left;">
                                    Leave balance:


                                </td>
                                <td
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; border:1px solid #fff9f9; text-align:center;">
                                    1,700.00
                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td style="background-color:#fff9f9; padding:6px; font-size:14px;  text-align: left;">
                                    I Pula/USD


                                </td>
                                <td style="background-color:#fff9f9; padding:6px; font-size:14px; text-align:center;">
                                    0.0753


                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td style="background-color:#fff9f9; padding:6px; font-size:14px; text-align: left;">
                                    1 Pula/Rupee


                                </td>
                                <td style="background-color:#fff9f9; padding:6px; font-size:14px; text-align:center;">
                                    6.1700


                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td style="background-color:#fff9f9; padding:6px; font-size:14px; text-align: left;">
                                    1 USD/Rupee



                                </td>
                                <td style="background-color:#fff9f9; padding:6px; font-size:14px; text-align:center;">
                                    82.0000


                                </td>
                            </tr>
                            <tr style="height: 19pt; line-height: 24px">
                                <td colspan="2"
                                    style="background-color:#fff9f9; padding:6px; font-size:14px; text-align: left;">
                                    For Bank of Baroda (Botswana) Ltd
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="padding: 0px; display: flex; position:relative; bottom: 0; width: 98%; padding-top: 6em;">

                    <div style="width:100%; text-align: left; font-weight: 600;">
                        <p>Senior Manager<br>
                            Date: 20.06.2023</p>
                    </div>

                </div>
            </div>
        </div>

    </page>

</body>

</html>
