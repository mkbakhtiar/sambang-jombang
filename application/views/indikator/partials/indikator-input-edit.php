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

    /* Status button styles */
    .status-btn-group {
        margin-bottom: 1rem;
    }
    
    .status-btn {
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        margin-right: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .status-btn.active {
        color: white;
        font-weight: bold;
    }
    
    .status-btn-sangat-sementara.active {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .status-btn-sementara.active {
        background-color: #fd7e14;
        border-color: #fd7e14;
    }
    
    .status-btn-final.active {
        background-color: #28a745;
        border-color: #28a745;
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

<!-- Status field with button-style options -->
<div class="mb-3">
    <label class="form-label">Status Data</label>
    <div class="status-btn-group">
        <input type="radio" name="status_data" id="status-sangat-sementara" value="sangat_sementara" class="d-none" <?= $props['edit'] && isset($props['cur_data']['status_data']) && $props['cur_data']['status_data'] == 'sangat_sementara' ? 'checked' : '' ?>>
        <label for="status-sangat-sementara" class="status-btn status-btn-sangat-sementara <?= $props['edit'] && isset($props['cur_data']['status_data']) && $props['cur_data']['status_data'] == 'sangat_sementara' ? 'active' : '' ?>">Sangat Sementara</label>
        
        <input type="radio" name="status_data" id="status-sementara" value="sementara" class="d-none" <?= $props['edit'] && isset($props['cur_data']['status_data']) && $props['cur_data']['status_data'] == 'sementara' ? 'checked' : '' ?>>
        <label for="status-sementara" class="status-btn status-btn-sementara <?= $props['edit'] && isset($props['cur_data']['status_data']) && $props['cur_data']['status_data'] == 'sementara' ? 'active' : '' ?>">Sementara</label>
        
        <input type="radio" name="status_data" id="status-final" value="final" class="d-none" <?= $props['edit'] && isset($props['cur_data']['status_data']) && $props['cur_data']['status_data'] == 'final' ? 'checked' : '' ?>>
        <label for="status-final" class="status-btn status-btn-final <?= $props['edit'] && isset($props['cur_data']['status_data']) && $props['cur_data']['status_data'] == 'final' ? 'active' : '' ?>">Final</label>
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

        // Status button functionality
        $('.status-btn').on('click', function() {
            // Remove active class from all buttons
            $('.status-btn').removeClass('active');
            // Add active class to clicked button
            $(this).addClass('active');
            // Check the associated radio button
            $(this).prev('input[type=radio]').prop('checked', true);
        });
    });
</script>