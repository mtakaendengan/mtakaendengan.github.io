<?php

class Home extends CI_Controller {
    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('templates/footer');
        $this->load->view('home/index');
    }
}