<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Status Berita Acara
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('SkOrmawa') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_BA' => $berita_acara['id_BA']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_ormawa">Nama SK</label>
                    <div class="col-md-9">
                        <div class="input-group">
                           
                            <input value="<?= set_value('nama_BA', $berita_acara['nama_BA']); ?>" name="nama_BA" id="nama_BA" type="text" class="form-control" placeholder="Nama Sk..." readonly>
                        </div>
                        <?= form_error('nama_BA', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="status">Status</label>
                    <div class="col-md-9">
                        <div class="input-group">
							<select name="status" id="status">
							<option value="Diterima" <?php if($berita_acara['status']=="Diterima"){echo"selected";} ?> > Diterima</option>
							<option value="Revisi"<?php if($berita_acara['status']=="Revisi"){echo"selected";} ?> > Revisi</option>
							</select>
							
							
                        </div>
                        <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				<div class="row form-group">
                    <label class="col-md-3 text-md-right" for="catatan">Catatan</label>
                    <div class="col-md-9">
                        <div class="input-group">
							
							<textarea name="catatan" id="catatan" class="form-control" rows="10" placeholder="Catatan..."><?= set_value('catatan', $berita_acara['catatan']); ?></textarea>
							
                        </div>
                        <?= form_error('catatan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
				
				
                <!-- <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_telp">Nomor Telepon</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                            </div>
                            <input value="<?= set_value('no_telp', $supplier['no_telp']); ?>" name="no_telp" id="no_telp" type="text" class="form-control" placeholder="Nomor Telepon...">
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
                            <textarea name="alamat" id="alamat" class="form-control" rows="4" placeholder="Alamat..."><?= set_value('alamat', $supplier['alamat']); ?></textarea>
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