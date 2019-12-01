<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meeting extends CI_Controller
{

    public function report()
    {
        $data['title'] = 'Write Report';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        //echo 'selamat datang user ', $data['user']['nm_user'];

        $data['report'] = $this->db->get('meeting_report_test')->result_array();

        $this->form_validation->set_rules('date', 'Date', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_sidebar', $data);
            $this->load->view('templates/user_topbar', $data);
            $this->load->view('meeting/report', $data);
            $this->load->view('templates/user_footer', $data);
        } else {
            $data = [
                'date' => $this->input->post('date')
            ];
            $this->db->insert('meeting_report_test', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added</div>');
            redirect('meeting/report');
        }
    }
}
