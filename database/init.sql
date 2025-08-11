-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               9.1.0 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.11.0.7065
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for tasks_demo_db
CREATE DATABASE IF NOT EXISTS `tasks_demo_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `tasks_demo_db`;

-- Dumping structure for table tasks_demo_db.tdtask10
CREATE TABLE IF NOT EXISTS `tdtask10` (
  `TASK10_ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Task ID',
  `TASK10_TITL` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Task Title',
  `TASK10_DESC` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci COMMENT 'Task Description',
  `TASK10_STUS` int NOT NULL COMMENT 'Task Status',
  `TASK10_DUED` datetime NOT NULL COMMENT 'Task Due Date',
  `TASK10_CRTD` datetime NOT NULL COMMENT 'Created DateTime',
  `TASK10_CRTU` int(10) unsigned zerofill NOT NULL COMMENT 'Created User',
  `TASK10_CRTP` varchar(128) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Manual Insert' COMMENT 'Created Program',
  `TASK10_LUPD` datetime NOT NULL COMMENT 'Last Updated DataTime',
  `TASK10_LUPU` int(10) unsigned zerofill NOT NULL COMMENT 'Last Updated User',
  `TASK10_LUPP` varchar(128) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Manual Insert' COMMENT 'Last Updated Program',
  `TASK10_DFLG` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000' COMMENT 'Delete Flag',
  PRIMARY KEY (`TASK10_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table tasks_demo_db.tduser10
CREATE TABLE IF NOT EXISTS `tduser10` (
  `USER10_ID` int NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `USER10_NAME` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Username',
  `USER10_EMAL` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'User Email',
  `USER10_CRTD` datetime NOT NULL COMMENT 'Created DateTime',
  `USER10_CRTU` int(10) unsigned zerofill NOT NULL COMMENT 'Created User',
  `USER10_CRTP` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Manual Insert' COMMENT 'Created Program',
  `USER10_LUPD` datetime NOT NULL COMMENT 'Last Updated DataTime',
  `USER10_LUPU` int(10) unsigned zerofill NOT NULL COMMENT 'Last Updated User',
  `USER10_LUPP` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Manual Insert' COMMENT 'Last Updated Program',
  `USER10_DFLG` int(10) unsigned zerofill NOT NULL DEFAULT '0000000000' COMMENT 'Delete Flag',
  PRIMARY KEY (`USER10_ID`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
