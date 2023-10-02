<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardZeroModel extends Model
{
    protected $table = 'zero';
    // protected $primaryKey = '';

    public function getLineData()
    {
        $query = $this->select('date, SUM(CASE WHEN remark = "TRAFFIC" THEN 1 ELSE 0 END) AS traffic_count, SUM(CASE WHEN remark = "PAYLOAD" THEN 1 ELSE 0 END) AS payload_count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return $query->getResult('array');
    }

    public function getDateUpdate()
    {
        $dateUpdate = $this->selectMax('date')->first();
        if ($dateUpdate) {
            $dateupdatevalue = $dateUpdate['date'];

            $query = $this->select('nop, SUM(CASE WHEN remark = "TRAFFIC" THEN 1 ELSE 0 END) AS traffic_count, SUM(CASE WHEN remark = "PAYLOAD" THEN 1 ELSE 0 END) AS payload_count')
                ->where('date', $dateupdatevalue)
                ->groupBy('nop')
                ->orderBy('nop', 'asc')
                ->get();
        } else {
            echo "Tidak ada data tanggal terupdate yang ditemukan.";
        }
        return $query->getResult('array');
    }
    public function getFilteredData($nop = null) 
    {
        if($nop) {
            $this->where('nop', $nop)->get();
        }
        return $this->findAll();
    }
}
