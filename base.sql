-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.6.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para edibcac_distribucion_android
CREATE DATABASE IF NOT EXISTS `edibcac_distribucion_android` /*!40100 DEFAULT CHARACTER SET ucs2 COLLATE ucs2_spanish_ci */;
USE `edibcac_distribucion_android`;


-- Volcando estructura para tabla edibcac_distribucion_android.aplication
CREATE TABLE IF NOT EXISTS `aplication` (
  `appId` int(11) NOT NULL AUTO_INCREMENT,
  `appName` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `appDescription` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `appImage` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `appRoute` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `appLaboratory` int(11) NOT NULL,
  `typeId` int(11) NOT NULL,
  PRIMARY KEY (`appId`),
  UNIQUE KEY `appName` (`appName`),
  UNIQUE KEY `appRoute` (`appRoute`),
  KEY `appLaboratory` (`appLaboratory`),
  KEY `appType` (`typeId`),
  CONSTRAINT `appLaboratory` FOREIGN KEY (`appLaboratory`) REFERENCES `laboratory` (`labId`),
  CONSTRAINT `appType` FOREIGN KEY (`typeId`) REFERENCES `typeaplication` (`typeId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- Volcando datos para la tabla edibcac_distribucion_android.aplication: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `aplication` DISABLE KEYS */;
INSERT INTO `aplication` (`appId`, `appName`, `appDescription`, `appImage`, `appRoute`, `appLaboratory`, `typeId`) VALUES
	(7, 'calculadora tecnofarma', 'calculadora de tecnofarma mexico', 'images', 'apk/', 1, 1),
	(8, 'calculadora sanofi', 'calculadora sanofi', 'images', 'apk/sanofi', 1, 1);
/*!40000 ALTER TABLE `aplication` ENABLE KEYS */;


-- Volcando estructura para tabla edibcac_distribucion_android.laboratory
CREATE TABLE IF NOT EXISTS `laboratory` (
  `labId` int(11) NOT NULL AUTO_INCREMENT,
  `labName` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `labDescription` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  PRIMARY KEY (`labId`),
  UNIQUE KEY `labName` (`labName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- Volcando datos para la tabla edibcac_distribucion_android.laboratory: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `laboratory` DISABLE KEYS */;
INSERT INTO `laboratory` (`labId`, `labName`, `labDescription`) VALUES
	(1, 'Tecnofarma', 'tecnofarma laboratorios mexico'),
	(2, 'Bristol', 'bristol de venezuela');
/*!40000 ALTER TABLE `laboratory` ENABLE KEYS */;


-- Volcando estructura para tabla edibcac_distribucion_android.roll
CREATE TABLE IF NOT EXISTS `roll` (
  `rolId` int(11) NOT NULL AUTO_INCREMENT,
  `rolName` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `rolDescription` varchar(70) COLLATE ucs2_spanish_ci NOT NULL,
  PRIMARY KEY (`rolId`),
  UNIQUE KEY `rolName` (`rolName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- Volcando datos para la tabla edibcac_distribucion_android.roll: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `roll` DISABLE KEYS */;
INSERT INTO `roll` (`rolId`, `rolName`, `rolDescription`) VALUES
	(1, 'Admin', 'Administrador - Todos los permisos.'),
	(2, 'Comercial', 'Comercial - Ventas'),
	(3, 'Gerente', 'Gerente de producto');
/*!40000 ALTER TABLE `roll` ENABLE KEYS */;


-- Volcando estructura para tabla edibcac_distribucion_android.typeaplication
CREATE TABLE IF NOT EXISTS `typeaplication` (
  `typeId` int(11) NOT NULL AUTO_INCREMENT,
  `typeName` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `typeDescription` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  PRIMARY KEY (`typeId`),
  UNIQUE KEY `typeName` (`typeName`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- Volcando datos para la tabla edibcac_distribucion_android.typeaplication: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `typeaplication` DISABLE KEYS */;
INSERT INTO `typeaplication` (`typeId`, `typeName`, `typeDescription`) VALUES
	(1, 'Calculadora', 'calculadora'),
	(2, 'atlas', 'atlas anatomico');
/*!40000 ALTER TABLE `typeaplication` ENABLE KEYS */;


-- Volcando estructura para tabla edibcac_distribucion_android.user
CREATE TABLE IF NOT EXISTS `user` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `userMail` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `userPassword` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  `userState` bit(1) NOT NULL,
  `rollId` int(11) NOT NULL,
  `userDateCreate` varchar(50) COLLATE ucs2_spanish_ci NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userMail` (`userMail`),
  KEY `rollId` (`rollId`),
  CONSTRAINT `rollId` FOREIGN KEY (`rollId`) REFERENCES `roll` (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- Volcando datos para la tabla edibcac_distribucion_android.user: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`userId`, `userName`, `userMail`, `userPassword`, `userState`, `rollId`, `userDateCreate`) VALUES
	(2, 'SebastianCH', 'sebass7@live.com', '1022399551SCH', b'1', 1, '2016/04/05'),
	(66, '111', '111', '111', b'0', 1, '63.000000000000000000'),
	(67, 'dsadas', 'sasss@ssss.com', '121212', b'0', 1, '2016/04/08'),
	(68, 'asasasas', 'sassssss@ssss.com', '121212', b'1', 2, '2016/04/08'),
	(69, 'asasasas', 'oiji,uju8', '121212', b'1', 2, '2016/04/08');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Volcando estructura para tabla edibcac_distribucion_android.useraplication
CREATE TABLE IF NOT EXISTS `useraplication` (
  `UAid` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `appId` int(11) NOT NULL,
  `UAdateCreate` date NOT NULL,
  `UAdateFinish` date NOT NULL,
  `UAstate` bit(1) NOT NULL,
  PRIMARY KEY (`UAid`),
  KEY `uaUser` (`UserId`),
  KEY `uaApp` (`appId`),
  CONSTRAINT `uaApp` FOREIGN KEY (`appId`) REFERENCES `aplication` (`appId`),
  CONSTRAINT `uaUser` FOREIGN KEY (`UserId`) REFERENCES `user` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ucs2 COLLATE=ucs2_spanish_ci;

-- Volcando datos para la tabla edibcac_distribucion_android.useraplication: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `useraplication` DISABLE KEYS */;
INSERT INTO `useraplication` (`UAid`, `UserId`, `appId`, `UAdateCreate`, `UAdateFinish`, `UAstate`) VALUES
	(1, 2, 7, '2016-04-06', '2016-04-11', b'1'),
	(2, 2, 8, '2016-04-03', '2016-04-04', b'1');
/*!40000 ALTER TABLE `useraplication` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
