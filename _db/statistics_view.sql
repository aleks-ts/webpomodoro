# select `tl`.`task_id` AS `task_id`,date_format(`tl`.`date`,'%Y-%m-%d') AS `pomodoro_date`,`t`.`title` AS `task`,`u`.`nickname` AS `user`,`t`.`estimated` AS `pomodoro_planned`,`t`.`actual` AS `pomodoro_done`,`t`.`completed` AS `completed` from ((`webpomodoro`.`tasklog` `tl` left join `webpomodoro`.`task` `t` on((`tl`.`task_id` = `t`.`task_id`))) left join `webpomodoro`.`user` `u` on((`t`.`user_id` = `u`.`user_id`))) group by date_format(`tl`.`date`,'%Y-%m-%d'),`tl`.`task_id`,`t`.`title`,`u`.`nickname` order by `tl`.`date` desc

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `webpomodoro`.`statistics` AS select `tl`.`task_id` AS `task_id`,date_format(`tl`.`date`,'%Y-%m-%d') AS `pomodoro_date`,`t`.`title` AS `task`,`u`.`nickname` AS `user`,`t`.`estimated` AS `pomodoro_planned`,`t`.`actual` AS `pomodoro_done`,`t`.`completed` AS `completed` from ((`webpomodoro`.`tasklog` `tl` left join `webpomodoro`.`task` `t` on((`tl`.`task_id` = `t`.`task_id`))) left join `webpomodoro`.`user` `u` on((`t`.`user_id` = `u`.`user_id`))) group by date_format(`tl`.`date`,'%Y-%m-%d'),`tl`.`task_id`,`t`.`title`,`u`.`nickname` order by `tl`.`date` desc