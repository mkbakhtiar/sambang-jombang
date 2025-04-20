<?php isset($verifikasi) ? $edit = true : $edit = false ?>

<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-verifikasi',
            'class'   => '',
            'id'      => 'form-verifikasi',
            'method'  => 'POST'
        ]); ?>
        <div class="mb-3 text-center">
            <h5>Apakah Data Sudah Sesuai dan Lolos Verifikasi?</h5>
        </div>
        <input type="hidden" name="id_data" value="<?= $id ?>">
        <div class="mb-3 mx-auto">
            <div class="form-check form-switch form-switch-lg mb-1 d-flex justify-content-center" dir="ltr">
                <input type="checkbox" class="form-check-input" id="verifikasi" name="verifikasi" value="1" <?= $edit ? ($verifikasi['status_verifikasi'] == '1' ? 'checked' : '') : 'checked' ?>>
            </div>
            <div class="mb-3 d-flex justify-content-center" dir="ltr">
                <label class="form-check-label" for="verifikasi" id="label-verifikasi"> Lolos</label>
            </div>
        </div>

        <div class="lock-data-container">
            <div class="mb-3 text-center">
                <h5>Kunci Data? </h5>
            </div>
            <div class="mb-3 mx-auto">
                <div class="form-check form-switch form-switch-lg mb-1 d-flex justify-content-center" dir="ltr">
                    <input type="checkbox" class="form-check-input" id="lock_data" name="lock_data" value="1" <?= $edit ? ($verifikasi['lock_data'] == '1' ? 'checked' : '') : 'checked' ?>>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="keterangan">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"><?= $edit ? ($verifikasi['keterangan']) : '' ?></textarea>
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
        $('.lock-data-container').hide();
        $('input[type=checkbox][name=verifikasi]').trigger('change');
    });

    $('input[type=checkbox][name=verifikasi]').on('change', function() {
        if (this.checked) {
            $('#label-verifikasi').text(' Lolos');
            $('#keterangan').attr('required', false);
            $('.lock-data-container').show(300);
        } else {
            $('#label-verifikasi').text(' Tidak Lolos');
            $('#keterangan').attr('required', true);
            $('#lock-data').attr('disabled', true);
            $('.lock-data-container').hide(300);
        }
    });

    $('#form-verifikasi').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'indikator/data_verifikasi/submit',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                if (data.status == 'success') {
                    $('#modal-verifikasi').modal('hide');
                    $('#tb-data-verifikasi').DataTable().ajax.reload(null, false);
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