-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 23 avr. 2023 à 18:23
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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`article_id`, `article_name`, `article_date`, `article_intro`, `article_quote`, `article_image`, `category_id`, `user_id`) VALUES
(2, 'Premier article', '2023-04-22 19:24:26', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.\r\n\r\nEt eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.\r\n\r\nSit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.\r\n\r\nSed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat. Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque. Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.', 'Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.', 'blog-1.jpg', 1, 43),
(75, 'Deuxieme article', '2023-04-22 22:00:46', 'miaaam', 'afzaazfzafza', 'blog-2.jpg', 1, 43),
(76, 'Troisième article', '2023-04-23 09:35:40', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta. Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore. Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate. Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat. Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque. Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.', 'Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.', 'blog-3.jpg', 1, 43),
(77, 'Quatrième article', '2023-04-23 09:36:48', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.  Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.  Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.  Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat. Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque. Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.', '', 'blog-4.jpg', 1, 43),
(78, 'Cinquième article', '2023-04-23 09:37:12', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.  Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.  Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.  Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat. Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque. Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. Vel magnam quod et tempora deleniti error rerum nihil tempora.', '', 'blog-5.jpg', 1, 43),
(79, 'Sixième article', '2023-04-23 09:37:32', 'Similique neque nam consequuntur ad non maxime aliquam quas. Quibusdam animi praesentium. Aliquam et laboriosam eius aut nostrum quidem aliquid dicta.  Et eveniet enim. Qui velit est ea dolorem doloremque deleniti aperiam unde soluta. Est cum et quod quos aut ut et sit sunt. Voluptate porro consequatur assumenda perferendis dolore.  Sit repellat hic cupiditate hic ut nemo. Quis nihil sunt non reiciendis. Sequi in accusamus harum vel aspernatur. Excepturi numquam nihil cumque odio. Et voluptate cupiditate.  Sed quo laboriosam qui architecto. Occaecati repellendus omnis dicta inventore tempore provident voluptas mollitia aliquid. Id repellendus quia. Asperiores nihil magni dicta est suscipit perspiciatis. Voluptate ex rerum assumenda dolores nihil quaerat. Dolor porro tempora et quibusdam voluptas. Beatae aut at ad qui tempore corrupti velit quisquam rerum. Omnis dolorum exercitationem harum qui qui blanditiis neque. Iusto autem itaque. Repudiandae hic quae aspernatur ea neque qui. Architecto voluptatem magni. ', 'Et vero doloremque tempore voluptatem ratione vel aut. Deleniti sunt animi aut. Aut eos aliquam doloribus minus autem quos.', 'blog-6.jpg', 1, 43),
(80, 'Septième article', '2023-04-23 09:38:03', 'Article de la page 2', 'oé oé oé ', 'blog-recent-1.jpg', 1, 43),
(81, 'Image safe', '2023-04-23 17:41:16', 'Salut !', NULL, '64456dbcf067b.jpeg', 1, 43),
(82, 'zadza', '2023-04-23 17:46:23', 'dzadza', NULL, 'blog-3.jpg', 1, 43);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_date`, `comment_message`, `user_id`, `article_id`) VALUES
(7, '2023-04-22 22:28:40', 'SSuper message', 43, 2),
(15, '2023-04-23 01:25:02', 'salut ça va ???', 43, 2),
(23, '2023-04-23 10:06:18', 'Ici il n&#039;y a pas de citations !', 43, 78),
(24, '2023-04-23 10:06:51', 'il n\'y a pas !', 43, 78),
(25, '2023-04-23 17:03:49', 'Jvais laisser un commentaire en fragment délire', 40, 80),
(26, '2023-04-23 17:07:16', 'Moi aussi jpeux commenter ! en plus j\'ai de belles lunettes 8D', 40, 2),
(27, '2023-04-23 17:08:51', 'et oui c\'est moi 8D', 40, 2),
(28, '2023-04-23 17:11:58', 'Voyons voir les data..', 40, 2),
(29, '2023-04-23 17:15:20', 'En effet... 8D', 40, 78),
(30, '2023-04-23 17:16:35', 'J\'en mets pleins partout et je test les data 8D', 40, 76),
(31, '2023-04-23 17:16:54', 'ah..', 40, 76),
(32, '2023-04-23 17:17:27', 'Salut', 40, 79),
(33, '2023-04-23 17:58:30', 'eezef', 43, 82),
(34, '2023-04-23 18:19:23', 'Salut !', 43, 80);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`section_id`, `section_title`, `section_body`, `section_image`, `article_id`) VALUES
(2, 'Une super section', 'bonjour c\'est moi the section', 'blog-recent-1.jpg', 2),
(3, 'ouaaais ça gaz', 'bonn bah là y\'a pas d\'image!', '', 2),
(4, 'cool la section', 'no image', '', 75),
(5, 'azdaz', 'azdazda', '644570f2b06ac.png', 82),
(6, 'azdazd', 'azdazd', '64457140073c2.png', 82),
(7, 'dazdaf', 'azdazdzaf', '64457172daf16.jpg', 82);

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
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'base_profile.png',
  `role_id` int NOT NULL,
  `user_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_role_FK` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_active`, `user_token`, `user_image`, `role_id`, `user_description`) VALUES
(36, 'flou', 'verif@verif.verif', '$2y$10$h5P/SWokshvezOKAHUMzR.ujsMjOfOBTQ04flR9Q6vTI8u8AK3Wiy', 0, '54063720264428bc49cbb2', 'base_profile.png', 0, NULL),
(40, 'user', 'user@user.user', '$2y$10$gVfYfa7dKvOBydSmS.D7P./7DDbqm5EtEl5r9xBMNwsPZBwPmvPmC', 1, '191208380264428c984a932', '64456075cb9b3.jpg', 1, 'j&#039;ai de belles lunettes'),
(41, 'test', 'test@test.test', '$2y$10$ZX8VBiTvm1cd9JGqeczDNOj35Fez3gnyWiGkKe78Qb4tkT5/jiBga', 1, '37048638164428cd8408b5', '6445746c73fcb.jpg', 0, 'J&#039;aime beaucoup tintin'),
(42, 'louis', 'louis@louis.com', '$2y$10$XVgIVoDOCKFh42di6lzLrerVBNmJOWCTvJwTL860rNCyHCOTO6bVK', 1, '83489506464428e20e08ae', '644574f3bbc2d.jpg', 0, 'J&#039;aime bcp milou !'),
(43, 'Nabil', 'nabil@mail.com', '$2y$10$LMpUAc7cHBnzA0JsYk0kXOGZF9qNCQ5jy7q6SU9RgJt8HStTRpTHq', 1, '146911102764429471b5eaf', '64455c01cee5b.jpg', 1, 'Voici ma super description'),
(44, 'ziad', 'ziad@ziad.ziad', '$2y$10$JMYMVQ.oHfRQTIwZF4fTWeXjOETwivOoFcDbl9mLWVdOMQ1lViSMO', 1, '184432080464429842e3bab', 'base_profile.png', 0, NULL),
(45, 'zadazdazdzad', 'nabil@mail.comdd', '$2y$10$ZqlxX0ciV/IB5Uq1Tw8m4ep4vWztCHdnThSdKD3Ej3jmbu71/rts6', 1, '10013797926442e3f070ae2', 'base_profile.png', 0, NULL),
(46, 'dzadzad', 'nabildd', '$2y$10$LH0cjqp/i3YYQZMbQArcuuZcf3ySy6vMwlsPEXTZkFN1zqmPNLSbu', 0, '17557993346442e42b1dadc', 'base_profile.png', 0, NULL),
(47, 'regexx', 'regexx@mail.com', '$2y$10$jj1LsIIzWcQDFXu4KDz.RutBY9a7VHFumJVIpW84qn8d7T7C11ggu', 1, '8592456826442e946ced18', 'base_profile.png', 0, NULL),
(50, 'validate', 'validate@mail.com', '$2y$10$aYvn930phgWus5KVlH9x5.qTYTeI8piVY4xp4BsyYoXABZ2x7Atni', 1, '13165738866443087dc4103', 'base_profile.png', 0, NULL),
(51, 'nabil', 'nabilo@mail.com', '$2y$10$X773XKjKgi08hDV8iAJtTePZEPrQv2LSbFN5MRdE/aVsyqhAtLzOu', 0, '8054522456444000185f45', 'base_profile.png', 0, NULL),
(52, 'Nabil Bellila', 'bellilanabil8@gmail.com', '$2y$10$25F6U7mWcol.mbquN9nxUOyhhyhAUnfDX7PeTbU.sx7AdAbzslfyO', 0, '510750153644403f7f2e1e', 'base_profile.png', 0, NULL),
(53, 'Nabil Bellila', 'bellilanabil8@gmail.comd', '$2y$10$V7HXAaQ30jbtJIOggvPz0uaL7tG2r1AzjUQMW6LgtMJpMsw5PmQgC', 0, '684594335644404a9ad51c', 'base_profile.png', 0, NULL),
(54, 'Nabil Bellila', 'nabil@mail.comzadazd', '$2y$10$So3DCGK.bHy8o5I.oZ8nc.hwIK3XEMqaBgQSzxDea4BvJsTXbuWti', 0, '14125862966444051dd3e0b', 'base_profile.png', 0, NULL),
(55, 'Nabil Bellila', 'nabil@mail.comzadazdd', '$2y$10$SMhKPPOmFs7l2R/uheYyg.db4WHsfMS3ZmyTtZu78QH3knGhTM.CO', 0, '6227434136444058187720', 'base_profile.png', 0, NULL),
(56, 'Nabil Bellila', 'nabil@mail.comzadazdddd', '$2y$10$MzPk6H4MtBPy.XokvCC4qu7GUaBVQIPPoyHgghqVnRT2j.ZO4lpxq', 0, '666831604644405983f5f2', 'base_profile.png', 0, NULL),
(57, 'Nabil Bellila', 'bellilanabil8@gmail.comzadz', '$2y$10$bpKZSd.UJJJTzf.UBl6s9OO4pf3qDlRLZIsVqof8wU/2U5jkeOu2.', 0, '802429690644405c631401', '', 0, NULL),
(58, 'Nabil Bellila', 'bellilanabil8@gmail.comazzfa', '$2y$10$LHOCdZ.VYx09ipOXoYImXOFn2U8gBiLbykViLsvIOAAL7AReea7pi', 0, '17695560166444063c49353', '', 0, NULL),
(59, 'Nabil Bellila', 'nabilon@mail.com', '$2y$10$agoNK8KtUWiZOZnxMyrlG.BcGAHftCbey4MRlHRlnm232i.8mMqKO', 0, '141226264664441ce66d843', '', 0, NULL),
(60, 'Nabil Bellila', 'activate@mail.com', '$2y$10$PMHxlWCerbzLMqVYIqe96uMYPHI4pe.yHAdKYosen8YWPxTpA9vSq', 0, '188750649564441d2320a4b', '', 0, NULL),
(61, 'Nabil Bellila', 'activate@mail.comd', '$2y$10$rtPfjFXmQ68sHkPjqqPzUOA7OkbM3mFOLFrzNYV424O2AY4wJho8C', 0, '212993510864441d2b87d56', '', 0, NULL),
(62, 'Nabil Bellila', 'activate@mail.comdzz', '$2y$10$U/6nY5nJvmq8KFOI0wlACOYKaS/caOG2ToO96pP.j.z.q4WG8GQvy', 0, '170495458464441d2e732f6', '', 0, NULL),
(63, 'Nabil Bellila', 'bellilanabil8@gmaild.com', '$2y$10$Xfom/luZ/axu9Z/s50/VxOtaayJL9QEmy5IR9XtrzoPI7yzoQComW', 0, '30544505764441d48578e8', '', 0, NULL),
(64, 'Nabil Bellila', 'bellilanabil8@gmaild.comd', '$2y$10$/9151ym/NAQ84apYwYHQkeW6qp29zDMko4EKMMt2f9qIXZfwjl93O', 0, '142642933464441da42447b', '', 0, NULL),
(65, 'Nabil Bellila', 'belliladzdznabil8@gmail.com', '$2y$10$D0cL70ZnCD44hP3XpRS6g.kvLZRCuzmYnLG07WogMYAKJNuwafqp2', 0, '73331341664441e0c15ced', '', 0, NULL),
(66, 'Nabil Bellila', 'belliladzdznabil8@gmail.comd', '$2y$10$89OEeMcjPv18UKxBl9UpZe5VOK3/o8/QZZKSxY47YE5YKknCMnvc2', 0, '153371507864441e4775491', '', 0, NULL),
(67, 'Nabil Bellila', 'belliladzdznabil8@gmail.comdz', '$2y$10$q3pBY3Z7imCL2r1i3UYrnuqwagKNe4Tte/ioDD4DRCyfyg3L06Q/G', 0, '105889197464441e4d5b1fb', '', 0, NULL),
(68, 'Nabil Bellila', 'bellilazazadzadzdanabil8@gmail.com', '$2y$10$iN3a6yuIp9xSLUMjtXUT2.vU6DeH3ZfMxUICb5VlR5/ok8QT8092q', 0, '16399546864441e5dc15a2', '', 0, NULL),
(69, 'Nabil Bellila', 'bellilazazadzadzdanabil8@dgmail.com', '$2y$10$wEMjfSAY6IGnvwEi4.IhduJPzyD59YfVnZUmKQE.5oGnPfXzjzYNO', 0, '102964915264441e81bbe4a', '', 0, NULL),
(70, 'Nabil Bellila', 'bellilanabil8@gmail.comzadzadza', '$2y$10$CNInYruIf5/s5IPnGZJUY.3kprTUZLmOVz0XeItckKwgp4Hrr7T6a', 0, '79167288864441f6f3e913', '', 0, NULL),
(71, 'Nabil Bellila', 'bellilanabil8@gmail.comzadzadzadz', '$2y$10$WdxlDxFC9d36R45khufnae2CbWSCzAzyPTu8TelTXGtPxH6K92Vmi', 1, '62290837464441f853ceae', '', 0, NULL),
(72, 'Bellila', 'bellilanabil8@gmail.comdd', '$2y$10$f2GzJJbgWM9slHvp4QCkOuCHC9ZBMrMYVC9towNhsMyq2YXgD4A0u', 1, '125023624964441fd27631c', '', 0, NULL),
(73, 'Nabil Bellila', 'bellilanabil8@gmail.comazdazdazfazzaf', '$2y$10$cXomrsROOW8KzEMDNBCQ9upNESxuJQGcueNJETjHKm6NTVHbdnOoy', 1, '19541550956444201f811ab', '', 0, NULL),
(74, 'aaaaaa', 'aa@aa.com', '$2y$10$jdiI7IoovuzlAyZQL8w4F.O.cPGnCJM1JR/iPB4ZDzho7cjQp8byu', 1, '76061742164457521de2dd', 'base_profil.png', 0, NULL);

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
