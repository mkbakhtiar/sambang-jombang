<div class="section-header" style="margin-top: 0" data-aos="fade-up" data-aos-delay="">
  </div>
<div class="pt-4" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4" style="overflow: auto;">
        <!-- <table class="table table-bordered" style="width: 100%;">
            <thead class="bg-dark text-light">
                <tr class="text-center align-middle">
                    <th rowspan="2">#</th>
                    <th rowspan="2">Test Nama Indikator</th>
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
                <tr class="align-middle">
                    <td>1.</td>
                    <td style="width: 30%;"><?= $props['ind_data']['nama_indikator']; ?></td>
                    <?php foreach ($props['ind_data']['data'] as $kd => $vd) : ?>
                        <td class="text-end"><?= convert_number($vd['data_angka']); ?></td>
                    <?php endforeach; ?>
                    <td><?= $props['ind_data']['nama_satuan']; ?></td>
                    <td><?= $props['ind_data']['nama_skpd']; ?></td>
                </tr>
                
                <?php echo $props['sub_data']?>

            </tbody>
        </table> -->
        <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <!-- <th>PK</th> -->
                        <!-- <th>UUID</th> -->
                        <th>Judul</th>
                        <th>Jenis</th>
                        <th>Pemilik</th>
                        <th>Tanggal</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($props['list_objects'] as $objects => $object) : ?>
                        <tr>
                            <!-- <td><?= $object['pk']; ?></td> -->
                            <!-- <td><?= $object['uuid']; ?></td> -->
                            <td><?= $object['title']; ?></td>
                            <td><?= $object['resource_type']; ?></td>
                            <td><?= $object['attribution']; ?></td>
                            <td><?= $object['date'];  ?></td>
                            <?php if ($object['attribution'] == 'dataset') { ?>
                            <?php } else { ?>
                                <td><a href=" <?= $object['detail_url']; ?>" target="_blank">Link</a></td>
                            <?php } ?>
                        </tr>
                    <?php endforeach; ?>
                <tfoot>
                </tfoot>
            </table>

    </div>
</div>


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        new DataTable('#example', {
            "columns": [{
                    "width": "40%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "35%"
                },
                {
                    "width": "10%"
                },
                {
                    "width": "5%"
                }
            ],
            fixedColumns: true,
            paging: true,
            scrollCollapse: true,
        });
    });
</script>