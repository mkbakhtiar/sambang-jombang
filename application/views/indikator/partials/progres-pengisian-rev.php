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
                                            <!-- <th style="width: 12%;">Total</th> -->
                                            <th style="width: 12%;">Lihat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($props['stats'] as $kr => $vr) : ?>
                                            <tr class="align-middle">
                                                <td class="text-center"><?= $kr + 1; ?></td>
                                                <td class="text-start"><?= $vr['nama_skpd']; ?></td>
                                                <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                                    <td class="text-end"><?= number_format((($vr['t_' . $vt['nama_tahun']] / $vr['jml_indikator']) * 100), 2); ?>%</td>
                                                <?php endforeach; ?>
                                                <!-- <td class="text-end"><?= $vr['progres']['total']; ?>%</td> -->
                                                <td class="text-center"><a href="<?= base_url('indikator/pengisian/') . $vr['id_skpd'] ?>" class="btn btn-success" type="button" target="_blank">Lihat</a></td>
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