<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];


        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function employeeAdd()
    {
        $data['title'] = 'Add User';

        $this->load->model('Admin_model', 'arole');
        $data['arole'] = $this->arole->getRole();
        $data['arole'] = $this->db->get('user_role')->result_array();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $this->form_validation->set_rules('nm_user', 'Full Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        //$this->form_validation->set_rules('im_user', 'Image', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('lv_user', 'Level User', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/employeeadd', $data);
            $this->load->view('templates/user_footer', $data);
        } else {
            $data = [
                'nm_user' => htmlspecialchars($this->input->post('nm_user', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'im_user' => 'default.jpg',
                'password' => $this->input->post('password'),
                'lv_user' => $this->input->post('lv_user'),
                'ac_user' => 1,
                'dt_user' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New User Added</div>');
            redirect('admin/employeeadd');
        }
    }

    public function main()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/main', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('ty_role', 'Role Name', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/user_footer', $data);
        } else {
            $data = [
                'ty_role' => $this->input->post('ty_role'),
            ];
            $this->db->insert('user_role', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($id_role)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $data['role'] = $this->db->get_where('user_role', ['id_role' => $id_role])->row_array();

        $this->db->where('id_menu !=', 1);
        $data['menu'] = $this->db->get('menu')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function changeAccess()
    {
        $id_menu = $this->input->post('id_menu');
        $id_role = $this->input->post('id_role');

        $data = [
            'id_role' => $id_role,
            'id_menu' => $id_menu
        ];

        $result = $this->db->get_where('menu_access', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('menu_access', $data);
        } else {
            $this->db->delete('menu_access', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    public function employee()
    {
        $data['title'] = 'Employee';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $data['employee'] = $this->db->get('user')->result_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('admin/employee', $data);
        $this->load->view('templates/user_footer', $data);
    }
}
