<main id="main">
    <div id="featured-services" class="featured-services">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-3" style="display: flex; flex-direction: column; align-items: center;">
                    <div class="d-flex flex-column align-items-center">
                        <button id="button1" class="btn button-2" onclick="showIframe(1)">
                            <div id="slide"></div>
                            <a href="#">IPH Jombang</a>
                        </button>
                        <button id="button4" class="btn button-2" onclick="showIframe(4)">
                            <div id="slide"></div>
                            <a href="#">Panel Harga SP2KP Harian</a>
                        </button>
                        <button id="button3" class="btn button-2" onclick="showIframe(3)">
                            <div id="slide"></div>
                            <a href="#">Panel Harga Bapokting Bulanan</a>
                        </button>
                        <button id="button2" class="btn button-2" onclick="showIframe(2)">
                            <div id="slide"></div>
                            <a href="#">Panel Harga Bapokting Harian</a>
                        </button>
                        <button id="button5" class="btn button-2" onclick="showIframe(5)">
                            <div id="slide"></div>
                            <a href="#">Panel Harga Komoditi Ternak</a>
                        </button>
                        <!-- Tambahkan tombol-tombol lainnya di sini -->
                    </div>
                </div>
                <div class="col-md-8" style="flex-direction: column; align-items: center;">
                    <div class="d-flex justify-content-center">
                        <!-- <iframe id="iframe1" src="https://lookerstudio.google.com/embed/reporting/1bbe9f56-54ba-494a-a2a9-00943cb95f0b/page/X4ZoD" frameborder="0" allowfullscreen></iframe> -->
                        <iframe id="iframe1" width="800" height="550"
                            src="https://lookerstudio.google.com/embed/reporting/1bbe9f56-54ba-494a-a2a9-00943cb95f0b/page/X4ZoD"
                            frameborder="0" style="border:0; display: block;" allowfullscreen
                            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
                            data-src="https://lookerstudio.google.com/embed/reporting/1bbe9f56-54ba-494a-a2a9-00943cb95f0b/page/X4ZoD"></iframe>
                        <iframe id="iframe2" width="800" height="550" src="" frameborder="0"
                            style="border:0; display: none;" allowfullscreen
                            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
                            data-src="https://lookerstudio.google.com/embed/reporting/8829eaed-fd57-4097-98b0-cd08ccd3cf66/page/CmiqD"></iframe>
                        <iframe id="iframe3" width="800" height="550" src="" frameborder="0"
                            style="border:0; display: none;" allowfullscreen
                            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
                            data-src="https://lookerstudio.google.com/embed/reporting/d19fd210-987f-4d9f-86be-cee9c0441463/page/CmiqD"></iframe>
                        <iframe id="iframe4" width="800" height="550" src="" frameborder="0"
                            style="border:0; display: none;" allowfullscreen
                            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
                            data-src="https://lookerstudio.google.com/embed/reporting/c4d1efd8-7532-482d-a9c8-db3eb319851b/page/CmiqD"></iframe>
                        <!-- data-src="https://lookerstudio.google.com/embed/reporting/7f7635e1-7546-4087-a345-28fb1ce999fc/page/CmiqD"></iframe> -->
                        <iframe id="iframe5" width="800" height="550" src="" frameborder="0"
                            style="border:0; display: none;" allowfullscreen
                            sandbox="allow-storage-access-by-user-activation allow-scripts allow-same-origin allow-popups allow-popups-to-escape-sandbox"
                            data-src="https://lookerstudio.google.com/embed/reporting/abab4c04-832b-42e3-8b8d-0c2ccedd6767/page/CmiqD"></iframe>

                        <!-- Tambahkan iframe lainnya di sini -->
                    </div>
                </div>
            </div>
        </div>
    </div>



    <style>
        /* Style tambahan untuk tombol */
        .col-md-3 button {
            width: 70%;
        }

        /* CSS */
        .btn {
            width: 60%;
            /* Lebar tombol 90% dari lebar layar */
            margin-bottom: 10px;
            /* Ruang antara tombol */
        }

        iframe {
            width: 90vw;
            /* Lebar iframe 90% dari viewport width */
            height: 80vh;
            /* Tinggi iframe 50% dari viewport height */
        }

        /* Media queries untuk keperluan tertentu jika diperlukan */
        @media screen and (max-width: 768px) {
            .btn {
                width: 70%;
                /* Ubah lebar tombol menjadi 100% untuk layar kecil */
            }

            iframe {
                width: 100vw;
                /* Lebar iframe 100% dari viewport width untuk layar kecil */
                height: 60vh;
                /* Tinggi iframe 60% dari viewport height untuk layar kecil */
            }
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