ALTER TABLE `taxisys`.`drivers` ADD COLUMN `pagibig` VARCHAR(50) NULL AFTER `philhealth`;
ALTER TABLE `taxisys`.`drivers` ADD COLUMN `status` ENUM('Active','Inactive') DEFAULT 'Active' NULL;