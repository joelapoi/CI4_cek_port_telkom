<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields = ['akses'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        $builder = $this->table('users');
        $builder->like('email', $keyword)->orLike('username', $keyword);
        return $builder;
    }
}
