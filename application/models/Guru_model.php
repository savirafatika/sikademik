<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_model extends CI_Model
{
    public function getGuru()
    {
        return $this->db->get('guru');
    }
}