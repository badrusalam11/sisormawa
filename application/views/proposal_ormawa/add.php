<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Supplier
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('ProposalOrmawa') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <!-- <form method="POST" enctype="multipart/form-data" action="<?=base_url()?>ProposalOrmawa/tambah"> -->
				<?php echo form_open_multipart();?>
               <div class="row form-group" hidden >
                    <label class="col-md-3 text-md-right" for="id_ormawa">Nama Ormawa</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            
                            <!-- <select name="id_ormawa" id="id_ormawa">
                            							<?php foreach($ormawa as $r):?>
                            							<option value="<?= $r['id_ormawa']?>"><?= $r['nama_ormawa']?></option>
                            							<?php endforeach;?>
                            							</select> -->
							<input name="id_ormawa" type="text" value="<?= $this->session->userdata('login_session')['id_ormawa']?>"/>
                        </div>
                        <?= form_error('id_ormawa', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_proposal">Nama Proposal</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            
                            <input name="nama_proposal" id="nama_proposal" type="text" class="form-control" placeholder="Nama Proposal...">
                        </div>
                        <?= form_error('nama_proposal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
			
				<div class="row form-group">
				                    <label class="col-md-3 text-md-right" for="berkas">Berkas</label>
				                    <div class="col-md-9">
				                        <div class="input-group">
				                             <input name="berkas" id="berkas" type="file" class="form-control">
				                        </div>
				                        <?= form_error('berkas', '<small class="text-danger">', '</small>'); ?>
				                    </div>
				 </div>
				 
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_proker">Nama Proker</label>
                    <div class="col-md-9">
                        <div class="input-group">
							<select name="id_proker" id="id_proker">
							<?php foreach($proker as $r):?>
							<option value="<?= $r['id_proker']?>"><?= $r['keterangan']?></option>
							<?php endforeach;?>
							</select>
							
                        </div>
                        <?= form_error('keterangan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
				<!-- </form> -->
            </div>
        </div>
    </div>
</div>