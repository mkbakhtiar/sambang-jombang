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

    <section id="search" class="search">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col--12 position-relative align-self-start order-lg-last order-last">
                    <form action="#" class="form-search d-flex align-items-stretch aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                        <input type="text" class="form-control" placeholder="Pencarian Data" id="search-bar">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
                        
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Filter Buku</title>
    <!-- Masukkan referensi ke jQuery di sini jika belum ada -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="container">
    <!-- Bagian Dropdown Filter -->
    <div class="col-12 mb-3">
        <label for="filter-select">Filter Kategori Buku dan Infografis:</label>
        <select class="form-control" id="filter-select">
            <option value="all">Semua Kategori</option>
            <option value="pdrb">PDRB</option>
            <option value="Statistik">Statistik</option>
	        <option value="Infografis">Infografis</option>
	        <option value="jombang dalam angka">Jombang Dalam Angka</option>
	        <option value="Indeks">Indikator Daerah</option>
	        <option value="Profil Kesehatan">Profil Kesehatan</option>
	        
	        
            <!-- Tambahkan opsi kategori lainnya jika diperlukan -->
        </select>
    </div>

  
    <!-- Konten Buku dan Infografis -->
    <section id="service" class="services pt-0">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
            <div class="row">
                <div class="row gy-4" id="container-buku">
                    <!-- Isi konten buku -->
                </div>
                <div class="row gy-4" id="container-infografis">
                    <!-- Isi konten infografis -->
                </div>
            </div>
        </div>
    </section>
</div>

<div class="section-header">
<span id="span-buku">BUKU DAN INFOGRAFIS </span>
<h2>BUKU DAN INFOGRAFIS</h2>
</div> 

<script>
    $(document).ready(function() {
        // Fungsi untuk mengatur filter dropdown dan pencarian teks
        $("#search-bar").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            var selectedFilter = $('#filter-select').val().toLowerCase();

            $('#container-buku .col-lg-4').each(function() {
                var bookTitle = $(this).find('h3 a').text().toLowerCase();

                if ((selectedFilter === 'all' || bookTitle.includes(selectedFilter)) &&
                    (bookTitle.includes(searchText))) {
                    $(this).show(100);
                } else {
                    $(this).hide(100);
                }
            });
        });

        // Fungsi untuk mengatur filter dropdown
        $('#filter-select').change(function() {
            $("#search-bar").trigger("keyup");
        });
    });
</script>

</body>
</html>

    <section id="service" class="services pt-0">
        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                <div class="col-6" id="btn-buku">
                </div>
                <div class="col-6" id="btn-infografis">
            </div>
            <div class="row">
                <div class="row gy-4" id="container-buku">
                    <?php foreach ($props['list_buku'] as $kb => $vb) : ?>
                        <div class="col-lg-4 col-md-6" id="">
                            <div class="card">
                                <div class="card-img">
                                    <?php if ($vb['cover_name'] == '') : ?>
                                        <img src="<?= base_url('assets/front/img/buku.jpg') ?>" alt="" class="img-fluid">
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/upload/' . $vb['cover_name']) ?>" alt="" class="img-fluid">
                                    <?php endif; ?>
                                </div>
                                <h3><a href="<?= base_url('front/publikasi/buku/') . createSlug(true, $vb['id_buku'], $vb['judul']) ?>" class="stretched-link"><?= $vb['judul'] ?></a></h3>
                                <p><?= $vb['deskripsi']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row gy-4" id="container-infografis">
                    <?php foreach ($props['list_infografis'] as $kb => $vb) : ?>
                        <div class="col-lg-4 col-md-6" id="">
                            <div class="card">
                                <div class="card-img">
                                    <?php if ($vb['cover_name'] == '') : ?>
                                        <img src="<?= base_url('assets/front/img/buku.jpg') ?>" alt="" class="img-fluid">
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/upload/' . $vb['cover_name']) ?>" alt="" class="img-fluid">
                                    <?php endif; ?>
                                </div>
                                <h3><a href="<?= base_url('front/publikasi/infografis/') . createSlug(true, $vb['id_infografis'], $vb['judul']) ?>" class="stretched-link"><?= $vb['judul'] ?></a></h3>
                                <p><?= $vb['deskripsi']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
            $(".ul-list li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
            console.log(value);
        });

        $('.btn-detail').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.post(base_url + 'front/detail', {
                    id: id,
                })
                .done(function(data) {
                    $('#data-container').html(data);
                });
        });

        $('#container-infografis').hide();
        $('#span-infografis').hide();

        $('#btn-buku').on('click', function(e) {
            e.preventDefault();
            $('#container-infografis').hide(100);
            $('#container-buku').show(100);
            $('#span-infografis').hide(100);
            $('#span-buku').show(100);
        });
        $('#btn-infografis').on('click', function(e) {
            e.preventDefault();
            $('#container-buku').hide(100);
            $('#container-infografis').show(100);
            $('#span-buku').hide(100);
            $('#span-infografis').show(100);
        });
    });
</script>
 