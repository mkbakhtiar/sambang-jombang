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
                    <li>Publikasi</li>
                </ol>
            </div>
        </nav>
    </div>

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="row gt-4">
                <div class="col-lg-6 position-relative align-self-start order-lg-last order-last">
                    <div class="text-end">
                        <img src="<?= base_url('assets/upload/' . $props['detail']['cover_name']) ?>" alt="" width="250px" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 content order-first order-lg-first">
                    <h3><?= $props['detail']['judul']; ?></h3>
                    <div class="row">
                        <div class="col">
                            <ul>
                                <li data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-info-circle-fill"></i>
                                    <div>
                                        <p>Deskripsi</p>
                                        <h5>
                                            <?= $props['detail']['deskripsi']; ?>
                                        </h5>
                                    </div>
                                </li>
                                <li data-aos="fade-up" data-aos-delay="100">
                                    <i class="bi bi-building-fill-check"></i>
                                    <div>
                                        <p>Produsen Data</p>
                                        <h5><?= $props['detail']['nama_skpd']; ?></h5>
                                    </div>
                                </li>
                                <li data-aos="fade-up" data-aos-delay="100">
                                    <!-- <i class="bi bi-download"></i> -->
                                    <div class="align-middle">
                                        <!-- <p>Download</p> -->
                                        <h5><a href="<?= base_url('assets/upload/' . $props['detail']['file_name']) ?>" class="btn btn-success" type="button">Download</a></h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="stats-counter" class="stats-counter pt-0">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <section>
                    <div id="pspdfkit" style="height: 80vh;"></div>
                </section>
            </div>
        </div>
    </section>
</main>

<?php $this->load->view('front/partials/footer'); ?>
<script src="<?= base_url('vendor/pdfkit/dist/pspdfkit.js') ?>"></script>

<script>
    PSPDFKit.load({
            container: "#pspdfkit",
            document: "<?= base_url('assets/upload/' . $props['detail']['file_name']) ?>"
        })
        .then(function(instance) {
            const items = instance.toolbarItems;
            const exc = ["sidebar-thumbnails", "sidebar-document-outline", "sidebar-annotations", "sidebar-bookmarks", "pager", "pan", "zoom-out", "zoom-in", "zoom-mode", "search"];
            instance.setToolbarItems(items.filter((item) => exc.includes(item.type)));
            console.log("PSPDFKit loaded", instance);
        })
        .catch(function(error) {
            console.error(error.message);
        });
</script>