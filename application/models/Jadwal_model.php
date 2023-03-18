<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_model extends CI_Model
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

    public function getKelasByID($idKelas)
    {
        return $this->db->get_where('kelas', ['id' => $idKelas]);
    }

    public function getJadwalKelas($idKelas)
    {
        $query = "SELECT
        jp.id,
        jp.tahun_id,
        jp.mapel_id,
        jp.guru_id,
        jp.hari_id,
        jp.jam,
        h.nama_hari,
        mp.nama_mapel,
        k.nama_kelas,
        g.nama as nama_guru
      FROM
        jadwal_pelajaran jp
        LEFT JOIN hari h ON h.id = jp.hari_id
        LEFT JOIN guru g ON g.NIP = jp.guru_id
        LEFT JOIN mata_pelajaran mp ON mp.id = jp.mapel_id
        LEFT JOIN kelas k ON k.id = jp.kelas_id
      WHERE
        k.id ='" . $idKelas . "' ORDER BY h.id ASC";
        return $this->db->query($query);
    }

    public function countJadwalKelas($idKelas)
    {
        $query = "SELECT
        jp.id
      FROM
        jadwal_pelajaran as jp
        LEFT JOIN kelas as k ON k.id = jp.kelas_id
      WHERE
        k.id = '" . $idKelas . "'";
        return $this->db->query($query);
    }
}