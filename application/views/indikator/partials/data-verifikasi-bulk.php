<?php isset($verifikasi) ? $edit = true : $edit = false ?>

<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-verifikasi-bulk',
            'class'   => '',
            'id'      => 'form-verifikasi-bulk',
            'method'  => 'POST'
        ]); ?>
        <div class="mb-3 text-center">
            <h5>Verifikasi Data Massal (<?= count($ids) ?> item)</h5>
        </div>
        
        <?php foreach ($ids as $id): ?>
            <input type="hidden" name="ids[]" value="<?= $id ?>">
        <?php endforeach; ?>
        
        <div class="mb-3 mx-auto">
            <h6 class="text-center">Apakah Data Sudah Sesuai dan Lolos Verifikasi?</h6>
            <div class="form-check form-switch form-switch-lg mb-1 d-flex justify-content-center" dir="ltr">
                <input type="checkbox" class="form-check-input" id="verifikasi" name="verifikasi" value="1" checked>
            </div>
            <div class="mb-3 d-flex justify-content-center" dir="ltr">
                <label class="form-check-label" for="verifikasi" id="label-verifikasi"> Lolos</label>
            </div>
        </div>

        <div class="lock-data-container">
            <div class="mb-3 text-center">
                <h6>Kunci Data? </h6>
            </div>
            <div class="mb-3 mx-auto">
                <div class="form-check form-switch form-switch-lg mb-1 d-flex justify-content-center" dir="ltr">
                    <input type="checkbox" class="form-check-input" id="lock_data" name="lock_data" value="1" checked>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="keterangan">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
        </div>
        <hr>
        <div class="alert alert-info">
            <small><i class="mdi mdi-information-outline me-1"></i> Tindakan ini akan menerapkan status verifikasi yang sama untuk semua data yang dipilih.</small>
        </div>
        <div class="mt-4 d-flex justify-content-center">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary w-md">Verifikasi Massal</button>
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

    $('#form-verifikasi-bulk').on('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda akan memverifikasi ' + <?= count($ids) ?> + ' data sekaligus. Lanjutkan?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Verifikasi',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'indikator/data_verifikasi_bulk/submit',
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        // Tambahkan loading indicator jika diperlukan
                    },
                    success: function(data) {
                        if (data.status) {
                            $('#modal-verifikasi').modal('hide');
                            $('#tb-data-verifikasi').DataTable().ajax.reload(null, false);
                            update_stats();
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
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan pada server'
                        });
                    }
                });
            }
        });
    });
</script>