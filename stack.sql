-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 17 Octobre 2014 à 17:28
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `stack`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id`, `contenu`, `id_question`, `id_user`, `dateCreated`, `dateModified`) VALUES
(1, 'reposne a id 1', 1, 19, '2014-10-17', '0000-00-00'),
(2, 'reposne a id 1', 1, 19, '2014-10-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_questions` int(11) DEFAULT NULL,
  `id_answer` int(11) DEFAULT NULL,
  `contenu` varchar(255) NOT NULL,
  `vote_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `keyword1` varchar(255) NOT NULL,
  `keyword2` varchar(255) NOT NULL,
  `keyword3` varchar(255) NOT NULL,
  `keyword4` varchar(255) NOT NULL,
  `keyword5` varchar(255) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `title`, `contenu`, `id_user`, `keyword1`, `keyword2`, `keyword3`, `keyword4`, `keyword5`, `dateCreated`, `dateModified`) VALUES
(1, 'application local-storage', 'blabblbhkleklejklejkle', 19, 'php', 'jquery', 'mysql', 'css3', '', '2014-10-17', '0000-00-00'),
(2, 'Code::blocks cycle through clipboard history', 'Currently when I populate the TextBlock ', 19, 'css3', 'apache', 'joomla', '', '', '0000-00-00', '0000-00-00'),
(3, 'Code::blocks cycle through clipboard history', 'Currently when I populate the TextBlock ', 19, 'css3', 'apache', 'joomla', '', '', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `keyword`) VALUES
(1, 'PHP'),
(2, 'MySQL'),
(3, 'HTML5'),
(4, 'CSS3'),
(5, 'Jquery');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `dateRegistered` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `job` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `externallink` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `username`, `password`, `salt`, `token`, `dateRegistered`, `dateModified`, `job`, `country`, `language`, `externallink`) VALUES
(16, '', '', 'thibault.pirot@wanadoo.fr', 'Natacha', '27e419c68afe960ad658422bb40cb74afbc4ffd99106e25b44c9b205e09b5ebf51ba1b235cbb54ed229a689b443bee43156b49dc8ba85e70d0a4ee0ceb2411ec', 'RsuZi4hLus46LM4M4G5ORNaL5hbG0B8x8iyJKiixlZQFNC4UVw', 'jiY1WmyHXCDdsx3Bdf60kUQNqkb0fDRzXLkxKETnI1RtnvPCzC', '2014-10-17 08:02:52', '2014-10-17 08:02:52', '', '', '', ''),
(17, '', '', 'jeremy.tobelem@gmail.com', 'Jeremy', '02d9ee18dae4dc42926275e975890b30d2c81c9672c3acbe11e32097973353ab4af4e4efaad0aaba468a7bd5e4920df83643144f6a4f83e60abc48cb3049b4d5', 'T4dRSQLSx7Q6N44J2g2ASVW0vFeYQQY3NpKE5f6lreXEB5UnbT', 'qci7VOcHvoFNOjUWEbg8fn0OLEIcshLKGVjhFruCUsv49NcSwV', '2014-10-17 08:38:43', '2014-10-17 08:38:43', '', '', '', ''),
(18, '', '', 'nadeige.pirot@gmail.com', 'Nadeige', 'c15ac6e4abd49d71da1d69bb27ffbc2684c297126b9ccc6c1d5fbd87bc3f00eaa0f78a8fdbba569abf5f0faddbeb74c62ff832741ac846dc7300767d5b9df277', 'm0nVzMx3sfmtirN13hXcEy2hm9zdOkmibe3bQfq10Ua4umrjUo', 'bUUfIQ0USIDRtJPb1DSMYNcV3ztMjHEDPvncj29ZDcZLMMjVoK', '2014-10-17 08:39:50', '2014-10-17 08:39:50', '', '', '', ''),
(19, '', '', 'gsaissi@gmail.com', 'giogio', '4cbf0e8f43e52e782a091ff3ad9f8a4b30463c624dfdf27b256f865971084219690948acd9cda90c84cd9845a953c862523a0f13cad13e6e2c0b816a37289501', 'd4plmrTtMzTrMIN7qkNUNMzYoE9kMz8l8DdsriIUbQ8w6S3il1', 'eGm9ySCSxx2u0ntRfjbri7o52Cl9Aum8JnnIkFG1Q8bTG3dLSh', '2014-10-17 14:12:11', '2014-10-17 14:26:54', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `vote_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `id_user`, `id_answer`, `dateCreated`, `vote_type`) VALUES
(1, 19, 1, '2014-10-17', 20),
(2, 19, 1, '2014-10-17', 20);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
