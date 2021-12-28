<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;
class NamesCrud extends BaseController
{
    // show names list
    public function index()
    {
        $NameModel = new EmployeeModel();
        $data['users'] = $NameModel->orderBy('id', 'DESC')->findAll();
        return view('namelist', $data);
    }

    // add name form
    public function create()
    {
        return view('addname');
    }

    // add data
    public function store()
    {
        $NameModel = new EmployeeModel();
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $NameModel->insert($data);
        return $this->response->redirect(base_url('/namelist'));
    }

    // show single name
    public function singleUser($id = null)
    {
        $NameModel = new EmployeeModel();
        $data['user_obj'] = $NameModel->where('id', $id)->first();
        return view('editnames', $data);
    }

    // update name data
    public function update()
    {
        $NameModel = new EmployeeModel();
        $id = $this->request->getVar('id');
        $data = [
            'name' => $this->request->getVar('name'),
            'email'  => $this->request->getVar('email'),
        ];
        $NameModel->update($id, $data);
        return $this->response->redirect(base_url('/namelist'));
    }

    // delete name
    public function delete($id = null)
    {
        $NameModel = new EmployeeModel();
        $data['user'] = $NameModel->where('id', $id)->delete($id);
        return $this->response->redirect(base_url('/namelist'));
    }    
}
