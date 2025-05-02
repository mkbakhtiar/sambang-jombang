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

# -- Tambah field status_data di table data
ALTER TABLE `data` ADD `status_data` VARCHAR(50) NULL AFTER `catatan`;

# -- Ubah query untuk v_indikator_konfirmasi_rekap butuh filtering data yg tidak lengkap
SELECT 
    `s`.`id_skpd` AS `id_skpd`,
    `s`.`nama_skpd` AS `nama_skpd`,
    `s`.`no_telp` AS `telp_skpd`,
    `sk`.`konfirmasi_sudah` AS `konfirmasi_sudah`,
    `sk`.`konfirmasi_belum` AS `konfirmasi_belum`,
    `sk`.`konfirmasi_ok` AS `konfirmasi_ok`,
    `sk`.`konfirmasi_not_ok` AS `konfirmasi_not_ok`,
    ((`sk`.`konfirmasi_sudah` / NULLIF((`sk`.`konfirmasi_sudah` + `sk`.`konfirmasi_belum`), 0)) * 100) AS `progres` 
FROM 
    (`satudatajom_satudata3`.`tbl_skpd` `s` 
LEFT JOIN 
    (SELECT 
        `satudatajom_satudata3`.`i`.`id_skpd` AS `id_skpd`,
        COUNT(IF(((`satudatajom_satudata3`.`i`.`status_konfirmasi` IS NULL) AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.konsep') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.metodologi') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.teknik_pengumpulan') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_romantik') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_sdsn') <> '')),
                `satudatajom_satudata3`.`i`.`id_indikator`, NULL)) AS `konfirmasi_belum`,
        COUNT(IF(((`satudatajom_satudata3`.`i`.`status_konfirmasi` IS NOT NULL) AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.konsep') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.metodologi') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.teknik_pengumpulan') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_romantik') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_sdsn') <> '')),
                `satudatajom_satudata3`.`i`.`id_indikator`, NULL)) AS `konfirmasi_sudah`,
        COUNT(IF(((`satudatajom_satudata3`.`i`.`status_konfirmasi` = '1') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.konsep') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.metodologi') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.teknik_pengumpulan') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_romantik') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_sdsn') <> '')),
                `satudatajom_satudata3`.`i`.`id_indikator`, NULL)) AS `konfirmasi_ok`,
        COUNT(IF(((`satudatajom_satudata3`.`i`.`status_konfirmasi` = '2') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.konsep') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.metodologi') <> '') AND 
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.teknik_pengumpulan') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_romantik') <> '') AND
                 (JSON_EXTRACT(`satudatajom_satudata3`.`i`.`metadata`,'$.nomor_sdsn') <> '')),
                `satudatajom_satudata3`.`i`.`id_indikator`, NULL)) AS `konfirmasi_not_ok` 
    FROM 
        `satudatajom_satudata3`.`v_indikator` `i` 
    WHERE 
        (`satudatajom_satudata3`.`i`.`level` = '1') 
    GROUP BY 
        `satudatajom_satudata3`.`i`.`id_skpd`) `sk` 
ON 
    ((`s`.`id_skpd` = `sk`.`id_skpd`)))

# --- Tambah Field status_data pada v_data
select `satudatajom_satudata3`.`data`.`status_data` AS `status_data`,`satudatajom_satudata3`.`data`.`id_data` AS `id_data`,`satudatajom_satudata3`.`data`.`id_indikator` AS `id_indikator`,`satudatajom_satudata3`.`data`.`id_verifikasi` AS `id_verifikasi`,`satudatajom_satudata3`.`data`.`data_angka` AS `data_angka`,`satudatajom_satudata3`.`data`.`data_file` AS `data_file`,`satudatajom_satudata3`.`data`.`tahun` AS `tahun`,`satudatajom_satudata3`.`data`.`catatan` AS `catatan`,`satudatajom_satudata3`.`data`.`timestamp` AS `timestamp` from (`satudatajom_satudata3`.`data` join (select `satudatajom_satudata3`.`data`.`id_data` AS `id_data`,`satudatajom_satudata3`.`data`.`id_indikator` AS `id_indikator`,`satudatajom_satudata3`.`data`.`tahun` AS `tahun`,max(`satudatajom_satudata3`.`data`.`timestamp`) AS `timestamp` from `satudatajom_satudata3`.`data` group by `satudatajom_satudata3`.`data`.`id_indikator`,`satudatajom_satudata3`.`data`.`tahun`) `max_ts`) where ((`satudatajom_satudata3`.`data`.`id_indikator` = `max_ts`.`id_indikator`) and (`satudatajom_satudata3`.`data`.`timestamp` = `max_ts`.`timestamp`))

# --- ambah field status_data pada v_data_full
select `satudatajom_satudata3`.`d`.`status_data` AS `status_data`,`satudatajom_satudata3`.`d`.`id_data` AS `id_data`,`satudatajom_satudata3`.`d`.`id_indikator` AS `id_indikator`,`satudatajom_satudata3`.`d`.`id_verifikasi` AS `id_verifikasi`,`satudatajom_satudata3`.`d`.`data_angka` AS `data_angka`,`satudatajom_satudata3`.`d`.`data_file` AS `data_file`,`satudatajom_satudata3`.`d`.`tahun` AS `tahun`,`satudatajom_satudata3`.`d`.`catatan` AS `catatan`,`satudatajom_satudata3`.`d`.`timestamp` AS `timestamp`,`v`.`status_verifikasi` AS `status_verifikasi`,`v`.`keterangan` AS `keterangan`,`v`.`lock_data` AS `lock_data`,`v`.`timestamp` AS `vtimestamp`,`i`.`nama_indikator` AS `nama_indikator`,`i`.`nama_satuan` AS `nama_satuan`,`i`.`id_skpd` AS `id_skpd`,`i`.`nama_skpd` AS `nama_skpd`,`i`.`level` AS `level`,`i`.`id_akses` AS `id_akses`,`i`.`id_main_indikator` AS `id_main_indikator`,`ii`.`nama_indikator` AS `main_indikator`,`ii`.`id_skpd` AS `main_id_skpd`,`ii`.`nama_skpd` AS `main_skpd`,ifnull(`i`.`status_konfirmasi`,`ii`.`status_konfirmasi`) AS `status_konfirmasi` from (((`satudatajom_satudata3`.`v_data` `d` left join `satudatajom_satudata3`.`v_indikator` `i` on((`satudatajom_satudata3`.`d`.`id_indikator` = `i`.`id_indikator`))) left join `satudatajom_satudata3`.`v_data_verifikasi` `v` on((`satudatajom_satudata3`.`d`.`id_data` = `v`.`id_data`))) left join `satudatajom_satudata3`.`v_indikator` `ii` on((`i`.`id_main_indikator` = `ii`.`id_indikator`)))