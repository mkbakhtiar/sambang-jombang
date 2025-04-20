<?php $this->load->view('partials/head-main') ?>

<head>

    <meta charset="utf-8" />
    <title>Error <?= $err_code ?> | $msg</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('/') ?>assets/images/favicon.ico">

    <!-- preloader css -->
    <link rel="stylesheet" href="<?= base_url('/') ?>assets/css/preloader.min.css" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?= base_url('/') ?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('/') ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('/') ?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- <body data-layout="horizontal"> -->

    <div class="my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-1 fw-semibold"><?= $err_code; ?></h1>
                        <h4 class="text-uppercase"><?= $msg ?></h4>
                        <div class="mt-5 text-center">
                        <button class="btn btn-primary waves-effect waves-light" onclick="history.back()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-xl-8">
                    <div>
                        <img src="<?= base_url('/') ?>assets/images/error-img.png" alt="" class="img-fluid">
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end content -->

    <!-- JAVASCRIPT -->
    <script src="<?= base_url('/') ?>assets/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url('/') ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('/') ?>assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url('/') ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url('/') ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url('/') ?>assets/libs/feather-icons/feather.min.js"></script>
    <!-- pace js -->
    <script src="<?= base_url('/') ?>assets/libs/pace-js/pace.min.js"></script>

    <script src="<?= base_url('/') ?>assets/js/app.js"></script>

</body>

</html>