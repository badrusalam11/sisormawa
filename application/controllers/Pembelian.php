<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
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
        $data['title'] = "Pembelian";
        $data['pembelian'] = $this->admin->get('pembelian')();
        $this->template->load('templates/dashboard', 'pembelian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Pembelian";
            $data['barang'] = $this->admin->get('barang');

            // Mengenerate ID Barang
            $kode_terakhir = $this->admin->getMax('pembelian', 'id_pembelian');
            $kode_tambah = substr($kode_terakhir, -6, 6);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 6, '0', STR_PAD_LEFT);
            $data['id_pembelian'] = 'B' . $number;

            $this->template->load('templates/dashboard', 'pembelian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('pembelian', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan');
                redirect('pembelian');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('pembelian/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Pembelian";
            $data['satuan'] = $this->admin->get('satuan');
            $data['pembelian'] = $this->admin->get('pembelian', ['id_pembelian' => $id]);
            $this->template->load('templates/dashboard', 'pembelian/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('pembelian', 'id_pembelian', $id, $input);

            if ($update) {
                set_pesan('data berhasil disimpan');
                redirect('pembelian');
            } else {
                set_pesan('gagal menyimpan data');
                redirect('pembelian/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('pembelian', 'id_pembelian', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('pembelian');
    }
}
