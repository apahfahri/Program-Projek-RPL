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

-- Dumping data for table smurfer.game: ~5 rows (approximately)
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
  `Status_Payment` varchar(50) DEFAULT 'Unpaid',
  `Payment_Method` varchar(50) DEFAULT NULL,
  `Proof_Transaction` varchar(50) DEFAULT NULL,
  `Game_Username` varchar(50) DEFAULT NULL,
  `Game_Password` varchar(50) DEFAULT NULL,
  `Result` varchar(50) DEFAULT NULL,
  `Review` varchar(400) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`Id_Order`),
  KEY `FK_order_users` (`Id_User`),
  KEY `FK_order_game` (`Id_Game`),
  KEY `FK_order_workers` (`Id_Worker`),
  CONSTRAINT `FK_order_game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_users` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_order_workers` FOREIGN KEY (`Id_Worker`) REFERENCES `workers` (`Id_Worker`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.order: ~7 rows (approximately)
DELETE FROM `order`;
INSERT INTO `order` (`Id_Order`, `Id_User`, `Id_Worker`, `Id_Game`, `Total_Price`, `Initial_Rank`, `Final_Rank`, `Message`, `Status`, `Status_Payment`, `Payment_Method`, `Proof_Transaction`, `Game_Username`, `Game_Password`, `Result`, `Review`, `Rating`, `date`) VALUES
	(1, 3, 1, 2, 650000, 13, 22, 'Pake duelist yah bang', 'Done', 'Paid', 'Gopay', 'uploads/3.jpg', 'Phyyy2', '321', 'uploads/results/3.jpg', 'Keren bintang 5', 3, '2024-05-29 11:06:48'),
	(2, 3, 2, 6, 40000, 6, 10, 'KD jangan sampe turun bang', 'Canceled', 'Unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-30 01:38:34'),
	(3, 3, 3, 5, 340000, 5, 18, 'Usahain pake support bang', 'Done', 'Paid', 'Gopay', 'uploads/1.jpg', 'Phyyy2', '123', 'uploads/results/voice.jpg', 'Good job bang, gokil cepet banget prosesnya, winrate naik terus mantap lah pokonya rekomended', 5, '2024-05-30 01:49:34'),
	(4, 11, 1, 2, 1081000, 1, 24, 'Pake duelist bang', 'Done', 'Paid', 'Gopay', 'uploads/Transaction.jpg', 'Phyyy2', '123', 'uploads/results/Result.jpg', 'mantap bang', 5, '2024-05-30 06:11:19'),
	(7, 3, 1, 2, 900000, 15, 24, 'Pake duelist bang', 'Accepted', 'Unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-06-02 03:58:30'),
	(8, 3, 6, 1, 1350000, 20, 29, 'Push WR nana bang', 'Done', 'Paid', 'BCA', 'uploads/Transaction2.jpg', 'Aezekiel', '321', 'uploads/results/Result.jpg', NULL, NULL, '2024-06-02 05:30:02'),
	(9, 3, 4, 2, 200000, 13, 18, 'Yang penting naik bang', 'Done', 'Paid', 'Gopay', 'uploads/2.jpg', 'Phyyy2', '123', 'uploads/results/Result.jpg', 'Cepet banget proses nya oke banget', 5, '2024-06-02 08:53:42');

-- Dumping structure for table smurfer.rank
CREATE TABLE IF NOT EXISTS `rank` (
  `Point` int(11) DEFAULT NULL,
  `Rank` varchar(50) DEFAULT NULL,
  `Id_Game` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  KEY `FK_rank_game` (`Id_Game`),
  CONSTRAINT `FK_rank_game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.rank: ~208 rows (approximately)
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
	(36, 'Conqueror', 6, 200000),
	(1, 'Warrior 3', 1, 3000),
	(2, 'Warrior 2', 1, 3000),
	(3, 'Warrior 1', 1, 3000),
	(4, 'Elite 3', 1, 5000),
	(5, 'Elite 2', 1, 5000),
	(6, 'Elite 1', 1, 5000),
	(7, 'Master 4', 1, 10000),
	(8, 'Master 3', 1, 10000),
	(9, 'Master 2', 1, 10000),
	(10, 'Master 1', 1, 10000),
	(11, 'Grandmaster 5', 1, 20000),
	(12, 'Grandmaster 4', 1, 20000),
	(13, 'Grandmaster 3', 1, 20000),
	(14, 'Grandmaster 2', 1, 20000),
	(15, 'Grandmaster 1', 1, 20000),
	(16, 'Epic 5', 1, 50000),
	(17, 'Epic 4', 1, 50000),
	(18, 'Epic 3', 1, 50000),
	(19, 'Epic 2', 1, 50000),
	(20, 'Epic 1', 1, 50000),
	(21, 'Legend 5', 1, 70000),
	(22, 'Legend 4', 1, 70000),
	(23, 'Legend 3', 1, 70000),
	(24, 'Legend 2', 1, 70000),
	(25, 'Legend 1', 1, 70000),
	(26, 'Mythic', 1, 100000),
	(27, 'Mythic Honor', 1, 150000),
	(28, 'Mythic Glory', 1, 250000),
	(29, 'Mythic Immortal', 1, 500000),
	(1, '100', 4, 30000),
	(2, '200', 4, 30000),
	(3, '300', 4, 30000),
	(4, '400', 4, 30000),
	(5, '500', 4, 30000),
	(6, '600', 4, 30000),
	(7, '700', 4, 30000),
	(8, '800', 4, 30000),
	(9, '900', 4, 30000),
	(10, '1000', 4, 30000),
	(11, '1100', 4, 30000),
	(12, '1200', 4, 30000),
	(13, '1300', 4, 30000),
	(14, '1400', 4, 30000),
	(15, '1500', 4, 30000),
	(16, '1600', 4, 30000),
	(17, '1700', 4, 30000),
	(18, '1800', 4, 30000),
	(19, '1900', 4, 30000),
	(20, '2000', 4, 30000),
	(21, '2100', 4, 35000),
	(22, '2200', 4, 35000),
	(23, '2300', 4, 35000),
	(24, '2400', 4, 35000),
	(25, '2500', 4, 35000),
	(26, '2600', 4, 35000),
	(27, '2700', 4, 35000),
	(28, '2800', 4, 35000),
	(29, '2900', 4, 35000),
	(30, '3000', 4, 35000),
	(31, '3100', 4, 65000),
	(32, '3200', 4, 65000),
	(33, '3300', 4, 65000),
	(34, '3400', 4, 65000),
	(35, '3500', 4, 65000),
	(36, '3600', 4, 65000),
	(37, '3700', 4, 65000),
	(38, '3800', 4, 65000),
	(39, '3900', 4, 65000),
	(40, '4000', 4, 65000),
	(41, '4100', 4, 85000),
	(42, '4200', 4, 85000),
	(43, '4300', 4, 85000),
	(44, '4400', 4, 85000),
	(45, '4500', 4, 85000),
	(46, '4600', 4, 85000),
	(47, '4700', 4, 85000),
	(48, '4800', 4, 85000),
	(49, '4900', 4, 85000),
	(50, '5000', 4, 85000),
	(51, '5100', 4, 125000),
	(52, '5200', 4, 125000),
	(53, '5300', 4, 125000),
	(54, '5400', 4, 125000),
	(55, '5500', 4, 125000),
	(56, '5600', 4, 125000),
	(57, '5700', 4, 125000),
	(58, '5800', 4, 125000),
	(59, '5900', 4, 125000),
	(60, '6000', 4, 125000),
	(61, '6100', 4, 300000),
	(62, '6200', 4, 300000),
	(63, '6300', 4, 300000),
	(64, '6400', 4, 300000),
	(65, '6500', 4, 300000),
	(66, '6600', 4, 300000),
	(67, '6700', 4, 300000),
	(68, '6800', 4, 300000),
	(69, '6900', 4, 300000),
	(70, '7000', 4, 300000),
	(71, '7100', 4, 500000),
	(72, '7200', 4, 500000),
	(73, '7300', 4, 500000),
	(74, '7400', 4, 500000),
	(75, '7500', 4, 500000),
	(76, '7600', 4, 500000),
	(77, '7700', 4, 500000),
	(78, '7800', 4, 500000),
	(79, '7900', 4, 500000),
	(80, '8000', 4, 500000),
	(81, '8100', 4, 500000),
	(82, '8200', 4, 500000),
	(83, '8300', 4, 500000),
	(84, '8400', 4, 500000),
	(85, '8500', 4, 500000),
	(86, '8600', 4, 500000),
	(87, '8700', 4, 500000),
	(88, '8800', 4, 500000),
	(89, '8900', 4, 500000),
	(90, '9000', 4, 500000),
	(91, '9100', 4, 500000),
	(92, '9200', 4, 500000),
	(93, '9300', 4, 500000),
	(94, '9400', 4, 500000),
	(95, '9500', 4, 500000),
	(96, '9600', 4, 500000),
	(97, '9700', 4, 500000),
	(98, '9800', 4, 500000),
	(99, '9900', 4, 500000),
	(100, '10000', 4, 500000),
	(1, '1000', 3, 50000),
	(2, '2000', 3, 50000),
	(3, '3000', 3, 50000),
	(4, '4000', 3, 50000),
	(5, '5000', 3, 50000),
	(6, '6000', 3, 75000),
	(7, '7000', 3, 75000),
	(8, '8000', 3, 75000),
	(9, '9000', 3, 75000),
	(10, '10000', 3, 100000),
	(11, '11000', 3, 100000),
	(12, '12000', 3, 100000),
	(13, '13000', 3, 100000),
	(14, '14000', 3, 100000),
	(15, '15000', 3, 100000),
	(16, '16000', 3, 100000),
	(17, '17000', 3, 100000),
	(18, '18000', 3, 100000),
	(19, '19000', 3, 100000),
	(20, '20000', 3, 100000);

-- Dumping structure for table smurfer.users
CREATE TABLE IF NOT EXISTS `users` (
  `Id_User` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Status` varchar(50) DEFAULT 'Customer',
  `Foto` varchar(50) DEFAULT 'default2.jpg',
  PRIMARY KEY (`Id_User`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.users: ~8 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`Id_User`, `Username`, `Email`, `Password`, `Status`, `Foto`) VALUES
	(1, 'Lutfi ', 'lutfi3522@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(2, 'Axel', 'axel123@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(3, 'fahri', 'fahri123@gmail.com', '123', 'Customer', 'default2.jpg'),
	(4, 'Egi', 'egi123@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(6, 'Phyyy', 'lutfi123@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(9, 'Pii', '123@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(10, 'Gilang', 'gilang@gmail.com', '123', 'Worker', 'profile.jpeg'),
	(11, 'ariq', 'ariq@gmail.com', '123', 'Worker', 'profile.jpeg');

-- Dumping structure for table smurfer.workers
CREATE TABLE IF NOT EXISTS `workers` (
  `Id_Worker` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) DEFAULT NULL,
  `Id_Game` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_Worker`),
  KEY `FK_workers_users` (`Id_User`),
  KEY `FK_workers_game` (`Id_Game`),
  CONSTRAINT `FK_workers_game` FOREIGN KEY (`Id_Game`) REFERENCES `game` (`Id_Game`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_workers_users` FOREIGN KEY (`Id_User`) REFERENCES `users` (`Id_User`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table smurfer.workers: ~7 rows (approximately)
DELETE FROM `workers`;
INSERT INTO `workers` (`Id_Worker`, `Id_User`, `Id_Game`) VALUES
	(1, 1, 2),
	(2, 2, 6),
	(3, 4, 5),
	(4, 6, 2),
	(5, 11, 2),
	(6, 9, 4),
	(7, 10, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
