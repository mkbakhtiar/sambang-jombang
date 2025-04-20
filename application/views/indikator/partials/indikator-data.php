<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="bg-dark text-light">
                <tr class="text-center">
                    <th>Tahun</th>
                    <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                        <th><?= $vt['nama_tahun']; ?></th>
                    <?php endforeach; ?>
                    <th>Chart</th>
                </tr>
            </thead>
            <tbody>
                <tr class="align-middle">
                    <th class="text-center">Data</th>
                    <?php foreach ($props['ind_data']['data'] as $kd => $vd) : ?>
                        <td class="text-end"><?= $vd['data_angka']; ?> <?= $vd['status_verifikasi'] == '2' ? '<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="' . $vd['keterangan'] . '"><i class="fas fa-info-circle" style="color: red;"></i>' : '' ?></span></td>
                        <?php $cdata[] = $vd['data_angka'] ?>
                    <?php endforeach; ?>
                    <td style="width: 10%;" id="chart-1"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php if ($props['sub_data']['count'] != '0') : ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Sub Indikator</h5>
            <table class="table table-bordered">
                <thead class="bg-dark text-light">
                    <tr class="text-center">
                        <th>Nama Sub Indikator</th>
                        <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                            <th><?= $vt['nama_tahun']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($props['sub_data']['subs'] as $ks => $vs) : ?>
                        <tr>
                            <th class=""><?= $vs['nama_indikator'] ?></th>
                            <?php foreach ($vs['data'] as $ksd => $vsd) : ?>
                                <td class="text-end"><?= $vsd['data_angka']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<script src="<?= base_url() ?>/assets/libs/apexcharts/apexcharts.min.js"></script>

<script>
    $(document).ready(function() {
        $("[data-toggle=tooltip").tooltip();
    });
    var options1 = {
        series: [{
            data: <?= json_encode($cdata); ?>
        }],
        chart: {
            type: 'bar',
            width: 100,
            height: 35,
            sparkline: {
                enabled: true
            }
        },
        tooltip: {
            fixed: {
                enabled: false
            },
            x: {
                show: false
            },
            y: {
                title: {
                    formatter: function(seriesName) {
                        return ''
                    }
                }
            },
            marker: {
                show: false
            }
        }
    };

    var chart1 = new ApexCharts(document.querySelector("#chart-1"), options1);
    chart1.render();
</script>