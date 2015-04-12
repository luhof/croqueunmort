-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 12 Avril 2015 à 20:13
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `cadavre`
--

-- --------------------------------------------------------

--
-- Structure de la table `ce_action`
--

CREATE TABLE `ce_action` (
`idAction` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `shortAction` tinyint(1) NOT NULL,
  `objectx` int(11) DEFAULT NULL,
  `objecty` int(11) DEFAULT NULL,
  `url` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_action`
--

INSERT INTO `ce_action` (`idAction`, `name`, `shortAction`, `objectx`, `objecty`, `url`) VALUES
(1, 'Mangea', 1, 10, 10, 'eat.png'),
(2, 'Explosa', 1, 10, 10, 'explode.png'),
(3, 'questionna', 1, 30, 10, 'questionna.png'),
(4, 'Vomit', 1, 10, 10, 'vomit.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_character`
--

CREATE TABLE `ce_character` (
`idCharacter` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `url_thumb` varchar(45) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_character`
--

INSERT INTO `ce_character` (`idCharacter`, `name`, `url`, `url_thumb`) VALUES
(1, 'Charlie Darraud', 'charlie.png', 'charlie_small.png'),
(2, 'un clown', 'clown.png', 'clown_small.png'),
(3, 'Funland', 'funland.png', 'funland_small.png'),
(4, 'un Alien', 'monster.png', 'monster.png');

-- --------------------------------------------------------

--
-- Structure de la table `ce_corpse`
--

CREATE TABLE `ce_corpse` (
`idCorpse` int(11) NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `img` varchar(50) NOT NULL,
  `idPlace` int(11) DEFAULT NULL,
  `likesCount` int(11) NOT NULL,
  `corpse_by` text
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_corpse`
--

INSERT INTO `ce_corpse` (`idCorpse`, `finished`, `img`, `idPlace`, `likesCount`, `corpse_by`) VALUES
(77, 1, 'corpse_77.png', 3, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(78, 1, 'corpse_78.png', 5, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(79, 1, 'corpse_79.png', 5, 0, ',biri,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(80, 1, 'corpse_80.png', 4, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(81, 1, 'corpse_81.png', 3, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(82, 1, 'corpse_82.png', 4, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(83, 1, 'corpse_83.png', 4, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(84, 1, 'corpse_84.png', 5, 0, ',luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,luhof2,'),
(85, 1, 'corpse_85.png', 3, 0, ',luhof2,anonyme,anonyme,anonyme,anonyme,anonyme,anonyme,anonyme,anonyme,anonyme,anonyme,'),
(86, 1, 'corpse_86.png', 6, 0, ',robin,robin,robin,robin,robin,robin,robin,robin,robin,robin,robin,'),
(87, 1, 'corpse_87.png', 6, 0, ',robin,yohan,yohan,yohan,yohan,yohan,yohan,yohan,yohan,yohan,yohan,'),
(88, 1, 'corpse_88.png', 5, 0, ',maelle,maelle,maelle,maelle,maelle,maelle,maelle,maelle,maelle,maelle,maelle,'),
(89, 1, 'corpse_89.png', 4, 0, ',username,username,username,username,username,username,username,username,username,username,'),
(90, 1, 'corpse_90.png', 6, 0, ',username,luhof2,yohan,yohan,yohan,yohan,yohan,yohan,yohan,yohan,yohan,'),
(91, 1, 'corpse_91.png', 3, 0, ',yohan,yohan,yohan,yohan,yohan,yohan,anonyme,anonyme,anonyme,anonyme,anonyme,'),
(92, 1, 'corpse_92.png', 4, 0, ',romain,romain,romain,romain,romain,romain,romain,romain,romain,romain,');

-- --------------------------------------------------------

--
-- Structure de la table `ce_likes`
--

CREATE TABLE `ce_likes` (
  `idUser` int(11) NOT NULL,
  `idCorpse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ce_object`
--

CREATE TABLE `ce_object` (
`idObject` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `url_thumb` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

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

CREATE TABLE `ce_panel` (
`idCase` int(11) NOT NULL,
  `step` enum('1','2','3') NOT NULL,
  `finished` tinyint(1) NOT NULL,
  `idCorpse` int(11) NOT NULL,
  `idCharacter` int(11) DEFAULT NULL,
  `idAction` int(11) DEFAULT NULL,
  `idObject` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_panel`
--

INSERT INTO `ce_panel` (`idCase`, `step`, `finished`, `idCorpse`, `idCharacter`, `idAction`, `idObject`) VALUES
(176, '1', 1, 77, 1, 3, 5),
(177, '2', 1, 77, 4, 2, 3),
(178, '3', 1, 77, 3, 4, 1),
(179, '1', 1, 78, 4, 1, 2),
(180, '2', 1, 78, 3, 3, 1),
(181, '3', 1, 78, 2, 2, 2),
(182, '1', 1, 79, 2, 2, 3),
(183, '2', 1, 79, 1, 2, 3),
(184, '3', 1, 79, 2, 2, 5),
(185, '1', 1, 80, 1, 3, 3),
(186, '2', 1, 80, 3, 4, 5),
(187, '3', 1, 80, 4, 2, 1),
(188, '1', 1, 81, 1, 1, 1),
(189, '2', 1, 81, 2, 1, 2),
(190, '3', 1, 81, 4, 3, 5),
(191, '1', 1, 82, 3, 2, 3),
(192, '2', 1, 82, 3, 2, 2),
(193, '3', 1, 82, 3, 3, 4),
(194, '1', 1, 83, 1, 1, 2),
(195, '2', 1, 83, 1, 2, 1),
(196, '3', 1, 83, 1, 1, 2),
(197, '1', 1, 84, 3, 3, 3),
(198, '2', 1, 84, 1, 4, 3),
(199, '3', 1, 84, 4, 1, 4),
(200, '1', 1, 85, 1, 1, 1),
(201, '2', 1, 85, 1, 1, 2),
(202, '3', 1, 85, 2, 2, 3),
(203, '1', 1, 86, 1, 4, 4),
(204, '2', 1, 86, 2, 3, 3),
(205, '3', 1, 86, 3, 1, 1),
(206, '1', 1, 87, 1, 4, 2),
(207, '2', 1, 87, 3, 2, 1),
(208, '3', 1, 87, 2, 1, 5),
(209, '1', 1, 88, 1, 4, 2),
(210, '2', 1, 88, 3, 4, 5),
(211, '3', 1, 88, 2, 3, 4),
(212, '1', 1, 89, 4, 4, 1),
(213, '2', 1, 89, 2, 4, 2),
(214, '3', 1, 89, 1, 1, 4),
(215, '1', 1, 90, 3, 3, 4),
(216, '2', 1, 90, 2, 4, 2),
(217, '3', 1, 90, 1, 4, 3),
(218, '1', 1, 91, 1, 2, 1),
(219, '2', 1, 91, 3, 3, 5),
(220, '3', 1, 91, 1, 2, 2),
(221, '1', 1, 92, 1, 1, 1),
(222, '2', 1, 92, 2, 2, 4),
(223, '3', 1, 92, 3, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `ce_place`
--

CREATE TABLE `ce_place` (
`idPlace` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `url_thumb` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

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

CREATE TABLE `ce_user` (
`idUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_user`
--

INSERT INTO `ce_user` (`idUser`, `username`) VALUES
(17, 'qsdf'),
(18, 'Luhof'),
(19, 'luhof2'),
(20, 'mectest'),
(21, 'qsdfjklmqsdfjklm'),
(22, 'lucas'),
(23, 'lucashorand'),
(24, 'toto'),
(25, 'foo'),
(26, 'biri'),
(27, 'monsieur'),
(28, 'monsieurlol'),
(29, 'robin'),
(30, 'yohan'),
(31, 'maelle'),
(32, 'username'),
(33, 'romain');

-- --------------------------------------------------------

--
-- Structure de la table `ce_userinfo`
--

CREATE TABLE `ce_userinfo` (
`idUser` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pwd` varchar(100) NOT NULL,
  `since` date NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'niutniut.jpg'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ce_userinfo`
--

INSERT INTO `ce_userinfo` (`idUser`, `email`, `pwd`, `since`, `avatar`) VALUES
(17, 'qsdf@mail.fr', '2e77d94ee355b4123bc10b3c417ea42f', '2015-03-26', 'niutniut.jpg'),
(18, 'lucas.horand@gmail.com', 'f05a56018fa1461f904020b044afc702', '2015-03-26', 'niutniut.jpg'),
(19, 'machin@mail.fr', 'd9bcb7975099d9b197e328e80412f4a6', '2015-03-29', 'niutniut.jpg'),
(20, 'mectest@test.fr', 'd9bcb7975099d9b197e328e80412f4a6', '2015-03-29', 'niutniut.jpg'),
(21, 'mail@mail.fr', 'b02d0c53bfa38ab4a0d7b57f1d15b381', '2015-03-31', 'niutniut.jpg'),
(22, 'lucas.horand@lol.fr', 'b29aff6c0434a850d7e4477d5b5036f8', '2015-04-06', 'niutniut.jpg'),
(23, 'toto@laposte.gouv.google.fr', 'ecaf0bb3d07fcbc2991bc93b8249d1ef', '2015-04-06', 'niutniut.jpg'),
(24, 'bar@lol.fr', '513b286267041b86a46dd1b2655ad048', '2015-04-06', 'niutniut.jpg'),
(25, 'testnul@lol.fr', 'motdepasse', '2015-04-07', 'niutniut.jpg'),
(26, 'biri@laposte.gouv.google.org', '5b5195e8293abd54f34283b898fd7c9c', '2015-04-06', 'niutniut.jpg'),
(27, 'mr@lol.fr', '13760d078c3145d3dd7f6769f98c2e70', '2015-04-06', 'niutniut.jpg'),
(28, 'lol@lol.fr', 'd77c0d2edf5feef2e1f18e7f1a5ae271', '2015-04-06', 'niutniut.jpg'),
(29, 'robin@robin.gouv.org', '9d7f8457aec7981be99882e25bfad22d', '2015-04-07', 'niutniut.jpg'),
(30, 'yohan@yohan.fr', '57c46bae2b277a9e75f959e3c373553b', '2015-04-07', 'niutniut.jpg'),
(31, 'maelle@maelle.maelle', 'd9bcb7975099d9b197e328e80412f4a6', '2015-04-07', 'niutniut.jpg'),
(32, 'mail@google.com', 'f49588a0a61612e9158ad165c94056f3', '2015-04-07', 'niutniut.jpg'),
(33, 'romain@romain.fr', 'bf5416e974a9697f8e60a28cdfdacd5b', '2015-04-07', 'niutniut.jpg');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ce_action`
--
ALTER TABLE `ce_action`
 ADD PRIMARY KEY (`idAction`), ADD UNIQUE KEY `idAction` (`idAction`);

--
-- Index pour la table `ce_character`
--
ALTER TABLE `ce_character`
 ADD PRIMARY KEY (`idCharacter`);

--
-- Index pour la table `ce_corpse`
--
ALTER TABLE `ce_corpse`
 ADD PRIMARY KEY (`idCorpse`);

--
-- Index pour la table `ce_likes`
--
ALTER TABLE `ce_likes`
 ADD KEY `idUser` (`idUser`), ADD KEY `idCorpse` (`idCorpse`);

--
-- Index pour la table `ce_object`
--
ALTER TABLE `ce_object`
 ADD PRIMARY KEY (`idObject`), ADD UNIQUE KEY `idObject` (`idObject`);

--
-- Index pour la table `ce_panel`
--
ALTER TABLE `ce_panel`
 ADD PRIMARY KEY (`idCase`), ADD UNIQUE KEY `idCase` (`idCase`), ADD KEY `idCharacter` (`idCharacter`), ADD KEY `idAction` (`idAction`), ADD KEY `idObject` (`idObject`), ADD KEY `idCorpse` (`idCorpse`);

--
-- Index pour la table `ce_place`
--
ALTER TABLE `ce_place`
 ADD PRIMARY KEY (`idPlace`);

--
-- Index pour la table `ce_user`
--
ALTER TABLE `ce_user`
 ADD PRIMARY KEY (`idUser`), ADD UNIQUE KEY `idUser` (`idUser`);

--
-- Index pour la table `ce_userinfo`
--
ALTER TABLE `ce_userinfo`
 ADD PRIMARY KEY (`idUser`), ADD KEY `idUser` (`idUser`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ce_action`
--
ALTER TABLE `ce_action`
MODIFY `idAction` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ce_character`
--
ALTER TABLE `ce_character`
MODIFY `idCharacter` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `ce_corpse`
--
ALTER TABLE `ce_corpse`
MODIFY `idCorpse` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT pour la table `ce_object`
--
ALTER TABLE `ce_object`
MODIFY `idObject` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `ce_panel`
--
ALTER TABLE `ce_panel`
MODIFY `idCase` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=224;
--
-- AUTO_INCREMENT pour la table `ce_place`
--
ALTER TABLE `ce_place`
MODIFY `idPlace` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ce_user`
--
ALTER TABLE `ce_user`
MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT pour la table `ce_userinfo`
--
ALTER TABLE `ce_userinfo`
MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ce_likes`
--
ALTER TABLE `ce_likes`
ADD CONSTRAINT `ce_likes_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `ce_user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ce_likes_ibfk_2` FOREIGN KEY (`idCorpse`) REFERENCES `ce_corpse` (`idCorpse`);

--
-- Contraintes pour la table `ce_panel`
--
ALTER TABLE `ce_panel`
ADD CONSTRAINT `ce_panel_ibfk_4` FOREIGN KEY (`idCharacter`) REFERENCES `ce_character` (`idCharacter`),
ADD CONSTRAINT `ce_panel_ibfk_5` FOREIGN KEY (`idAction`) REFERENCES `ce_action` (`idAction`),
ADD CONSTRAINT `ce_panel_ibfk_6` FOREIGN KEY (`idObject`) REFERENCES `ce_object` (`idObject`),
ADD CONSTRAINT `ce_panel_ibfk_7` FOREIGN KEY (`idCorpse`) REFERENCES `ce_corpse` (`idCorpse`) ON DELETE CASCADE ON UPDATE CASCADE;
