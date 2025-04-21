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
                    <li>Urusan</li>
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

            <!-- Button Links -->
            <div class="row gy-4 mt-3">
                <div class="col-12 text-center">
                    <a href="https://jombangkab.bps.go.id/" target="_blank" class="btn btn-primary mx-2">BPS Jombang</a>
                    <a href="https://jatim.bps.go.id/" target="_blank" class="btn btn-primary mx-2">BPS Provinsi Jawa
                        Timur</a>
                    <a href="https://www.bps.go.id/" target="_blank" class="btn btn-primary mx-2">BPS RI</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about pt-0">
        <div class="mx-5" data-aos="fade-up">
            <div class="row">
                <div class="col-md-5 col-xl-4 col-sm-12">
                    <div class="flex-shrink-0 p-2 bg-white" style="width: 100%;">
                        <div class="section-header" style="margin-top: 0" data-aos="fade-up" data-aos-delay="">
                            <h2>Urusan</h2>
                        </div>
                        <div style="overflow: auto; min-height: 40vh; max-height: 75vh">
                            <ul class="list-unstyled ps-0">
                                <?php foreach ($props['list_urusan'] as $ku => $vu): ?>
                                    <li class="mb-1">
                                        <button class="btn btn-toggle align-items-center text-start rounded collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#<?= $vu['key'] ?>-collapse"
                                            aria-expanded="false">
                                            <?= $vu['nama_urusan']; ?>
                                        </button>
                                        <div class="collapse" id="<?= $vu['key'] ?>-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                                <?php foreach ($vu['list_ind'] as $kl => $vl): ?>
                                                    <li><a href="#" class="link-dark rounded btn-detail"
                                                            data-id="<?= createSlug(true, $vl['id_indikator'], $vl['nama_indikator']) ?>"><?= $vl['nama_indikator'] ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
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
        </div>
    </section>
</main>

<div id="modal-graph" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Grafik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container pt-4">

                    <div class="row mt-3" data-aos="fade-up" data-aos-delay="100">
                        <div class="card shadow shadow-sm">
                            <div class="card-body">
                                <div id="chart-sub-container"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php $this->load->view('front/partials/footer'); ?>


<script>
    $(document).ready(function () {
        $("#search-bar").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            if (value != '') {
                $(".collapse").collapse("show");
            } else {
                $(".collapse").collapse("hide");
            }
            $(".ul-list li").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.btn-detail').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#preloader2').css('display', 'block');
            $('#data-container').css('display', 'none');
            $('#modal-graph').css('top', '0');
            $.post(base_url + 'front/detail/' + id)
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