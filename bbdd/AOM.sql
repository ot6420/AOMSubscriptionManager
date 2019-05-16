-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Temps de generació: 16-05-2019 a les 12:48:58
-- Versió del servidor: 10.1.36-MariaDB
-- Versió de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `AOM`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `Community`
--

CREATE TABLE `Community` (
  `communityID` int(11) NOT NULL,
  `communityName` varchar(100) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `communityType` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `CommunityPost`
--

CREATE TABLE `CommunityPost` (
  `postID` int(11) NOT NULL,
  `postName` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `replyID` int(11) NOT NULL,
  `postDate` date DEFAULT NULL,
  `communityID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `CommunityVote`
--

CREATE TABLE `CommunityVote` (
  `userID` int(11) NOT NULL,
  `postID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `Cycle`
--

CREATE TABLE `Cycle` (
  `cycleID` int(11) NOT NULL,
  `cycle` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Bolcament de dades per a la taula `Cycle`
--

INSERT INTO `Cycle` (`cycleID`, `cycle`) VALUES
(1, 'Semanal'),
(2, 'Mensual'),
(3, 'Trimestral'),
(4, 'Semestral'),
(5, 'Anual');

-- --------------------------------------------------------

--
-- Estructura de la taula `FeedBack`
--

CREATE TABLE `FeedBack` (
  `feedbackID` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `FeedBack`
--

INSERT INTO `FeedBack` (`feedbackID`, `vote`, `description`, `userID`) VALUES
(15, 5, 'pepe', 37),
(16, 4, 'Bastante bien', 37);

-- --------------------------------------------------------

--
-- Estructura de la taula `Notifications`
--

CREATE TABLE `Notifications` (
  `notificationsID` int(11) NOT NULL,
  `notificationName` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `notificationType` varchar(255) NOT NULL,
  `subscriptionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de la taula `Subscription`
--

CREATE TABLE `Subscription` (
  `subscriptionID` int(11) NOT NULL,
  `subscriptionName` varchar(255) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `cycle` varchar(10) NOT NULL,
  `firstBill` date NOT NULL,
  `remainMe` int(11) NOT NULL,
  `price` double NOT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `Subscription`
--

INSERT INTO `Subscription` (`subscriptionID`, `subscriptionName`, `description`, `cycle`, `firstBill`, `remainMe`, `price`, `userID`) VALUES
(16, 'netflix', 'Home1', '3', '2008-02-01', 1, 20, 37),
(17, 'spotify', 'Familia', '3', '1997-09-28', 2, 15, 37),
(18, 'playstationplus', 'Hijo', '12', '2011-01-01', 5, 60, 37),
(20, 'netflix', 'Admin Admin', '6', '2018-11-05', 5, 10, 36),
(21, 'applemusic', 'Home', '1', '2019-05-02', 1, 0, 37),
(22, 'hbo', 'Home', '1', '2019-01-01', 1, 0, 37),
(23, 'amazonprime', 'Compras', '3', '2019-05-03', 5, 10, 37),
(24, 'wuaki', 'Familia', '6', '2019-05-08', 7, 1, 37),
(25, 'dazn', 'F1', '24', '2019-05-08', 5, 10, 37),
(26, 'evernote', 'Notas', '6', '2019-05-07', 5, 40, 37),
(27, 'twitch', 'Salono', '6', '2019-05-01', 5, 30, 37),
(28, 'icloud', 'La nuebe que manda', '3', '2019-05-02', 5, 10, 37),
(29, 'dropbox', 'Archivos', '6', '2019-05-01', 2, 2, 37),
(31, 'netflix', 'Mio', '3', '2009-11-05', 5, 10, 39),
(32, 'twitch', 'Juegos', '6', '2019-05-17', 1, 15, 36),
(33, 'applemusic', 'Home', '6', '2019-05-02', 2, 10, 39);

-- --------------------------------------------------------

--
-- Estructura de la taula `Users`
--

CREATE TABLE `Users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birthDate` date NOT NULL,
  `email` varchar(200) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `userType` int(11) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Bolcament de dades per a la taula `Users`
--

INSERT INTO `Users` (`userID`, `firstName`, `lastName`, `birthDate`, `email`, `pass`, `userType`, `token`) VALUES
(36, 'Admin', 'Admin1', '2018-09-14', 'admin@admin.com', 'admin', 0, NULL),
(37, 'user1', 'user user', '1997-04-21', 'user1@user.com', 'user', 1, NULL),
(39, 'user2', 'user user', '1988-04-05', 'user2@user.com', 'user', 1, NULL);

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `Community`
--
ALTER TABLE `Community`
  ADD PRIMARY KEY (`communityID`);

--
-- Índexs per a la taula `CommunityPost`
--
ALTER TABLE `CommunityPost`
  ADD PRIMARY KEY (`postID`),
  ADD KEY `FK_Community` (`communityID`),
  ADD KEY `FK_Users` (`userID`);

--
-- Índexs per a la taula `CommunityVote`
--
ALTER TABLE `CommunityVote`
  ADD KEY `FK_CommunityPost` (`postID`),
  ADD KEY `FK_CommunityUsers` (`userID`);

--
-- Índexs per a la taula `Cycle`
--
ALTER TABLE `Cycle`
  ADD PRIMARY KEY (`cycleID`);

--
-- Índexs per a la taula `FeedBack`
--
ALTER TABLE `FeedBack`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `FK_FeedbackU_idx` (`userID`);

--
-- Índexs per a la taula `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`notificationsID`),
  ADD KEY `FK_subscriptionNotifications` (`subscriptionID`);

--
-- Índexs per a la taula `Subscription`
--
ALTER TABLE `Subscription`
  ADD PRIMARY KEY (`subscriptionID`),
  ADD KEY `FK_userSubscription` (`userID`);

--
-- Índexs per a la taula `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `Community`
--
ALTER TABLE `Community`
  MODIFY `communityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `CommunityPost`
--
ALTER TABLE `CommunityPost`
  MODIFY `postID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `Cycle`
--
ALTER TABLE `Cycle`
  MODIFY `cycleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `FeedBack`
--
ALTER TABLE `FeedBack`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la taula `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `notificationsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la taula `Subscription`
--
ALTER TABLE `Subscription`
  MODIFY `subscriptionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la taula `Users`
--
ALTER TABLE `Users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `CommunityPost`
--
ALTER TABLE `CommunityPost`
  ADD CONSTRAINT `FK_Community` FOREIGN KEY (`communityID`) REFERENCES `Community` (`communityID`),
  ADD CONSTRAINT `FK_Users` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);

--
-- Restriccions per a la taula `CommunityVote`
--
ALTER TABLE `CommunityVote`
  ADD CONSTRAINT `FK_CommunityPost` FOREIGN KEY (`postID`) REFERENCES `CommunityPost` (`postID`),
  ADD CONSTRAINT `FK_CommunityUsers` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`);

--
-- Restriccions per a la taula `FeedBack`
--
ALTER TABLE `FeedBack`
  ADD CONSTRAINT `FK_FeedbackU` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restriccions per a la taula `Notifications`
--
ALTER TABLE `Notifications`
  ADD CONSTRAINT `FK_subscriptionNotifications` FOREIGN KEY (`subscriptionID`) REFERENCES `Subscription` (`subscriptionID`);

--
-- Restriccions per a la taula `Subscription`
--
ALTER TABLE `Subscription`
  ADD CONSTRAINT `FK_userSubscription` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
