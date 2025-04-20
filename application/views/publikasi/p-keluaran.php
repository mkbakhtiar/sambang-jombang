<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                <?php $this->load->view('partials/page-title') ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10 col-sm-12">
                                        <h4 class="card-title">Daftar Keluaran</h4>
                                    </div>
                                    <div class="col-md-2 col-sm-12 d-flex align-items-center justify-content-center">
                                        <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" id="btn-tambah">
                                            <i class="bx bxs-plus-square font-size-16 align-middle me-2"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="tb-data" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Keluaran</th>
                                            <th>Deskripsi</th>
                                            <th>Daftar Data</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($props['keluaran'] as $ku => $vu) : ?>
                                            <tr>
                                                <td><?= $ku + 1 ?></td>
                                                <td><?= $vu['nama_keluaran']; ?></td>
                                                <td><?= $vu['keterangan']; ?></td>
                                                <td><?= $vu['keterangan']; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-info btn-c-data" data-id="<?= encrypt_url(true, $vu['id_keluaran']) ?>" type="button">Pilih Data</button>
                                                    <button class="btn btn-sm btn-warning btn-edit" data-id="<?= encrypt_url(true, $vu['id_keluaran']) ?>" type="button">Edit</button>
                                                    <button class="btn btn-sm btn-danger btn-delete" data-id="<?= encrypt_url(true, $vu['id_keluaran']) ?>" type="button">Delete</button>
                                                </td>
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

<div id="modal-edit" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
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

<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script src="https://cdn.datatables.net/select/1.5.0/js/dataTables.select.min.js"></script>

<script>
    $('#btn-tambah').on('click', function(e) {
        e.preventDefault();
        var modal = $('#modal-edit');
        $.post(base_url + 'masterdata/edit/keluaran', {
                act: 'add'
            })
            .done(function(data) {
                modal.find('.modal-title').html('Tambah');
                modal.find('.modal-body').html(data);
                modal.modal('show');
            });
    });

    var tbListU = $('#tb-data').DataTable({
        "pageLength": 10,
        scrollX: true,
        drawCallback: function() {
            $('.btn-c-data').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-edit');
                $.post(base_url + 'publikasi/pilih_data/keluaran', {
                        id: id,
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Pilih Data');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                    });
            });
            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-edit');
                $.post(base_url + 'masterdata/edit/keluaran', {
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
                        $.post(base_url + 'masterdata/delete/keluaran', {
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

    setTimeout(function() {
        tbListU.columns.adjust().draw();
    }, 1000);
</script>


</body>

</html>