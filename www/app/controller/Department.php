<?php

class Department extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('DepartmentModel');
    }

    public function index()
    {
        $this->view('department/index', $this->model->getAll());
    }

    public function addDepartment()
    {
        $response = $this->model->addNewDepartment($_POST);
        $this->view('department/info', $response);
    }

    public function add()
    {
        $this->view('department/add');
    }

    public function update()
    {
        $getDepartment = $this->model->getDepartment($_GET);
        $this->view('department/update', $getDepartment);
    }

    public function delete()
    {
        $this->model->delete($_GET['id']);
        $this->view('department/delete');
    }

    public function updateDepartment()
    {
        if (!empty($_POST)) {
            $getDepartment = $this->model->updateDepartment($_POST);
            $this->view('department/info', $getDepartment);
        }
    }

}