<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function index()
    {
        $Adminmodel = new AdminModel();
        $data['packetloss'] = $Adminmodel->findAll();
        dd($data['packetloss']);
        return view('admin', $data);
    }
}
