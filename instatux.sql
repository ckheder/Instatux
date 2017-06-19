-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 17 Juin 2017 à 17:40
-- Version du serveur :  10.2.6-MariaDB-10.2.6+maria~xenial
-- Version de PHP :  7.0.18-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `instatux`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `suivi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `user_id`, `suivi`) VALUES
(29, 17, 18),
(28, 17, 18),
(10, 19, 17),
(27, 17, 18),
(30, 17, 19),
(31, 17, 18),
(32, 18, 17);

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `comm` text NOT NULL,
  `tweet_id` varchar(11) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `comm`, `tweet_id`, `user_id`, `created`) VALUES
(1, 'essai comm', '14', '17', '2016-10-11 12:00:00'),
(11, 'tu ne peut delete :)', '14', '17', '2016-10-25 18:19:45'),
(15, 'test', '14', '17', '2016-11-18 20:01:01'),
(21, 'test', '14', '17', '2016-12-08 10:01:04'),
(22, 'osef', '14', '17', '2017-01-11 10:29:43'),
(23, 'fr', '14', '17', '2017-01-11 20:17:57'),
(24, 'test', '8', '17', '2017-01-17 10:17:14'),
(25, 'test comm', '14', '17', '2017-01-17 11:28:15'),
(26, 'gg', '8', '17', '2017-01-17 11:30:14'),
(27, '[youtube]PhCwG-HBSwo[/youtube]', '17', '17', '2017-02-11 16:19:03'),
(31, 'test\r\n', '44', '17', '2017-02-17 09:56:52'),
(32, 'test', '43', '17', '2017-02-17 14:56:12'),
(33, 'commentaire', '15', '17', '2017-02-25 16:08:32'),
(129, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:36:26'),
(128, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:35:40'),
(124, '', NULL, NULL, '2017-04-24 09:19:03'),
(130, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:42:07'),
(131, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:43:43'),
(132, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:44:14'),
(133, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:44:30'),
(134, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:44:43'),
(136, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:50:58'),
(145, 'gg', '8', '17', '2017-05-04 15:55:57'),
(146, 'test', '8', '17', '2017-05-04 15:57:46'),
(147, 'test', '8', '17', '2017-05-04 15:58:52'),
(143, 'test notif', '8', '17', '2017-04-27 19:02:48');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(111) NOT NULL,
  `conv` int(111) NOT NULL,
  `participant1` int(11) NOT NULL,
  `participant2` int(11) NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `conv`, `participant1`, `participant2`, `statut`) VALUES
(1, 1, 18, 17, 1),
(3, 2, 17, 19, 1),
(5, 1, 17, 18, 1),
(6, 2, 19, 17, 1),
(7, 3, 18, 19, 1),
(8, 3, 19, 18, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destinataire` int(11) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `conv` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `user_id`, `destinataire`, `message`, `created`, `conv`) VALUES
(16, 18, 17, 'premier message', '2016-12-09 00:00:00', 1),
(18, 19, 17, 'first message', '2016-12-12 00:00:00', 2),
(19, 17, 19, 'deuxième message', '2016-12-27 00:00:00', 2),
(20, 19, 17, 'dernier message gg', '2016-12-13 00:00:00', 2),
(34, 17, 18, 'sdf', '2017-01-20 09:36:11', 1),
(33, 17, 18, 'osef', '2017-01-18 18:51:39', 1),
(39, 18, 17, 'last dernier', '2017-02-02 12:00:00', 1),
(25, 17, 18, 'essai réponse', '2017-01-02 00:00:00', 1),
(26, 17, 18, 're éssai', '2017-01-02 00:00:00', 1),
(27, 17, 18, 'essai', '2017-01-02 19:40:16', 1),
(40, 17, 19, 'dernier agaga', '2017-02-07 00:00:00', 2),
(29, 17, 18, 'test', '2017-01-15 19:43:35', 1),
(30, 17, 18, 'osef', '2017-01-15 19:50:53', 1),
(32, 17, 18, 'gvg', '2017-01-15 19:54:25', 1),
(38, 17, 18, 'test conv', '2017-01-23 09:46:10', 1),
(41, 17, 18, 'dfg', '2017-02-15 17:17:13', 1),
(42, 17, 19, 'test', '2017-02-15 18:55:45', 2),
(43, 17, 18, 'test modal', '2017-02-16 16:29:52', 1),
(44, 17, 19, 'yeah', '2017-02-20 13:24:34', 2),
(45, 17, 18, 'zfzf', '2017-02-24 09:40:34', 1),
(46, 17, 18, 'efefe', '2017-02-24 10:14:45', 1),
(47, 17, 18, 'osef', '2017-02-24 10:15:27', 1),
(50, 17, 18, 'test bulle', '2017-03-07 18:54:09', 1),
(51, 17, 18, 'très très long texte agahyfhb iazjeeeeeeadadazd', '2017-03-07 18:54:55', 1),
(52, 17, 19, 'yeah', '2017-03-09 19:13:15', 2),
(53, 17, 19, 'yay', '2017-03-10 09:56:35', 2),
(54, 17, 18, 'qsd', '2017-05-05 19:12:59', 1),
(55, 17, 18, 'test', '2017-05-07 08:46:56', 1),
(56, 17, 19, 'test', '2017-05-09 19:06:40', 2),
(57, 17, 18, 'test', '2017-05-11 15:14:22', 1),
(58, 17, 18, 'test', '2017-05-11 15:15:42', 1),
(59, 17, 18, 'test', '2017-05-11 19:03:37', 1),
(60, 17, 18, 'sdf', '2017-05-11 19:04:24', 1),
(61, 17, 18, 'sd', '2017-05-11 19:05:07', 1),
(62, 17, 19, 'test', '2017-05-20 09:09:28', 2),
(63, 17, 19, 'essair', '2017-05-20 09:10:58', 2),
(64, 17, 19, 'test', '2017-05-20 09:11:50', 2),
(65, 17, 19, 'test', '2017-05-20 09:12:26', 2),
(66, 17, 18, 'test', '2017-05-22 09:03:14', 1),
(67, 18, 17, 'notif', '2017-05-22 09:04:14', 1),
(68, 18, 17, 'notif', '2017-05-22 09:04:43', 1),
(69, 17, 18, 'notif 2', '2017-05-22 09:06:55', 1),
(70, 17, 18, 'notif 3', '2017-05-22 09:07:37', 1),
(71, 18, 17, 'ahah nice', '2017-05-22 09:08:05', 1),
(72, 17, 18, 'essai', '2017-05-22 09:11:07', 1),
(73, 18, 17, 'test jqeury', '2017-05-28 19:10:47', 1),
(74, 18, 17, 're test jquery', '2017-05-28 19:27:48', 1),
(75, 18, 17, 'osef gg', '2017-05-29 18:52:33', 1),
(76, 17, 18, 'ajax de merde', '2017-05-29 19:01:44', 1),
(79, 18, 17, 'test update', '2017-06-04 08:47:50', 1),
(81, 18, 17, 're test', '2017-06-04 19:13:22', 1),
(77, 17, 18, 'test', '2017-06-04 08:23:11', 1),
(78, 17, 18, 'beuhihan', '2017-06-04 08:26:19', 1),
(80, 18, 17, 'tes conv masqué', '2017-06-04 08:49:29', 1);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notif` int(111) NOT NULL,
  `user_id` int(111) NOT NULL,
  `notification` text NOT NULL,
  `created` datetime NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id_notif`, `user_id`, `notification`, `created`, `statut`) VALUES
(17, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/users/profil/17">test</a> s\'est abonné', '2017-04-26 09:37:59', 1),
(18, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/users/profil/17">test</a> à commenté votre <a href="/instatux/post/8">publication</a><br /><br />test notif', '2017-04-27 19:02:48', 1),
(20, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> s\'est abonné', '2017-05-04 15:53:22', 1),
(21, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à commenté votre <a href="/instatux/post/8">publication</a><br /><br />gg', '2017-05-04 15:55:57', 1),
(22, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à commenté votre <a href="/instatux/post/8">publication</a><br /><br />test', '2017-05-04 15:57:46', 1),
(23, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à commenté votre <a href="/instatux/post/8">publication</a><br /><br />test', '2017-05-04 15:58:52', 1),
(26, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1">message</a> !;', '2017-05-22 09:07:37', 1),
(30, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/8">post</a> !', '2017-06-15 16:14:50', 0),
(31, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/8">post</a> !', '2017-06-16 15:24:50', 0),
(32, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/8">post</a> !', '2017-06-16 15:25:27', 0),
(33, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/8">post</a> !', '2017-06-16 16:00:53', 0),
(34, 18, '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/8">post</a> !', '2017-06-16 16:02:50', 0);

-- --------------------------------------------------------

--
-- Structure de la table `partage`
--

CREATE TABLE `partage` (
  `id_partage` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tweet_partage` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `partage`
--

INSERT INTO `partage` (`id_partage`, `user_id`, `tweet_partage`, `created`) VALUES
(22, 17, 8, '2017-06-16 15:25:27'),
(23, 17, 8, '2017-06-16 16:00:53'),
(24, 17, 8, '2017-06-16 16:02:50');

-- --------------------------------------------------------

--
-- Structure de la table `phinxlog`
--

CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT current_timestamp
) ;

--
-- Contenu de la table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`) VALUES
(20161103173418, 'AddDescriptionToUsers', '2016-11-03 16:35:28', '2016-11-03 16:35:28'),
(20161103173445, 'AddAvatarprofilToUsers', '2016-11-03 16:35:28', '2016-11-03 16:35:28'),
(20161103173500, 'AddAvatartweetToUsers', '2016-11-03 16:35:28', '2016-11-03 16:35:28');

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contenu_tweet` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `nb_commentaire` int(111) DEFAULT 0,
  `nb_partage` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tweet`
--

INSERT INTO `tweet` (`id`, `user_id`, `contenu_tweet`, `created`, `modified`, `nb_commentaire`, `nb_partage`) VALUES
(8, 18, 'accueuil moi', '2016-09-06 19:35:36', '2016-09-06 19:35:36', 6, 3),
(15, 19, 'accueuil test 2 essai', '2016-10-07 08:50:07', '2016-10-07 08:50:07', 1, 0),
(43, 17, '<p>Meilleur framework PHP</p><div data-oembed-url="http://cakephp.org/"><a href="https://cakephp.org/" data-iframely-url="//cdn.iframe.ly/LSanG5">CakePHP - Build fast, grow solid | PHP Framework | Home</a><script async="" src="//cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-02-15 16:03:22', '2017-02-15 16:03:22', 1, 1),
(46, 17, '<p>test</p>', '2017-04-21 09:02:20', '2017-04-21 09:02:20', 8, 4);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `avatarprofil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `modified`, `description`, `avatarprofil`) VALUES
(17, 'test', '$2y$10$UIQ9op5aAipqz8pDVruLU.pvOIj1kWtiYDxejEP9J40xE439wn1W6', 'alexa@gmail.com', '2016-09-02 12:08:17', '2016-11-06 20:04:04', 'ma description', 'avatars/1480966833_183.jpg'),
(18, 'essai', '$2y$10$iXLVGo6eGEB2cTKBpg/nieN5xr/VfBLiKl9LFBcQ1nVAfW00I3JOG', 'osef@gmail.com', '2016-09-06 19:03:25', '2016-09-06 19:03:25', 'essai cakephp 3', 'avatars/warcraft.png'),
(19, 'test2', '$2y$10$UDe2RZRiavxk55ebkfOlA.J4TS6HKOlB25.PXLCZl06MZlrhJ3JB6', 'test2@gmail.com', '2016-10-07 08:47:30', '2016-10-07 08:47:30', 'test cakephp 3', 'avatars/default.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_key` (`suivi`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tweet_id` (`tweet_id`),
  ADD KEY `auteur` (`user_id`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messagerie`
--
ALTER TABLE `messagerie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notif`);

--
-- Index pour la table `partage`
--
ALTER TABLE `partage`
  ADD PRIMARY KEY (`id_partage`),
  ADD KEY `partageur` (`user_id`),
  ADD KEY `tweet_partage` (`tweet_partage`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_key` (`user_id`);
ALTER TABLE `tweet` ADD FULLTEXT KEY `search_tweet` (`contenu_tweet`);
ALTER TABLE `tweet` ADD FULLTEXT KEY `search` (`contenu_tweet`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD FULLTEXT KEY `search_users` (`username`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `id_partage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `partage`
--
ALTER TABLE `partage`
  ADD CONSTRAINT `partage_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `partage_ibfk_2` FOREIGN KEY (`tweet_partage`) REFERENCES `tweet` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
