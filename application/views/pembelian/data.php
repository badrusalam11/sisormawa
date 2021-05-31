<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Pembelian
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('pembelian/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Input Pembelian
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
                    <th>ID Pembelian</th>
                    <th>Tanggal Beli</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Beli</th>
                    <th>User</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if ($pembelian) :
                    foreach ($pembelian as $p) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p['id_pembelian']; ?></td>
                            <td><?= $p['tanggal_beli']; ?></td>
                            <td><?= $p['nama_barang']; ?></td>
                            <td><?= $p['jumlah_beli'] . ' ' . $p['nama_satuan']; ?></td>
                            <td><?= $p['nama']; ?></td>
                            <td>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('pembelian/delete/') . $p['id_pembelian'] ?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-trash"></i></a>
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