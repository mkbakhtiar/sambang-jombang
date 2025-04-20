<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1400px;" data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD RSUD JOMBANG</h1>
            <p>Sumber : RSUD Jombang</p>
        </div>
        <div class="container">
            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="490" height="83" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=1801573343&amp;format=interactive"></iframe>
                    <iframe width="490" height="83" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=452658267&amp;format=interactive"></iframe>
                    <iframe width="281" height="83" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=1867022946&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="490" height="83" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=1860268487&amp;format=interactive"></iframe>
                    <iframe width="490" height="83" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=122382758&amp;format=interactive"></iframe>
                    <iframe width="281" height="83" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=1856786831&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="417" height="387" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=128345280&amp;format=interactive"></iframe>
                    <iframe width="459" height="387" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=2051290768&amp;format=interactive"></iframe>
                    <iframe width="387" height="387" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1wThglcXCP1xO1RvGYF2vzfB4HBJWm3QmXYU_dqQVfYo/pubchart?oid=1497383588&amp;format=interactive"></iframe>
                </div>
            </div>
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