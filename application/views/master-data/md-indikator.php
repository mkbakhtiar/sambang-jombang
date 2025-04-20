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
                            <h4 class="card-title"><?= $title ?></h4>
                                <p class="card-title-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora optio, assumenda quis dolores doloremque earum maxime sapiente quos mollitia commodi cumque repellat perspiciatis? Voluptatum reprehenderit ab sapiente numquam. Et, exercitationem.
                                </p>
                            </div>
                            <div class="card-body">

                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Indikator</th>
                                            <th>Definisi Operasional</th>
                                            <th>Satuan</th>
                                            <th>Sumber Data</th>
                                            <th>Cara Pengambilan Data</th>
                                            <th>Keluaran</th>
                                            <th>SKPD</th>
                                            <th>Penanggung Jawab Program</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Nama Indikator</td>
                                            <td>Definisi Operasional</td>
                                            <td>Satuan</td>
                                            <td>Sumber Data</td>
                                            <td>Cara Pengambilan Data</td>
                                            <td>Keluaran</td>
                                            <td>SKPD</td>
                                            <td>Penanggung Jawab Program</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Nama Indikator</td>
                                            <td>Definisi Operasional</td>
                                            <td>Satuan</td>
                                            <td>Sumber Data</td>
                                            <td>Cara Pengambilan Data</td>
                                            <td>Keluaran</td>
                                            <td>SKPD</td>
                                            <td>Penanggung Jawab Program</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Nama Indikator</td>
                                            <td>Definisi Operasional</td>
                                            <td>Satuan</td>
                                            <td>Sumber Data</td>
                                            <td>Cara Pengambilan Data</td>
                                            <td>Keluaran</td>
                                            <td>SKPD</td>
                                            <td>Penanggung Jawab Program</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Nama Indikator</td>
                                            <td>Definisi Operasional</td>
                                            <td>Satuan</td>
                                            <td>Sumber Data</td>
                                            <td>Cara Pengambilan Data</td>
                                            <td>Keluaran</td>
                                            <td>SKPD</td>
                                            <td>Penanggung Jawab Program</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Nama Indikator</td>
                                            <td>Definisi Operasional</td>
                                            <td>Satuan</td>
                                            <td>Sumber Data</td>
                                            <td>Cara Pengambilan Data</td>
                                            <td>Keluaran</td>
                                            <td>SKPD</td>
                                            <td>Penanggung Jawab Program</td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button type="button" class="btn btn-sm btn-warning">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
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

</body>

</html>