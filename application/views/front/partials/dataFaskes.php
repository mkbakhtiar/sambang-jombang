<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1800px; " data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD FASILITAS KESEHATAN LAINNYA</h1>
            <p>Sumber :Dinas Kesehatan</p>
        </div>
        <div class="container">
            <div class="col-md-8" style="flex-direction: column; align-items: center;">
                <div class="row-columns" style="display: flex; gap: 5px;">

                    <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">

                        <!-- Kategori 1: Data Sebaran Balita Stunting (Satu kolom) -->
                        <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                            <iframe width="537" height="179" seamless frameborder="0" scrolling="no"
                                src="https://docs.google.com/spreadsheets/d/1pMG5gDsScOB8lFfjbz3uBSZfsaFK5cOC7CnHz8DVDmQ/pubchart?oid=921488667&amp;format=interactive"></iframe>
                            <iframe width="537" height="414" seamless frameborder="0" scrolling="no"
                                src="https://docs.google.com/spreadsheets/d/1pMG5gDsScOB8lFfjbz3uBSZfsaFK5cOC7CnHz8DVDmQ/pubchart?oid=668955299&amp;format=interactive"></iframe>
                        </div>
                    </div>
                    <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">

                        <!-- Kategori 1: Data Sebaran Balita Stunting (Satu kolom) -->
                        <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                            <iframe width="614" height="608" seamless frameborder="0" scrolling="no"
                                src="https://docs.google.com/spreadsheets/d/1pMG5gDsScOB8lFfjbz3uBSZfsaFK5cOC7CnHz8DVDmQ/pubchart?oid=2018621821&amp;format=interactive"></iframe>
                        </div>
                    </div>
                    <div class="row-categories" style="display: flex; flex-direction: column; gap: 0px;">

                        <!-- Kategori 1: Data Sebaran Balita Stunting (Satu kolom) -->
                        <div class="category" style="display: grid; grid-template-columns: 1fr; gap: 0px;">
                            <iframe width="614" height="608" seamless frameborder="0" scrolling="no"
                                src="https://docs.google.com/spreadsheets/d/1pMG5gDsScOB8lFfjbz3uBSZfsaFK5cOC7CnHz8DVDmQ/pubchart?oid=541660440&amp;format=interactive"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <td><a
                    href="https://docs.google.com/spreadsheets/d/1pLzI9y2iQwZ27WQnVbxSdqRg_hasAxrlXbSmrGqqhUc/edit?usp=sharing">Data
                    Selengkapnya ....</a></td>
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