<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaanpembelian extends CI_Controller
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
        $data['title'] = "Permintaan Pembelian";
        $data['permintaanpembelian'] = $this->admin->getInfoPermintaan('PermintaanPembelian');
        $this->template->load('templates/dashboard', 'permintaan_pembelian/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_minta', 'Tanggal Minta', 'required|trim');
        $this->form_validation->set_rules('divisi_id', 'Divisi', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_minta', 'Jumlah Minta', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Permintaan Pembelian";
            $data['divisi'] = $this->admin->get('divisi');
            $data['barang'] = $this->admin->get('barang');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'PP-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('permintaanpembelian', 'id_pp', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_pp'] = $kode . $number;

            $this->template->load('templates/dashboard', 'permintaan_pembelian/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('permintaanpembelian', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('permintaanpembelian');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('permintaanpembelian/add');
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('permintaanpembelian', 'id_pp', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('permintaanpembelian');
    }
}
