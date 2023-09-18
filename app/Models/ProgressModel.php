<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'activity_trial';
    protected $primaryKey = 'Unique_ID';

    public function getPercen()
    {
        $query = $this->select('new_nop,SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) AS closed_count, SUM(CASE WHEN status = "open" THEN 1 ELSE 0 END) AS open_count, (SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) / (SUM(CASE WHEN status = "closed" THEN 1 ELSE 0 END) + SUM(CASE WHEN status = "open" THEN 1 ELSE 0 END)) * 100) AS percentage ')
            ->groupBy('new_nop')
            ->orderBy('percentage', 'desc')
            ->get();

        return $query->getResult('array');
    }
}
