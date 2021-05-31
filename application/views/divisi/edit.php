<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Divisi
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('satuan') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open('', [], ['id_divisi' => $divisi['id_divisi']]); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_divisi">Nama Divisi</label>
                    <div class="col-md-9">
                        <input value="<?= set_value('nama_divisi', $divisi['nama_divisi']); ?>" name="nama_divisi" id="nama_divisi" type="text" class="form-control" placeholder="Nama Divisi...">
                        <?= form_error('nama_divisi', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>