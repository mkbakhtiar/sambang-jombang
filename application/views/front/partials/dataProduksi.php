<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1500px; " data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD PRODUKSI</h1>
            <p>Sumber :Dinas Pertanian</p>
        </div>
        <div class="container">
            <iframe style="border: none; " width="310" height="55" seamless frameborder="0" scrolling="no"
                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQDCLCEJFs8oedWrMmzN6xAwQC55JIb3CZhlN8t6f2yJjH_Lmo7rq88g4uPzHVa7V0pOXTwA4zyU0hI/pubchart?oid=1597523869&amp;format=interactive"></iframe>
            <div class="col-md-8" id="sp2kp" style="display:block; flex-direction: column; align-items: center;">
                <div class="row-columns" style="display: flex; gap: 5px;">

                    <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">

                        <!-- Kategori 1: Data Sebaran Balita Stunting (Satu kolom) -->
                        <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                        </div>

                        <!-- Kategori 2 dan 3: Dua column bersebelahan -->
                        <div class="row-columns" style="display: flex; gap: 5px;">
                            <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">
                                <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                                    <!-- PADI -->
                                    <iframe width="500" height="371" seamless frameborder="0" scrolling="no"
                                        src="https://docs.google.com/spreadsheets/d/1nBnVCMnx--iikLvVihEX7GZiT4vJZUq3FXh_uBpKPSc/pubchart?oid=344899441&amp;format=interactive"></iframe>
                                    <!-- CABE RAWIT  -->
                                    <iframe width="500" height="371" seamless frameborder="0" scrolling="no"
                                        src="https://docs.google.com/spreadsheets/d/1nBnVCMnx--iikLvVihEX7GZiT4vJZUq3FXh_uBpKPSc/pubchart?oid=583057729&amp;format=interactive"></iframe>
                                </div>
                            </div>
                            <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">
                                <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                                    <!-- JAGUNG  -->
                                    <iframe width="500" height="371" seamless frameborder="0" scrolling="no"
                                        src="https://docs.google.com/spreadsheets/d/1nBnVCMnx--iikLvVihEX7GZiT4vJZUq3FXh_uBpKPSc/pubchart?oid=1060526422&amp;format=interactive"></iframe>
                                    <!-- CABE besar -->
                                    <iframe width="500" height="371" seamless frameborder="0" scrolling="no"
                                        src="https://docs.google.com/spreadsheets/d/1nBnVCMnx--iikLvVihEX7GZiT4vJZUq3FXh_uBpKPSc/pubchart?oid=631031515&amp;format=interactive"></iframe>
                                </div>
                            </div>
                            <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">
                                <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                                    <!-- KEDELAI -->
                                    <iframe width="500" height="371" seamless frameborder="0" scrolling="no"
                                        src="https://docs.google.com/spreadsheets/d/1nBnVCMnx--iikLvVihEX7GZiT4vJZUq3FXh_uBpKPSc/pubchart?oid=1050751554&amp;format=interactive"></iframe>
                                    <!-- BAWANG MERAH  -->
                                    <iframe width="500" height="371" seamless frameborder="0" scrolling="no"
                                        src="https://docs.google.com/spreadsheets/d/1nBnVCMnx--iikLvVihEX7GZiT4vJZUq3FXh_uBpKPSc/pubchart?oid=1460145259&amp;format=interactive"></iframe>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- <td><a
                    href="https://docs.google.com/spreadsheets/d/1XoxdSQuRdpjiKd5RKmRItqwjT3aTUHQTCvPr_ClfjJg/edit?usp=sharing">Data
                    Selengkapnya ....</a></td> -->
        </div>
    </div>
</main>




<style>
    .category {
        margin-bottom: 10px;
        text-align: center;
    }

    .category h3,
    .category h4 {
        margin-bottom: 10px;
    }

    iframe {
        margin: 0px;
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