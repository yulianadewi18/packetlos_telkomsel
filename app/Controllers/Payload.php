<?php

namespace App\Controllers;

use App\Models\PayloadModel;

class Payload extends BaseController
{
    public function index()
    {
        $payloadmodel = new PayloadModel();


        // $data['dateUpdate'] = $zeromodel->getDateUpdate();
        // dd($data['dateUpdate']);

        return view('payload');
    }
}
