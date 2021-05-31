<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProposalOrmawa extends CI_Controller
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
    {	$id_ormawa = $this->session->userdata('login_session')['id_ormawa'];
		if($id_ormawa==0){
        $data['title'] = "Proposal Ormawa";
        $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->template->load('templates/dashboard', 'proposal_ormawa/data', $data);
		}
		else {
		$data['title'] = "Proposal Ormawa";
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		$data['proposal'] = $this->admin->get('proposal',null, ['id_ormawa' => $id_ormawa]);
        $this->template->load('templates/dashboard', 'proposal_ormawa/detail', $data);	
		}
	}
	
	public function detail()
{
	$id_ormawa = $this->input->get('id_ormawa');
	$data['title'] = "Detail Proposal Ormawa";
    $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
    $data['proposal'] = $this->admin->get('proposal',null, ['id_ormawa' => $id_ormawa]);
	
	// $data['barang'] = $this->admin->getBarang();
	// $data['barangmasuk'] = $this->admin->getInfoBarangMasuk();
	// $data['barangkeluar'] = $this->admin->getInfoBarangKeluar();
    $this->template->load('templates/dashboard', 'proposal_ormawa/detail', $data);
	
	
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
				
        $this->form_validation->set_rules('nama_proposal', 'Nama Proposal', 'required|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required|trim');
	
    }
	
	private function _validasi2()
	{
			
        $this->form_validation->set_rules('nama_proposal', 'Nama Proposal', 'required|trim');
        $this->form_validation->set_rules('id_ormawa', 'Nama Ormawa', 'required|trim');
		$this->form_validation->set_rules('berkas', 'berkas');
		$this->form_validation->set_rules('id_proker', 'Nama Proker', 'required|trim');
	}
    public function add()
    {
		
        $this->_validasi2();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Proposal Ormawa";
			$data['ormawa'] = $this->admin->get('ormawa');
			$data['proker'] = $this->admin->get('proker');
			$data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'proposal_ormawa/add', $data);
        } 
		else {
		$id_ormawa = $this->input->post('id_ormawa');
		$nama_proposal = $this->input->post('nama_proposal');
		$id_proker = $this->input->post('id_proker');
		$file = uploadFile();
		
		$input = array(
        'id_ormawa' => $id_ormawa,
        'nama_proposal' => $nama_proposal,
        'id_proker' => $id_proker,
        'berkas' => $file
		);
		// var_dump($data);
            // $input = $this->input->post(null, true);
			// $input['berkas']= uploadFile();
			// var_dump($input);
            $save = $this->admin->insert('proposal', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('ProposalOrmawa');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ProposalOrmawa/add');
            }
		}
    }
	public function tambah()
	
	{	$id_ormawa = $this->input->post('id_ormawa');
		$nama_proposal = $this->input->post('nama_proposal');
		$id_proker = $this->input->post('id_proker');
		$file = uploadFile();
		
		$data = array(
        'id_ormawa' => $id_ormawa,
        'nama_proposal' => $nama_proposal,
        'id_proker' => $id_proker,
        'berkas' => $file
		);
		var_dump($data);
	}

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Status Proposal";
            $data['proposal'] = $this->admin->get('proposal', ['id_proposal' => $id]);
            // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'proposal_ormawa/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('proposal', 'id_proposal', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('ProposalOrmawa');
            } else {
                set_pesan('data gagal diedit.');
				echo $input = $this->input->post(null, true);
                redirect('ProposalOrmawa/edit/' . $id);
            }
        }
    }
	
	public function pengesahan($getId)
    {
		$this->load->library('f_pdf');
        $id = encode_php_tags($getId);
        $data['title'] = "LEMBAR PENGESAHAN PROPOSAL";
        $data['proposal'] = $this->admin->get('proposal', ['id_proposal' => $id]);
		if($data['proposal']['status']=="Diterima"){
		$id_ormawa = $data['proposal']['id_ormawa'];
		$id_proker = $data['proposal']['id_proker'];
		$data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
		$data['proker'] = $this->admin->get('proker',null, ['id_proker' => $id_proker])[0];
        // $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->load->view('proposal_ormawa/lembar_pengesahan', $data);
        }
		else{
			set_pesan('Akses terlarang!',false);
			redirect('ProposalOrmawa');
		}
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('proposal', 'id_proposal', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('ProposalOrmawa');
    }
}
