<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-05-07 01:45:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:45:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:45:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:45:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:45:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:45:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:45:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:45:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:45:18 --> 404 Page Not Found: ../modules/ipss/controllers/Alert/stockAlert
ERROR - 2025-05-07 01:45:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:45:48 --> 404 Page Not Found: ../modules/ipss/controllers/Alert/stockAlert
ERROR - 2025-05-07 01:47:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:47:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:47:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:47:57 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:47:57 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:47:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:47:57 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:47:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 12:47:59 --> Severity: Warning --> oci_execute(): ORA-00928: missing SELECT keyword /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 12:47:59 --> Query error: ORA-00928: missing SELECT keyword - Invalid query: 
            WITH drug_stocks AS (
                SELECT 
                    d.T01_DRUG_ID,
                    d.T01_DRUGS,
                    d.T01_TRADE_NAME, 
                    d.T01_MIN_STOCK,
                    NVL(SUM(b.T02_TOTAL_UNITS), 0) AS CURRENT_STOCK
                FROM 
                    IPSS_T01_DRUG d
                LEFT JOIN 
                    IPSS_T02_DBATCH b ON d.T01_DRUG_ID = b.T02_DRUG_ID
                GROUP BY 
                    d.T01_DRUG_ID, d.T01_DRUGS, d.T01_TRADE_NAME, d.T01_MIN_STOCK
            )
            
            -- Update existing alerts where status changed from WARNING to CRITICAL
            MERGE INTO IPSS_T06_STOCK_ALERTS a
            USING (
                SELECT 
                    ds.T01_DRUG_ID,
                    CASE
                        WHEN ds.CURRENT_STOCK < ds.T01_MIN_STOCK THEN 'CRITICAL'
                        WHEN ds.CURRENT_STOCK BETWEEN ds.T01_MIN_STOCK AND (ds.T01_MIN_STOCK + 100) THEN 'WARNING'
                    END AS NEW_ALERT_TYPE,
                    ds.CURRENT_STOCK,
                    ds.T01_MIN_STOCK
                FROM 
                    drug_stocks ds
                WHERE 
                    ds.CURRENT_STOCK < ds.T01_MIN_STOCK OR 
                    (ds.CURRENT_STOCK BETWEEN ds.T01_MIN_STOCK AND (ds.T01_MIN_STOCK + 100))
            ) src
            ON (a.T06_DRUG_ID = src.T01_DRUG_ID)
            WHEN MATCHED THEN
                UPDATE SET 
                    a.T06_ALERT_TYPE = src.NEW_ALERT_TYPE,
                    a.T06_CURRENT_STOCK = src.CURRENT_STOCK,
                    a.T06_ALERT_DATE = SYSDATE
                WHERE a.T06_ALERT_TYPE != src.NEW_ALERT_TYPE OR a.T06_CURRENT_STOCK != src.CURRENT_STOCK
            WHEN NOT MATCHED THEN
                INSERT (T06_DRUG_ID, T06_ALERT_TYPE, T06_CURRENT_STOCK, T06_MIN_STOCK, T06_ALERT_DATE)
                VALUES (src.T01_DRUG_ID, src.NEW_ALERT_TYPE, src.CURRENT_STOCK, src.T01_MIN_STOCK, SYSDATE)
        
ERROR - 2025-05-07 01:48:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 12:48:14 --> Severity: Warning --> oci_execute(): ORA-00928: missing SELECT keyword /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 12:48:14 --> Query error: ORA-00928: missing SELECT keyword - Invalid query: 
            WITH batch_expiry AS (
                SELECT 
                    b.T02_BATCH_ID,
                    b.T02_DRUG_ID,
                    b.T02_EXP_DATE,
                    b.T02_TOTAL_UNITS,
                    CASE
                        WHEN b.T02_EXP_DATE <= SYSDATE THEN 'EXPIRED'
                        WHEN b.T02_EXP_DATE <= SYSDATE + INTERVAL '3' MONTH THEN '3_MONTHS'
                        WHEN b.T02_EXP_DATE <= SYSDATE + INTERVAL '6' MONTH THEN '6_MONTHS'
                        WHEN b.T02_EXP_DATE <= SYSDATE + INTERVAL '9' MONTH THEN '9_MONTHS'
                        ELSE NULL
                    END AS EXPIRY_STATUS
                FROM 
                    IPSS_T02_DBATCH b
                WHERE 
                    b.T02_TOTAL_UNITS > 0
            )
            
            -- Update existing alerts or create new ones
            MERGE INTO IPSS_T07_EXPIRY_ALERTS a
            USING (
                SELECT 
                    be.T02_BATCH_ID,
                    be.T02_DRUG_ID,
                    be.EXPIRY_STATUS,
                    be.T02_EXP_DATE,
                    be.T02_TOTAL_UNITS
                FROM 
                    batch_expiry be
                WHERE 
                    be.EXPIRY_STATUS IS NOT NULL
            ) src
            ON (a.T07_BATCH_ID = src.T02_BATCH_ID)
            WHEN MATCHED THEN
                UPDATE SET 
                    a.T07_EXPIRY_STATUS = src.EXPIRY_STATUS,
                    a.T07_REMAINING_UNITS = src.T02_TOTAL_UNITS,
                    a.T07_ALERT_DATE = SYSDATE
                WHERE 
                    a.T07_EXPIRY_STATUS != src.EXPIRY_STATUS OR 
                    a.T07_REMAINING_UNITS != src.T02_TOTAL_UNITS
            WHEN NOT MATCHED THEN
                INSERT (T07_BATCH_ID, T07_DRUG_ID, T07_EXPIRY_STATUS, T07_EXP_DATE, T07_REMAINING_UNITS, T07_ALERT_DATE)
                VALUES (src.T02_BATCH_ID, src.T02_DRUG_ID, src.EXPIRY_STATUS, src.T02_EXP_DATE, src.T02_TOTAL_UNITS, SYSDATE)
        
ERROR - 2025-05-07 01:48:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 12:48:47 --> Severity: Warning --> oci_execute(): ORA-00928: missing SELECT keyword /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 12:48:47 --> Query error: ORA-00928: missing SELECT keyword - Invalid query: 
            WITH drug_stocks AS (
                SELECT 
                    d.T01_DRUG_ID,
                    d.T01_DRUGS,
                    d.T01_TRADE_NAME, 
                    d.T01_MIN_STOCK,
                    NVL(SUM(b.T02_TOTAL_UNITS), 0) AS CURRENT_STOCK
                FROM 
                    IPSS_T01_DRUG d
                LEFT JOIN 
                    IPSS_T02_DBATCH b ON d.T01_DRUG_ID = b.T02_DRUG_ID
                GROUP BY 
                    d.T01_DRUG_ID, d.T01_DRUGS, d.T01_TRADE_NAME, d.T01_MIN_STOCK
            )
            
            -- Update existing alerts where status changed from WARNING to CRITICAL
            MERGE INTO IPSS_T06_STOCK_ALERTS a
            USING (
                SELECT 
                    ds.T01_DRUG_ID,
                    CASE
                        WHEN ds.CURRENT_STOCK < ds.T01_MIN_STOCK THEN 'CRITICAL'
                        WHEN ds.CURRENT_STOCK BETWEEN ds.T01_MIN_STOCK AND (ds.T01_MIN_STOCK + 100) THEN 'WARNING'
                    END AS NEW_ALERT_TYPE,
                    ds.CURRENT_STOCK,
                    ds.T01_MIN_STOCK
                FROM 
                    drug_stocks ds
                WHERE 
                    ds.CURRENT_STOCK < ds.T01_MIN_STOCK OR 
                    (ds.CURRENT_STOCK BETWEEN ds.T01_MIN_STOCK AND (ds.T01_MIN_STOCK + 100))
            ) src
            ON (a.T06_DRUG_ID = src.T01_DRUG_ID)
            WHEN MATCHED THEN
                UPDATE SET 
                    a.T06_ALERT_TYPE = src.NEW_ALERT_TYPE,
                    a.T06_CURRENT_STOCK = src.CURRENT_STOCK,
                    a.T06_ALERT_DATE = SYSDATE
                WHERE a.T06_ALERT_TYPE != src.NEW_ALERT_TYPE OR a.T06_CURRENT_STOCK != src.CURRENT_STOCK
            WHEN NOT MATCHED THEN
                INSERT (T06_DRUG_ID, T06_ALERT_TYPE, T06_CURRENT_STOCK, T06_MIN_STOCK, T06_ALERT_DATE)
                VALUES (src.T01_DRUG_ID, src.NEW_ALERT_TYPE, src.CURRENT_STOCK, src.T01_MIN_STOCK, SYSDATE)
        
ERROR - 2025-05-07 01:49:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 12:49:00 --> Severity: Warning --> oci_execute(): ORA-00928: missing SELECT keyword /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 12:49:00 --> Query error: ORA-00928: missing SELECT keyword - Invalid query: 
            WITH batch_expiry AS (
                SELECT 
                    b.T02_BATCH_ID,
                    b.T02_DRUG_ID,
                    b.T02_EXP_DATE,
                    b.T02_TOTAL_UNITS,
                    CASE
                        WHEN b.T02_EXP_DATE <= SYSDATE THEN 'EXPIRED'
                        WHEN b.T02_EXP_DATE <= SYSDATE + INTERVAL '3' MONTH THEN '3_MONTHS'
                        WHEN b.T02_EXP_DATE <= SYSDATE + INTERVAL '6' MONTH THEN '6_MONTHS'
                        WHEN b.T02_EXP_DATE <= SYSDATE + INTERVAL '9' MONTH THEN '9_MONTHS'
                        ELSE NULL
                    END AS EXPIRY_STATUS
                FROM 
                    IPSS_T02_DBATCH b
                WHERE 
                    b.T02_TOTAL_UNITS > 0
            )
            
            -- Update existing alerts or create new ones
            MERGE INTO IPSS_T07_EXPIRY_ALERTS a
            USING (
                SELECT 
                    be.T02_BATCH_ID,
                    be.T02_DRUG_ID,
                    be.EXPIRY_STATUS,
                    be.T02_EXP_DATE,
                    be.T02_TOTAL_UNITS
                FROM 
                    batch_expiry be
                WHERE 
                    be.EXPIRY_STATUS IS NOT NULL
            ) src
            ON (a.T07_BATCH_ID = src.T02_BATCH_ID)
            WHEN MATCHED THEN
                UPDATE SET 
                    a.T07_EXPIRY_STATUS = src.EXPIRY_STATUS,
                    a.T07_REMAINING_UNITS = src.T02_TOTAL_UNITS,
                    a.T07_ALERT_DATE = SYSDATE
                WHERE 
                    a.T07_EXPIRY_STATUS != src.EXPIRY_STATUS OR 
                    a.T07_REMAINING_UNITS != src.T02_TOTAL_UNITS
            WHEN NOT MATCHED THEN
                INSERT (T07_BATCH_ID, T07_DRUG_ID, T07_EXPIRY_STATUS, T07_EXP_DATE, T07_REMAINING_UNITS, T07_ALERT_DATE)
                VALUES (src.T02_BATCH_ID, src.T02_DRUG_ID, src.EXPIRY_STATUS, src.T02_EXP_DATE, src.T02_TOTAL_UNITS, SYSDATE)
        
ERROR - 2025-05-07 01:51:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:51:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:51:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:51:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:51:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:51:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:51:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 01:51:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:58:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 01:59:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 12:59:50 --> Severity: Warning --> Undefined property: CI::$Alert_model /var/www/html/public/application/third_party/MX/Controller.php 60
ERROR - 2025-05-07 12:59:50 --> Severity: error --> Exception: Call to a member function update_stock_alerts() on null /var/www/html/public/application/modules/ipss/controllers/Alert.php 17
ERROR - 2025-05-07 02:00:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:02:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 13:02:34 --> Severity: error --> Exception: Call to undefined method Template::set_view() /var/www/html/public/application/modules/ipss/controllers/Alert.php 24
ERROR - 2025-05-07 02:08:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:34 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:35 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:35 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:35 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:38 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:38 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:38 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:08:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:08:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:13:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:13:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:13:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:13:14 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:13:14 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:13:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:13:14 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:29:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:29:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:29:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:29:54 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:29:54 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:29:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:29:54 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:30:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:30:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:30:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:30:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:30:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:30:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:30:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:34:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 13:34:47 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 38
ERROR - 2025-05-07 13:34:47 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 38
ERROR - 2025-05-07 13:34:47 --> Severity: Warning --> Undefined property: stdClass::$trade_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 39
ERROR - 2025-05-07 13:34:47 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 39
ERROR - 2025-05-07 13:34:47 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 38
ERROR - 2025-05-07 13:34:47 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 38
ERROR - 2025-05-07 13:34:47 --> Severity: Warning --> Undefined property: stdClass::$trade_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 39
ERROR - 2025-05-07 13:34:47 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 39
ERROR - 2025-05-07 02:34:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:34:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:34:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:34:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:34:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:34:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:34:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 13:34:56 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 63
ERROR - 2025-05-07 13:34:56 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 63
ERROR - 2025-05-07 13:34:56 --> Severity: Warning --> Undefined property: stdClass::$trade_name /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 64
ERROR - 2025-05-07 13:34:56 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 64
ERROR - 2025-05-07 13:34:56 --> Severity: Warning --> Undefined property: stdClass::$barcode /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 65
ERROR - 2025-05-07 13:34:56 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 65
ERROR - 2025-05-07 13:34:56 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 63
ERROR - 2025-05-07 13:34:56 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 63
ERROR - 2025-05-07 13:34:56 --> Severity: Warning --> Undefined property: stdClass::$trade_name /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 64
ERROR - 2025-05-07 13:34:56 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 64
ERROR - 2025-05-07 13:34:56 --> Severity: Warning --> Undefined property: stdClass::$barcode /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 65
ERROR - 2025-05-07 13:34:56 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/expiryAlert.php 65
ERROR - 2025-05-07 02:34:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:34:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:34:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:34:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:34:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:34:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:48:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:48:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:48:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:48:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:48:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:48:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:48:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:48 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:48 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:48 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:49:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:49:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:38 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:39 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:39 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:39 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:39 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:45 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:45 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:45 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:50:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:50:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:14 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:51:14 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:51:14 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:14 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:51:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:24 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:51:24 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:51:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:51:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:52:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:52:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:52:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:52:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:52:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:52:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:52:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:54:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:54:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:54:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:54:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:54:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 02:54:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 02:54:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 03:18:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 03:18:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 03:18:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 03:18:45 --> 404 Page Not Found: /index
ERROR - 2025-05-07 03:18:45 --> 404 Page Not Found: /index
ERROR - 2025-05-07 03:18:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 03:18:45 --> 404 Page Not Found: /index
ERROR - 2025-05-07 03:18:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 14:18:47 --> Severity: Warning --> Undefined property: stdClass::$current_stock /var/www/html/public/application/modules/ipss/models/Alert_model.php 20
ERROR - 2025-05-07 14:18:47 --> Severity: Warning --> Undefined property: stdClass::$current_stock /var/www/html/public/application/modules/ipss/models/Alert_model.php 22
ERROR - 2025-05-07 14:18:47 --> Severity: Warning --> Undefined property: stdClass::$current_stock /var/www/html/public/application/modules/ipss/models/Alert_model.php 35
ERROR - 2025-05-07 14:18:47 --> Severity: Warning --> oci_execute(): ORA-01861: literal does not match format string /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 14:18:47 --> Query error: ORA-01861: literal does not match format string - Invalid query: INSERT INTO "IPSS_T06_STOCK_ALERTS" ("T06_DRUG_ID", "T06_ALERT_TYPE", "T06_CURRENT_STOCK", "T06_MIN_STOCK", "T06_ALERT_DATE") VALUES ('141', 'CRITICAL', NULL, '200', '2025-05-07 14:18:47')
ERROR - 2025-05-07 06:07:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:07:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:07:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:07:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:07:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:07:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:07:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:07:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:07:48 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;B&quot;.&quot;T02_EXP_DATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:07:48 --> Query error: ORA-00904: "B"."T02_EXP_DATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID"
WHERE b.T02_TOTAL_UNITS > 0 AND b.T02_EXP_DATE > SYSDATE
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:07:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:07:57 --> Severity: Warning --> oci_execute(): ORA-01861: literal does not match format string /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:07:57 --> Query error: ORA-01861: literal does not match format string - Invalid query: INSERT INTO "IPSS_T07_EXPIRY_ALERTS" ("T07_BATCH_ID", "T07_DRUG_ID", "T07_EXPIRY_STATUS", "T07_EXP_DATE", "T07_REMAINING_UNITS", "T07_ALERT_DATE") VALUES ('3', '101', '3_MONTHS', '2025-05-31', '70', '2025-05-07 17:07:57')
ERROR - 2025-05-07 06:08:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:08:25 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;B&quot;.&quot;T02_EXP_DATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:08:25 --> Query error: ORA-00904: "B"."T02_EXP_DATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID"
WHERE b.T02_TOTAL_UNITS > 0 AND b.T02_EXP_DATE > SYSDATE
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:08:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:08:28 --> Severity: Warning --> oci_execute(): ORA-01861: literal does not match format string /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:08:28 --> Query error: ORA-01861: literal does not match format string - Invalid query: INSERT INTO "IPSS_T07_EXPIRY_ALERTS" ("T07_BATCH_ID", "T07_DRUG_ID", "T07_EXPIRY_STATUS", "T07_EXP_DATE", "T07_REMAINING_UNITS", "T07_ALERT_DATE") VALUES ('3', '101', '3_MONTHS', '2025-05-31', '70', '2025-05-07 17:08:28')
ERROR - 2025-05-07 06:12:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:12:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:12:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:12:43 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:12:43 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:12:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:12:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:12:45 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:12:45 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:12:45 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID"
WHERE "b"."T02_TOTAL_UNITS" >0
AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:12:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:12:52 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;A&quot;.&quot;T07_EXPIRY_STATUS&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:12:52 --> Query error: ORA-00904: "A"."T07_EXPIRY_STATUS": invalid identifier - Invalid query: SELECT "a".*, "d"."T01_DRUGS" as "drug_name"
FROM "IPSS_T07_EXPIRY_ALERTS" "a"
JOIN "IPSS_T01_DRUG" "d" ON "d"."T01_DRUG_ID" = "a"."T07_DRUG_ID"
ORDER BY CASE a.T07_EXPIRY_STATUS 
                            WHEN 'EXPIRED' THEN 1 
                            WHEN '3_MONTHS' THEN 2 
                            WHEN '6_MONTHS' THEN 3 
                            WHEN '9_MONTHS' THEN 4 
                            END ASC, "a"."T07_REMAINING_UNITS" ASC
ERROR - 2025-05-07 06:13:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:13:00 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:13:00 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID"
WHERE "b"."T02_TOTAL_UNITS" >0
AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:13:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:13:54 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;A&quot;.&quot;T07_EXPIRY_STATUS&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:13:54 --> Query error: ORA-00904: "A"."T07_EXPIRY_STATUS": invalid identifier - Invalid query: SELECT "a".*, "d"."T01_DRUGS" as "drug_name"
FROM "IPSS_T07_EXPIRY_ALERTS" "a"
JOIN "IPSS_T01_DRUG" "d" ON "d"."T01_DRUG_ID" = "a"."T07_DRUG_ID"
ORDER BY CASE a.T07_EXPIRY_STATUS 
                            WHEN 'EXPIRED' THEN 1 
                            WHEN '3_MONTHS' THEN 2 
                            WHEN '6_MONTHS' THEN 3 
                            WHEN '9_MONTHS' THEN 4 
                            END ASC, "a"."T07_REMAINING_UNITS" ASC
ERROR - 2025-05-07 06:16:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:16:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:16:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:16:27 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:16:27 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:16:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:16:27 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:16:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:16:28 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;B&quot;.&quot;T02_EXP_DATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:16:28 --> Query error: ORA-00904: "B"."T02_EXP_DATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID"
WHERE "b"."T02_TOTAL_UNITS" >0
AND b.T02_EXP_DATE > SYSDATE
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:22:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:22:51 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:22:51 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:24:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:24:20 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:24:20 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:24:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:24:21 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:24:21 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:24:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:24:21 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:24:21 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:24:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:24:22 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:24:22 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:24:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:24:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:24:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:24:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:24:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:24:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:24:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:24:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:24:26 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:24:26 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:25:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:25:10 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;B&quot;.&quot;T02_TOTAL_UNITS&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:25:10 --> Query error: ORA-00904: "B"."T02_TOTAL_UNITS": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > 'SYSDATE'
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:26:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:26:13 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;SYSDATE&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:26:13 --> Query error: ORA-00904: "SYSDATE": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID" AND "b"."T02_TOTAL_UNITS" > 0 AND "b"."T02_EXP_DATE" > "SYSDATE"
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:27:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:27:20 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;D&quot;.&quot;T01_DRUG_ID&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:27:20 --> Query error: ORA-00904: "D"."T01_DRUG_ID": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN IPSS_T02_DBATCH b ON b.T02_DRUG_ID = d.T01_DRUG_ID AND b.T02_TOTAL_UNITS > 0 AND b.T02_EXP_DATE > SYSDATE
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:28:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:28:49 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;B&quot;.&quot;T02_TOTAL_UNITS&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:28:49 --> Query error: ORA-00904: "B"."T02_TOTAL_UNITS": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", COALESCE(SUM(b.T02_TOTAL_UNITS), 0) as CURRENT_STOCK
FROM "IPSS_T01_DRUG" "d"
LEFT JOIN "IPSS_T02_DBATCH" "b" ON "b"."T02_DRUG_ID" = "d"."T01_DRUG_ID"
WHERE (b.T02_TOTAL_UNITS > 0 AND b.T02_EXP_DATE > SYSDATE) OR b.T02_TOTAL_UNITS IS NULL
GROUP BY "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK"
ERROR - 2025-05-07 06:29:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:29:48 --> Severity: Warning --> oci_execute(): ORA-00904: &quot;D&quot;.&quot;T01_DRUG_ID&quot;: invalid identifier /core-ci/ci3/system/database/drivers/oci8/oci8_driver.php 287
ERROR - 2025-05-07 17:29:48 --> Query error: ORA-00904: "D"."T01_DRUG_ID": invalid identifier - Invalid query: SELECT "d"."T01_DRUG_ID", "d"."T01_MIN_STOCK", 0 as "CURRENT_STOCK"
FROM "IPSS_T01_DRUG" "d"
WHERE NOT EXISTS (SELECT 1 FROM IPSS_T02_DBATCH b WHERE b.T02_DRUG_ID = d.T01_DRUG_ID AND b.T02_TOTAL_UNITS > 0 AND b.T02_EXP_DATE > SYSDATE)
ERROR - 2025-05-07 06:40:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:40:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:40:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:40:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:40:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:41:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:41:00 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:41:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 17:41:01 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: Warning --> Undefined property: stdClass::$drug_name /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 17:41:01 --> Severity: 8192 --> htmlspecialchars(): Passing null to parameter #1 ($string) of type string is deprecated /var/www/html/public/application/modules/ipss/views/alert/stockAlert.php 52
ERROR - 2025-05-07 06:41:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:41:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:41:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:41:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 06:41:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 06:41:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:18 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:18 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:18 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:26 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:26 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:26 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:28 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:28 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:04:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:04:29 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:43 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:43 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:43 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:43 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:05:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:05:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:06:57 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:06:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:06:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:06:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:06:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:06:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:06:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:09:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:09:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:09:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:09:09 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:09:09 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:09:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:09:09 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:09:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:09:10 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:09:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:09:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:10:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:10:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:10:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:48 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:10:48 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:10:48 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:10:48 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:04 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:04 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:04 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:15 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:15 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:21:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:21:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:26 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:26 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:26 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:26 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:40 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:40 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:40 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:41 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:41 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:46 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:46 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:46 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:23:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:23:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:24:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:20 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:24:20 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:24:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:20 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:24:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:23 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:24:23 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:24:23 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:24:23 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:34:24 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:34:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:34:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:34:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:42 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:34:42 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:34:42 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:34:42 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:06 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:06 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:06 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:22 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:22 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:22 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:22 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:33 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:33 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:36 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:36 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:36 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:36 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:46 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:46 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:46 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:53 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:54 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:54 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:54 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:54 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:36:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:36:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:37:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:00 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:37:00 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:37:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:00 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:37:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:37:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:37:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:37:12 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:07 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:07 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:07 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:08 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:08 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:09 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:09 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:13 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:19 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:21 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:21 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:38:21 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:38:21 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:41:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:41:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:41:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:41:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:41:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:41:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:41:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:42:00 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:42:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:42:01 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:01 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:42:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:08 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:42:08 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:42:08 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:42:08 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:50:10 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:50:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:50:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:50:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:50:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:50:11 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:50:11 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:29 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:29 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:29 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:29 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:30 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:30 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:30 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:32 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:32 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:32 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:44 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:44 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:51 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:51 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:52 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:52 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:52:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:52:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:02 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:02 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:02 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:27 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:28 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:28 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:28 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:28 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:53:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:53:58 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:02 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:02 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:02 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:03 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:03 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:04 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:04 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:04 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:04 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:50 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:50 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:55 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:56 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:56 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:58 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:54:59 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:54:59 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:05 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:05 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:05 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:05 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:06 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:07 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:07 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:07 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:07 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:12 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:17 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:17 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:17 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:18 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:18 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:19 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:20 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:20 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:20 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:20 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:25 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:25 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:30 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:31 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:31 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:31 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:35 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:35 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:35 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:35 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:46 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:47 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:47 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:49 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:49 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:55:49 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:55:49 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:58:31 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:58:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:58:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:58:32 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:58:32 --> 404 Page Not Found: /index
ERROR - 2025-05-07 07:58:32 --> Could not find the specified $config['composer_autoload'] path: vendor/autoload.php
ERROR - 2025-05-07 07:58:32 --> 404 Page Not Found: /index
