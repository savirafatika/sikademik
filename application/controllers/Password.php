<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
{
  public function __construct()
	{
    parent::__construct();
    if (!$this->session->userdata('email')) {
      redirect('auth');
    }
	}
  
  public function index()
  {
    $this->form_validation->set_rules('old_password', 'Password Lama', 'trim|required');
    $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
    $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'trim|required|min_length[3]|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Ganti Password';
      $this->load->view('pages/password/index', $data);
    } else {
      $email = $this->session->userdata('email');
      $user = $this->db->get_where('user', ['email' => $email])->row_array();

      $old_password = $this->input->post('old_password');
      $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
      if (password_verify($old_password, $user['password'])) {
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $this->db->update('user');
        
        $this->session->set_flashdata('message', '<div class="alert alert-success m-4" role="alert">Password telah berhasil diganti! Silakan login dengan password baru Anda.</div>');
          redirect('password');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak valid!</div>');
        redirect('password');
      }
    }
  }
}