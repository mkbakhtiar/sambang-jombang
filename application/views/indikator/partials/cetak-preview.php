<style>
    .tab {
        display: inline-block;
        margin-left: 5%;
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="row gy-4">
            <table class="table table-bordered" style="width: 100%;">
                <thead class="bg-dark text-light">
                    <tr class="text-center align-middle">
                        <th rowspan="2">#</th>
                        <th rowspan="2">Nama Indikator</th>
                        <th colspan="<?= count($props['tahun']) ?>">Tahun</th>
                        <th rowspan="2">Satuan</th>
                        <th rowspan="2">Sumber Data</th>
                    </tr>
                    <tr class="text-center align-middle">
                        <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                            <th><?= $vt['nama_tahun']; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($props['selected_data'] as $ksd => $vsd) : ?>
                        <tr class="align-middle">
                            <td class="text-center"><?= $ksd + 1; ?></td>
                            <td style="width: 30%;"><?= $vsd['nama_indikator']; ?></td>
                            <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                <td class="text-end"><?= $vsd['data'][$kt]['data_angka']; ?></td>
                            <?php endforeach; ?>
                            <td><?= $vsd['nama_satuan']; ?></td>
                            <td><?= $vsd['nama_skpd']; ?></td>
                        </tr>
                        <?php if ($vsd['sub']['count'] != '0') : ?>
                            <?php foreach ($vsd['sub']['subs'] as $ks => $vs) : ?>
                                <tr class="align-middle">
                                    <td class="text-center"><?= strval($ksd + 1) . '.' . strval($ks + 1) ?></td>
                                    <td style="width: 30%;"><span class="tab"></span><?= $vs['nama_indikator'] ?></td>
                                    <?php foreach ($props['tahun'] as $kt => $vt) : ?>
                                        <td class="text-end"><?= $vs['data'][$kt]['data_angka']; ?></td>
                                    <?php endforeach; ?>
                                    <td><?= $vs['nama_satuan'] ?></td>
                                    <td><?= $vsd['nama_skpd']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
</script>