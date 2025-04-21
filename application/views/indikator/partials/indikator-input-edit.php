<style>
    .custom-file-button input[type=file] {
        margin-left: -2px !important;
    }

    .custom-file-button input[type=file]::-webkit-file-upload-button {
        display: none;
    }

    .custom-file-button input[type=file]::file-selector-button {
        display: none;
    }

    .custom-file-button:hover label {
        background-color: #dde0e3;
        cursor: pointer;
    }
</style>

<?= form_open('', [
    'name'    => 'form-edit',
    'class'   => '',
    'id'      => 'form-edit',
    'method'  => 'POST',
    'enctype' => 'multipart/form-data'
]); ?>

<div class="mb-2">
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text">Data Angka</span>
        </div>
        <input type="hidden" name="id_indikator" id="id_indikator" value="<?= $props['id_indikator'] ?>">
        <input type="hidden" name="tahun" id="tahun" value="<?= $props['tahun'] ?>">
        <input class="form-control" type="<?= $props['edit'] ? ($props['cur_data']['data_angka'] == 'n/a' ? 'text' : 'number') : 'number' ?>" step="0.001" name="data-angka" id="data-angka" placeholder="" value="<?= $props['edit'] ? ($props['cur_data']['data_angka'] == 'n/a' ? 'n/a' : $props['cur_data']['data_angka']) : '' ?>" required <?= $props['edit'] ? ($props['cur_data']['data_angka'] == 'n/a' ? 'readonly' : '') : '' ?>>
        <div class="input-group-prepend">
            <span class="input-group-text"><?= $props['ind_data']['nama_satuan']; ?></span>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="input-group justify-content-center">
        <div class="form-check pl-3">
            <input class="form-check-input" type="checkbox" id="check-na" name="check-na" <?= $props['edit'] ? ($props['cur_data']['data_angka'] == 'n/a' ? 'checked' : '') : '' ?>>
            <label class="form-check-label" for="check-na">
                centang jika data tidak tersedia (n/a)
            </label>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="input-group custom-file-button">
        <label class="input-group-text" for="file">Data File</label>
        <input class="form-control" type="file" id="file" name="file">
    </div>
</div>

<div class="mb-3">
    <label class="form-label" for="catatan">Catatan</label>
    <input type="text" class="form-control" name="catatan" id="catatan" value="<?= $props['edit'] ? $props['cur_data']['catatan'] : '' ?>">
</div>

<div class="row justify-content-center">
    <button type="submit" id="btn-submit" class="btn btn-block btn-primary w-md">Simpan</button>
</div>

<?= form_close(); ?>

<script>
    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        var btn = $('#btn-submit');
        btn.attr('disabled', true)
        $.ajax({
            url: base_url + 'indikator/input_save',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {},
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Berhasil'
                    }).then((result) => {
                        if (result.value) {
                            $('#modal-edit').modal('hide');
                            $('#tb-data').DataTable().ajax.reload(null, false);
                        }
                    });


                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Berhasil',
                        text: 'Tidak Berhasil'
                    });
                }
            }
        });
    });

    $(document).ready(function() {
        $('input[type=checkbox][name=check-na]').trigger('change');
        $('input[type=checkbox][name=check-na]').on('change', function() {
            if (this.checked) {
                $('#data-angka').attr('type', 'text');
                $('#data-angka').val('n/a');
                $('#data-angka').attr('readonly', true);
            } else {
                $('#data-angka').attr('type', 'number');
                $('#data-angka').val();
                $('#data-angka').attr('readonly', false);
            }
        });
    });
</script>