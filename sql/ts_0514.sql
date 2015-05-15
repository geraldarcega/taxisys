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
CREATE DATABASE /*!32312 IF NOT EXISTS*/`taxisys` /*!40100 DEFAULT CHARACTER SET latin1 */;

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
  `acct_idFK` int(11) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `mname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `sss` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`driver_id`),
  KEY `acct_idFK` (`acct_idFK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `drivers` */

/*Table structure for table `drivers_acct` */

DROP TABLE IF EXISTS `drivers_acct`;

CREATE TABLE `drivers_acct` (
  `acct_id` int(11) NOT NULL AUTO_INCREMENT,
  `drivers_idFK` int(11) DEFAULT NULL,
  `in` int(11) DEFAULT NULL,
  `out` int(11) DEFAULT NULL,
  `remarks` text,
  `transac_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`acct_id`),
  KEY `drivers_idFK` (`drivers_idFK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `drivers_acct` */

/*Table structure for table `garrage` */

DROP TABLE IF EXISTS `garrage`;

CREATE TABLE `garrage` (
  `garrage_id` int(11) NOT NULL AUTO_INCREMENT,
  `garrage_name` varchar(100) DEFAULT NULL,
  `garrage_location` varchar(255) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`garrage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `garrage` */

/*Table structure for table `parts` */

DROP TABLE IF EXISTS `parts`;

CREATE TABLE `parts` (
  `parts_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_idFK` int(11) DEFAULT NULL,
  `parts_name` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `install_date` date DEFAULT NULL,
  `install_by` varchar(100) DEFAULT NULL,
  `supplier` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`parts_id`),
  KEY `unit_idFK` (`unit_idFK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `parts` */

/*Table structure for table `units` */

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `unit_id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_number` varchar(10) DEFAULT NULL,
  `year_model` int(4) DEFAULT NULL,
  `reg_rate` int(11) DEFAULT NULL,
  `coding_rate` int(11) DEFAULT NULL,
  `holiday_rate` int(11) DEFAULT NULL,
  `sunday_rate` int(11) DEFAULT NULL,
  `coding_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') DEFAULT NULL,
  `releasing_date1` date DEFAULT NULL,
  `releasing_date2` date DEFAULT NULL,
  `franchise_until` date DEFAULT NULL,
  `renew_by` date DEFAULT NULL,
  `overhead_fund` decimal(10,2) DEFAULT NULL,
  `docs_fund` decimal(10,2) DEFAULT NULL,
  `replacement_fund` decimal(10,2) DEFAULT NULL,
  `status` enum('On-duty','On-garrage','On-maintenance','Replaced') DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`unit_id`),
  KEY `plate_number` (`plate_number`,`franchise_until`,`renew_by`,`coding_day`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `units` */

insert  into `units`(`unit_id`,`plate_number`,`year_model`,`reg_rate`,`coding_rate`,`holiday_rate`,`sunday_rate`,`coding_day`,`releasing_date1`,`releasing_date2`,`franchise_until`,`renew_by`,`overhead_fund`,`docs_fund`,`replacement_fund`,`status`,`date_created`) values (1,'aaa123',2015,1500,1000,1300,1200,'Tuesday','2014-05-06','2014-06-18','2015-05-14','2016-10-04',150.00,250.00,1000.00,NULL,'2015-05-14 16:21:25'),(2,'AAA 122',2014,1500,1000,1500,1300,'Friday','2014-01-01','2014-01-05','2018-01-01','2015-02-11',10000.00,3000.00,100000.00,NULL,'2015-05-14 16:42:59'),(3,'AAA 124',2014,1500,1000,1500,1300,'Monday','2015-05-13','2015-05-13','2015-05-28','2015-05-21',1000.00,100.00,100000.00,NULL,'2015-05-14 17:37:48');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `pword` varchar(255) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `lvl` int(1) DEFAULT '0' COMMENT '0 - normal, 1 - admin',
  `active` int(1) DEFAULT NULL,
  `garrage_idFK` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `garrage_idFK` (`garrage_idFK`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`pword`,`fname`,`lname`,`photo`,`lvl`,`active`,`garrage_idFK`,`date_created`) values (1,'admin','e6e061838856bf47e1de730719fb2609','Gerald','Arcega',NULL,1,NULL,NULL,'2015-04-10 02:53:21');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
