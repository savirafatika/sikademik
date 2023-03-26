<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
			parent::__construct();
			is_logged_in();
	}
	
	public function index() {
		$data['title'] = 'Dashboard';
		$data['total_guru'] = $this->db->get_where('user', ['role_id' => 2])->num_rows();
		$data['total_siswa'] = $this->db->get('siswa')->num_rows();
		$data['total_mapel'] = $this->db->get('mata_pelajaran')->num_rows();
		$data['total_staff'] = $this->db->get_where('user', ['role_id' => 1])->num_rows();
		$this->load->view('pages/dashboard', $data);
	}
}