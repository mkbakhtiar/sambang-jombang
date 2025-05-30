<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h4 class="card-title"><?= $title ?></h4>
                                        <p class="card-title-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora optio, assumenda quis dolores doloremque earum maxime sapiente quos mollitia commodi cumque repellat perspiciatis? Voluptatum reprehenderit ab sapiente numquam. Et, exercitationem.
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

                                <table id="tb_data_skpd" class="table table-bordered display nowrap" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama SKPD</th>
                                            <th>Alamat</th>
                                            <th>No Telp</th>
                                            <th>Website</th>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <ul class="list-group" id="detail-list">
                    </ul>
                </div>
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

<!-- Datatable init js -->
<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script>
    var dt_table = $('#tb_data_skpd').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "ajax": {
            url: base_url + 'masterdata/get_data',
            type: 'POST'
        },
        scrollX: true,
        drawCallback: function() {
            $('.btn-detail').on('click', function(e) {
                e.preventDefault();
                var modal = $('#modal-detail');
                var id = $(this).data('id');
                var detaildiv = modal.find('#detail-list');
                detaildiv.html('');
                modal.modal('show');
                $.post(base_url + 'masterdata/get_detail/skpd', {
                        id: id,
                    })
                    .done(function(data) {
                        $.each(data, function(key, value) {
                            $(detaildiv).append('<li class="list-group-item">' + key + ' : ' + value + '</li>');
                        });
                        console.log(data);

                    });
            });
            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var modal = $('#modal-edit');
                $.post(base_url + 'masterdata/edit/skpd', {
                        id: id,
                        act: 'edit'
                    })
                    .done(function(data) {
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
                        $.post(base_url + 'masterdata/delete/skpd', {
                            id: id
                        }).done(function(data) {
                            if (data.status == 'success') {
                                $('#tb_data_skpd').DataTable().ajax.reload(null, false);

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
        $.post(base_url + 'masterdata/edit/skpd', {
                // id: id,
                act: 'add'
            })
            .done(function(data) {
                modal.find('.modal-body').html(data);
                modal.modal('show');
            });
    })
</script>

</body>

</html>