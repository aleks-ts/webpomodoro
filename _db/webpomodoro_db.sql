CREATE DATABASE  IF NOT EXISTS `webpomodoro` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `webpomodoro`;
-- MySQL dump 10.13  Distrib 5.5.28, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: webpomodoro
-- ------------------------------------------------------
-- Server version	5.5.28-0ubuntu0.12.10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Temporary table structure for view `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!50001 DROP VIEW IF EXISTS `statistics`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `statistics` (
  `task_id` tinyint NOT NULL,
  `pomodoro_date` tinyint NOT NULL,
  `task` tinyint NOT NULL,
  `user` tinyint NOT NULL,
  `pomodoro_planned` tinyint NOT NULL,
  `pomodoro_done` tinyint NOT NULL,
  `completed` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `tasklog`
--

DROP TABLE IF EXISTS `tasklog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasklog` (
  `tasklog_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`tasklog_id`),
  UNIQUE KEY `pomodoro_id_UNIQUE` (`tasklog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasklog`
--

LOCK TABLES `tasklog` WRITE;
/*!40000 ALTER TABLE `tasklog` DISABLE KEYS */;
INSERT INTO `tasklog` VALUES (1,'2012-12-13 00:00:00',1),(4,'2012-12-05 00:00:00',1),(7,'2012-12-13 08:28:47',1),(8,'2012-12-18 07:11:00',50),(9,'2012-12-18 07:20:59',50),(11,'2012-12-18 07:31:16',50),(12,'2012-12-18 07:31:32',50),(13,'2012-12-18 07:33:46',52),(14,'2012-12-18 07:38:21',52),(15,'2012-12-18 07:39:00',56),(16,'2012-12-18 09:27:03',56),(17,'2012-12-18 09:27:32',58),(18,'2013-01-14 03:39:33',52);
/*!40000 ALTER TABLE `tasklog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'alexander@gmail.com','Ts Alexander','8bf968a415cc3cd63930fec8e3e164a4'),(2,'serg@saint.com','Igor Slavin',NULL),(3,'alt@mail.ru','John Professor','a53977b191d482947fc3618cd6614c5b');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `estimated` int(11) NOT NULL DEFAULT '0',
  `actual` int(11) NOT NULL DEFAULT '0',
  `completed` tinyint(4) DEFAULT '0',
  `completed_date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`task_id`),
  UNIQUE KEY `task_id_UNIQUE` (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'setup database',1,3,1,'2013-01-10 00:00:00',2),(50,'123',12,4,1,'2013-01-13 00:00:00',1),(52,'make coffee',1,3,0,NULL,2),(56,'fix bugs',3,2,1,'2013-01-12 00:00:00',1),(57,'sing a song ',2,0,0,NULL,2),(58,'112',3,1,1,'2013-01-13 00:00:00',1),(59,'set up website ',1,0,0,'2013-01-12 00:00:00',1),(62,'0000000000000',3,0,1,'2013-01-10 00:00:00',2),(63,'make tea',1,0,0,NULL,3),(64,'do something',3,0,0,NULL,3),(65,'fix session ',1,0,0,NULL,3),(66,'fix session bugs',1,0,0,NULL,3);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `statistics`
--

/*!50001 DROP TABLE IF EXISTS `statistics`*/;
/*!50001 DROP VIEW IF EXISTS `statistics`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `statistics` AS select `tl`.`task_id` AS `task_id`,date_format(`tl`.`date`,'%Y-%m-%d') AS `pomodoro_date`,`t`.`title` AS `task`,`u`.`nickname` AS `user`,`t`.`estimated` AS `pomodoro_planned`,`t`.`actual` AS `pomodoro_done`,`t`.`completed` AS `completed` from ((`tasklog` `tl` left join `task` `t` on((`tl`.`task_id` = `t`.`task_id`))) left join `user` `u` on((`t`.`user_id` = `u`.`user_id`))) group by date_format(`tl`.`date`,'%Y-%m-%d'),`tl`.`task_id`,`t`.`title`,`u`.`nickname` order by `tl`.`date` desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Dumping routines for database 'webpomodoro'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-01-14 14:47:20
