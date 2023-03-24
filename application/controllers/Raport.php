<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Raport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Raport_model', 'raport');
        $this->load->model('Nilai_model', 'nilai');
    }

    public function index()
    {
        $data['title'] = 'Raport Siswa';
        $email         = $this->session->userdata('email');

        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['kelas'] = $this->nilai->getAllKelas()->result_array();
        $data['tahun'] = $this->nilai->getTahun()->result_array();
        $this->load->view('pages/raport/index', $data);
    }

    public function daftar_siswa()
    {
        $data['title'] = 'Raport Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $param = [
            "kelas"    => $this->input->get('kelas'),
            "tahun"    => $this->input->get('tahun'),
            "semester" => $this->input->get('semester'),
        ];
        $data['daftar_siswa'] = $this->nilai->getDaftarSiswa($param)->result_array();
        $this->load->view('pages/raport/list-siswa', $data);

    }

    public function lihat_raport($idSiswa)
    {
        $data['title'] = 'Raport Siswa';
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

        $data['param']        = $param;
        $data['back']         = base_url('raport/daftar_siswa') . "?kelas=${kelas}&tahun=${tahun}&semester=${semester}";
        $data['jumlah_siswa'] = $this->raport->getRankingSiswa($kelas)->num_rows();
        $data['grup_a']       = $this->raport->getRaportSiswa($param, 'A')->result_array();
        $data['grup_b']       = $this->raport->getRaportSiswa($param, 'B')->result_array();
        $this->load->view('pages/raport/data-raport', $data);

    }
}
