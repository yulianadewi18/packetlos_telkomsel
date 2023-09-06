<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'packetlos';
    protected $primaryKey = 'site_id';

    public function search($keyword)
    {
        $builder = $this->table('packetlos');
        $builder->like('site_id', $keyword);
        $builder->orLike('nop', $keyword);
        $builder->orLike('pl_status', $keyword);
        return $builder;
    }
}
