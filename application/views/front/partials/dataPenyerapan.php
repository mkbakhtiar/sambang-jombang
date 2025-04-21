<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1800px; " data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD PENYERAPAN ANGGARAN</h1>
            <p>Sumber :Badan Pengelolaan Keuangan dan Aset Daerah</p>

        </div>
        <div class="container">
            <iframe style="border:none;" width="310" height="55" seamless frameborder="0" scrolling="no"
                src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=1368498862&amp;format=interactive"></iframe>

            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <!-- Kategori 1: Data Sebaran Balita Stunting -->
                <div class="category" style="display: grid; grid-template-columns: repeat(4, auto); gap: 10px;">
                    <iframe width="450" height="175" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=501847105&amp;format=interactive"></iframe>
                    <iframe width="450" height="175" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=1070284404&amp;format=interactive"></iframe>
                    <iframe width="450" height="175" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=366083668&amp;format=interactive"></iframe>
                    <iframe width="450" height="175" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=148232263&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(4, auto); gap: 10px;">
                    <iframe width="910" height="603" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=2123918905&amp;format=interactive"></iframe>
                    <iframe width="911" height="602" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=1798993963&amp;format=interactive"></iframe>
                </div>
            </div>
            <td><a
                    href="https://docs.google.com/spreadsheets/d/1T_RvNzp1bjJbCJetqlIJLWfrqfnA1CbDc2V0gQCU6Os/edit?usp=sharing">Data
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