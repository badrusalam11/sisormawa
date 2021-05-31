<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LpjOrmawa extends CI_Controller
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
        $data['title'] = "LPJ Ormawa";
        $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->template->load('templates/dashboard', 'lpj_ormawa/data', $data);
		}
		else {
		$data['title'] = "LPJ Ormawa";
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		$data['lpj'] = $this->admin->get('lpj',null, ['id_ormawa' => $id_ormawa]);
		$this->template->load('templates/dashboard', 'lpj_ormawa/detail', $data);
		
		}
    }
	
	public function detail()
{
	$id_ormawa = $this->input->get('id_ormawa');
	$data['title'] = "Detail LPJ Ormawa";
    $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
    $data['lpj'] = $this->admin->get('lpj',null, ['id_ormawa' => $id_ormawa]);
	
	// $data['barang'] = $this->admin->getBarang();
	// $data['barangmasuk'] = $this->admin->getInfoBarangMasuk();
	// $data['barangkeluar'] = $this->admin->getInfoBarangKeluar();
    $this->template->load('templates/dashboard', 'lpj_ormawa/detail', $data);
	
	
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
		
        // $this->form_validation->set_rules('nama_lpj', 'Nama Proposal', 'required|trim');
        $this->form_validation->set_rules('nama_lpj', 'Nama LPJ', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim');
    }
	
	private function _validasi2()
	{
			
        $this->form_validation->set_rules('nama_lpj', 'Nama LPJ', 'required|trim');
        $this->form_validation->set_rules('id_ormawa', 'Nama Ormawa', 'required|trim');
		$this->form_validation->set_rules('berkas', 'berkas');
		$this->form_validation->set_rules('id_proker', 'Nama Proker', 'required|trim');
	}

    public function add()
    {
        $this->_validasi2();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah LPJ Ormawa";
			$data['ormawa'] = $this->admin->get('ormawa');
			$data['proker'] = $this->admin->get('proker');
			$data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'lpj_ormawa/add', $data);
        } else {
            $id_ormawa = $this->input->post('id_ormawa');
		$nama_lpj = $this->input->post('nama_lpj');
		$id_proker = $this->input->post('id_proker');
		$file = uploadFile();
		
		$input = array(
        'id_ormawa' => $id_ormawa,
        'nama_lpj' => $nama_lpj,
        'id_proker' => $id_proker,
        'berkas' => $file
		);
            $save = $this->admin->insert('lpj', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('LpjOrmawa');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('LpjOrmawa/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Status LPJ";
            $data['lpj'] = $this->admin->get('lpj', ['id_lpj' => $id]);
            // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'lpj_ormawa/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('lpj', 'id_lpj', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('LpjOrmawa');
            } else {
                set_pesan('data gagal diedit.',false);
				echo $input = $this->input->post(null, true);
                redirect('LpjOrmawa/edit/' . $id);
            }
        }
    }
	
	public function pengesahan($getId)
    {
		$this->load->library('f_pdf');
        $id = encode_php_tags($getId);
        $data['title'] = "LEMBAR PENGESAHAN LPJ";
        $data['lpj'] = $this->admin->get('lpj', ['id_lpj' => $id]);
		if($data['lpj']['status']=="Diterima"){
		$id_ormawa = $data['lpj']['id_ormawa'];
		$id_proker = $data['lpj']['id_proker'];
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		$data['proker'] = $this->admin->get('proker',null, ['id_proker' => $id_proker])[0];
        // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->load->view('lpj_ormawa/lembar_pengesahan', $data);
        }
		else{
			set_pesan('Akses terlarang!',false);
			redirect('LpjOrmawa');
		}
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('lpj', 'id_lpj', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('LpjOrmawa');
    }
}
