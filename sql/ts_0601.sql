/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.36-MariaDB : Database - taxisys
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`taxisys` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `taxisys`;

/*Table structure for table `boundary` */

DROP TABLE IF EXISTS `boundary`;

CREATE TABLE `boundary` (
  `boundary_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_idFK` int(11) DEFAULT NULL,
  `unit_idFK` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `short` int(11) DEFAULT NULL,
  `remarks` text,
  `status` enum('complete','short') DEFAULT NULL,
  `transac_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`boundary_id`),
  KEY `driver_idFK` (`driver_idFK`,`unit_idFK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `boundary` */

/*Table structure for table `drivers` */

DROP TABLE IF EXISTS `drivers`;

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `mname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `lname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `address` text,
  `dob` date DEFAULT NULL,
  `sss` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `philhealth` varchar(50) DEFAULT NULL,
  `pagibig` varchar(50) DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `del` enum('Yes','No') DEFAULT 'No',
  PRIMARY KEY (`driver_id`),
  KEY `acct_idFK` (`fname`,`mname`,`lname`,`dob`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `drivers` */

insert  into `drivers`(`driver_id`,`fname`,`mname`,`lname`,`address`,`dob`,`sss`,`philhealth`,`pagibig`,`photo`,`del`) values (1,'Jason','New','Bourne','Manila, Philippines','1990-01-30','13243546','13246345','24356342',NULL,'No'),(2,'Gerald','Sweet','Lover','Ph 1 Heritage Homes Marilao, Bulacan','1990-01-15','1234567823','65432453','2345675344',NULL,'No');

/*Table structure for table `drivers_acct` */

DROP TABLE IF EXISTS `drivers_acct`;

CREATE TABLE `drivers_acct` (
  `acct_id` int(11) NOT NULL AUTO_INCREMENT,
  `drivers_idFK` int(11) DEFAULT NULL,
  `in` int(11) DEFAULT NULL,
  `out` int(11) DEFAULT NULL,
  `remarks` text CHARACTER SET latin1,
  `transac_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`acct_id`),
  KEY `drivers_idFK` (`drivers_idFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `drivers_acct` */

/*Table structure for table `garrage` */

DROP TABLE IF EXISTS `garrage`;

CREATE TABLE `garrage` (
  `garrage_id` int(11) NOT NULL AUTO_INCREMENT,
  `garrage_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `garrage_location` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`garrage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `garrage` */

/*Table structure for table `parts` */

DROP TABLE IF EXISTS `parts`;

CREATE TABLE `parts` (
  `parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_idFK` int(11) DEFAULT NULL,
  `parts_name` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `install_date` date DEFAULT NULL,
  `install_by` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `supplier` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`parts_id`),
  KEY `unit_idFK` (`unit_idFK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `parts` */

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_idFK` int(11) DEFAULT NULL,
  `plate_number` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `year_model` int(4) DEFAULT NULL,
  `reg_rate` int(11) DEFAULT NULL,
  `coding_rate` int(11) DEFAULT NULL,
  `holiday_rate` int(11) DEFAULT NULL,
  `sunday_rate` int(11) DEFAULT NULL,
  `coding_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') CHARACTER SET latin1 DEFAULT NULL,
  `resealing_date1` date DEFAULT NULL,
  `resealing_date2` date DEFAULT NULL,
  `franchise_until` date DEFAULT NULL,
  `renew_by` date DEFAULT NULL,
  `overhead_fund` decimal(10,2) DEFAULT NULL,
  `docs_fund` decimal(10,2) DEFAULT NULL,
  `replacement_fund` decimal(10,2) DEFAULT NULL,
  `status` enum('On-duty','On-garrage','On-maintenance','Replace') DEFAULT 'On-duty',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_id`),
  KEY `plate_number` (`plate_number`,`franchise_until`,`renew_by`,`coding_day`,`driver_idFK`,`year_model`,`coding_rate`,`holiday_rate`,`resealing_date1`,`resealing_date2`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `units` */

insert  into `units`(`unit_id`,`driver_idFK`,`plate_number`,`year_model`,`reg_rate`,`coding_rate`,`holiday_rate`,`sunday_rate`,`coding_day`,`resealing_date1`,`resealing_date2`,`franchise_until`,`renew_by`,`overhead_fund`,`docs_fund`,`replacement_fund`,`status`,`date_created`) values (1,NULL,'aaa 123',2015,123245,2312,2341,132,'Tuesday','2015-05-20','2015-05-20','2015-05-20','2015-05-20',123.00,234.00,3242.00,'On-duty','2015-05-30 23:38:00'),(2,NULL,'AAA 122',2014,1500,1000,1500,1300,'Friday','2014-01-01','2014-01-05','2018-01-01','2015-02-11',10000.00,3000.00,100000.00,'On-duty','2015-05-30 23:38:03'),(3,NULL,'AAA 124',2014,1500,1000,1500,1300,'Monday','2015-05-13','2015-05-13','2015-05-28','2015-05-21',1000.00,100.00,100000.00,'On-garrage','2015-05-30 23:38:33'),(4,NULL,'AAA 3214',2015,1550,1200,1550,1400,'Monday','2015-05-03','2015-05-11','2020-01-01','2018-06-12',1200.00,100.00,2000.00,'On-garrage','2015-05-30 23:38:29'),(5,NULL,'ABX 1234',2006,1550,550,1350,1350,'Monday','2015-05-19','2016-01-01','2020-02-01','2020-01-01',120.00,120.00,300.00,'On-garrage','2015-05-30 23:38:22');

/*Table structure for table `units_logs` */

DROP TABLE IF EXISTS `units_logs`;

CREATE TABLE `units_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_idFK` int(11) DEFAULT NULL,
  `driver_idFK` int(11) DEFAULT NULL,
  `status` enum('On-duty','On-garrage','On-maintenance','Replaced') CHARACTER SET latin1 DEFAULT 'On-duty',
  `boundary` decimal(10,2) DEFAULT NULL,
  `is_holiday` tinyint(1) DEFAULT NULL,
  `is_coding` tinyint(1) DEFAULT NULL,
  `is_sunday` tinyint(1) DEFAULT NULL,
  `trans_date` datetime DEFAULT NULL,
  `assign_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `unit_idFK` (`unit_idFK`,`status`,`trans_date`,`driver_idFK`,`assign_date`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `units_logs` */

insert  into `units_logs`(`log_id`,`unit_idFK`,`driver_idFK`,`status`,`boundary`,`is_holiday`,`is_coding`,`is_sunday`,`trans_date`,`assign_date`) values (1,1,1,'On-duty',NULL,NULL,NULL,NULL,NULL,'2015-05-27 01:19:59'),(2,3,2,'On-duty',NULL,NULL,NULL,NULL,NULL,'2015-05-27 01:24:59'),(5,2,1,'On-duty',NULL,NULL,NULL,NULL,NULL,'2015-05-28 00:33:02'),(6,1,2,'On-duty',NULL,NULL,NULL,NULL,NULL,'2015-05-28 02:14:39');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `pword` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `fname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `lname` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `lvl` int(1) DEFAULT '0' COMMENT '0 - normal, 1 - admin',
  `active` int(1) DEFAULT NULL,
  `garrage_idFK` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `garrage_idFK` (`garrage_idFK`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`pword`,`fname`,`lname`,`photo`,`lvl`,`active`,`garrage_idFK`,`date_created`) values (1,'admin','e6e061838856bf47e1de730719fb2609','Gerald','Arcega',NULL,1,NULL,NULL,'2015-04-10 02:53:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
