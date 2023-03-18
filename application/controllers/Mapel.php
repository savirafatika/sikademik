<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mapel_model', 'mapel');
        $this->load->model('Jadwal_model', 'jadwal');
        is_logged_in();
    }

    public function index()
    {
        $data['title']        = 'Data Mata Pelajaran';
        $email                = $this->session->userdata('email');
        $data['user']         = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['daftar_kelas'] = $this->jadwal->getAllKelas()->result_array();
        $this->load->view('pages/mapel/list-kelas', $data);
    }

    public function kelas($idKelas = null)
    {
        if (!$idKelas) {
            redirect('mapel');
        }
        $data['title'] = 'Data Mata Pelajaran';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['kelas'] = $this->jadwal->getKelasByID($idKelas)->row_array();
        $data['mapel'] = $this->mapel->getMapel($idKelas)->result_array();
        $this->load->view('pages/mapel/index', $data);
    }

    public function store()
    {
        $kelas_id   = $this->input->post('kelas_id');
        $nama_mapel = $this->input->post('nama_mapel');
        $grup = $this->input->post('grup');

        $check = $this->db->get_where('mata_pelajaran', [
            'kelas_id'   => $kelas_id,
            'nama_mapel' => $nama_mapel,
        ])->num_rows();
        if ($check < 1) {
            $is_unique = "";
        } else {
            $is_unique = "|is_unique[mata_pelajaran.nama_mapel]";
        }

        $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required' . $is_unique);
        $this->form_validation->set_rules('grup', 'Kelompok Mata Pelajaran', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'kelas_id'   => $kelas_id,
                'nama_mapel' => $nama_mapel,
                'grup' => $grup,
            ];
            $this->db->insert('mata_pelajaran', $data);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function update()
    {
        $id         = $this->input->post('id');
        $kelas_id   = $this->input->post('kelas_id');
        $nama_mapel = $this->input->post('nama_mapel');
        $grup = $this->input->post('grup');

        $check = $this->db->get_where('mata_pelajaran', ['id' => $id])->row();
        if ($check->kelas_id == $kelas_id && $check->nama_mapel == $nama_mapel) {
            $is_unique = "";
        } else {
            $is_unique = "|is_unique[mata_pelajaran.nama_mapel]";
        }

        $this->form_validation->set_rules('nama_mapel', 'Nama Mata Pelajaran', 'required' . $is_unique);
        $this->form_validation->set_rules('grup', 'Kelompok Mata Pelajaran', 'required');
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('kelas_id', $kelas_id);
            $this->db->set('grup', $grup);
            $this->db->set('nama_mapel', $nama_mapel);
            $this->db->where('id', $id);
            $this->db->update('mata_pelajaran');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('id', 'ID Mata Pelajaran', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('mata_pelajaran');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}