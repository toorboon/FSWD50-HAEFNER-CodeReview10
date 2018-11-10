CREATE DATABASE  IF NOT EXISTS `cr10_haefner_marco_biglibrary` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `cr10_haefner_marco_biglibrary`;
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: cr10_haefner_marco_biglibrary
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `media_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Christian Wenzel',1),(2,'Johann Wolfgang von Goethe',2),(3,'Ernst Cassirer',3),(4,'Michael Stürmer',4),(5,'Gustave Le Bon',5),(6,'Erich Fromm',6),(7,'Friedrich Nietzsche',7),(8,'George Orwell',8),(9,'John Ralston Saul',9),(10,'Antoine de Saint-Exupery',10);
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `image` varchar(555) CHARACTER SET utf8 DEFAULT NULL,
  `isbn` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(555) CHARACTER SET utf8 DEFAULT NULL,
  `publish_date` date DEFAULT NULL,
  `type` varchar(45) CHARACTER SET utf8 NOT NULL,
  `status` varchar(45) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'PHP 7 und MySQL: Von den Grundlagen bis zur professionellen Programmierung','img/php7.jpg','3836240823','Das Buch für amibitionierte Einsteiger und fortgeschrittene Entwickler, die umfangreiches Grundwissen in der Datenbankentwicklung und Programmierung mit PHP erhalten möchten.','2016-04-25','book','available'),(2,'Die Leiden des jungen Werther','img/goethe.jpg','3938484152','Eine ergreifende Erzählung von Liebe, Jugend und Schmerz.','2005-03-31','Book','available'),(3,'Philosophie der symbolischen Formen: Erster Teil: Die Sprache','img/cassirer.jpg','3787319530','Die dreibändige \"Philosophie der symbolischen Formen\" ist das herausragende Werk, in dem Cassirer die Transformation der traditionellen Transzendentalphilosophie zur Kulturphilosophie vollzog.','2010-03-01','Book','available'),(4,'Der Aufstand der Massen','img/ortega.jpg','3421045771','Der feinsinnige Essay des spanischen Kulturphilosophen, 1930 erstmals veröffentlicht und seither in viele Sprachen übersetzt, zählt zu den epochalen Büchern des 20. Jahrhunderts.','2012-05-21','Book','available'),(5,'Psychologie der Massen','img/psychologie.jpg','3868200266','Sein berühmtes Werk Psychologie der Massen übte einen nachhaltigen Einfl uss in der Wissenschaft und praktischen Politik aus.','2009-04-01','Book','available'),(6,'Die Kunst des Liebens','img/erich.jpg','3717560026','Wie lässt sich in einer Zeit der Schnelllebigkeit und der Vereinzelung die ersehnte innige Verbundenheit zwischen zwei Menschen erreichen?','2016-03-14','Book','available'),(7,'Also sprach Zarathustra','img/zara.jpg','3868200509','Mit seiner Unruhe und gottlosen Leidenschaft wirkt es über alle Dogmen und Religionen hinweg gerade im 21. Jahrhundert aktueller denn je.','2011-03-10','Book','available'),(8,'Animal Farm','img/animal.jpg','B01K90ASDO','Some are more equal than others...','2013-03-01','Book','available'),(9,'The Collapse of Globalism','img/global.jpg','B01K934OE0','Globalization and ideology.','2009-01-06','Book','available'),(10,'Der Kleine Prinz','img/prince.jpg','3730602292','Das moderne Märchen berührt mit seinem Plädoyer für Menschlichkeit Leserinnen und Leser jeden Alters und wurde vom Autor selbst mit Illustrationen versehen.','2015-02-05','Book','available');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `size` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `media_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
INSERT INTO `publisher` VALUES (1,'Rheinwerk Computing','Rheinwerkallee 4, 53227, Bonn','big',1),(2,'Anaconda','Fernkorngasse 10, 1210, Wien','Large',2),(3,'Philosophische Bibliothek','Horstgasse 1, 1210, Wien','Medium',3),(4,'Deutsche Verlags-Anstalt','Peterstraße 1, 1210, Wien','Small',4),(5,'Nikol','Güntherzugstraße 11, 1210, Wien','Large',5),(6,'Manesse Verlag','Heinzweg 1, 1210, Wien','Small',6),(7,'Horst Wald Verlag','Horstgasse 165, 1210, Wien','Large',7),(8,'Penguin Classics','Peters street 1, 265-205, London','Large',8),(9,'Atlantic','Managers Street 1, E14 9NY, London','Large',9),(10,'Anda Verlag','Mariannengraben 1, 1210, Wien','Medium',10);
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-10 14:28:41
