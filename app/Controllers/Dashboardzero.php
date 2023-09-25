<?php

namespace App\Controllers;

use App\Models\DashboardZeroModel;

class Dashboardzero extends BaseController
{
    public function index()
    {
        $Zeromodel = new DashboardZeroModel();

        // $data['packetloss'] = $Adminmodel->findAll();

        return view('dashboardzero');
    }
}
