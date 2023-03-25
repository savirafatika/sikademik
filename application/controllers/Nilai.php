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
        $data['kelas'] = $this->nilai->getAllKelas()->result_array();
        $data['tahun'] = $this->nilai->getTahun()->result_array();
        $data['mapel'] = $this->nilai->getAllMapel($kelas)->result_array();
        $data['siswa'] = $this->nilai->getSiswa($kelas)->result_array();
        $data['nilai'] = $this->nilai->getNilaiSiswa($param)->result_array();
        $this->load->view('pages/nilai/data-nilai', $data);

    }

    public function input()
    {
        $data['title'] = 'Input Nilai Siswa';
        $email         = $this->session->userdata('email');
        $data['user']  = $this->db->get_where('user', ['email' => $email])->row_array();

        $this->form_validation->set_rules('kelas_id', 'Kelas', 'required');
        $this->form_validation->set_rules('tahun_id', 'Tahun', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('mapel_id', 'Mata Pelajaran', 'required');
        $this->form_validation->set_rules('siswa_id', 'Siswa', 'required');
        $this->form_validation->set_rules('nilai_pengetahuan', 'Nilai Pengetahuan', 'required');
        $this->form_validation->set_rules('nilai_keterampilan', 'Nilai Keterampilan', 'required');

        if ($this->form_validation->run() == false) {
            $data['kelas'] = $this->nilai->getAllKelas()->result_array();
            $data['tahun'] = $this->nilai->getTahun()->result_array();
            $data['mapel'] = $this->nilai->getAllMapel()->result_array();
            $this->load->view('pages/nilai/input', $data);
        } else {
            $param = [
                "kelas"    => $this->input->post('kelas_id'),
                "tahun"    => $this->input->post('tahun_id'),
                'semester' => $this->input->post('semester'),
                'siswa'    => $this->input->post('siswa_id'),
                'mapel'    => $this->input->post('mapel_id'),
            ];

            // validasi nilai terhadap mapel sudah ditambahkan (already exists)
            $check = $this->nilai->checkNilai($param);
            if ($check >= 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Nilai Mata Pelajaran sudah ada!</div>');
                redirect('nilai/input');
            }

            $data = [
                'kelas_id'           => $param['kelas'],
                'tahun_id'           => $param['tahun'],
                'semester'           => $param['semester'],
                'siswa_id'           => $param['siswa'],
                'mapel_id'           => $param['mapel'],
                'nilai_pengetahuan'  => $this->input->post('nilai_pengetahuan'),
                'nilai_keterampilan' => $this->input->post('nilai_keterampilan'),
                'spiritual'          => $this->input->post('spiritual') ?? null,
                'sosial'             => $this->input->post('sosial') ?? null,
            ];
            $this->db->insert('nilai_siswa', $data);

            // trigger update nilai untuk ranking siswa
            $nilai_siswa               = $this->nilai->getNilai($param)->result_array();
            $jumlah_nilai_pengetahuan  = 0;
            $jumlah_nilai_keterampilan = 0;
            foreach ($nilai_siswa as $item) {
                $jumlah_nilai_pengetahuan += $item['nilai_pengetahuan'];
                $jumlah_nilai_keterampilan += $item['nilai_keterampilan'];
            }
            $jumlah_nilai = $jumlah_nilai_pengetahuan + $jumlah_nilai_keterampilan;

            $data_trigger = [
                "kelas"        => $param['kelas'],
                'nis'          => $param['siswa'],
                'jumlah_nilai' => $jumlah_nilai,
            ];

            $this->nilai->trigger_ranking($data_trigger);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">Nilai berhasil diinput!</div>');
            redirect('nilai/input');
        }
    }

    public function update()
    {

        $this->form_validation->set_rules('spiritual', 'Nilai Sikap Spiritual', 'required');
        $this->form_validation->set_rules('sosial', 'Nilai Sikap Sosial', 'required');
        $this->form_validation->set_rules('nilai_pengetahuan', 'Nilai Pengetahuan', 'required');
        $this->form_validation->set_rules('nilai_keterampilan', 'Nilai Keterampilan', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $nilai_id = $this->input->post('id_nilai');

            $this->db->set('sosial', $this->input->post('sosial'));
            $this->db->set('spiritual', $this->input->post('spiritual'));
            $this->db->set('nilai_keterampilan', $this->input->post('nilai_keterampilan'));
            $this->db->set('nilai_pengetahuan', $this->input->post('nilai_pengetahuan'));
            $this->db->where('id', $nilai_id);
            $this->db->update('nilai_siswa');

            $nilai = $this->nilai->getNilaiById($nilai_id)->row_array();
            $param = [
                "kelas"    => $nilai['kelas_id'],
                "tahun"    => $nilai['tahun_id'],
                'semester' => $nilai['semester'],
                'siswa'    => $nilai['siswa_id'],
            ];

            // trigger update nilai untuk ranking siswa
            $jumlah_nilai_pengetahuan  = 0;
            $jumlah_nilai_keterampilan = 0;

            $nilai_siswa = $this->nilai->getNilai($param)->result_array();

            foreach ($nilai_siswa as $item) {
                $jumlah_nilai_pengetahuan += $item['nilai_pengetahuan'];
                $jumlah_nilai_keterampilan += $item['nilai_keterampilan'];
            }
            $jumlah_nilai = $jumlah_nilai_pengetahuan + $jumlah_nilai_keterampilan;

            $data_trigger = [
                "kelas"        => $param['kelas'],
                'nis'          => $param['siswa'],
                'jumlah_nilai' => $jumlah_nilai,
            ];

            $this->nilai->trigger_ranking($data_trigger);

            echo json_encode(['success' => 'Data nilai berhasil diubah']);
        }
    }

    public function delete()
    {
        $nilai_id = $this->input->post('id');
        $nilai    = $this->nilai->getNilaiById($nilai_id)->row_array();
        $param    = [
            "kelas"    => $nilai['kelas_id'],
            "tahun"    => $nilai['tahun_id'],
            'semester' => $nilai['semester'],
            'siswa'    => $nilai['siswa_id'],
        ];

        $this->db->where('id', $nilai_id);
        $this->db->delete('nilai_siswa');

        // trigger update nilai untuk ranking siswa
        $jumlah_nilai_pengetahuan  = 0;
        $jumlah_nilai_keterampilan = 0;

        $nilai_siswa = $this->nilai->getNilai($param)->result_array();

        foreach ($nilai_siswa as $item) {
            $jumlah_nilai_pengetahuan += $item['nilai_pengetahuan'];
            $jumlah_nilai_keterampilan += $item['nilai_keterampilan'];
        }
        $jumlah_nilai = $jumlah_nilai_pengetahuan + $jumlah_nilai_keterampilan;

        $data_trigger = [
            "kelas"        => $param['kelas'],
            'nis'          => $param['siswa'],
            'jumlah_nilai' => $jumlah_nilai,
        ];

        $this->nilai->trigger_ranking($data_trigger);

        echo json_encode(['success' => 'Data nilai berhasil dihapus']);
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
}
