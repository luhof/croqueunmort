-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Dim 22 Mars 2015 à 17:07
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cadavre`
--
CREATE DATABASE IF NOT EXISTS `cadavre` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cadavre`;

-- --------------------------------------------------------

--
-- Structure de la table `ce_action`
--

CREATE TABLE IF NOT EXISTS `ce_action` (
  `idAction` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `shortAction` tinyint(1) NOT NULL,
  `objectx` int(11) DEFAULT NULL,
  `objecty` int(11) DEFAULT NULL,
  `url_thumb` varchar(50) NOT NULL,
  PRIMARY KEY (`idAction`),
  UNIQUE KEY `idAction` (`idAction`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ce_action`
--

INSERT INTO `ce_action` (`idAction`, `name`, `shortAction`, `objectx`, `objecty`, `url_thumb`) VALUES
(1, 'Mangea', 1, 10, 10, 'eat.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_character`
--

CREATE TABLE IF NOT EXISTS `ce_character` (
  `idCharacter` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `url_thumb` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCharacter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ce_character`
--

INSERT INTO `ce_character` (`idCharacter`, `name`, `url`, `url_thumb`) VALUES
(1, 'Charlie Darraud', 'charlie.png', 'charlie_small.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_corpse`
--

CREATE TABLE IF NOT EXISTS `ce_corpse` (
  `idCorpse` int(11) NOT NULL AUTO_INCREMENT,
  `finished` tinyint(1) NOT NULL,
  `img` varchar(50) NOT NULL,
  `idPlace` int(11) NOT NULL,
  `place_by` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `likesCount` int(11) NOT NULL,
  PRIMARY KEY (`idCorpse`),
  KEY `place_by` (`place_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ce_corpse`
--

INSERT INTO `ce_corpse` (`idCorpse`, `finished`, `img`, `idPlace`, `place_by`, `idUser`, `likesCount`) VALUES
(1, 0, '0', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `ce_likes`
--

CREATE TABLE IF NOT EXISTS `ce_likes` (
  `idUser` int(11) NOT NULL,
  `idCorpse` int(11) NOT NULL,
  KEY `idUser` (`idUser`),
  KEY `idCorpse` (`idCorpse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ce_object`
--

CREATE TABLE IF NOT EXISTS `ce_object` (
  `idObject` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `url_thumb` varchar(50) NOT NULL,
  PRIMARY KEY (`idObject`),
  UNIQUE KEY `idObject` (`idObject`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ce_object`
--

INSERT INTO `ce_object` (`idObject`, `name`, `url`, `url_thumb`) VALUES
(1, 'Chaussette', 'sock.png', 'sock_small.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_panel`
--

CREATE TABLE IF NOT EXISTS `ce_panel` (
  `idCase` int(11) NOT NULL AUTO_INCREMENT,
  `step` enum('1','2','3') NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `idCorpse` int(11) NOT NULL,
  `character_by` int(11) NOT NULL,
  `action_by` int(11) NOT NULL,
  `idCharacter` int(11) NOT NULL,
  `idAction` int(11) NOT NULL,
  `idObject` int(11) NOT NULL,
  PRIMARY KEY (`idCase`),
  UNIQUE KEY `idCase` (`idCase`),
  KEY `character_by` (`character_by`),
  KEY `action_by` (`action_by`),
  KEY `idCharacter` (`idCharacter`),
  KEY `idAction` (`idAction`),
  KEY `idObject` (`idObject`),
  KEY `idCorpse` (`idCorpse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ce_place`
--

CREATE TABLE IF NOT EXISTS `ce_place` (
  `idPlace` int(11) NOT NULL AUTO_INCREMENT,
  `idCorpse` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `url_thumb` varchar(50) NOT NULL,
  PRIMARY KEY (`idPlace`),
  KEY `idCorpse` (`idCorpse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ce_place`
--

INSERT INTO `ce_place` (`idPlace`, `idCorpse`, `name`, `url`, `url_thumb`) VALUES
(1, 0, 'Dans une for', 'forest.png', 'forest.png'),
(2, 0, 'Dans la rue', 'street.png', 'street.png'),
(3, 1, 'Dans la for', 'forest.png', 'forest.png'),
(4, 2, 'Dans la rue', 'street.png', 'street.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_user`
--

CREATE TABLE IF NOT EXISTS `ce_user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ce_user`
--

INSERT INTO `ce_user` (`idUser`, `username`) VALUES
(1, 'totoé'),
(3, 'weshgros');

-- --------------------------------------------------------

--
-- Structure de la table `ce_userinfo`
--

CREATE TABLE IF NOT EXISTS `ce_userinfo` (
  `idUser` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `create_time` date NOT NULL,
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_userinfo`
--

INSERT INTO `ce_userinfo` (`idUser`, `email`, `pwd`, `create_time`) VALUES
(1, 'toto@toto.net', 'njsqdjfklm', '2015-02-03'),
(3, 'wesn@fsmdqjfklm.fr', 'jgklqsmgjklm', '0000-00-00');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ce_corpse`
--
ALTER TABLE `ce_corpse`
  ADD CONSTRAINT `ce_corpse_ibfk_1` FOREIGN KEY (`place_by`) REFERENCES `ce_user` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ce_likes`
--
ALTER TABLE `ce_likes`
  ADD CONSTRAINT `ce_likes_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `ce_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ce_likes_ibfk_2` FOREIGN KEY (`idCorpse`) REFERENCES `ce_place` (`idCorpse`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ce_panel`
--
ALTER TABLE `ce_panel`
  ADD CONSTRAINT `ce_panel_ibfk_1` FOREIGN KEY (`character_by`) REFERENCES `ce_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ce_panel_ibfk_3` FOREIGN KEY (`action_by`) REFERENCES `ce_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ce_panel_ibfk_4` FOREIGN KEY (`idCharacter`) REFERENCES `ce_character` (`idCharacter`),
  ADD CONSTRAINT `ce_panel_ibfk_5` FOREIGN KEY (`idAction`) REFERENCES `ce_action` (`idAction`),
  ADD CONSTRAINT `ce_panel_ibfk_6` FOREIGN KEY (`idObject`) REFERENCES `ce_object` (`idObject`),
  ADD CONSTRAINT `ce_panel_ibfk_7` FOREIGN KEY (`idCorpse`) REFERENCES `ce_corpse` (`idCorpse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ce_userinfo`
--
ALTER TABLE `ce_userinfo`
  ADD CONSTRAINT `ce_userinfo_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `ce_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Base de données: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
