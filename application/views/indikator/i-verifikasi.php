<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />

    <?php $this->load->view('partials/head-css') ?>

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
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border border-primary">
                            <div class="card-header bg-primary">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Jumlah Data</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="total-data">0</h3>
                            </div>
                            <div class="card-footer text-center p-2 m-0">
                                <button onclick="change_source('all')" class="btn btn-primary btn-sm" type="button">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border border-warning">
                            <div class="card-header bg-warning">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Jumlah Data Pending</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="data-pending">0</h3>
                            </div>
                            <div class="card-footer text-center p-2 m-0">
                                <button onclick="change_source('pending')" class="btn btn-warning btn-sm" type="button">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border border-danger">
                            <div class="card-header bg-danger">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Jumlah Data Revisi</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="data-revisi">0</h3>
                            </div>
                            <div class="card-footer text-center p-2 m-0">
                                <button onclick="change_source('revisi')" class="btn btn-danger btn-sm" type="button">Lihat</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="card border border-success">
                            <div class="card-header bg-success">
                                <h5 class="my-0 text-light"><i class="mdi mdi-bullseye-arrow me-3"></i>Jumlah Data Lolos</h5>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="" id="data-lolos">0</h3>
                            </div>
                            <div class="card-footer text-center p-2 m-0">
                                <button onclick="change_source('lolos')" class="btn btn-success btn-sm" type="button">Lihat</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Progres Verifikasi Data</h4>
                                <div>
                                    <div class="progress animated-progess mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 10%" id="progress"></div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-middle">
                                    <div class="col-md-12 col-lg-6">
                                        <h4 class="card-title">Daftar Data</h4>
                                    </div>
                                    <div class="col-md-12 col-lg-6">
                                        <div class="row g-3 align-items-end">
                                            <div class="col-sm-12 col-md-8">
                                                <select id="sel-skpd" class="form-control select2" name="" style="width: 100%;">
                                                    <option value="" selected>Semua OPD</option>
                                                    <?php foreach ($props['skpd_list'] as $ks => $vs) : ?>
                                                        <option value="<?= $vs['id_skpd'] ?>"><?= $vs['nama_skpd'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-12 col-md-4">
                                                <select id="sel-tahun" class="form-control select2" name="" style="width: 100%;">
                                                    <option value="" selected>Semua Tahun</option>
                                                    <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                                        <option value="<?= $vt['nama_tahun'] ?>"><?= $vt['nama_tahun'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table id="tb-data-verifikasi" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Indikator</th>
                                            <th>SKPD</th>
                                            <th>Tahun</th>
                                            <th>Data Angka</th>
                                            <th>Data File</th>
                                            <th>Catatan Data</th>
                                            <th>Update Data</th>
                                            <th>Metadata</th>
                                            <th>Verifikasi</th>
                                            <th>Catatan Verifikasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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

<div id="modal-detail" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-verifikasi" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="<?= base_url() ?>/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="<?= base_url() ?>/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>



<script>
    $('.select2').select2({
        theme: 'bootstrap4'
    });
    var tb_verifikasi = $('#tb-data-verifikasi').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "ajax": {
            url: base_url + 'indikator/get_indikator_list/verifikasi',
            type: 'POST'
        },
        "order": [
            [8, 'asc']
        ],
        "columnDefs": [{
            targets: [4],
            className: 'text-end'
        }],
        scrollX: true,
        drawCallback: function() {
            $('.a-detail-indikator').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-detail');
                $.post(base_url + 'indikator/get_indikator_detail', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Detail Indikator');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                    });
            });
            $('.a-detail-data').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-detail');
                $.post(base_url + 'indikator/get_datas', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Data');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                    });
            });
            $('.btn-verifikasi').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-verifikasi');
                $.post(base_url + 'indikator/data_verifikasi?type=all', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Verifikasi Data');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                    });
            });
        },
    });

    function update_stats() {
        $.ajax(base_url + 'indikator/get_rekap_verifikasi')
            .done(function(data) {
                $('#total-data').text(data['jumlah']);
                $('#data-pending').text(data['verifikasi_belum']);
                $('#data-revisi').text(data['verifikasi_not_ok']);
                $('#data-lolos').text(data['verifikasi_ok']);

                $('#progress').css('width', String((data['jumlah'] - data['verifikasi_belum']) / data['jumlah'] * 100) + '%');

            })
    }

    update_stats();

    function change_source(type) {
        var url = base_url + 'indikator/get_indikator_list/verifikasi?type=' + type;
        tb_verifikasi.ajax.url(url).load();
    }

    $('#sel-tahun').on('change', function() {
        filter_dt()
    });
    $('#sel-skpd').on('change', function() {
        filter_dt()
    });

    function filter_dt() {
        var t = $('#sel-tahun').val();
        var s = $('#sel-skpd').val();

        var tt = (t != '' ? 'tahun=' + t : '');
        var ss = (s != '' ? 'skpd=' + s : '');

        var url = base_url + 'indikator/get_indikator_list/verifikasi?' + tt + '&' + ss;
        $('#tb-data-verifikasi').DataTable().ajax.url(url).load();
    }
</script>


</body>

</html>