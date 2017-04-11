-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 03:53 AM
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

--
-- Dumping data for table `acted_in`
--

INSERT INTO `acted_in` (`actorID`, `filmID`, `role`) VALUES
(2, 1, 'Bruce Wayne / Batman'),
(2, 3, 'Bruce Wayne / Batman'),
(3, 1, 'the Joker'),
(4, 3, 'Emmet Brickowski'),
(5, 3, 'Wyldstyle / Lucy');

-- --------------------------------------------------------

--
-- Table structure for table `actors`
--

CREATE TABLE IF NOT EXISTS `actors` (
  `ID` int(11) NOT NULL,
  `favRole` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actors`
--

INSERT INTO `actors` (`ID`, `favRole`) VALUES
(2, NULL),
(3, NULL),
(4, NULL),
(5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
`ID` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `year` year(4) NOT NULL,
  `organization` varchar(64) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`ID`, `name`, `year`, `organization`) VALUES
(1, 'Truly Moving Picture Award', 2017, 'Heartland Film Festival'),
(2, 'Truly Moving Picture Award', 2014, 'Heartland Film Festival'),
(3, 'Favorite Movie Actor', 2014, 'Kid''s Choice Awards');

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE IF NOT EXISTS `directors` (
  `ID` int(11) NOT NULL,
  `favFilm` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `directors`
--

INSERT INTO `directors` (`ID`, `favFilm`) VALUES
(6, NULL),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
`ID` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `year` year(4) NOT NULL,
  `runtime` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `boxOffice` int(11) NOT NULL,
  `description` text NOT NULL,
  `director` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`ID`, `name`, `year`, `runtime`, `budget`, `boxOffice`, `description`, `director`) VALUES
(1, 'The Lego Batman Movie', 2017, 104, 80000000, 297300000, 'Really cool awesome movie about LEGO and Batman is in it too.', 1),
(3, 'The Lego Movie', 2014, 100, 60000000, 469200000, 'Another cool movie about LEGO. Batman is also in this one, but not as much.', 6);

-- --------------------------------------------------------

--
-- Table structure for table `film_genres`
--

CREATE TABLE IF NOT EXISTS `film_genres` (
  `filmID` int(11) NOT NULL,
  `genre` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `film_genres`
--

INSERT INTO `film_genres` (`filmID`, `genre`) VALUES
(1, 'Action'),
(1, 'Animation'),
(1, 'Comedy'),
(1, 'Family'),
(3, 'Action'),
(3, 'Animation'),
(3, 'Comedy'),
(3, 'Family');

-- --------------------------------------------------------

--
-- Table structure for table `nominated`
--

CREATE TABLE IF NOT EXISTS `nominated` (
  `filmID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nominated`
--

INSERT INTO `nominated` (`filmID`, `personID`, `awardID`) VALUES
(3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE IF NOT EXISTS `persons` (
`ID` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `dateOfDeath` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`ID`, `name`, `dateOfBirth`, `dateOfDeath`) VALUES
(1, 'Chris McKay', '0000-00-00', '0000-00-00'),
(2, 'Will Arnett', '1970-05-04', '0000-00-00'),
(3, 'Zach Galifianakis', '1969-10-01', '0000-00-00'),
(4, 'Chris Pratt', '1979-06-21', '0000-00-00'),
(5, 'Elizabeth Banks', '1974-02-10', '0000-00-00'),
(6, 'Phil Lord', '1975-07-12', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `recommended`
--

CREATE TABLE IF NOT EXISTS `recommended` (
  `userID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recommended`
--

INSERT INTO `recommended` (`userID`, `filmID`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `userID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`userID`, `filmID`, `rating`, `review`) VALUES
(1, 1, 8, 'Cool movie. I liked it a lot :D'),
(2, 3, 9, 'Good movie, would watch again.');

-- --------------------------------------------------------

--
-- Table structure for table `sequel_to`
--

CREATE TABLE IF NOT EXISTS `sequel_to` (
  `baseFilmID` int(11) NOT NULL,
  `sequelID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sequel_to`
--

INSERT INTO `sequel_to` (`baseFilmID`, `sequelID`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `similar_films`
--

CREATE TABLE IF NOT EXISTS `similar_films` (
  `film1ID` int(11) NOT NULL,
  `film2ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `similar_films`
--

INSERT INTO `similar_films` (`film1ID`, `film2ID`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `studios`
--

CREATE TABLE IF NOT EXISTS `studios` (
`ID` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `founded` date NOT NULL,
  `headquarters` varchar(64) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `studios`
--

INSERT INTO `studios` (`ID`, `name`, `founded`, `headquarters`) VALUES
(1, 'Warner Bros. Animation', '1980-01-01', 'Burbank, California');

-- --------------------------------------------------------

--
-- Table structure for table `trailers`
--

CREATE TABLE IF NOT EXISTS `trailers` (
  `name` varchar(64) NOT NULL,
  `filmID` int(11) NOT NULL,
  `trailer` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trailers`
--

INSERT INTO `trailers` (`name`, `filmID`, `trailer`) VALUES
('Trailer 1', 1, 'https://www.youtube.com/watch?v=ijZDOyldztw');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`ID` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `passwordHash` varchar(64) NOT NULL,
  `moderator` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `passwordHash`, `moderator`) VALUES
(1, 'averageUser', 'password', 0),
(2, 'moderator', 'password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `watched`
--

CREATE TABLE IF NOT EXISTS `watched` (
  `userID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `watched`
--

INSERT INTO `watched` (`userID`, `filmID`) VALUES
(1, 1),
(1, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `won`
--

CREATE TABLE IF NOT EXISTS `won` (
  `filmID` int(11) NOT NULL,
  `personID` int(11) NOT NULL,
  `awardID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `won`
--

INSERT INTO `won` (`filmID`, `personID`, `awardID`) VALUES
(1, 1, 1),
(3, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `worked_on`
--

CREATE TABLE IF NOT EXISTS `worked_on` (
  `studioID` int(11) NOT NULL,
  `filmID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worked_on`
--

INSERT INTO `worked_on` (`studioID`, `filmID`) VALUES
(1, 1),
(1, 3);

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
 ADD PRIMARY KEY (`ID`), ADD KEY `favRole` (`favRole`);

--
-- Indexes for table `awards`
--
ALTER TABLE `awards`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
 ADD PRIMARY KEY (`ID`), ADD KEY `favFilm` (`favFilm`);

--
-- Indexes for table `films`
--
ALTER TABLE `films`
 ADD PRIMARY KEY (`ID`), ADD KEY `director` (`director`);

--
-- Indexes for table `film_genres`
--
ALTER TABLE `film_genres`
 ADD PRIMARY KEY (`filmID`,`genre`);

--
-- Indexes for table `nominated`
--
ALTER TABLE `nominated`
 ADD PRIMARY KEY (`filmID`,`personID`,`awardID`), ADD KEY `filmID` (`filmID`), ADD KEY `awardID` (`awardID`), ADD KEY `nominatedPerson` (`personID`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `recommended`
--
ALTER TABLE `recommended`
 ADD PRIMARY KEY (`userID`,`filmID`), ADD KEY `recommendedFilm` (`filmID`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
 ADD PRIMARY KEY (`userID`,`filmID`), ADD KEY `userID` (`userID`), ADD KEY `filmID` (`filmID`);

--
-- Indexes for table `sequel_to`
--
ALTER TABLE `sequel_to`
 ADD PRIMARY KEY (`baseFilmID`,`sequelID`), ADD KEY `sequelSequel` (`sequelID`);

--
-- Indexes for table `similar_films`
--
ALTER TABLE `similar_films`
 ADD PRIMARY KEY (`film1ID`,`film2ID`), ADD KEY `similarFilm2` (`film2ID`);

--
-- Indexes for table `studios`
--
ALTER TABLE `studios`
 ADD PRIMARY KEY (`ID`);

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
-- Indexes for table `won`
--
ALTER TABLE `won`
 ADD PRIMARY KEY (`filmID`,`awardID`,`personID`), ADD KEY `filmID` (`filmID`), ADD KEY `awardID` (`awardID`), ADD KEY `wonPerson` (`personID`);

--
-- Indexes for table `worked_on`
--
ALTER TABLE `worked_on`
 ADD PRIMARY KEY (`studioID`,`filmID`), ADD KEY `workedOnFilm` (`filmID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `awards`
--
ALTER TABLE `awards`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `studios`
--
ALTER TABLE `studios`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
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
ADD CONSTRAINT `actorsFavFilm` FOREIGN KEY (`favRole`) REFERENCES `films` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `actorsPerson` FOREIGN KEY (`ID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `directors`
--
ALTER TABLE `directors`
ADD CONSTRAINT `directorsFavFilm` FOREIGN KEY (`favFilm`) REFERENCES `films` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `directorsPerson` FOREIGN KEY (`ID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `films`
--
ALTER TABLE `films`
ADD CONSTRAINT `filmsDirector` FOREIGN KEY (`director`) REFERENCES `directors` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `film_genres`
--
ALTER TABLE `film_genres`
ADD CONSTRAINT `genreFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nominated`
--
ALTER TABLE `nominated`
ADD CONSTRAINT `nominatedAward` FOREIGN KEY (`awardID`) REFERENCES `awards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nominatedFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nominatedPerson` FOREIGN KEY (`personID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recommended`
--
ALTER TABLE `recommended`
ADD CONSTRAINT `recommendedFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `recommendedUser` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
ADD CONSTRAINT `reviewFilmID` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `reviewUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sequel_to`
--
ALTER TABLE `sequel_to`
ADD CONSTRAINT `sequelBase` FOREIGN KEY (`baseFilmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `sequelSequel` FOREIGN KEY (`sequelID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `similar_films`
--
ALTER TABLE `similar_films`
ADD CONSTRAINT `similarFilm1` FOREIGN KEY (`film1ID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `similarFilm2` FOREIGN KEY (`film2ID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `won`
--
ALTER TABLE `won`
ADD CONSTRAINT `wonAward` FOREIGN KEY (`awardID`) REFERENCES `awards` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `wonFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `wonPerson` FOREIGN KEY (`personID`) REFERENCES `persons` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `worked_on`
--
ALTER TABLE `worked_on`
ADD CONSTRAINT `workedOnFilm` FOREIGN KEY (`filmID`) REFERENCES `films` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `workedOnStudio` FOREIGN KEY (`studioID`) REFERENCES `studios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
