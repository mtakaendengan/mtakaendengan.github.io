<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getAllAdmin()
    {
        $query = $this->db->get('user');
        return $query->result_array();
    }

    public function getRole()
    {
        $query = "SELECT `user_role`.`ty_role`, `user`.`lv_user`
                  from `user_role` Join `user`
                  on `user_role`.`id_role` = `user`.`lv_user`
    ";
        return $this->db->query($query)->result_array();
    }
}
