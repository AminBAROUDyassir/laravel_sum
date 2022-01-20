<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Milon\Barcode\DNS1D;

class BarcodeController extends Controller
{
    public function get_code_bar(Request $request)
    {
        $code = $request->code;
        $d = new DNS1D();
        return '<img src="data:image/png;base64,' . $d->getBarcodePNG($code, 'C39', 2, 60, array(1, 1, 1), true) . '" alt="barcode" />';
    }

    public function get_code_bar_text(Request $request)
    {
        $code = $request->code;
        $d = new DNS1D();
        return 'data:image/png;base64,' . $d->getBarcodePNG($code, 'C39', 2, 60, array(1, 1, 1), true);
    }

}
