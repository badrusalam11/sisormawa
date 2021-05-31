<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Riwayat Data Permintaan Pembelian
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('permintaanpembelian/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Permintaan Pembelian
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>No Transaksi</th>
                    <th>Tanggal Minta</th>
                    <th>Divisi</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Minta</th>
                    <th>User</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($permintaanpembelian) :
                    foreach ($permintaanpembelian as $pp) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $pp->id_pp; ?></td>
                            <td><?= $pp->tanggal_minta; ?></td>
                            <td><?= $pp->nama_divisi; ?>
                            </td>
                            <td><?= $pp->nama_barang; ?></td>
                            <td><?= $pp->jumlah_minta; ?> &nbsp; pcs</td>
                            <td><?= $pp->nama; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('permintaanpembelian/delete/') . $pp->id_pp ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>