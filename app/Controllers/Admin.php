<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    public function index()
    {
        $currentPage = $this->request->getVar('page_packetlos') ? $this->request->getVar('page_packetlos') :
            1;

        $Adminmodel = new AdminModel();
        $data['packetloss'] = $Adminmodel->findAll();
        dd($data['packetloss']);
        return view('admin', $data);
    }
}
