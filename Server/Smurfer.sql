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

-- Dumping structure for table smurfer.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `Id_Admin` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.admin: ~0 rows (approximately)
DELETE FROM `admin`;
INSERT INTO `admin` (`Id_Admin`, `Username`, `Password`) VALUES
	(1, 'admin', 'admin');

-- Dumping structure for table smurfer.game
CREATE TABLE IF NOT EXISTS `game` (
  `Id_Game` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_Game` varchar(50) NOT NULL,
  `Image` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id_Game`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.game: ~6 rows (approximately)
DELETE FROM `game`;
INSERT INTO `game` (`Id_Game`, `Nama_Game`, `Image`) VALUES
	(1, 'Mobile Legends', 'Mobile Legends.jpeg'),
	(2, 'Valorant', 'Valorant.jpeg'),
	(3, 'Counter Strike 2', 'Counter Strike 2.jpeg'),
	(4, 'Dota 2', 'Dota 2.jpeg'),
	(5, 'League Of Legends', 'League Of Legends.jpeg'),
	(6, 'PUBG Mobile', 'PUBG Mobile.jpeg');

-- Dumping structure for table smurfer.order
CREATE TABLE IF NOT EXISTS `order` (
  `Id_Order` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) NOT NULL,
  `Id_Worker` int(11) NOT NULL,
  `Id_Game` int(11) NOT NULL,
  `Total_Price` int(11) DEFAULT NULL,
  `Initial_Rank` int(11) DEFAULT NULL,
  `Final_Rank` int(11) DEFAULT NULL,
  `Message` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Pending',
  PRIMARY KEY (`Id_Order`),
  KEY `FK_order_users` (`Id_User`),
  KEY `FK_order_game` (`Id_Game`),
  KEY `FK_order_workers` (`Id_Worker`),
  CONSTRAINT `FK_order_game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_users` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_workers` FOREIGN KEY (`Id_Worker`) REFERENCES `workers` (`Id_Worker`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.order: ~5 rows (approximately)
DELETE FROM `order`;
INSERT INTO `order` (`Id_Order`, `Id_User`, `Id_Worker`, `Id_Game`, `Total_Price`, `Initial_Rank`, `Final_Rank`, `Message`, `Status`) VALUES
	(1, 3, 1, 2, 45000, 1, 7, 'Selesai 2 minggu bang pake reyna kalo bisa', 'Declined'),
	(2, 3, 1, 2, 35000, 1, 6, '', 'Canceled'),
	(3, 3, 3, 5, 14000, 2, 4, '', 'Canceled'),
	(4, 3, 1, 2, 1085000, 1, 24, '', 'Declined'),
	(5, 3, 1, 2, 90000, 2, 11, 'Kalo bisa pake duelist terus', 'Canceled');

-- Dumping structure for table smurfer.rank
CREATE TABLE IF NOT EXISTS `rank` (
  `Point` int(11) DEFAULT NULL,
  `Rank` varchar(50) DEFAULT NULL,
  `Id_Game` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  KEY `FK_rank_game` (`Id_Game`),
  CONSTRAINT `FK_rank_game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.rank: ~79 rows (approximately)
DELETE FROM `rank`;
INSERT INTO `rank` (`Point`, `Rank`, `Id_Game`, `Price`) VALUES
	(1, 'Iron 1', 2, 5000),
	(2, 'Iron 2', 2, 5000),
	(3, 'Iron 3', 2, 5000),
	(4, 'Bronze 1', 2, 7000),
	(5, 'Bronze 2', 2, 7000),
	(6, 'Bronze 3', 2, 7000),
	(7, 'Silver 1', 2, 10000),
	(8, 'Silver 2', 2, 10000),
	(9, 'Silver 3', 2, 10000),
	(10, 'Gold 1', 2, 15000),
	(11, 'Gold 2', 2, 15000),
	(12, 'Gold 3', 2, 15000),
	(13, 'Platinum 1', 2, 25000),
	(14, 'Platinum 2', 2, 25000),
	(15, 'Platinum 3', 2, 25000),
	(16, 'Diamond 1', 2, 50000),
	(17, 'Diamond 2', 2, 50000),
	(18, 'Diamond 3', 2, 50000),
	(19, 'Ascendant 1', 2, 100000),
	(20, 'Ascendant 2', 2, 100000),
	(21, 'Ascendant 3', 2, 100000),
	(22, 'Immortal 1', 2, 150000),
	(23, 'Immortal 2', 2, 150000),
	(24, 'Immortal 3', 2, 150000),
	(1, 'Iron 4', 5, 5000),
	(2, 'Iron 3', 5, 5000),
	(3, 'Iron 2', 5, 5000),
	(4, 'Iron 1', 5, 5000),
	(5, 'Bronze 4', 5, 10000),
	(6, 'Bronze 3', 5, 10000),
	(7, 'Bronze 2', 5, 10000),
	(8, 'Bronze 1', 5, 10000),
	(9, 'Gold 4', 5, 15000),
	(10, 'Gold 3', 5, 15000),
	(11, 'Gold 2', 5, 15000),
	(12, 'Gold 1', 5, 15000),
	(13, 'Diamond 4', 5, 25000),
	(14, 'Diamond 3', 5, 25000),
	(15, 'Diamond 2', 5, 25000),
	(16, 'Diamond 1', 5, 25000),
	(17, 'Master', 5, 50000),
	(18, 'Grandmaster', 5, 100000),
	(19, 'Challenger', 5, 150000),
	(1, 'Bronze 5', 6, 5000),
	(2, 'Bronze 4', 6, 5000),
	(3, 'Bronze 3', 6, 5000),
	(4, 'Bronze 2', 6, 5000),
	(5, 'Bronze 1', 6, 5000),
	(6, 'Silver 5', 6, 10000),
	(7, 'Silver 4', 6, 10000),
	(8, 'Silver 3', 6, 10000),
	(9, 'Silver 2', 6, 10000),
	(10, 'Silver 1', 6, 10000),
	(11, 'Gold 5', 6, 25000),
	(12, 'Gold 4', 6, 25000),
	(13, 'Gold 3', 6, 25000),
	(14, 'Gold 2', 6, 25000),
	(15, 'Gold 1', 6, 25000),
	(16, 'Platinum 5', 6, 50000),
	(17, 'Platinum 4', 6, 50000),
	(18, 'Platinum 3', 6, 50000),
	(19, 'Platinum 2', 6, 50000),
	(20, 'Platinum 1', 6, 50000),
	(21, 'Diamond 5', 6, 100000),
	(22, 'Diamond 4', 6, 100000),
	(23, 'Diamond 3', 6, 100000),
	(24, 'Diamond 2', 6, 100000),
	(25, 'Diamond 1', 6, 100000),
	(26, 'Crown 5', 6, 125000),
	(27, 'Crown 4', 6, 125000),
	(28, 'Crown 3', 6, 125000),
	(29, 'Crown 2', 6, 125000),
	(30, 'Crown 1', 6, 125000),
	(31, 'Ace 5', 6, 150000),
	(32, 'Ace 4', 6, 150000),
	(33, 'Ace 3', 6, 150000),
	(34, 'Ace 2', 6, 150000),
	(35, 'Ace 1', 6, 150000),
	(36, 'Conqueror', 6, 200000);

-- Dumping structure for table smurfer.users
CREATE TABLE IF NOT EXISTS `users` (
  `Id_User` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Customer',
  `Foto` varchar(50) DEFAULT 'default2.jpg',
  PRIMARY KEY (`Id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.users: ~7 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`Id_User`, `Username`, `Email`, `Password`, `Status`, `Foto`) VALUES
	(1, 'lutfi ', 'lutfi3522@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(2, 'Axel', 'axel123@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(3, 'fahri', 'fahri123@gmail.com', '123', 'Customer', 'default2.jpg'),
	(4, 'Egi', 'egi123@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(6, 'Phyyy', 'lutfi123@gmail.com', '123', 'Customer', 'profile.jpeg'),
	(8, 'lutfi', 'lutfi123@gmail.com', '123', 'Customer', 'default2.jpg'),
	(9, 'pii', '123@gmail.com', '123', 'Customer', 'default2.jpg'),
	(10, '123', '12345', '123', 'Customer', 'default2.jpg');

-- Dumping structure for table smurfer.workers
CREATE TABLE IF NOT EXISTS `workers` (
  `Id_Worker` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) DEFAULT NULL,
  `Id_Game` int(11) DEFAULT NULL,
  `Rating` float DEFAULT NULL,
  `Exp` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Worker`),
  KEY `FK_workers_users` (`Id_User`),
  KEY `FK_workers_game` (`Id_Game`),
  CONSTRAINT `FK_workers_game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_workers_users` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.workers: ~4 rows (approximately)
DELETE FROM `workers`;
INSERT INTO `workers` (`Id_Worker`, `Id_User`, `Id_Game`, `Rating`, `Exp`) VALUES
	(1, 1, 2, 4.5, NULL),
	(2, 2, 6, 0, NULL),
	(3, 4, 5, 0, NULL),
	(4, 6, 3, 0, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
