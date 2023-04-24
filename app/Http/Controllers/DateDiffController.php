<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DateDiffController extends Controller
{

    public function index()
    {
        for ($i = 0; $i < 5; $i++) {
            for($j=0;$j<$i+1;$j++){
                echo "*";
            }
            echo "<br>";
        }

        // return view('datediff');
    }


    function date_diff(Request $request)
    {
        $date1 = strtotime($request->date1);
        $date2 = strtotime($request->date2);
        ($date1 - $date2) / 365 / 24;
    }
}
