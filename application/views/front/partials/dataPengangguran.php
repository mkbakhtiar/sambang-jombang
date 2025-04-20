<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; " data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD JUMLAH PENGANGGURAN</h1>
            <p>Sumber :Dinas Tenaga Kerja Kabupaten Jombang</p>

        </div>
        <div class="container">
            <iframe style="border:none;" width="310" height="55" seamless frameborder="0" scrolling="no"
                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=930887644&amp;format=interactive"></iframe>

            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <!-- Kategori 1: Data Sebaran Balita Stunting -->
                <div class="category" style="display: grid; grid-template-columns: repeat(5, auto); gap: 10px;">
                    <!-- <div style="width: 315px; height: 368px; border: 1px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                        <h3>
                            JUMLAH SISWA
                        </h3>
                    </div> -->
                    <iframe width="246" height="70" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=1336740632&amp;format=interactive"></iframe>
                    <iframe width="246" height="70" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=1379344162&amp;format=interactive"></iframe>
                    <iframe width="246" height="70" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=2001399801&amp;format=interactive"></iframe>
                    <iframe width="246" height="70" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=898427725&amp;format=interactive"></iframe>
                    <iframe width="246" height="70" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=772970831&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="1241" height="747" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR9bigA84iJ5xLT5nRjwYEdM-WE7odSQbnK_PUg1LGeib7AV21MTDLnrv3rdMlpVt2qoVZRxP-YpZLZ/pubchart?oid=1642015324&amp;format=interactive"></iframe>
                </div>
            </div>
            <td><a
                    href="https://docs.google.com/spreadsheets/d/1lgQViz6IxI1EQNYElp-ZXUW5yDJqvaeufqG-nDHLLvo/edit?usp=sharing">Data
                    Selengkapnya ....</a></td>
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