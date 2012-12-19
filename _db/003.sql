CREATE  TABLE `webpomodoro`.`pomodoro` (
  `pomodoro_id` INT NOT NULL AUTO_INCREMENT ,
  `date` DATETIME NULL ,
  `task_id` INT NULL ,
  PRIMARY KEY (`pomodoro_id`) ,
  UNIQUE INDEX `pomodoro_id_UNIQUE` (`pomodoro_id` ASC) )
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;