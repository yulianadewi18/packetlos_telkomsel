<?php

namespace App\Controllers;

use App\Models\DashboardZeroModel;

class Dashboardzero extends BaseController
{
    protected $filters = ['auth'];
    public function index()
    {
        $Zeromodel = new DashboardZeroModel();

        $data['zero'] = $Zeromodel->findAll();

        return view('dashboardzero', $data);
    }
}
