<?php $this->load->view('front/partials/header'); ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css" />

</head>


<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">


    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <main id="main">
        <div class="breadcrumbs">
            <div class="page-header d-flex align-items-center"
                style="background-image: url('<?= base_url('assets/front') ?>/img/hero-img.svg')">
                <div class="container position-relative">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-6 text-center">
                        </div>
                    </div>
                </div>
            </div>
            <nav>
                <div class="container">
                    <ol>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li>Request Data</li>
                    </ol>
                </div>
            </nav>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="section-header">
                        <span>FORM REQUEST DATA </span>
                        <h2>FORM REQUEST DATA</h2>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-sm-12 col-lg-8">
                                <?= form_open('', [
                                    'name' => 'form-edit',
                                    'class' => '',
                                    'id' => 'form-edit',
                                    'method' => 'POST'
                                ]); ?>
                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nama" name="nama" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <!-- Email Input -->
                                    <div class="col-sm-6">
                                        <label for="email" class="col-form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <!-- Telepon Input -->
                                    <div class="col-sm-6">
                                        <label for="telepon" class="col-form-label">Telepon</label>
                                        <input type="tel" class="form-control" id="telepon" name="telepon" required>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-sm-6">
                                        <label for="asal" class="col-sm-3 col-form-label">Pilih
                                            Asal</label>
                                        <div class="col">
                                            <select class="form-control select2" name="asal" id="asal"
                                                style="width: 100%;" required>
                                                <option value="" disabled selected>Pilih Asal</option>
                                                <option value="Instansi">Instansi</option>
                                                <option value="Masyarakat">Masyarakat</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="row mb-4" id="formInstansi" style="display: none;">
                                            <label for="nama_instansi" class="col-sm-6 col-form-label">Nama Instansi
                                            </label>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" id="nama_instansi"
                                                    name="nama_instansi">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="kebutuhan_data" class="col-sm-3 col-form-label">Data
                                        yang diperlukan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="kebutuhan_data" name="kebutuhan_data"
                                            rows="4" required></textarea>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="keperluan" class="col-sm-3 col-form-label">Definisi
                                        Keperluan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="keperluan" name="keperluan" rows="4"
                                            required></textarea>
                                    </div>
                                </div>


                                <!-- <div class="row mb-4">
                                                    <label for="nama_indikator" class="col-sm-3 col-form-label">Nama
                                                        Indikator</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="nama_indikator"
                                                            name="nama_indikator" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="definisi_operasional"
                                                        class="col-sm-3 col-form-label">Definisi
                                                        Operasional</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control"
                                                            id="definisi_operasional" name="definisi_operasional" x
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="id_satuan"
                                                        class="col-sm-3 col-form-label">Satuan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="id_satuan"
                                                            id="id_satuan" style="width: 100%;" required>
                                                            <option value="" disabled selected>Pilih Satuan
                                                            </option>
                                                            <option>Satuan bebassss</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="id_akses" class="col-sm-3 col-form-label">Akses</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="id_akses"
                                                            id="id_akses" style="width: 100%;" required>
                                                            <option value="" disabled selected>Pilih Akses
                                                            </option>

                                                            <option>Akses Terbuka</option>
                                                            <option>Akses Tertutup</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="id_periodik"
                                                        class="col-sm-3 col-form-label">Periodik</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="id_periodik"
                                                            id="id_periodik" style="width: 100%;">
                                                            <option value="" disabled selected>Pilih Periodik
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div> -->

                                <div class="row">
                                    <div class="col-sm-12 text-end">
                                        <button type="submit" class="btn btn-primary w-md">Simpan</button>
                                    </div>
                                    <?php form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- end col -->
        </div> <!-- end row -->


</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


<?php $this->load->view('front/partials/footer'); ?>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>

<!-- Required datatable js -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Datatable init js -->

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<script>
    $('#asal').on('change', function () {
        if (this.value === 'Instansi') {
            $('#formInstansi').show();  // Tampilkan form instansi
            $('#nama_instansi').attr('required', true); // Jadikan wajib
        } else {
            $('#formInstansi').hide();  // Sembunyikan form instansi
            $('#nama_instansi').removeAttr('required'); // Tidak wajib jika bukan instansi
        }
    });

</script>

<script>
    $(document).on('select2:open', () => {
        document.querySelector('.select2-search__field').focus();
    });
    // var dt_table = $('#tb_sub').DataTable({});
    $('.select2').select2({
        theme: 'bootstrap4'
    });
    $('.select2-multiple').select2({
        // theme: 'bootstrap4'
    });

    $('#id_satuan').select2({
        tags: true,
        theme: 'bootstrap4'
    });


    $('#form-edit').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'request_data/save',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () { },
            success: function (data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil'
                    }).then((result) => {
                        if (result.isConfirmed) { // Use isConfirmed for SweetAlert2
                            // Reload the base URL
                            window.location.href = base_url; // Redirect to base URL
                        }
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Berhasil',
                        text: 'Tidak Berhasil'
                    });
                }
            }
        });
    });



</script>

</body>

</html>