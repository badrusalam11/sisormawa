`<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
				Proker
				</h4>
            </div>
			<div class="col-auto" <?php if($this->session->userdata('login_session')['id_ormawa']==0){echo"hidden";}?> >
			                <a href="<?= current_url()?>/add" class="btn btn-sm btn-primary btn-icon-split">
			                    <span class="icon">
			                        <i class="fa fa-plus"></i>
			                    </span>
			                    <span class="text">
			                        Tambah Proker
			                    </span>
			                </a>
			</div>
        </div>
    </div>
	<div class="container">
	      <div class="row">
	        <div class="span4" id="calendar"></div>
	      </div>
	</div>
</div>