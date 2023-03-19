<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Nilai_model', 'nilai');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Nilai Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['kelas'] = $this->nilai->getAllKelas()->result_array();
        $data['tahun'] = $this->nilai->getTahun()->result_array();
        $this->load->view('pages/nilai/index', $data);
    }

    public function daftar_siswa()
    {
        $data['title'] = 'Data Nilai Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $param = [
            "kelas"    => $this->input->get('kelas'),
            "tahun"    => $this->input->get('tahun'),
            "semester" => $this->input->get('semester'),
        ];
        $data['daftar_siswa'] = $this->nilai->getDaftarSiswa($param)->result_array();
        $this->load->view('pages/nilai/list-siswa', $data);

    }

    public function lihat_nilai($idSiswa)
    {
        $data['title'] = 'Data Nilai Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $kelas    = $this->input->get('kelas');
        $tahun    = $this->input->get('tahun');
        $semester = $this->input->get('semester');
        $param    = [
            "kelas"    => $kelas,
            "tahun"    => $tahun,
            "semester" => $semester,
            "siswa"    => $idSiswa,
        ];
        $data['back']  = base_url('nilai/daftar_siswa') . "?kelas=${kelas}&tahun=${tahun}&semester=${semester}";
        $data['nilai'] = $this->nilai->getNilaiSiswa($param)->result_array();
        $this->load->view('pages/nilai/data-nilai', $data);

    }

    public function input()
    {
        $data['title'] = 'Input Nilai Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $data['kelas'] = $this->nilai->getAllKelas()->result_array();
        $data['tahun'] = $this->nilai->getTahun()->result_array();
        $data['mapel'] = $this->nilai->getAllMapel()->result_array();
        $this->load->view('pages/nilai/input', $data);
    }

    public function get_mapel()
    {
        $idKelas = $this->input->post('id', true);
        $data    = $this->nilai->getAllMapel($idKelas)->result();
        echo json_encode($data);
    }

    public function get_siswa()
    {
        $idKelas = $this->input->post('id', true);
        $data    = $this->nilai->getSiswa($idKelas)->result();
        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('tahun_id', 'Tahun', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('mapel_id', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('siswa_id', 'Siswa', 'required');
        $this->form_validation->set_rules('nilai_pengetahuan', 'Nilai Pengetahuan', 'required');
        $this->form_validation->set_rules('nilai_keterampilan', 'Nilai Keterampilan', 'required');
        $this->form_validation->set_rules('spiritual', 'Spiritual', 'required');
        $this->form_validation->set_rules('sosial', 'Sosial', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $data = [
                'kelas_id'           => $this->input->post('kelas_id'),
                'tahun_id'           => $this->input->post('tahun_id'),
                'semester'           => $this->input->post('semester'),
                'mapel_id'           => $this->input->post('mapel_id'),
                'siswa_id'           => $this->input->post('siswa_id'),
                'nilai_pengetahuan'  => $this->input->post('nilai_pengetahuan'),
                'nilai_keterampilan' => $this->input->post('nilai_keterampilan'),
                'spiritual'          => $this->input->post('spiritual'),
                'sosial'             => $this->input->post('sosial'),
            ];
            $this->db->insert('nilai_siswa', $data);
            var_dump($data);die;
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }
}
