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

<div class="row d-none">
    <?= form_open('', [
        'name'    => 'form-list',
        'class'   => '',
        'id'      => 'form-list',
        'method'  => 'POST'
    ]); ?>
    <input type="hidden" name="id" value="<?= $props['id'] ?>">
    <div class="row" id="selected-list">

    </div>
    <div class="mt-4">
        <button type="submit" class="btn btn-primary w-md">Submit</button>
    </div>
    <?= form_close(); ?>
</div>
<script>
    $(document).ready(function() {
        var tbList = $('#tb-list').DataTable({
            // "pageLength": 10000,
            dom: 'lrtp',
            scrollY: '500px',
            scrollCollapse: true,
            paging: false,
            lengthChange: false,
            info: true,
            autoWidth: false,
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                "targets": [1, 6],
                "visible": false
            }],
            select: {
                selector: 'td:first-child'
            },
            order: [
                [2, 'asc']
            ],
            select: {
                style: 'multi'
            }
        });

        setTimeout(function() {
            tbList.columns.adjust().draw();
        }, 1000);

        tbList.rows().every(function(rowIdx, tableLoop, rowLoop) {
            if (this.data()[6] == 'Selected') {
                this.select();
            }
        });

        $('#search').keyup(function() {
            tbList.search($(this).val()).draw();
        });

        $('#btn-confirm').on('click', function() {
            var tblData = tbList.rows('.selected').data();
            var tmpData = [];
            $.each(tblData, function(i, val) {
                tmpData.push(tblData[i]);
            });

            $("#selected-list").empty();
            $.each(tblData, function(i, val) {
                $('#selected-list').append(`<input type="hidden" name="selected[]" value="${val[1]}">`)
            });
            $('#form-list').first().trigger("submit");
        });

        $('#form-list').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: base_url + 'publikasi/submit/<?= $props['type'] ?>',
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function(data) {
                    // console.log(data);
                },
                success: function(data) {
                    // data = $.parseJSON(data);
                    console.log(data);
                    if (data.status == 'success') {
                        $('#modal-lihat').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: data.message
                        });


                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Tidak Berhasil',
                            text: data.message
                        });
                    }
                }
            });
        });

    });
</script>