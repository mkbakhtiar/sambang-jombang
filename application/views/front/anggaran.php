<?php $this->load->view('front/partials/header'); ?>

<script>
    document.addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

</script>

<main id="main">
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center"
            style="background-image: url('<?= base_url('assets/front') ?>/img/hero-img.svg')">
            <div class="container position-relative">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 text-center">
                    </div>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Publikasi</li>
                    <li>Informasi Keuangan Daerah</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="search" class="search">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col--12 position-relative align-self-start order-lg-last order-last">
                    <form action="#" class="form-search d-flex align-items-stretch aos-init aos-animate"
                        data-aos="fade-up" data-aos-delay="300">
                        <input type="text" class="form-control" placeholder="Pencarian Data" id="search-bar">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <html lang="en">

    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <meta charset="UTF-8">
        <title>Filter Buku</title>
        <!-- Masukkan referensi ke jQuery di sini jika belum ada -->
    </head>

    <body>
        <br>
        <div class="container">

            <div class="card card-folders">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col mr-auto">
                            <h4 class="card-title m-0">Folders</h4>
                        </div>
                        <div class="col col-auto pr-2">
                            <div class="btn-group">
                                <button class="btn btn-sm btn-outline-secondary" id="btn-list"><i
                                        class="fa fa-th-list fa-lg"></i></button>
                                <button class="btn btn-sm btn-outline-secondary outline-none active" id="btn-grid"><i
                                        class="fa fa-th-large fa-lg"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Folders Container -->
                <div class="card-body" id="foldersGroup">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><i class="far fa-folder"></i>&nbsp; Folders</li>
                    </ol>
                    <id="main-folders" class="d-flex align-items-stretch flex-wrap">
                        <div class="d-inline-flex">
                            <button class="folder-container" id="2023">
                                <div class="folder-icon">
                                    <i class="fa fa-folder folder-icon-color"></i>
                                </div>
                                <div class="folder-name">2023</div>
                            </button>
                        </div>
                        <div class="d-inline-flex">
                            <button class="folder-container" id="2024">
                                <div class="folder-icon">
                                    <i class="fa fa-folder folder-icon-color"></i>
                                </div>
                                <div class="folder-name">2024</div>
                            </button>
                        </div>
                </div>
                <div class="card-body d-none" id="foldersSubGroup">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><i class="far fa-folder"></i>&nbsp; Folders</li>
                    </ol>
                    <id="main-folders" class="d-flex align-items-stretch flex-wrap">
                        <div class="d-inline-flex">
                            <button class="folder-container" id="2023">
                                <div class="folder-icon">
                                    <i class="fa fa-folder folder-icon-color"></i>
                                </div>
                                <div class="folder-name">TEST</div>
                            </button>
                        </div>
                        <div class="d-inline-flex">
                            <button class="folder-container" id="2024">
                                <div class="folder-icon">
                                    <i class="fa fa-folder folder-icon-color"></i>
                                </div>
                                <div class="folder-name">TEST2</div>
                            </button>
                        </div>
                </div>

                <!-- End Folders Container -->
                <!-- Files Container -->
                <div class="card-body d-none" id="filesGroup2023">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" id="backToFolders"><i class="far fa-folder"></i>&nbsp;
                                Folders</a></li>
                        <li class="breadcrumb-item active">2023</li>
                    </ol>
                    <div id="main-files" class="d-flex align-items-stretch flex-wrap">
                        <?php foreach ($props['list_anggaran_2023'] as $kb => $vb): ?>
                            <div class="d-inline-flex">
                                <button class="folder-container"
                                    onclick="window.location.href='<?= base_url('front/infokeuangan/anggaran/') . createSlug(true, $vb['id_anggaran'], $vb['judul']) ?>'">
                                    <div class="folder-icon">
                                        <?php if ($vb['cover_name'] == ''): ?>
                                            <img src="<?= base_url('assets/front/img/buku.jpg') ?>" alt="" class="img-fluid">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/upload/' . $vb['cover_name']) ?>" alt=""
                                                class="img-fluid">
                                        <?php endif; ?>
                                    </div>
                                    <div class="folder-name">
                                        <?= $vb['judul'] ?>
                                    </div>
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="card-body d-none" id="filesGroup2024">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" id="backToFolders"><i class="far fa-folder"></i>&nbsp;
                                Folders</a></li>
                        <li class="breadcrumb-item active">2024</li>
                    </ol>
                    <div id="main-files" class="d-flex align-items-stretch flex-wrap">
                        <div class="d-inline-flex">
                            <button class="folder-container" id="2024ringkasan">
                                <div class="folder-icon">
                                    <i class="fa fa-folder folder-icon-color"></i>
                                </div>
                                <div class="folder-name">
                                    Informasi Ringkasan RKA Perubahan APBD
                                </div>
                            </button>
                        </div>
                        <?php foreach ($props['list_anggaran_2024'] as $kb => $vb): ?>
                            <div class="d-inline-flex">
                                <button class="folder-container"
                                    onclick="window.location.href='<?= base_url('front/infokeuangan/anggaran/') . createSlug(true, $vb['id_anggaran'], $vb['judul']) ?>'">
                                    <div class="folder-icon">
                                        <?php if ($vb['cover_name'] == ''): ?>
                                            <img src="<?= base_url('assets/front/img/buku.jpg') ?>" alt="" class="img-fluid">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/upload/' . $vb['cover_name']) ?>" alt=""
                                                class="img-fluid">
                                        <?php endif; ?>
                                    </div>
                                    <div class="folder-name">
                                        <?= $vb['judul'] ?>
                                    </div>
                                </button>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>

                <div class="card-body d-none" id="filesGroup2024ringkasan">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" id="backToFolders"><i class="far fa-folder"></i>&nbsp;
                                Folders</a></li>
                        <li class="breadcrumb-item active">2024</li>
                        <li class="breadcrumb-item active">Informasi Ringkasan RKA Perubahan APBD</li>

                    </ol>
                    <div id="main-files" class="d-flex align-items-stretch flex-wrap">
                        <?php foreach ($props['list_anggaran_2024_ringkasan'] as $kb => $vb): ?>
                            <div class="d-inline-flex">
                                <button class="folder-container"
                                    onclick="window.location.href='<?= base_url('front/infokeuangan/anggaran/') . createSlug(true, $vb['id_anggaran'], $vb['judul']) ?>'">
                                    <div class="folder-icon">
                                        <?php if ($vb['cover_name'] == ''): ?>
                                            <img src="<?= base_url('assets/front/img/buku.jpg') ?>" alt="" class="img-fluid">
                                        <?php else: ?>
                                            <img src="<?= base_url('assets/upload/' . $vb['cover_name']) ?>" alt=""
                                                class="img-fluid">
                                        <?php endif; ?>
                                    </div>
                                    <div class="folder-name">
                                        <?= $vb['judul'] ?>
                                    </div>
                                </button>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <!-- End Files Container -->
            </div>
        </div>

        </div>
        <br>

        <style>
            /* Define folder colors */
            .folder-color {
                color: #FFC107;
            }

            .folder-color-light {
                color: #FFD95A;
            }

            .folder-color-dark {
                color: #E6AC00;
            }

            /* Styles for .card-folders */
            .card-folders .card-body>.breadcrumb {
                margin-left: -1.25em;
                margin-right: -1.25em;
                margin-top: -1.25em;
                border-radius: 0;
            }

            /* Styles for folder elements */
            .folder-container {
                text-align: center;
                margin-left: 1rem;
                margin-right: 1rem;
                margin-bottom: 1.5rem;
                width: 100px;
                padding: 0;
                align-self: start;
                background: none;
                border: none;
                outline-color: transparent !important;
                cursor: pointer;
            }

            .folder-icon {
                font-size: 3em;
                line-height: 1.25em;
            }

            .folder-icon-color {
                color: #FFC107;
                text-shadow: 1px 1px 0px #E6AC00;
            }

            .folder-name {
                overflow-wrap: break-word;
                word-wrap: break-word;
                hyphens: auto;
            }

            /* Flex-column folder styles */
            .flex-column .folder-container {
                display: flex;
                width: auto;
                min-width: 100px;
                text-align: left;
                margin: 0;
                margin-bottom: 1rem;
            }

            .flex-column .folder-icon,
            .flex-column .folder-name {
                display: inline-flex;
            }

            .flex-column .folder-icon {
                font-size: 1.4em;
                margin-right: 1rem;
            }

            /* File icon styles */
            .file-icon-color {
                color: #999;
            }

            .breadcrumb-item.active {
                margin-top: 20px;
                margin-left: 20px;
            }

            .breadcrumb-item {
                margin-top: 20px;
                margin-left: 20px;
            }

            .folder-icon {
                width: 100px;
                /* Atur lebar ikon folder */
                height: 100px;
                /* Atur tinggi ikon folder */
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }

            .folder-icon img {
                max-width: 100%;
                /* Memastikan gambar tidak melebar di luar folder-icon */
                max-height: 100%;
                /* Memastikan gambar tidak terlalu tinggi di luar folder-icon */
                object-fit: cover;
                /* Memastikan gambar menyesuaikan diri dengan baik ke dalam elemen */
            }

            /* Gaya untuk judul */
            .folder-name {
                color: black;
                font-weight: bold;
                transition: color 0.3s ease;
            }

            /* Gaya hover untuk judul */
            .folder-container:hover .folder-name {
                color: blue;
                /* Ubah warna sesuai keinginan */
            }
        </style>

        <script>

            $(document).ready(function () {
                // Grid or list selection
                $('#btn-list').on('click', function () {
                    $('#main-folders').addClass('flex-column');
                    $('#btn-grid').removeClass('active')
                    $(this).addClass('active')
                });
                $('#btn-grid').on('click', function () {
                    $('#main-folders').removeClass('flex-column');
                    $('#btn-list').removeClass('active')
                    $(this).addClass('active')
                });
                $('#btn-list').on('click', function () {
                    $('#main-files').addClass('flex-column');
                    $('#btn-grid').removeClass('active')
                    $(this).addClass('active')
                });
                $('#btn-grid').on('click', function () {
                    $('#main-files').removeClass('flex-column');
                    $('#btn-list').removeClass('active')
                    $(this).addClass('active')
                });

                // Open folder and see files
                $('#2023').on('click', function () {
                    $('#filesGroup2023').removeClass('d-none');
                    $('#foldersGroup').addClass('d-none')
                });
                $('#2024').on('click', function () {
                    $('#filesGroup2024').removeClass('d-none');
                    $('#foldersGroup').addClass('d-none')
                });
                $('#2024ringkasan').on('click', function () {
                    $('#filesGroup2024ringkasan').removeClass('d-none');
                    $('#filesGroup2024').addClass('d-none');
                    $('#filesGroup2023').addClass('d-none');
                    $('#foldersSubGroup').addClass('d-none')
                });
                $('a#backToFolders').on('click', function () {
                    $('#foldersGroup').removeClass('d-none');
                    $('#foldersSubGroup').addClass('d-none');
                    $('#filesGroup2024ringkasan').addClass('d-none');
                    $('#filesGroup2023').addClass('d-none')
                    $('#filesGroup2024').addClass('d-none')
                });
            });
            $("#search-bar").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".ul-list li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
                console.log(value);
            });

            $('.btn-detail').on('click', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.post(base_url + 'front/detail', {
                    id: id,
                })
                    .done(function (data) {
                        $('#data-container').html(data);
                    });
            });

            // $('#container-infografis').hide();
            // $('#span-infografis').hide();

            $('#btn-buku').on('click', function (e) {
                e.preventDefault();
                $('#container-infografis').hide(100);
                $('#container-buku').show(100);
                $('#span-infografis').hide(100);
                $('#span-buku').show(100);
            });
            $('#btn-infografis').on('click', function (e) {
                e.preventDefault();
                $('#container-buku').hide(100);
                $('#container-infografis').show(100);
                $('#span-buku').hide(100);
                $('#span-infografis').show(100);
            });

        </script>
    </body>

    <?php $this->load->view('front/partials/footer'); ?>