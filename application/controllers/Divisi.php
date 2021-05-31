<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Divisi";
        $data['divisi'] = $this->admin->get('divisi');
        $this->template->load('templates/dashboard', 'divisi/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_divisi', 'Nama Divisi', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Divisi";
            $this->template->load('templates/dashboard', 'divisi/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('divisi', $input);
            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('divisi');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('divisi/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Divisi";
            $data['divisi'] = $this->admin->get('divisi', ['id_divisi' => $id]);
            $this->template->load('templates/dashboard', 'divisi/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('divisi', 'id_divisi', $id, $input);
            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('divisi');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('divisi/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('divisi', 'id_divisi', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('divisi');
    }

    
}
