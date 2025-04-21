<style>
    .select2-container--open {
        z-index: 2000
    }
</style>

<?php isset($konfirmasi) ? $edit = true : $edit = false ?>

<div class="col-l2">
    <div>
        <?= form_open('', [
            'name' => 'form-konfirmasi',
            'class' => '',
            'id' => 'form-konfirmasi',
            'method' => 'POST'
        ]); ?>
        <div class="mb-3 text-center">
            <h5>Data untuk indikator ini tersedia dan dapat diinputkan ke dalam sistem ini?</h5>
        </div>
        <input type="hidden" name="id_indikator" value="<?= $id ?>">
        <div class="mb-3 mx-auto">
            <div class="form-check form-switch form-switch-lg mb-1 d-flex justify-content-center" dir="ltr">
                <input type="checkbox" class="form-check-input" id="konfirmasi" name="konfirmasi" value="1" <?= $edit ? ($konfirmasi['status_konfirmasi'] == '1' ? 'checked' : '') : 'checked' ?>>
            </div>
            <div class="mb-3 d-flex justify-content-center" dir="ltr">
                <label class="form-check-label" for="konfirmasi" id="label-konfirmasi"> Tersedia</label>
            </div>
        </div>
        <div id="container-alasan">
            <div class="mb-3">
                <label class="form-label" for="alasan">Alasan</label>
                <select class="form-control select2" name="alasan" id="alasan" style="width: 100%;">
                    <option value="1" <?= $edit ? ($konfirmasi['alasan'] == '1' ? 'selected' : '') : '' ?>>Data Sudah Tidak
                        Tersedia</option>
                    <option value="2" <?= $edit ? ($konfirmasi['alasan'] == '2' ? 'selected' : '') : '' ?>>Pengampu Data
                        Pindah Ke SKPD Lain</option>
                </select>
            </div>
            <div id="container-skpd">
                <div class="mb-3">
                    <label class="form-label" for="skpd">SKPD Pengganti</label>
                    <select class="form-control select2" name="id_skpd" id="id_skpd" style="width: 100%;">
                        <option value="" disabled selected>Pilih SKPD Pengganti</option>
                        <?php foreach ($skpd as $ks => $vk): ?>
                            <option value="<?= $vk['id_skpd'] ?>" <?= $edit ? ($vk['id_skpd'] == $konfirmasi['skpd_pengganti'] ? 'selected' : '') : '' ?>><?= $vk['nama_skpd'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="keterangan">Keterangan</label>
                <textarea class="form-control" name="keterangan" id="keterangan"
                    rows="3"><?= $edit ? ($konfirmasi['keterangan']) : '' ?></textarea>
            </div>
        </div>
        <hr>
        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-md">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.select2').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#modal-konfirmasi"),
            minimumResultsForSearch: 10
        });
        $('#container-alasan').hide();
        $('#container-skpd').hide();
        $('input[type=checkbox][name=konfirmasi]').trigger('change');
        $('#alasan').trigger('change');
    });

    $('input[type=checkbox][name=konfirmasi]').on('change', function () {
        if (this.checked) {
            $('#label-konfirmasi').text(' Tersedia');
            $('#container-alasan').hide(250);
        } else {
            $('#label-konfirmasi').text(' Tidak Tersedia');
            $('#container-alasan').show(250);
        }
    });

    $('#alasan').on('change', function () {
        switch ($(this).val()) {
            case '1':
                $('#container-skpd').hide(250);
                break;
            case '2':
                $('#container-skpd').show(250);
                break;
        }
    });

    $('#form-konfirmasi').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'indikator/indikator_konfirmasi/submit',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () { },
            success: function (data) {
                // data = $.parseJSON(data);
                // console.log(data);
                if (data.status == 'success') {
                    $('#modal-konfirmasi').modal('hide');
                    $('#tb_indikator').DataTable().ajax.reload(null, false);
                    update_stats()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        // text: data.message
                    });
                    $('#tb_sub').DataTable().ajax.reload(null, false);
                    update_stats()
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        // text: data.message
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Berhasil',
                        // text: data.message
                    });
                }
            }
        });
    });
</script>