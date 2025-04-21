<style>
    .select2-container--open {
        z-index: 2000
    }
</style>
<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-edit-sub',
            'class'   => '',
            'id'      => 'form-edit-sub',
            'method'  => 'POST'
        ]); ?>
        <input type="hidden" class="form-control" name="act" id="act" value="<?= $edit ? 'edit' : 'add' ?>">
        <input type="hidden" class="form-control" name="id_main_indikator" id="id_main_indikator" value="<?= $main_id ?>">
        <?php if ($edit) : ?>
            <input type="hidden" class="form-control" name="id_indikator" id="id_indikator" value="<?= $id_indikator ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label" for="nama_indikator">Nama Indikator</label>
            <input type="text" class="form-control" name="nama_indikator" id="nama_indikator" value="<?= $edit ? $edit_data['nama_indikator'] : null ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="definisi_operasional">Definisi Operasional</label>
            <input type="text" class="form-control" name="definisi_operasional" id="definisi_operasional" value="<?= $edit ? $edit_data['definisi_operasional'] : null ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="satuan">Satuan</label>
            <select class="form-control select2" name="id_satuan" id="id_satuan" style="width: 100%;" required>
                <option value="" disabled selected>Pilih Satuan</option>
                <?php foreach ($satuan as $ks => $vk) : ?>
                    <option value="<?= $vk['id_satuan'] ?>" <?= $edit ? ($vk['id_satuan'] == $edit_data['id_satuan'] ? 'selected' : '') : '' ?>><?= $vk['nama_satuan'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- <?php foreach ($props['metadata_cols'] as $kmc => $vmc) : ?>
            <div class="mb-3">
                <label for="<?= $vmc['key_metadata'] ?>" class="form-label"><?= $vmc['nama_metadata'] ?></label>
                <input type="text" class="form-control" id="<?= $vmc['key_metadata'] ?>" name="<?= $vmc['key_metadata'] ?>" value="<?= $edit ? $edit_data[$vmc['key_metadata']] : null ?>">
            </div>
        <?php endforeach; ?> -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-md">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#modal-edit")

        })
    });


    $('#form-edit-sub').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'indikator/sub_submit/',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                // data = $.parseJSON(data);
                console.log(data);
                if (data.status == 'success') {
                    $('#modal-edit').modal('hide');
                    $('#tb_sub').DataTable().ajax.reload(null, false);

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
</script>