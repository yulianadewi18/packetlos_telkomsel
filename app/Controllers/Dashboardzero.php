<?php

namespace App\Controllers;

use App\Models\DashboardZeroModel;

class Dashboardzero extends BaseController
{
    public function index()
    {
        $zeromodel = new DashboardZeroModel();

        $data['zerotrafic_load'] = $zeromodel->orderBy('date', 'DESC')->findAll();

        // $data['dateUpdate'] = $zeromodel->getDateUpdate();
        // dd($data['dateUpdate']);

        return view('dashboardzero', $data);
    }
    public function chartdata()
    {
        $zeromodel = new DashboardZeroModel();
        $data['zerodate'] = $zeromodel->getLineData();
        return response()->setJson($data);
    }

    public function barchart()
    {
        $zeromodel = new DashboardZeroModel();
        $data['dateUpdate'] = $zeromodel->getDateUpdate();
        return response()->setJson($data);
    }
}
