<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table      = 'tb_data';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['akses'];

    public function getData($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        $builder = $this->table('tb_data');
        $builder->like('node_ip', $keyword)->orLike('nama_odp1', $keyword)->orLike('nama_odp2', $keyword)->orLike('nama_odp3', $keyword)->orLike('nama_odp4', $keyword);
        return $builder;
    }

    public function add($data)
    {
        $this->db->table('tb_data')->insert($data);
    }

    public function cekdata($id)
    {
        return $this->db->table('tb_data')->where('id', $id)->get()->getRowArray();    
    }
}
