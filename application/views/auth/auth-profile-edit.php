<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-edit',
            'class'   => '',
            'id'      => 'form-edit',
            'method'  => 'POST'
        ]); ?>
        <input type="hidden" name="id_user" id="id_user" value="<?= $edit_data['id_user'] ?>">
        <input type="hidden" class="form-control" name="act" id="act" value="edit">
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input type="text" class="form-control" name="" id="" value="<?= $edit_data['username'] ?>" disabled>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $edit_data['nama_lengkap'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="nip">NIP</label>
            <input type="text" class="form-control" name="nip" id="nip" value="<?= $edit_data['nip'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">E-Mail</label>
            <input type="text" class="form-control" name="email" id="email" value="<?= $edit_data['email'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_hp">No HP</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= $edit_data['no_hp'] ?>">
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
                    location.reload();

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