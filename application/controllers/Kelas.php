<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Kelas';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['kelas'] = $this->db->get('kelas')->result_array();
        $this->load->view('pages/kelas/index', $data);
    }

    public function getKelas()
    {
        $data = $this->db->get('kelas')->result();
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required|is_unique[kelas.nama_kelas]');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'nama_kelas' => $this->input->post('nama_kelas'),
            ];
            $this->db->insert('kelas', $data);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }
    public function update()
    {
        $id        = $this->input->post('id');
        $form      = $this->input->post('nama_kelas');
        $is_unique = is_unique('kelas', $id, 'nama_kelas', $form);
        $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required' . $is_unique);

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('nama_kelas', $this->input->post('nama_kelas'));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('kelas');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('id', 'ID Kelas', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('kelas');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
