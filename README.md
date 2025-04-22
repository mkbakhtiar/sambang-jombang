# -- Add Google-specific columns to the user table
ALTER TABLE auth_users ADD COLUMN google_id VARCHAR(255) NULL;
ALTER TABLE auth_users ADD COLUMN profile_picture VARCHAR(255) NULL;
ALTER TABLE auth_users ADD COLUMN date_created DATETIME NULL;
ALTER TABLE auth_users ADD COLUMN last_login DATETIME NULL;

# -- Create index for faster queries
CREATE INDEX idx_google_id ON auth_users(google_id);
CREATE INDEX idx_email ON auth_users(email);

# -- Add status column
ALTER TABLE `auth_users` ADD `status` INT NULL AFTER `date_created`;

# -- Tambah kolom no_telp untuk tbl_skpd di view v_indikator_konfirmasi_rekap
select `s`.`id_skpd` AS `id_skpd`,`s`.`nama_skpd` AS `nama_skpd`,`s`.`no_telp` AS `telp_skpd`,`sk`.`konfirmasi_sudah` AS `konfirmasi_sudah`,`sk`.`konfirmasi_belum` AS `konfirmasi_belum`,`sk`.`konfirmasi_ok` AS `konfirmasi_ok`,`sk`.`konfirmasi_not_ok` AS `konfirmasi_not_ok`,((`sk`.`konfirmasi_sudah` / (`sk`.`konfirmasi_sudah` + `sk`.`konfirmasi_belum`)) * 100) AS `progres` from (`satudatajom_satudata3`.`tbl_skpd` `s` left join (select `satudatajom_satudata3`.`i`.`id_skpd` AS `id_skpd`,count(if((`satudatajom_satudata3`.`i`.`status_konfirmasi` is null),`satudatajom_satudata3`.`i`.`id_indikator`,NULL)) AS `konfirmasi_belum`,count(if((`satudatajom_satudata3`.`i`.`status_konfirmasi` is not null),`satudatajom_satudata3`.`i`.`id_indikator`,NULL)) AS `konfirmasi_sudah`,count(if((`satudatajom_satudata3`.`i`.`status_konfirmasi` = '1'),`satudatajom_satudata3`.`i`.`id_indikator`,NULL)) AS `konfirmasi_ok`,count(if((`satudatajom_satudata3`.`i`.`status_konfirmasi` = '2'),`satudatajom_satudata3`.`i`.`id_indikator`,NULL)) AS `konfirmasi_not_ok` from `satudatajom_satudata3`.`v_indikator` `i` where (`satudatajom_satudata3`.`i`.`level` = '1') group by `satudatajom_satudata3`.`i`.`id_skpd`) `sk` on((`s`.`id_skpd` = `sk`.`id_skpd`)))

# -- Tambah kolom no_telp skpd untuk di view ini v_indikator
select `i`.`id_indikator` AS `id_indikator`,`i`.`nama_indikator` AS `nama_indikator`,`i`.`definisi_operasional` AS `definisi_operasional`,`i`.`level` AS `level`,`i`.`id_main_indikator` AS `id_main_indikator`,`i`.`id_skpd` AS `id_skpd`,`i`.`id_keluaran` AS `id_keluaran`,`i`.`id_satuan` AS `id_satuan`,`i`.`id_akses` AS `id_akses`,`i`.`id_periodik` AS `id_periodik`,`i`.`metadata` AS `metadata`,`i`.`id_konfirmasi` AS `id_konfirmasi`,`i`.`timestamp` AS `timestamp`,`s`.`nama_skpd` AS `nama_skpd`,`s`.`no_telp` AS `telp_skpd`,`st`.`nama_satuan` AS `nama_satuan`,`pr`.`nama_periodik` AS `nama_periodik`,`ak`.`nama_akses` AS `nama_akses`,`ik`.`status_konfirmasi` AS `status_konfirmasi`,`ik`.`alasan` AS `alasan` from (((((`satudatajom_satudata3`.`indikator` `i` left join `satudatajom_satudata3`.`tbl_skpd` `s` on((`i`.`id_skpd` = `s`.`id_skpd`))) left join `satudatajom_satudata3`.`tbl_satuan` `st` on((`i`.`id_satuan` = `st`.`id_satuan`))) left join `satudatajom_satudata3`.`tbl_akses` `ak` on((`i`.`id_akses` = `ak`.`id_akses`))) left join `satudatajom_satudata3`.`tbl_periodik` `pr` on((`i`.`id_periodik` = `pr`.`id_periodik`))) left join `satudatajom_satudata3`.`indikator_konfirmasi` `ik` on((`i`.`id_konfirmasi` = `ik`.`id_konfirmasi`)))