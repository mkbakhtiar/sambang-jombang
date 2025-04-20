<div class="col-l2">
    <div>
        <?= form_open('', [
            'name'    => 'form-edit',
            'class'   => '',
            'id'      => 'form-edit',
            'method'  => 'POST'
        ]); ?>
        <input type="hidden" class="form-control" name="act" id="act" value="<?= $edit ? 'edit' : 'add' ?>">
        <?php if ($edit) : ?>
            <input type="hidden" name="id_user" id="id_user" value="<?= $edit ? $edit_data['id_user'] : '' ?>">
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="<?= $edit ? $edit_data['username'] : '' ?>">
        </div>
        <?php if (!$edit) : ?>
            <div class="mb-3">
                <label class="form-label" for="password">Password</label>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" id="password" value="">
                    <div class="input-group-prepend">
                        <button class="btn btn-light ms-0" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= $edit ? $edit_data['nama_lengkap'] : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="id_skpd">SKPD</label>
            <select class="form-control select2" name="id_skpd" id="id_skpd" style="width: 100%;" required>
                <option value="" disabled selected>Pilih SKPD</option>
                <?php foreach ($skpd as $ks => $vk) : ?>
                    <option value="<?= $vk['id_skpd'] ?>" <?= $edit ? ($vk['id_skpd'] == $edit_data['id_skpd'] ? 'selected' : '') : '' ?>><?= $vk['nama_skpd'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="id_role">Role</label>
            <select class="form-control select2" name="id_role" id="id_role" style="width: 100%;" required>
                <option value="" disabled selected>Pilih Role</option>
                <?php foreach ($role as $ks => $vk) : ?>
                    <option value="<?= $vk['id_role'] ?>" <?= $edit ? ($vk['id_role'] == $edit_data['id_role'] ? 'selected' : '') : '' ?>><?= $vk['nama_role'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nip">NIP</label>
            <input type="text" class="form-control" name="nip" id="nip" value="<?= $edit ? $edit_data['nip'] : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="email">E-Mail</label>
            <input type="text" class="form-control" name="email" id="email" value="<?= $edit ? $edit_data['email'] : '' ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="no_hp">No HP</label>
            <input type="text" class="form-control" name="no_hp" id="no_hp" value="<?= $edit ? $edit_data['no_hp'] : '' ?>">
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