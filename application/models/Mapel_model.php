<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_model extends CI_Model
{
    public function getMapel($idKelas)
    {
        $query = "SELECT
        mp.id,
        mp.nama_mapel,
        mp.grup,
        k.id as kelas_id,
        k.nama_kelas
      FROM
        mata_pelajaran mp
        LEFT JOIN kelas k ON k.id = mp.kelas_id
        WHERE k.id = '" . $idKelas . "'";
        return $this->db->query($query);
    }

    public function countMapelKelas($idKelas)
    {
        $query = "SELECT
        mp.id
      FROM
      mata_pelajaran as mp
        LEFT JOIN kelas as k ON k.id = mp.kelas_id
      WHERE
        k.id = '" . $idKelas . "'";
        return $this->db->query($query);
    }
}