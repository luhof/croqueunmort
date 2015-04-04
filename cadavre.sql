-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Sam 04 Avril 2015 à 17:30
-- Version du serveur: 5.5.27
-- Version de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cadavre`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `ce_action`
--

INSERT INTO `ce_action` (`idAction`, `name`, `shortAction`, `objectx`, `objecty`, `url_thumb`) VALUES
(1, 'Mangea', 1, 10, 10, 'eat.png'),
(2, 'Explosa', 1, 10, 10, 'explode.png'),
(3, 'questionna', 1, 30, 10, 'questionna.png'),
(4, 'Vomit', 1, 10, 10, 'vomit.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `ce_character`
--

INSERT INTO `ce_character` (`idCharacter`, `name`, `url`, `url_thumb`) VALUES
(1, 'Charlie Darraud', 'charlie.png', 'charlie_small.png'),
(2, 'un clown', 'clown.png', 'clown_small.png'),
(3, 'Funland', 'funland.png', 'funland_small.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_corpse`
--

CREATE TABLE IF NOT EXISTS `ce_corpse` (
  `idCorpse` int(11) NOT NULL AUTO_INCREMENT,
  `finished` tinyint(1) NOT NULL,
  `img` varchar(50) NOT NULL,
  `idPlace` int(11) NOT NULL,
  `likesCount` int(11) NOT NULL,
  `corpse_by` text NOT NULL,
  PRIMARY KEY (`idCorpse`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `ce_corpse`
--

INSERT INTO `ce_corpse` (`idCorpse`, `finished`, `img`, `idPlace`, `likesCount`, `corpse_by`) VALUES
(1, 0, '', 1, 0, 'luhof2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `ce_object`
--

INSERT INTO `ce_object` (`idObject`, `name`, `url`, `url_thumb`) VALUES
(1, 'Chaussette', 'sock.png', 'sock_small.png'),
(2, 'Chien', 'dog.png', 'dog_small.png'),
(3, 'Monstre hideux', 'monster.png', 'monster_small.png'),
(4, 'Smartphone', 'smartphone.png', 'smartphone_small.png'),
(5, 'Sandwich', 'sandwich.png', 'sandwich_small.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_panel`
--

CREATE TABLE IF NOT EXISTS `ce_panel` (
  `idCase` int(11) NOT NULL AUTO_INCREMENT,
  `step` enum('1','2','3') NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `idCorpse` int(11) NOT NULL,
  `idCharacter` int(11) NOT NULL,
  `idAction` int(11) NOT NULL,
  `idObject` int(11) NOT NULL,
  PRIMARY KEY (`idCase`),
  UNIQUE KEY `idCase` (`idCase`),
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
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `url_thumb` varchar(50) NOT NULL,
  PRIMARY KEY (`idPlace`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `ce_place`
--

INSERT INTO `ce_place` (`idPlace`, `name`, `url`, `url_thumb`) VALUES
(3, 'Dans la forêt', 'forest.png', 'forest.png'),
(4, 'Dans la rue', 'street.png', 'street.png'),
(5, 'à l''IMAC', 'imac.png', 'imac_small.png'),
(6, 'Sommet de la tour eiffel', 'eiffel.png', 'eiffel_small.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_user`
--

CREATE TABLE IF NOT EXISTS `ce_user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `ce_user`
--

INSERT INTO `ce_user` (`idUser`, `username`) VALUES
(7, 'alexander'),
(8, 'alexander2'),
(9, 'canari'),
(10, 'salut'),
(11, 'salut'),
(12, 'salut'),
(13, 'salut'),
(14, 'salut'),
(15, 'ichbintest'),
(16, 'ichbintest2'),
(17, 'qsdf'),
(18, 'Luhof'),
(19, 'luhof2'),
(20, 'mectest'),
(21, 'qsdfjklmqsdfjklm');

-- --------------------------------------------------------

--
-- Structure de la table `ce_userinfo`
--

CREATE TABLE IF NOT EXISTS `ce_userinfo` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `since` date NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'niutniut.jpg',
  `favoriteCorpse` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `ce_userinfo`
--

INSERT INTO `ce_userinfo` (`idUser`, `email`, `pwd`, `since`, `avatar`, `favoriteCorpse`) VALUES
(7, 'alexander2@alexander.gouv.fr', '456soleil', '2015-03-24', 'niutniut.jpg', 0),
(8, 'alexander22@ichbinalexander.gouv.fr', 'ichbinalexander', '2015-03-24', 'niutniut.jpg', 0),
(9, 'canaricoincui@canard.fr', 'cuicui', '2015-03-26', 'niutniut.jpg', 0),
(10, 'luhof@lol.fr', 'salut', '2015-03-26', 'niutniut.jpg', 0),
(11, 'luhof@lol.fr', 'salut', '2015-03-26', 'niutniut.jpg', 0),
(12, 'luhof@lol.fr', 'salut', '2015-03-26', 'niutniut.jpg', 0),
(13, 'luhof@lol.fr', 'salut', '2015-03-26', 'niutniut.jpg', 0),
(14, 'luhof@lol.fr', 'salut', '2015-03-26', 'niutniut.jpg', 0),
(15, 'ichbin@lol.fr', 'ichbin', '2015-03-26', 'niutniut.jpg', 0),
(16, 'luh@lol.fr', 'pass1', '2015-03-26', 'niutniut.jpg', 0),
(17, 'qsdf@mail.fr', '2e77d94ee355b4123bc10b3c417ea42f', '2015-03-26', 'niutniut.jpg', 0),
(18, 'lucas.horand@gmail.com', 'f05a56018fa1461f904020b044afc702', '2015-03-26', 'niutniut.jpg', 0),
(19, 'machin@mail.fr', 'd9bcb7975099d9b197e328e80412f4a6', '2015-03-29', 'niutniut.jpg', 0),
(20, 'mectest@test.fr', 'd9bcb7975099d9b197e328e80412f4a6', '2015-03-29', 'niutniut.jpg', 0),
(21, 'mail@mail.fr', 'b02d0c53bfa38ab4a0d7b57f1d15b381', '2015-03-31', 'niutniut.jpg', 0);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `roomid` int(11) NOT NULL,
  `roomname` varchar(50) NOT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rooms`
--

INSERT INTO `rooms` (`roomid`, `roomname`) VALUES
(1, 'roomOne'),
(2, 'roomTwo');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  PRIMARY KEY (`roomid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `roomid`) VALUES
(1, 'jsklfmjqm', 1, 1),
(2, 'zafzfafa', 2, 2);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ce_likes`
--
ALTER TABLE `ce_likes`
  ADD CONSTRAINT `ce_likes_ibfk_2` FOREIGN KEY (`idCorpse`) REFERENCES `ce_corpse` (`idCorpse`),
  ADD CONSTRAINT `ce_likes_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `ce_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ce_panel`
--
ALTER TABLE `ce_panel`
  ADD CONSTRAINT `ce_panel_ibfk_4` FOREIGN KEY (`idCharacter`) REFERENCES `ce_character` (`idCharacter`),
  ADD CONSTRAINT `ce_panel_ibfk_5` FOREIGN KEY (`idAction`) REFERENCES `ce_action` (`idAction`),
  ADD CONSTRAINT `ce_panel_ibfk_6` FOREIGN KEY (`idObject`) REFERENCES `ce_object` (`idObject`),
  ADD CONSTRAINT `ce_panel_ibfk_7` FOREIGN KEY (`idCorpse`) REFERENCES `ce_corpse` (`idCorpse`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `rooms` (`roomid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
