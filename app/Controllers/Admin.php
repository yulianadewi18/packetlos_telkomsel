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

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $admin = $Adminmodel->search($keyword);
        } else {
            $admin = $Adminmodel;
        }

        //$data['packetloss'] = $Adminmodel->findAll();
        $data['packetloss'] = $admin->orderBy('week', 'desc')->paginate(25, 'packetlos');
        $data['pager'] = $Adminmodel->pager;
        $data['currentPage'] = $currentPage;
        dd($data['packetloss']);
        return view('admin', $data);
    }
}
