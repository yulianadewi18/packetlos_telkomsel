<?php

namespace App\Controllers;

use App\Models\PayloadModel;

class Payload extends BaseController
{
    public function index()
    {
        $payloadModel = new PayloadModel();
        $data['payload'] = $payloadModel->select('payload.*, SUM(payload) as total_payload')
            ->groupBy('kabupaten')
            ->orderBy('total_payload', 'ASC')
            ->get()
            ->getResultArray();
        $selectedKabupaten = $this->request->getGet('kabupaten');
        $selectedKecamatan = $this->request->getGet('kecamatan');
        if ($selectedKabupaten !== null) {
            // Jika 'kabupaten' ada dalam URL, Anda bisa memprosesnya
            // Misalnya, Anda bisa menggunakan nilai ini untuk mengambil data berdasarkan 'kabupaten'
            $data['payload'] = $payloadModel
                ->where('kabupaten', $selectedKabupaten)
                ->orderBy('payload', 'ASC') // Mengurutkan dari yang terkecil
                ->findAll();
        }

        if ($selectedKecamatan !== null) {
            // Jika 'kecamatan' ada dalam URL, Anda bisa memprosesnya
            // Misalnya, Anda bisa menggunakan nilai ini untuk mengambil data berdasarkan 'kecamatan'
            $data['payload'] = $payloadModel
                ->where('kecamatan', $selectedKecamatan)
                ->orderBy('payload', 'ASC') // Mengurutkan dari yang terkecil
                ->findAll();
        }
        return view('payload', $data);
    }
}
