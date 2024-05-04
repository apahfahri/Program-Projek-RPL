-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for smurfer
CREATE DATABASE IF NOT EXISTS `smurfer` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `smurfer`;

-- Dumping structure for table smurfer.game
CREATE TABLE IF NOT EXISTS `game` (
  `Id_Game` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Game` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_Game`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.game: ~6 rows (approximately)
DELETE FROM `game`;
INSERT INTO `game` (`Id_Game`, `Nama_Game`) VALUES
	(1, 'Mobile Legends'),
	(2, 'Valorant'),
	(3, 'Counter Strike 2'),
	(4, 'Dota 2'),
	(5, 'League Of Legends'),
	(6, 'PUBG Mobile');

-- Dumping structure for table smurfer.users
CREATE TABLE IF NOT EXISTS `users` (
  `Id_User` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Customer',
  `Foto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.users: ~4 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`Id_User`, `Username`, `Email`, `Password`, `Status`, `Foto`) VALUES
	(1, 'lutfi ', 'lutfi3522@gmail.com', '123', 'Worker', NULL),
	(2, 'Axel', 'axel123@gmail.com', '123', 'Worker', NULL),
	(3, 'fahri', 'fahri123@gmail.com', '123', 'Customer', NULL),
	(4, 'Egi', 'egi123@gmail.com', '123', 'Worker', NULL);

-- Dumping structure for table smurfer.workers
CREATE TABLE IF NOT EXISTS `workers` (
  `Id_Worker` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Worker`),
  KEY `FK_workers_users` (`Id_User`),
  CONSTRAINT `FK_workers_users` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.workers: ~1 rows (approximately)
DELETE FROM `workers`;
INSERT INTO `workers` (`Id_Worker`, `Id_User`, `Rating`) VALUES
	(1, 1, 0);

-- Dumping structure for table smurfer.workers_game
CREATE TABLE IF NOT EXISTS `workers_game` (
  `Id_Worker` int(11) DEFAULT NULL,
  `Id_Game` int(11) DEFAULT NULL,
  KEY `FK__workers` (`Id_Worker`),
  KEY `FK__game` (`Id_Game`),
  CONSTRAINT `FK__game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__workers` FOREIGN KEY (`Id_Worker`) REFERENCES `workers` (`Id_Worker`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.workers_game: ~2 rows (approximately)
DELETE FROM `workers_game`;
INSERT INTO `workers_game` (`Id_Worker`, `Id_Game`) VALUES
	(1, 2),
	(1, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
