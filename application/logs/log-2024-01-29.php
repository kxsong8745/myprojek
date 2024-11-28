<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-01-29 02:56:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:34 --> Severity: Warning --> Undefined variable $idp1 /dev-portalv2/app_psh/application/modules/kursus/controllers/Senarai.php 68
ERROR - 2024-01-29 02:56:34 --> Severity: Warning --> oci_execute(): ORA-00936: missing expression /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 02:56:34 --> Query error: ORA-00936: missing expression - Invalid query: SELECT KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS, KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KM_T07_PELAJAR_MODUL.STATUS_PROSES, 
        KR_T04_KURSUS_BATCH.ID_BATCH, KR_T07_BATCH.NAMA_BATCH, KM_T08_PELAJAR_BATCH.ID_PELAJAR_BATCH,  KM_T08_PELAJAR_BATCH.NO_MATRIK, KR_T06_MODUL_KURSUS_BATCH.NAMA_MODUL, KM_T07_PELAJAR_MODUL.ID_PELAJAR, KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KM_T07_PELAJAR_MODUL.B_STATUS_BAYAR,  KM_T07_PELAJAR_MODUL.B_NO_RUJUKAN,to_char(KM_T07_PELAJAR_MODUL.CREATED_ON,'DD/MM/YYYY') AS TARIKH_DAFTAR 
            FROM KM_T07_PELAJAR_MODUL
            JOIN KR_T06_MODUL_KURSUS_BATCH ON KM_T07_PELAJAR_MODUL.ID_MODUL_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.ID_MODUL_KURSUS_BATCH
            JOIN KR_T04_KURSUS_BATCH ON KR_T04_KURSUS_BATCH.ID_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.T10_ID_KURSUS_BATCH
            JOIN KM_T01_PELAJAR_CORE ON KM_T01_PELAJAR_CORE.ID_PELAJAR = KM_T07_PELAJAR_MODUL.ID_PELAJAR
            JOIN KM_T08_PELAJAR_BATCH ON KM_T08_PELAJAR_BATCH.ID_PELAJAR = KM_T01_PELAJAR_CORE.ID_PELAJAR
             JOIN KR_T07_BATCH ON KR_T07_BATCH.ID_BATCH = KM_T08_PELAJAR_BATCH.ID_BATCH
            WHERE km_t01_pelajar_core.id_pelajar = 
ERROR - 2024-01-29 02:56:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Undefined variable $total /dev-portalv2/app_psh/themes/psh_p/views/header.php 197
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Attempt to read property "PG_T02_NAME" on null /dev-portalv2/app_psh/themes/psh_p/views/menu.php 48
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 158
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 166
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 174
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 182
ERROR - 2024-01-29 02:56:35 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 190
ERROR - 2024-01-29 02:56:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Attempt to read property "PG_T02_NAME" on null /dev-portalv2/app_psh/application/modules/kursus/views/mohon/daftar.php 8
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Attempt to read property "PG_T02_IC" on null /dev-portalv2/app_psh/application/modules/kursus/views/mohon/daftar.php 15
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Undefined variable $total /dev-portalv2/app_psh/themes/psh_p/views/header.php 197
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Attempt to read property "PG_T02_NAME" on null /dev-portalv2/app_psh/themes/psh_p/views/menu.php 48
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 158
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 166
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 174
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 182
ERROR - 2024-01-29 02:56:40 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/themes/psh_p/views/menu.php 190
ERROR - 2024-01-29 02:56:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 02:56:45 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 02:56:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 44
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 45
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 46
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 47
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 48
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 55
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 56
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 57
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 58
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 59
ERROR - 2024-01-29 03:02:44 --> Severity: error --> Exception: Too few arguments to function User_control::__construct(), 0 passed in /dev-portalv2/mynemov3/system/core/Loader.php on line 1292 and exactly 1 expected /dev-portalv2/app_psh/application/libraries/User_control.php 9
ERROR - 2024-01-29 03:02:44 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /dev-portalv2/mynemov3/system/core/Exceptions.php:272) /dev-portalv2/mynemov3/system/core/Common.php 573
ERROR - 2024-01-29 03:02:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:52 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 03:02:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "ALAMAT1_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 22
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "ALAMAT2_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 27
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "ALAMAT3_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 32
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "POSKOD_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 42
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 73
ERROR - 2024-01-29 03:02:55 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 74
ERROR - 2024-01-29 03:02:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:02:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:15 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 55
ERROR - 2024-01-29 03:03:15 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 56
ERROR - 2024-01-29 03:03:15 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 57
ERROR - 2024-01-29 03:03:15 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 58
ERROR - 2024-01-29 03:03:15 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 59
ERROR - 2024-01-29 03:03:15 --> Severity: error --> Exception: Too few arguments to function User_control::__construct(), 0 passed in /dev-portalv2/mynemov3/system/core/Loader.php on line 1292 and exactly 1 expected /dev-portalv2/app_psh/application/libraries/User_control.php 9
ERROR - 2024-01-29 03:03:15 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /dev-portalv2/mynemov3/system/core/Exceptions.php:272) /dev-portalv2/mynemov3/system/core/Common.php 573
ERROR - 2024-01-29 03:03:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:03:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:29 --> Severity: Warning --> Undefined property: CI::$addPermission /dev-portalv2/app_psh/application/third_party/MX/Controller.php 59
ERROR - 2024-01-29 03:10:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:52 --> Severity: Warning --> Undefined property: CI::$addPermission /dev-portalv2/app_psh/application/third_party/MX/Controller.php 59
ERROR - 2024-01-29 03:10:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:10:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:13:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:13:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:13:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:14:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:14:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:15:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:16:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:17:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "ALAMAT1_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 22
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "ALAMAT2_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 27
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "ALAMAT3_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 32
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "POSKOD_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 42
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 73
ERROR - 2024-01-29 03:18:39 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 74
ERROR - 2024-01-29 03:18:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "ALAMAT1_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 22
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "ALAMAT2_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 27
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "ALAMAT3_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 32
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "POSKOD_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 42
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 73
ERROR - 2024-01-29 03:18:41 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 74
ERROR - 2024-01-29 03:18:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:18:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:28 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 03:19:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:19:59 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 03:19:59 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 03:20:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:20:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:34:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:35:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:36:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:38:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:38:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:38:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:38:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:38:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:38:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:39:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:39:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:39:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:39:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:39:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:40:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:45:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:45:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:45:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:45:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:46:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:47:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:48:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:48:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:48:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:49:38 --> Severity: Warning --> oci_execute(): ORA-00001: unique constraint (MCPSH.T15_PELAJAR_BATCH_UK1) violated /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 03:49:38 --> Query error: ORA-00001: unique constraint (MCPSH.T15_PELAJAR_BATCH_UK1) violated - Invalid query: INSERT INTO "KM_T08_PELAJAR_BATCH" ("ID_BATCH", "ID_PELAJAR_DUM", "ID_PELAJAR", "ID_PELAJAR_BATCH") VALUES ('3', '2', '0', '736')
ERROR - 2024-01-29 03:50:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:50:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "ALAMAT1_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 22
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "ALAMAT2_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 27
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "ALAMAT3_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 32
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "POSKOD_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 42
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:20 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 73
ERROR - 2024-01-29 03:51:21 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 74
ERROR - 2024-01-29 03:51:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:32 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 03:51:32 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 03:51:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:51:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:52:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:18 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 03:53:18 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 03:53:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:53:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:24 --> Severity: error --> Exception: Call to undefined method Pelajar_modul_model::get() /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 73
ERROR - 2024-01-29 03:54:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:54:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "amount" /dev-portalv2/app_psh/application/libraries/Bill.php 160
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "id" /dev-portalv2/app_psh/application/libraries/Bill.php 174
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "reference_1" /dev-portalv2/app_psh/application/libraries/Bill.php 165
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "reference_2" /dev-portalv2/app_psh/application/libraries/Bill.php 169
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 03:55:36 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 03:55:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "amount" /dev-portalv2/app_psh/application/libraries/Bill.php 160
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "id" /dev-portalv2/app_psh/application/libraries/Bill.php 174
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "reference_1" /dev-portalv2/app_psh/application/libraries/Bill.php 165
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "reference_2" /dev-portalv2/app_psh/application/libraries/Bill.php 169
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 03:55:38 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 03:55:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:19 --> Severity: error --> Exception: Call to undefined method Pelajar_modul_model::get() /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 73
ERROR - 2024-01-29 03:56:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:43 --> Severity: error --> Exception: Call to undefined method Pelajar_modul_model::get() /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 73
ERROR - 2024-01-29 03:56:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:45 --> Severity: error --> Exception: Call to undefined method Pelajar_modul_model::get() /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 73
ERROR - 2024-01-29 03:56:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:56:49 --> Severity: error --> Exception: Call to undefined method Pelajar_modul_model::get() /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 73
ERROR - 2024-01-29 03:57:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:57:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "ALAMAT1_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 22
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "ALAMAT2_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 27
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "ALAMAT3_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 32
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "POSKOD_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 42
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 73
ERROR - 2024-01-29 03:57:30 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 74
ERROR - 2024-01-29 03:57:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:57:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:57:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:57:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:58:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 03:59:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:00:57 --> Severity: error --> Exception: Too few arguments to function CI_URI::segment(), 0 passed in /dev-portalv2/app_psh/themes/psh_a/views/menu.php on line 71 and at least 1 expected /dev-portalv2/mynemov3/system/core/URI.php 344
ERROR - 2024-01-29 04:01:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> foreach() argument must be of type array|object, string given /dev-portalv2/app_psh/application/modules/kursus/controllers/Bayar.php 59
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "amount" /dev-portalv2/app_psh/application/libraries/Bill.php 160
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "id" /dev-portalv2/app_psh/application/libraries/Bill.php 174
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "reference_1" /dev-portalv2/app_psh/application/libraries/Bill.php 165
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "reference_2" /dev-portalv2/app_psh/application/libraries/Bill.php 169
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 04:01:18 --> Severity: Warning --> Undefined array key "paid" /dev-portalv2/app_psh/application/libraries/Bill.php 155
ERROR - 2024-01-29 04:01:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:26 --> Severity: Warning --> foreach() argument must be of type array|object, string given /dev-portalv2/app_psh/application/modules/kursus/controllers/Bayar.php 59
ERROR - 2024-01-29 04:01:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:01:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:02:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:16 --> Severity: error --> Exception: syntax error, unexpected token "->" /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 74
ERROR - 2024-01-29 04:03:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:24 --> Severity: Warning --> Undefined variable $id /dev-portalv2/app_psh/application/modules/kursus/models/Pelajar_modul_model.php 72
ERROR - 2024-01-29 04:03:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:03:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:04:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:05:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:06 --> Severity: Warning --> oci_execute(): ORA-00001: unique constraint (MCPSH.T15_PELAJAR_BATCH_UK1) violated /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 04:06:06 --> Query error: ORA-00001: unique constraint (MCPSH.T15_PELAJAR_BATCH_UK1) violated - Invalid query: INSERT INTO "KM_T08_PELAJAR_BATCH" ("ID_BATCH", "ID_PELAJAR_DUM", "ID_PELAJAR", "ID_PELAJAR_BATCH") VALUES ('3', '3', '0', '737')
ERROR - 2024-01-29 04:06:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:17 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:06:17 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:06:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:22 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:06:22 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:06:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:36 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:06:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:47 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:06:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:06:48 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:06:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:07:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:07:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:07:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:07:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:07:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:08:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:08:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:08:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:08:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:09:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:09:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:09:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:09:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:10:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:25 --> Severity: Warning --> Array to string conversion /dev-portalv2/mynemov3/system/database/DB_driver.php 1524
ERROR - 2024-01-29 04:11:25 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;ARRAY&quot;: invalid identifier /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 04:11:25 --> Query error: ORA-00904: "ARRAY": invalid identifier - Invalid query: UPDATE "KM_T07_PELAJAR_MODUL" SET "B_AMOUNT_BAYAR" = 350, "B_NO_RUJUKAN" = Array, "B_TARIKH_BAYAR" = '29-Jan-2024 04:11:25', "B_STATUS_BAYAR" = '1'
WHERE "ID_PELAJAR" = '761'
ERROR - 2024-01-29 04:11:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:11:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:53 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:12:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:54 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:12:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:12:55 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:13:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:13:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:13:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:13:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:13:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:13:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:09 --> Severity: Warning --> oci_execute(): ORA-00936: missing expression /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 04:14:09 --> Query error: ORA-00936: missing expression - Invalid query: SELECT KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH, LISTAGG(KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL, ' ') WITHIN GROUP (ORDER BY KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL) AS KOD_MODUL, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS
            FROM KM_T07_PELAJAR_MODUL
            JOIN KR_T06_MODUL_KURSUS_BATCH ON KM_T07_PELAJAR_MODUL.ID_MODUL_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.ID_MODUL_KURSUS_BATCH
            JOIN KR_T04_KURSUS_BATCH ON KR_T04_KURSUS_BATCH.ID_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.T10_ID_KURSUS_BATCH
            JOIN KM_T01_PELAJAR_CORE ON KM_T01_PELAJAR_CORE.ID_PELAJAR = KM_T07_PELAJAR_MODUL.ID_PELAJAR
            JOIN KM_T08_PELAJAR_BATCH ON KM_T08_PELAJAR_BATCH.ID_PELAJAR = KM_T01_PELAJAR_CORE.ID_PELAJAR
            WHERE KM_T08_PELAJAR_BATCH.ID_BATCH = 
            GROUP BY KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS,KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH
ERROR - 2024-01-29 04:14:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:10 --> Severity: Warning --> oci_execute(): ORA-00936: missing expression /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 04:14:10 --> Query error: ORA-00936: missing expression - Invalid query: SELECT KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH, LISTAGG(KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL, ' ') WITHIN GROUP (ORDER BY KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL) AS KOD_MODUL, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS
            FROM KM_T07_PELAJAR_MODUL
            JOIN KR_T06_MODUL_KURSUS_BATCH ON KM_T07_PELAJAR_MODUL.ID_MODUL_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.ID_MODUL_KURSUS_BATCH
            JOIN KR_T04_KURSUS_BATCH ON KR_T04_KURSUS_BATCH.ID_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.T10_ID_KURSUS_BATCH
            JOIN KM_T01_PELAJAR_CORE ON KM_T01_PELAJAR_CORE.ID_PELAJAR = KM_T07_PELAJAR_MODUL.ID_PELAJAR
            JOIN KM_T08_PELAJAR_BATCH ON KM_T08_PELAJAR_BATCH.ID_PELAJAR = KM_T01_PELAJAR_CORE.ID_PELAJAR
            WHERE KM_T08_PELAJAR_BATCH.ID_BATCH = 
            GROUP BY KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS,KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH
ERROR - 2024-01-29 04:14:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:12 --> Severity: Warning --> oci_execute(): ORA-00936: missing expression /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 04:14:12 --> Query error: ORA-00936: missing expression - Invalid query: SELECT KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH, LISTAGG(KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL, ' ') WITHIN GROUP (ORDER BY KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL) AS KOD_MODUL, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS
            FROM KM_T07_PELAJAR_MODUL
            JOIN KR_T06_MODUL_KURSUS_BATCH ON KM_T07_PELAJAR_MODUL.ID_MODUL_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.ID_MODUL_KURSUS_BATCH
            JOIN KR_T04_KURSUS_BATCH ON KR_T04_KURSUS_BATCH.ID_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.T10_ID_KURSUS_BATCH
            JOIN KM_T01_PELAJAR_CORE ON KM_T01_PELAJAR_CORE.ID_PELAJAR = KM_T07_PELAJAR_MODUL.ID_PELAJAR
            JOIN KM_T08_PELAJAR_BATCH ON KM_T08_PELAJAR_BATCH.ID_PELAJAR = KM_T01_PELAJAR_CORE.ID_PELAJAR
            WHERE KM_T08_PELAJAR_BATCH.ID_BATCH = 
            GROUP BY KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS,KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH
ERROR - 2024-01-29 04:14:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:14:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:16:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:16:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:16:41 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:17:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:17:15 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:17:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:17:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:17:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:17:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:19:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:19:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:19:16 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:19:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:19:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:19:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:20:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:21:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:22:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:22:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:23:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:23:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:23:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:23:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:23:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:23:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:24:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:24:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:24:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:24:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:24:36 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:25:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:25:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:25:30 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:25:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:25:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:25:52 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/view_batch_admin
ERROR - 2024-01-29 04:26:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:26:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:26:02 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/view_batch_admin
ERROR - 2024-01-29 04:26:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:26:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:26:16 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/view_batch
ERROR - 2024-01-29 04:26:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:26:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:30:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:00 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:31:00 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:31:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:31:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:09 --> Severity: Warning --> oci_execute(): ORA-00936: missing expression /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 04:32:09 --> Query error: ORA-00936: missing expression - Invalid query: SELECT KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH, LISTAGG(KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL, ' ') WITHIN GROUP (ORDER BY KR_T06_MODUL_KURSUS_BATCH.KOD_MODUL) AS KOD_MODUL, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS
            FROM KM_T07_PELAJAR_MODUL
            JOIN KR_T06_MODUL_KURSUS_BATCH ON KM_T07_PELAJAR_MODUL.ID_MODUL_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.ID_MODUL_KURSUS_BATCH
            JOIN KR_T04_KURSUS_BATCH ON KR_T04_KURSUS_BATCH.ID_KURSUS_BATCH = KR_T06_MODUL_KURSUS_BATCH.T10_ID_KURSUS_BATCH
            JOIN KM_T01_PELAJAR_CORE ON KM_T01_PELAJAR_CORE.ID_PELAJAR = KM_T07_PELAJAR_MODUL.ID_PELAJAR
            JOIN KM_T08_PELAJAR_BATCH ON KM_T08_PELAJAR_BATCH.ID_PELAJAR = KM_T01_PELAJAR_CORE.ID_PELAJAR
            WHERE KM_T08_PELAJAR_BATCH.ID_BATCH = 
            GROUP BY KM_T01_PELAJAR_CORE.NAMA_PELAJAR, KR_T04_KURSUS_BATCH.KR_T04_NAMA_KURSUS,KM_T07_PELAJAR_MODUL.STATUS_SOKONG, KR_T04_KURSUS_BATCH.ID_BATCH
ERROR - 2024-01-29 04:32:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:32:34 --> 404 Page Not Found: ../modules/urus_daftar/controllers/Manage/views_batch_admin
ERROR - 2024-01-29 04:32:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:12 --> Severity: Warning --> Undefined property: CI::$addPermission /dev-portalv2/app_psh/application/third_party/MX/Controller.php 59
ERROR - 2024-01-29 04:33:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:33:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:20 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:34:20 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 04:34:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:34:35 --> Severity: error --> Exception: syntax error, unexpected double-quoted string "FLAG", expecting ")" /dev-portalv2/app_psh/application/modules/kursus/controllers/Bayar.php 125
ERROR - 2024-01-29 04:35:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:35:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:36:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:39:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:39:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:40:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:40:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:42:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:42:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:42:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:43:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:43:08 --> Severity: error --> Exception: Call to undefined method MY_Loader::views() /dev-portalv2/app_psh/application/modules/kursus/controllers/Mohon.php 406
ERROR - 2024-01-29 04:43:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:43:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:43:12 --> Severity: error --> Exception: Call to undefined method MY_Loader::views() /dev-portalv2/app_psh/application/modules/kursus/controllers/Mohon.php 406
ERROR - 2024-01-29 04:44:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:49:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 44
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 45
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 46
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 47
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 48
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 55
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 56
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 57
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 58
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Undefined array key "MATRIK" /dev-portalv2/app_psh/application/core/AdminPSH_Controller.php 59
ERROR - 2024-01-29 04:49:28 --> Severity: error --> Exception: Too few arguments to function User_control::__construct(), 0 passed in /dev-portalv2/mynemov3/system/core/Loader.php on line 1292 and exactly 1 expected /dev-portalv2/app_psh/application/libraries/User_control.php 9
ERROR - 2024-01-29 04:49:28 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /dev-portalv2/mynemov3/system/core/Exceptions.php:272) /dev-portalv2/mynemov3/system/core/Common.php 573
ERROR - 2024-01-29 05:44:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:44:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:13 --> 404 Page Not Found: ../modules/mc_login/controllers//index
ERROR - 2024-01-29 05:45:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:45:18 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 05:45:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:46:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:46:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:46:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:49:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 05:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:43:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:43:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:43:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:43:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:44:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:44:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:44:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:44:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:45:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:45:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:45:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:45:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:45:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:46:54 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 06:46:54 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 06:47:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:47:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:47:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:47:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:12 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 06:48:12 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 06:48:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:34 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 06:48:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "ALAMAT1_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 22
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "ALAMAT2_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 27
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "ALAMAT3_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 32
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "POSKOD_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 42
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "NEGERI_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 55
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 73
ERROR - 2024-01-29 06:48:39 --> Severity: Warning --> Attempt to read property "DAERAH_DUM" on bool /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/tambah_alamat2.php 74
ERROR - 2024-01-29 06:48:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:48:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:34 --> Severity: Warning --> Trying to access array offset on value of type bool /dev-portalv2/app_psh/application/modules/supplier/libraries/Auth.php 27
ERROR - 2024-01-29 06:52:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:52:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:53:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:56:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:56:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 06:56:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:00:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:00:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:08:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:08:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:08:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:08:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:08:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:08:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:23 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 07:09:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:09:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:29 --> Severity: Warning --> Undefined property: stdClass::$PG_T02_NAMA /dev-portalv2/app_psh/application/modules/mc_login/controllers/Auth.php 53
ERROR - 2024-01-29 07:10:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:31 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;T16_ID_MODUL_KURSUS_BATCH&quot;: invalid identifier /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 07:10:31 --> Query error: ORA-00904: "T16_ID_MODUL_KURSUS_BATCH": invalid identifier - Invalid query: INSERT INTO "KR_T01_TEMP" ("T16_ID_MODUL_KURSUS_BATCH") VALUES (NULL)
ERROR - 2024-01-29 07:10:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:50 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;T16_ID_MODUL_KURSUS_BATCH&quot;: invalid identifier /dev-portalv2/mynemov3/system/database/drivers/oci8/oci8_driver.php 286
ERROR - 2024-01-29 07:10:50 --> Query error: ORA-00904: "T16_ID_MODUL_KURSUS_BATCH": invalid identifier - Invalid query: INSERT INTO "KR_T01_TEMP" ("T16_ID_MODUL_KURSUS_BATCH") VALUES (NULL)
ERROR - 2024-01-29 07:10:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:10:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:11:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:11:16 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:11:16 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:11:16 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:11:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:11:49 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:11:49 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:11:49 --> Severity: error --> Exception: Too few arguments to function CI_URI::segment(), 0 passed in /dev-portalv2/app_psh/themes/psh_p/views/menu.php on line 269 and at least 1 expected /dev-portalv2/mynemov3/system/core/URI.php 344
ERROR - 2024-01-29 07:11:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:11:55 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:11:55 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:24 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:24 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:26 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:26 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:30 --> Severity: Warning --> Undefined variable $results /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:30 --> Severity: Warning --> foreach() argument must be of type array|object, null given /dev-portalv2/app_psh/application/modules/info_peserta/views/profil/pelajar_eborang.php 36
ERROR - 2024-01-29 07:12:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:47 --> Severity: Warning --> Trying to access array offset on value of type bool /dev-portalv2/app_psh/application/modules/supplier/libraries/Auth.php 27
ERROR - 2024-01-29 07:12:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:57 --> Severity: Warning --> Undefined property: CI::$addPermission /dev-portalv2/app_psh/application/third_party/MX/Controller.php 59
ERROR - 2024-01-29 07:12:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:12:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:13:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:13:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:13:37 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2024-01-29 07:13:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
