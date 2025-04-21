<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
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
                                        <h4 class="card-title">Daftar <?= $title ?></h4>
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
                                        <?php foreach ($datas as $key => $data) : ?>
                                            <tr>
                                                <td><?= $key + 1; ?></td>
                                                <td><?= $data['data_id']; ?></td>
                                                <td><?= $data['data_year']; ?></td>
                                                <td>
                                                    <?= $data['data_name'] . "<br/>" . $data['view_label']; ?>
                                                </td>
                                                <!-- <td></td> -->
                                            </tr>
                                        <?php endforeach ?>
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
                <h5 class="modal-title">Tambah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-l2">
                    <div>

                        <?= form_open('', [
                            'name'    => 'form-edit',
                            'class'   => '',
                            'id'      => 'form-edit',
                            'method'  => 'POST'
                        ]); ?>
                        <div class="mb-3">
                            <label class="form-label" for="nama_skpd">Tahun</label>
                            <select class="form-control select2" name="data_year" id="data_year" style="width: 100%;" required>
                                <option value="" disabled selected>Pilih Tahun</option>
                                <?php foreach ($years as $datas => $data) : ?>
                                    <option value="<?= $data['data_year'] ?>" ?><?= $data['data_year'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                        <?= form_close(); ?>
                    </div>
                </div>

            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
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

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script>
    var dt_table = $('#tb_data').DataTable({
        "pageLength": 10,
        "columns": [{
                "width": "5%"
            },
            {
                "width": "10%"
            },
            {
                "width": "10%"
            },
            {
                "width": "75%"
            }
        ]
    });

    $('.select2').select2({
        dropdownParent: $('#modal-edit')
    });

    $('#btn-tambah').on('click', function(e) {
        e.preventDefault();
        var modal = $('#modal-edit');
        modal.modal('show');
    });

    $('#form-edit').on('submit', function(e) {
        // alert("sss");
        e.preventDefault();
        $.ajax({
            url: base_url + 'geoportal/views/submit',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                // data = $.parseJSON(data);
                console.log(data);
                if (data.status == 'success') {
                    $('#modal-edit').modal('hide');
                    // $('#tb_data').DataTable().ajax.reload(null, false);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message
                    });
                    location.reload(true);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Berhasil',
                        text: data.message
                    });
                }
            }
        });
    });
</script>

</body>

</html>