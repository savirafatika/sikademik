<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function getSiswa($idKelas)
    {
        $query = "SELECT
          s.*
          FROM
          siswa as s
            LEFT JOIN kelas_murid as km ON km.nis = s.NIS
          WHERE
          km.kelas_id = '" . $idKelas . "'";
        return $this->db->query($query);
    }

    public function countSiswaKelas($idKelas)
    {
        $query = "SELECT
        km.nis
      FROM
      kelas_murid as km
        LEFT JOIN kelas as k ON k.id = km.kelas_id
      WHERE
        k.id = '" . $idKelas . "'";
        return $this->db->query($query);
    }
}
