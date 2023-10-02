<?php

namespace App\Controllers;

use App\Models\DashboardZeroModel;

class Dashboardzero extends BaseController
{
    public function index()
    {
        $zeromodel = new DashboardZeroModel();
      
        $data['zerotrafic_load'] = $zeromodel->orderBy('date', 'DESC')->findAll();

        // $data['dateUpdate'] = $zeromodel->getDateUpdate();
        // dd($data['dateUpdate']);

        return view('dashboardzero', $data);
    }
    public function filterData()
    {
        $zeromodel = new DashboardZeroModel();

        $length = (int) $this->request->getPost('length') ;
        $start =  (int) $this->request->getPost('start');
        $order = $this->request->getPost('order');
        $search = $this->request->getPost('search');
    
        $filter_nop = $this->request->getPost('filter_nop');
    
        $query = $zeromodel->select('*');
    
        if (!empty($filter_nop)) {
            $query->where('nop', $filter_nop);
        }
    
        if (!empty($search['value'])) {
            $query->like('cell_name', $search['value']);
        }
    
        if (isset($order[0])) {
            $columns = ['tech', 'date', 'cell_name','site_id','site_name','kecamatan','kabupaten','nop','remark'];
            $column = $columns[$order[0]['column']];
            $dir = $order[0]['dir'];
    
            $query->orderBy($column, $dir);
        }
    
        $totalRecords = $query->countAllResults();
        $data = $query->findAll($length, $start);
    
        $result = [
            'draw' => intval($this->request->getPost('draw')),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ];
    
        return response()->setJson($result);
        // $nop = $this->request->getPost('filter_nop');
        // $zeromodel = new DashboardZeroModel();
    
        // if (empty($nop)) {
        //     $data['zerotrafic_load'] = $zeromodel->orderBy('date', 'DESC')->findAll();
        // } else {
        //     // Assuming getFilteredData does a DB query to filter by NOP:
        //     $data['zerotrafic_load'] = $zeromodel->where('nop', $nop)->orderBy('date', 'DESC')->findAll();
        // }
        
        // return view('dashboardzero_rows', $data); 
    }
  
    public function chartdata()
    {
        $zeromodel = new DashboardZeroModel();
        $data['zerodate'] = $zeromodel->getLineData();
        return response()->setJson($data);
    }

    public function barchart()
    {
        $zeromodel = new DashboardZeroModel();
        $data['dateUpdate'] = $zeromodel->getDateUpdate();
        return response()->setJson($data);
    }

   
}
