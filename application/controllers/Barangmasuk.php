<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangmasuk extends CI_Controller
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
        $data['title'] = "Barang Masuk";
        $data['barangmasuk'] = $this->admin->getBarangMasuk();
        $this->template->load('templates/dashboard', 'barang_masuk/data', $data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required|trim');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('barang_id', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah_masuk', 'Jumlah Masuk', 'required|trim|numeric|greater_than[0]');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Barang Masuk";
            $data['supplier'] = $this->admin->get('supplier');
            $data['barang'] = $this->admin->get('barang');

            // Mendapatkan dan men-generate kode transaksi barang masuk
            $kode = 'T-BM-' . date('ymd');
            $kode_terakhir = $this->admin->getMax('barang_masuk', 'id_barang_masuk', $kode);
            $kode_tambah = substr($kode_terakhir, -5, 5);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 5, '0', STR_PAD_LEFT);
            $data['id_barang_masuk'] = $kode . $number;

            $this->template->load('templates/dashboard', 'barang_masuk/add', $data);
        } else {
            $input = $this->input->post(null, true);
			// var_dump($input);
			$gambar = $this->uploadGambar();
			// array_push($input, ["gambar"], $gambar);
			$input["gambar"] = $gambar;
			var_dump($input);
			
            $insert = $this->admin->insert('barang_masuk', $input);

            if ($insert) {
                set_pesan('data berhasil disimpan.');
                redirect('barangmasuk');
            } else {
                set_pesan('Opps ada kesalahan!');
                redirect('barangmasuk/add');
            }
        }
    }
	
	public function uploadGambar() {
	$namafile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];
	
	//cek apakah tidak ada gambar yang diupload
	if ($error === 4){
		echo "<script> alert('Masukkan Gambar!')</script>";
		return false;
	}
	
	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg','jpeg','png'];
	$ekstensiGambar = explode('.',$namafile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
		echo"<script>alert('Yang Anda upload bukan gambar !!!')</script>";
	}
	
	// cek jika ukurannya terlalu besar
	if($ukuranFile > 1000000){
		echo"<script>alert('Ukuran Gambar Terlalu Besar')</script>";
	}
	
	// lolos pengecekan, gambar siap diupload
	// generate nama gambar
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensiGambar;
	// move_uploaded_file($tmpName,'img/'. $namafilebaru);
	move_uploaded_file($tmpName,'././gambar/'. $namafilebaru);
	return $namafilebaru;
	}

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
		$query = $this->db->query("SELECT gambar FROM barang_masuk WHERE id_barang_masuk = '$id'");
		$gambar = $query->result_array();
		$target = '././gambar/' . $gambar[0]["gambar"];
		unlink($target);
		
        if ($this->admin->delete('barang_masuk', 'id_barang_masuk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('barangmasuk');
    }
}
