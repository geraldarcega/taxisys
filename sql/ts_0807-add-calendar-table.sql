CREATE TABLE `calendar` (
	`id` INT NOT NULL,
	`date_from` DATE NOT NULL,
	`time_from` TIME NOT NULL,
	`date_to` DATE NOT NULL,
	`time_to` TIME NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`created_by` INT NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	`updated_by` INT NOT NULL,
	`deleted_at` TIMESTAMP NOT NULL,
	`deleted_by` INT NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `date_from` (`date_from`),
	INDEX `time_from` (`time_from`),
	INDEX `date_to` (`date_to`),
	INDEX `time_to` (`time_to`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB;