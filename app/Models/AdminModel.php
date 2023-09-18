<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'packetlos';
    protected $primaryKey = 'site_id';

    public function search($keyword, $nop)
    {
        $builder = $this->builder();

        $builder->groupStart()
            ->like('site_id', $keyword)
            ->orLike('pl_status', $keyword)
            ->orLike('week', $keyword)
            ->orLike('avg_packet_loss', $keyword)
            ->orLike('kabupaten', $keyword)
            ->orLike('nop', $keyword)
            ->groupEnd();

        $builder->where('nop', $nop);

        return $builder->get()->getResultArray();
    }
    public function editData($table, $data, $where)
    {
        return $this->db->table($table)->update($data, $where);
    }
}
