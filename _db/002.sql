CREATE  TABLE `webpomodoro`.`task` (
  `task_id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `estimated` INT NULL ,
  `completed` TINYINT NULL DEFAULT 0 ,
  `completed_date` DATETIME NULL ,
  PRIMARY KEY (`task_id`) ,
  UNIQUE INDEX `task_id_UNIQUE` (`task_id` ASC) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

ALTER TABLE `webpomodoro`.`task` CHANGE COLUMN `estimated` `estimated` INT(11) NULL DEFAULT 0  ;

ALTER TABLE `webpomodoro`.`task` ADD COLUMN `user_id` INT  NOT NULL  AFTER `completed_date` ;

ALTER TABLE `webpomodoro`.`task` ADD COLUMN `actual` INT NOT NULL DEFAULT 0  AFTER `estimated` ;

ALTER TABLE `webpomodoro`.`task` CHANGE COLUMN `title` `title` VARCHAR(255) NOT NULL  ,
CHANGE COLUMN `estimated` `estimated` INT(11) NOT NULL DEFAULT '0'  ;
