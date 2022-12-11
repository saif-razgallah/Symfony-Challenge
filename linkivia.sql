-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 11 déc. 2022 à 18:40
-- Version du serveur : 5.7.36
-- Version de PHP : 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `linkivia`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20221203222624', '2022-12-03 22:32:18', 203),
('DoctrineMigrations\\Version20221211183036', '2022-12-11 18:31:28', 191);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_affect_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_527EDB25A8E564D3` (`user_affect_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`id`, `user_affect_id`, `title`, `subject`, `description`, `status`) VALUES
(27, 21, 'tkshlerin', 'collins', 'skilesdonnelly', 'enattente'),
(28, 22, 'king', 'durward', 'nihil', 'enattente'),
(29, 23, 'russel', 'mcdermott', 'nihil', 'terminee'),
(30, 24, 'bradley72', 'collins', 'skilesdonnelly', 'enattente'),
(31, NULL, 'wolffdeckow', 'mcdermott', 'accusantium', 'enattente'),
(32, NULL, 'feeney', 'durward', 'accusantium', 'enattente'),
(33, NULL, 'biz', 'collins', 'skilesdonnelly', 'enattente');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `firstname`, `lastname`, `city`, `phone_number`) VALUES
(20, 'saif@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$EvjBEfFQok.qvzFkFAl3t.oRAI7x.WeFjiruL1ZnYhvPL3he0WX7q', 'saif', 'razgallah', 'sousse', '29732742'),
(21, 'lacroix.claudine@renaud.org', '[\"ROLE_USER\"]', '$2y$13$maGkG3V0rd4Gs5vMNRUkc.7BJ9qIOg9OPDNF9GNuapQGhMmr2aY..', 'Émile', 'Francois', 'Humbert-sur-Mer', '+33064643911'),
(22, 'olivier.gros@maillot.com', '[\"ROLE_USER\"]', '$2y$13$RUy5.ZOAX1KjaVesZYq5J.pTNd5ehRPg7jUthMWKCufQ6IDgYitaK', 'Christiane', 'Chauvin', 'Ribeiro', '+33853856635'),
(23, 'philippine36@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$A8.57xWMLUY2IVLms8qq1OvIkVPnYCp9H2Dn1qQqupjJw9nZD1jw6', 'Henriette', 'Bodin', 'Germain-la-Forêt', '+33658745952'),
(24, 'legoff.guy@buisson.com', '[\"ROLE_USER\"]', '$2y$13$UcN.OHF4CjRvOGOloFryQObNiQkmboUJXzf77kx8BsKsDfbrHNc7q', 'Isaac', 'Humbert', 'Michaud', '+33505751852'),
(25, 'dupont.margot@morel.fr', '[\"ROLE_USER\"]', '$2y$13$LQcwOYYCm..p.gWv9z8hqOE.QFfTOOUrFyLYCgNT5zGAcWGV4mytW', 'Alexandre', 'Riou', 'BouvetVille', '+33663689937');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `FK_527EDB25A8E564D3` FOREIGN KEY (`user_affect_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
