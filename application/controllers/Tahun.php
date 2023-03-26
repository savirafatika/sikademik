<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Tahun Ajaran';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['tahun'] = $this->db->get('tahun_ajaran')->result_array();
        $this->load->view('pages/tahun/index', $data);
    }

    public function getTahun()
    {
        $data = $this->db->get('tahun_ajaran')->result();
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|is_unique[tahun_ajaran.tahun]');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'tahun' => $this->input->post('tahun'),
            ];
            $this->db->insert('tahun_ajaran', $data);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }
    public function update()
    {
        $id        = $this->input->post('id');
        $form      = $this->input->post('tahun');
        $is_unique = is_unique('tahun_ajaran', $id, 'tahun', $form);
        $this->form_validation->set_rules('tahun', 'Tahun', 'required' . $is_unique);

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('tahun', $form);
            $this->db->where('id', $id);
            $this->db->update('tahun_ajaran');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('id', 'ID Tahun', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id'));
            $this->db->delete('tahun_ajaran');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
