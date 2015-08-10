-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.5-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.2.0.4947
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for taxipos
CREATE DATABASE IF NOT EXISTS `taxipos` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `taxipos`;


-- Dumping structure for table taxipos.calendar
CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) NOT NULL,
  `unit_maintenance_id` int(11) NOT NULL,
  `allday` tinyint(1) NOT NULL DEFAULT '0',
  `date_from` date NOT NULL,
  `time_from` time DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `time_to` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `date_from` (`date_from`),
  KEY `time_from` (`time_from`),
  KEY `date_to` (`date_to`),
  KEY `time_to` (`time_to`),
  KEY `status` (`status`),
  KEY `unit_id` (`unit_id`),
  KEY `maintenance_id` (`unit_maintenance_id`),
  KEY `deleted_at` (`deleted_at`),
  KEY `updated_at` (`updated_at`),
  KEY `created_at` (`created_at`),
  KEY `allday` (`allday`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.calendar: ~1 rows (approximately)
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` (`id`, `unit_id`, `unit_maintenance_id`, `allday`, `date_from`, `time_from`, `date_to`, `time_to`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 1, '2015-08-11', NULL, NULL, NULL, 0, '2015-08-10 16:35:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;


-- Dumping structure for table taxipos.drivers
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `middle_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `nickname` varchar(20) DEFAULT NULL,
  `address` text,
  `birthday` date DEFAULT NULL,
  `sss` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1-duty, 2-off',
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`),
  KEY `first_name` (`first_name`),
  KEY `middle_name` (`middle_name`),
  KEY `last_name` (`last_name`),
  KEY `birthday` (`birthday`),
  KEY `photo` (`photo`),
  KEY `status` (`status`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`),
  FULLTEXT KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.drivers: ~1 rows (approximately)
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` (`id`, `unit_id`, `first_name`, `middle_name`, `last_name`, `nickname`, `address`, `birthday`, `sss`, `philhealth`, `pagibig`, `photo`, `status`, `created_at`, `deleted_at`) VALUES
	(1, 2, 'Jason', 'Again', 'Bourne', 'Jason AB', 'Quezon City', '1980-08-08', '324562342', '', '', NULL, 1, NULL, '2015-08-09 23:47:56');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;


-- Dumping structure for table taxipos.drivers_acct
CREATE TABLE IF NOT EXISTS `drivers_acct` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pos_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `in` decimal(6,2) DEFAULT NULL,
  `out` decimal(6,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pos_id` (`pos_id`),
  KEY `driver_id` (`driver_id`),
  KEY `created_at` (`created_at`),
  KEY `in` (`in`),
  KEY `out` (`out`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.drivers_acct: ~0 rows (approximately)
/*!40000 ALTER TABLE `drivers_acct` DISABLE KEYS */;
INSERT INTO `drivers_acct` (`id`, `pos_id`, `driver_id`, `in`, `out`, `created_at`) VALUES
	(1, 1, 1, 0.00, 550.00, '2015-07-26 14:35:47'),
	(2, 2, 1, 50.00, 0.00, '2015-08-03 17:49:32'),
	(3, 3, 1, 50.00, 0.00, '2015-08-08 11:41:44');
/*!40000 ALTER TABLE `drivers_acct` ENABLE KEYS */;


-- Dumping structure for table taxipos.garrage
CREATE TABLE IF NOT EXISTS `garrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `location` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.garrage: ~0 rows (approximately)
/*!40000 ALTER TABLE `garrage` DISABLE KEYS */;
/*!40000 ALTER TABLE `garrage` ENABLE KEYS */;


-- Dumping structure for table taxipos.maintenance
CREATE TABLE IF NOT EXISTS `maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `interval` tinyint(1) DEFAULT NULL COMMENT '1-odometer 2-monthly 3-weekly',
  `interval_value` int(6) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `is_scheduled` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `price` (`price`),
  KEY `interval` (`interval`),
  KEY `name` (`name`),
  KEY `created_at` (`created_at`),
  KEY `interval_value` (`interval_value`),
  KEY `is_scheduled` (`is_scheduled`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxipos.maintenance: ~3 rows (approximately)
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` (`id`, `name`, `interval`, `interval_value`, `price`, `is_scheduled`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'General Check Up', 1, 10000, 5000.00, 1, '2015-07-27 16:07:23', NULL, NULL),
	(2, 'Clean Air Filter', 1, 10000, 2000.00, 1, '2015-07-28 16:24:58', NULL, NULL),
	(3, 'Clean Spark Plugs', 1, 10000, 800.00, 1, '2015-07-28 16:25:34', NULL, NULL),
	(4, 'change oil', 1, 10000, 2500.00, 1, '2015-07-28 16:35:07', NULL, NULL);
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;


-- Dumping structure for table taxipos.maintenance_parts
CREATE TABLE IF NOT EXISTS `maintenance_parts` (
  `maintenance_id` int(11) DEFAULT NULL,
  `parts_id` int(11) DEFAULT NULL,
  `count` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `maintenance_id` (`maintenance_id`),
  KEY `parts_id` (`parts_id`),
  KEY `count` (`count`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxipos.maintenance_parts: ~4 rows (approximately)
/*!40000 ALTER TABLE `maintenance_parts` DISABLE KEYS */;
INSERT INTO `maintenance_parts` (`maintenance_id`, `parts_id`, `count`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, '2015-07-28 16:33:49', NULL, NULL),
	(1, 2, 2, '2015-07-28 16:33:49', NULL, NULL),
	(1, 3, 3, '2015-07-28 16:33:49', NULL, NULL),
	(4, 1, 1, '2015-07-28 16:35:07', NULL, NULL);
/*!40000 ALTER TABLE `maintenance_parts` ENABLE KEYS */;


-- Dumping structure for table taxipos.parts
CREATE TABLE IF NOT EXISTS `parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `supplier` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `stock` int(4) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `purchase_date` (`purchase_date`),
  KEY `price` (`price`),
  KEY `stock` (`stock`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `supplier` (`supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.parts: ~3 rows (approximately)
/*!40000 ALTER TABLE `parts` DISABLE KEYS */;
INSERT INTO `parts` (`id`, `name`, `purchase_date`, `supplier`, `price`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'oil', '2015-07-25', 'test', 2000.00, 5, '2015-07-25 16:53:11', '0000-00-00 00:00:00', NULL),
	(2, 'side mirror', '2015-07-28', 'mirroring', 500.00, 5, '2015-07-28 13:27:48', '0000-00-00 00:00:00', NULL),
	(3, 'hose', '2015-07-23', 'hosess', 150.00, 10, '2015-07-28 13:28:14', '0000-00-00 00:00:00', NULL),
	(4, 'spark plug', '2015-07-28', 'sparky', 200.00, 10, '2015-07-28 16:25:56', '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `parts` ENABLE KEYS */;


-- Dumping structure for table taxipos.parts_logs
CREATE TABLE IF NOT EXISTS `parts_logs` (
  `parts_id` int(11) DEFAULT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `maintenance_id` (`maintenance_id`),
  KEY `parts_id` (`parts_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.parts_logs: ~0 rows (approximately)
/*!40000 ALTER TABLE `parts_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `parts_logs` ENABLE KEYS */;


-- Dumping structure for table taxipos.pos
CREATE TABLE IF NOT EXISTS `pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(15) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `rate_type` tinyint(1) DEFAULT '1' COMMENT '1-reg, 2-coding, 3-sunday, 4-holiday',
  `amount` decimal(6,2) DEFAULT NULL,
  `short` decimal(6,2) DEFAULT NULL,
  `remarks` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`),
  KEY `driver_id` (`driver_id`),
  KEY `created_at` (`created_at`),
  KEY `created_by` (`created_by`),
  KEY `updated_at` (`updated_at`),
  KEY `updated_by` (`updated_by`),
  KEY `rate_type` (`rate_type`),
  FULLTEXT KEY `reference` (`reference`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.pos: ~0 rows (approximately)
/*!40000 ALTER TABLE `pos` DISABLE KEYS */;
INSERT INTO `pos` (`id`, `reference`, `unit_id`, `driver_id`, `rate_type`, `amount`, `short`, `remarks`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
	(1, NULL, 1, 1, 3, 1000.00, 550.00, 'natulog lang', '2015-07-26 14:35:47', 1, '0000-00-00 00:00:00', NULL),
	(2, NULL, 1, 1, 2, 1500.00, NULL, 'test', '2015-08-03 17:49:32', 1, '0000-00-00 00:00:00', NULL),
	(3, NULL, 1, 1, 1, 1500.00, NULL, '', '2015-08-08 11:43:03', 1, '0000-00-00 00:00:00', NULL);
/*!40000 ALTER TABLE `pos` ENABLE KEYS */;


-- Dumping structure for table taxipos.units
CREATE TABLE IF NOT EXISTS `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garrage_id` int(11) DEFAULT NULL,
  `plate_number` varchar(8) CHARACTER SET latin1 DEFAULT NULL,
  `year_model` int(4) DEFAULT NULL,
  `reg_rate` decimal(6,2) DEFAULT NULL,
  `coding_rate` decimal(6,2) DEFAULT NULL,
  `holiday_rate` decimal(6,2) DEFAULT NULL,
  `sunday_rate` decimal(6,2) DEFAULT NULL,
  `coding_day` tinyint(1) DEFAULT NULL,
  `resealing_date1` date DEFAULT NULL,
  `resealing_date2` date DEFAULT NULL,
  `franchise_until` date DEFAULT NULL,
  `renew_by` date DEFAULT NULL,
  `overhead_fund` decimal(6,2) DEFAULT NULL,
  `docs_fund` decimal(6,2) DEFAULT NULL,
  `replacement_fund` decimal(6,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '2' COMMENT '1-duty, 2-garrage, 3-maintenance, 4-replaced',
  `odometer` int(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `garrage_id` (`garrage_id`),
  KEY `plate_number` (`plate_number`),
  KEY `year_model` (`year_model`),
  KEY `reg_rate` (`reg_rate`),
  KEY `coding_rate` (`coding_rate`),
  KEY `sunday_rate` (`sunday_rate`),
  KEY `holiday_rate` (`holiday_rate`),
  KEY `resealing_date1` (`resealing_date1`),
  KEY `resealing_date2` (`resealing_date2`),
  KEY `franchise_until` (`franchise_until`),
  KEY `renew_by` (`renew_by`),
  KEY `status` (`status`),
  KEY `odometer` (`odometer`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.units: ~5 rows (approximately)
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` (`id`, `garrage_id`, `plate_number`, `year_model`, `reg_rate`, `coding_rate`, `holiday_rate`, `sunday_rate`, `coding_day`, `resealing_date1`, `resealing_date2`, `franchise_until`, `renew_by`, `overhead_fund`, `docs_fund`, `replacement_fund`, `status`, `odometer`, `created_at`) VALUES
	(1, NULL, 'AAA 123', 2014, 1500.00, 800.00, 1000.00, 1000.00, 1, '2015-08-17', '2015-09-28', '2020-11-25', '2017-07-26', 2000.00, 800.00, 5000.00, 3, 12000, '2015-08-10 05:11:44'),
	(2, NULL, 'ABC 321', 2014, 1550.00, 800.00, 1000.00, 1000.00, 1, '2015-08-29', '2015-08-28', '2015-09-01', '2015-08-26', 2000.00, 200.00, 5000.00, 1, 10000, '2015-08-10 05:11:01'),
	(3, NULL, 'EFG 456', 2015, 1550.00, 800.00, 900.00, 1000.00, 1, '2015-08-02', '2015-08-04', '2015-08-19', '2015-08-19', 2000.00, 240.00, 2500.00, 2, NULL, '2015-08-01 23:13:32'),
	(4, NULL, 'ZAF 1234', 2015, 1600.00, 800.00, 900.00, 1000.00, 1, '2015-08-27', '2015-09-05', '2015-09-04', '2015-09-05', 2000.00, 200.00, 2400.00, 2, NULL, '2015-08-02 00:24:49'),
	(5, NULL, 'AMJ 234', 2012, 1550.00, 700.00, 700.00, 1000.00, 1, '2015-08-21', '2015-08-28', '2015-09-11', '2015-08-08', 1500.00, 100.00, 1500.00, 2, NULL, '2015-08-02 00:27:15');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;


-- Dumping structure for table taxipos.units_logs
CREATE TABLE IF NOT EXISTS `units_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1' COMMENT '1-duty, 2-garrage, 3-maintenance, 4-replaced',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `unit_id` (`unit_id`),
  KEY `driver_id` (`driver_id`),
  KEY `created_at` (`created_at`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.units_logs: ~0 rows (approximately)
/*!40000 ALTER TABLE `units_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `units_logs` ENABLE KEYS */;


-- Dumping structure for table taxipos.units_maintenance
CREATE TABLE IF NOT EXISTS `units_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) DEFAULT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `odometer` int(6) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `prefered_date` date DEFAULT NULL,
  `prefered_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_id` (`maintenance_id`),
  KEY `unit_id` (`unit_id`),
  KEY `created_at` (`created_at`),
  KEY `updated_at` (`updated_at`),
  KEY `deleted_at` (`deleted_at`),
  KEY `odometer` (`odometer`),
  KEY `status` (`status`),
  KEY `prefered_date` (`prefered_date`),
  KEY `prefered_time` (`prefered_time`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table taxipos.units_maintenance: ~1 rows (approximately)
/*!40000 ALTER TABLE `units_maintenance` DISABLE KEYS */;
INSERT INTO `units_maintenance` (`id`, `unit_id`, `maintenance_id`, `odometer`, `notes`, `status`, `prefered_date`, `prefered_time`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
	(1, 1, 1, 12000, 'test', 0, NULL, NULL, '2015-08-10 16:35:25', 1, '2015-08-10 10:35:25', 1, NULL, NULL);
/*!40000 ALTER TABLE `units_maintenance` ENABLE KEYS */;


-- Dumping structure for table taxipos.units_maintenance_logs
CREATE TABLE IF NOT EXISTS `units_maintenance_logs` (
  `unit_maintenance_id` int(11) DEFAULT NULL,
  `odometer` int(11) DEFAULT NULL,
  `remarks` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  KEY `unit_maintenance_id` (`unit_maintenance_id`),
  KEY `created_at` (`created_at`),
  KEY `created_by` (`created_by`),
  KEY `odometer` (`odometer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.units_maintenance_logs: ~0 rows (approximately)
/*!40000 ALTER TABLE `units_maintenance_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `units_maintenance_logs` ENABLE KEYS */;


-- Dumping structure for table taxipos.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garrage_id` int(11) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `pword` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `lvl` int(1) DEFAULT '0' COMMENT '0 - normal, 1 - admin',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `garrage_id` (`garrage_id`),
  KEY `username` (`username`),
  KEY `pword` (`pword`),
  KEY `first_name` (`first_name`),
  KEY `last_name` (`last_name`),
  KEY `photo` (`photo`),
  KEY `lvl` (`lvl`),
  KEY `created_at` (`created_at`),
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table taxipos.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `garrage_id`, `username`, `pword`, `first_name`, `last_name`, `photo`, `lvl`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'admin', 'e6e061838856bf47e1de730719fb2609', 'Gerald', 'Arcega', NULL, 1, '2015-07-19 09:02:51', NULL, NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
