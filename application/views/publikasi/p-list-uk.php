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
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.5.0/css/select.dataTables.min.css">


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
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4 class="card-title">Daftar <?= $title ?></h4>
                                        </p>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" id="btn-tambah">
                                            <i class="bx bxs-plus-square font-size-16 align-middle me-2"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <table id="tb_data" class="table table-bordered display nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <?php foreach ($props['cols'] as $kc => $vc) : ?>
                                                <th><?= $vc; ?></th>
                                            <?php endforeach ?>
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

<div id="modal-lihat" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="modal-edit" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">

                </div>
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
<!-- Datatable init js -->
<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>
<script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script>
    const type = '<?= $props['type']; ?>';
    var dt_table = $('#tb_data').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "ajax": {
            url: base_url + 'publikasi/get_data/' + type,
            type: 'POST'
        },
        scrollX: true,
        drawCallback: function() {
            $('.btn-c-data').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-lihat');

                showPreloader();
                var btn = $(this);
                btn.attr('disabled', true);
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                $.post(base_url + 'publikasi/pilih_data/<?= $props['type'] ?>', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Pilih Data');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                        
                        hidePreloader();
                        btn.attr('disabled', false);
                        btn.html('Pilih Data');
                    });
            });
            $('.btn-s-data').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-lihat');
                
                showPreloader();
                var btn = $(this);
                btn.attr('disabled', true);
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

                $.post(base_url + 'publikasi/lihat_data/<?= $props['type'] ?>', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Lihat Data');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');

                        hidePreloader();
                        btn.attr('disabled', false);
                        btn.html('Lihat Data');
                    });
            });
            $('.check-status').on('click', function(e) {
                // e.preventDefault();
                var id = $(this).data('id');
                $.post(base_url + 'masterdata/upstate/' + type, {
                    id: id
                }).done(function(data) {
                    if (data.status == 'success') {
                        $('#tb_data').DataTable().ajax.reload(null, false);
                    } else {
                        $('#tb_data').DataTable().ajax.reload(null, false);
                    }
                });
            });
            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-edit');
                $.post(base_url + 'masterdata/edit/<?= $props['type'] ?>', {
                        id: id,
                        act: 'edit'
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Edit');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                    });
            });
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Warning',
                    text: 'Hapus Data?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f77',
                    cancelButtonColor: '#38d',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        $.post(base_url + 'masterdata/delete/<?= $props['type'] ?>', {
                            id: id
                        }).done(function(data) {
                            if (data.status == 'success') {
                                $('#tb_data').DataTable().ajax.reload(null, false);

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data Berhasil Dihapus'
                                });

                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Tidak Berhasil',
                                    text: 'Data Tidak Berhasil Dihapus'
                                });
                            }
                        });;
                    }
                });
            });
        },
    });

    $('#btn-tambah').on('click', function(e) {
        e.preventDefault();
        var modal = $('#modal-edit');
        var ctrlr = 'publikasi';
        if (type == 'keluaran' || type == 'urusan') {
            ctrlr = 'masterdata';
        }
        $.post(base_url + ctrlr + '/edit/' + type, {
                // id: id,
                act: 'add'
            })
            .done(function(data) {
                modal.find('.modal-title').html('Tambah');
                modal.find('.modal-body').html(data);
                modal.modal('show');
            });
    });
</script>

</body>

</html>