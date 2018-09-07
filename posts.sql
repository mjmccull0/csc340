-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `Posts`;
CREATE TABLE `Posts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `imgUrl` varchar(255) NOT NULL,
  `cid` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Posts` (`ID`, `title`, `imgUrl`, `cid`, `active`) VALUES
(1,	'Preparing athletic trainers for the front lines',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/athletic-training-program-36184-F.jpg',	36184,	1),
(2,	'UNCG receives $1.2 million for student mentoring, classroom modernization',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/armfieldgrant-36230-F.jpg',	36230,	1),
(3,	'From fairy tales to Andy Warhol, a look at the Weatherspoon’s fall exhibits',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/Weatherspoon-36173-F.jpg',	36173,	1),
(4,	'Spartans make an impact with service to the community',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/spartan-service-day-36203-F.jpg',	36203,	1),
(5,	'UNCG Night with the Grasshoppers and one alum\'s secret sauce',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/Grasshoppers-Drew-Gill-36120-F.jpg',	36120,	1),
(6,	'What\'s free at the G',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/Free-at-the-G-36156-F.jpg',	36156,	1),
(7,	'UNCG receives $294,000 grant to expand Digital Library on American Slavery',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/DLAS-36145-F.jpg',	36145,	1),
(8,	'What\'s new at the G',	'https://newsandfeatures.uncg.edu/wp-content/uploads/2018/08/new-at-the-g-36108-F.jpg',	36108,	1);

-- 2018-09-07 19:38:43
