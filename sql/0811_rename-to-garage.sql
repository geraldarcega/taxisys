RENAME TABLE `garrage` TO `garage`;
ALTER TABLE `units` CHANGE COLUMN `garrage_id` `garage_id` INT(11) NULL DEFAULT NULL AFTER `id`;