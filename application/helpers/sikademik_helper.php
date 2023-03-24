<?php

function is_unique($table, $id, $field, $form, $where = 'id')
{
    $ci             = get_instance();
    $original_value = $ci->db->query("SELECT ${field} FROM ${table} WHERE ${where} = " . $id)->row()->$field;
    if ($form != $original_value) {
        $is_unique = "|is_unique[${table}.${field}]";
    } else {
        $is_unique = "";
    }
    return $is_unique;
}

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $path    = $ci->uri->segment(1);

        if ($role_id == 3) {
            $menu = $ci->db->get_where('user_sub_menu', [
                'url'     => $path,
                'menu_id' => 4,
            ])->row_array();
        } elseif ($role_id == 2) {
            $menu = $ci->db->get_where('user_sub_menu', [
                'url'     => $path,
                'menu_id' => 2,
            ])->row_array();
        } else {
            $ci->db->select('menu_id');
            $ci->db->where('url', $path);
            $ci->db->where_in('menu_id', [1, 3]);
            $menu = $ci->db->get('user_sub_menu')->row_array();
        }
        $userAccess = $ci->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu['menu_id'],
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();

    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function count_jadwal_kelas($id_kelas)
{
    $ci = get_instance();
    $ci->load->model('Jadwal_model', 'jadwal');
    return $ci->jadwal->countJadwalKelas($id_kelas)->num_rows();
}

function count_jumlah_mapel($id_kelas)
{
    $ci = get_instance();
    $ci->load->model('Mapel_model', 'mapel');
    return $ci->mapel->countMapelKelas($id_kelas)->num_rows();
}

function count_jadwal_kelas_guru($id_kelas, $nip)
{
    $ci = get_instance();
    $ci->load->model('Jadwal_guru_model', 'jadwal_guru');
    return $ci->jadwal_guru->countJadwalKelasGuru($id_kelas, $nip)->num_rows();
}

function count_siswa_kelas($id_kelas)
{
    $ci = get_instance();
    $ci->load->model('Jadwal_guru_model', 'siswa');
    return $ci->siswa->countSiswaKelas($id_kelas)->num_rows();
}

function conversi_nilai($angka)
{
    $nilai = '';
    if ($angka >= 81) {
        $nilai = 'A';
    } elseif ($angka > 60 && $angka <= 80) {
        $nilai = 'B';
    } elseif ($angka > 40 && $angka <= 60) {
        $nilai = 'C';
    } elseif ($angka > 20 && $angka <= 40) {
        $nilai = 'D';
    } else {
        $nilai = 'E';
    }
    return $nilai;
}

function get_ranking($idKelas, $nis)
{
    $ci = get_instance();
    $ci->load->model('Raport_model', 'raport');
    $query   = $ci->raport->getRankingSiswa($idKelas)->result_array();
    $ranking = array_column($query, 'nis');
    return array_search($nis, $ranking) + 1;
}
