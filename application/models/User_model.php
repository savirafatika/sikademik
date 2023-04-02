<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getUser($email)
    {
        $this->db->select('u.id,u.name,u.email,u.role_id,u.is_active,u.date_created,ur.role');
        // $this->db->where('u.email !=', $email);
        // $this->db->where_in('u.role_id', [2,3]);
        $this->db->from('user as u');
        $this->db->join('user_role as ur', 'ur.id = u.role_id');
        return $this->db->get();
    }
}
