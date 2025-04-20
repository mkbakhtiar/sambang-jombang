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
                    <li>Katalog Data</li>
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
                    <form action="#" id="form-search" class="form-search d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
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
                <h2>Katalog Data</h2>
            </div>

            <div style="overflow-x:auto;">
                <table class="table table-hover" style="width: 100%;">
                    <thead class="bg-dark text-light">
                        <tr class="align-middle">
                            <th style="width: 5%;">#</th>
                            <th style="width: 20%;">Nama Indikator</th>
                            <th style="width: 35%;">Definisi Operasional</th>
                            <th style="width: 15%;">Satuan</th>
                            <th style="width: 25%;">OPD Pengampu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($props['list'] as $kl => $vl) : ?>
                            <tr class="align-middle list-ind">
                                <td class="text-center"><?= $kl + 1; ?></td>
                                <td><?= $vl['nama_indikator']; ?></td>
                                <td><?= $vl['definisi_operasional']; ?></td>
                                <td><?= $vl['nama_satuan']; ?></td>
                                <td><?= $vl['nama_skpd']; ?></td>
                            </tr>
                            <?php if (isset($vl['subs'])): ?>
                                <?php foreach ($vl['subs'] as $ks => $vs) : ?>
                                    <tr class="align-middle list-ind">
                                    <td class="text-center"><?= $kl + 1; ?>.<?= $ks + 1 ?></td>
                                        <td><?= $vs['nama_indikator']; ?></td>
                                        <td><?= $vs['definisi_operasional']; ?></td>
                                        <td><?= $vs['nama_satuan']; ?></td>
                                        <td><?= $vs['nama_skpd']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('front/partials/footer'); ?>

<script>
    $(document).ready(function() {
        $('#form-search').on('submit', function(e) {
            e.preventDefault();
            var value = $('#search-bar').val().toLowerCase();
            window.open(base_url + 'front/katalog_data?q=' + value, '_self');
        });

        $("#search-bar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".list-ind").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#search-bar').trigger('keyup');
    });
</script>