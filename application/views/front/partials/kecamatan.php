<main id="main">
    <!-- <script type="text/javascript" src="<?= base_url('assets/front/js') ?>/canvasjs.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <div id="featured-services" class="featured-services">
        <div class="container">
            <!-- <div class="row gy-4"> -->
            <div class="col-md-12" style="overflow: auto; height: 50vh; display: block; flex-direction: column;">

                <!-- 
                    <pre>
                        <?php print_r($props['list_kecamatan']); ?>
                    </pre> -->


                <div class="card2">
                    <h1>Informasi Kecamatan </h1>
                    <h2><?php echo $props['nama_indikator']; ?></h2>
                    <?php foreach ($props['list_kecamatan'] as $kecamatan) { ?>
                        <div>
                            <h3><?php echo $kecamatan['tahun']; ?></h3>
                        </div>
                    <?php } ?>
                    <details class="warning" open>
                        <summary>Wilayah</summary>
                        <?php foreach ($props['list_kecamatan'] as $kecamatan) {
                            echo '<div>';
                            echo '<p><b>Luas Wilayah: </b>' . $kecamatan['data_angka'] . ' Km²' . '</p>'; // Tampilkan data angka
                            echo '</div>';
                        } ?>
                        <?php foreach ($props['total_desa_kecamatan'] as $kecamatan) {
                            echo '<div>';
                            echo '<p><b>Jumlah Desa: </b>' . $kecamatan['data_angka'] . '</p>'; // Tampilkan data angka
                            echo '</div>';
                        } ?>

                        <!-- <?php if (!empty($props['total_desa_kecamatan'])) {
                            $kecamatan = $props['total_desa_kecamatan']; // Ambil data kecamatan
                        
                            echo '<div>';
                            echo '<p><b>Jumlah Desa: </b>' . $kecamatan . '</p>'; // Tampilkan data angka
                            echo '</div>';
                        } else {
                            echo '<p>Data tidak tersedia</p>'; // Tampilkan pesan jika data tidak tersedia
                        } ?> -->
                    </details>

                    <!-- <details class="info" open>
                        <summary>For the public</summary>
                        <p>Social distance, quarantine and isolation</p>
                        <p>Hand hygiene, cough etiquette, cleaning and laundry</p>
                        <p>When children have acute respiratory tract infections</p>
                        <p>Risk groups and their relatives</p>
                    </details>

                    <details class="alert">
                        <summary>Facts and knowledge about COVID-19</summary>
                        <p>Some text to be hidden.</p>
                        <p>Some text to be hidden.</p>
                        <p>Some text to be hidden.</p>
                        <p>Some text to be hidden.</p>
                    </details> -->
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</main>

<style>
    @import url('https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@300;400;500;600;700&display=swap');

    :root {
        --color-bg: #EEEDEB;
        --color-title: #0E1C4E;

        --color-summary-1: #FFF6EE;
        --color-summary-1-highlight: #FFC48B;
        --color-summary-2: #FAFAFF;
        --color-summary-2-highlight: #B4B3FF;
        --color-summary-3: #FFF0F3;
        --color-summary-3-highlight: #FFB3C0;

        --font-ibm-plex-sans: 'IBM Plex Sans', sans-serif;
    }

    .card2 {
        background: white;
        /* padding: 38px 36px;
        margin-top: 40px;
        margin-bottom: 40px; */
        /* border-radius: 4px; */
        /* box-shadow: 0 8px 10px rgba(0, 0, 0, .1); */
        max-width: 30em;
        width: 100%;

        h1 {
            font-family: var(--font-ibm-plex-sans);
            font-style: normal;
            font-weight: bold;
            font-size: 20px;
            line-height: 1.2;
            color: var(--color-title);
            margin-bottom: 20px;
        }

        details {
            display: flex;

            border-radius: 5px;
            overflow: hidden;
            background: rgba(0, 0, 0, .05);
            border-left: 15px solid gray;
            padding: 15px;

            & {
                margin-top: 15px;
            }

            &.warning {
                --highlight: var(--color-summary-1-highlight);
                background: var(--color-summary-1);
                border-left-color: var(--color-summary-1-highlight);

                p {
                    list-style-type: kecamatan-warning;
                }
            }

            &.info {
                --highlight: var(--color-summary-2-highlight);
                background: var(--color-summary-2);
                border-left-color: var(--color-summary-2-highlight);

                p {
                    list-style-type: corona-info;
                }
            }

            &.alert {
                --highlight: var(--color-summary-3-highlight);
                background: var(--color-summary-3);
                border-left-color: var(--highlight);

                p {
                    list-style-type: corona-alert;
                }
            }

            summary,
            p {
                position: relative;
                display: flex;
                flex-direction: row;
                align-content: center;
                justify-content: flex-start;
                font-family: var(--font-ibm-plex-sans);
                font-style: normal;
                font-weight: normal;
                font-size: 18px;
                color: var(--color-title);
                padding: 20px;
                cursor: pointer;

                &::-webkit-details-marker {
                    display: none;
                }

                &:focus {
                    outline: solid 3px var(--highlight);
                }

                &::selection {
                    background-color: var(--highlight);
                }
            }

            p {
                display: list-item;
                cursor: default;
                margin-left: 3rem;
                list-style-type: corona;
            }

            summary::before {
                cursor: pointer;
                position: absolute;
                display: inline-flex;
                width: 1rem;
                height: 1rem;
                left: 0rem;
                margin-right: .5rem;
                content: url("data:image/svg+xml,%3Csvg width='100%' height='100%' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M22.6066 12H1.3934' stroke='%23202842' stroke-width='1.875' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 1.39343V22.6066' stroke='%23202842' stroke-width='1.875' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A");

            }

            &[open] {
                summary {

                    font-weight: 700;

                    &::before {
                        transform: rotate(45deg);
                        content: url("data:image/svg+xml,%3Csvg width='100%' height='100%' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M22.6066 12H1.3934' stroke='%23202842' stroke-width='3.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3Cpath d='M12 1.39343V22.6066' stroke='%23202842' stroke-width='3.6' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E%0A");
                    }
                }
            }
        }
    }

    @counter-style kecamatan-warning {
        system: cyclic;
        symbols: 📍 🗺️ 🏘️ 🌍;
        suffix: " ";
    }

    @counter-style corona-info {
        system: cyclic;
        symbols: 🧬;
        suffix: " ";
    }

    @counter-style corona-alert {
        system: fixed;
        symbols: 💉 🩸 😷 🦠 🧫;
        suffix: " ";
    }
</style>