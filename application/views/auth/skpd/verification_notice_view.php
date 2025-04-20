<?php $this->load->view('partials/head-main') ?>

<head>
    <?php $this->load->view('partials/title-meta') ?>
    <?php $this->load->view('partials/head-css') ?>
    <style>
        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            margin-top: 6rem;
        }
        .card {
            max-width: 500px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .main-content {
            margin-left: 0;
        }
        .success-icon {
            font-size: 64px;
            color: #34c38f;
            margin-bottom: 20px;
        }
    </style>
</head>

<?php $this->load->view('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php $this->load->view('partials/topbar_notverified') ?>

    <!-- Start Content here -->
    <div class="main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center p-4">
                                <i class="mdi mdi-check-circle-outline success-icon"></i>
                                <h4 class="mb-3">Terima kasih telah mendaftar!</h4>
                                <p>SKPD: <strong><?= $this->session->userdata('user_logged')['nama_skpd'] ?></strong></p>
                                <p class="mb-4">Akun Anda sedang diverifikasi oleh administrator.</p>
                                <p>Silakan login kembali nanti untuk memeriksa status verifikasi akun Anda.</p>
                                <div class="mt-4">
                                    <a href="<?= base_url('auth_old/logout') ?>" class="btn btn-primary px-4">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>
<script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>
</html>