CREATE  TABLE `webpomodoro`.`user` (
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`) ,
  UNIQUE INDEX `user_id_UNIQUE` (`user_id` ASC) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

ALTER TABLE `webpomodoro`.`user` CHANGE COLUMN `user_id` `user_id` INT(11) NOT NULL AUTO_INCREMENT  ;

