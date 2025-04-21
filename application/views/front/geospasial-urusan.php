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
                    <li>Geospasial</li>
                    <li>Urusan Spasial</li>
                </ol>
            </div>
        </nav>
    </div>
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
                                            <?= $vu['g_nama_urusan']; ?>
                                        </button>
                                        <div class="collapse" id="<?= $vu['key'] ?>-collapse">
                                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small ul-list">
                                                <?php foreach ($vu['judul'] as $titleArray): ?>
                                                    <?php foreach ($titleArray as $title): ?>
                                                        <li>
                                                            <a href="#" class="link-dark rounded btn-detail"
                                                                data-id="<?= createSlug(true, $title['pk']) ?>">
                                                                <?= $title['title'] ?>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
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
                    <div id="data-container">

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>



<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        new DataTable('#example', {
            "columns": [{
                "width": "5%"
            },
            {
                "width": "5%"
            },
            {
                "width": "40%"
            },
            {
                "width": "10%"
            },
            {
                "width": "35%"
            },
            {
                "width": "10%"
            },
            {
                "width": "5%"
            }
            ],
            fixedColumns: true,
            paging: true,
            scrollCollapse: true,
        });
    });
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
            $('#preloader').css('display', 'block');
            $.post(base_url + 'front/detailGeo/' + id)
                .done(function (data) {
                    $('#data-container').html(data);
                    $('#preloader').css('display', 'none');
                    $('html, body').animate({
                        scrollTop: $("#data-container").offset().top - 100
                    }, 500);
                });
        });
    });
</script>

<?php $this->load->view('front/partials/footer'); ?>