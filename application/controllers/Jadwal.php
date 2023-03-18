<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model', 'jadwal');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Jadwal Pelajaran';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['daftar_kelas'] = $this->jadwal->getAllKelas()->result_array();
        $this->load->view('pages/jadwal/index', $data);
    }

    public function jadwal_kelas($idKelas = null)
    {
        if (!$idKelas) {
            redirect('jadwal');
        }
        $data['title'] = 'Jadwal Pelajaran';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['jadwal'] = $this->jadwal->getJadwalKelas($idKelas)->result_array();
        $data['kelas']  = $this->jadwal->getKelasByID($idKelas)->row_array();
        $data['tahun']  = $this->jadwal->getTahun()->result_array();
        $data['mapel']  = $this->jadwal->getAllMapel($idKelas)->result_array();
        $data['guru']   = $this->db->get('guru')->result_array();
        $data['hari']   = $this->db->get('hari')->result_array();
        $this->load->view('pages/jadwal/kelas/index', $data);

    }

    public function store()
    {
        $this->form_validation->set_rules('tahun_id', 'Tahun', 'required');
        $this->form_validation->set_rules('mapel_id', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('guru_id', 'Guru', 'required');
        $this->form_validation->set_rules('hari_id', 'Nama Hari', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'kelas_id' => $this->input->post('kelas_id'),
                'tahun_id' => $this->input->post('tahun_id'),
                'mapel_id' => $this->input->post('mapel_id'),
                'guru_id'  => $this->input->post('guru_id'),
                'hari_id'  => $this->input->post('hari_id'),
                'jam'      => $this->input->post('jam'),
            ];
            $this->db->insert('jadwal_pelajaran', $data);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function update()
    {

        $this->form_validation->set_rules('tahun_id', 'Tahun', 'required');
        $this->form_validation->set_rules('mapel_id', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('guru_id', 'Guru', 'required');
        $this->form_validation->set_rules('hari_id', 'Nama Hari', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('tahun_id', $this->input->post('tahun_id'));
            $this->db->set('mapel_id', $this->input->post('mapel_id'));
            $this->db->set('guru_id', $this->input->post('guru_id'));
            $this->db->set('hari_id', $this->input->post('hari_id'));
            $this->db->set('jam', $this->input->post('jam'));
            $this->db->where('id', $this->input->post('id_jadwal'));
            $this->db->update('jadwal_pelajaran');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $jadwal_id = $this->input->post('id');
        $this->db->where('id', $jadwal_id);
        $this->db->delete('jadwal_pelajaran');
        echo json_encode(['success' => 'Data berhasil dihapus']);
    }
}