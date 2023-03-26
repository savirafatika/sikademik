<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_model', 'menu');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Manajemen Menu';
        $data['user']  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('pages/menu/index', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required|is_unique[user_menu.menu]');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function update()
    {
        $id        = $this->input->post('id_menu');
        $form      = $this->input->post('menu');
        $is_unique = is_unique('user_menu', $id, 'menu', $form);
        $this->form_validation->set_rules('menu', 'Menu', 'required' . $is_unique);

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('menu', $this->input->post('menu'));
            $this->db->where('id', $this->input->post('id_menu'));
            $this->db->update('user_menu');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function delete()
    {
        $this->form_validation->set_rules('id_menu', 'Menu ID', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id_menu'));
            $this->db->delete('user_menu');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }

    public function get_sub_menu()
    {
        $this->load->model('Menu_model', 'menu');
        $data = $this->menu->getSubMenu()->result();
        echo json_encode($data);
    }

    public function submenu()
    {
        $data['title'] = 'Manajemen Sub Menu';
        $data['user']  = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu()->result_array();
        $data['menu']    = $this->db->get('user_menu')->result_array();
        $this->load->view('pages/menu/submenu', $data);
    }

    public function storeSubMenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');
        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $menu_id = $this->input->post('menu_id');
            $order   = $this->menu->getSubMenuOrder($menu_id);
            $data    = [
                'title'     => $this->input->post('title'),
                'menu_id'   => $menu_id,
                'url'       => $this->input->post('url'),
                'icon'      => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
                'order'     => $order['order'] + 1,
            ];
            $this->db->insert('user_sub_menu', $data);
            echo json_encode(['success' => 'Data berhasil ditambahkan']);
        }
    }

    public function updateSubMenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->set('is_active', $this->input->post('is_active'));
            $this->db->set('icon', $this->input->post('icon'));
            $this->db->set('url', $this->input->post('url'));
            $this->db->set('menu_id', $this->input->post('menu_id'));
            $this->db->set('title', $this->input->post('title'));
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('user_sub_menu');
            echo json_encode(['success' => 'Data berhasil diubah']);
        }
    }

    public function deleteSubMenu()
    {
        $this->form_validation->set_rules('id_sub_menu', 'Sub Menu ID', 'required');

        if ($this->form_validation->run() == false) {
            $errors = array_values($this->form_validation->error_array())[0];
            echo json_encode(['error' => $errors]);
        } else {
            $this->db->where('id', $this->input->post('id_sub_menu'));
            $this->db->delete('user_sub_menu');
            echo json_encode(['success' => 'Data berhasil dihapus']);
        }
    }
}
