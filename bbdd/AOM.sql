CREATE DATABASE  IF NOT EXISTS `AOM` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `AOM`;
-- MySQL dump 10.13  Distrib 8.0.13, for macos10.14 (x86_64)
--
-- Host: localhost    Database: AOM
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Community`
--

DROP TABLE IF EXISTS `Community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Community` (
  `communityID` int(11) NOT NULL AUTO_INCREMENT,
  `communityName` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `communityType` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`communityID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Community`
--

LOCK TABLES `Community` WRITE;
/*!40000 ALTER TABLE `Community` DISABLE KEYS */;
/*!40000 ALTER TABLE `Community` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CommunityPost`
--

DROP TABLE IF EXISTS `CommunityPost`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CommunityPost` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `postName` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `replyID` int(11) NOT NULL,
  `postDate` date DEFAULT NULL,
  `communityID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`postID`),
  KEY `FK_Community` (`communityID`),
  KEY `FK_Users` (`userID`),
  CONSTRAINT `FK_Community` FOREIGN KEY (`communityID`) REFERENCES `Community` (`communityID`),
  CONSTRAINT `FK_Users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CommunityPost`
--

LOCK TABLES `CommunityPost` WRITE;
/*!40000 ALTER TABLE `CommunityPost` DISABLE KEYS */;
/*!40000 ALTER TABLE `CommunityPost` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CommunityVote`
--

DROP TABLE IF EXISTS `CommunityVote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `CommunityVote` (
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  KEY `FK_CommunityPost` (`postID`),
  KEY `FK_CommunityUsers` (`userID`),
  CONSTRAINT `FK_CommunityPost` FOREIGN KEY (`postID`) REFERENCES `CommunityPost` (`postID`),
  CONSTRAINT `FK_CommunityUsers` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CommunityVote`
--

LOCK TABLES `CommunityVote` WRITE;
/*!40000 ALTER TABLE `CommunityVote` DISABLE KEYS */;
/*!40000 ALTER TABLE `CommunityVote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FeedBack`
--

DROP TABLE IF EXISTS `FeedBack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `FeedBack` (
  `feedbackID` int(11) NOT NULL AUTO_INCREMENT,
  `vote` int(11) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`feedbackID`),
  KEY `FK_userFeedBack` (`userID`),
  CONSTRAINT `FK_userFeedBack` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FeedBack`
--

LOCK TABLES `FeedBack` WRITE;
/*!40000 ALTER TABLE `FeedBack` DISABLE KEYS */;
/*!40000 ALTER TABLE `FeedBack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notifications`
--

DROP TABLE IF EXISTS `Notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Notifications` (
  `notificationsID` int(11) NOT NULL AUTO_INCREMENT,
  `notificationName` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `notificationType` varchar(255) DEFAULT NULL,
  `subscriptionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`notificationsID`),
  KEY `FK_subscriptionNotifications` (`subscriptionID`),
  CONSTRAINT `FK_subscriptionNotifications` FOREIGN KEY (`subscriptionID`) REFERENCES `Subscription` (`subscriptionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notifications`
--

LOCK TABLES `Notifications` WRITE;
/*!40000 ALTER TABLE `Notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `Notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Subscription`
--

DROP TABLE IF EXISTS `Subscription`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Subscription` (
  `subscriptionID` int(11) NOT NULL AUTO_INCREMENT,
  `subscriptionName` varchar(255) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `cycle` int(11) DEFAULT NULL,
  `firstBill` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `remainMe` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`subscriptionID`),
  KEY `FK_userSubscription` (`userID`),
  CONSTRAINT `FK_userSubscription` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Subscription`
--

LOCK TABLES `Subscription` WRITE;
/*!40000 ALTER TABLE `Subscription` DISABLE KEYS */;
INSERT INTO `Subscription` VALUES (1,'Spotify','Musica ',12,'2012-12-12',15,1,8,2),(2,'Netflix','Home',2,'2004-11-02',15,2,2.4,1),(23,'Movistar','Home',2,'2004-11-02',15,2,6,1),(24,'Itunes','Home',2,'2004-11-02',12,2,87,1),(25,'HBO','Film',2,'2004-11-02',12,2,74,1),(26,'Orange','Phone',2,'2004-11-02',12,2,32,1),(27,'Amazon','Music',2,'2018-01-17',12,2,102,1);
/*!40000 ALTER TABLE `Subscription` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `Users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `interfaceLanguage` varchar(100) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Pepe','Cazuela','2011-12-08','ot.trivino.calsina@gmail.com','1234','Catalan',1),(2,'Loca','Cazuela','2001-09-09','marc.roig@gmail.com','1234','Catalan',1);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-21 13:07:47
