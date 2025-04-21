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
                                <h4 class="card-title">Jumlah Titik Papan Reklame yang disewakan</h4>
                                <hr>
                                <table class="table table-responsive table-borderless table-sm">
                                    <tbody>
                                        <tr>
                                            <td style="width:200px;">Definisi Operasional</td>
                                            <td>: Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus officiis, perferendis quisquam molestias impedit tempore quidem animi rerum, fugit quo, minus ipsam ipsa ducimus consequuntur optio eius possimus ullam assumenda!</td>
                                        </tr>
                                        <tr>
                                            <td>Satuan</td>
                                            <td>: Lokasi</td>
                                        </tr>
                                        <tr>
                                            <td>Keluaran</td>
                                            <td>: </td>
                                        </tr>
                                        <tr>
                                            <td>Sumber Data</td>
                                            <td>: </td>
                                        </tr>
                                        <tr>
                                            <td>Cara Pengambilan Data</td>
                                            <td>: </td>
                                        </tr>
                                        <tr>
                                            <td>Penanggung Jawab Program</td>
                                            <td>: </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tahun</th>
                                            <th>Data Angka</th>
                                            <th>Data File</th>
                                            <th>Update Terakhir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>2022</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>-</td>
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
                                            <td>2021</td>
                                            <td>800</td>
                                            <td>data_loremds.xlsx</td>
                                            <td>2021-10-10 22:00:10</td>
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
                                            <td>2020</td>
                                            <td>900</td>
                                            <td>data_loremds.xlsx</td>
                                            <td>2020-10-10 22:00:10</td>
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
                                            <td>2019</td>
                                            <td>1300</td>
                                            <td>data_loremds.xlsx</td>
                                            <td>2019-10-10 22:00:10</td>
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
                                            <td>2018</td>
                                            <td>700</td>
                                            <td>data_loremds.xlsx</td>
                                            <td>2018-10-10 22:00:10</td>
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
                            <div class="card-body">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Grafik Data</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="column_chart_datalabel" data-colors='["#5156be"]' class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
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
<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<!-- <script src="<?= base_url() ?>/assets/js/pages/apexcharts.init.js"></script> -->

<script>
    // var columnDatalabelColors = getChartColorsArray("#column_chart_datalabel");
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
            data: [700, 1300, 900, 800, 0]
        }],
        // colors: columnDatalabelColors,
        grid: {
            borderColor: '#f1f1f1',
        },
        xaxis: {
            categories: ["2018", "2019", "2020", "2021", "2022", ],
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
                    return val + "%";
                }
            }

        },
        title: {
            text: 'Jumlah Titik Papan Reklame yang disewakan',
            floating: true,
            offsetY: 330,
            align: 'center',
            style: {
                color: '#444',
                fontWeight: '500',
            }
        },
    }

    var chart = new ApexCharts(
        document.querySelector("#column_chart_datalabel"),
        options
    );

    chart.render();
</script>

<script src="<?= base_url() ?>/assets/js/app.js"></script>

</body>

</html>