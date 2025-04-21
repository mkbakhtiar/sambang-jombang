<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="section-header" style="margin-top: 0; width: 1600px;" data-aos="fade-up" data-aos-delay="">
            <h1>DASHBOARD JUMLAH SMP</h1>
            <p>Sumber :Dinas Pendidikaan dan Kebudayaan</p>
        </div>
        <div class="container">
            <div class="col-md-8" style="flex-direction: column; align-items: center;">

                <!-- Kategori 1: Data Sebaran Balita Stunting -->
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">

                    <div
                        style="width: 500px; height: 50px; border: 1px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9;">
                        <h3>
                            JUMLAH SISWA
                        </h3>
                    </div>
                    <div
                        style="width: 500px; height: 50px; border: 1px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                        <h3>
                            RASIO GURU
                        </h3>
                    </div>
                    <div
                        style="width: 500px; height: 50px; border: 1px; display: flex; align-items: center; justify-content: center; background-color: #f9f9f9; border-radius: 8px;">
                        <h3>
                            JUMLAH KELAS
                        </h3>
                    </div>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="500" height="448" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQBVoIecwT0B7kBTsD1r0QuLC5L8Pu1sr0VZEMntHrbvmOgVE08t0EdG5xBNjD5_49udBe6QeD2IrgT/pubchart?oid=987828085&amp;format=interactive"></iframe>
                    <iframe width="500" height="448" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQBVoIecwT0B7kBTsD1r0QuLC5L8Pu1sr0VZEMntHrbvmOgVE08t0EdG5xBNjD5_49udBe6QeD2IrgT/pubchart?oid=104751906&amp;format=interactive"></iframe>
                    <iframe width="500" height="448" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQBVoIecwT0B7kBTsD1r0QuLC5L8Pu1sr0VZEMntHrbvmOgVE08t0EdG5xBNjD5_49udBe6QeD2IrgT/pubchart?oid=1492562787&amp;format=interactive"></iframe>
                </div>
                <div class="category" style="display: grid; grid-template-columns: repeat(3, auto); gap: 10px;">
                    <iframe width="500" height="448" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQBVoIecwT0B7kBTsD1r0QuLC5L8Pu1sr0VZEMntHrbvmOgVE08t0EdG5xBNjD5_49udBe6QeD2IrgT/pubchart?oid=1874727963&amp;format=interactive"></iframe>
                    <iframe width="500" height="448" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQBVoIecwT0B7kBTsD1r0QuLC5L8Pu1sr0VZEMntHrbvmOgVE08t0EdG5xBNjD5_49udBe6QeD2IrgT/pubchart?oid=2116346690&amp;format=interactive"></iframe>
                    <iframe width="500" height="448" seamless frameborder="0" scrolling="no"
                        src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQBVoIecwT0B7kBTsD1r0QuLC5L8Pu1sr0VZEMntHrbvmOgVE08t0EdG5xBNjD5_49udBe6QeD2IrgT/pubchart?oid=635311241&amp;format=interactive"></iframe>
                </div>
            </div>
            <td><a
                    href="https://docs.google.com/spreadsheets/d/1PIWPitu7bC15nLlV4x__OMNkePkiuC495qcinKcVUYg/edit?usp=sharing">Data
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
        margin: 10px;
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