<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BeritaAcara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
		
		$this->load->helper('uploadFile');
    }

    public function index()
    {
		$id_ormawa = $this->session->userdata('login_session')['id_ormawa'];
	if($id_ormawa==0){
        $data['title'] = "Berita Acara Ormawa";
        $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->template->load('templates/dashboard', 'berita_acara/data', $data);
		}
	else {
	$data['title'] = "Berita Acara Ormawa";
    $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
    $data['berita_acara'] = $this->admin->get('berita_acara',null, ['id_ormawa' => $id_ormawa]);
	$this->template->load('templates/dashboard', 'berita_acara/detail', $data);
		}
    }
	
	public function detail()
{
	$id_ormawa = $this->input->get('id_ormawa');
	$data['title'] = "Berita Acara Ormawa";
    $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
    $data['berita_acara'] = $this->admin->get('berita_acara',null, ['id_ormawa' => $id_ormawa]);
	
	// $data['barang'] = $this->admin->getBarang();
	// $data['barangmasuk'] = $this->admin->getInfoBarangMasuk();
	// $data['barangkeluar'] = $this->admin->getInfoBarangKeluar();
    $this->template->load('templates/dashboard', 'berita_acara/detail', $data);
	
	
}

    private function _validasi()
    {
        // $this->form_validation->set_rules('nama_ormawa', 'Nama Ormawa', 'required|trim');
        // $this->form_validation->set_rules('sejarah', 'Sejarah Ormawa', 'required|trim');
        // $this->form_validation->set_rules('ad_art', 'AD/ART Ormawa', 'required|trim');
        // $this->form_validation->set_rules('gbho', 'GBHO Ormawa', 'required|trim');
        // $this->form_validation->set_rules('gbhk', 'GBHK Ormawa', 'required|trim');
        // $this->form_validation->set_rules('struktur', 'Struktur Organisasi', 'required|trim');
        // $this->form_validation->set_rules('id_rumpun', 'Struktur Organisasi', 'required|trim');
		
        $this->form_validation->set_rules('nama_BA', 'Nama Berita Acara', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim');
    }
	
	 private function _validasi2()
    {
         $this->form_validation->set_rules('nama_BA', 'Nama Berita Acara', 'required|trim');
        $this->form_validation->set_rules('id_ormawa', 'Nama Ormawa', 'required|trim');
		$this->form_validation->set_rules('berkas', 'berkas');
	}

    public function add()
    {
        $this->_validasi2();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Proposal Ormawa";
			$data['ormawa'] = $this->admin->get('ormawa');
			$data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'berita_acara/add', $data);
        } else {
        $id_ormawa = $this->input->post('id_ormawa');
		$nama_BA = $this->input->post('nama_BA');
		$file = uploadFile();
		
		$input = array(
        'id_ormawa' => $id_ormawa,
        'nama_BA' => $nama_BA,
        'berkas' => $file
		);
            $save = $this->admin->insert('berita_acara', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('BeritaAcara');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('BeritaAcara/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Status Berita Acara";
            $data['berita_acara'] = $this->admin->get('berita_acara', ['id_BA' => $id]);
            // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'berita_acara/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('berita_acara', 'id_BA', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('BeritaAcara');
            } else {
                set_pesan('data gagal diedit.');
				echo $input = $this->input->post(null, true);
                redirect('BeritaAcara/edit/' . $id);
            }
        }
    }
	
	public function pengesahan($getId)
    {
		$this->load->library('f_pdf');
        $id = encode_php_tags($getId);
        $data['title'] = "LEMBAR PENGESAHAN BERITA ACARA";
        $data['berita_acara'] = $this->admin->get('berita_acara', ['id_BA' => $id]);
		if($data['berita_acara']['status']=="Diterima"){
		$id_ormawa = $data['berita_acara']['id_ormawa'];
		// $id_proker = $data['proposal']['id_proker'];
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		// $data['proker'] = $this->admin->get('proker',null, ['id_proker' => $id_proker])[0];
        // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->load->view('berita_acara/lembar_pengesahan', $data);
        }
		else{
			set_pesan('Akses terlarang!',false);
			redirect('BeritaAcara');
		}
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('berita_acara', 'id_BA', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('BeritaAcara');
    }
}
