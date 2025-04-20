<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... Bagian lain dari kode Anda ... -->
    <style>
        /* Gaya untuk dropdown */
        .dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1000;
            /* Sesuaikan styling dropdown sesuai kebutuhan */
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
    <!-- ... Bagian lain dari kode Anda ... -->

    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title><?= $title; ?></title>

    <link href="<?= base_url('assets/images/') ?>logo-jombang.png" rel="icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link href="<?= base_url('assets/front') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/front') ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="<?= base_url('assets/front') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/front') ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/front') ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/front') ?>/vendor/aos/aos.css" rel="stylesheet" />

    <link href="<?= base_url('assets/front') ?>/css/main.css?v=2" rel="stylesheet" />
</head>

<body>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="<?= base_url() ?>" class="logo d-flex align-items-center">
                <img src="<?= base_url('assets/images/') ?>logo-jombang1.png" alt="">
                <h1> </h1>
            </a>

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="<?= base_url() ?>"
                            class="<?= $this->uri->segment(1) == '' || $this->uri->segment(2) == 'front' ? 'active' : '' ?>">Home</a>
                    </li>
                    <li><a href="https://ckan.jombangkab.go.id/" target="_blank">Open Data</a></li>
                    <!-- <li><a href="<?= base_url('front/geospasial') ?>" class="<?= $this->uri->segment(2) == 'geospasial' ? 'active' : '' ?>">Geospasial</a></li> -->
                    <!-- <li><a href="<?= base_url('front/grafik_harga') ?>" class="<?= $this->uri->segment(2) == 'grafik_harga' ? 'active' : '' ?>">Grafik Harga</a></li> -->

                    <li class="dropdown">
                        <a href="#"
                            class="<?= $this->uri->segment(2) == 'geospasial_urusan' ? 'active' : '' ?>">Geospasial</a>
                        <ul class="dropdown-menu">
                            <!-- <li><a href="<?= base_url('front/geospasial_produsen') ?>" class="<?= $this->uri->segment(2) == 'geospasial_data' ? 'active' : '' ?>">Produsen Spasial</a></li> -->
                            <li><a href="<?= base_url('geoportal/geospasial_urusan') ?>"
                                    class="<?= $this->uri->segment(2) == 'geospasial_urusan' ? 'active' : '' ?>">Urusan
                                    Spasial</a></li>
                            <li><a href="https://gispotensi.jombangkab.go.id/" target="_blank">Gis Potensi Jombang</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#"
                            class="<?= $this->uri->segment(2) == 'data' || $this->uri->segment(2) == 'urusan' || $this->uri->segment(2) == 'produsen' || $this->uri->segment(2) == 'katalog_data' ? 'active' : '' ?>">Data</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('front/data') ?>"
                                    class="<?= $this->uri->segment(2) == 'data' ? 'active' : '' ?>">Data Statistik</a>
                            </li>
                            <li><a href="<?= base_url('front/urusan') ?>"
                                    class="<?= $this->uri->segment(2) == 'urusan' ? 'active' : '' ?>">Urusan Data</a>
                            </li>
                            <li><a href="<?= base_url('front/produsen') ?>"
                                    class="<?= $this->uri->segment(2) == 'produsen' ? 'active' : '' ?>">Produsen
                                    Data</a></li>
                            <li><a href="<?= base_url('front/katalog_data') ?>"
                                    class="<?= $this->uri->segment(2) == 'katalog_data' ? 'active' : '' ?>">Katalog
                                    Data</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="#"
                            class="<?= ($this->uri->segment(2) == 'infokeuangan' || $this->uri->segment(2) == 'publikasi') ? 'active' : '' ?>">Publikasi</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('front/publikasi') ?>"
                                    class="<?= $this->uri->segment(2) == 'publikasi' ? 'active' : '' ?>">Buku dan
                                    Infografis</a></li>
                            <li><a href="<?= base_url('front/infokeuangan') ?>"
                                    class="<?= $this->uri->segment(2) == 'infokeuangan' ? 'active' : '' ?>">Info
                                    Keuangan Daerah</a></li>
                        </ul>
                    </li>
                    <li><a href="<?= base_url('request_data') ?>"
                            class="<?= ($this->uri->segment(1) == 'request_data') ? 'active' : '' ?>">
                            Request Data
                        </a>
                    </li>

                    <!-- <li><a href="<?= base_url('front/publikasi') ?>" class="<?= $this->uri->segment(2) == 'publikasi' ? 'active' : '' ?>">Publikasi</a></li> -->
                </ul>
            </nav>
        </div>
    </header>