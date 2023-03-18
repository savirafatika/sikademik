<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Guru_model', 'guru');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Guru';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['guru'] = $this->guru->getGuru()->result_array();
        $this->load->view('pages/guru/index', $data);
    }

    public function getGuru()
    {
        $data = $this->guru->getGuru()->result();
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|is_unique[guru.NIP]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required');
        $this->form_validation->set_rules('nama_perguruan_tinggi', 'Nama Perguruan Tinggi', 'required');
        $this->form_validation->set_rules('jurusan', 'Nama Jurusan', 'required');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required');
        $this->form_validation->set_rules('golongan', 'Golongan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'nip'                   => $this->input->post('nip'),
                'nama'                  => $this->input->post('nama'),
                'tempat_lahir'          => $this->input->post('tempat_lahir'),
                'tanggal_lahir'         => $this->input->post('tanggal_lahir'),
                'jenis_kelamin'         => $this->input->post('jenis_kelamin'),
                'agama'                 => $this->input->post('agama'),
                'status_perkawinan'     => $this->input->post('status_perkawinan'),
                'nama_perguruan_tinggi' => $this->input->post('nama_perguruan_tinggi'),
                'jurusan'               => $this->input->post('jurusan'),
                'tahun_lulus'           => $this->input->post('tahun_lulus'),
                'golongan'              => $this->input->post('golongan'),
                'keterangan'            => $this->input->post('keterangan'),
                'alamat'                => $this->input->post('alamat'),
            ];
            $result = $this->db->insert('guru', $data);

            // tambahkan guru ke user tabel
            $nama  = $this->input->post('nama');
            $nip   = $this->input->post('nip');
            $email = implode("_", explode(" ", $nama));

            $data_guru = [
                'name'         => $this->input->post('nama'),
                'email'        => strtolower($email) . '@sikademik.com',
                'password'     => password_hash($nip, PASSWORD_DEFAULT),
                'role_id'      => 2,
                'is_active'    => 1,
                'no_induk'     => $nip,
                'date_created' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('user', $data_guru);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function update()
    {
        $id        = $this->input->post('id_guru');
        $nip       = $this->input->post('nip');
        $is_unique = is_unique('guru', $id, 'NIP', $nip, 'NIP');
        $this->form_validation->set_rules('nip', 'NIP', 'required' . $is_unique);
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('status_perkawinan', 'Status Perkawinan', 'required');
        $this->form_validation->set_rules('nama_perguruan_tinggi', 'Nama Perguruan Tinggi', 'required');
        $this->form_validation->set_rules('jurusan', 'Nama Jurusan', 'required');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required');
        $this->form_validation->set_rules('golongan', 'Golongan', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('nip', $this->input->post('nip'));
            $this->db->set('nama', $this->input->post('nama'));
            $this->db->set('tempat_lahir', $this->input->post('tempat_lahir'));
            $this->db->set('tanggal_lahir', $this->input->post('tanggal_lahir'));
            $this->db->set('jenis_kelamin', $this->input->post('jenis_kelamin'));
            $this->db->set('agama', $this->input->post('agama'));
            $this->db->set('status_perkawinan', $this->input->post('status_perkawinan'));
            $this->db->set('nama_perguruan_tinggi', $this->input->post('nama_perguruan_tinggi'));
            $this->db->set('jurusan', $this->input->post('jurusan'));
            $this->db->set('tahun_lulus', $this->input->post('tahun_lulus'));
            $this->db->set('golongan', $this->input->post('golongan'));
            $this->db->set('keterangan', $this->input->post('keterangan'));
            $this->db->set('alamat', $this->input->post('alamat'));
            $this->db->where('NIP', $this->input->post('id_guru'));
            $this->db->update('guru');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('NIP', $this->input->post('nip'));
            $this->db->delete('guru');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
