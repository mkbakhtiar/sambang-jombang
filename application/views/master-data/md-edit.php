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
            <?php if ($kv['type'] != 'hidden') : ?>
                <div class="mb-3">
                    <label class="form-label" for="<?= $kv['name'] ?>"><?= $kv['label'] ?></label>
                    <input type="<?= $kv['type'] ?>" class="form-control" name="<?= $kv['name'] ?>" id="<?= $kv['name'] ?>" value="<?= $kv['data'] ?>">
                </div>
            <?php elseif ($kv['type'] == 'hidden' && $act != 'add') : ?>
                <input type="<?= $kv['type'] ?>" class="form-control" name="<?= $kv['name'] ?>" id="<?= $kv['name'] ?>" value="<?= $kv['data'] ?>">
            <?php endif; ?>
        <?php endforeach; ?>


        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary w-md">Submit</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'masterdata/submit/<?= $type ?>',
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
                    $('#tb_data').DataTable().ajax.reload(null, false);

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

    $('input[name="nama_metadata"]').on('keyup', function(e) {
        $('input[name="key_metadata"]').val(
            create_key($(this).val())
        );
    });

    $('input[name="key_metadata"]').attr('readOnly', true);

    function create_key(str) {
        const reg = /[^A-Za-z]/gi
        const newStr = str.toLowerCase().replace(reg, "_").replace("__", "_");
        return newStr;
    }
</script>