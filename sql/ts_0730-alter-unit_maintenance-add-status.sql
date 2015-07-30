ALTER TABLE `units_maintenance`
	ADD COLUMN `status` TINYINT NOT NULL AFTER `notes`,
	ADD INDEX `status` (`status`);