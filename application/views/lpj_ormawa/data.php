`<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                   Data Ormawa
                </h4>
            </div>
			<!-- <div class="col-auto">
			                <a href="<?= base_url('ProfileOrmawa/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
			                    <span class="icon">
			                        <i class="fa fa-plus"></i>
			                    </span>
			                    <span class="text">
			                        Tambah Data Ormawa
			                    </span>
			                </a>
			            </div> -->
        </div>
    </div>
	<div class="col">
	<?php
	if ($rumpun_ormawa) :
	$no = 1;
    foreach ($rumpun_ormawa as $r) :
	?>
	<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse<?=$r['id_rumpun'];?>"><?= $r['nama_rumpun']?></a>
        </h4>
      </div>
      <div id="collapse<?=$r['id_rumpun'];?>" class="panel-collapse collapse">
		<?php
		$CI =& get_instance();
		$CI->load->model('Admin_model', 'admin');
		// $arr = $CI->admin->getNamaOrmawa(['id_rumpun' => $r['id_rumpun']]);
		$arr = $CI->admin->get('ormawa', null, ['id_rumpun' => $r['id_rumpun']]);
		// $arr = $CI->admin->get('ormawa');
		// var_dump($arr);
		// $arr = $CI->db->get_where('ormawa', ['id_rumpun' => $r['id_rumpun']]);
		?>
		<?php foreach ($arr as $o) :?>
        <div class="panel-body"><a href="<?= current_url();?>/detail?id_ormawa=<?=$o['id_ormawa']?>"><?php echo $o['nama_ormawa'];?></a></div>
		<?php endforeach; ?>
      </div>
    </div>
  </div>
  <?php $no++; ?>
  <?php endforeach; ?>
   <?php else : ?>
   <tr>
   <td colspan="6" class="text-center">
   Data Kosong
   </td>
   </tr>
   <?php endif; ?>
   </div>
</div>