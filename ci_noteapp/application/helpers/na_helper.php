<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $id_role = $ci->session->userdata('lv_user');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('menu', ['nm_menu' => $menu])->row_array();
        $id_menu = $queryMenu['id_menu'];

        $userAccess = $ci->db->get_where('menu_access', [
            'id_role' => $id_role,
            'id_menu' => $id_menu
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/block');
        }
    }
}

function check_access($id_role, $id_menu)
{
    $ci = get_instance();

    $ci->db->where('id_role', $id_role);
    $ci->db->where('id_menu', $id_menu);
    $result = $ci->db->get('menu_access');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
