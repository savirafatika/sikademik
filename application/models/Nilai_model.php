<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Nilai_model extends CI_Model
{
    public function getAllKelas()
    {
        $this->db->order_by('nama_kelas', 'ASC');
        return $this->db->get('kelas');
    }

    public function getTahun()
    {
        return $this->db->get('tahun_ajaran');
    }

    public function getAllMapel($idKelas = null)
    {
        if ($idKelas) {
            return $this->db->get_where('mata_pelajaran', ['kelas_id' => $idKelas]);
        }
        return $this->db->get('mata_pelajaran');
    }

    public function getSiswa($idKelas = null)
    {
        $query = "SELECT
          s.NIS,
          s.nama
          FROM
          siswa s
          LEFT JOIN kelas_murid km ON km.nis = s.NIS
          WHERE km.kelas_id ='" . $idKelas . "'
          ORDER BY s.nama ASC
        ";
        return $this->db->query($query);
    }

    public function getDaftarSiswa($param)
    {
        $query = "SELECT
        ns.id,
        s.NIS,
        s.nama
      FROM
        nilai_siswa ns
        LEFT JOIN siswa s ON s.NIS = ns.siswa_id
      WHERE
        ns.kelas_id ='" . $param['kelas'] . "' AND ns.tahun_id ='" . $param['tahun'] . "' AND ns.semester ='" . $param['semester'] . "' GROUP BY ns.siswa_id ORDER BY s.nama ASC";
        return $this->db->query($query);
    }

    public function getNilaiSiswa($param)
    {
        $query = "SELECT
        ns.*,
        s.nama,
        mp.nama_mapel,
        mp.grup
      FROM
        nilai_siswa ns
        LEFT JOIN siswa s ON s.NIS = ns.siswa_id
        LEFT JOIN mata_pelajaran mp ON mp.id = ns.mapel_id
      WHERE
        ns.siswa_id ='" . $param['siswa'] . "' AND
        ns.kelas_id ='" . $param['kelas'] . "' AND ns.tahun_id ='" . $param['tahun'] . "' AND ns.semester ='" . $param['semester'] . "' ORDER BY s.nama ASC, mp.grup ASC";
        return $this->db->query($query);
    }

    public function checkNilai($param)
    {
        $check = $this->db->get_where('nilai_siswa', [
            'mapel_id' => $param['mapel'],
            'siswa_id' => $param['siswa'],
            'kelas_id' => $param['kelas'],
            'tahun_id' => $param['tahun'],
            'semester' => $param['semester'],
        ])->num_rows();
        return $check;
    }

    public function getNilai($param)
    {
        $query = "SELECT
        nilai_pengetahuan,
        nilai_keterampilan
      FROM
        nilai_siswa
      WHERE
        siswa_id ='" . $param['siswa'] . "' AND
        kelas_id ='" . $param['kelas'] . "' AND tahun_id ='" . $param['tahun'] . "' AND semester ='" . $param['semester'] . "'";
        return $this->db->query($query);
    }

    public function getNilaiById($nilai_id)
    {
        $query = "SELECT * FROM nilai_siswa WHERE id ='" . $nilai_id . "'";
        return $this->db->query($query);
    }

    public function trigger_ranking($data)
    {
        $check = $this->db->get_where('ranking_siswa', [
            'kelas_id' => $data['kelas'],
            'nis'      => $data['nis'],
        ])->num_rows();

        if ($check < 1) {
            $query = $this->db->insert('ranking_siswa', $data);
        } else {
            $this->db->set('jumlah_nilai', $data['jumlah_nilai']);
            $this->db->where('kelas_id', $data['kelas']);
            $this->db->where('nis', $data['nis']);
            $query = $this->db->update('ranking_siswa');
        }
        return $query;
    }
}
