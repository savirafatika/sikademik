<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Siswa_model', 'siswa');
        $this->load->model('Jadwal_model', 'jadwal');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['daftar_kelas'] = $this->jadwal->getAllKelas()->result_array();

        $this->load->view('pages/siswa/list-kelas', $data);
    }

    public function data_siswa($idKelas = null)
    {
        if (!$idKelas) {
            redirect('jadwal');
        }
        $data['title'] = 'Data Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['kelas'] = $this->jadwal->getKelasByID($idKelas)->row_array();
        $data['siswa'] = $this->siswa->getSiswa($idKelas)->result_array();
        $this->load->view('pages/siswa/index', $data);
    }

    public function getSiswa($idKelas = null)
    {
        $data = $this->siswa->getSiswa($idKelas)->result();
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required|is_unique[siswa.NIS]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'nis'            => $this->input->post('nis'),
                'nama'           => $this->input->post('nama'),
                'tempat_lahir'   => $this->input->post('tempat_lahir'),
                'tanggal_lahir'  => $this->input->post('tanggal_lahir'),
                'agama'          => $this->input->post('agama'),
                'nama_ayah'      => $this->input->post('nama_ayah'),
                'nama_ibu'       => $this->input->post('nama_ibu'),
                'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
                'pekerjaan_ibu'  => $this->input->post('pekerjaan_ibu'),
                'alamat'         => $this->input->post('alamat'),
                'jenis_kelamin'  => $this->input->post('jenis_kelamin'),
            ];
            $this->db->insert('siswa', $data);

            // tambahkan siswa ke tbl kelas_murid
            $this->db->insert('kelas_murid', [
                'nis'      => $this->input->post('nis'),
                'kelas_id' => $this->input->post('kelas_id'),
            ]);

            // tambahkan siswa ke user tabel
            $nama  = $this->input->post('nama');
            $nis   = $this->input->post('nis');
            $email = implode("_", explode(" ", $nama));

            $data_siswa = [
                'name'         => $this->input->post('nama'),
                'email'        => strtolower($email) . '@sikademik.com',
                'password'     => password_hash($nis, PASSWORD_DEFAULT),
                'role_id'      => 3,
                'is_active'    => 1,
                'no_induk'     => $nis,
                'date_created' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('user', $data_siswa);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function update()
    {
        $id        = $this->input->post('id_siswa');
        $nis       = $this->input->post('nis');
        $is_unique = is_unique('siswa', $id, 'NIS', $nis, 'NIS');
        $this->form_validation->set_rules('nis', 'NIS', 'required' . $is_unique);
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'required');
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('nis', $this->input->post('nis'));
            $this->db->set('nama', $this->input->post('nama'));
            $this->db->set('tempat_lahir', $this->input->post('tempat_lahir'));
            $this->db->set('tanggal_lahir', $this->input->post('tanggal_lahir'));
            $this->db->set('agama', $this->input->post('agama'));
            $this->db->set('nama_ayah', $this->input->post('nama_ayah'));
            $this->db->set('nama_ibu', $this->input->post('nama_ibu'));
            $this->db->set('pekerjaan_ayah', $this->input->post('pekerjaan_ayah'));
            $this->db->set('pekerjaan_ibu', $this->input->post('pekerjaan_ibu'));
            $this->db->set('alamat', $this->input->post('alamat'));
            $this->db->set('jenis_kelamin', $this->input->post('jenis_kelamin'));
            $this->db->where('NIS', $this->input->post('id_siswa'));
            $this->db->update('siswa');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('nis', 'NIS', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('NIS', $this->input->post('nis'));
            $this->db->delete('siswa');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
