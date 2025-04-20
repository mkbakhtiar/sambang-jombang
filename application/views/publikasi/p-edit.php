<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-edit',
            'class'   => '',
            'id'      => 'form-edit',
            'method'  => 'POST'
        ]); ?>
        <input type="hidden" class="form-control" name="act" id="act" value="<?= $act ?>">
        <?php foreach ($edit_data as $ke => $kv) : ?>
            <?php if ($kv['type'] != 'hidden' && $kv['type'] != 'textarea' && $kv['type'] != 'select_skpd') : ?>
                <div class="mb-3">
                    <label class="form-label" for="<?= $kv['name'] ?>"><?= $kv['label'] ?></label>
                    <input type="<?= $kv['type'] ?>" class="form-control" name="<?= $kv['name'] ?>" id="<?= $kv['name'] ?>" value="<?= $kv['data'] ?>">
                </div>
            <?php elseif ($kv['type'] == 'textarea') : ?>
                <div class="mb-3">
                    <label class="form-label" for="<?= $kv['name'] ?>"><?= $kv['label'] ?></label>
                    <textarea class="form-control" name="<?= $kv['name'] ?>" id="<?= $kv['name'] ?>" rows="3"><?= $kv['data'] ?></textarea>
                </div>
            <?php elseif ($kv['type'] == 'select_skpd' && $this->session->admin) : ?>
                <div class="mb-3">
                    <label class="form-label" for="<?= $kv['name'] ?>"><?= $kv['label'] ?></label>
                    <select class="form-control select2" name="<?= $kv['name'] ?>" id="<?= $kv['name'] ?>" style="width: 100%;" required>
                        <option value="" disabled selected>Pilih SKPD</option>
                        <?php foreach ($kv['option'] as $ks => $vk) : ?>
                            <option value="<?= $vk['id_skpd'] ?>" <?= $kv['data'] != null ? ($vk['id_skpd'] == $kv['data'] ? 'selected' : '') : '' ?>><?= $vk['nama_skpd'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php elseif ($kv['type'] == 'hidden' && $act != 'add') : ?>
                <input type="<?= $kv['type'] ?>" class="form-control" name="<?= $kv['name'] ?>" id="<?= $kv['name'] ?>" value="<?= $kv['data'] ?>">
            <?php endif; ?>
        <?php endforeach; ?>


        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-md" id="btn-submit">Simpan</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'publikasi/save/<?= $type ?>',
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                showPreloader();
                var btn = $('#btn-submit');
                btn.attr('disabled', true);
                btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            },
            success: function(data) {
                // data = $.parseJSON(data);
                // console.log(data);
                if (data.status == 'success') {
                    $('#modal-edit').modal('hide');
                    $('#tb_data').DataTable().ajax.reload(null, false);

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: data.message
                    });

                    hidePreloader()

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Tidak Berhasil',
                        text: data.message
                    });
                    
                    hidePreloader();
                }
            }
        });
    });

    // $('input[type="file"][name="cover"]').attr('accept', '.jpg,.jpeg,.png');
    // $('input[type="file"][name="cover"]').change(function() {
    //     var ext = (this.value).split(".").pop();
    //     switch (ext) {
    //         case 'jpg':
    //         case 'jpeg':
    //         case 'png':
    //             break;
    //         default:
    //             alert('This is not an allowed file type.');
    //             this.value = '';
    //     }
    // });

    // $('input[type="file"][name="file"]').attr('accept', '.pdf');
    // $('input[type="file"][name="file"]').change(function() {
    //     var ext = (this.value).split(".").pop();
    //     switch (ext) {
    //         case 'pdf':
    //             break;
    //         default:
    //             alert('This is not an allowed file type.');
    //             this.value = '';
    //     }
    // });

    // Atur aksesptor file untuk input file "cover"
    $('input[type="file"][name="cover"]').attr('accept', '.jpg,.jpeg,.png');

    // Tangani perubahan pada input file "cover"
    $('input[type="file"][name="cover"]').change(function() {
        var ext = $(this).val().split('.').pop().toLowerCase(); // Ambil ekstensi file dan ubah menjadi huruf kecil
        // Periksa ekstensi file
        switch (ext) {
            case 'jpg':
            case 'jpeg':
            case 'png':
                break;
            default:
                alert('This is not an allowed file type. Only JPG, JPEG, and PNG files are allowed.');
                $(this).val(''); // Kosongkan nilai input file jika ekstensi tidak diizinkan
        }
    });

    // Atur aksesptor file untuk input file "file"
    $('input[type="file"][name="file"]').attr('accept', '.pdf');

    // Tangani perubahan pada input file "file"
    $('input[type="file"][name="file"]').change(function() {
        var ext = $(this).val().split('.').pop().toLowerCase(); // Ambil ekstensi file dan ubah menjadi huruf kecil
        // Periksa ekstensi file
        switch (ext) {
            case 'pdf':
                break;
            default:
                alert('This is not an allowed file type. Only PDF files are allowed.');
                $(this).val(''); // Kosongkan nilai input file jika ekstensi tidak diizinkan
        }
    });


    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            dropdownParent: $("#modal-edit")
        });
    });
</script>