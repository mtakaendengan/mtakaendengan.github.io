<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {

        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'NoteApp User Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login(); //private
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        //var_dump($user);
        //die;
        if ($user) {
            if ($user['ac_user'] == 1) {
                if ($password == $user['password']) {
                    $data = [
                        'username' => $user['username'],
                        'lv_user' => $user['lv_user']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['lv_user'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User not Activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User not Registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {

        if ($this->session->userdata('username')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[5]|max_length[20]|is_unique[user.username]', [
            'is_unique' => 'This username has been taken!'
        ]);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|max_length[20]|matches[password2]', [
            'matches' => 'Password did not match!',
            'min_length' => 'Password too short (min 3)',
            'max_length' => 'Password too long (max 10)'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'NoteApp User Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nm_user' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'im_user' => 'default.jpg',
                'password' => $this->input->post('password1'),
                'lv_user' => 2,
                'ac_user' => 1,
                'dt_user' => time()
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Account Created,  Please Login!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('lv_user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logged out complete!</div>');
        redirect('auth');
    }

    public function block()
    {
        $this->load->view('auth/block');
    }
}
