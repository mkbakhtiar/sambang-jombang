<style>
    .select2-container--open {
        z-index: 2000
    }
</style>
<?php debug($konfirmasi) ?>
<?php isset($konfirmasi) ? $edit = true : $edit = false ?>

<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-konfirmasi',
            'class'   => '',
            'id'      => 'form-konfirmasi',
            'method'  => 'POST'
        ]); ?>
        <div class="mb-3 text-center">
            <h5>"<?= $konfirmasi['nama_indikator'] ?>" akan dipindah dari <u><?= $konfirmasi['nama_skpd_asal'] ?></u> ke <u><?= $konfirmasi['nama_skpd_pengganti'] ?></u>?</h5>
        </div>
        <input type="hidden" name="id_indikator" value="<?= $konfirmasi['id_indikator'] ?>">
        <input type="hidden" name="id_konfirmasi" value="<?= $konfirmasi['id_konfirmasi'] ?>">
        <input type="hidden" name="id_skpd_pengganti" value="<?= $konfirmasi['skpd_pengganti'] ?>">
        <div class="mb-3 mx-auto">
            <div class="form-check form-switch form-switch-lg mb-1 d-flex justify-content-center" dir="ltr">
                <input type="checkbox" class="form-check-input" id="konfirmasi" name="konfirmasi" value="1" checked>
            </div>
            <div class="mb-3 d-flex justify-content-center" dir="ltr">
                <label class="form-check-label" for="konfirmasi" id="label-konfirmasi"> Setuju</label>
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
    $(document).ready(function() {
        // $('.select2').select2({
        //     theme: 'bootstrap4',
        //     dropdownParent: $("#modal-konfirmasi"),
        //     minimumResultsForSearch: 10
        // });
        // $('#container-alasan').hide();
        // $('#container-skpd').hide();
        // $('input[type=checkbox][name=konfirmasi]').trigger('change');
        // $('#alasan').trigger('change');
    });

    $('input[type=checkbox][name=konfirmasi]').on('change', function() {
        if (this.checked) {
            $('#label-konfirmasi').text(' Setuju');
            $('#container-alasan').hide(250);
        } else {
            $('#label-konfirmasi').text(' Tolak');
            $('#container-alasan').show(250);
        }
    });

    $('#form-konfirmasi').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'indikator/transfer/submit',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
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