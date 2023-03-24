<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_guru_model extends CI_Model
{
    public function getMyKelas($nip)
    {
        $query = "SELECT
        k.*
        FROM
        kelas as k
        LEFT JOIN jadwal_pelajaran as jp ON jp.kelas_id = k.id
        LEFT JOIN guru as g ON g.NIP = jp.guru_id
      WHERE
        g.nip = '" . $nip . "' GROUP BY k.id ORDER BY k.nama_kelas ASC";
        return $this->db->query($query);
    }

    public function getGuru($nip = null)
    {
        if (IS_NULL($nip)) {
            return $this->db->get('guru')->result_array();
        }
        return $this->db->get_where('guru', ['NIP' => $nip])->result_array();
    }

    public function getKelasByID($idKelas)
    {
        return $this->db->get_where('kelas', ['id' => $idKelas]);
    }

    public function getJadwalKelas($idKelas, $nip)
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
        g.nama as nama_guru,
        th.tahun as tahun_ajaran
      FROM
        jadwal_pelajaran jp
        LEFT JOIN hari h ON h.id = jp.hari_id
        LEFT JOIN guru g ON g.NIP = jp.guru_id
        LEFT JOIN mata_pelajaran mp ON mp.id = jp.mapel_id
        LEFT JOIN kelas k ON k.id = jp.kelas_id
        LEFT JOIN tahun_ajaran th ON th.id = jp.tahun_id
      WHERE
        k.id ='" . $idKelas . "' AND jp.guru_id = '" . $nip . "'";
        return $this->db->query($query);
    }

    public function countJadwalKelasGuru($idKelas, $nip)
    {
        $query = "SELECT
        jp.id
      FROM
        jadwal_pelajaran as jp
        LEFT JOIN kelas as k ON k.id = jp.kelas_id
      WHERE
        k.id = '" . $idKelas . "'
        AND jp.guru_id = '" . $nip . "'";
        return $this->db->query($query);
    }
}