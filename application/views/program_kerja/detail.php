<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                   <?php echo $ormawa['nama_ormawa'];?>
                </h4>
            </div>
			<div class="col-auto">
                <a href="<?= base_url('ProfileOrmawa/edit') ?>/<?=$ormawa['id_ormawa']?>" class="btn btn-sm btn-warning btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span class="text">
                        Edit Data Ormawa
                    </span>
                </a>
            </div>
			<div class="col-auto">
                <a href="<?= base_url('ProfileOrmawa/delete') ?>/<?=$ormawa['id_ormawa']?>" class="btn btn-sm btn-danger btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-trash"></i>
                    </span>
                    <span class="text">
                        Delete Data Ormawa
                    </span>
                </a>
            </div>
        </div>
    </div>
	<div class="col">
	<h5>Sejarah Organisasi</h5>
	<p><?php echo $ormawa['sejarah'];?></p>
	<h5>AD/ART</h5>
	<p><?php echo $ormawa['ad_art'];?></p>
	<h5>GBHO</h5>
	<p><?php echo $ormawa['gbho'];?></p>
	<h5>GBHK</h5>
	<p><?php echo $ormawa['gbhk'];?></p>
	<h5>Struktur Kepengurusan</h5>
	<p><?php echo $ormawa['struktur'];?></p>
	</div>
   
</div>