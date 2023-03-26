<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Level Pengguna';
        $data['user']  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('pages/role/index', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('role', 'Role', 'required|is_unique[user_role.role]');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }
    public function update()
    {
        $id        = $this->input->post('id_role');
        $form      = $this->input->post('role');
        $is_unique = is_unique('user_role', $id, 'role', $form);
        $this->form_validation->set_rules('role', 'Role', 'required' . $is_unique);

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('role', $this->input->post('role'));
            $this->db->where('id', $this->input->post('id_role'));
            $this->db->update('user_role');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('id_role', 'Role ID', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id_role'));
            $this->db->delete('user_role');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
