<?php $edit = true; ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $props['ind_data']['nama_indikator']; ?></h4>
        <hr>
        <table class="table table-responsive table-borderless table-sm">
            <tbody>
                <tr>
                    <td style="width:200px;">Definisi Operasional</td>
                    <td>: <?= $props['ind_data']['definisi_operasional']; ?></td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>: <?= $props['ind_data']['nama_satuan']; ?></td>
                </tr>
                <tr>
                    <td>SKPD</td>
                    <td>: <?= $props['ind_data']['nama_skpd']; ?></td>
                </tr>
                <?php foreach ($props['metadata_cols'] as $kmc => $vmc) : ?>
                    <tr>
                        <td><?= $vmc['nama_metadata'] ?></td>
                        <td>: <?= $props['ind_data'][$vmc['key_metadata']] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- <?php if ($props['sub_data']['count'] != 0) : ?> -->
    <!-- <hr> -->
    
    <div class="card-body" id="sub-container">
        <label class="col-form-label col-12 text-center mb-3">Sub Indikator</label>
        <div class="table-responsive">
            
        <div class="card-body">
        <div class="row">
            <div class="col-12">
                <input class="form-control" type="text" name="search" id="search" placeholder="Pencarian...">
            </div>
        </div>
            <table id="tb_sub_ind_list" class="table table-bordered table-hover" style="width: 100%;">
                <thead  class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Sub Indikator</th>
                        <th>Definisi Operasional</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $props['table_rows'] ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<script>
        var tb_sub = $('#tb_sub_ind_list').DataTable({
            "pageLength": 10,
            dom: 'lrtp',
            scrollY: '500px',
            scrollCollapse: true,
            paging: true,
            lengthChange: false,
            info: true,
            autoWidth: false,
            order: [],
            
        });
        setTimeout(function() {
            tb_sub.columns.adjust().draw();
        }, 1000);

        $('#search').keyup(function() {
            tb_sub.search($(this).val()).draw();
        });
</script>

<!-- <?php debug($props) ?> -->