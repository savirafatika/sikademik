<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Pengguna';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['users'] = $this->user->getUser($email)->result_array();
        $data['role']  = $this->db->get('user_role')->result_array();
        $this->load->view('pages/user/index', $data);
    }

    public function getUser()
    {
        $email = $this->input->get('email');
        $data  = $this->user->getUser($email)->result();
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('is_active', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'name'         => $this->input->post('nama'),
                'email'        => $this->input->post('email'),
                'role_id'      => $this->input->post('role_id'),
                'is_active'    => $this->input->post('is_active'),
                'password'     => password_hash('sikademik', PASSWORD_DEFAULT),
                'date_created' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('user', $data);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function update()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('role_id', 'Role', 'required');
        $this->form_validation->set_rules('is_active', 'Status', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('is_active', $this->input->post('is_active'));
            $this->db->set('email', $this->input->post('email'));
            $this->db->set('role_id', $this->input->post('role_id'));
            $this->db->set('name', $this->input->post('nama'));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('id_user', 'User ID', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id_user'));
            $this->db->delete('user');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
