<div class="vertical-menu">

    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="<?= base_url('admin/dashboard') ?>">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <?php if ($this->session->admin): ?>
                    <!-- <li>
                        <a href="<?= base_url('admin/visitor') ?>">
                            <i data-feather="bar-chart"></i>
                            <span data-key="t-visitor">Visitor</span>
                        </a>
                    </li> -->
                <?php endif; ?>

                <li class="menu-title" data-key="t-menu-perencanaan">Perencanaan</li>
                <li>
                    <a href="<?= base_url('indikator/penetapan') ?>">
                        <i data-feather="list"></i>
                        <span data-key="t-penetapan">Penetapan Daftar Data</span>
                    </a>
                </li>
                <?php if ($this->session->admin || $this->session->admin2): ?>
                    <li>
                        <a href="<?= base_url('indikator/penetapan_progres') ?>">
                            <i data-feather="bar-chart"></i>
                            <span data-key="t-penetapan-progres">Progres</span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <?php if ($this->session->admin): ?>
                    <li>
                        <a href="<?= base_url('indikator/penetapan_progres') ?>">
                            <i data-feather="bar-chart"></i>
                            <span data-key="t-penetapan-progres">Progres</span>
                        </a>
                    </li>
                <?php endif; ?> -->

                <li class="menu-title" data-key="t-menu-pengumpulan">Pengumpulan</li>
                <li>
                    <a href="<?= base_url('indikator/pengisian') ?>">
                        <i data-feather="edit"></i>
                        <span data-key="t-pengisian">Pengisian Data</span>
                    </a>
                </li>
                <?php if ($this->session->admin || $this->session->admin2): ?>
                    <li>
                        <a href="<?= base_url('indikator/pengisian_progres_rev') ?>">
                            <i data-feather="bar-chart"></i>
                            <span data-key="t-pengisian-progres">Progres</span>
                        </a>
                    </li>
                <?php endif; ?>
                <!-- <?php if ($this->session->admin): ?>
                    <li>
                        <a href="<?= base_url('indikator/pengisian_progres_rev') ?>">
                            <i data-feather="bar-chart"></i>
                            <span data-key="t-pengisian-progres">Progres</span>
                        </a>
                    </li>
                <?php endif; ?> -->

                <?php if ($this->session->admin): ?>
                    <li class="menu-title" data-key="t-menu-pemeriksaan">Pemeriksaan</li>
                    <li>
                        <a href="<?= base_url('indikator/verifikasi') ?>">
                            <i data-feather="check-square"></i>
                            <!-- <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span> -->
                            <span data-key="t-verifikasi">Verifikasi Data</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->admin): ?>
                    <li class="menu-title" data-key="t-menu-publikasi">Publikasi</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="external-link"></i>
                            <span data-key="t-publikasi">Publikasi Data</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url('publikasi/keluaran') ?>" data-key="m-keluaran">Keluaran</a></li>
                            <li><a href="<?= base_url('publikasi/urusan') ?>" data-key="m-urusan">Urusan</a></li>
                            <li><a href="<?= base_url('publikasi/buku') ?>" data-key="m-buku">Buku</a></li>
                            <li><a href="<?= base_url('publikasi/infografis') ?>" data-key="m-infografis">Infografis</a>
                            </li>
                            <li><a href="<?= base_url('publikasi/anggaran') ?>" data-key="m-anggaran">Anggaran</a></li>
                            <li><a href="<?= base_url('publikasi/tagar') ?>" data-key="m-tagar">Tagar</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->admin): ?>
                    <li class="menu-title" data-key="t-menu-permintaan">Permintaan Data</li>
                    <li>
                        <a href="<?= base_url('indikator/daftarrequest') ?>">
                            <i data-feather="check-square"></i>
                            <!-- <span class="badge rounded-pill bg-soft-danger text-danger float-end">7</span> -->
                            <span data-key="t-request">Daftar Permintaan Data</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->admin): ?>
                    <li class="menu-title" data-key="t-menu">Geoportal</li>
                    <li>
                        <a href="<?= base_url('geoportal/indicators') ?>">
                            <i data-feather="list"></i>
                            <span data-key="t-data">Indikator</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('geoportal/views') ?>">
                            <i data-feather="eye"></i>
                            <span data-key="t-data">View</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('geoportal/datas') ?>">
                            <i data-feather="file-text"></i>
                            <span data-key="t-data">Data</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($this->session->admin): ?>
                    <li class="menu-title" data-key="t-menu">Settings</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="database"></i>
                            <span data-key="t-authentication">Master Data</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="<?= base_url('masterdata/skpd') ?>" data-key="m-skpd">SKPD</a></li>
                            <li><a href="<?= base_url('masterdata/satuan') ?>" data-key="m-satuan">Satuan</a></li>
                            <li><a href="<?= base_url('masterdata/metadata') ?>" data-key="m-metadata">Metadata</a></li>
                            <li><a href="<?= base_url('masterdata/periodik') ?>" data-key="m-periodik">Periodik</a></li>
                            <li><a href="<?= base_url('masterdata/tahun') ?>" data-key="m-tahun">Tahun</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i data-feather="users"></i>
                            <span data-key="t-authentication">Auth</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <!-- <li><a href="<?= base_url('auth/role') ?>" data-key="s-role">Role </a></li> -->
                            <li><a href="<?= base_url('auth/user') ?>" data-key="s-user">User</a></li>
                        </ul>
                    </li>

                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>