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
        <nav>
            <div class="container">
                <ol>
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li>Harga</li>
                </ol>
            </div>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <meta http-equiv="Content-Security-Policy" content="script-src 'self' maps.googleapis.com">

    <main id="main">
        <section id="featured-services" style="margin:0;" class="featured-services">
            <div class="container" style="margin:0; padding: 20; width:212px;">

                <!-- <div class="row gy-4"> -->
                <!-- <div class="mx-5"> -->
                <!-- <div class="row"> -->
                <!-- <div class="col-md-5 col-xl-4 col-sm-12"> -->
                <!-- <div class="col-md- col-xl-2 col-sm-2"> -->
                <!-- <div class="flex-shrink-0 p-2 bg-white" style="width: 100%;"> -->
                <!-- <div style="min-height: 40vh;"> -->
                <div class="sidebar" style="height: 200vh;">
                    <ul class="list-unstyled ps-0">
                        <li class="mb-1">
                            <button class="btn btn-toggle align-items-center text-start rounded collapsed"
                                data-bs-toggle="collapse" data-bs-target="#inflasi-collapse" aria-expanded="false">
                                <!-- <img src="assets/front/img/inflasi.png" alt="" class="icon"> -->
                                Penanganan Inflasi
                            </button>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" data-id="dataIPH">Data IPH</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" data-id="dataHargaTPID">Harga</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail" data-id="dataStock">Stok
                                            Ketersediaan</a></li>
                                </ul>
                            </div>
                            <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail"
                                            data-id="dataProduksi">Produksi</a></li>
                                </ul>
                            </div>
                            <!-- <div class="collapse" id="inflasi-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                    <li><a href="#" class="link-dark rounded btn-detail"
                                            data-id="dataKosong">Distribusi</a></li>
                                </ul>
                            </div> -->
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
                <div id="data-container" style="display: none;">
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

                /* .btn-toggle .icon {
        margin-right: 10px;
    } */

                .btn-detail {
                    display: flex;
                    align-items: center;
                    font-size: 1rem;
                }

                /* .btn-detail .icon {
        margin-right: 10px;
    } */

                .btn-toggle-nav {
                    margin-left: 30px;
                }
            </style>

            </div>



            </div>
            </div>
        </section>

        <div id="modal-komoditi" class="modal bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="width: 100%; max-width: 95vw;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Harga Komoditi Pokok</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div id="modal-kesehatan" class="modal bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="width: 100%; max-width: 95vw;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kesehatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </main>


    <?php $this->load->view('front/partials/footer'); ?>
    <script>
        $('#harga').on('click', function (e) {
            e.preventDefault();
            var modal = $('#modal-komoditi');
            $.ajax({
                url: "<?php echo base_url('Front/komoditi'); ?>",
                method: "GET",
                success: function (data) {
                    modal.find('.modal-title').html('Perkembangan Harga Komoditi');
                    modal.find('.modal-body').html(data);
                    modal.modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        $(document).ready(function () {
            $('#form-search').on('submit', function (e) {
                e.preventDefault();
                var value = $('#search-bar').val().toLowerCase();
                window.open(base_url + 'front/data?q=' + value, '_self');
            });
        });

    </script>

    <script>
        //     $('#kesehatan').on('click', function(e) {
        //     e.preventDefault();
        //     var modal = $('#modal-kesehatan');

        //     // Memanggil URL kedua terlebih dahulu
        //     $.ajax({
        //         url: "<?php echo base_url('Api/tempattidur'); ?>",
        //         method: "GET",
        //         success: function(data) {
        //             // Lakukan sesuatu dengan data dari URL kedua

        //             // Setelah URL kedua berhasil dimuat, memanggil URL pertama
        //             $.ajax({
        //                 url: "<?php echo base_url('Front/kesehatan'); ?>",
        //                 method: "GET",
        //                 success: function(data) {
        //                     modal.find('.modal-title').html('Kesehatan');
        //                     modal.find('.modal-body').html(data);
        //                     modal.modal('show');
        //                 },
        //                 error: function(xhr, status, error) {
        //                     console.error(xhr.responseText);
        //                 }
        //             });
        //         },
        //         error: function(xhr, status, error) {
        //             console.error(xhr.responseText);
        //         }
        //     });
        // });
    </script>


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
    <script>
        $(document).ready(function () {
            $('.btn-detail').on('click', function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                $('#preloader2').css('display', 'block');
                $('#data-container').css('display', 'none');
                $('#modal-graph').css('top', '0');
                $.post(base_url + 'Front/' + id)
                    .done(function (data) {
                        $('#data-container').html(data);
                        $('#preloader2').css('display', 'none');
                        $('#data-container').css('display', 'block');
                        $('html, body').animate({
                            scrollTop: $("#data-container").offset().top - 100
                        }, 500);
                    });
            });
        });
    </script>

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