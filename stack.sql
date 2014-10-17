-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 17 Octobre 2014 à 10:45
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
  `id_questions` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_questions` int(11) NOT NULL,
  `contenu` varchar(255) NOT NULL,
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
  `Titre` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `id_users` int(11) NOT NULL,
  `comment` text NOT NULL,
  `dateCreated` date NOT NULL,
  `dateModified` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `avatar`, `email`, `username`, `password`, `salt`, `token`, `dateRegistered`, `dateModified`, `job`, `country`, `language`, `externallink`) VALUES
(16, '', 'thibault.pirot@wanadoo.fr', 'Natacha', '27e419c68afe960ad658422bb40cb74afbc4ffd99106e25b44c9b205e09b5ebf51ba1b235cbb54ed229a689b443bee43156b49dc8ba85e70d0a4ee0ceb2411ec', 'RsuZi4hLus46LM4M4G5ORNaL5hbG0B8x8iyJKiixlZQFNC4UVw', 'jiY1WmyHXCDdsx3Bdf60kUQNqkb0fDRzXLkxKETnI1RtnvPCzC', '2014-10-17 08:02:52', '2014-10-17 08:02:52', '', '', '', ''),
(17, '', 'jeremy.tobelem@gmail.com', 'Jeremy', '02d9ee18dae4dc42926275e975890b30d2c81c9672c3acbe11e32097973353ab4af4e4efaad0aaba468a7bd5e4920df83643144f6a4f83e60abc48cb3049b4d5', 'T4dRSQLSx7Q6N44J2g2ASVW0vFeYQQY3NpKE5f6lreXEB5UnbT', 'qci7VOcHvoFNOjUWEbg8fn0OLEIcshLKGVjhFruCUsv49NcSwV', '2014-10-17 08:38:43', '2014-10-17 08:38:43', '', '', '', ''),
(18, '', 'nadeige.pirot@gmail.com', 'Nadeige', 'c15ac6e4abd49d71da1d69bb27ffbc2684c297126b9ccc6c1d5fbd87bc3f00eaa0f78a8fdbba569abf5f0faddbeb74c62ff832741ac846dc7300767d5b9df277', 'm0nVzMx3sfmtirN13hXcEy2hm9zdOkmibe3bQfq10Ua4umrjUo', 'bUUfIQ0USIDRtJPb1DSMYNcV3ztMjHEDPvncj29ZDcZLMMjVoK', '2014-10-17 08:39:50', '2014-10-17 08:39:50', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_réponses` int(11) NOT NULL,
  `dateCreated` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
