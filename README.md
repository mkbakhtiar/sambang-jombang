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