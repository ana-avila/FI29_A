-- MySQL dump 10.16  Distrib 10.1.40-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: kursplanung
-- ------------------------------------------------------
-- Server version	10.1.40-MariaDB

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
-- Current Database: `kursplanung`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `kursplanung` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kursplanung`;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `admindid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vorname` varchar(100) NOT NULL,
  `nachname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwhash` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  PRIMARY KEY (`admindid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kurse`
--

DROP TABLE IF EXISTS `kurse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kurse` (
  `kursid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `klassenname` varchar(100) NOT NULL,
  `startdatum` date NOT NULL,
  `kursvorlageid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`kursid`),
  KEY `kursvorlageid` (`kursvorlageid`),
  CONSTRAINT `kurse_ibfk_1` FOREIGN KEY (`kursvorlageid`) REFERENCES `kursvorlage` (`kursvorlageid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurse`
--

LOCK TABLES `kurse` WRITE;
/*!40000 ALTER TABLE `kurse` DISABLE KEYS */;
INSERT INTO `kurse` VALUES (2,'Klasse1','2020-12-01',1),(3,'Klasse2','2020-12-01',1),(4,'Klasse3','2021-01-01',1),(5,'Klasse4','2021-01-01',1),(6,'Klasse5','2021-02-01',1);
/*!40000 ALTER TABLE `kurse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kurseurlaub`
--

DROP TABLE IF EXISTS `kurseurlaub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kurseurlaub` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kursid` int(10) unsigned NOT NULL,
  `urlaubsstart` date NOT NULL,
  `urlaubende` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kursid` (`kursid`),
  CONSTRAINT `kurseurlaub_ibfk_1` FOREIGN KEY (`kursid`) REFERENCES `kurse` (`kursid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurseurlaub`
--

LOCK TABLES `kurseurlaub` WRITE;
/*!40000 ALTER TABLE `kurseurlaub` DISABLE KEYS */;
/*!40000 ALTER TABLE `kurseurlaub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kurstrainer`
--

DROP TABLE IF EXISTS `kurstrainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kurstrainer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kursid` int(10) unsigned NOT NULL,
  `trainerid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kursid` (`kursid`),
  KEY `trainerid` (`trainerid`),
  CONSTRAINT `kurstrainer_ibfk_1` FOREIGN KEY (`kursid`) REFERENCES `kurse` (`kursid`),
  CONSTRAINT `kurstrainer_ibfk_2` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kurstrainer`
--

LOCK TABLES `kurstrainer` WRITE;
/*!40000 ALTER TABLE `kurstrainer` DISABLE KEYS */;
/*!40000 ALTER TABLE `kurstrainer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursvorlage`
--

DROP TABLE IF EXISTS `kursvorlage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kursvorlage` (
  `kursvorlageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kursvorlagenname` varchar(100) NOT NULL,
  `description` text,
  `dauer` int(11) NOT NULL,
  PRIMARY KEY (`kursvorlageid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursvorlage`
--

LOCK TABLES `kursvorlage` WRITE;
/*!40000 ALTER TABLE `kursvorlage` DISABLE KEYS */;
INSERT INTO `kursvorlage` VALUES (1,'kursvorlage1','DESCRIPTION1',0),(2,'kursvorlage2','DESCRIPTION2',0),(3,'kursvorlage3','DESCRIPTION3',0),(4,'kursvorlage4','DESCRIPTION4',0),(5,'kursvorlage5','DESCRIPTION5',0);
/*!40000 ALTER TABLE `kursvorlage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursvorlagemodule`
--

DROP TABLE IF EXISTS `kursvorlagemodule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kursvorlagemodule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kursvorlageid` int(10) unsigned NOT NULL,
  `modulid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kursvorlageid` (`kursvorlageid`),
  KEY `modulid` (`modulid`),
  CONSTRAINT `kursvorlagemodule_ibfk_1` FOREIGN KEY (`kursvorlageid`) REFERENCES `kursvorlage` (`kursvorlageid`),
  CONSTRAINT `kursvorlagemodule_ibfk_2` FOREIGN KEY (`modulid`) REFERENCES `modul` (`modulid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursvorlagemodule`
--

LOCK TABLES `kursvorlagemodule` WRITE;
/*!40000 ALTER TABLE `kursvorlagemodule` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursvorlagemodule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lernfelder`
--

DROP TABLE IF EXISTS `lernfelder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lernfelder` (
  `lernfeldid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lernfeldname` varchar(100) NOT NULL,
  `description` text,
  `dauer` int(11) DEFAULT NULL,
  PRIMARY KEY (`lernfeldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lernfelder`
--

LOCK TABLES `lernfelder` WRITE;
/*!40000 ALTER TABLE `lernfelder` DISABLE KEYS */;
/*!40000 ALTER TABLE `lernfelder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lernfelderschwerpunktthemen`
--

DROP TABLE IF EXISTS `lernfelderschwerpunktthemen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lernfelderschwerpunktthemen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lernfeldid` int(10) unsigned NOT NULL,
  `schwerpunktthemenid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lernfeldid` (`lernfeldid`),
  KEY `schwerpunktthemenid` (`schwerpunktthemenid`),
  CONSTRAINT `lernfelderschwerpunktthemen_ibfk_1` FOREIGN KEY (`lernfeldid`) REFERENCES `lernfelder` (`lernfeldid`),
  CONSTRAINT `lernfelderschwerpunktthemen_ibfk_2` FOREIGN KEY (`schwerpunktthemenid`) REFERENCES `schwerpunktthemen` (`schwerpunktthemenid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lernfelderschwerpunktthemen`
--

LOCK TABLES `lernfelderschwerpunktthemen` WRITE;
/*!40000 ALTER TABLE `lernfelderschwerpunktthemen` DISABLE KEYS */;
/*!40000 ALTER TABLE `lernfelderschwerpunktthemen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modul`
--

DROP TABLE IF EXISTS `modul`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modul` (
  `modulid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulname` varchar(100) NOT NULL,
  `dauerid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`modulid`),
  KEY `dauerid` (`dauerid`),
  CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`dauerid`) REFERENCES `moduldauer` (`dauerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modul`
--

LOCK TABLES `modul` WRITE;
/*!40000 ALTER TABLE `modul` DISABLE KEYS */;
/*!40000 ALTER TABLE `modul` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moduldauer`
--

DROP TABLE IF EXISTS `moduldauer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moduldauer` (
  `dauerid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dauer` int(11) NOT NULL,
  PRIMARY KEY (`dauerid`),
  UNIQUE KEY `dauer` (`dauer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moduldauer`
--

LOCK TABLES `moduldauer` WRITE;
/*!40000 ALTER TABLE `moduldauer` DISABLE KEYS */;
/*!40000 ALTER TABLE `moduldauer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modullernfelder`
--

DROP TABLE IF EXISTS `modullernfelder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modullernfelder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modulid` int(10) unsigned NOT NULL,
  `lernfeldid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `modulid` (`modulid`),
  KEY `lernfeldid` (`lernfeldid`),
  CONSTRAINT `modullernfelder_ibfk_1` FOREIGN KEY (`modulid`) REFERENCES `modul` (`modulid`),
  CONSTRAINT `modullernfelder_ibfk_2` FOREIGN KEY (`lernfeldid`) REFERENCES `lernfelder` (`lernfeldid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modullernfelder`
--

LOCK TABLES `modullernfelder` WRITE;
/*!40000 ALTER TABLE `modullernfelder` DISABLE KEYS */;
/*!40000 ALTER TABLE `modullernfelder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schwerpunktthemen`
--

DROP TABLE IF EXISTS `schwerpunktthemen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schwerpunktthemen` (
  `schwerpunktthemenid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `schwerpunktthemenname` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`schwerpunktthemenid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schwerpunktthemen`
--

LOCK TABLES `schwerpunktthemen` WRITE;
/*!40000 ALTER TABLE `schwerpunktthemen` DISABLE KEYS */;
/*!40000 ALTER TABLE `schwerpunktthemen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainer` (
  `trainerid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vorname` varchar(100) NOT NULL,
  `nachname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`trainerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainer`
--

LOCK TABLES `trainer` WRITE;
/*!40000 ALTER TABLE `trainer` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainerlernfelder`
--

DROP TABLE IF EXISTS `trainerlernfelder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainerlernfelder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trainerid` int(10) unsigned NOT NULL,
  `lernfeldid` int(10) unsigned NOT NULL,
  `lernfeldtyp` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lernfeldid` (`lernfeldid`),
  KEY `trainerid` (`trainerid`),
  CONSTRAINT `trainerlernfelder_ibfk_1` FOREIGN KEY (`lernfeldid`) REFERENCES `lernfelder` (`lernfeldid`),
  CONSTRAINT `trainerlernfelder_ibfk_2` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainerlernfelder`
--

LOCK TABLES `trainerlernfelder` WRITE;
/*!40000 ALTER TABLE `trainerlernfelder` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainerlernfelder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainerschwerpunktthemen`
--

DROP TABLE IF EXISTS `trainerschwerpunktthemen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainerschwerpunktthemen` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trainerid` int(10) unsigned NOT NULL,
  `schwerpunktthemenid` int(10) unsigned NOT NULL,
  `schwerpunktthementyp` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `trainerid` (`trainerid`),
  KEY `schwerpunktthemenid` (`schwerpunktthemenid`),
  CONSTRAINT `trainerschwerpunktthemen_ibfk_1` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`),
  CONSTRAINT `trainerschwerpunktthemen_ibfk_2` FOREIGN KEY (`schwerpunktthemenid`) REFERENCES `schwerpunktthemen` (`schwerpunktthemenid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainerschwerpunktthemen`
--

LOCK TABLES `trainerschwerpunktthemen` WRITE;
/*!40000 ALTER TABLE `trainerschwerpunktthemen` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainerschwerpunktthemen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainerurlaub`
--

DROP TABLE IF EXISTS `trainerurlaub`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainerurlaub` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trainerid` int(10) unsigned NOT NULL,
  `urlaubstart` date NOT NULL,
  `urlaubende` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainerid` (`trainerid`),
  CONSTRAINT `trainerurlaub_ibfk_1` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainerurlaub`
--

LOCK TABLES `trainerurlaub` WRITE;
/*!40000 ALTER TABLE `trainerurlaub` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainerurlaub` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainerzeitzuweisung`
--

DROP TABLE IF EXISTS `trainerzeitzuweisung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainerzeitzuweisung` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `trainerid` int(10) unsigned NOT NULL,
  `kursid` int(10) unsigned NOT NULL,
  `zeitzuweisungid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `zeitzuweisungid` (`zeitzuweisungid`),
  KEY `trainerid` (`trainerid`),
  CONSTRAINT `trainerzeitzuweisung_ibfk_1` FOREIGN KEY (`zeitzuweisungid`) REFERENCES `zeitzuweisung` (`zeitzuweisungid`),
  CONSTRAINT `trainerzeitzuweisung_ibfk_2` FOREIGN KEY (`trainerid`) REFERENCES `trainer` (`trainerid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainerzeitzuweisung`
--

LOCK TABLES `trainerzeitzuweisung` WRITE;
/*!40000 ALTER TABLE `trainerzeitzuweisung` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainerzeitzuweisung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_kursstartdatum`
--

DROP TABLE IF EXISTS `v_kursstartdatum`;
/*!50001 DROP VIEW IF EXISTS `v_kursstartdatum`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_kursstartdatum` (
  `Klassenname` tinyint NOT NULL,
  `Startdatum` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `zeitzuweisung`
--

DROP TABLE IF EXISTS `zeitzuweisung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zeitzuweisung` (
  `zeitzuweisungid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `startdatum` date NOT NULL,
  `enddatum` date DEFAULT NULL,
  PRIMARY KEY (`zeitzuweisungid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zeitzuweisung`
--

LOCK TABLES `zeitzuweisung` WRITE;
/*!40000 ALTER TABLE `zeitzuweisung` DISABLE KEYS */;
/*!40000 ALTER TABLE `zeitzuweisung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'kursplanung'
--

--
-- Current Database: `kursplanung`
--

USE `kursplanung`;

--
-- Final view structure for view `v_kursstartdatum`
--

/*!50001 DROP TABLE IF EXISTS `v_kursstartdatum`*/;
/*!50001 DROP VIEW IF EXISTS `v_kursstartdatum`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = cp850 */;
/*!50001 SET character_set_results     = cp850 */;
/*!50001 SET collation_connection      = cp850_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_kursstartdatum` AS select `kurse`.`klassenname` AS `Klassenname`,`kurse`.`startdatum` AS `Startdatum` from `kurse` group by `kurse`.`klassenname` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-24 10:00:28
