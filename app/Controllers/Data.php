<?php

namespace App\Controllers;

use App\Models\DataModel;
use Config\Validation;

ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');

class Data extends BaseController
{
    protected $dataModel;

    public function __construct()
    {
        helper('form');
        $this->dataModel = new DataModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_tb_data') ? $this->request->getVar('page_tb_data') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $data = $this->dataModel->search($keyword);
        } else {
            $data = $this->dataModel;
        }

        $data = [
            'title' => 'Daftar ODP Gendong',
            // 'data'  => $this->dataModel->findAll(),
            'data'  => $data->paginate(10, 'tb_data'),
            'pager'  => $this->dataModel->pager,
            'currentPage'   => $currentPage
        ];


        return view('data/index', $data);
    }

    public function delete()
    {
        $this->dataModel->truncate('tb_data');
        session()->setFlashdata('pesan', 'Data Berhasil dihapus.');
        return redirect()->to('/data');
    }

    public function import()
    {
        $file = $this->request->getFile('file_excel');
        $ext = $file->getClientExtension();
        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $x => $excel) {
            //skip header tabel
            // if ($x == 0) {
            //     continue;
            // }
            $data = [
                'witel'         => $excel['1'],
                'sto'           => $excel['2'],
                'vendor'        => $excel['3'],
                'node_ip'       => $excel['4'],
                'jmlh_onu_id'   => $excel['5'],
                'nama_odp1'     => $excel['6'],
                'nama_odp2'     => $excel['7'],
                'nama_odp3'     => $excel['8'],
                'nama_odp4'     => $excel['9'],
            ];
            $this->dataModel->add($data);

        }
        session()->setFlashdata('pesan','Data berhasil di import !!');
        return redirect()->to(base_url('data'));
    }
    //--------------------------------------------------------------------

}
