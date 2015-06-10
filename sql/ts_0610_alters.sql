ALTER TABLE `taxisys`.`boundary` CHANGE `status` `status` TINYINT(1) DEFAULT 1 NULL COMMENT '1-full, 2-short';
ALTER TABLE `taxisys`.`boundary` CHARSET=utf8, COLLATE=utf8_general_ci;
ALTER TABLE `taxisys`.`boundary` ADD INDEX (`status`);

ALTER TABLE `taxisys`.`units` CHANGE `coding_day` `coding_day` TINYINT(1) NULL;

ALTER TABLE `taxisys`.`drivers_acct` DROP COLUMN `remarks`;
ALTER TABLE `taxisys`.`pos` ADD COLUMN `remarks` TEXT NULL AFTER `status`; 