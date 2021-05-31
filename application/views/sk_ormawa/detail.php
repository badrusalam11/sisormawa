<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                   <?php echo $ormawa['nama_ormawa'];?>
                </h4>
            </div>
			<div class="col-auto" <?php if($this->session->userdata('login_session')['id_ormawa']==0){echo"hidden";}?> >
			                <a href="<?= current_url()?>/add" class="btn btn-sm btn-primary btn-icon-split">
			                    <span class="icon">
			                        <i class="fa fa-plus"></i>
			                    </span>
			                    <span class="text">
			                        Tambah SK
			                    </span>
			                </a>
			</div>
        </div>
    </div>
	<!-- <div class="col">
	<h5>sk_ormawa Ormawa</h5>
	<?php if($sk_ormawa):?>
	<?php foreach($sk_ormawa as $p):?>
	<a href="<?php echo base_url('file_proposal/') . $p['berkas'];?>"><?php echo $p['berkas'];?></a>
	<br />
	<?php endforeach;?>
	<?php else : ?>
	<div>File Tidak Ditemukan</div>
	<?php endif;?>
	
	</div> -->
	<div class="table-responsive">
        <table class="table table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Nama SK</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($sk_ormawa) :
                    foreach ($sk_ormawa as $p) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['nama_sk']; ?></td>
                            <td><?= $p['status']; ?></td>
                            <td><?= $p['catatan']; ?></td>
                            <td>
                                <a href="<?php echo base_url('file_sk_ormawa/') . $p['berkas'];?>" class="btn btn-primary  btn-sm"><i class="fa fa-download"></i></a>
								<a href="<?= base_url('SkOrmawa/edit/') . $p['id_sk'] ?>" class="btn btn-warning btn-sm" <?php if($this->session->userdata('login_session')['id_ormawa'] != 0) { echo "hidden";}?>><i class="fa fa-edit"></i></a>
								<a href="<?= base_url('SkOrmawa/pengesahan/') . $p['id_sk'] ?>" class="btn btn-success btn-sm <?php if($p['status']=='Revisi'){echo "disabled";}?>"><i class="fa fa-signature"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('SkOrmawa/delete/') . $p['id_sk'] ?>" class="btn btn-danger btn-sm"  <?php if($this->session->userdata('login_session')['id_ormawa'] == 0) { echo "hidden";}?>><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="3" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>