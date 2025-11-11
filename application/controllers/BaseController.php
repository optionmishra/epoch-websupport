<?php

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class BaseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('string');

        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('Permission');
        $this->load->library('upload');
        $this->load->library('email');
        $this->load->library('excel');

        $this->load->model('AuthModel');
        $this->load->model('WebModel');

        $this->siteEmail = $_ENV['EMAIL'];
        $this->siteName = $_ENV['NAME'];
    }

    protected function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        exit();
    }
}
