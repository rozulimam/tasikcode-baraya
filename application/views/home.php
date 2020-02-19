<!DOCTYPE html>
<html lang="id">

<head>
    <title>Baraya Tasik Code</title>

    <meta charset="utf-8">
    <meta name="description" content="<?= $meta_desc ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('asset/plugins/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/plugins/font-awesome/css/all.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/css/custom.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <header>
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">Baraya</h4>
                        <p class="text-muted">
                            <?= $about ?>
                        </p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="https://twitter.com/tasikcode" class="text-white">Follow on Twitter</a></li>
                            <li><a href="https://www.facebook.com/tasikcode/" class="text-white">Like on Facebook</a></li>
                            <li><a href="https://github.com/TasikCode" class="text-white">Github</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <i class="fa fa-users"></i>&nbsp;<strong>Baraya</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </header>

    <main role="main">
        <div class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-lg-4 mb-2">
                                <a href="<?= $gform ?>" class="btn btn-block btn-outline-secondary" target="_blank">
                                    <i class="fa fa-user-plus"></i> Saya ingin memperkenalkan diri
                                </a>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Siapa yang anda cari...">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" id="btn_search">Cari</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <?php foreach ($family as $d) { ?>
                        <div class="col-lg-3 col-md-6 col-sm-12 members">
                            <div class="card mb-4 shadow-sm">
                                <img class='bd-placeholder-img card-img-top' src="<?= $d['image']; ?>" onerror="this.src='asset/img/github-logo.png';" alt="Image Of <?= $d['name']; ?>" />
                                <div class="card-body">
                                    <div class="card-text text-center">
                                        <p class="font-weight-bold"><?= $d['name']; ?><br/>
                                        <small class='text-black-50'><?= $d['title']; ?></small></p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button class="btn btn-sm btn-outline-secondary btn-block btn-detail" data-id="<?= $d['id'] ?>">
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

    <footer class="text-muted">

    </footer>


    <div class="modal fade" id="my-modal" tabindex="-1" role="dialog" aria-labelledby="my-modal" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('asset/plugins/jquery/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugins/bootstrap/js/popper.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/plugins/sweetalert/sweetalert2.all.min.js') ?>"></script>
    <script src="<?php echo base_url('asset/js/custom.js') ?>"></script>
</body>

</html>