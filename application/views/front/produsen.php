<?php $this->load->view('front/partials/header'); ?>
<link href="<?= base_url('assets/front') ?>/css/sidebars.css" rel="stylesheet" />

<script>
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault();
    });
</script>

<main id="main">
    <div class="breadcrumbs">
        <div class="page-header d-flex align-items-center" style="background-image: url('<?= base_url('assets/front') ?>/img/hero-img.svg')">
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
                    <li>Produsen Data</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="search" class="search">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col--12 position-relative align-self-start order-lg-last order-last">
                    <form action="#" class="form-search d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <input type="text" class="form-control" placeholder="Pencarian Data" id="search-bar" style="color: black;">    
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
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
                            <h2>Produsen Data</h2>
                        </div>
                        <div style="overflow: auto; min-height: 40vh; max-height: 75vh">
                            <ul class="list-unstyled ps-0">
                                <?php foreach ($props['list_produsen'] as $ku => $vu) : ?>
                                    <?php if (count($vu['list_ind']) != 0) : ?>
                                        <li class="mb-1">
                                            <button class="btn btn-toggle align-items-center rounded text-start collapsed" data-bs-toggle="collapse" data-bs-target="#<?= $vu['key'] ?>-collapse" aria-expanded="false">
                                                <?= $vu['nama_skpd']; ?>
                                            </button>
                                            <div class="collapse" id="<?= $vu['key'] ?>-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                                <?php foreach ($vu['list_ind'] as $kl => $vl) : ?>
                                                    <li><a href="#" class="link-dark rounded btn-detail" data-id="<?= createSlug(true, $vl['id_indikator'], $vl['nama_indikator']) ?>"><?= $vl['nama_indikator'] ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-xl-8 col-sm-12">
                    <div id="data-container">
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('front/partials/footer'); ?>

<script>
    $(document).ready(function() {
        $("#search-bar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            if (value != '') {
                $(".collapse").collapse("show");
            } else {
                $(".collapse").collapse("hide");
            }
            $(".ul-list li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.btn-detail').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#preloader').css('display', 'block');
            $.post(base_url + 'front/detail/' + id)
                .done(function(data) {
                    $('#data-container').html(data);
                    $('#preloader').css('display', 'none');
                    $('html, body').animate({
                        scrollTop: $("#data-container").offset().top - 100
                    }, 500);
                });
        });
    });
</script>