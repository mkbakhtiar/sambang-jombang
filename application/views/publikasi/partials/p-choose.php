<div class="row">
    <div class="col-12">
        <input class="form-control" type="text" name="search" id="search" placeholder="Pencarian...">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-hover" style="width: 100%;" id="tb-list">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Nama Indikator</th>
                    <th>SKPD</th>
                    <th>Definisi Operasional</th>
                    <th>Satuan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($props['indikator_list'] as $ki => $vi) : ?>
                    <tr>
                        <td></td>
                        <td><?= encrypt_url(true, $vi['id_indikator']); ?></td>
                        <td><?= $vi['nama_indikator']; ?></td>
                        <td><?= $vi['nama_skpd']; ?></td>
                        <td><?= $vi['definisi_operasional']; ?></td>
                        <td><?= $vi['nama_satuan']; ?></td>
                        <td>
                            <?= (in_array($vi['id_indikator'], $props['selected'])) ? 'Selected' : '' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="d-flex justify-content-center"><button class="btn btn-primary mx-auto" id="btn-confirm" type="button">Simpan</button></div>
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

        // $($.fn.dataTable.tables(true)).DataTable().columns.adjust();

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
                        $('#modal-edit').modal('hide');
                        // $('#tb_data').DataTable().ajax.reload(null, false);

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
