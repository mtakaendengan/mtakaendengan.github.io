<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/user_footer', $data);
        } else {
            $this->db->insert('menu', ['nm_menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('menu');
        }
    }

    public function subMenu()
    {
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->form_validation->set_rules('tl_sub', 'Title', 'required');
        $this->form_validation->set_rules('id_menu', 'Menu', 'required');
        $this->form_validation->set_rules('ur_sub', 'URL', 'required');
        $this->form_validation->set_rules('ic_sub', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/user_footer', $data);
        } else {
            $data = [
                'tl_sub' => $this->input->post('tl_sub'),
                'id_menu' => $this->input->post('id_menu'),
                'ur_sub' => $this->input->post('ur_sub'),
                'ic_sub' => $this->input->post('ic_sub'),
                'ac_sub' => $this->input->post('ac_sub')
            ];
            $this->db->insert('sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('menu/submenu');
        }
    }
}
