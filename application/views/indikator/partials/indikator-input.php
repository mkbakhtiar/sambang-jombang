<?php $this->load->view('partials/head-main') ?>

<head>

    <?php $this->load->view('partials/title-meta') ?>

    <!-- DataTables -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?= base_url() ?>/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <?php $this->load->view('partials/head-css') ?>
    <script>
        function create_chart_data() {
            var raw = tb_data.rows().data();
            var restYear = [];
            var restValue = [];
            $.each(raw, function(index, value) {
                restYear.push(value[0])
                restValue.push(value[1])
            });
            return [restYear, restValue]
        }

        function update_chart() {
            chart.updateSeries([{
                data: create_chart_data()[1]
            }])
            chart2.updateSeries([{
                data: create_chart_data()[1]
            }])
        }
    </script>

</head>

<?php $this->load->view('partials/body') ?>

<!-- <body data-layout="horizontal"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <?php $this->load->view('partials/menu') ?>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?php $this->load->view('partials/page-title') ?>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title"><?= $props['ind_data']['nama_indikator'] ?? 'Data tidak tersedia'; ?></h4>
                                    </div>
                                    <div class="card-body"  style="height: 400px; max-height: 400px; overflow-y: auto;">
                                        <table class="table table-responsive table-borderless table-sm">
                                            <tbody>
                                                <tr>
                                                    <td style="width:200px;">Definisi Operasional</td>
                                                    <td>: <?= $props['ind_data']['definisi_operasional'] ?? 'Data tidak tersedia'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Satuan</td>
                                                    <td>: <?= $props['ind_data']['nama_satuan'] ?? 'Data tidak tersedia'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>SKPD</td>
                                                    <td>: <?= $props['ind_data']['nama_skpd'] ?? 'Data tidak tersedia'; ?></td>
                                                </tr>
                                                <?php foreach ($props['metadata_cols'] as $kmc => $vmc) : ?>
                                                    <tr>
                                                        <td><?= $vmc['nama_metadata'] ?></td>
                                                        <td>: <?= $props['ind_data'][$vmc['key_metadata']] ?? 'Data tidak tersedia' ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">History Data File</h4>
                                    </div>
                                    <div class="card-body" style="height: 400px; max-height: 400px; overflow-y: auto;">
                                        <!-- Section: Timeline -->
                                        <ul class="timeline">
                                            <?php if (!empty($props['history'])): ?>
                                                <?php foreach ($props['history'] as $history_item): ?>
                                                    <li class="timeline-item mb-5">
                                                        <h5 class="fw-bold"><?php echo date('d M Y', strtotime($history_item['timestamp'])); ?></h5>
                                                        <p class="text-muted mb-2 fw-bold"><?php echo date('H:i:s', strtotime($history_item['timestamp'])); ?></p>
                                                        <p class="text-muted">
                                                            Data Angka: <?php echo $history_item['data_angka']; ?><br>
                                                            
                                                            Data File: <?php if (!empty($history_item['data_file'])): ?>
                                                                            <a href="<?php echo base_url('assets/upload/' . $history_item['data_file']); ?>"><?php echo $history_item['data_file']; ?></a>
                                                                        <?php else: ?>
                                                                            None
                                                                        <?php endif; ?><br>
                                                            Tahun: <?php echo $history_item['tahun']; ?><br>
                                                            Catatan: <?php echo $history_item['catatan']; ?>
                                                        </p>
                                                    </li>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <li class="timeline-item mb-5">
                                                    <p class="text-muted">No history data available.</p>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Data</h4>
                                    
                                </div>
                                <div class="card-body">
                                    <table id="tb-data" class="table table-bordered display nowrap" style="width: 100%;">
                                        <thead>
                                            <tr class="text-center">
                                                <th>Tahun</th>
                                                <th>Data Angka</th>
                                                <th>Data File</th>
                                                <th>Catatan Data</th>
                                                <th>Update Terakhir</th>
                                                <th>Status Verifikasi</th>
                                                <th>Status Data</th>
                                                <th>Catatan Verifikasi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Grafik Data</h4>
                                    <div class="flex-shrink-0">
                                        <ul class="nav justify-content-end nav-pills card-header-pills" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" href="#bar-chart" role="tab">
                                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                                    <span class="d-none d-sm-block">Bar</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-toggle="tab" href="#line-chart" role="tab">
                                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                                    <span class="d-none d-sm-block">Line</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <!-- Tab panes -->
                                    <div class="tab-content text-muted">
                                        <div class="tab-pane active" id="bar-chart" role="tabpanel">
                                            <div id="bar-chart-container" data-colors='["#5156be"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                        <div class="tab-pane" id="line-chart" role="tabpanel">
                                            <div id="line-chart-container" data-colors='["#5156be"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->

                            </div>

                            <?php if ($props['sub_data']['count'] != '0') : ?>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Sub Indikator</h5>
                                    </div>
                                    <div class="card-body">
                                        <table id="tb_sub" class="table table-bordered display nowrap" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Sub Indikator</th>
                                                    <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                                        <th><?= $vt['nama_tahun']; ?></th>
                                                    <?php endforeach; ?>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            <?php endif; ?>

                        </div>
                    </div> <!-- end row -->

                </div> <!-- container-fluid -->
            </div>
            <?php $this->load->view('partials/footer') ?>
        </div>
    </div>
</div>
<!-- END layout-wrapper -->

<div id="modal-edit" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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

<!-- Datatable init js -->
<script src="<?= base_url() ?>/assets/js/pages/datatables.init.js"></script>
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<script>
    var tb_data = $('#tb-data').DataTable({
        "pageLength": 10,
        "searching": false,
        "serverSide": true,
        "ajax": {
            url: base_url + 'indikator/input_get_list/<?= $props['id'] ?>',
            type: 'POST'
        },
        "columnDefs": [{
                targets: [1],
                className: 'text-end'
            },
            {
                targets: [5, 7],
                className: 'text-center'
            }
        ],
        scrollX: true,
        drawCallback: function() {
            $('.btn-edit').on('click', function(e) {
                e.preventDefault();
                var btn = $(this);
                btn.attr('disabled', true)
                var id = $(this).data('id');
                var tahun = $(this).data('tahun');
                var iddata = $(this).data('iddata');
                var modal = $('#modal-edit');
                $.post(base_url + 'indikator/input_edit', {
                        id: id,
                        tahun: tahun,
                        iddata: iddata
                    })
                    .done(function(data) {
                        modal.find('.modal-title').html('Edit (' + tahun + ')');
                        modal.find('.modal-body').html(data);
                        modal.modal('show');
                        btn.attr('disabled', false)
                    });
            });
        },
    });

    tb_data.on('draw', function() {
        update_chart();
    });
    
    var tb_sub = $('#tb_sub').DataTable({
        "pageLength": 10,
        "serverSide": true,
        "processing": true,
        "ajax": {
            url: base_url + 'indikator/get_input_sub_list/<?= $props['id'] ?>',
            type: 'POST'
        },
        scrollX: true,
    });

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
            name: 'Lokasi',
            data: [0, 0, 0, 0, 0, 0]
        }],
        // colors: columnDatalabelColors,
        grid: {
            borderColor: '#f1f1f1',
        },
        xaxis: {
            categories: ['2018', '2019', '2020', '2021', '2022'],
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
                    return val + " <?= $props['ind_data']['nama_satuan'] ?? 'Data Tidak Tersedia' ?>";
                }
            }

        },
        // title: {
        //     text: 'Jumlah Titik Papan Reklame yang disewakan',
        //     floating: true,
        //     offsetY: 330,
        //     align: 'center',
        //     style: {
        //         color: '#444',
        //         fontWeight: '500',
        //     }
        // },
    }

    var options2 = {
        chart: {
            height: 350,
            type: 'line',
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
            name: 'Lokasi',
            data: [0, 0, 0, 0, 0, 0]
        }],
        // colors: columnDatalabelColors,
        grid: {
            borderColor: '#f1f1f1',
        },
        xaxis: {
            categories: ['2018', '2019', '2020', '2021', '2022'],
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
                    return val + " <?= $props['ind_data']['nama_satuan'] ?? 'Data tidak tersedia' ?>";
                }
            }

        },
        // title: {
        //     text: 'Jumlah Titik Papan Reklame yang disewakan',
        //     floating: true,
        //     offsetY: 330,
        //     align: 'center',
        //     style: {
        //         color: '#444',
        //         fontWeight: '500',
        //     }
        // },
    }

    var chart = new ApexCharts(
        document.querySelector("#bar-chart-container"),
        options
    );
    
    var chart2 = new ApexCharts(
        document.querySelector("#line-chart-container"),
        options2
    );

    chart.render();
    chart2.render();

    $(document).ready(function() {
        chart.updateSeries([{
            data: create_chart_data()[1]
        }])
        chart2.updateSeries([{
            data: create_chart_data()[1]
        }])
    });
</script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

<style>
    .timeline {
    border-left: 1px solid hsl(0, 0%, 90%);
    position: relative;
    list-style: none;
    }

    .timeline .timeline-item {
    position: relative;
    padding-left: 30px;

    }

    .timeline .timeline-item:after {
    position: absolute;
    display: block;
    top: 0;
    }

    .timeline .timeline-item:after {
    background-color: hsl(0, 0%, 90%);
    left: -5px;
    border-radius: 50%;
    height: 11px;
    width: 11px;
    content: "";
    }
</style>





</body>

</html>