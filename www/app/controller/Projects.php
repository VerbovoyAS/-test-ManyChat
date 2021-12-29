<?php

class Projects extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('ProjectsModel');
    }

    public function index()
    {
        $model = $this->model('ProjectsModel');

        $this->view('projects/index', $model->getAll());
    }

    public function add()
    {
        $this->view('projects/add');
    }

    public function addProjects()
    {
        $response = $this->model->addNewProjects($_POST);

        $this->view('projects/info', $response);
    }

    public function update()
    {
        $getProjects = $this->model->getProjects($_GET);

        $this->view('projects/update', $getProjects);
    }

    public function delete()
    {
        $this->model->delete($_GET['id']);
        $this->view('projects/delete');
    }

    public function updateProjects()
    {
        if (!empty($_POST)) {
            $getDepartment = $this->model->updateProjects($_POST);
            $this->view('projects/info', $getDepartment);
        }
    }

}