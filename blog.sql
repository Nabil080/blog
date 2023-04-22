-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 22 avr. 2023 à 15:36
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `romain`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `article_name` varchar(255) NOT NULL,
  `article_date` date NOT NULL,
  `article_intro` varchar(2550) NOT NULL,
  `article_quote` varchar(510) DEFAULT NULL,
  `article_image` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `article_category_FK` (`category_id`),
  KEY `article_user0_FK` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

DROP TABLE IF EXISTS `article_tag`;
CREATE TABLE IF NOT EXISTS `article_tag` (
  `tag_id` int NOT NULL,
  `article_id` int NOT NULL,
  PRIMARY KEY (`tag_id`,`article_id`),
  KEY `article_tag_article0_FK` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `comment_date` varchar(255) NOT NULL,
  `comment_message` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `article_id` int DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_user_FK` (`user_id`),
  KEY `comment_article0_FK` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(0, 'user'),
(1, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int NOT NULL AUTO_INCREMENT,
  `section_title` varchar(255) NOT NULL,
  `section_body` varchar(2550) NOT NULL,
  `section_image` varchar(255) NOT NULL,
  `article_id` int NOT NULL,
  PRIMARY KEY (`section_id`),
  KEY `section_article_FK` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_active` tinyint(1) NOT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `role_id` int NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_role_FK` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_active`, `user_token`, `user_image`, `role_id`) VALUES
(36, 'verif', 'verif@verif.verif', '$2y$10$h5P/SWokshvezOKAHUMzR.ujsMjOfOBTQ04flR9Q6vTI8u8AK3Wiy', 0, '54063720264428bc49cbb2', NULL, 0),
(40, 'user', 'user@user.user', '$2y$10$HRB11DRAkh2ZkHtkbSRltuJ9vpcQpl89.KY5UftK7RZeqXRc65OvW', 1, '191208380264428c984a932', NULL, 0),
(41, 'test', 'test@test.test', '$2y$10$WoGEiboU0mv6znykj0Ia0.i3Q4NrBWAFIdXZIAGzlsRmGqBlf2odu', 1, '37048638164428cd8408b5', NULL, 0),
(42, 'louis', 'louis@louis.com', '$2y$10$oI/srsBk5AkxTPtB9Qb3cerHers8nbILsgQBN0cJQUTq2bRCCerti', 1, '83489506464428e20e08ae', NULL, 0),
(43, 'Nabil', 'nabil@mail.com', '$2y$10$b.NdSAYg4yKcPNndXIzVue0.L.8RLjXOiw5RL4miuWjEJIT5PZJhe', 1, '146911102764429471b5eaf', NULL, 0),
(44, 'ziad', 'ziad@ziad.ziad', '$2y$10$JMYMVQ.oHfRQTIwZF4fTWeXjOETwivOoFcDbl9mLWVdOMQ1lViSMO', 1, '184432080464429842e3bab', NULL, 0),
(45, 'zadazdazdzad', 'nabil@mail.comdd', '$2y$10$ZqlxX0ciV/IB5Uq1Tw8m4ep4vWztCHdnThSdKD3Ej3jmbu71/rts6', 0, '10013797926442e3f070ae2', NULL, 0),
(46, 'dzadzad', 'nabildd', '$2y$10$LH0cjqp/i3YYQZMbQArcuuZcf3ySy6vMwlsPEXTZkFN1zqmPNLSbu', 0, '17557993346442e42b1dadc', NULL, 0),
(47, 'regexx', 'regexx@mail.com', '$2y$10$jj1LsIIzWcQDFXu4KDz.RutBY9a7VHFumJVIpW84qn8d7T7C11ggu', 1, '8592456826442e946ced18', NULL, 0),
(50, 'validate', 'validate@mail.com', '$2y$10$aYvn930phgWus5KVlH9x5.qTYTeI8piVY4xp4BsyYoXABZ2x7Atni', 1, '13165738866443087dc4103', NULL, 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_category_FK` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `article_user0_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_article0_FK` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`),
  ADD CONSTRAINT `article_tag_tag_FK` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`tag_id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_article0_FK` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`),
  ADD CONSTRAINT `comment_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_article_FK` FOREIGN KEY (`article_id`) REFERENCES `article` (`article_id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_role_FK` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
