<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DataModel;

class DataController extends Controller
{

    public function index($hierarki = 'kabupaten', $id = null)
    {
        $dataModel = new DataModel();
        $data['kabupaten'] = $dataModel->getKabupatenData();
        $data['hierarki'] = $hierarki; // Tambahkan baris ini
        $data['dataModel'] = $dataModel; // Menambahkan dataModel ke data yang akan dikirim ke tampilan


        if ($hierarki === 'kabupaten') {
            $data['data'] = $dataModel->getKabupatenData();
        } elseif ($hierarki === 'kecamatan' && $id) {
            $data['data'] = $dataModel->getKecamatanData($id);
        } elseif ($hierarki === 'site' && $id) {
            $data['data'] = $dataModel->getSiteData($id);
        } else {
            // Tambahkan logika lain jika diperlukan
        }

        return view('data_view', $data);
    }
}
