<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php $this->load->view('partials/head-css') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />

</head>

<?php $this->load->view('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <?php $this->load->view('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?php $this->load->view('partials/page-title') ?>
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card border border-primary">
                            <div class="card-header bg-primary">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Indikator</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class=""><?= $props['stats_indikator']['konfirmasi_ok']; ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-warning">
                            <div class="card-header bg-warning">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Data</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class=""><?= array_sum($props['stats_data']['data']) ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-success">
                            <div class="card-header bg-success">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Progres</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class=""><?= $props['stats_data']['total'] ?>%</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Progres Pengisian Data</h4>
                                <div>
                                    <div class="progress animated-progess mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $props['stats_data']['total'] ?>%" aria-valuenow="<?= $props['stats_data']['total'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <thead class="bg-primary text-light">
                                        <tr class="text-center">
                                            <?php foreach ($props['stats_data']['detail'] as $kd => $vd) : ?>
                                                <th><?= $kd; ?></th>
                                            <?php endforeach ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <?php foreach ($props['stats_data']['detail'] as $kd => $vd) : ?>
                                                <td><?= $vd; ?>%</td>
                                            <?php endforeach ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="tb-progres" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th>#</th>
                                            <th>Nama OPD</th>
                                            <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                                <th style="width: 12%;"><?= $vt['nama_tahun']; ?></th>
                                                <?php endforeach; ?>
                                                <th style="width: 12%;">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($props['skpd_list'] as $kr => $vr) : ?>
                                            <tr class="align-middle">
                                                <td class="text-center"><?= $kr + 1; ?></td>
                                                <td class="text-start"><?= $vr['nama_skpd']; ?></td>
                                                <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                                    <td class="text-end"><?= $vr['progres']['detail'][$vt['nama_tahun']]; ?>%</td>
                                                    <?php endforeach; ?>
                                                <td class="text-end"><?= $vr['progres']['total']; ?>%</td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <?php $this->load->view('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->
<?php $this->load->view('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?= base_url() ?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?= base_url() ?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="<?= base_url() ?>assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>assets/js/app.js"></script>

<script>
    var tbProgres = $('#tb-progres').DataTable({
        pageLength: 1000,
        paging: false,
        dom: 'Bfrtip',
        lengthChange: false,
        buttons: ['excel', 'pdf']
    });

    function update_stats() {
        $.ajax(base_url + 'indikator/get_rekap_konfirmasi/<?= $this->session->admin || $this->session->admin2 ? '' : $this->session->detail['id_skpd'] ?>')
        // $.ajax(base_url + 'indikator/get_rekap_konfirmasi/<?= $this->session->admin ? '' : $this->session->detail['id_skpd'] ?>')
            .done(function(data) {
                var totalData = parseInt(data['konfirmasi_sudah']) + parseInt(data['konfirmasi_belum']);
                var totalConfirmed = parseInt(data['konfirmasi_sudah']);
                var totalOk = parseInt(data['konfirmasi_ok'])
                $('#total-data').text(totalData);
                $('#total-konfirmasi').text(totalConfirmed);
                $('#total-ok').text(totalOk);
                $('#progress').css('width', String(totalConfirmed / totalData * 100) + '%');
            })
    }

    $(document).ready(function() {
        update_stats();
    });
</script>


</body>

</html>