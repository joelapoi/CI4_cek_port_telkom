<?php

namespace App\Controllers;

use App\Models\UsersModel;
use Config\Validation;

class Users extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $users = $this->usersModel->search($keyword);
        } else {
            $users = $this->usersModel;
        }

        $data = [
            'title' => 'Daftar ODP Gendong',
            // 'users'  => $this->usersModel->findAll(),
            'users'  => $users->paginate(10, 'users'),
            'pager'  => $this->usersModel->pager,
            'currentPage'   => $currentPage
        ];


        return view('users/index', $data);
    }

    public function edit($id)
    {
        $data = [
            'title'         => 'Form Edit User',
            'validation'    => \Config\Services::validation(),
            'users'         => $this->usersModel->getUser($id)
        ];
        return view('users/edit', $data);
    }

    public function update($id)
    {
        $this->usersModel->save([
            'id'        => $id,
            'akses'     => $this->request->getVar('akses')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $this->usersModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus.');
        return redirect()->to('/users');
    }
    //--------------------------------------------------------------------

}
