<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{
    protected $filters = ['auth'];

    public function index()
    {

        //data packet loss dari database filter nop
        $session = session();
        $nop = $session->nop;
        $Adminmodel = new AdminModel();

        $keyword = $this->request->getVar('keyword');
        // dd($keyword);
        $data['packetloss'] = $Adminmodel->where('nop', $nop)->findAll();
        if ($keyword != null || !empty($keyword)) {
            $data['packetloss'] = $Adminmodel->search($keyword, $nop);
        }
        return view('admin', $data);
    }
    public function edit()
    {
        $site_id = $this->request->getPost("site_id");
        $pl_status = $this->request->getPost("pl_status");
        $newAvgPacketLoss = $this->request->getPost("avg_packet_loss"); // Updated field name

        $data = [
            'site_id' => $site_id,
            'pl_status' => $pl_status,
            'avg_packet_loss' => $newAvgPacketLoss, // Updated field name
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
