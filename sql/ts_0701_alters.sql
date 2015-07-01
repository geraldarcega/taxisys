ALTER TABLE `taxisys`.`units_maintenance` ADD COLUMN `schedule` DATE NULL AFTER `odometer`;
ALTER TABLE `taxisys`.`units_maintenance` ADD INDEX (`schedule`); 