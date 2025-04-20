<main id="main">
    <!-- <script type="text/javascript" src="<?= base_url('assets/front/js') ?>/canvasjs.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div id="featured-services" class="featured-services" style="margin-top: 0; width: 1600px;">
        <div class="container">
            <div class="row gy-4">

                <div class="col-md-8" id="puskesmas" style="height: 75vh;flex-direction: column; align-items: center;">
                    <h2>Puskesmas</h2>
                    <p>Sumber Data: <a href="https://simpus.jombangkab.go.id/"
                            target="_blank">https://simpus.jombangkab.go.id/</a></p>
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-md-8 text-start">
                            <?php setlocale(LC_TIME, 'id_ID'); ?>
                            <h5>Update terakhir:
                                <?php echo strftime('%e %B %Y, %H:%M', strtotime($props['simpus_updated_at'])); ?>
                            </h5>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-primary" id="refreshSimpus">
                                <span id="refreshSimpusText">REFRESH</span>
                                <span id="loadingSimpus" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>

                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="row">
                            <div class="box">
                                <h4>Grafik Distribusi Umur</h4>
                                <p>Grafik ini menunjukkan distribusi total kunjungan pasien puskesmas berdasarkan
                                    kelompok umur.</p>
                                <div id="chart-umur"></div>
                            </div>
                            <div class="box">
                                <h4>Grafik Total Kunjungan per Tanggal</h4>
                                <p>Grafik ini menunjukkan total kunjungan pasien puskesmas per tanggal.</p>
                                <div id="chart-tanggal"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function showDiv(divNumber) {
                    const divIds = ['rsud', 'puskesmas'];
                    const buttonIds = ['button1', 'button2'];

                    // Mengatur display untuk div yang sesuai dan mengubah kelas tombol
                    divIds.forEach((divId, index) => {
                        const displayValue = (index + 1 === divNumber) ? 'block' : 'none';
                        document.getElementById(divId).style.display = displayValue;

                        const isButtonActive = (index + 1 === divNumber);
                        const buttonElement = document.getElementById(buttonIds[index]);
                        buttonElement.classList.toggle('btn-primary', isButtonActive);

                        if (isButtonActive) {
                            buttonElement.classList.add('clicked'); // Menambah kelas clicked jika tombol aktif
                        } else {
                            buttonElement.classList.remove('clicked'); // Menghapus kelas clicked jika tombol tidak aktif
                        }
                    });
                }
            </script>

        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <td><a href="">Data Selengkapnya ....</a></td>
    </div>
    </div>
</main>
<script>
    // Data dari controller
    var list_kunjungan = <?php echo json_encode($props['list_kunjungan']); ?>;

    // Memproses data tanggal
    var tanggalLabels = [];
    var seriesTanggal = [];
    for (var tanggal in list_kunjungan.tanggal) {
        tanggalLabels.push(tanggal);
        seriesTanggal.push(list_kunjungan.tanggal[tanggal]);
    }

    // Mendefinisikan urutan yang diinginkan
    var umurOrder = ['0-5', '6-12', '13-18', '19-35', '36-60', '60+'];

    // Memproses dan mengurutkan data umur
    var umurData = [];
    for (var umur in list_kunjungan.umur) {
        umurData.push({ label: umur, value: list_kunjungan.umur[umur] });
    }

    // Mengurutkan data sesuai dengan urutan yang diinginkan
    umurData.sort(function (a, b) {
        return umurOrder.indexOf(a.label) - umurOrder.indexOf(b.label);
    });

    // Mengambil data yang sudah diurutkan
    var umurLabels = umurData.map(function (d) { return 'Usia ' + d.label; });
    var seriesUmur = umurData.map(function (d) { return d.value; });

    // Grafik Distribusi Umur (Pie Chart)
    var optionsUmur = {
        series: seriesUmur,
        chart: {
            height: 350,
            type: 'pie'
        },
        labels: umurLabels,
        colors: ['#FF4560', '#00E396', '#008FFB', '#FEB019', '#FF66C3', '#775DD0'],
        legend: {
            position: 'right',
            offsetY: 0,
            itemMargin: {
                horizontal: 5,
                vertical: 10
            }
        }
    };

    var chartUmur = new ApexCharts(document.querySelector("#chart-umur"), optionsUmur);
    chartUmur.render();


    // Grafik Total Kunjungan per Tanggal (Line Chart)
    var optionsTanggal = {
        series: [{
            name: 'Total Kunjungan',
            data: seriesTanggal
        }],
        chart: {
            height: 350,
            type: 'line'
        },
        dataLabels: {
            enabled: true
        },
        colors: ['#00E396'],
        xaxis: {
            categories: tanggalLabels,
            labels: {
                rotate: -45, // Rotasi label
                style: {
                    colors: '#9e9e9e',
                    fontSize: '12px',
                    cssClass: 'apexcharts-xaxis-label'
                }
            },
            tickPlacement: 'on'
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return val;
                }
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yyyy'
            }
        }
    };

    var chartTanggal = new ApexCharts(document.querySelector("#chart-tanggal"), optionsTanggal);
    chartTanggal.render();
</script>
</script>


<style>
    /* Style tambahan untuk tombol */
    .col-md-3 button {
        width: 70%;
    }

    /* CSS */
    .btn {
        width: 60%;
        /* Lebar tombol 90% dari lebar layar */
        margin-bottom: 10px;
        /* Ruang antara tombol */
    }

    iframe {
        width: 90vw;
        /* Lebar iframe 90% dari viewport width */
        height: 80vh;
        /* Tinggi iframe 50% dari viewport height */
    }

    /* Media queries untuk keperluan tertentu jika diperlukan */
    @media screen and (max-width: 768px) {
        .btn {
            width: 70%;
            /* Ubah lebar tombol menjadi 100% untuk layar kecil */
        }

        iframe {
            width: 100vw;
            /* Lebar iframe 100% dari viewport width untuk layar kecil */
            height: 60vh;
            /* Tinggi iframe 60% dari viewport height untuk layar kecil */
        }
    }
</style>

<script>

    function showIframe(iframeNumber) {
        const iframeIds = ['rsud', 'puskesmas'];
        const buttonIds = ['button1', 'button2'];

        // Mengatur display untuk iframe yang sesuai dan mengubah kelas tombol
        iframeIds.forEach((iframeId, index) => {
            const displayValue = (index + 1 === iframeNumber) ? 'block' : 'none';
            document.getElementById(iframeId).style.display = displayValue;

            const isButtonActive = (index + 1 === iframeNumber);
            const buttonElement = document.getElementById(buttonIds[index]);
            buttonElement.classList.toggle('btn-primary', isButtonActive);

            if (isButtonActive) {
                buttonElement.classList.add('clicked'); // Menambah kelas clicked jika tombol aktif
            } else {
                buttonElement.classList.remove('clicked'); // Menghapus kelas clicked jika tombol tidak aktif
            }
        });


        // Mengatur data-src kembali ke src untuk iframe yang dipilih
        const selectedIframe = document.getElementById('iframe' + iframeNumber);
        const selectedIframeSrc = selectedIframe.getAttribute('data-src');
        if (selectedIframeSrc) {
            selectedIframe.src = selectedIframeSrc;
        }

        // Mengatur data-loaded ke true untuk iframe yang dipilih
        if (selectedIframe && selectedIframe.getAttribute('data-loaded') !== 'true') {
            selectedIframe.setAttribute('data-loaded', 'true');
        }

        // Menghapus src untuk iframe yang tidak dipilih
        iframeIds.forEach((iframeId, index) => {
            if (index + 1 !== iframeNumber) {
                const iframe = document.getElementById(iframeId);
                iframe.src = '';
            }
        });
    }

</script>

<script>
    //     var options = {
    //     series: [
    //         {
    //             name: 'Kapasitas',
    //             group: 'budget',
    //             data: [
    //                 <?php foreach ($tempattidurs as $tempattidur): ?>
        //                     <?php echo $tempattidur['kapasitas']; ?>,
        //                 <?php endforeach; ?>
    //             ]
    //         },
    //         {
    //             name: 'Kosong',
    //             group: 'actual',
    //             data: [
    //                 <?php foreach ($tempattidurs as $tempattidur): ?>
        //                     <?php echo $tempattidur['kosong']; ?>,
        //                 <?php endforeach; ?>
    //             ]
    //         },
    //         {
    //             name: 'Terisi',
    //             group: 'actual',
    //             data: [
    //                 <?php foreach ($tempattidurs as $tempattidur): ?>
        //                     <?php echo $tempattidur['terisi']; ?>,
        //                 <?php endforeach; ?>
    //             ]
    //         }
    //     ],
    //     chart: {
    //         type: 'bar',
    //         height: 350,
    //         stacked: true,
    //     },
    //     stroke: {
    //         width: 1,
    //         colors: ['#fff']
    //     },
    //     dataLabels: {
    //         enabled: true
    //     },
    //     plotOptions: {
    //         bar: {
    //             horizontal: true
    //         }
    //     },
    //     xaxis: {
    //         categories: [
    //             <?php foreach ($tempattidurs as $tempattidur): ?>
        //                 '<?php echo $tempattidur['nama_tempat_rawat']; ?>',
        //             <?php endforeach; ?>
    //         ],
    //     },
    //     fill: {
    //         opacity: 1,
    //     },
    //     colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
    //     legend: {
    //         position: 'top',
    //         horizontalAlign: 'left'
    //     }
    // };

    // var chart = new ApexCharts(document.querySelector("#chart"), options);
    // chart.render();
    var tempattidurs = <?php echo json_encode($grouped_tempattidur); ?>;

    var seriesData = [];
    var categories = [];

    for (var nama_tempat_tidur in tempattidurs) {
        if (tempattidurs.hasOwnProperty(nama_tempat_tidur)) {
            var totalKapasitas = 0;
            var totalKosong = 0;
            var totalTerisi = 0;

            tempattidurs[nama_tempat_tidur].forEach(function (tempattidur) {
                totalKapasitas += parseInt(tempattidur.kapasitas);
                totalKosong += parseInt(tempattidur.kosong);
                totalTerisi += parseInt(tempattidur.terisi);
            });

            seriesData.push({
                name: 'Kapasitas',
                group: 'budget',
                data: totalKapasitas
            });
            seriesData.push({
                name: 'Kosong',
                group: 'actual',
                data: totalKosong
            });
            seriesData.push({
                name: 'Terisi',
                group: 'actual',
                data: totalTerisi
            });
            categories.push(nama_tempat_tidur);
        }
    }

    var options = {
        series: [
            {
                name: 'Kapasitas',
                group: 'budget',
                data: seriesData.filter(item => item.name === 'Kapasitas').map(item => item.data)
            },
            {
                name: 'Kosong',
                group: 'actual',
                data: seriesData.filter(item => item.name === 'Kosong').map(item => item.data)
            },
            {
                name: 'Terisi',
                group: 'actual',
                data: seriesData.filter(item => item.name === 'Terisi').map(item => item.data)
            }
        ],
        chart: {
            type: 'bar',
            height: 500,
            stacked: true,
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        dataLabels: {
            enabled: true
        },
        plotOptions: {
            bar: {
                horizontal: true
            }
        },
        xaxis: {
            categories: categories,
        },
        fill: {
            opacity: 1,
        },
        colors: ['#3b56b5', '#05D25C', '#FF0000'],
        legend: {
            position: 'top',
            horizontalAlign: 'left'
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>

<style>
    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 5;
        width: auto;
        height: auto;
    }

    .carousel-control-prev {
        left: -50px;
        /* Adjust this value to position the button further to the left */
    }

    .carousel-control-next {
        right: -50px;
        /* Adjust this value to position the button further to the right */
    }
</style>
<script>
    $('#refreshRSUD').on('click', function (e) {
        e.preventDefault();
        var modal = $('#modal-kesehatan');
        var loading = $('#loadingRSUD');
        var refreshText = $('#refreshRSUDText');

        // Tampilkan loading dan sembunyikan teks refresh
        loading.show();
        refreshText.hide();
        $.ajax({
            url: "<?php echo base_url('Api/tempattidur'); ?>",
            method: "GET",
            success: function (data) {
                $.ajax({
                    url: "<?php echo base_url('Front/kesehatan'); ?>",
                    method: "GET",
                    success: function (data) {
                        modal.find('.modal-body').html(data); // Update konten modal

                        // Sembunyikan loading dan tampilkan kembali teks refresh
                        loading.hide();
                        refreshText.show();

                        $('#button1').trigger('click');

                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        // Sembunyikan loading dan tampilkan kembali teks refresh
                        loading.hide();
                        refreshText.show();
                    }
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    $('#refreshSimpus').on('click', function (e) {
        e.preventDefault();
        var modal = $('#modal-kesehatan');
        var loading = $('#loadingSimpus');
        var refreshText = $('#refreshSimpusText');

        // Tampilkan loading dan sembunyikan teks refresh
        loading.show();
        refreshText.hide();
        $.ajax({
            url: "<?php echo base_url('Api/simpuskunjungan'); ?>",
            method: "GET",
            success: function (data) {
                $.ajax({
                    url: "<?php echo base_url('Front/kesehatan'); ?>",
                    method: "GET",
                    success: function (data) {
                        modal.find('.modal-body').html(data); // Update konten modal
                        // modal.find('.modal-body').html(data); // Update konten modal

                        // Sembunyikan loading dan tampilkan kembali teks refresh
                        loading.hide();
                        refreshText.show();

                        $('#button2').trigger('click');
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                        // Sembunyikan loading dan tampilkan kembali teks refresh
                        loading.hide();
                        refreshText.show();

                    }
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });


</script>

<style>
    #rsud {
        padding: 20px;
        background-color: #f9f9f9;
        /* Latar belakang yang ringan */
        border-radius: 8px;
        /* Sudut yang membulat */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Bayangan lembut */
    }

    #rsud h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    #rsud p {
        font-size: 14px;
        color: #666;
        margin-bottom: 20px;
    }
</style>