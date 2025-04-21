<?php $this->load->view('partials/head-main') ?>

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
                                <h5>Indikator</h5>
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
                                        <?php if ($edit): ?>
                                            <input type="hidden" id="id_indikator" name="id_indikator"
                                                value="<?= $props['ind_data']['id_indikator'] ?>" required>
                                        <?php endif; ?>
                                        <div class="row mb-4">
                                            <label for="nama_indikator" class="col-sm-3 col-form-label">Nama
                                                Indikator</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nama_indikator"
                                                    name="nama_indikator"
                                                    value="<?= $edit ? $props['ind_data']['nama_indikator'] : null ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="definisi_operasional" class="col-sm-3 col-form-label">Definisi
                                                Operasional</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="definisi_operasional"
                                                    name="definisi_operasional"
                                                    value="<?= $edit ? $props['ind_data']['definisi_operasional'] : null ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="id_satuan" class="col-sm-3 col-form-label">Satuan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="id_satuan" id="id_satuan"
                                                    style="width: 100%;" required>
                                                    <option value="" disabled selected>Pilih Satuan</option>
                                                    <?php foreach ($props['satuan'] as $ks => $vk): ?>
                                                        <option value="<?= $vk['id_satuan'] ?>" <?= $edit ? ($vk['id_satuan'] == $props['ind_data']['id_satuan'] ? 'selected' : '') : '' ?>><?= $vk['nama_satuan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="id_akses" class="col-sm-3 col-form-label">Akses</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="id_akses" id="id_akses"
                                                    style="width: 100%;" required>
                                                    <option value="" disabled selected>Pilih Akses</option>
                                                    <?php foreach ($props['akses'] as $ks => $vk): ?>
                                                        <option value="<?= $vk['id_akses'] ?>" <?= $edit ? ($vk['id_akses'] == $props['ind_data']['id_akses'] ? 'selected' : '') : '' ?>><?= $vk['nama_akses'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="id_periodik" class="col-sm-3 col-form-label">Periodik</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="id_periodik" id="id_periodik"
                                                    style="width: 100%;" required>
                                                    <option value="" disabled selected>Pilih Periodik</option>
                                                    <?php foreach ($props['periodik'] as $ks => $vk): ?>
                                                        <option value="<?= $vk['id_periodik'] ?>" <?= $edit ? ($vk['id_periodik'] == $props['ind_data']['id_periodik'] ? 'selected' : '') : '' ?>><?= $vk['nama_periodik'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="id_keluaran" class="col-sm-3 col-form-label">Keluaran</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-multiple" name="id_keluaran[]"
                                                    id="id_keluaran" style="width: 100%;" multiple>
                                                    <option value="" disabled>Pilih Keluaran</option>
                                                    <?php foreach ($props['keluaran'] as $ks => $vk): ?>
                                                        <option value="<?= $vk['id_keluaran'] ?>" <?= $edit ? ((in_array($vk['id_keluaran'], $props['keluaran_selected'])) ? 'selected' : '') : '' ?>><?= $vk['nama_keluaran'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <label for="id_urusan" class="col-sm-3 col-form-label">Urusan</label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2-multiple" name="id_urusan[]"
                                                    id="id_urusan" style="width: 100%;" multiple>
                                                    <option value="" disabled>Pilih Urusan</option>
                                                    <?php foreach ($props['urusan'] as $ks => $vk): ?>
                                                        <option value="<?= $vk['id_urusan'] ?>" <?= $edit ? ((in_array($vk['id_urusan'], $props['urusan_selected'])) ? 'selected' : '') : '' ?>><?= $vk['nama_urusan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <?php if ($this->session->detail['id_role'] == '1'): ?>
                                            <div class="row mb-4">
                                                <label for="id_skpd" class="col-sm-3 col-form-label">OPD</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2" name="id_skpd" id="id_skpd"
                                                        style="width: 100%;" required>
                                                        <option value="" disabled selected>Pilih SKPD</option>
                                                        <?php foreach ($props['skpd'] as $ks => $vk): ?>
                                                            <option value="<?= $vk['id_skpd'] ?>" <?= $edit ? ($vk['id_skpd'] == $props['ind_data']['id_skpd'] ? 'selected' : '') : '' ?>><?= $vk['nama_skpd'] ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php elseif ($this->session->detail['id_role'] == '3'): ?>
                                            <div class="row mb-4">
                                                <label for="id_skpd" class="col-sm-3 col-form-label">OPD</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select2" name="id_skpd" id="id_skpd"
                                                        style="width: 100%;" required>
                                                        <option value="<?= $this->session->detail['id_skpd'] ?>"
                                                            selected=""><?= $this->session->detail['nama_skpd'] ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <hr class="mb-4">

                                        <?php foreach ($props['metadata_cols'] as $kmc => $vmc): ?>
                                            <div class="row mb-4">
                                                <label for="<?= $vmc['key_metadata'] ?>"
                                                    class="col-sm-3 col-form-label"><?= $vmc['nama_metadata'] ?> <span
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-custom-class="custom-tooltip"
                                                        data-bs-title="<?= $vmc['keterangan'] ?>"><i
                                                            class=" fas fa-info-circle"></i></span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="<?= $vmc['key_metadata'] ?>"
                                                        name="<?= $vmc['key_metadata'] ?>"
                                                        value="<?= $edit ? $props['ind_data'][$vmc['key_metadata']] : null ?>">
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                        <div class="row justify-content-end">
                                            <div class="col-sm-9">
                                                <div>
                                                    <button type="submit" class="btn btn-primary w-md">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                        <?php form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($edit): ?>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-10">
                                            <h5>Sub Indikator</h5>
                                        </div>
                                        <div class="col-sm-12 col-md-2 d-flex align-items-center justify-content-center">
                                            <button class="btn btn-sm btn-primary" id="btn-tambah-sub" type="button"><i
                                                    class="bx bxs-plus-square font-size-16 align-middle me-2"></i>
                                                Tambah</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="tb_sub" class="table table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Sub Indikator</th>
                                                <th>Definisi Operasional</th>
                                                <th>Satuan</th>
                                                <th>Sub Indikator</th>
                                                <th>Konfirmasi</th>
                                                <th style="width: 10%;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
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

<!-- Datatable init js -->
<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

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
            url: base_url + 'indikator/save',
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
                        if (result.value) {
                            window.open(base_url + 'indikator/add/' + data.inserted_id, '_self');
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

    <?php if ($edit): ?>
        const id_indikator = '<?= $props['ind_data']['id_indikator'] ?>';
        const type = '<?= $edit ? 'edit' : 'add' ?>';
        var tb_sub = $('#tb_sub').DataTable({
            "pageLength": 100,
            "serverSide": true,
            "ajax": {
                url: base_url + 'indikator/get_subind_list/' + id_indikator,
                type: 'POST'
            },
            // dom: '',
            scrollX: true,
            drawCallback: function () {
                $('.btn-sub-detail').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var modal = $('#modal-detail');
                    $.post(base_url + 'indikator/get_indikator_detail', {
                        id: id,
                    })
                        .done(function (data) {
                            modal.find('.modal-title').html('Detail Indikator');
                            modal.find('.modal-body').html(data);
                            modal.modal('show');
                        });
                });
                $('.btn-detail').on('click', function (e) {
                    e.preventDefault();
                    var modal = $('#modal-detail');
                    var id = $(this).data('id');
                    var detaildiv = modal.find('#detail-list');
                    detaildiv.html('');
                    modal.modal('show');
                    $.post(base_url + 'masterdata/get_detail/' + type, {
                        id: id,
                    })
                        .done(function (data) {
                            $.each(data, function (key, value) {
                                $(detaildiv).append('<li class="list-group-item">' + key + ' : ' + value + '</li>');
                            });
                            console.log(data);

                        });
                });
                $('.btn-confirm').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var modal = $('#modal-konfirmasi');
                    $.post(base_url + 'indikator/indikator_konfirmasi', {
                        id: id,
                    })
                        .done(function (data) {
                            modal.find('.modal-title').html('Konfirmasi');
                            modal.find('.modal-body').html(data);
                            modal.modal('show');
                        });
                });
                $('.btn-edit').on('click', function (e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    var mainid = $(this).data('main-id');
                    var modal = $('#modal-edit');
                    $.post(base_url + 'indikator/sub_edit/' + type, {
                        id: id,
                        mainid: mainid,
                        act: 'edit'
                    })
                        .done(function (data) {
                            modal.find('.modal-title').html('Edit');
                            modal.find('.modal-body').html(data);
                            modal.modal('show');
                        });
                });
                $('.btn-delete').on('click', function (e) {
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
                            $.post(base_url + 'indikator/delete', {
                                id: id
                            }).done(function (data) {
                                if (data.status == 'success') {
                                    $('#tb_sub').DataTable().ajax.reload(null, false);

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

        $('#btn-tambah-sub').on('click', function (e) {
            e.preventDefault();
            var modal = $('#modal-edit');
            var mainid = '<?= $enc_id ?>';
            $.post(base_url + 'indikator/sub_edit/' + type, {
                mainid: mainid,
                act: 'add'
            })
                .done(function (data) {
                    modal.find('.modal-title').html('Tambah');
                    modal.find('.modal-body').html(data);
                    modal.modal('show');
                });
        })
    <?php endif; ?>
    function update_stats() {
        $.ajax(base_url + 'indikator/get_rekap_konfirmasi/<?= $this->session->admin || $this->session->admin2 ? $this->uri->segment(3) : $this->session->detail['id_skpd'] ?>')
            .done(function (data) {
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
</script>

</body>

</html>