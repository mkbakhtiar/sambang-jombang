<?php $this->load->view('front/partials/header'); ?>

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
</script>
    <!-- MDB -->
    <link rel="stylesheet" href="<?= base_url('assets/front') ?>/css/mdb.min.css" />

<link href="<?= base_url('assets/front') ?>/css/tab-style.css" rel="stylesheet" />
<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />



</head>
<script>
    import { Ripple, initMDB } from "mdb-ui-kit";

initMDB({ Ripple });
</script>
<style>
   #tb_metadata thead {
        display: none;
    }
</style>

<main id="main">
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('<?= base_url('assets/front') ?>/img/hero-img.svg')">
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
                    <li>Data</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="about" class="about">
    <div class="container" data-aos="fade-up">
            <div class="col-lg-6 content order-first order-lg-first">
                <h3><?= $props['ind_data']['nama_indikator']; ?></h3>
            </div>
        <!-- </div> --> 
            <div class="tabset">
                <!-- Tab 1 -->
                <input type="radio" name="tabset" id="tab1" aria-controls="tabel" checked>
                <label for="tab1">Tabel</label>
                <!-- Tab 2 -->
                <input type="radio" name="tabset" id="tab2" aria-controls="metadata">
                <label for="tab2">Metadata</label>
                <div class="tab-panels">
                    <section id="tabel" class="tab-panel">
                    <!-- <p>1</p> -->
                <div class="container" data-aos="fade-up">
                    </div>
                        <div class="row">
                            <div class="card-body" id="sub-container">
                                <div class="table-responsive">
                                    <table id="tb_sub" class="table table-bordered table-hover" style="width: 100%;">
                                        <div class="d-flex mb-4 justify-content-start">
                                            <div class="d-flex align-items-center me-3">
                                                <button class="btn btn-xs btn-danger" style="width: 15px; height: 15px; padding: 0; margin-right: 5px;">&nbsp;</button>
                                                <span>Sangat Sementara</span>
                                            </div>
                                            <div class="d-flex align-items-center me-3">
                                                <button class="btn btn-xs btn-warning" style="width: 15px; height: 15px; padding: 0; margin-right: 5px;">&nbsp;</button>
                                                <span>Sementara</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-xs btn-success" style="width: 15px; height: 15px; padding: 0; margin-right: 5px;">&nbsp;</button>
                                                <span>Final</span>
                                            </div>
                                        </div>
                                        <thead class="bg-dark text-light">
                                            <tr class="table-secondary text-center align-middle">
                                                <th rowspan="2">#</th>
                                                <th rowspan="2">Nama Indikator</th>
                                                <th colspan="<?= count($props['tahun']) ?>">Tahun</th>
                                                <th rowspan="2">Satuan</th>
                                                <th rowspan="2">Sumber Data</th>
                                            </tr>
                                            <tr class="table-secondary text-center align-middle">
                                                <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                                    <th><?= $vt['nama_tahun']; ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="align-middle">
                                                <td>1.</td>
                                                <td style="width: 30%;"><?= $props['ind_data']['nama_indikator']; ?></td>
                                                <?php foreach ($props['ind_data']['data'] as $kd => $vd) : ?>
                                                    <td class="text-center">
                                                        <?php
                                                        $status_data = '';
                                                        switch ($vd['status_data']) {
                                                            case 'sangat_sementara':
                                                                $status_data = '<button class="btn btn-xs btn-danger" style="width: 15px; height: 15px; padding: 0;">&nbsp;</button>';
                                                                break;
                                                            case 'sementara':
                                                                $status_data = '<button class="btn btn-xs btn-warning" style="width: 15px; height: 15px; padding: 0;">&nbsp;</button>';
                                                                break;
                                                            case 'final':
                                                                $status_data = '<button class="btn btn-xs btn-success" style="width: 15px; height: 15px; padding: 0;">&nbsp;</button>';
                                                                break;
                                                        }
                                                        echo $status_data;
                                                        ?>
                                                        <br>
                                                        <?= convert_number($vd['data_angka']); ?>
                                                    </td>
                                                <?php endforeach; ?>
                                                <td><?= $props['ind_data']['nama_satuan']; ?></td>
                                                <td><?= $props['ind_data']['nama_skpd']; ?></td>
                                            </tr>
                                            <?php foreach ($props['sub_data']['subs'] as $ks => $vs) : ?>
                                                <tr>
                                                    <td>1.<?= strval($ks + 1) ?>.</td>
                                                    <td style="width: 30%;"><?= $vs['nama_indikator'] ?></td>
                                                    <?php foreach ($vs['data'] as $ksd => $vsd) : ?>
                                                        <td class="text-center">
                                                            <?php
                                                            $status_data = '';
                                                            switch ($vsd['status_data']) {
                                                                case 'sangat_sementara':
                                                                    $status_data = '<button class="btn btn-xs btn-danger" style="width: 15px; height: 15px; padding: 0;">&nbsp;</button>';
                                                                    break;
                                                                case 'sementara':
                                                                    $status_data = '<button class="btn btn-xs btn-warning" style="width: 15px; height: 15px; padding: 0;">&nbsp;</button>';
                                                                    break;
                                                                case 'final':
                                                                    $status_data = '<button class="btn btn-xs btn-success" style="width: 15px; height: 15px; padding: 0;">&nbsp;</button>';
                                                                    break;
                                                            }
                                                            echo $status_data;
                                                            ?>
                                                            <br>
                                                            <?= convert_number($vsd['data_angka']); ?>
                                                        </td>
                                                    <?php endforeach; ?>
                                                    <td><?= $vs['nama_satuan']; ?></td>
                                                    <td></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>
                        <section id="metadata" class="tab-panel">
                        <div class="container" data-aos="fade-up">
                            </div>
                                <div class="row">
                                    <div class="card-body" id="sub-container">
                                    <div class="col-lg-12 content order-first order-lg-first">
                                        <div class="row">
                                            <div class="col">
                                                <!-- Change the list to a table -->
                                                <table id="tb_metadata" class="table" style="width: 100%;">
                                                    <thead class="bg-dark text-light">
                                                        <tr class="text-center align-middle">
                                                            <th>Isi</th>
                                                            <th>Deskripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr data-aos="fade-up" data-aos-delay="100">
                                                            <td>Kode</td>
                                                            <td><?= $props['ind_data']['id_indikator']; ?></td>
                                                        </tr>
                                                        <tr data-aos="fade-up" data-aos-delay="100">
                                                            <td>Nama</td>
                                                            <td><?= $props['ind_data']['nama_indikator']; ?></td>
                                                        </tr>
                                                        <tr data-aos="fade-up" data-aos-delay="100">
                                                            <td>Definisi</td>
                                                            <td><?= $props['ind_data']['definisi_operasional']; ?></td>
                                                        </tr>
                                                        <tr data-aos="fade-up" data-aos-delay="100">
                                                            <td>Produsen Data</td>
                                                            <td><?= $props['ind_data']['nama_skpd']; ?></td>
                                                        </tr>
                                                        <tr data-aos="fade-up" data-aos-delay="200">
                                                            <td>Satuan</td>
                                                            <td><?= $props['ind_data']['nama_satuan']; ?></td>
                                                        </tr>
                                                        <tr data-aos="fade-up" data-aos-delay="300">
                                                            <td>Urusan</td>
                                                            <td>
                                                                <?php
                                                                $tmp = [];
                                                                foreach ($props['ind_data']['urusan'] as $ku => $vu) {
                                                                    $tmp[] = $vu['nama_urusan'];
                                                                }
                                                                echo implode(', ', $tmp);
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <!-- Loop through metadata -->
                                                        <?php foreach ($props['ind_data']['metadata'] as $km => $vm) : ?>
                                                            <?php if ($vm['value'] != null) : ?>
                                                                <tr data-aos="fade-up" data-aos-delay="400">
                                                                    <td><?= $vm['nama_metadata']; ?></td>
                                                                    <td><?= $vm['value']; ?></td>
                                                                </tr>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                  

                                        
                        </section>
                    
            
                </div>
        </div>
        </div>
        </div>
                

</main>

<div id="modal-graph" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Grafik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container pt-4">
                    <div class="row mt-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="card shadow shadow-sm">
                            <div class="card-body">
                                <div id="chart-sub-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view('front/partials/footer'); ?>
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

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
    // Persiapkan data untuk grafik
    <?php
    // Persiapkan data tahun untuk label
    $tahunLabels = [];
    foreach ($props['tahun'] as $kt => $vt) {
        $tahunLabels[] = $vt['nama_tahun'];
    }
    
    // Persiapkan data utama
    $mainData = [];
    foreach ($props['ind_data']['data'] as $kd => $vd) {
        $mainData[] = floatval($vd['data_angka']);
    }
    
    // Persiapkan data sub indikator jika ada
    $csubdata = [];
    if (!empty($props['sub_data']['subs'])) {
        foreach ($props['sub_data']['subs'] as $ks => $vs) {
            $tmp = ['name' => $vs['nama_indikator'], 'data' => []];
            foreach ($vs['data'] as $ksd => $vsd) {
                $tmp['data'][] = floatval($vsd['data_angka']);
            }
            $csubdata[] = $tmp;
        }
    }
    ?>

    var options = {
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                borderRadius: 10,
                dataLabels: {
                    position: 'top', // top, center, bottom
                },
            }
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val;
            },
            offsetY: -22,
            style: {
                fontSize: '12px',
                colors: ["#304758"]
            }
        },
        series: [{
            name: '<?= $props['ind_data']['nama_indikator']; ?>',
            data: <?= json_encode($mainData); ?>
        }],
        grid: {
            borderColor: '#f1f1f1',
        },
        xaxis: {
            categories: <?= json_encode($tahunLabels); ?>,
            position: 'bottom',
            labels: {
                offsetY: 18,
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            crosshairs: {
                fill: {
                    type: 'gradient',
                    gradient: {
                        colorFrom: '#D8E3F0',
                        colorTo: '#BED1E6',
                        stops: [0, 100],
                        opacityFrom: 0.4,
                        opacityTo: 0.5,
                    }
                }
            },
            tooltip: {
                enabled: true,
                offsetY: -35,
            }
        },
        yaxis: {
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false,
            },
            labels: {
                show: false,
                formatter: function(val) {
                    return val + " <?= $props['ind_data']['nama_satuan'] ?>";
                }
            }
        }
    };

    var chart = new ApexCharts(
        document.querySelector("#chart-container"),
        options
    );

    chart.render();

    // Menampilkan grafik berdasarkan kondisi sub data
    <?php if ($props['sub_data']['count'] != '0') : ?>
        // Jika ada sub data, tampilkan grafik sub data
        var optionsSub = {
            series: <?= json_encode($csubdata); ?>,
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: <?= json_encode($tahunLabels); ?>,
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " <?= $props['ind_data']['nama_satuan'] ?>";
                    }
                }
            }
        };

        var chartSub = new ApexCharts(document.querySelector("#chart-sub-container"), optionsSub);
        chartSub.render();
    <?php else : ?>
        // Jika tidak ada sub data, tampilkan grafik data utama
        var optionsMain = {
            series: [{
                name: '<?= $props['ind_data']['nama_indikator']; ?>',
                data: <?= json_encode($mainData); ?>
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: <?= json_encode($tahunLabels); ?>,
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + " <?= $props['ind_data']['nama_satuan'] ?>";
                    }
                }
            }
        };

        var chartMain = new ApexCharts(document.querySelector("#chart-sub-container"), optionsMain);
        chartMain.render();
    <?php endif; ?>
</script>
<script>
     $(document).ready(function () {
    var tb_metadata = $('#tb_metadata').DataTable({
        "pageLength": 10,
        buttons: [
            {
                extend: 'pdfHtml5',
                className: 'buttons-pdf-metadata',
                text: 'Metadata'
            },
        ],
        dom: "<'row '<'col-md-7'B>>",
        scrollX: false,
        autoWidth: false,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"]
        ],
        initComplete: function () {
            var buttonsMetadata = $('.buttons-pdf-metadata');

            function changeClass(element, oldClass, newClass, iconClass) {
                element.removeClass(oldClass);
                element.addClass(newClass);
                element.html(`<i class="${iconClass}" style="margin-right: 5px;"></i> ${element.text()}`);
            }

            changeClass(buttonsMetadata, 'btn-secondary', 'btn-danger', 'fas fa-file-pdf');
        }
    });

    var tb_sub = $('#tb_sub').DataTable({
        "pageLength": 10,
        buttons: [
            {
                extend: 'csvHtml5',
                className: 'buttons-csv-sub'
            },
            {
                extend: 'excelHtml5',
                className: 'buttons-excel-sub'
            },
            {
                extend: 'pdfHtml5',
                className: 'buttons-pdf-sub'
            },
            {
                text: 'Grafik',
                className: 'buttons-open-graph',
                action: function (e, dt, node, config) {
                    // Selalu tampilkan modal grafik
                    $('#modal-graph').modal('show');
                }
            }
        ],
        dom: "<'row justify-content-center'<'col-md-7'B><'col-md-2'l><'col-md-3'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        scrollX: false,
        autoWidth: false,
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"]
        ],
        initComplete: function () {
            var buttonsPdf = $('.buttons-pdf-sub');
            var buttonsExcel = $('.buttons-excel-sub');
            var buttonsCsv = $('.buttons-csv-sub');
            var buttonsGraph = $('.buttons-open-graph');
            
            function changeClass(element, oldClass, newClass, iconClass) {
                element.removeClass(oldClass);
                element.addClass(newClass);
                element.html(`<i class="${iconClass}" style="margin-right: 5px;"></i> ${element.text()}`);
            }

            changeClass(buttonsPdf, 'btn-secondary', 'btn-danger', 'fas fa-file-pdf');
            changeClass(buttonsExcel, 'btn-secondary', 'btn-success', 'fas fa-file-excel');
            changeClass(buttonsCsv, 'btn-secondary', 'btn-info', 'fas fa-file-csv');
            // Selalu aktifkan tombol grafik
            changeClass(buttonsGraph, 'btn-secondary', 'btn-warning', 'fas fa-chart-line');
        }
    });

    setTimeout(function () {
        tb_metadata.columns.adjust().draw();
        tb_sub.columns.adjust().draw();
    }, 1000);

    $('#search').keyup(function () {
        tb_metadata.search($(this).val()).draw();
        tb_sub.search($(this).val()).draw();
    });

    tb_metadata.buttons().container()
        .appendTo($('.col-sm-6:eq(0)', tb_metadata.table().container()));

    tb_sub.buttons().container()
        .appendTo($('.col-sm-6:eq(0)', tb_sub.table().container()));
});

</script>
<section id="stats-counter" class="stats-counter pt-0">
       
</section>