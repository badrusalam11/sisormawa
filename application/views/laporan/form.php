<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Kartu Barang
                </h4>
            </div>
            
        </div>
    </div>
	<form action="<?=base_url()?>laporan/cari" method="">
	<div class="container">
		<label>Cari Barang</label>
		<select  name="id_barang" id="" class="custom-select">
			<?php foreach($barang as $b) :?>
			<option value="<?=$b['id_barang']?>" <?php if(isset($_GET['id_barang'])){if($b['id_barang']==$_GET['id_barang']){echo "selected";}}?>><?= $b['nama_barang']?></option>
			<?php endforeach;?>
		</select>
		<br />
		<button type="submit" class="btn btn-primary">Cari!</button>
		
	</div>
	</form>
	<br />
	
    <div class="table-responsive" <?php if(empty($barangmasuk)){echo"hidden";} else {echo " ";}?>> 
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No. </th>
                    <th>Tanggal</th>
                    <th>Barang Masuk</th>
                    <th>Barang Keluar</th>
                    <th>Saldo</th>
                </tr>
            </thead>
            <tbody>
                <?php
				$jumlah_masuk = 0;
				$jumlah_keluar = 0;
				$saldo = 0;
                $no = 1;
                if ($barangmasuk or $barangkeluar) :
                    foreach ($barangmasuk as $d) :
                        ?>
                        <tr>
							
                            <td><?= $no++; ?></td>
                            <td><?= $d['tanggal_masuk']; ?></td>
                            <!-- <td><?= $d->barang_id; ?></td> -->
                            <td><?php echo $d['jumlah_masuk']; ?></td>
                            <td>-</td>
                            <td><?php
							$jumlah_masuk += $d['jumlah_masuk']; 
							$saldo = $jumlah_masuk - $jumlah_keluar;
							echo $saldo;
							?></td>
                            
                        </tr>
						
                    <?php 
					endforeach;
					?>
					
					<?php
                    foreach ($barangkeluar as $d) :
                        ?>
                        <tr>
							
                            <td><?= $no++; ?></td>
                            <td><?= $d['tanggal_keluar']; ?></td>
                            <!-- <td><?= $d->barang_id; ?></td> -->
                            <td>-</td>
                            <td><?php echo $d['jumlah_keluar']; ?></td>
                            <td><?php
							$jumlah_keluar += $d['jumlah_keluar']; 
							$saldo = $jumlah_masuk - $jumlah_keluar;
							echo $saldo;
							?></td>
                            
                        </tr>
						
                    <?php 
					endforeach;
					?>
					
                <?php
				else : 
				?>
                    <tr>
                        <td colspan="8" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php 
				endif; 
				?>
            </tbody>
        </table>
    </div>
</div>