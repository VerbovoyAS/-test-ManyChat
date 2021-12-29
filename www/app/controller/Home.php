<?php

class Home extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = $this->model('HomeModel');
    }

    public function index()
    {
        $getList = $this->model->getReports();
        $this->view('home/index', $getList);
    }

}