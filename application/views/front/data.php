<?php $this->load->view('front/partials/header'); ?>

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
                    <li>Data</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="search" class="search">
        <div class="container" data-aos="fade-up">
            <!-- <div class="row gy-4">
                <div class="section-header" style="margin-top: 0" data-aos="fade-up" data-aos-delay="">
                    <h2>Pencarian</h2>
                </div>
            </div> -->
            <div class="row gy-4">
                <div class="col--12 position-relative align-self-start order-lg-last order-last">
                    <form action="#" class="form-search d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <input type="text" class="form-control" placeholder="Pencarian Data" id="search-bar" value="<?= $this->input->get('q') ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section id="horizontal-pricing" class="horizontal-pricing pt-0">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>Hasil Pencarian</h2>
            </div>

            <?php foreach ($props['list'] as $kl => $vl) : ?>
                <div class="row pricing-item mb-4 list-ind">
                    <div class="py-3 col-12 d-flex align-items-center justify-content-center text-center">
                        <h3><?= $vl['nama_indikator']; ?></h3>
                    </div>
                    <hr>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center text-center px-3">
                        <p><?= $vl['definisi_operasional']; ?></p>
                    </div>
                    <div class="col-lg-4 d-flex align-items-start justify-content-center">
                        <ul>
                            <li class="justify-content-center"><i class="bi bi-building-fill-check"></i> <?= $vl['nama_skpd']; ?></li>
                            <!-- <li class="justify-content-center"><i class="bi bi-123"></i> <?= $vl['nama_satuan']; ?></li> -->
                            <?php if ($vl['count'] != null) : ?>
                                <li class="justify-content-center"><i class="bi bi-eye-fill"></i> <?= $vl['count']; ?>x</li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <div class="col-lg-4 d-flex align-items-center justify-content-center">
                        <div class="text-center">
                            <a href="<?= base_url('front/data/' . createSlug(true, $vl['id_indikator'], $vl['nama_indikator'])) ?>" class="btn btn-lg btn-success">Lihat</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section><!-- End Horizontal Pricing Section -->

    <section id="about" class="about pt-0 d-none">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4 mt-5">
                <?php for ($i = 0; $i < 10; $i++) : ?>
                    <div class="col-12 mb-3" data-aos="fade-up">
                        <div class="card shadow">
                            <div class="card-body">
                                <h5 class="card-title">Title</h5>
                                <p class="card-text">Content</p>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="row gy-4 mt-3">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <div class="row d-none">
        <?php debug($props) ?>
    </div>
</main>

<?php $this->load->view('front/partials/footer'); ?>

<script>
    $(document).ready(function() {
        $("#search-bar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".list-ind").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#search-bar').trigger('keyup');
    });
</script>