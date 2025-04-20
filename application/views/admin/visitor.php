<?php $this->load->view('partials/head-main') ?>
<?php
$cdata = array(
    'data' => [],
    'cat' => []
);
foreach ($props['top_data'] as $kp => $vp) {
    $cdata['data'][] = $vp['count'];
    $cdata['cat'][] = substr($vp['nama_indikator'], 0, 15) . (strlen($vp['nama_indikator']) > 15 ? '...' : '');
    if ($kp > 15) {
        break;
    }
}

$clogv = array(
    'data' => [],
    'cat' => []
);
foreach ($props['visitor_log'] as $kp => $vp) {
    $clogv['data'][] = $vp['count'];
    $clogv['cat'][] = date('Y-m-d H:i',strtotime('+7 hour',strtotime($vp['timestamp'])));
    if ($kp > 10) {
        break;
    }
}
?>

<head>

    <?php $this->load->view('partials/title-meta') ?>
    <link href="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <?php $this->load->view('partials/head-css') ?>

</head>

<?php $this->load->view('partials/body') ?>

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
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary shadow-primary card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <h3 class="mb-3 text-light">
                                            <?= $this->session->detail['nama_lengkap'] ?> <img class="rounded-circle header-profile-user" src="<?= base_url() ?>/assets/images/avatar-1.jpg" alt="Header Avatar">
                                        </h3>
                                        <div class="">
                                            <h5 class="mb-3 text-light">
                                                <?= $this->session->detail['nama_skpd'] ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Indikator</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart-indikator" data-colors='["#ffbf53", "#2ab57d", "#fd625e"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <!-- <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">2022-02-20 12:22:11</span>
                                </div> -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Data</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart-data" data-colors='["#ffbf53", "#2ab57d", "#fd625e"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <!-- <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">2022-02-20 12:22:11</span>
                                </div> -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col-->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Publikasi</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="">0</span>
                                        </h4>
                                    </div>
                                    <div class="col-6">
                                        <div id="mini-chart-publikasi" data-colors='["#2ab57d"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <!-- <div class="text-nowrap">
                                    <span class="badge bg-soft-success text-success">2022-02-20 12:22:11</span>
                                </div> -->
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div><!-- end row-->

                <div class="row">
                    <div class="col-xl-12">
                        <!-- card -->
                        <div class="card">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Visitor</h5>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-xl-8">
                                        <div>
                                            <div id="spline-visitor-count" data-colors='["#5156be", "#34c38f"]' class="apex-charts"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="p-4" data-simplebar style="max-height: 352px;">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <!-- card -->
                        <div class="card">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Data Terpopuler</h5>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-xl-8">
                                        <div>
                                            <div id="bar-top-data" data-colors='["#5156be", "#34c38f"]' class="apex-charts"></div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="p-4" data-simplebar style="max-height: 352px;">
                                            <?php foreach ($props['top_data'] as $kp => $vp) : ?>
                                                <div class="mt-0 mb-3">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm m-auto">
                                                            <span class="avatar-title rounded-circle bg-soft-light text-dark font-size-16">
                                                                <?= $kp + 1; ?>
                                                            </span>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <span class="font-size-16"><?= $vp['nama_indikator'] ?></span>
                                                            <p class="text-muted mb-0 font-size-12"><?= $vp['nama_skpd']; ?></p>
                                                        </div>

                                                        <div class="flex-shrink-0">
                                                            <a href="<?= base_url('front/data/') . createSlug(true, $vp['id_indikator'], $vp['nama_indikator']) ?>" class="btn btn-primary btn-sm" type="button" target="_blank">Dilihat (<?= $vp['count']; ?>)</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                </div>

                <div class="row d-none">
                    <div class="col-md-12 col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Indikator</h4>
                                <div class="flex-shrink-0">
                                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#indikator-all-tab" role="tab">
                                                Semua
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#indikator-ok-tab" role="tab">
                                                Terkonfirmasi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#indikator-belum-tab" role="tab">
                                                Belum Konfirmasi
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- end nav tabs -->
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body px-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="indikator-all-tab" role="tabpanel">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                            <table class="table align-middle table-nowrap table-borderless" style="width: 100%;">
                                                <tbody>
                                                    <?php foreach ($props['list_indikator'] as $kl => $vl) : ?>
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <?php if ($vl['status_konfirmasi'] == '') : ?>
                                                                    <div class="font-size-22 text-warning">
                                                                        <i class="bx bx-help-circle d-block"></i>
                                                                    </div>
                                                                <?php elseif ($vl['status_konfirmasi'] == '1') : ?>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bxs-check-circle d-block"></i>
                                                                    </div>
                                                                <?php elseif ($vl['status_konfirmasi'] == '2') : ?>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bxs-x-circle d-block"></i>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1"><?= substr($vl['nama_indikator'], 0, 40) . (strlen($vl['nama_indikator']) > 40 ? '...' : ''); ?></h5>
                                                                    <p class="text-muted mb-0 font-size-12"><?= $vl['nama_skpd']; ?></p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0"><?= $vl['nama_satuan']; ?></h5>
                                                                    <p class="text-muted mb-0 font-size-12"><?= $vl['timestamp']; ?></p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="indikator-ok-tab" role="tabpanel">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                            <table class="table align-middle table-nowrap table-borderless">
                                                <tbody>
                                                    <?php foreach ($props['list_indikator'] as $kl => $vl) : ?>
                                                        <?php if ($vl['status_konfirmasi'] == '1') : ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <?php if ($vl['status_konfirmasi'] == '') : ?>
                                                                        <div class="font-size-22 text-warning">
                                                                            <i class="bx bx-help-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_konfirmasi'] == '1') : ?>
                                                                        <div class="font-size-22 text-success">
                                                                            <i class="bx bxs-check-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_konfirmasi'] == '2') : ?>
                                                                        <div class="font-size-22 text-danger">
                                                                            <i class="bx bxs-x-circle d-block"></i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1"><?= substr($vl['nama_indikator'], 0, 40) . (strlen($vl['nama_indikator']) > 40 ? '...' : ''); ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= $vl['nama_skpd']; ?></p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0"><?= $vl['nama_satuan']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= $vl['timestamp']; ?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="indikator-belum-tab" role="tabpanel">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                            <table class="table align-middle table-nowrap table-borderless">
                                                <tbody>
                                                    <?php foreach ($props['list_indikator'] as $kl => $vl) : ?>
                                                        <?php if ($vl['status_konfirmasi'] == '') : ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <?php if ($vl['status_konfirmasi'] == '') : ?>
                                                                        <div class="font-size-22 text-warning">
                                                                            <i class="bx bx-help-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_konfirmasi'] == '1') : ?>
                                                                        <div class="font-size-22 text-success">
                                                                            <i class="bx bxs-check-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_konfirmasi'] == '2') : ?>
                                                                        <div class="font-size-22 text-danger">
                                                                            <i class="bx bxs-x-circle d-block"></i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1"><?= substr($vl['nama_indikator'], 0, 40) . (strlen($vl['nama_indikator']) > 40 ? '...' : ''); ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= $vl['nama_skpd']; ?></p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0"><?= $vl['nama_satuan']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= $vl['timestamp']; ?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Data</h4>
                                <div class="flex-shrink-0">
                                    <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#data-all-tab" role="tab">
                                                Semua
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#data-ok-tab" role="tab">
                                                Terverifikasi
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#data-belum-tab" role="tab">
                                                Belum Verifikasi
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- end nav tabs -->
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body px-0">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="data-all-tab" role="tabpanel">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                            <table class="table align-middle table-nowrap table-borderless" style="width: 100%;">
                                                <tbody>
                                                    <?php foreach ($props['list_data'] as $kl => $vl) : ?>
                                                        <tr>
                                                            <td style="width: 50px;">
                                                                <?php if ($vl['status_verifikasi'] == '') : ?>
                                                                    <div class="font-size-22 text-warning">
                                                                        <i class="bx bx-help-circle d-block"></i>
                                                                    </div>
                                                                <?php elseif ($vl['status_verifikasi'] == '1') : ?>
                                                                    <div class="font-size-22 text-success">
                                                                        <i class="bx bxs-check-circle d-block"></i>
                                                                    </div>
                                                                <?php elseif ($vl['status_verifikasi'] == '2') : ?>
                                                                    <div class="font-size-22 text-danger">
                                                                        <i class="bx bxs-x-circle d-block"></i>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </td>

                                                            <td>
                                                                <div>
                                                                    <h5 class="font-size-14 mb-1"><?= $vl['data_angka'] . ' ' . $vl['nama_satuan']; ?></h5>
                                                                    <p class="text-muted mb-0 font-size-12"><?= substr($vl['nama_indikator'], 0, 40) . (strlen($vl['nama_indikator']) > 40 ? '...' : '') . ' (' . $vl['tahun'] . ')'; ?></p>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="text-end">
                                                                    <h5 class="font-size-14 mb-0"><?= $vl['status_verifikasi'] == '2' ? $vl['keterangan'] : $vl['catatan']; ?></h5>
                                                                    <p class="text-muted mb-0 font-size-12"><?= $vl['timestamp']; ?></p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="data-ok-tab" role="tabpanel">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                            <table class="table align-middle table-nowrap table-borderless">
                                                <tbody>
                                                    <?php foreach ($props['list_data'] as $kl => $vl) : ?>
                                                        <?php if ($vl['status_verifikasi'] == '1') : ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <?php if ($vl['status_verifikasi'] == '') : ?>
                                                                        <div class="font-size-22 text-warning">
                                                                            <i class="bx bx-help-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_verifikasi'] == '1') : ?>
                                                                        <div class="font-size-22 text-success">
                                                                            <i class="bx bxs-check-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_verifikasi'] == '2') : ?>
                                                                        <div class="font-size-22 text-danger">
                                                                            <i class="bx bxs-x-circle d-block"></i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1"><?= $vl['data_angka'] . ' ' . $vl['nama_satuan']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= substr($vl['nama_indikator'], 0, 40) . (strlen($vl['nama_indikator']) > 40 ? '...' : '') . ' (' . $vl['tahun'] . ')'; ?></p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0"><?= $vl['status_verifikasi'] == '2' ? $vl['keterangan'] : $vl['catatan']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= $vl['timestamp']; ?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                    <div class="tab-pane" id="data-belum-tab" role="tabpanel">
                                        <div class="table-responsive px-3" data-simplebar style="max-height: 352px;">
                                            <table class="table align-middle table-nowrap table-borderless">
                                                <tbody>
                                                    <?php foreach ($props['list_data'] as $kl => $vl) : ?>
                                                        <?php if ($vl['status_verifikasi'] == '') : ?>
                                                            <tr>
                                                                <td style="width: 50px;">
                                                                    <?php if ($vl['status_verifikasi'] == '') : ?>
                                                                        <div class="font-size-22 text-warning">
                                                                            <i class="bx bx-help-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_verifikasi'] == '1') : ?>
                                                                        <div class="font-size-22 text-success">
                                                                            <i class="bx bxs-check-circle d-block"></i>
                                                                        </div>
                                                                    <?php elseif ($vl['status_verifikasi'] == '2') : ?>
                                                                        <div class="font-size-22 text-danger">
                                                                            <i class="bx bxs-x-circle d-block"></i>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </td>

                                                                <td>
                                                                    <div>
                                                                        <h5 class="font-size-14 mb-1"><?= $vl['data_angka'] . ' ' . $vl['nama_satuan']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= substr($vl['nama_indikator'], 0, 40) . (strlen($vl['nama_indikator']) > 40 ? '...' : '') . ' (' . $vl['tahun'] . ')'; ?></p>
                                                                    </div>
                                                                </td>

                                                                <td>
                                                                    <div class="text-end">
                                                                        <h5 class="font-size-14 mb-0"><?= $vl['status_verifikasi'] == '2' ? $vl['keterangan'] : $vl['catatan']; ?></h5>
                                                                        <p class="text-muted mb-0 font-size-12"><?= $vl['timestamp']; ?></p>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end tab pane -->
                                </div>
                                <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-xl-5">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <h5 class="card-title me-2">Progres Konfirmasi</h5>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-sm">
                                        <div id="pie-indikator" data-colors='["#777aca", "#5156be", "#a8aada"]' class="apex-charts"></div>
                                    </div>
                                    <div class="col-sm align-self-center">
                                        <div class="mt-4 mt-sm-0">

                                            <div class="mt-4 pt-2">
                                                <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-primary"></i> Terkonfirmasi</p>
                                                <h6><?= $props['stats_indikator']['konfirmasi_sudah']; ?></h6>
                                            </div>

                                            <div class="mt-4 pt-2">
                                                <p class="mb-2"><i class="mdi mdi-circle align-middle font-size-10 me-2 text-info"></i> Belum Konfirmasi</p>
                                                <h6><?= $props['stats_indikator']['konfirmasi_belum']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?php $this->load->view('partials/footer') ?>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?php $this->load->view('partials/right-sidebar') ?>

<?php $this->load->view('partials/vendor-scripts') ?>

<!-- apexcharts -->
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<!-- <script src="<?= base_url() ?>/assets/js/pages/dashboard.init.js"></script> -->

<!-- App js -->
<script src="<?= base_url() ?>/assets/js/app.js"></script>
</body>
<script>
    function getChartColorsArray(chartId) {
        var colors = $(chartId).attr('data-colors');
        var colors = JSON.parse(colors);
        return colors.map(function(value) {
            var newValue = value.replace(' ', '');
            if (newValue.indexOf('--') != -1) {
                var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
                if (color) return color;
            } else {
                return newValue;
            }
        })
    }
    var barchartColors = getChartColorsArray("#bar-top-data");
    var options = {
        series: [{
            name: 'Progres',
            data: <?= json_encode($cdata['data']) ?>
        }],
        chart: {
            type: 'bar',
            height: 400,
            stacked: true,
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            bar: {
                columnWidth: '70%',
            },
        },
        colors: barchartColors,
        fill: {
            opacity: 1
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            show: false,
        },
        yaxis: {
            // max: 100,
            labels: {
                formatter: function(y) {
                    return y.toFixed(0) + "x";
                }
            }
        },
        xaxis: {
            categories: <?= json_encode($cdata['cat']) ?>,
            labels: {
                rotate: -45
            }
        }
    };
    
    var chart = new ApexCharts(document.querySelector("#bar-top-data"), options);
    chart.render();
    
    // spline area
    var splneAreaColors = getChartColorsArray("#spline-visitor-count");
    var options = {
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false,
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3,
        },
        series: [{
            name: 'Hit',
            data: <?= json_encode($clogv['data']) ?>
        }],
        colors: splneAreaColors,
        xaxis: {
            type: 'datetime',
            categories: <?= json_encode($clogv['cat']) ?>,
            // categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00", "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00", "2018-09-19T10:30:00"],
        },
        grid: {
            borderColor: '#f1f1f1',
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        }
    }

    var chart = new ApexCharts(
        document.querySelector("#spline-visitor-count"),
        options
    );

    chart.render();
</script>

</html>