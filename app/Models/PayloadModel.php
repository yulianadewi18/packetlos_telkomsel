<?php

namespace App\Models;

use CodeIgniter\Model;

class PayloadModel extends Model
{
    protected $table = 'payload';
    protected $geo = 'geojson';
    // protected $primaryKey = '';

    public function getData()
    {
        return $this->findAll();
    }
}
