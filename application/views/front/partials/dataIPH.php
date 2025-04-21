<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1600px;" data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD IPH JOMBANG</h1>
            <p>Sumber :Badan Pusat Statistik</p>
        </div>
        <div class="container">
            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <!-- Kategori 1: Data Sebaran Balita Stunting -->
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <!-- <div style="width: 315px; height: 368px; border: 1px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                        <h3>
                            JUMLAH SISWA
                        </h3>
                    </div> -->
                    <iframe id="iframe1" width="1600" height="1000"
                        src="https://lookerstudio.google.com/embed/reporting/1bbe9f56-54ba-494a-a2a9-00943cb95f0b/page/X4ZoD"
                        frameborder="0" style="border:0; display: block;" allowfullscreen
                        sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
                        data-src="https://lookerstudio.google.com/embed/reporting/1bbe9f56-54ba-494a-a2a9-00943cb95f0b/page/X4ZoD"></iframe>
                </div>
            </div>
            <!-- <td><a
                    href="https://docs.google.com/spreadsheets/d/1_KGw_ixrgqV1vsURn-LcMB352xj88aK5Le41bgdXeR8/edit?usp=drive_link">Data
                    Selengkapnya ....</a></td> -->
        </div>
    </div>
</main>




<style>
    .category {
        margin-bottom: 40px;
        text-align: center;
    }

    .category h3,
    .category h4 {
        margin-bottom: 20px;
    }

    iframe {
        border-radius: 8px;
        box-shadow: none;
        border: 1px solid #ccc;
        /* Menambahkan border tipis dengan warna abu-abu */
    }
</style>

<script>

    function showIframe(iframeNumber) {
        const iframeIds = ['iframe1', 'iframe2', 'iframe3', 'iframe4', 'iframe5'];
        const buttonIds = ['button1', 'button2', 'button3', 'button4', 'button5'];

        // Mengatur display untuk iframe yang sesuai dan mengubah kelas tombol
        iframeIds.forEach((iframeId, index) => {
            const displayValue = (index + 1 === iframeNumber) ? 'block' : 'none';
            document.getElementById(iframeId).style.display = displayValue;

            const isButtonActive = (index + 1 === iframeNumber);
            const buttonElement = document.getElementById(buttonIds[index]);
            buttonElement.classList.toggle('btn-primary', isButtonActive);

            if (isButtonActive) {
                buttonElement.classList.add('clicked'); // Menambah kelas clicked jika tombol aktif
            } else {
                buttonElement.classList.remove('clicked'); // Menghapus kelas clicked jika tombol tidak aktif
            }
        });


        // Mengatur data-src kembali ke src untuk iframe yang dipilih
        const selectedIframe = document.getElementById('iframe' + iframeNumber);
        const selectedIframeSrc = selectedIframe.getAttribute('data-src');
        if (selectedIframeSrc) {
            selectedIframe.src = selectedIframeSrc;
        }

        // Mengatur data-loaded ke true untuk iframe yang dipilih
        if (selectedIframe && selectedIframe.getAttribute('data-loaded') !== 'true') {
            selectedIframe.setAttribute('data-loaded', 'true');
        }

        // Menghapus src untuk iframe yang tidak dipilih
        iframeIds.forEach((iframeId, index) => {
            if (index + 1 !== iframeNumber) {
                const iframe = document.getElementById(iframeId);
                iframe.src = '';
            }
        });
    }

</script>