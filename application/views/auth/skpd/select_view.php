<?php $this->load->view('partials/head-main') ?>

<head>
    <?php $this->load->view('partials/title-meta') ?>
    <?php $this->load->view('partials/head-css') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />
    <style>
        .content-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }
        .card {
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .card-header {
            padding: 1.5rem 1.5rem 0.5rem;
            background: transparent;
            border-bottom: none;
        }
        .card-body {
            padding: 1rem 1.5rem 1.5rem;
        }
        .main-content {
            margin-left: 0;
        }
    </style>
</head>

<?php $this->load->view('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">
    
    <?php $this->load->view('partials/topbar_notverified') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="content-wrapper">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pilih SKPD</h4>
                                <p class="card-title-desc">Silakan pilih SKPD tempat Anda bekerja</p>
                            </div>
                            <div class="card-body">
                                <?php if ($this->session->flashdata('pesan')) : ?>
                                    <?= $this->session->flashdata('pesan'); ?>
                                <?php endif; ?>
                                
                                <form action="<?= base_url('skpd/update_skpd'); ?>" method="post">
                                    <div class="mb-4">
                                        <label for="id_skpd" class="form-label">SKPD</label>
                                        <select class="form-control select2" name="id_skpd" id="id_skpd" required>
                                            <option value="">-- Pilih SKPD --</option>
                                            <?php foreach ($skpd_list as $skpd) : ?>
                                                <option value="<?= $skpd['id_skpd']; ?>"><?= $skpd['nama_skpd']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary px-4">Lanjutkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
            </div> <!-- container-fluid -->
        </div>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
    });
</script>

</body>
</html>