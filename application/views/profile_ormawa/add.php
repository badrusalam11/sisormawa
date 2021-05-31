<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Profile Ormawa
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('ProfileOrmawa') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_ormawa">Nama Ormawa</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            
                            <input value="<?= set_value('nama_ormawa'); ?>" name="nama_ormawa" id="nama_ormawa" type="text" class="form-control" placeholder="Nama Ormawa...">
                        </div>
                        <?= form_error('nama_ormawa', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="sejarah">Sejarah Ormawa</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            
                            <textarea name="sejarah" id="sejarah" class="form-control" rows="10" placeholder="Sejarah..."><?= set_value('sejarah'); ?></textarea>
                        </div>
                        <?= form_error('sejarah', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="ad_art">AD/ART Ormawa</label>
                    <div class="col-md-9">
                        <div class="input-group">
							
							<textarea name="ad_art" id="ad_art" class="form-control" rows="10" placeholder="AD/ART..."><?= set_value('ad_art'); ?></textarea>
							
                        </div>
                        <?= form_error('ad_art', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="gbho">GBHO Ormawa</label>
                    <div class="col-md-9">
                        <div class="input-group">
							
							<textarea name="gbho" id="gbho" class="form-control" rows="10" placeholder="GBHO..."><?= set_value('gbho'); ?></textarea>
							
                        </div>
                        <?= form_error('gbho', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="gbho">GBHK Ormawa</label>
                    <div class="col-md-9">
                        <div class="input-group">
							
							<textarea name="gbhk" id="gbhk" class="form-control" rows="10" placeholder="GBHK..."><?= set_value('gbhk'); ?></textarea>
							
                        </div>
                        <?= form_error('gbhk', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="gbho">Struktur Organisasi</label>
                    <div class="col-md-9">
                        <div class="input-group">
							
							<textarea name="struktur" id="struktur" class="form-control" rows="10" placeholder="Struktur..."><?= set_value('struktur'); ?></textarea>
							
                        </div>
                        <?= form_error('struktur', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_rumpun">Rumpun</label>
                    <div class="col-md-9">
                        <div class="input-group">
							<select name="id_rumpun" id="id_rumpun">
							<?php foreach($rumpun_ormawa as $r):?>
							<option value="<?= $r['id_rumpun']?>"><?= $r['nama_rumpun']?></option>
							<?php endforeach;?>
							</select>
							
							
                        </div>
                        <?= form_error('id_rumpun', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				
                <!-- <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_telp">Nomor Telepon</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                            </div>
                            <input value="<?= set_value('no_telp'); ?>" name="no_telp" id="no_telp" type="text" class="form-control" placeholder="Nomor Telepon...">
                        </div>
                        <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                            </div>
                            <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Alamat..."><?= set_value('alamat'); ?></textarea>
                        </div>
                        <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div> -->
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