<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_model extends CI_Model
{
    public function getSiswa()
    {
        return $this->db->get('siswa');
    }
}