<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use NumberToWords\NumberToWords;

class OtherController extends Controller
{

    public function get_number(Request $request)
    {
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('fr');
        if (isset($request->number)) {
            return $numberTransformer->toWords($request->number);
        }
        return "";

    }

}
