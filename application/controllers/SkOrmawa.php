<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SkOrmawa extends CI_Controller
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
        $data['title'] = "SK Ormawa";
        $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->template->load('templates/dashboard', 'sk_ormawa/data', $data);
		}
	else {
		$data['title'] = "SK Ormawa";
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		$data['sk_ormawa'] = $this->admin->get('sk_ormawa',null, ['id_ormawa' => $id_ormawa]);
		$this->template->load('templates/dashboard', 'sk_ormawa/detail', $data);
		}
    }
	
	public function detail()
{
	$id_ormawa = $this->input->get('id_ormawa');
	$data['title'] = "Detail SK Ormawa";
    $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
    $data['sk_ormawa'] = $this->admin->get('sk_ormawa',null, ['id_ormawa' => $id_ormawa]);
	
	// $data['barang'] = $this->admin->getBarang();
	// $data['barangmasuk'] = $this->admin->getInfoBarangMasuk();
	// $data['barangkeluar'] = $this->admin->getInfoBarangKeluar();
    $this->template->load('templates/dashboard', 'sk_ormawa/detail', $data);
	
	
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
		
        $this->form_validation->set_rules('nama_sk', 'Nama SK', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim');
    }

	private function _validasi2()
	{
			
        $this->form_validation->set_rules('nama_sk', 'Nama SK', 'required|trim');
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
            $this->template->load('templates/dashboard', 'sk_ormawa/add', $data);
        } else {
        $id_ormawa = $this->input->post('id_ormawa');
		$nama_sk = $this->input->post('nama_sk');
		$file = uploadFile();
		
		$input = array(
        'id_ormawa' => $id_ormawa,
        'nama_sk' => $nama_sk,
        'berkas' => $file
		);
            $save = $this->admin->insert('sk_ormawa', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('SkOrmawa');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('SkOrmawa/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Status SK";
            $data['sk_ormawa'] = $this->admin->get('sk_ormawa', ['id_sk' => $id]);
            // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'sk_ormawa/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('sk_ormawa', 'id_sk', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('SkOrmawa');
            } else {
                set_pesan('data gagal diedit.');
				echo $input = $this->input->post(null, true);
                redirect('SkOrmawa/edit/' . $id);
            }
        }
    }
	
	public function pengesahan($getId)
    {
		$this->load->library('f_pdf');
        $id = encode_php_tags($getId);
        $data['title'] = "LEMBAR PENGESAHAN SK";
        $data['sk_ormawa'] = $this->admin->get('sk_ormawa', ['id_sk' => $id]);
		if($data['sk_ormawa']['status']=="Diterima"){
		$id_ormawa = $data['sk_ormawa']['id_ormawa'];
		// $id_proker = $data['proposal']['id_proker'];
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		// $data['proker'] = $this->admin->get('proker',null, ['id_proker' => $id_proker])[0];
        // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->load->view('sk_ormawa/lembar_pengesahan', $data);
        }
		else{
			set_pesan('Akses terlarang!',false);
			redirect('SkOrmawa');
		}
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('sk_ormawa', 'id_sk', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('SkOrmawa');
    }
}
