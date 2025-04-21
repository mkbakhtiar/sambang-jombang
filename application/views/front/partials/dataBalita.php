<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1600px;" data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD DATA STUNTING PEMERINTAH KABUPATEN JOMBANG</h1>
            <p>Sumber : Dinas Kesehatan Kabupaten Jombang</p>
        </div>
        <div class="container">
            <iframe style="border:none;" width="310" height="55" seamless frameborder="0" scrolling="no"
                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSzQFWCx36GyBC89m7cRqNyOnHcfVySERfrURP4dYcS44FXJiycOCBYTSwB2o7A2eJAFgmsGedsmC6l/pubchart?oid=132955501&amp;format=interactive"></iframe>

            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <!-- Kategori 1: Data Sebaran Balita Stunting -->
                <!-- <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <div style="width: 315px; height: 368px; border: 1px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                        <p style="text-align: left; font-size: 18px; color: #333;">
                            Catatan :
                            <br>*GIKUR : Gizi Kurang      
                            <br>*GIBUR : Gizi Buruk
                        </p>
                        <p>
                        
                        </p>
                    </div>

                    <iframe width="408" height="285" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSzQFWCx36GyBC89m7cRqNyOnHcfVySERfrURP4dYcS44FXJiycOCBYTSwB2o7A2eJAFgmsGedsmC6l/pubchart?oid=2116441221&amp;format=interactive"></iframe>
                    <iframe width="408" height="285" seamless frameborder="0" scrolling="no" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSzQFWCx36GyBC89m7cRqNyOnHcfVySERfrURP4dYcS44FXJiycOCBYTSwB2o7A2eJAFgmsGedsmC6l/pubchart?oid=1111748181&amp;format=interactive"></iframe>
                </div> -->
                <div class="category" style="display: grid; grid-template-columns: repeat(4, auto); gap: 10px;">
                    <iframe width="331" height="285" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1u-IYeGS0JP6MpRKU4ndDQHRsboYwJZjoM4ddkniZFMs/pubchart?oid=2116441221&amp;format=interactive"></iframe>
                    <iframe width="331" height="285" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1u-IYeGS0JP6MpRKU4ndDQHRsboYwJZjoM4ddkniZFMs/pubchart?oid=1111748181&amp;format=interactive"></iframe>
                    <iframe width="428" height="289" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1u-IYeGS0JP6MpRKU4ndDQHRsboYwJZjoM4ddkniZFMs/pubchart?oid=1217357499&amp;format=interactive"></iframe>
                    <iframe width="428" height="289" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1u-IYeGS0JP6MpRKU4ndDQHRsboYwJZjoM4ddkniZFMs/pubchart?oid=1887566762&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="430" height="408" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSzQFWCx36GyBC89m7cRqNyOnHcfVySERfrURP4dYcS44FXJiycOCBYTSwB2o7A2eJAFgmsGedsmC6l/pubchart?oid=696575156&amp;format=interactive"></iframe>
                    <iframe width="430" height="408" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSzQFWCx36GyBC89m7cRqNyOnHcfVySERfrURP4dYcS44FXJiycOCBYTSwB2o7A2eJAFgmsGedsmC6l/pubchart?oid=1029129454&amp;format=interactive"></iframe>
                    <iframe width="676" height="408" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1u-IYeGS0JP6MpRKU4ndDQHRsboYwJZjoM4ddkniZFMs/pubchart?oid=744757730&amp;format=interactive"></iframe>
                </div>

                <div class="category" style="display: grid; grid-template-columns: repeat(2, auto); gap: 10px;">
                </div>
            </div>
            <td><a
                    href="https://docs.google.com/spreadsheets/d/11-rLRNhFQG8YNFlMTbEXy8mlmme31TtKhJhMEnwij_Y/edit?usp=sharing">Data
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