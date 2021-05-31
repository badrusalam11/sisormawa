<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileOrmawa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {	$id_ormawa = $this->session->userdata('login_session')['id_ormawa'];
		if($id_ormawa==0){
        $data['title'] = "Profile Ormawa";
        $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
        $this->template->load('templates/dashboard', 'profile_ormawa/data', $data);
		}
		else {
		$data['title'] = "Profile Ormawa";
        $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
        $this->template->load('templates/dashboard', 'profile_ormawa/detail', $data);
		}
    }
	
	public function detail()
{
	$id_ormawa = $this->input->get('id_ormawa');
	$data['title'] = "Detail Ormawa";
    $data['ormawa'] = $this->admin->get('ormawa',null, ['id_ormawa' => $id_ormawa])[0];
	// $data['barang'] = $this->admin->getBarang();
	// $data['barangmasuk'] = $this->admin->getInfoBarangMasuk();
	// $data['barangkeluar'] = $this->admin->getInfoBarangKeluar();
    $this->template->load('templates/dashboard', 'profile_ormawa/detail', $data);
	
	
}

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_ormawa', 'Nama Ormawa', 'required|trim');
        // $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric');
        $this->form_validation->set_rules('sejarah', 'Sejarah Ormawa', 'required|trim');
        $this->form_validation->set_rules('ad_art', 'AD/ART Ormawa', 'required|trim');
        $this->form_validation->set_rules('gbho', 'GBHO Ormawa', 'required|trim');
        $this->form_validation->set_rules('gbhk', 'GBHK Ormawa', 'required|trim');
        $this->form_validation->set_rules('struktur', 'Struktur Organisasi', 'required|trim');
        $this->form_validation->set_rules('id_rumpun', 'Struktur Organisasi', 'required|trim');
    }

    public function add()
    {
        $this->_validasi();
        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Profile Ormawa";
			$data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'profile_ormawa/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $save = $this->admin->insert('ormawa', $input);
            if ($save) {
                set_pesan('data berhasil disimpan.');
                redirect('ProfileOrmawa');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('ProfileOrmawa/add');
            }
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Data Ormawa";
            $data['ormawa'] = $this->admin->get('ormawa', ['id_ormawa' => $id]);
            $data['rumpun_ormawa'] = $this->admin->get('rumpun_ormawa');
            $this->template->load('templates/dashboard', 'profile_ormawa/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('ormawa', 'id_ormawa', $id, $input);

            if ($update) {
                set_pesan('data berhasil diedit.');
                redirect('ProfileOrmawa');
            } else {
                set_pesan('data gagal diedit.');
				echo $input = $this->input->post(null, true);
                // redirect('ProfileOrmawa/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('ormawa', 'id_ormawa', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('ProfileOrmawa');
    }
}
