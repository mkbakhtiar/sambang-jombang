<?php $this->load->view('partials/head-main') ?>
<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });
</script>

<head>
    <meta charset="utf-8" />
    <title>Login | Satu Data Jombang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link href="<?= base_url('assets/images/') ?>logo-jombang.png" rel="icon" />
    <!-- Google Sign-In API -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    
    <?php $this->load->view('partials/head-css') ?>
    
    <style>
        .google-btn {
            width: 100%;
            height: 42px;
            background-color: #4285f4;
            border-radius: 4px;
            box-shadow: 0 3px 4px 0 rgba(0,0,0,.25);
            cursor: pointer;
            display: flex;
            align-items: center;
            margin: 0 auto;
        }
        .google-icon-wrapper {
            width: 40px;
            height: 40px;
            border-radius: 2px;
            background-color: #fff;
            margin-left: 1px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .google-icon {
            width: 18px;
            height: 18px;
        }
        .btn-text {
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            margin-left: 24px;
            text-align: center;
            flex-grow: 1;
            padding-right: 40px;
        }
    </style>
</head>

<?php $this->load->view('partials/body') ?>

<div class="auth-page">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-xxl-3 col-lg-4 col-md-5">
                <div class="auth-full-page-content d-flex p-sm-5 p-4">
                    <div class="w-100">
                        <div class="d-flex flex-column h-100">
                            <div class="mb-4 mb-md-5 text-center">
                                <img src="assets/images/logo-jombang.png" alt="" height="60">
                                <!-- Menambah direct kembali ke Home -->
                                <a href="<?= base_url() ?>">
                                    <h4 class="mt-2">Satu Data Kabupaten Jombang</h4>
                                </a>
                            </div>
                            <div class="auth-content my-auto">
                                <div class="text-center">
                                    <h5 class="mb-0">Selamat Datang!</h5>
                                    <p class="text-muted mt-2">Login atau daftar cukup dengan sekali klik</p>
                                </div>
                                
                                <div class="mt-5 pt-2">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-4 text-muted fw-medium text-center">- Login/Daftar dengan Google -</h5>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <div id="g_id_onload"
                                            data-client_id="583603102197-63th62gs4mkfqklk2cfdmm57pvmf32u3.apps.googleusercontent.com"
                                            data-callback="handleCredentialResponse"
                                            data-auto_prompt="false">
                                        </div>
                                        <div class="g_id_signin"
                                            data-type="standard"
                                            data-size="large"
                                            data-theme="filled_blue"
                                            data-text="signin_with"
                                            data-shape="rectangular"
                                            data-logo_alignment="left"
                                            data-width="300">
                                        </div>
                                    </div>
                                    
                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">
                                            Dengan login, Anda menyetujui <a href="#" class="text-primary fw-semibold">Syarat dan Ketentuan</a> kami
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info mt-5" role="alert">
                                    <h5 class="alert-heading"><i class="mdi mdi-information-outline me-2"></i>Informasi</h5>
                                    <p>Satu Data Jombang menggunakan login otomatis dengan Google. Jika ini pertama kali Anda login, akun akan otomatis dibuat menggunakan data Google Anda.</p>
                                </div>
                            </div>
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">©
                                    <script>
                                        document.write(new Date().getFullYear())
                                    </script> Kabupaten Jombang
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end auth full page content -->
            </div>
            <!-- end col -->
            <div class="col-xxl-9 col-lg-8 col-md-7">
                <div class="auth-bg pt-md-5 p-4 d-flex">
                    <div class="bg-overlay bg-primary"></div>
                    <ul class="bg-bubbles">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <!-- end bubble effect -->
                    <div class="row justify-content-center align-items-center w-100">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <!-- Feature highlights -->
                                <div class="text-white py-5">
                                    <h1 class="text-white font-weight-bold mb-4">Satu Data Kabupaten Jombang</h1>
                                    <div class="feature-list">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-check-circle-outline font-size-24 me-3"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="text-white font-size-16 mb-1">Akses mudah dengan akun Google</h5>
                                                <p class="font-size-14 mb-0">Login cepat dan aman dengan akun Google Anda</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-check-circle-outline font-size-24 me-3"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="text-white font-size-16 mb-1">Akses data terpadu</h5>
                                                <p class="font-size-14 mb-0">Kelola dan akses semua data dalam satu platform</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-check-circle-outline font-size-24 me-3"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h5 class="text-white font-size-16 mb-1">Keamanan data terjamin</h5>
                                                <p class="font-size-14 mb-0">Data Anda selalu aman dengan sistem enkripsi modern</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>

<!-- JAVASCRIPT -->
<?php $this->load->view('partials/vendor-scripts') ?>

<script>
    function handleCredentialResponse(response) {
        // Send the ID token to your server
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= base_url("auth_old/google_login"); ?>');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                const result = JSON.parse(xhr.responseText);
                if (result.success) {
                    if (result.isNewRegistration) {
                        // This is a new registration, redirect to OPD selection page
                        window.location.href = '<?= base_url("skpd/select"); ?>';
                    } else {
                        if(result.isVerified){
                            window.location.href = '<?= base_url("admin/dashboard"); ?>';
                        }else{
                            window.location.href = '<?= base_url("skpd/verification_notice"); ?>';
                        }
                    }
                } else {
                    alert(result.message || 'Gagal login dengan Google');
                }
            } else {
                alert('Terjadi kesalahan saat login. Silakan coba lagi.');
            }
        };
        xhr.send('id_token=' + response.credential);
    }
    
    // For the custom Google button if needed
    document.getElementById('customGoogleBtn')?.addEventListener('click', function() {
        // Trigger Google Sign-In
        google.accounts.id.prompt();
    });
    
    // Display any flashdata messages
    <?php if($this->session->flashdata('pesan')): ?>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessage = '<?= $this->session->flashdata("pesan") ?>';
            if (flashMessage) {
                const messageContainer = document.createElement('div');
                messageContainer.innerHTML = flashMessage;
                document.querySelector('.auth-content').prepend(messageContainer);
                
                // Auto hide after 5 seconds
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                        alert.classList.add('fade');
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    });
                }, 5000);
            }
        });
    <?php endif; ?>
</script>

</body>
</html>