<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function main()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_sidebar', $data);
        $this->load->view('templates/user_topbar', $data);
        $this->load->view('user/main', $data);
        $this->load->view('templates/user_footer', $data);
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/user_footer', $data);
        } else {
            $name = $this->input->post('name');
            $username = $this->input->post('username');

            //cek jika ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['im_user'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('im_user', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('nm_user', $name);
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Profile has been updated</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $this->form_validation->set_rules('currentpassword', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'New Password', 'required|trim|min_length[3]|max_length[20]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'Confirm New Password', 'required|trim|min_length[3]|max_length[20]|matches[newpassword1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/user_footer', $data);
        } else {

            $currentpassword = $this->input->post('currentpassword');
            $newpassword = $this->input->post('newpassword1');

            if ($currentpassword = $data['user']['password']) {
                //untuk password ber hash gunakan method verifypassword :)
                //var_dump($currentpassword,  $data['user']['password'], $newpassword);
                //die;
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Old Password</div>');
                redirect('user/changepassword');
            } else {
                if ($currentpassword == $newpassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password cannot be the same</div>');
                    redirect('user/changepassword');
                } else {
                    //acak password
                    // $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    // $usepassword = $new_password;
                    $this->db->set('password', $newpassword);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
