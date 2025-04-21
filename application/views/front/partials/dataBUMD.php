<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1100px; " data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD BUMD</h1>
            <p>Sumber :Bagian Perekonomian</p>
        </div>
        <div class="container">
            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <!-- Kategori 1: Data Sebaran Balita Stunting -->
                <div class="category" style="display: grid; grid-template-columns: repeat(1, auto); gap: 10px;">
                    <iframe width="1068" height="54" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=1613374222&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(2, auto); gap: 10px;">
                    <iframe width="530" height="107" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=77775032&amp;format=interactive"></iframe>
                    <iframe width="530" height="107" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=126720458&amp;format=interactive"></iframe>

                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(2, auto); gap: 10px;">
                    <iframe width="530" height="107" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=1567630477&amp;format=interactive"></iframe>
                    <iframe width="530" height="107" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=22345481&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(2, auto); gap: 10px;">
                    <iframe width="532" height="332" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=226745712&amp;format=interactive"></iframe>
                    <iframe width="532" height="332" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/1s3tdjcnzLQ_vXk0HUd2uR6JlEJBNpNMW2gmfGVM7TsY/pubchart?oid=1831734402&amp;format=interactive"></iframe>
                </div>
            </div>
            <td><a
                    href="https://docs.google.com/spreadsheets/d/19XrfDtQy3jecZJYqrBdMt_C3B3OIkOagg2Tr6h9F6YU/edit?usp=sharing">Data
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