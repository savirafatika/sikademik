<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_guru_model', 'jadwal_guru');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Jadwal Guru';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();
        $nip           = null;
        if ($data['user']['role_id'] != 1) {
            $nip = $data['user']['no_induk'] ?? null;
        }
        $data['daftar_guru'] = $this->jadwal_guru->getGuru($nip);
        $this->load->view('pages/jadwal/guru/list-guru', $data);
    }

    public function nip($nip)
    {
        $data['title'] = 'Jadwal Guru';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['daftar_kelas'] = $this->jadwal_guru->getMyKelas($nip)->result_array();
        $this->load->view('pages/jadwal/guru/list-kelas', $data);
    }

    public function kelas($idKelas = null)
    {
        if (!$idKelas) {
            redirect('jadwal_guru');
        }
        $nip = $this->input->get('nip');

        $data['title'] = 'Jadwal Guru';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['kelas']  = $this->jadwal_guru->getKelasByID($idKelas)->row_array();
        $data['jadwal'] = $this->jadwal_guru->getJadwalKelas($idKelas, $nip)->result_array();

        $this->load->view('pages/jadwal/guru/list-jadwal', $data);
    }

    public function update_jadwal_guru()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('jadwal_id', 'Jadwal', 'required');

        $data = [
            'jadwal_id' => $this->input->post('jadwal_id'),
            'nip'       => $this->input->post('nip'),
        ];
        $result = $this->db->insert('jadwal_guru', $data);
        echo json_encode($result);
    }

    public function delete_jadwal_guru()
    {
        $this->db->where('jadwal_id', $this->input->post('jadwal_id'));
        $result = $this->db->delete('jadwal_guru');
        echo json_encode($result);
    }
}
