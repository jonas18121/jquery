-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 16 nov. 2020 à 18:29
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `id` int(11) NOT NULL,
  `adresse_ip` varchar(255) DEFAULT NULL,
  `id_message` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse_ip` varchar(255) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `yes_like` int(11) NOT NULL DEFAULT '0',
  `no_like` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id`, `title`, `content`, `date_at`, `adresse_ip`, `pseudo`, `yes_like`, `no_like`) VALUES
(1, 'Mon premier message ', 'Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message Mon premier message ', '2020-11-06 09:58:27', '127.0.0.1', NULL, 0, 0),
(2, 'mon deuxieme message ', 'mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message mon deuxieme message ', '2020-11-06 12:04:36', '127.0.0.1', 'bourik', 0, 1),
(3, 'la coriandre ', 'la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre la coriandre ', '2020-11-07 14:01:42', '127.0.0.1', 'Kori andrer', 0, 0),
(18, 'mon 29 eme sujet', '&lt;p&gt;waou,&amp;nbsp; quel sujet&amp;nbsp;&lt;/p&gt;', '2020-11-13 16:31:16', '127.0.0.1', 'iti le roi', 0, 0),
(17, 'lolita ', 'lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita lolita ', '2020-11-09 10:22:36', '127.0.0.1', 'ginola', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `date_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse_ip` varchar(255) DEFAULT NULL,
  `id_message` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`id`, `pseudo`, `content`, `date_at`, `adresse_ip`, `id_message`) VALUES
(1, NULL, 'Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  Ma premiere reponse  ', '2020-11-06 09:59:32', '127.0.0.1', 1),
(2, 'amacepamoule', 'ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ma deuxieme reponse ', '2020-11-06 17:09:35', '127.0.0.1', 1),
(4, 'loriphisse', 'ma troisiemes reponse', '2020-11-07 13:49:27', '127.0.0.1', 2),
(5, 'lulu ', 'lulu lulu lulu lulu lulu lulu lulu lulu lulu lulu lulu lulu lulu lulu ', '2020-11-07 14:02:39', '127.0.0.1', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`) VALUES
(1, 'jean', 'jeancastre@gmail.com', 'jeancastre'),
(2, 'tata', 'tata@gmail.com', '$2y$10$/CrRfGDR0kxoHzIifJMS8OaEHJhgqr5FS2hOG9ZLk8Avc33B1.l8m');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
