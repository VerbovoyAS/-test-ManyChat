<?php

class Staff extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('StaffModel');
    }

    public function index()
    {
        $getDepartment = $this->model->getAllProjectsList();
        $getProject = $this->model->getAllDepartmentList();

        $result = [
            'departmentList' => $getDepartment,
            'projectList'    => $getProject,
            'staffList'      => $this->model->getAll(),
            'gender'         => $this->model::GENDER,
        ];
        $this->view('staff/index', $result);
    }

    public function add()
    {
        $getDepartment = $this->model->getOptionDepartment();
        $getProject = $this->model->getOptionProject();

        $result = [
            'getDepartment' => $getDepartment ?? null,
            'getProject'    => $getProject ?? null,
        ];

        $this->view('staff/add', $result);
    }

    public function delete()
    {
        $this->model->delete($_GET['id']);
        $this->view('staff/delete');
    }

    public function update()
    {
        $getStaff = $this->model->getStaff($_GET);
        $getDepartment = $this->model->getOptionDepartment();
        $getProject = $this->model->getOptionProject();

        $result = [
            'getStaff'      => $getStaff,
            'getDepartment' => $getDepartment ?? null,
            'getProject'    => $getProject ?? null,
        ];

        $this->view('staff/update', $result);
    }

    public function addStaff()
    {
        $response = $this->model->addNewStaff($_POST);
        $this->view('staff/info', $response);
    }

    public function updateStaff()
    {
        if (!empty($_POST)) {
            $getDepartment = $this->model->updateStaff($_POST);
            $this->view('staff/info', $getDepartment);
        }
    }

}