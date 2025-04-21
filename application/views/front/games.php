<?php $this->load->view('front/partials/header'); ?>
<link href="<?= base_url('assets/front') ?>/css/sidebars.css" rel="stylesheet" />

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
        <div class="section-header" style="margin-top: 0" data-aos="fade-up" data-aos-delay="">
            <h2>GAMES KOMINFO JOMBANG</h2>
            <p>&copy; Santik Kominfo</p>

        </div>
        <nav>
            <div class="container">
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Games</li>
                </ol>
            </div>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <meta http-equiv="Content-Security-Policy" content="script-src 'self' maps.googleapis.com">

    <main id="main">
        <section id="featured-services" style="margin:0;" class="featured-services">
            <div class="container" style="margin:0; padding: 20; width:212px;">

                <div class="sidebar" style="height: 150vh;">
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center text-start rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#carikata-collapse" aria-expanded="false">
                                <!-- <img src="assets/front/img/inflasi.png" alt="" class="icon"> -->
                                Mencari Kata
                            </button>
                            <div class="collapse" id="carikata-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="cariKata1Btn">LEVEL 1</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="carikata-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="cariKata2Btn">LEVEL 2</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center text-start rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#tts-collapse" aria-expanded="false">
                                <!-- <img src="assets/front/img/inflasi.png" alt="" class="icon"> -->
                                Teka Teki Silang
                            </button>
                            <div class="collapse" id="tts-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="TTS1Btn">LEVEL 1</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="tts-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="TTS2Btn">LEVEL 2</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center text-start rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#kuis-collapse" aria-expanded="false">
                                <!-- <img src="assets/front/img/inflasi.png" alt="" class="icon"> -->
                                Kuis
                            </button>
                            <div class="collapse" id="kuis-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="kuis1Btn">KUIS KOMINFO</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center text-start rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#inflasi-collapse" aria-expanded="false">
                                <!-- <img src="assets/front/img/inflasi.png" alt="" class="icon"> -->
                                Puzzle
                            </button>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="puzzle1Btn">LEVEL 1</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="puzzle2Btn">LEVEL 2</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" id="puzzle3Btn">LEVEL 3</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            </div>
            </div>
            <div class="col-md-7 col-xl-8 col-sm-12">
                <div id="preloader2">
                    Sedang Memuat Data <span class="dots"></span>
                </div>

                <!-- CARI KATA  -->
                <div class="col-md-8" id="carikata1"
                    style="display:none; padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/b7G5Vk_m-iQAFvBS71gAAA/9F23L9B?teacher_id=5032766321721344"
                        width="100%" height="1000vw"></iframe>
                </div>
                <div class="col-md-8" id="carikata2"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/vGK8tDDq-iQAEtG0L1gAAA/VFZ6YVM/kominfo-jombang?teacher_id=5500695089774592"
                        width="100%" height="1000vw"></iframe>
                </div>

                <!-- TTS  -->
                <div class="col-md-8" id="tts1"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/YYHqy8s1-iQAF2ZiL1gAAA/KF2VWKK/tts-edukasi-ko?teacher_id=5032766321721344"
                        width="100%" height="1000vw"></iframe>
                </div>
                <div class="col-md-8" id="tts2"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/HOYjGOtx-iQAEnFmGNgAAA/RF2KNRR/tts-kominfo-jo?teacher_id=5500695089774592"
                        width="100%" height="1000vw"></iframe>
                </div>
                <!-- KUIS  -->
                <div class="col-md-8" id="kuis1"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/4kc1unNr-iQAE3yFP1gAAA/KF22EKW/teknologi-dan-i?teacher_id=5032766321721344"
                        width="100%" height="1000vw"></iframe>
                </div>
                <div class="col-md-8" id="kuis2"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/vGK8tDDq-iQAEtG0L1gAAA/VFZ6YVM/kominfo-jombang?teacher_id=5500695089774592"
                        width="100%" height="1000vw"></iframe>
                </div>
                <div class="col-md-8" id="kuis3"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/vGK8tDDq-iQAEtG0L1gAAA/VFZ6YVM/kominfo-jombang?teacher_id=5500695089774592"
                        width="100%" height="1000vw"></iframe>
                </div>

                <!-- PUZZLE  -->
                <div class="col-md-8" id="puzzle1"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/rgzE0z_k-iQAEb0K5NgAAA/YF2HEYM/puzzle-1?teacher_id=5032766321721344"
                        width="100%" height="1000vw"></iframe>
                </div>
                <div class="col-md-8" id="puzzle2"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/YeykcK7--iQAFPUVdNgAAA/JF2QSJW/puzzle-2?teacher_id=5032766321721344"
                        width="100%" height="1000vw"></iframe>
                </div>
                <div class="col-md-8" id="puzzle3"
                    style="display:none;  padding:10px; flex-direction: column; align-items: center;">
                    <iframe
                        src="https://www.bookwidgets.com/play/ekYliHJ0-iQAEAYup1gAAA/3F24P3K/puzzle-3?teacher_id=5032766321721344"
                        width="100%" height="1000vw"></iframe>
                </div>
            </div>
            </div>

            <style>
                .icon {
                    width: 20px;
                    height: 20px;
                    /* margin-right: 10px; */
                }

                .btn-toggle {
                    display: flex;
                    align-items: center;
                    font-size: 1rem;
                }

                .btn-detail {
                    display: flex;
                    align-items: center;
                    font-size: 1rem;
                }


                .btn-toggle-nav {
                    margin-left: 30px;
                }
            </style>

            </div>



            </div>
            </div>
        </section>
    </main>
    <footer>
        <p class="text-center">&copy; 2024 Santik Kominfo</p>
    </footer>

    <?php $this->load->view('front/partials/footer'); ?>

    <style>
        #preloader2 {
            position: fixed;
            left: 65%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            display: none;
            text-align: center;
        }

        .dots::after {
            content: ' ';
            display: inline-block;
            width: 1em;
            text-align: left;
            animation: ellipsis steps(4, end) 2s infinite;
        }

        @keyframes ellipsis {
            0% {
                content: ' ';
            }

            25% {
                content: '.';
            }

            50% {
                content: '..';
            }

            75% {
                content: '...';
            }

            100% {
                content: '';
            }
        }
    </style>

    <style>
        section {
            display: flex;
        }

        .sidebar {
            width: 200px;
            background-color: #f4f4f4;
            padding: 0px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .content {
            /* flex-grow: 1; */
            padding: 20px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #007bff;
            color: #fff;
        }

        .content>div {
            display: none;
        }

        .content>div.active {
            display: block;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .content>div {
            margin-top: 100px;
            /* Adjust this value as needed */
        }
    </style>

    <script>
        // Fungsi untuk menampilkan elemen tertentu dan menyembunyikan lainnya
        function showElement(elementId, allElementIds) {
            allElementIds.forEach(function (id) {
                document.getElementById(id).style.display = (id === elementId) ? 'block' : 'none';
            });
        }

        // Definisikan semua tombol dengan ID elemen yang akan ditampilkan
        const buttonsAndElements = [
            { buttonId: 'cariKata1Btn', elementId: 'carikata1' },
            { buttonId: 'cariKata2Btn', elementId: 'carikata2' },
            { buttonId: 'puzzle1Btn', elementId: 'puzzle1' },
            { buttonId: 'puzzle2Btn', elementId: 'puzzle2' },
            { buttonId: 'puzzle3Btn', elementId: 'puzzle3' },
            { buttonId: 'kuis1Btn', elementId: 'kuis1' },
            { buttonId: 'TTS1Btn', elementId: 'tts1' },
            { buttonId: 'TTS2Btn', elementId: 'tts2' }
        ];

        // Dapatkan semua ID elemen yang perlu dikendalikan
        const allElementIds = buttonsAndElements.map(item => item.elementId);

        // Loop untuk menambahkan event listener ke setiap tombol
        buttonsAndElements.forEach(function (item) {
            document.getElementById(item.buttonId).addEventListener('click', function () {
                showElement(item.elementId, allElementIds);
            });
        });

    </script>