<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Jumlah Indikator</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="total-data">-</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-warning">
                            <div class="card-header bg-warning">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Terkonfirmasi</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="total-konfirmasi">-</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border border-success">
                            <div class="card-header bg-success">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Jumlah Indikator Akhir</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="total-ok">-</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="card-title"><?= $title ?></h4>
                                        <div>
                                            <div class="progress animated-progess mb-2 mt-2">
                                                <div class="progress-bar" role="progressbar" style="width: 0%" id="progress"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tb-progres" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr class="text-center align-middle">
                                            <th>#</th>
                                            <th>Nama OPD</th>
                                            <th style="width: 12%;">Indikator</th>
                                            <th style="width: 12%;">Terkonfirmasi</th>
                                            <th style="width: 12%;">Belum Konfirmasi</th>
                                            <th style="width: 12%;">Indikator Tersedia</th>
                                            <th style="width: 12%;">Indikator Tidak Tersedia</th>
                                            <th style="width: 12%;">Progres</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($props['rekap'] as $kr => $vr) : ?>
                                            <tr>
                                                <?php $total_ind = intval($vr['konfirmasi_sudah']) + intval($vr['konfirmasi_belum']); ?>
                                                <td class="text-center"><?= $kr + 1; ?></td>
                                                <td class="text-start"><?= $vr['nama_skpd']; ?></td>
                                                <td class="text-end"><?= $total_ind; ?></td>
                                                <td class="text-end"><?= $vr['konfirmasi_sudah'] == null ? 0 : $vr['konfirmasi_sudah']; ?></td>
                                                <td class="text-end"><?= $vr['konfirmasi_belum'] == null ? 0 : $vr['konfirmasi_belum']; ?></td>
                                                <td class="text-end"><?= $vr['konfirmasi_ok'] == null ? 0 : $vr['konfirmasi_ok']; ?></td>
                                                <td class="text-end"><?= $vr['konfirmasi_not_ok'] == null ? 0 : $vr['konfirmasi_not_ok']; ?></td>
                                                <td class="text-end"><?= $total_ind != 0 ? number_format((intval($vr['konfirmasi_sudah']) / ($total_ind) * 100), 2) : '100.00'; ?> %</td>
                                                <td class="text-end"></td>
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