<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Program Kerja
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('ProgramKerja') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open(); ?>
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
                    <label class="col-md-3 text-md-right" for="tanggal">Tanggal</label>
                    <div class="col-md-9">
                        <div class="input-group">
                             <input name="tanggal" id="tanggal" type="date" class="form-control">
                        </div>
                        <?= form_error('tanggal', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="keterangan">Keterangan</label>
                    <div class="col-md-9">
                        <div class="input-group">
							
							<textarea name="keterangan" id="keterangan" class="form-control" rows="10" placeholder="Keterangan..."><?= set_value('keterangan'); ?></textarea>
							
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
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>