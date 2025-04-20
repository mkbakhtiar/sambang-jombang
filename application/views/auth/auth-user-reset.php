<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-edit',
            'class'   => '',
            'id'      => 'form-edit',
            'method'  => 'POST'
        ]); ?>
        <input type="hidden" class="form-control" name="act" id="act" value="reset">
        <input type="hidden" name="id_user" id="id_user" value="<?= $edit_data['id_user'] ?>">
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input type="text" class="form-control" id="username" value="<?= $edit_data['username'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Password Baru</label>
            <div class="input-group">
                <input type="password" class="form-control" name="password" id="password" value="">
                <div class="input-group-prepend">
                    <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary w-md">Submit</button>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<script>
    $('.select2').select2({
        theme: 'bootstrap4',
        dropdownParent: $("#modal-edit")
    });

    $('#form-edit').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'auth/save',
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

    $('#password-addon').on('click', function(e) {
        e.preventDefault();
        var inputPass = $(this).parent().siblings();
        if (inputPass.attr('type') == 'password') {
            inputPass.attr('type', 'text')
        } else {
            inputPass.attr('type', 'password')
        }
    })
</script>