-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 23 avr. 2023 à 01:37
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
  `article_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_intro` varchar(2550) NOT NULL,
  `article_quote` varchar(510) DEFAULT NULL,
  `article_image` varchar(255) NOT NULL,
  `category_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`article_id`),
  KEY `article_category_FK` (`category_id`),
  KEY `article_user0_FK` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`article_id`, `article_name`, `article_date`, `article_intro`, `article_quote`, `article_image`, `category_id`, `user_id`) VALUES
(2, 'Dolorum optio tempore voluptas dignissimos cumque fuga qui quibusdam quia', '2023-04-22 19:24:26', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.\r\n                  Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.\r\n\r\nSit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.\r\n\r\nSed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat. Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque. Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.', 'Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.', 'blog-1.jpg', 1, 43),
(75, 'Deuxieme article', '2023-04-22 22:00:46', 'miaaam', 'afzaazfzafza', 'blog-2.jpg', 1, 43);

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

--
-- Déchargement des données de la table `article_tag`
--

INSERT INTO `article_tag` (`tag_id`, `article_id`) VALUES
(1, 2),
(2, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Business'),
(2, 'Général\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `comment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `article_id` int DEFAULT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `comment_user_FK` (`user_id`),
  KEY `comment_article0_FK` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_date`, `comment_message`, `user_id`, `article_id`) VALUES
(7, '2023-04-22 22:28:40', 'SSuper message', 43, 2),
(15, '2023-04-23 01:25:02', 'salut ça va ???', 43, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reply`
--

DROP TABLE IF EXISTS `reply`;
CREATE TABLE IF NOT EXISTS `reply` (
  `reply_id` int NOT NULL AUTO_INCREMENT,
  `reply_message` varchar(255) NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`reply_id`),
  KEY `reply_comment_FK` (`comment_id`),
  KEY `reply_user_FK` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reply`
--

INSERT INTO `reply` (`reply_id`, `reply_message`, `reply_date`, `comment_id`, `user_id`) VALUES
(3, 'Je réponds à ton message', '2023-04-22 23:26:12', 7, 42),
(4, 'Et moi je te re réponds !', '2023-04-22 23:26:12', 7, 43);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`section_id`, `section_title`, `section_body`, `section_image`, `article_id`) VALUES
(2, 'Une super section', 'bonjour c\'est moi the section', 'blog-recent-1.jpg', 2),
(3, 'ouaaais ça gaz', 'bonn bah là y\'a pas d\'image!', '', 2),
(4, 'cool la section', 'no image', '', 75);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`) VALUES
(1, 'Creative\r\n'),
(2, 'Tips'),
(3, 'Marketing');

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
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_active`, `user_token`, `user_image`, `role_id`) VALUES
(36, 'verif', 'verif@verif.verif', '$2y$10$h5P/SWokshvezOKAHUMzR.ujsMjOfOBTQ04flR9Q6vTI8u8AK3Wiy', 0, '54063720264428bc49cbb2', NULL, 0),
(40, 'user', 'user@user.user', '$2y$10$HRB11DRAkh2ZkHtkbSRltuJ9vpcQpl89.KY5UftK7RZeqXRc65OvW', 1, '191208380264428c984a932', NULL, 0),
(41, 'test', 'test@test.test', '$2y$10$WoGEiboU0mv6znykj0Ia0.i3Q4NrBWAFIdXZIAGzlsRmGqBlf2odu', 1, '37048638164428cd8408b5', NULL, 0),
(42, 'louis', 'louis@louis.com', '$2y$10$oI/srsBk5AkxTPtB9Qb3cerHers8nbILsgQBN0cJQUTq2bRCCerti', 1, '83489506464428e20e08ae', NULL, 0),
(43, 'Nabil', 'nabil@mail.com', '$2y$10$b.NdSAYg4yKcPNndXIzVue0.L.8RLjXOiw5RL4miuWjEJIT5PZJhe', 1, '146911102764429471b5eaf', NULL, 1),
(44, 'ziad', 'ziad@ziad.ziad', '$2y$10$JMYMVQ.oHfRQTIwZF4fTWeXjOETwivOoFcDbl9mLWVdOMQ1lViSMO', 1, '184432080464429842e3bab', NULL, 0),
(45, 'zadazdazdzad', 'nabil@mail.comdd', '$2y$10$ZqlxX0ciV/IB5Uq1Tw8m4ep4vWztCHdnThSdKD3Ej3jmbu71/rts6', 1, '10013797926442e3f070ae2', NULL, 0),
(46, 'dzadzad', 'nabildd', '$2y$10$LH0cjqp/i3YYQZMbQArcuuZcf3ySy6vMwlsPEXTZkFN1zqmPNLSbu', 0, '17557993346442e42b1dadc', NULL, 0),
(47, 'regexx', 'regexx@mail.com', '$2y$10$jj1LsIIzWcQDFXu4KDz.RutBY9a7VHFumJVIpW84qn8d7T7C11ggu', 1, '8592456826442e946ced18', NULL, 0),
(50, 'validate', 'validate@mail.com', '$2y$10$aYvn930phgWus5KVlH9x5.qTYTeI8piVY4xp4BsyYoXABZ2x7Atni', 1, '13165738866443087dc4103', NULL, 0),
(51, 'nabil', 'nabilo@mail.com', '$2y$10$X773XKjKgi08hDV8iAJtTePZEPrQv2LSbFN5MRdE/aVsyqhAtLzOu', 0, '8054522456444000185f45', NULL, 0),
(52, 'Nabil Bellila', 'bellilanabil8@gmail.com', '$2y$10$25F6U7mWcol.mbquN9nxUOyhhyhAUnfDX7PeTbU.sx7AdAbzslfyO', 0, '510750153644403f7f2e1e', NULL, 0),
(53, 'Nabil Bellila', 'bellilanabil8@gmail.comd', '$2y$10$V7HXAaQ30jbtJIOggvPz0uaL7tG2r1AzjUQMW6LgtMJpMsw5PmQgC', 0, '684594335644404a9ad51c', NULL, 0),
(54, 'Nabil Bellila', 'nabil@mail.comzadazd', '$2y$10$So3DCGK.bHy8o5I.oZ8nc.hwIK3XEMqaBgQSzxDea4BvJsTXbuWti', 0, '14125862966444051dd3e0b', NULL, 0),
(55, 'Nabil Bellila', 'nabil@mail.comzadazdd', '$2y$10$SMhKPPOmFs7l2R/uheYyg.db4WHsfMS3ZmyTtZu78QH3knGhTM.CO', 0, '6227434136444058187720', NULL, 0),
(56, 'Nabil Bellila', 'nabil@mail.comzadazdddd', '$2y$10$MzPk6H4MtBPy.XokvCC4qu7GUaBVQIPPoyHgghqVnRT2j.ZO4lpxq', 0, '666831604644405983f5f2', NULL, 0),
(57, 'Nabil Bellila', 'bellilanabil8@gmail.comzadz', '$2y$10$bpKZSd.UJJJTzf.UBl6s9OO4pf3qDlRLZIsVqof8wU/2U5jkeOu2.', 0, '802429690644405c631401', NULL, 0),
(58, 'Nabil Bellila', 'bellilanabil8@gmail.comazzfa', '$2y$10$LHOCdZ.VYx09ipOXoYImXOFn2U8gBiLbykViLsvIOAAL7AReea7pi', 0, '17695560166444063c49353', NULL, 0),
(59, 'Nabil Bellila', 'nabilon@mail.com', '$2y$10$agoNK8KtUWiZOZnxMyrlG.BcGAHftCbey4MRlHRlnm232i.8mMqKO', 0, '141226264664441ce66d843', NULL, 0),
(60, 'Nabil Bellila', 'activate@mail.com', '$2y$10$PMHxlWCerbzLMqVYIqe96uMYPHI4pe.yHAdKYosen8YWPxTpA9vSq', 0, '188750649564441d2320a4b', NULL, 0),
(61, 'Nabil Bellila', 'activate@mail.comd', '$2y$10$rtPfjFXmQ68sHkPjqqPzUOA7OkbM3mFOLFrzNYV424O2AY4wJho8C', 0, '212993510864441d2b87d56', NULL, 0),
(62, 'Nabil Bellila', 'activate@mail.comdzz', '$2y$10$U/6nY5nJvmq8KFOI0wlACOYKaS/caOG2ToO96pP.j.z.q4WG8GQvy', 0, '170495458464441d2e732f6', NULL, 0),
(63, 'Nabil Bellila', 'bellilanabil8@gmaild.com', '$2y$10$Xfom/luZ/axu9Z/s50/VxOtaayJL9QEmy5IR9XtrzoPI7yzoQComW', 0, '30544505764441d48578e8', NULL, 0),
(64, 'Nabil Bellila', 'bellilanabil8@gmaild.comd', '$2y$10$/9151ym/NAQ84apYwYHQkeW6qp29zDMko4EKMMt2f9qIXZfwjl93O', 0, '142642933464441da42447b', NULL, 0),
(65, 'Nabil Bellila', 'belliladzdznabil8@gmail.com', '$2y$10$D0cL70ZnCD44hP3XpRS6g.kvLZRCuzmYnLG07WogMYAKJNuwafqp2', 0, '73331341664441e0c15ced', NULL, 0),
(66, 'Nabil Bellila', 'belliladzdznabil8@gmail.comd', '$2y$10$89OEeMcjPv18UKxBl9UpZe5VOK3/o8/QZZKSxY47YE5YKknCMnvc2', 0, '153371507864441e4775491', NULL, 0),
(67, 'Nabil Bellila', 'belliladzdznabil8@gmail.comdz', '$2y$10$q3pBY3Z7imCL2r1i3UYrnuqwagKNe4Tte/ioDD4DRCyfyg3L06Q/G', 0, '105889197464441e4d5b1fb', NULL, 0),
(68, 'Nabil Bellila', 'bellilazazadzadzdanabil8@gmail.com', '$2y$10$iN3a6yuIp9xSLUMjtXUT2.vU6DeH3ZfMxUICb5VlR5/ok8QT8092q', 0, '16399546864441e5dc15a2', NULL, 0),
(69, 'Nabil Bellila', 'bellilazazadzadzdanabil8@dgmail.com', '$2y$10$wEMjfSAY6IGnvwEi4.IhduJPzyD59YfVnZUmKQE.5oGnPfXzjzYNO', 0, '102964915264441e81bbe4a', NULL, 0),
(70, 'Nabil Bellila', 'bellilanabil8@gmail.comzadzadza', '$2y$10$CNInYruIf5/s5IPnGZJUY.3kprTUZLmOVz0XeItckKwgp4Hrr7T6a', 0, '79167288864441f6f3e913', NULL, 0),
(71, 'Nabil Bellila', 'bellilanabil8@gmail.comzadzadzadz', '$2y$10$WdxlDxFC9d36R45khufnae2CbWSCzAzyPTu8TelTXGtPxH6K92Vmi', 1, '62290837464441f853ceae', NULL, 0),
(72, 'Bellila', 'bellilanabil8@gmail.comdd', '$2y$10$f2GzJJbgWM9slHvp4QCkOuCHC9ZBMrMYVC9towNhsMyq2YXgD4A0u', 1, '125023624964441fd27631c', NULL, 0),
(73, 'Nabil Bellila', 'bellilanabil8@gmail.comazdazdazfazzaf', '$2y$10$cXomrsROOW8KzEMDNBCQ9upNESxuJQGcueNJETjHKm6NTVHbdnOoy', 1, '19541550956444201f811ab', NULL, 0);

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
-- Contraintes pour la table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_comment_FK` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`),
  ADD CONSTRAINT `reply_user_FK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

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
