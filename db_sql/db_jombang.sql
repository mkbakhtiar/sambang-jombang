/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100422
 Source Host           : localhost:3306
 Source Schema         : db_jombang

 Target Server Type    : MySQL
 Target Server Version : 100422
 File Encoding         : 65001

 Date: 13/12/2022 11:56:06
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for auth_role
-- ----------------------------
DROP TABLE IF EXISTS `auth_role`;
CREATE TABLE `auth_role`  (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `rules` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_role`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_role
-- ----------------------------
INSERT INTO `auth_role` VALUES (1, 'Admin', NULL, '2022-12-02 17:26:48');
INSERT INTO `auth_role` VALUES (2, 'Walidata', NULL, '2022-12-02 17:26:52');
INSERT INTO `auth_role` VALUES (3, 'Produsen', NULL, '2022-12-02 17:26:56');

-- ----------------------------
-- Table structure for auth_users
-- ----------------------------
DROP TABLE IF EXISTS `auth_users`;
CREATE TABLE `auth_users`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `id_skpd` int NULL DEFAULT NULL,
  `id_role` int NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of auth_users
-- ----------------------------
INSERT INTO `auth_users` VALUES (1, 4, 1, 'admin', '2bdb27c5b3df2d64cd77aaac4bad352c', 'Admin Baru', '', '', '12', NULL);
INSERT INTO `auth_users` VALUES (2, 2, 2, 'walidata', '2bdb27c5b3df2d64cd77aaac4bad352c', 'Walidata', NULL, NULL, NULL, '2022-11-30 21:27:20');
INSERT INTO `auth_users` VALUES (3, 22, 3, 'produsen', '2bdb27c5b3df2d64cd77aaac4bad352c', 'SKPD', NULL, NULL, NULL, '2022-11-30 21:28:02');

-- ----------------------------
-- Table structure for data
-- ----------------------------
DROP TABLE IF EXISTS `data`;
CREATE TABLE `data`  (
  `id_data` int NOT NULL AUTO_INCREMENT,
  `id_indikator` int NULL DEFAULT NULL,
  `id_verifikasi` int NULL DEFAULT NULL,
  `data_angka` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `data_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_data`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 102 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data
-- ----------------------------
INSERT INTO `data` VALUES (16, 1, NULL, '0901290', '2', '2022', NULL, '2022-11-29 17:50:06');
INSERT INTO `data` VALUES (17, 1, NULL, '123', NULL, '2021', NULL, '2022-11-29 17:44:39');
INSERT INTO `data` VALUES (18, 1, NULL, '1233113', NULL, '2022', NULL, '2022-11-29 17:36:18');
INSERT INTO `data` VALUES (27, 1, NULL, '2389472389', NULL, '2018', NULL, '2022-11-29 18:22:38');
INSERT INTO `data` VALUES (28, 1, NULL, '123', NULL, '2020', NULL, '2022-11-29 18:22:45');
INSERT INTO `data` VALUES (29, 1, NULL, '41414141', NULL, '2022', NULL, '2022-11-29 18:22:58');
INSERT INTO `data` VALUES (30, 1, NULL, '18312938', 'Data_Pembudidaya_Ikan_Konsumsi_(3)1.xlsx', '2022', NULL, '2022-11-29 18:23:07');
INSERT INTO `data` VALUES (31, 2, NULL, '199031', NULL, '2022', NULL, '2022-11-29 19:57:48');
INSERT INTO `data` VALUES (32, 1, NULL, '12345', NULL, '2022', NULL, '2022-11-29 21:53:45');
INSERT INTO `data` VALUES (33, 1, NULL, '8122', NULL, '2019', NULL, '2022-11-30 12:15:29');
INSERT INTO `data` VALUES (34, 1, NULL, '90', NULL, '2018', NULL, '2022-11-30 13:21:38');
INSERT INTO `data` VALUES (35, 1, NULL, '9000', NULL, '2018', NULL, '2022-11-30 13:22:39');
INSERT INTO `data` VALUES (36, 1, NULL, '90', NULL, '2018', NULL, '2022-11-30 13:23:31');
INSERT INTO `data` VALUES (37, 1, NULL, '1000', NULL, '2018', NULL, '2022-11-30 13:25:44');
INSERT INTO `data` VALUES (38, 1, NULL, '100', NULL, '2018', NULL, '2022-11-30 13:46:23');
INSERT INTO `data` VALUES (39, 1, NULL, '200', NULL, '2018', NULL, '2022-11-30 13:48:28');
INSERT INTO `data` VALUES (40, 1, NULL, '900', NULL, '2019', NULL, '2022-11-30 13:53:06');
INSERT INTO `data` VALUES (41, 1, NULL, '800', NULL, '2021', NULL, '2022-11-30 13:53:53');
INSERT INTO `data` VALUES (42, 1, NULL, '2000', NULL, '2022', NULL, '2022-11-30 20:21:13');
INSERT INTO `data` VALUES (43, 1, NULL, '1000', NULL, '2022', NULL, '2022-11-30 20:22:57');
INSERT INTO `data` VALUES (44, 10, NULL, '9012', NULL, '2018', NULL, '2022-11-30 21:56:25');
INSERT INTO `data` VALUES (45, 10, NULL, '1000', NULL, '2019', NULL, '2022-11-30 22:06:16');
INSERT INTO `data` VALUES (46, 10, NULL, '348', NULL, '2020', NULL, '2022-11-30 22:06:22');
INSERT INTO `data` VALUES (47, 10, NULL, '800', NULL, '2021', NULL, '2022-11-30 22:06:29');
INSERT INTO `data` VALUES (48, 10, NULL, '400', NULL, '2022', NULL, '2022-11-30 22:06:39');
INSERT INTO `data` VALUES (49, 1, NULL, '500', NULL, '2020', NULL, '2022-11-30 22:10:49');
INSERT INTO `data` VALUES (50, 1, NULL, '1000', NULL, '2018', NULL, '2022-11-30 22:21:51');
INSERT INTO `data` VALUES (51, 13, NULL, '69', NULL, '2018', NULL, '2022-12-01 10:24:28');
INSERT INTO `data` VALUES (52, 13, 21, '88', NULL, '2019', NULL, '2022-12-01 10:25:10');
INSERT INTO `data` VALUES (53, 17, 22, '80', NULL, '2022', NULL, '2022-12-04 22:33:58');
INSERT INTO `data` VALUES (54, 7, 15, '213', NULL, '2018', NULL, '2022-12-04 22:32:54');
INSERT INTO `data` VALUES (55, 7, 11, '444', NULL, '2019', NULL, '2022-12-04 22:32:02');
INSERT INTO `data` VALUES (56, 7, 12, '908', NULL, '2020', NULL, '2022-12-04 22:32:09');
INSERT INTO `data` VALUES (57, 17, NULL, '90', NULL, '2021', NULL, '2022-12-05 17:59:12');
INSERT INTO `data` VALUES (58, 17, NULL, '800', NULL, '2022', NULL, '2022-12-05 17:59:19');
INSERT INTO `data` VALUES (59, 17, NULL, '8', NULL, '2022', NULL, '2022-12-05 18:00:09');
INSERT INTO `data` VALUES (60, 17, NULL, '12', NULL, '2020', NULL, '2022-12-05 18:01:26');
INSERT INTO `data` VALUES (61, 17, 26, '900', NULL, '2021', NULL, '2022-12-05 18:01:47');
INSERT INTO `data` VALUES (62, 17, 23, '121', NULL, '2020', NULL, '2022-12-05 18:02:23');
INSERT INTO `data` VALUES (63, 17, 25, '1212', NULL, '2020', NULL, '2022-12-05 18:04:43');
INSERT INTO `data` VALUES (64, 13, 42, '2', NULL, '2020', NULL, '2022-12-05 18:24:09');
INSERT INTO `data` VALUES (65, 13, 41, '21', NULL, '2021', NULL, '2022-12-05 18:25:06');
INSERT INTO `data` VALUES (66, 13, 27, '9000', NULL, '2022', NULL, '2022-12-05 18:25:15');
INSERT INTO `data` VALUES (67, 13, 40, '99', NULL, '2022', NULL, '2022-12-05 18:26:39');
INSERT INTO `data` VALUES (68, 19, 33, '90', NULL, '2018', NULL, '2022-12-07 08:39:19');
INSERT INTO `data` VALUES (69, 19, 32, '80', NULL, '2020', NULL, '2022-12-07 08:39:25');
INSERT INTO `data` VALUES (70, 19, 30, '89', NULL, '2021', NULL, '2022-12-07 08:39:31');
INSERT INTO `data` VALUES (71, 19, 29, '79', NULL, '2019', NULL, '2022-12-07 08:39:37');
INSERT INTO `data` VALUES (72, 19, 28, '98', NULL, '2022', NULL, '2022-12-07 08:39:47');
INSERT INTO `data` VALUES (73, 18, 39, '80', NULL, '2022', NULL, '2022-12-07 10:27:07');
INSERT INTO `data` VALUES (74, 7, 36, '443', NULL, '2019', NULL, '2022-12-07 11:18:41');
INSERT INTO `data` VALUES (75, 7, 38, '400', NULL, '2020', NULL, '2022-12-07 11:20:41');
INSERT INTO `data` VALUES (76, 17, NULL, '12', NULL, '2018', NULL, '2022-12-08 10:47:46');
INSERT INTO `data` VALUES (77, 17, NULL, '31', NULL, '2019', NULL, '2022-12-08 10:47:51');
INSERT INTO `data` VALUES (78, 17, NULL, '31', NULL, '2019', NULL, '2022-12-08 10:47:58');
INSERT INTO `data` VALUES (79, 10, NULL, '90', NULL, '2018', NULL, '2022-12-08 11:25:39');
INSERT INTO `data` VALUES (80, 23, NULL, '80', NULL, '2018', NULL, '2022-12-10 16:47:03');
INSERT INTO `data` VALUES (81, 24, NULL, '30', NULL, '2019', NULL, '2022-12-10 17:19:24');
INSERT INTO `data` VALUES (82, 22, NULL, '1.8', NULL, '2018', NULL, '2022-12-11 10:18:35');
INSERT INTO `data` VALUES (83, 22, 47, '1.6', NULL, '2019', NULL, '2022-12-11 10:18:57');
INSERT INTO `data` VALUES (84, 22, NULL, '1.4', NULL, '2018', NULL, '2022-12-11 10:19:05');
INSERT INTO `data` VALUES (85, 22, 46, '1.6', NULL, '2020', NULL, '2022-12-11 10:19:26');
INSERT INTO `data` VALUES (86, 22, 43, '2.51', NULL, '2021', NULL, '2022-12-11 10:19:36');
INSERT INTO `data` VALUES (88, 22, 45, 'n/a', NULL, '2018', NULL, '2022-12-11 10:50:47');
INSERT INTO `data` VALUES (89, 22, 44, 'n/a', NULL, '2022', NULL, '2022-12-11 10:51:43');
INSERT INTO `data` VALUES (90, 44, NULL, 'n/a', NULL, '2018', NULL, '2022-12-11 20:01:51');
INSERT INTO `data` VALUES (91, 44, 49, '30', NULL, '2019', NULL, '2022-12-11 20:01:57');
INSERT INTO `data` VALUES (92, 44, 48, '56', NULL, '2020', NULL, '2022-12-11 20:02:05');
INSERT INTO `data` VALUES (93, 45, NULL, '43', NULL, '2018', NULL, '2022-12-11 20:02:21');
INSERT INTO `data` VALUES (94, 45, NULL, '65', NULL, '2019', NULL, '2022-12-11 20:02:26');
INSERT INTO `data` VALUES (95, 23, NULL, '70', NULL, '2019', NULL, '2022-12-11 20:04:27');
INSERT INTO `data` VALUES (96, 44, NULL, '89', NULL, '2019', NULL, '2022-12-11 20:07:42');
INSERT INTO `data` VALUES (97, 1, NULL, '1000', NULL, '2018', 'asjdoiad', '2022-12-11 21:36:54');
INSERT INTO `data` VALUES (98, 1, NULL, '1000', 'Daerah_diy-sumber-air-minum-2018-2022.xlsx', '2018', 'asjdoiad', '2022-12-12 08:15:12');
INSERT INTO `data` VALUES (99, 1, NULL, '1000', NULL, '2018', 'asjdoiad', '2022-12-12 08:15:19');
INSERT INTO `data` VALUES (100, 22, 51, '3.0', 'Daerah_diy-sumber-air-minum-2018-20221.xlsx', '2022', 'Naik signifikan', '2022-12-12 09:50:40');
INSERT INTO `data` VALUES (101, 22, NULL, '5', NULL, '2023', '', '2022-12-12 10:24:45');

-- ----------------------------
-- Table structure for data_verifikasi
-- ----------------------------
DROP TABLE IF EXISTS `data_verifikasi`;
CREATE TABLE `data_verifikasi`  (
  `id_verifikasi` int NOT NULL AUTO_INCREMENT,
  `id_data` int NULL DEFAULT NULL,
  `status_verifikasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_verifikasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of data_verifikasi
-- ----------------------------
INSERT INTO `data_verifikasi` VALUES (7, 56, '1', '', '2022-12-04 22:29:10');
INSERT INTO `data_verifikasi` VALUES (8, 55, '2', 'dasdasd', '2022-12-04 22:29:24');
INSERT INTO `data_verifikasi` VALUES (9, 55, '1', 'dasdasd', '2022-12-04 22:30:11');
INSERT INTO `data_verifikasi` VALUES (10, 55, '1', 'dasdasd', '2022-12-04 22:30:24');
INSERT INTO `data_verifikasi` VALUES (11, 55, '2', 'dasdasd', '2022-12-04 22:32:02');
INSERT INTO `data_verifikasi` VALUES (12, 56, '2', 'asjdna', '2022-12-04 22:32:09');
INSERT INTO `data_verifikasi` VALUES (13, 54, '2', 'jsanxkas', '2022-12-04 22:32:23');
INSERT INTO `data_verifikasi` VALUES (14, 54, '1', 'jsanxkas', NULL);
INSERT INTO `data_verifikasi` VALUES (15, 54, '1', 'jsanxkas', NULL);
INSERT INTO `data_verifikasi` VALUES (16, 53, '1', '', NULL);
INSERT INTO `data_verifikasi` VALUES (17, 53, '1', '', NULL);
INSERT INTO `data_verifikasi` VALUES (18, 53, '1', '', NULL);
INSERT INTO `data_verifikasi` VALUES (19, 53, '1', '', '2022-12-04 22:34:58');
INSERT INTO `data_verifikasi` VALUES (20, 52, '1', '', '2022-12-04 22:35:03');
INSERT INTO `data_verifikasi` VALUES (21, 52, '1', 'Sudah Bag\r\n', '2022-12-04 22:35:19');
INSERT INTO `data_verifikasi` VALUES (22, 53, '2', 'dsad', '2022-12-05 17:53:07');
INSERT INTO `data_verifikasi` VALUES (23, 62, '1', '', '2022-12-05 18:04:36');
INSERT INTO `data_verifikasi` VALUES (24, 63, '2', 'Anomali', '2022-12-05 18:05:24');
INSERT INTO `data_verifikasi` VALUES (25, 63, '1', 'Anomali', '2022-12-05 18:19:24');
INSERT INTO `data_verifikasi` VALUES (26, 61, '2', 'Kurang', '2022-12-05 18:21:51');
INSERT INTO `data_verifikasi` VALUES (27, 66, '2', 'anomali', '2022-12-05 18:25:50');
INSERT INTO `data_verifikasi` VALUES (28, 72, '1', '', '2022-12-07 08:40:17');
INSERT INTO `data_verifikasi` VALUES (29, 71, '1', 'jadhajk', '2022-12-07 08:40:21');
INSERT INTO `data_verifikasi` VALUES (30, 70, '1', '', '2022-12-07 08:42:18');
INSERT INTO `data_verifikasi` VALUES (31, 69, '2', 'Data tidak sesuai dengan data sebelumnya', '2022-12-07 08:42:38');
INSERT INTO `data_verifikasi` VALUES (32, 69, '1', 'Sudah OK', '2022-12-07 08:43:00');
INSERT INTO `data_verifikasi` VALUES (33, 68, '1', '', '2022-12-07 10:20:43');
INSERT INTO `data_verifikasi` VALUES (34, 73, '2', 'Ora genah', '2022-12-07 11:17:12');
INSERT INTO `data_verifikasi` VALUES (35, 75, '1', '', '2022-12-07 11:20:57');
INSERT INTO `data_verifikasi` VALUES (36, 74, '1', '', '2022-12-07 11:21:01');
INSERT INTO `data_verifikasi` VALUES (37, 73, '1', 'Ora genah', '2022-12-07 11:22:53');
INSERT INTO `data_verifikasi` VALUES (38, 75, '2', 'dkasld', '2022-12-07 11:42:15');
INSERT INTO `data_verifikasi` VALUES (39, 73, '2', 'Ora genah', '2022-12-08 10:34:22');
INSERT INTO `data_verifikasi` VALUES (40, 67, '1', '', '2022-12-08 10:41:23');
INSERT INTO `data_verifikasi` VALUES (41, 65, '1', '', '2022-12-08 10:41:28');
INSERT INTO `data_verifikasi` VALUES (42, 64, '1', '', '2022-12-08 10:41:32');
INSERT INTO `data_verifikasi` VALUES (43, 86, '1', '', '2022-12-11 10:28:34');
INSERT INTO `data_verifikasi` VALUES (44, 89, '1', '', '2022-12-11 17:53:02');
INSERT INTO `data_verifikasi` VALUES (45, 88, '1', '', '2022-12-11 17:53:08');
INSERT INTO `data_verifikasi` VALUES (46, 85, '1', '', '2022-12-11 17:53:12');
INSERT INTO `data_verifikasi` VALUES (47, 83, '1', '', '2022-12-11 17:53:17');
INSERT INTO `data_verifikasi` VALUES (48, 92, '1', '', '2022-12-11 20:07:04');
INSERT INTO `data_verifikasi` VALUES (49, 91, '2', 'Data anomali', '2022-12-11 20:07:16');
INSERT INTO `data_verifikasi` VALUES (50, 100, '1', 'Sudah Ok', '2022-12-12 10:23:21');
INSERT INTO `data_verifikasi` VALUES (51, 100, '2', 'Data Anomali', '2022-12-12 10:23:51');

-- ----------------------------
-- Table structure for indikator
-- ----------------------------
DROP TABLE IF EXISTS `indikator`;
CREATE TABLE `indikator`  (
  `id_indikator` int NOT NULL AUTO_INCREMENT,
  `nama_indikator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `definisi_operasional` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_main_indikator` int NULL DEFAULT NULL,
  `id_skpd` int NULL DEFAULT NULL,
  `id_keluaran` int NULL DEFAULT NULL,
  `id_satuan` int NULL DEFAULT NULL,
  `id_akses` int NULL DEFAULT NULL,
  `id_periodik` int NULL DEFAULT NULL,
  `metadata` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NULL,
  `id_konfirmasi` int NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_indikator`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of indikator
-- ----------------------------
INSERT INTO `indikator` VALUES (1, 'djsad', 'dhasjkd', '1', NULL, 1, NULL, 1, 1, NULL, '{\"sumber_data\":\"rw\",\"cara_pengambilan_data\":\"udhauid\",\"test\":\"fdsffffffffffffffffffffffff\",\"kolom_baru\":\"\"}', 20, '2022-12-11 12:35:38');
INSERT INTO `indikator` VALUES (2, '101010101', 'dhasjkd', '1', NULL, 3, NULL, 1, 1, NULL, '{\"sumber_data_asli\":\"dhwad\",\"cara_pengambilan_data\":\"udhauid\"}', 27, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (3, 'test', '18319238', '1', NULL, 3, NULL, 1, 1, NULL, '{\"sumber_data_asli\":\"jdaskjd\",\"cara_pengambilan_data\":\"9039\",\"test\":\"djksaa\"}', 43, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (4, 'tes', '213', '1', NULL, 3, NULL, 2, 1, NULL, '{\"sumber_data_asli\":\"\",\"cara_pengambilan_data\":\"\"}', 28, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (5, 'ijwq', 'dji', '1', NULL, 3, NULL, 1, 1, NULL, '{\"sumber_data_asli\":\"\",\"cara_pengambilan_data\":\"\"}', 30, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (6, 'jad', 'djak', '1', NULL, 2, NULL, 1, 1, NULL, '{\"sumber_data_asli\":\"\",\"cara_pengambilan_data\":\"\"}', 39, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (7, 'asjdio', 'djoaisd', '1', NULL, 3, NULL, 2, 1, NULL, '{\"sumber_data_asli\":\"\",\"cara_pengambilan_data\":\"\"}', 40, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (8, 'asjdio', 'djoaisd', '1', NULL, 3, NULL, 2, 1, NULL, '{\"sumber_data_asli\":\"\",\"cara_pengambilan_data\":\"\"}', 41, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (9, 'jasdjklasjdkl', 'dlkasjdl', '1', NULL, 7, NULL, 2, 1, NULL, '{\"sumber_data_asli\":\"adsijkdj\",\"cara_pengambilan_data\":\"dkjalskdj\"}', 42, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (10, 'djiasjd2', '232', '2', 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (13, '12', '12', '2', 1, NULL, NULL, 2, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (14, 'test', 'test', '2', 0, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (15, 'tesss', 'adfasf', '2', 0, NULL, NULL, 1, 1, NULL, NULL, 25, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (16, 'dsa', 'dad', '2', 0, NULL, NULL, 2, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (17, '21', 'ee12sa', '2', 1, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (18, 'tets20202221ijoads', 'kasdmlsmdk', '1', NULL, 3, NULL, 2, 1, NULL, '{\"sumber_data_asli\":\"jasd\",\"cara_pengambilan_data\":\"kdmaslkdm\",\"test\":\"dkmaklsd2\"}', 37, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (19, 'askdj', 'kdsakld', '2', 2, NULL, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (20, 'OKOPKOPKPOKPOKP', 'KADSPODKAOPDKOADK', '1', NULL, 11, NULL, 2, 1, NULL, '{\"sumber_data_asli\":\"AKSJD\",\"cara_pengambilan_data\":\"DJAKLS\",\"test\":\"DJAKLSDJ\"}', 36, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (21, 'OI123UIO12IO3', 'JDASOIJDSAODJ', '2', 20, NULL, NULL, 2, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (22, 'Indeks SPBE', 'penilaian dari penyelenggaraan pemerintahan yang memanfaatkan teknologi informasi dan komunikasi untuk memberikan layanan kepada pengguna SPBE secara terintegrasi', '1', NULL, 22, NULL, 1, 1, NULL, NULL, 49, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (23, 'Jumlah jaringan komunikasi', 'sistem komunikasi umum yang akan digunakan  oleh kelompok dalam mengirimkan pesan dari orang ke orang lain nya', '1', NULL, 22, NULL, 3, 1, NULL, '{\"sumber_data\":\"\",\"cara_pengambilan_data\":\"\",\"test\":\"\",\"kolom_baru\":\"\"}', 48, '2022-12-11 15:42:40');
INSERT INTO `indikator` VALUES (24, 'Jumlah jaringan telepon genggam', 'sistem telekomunikasi elektronik dua arah yang bisa dibawa kemana-mana dan memiliki kemampuan untuk mengirimkan pesan berupa suara', '2', 23, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (25, 'Jumlah jaringan telepon stasioner', 'Jaringan telekomunikasi yang bersifat statis/tetap', '2', 23, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (26, 'Total jaringan komunikasi ', 'rangkaian perangkat telekomunikasi dan kelengkapannya yang digunakan dalam bertelekomunikasi', '2', 23, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (27, 'Rasio wartel/warnet terhadap penduduk', '', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (28, 'Jumlah surat kabar Nasional/Lokal', '-', '1', NULL, 22, NULL, 1, 1, NULL, '{\"sumber_data\":\"\",\"cara_pengambilan_data\":\"\",\"test\":\"\",\"kolom_baru\":\"\"}', 47, '2022-12-12 07:22:07');
INSERT INTO `indikator` VALUES (29, 'Jumlah jenis surat kabar terbitan nasional', 'suatu penerbitan yang ringan dan mudah dibuang, biasanya dicetak pada kertas berbiaya rendah yang disebut kertas koran, yang berisi berita-berita terkini dalam berbagai topik yang terbit dari daerah', '2', 28, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (30, 'Jumlah jenis surat kabar terbitan lokal', 'suatu penerbitan yang ringan dan mudah dibuang, biasanya dicetak pada kertas berbiaya rendah yang disebut kertas koran, yang berisi berita-berita terkini dalam berbagai topik dengan skala nasional', '2', 28, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (31, 'Total jenis surat kabar ', 'jumlah total jenis surat kabar terbitan nasional ditambah jumlah jenis surat kabar terbitan lokal', '2', 28, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (32, 'Jumlah penyiaran radio/tv lokal', 'seorang yang bertugas menyebar luaskan sesuatu atau lebih informasi yang terjamin akurasinya dengan mengandalkan radio dan televisi atau lainnya dengan tujuan untuk diketahui oleh pendengar, dilaksanakan, dituruti, dan dipahami.', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (33, 'Penyiaran radio', 'seseorang yang bertugas untuk memandu atau membawakan acara di program yang diadakan di radio', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (34, 'Penyiaran TV', 'seseorang yang bertugas untuk memandu atau membawakan acara di program yang diadakan di tv', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (35, 'Website milik pemerintah daerah', 'Sistem server internet yang mendukung dokume dibuat secara khusus milik pemerintah', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (36, 'Persentase penduduk yang menggunakan HP ', '', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (37, 'Data informasi sektoral', 'Data statistik yang pemanfaatannya ditujukan untuk memenuhi kebutuhan instansi pemerintah tertentu dalam rangka penyelenggaraan tugas-tugas pemerintah dan tugas pembangunan yag merupakan tugas pokok instansi pemerintah yang bersangkutan.', '1', NULL, 22, NULL, 1, 1, NULL, NULL, 44, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (38, 'Cakupan Pengembangan dan pemberdayaan Kelompok Informasi Masyarakat di Tingkat Kecamatan', 'jangkauan layanan untuk memenuhi kebutuhan telekomunikasi dengan menggunakan jaringan telekomunikasi', '1', NULL, 22, NULL, 1, 1, NULL, NULL, 45, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (39, 'Cakupan Layanan Telekomunikasi', 'jangkauan layanan untuk memenuhi kebutuhan telekomunikasi dengan menggunakan jaringan telekomunikasi', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (40, 'Persentase penduduk yang menggunakan HP/Telepon', 'perbandingan rasio jumlah penduduk yang menggunakan hp/telepon dibagi dengan total jumlah penduduk', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (41, 'Proporsi rumah tangga dengan akses internet', 'perbandingan antara jumlah penduduk yang menggunakan hp/telepon dibagi dengan total jumlah penduduk jumlah rumah tangga yang memiliki akses internet dibagi dengan jumlah rumah tangga', '1', NULL, 22, NULL, 1, 1, NULL, NULL, NULL, '2022-12-11 12:35:40');
INSERT INTO `indikator` VALUES (42, 'Proporsi rumah tangga yang memiliki komputer pribadi', 'perbandingan antara jumlah rumah tangga yang memiliki komputer pribadi dibanding dengan jumlah rumah tangga total', '1', NULL, 22, NULL, 1, 1, NULL, NULL, 51, '2022-12-11 19:58:22');
INSERT INTO `indikator` VALUES (43, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, '{\"sumber_data\":null,\"cara_pengambilan_data\":null,\"test\":null,\"kolom_baru\":null}', NULL, '2022-12-11 12:39:46');
INSERT INTO `indikator` VALUES (44, 'Coba Kominfo', 'Coba desk', '1', NULL, 22, NULL, 4, 2, NULL, '{\"konsep\":\"Konsep\"}', 50, '2022-12-11 20:18:23');
INSERT INTO `indikator` VALUES (45, 'Sub 1 Test', 'Def 1 test sub', '2', 44, NULL, NULL, 2, NULL, NULL, NULL, NULL, '2022-12-11 19:56:57');
INSERT INTO `indikator` VALUES (46, 'Januari', '', '2', 44, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2022-12-11 20:25:49');
INSERT INTO `indikator` VALUES (47, 'Coba Tambah', 'Def', '1', NULL, 22, NULL, 4, 1, NULL, '{\"konsep\":\"Konsep Coba coba\"}', NULL, '2022-12-12 09:43:51');
INSERT INTO `indikator` VALUES (48, 'Sub Cob Januari', 'Bulan Januari', '2', 47, NULL, NULL, 2, NULL, NULL, NULL, NULL, '2022-12-12 09:45:42');

-- ----------------------------
-- Table structure for indikator_konfirmasi
-- ----------------------------
DROP TABLE IF EXISTS `indikator_konfirmasi`;
CREATE TABLE `indikator_konfirmasi`  (
  `id_konfirmasi` int NOT NULL AUTO_INCREMENT,
  `id_indikator` int NOT NULL,
  `status_konfirmasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alasan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `skpd_pengganti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_konfirmasi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 52 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of indikator_konfirmasi
-- ----------------------------
INSERT INTO `indikator_konfirmasi` VALUES (1, 1, '13', NULL, NULL, NULL, '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (2, 1, '13', NULL, NULL, NULL, '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (3, 0, '1', '1', NULL, '', '2022-11-21 11:24:08');
INSERT INTO `indikator_konfirmasi` VALUES (4, 0, '1', NULL, NULL, NULL, '2022-11-21 11:26:21');
INSERT INTO `indikator_konfirmasi` VALUES (5, 1, '13', '1', NULL, 'kljasdkasdn', '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (6, 1, '13', '1', NULL, 'kljasdkasdn', '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (7, 1, '13', '1', NULL, 'kljasdkasdn', '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (8, 1, '13', '2', '14', 'pendidikan', '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (9, 2, '2', '1', NULL, 'jadjdkasd', '2022-11-21 11:45:34');
INSERT INTO `indikator_konfirmasi` VALUES (10, 1, '13', NULL, NULL, NULL, '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (11, 1, '13', NULL, NULL, NULL, '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (12, 3, '12', NULL, NULL, NULL, '2022-11-21 11:53:02');
INSERT INTO `indikator_konfirmasi` VALUES (13, 1, '13', NULL, NULL, NULL, '2022-11-21 11:53:39');
INSERT INTO `indikator_konfirmasi` VALUES (14, 1, '1', NULL, NULL, NULL, '2022-11-21 11:53:56');
INSERT INTO `indikator_konfirmasi` VALUES (15, 2, '1', NULL, NULL, NULL, '2022-11-21 12:10:48');
INSERT INTO `indikator_konfirmasi` VALUES (16, 2, '2', '2', '3', 'jkhj', '2022-11-21 12:11:03');
INSERT INTO `indikator_konfirmasi` VALUES (17, 2, '1', NULL, NULL, NULL, '2022-11-21 12:19:36');
INSERT INTO `indikator_konfirmasi` VALUES (18, 2, '2', '1', NULL, '', '2022-11-21 12:52:59');
INSERT INTO `indikator_konfirmasi` VALUES (19, 1, '2', '1', NULL, '', '2022-11-21 13:13:02');
INSERT INTO `indikator_konfirmasi` VALUES (20, 1, '1', NULL, NULL, NULL, '2022-11-21 19:44:18');
INSERT INTO `indikator_konfirmasi` VALUES (21, 3, '2', '1', NULL, 'bhjb', '2022-11-21 19:58:29');
INSERT INTO `indikator_konfirmasi` VALUES (22, 2, '2', '2', '3', 'da', '2022-11-23 10:31:57');
INSERT INTO `indikator_konfirmasi` VALUES (23, 2, '1', NULL, NULL, NULL, '2022-11-23 10:34:10');
INSERT INTO `indikator_konfirmasi` VALUES (24, 15, '1', NULL, NULL, NULL, '2022-11-23 10:35:51');
INSERT INTO `indikator_konfirmasi` VALUES (25, 15, '2', '2', '2', 'fd', '2022-11-23 10:36:20');
INSERT INTO `indikator_konfirmasi` VALUES (26, 2, '2', '1', NULL, '', '2022-11-29 14:52:59');
INSERT INTO `indikator_konfirmasi` VALUES (27, 2, '1', NULL, NULL, NULL, '2022-11-29 16:16:46');
INSERT INTO `indikator_konfirmasi` VALUES (28, 4, '1', NULL, NULL, NULL, '2022-12-01 09:41:05');
INSERT INTO `indikator_konfirmasi` VALUES (29, 5, '1', NULL, NULL, NULL, '2022-12-01 09:50:08');
INSERT INTO `indikator_konfirmasi` VALUES (30, 5, '2', '1', NULL, '', '2022-12-01 09:50:19');
INSERT INTO `indikator_konfirmasi` VALUES (31, 6, '1', NULL, NULL, NULL, '2022-12-01 09:56:57');
INSERT INTO `indikator_konfirmasi` VALUES (32, 7, '1', NULL, NULL, NULL, '2022-12-01 10:18:45');
INSERT INTO `indikator_konfirmasi` VALUES (33, 18, '1', NULL, NULL, NULL, '2022-12-07 08:41:13');
INSERT INTO `indikator_konfirmasi` VALUES (34, 8, '1', NULL, NULL, NULL, '2022-12-09 00:31:20');
INSERT INTO `indikator_konfirmasi` VALUES (35, 9, '1', NULL, NULL, NULL, '2022-12-09 00:31:24');
INSERT INTO `indikator_konfirmasi` VALUES (36, 20, '1', NULL, NULL, NULL, '2022-12-09 00:31:30');
INSERT INTO `indikator_konfirmasi` VALUES (37, 18, '2', '1', NULL, '', '2022-12-09 00:33:07');
INSERT INTO `indikator_konfirmasi` VALUES (38, 8, '2', '1', NULL, 'das', '2022-12-09 09:16:02');
INSERT INTO `indikator_konfirmasi` VALUES (39, 6, '2', '1', NULL, '', '2022-12-10 14:51:21');
INSERT INTO `indikator_konfirmasi` VALUES (40, 7, '2', '1', NULL, '', '2022-12-10 14:51:34');
INSERT INTO `indikator_konfirmasi` VALUES (41, 8, '1', NULL, NULL, NULL, '2022-12-10 14:51:49');
INSERT INTO `indikator_konfirmasi` VALUES (42, 9, '2', '1', NULL, '', '2022-12-10 14:52:29');
INSERT INTO `indikator_konfirmasi` VALUES (43, 3, '1', NULL, NULL, NULL, '2022-12-10 14:52:41');
INSERT INTO `indikator_konfirmasi` VALUES (44, 37, '1', NULL, NULL, NULL, '2022-12-10 15:55:00');
INSERT INTO `indikator_konfirmasi` VALUES (45, 38, '1', NULL, NULL, NULL, '2022-12-10 15:55:03');
INSERT INTO `indikator_konfirmasi` VALUES (46, 23, '1', NULL, NULL, NULL, '2022-12-10 15:55:09');
INSERT INTO `indikator_konfirmasi` VALUES (47, 28, '1', NULL, NULL, NULL, '2022-12-10 15:55:14');
INSERT INTO `indikator_konfirmasi` VALUES (48, 23, '1', NULL, NULL, NULL, '2022-12-10 17:19:08');
INSERT INTO `indikator_konfirmasi` VALUES (49, 22, '1', NULL, NULL, NULL, '2022-12-10 17:20:46');
INSERT INTO `indikator_konfirmasi` VALUES (50, 44, '1', NULL, NULL, NULL, '2022-12-11 19:58:10');
INSERT INTO `indikator_konfirmasi` VALUES (51, 42, '2', '1', NULL, '', '2022-12-11 19:58:22');

-- ----------------------------
-- Table structure for keluaran_indikator
-- ----------------------------
DROP TABLE IF EXISTS `keluaran_indikator`;
CREATE TABLE `keluaran_indikator`  (
  `id_ur_in` int NOT NULL AUTO_INCREMENT,
  `id_keluaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_indikator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_ur_in`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of keluaran_indikator
-- ----------------------------
INSERT INTO `keluaran_indikator` VALUES (59, '1', '44', '2022-12-11 22:11:13');
INSERT INTO `keluaran_indikator` VALUES (60, '1', '37', '2022-12-12 10:26:35');
INSERT INTO `keluaran_indikator` VALUES (61, '1', '1', '2022-12-12 10:26:35');
INSERT INTO `keluaran_indikator` VALUES (62, '1', '3', '2022-12-12 10:26:35');

-- ----------------------------
-- Table structure for p_buku
-- ----------------------------
DROP TABLE IF EXISTS `p_buku`;
CREATE TABLE `p_buku`  (
  `id_buku` int NOT NULL AUTO_INCREMENT,
  `id_skpd` int NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `cover` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_buku`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of p_buku
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_akses`;
CREATE TABLE `tbl_akses`  (
  `id_akses` int NOT NULL AUTO_INCREMENT,
  `nama_akses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_akses`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_akses
-- ----------------------------
INSERT INTO `tbl_akses` VALUES (1, 'Data Terbuka', NULL, '1', '2022-12-11 21:39:10');
INSERT INTO `tbl_akses` VALUES (2, 'Data Terbatas', NULL, '1', '2022-12-11 21:39:16');
INSERT INTO `tbl_akses` VALUES (3, 'Data Tertutup', NULL, '1', '2022-12-11 21:39:22');

-- ----------------------------
-- Table structure for tbl_keluaran
-- ----------------------------
DROP TABLE IF EXISTS `tbl_keluaran`;
CREATE TABLE `tbl_keluaran`  (
  `id_keluaran` int NOT NULL AUTO_INCREMENT,
  `nama_keluaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keluaran`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_keluaran
-- ----------------------------
INSERT INTO `tbl_keluaran` VALUES (1, 'IKD', 'Indeks K D', '1', '2022-12-13 09:13:02');
INSERT INTO `tbl_keluaran` VALUES (2, 'SDGs', 'S Desa Gs', '1', '2022-12-13 09:13:02');

-- ----------------------------
-- Table structure for tbl_metadata
-- ----------------------------
DROP TABLE IF EXISTS `tbl_metadata`;
CREATE TABLE `tbl_metadata`  (
  `id_metadata` int NOT NULL AUTO_INCREMENT,
  `nama_metadata` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `key_metadata` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_metadata`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_metadata
-- ----------------------------
INSERT INTO `tbl_metadata` VALUES (9, 'Konsep', 'konsep', 'Ide yang mendasari data dan tujuan data tersebut diproduksi', '1', '2022-12-13 08:54:10');
INSERT INTO `tbl_metadata` VALUES (10, 'Definisi', 'definisi', 'Definisi adalah bal bla bla', '1', '2022-12-13 08:54:10');
INSERT INTO `tbl_metadata` VALUES (11, 'No Romantik', 'no_romantik', 'romantik.bps.go.id', '1', '2022-12-13 08:54:10');

-- ----------------------------
-- Table structure for tbl_periodik
-- ----------------------------
DROP TABLE IF EXISTS `tbl_periodik`;
CREATE TABLE `tbl_periodik`  (
  `id_periodik` int NOT NULL AUTO_INCREMENT,
  `nama_periodik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_periodik`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_periodik
-- ----------------------------
INSERT INTO `tbl_periodik` VALUES (1, 'Tahunan', NULL, '1', '2022-12-11 21:39:10');
INSERT INTO `tbl_periodik` VALUES (2, 'Bulanan', NULL, '1', '2022-12-11 21:39:16');
INSERT INTO `tbl_periodik` VALUES (3, 'Triwulan', NULL, '2', '2022-12-11 21:39:22');
INSERT INTO `tbl_periodik` VALUES (5, 'Semester', '', '2', '2022-12-13 07:50:19');

-- ----------------------------
-- Table structure for tbl_satuan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_satuan`;
CREATE TABLE `tbl_satuan`  (
  `id_satuan` int NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `lambang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_satuan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_satuan
-- ----------------------------
INSERT INTO `tbl_satuan` VALUES (1, 'Kilogram', 'Kg', 'Saatuan Berat Kilo', '1', '2022-12-13 09:13:25');
INSERT INTO `tbl_satuan` VALUES (2, 'Rupiah', 'Rp', 'Mata uang Indonesia', '1', '2022-12-13 09:13:26');
INSERT INTO `tbl_satuan` VALUES (3, 'Point', '', 'Titik', '1', '2022-12-13 09:13:25');
INSERT INTO `tbl_satuan` VALUES (4, 'Coba', NULL, NULL, '1', '2022-12-13 09:13:27');

-- ----------------------------
-- Table structure for tbl_skpd
-- ----------------------------
DROP TABLE IF EXISTS `tbl_skpd`;
CREATE TABLE `tbl_skpd`  (
  `id_skpd` int NOT NULL AUTO_INCREMENT,
  `nama_skpd` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `no_telp` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `website` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `timestamp` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_skpd`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 137 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_skpd
-- ----------------------------
INSERT INTO `tbl_skpd` VALUES (1, 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (2, 'Badan Kesatuan Bangsa dan Politik', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (3, 'Badan Penanggulangan Bencana Daerah', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (4, 'Badan Pendapatan Daerah', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (5, 'Badan Pengelolaan Keuangan dan Aset Daerah', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (6, 'Badan Perencanaan Pembangunan Daerah', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (7, 'Bagian Adm. Kesra', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (8, 'Bagian Adm. Pembangunan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (9, 'Bagian Adm. Pemerintahaan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (10, 'Bagian Adm. Perekonomian', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (11, 'Bagian Hukum', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (12, 'Bagian Humas dan Protokol', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (13, 'Bagian Organisasi', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (14, 'Bagian Pengadaan Barang dan Jasa', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (15, 'Bagian Perencanaan dan Keuangan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (16, 'Bagian Umum', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (17, 'Dinas Inspektorat', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (18, 'Dinas Kepemudaan, Olahraga dan Pariwisata', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (19, 'Dinas Kependudukan dan Capil', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (20, 'Dinas Kesehatan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (21, 'Dinas Ketahanan Pangan dan Perikanan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (22, 'Dinas Komunikasi dan Informatika', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (23, 'Dinas Koperasi dan Usaha Mikro', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (24, 'Dinas Lingkungan Hidup', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (25, 'Dinas Pekerjaan Umum dan Penataan Ruang', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (26, 'Dinas Pemberdayaan Masyarakat dan Desa', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (27, 'Dinas Penanaman Modal dan PTSP', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (28, 'Dinas Pendidikan dan Kebudayaan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (29, 'Dinas Pengendalian Penduduk dan Keluarga Berencana dan PPPA', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (30, 'Dinas Perdagangan dan Perindustrian', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (31, 'Dinas Perhubungan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (32, 'Dinas Perpustakaan dan Kearsipan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (33, 'Dinas Pertanian', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (34, 'Dinas Perumahan dan Pemukiman', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (35, 'Dinas Peternakan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (36, 'Dinas Satpol PP', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (37, 'Dinas Sosial', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (38, 'Dinas Tenaga Kerja', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (39, 'Kecamatan Bandarkedungmulyo', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (40, 'Kecamatan Bareng', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (41, 'Kecamatan Diwek', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (42, 'Kecamatan Gudo', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (43, 'Kecamatan Jogoroto', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (44, 'Kecamatan Jombang', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (45, 'Kecamatan Kabuh', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (46, 'Kecamatan Kesamben', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (47, 'Kecamatan Kudu', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (48, 'Kecamatan Megaluh', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (49, 'Kecamatan Mojoagung', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (50, 'Kecamatan Mojowarno', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (51, 'Kecamatan Ngoro', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (52, 'Kecamatan Ngusikan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (53, 'Kecamatan Perak', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (54, 'Kecamatan Peterongan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (55, 'Kecamatan Plandaan', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (56, 'Kecamatan Ploso', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (57, 'Kecamatan Sumobito', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (58, 'Kecamatan Tembelang', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (59, 'Kecamatan Wonosalam', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (60, 'RSUD Jombang', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (61, 'RSUD Ploso', NULL, NULL, NULL, '1', NULL);
INSERT INTO `tbl_skpd` VALUES (62, 'Sekretariat DPRD', NULL, NULL, NULL, '1', NULL);

-- ----------------------------
-- Table structure for tbl_tahun
-- ----------------------------
DROP TABLE IF EXISTS `tbl_tahun`;
CREATE TABLE `tbl_tahun`  (
  `id_tahun` int NOT NULL AUTO_INCREMENT,
  `nama_tahun` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_tahun`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_tahun
-- ----------------------------
INSERT INTO `tbl_tahun` VALUES (1, '2018', '', '2', '2022-12-13 11:53:14');
INSERT INTO `tbl_tahun` VALUES (2, '2019', '', '1', '2022-12-13 11:34:21');
INSERT INTO `tbl_tahun` VALUES (3, '2020', '', '1', '2022-12-13 11:34:20');
INSERT INTO `tbl_tahun` VALUES (4, '2021', '', '1', '2022-12-13 09:13:47');
INSERT INTO `tbl_tahun` VALUES (5, '2022', '', '1', '2022-12-13 09:13:47');
INSERT INTO `tbl_tahun` VALUES (8, '2023', 'Tahun 2023', '1', '2022-12-13 11:53:21');

-- ----------------------------
-- Table structure for tbl_urusan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_urusan`;
CREATE TABLE `tbl_urusan`  (
  `id_urusan` int NOT NULL AUTO_INCREMENT,
  `nama_urusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_urusan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_urusan
-- ----------------------------
INSERT INTO `tbl_urusan` VALUES (1, 'Kesehatan', 'Kd', '1', '2022-12-13 09:13:53');
INSERT INTO `tbl_urusan` VALUES (2, 'Informatika', '31', '1', '2022-12-13 09:13:55');
INSERT INTO `tbl_urusan` VALUES (3, 'Kependudukan', NULL, '1', '2022-12-13 09:13:53');

-- ----------------------------
-- Table structure for urusan_indikator
-- ----------------------------
DROP TABLE IF EXISTS `urusan_indikator`;
CREATE TABLE `urusan_indikator`  (
  `id_ur_in` int NOT NULL AUTO_INCREMENT,
  `id_urusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_indikator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id_ur_in`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 59 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of urusan_indikator
-- ----------------------------
INSERT INTO `urusan_indikator` VALUES (15, '1', '2', '2022-12-09 00:16:28');
INSERT INTO `urusan_indikator` VALUES (19, '3', '2', '2022-12-09 00:21:08');
INSERT INTO `urusan_indikator` VALUES (21, '3', '4', '2022-12-09 00:21:09');
INSERT INTO `urusan_indikator` VALUES (30, '2', '38', '2022-12-10 22:37:42');
INSERT INTO `urusan_indikator` VALUES (32, '2', '22', '2022-12-10 22:37:42');
INSERT INTO `urusan_indikator` VALUES (33, '2', '23', '2022-12-10 22:37:42');
INSERT INTO `urusan_indikator` VALUES (34, '2', '28', '2022-12-10 22:37:42');
INSERT INTO `urusan_indikator` VALUES (35, '1', '8', '2022-12-11 00:26:03');
INSERT INTO `urusan_indikator` VALUES (42, '3', '8', '2022-12-11 00:26:10');
INSERT INTO `urusan_indikator` VALUES (43, '3', '38', '2022-12-11 00:26:10');
INSERT INTO `urusan_indikator` VALUES (44, '3', '37', '2022-12-11 00:26:10');
INSERT INTO `urusan_indikator` VALUES (45, '3', '1', '2022-12-11 00:26:10');
INSERT INTO `urusan_indikator` VALUES (46, '3', '22', '2022-12-11 00:26:10');
INSERT INTO `urusan_indikator` VALUES (47, '3', '23', '2022-12-11 00:26:10');
INSERT INTO `urusan_indikator` VALUES (48, '4', '2', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (49, '4', '8', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (50, '4', '38', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (51, '4', '37', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (52, '4', '1', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (53, '4', '22', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (54, '4', '23', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (55, '4', '28', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (56, '4', '20', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (57, '4', '4', '2022-12-11 00:38:15');
INSERT INTO `urusan_indikator` VALUES (58, '4', '3', '2022-12-11 00:38:15');

-- ----------------------------
-- View structure for v_indikator
-- ----------------------------
DROP VIEW IF EXISTS `v_indikator`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_indikator` AS SELECT
  i.*,
  s.nama_skpd,
  st.nama_satuan,
  pr.nama_periodik,
  ak.nama_akses,
  ik.status_konfirmasi 
FROM
  indikator i
  LEFT JOIN tbl_skpd s ON i.id_skpd = s.id_skpd
  LEFT JOIN tbl_satuan st ON i.id_satuan = st.id_satuan
  LEFT JOIN tbl_akses ak ON i.id_akses = ak.id_akses
  LEFT JOIN tbl_periodik pr ON i.id_periodik = pr.id_periodik
  LEFT JOIN indikator_konfirmasi ik ON i.id_konfirmasi = ik.id_konfirmasi ;

-- ----------------------------
-- View structure for v_data_verifikasi
-- ----------------------------
DROP VIEW IF EXISTS `v_data_verifikasi`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_data_verifikasi` AS SELECT dv
    .* 
  FROM
    data_verifikasi dv,
    ( SELECT id_data, max( `timestamp` ) AS `timestamp` FROM data_verifikasi GROUP BY id_data) max_ts 
  WHERE
    dv.id_data = max_ts.id_data
    AND dv.`timestamp` = max_ts.`timestamp` ;


-- ----------------------------
-- View structure for v_data
-- ----------------------------
DROP VIEW IF EXISTS `v_data`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_data` AS SELECT DATA
	.*
FROM
	DATA,
	( SELECT id_data, id_indikator, tahun, max( `timestamp` ) AS `timestamp` FROM DATA GROUP BY id_indikator, tahun ) max_ts 
WHERE
	DATA.id_indikator = max_ts.id_indikator 
	AND DATA.`timestamp` = max_ts.`timestamp` ;

-- ----------------------------
-- View structure for v_data_full
-- ----------------------------
DROP VIEW IF EXISTS `v_data_full`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_data_full` AS SELECT
	d.*,
	v.status_verifikasi,
	v.keterangan,
	v.`timestamp` AS vtimestamp,
	i.nama_indikator,
	i.nama_satuan,
	i.nama_skpd,
	i.`level`,
	i.id_akses,
	i.id_main_indikator,
	ii.nama_indikator AS main_indikator,
	ii.nama_skpd AS main_skpd,
	i.status_konfirmasi 
FROM
	`v_data` d
	LEFT JOIN v_indikator i ON d.id_indikator = i.id_indikator
	LEFT JOIN v_data_verifikasi v ON d.id_data = v.id_data
	LEFT JOIN v_indikator ii ON i.id_main_indikator = ii.id_indikator ;

-- ----------------------------
-- View structure for v_indikator_konfirmasi_rekap
-- ----------------------------
DROP VIEW IF EXISTS `v_indikator_konfirmasi_rekap`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_indikator_konfirmasi_rekap` AS SELECT
	s.id_skpd,
	s.nama_skpd,
	sk.konfirmasi_sudah,
	sk.konfirmasi_belum,
	sk.konfirmasi_ok,
	sk.konfirmasi_not_ok 
FROM
	tbl_skpd s
	LEFT JOIN (
	SELECT
		id_skpd,
		COUNT(
		IF
		( `i`.`status_konfirmasi` IS NULL, `i`.`id_indikator`, NULL )) AS `konfirmasi_belum`,
		COUNT(
		IF
		( `i`.`status_konfirmasi` IS NOT NULL, `i`.`id_indikator`, NULL )) AS `konfirmasi_sudah`,
		COUNT(
		IF
		( `i`.`status_konfirmasi` = '1', `i`.`id_indikator`, NULL )) AS `konfirmasi_ok`,
		COUNT(
		IF
		( `i`.`status_konfirmasi` = '2', `i`.`id_indikator`, NULL )) AS `konfirmasi_not_ok` 
	FROM
		v_indikator i 
	WHERE
		i.`level` = '1' 
	GROUP BY
	id_skpd 
	) sk ON s.id_skpd = sk.id_skpd ;

SET FOREIGN_KEY_CHECKS = 1;
