<style type="text/css">
    #crop_area { width: 100%; height: 200px; display: none; margin-bottom: 50px; }
    #btn_get { display: none; }
    #avatar { width: 100%; height: auto; display: none}
</style> 
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?=$title?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?=$title?></strong>
            </li>
        </ol>
    </div>  
</div>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">

                </div>
                <div class="ibox-content"> 
						<div class="row">
							<div class="col-md-3 b-r">
								<div class="form-group">
									<label>Foto</label>  
									<p class="text-center" id="avatar_area">
						                <a href="#"><i class="fa fa-user big-icon"></i></a>
						                
						            </p> 
						            <img src="" alt="" id="avatar">

						            <div id="crop_area"></div> 
						            <button class="btn btn-primary btn-block" id="btn_get">
						            	<i class="fa fa-cut"></i>
						            	Potong Gambar
						            </button>

									<input type="file" class="form-control" id="upload" accept="image/*" />
									
								</div>
							</div>
							<div class="col-md-9">
								<div class="row"> 
									<div class="col-md-6">
										<div class="form-group">
											<label>Nama Lengkap</label> 
											<input type="text" class="form-control" id="name">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Email</label> 
											<input type="text" class="form-control" id="email">
										</div>
									</div> 

									<div class="col-md-3">
										<div class="form-group">
											<label>Username</label> 
											<input type="text" class="form-control" id="username">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Jenis Kelamin</label> 
											<select class="form-control" id="gender"> 
												<option value="L">Laki-laki</option>
												<option value="P">Perempuan</option> 
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Level</label> 
											<select class="form-control" id="id_level"> 
												<?php foreach ($level as $d){ ?>
													<option value="<?=$d->id_level?>"><?=$d->level?></option> 
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Akses</label> 
											<select class="form-control" id="access"> 
												<option value="Y">Aktif</option>
												<option value="N">Nonaktif</option>
											</select>
										</div>
									</div> 
									<div class="col-md-6">
										<div class="form-group">
											<label>Password</label> 
											<input type="password" class="form-control" id="pass">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Konfirmasi Password</label> 
											<input type="password" class="form-control" id="conf_pass">
										</div>
									</div> 
									<div class="col-md-12">
										<div class="form-group"> 
											<div id="notif"></div>
										</div>
									</div>
								</div>
							</div> 
						</div>
                        <div class="col-sm-12"> 
                                <div class="hr-line-dashed"></div>
                                <button class="btn btn-primary" id="save" >
                                    <i class="fa fa-edit"></i> Simpan Data
                                </button> 
                        </div> 
                </div>
            </div>
        </div>
    </div>
</div>

