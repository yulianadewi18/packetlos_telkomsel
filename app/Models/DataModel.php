<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = 'payload'; // Gantilah 'nama_tabel_anda' dengan nama tabel yang sesuai dalam database Anda.
    protected $primaryKey = 'kabupaten'; // Gantilah 'site_id' dengan nama primary key yang sesuai.

    public function convertPayloadToNumeric($payload)
    {
        // Menghilangkan simbol mata uang dan mengganti tanda koma dengan titik
        // $payload = str_replace(['Rp', ',', '.'], '', $payload);
        return floatval($payload);
        // function formatToRupiah($value)
        // {
        //     return 'Rp ' . number_format($value, 2, ',', '.');
        // }
    }

    public function getKabupatenData()
    {
        $builder = $this->select('kabupaten, SUM(payload) as total_payload')
            ->groupBy('kabupaten')
            ->orderBy('total_payload', 'asc')
            ->get();

        return $builder->getResultArray();
    }

    public function getKecamatanData($kabupaten)
    {
        $builder = $this->select('kecamatan, SUM(payload) as total_payload')
            ->where('kabupaten', $kabupaten)
            ->groupBy('kecamatan')
            ->orderBy('total_payload', 'asc')
            ->get();

        return $builder->getResultArray();
    }

    public function getSiteData($kecamatan)
    {
        $builder = $this->select('site_id, payload as total_payload')
            ->where('kecamatan', $kecamatan)
            ->orderBy('total_payload', 'asc')
            ->get();

        return $builder->getResultArray();
    }
}
