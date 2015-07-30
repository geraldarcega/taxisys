/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.5-MariaDB : Database - taxipos
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `drivers` */

DROP TABLE IF EXISTS `drivers`;

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `middle_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
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
  KEY `deleted_at` (`deleted_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `drivers` */

insert  into `drivers`(`id`,`unit_id`,`first_name`,`middle_name`,`last_name`,`address`,`birthday`,`sss`,`philhealth`,`pagibig`,`photo`,`status`,`created_at`,`deleted_at`) values (1,1,'Jason','Again','Bourne','Quezon City','1980-08-08','324562342','','',NULL,2,NULL,'2015-07-26 14:35:47');

/*Table structure for table `drivers_acct` */

DROP TABLE IF EXISTS `drivers_acct`;

CREATE TABLE `drivers_acct` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `drivers_acct` */

insert  into `drivers_acct`(`id`,`pos_id`,`driver_id`,`in`,`out`,`created_at`) values (1,1,1,0.00,550.00,'2015-07-26 14:35:47');

/*Table structure for table `garrage` */

DROP TABLE IF EXISTS `garrage`;

CREATE TABLE `garrage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `location` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `garrage` */

/*Table structure for table `maintenance` */

DROP TABLE IF EXISTS `maintenance`;

CREATE TABLE `maintenance` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `maintenance` */

insert  into `maintenance`(`id`,`name`,`interval`,`interval_value`,`price`,`is_scheduled`,`created_at`,`updated_at`,`deleted_at`) values (1,'General Check Up',1,10000,5000.00,1,'2015-07-27 16:07:23',NULL,NULL);

/*Table structure for table `maintenance_parts` */

DROP TABLE IF EXISTS `maintenance_parts`;

CREATE TABLE `maintenance_parts` (
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

/*Data for the table `maintenance_parts` */

/*Table structure for table `parts` */

DROP TABLE IF EXISTS `parts`;

CREATE TABLE `parts` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `parts` */

insert  into `parts`(`id`,`name`,`purchase_date`,`supplier`,`price`,`stock`,`created_at`,`updated_at`,`deleted_at`) values (1,'oil','2015-07-25','test',2000.00,5,'2015-07-25 16:53:11','0000-00-00 00:00:00',NULL);

/*Table structure for table `parts_logs` */

DROP TABLE IF EXISTS `parts_logs`;

CREATE TABLE `parts_logs` (
  `parts_id` int(11) DEFAULT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `maintenance_id` (`maintenance_id`),
  KEY `parts_id` (`parts_id`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `parts_logs` */

/*Table structure for table `pos` */

DROP TABLE IF EXISTS `pos`;

CREATE TABLE `pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(15) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `rate_type` tinyint(1) DEFAULT NULL COMMENT '1-reg, 2-coding, 3-sunday, 4-holiday',
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
  KEY `rate_type` (`rate_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `pos` */

insert  into `pos`(`id`,`reference`,`unit_id`,`driver_id`,`rate_type`,`amount`,`short`,`remarks`,`created_at`,`created_by`,`updated_at`,`updated_by`) values (1,NULL,1,1,3,1000.00,550.00,'natulog lang','2015-07-26 14:35:47',1,'0000-00-00 00:00:00',NULL);

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `garrage_id` int(11) DEFAULT NULL,
  `plate_number` varchar(7) CHARACTER SET latin1 DEFAULT NULL,
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
  `odometer` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `units` */

insert  into `units`(`id`,`garrage_id`,`plate_number`,`year_model`,`reg_rate`,`coding_rate`,`holiday_rate`,`sunday_rate`,`coding_day`,`resealing_date1`,`resealing_date2`,`franchise_until`,`renew_by`,`overhead_fund`,`docs_fund`,`replacement_fund`,`status`,`odometer`,`created_at`) values (1,NULL,'aaa 123',2014,1500.00,800.00,1000.00,1000.00,1,'2015-08-17','2015-09-28','2020-11-25','2017-07-26',2000.00,800.00,5000.00,2,8000,'2015-07-26 14:35:47');

/*Table structure for table `units_logs` */

DROP TABLE IF EXISTS `units_logs`;

CREATE TABLE `units_logs` (
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

/*Data for the table `units_logs` */

/*Table structure for table `units_maintenance` */

DROP TABLE IF EXISTS `units_maintenance`;

CREATE TABLE `units_maintenance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_id` int(11) DEFAULT NULL,
  `maintenance_id` int(11) DEFAULT NULL,
  `repeat_type` tinyint(1) DEFAULT NULL COMMENT '1-wk, 2-mnth',
  `repeat_value` tinyint(2) DEFAULT NULL,
  `notes` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `maintenance_id` (`maintenance_id`),
  KEY `unit_id` (`unit_id`),
  KEY `repeat_type` (`repeat_type`),
  KEY `created_at` (`created_at`),
  KEY `created_by` (`created_by`),
  KEY `updated_at` (`updated_at`),
  KEY `updated_by` (`updated_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `units_maintenance` */

/*Table structure for table `units_maintenance_logs` */

DROP TABLE IF EXISTS `units_maintenance_logs`;

CREATE TABLE `units_maintenance_logs` (
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

/*Data for the table `units_maintenance_logs` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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

/*Data for the table `users` */

insert  into `users`(`id`,`garrage_id`,`username`,`pword`,`first_name`,`last_name`,`photo`,`lvl`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'admin','e6e061838856bf47e1de730719fb2609','Gerald','Arcega',NULL,1,'2015-07-19 09:02:51',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
