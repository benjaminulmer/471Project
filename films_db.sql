-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2017 at 09:51 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `films_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acted_in`
--

CREATE TABLE IF NOT EXISTS `acted_in` (
  `actorID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL,
  `role` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE IF NOT EXISTS `actors` (
  `ID` int(11) NOT NULL,
  `someAtt` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
`ID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `year` year(4) NOT NULL,
  `organization` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE IF NOT EXISTS `directors` (
  `ID` int(11) NOT NULL,
  `someAtt` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
`ID` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `year` year(4) NOT NULL,
  `budget` int(11) NOT NULL,
  `director` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `film_nominated`
--

CREATE TABLE IF NOT EXISTS `film_nominated` (
  `filmID` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `film_won`
--

CREATE TABLE IF NOT EXISTS `film_won` (
  `filmID` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
`ID` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `sex` set('m','f') NOT NULL,
  `dateOfBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `person_nominated`
--

CREATE TABLE IF NOT EXISTS `person_nominated` (
  `personID` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `person_won`
--

CREATE TABLE IF NOT EXISTS `person_won` (
  `personID` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recommended`
--

CREATE TABLE IF NOT EXISTS `recommended` (
  `userID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `userID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sequel_to`
--

CREATE TABLE IF NOT EXISTS `sequel_to` (
  `filmID` int(11) NOT NULL,
  `sequelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `similar_films`
--

CREATE TABLE IF NOT EXISTS `similar_films` (
  `film1ID` int(11) NOT NULL,
  `film2ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trailers`
--

CREATE TABLE IF NOT EXISTS `trailers` (
  `name` varchar(32) NOT NULL,
  `filmID` int(11) NOT NULL,
  `trailer` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `passwordHash` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `watched`
--

CREATE TABLE IF NOT EXISTS `watched` (
  `userID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acted_in`
--
ALTER TABLE `acted_in`
 ADD PRIMARY KEY (`actorID`,`filmID`), ADD KEY `actorID` (`actorID`), ADD KEY `filmID` (`filmID`);

--
-- Indexes for table `actors`
--
ALTER TABLE `actors`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
 ADD PRIMARY KEY (`ID`), ADD KEY `director` (`director`);

--
-- Indexes for table `film_nominated`
--
ALTER TABLE `film_nominated`
 ADD PRIMARY KEY (`filmID`,`awardID`), ADD KEY `filmID` (`filmID`), ADD KEY `awardID` (`awardID`);

--
-- Indexes for table `film_won`
--
ALTER TABLE `film_won`
 ADD PRIMARY KEY (`filmID`,`awardID`), ADD KEY `filmID` (`filmID`), ADD KEY `awardID` (`awardID`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `person_nominated`
--
ALTER TABLE `person_nominated`
 ADD PRIMARY KEY (`personID`,`awardID`), ADD KEY `personNominatedAward` (`awardID`);

--
-- Indexes for table `person_won`
--
ALTER TABLE `person_won`
 ADD PRIMARY KEY (`personID`,`awardID`), ADD KEY `filmID` (`personID`), ADD KEY `awardID` (`awardID`);

--
-- Indexes for table `recommended`
--
ALTER TABLE `recommended`
 ADD PRIMARY KEY (`userID`,`filmID`), ADD KEY `recommendedFilm` (`filmID`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
 ADD PRIMARY KEY (`userID`,`filmID`), ADD KEY `userID` (`userID`), ADD KEY `filmID` (`filmID`);

--
-- Indexes for table `sequel_to`
--
ALTER TABLE `sequel_to`
 ADD PRIMARY KEY (`filmID`,`sequelID`), ADD KEY `sequelSequel` (`sequelID`);

--
-- Indexes for table `similar_films`
--
ALTER TABLE `similar_films`
 ADD PRIMARY KEY (`film1ID`,`film2ID`), ADD KEY `similarFilm2` (`film2ID`);

--
-- Indexes for table `trailers`
--
ALTER TABLE `trailers`
 ADD PRIMARY KEY (`name`,`filmID`), ADD KEY `trailerFilm` (`filmID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `watched`
--
ALTER TABLE `watched`
 ADD PRIMARY KEY (`userID`,`filmID`), ADD KEY `userID` (`userID`), ADD KEY `filmID` (`filmID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acted_in`
--
ALTER TABLE `acted_in`
ADD CONSTRAINT `actedInActor` FOREIGN KEY (`actorID`) REFERENCES `actors` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `actedInFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `actors`
--
ALTER TABLE `actors`
ADD CONSTRAINT `actorsPerson` FOREIGN KEY (`ID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `directors`
--
ALTER TABLE `directors`
ADD CONSTRAINT `directorsPerson` FOREIGN KEY (`ID`) REFERENCES `actors` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `films`
--
ALTER TABLE `films`
ADD CONSTRAINT `filmsDirector` FOREIGN KEY (`director`) REFERENCES `directors` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `film_nominated`
--
ALTER TABLE `film_nominated`
ADD CONSTRAINT `filmNominatedAward` FOREIGN KEY (`awardID`) REFERENCES `awards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `filmNominatedFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `film_won`
--
ALTER TABLE `film_won`
ADD CONSTRAINT `wonAward` FOREIGN KEY (`awardID`) REFERENCES `awards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `wonFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person_nominated`
--
ALTER TABLE `person_nominated`
ADD CONSTRAINT `personNominatedAward` FOREIGN KEY (`awardID`) REFERENCES `awards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `personNominatedPerson` FOREIGN KEY (`personID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `person_won`
--
ALTER TABLE `person_won`
ADD CONSTRAINT `personWonAward` FOREIGN KEY (`awardID`) REFERENCES `awards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `personWonPerson` FOREIGN KEY (`personID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommended`
--
ALTER TABLE `recommended`
ADD CONSTRAINT `recommendedFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `recommendedUser` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
ADD CONSTRAINT `reviewFilmID` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reviewUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sequel_to`
--
ALTER TABLE `sequel_to`
ADD CONSTRAINT `sequelSequel` FOREIGN KEY (`sequelID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sequelFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `similar_films`
--
ALTER TABLE `similar_films`
ADD CONSTRAINT `similarFilm2` FOREIGN KEY (`film2ID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `similarFilm1` FOREIGN KEY (`film1ID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trailers`
--
ALTER TABLE `trailers`
ADD CONSTRAINT `trailerFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watched`
--
ALTER TABLE `watched`
ADD CONSTRAINT `watchedFilmID` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `watchedUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
