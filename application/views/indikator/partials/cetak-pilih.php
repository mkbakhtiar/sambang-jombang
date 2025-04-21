<div class="row">
    <div class="col-12">
        <input class="form-control" type="text" name="search" id="search" placeholder="Pencarian...">
    </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-hover" style="width: 100%;" id="tb-list">
            <thead class="thead-light">
                <tr class="align-middle">
                    <th><input type="checkbox" class="form-check-input" id="check-all" checked></th>
                    <th>ID</th>
                    <th>Nama Indikator</th>
                    <th>SKPD</th>
                    <th>Definisi Operasional</th>
                    <th>Satuan</th>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <div class="">
                <button class="btn btn-primary mx-auto" id="btn-export" type="button">Export</button>
            </div>
        </div>
    </div>
</div>
<!-- <div class="row mt-3">
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <div class="">
                <button class="btn btn-primary mx-auto" id="btn-excel" type="button">Cetak</button>
                <button class="btn btn-primary mx-auto" id="btn-preview" type="button">Preview</button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row mt-3">
    <div class="col-12">
        <div class="d-flex justify-content-center">
            <div class="">
                <button class="btn btn-primary mx-auto" id="btn-excel" type="button">Excel</button>
                <button class="btn btn-primary mx-auto" id="btn-pdf" type="button">PDF</button>
            </div>
        </div>
    </div>
</div>
<hr> -->
<div class="row mt-3">
    <div class="col-12" id="preview-container">
    </div>
</div>

<div class="row d-none">
    <form action="" method="post" id="form-select" target="_blank">
        <input type="hidden" name="selected" id="selected">
    </form>
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
                "targets": [1],
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

        // tbList.rows().every(function(rowIdx, tableLoop, rowLoop) {
        //     if (this.data()[6] == 'Selected') {
        //         this.select();
        //     }
        // });

        $('#search').keyup(function() {
            tbList.search($(this).val()).draw();
        });

        $('#btn-preview').on('click', function() {
            var tblData = tbList.rows('.selected').data();
            var tmpData = [];
            var btn = $(this);
            btn.attr('disabled', true);
            btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            $.each(tblData, function(i, val) {
                tmpData.push(tblData[i][1]);
            });

            if (tmpData.length != 0) {
                $.post(base_url + 'indikator/cetak/preview', {
                        selected: tmpData,
                    })
                    .done(function(data) {
                        $('#preview-container').html(data);
                        btn.html('Preview');
                        btn.attr('disabled', false);
                    });
            } else {
                $('#preview-container').html('');
                alert('Belum ada indikator yang dipilih')
            }
        });

        // $('#btn-excel').on('click', function() {
        //     var tblData = tbList.rows('.selected').data();
        //     var tmpData = [];
        //     var btn = $(this);
        //     btn.attr('disabled', true);
        //     btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
        //     $.each(tblData, function(i, val) {
        //         tmpData.push(tblData[i][1]);
        //     });

        //     if (tmpData.length != 0) {
        //         $.post(base_url + 'indikator/cetak/excel', {
        //                 selected: tmpData,
        //             })
        //             .done(function(data) {
        //                 btn.html('Cetak');
        //                 btn.attr('disabled', false);
        //             });
        //     } else {
        //         $('#preview-container').html('');
        //         alert('Belum ada indikator yang dipilih')
        //     }
        // });

        $('#btn-export').on('click', function() {
            var tblData = tbList.rows('.selected').data();
            var tmpData = [];
            $.each(tblData, function(i, val) {
                tmpData.push(tblData[i][1]);
            });

            if (tmpData.length != 0) {
                $('#selected').val(tmpData);
                $("#form-select").attr('action', $('#btn-all').prop('href'));
                $('#form-select').submit();
                // console.log($('#selected').val());
            } else {
                $('#preview-container').html('');
                alert('Belum ada indikator yang dipilih')
            }
        });

        $('#check-all').on('change', function() {
            if ($(this).is(":checked")) {
                tbList.rows().select();
            } else {
                tbList.rows().deselect();
            }
        });

        tbList.rows().select();
    });
</script>