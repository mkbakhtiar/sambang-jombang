   <script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
</script>

    <link href="<?= base_url('assets/front') ?>/css/tab-style.css?v=1.0.0" rel="stylesheet" />
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/natural.js"></script>

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

    <section id="about" class="about">
    <div class="container" data-aos="fade-up">
    <div class="section-header" style="margin-top: 0" data-aos="fade-up" data-aos-delay="">
                            <!-- <h2>Urusan</h2> -->
                            <div class="content order-first order-lg-first">
                <h3><?= $props['ind_data']['nama_indikator']; ?></h3>
            </div>
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
                                    <table id="tb_sub"  class="table table-bordered table-hover" style="width: 100%;">
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
                                                    <td class="text-end"><?= convert_number($vd['data_angka']); ?></td>
                                                <?php endforeach; ?>
                                                <td><?= $props['ind_data']['nama_satuan']; ?></td>
                                                <td><?= $props['ind_data']['nama_skpd']; ?></td>
                                            </tr>
                                            <?php foreach ($props['sub_data']['subs'] as $ks => $vs) : ?>
                                                <tr>
                                                    <td>1.<?= strval($ks + 1) ?>.</td>
                                                    <td style="width: 30%;"><?= $vs['nama_indikator'] ?></td>
                                                    <?php foreach ($vs['data'] as $ksd => $vsd) : ?>
                                                        <td class="text-end"><?= convert_number($vsd['data_angka']); ?></td>
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
                                                <table id="tb_metadata" class="table" style="width: 100%;">
                                                    <thead class="bg-dark text-light">
                                                        <tr class="text-center align-middle">
                                                            <th>Isi</th>
                                                            <th>Deskripsi</th>
                                                        </tr>
                                                    </thead>
                                                    <?php
                                                    // Ambil data yang ada di $props['ind_data']
                                                    $ind_data = $props['ind_data'];

                                                    // Gabungkan metadata dengan data lainnya dalam array
                                                    $customData = [
                                                        [
                                                            'nama_metadata' => 'Nama',
                                                            'value' => $ind_data['nama_indikator'],
                                                            'delay' => 100
                                                        ],
                                                        [
                                                            'nama_metadata' => 'Produsen Data',
                                                            'value' => $ind_data['nama_skpd'],
                                                            'delay' => 100
                                                        ],
                                                        [
                                                            'nama_metadata' => 'Definisi',
                                                            'value' => $ind_data['definisi_operasional'],
                                                            'delay' => 100
                                                        ],
                                                        [
                                                            'nama_metadata' => 'Kode',
                                                            'value' => $ind_data['id_indikator'],
                                                            'delay' => 100
                                                        ],
                                                        [
                                                            'nama_metadata' => 'Satuan',
                                                            'value' => $ind_data['nama_satuan'],
                                                            'delay' => 200
                                                        ]
                                                    ];

                                                    // Gabungkan dengan metadata yang sudah ada
                                                    foreach ($ind_data['metadata'] as $meta) {
                                                        if ($meta['value'] != null) {
                                                            $customData[] = [
                                                                'nama_metadata' => $meta['nama_metadata'],
                                                                'value' => $meta['value'],
                                                                'delay' => 400 // Anda bisa menyesuaikan delay sesuai kebutuhan
                                                            ];
                                                        }
                                                    }

                                                    // Definisikan urutan yang diinginkan
                                                    $order = [
                                                        'Nama',
                                                        'Produsen Data',
                                                        'Konsep',
                                                        'Definisi',
                                                        'Kode',
                                                        'Teknik Pengumpulan',
                                                        'Metodologi',
                                                        'Unit Observasi',
                                                        'Ukuran',
                                                        'Satuan',
                                                        'Manfaat',
                                                        'Formula',
                                                        'Nomor Romantik',
                                                        'Nomor SDSN',
                                                        'Sumber Referensi'
                                                    ];

                                                    // Buat fungsi untuk mengurutkan berdasarkan urutan yang diinginkan
                                                    usort($customData, function ($a, $b) use ($order) {
                                                        $pos_a = array_search($a['nama_metadata'], $order);
                                                        $pos_b = array_search($b['nama_metadata'], $order);
                                                        return $pos_a - $pos_b;
                                                    });
                                                    ?>

                                                    <tbody>
                                                        <?php foreach ($customData as $data) : ?>
                                                            <tr data-aos="fade-up" data-aos-delay="<?= $data['delay']; ?>">
                                                            <?php if ($data['nama_metadata'] == 'Teknik Pengumpulan') {
                                                                        $data['nama_metadata'] = 'Cara Pengumpulan Data';
                                                                    }?>
                                                                <td><?= $data['nama_metadata']; ?></td>
                                                                <td><?= $data['value']; ?></td>
                                                            </tr>
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

<?php
$csubdata = [];
foreach ($props['sub_data']['subs'] as $ks => $vs) {
    $tmp = ['name' => $vs['nama_indikator'], 'data' => []];
    foreach ($vs['data'] as $ksd => $vsd) {
        $tmp['data'][] = $vsd['data_angka'];
    }
    $csubdata[] = $tmp;
}
?>

<?php
$ctahun = [];
foreach ($props['tahun'] as $kt => $vt) {
    $ctahun[] = $vt['nama_tahun'];
}
?>

<?php
$cdata = [];
foreach ($props['ind_data']['data'] as $kd => $vd) {
    $cdata[] = floatval($vd['data_angka']);
}
?>

<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- JAVASCRIPT -->

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
            name: '',
            data: <?= json_encode($cdata); ?>
        }],
        // colors: columnDatalabelColors,
        grid: {
            borderColor: '#f1f1f1',
        },
        xaxis: {
            categories: <?= json_encode($ctahun); ?>,
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
    }

    var chart = new ApexCharts(
        document.querySelector("#chart-container"),
        options
    );

    chart.render();

    <?php if ($props['sub_data']['count'] != '0') : ?>
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
                categories: <?= json_encode($ctahun); ?>,
            },
            // yaxis: {
            //     title: {
            //         text: '$ (thousands)'
            //     }
            // },
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
    <?php endif; ?>
    // Cari tombol grafik
</script>
<script>
     $(document).ready(function () {
    var tb_metadata = $('#tb_metadata').DataTable({
        "pageLength": 15,
        "ordering": false,
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
        // "ordering": true,
        //  "columnDefs": [
        //     { "type": "natural", "targets": 0 }  // Menggunakan sorting alami untuk kolom pertama
        // ], 
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
                    // Tambahkan logika di sini untuk membuka modal
                    $('#modal-graph').modal('show'); // Contoh: Memanggil modal dengan ID 'myModal'
                }
            }
        ],
        dom: "<'row justify-content-center'<'col-md-7'B><'col-md-2'l><'col-md-3'f>>" +
            "<'row'<'col-md-12'tr>>" +
            "<'row'<'col-md-5'i><'col-md-7'p>>",
        scrollX: false,
        autoWidth: false,
        order: [],
        lengthMenu: [
            [5, 10, 25, 50, 100, -1],
            [5, 10, 25, 50, 100, "All"]
        ],
        initComplete: function () {
        var buttonsPdf = $('.buttons-pdf-sub');
        var buttonsExcel = $('.buttons-excel-sub');
        var buttonsCsv = $('.buttons-csv-sub');
        var buttonsGraph = $('.buttons-open-graph');
        
        // Periksa jumlah data
        <?php if ($props['sub_data']['count'] == null) : ?>
            // Jika jumlah data adalah 0, nonaktifkan tombol grafik
            buttonsGraph.prop('disabled', true);
        <?php endif; ?>

        function changeClass(element, oldClass, newClass, iconClass) {
            element.removeClass(oldClass);
            element.addClass(newClass);
            element.html(`<i class="${iconClass}" style="margin-right: 5px;"></i> ${element.text()}`);
            // Tambahkan properti CSS untuk mengatur ukuran font
            element.css('font-size', 'smaller');
        }

        changeClass(buttonsPdf, 'btn-secondary', 'btn-danger', 'fas fa-file-pdf');
        changeClass(buttonsExcel, 'btn-secondary', 'btn-success', 'fas fa-file-excel');
        changeClass(buttonsCsv, 'btn-secondary', 'btn-info', 'fas fa-file-csv');
        if(buttonsGraph.prop('disabled') !== true){
            changeClass(buttonsGraph, 'btn-secondary', 'btn-warning', 'fas fa-chart-line');
        }else{
            changeClass(buttonsGraph, 'btn-secondary', 'btn-secondary', 'fas fa-chart-line');

        }
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

 