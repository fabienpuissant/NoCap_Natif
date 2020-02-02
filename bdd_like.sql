-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 26 sep. 2019 à 23:00
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdd_like`
--

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `Email` varchar(255) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(255) DEFAULT NULL,
  `Contenu` varchar(255) DEFAULT NULL,
  `Auteur` varchar(255) NOT NULL,
  `Chemin` varchar(255) DEFAULT NULL,
  `like_count` int(11) DEFAULT '0',
  `dislike_count` int(11) DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`Email`, `id`, `Titre`, `Contenu`, `Auteur`, `Chemin`, `like_count`, `dislike_count`, `date`) VALUES
('fabienpuissant@live.fr', 1, 'test1', 'test1', 'test1', 'test1.jpeg', 39, 45, '2019-09-26 21:16:02'),
('fabienpuissant@live.fr', 2, 'test1', 'test1', 'test1', 'test2.jpeg', 11, 10, '2019-09-26 21:16:13'),
('fabienpuissant@live_fr', 7, 'chezi', 'hcden', 'cjdns', 'fabienpuissant@live_fr2.png', 4, 12, '2019-09-26 22:00:53'),
('fabienpuissant@live_fr', 8, 'test', 'Test', 'Fab', 'fabienpuissant@live_fr2.jpg', 0, 1, '2019-09-27 00:54:59');

-- --------------------------------------------------------

--
-- Structure de la table `photo_vote`
--

DROP TABLE IF EXISTS `photo_vote`;
CREATE TABLE IF NOT EXISTS `photo_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`,`ref_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=309 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo_vote`
--

INSERT INTO `photo_vote` (`id`, `ref_id`, `user_id`, `vote`, `created_at`) VALUES
(294, 2, '1', 1, '2019-09-26 22:53:35'),
(295, 1, '1', 1, '2019-09-26 22:53:47'),
(304, 7, '1', 1, '2019-09-26 22:54:01'),
(305, 8, '10', 0, '2019-09-26 23:00:24'),
(306, 7, '10', 1, '2019-09-26 23:00:27'),
(307, 2, '10', 0, '2019-09-26 23:00:28'),
(308, 1, '10', 1, '2019-09-26 23:00:33');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(255) NOT NULL,
  `Mdp` varchar(255) NOT NULL,
  `confirmation_token` varchar(60) NOT NULL,
  `confirmed_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `Email`, `Mdp`, `confirmation_token`, `confirmed_at`) VALUES
(26, 'fabienpuissant@live.fr', '$2y$10$ID.zpRb4cnmfvuAb/EPmMeC.oRwoJsbg6qDYyE6l8Q/ZANSfoYqqu', 'confirmed', '2019-09-26'),
(27, 'admin', '$2y$10$G2cBoBm8A1DLL26E0Ty8e.kLTrP6r0RxqTze5tJmp9VYvPEpt0gZm', '', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
