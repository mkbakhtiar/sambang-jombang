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
                <?php if ($this->session->admin || $this->session->admin2) : ?>
                    <div class="row mb-4">
                        <div class="col-12">
                            <select class="form-control select2" name="pilih-skpd" id="pilih-skpd" style="width: 100%;" required>
                                <option value="" disabled selected>Pilih OPD</option>
                                <option value="">Semua OPD</option>
                                <?php foreach ($props['skpd_list'] as $ks => $vs) : ?>
                                    <option value="<?= $vs['id_skpd'] ?>" <?= $vs['id_skpd'] == $this->uri->segment(3, 0) ? 'selected' : '' ?>><?= $vs['nama_skpd']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <?php if ($props['transfer_count'] != 0) : ?>
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert alert-danger text-center" role="alert">
                                    <a href="<?= base_url('indikator/transfer'); ?>">Terdapat <?= $props['transfer_count'] ?> Permintaan Pemindahan Kewenangan Data Ke OPD Lain</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
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
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Progres Penetapan Daftar Data</h4>
                                <div>
                                    <div class="progress animated-progess mb-4">
                                        <div class="progress-bar" role="progressbar" style="width: 0%" id="progress"></div>
                                    </div>
                                </div>
                                <div class="text-center d-none" id="download-container">
                                    <a href="<?= base_url('download/berita_acara/' . (($props['id_skpd'] != null) ? $props['id_skpd'] : '')) ?>" class="btn btn-sm btn-primary waves-effect waves-light">
                                        <i class="bx bx-download font-size-16 align-middle me-2"></i> Download Berita Acara
                                    </a>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4 class="card-title">Daftar Indikator</h4>
                                        </p>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end justify-content-end">
                                        <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                                        <?php if ($this->session->admin || !$this->session->admin2) : ?>
                                            <a href="<?= base_url('indikator/add') ?>" class="btn btn-primary waves-effect waves-light align-middle">
                                                <i class="bx bxs-plus-square font-size-16 align-middle me-2"></i> Tambah
                                            </a>
                                        <?php endif; ?>
                                            <div class="dropdown">
                                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Export <i class="mdi mdi-chevron-down"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="<?= base_url('download/download/penetapan/excel/' . ($this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : null) ) ?>">Excel</a>
                                                    <a class="dropdown-item" href="<?= base_url('download/download/penetapanAll/excel/' . ($this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : null) ) ?>">Excel All</a>
                                                    <!-- <a class="dropdown-item" href="<?= base_url('download/download/penetapan/pdf') ?>">PDF</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tb_indikator" class="table table-bordered" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 40%;">Nama Indikator</th>
                                            <th style="width: 40%;">Definisi Operasional</th>
                                            <th>Satuan</th>
                                            <th>Sub Indikator</th>
                                            <th>Metadata</th>
                                            <?php if ($this->session->admin || !$this->session->admin2) : ?>
                                            <th>Konfirmasi</th>
                                        <?php endif; ?>
                                            <th>Aksi</th>
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

<div id="modal-konfirmasi" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
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
    var tb_indikator = $('#tb_indikator').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "ajax": {
            url: base_url + 'indikator/get_indikator_list/confirm/<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : null ?>',
            type: 'POST'
        },
        // dom: '',
        scrollX: true,
        drawCallback: function() {
            $('.btn-sub-detail').on('click', function(e) {
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
            $('.btn-detail').on('click', function(e) {
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
            $('.btn-confirm').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-konfirmasi');
                $.post(base_url + 'indikator/indikator_konfirmasi', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Konfirmasi');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                    });
            });
            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                window.open(base_url + 'indikator/add/' + id, '_self');
            });
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Warning',
                    text: 'Hapus Indikator?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f77',
                    cancelButtonColor: '#38d',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        $.post(base_url + 'indikator/delete/', {
                            id: id
                        }).done(function(data) {
                            if (data.status == 'success') {
                                $('#tb_indikator').DataTable().ajax.reload(null, false);

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Indikator Berhasil Dihapus'
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tidak Berhasil',
                                    text: 'Indikator Tidak Berhasil Dihapus'
                                });
                            }
                        });;
                    }
                });
            });
        },
    });

    function update_stats() {
        $.ajax(base_url + 'indikator/get_rekap_konfirmasi/<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : $this->session->detail['id_skpd'] ?>')
            .done(function(data) {
                var totalData = parseInt(data['konfirmasi_sudah']) + parseInt(data['konfirmasi_belum']);
                var totalConfirmed = parseInt(data['konfirmasi_sudah']);
                var totalOk = parseInt(data['konfirmasi_ok'])
                $('#total-data').text(totalData);
                $('#total-konfirmasi').text(totalConfirmed);
                $('#total-ok').text(totalOk);
                $('#progress').css('width', String(totalConfirmed / totalData * 100) + '%');
                if ((totalConfirmed / totalData * 100) == 100) {
                    $('#download-container').removeClass('d-none')
                }
            })
    }

    $('#pilih-skpd').on('change', function(e) {
        e.preventDefault();
        var id = $(this).val();
        window.open(base_url + 'indikator/penetapan/' + id, '_self');
    })

    $(document).ready(function() {
        update_stats();
    });
</script>


</body>

</html>