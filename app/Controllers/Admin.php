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

        $data['packetloss'] = $Adminmodel->findAll();
        // $data['packetloss'] = $admin->orderBy('week', 'desc')->paginate(25, 'packetlos');
        // $data['pager'] = $Adminmodel->pager;
        // $data['currentPage'] = $currentPage;
        // dd($data['packetloss']);
        return view('admin', $data);
    }
    public function edit()
    {
        $site_id = $this->request->getPost("site_id");
        $pl_status = $this->request->getPost("pl_status");


        $data = [
            'site_id' => $site_id,
            'pl_status' => $pl_status,
        ];

        $where = ['site_id' => $site_id];

        try {
            $adminModel = new AdminModel();
            $edit = $adminModel->editData('packetlos', $data, $where);

            if ($edit) {
                echo "<script>alert('Data Berhasil diubah'); window.location='" . base_url('admin') . "';</script>";
            } else {
                echo "<script>alert('Gagal mengubah data'); window.location='" . base_url('admin') . "';</script>";
            }
        } catch (\Exception $e) {
            // Handle error if needed
        }
    }
}
