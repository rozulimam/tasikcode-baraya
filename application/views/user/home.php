<main role="main">
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                        <div class="col-md-12 col-lg-5 mb-2">
                            <a href="<?php echo base_url('register') ?>" class="btn btn-block btn-outline-secondary" target="_self">
                                <i class="fa fa-user-plus"></i> Saya ingin memperkenalkan diri
                            </a>
                        </div>
                        <div class="cold-md-12 col-lg-4">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Siapa yang anda cari..." id="keyword">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" id="btn_search">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>
                </div>  
            </div>
            <div class="row result_member">
                    <?php foreach ($family as $d){ ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 members">
                            <div class="card mb-4 shadow-sm">
                                <img class='bd-placeholder-img card-img-top' src="<?=$d['image']; ?>" onerror="this.src='assets/img/github-logo.png';
                            " />
                                <div class="card-body">
                                    <p class="card-text">
                                        <center>
                                            <b><?=$d['name'];?></b>
                                            <br>
                                            <small class='text-black-50'><?=$d['title'];?></small>
                                        </center>
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary btn-block btn-detail" data-id="<?=$d['id']?>">
                                            Kenali lebih dekat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                </div>
        </div>
    </div>
</main>