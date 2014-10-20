-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 19 Octobre 2014 à 20:36
-- Version du serveur :  5.6.20
-- Version de PHP :  5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `stack`
--
CREATE DATABASE IF NOT EXISTS `stack` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `stack`;

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`id` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `id_question` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `answers`
--

INSERT INTO `answers` (`id`, `contenu`, `id_question`, `id_user`, `dateCreated`, `dateModified`) VALUES
(1, 'reposne a id 1', 1, 19, '2014-10-17 00:00:00', '0000-00-00 00:00:00'),
(2, 'reposne a id 1', 1, 19, '2014-10-17 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_questions` int(11) DEFAULT NULL,
  `id_answer` int(11) DEFAULT NULL,
  `contenu` varchar(255) NOT NULL,
  `vote_type` tinyint(1) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
`id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `keyword1` varchar(255) NOT NULL,
  `keyword2` varchar(255) DEFAULT NULL,
  `keyword3` varchar(255) DEFAULT NULL,
  `keyword4` varchar(255) DEFAULT NULL,
  `keyword5` varchar(255) DEFAULT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`id`, `title`, `contenu`, `id_user`, `keyword1`, `keyword2`, `keyword3`, `keyword4`, `keyword5`, `dateCreated`, `dateModified`) VALUES
(83, ' how to make syntax when importing csv to postgres?', '        		\r\n        \r\n\r\nI would like to import a csv file, which has multiple occurrences of missing values. I recoded them into NULL and tried to import the file as. I suppose that my attributes which include the NULLS are character values. However transforming them to numeric is bit complicated. Therefore I would like to import all of my table as:\r\n\r\n\\copy player_allstar FROM ''/Users/Desktop/Rdaten/Data/player_allstar.csv''  DELIMITER '';'' CSV WITH NULL AS ''NULL'' '';''  HEADER\r\n\r\nThere must be a syntax error. But I tried different combinations and always get:\r\n\r\nERROR:  syntax error at or near "WITH NULL"\r\nLINE 1: COPY  player_allstar FROM STDIN DELIMITER '';'' CSV WITH NULL ...\r\n\r\nI also tried:\r\n\r\n\\copy player_allstar FROM ''/Users/Desktop/Rdate/Data/player_allstar.csv'' WITH( CSV, DELIMITER '';'', NULL  ''NULL'', HEADER);\r\n\r\nand get:\r\n\r\nERROR:  option "csv" not recognized\r\n\r\nI also tried:\r\n\r\n\\copy player_allstar FROM ''/Users/Desktop/Rdaten/Data/player_allstar.csv'' WITH(FORMAT CSV, DELIMITER '';'', NULL  ''NULL'', HEADER);\r\n\r\nand get:\r\n\r\n ERROR:  invalid input syntax for integer: "NULL"\r\n CONTEXT:  COPY player_allstar, line 2, column dreb: "NULL"\r\n\r\n	', 20, ' MySQL', 'Wordpress', 'Symfony 2', ' ', ' ', '2014-10-19 16:25:51', '2014-10-19 16:25:51'),
(84, ' get a post end send it to a separate page', '        		\r\n        	\r\n\r\nI have a list of posts I want to get the post clicked and send this to a separate page in order to share only this post on facebook and twitter. I have a problem in the with the AJAX get,\r\n\r\nif I use POST as to send data I can view generate a separate page and view that post but I cant get the posts data (date in this case) to parse in to my node function. but if I use GET im able to parse in the data but not able to generate a separate page for it.\r\n\r\nI don''t know if i just put myself in a real mess or if its a very simple solution, so please help me out.\r\n\r\njavascript\r\n\r\nfunction shareInsight(event) {\r\nevent.preventDefault();\r\nvar confirmation = confirm(''Are you sure you want to delete this user?'');\r\ndate = { \r\n    ''date'':$(this).attr(''rel'')\r\n}\r\nif (confirmation === true) {\r\n    $.ajax({\r\n        type: ''GET'',\r\n        data: date,\r\n        url: ''/users/shareinsight/''+$(this).attr(''rel''),\r\n        dataType: ''JSON''\r\n    }).done(function( response ) {\r\n        if (response.msg === '''') {\r\n        }\r\n        else {\r\n            alert(''Error: '' + response.msg);\r\n        }\r\n    });\r\n    }\r\n    else {\r\n      return false;\r\n    }\r\n};\r\n\r\nnode\r\n\r\nrouter.get(''/shareinsight/:id'', function(req, res) {\r\n     var insightToShare = req.params.id;\r\n     console.log(insightToShare)\r\n     var db = req.db_login;\r\n     db.collection(''insights'').find({''date'':insightToDelete}).toArray(function (err, items){\r\n     res.json(items);\r\n     });\r\n });\r\n\r\nconsole\r\n\r\n''1413716316934''\r\nGET /users/shareinsight/''1413716316934''?date=%271413716316934%27 200 7ms - 9.97kb\r\n\r\n', 18, ' PHP', 'MySQL', 'Javascript', 'HTML5', 'CSS3', '2014-10-19 16:28:40', '2014-10-19 16:28:40'),
(86, ' Deleting all associations in Ruby on Rails', '         	I''m trying to implement some very simple lighting, and I''ve gotten myself into something that I can''t figure out how to fix.\r\n\r\nI calculate the color of each vertex using this vertex shader:\r\n\r\n#version 330 core\r\n\r\nlayout(location = 0) in vec4 vertexpos;\r\nlayout(location = 1) in vec4 lightpos;\r\nuniform vec3 lightcolor;\r\nuniform vec4 received_color;\r\n\r\nuniform mat4 translation;\r\nuniform mat4 projection;\r\n\r\nout vec4 vertex_color;\r\n\r\nvec4 normal = vec4(0.0, 0.0, -1.0, 1.0);\r\n\r\nvoid attenuation(out float atten, in float distance, in float range, in float a, in float b, in float c)\r\n{\r\n    atten = 1.0 / ( a * distance * distance + b * distance + c) * range;\r\n}\r\n\r\nvoid main()\r\n{\r\n    /* position stuff */\r\n\r\n    float atten = 0.0;\r\n    attenuation(atten, distance(lightpos, vertexpos), 20, 1.0, 0.1, 1.0);\r\n    vec4 vlight = normalize(lightpos - vertexpos);\r\n    float ndotl = max(0.0, dot(normal.xyz, vlight.xyz));\r\n\r\n    vertex_color = vec4(atten * ndotl * lightcolor * received_color.xyz, 1.0);\r\n\r\n    gl_Position = vertexpos;\r\n}\r\nIn the fragment shader I simply set color equal to vertex_color\r\n\r\nNow, as far as I know, this should calculate the color independently for each vertex, and the colors should blend together nicely. However, this is what shows up: ', 18, 'MySQL', ' Joomla !', 'Symfony 2', ' ', ' ', '2014-10-19 20:33:29', '2014-10-19 20:33:29');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id`, `keyword`, `dateCreated`, `dateModified`) VALUES
(1, 'PHP', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'MySQL', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'HTML5', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'CSS3', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Jquery', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Wordpress', '2014-10-19 18:52:31', '2014-10-19 18:52:31'),
(12, 'Joomla !', '2014-10-19 18:52:31', '2014-10-19 18:52:31'),
(13, 'Drupal', '2014-10-19 18:52:31', '2014-10-19 18:52:31'),
(14, 'Symfony 2', '2014-10-19 18:52:31', '2014-10-19 18:52:31'),
(15, 'AJAX', '2014-10-19 18:52:31', '2014-10-19 18:52:31');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
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
  `externallink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `username`, `password`, `salt`, `token`, `dateRegistered`, `dateModified`, `job`, `country`, `language`, `externallink`) VALUES
(16, '', '', 'thibault.pirot@wanadoo.fr', 'Natacha', '27e419c68afe960ad658422bb40cb74afbc4ffd99106e25b44c9b205e09b5ebf51ba1b235cbb54ed229a689b443bee43156b49dc8ba85e70d0a4ee0ceb2411ec', 'RsuZi4hLus46LM4M4G5ORNaL5hbG0B8x8iyJKiixlZQFNC4UVw', 'jiY1WmyHXCDdsx3Bdf60kUQNqkb0fDRzXLkxKETnI1RtnvPCzC', '2014-10-17 08:02:52', '2014-10-17 08:02:52', '', '', '', ''),
(17, '', '', 'jeremy.tobelem@gmail.com', 'Jeremy', '02d9ee18dae4dc42926275e975890b30d2c81c9672c3acbe11e32097973353ab4af4e4efaad0aaba468a7bd5e4920df83643144f6a4f83e60abc48cb3049b4d5', 'T4dRSQLSx7Q6N44J2g2ASVW0vFeYQQY3NpKE5f6lreXEB5UnbT', 'qci7VOcHvoFNOjUWEbg8fn0OLEIcshLKGVjhFruCUsv49NcSwV', '2014-10-17 08:38:43', '2014-10-17 08:38:43', '', '', '', ''),
(18, '', '', 'nadeige.pirot@gmail.com', 'Nadeige', 'c15ac6e4abd49d71da1d69bb27ffbc2684c297126b9ccc6c1d5fbd87bc3f00eaa0f78a8fdbba569abf5f0faddbeb74c62ff832741ac846dc7300767d5b9df277', 'm0nVzMx3sfmtirN13hXcEy2hm9zdOkmibe3bQfq10Ua4umrjUo', 'bUUfIQ0USIDRtJPb1DSMYNcV3ztMjHEDPvncj29ZDcZLMMjVoK', '2014-10-17 08:39:50', '2014-10-17 08:39:50', '', '', '', ''),
(19, '', '', 'gsaissi@gmail.com', 'giogio', '4cbf0e8f43e52e782a091ff3ad9f8a4b30463c624dfdf27b256f865971084219690948acd9cda90c84cd9845a953c862523a0f13cad13e6e2c0b816a37289501', 'd4plmrTtMzTrMIN7qkNUNMzYoE9kMz8l8DdsriIUbQ8w6S3il1', 'eGm9ySCSxx2u0ntRfjbri7o52Cl9Aum8JnnIkFG1Q8bTG3dLSh', '2014-10-17 14:12:11', '2014-10-17 14:26:54', '', '', '', ''),
(20, 'sery@sery.fr', '', 'sery@sery.fr', 'Alain', '62d01f543724f112b864f747fb192205fac05c9f2d6bed8661f8933ebc36584e0d5141173eef963278a971c8791cc39db53f11048f1d303473aff6adea54394f', 'm3XvC5fDykhytUnGrmRLOjgwOuSajj7CuKX0KrF5rVzNP2FPlB', 'SAJGPtTTsdM5sA5l8aFpV42kq5w0OVtJqpRKBSGbylYwn4Hxep', '2014-10-19 13:09:58', '2014-10-19 13:09:58', 'Prof', 'France', 'Anglais', 'google'),
(21, 'sabine.bimbard@html.fr', '', 'sabine.bimbard@html.fr', 'Sabine', '1d18b1b09f43aa645734557cf0583a524962916bde83cbee246adfd9908d9a9085b1b4d6b5b4536d508c4b6e0eaecdb055eee4dc68e45249945483dd9fbec01e', 'CZIZpDuL1pMncvuNgNlGG4BX99BVKz7zP4LPaibRk13r8RtTsC', 'BPpVxv1rKlFTcr6VxTsOfhs6FSdps61IaKRfCLoMhsiQr6rjmD', '2014-10-19 14:48:50', '2014-10-19 14:48:50', 'secretaire', 'France', 'Français, Italien', 'Yahoo'),
(22, 'lucette@lucette.fr', '', 'lucette@lucette.fr', 'Lulue', 'eaa66a1d398bc94e5f803db0c9b2311f1ce8d8917f4d060627f84e2ddeac81c83251d9007494f61bf005f965f75bb798c991f6b8a86656f13b7a307f5b3e864e', 'DuBqZgL6O7VH05UuKrv1s5FsuHUqyaqVTAIymd24WJRApauY8H', 'vvOF5ETJxE5C4R4sAIh1x0lnQUsRMvJLmGQTYNBCelDH7R9dNT', '2014-10-19 14:50:55', '2014-10-19 14:50:55', '', '', '', ''),
(23, 'nadeige.couthon@orange.fr', '4431.jpg', 'nadeige.couthon@orange.fr', 'Coco', '76053e2f8f7494919b921a92136a54b781a265b8048db744616f9e09d1f7f368d62fdbc2e1967df5d97047b873d04d6f07ca32600bb30434d0289321d2f03cd8', 'GsNgNZ1fgsOBdeBrmx8rV5raqf7Qgcqraso3A1UvxjLjSjZJLW', 'zDFxbJ8WW5efw9dHhL37NfggW45MQJSmpHUTkTAI4VsPyxIPRv', '2014-10-19 17:49:45', '2014-10-19 18:32:31', 'Webmaster', 'France', 'Anglais', 'google'),
(24, 'thibault.pirot@gmail.com', '4654.jpg', 'thibault.pirot@gmail.com', 'Sergio', 'ce699a6001238848c2cc1e875990f553b840a777bf33fcf05005c898065d8aae473f07d26b69d74d414bca90e4d8b4df7754bd5091e8ee1c47df513547179626', 'Mr7FrRLUHaJDMQybZHovwXdt9CFx91R9nYuxLbCROT5A0ZK9w6', 'KVKWrvfDqWR5uLgWOsDmFuQUhEIdZjF9p6AtCY4OZ1zCrGI4DN', '2014-10-19 17:52:46', '2014-10-19 17:52:46', 'Webmaster', 'France', 'Anglais', 'google'),
(25, 'nicole.franck@inserm.fr', '4245.jpg', 'nicole.franck@inserm.fr', 'Barbie', '3e647601477201f75f4433461048affbe6a4d148b89826779cea8b3a2bb61947d0412d4ab489387cbcd718e09be80a7dfafe6829cc8f3901c4942afc355c3f1a', 'SFSdcVzEWPn5qVeFKH1uED0eXxPrMGeNbwBx0y0pUodV20T7MO', 'DPB3GmsQPRoTvmquZlUlcNGJNRsu2UDC74rChLR903WFOgHsAG', '2014-10-19 17:55:06', '2014-10-19 17:55:06', 'Webmaster', 'Angleterre', 'Suedois', ''),
(26, 'pirot@pirot.com', '4352.jpg', 'pirot@pirot.com', 'Cece', '96d05476f3c00003416c1716b075eb38a81dc01d576e7a4639b7f530a922335c51ef1ad768ac899c6ee0a4a52521b6fc2880a126f881a2347bd3015f947485e9', 'RzkqQcVuinEqx2L1W70NyckOME32WTWDEnRBKQUBSDsAQoCzIr', '43heA0DsA0ylihWdHIRs1rc1yIrkWzizctDe9huLL2AdueF3Nr', '2014-10-19 18:01:28', '2014-10-19 18:01:28', 'Jardinier', 'Guinée', 'FRANCAIS', ''),
(27, 'nadeige.couthon@facebook.com', '4352.jpg', 'nadeige.couthon@facebook.com', 'Leo', '95de6aed0a8955cbd6fdfc754a746e6eff8d3fcdeafdfc1303e577bd58117fdcbae3366cb1ed064698ca896bcc0a63662ef43d947cd7b51f13139e58be5f8320', 'bY9jq1M10TmhcCMZGmGnMjjLXoV89SukccFqKW6rxmkKrKTcZq', 'Vvc5S3Sv5CbFOS1GIBQycj7kIRZkgCg55xRr3KZuSRRmZsdNvF', '2014-10-19 18:07:38', '2014-10-19 18:07:38', 'webmaster', 'France', 'FRANCAIS', ''),
(28, 'titi@titi.fr', NULL, 'titi@titi.fr', 'tibo', '5e0c82564d50c601c0fb45dcfb942210133b0385cff4cad6f2145623b013b00379d65d68bfe05b84bcb56b37131a7867c0617208068a0a76000a232581f5a812', '2B5Jvh2vdz8Safx5462qH6yh61nYPw38qXvSIl4j18N0b0vVKT', 'DcXWRAN4MnYwOzR7RY5FdhV9CtoJsSBOPbvMohYyNac16F6m3f', '2014-10-19 18:10:44', '2014-10-19 18:10:44', 'Directeur d''école', 'France', 'Polonais', ''),
(29, 'luna@luna.fr', '4496.jpg', 'luna@luna.fr', 'Luna', 'e8367e841c4873b844adcc4b9737476905219307efc29ab8bf17f10add097ba361494de772dd5e603155cc05bcbeaf31d3d71a139726f1dbfbc2adac22ce9beb', 'I1vUPrxzGscx5ngAkRlgJxysso258ltdcB7cAHu8MQafEjsIS0', 'lRRNez6eGRkSTebjBk0YbZbiUNBoXOoKeurtvYIsSAU72GT1Lx', '2014-10-19 18:15:56', '2014-10-19 18:15:56', 'Mannequin', 'Chine', 'Chinois', ''),
(30, 'herve@herve.com', NULL, 'herve@herve.com', 'Hervé', '2a82437a8a823f9b70c8ce2f26894bc25f7b9eb3882cfc3393baedc58734f0730e1d7c54b37e05e99579dfebc00efa7098f5df35d238e733c2160ae139887386', 'cJApXPGvLYrrP6jr3WXcbAcID1P9PvjkG5dXUYV0BRRRL9uo8l', 'GoSGN3p03bKtxKrePaev2IOcTp0JhYckiFnnifvcKC5DWHtyp4', '2014-10-19 18:20:05', '2014-10-19 18:20:05', 'Facteur', 'France', 'FRANCAIS', ''),
(31, 'louise.attack@go.fr', NULL, 'louise.attack@go.fr', 'Louise', '794170b9983bd7944dca31d495bcc5189a5299ee6a07a17ffdb657c11746fe9c2b3f882a7aafa277b45d1a9020feef7dd6059386ec9a631cc92ebc8608a23557', 'UpWDv7ogb7slZPhaqLpq9c71xOTwzrLxg5uJzuO4qU6qqLVm9L', 'hItCuVirSSKMntw7HG87SwlendV5SODGz2Ztitt8nBSduVQdlz', '2014-10-19 18:28:03', '2014-10-19 18:28:03', 'Chanteuse', 'France', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  `dateModified` datetime NOT NULL,
  `vote_type` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `votes`
--

INSERT INTO `votes` (`id`, `id_user`, `id_answer`, `dateCreated`, `dateModified`, `vote_type`) VALUES
(1, 19, 1, '2014-10-17 00:00:00', '0000-00-00 00:00:00', 20),
(2, 19, 1, '2014-10-17 00:00:00', '0000-00-00 00:00:00', 20);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `answers`
--
ALTER TABLE `answers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `questions`
--
ALTER TABLE `questions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
