-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 26 Novembre 2017 à 21:30
-- Version du serveur :  10.2.10-MariaDB-10.2.10+maria~xenial
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

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
  `user_id` varchar(255) NOT NULL,
  `suivi` varchar(255) NOT NULL,
  `etat` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `user_id`, `suivi`, `etat`) VALUES
(118, 'essai', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

CREATE TABLE `aime` (
  `id` int(111) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tweet_aime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `aime`
--

INSERT INTO `aime` (`id`, `username`, `tweet_aime`) VALUES
(229, 'test', 256),
(233, 'essai', 249),
(234, 'essai', 248),
(235, 'essai', 242),
(240, 'essai', 250),
(243, 'test', 248),
(256, 'test', 252),
(264, 'test', 262),
(266, 'test', 87),
(267, 'test', 15),
(268, 'test', 250),
(269, 'test', 43);

-- --------------------------------------------------------

--
-- Structure de la table `blocage`
--

CREATE TABLE `blocage` (
  `id` int(11) NOT NULL,
  `bloqueur` varchar(255) NOT NULL,
  `bloquer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(33, 'commentaire', '15', '17', '2017-02-25 16:08:32'),
(129, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:36:26'),
(128, 'Le livre de cuisine CakePHP est un projet libre et communautaire d’édition de la documentation. Remarquez le bouton icone en forme de crayon fixé dans le coin en haut à droite; il vous redirigera vers l’éditeur en ligne de GitHub pour la page active, vous permettant de contribuer, d’ajouter, de supprimer ou corriger la documentation.', '46', '17', '2017-04-24 16:35:40'),
(151, 'dhdf', '74', '17', '2017-06-20 10:00:00'),
(152, 'qfgq', '8', '17', '2017-06-20 12:57:44'),
(153, 'w<vc', '8', '17', '2017-06-20 12:57:48'),
(230, 'test', '43', '17', '2017-06-20 14:00:12'),
(170, '#facebook lol', '137', '17', '2017-07-04 09:04:53'),
(229, 'omfg ça marche', '293', '18', '2017-11-14 16:19:43'),
(157, 'test', '43', '17', '2017-06-20 14:00:12'),
(159, 'test', '43', '17', '2017-06-20 14:16:54'),
(160, 'test', '43', '17', '2017-06-20 14:17:35'),
(161, 'test', '43', '17', '2017-06-20 14:21:51'),
(226, 'last comm', '43', '17', '2017-11-08 13:07:12'),
(225, 'clair', '248', '18', '2017-10-27 15:28:39'),
(166, 'test', '81', '17', '2017-06-21 09:18:41'),
(171, 'test', '138', '17', '2017-07-05 09:32:20'),
(172, 'gg', '138', '17', '2017-07-07 13:28:36'),
(173, 'c\'est qui ?', '138', '18', '2017-07-14 08:23:15'),
(174, 'wtf ?', '138', '18', '2017-07-14 08:23:51'),
(175, 'hein ?', '88', '17', '2017-07-14 15:01:16'),
(176, 'wut ?', '155', '18', '2017-07-14 15:06:58'),
(177, 'pff', '155', '18', '2017-07-14 15:08:47'),
(178, 're test', '155', '18', '2017-07-14 15:10:15'),
(179, 're rere ', '155', '18', '2017-07-14 15:10:44'),
(180, 'test', '138', '18', '2017-07-14 15:11:13'),
(181, 'best framework eu', '156', '18', '2017-07-16 09:44:12'),
(182, '#jenniferlopez <3', '178', '18', '2017-07-17 08:38:10'),
(183, 'test', '8', '17', '2017-07-17 16:28:55'),
(192, '<a href="../test">@test</a>', '194', '17', '2017-07-19 09:08:37'),
(205, '<a href="../test">@test</a>', '196', '18', '2017-07-20 09:23:58'),
(206, '<a href="../test">@test</a>', '196', '18', '2017-07-20 09:24:53'),
(194, '<a href="../test">@test</a> <a href="../essai">@essai</a> <a href="../search-%23teamgius">#teamgius</a>', '98', '18', '2017-07-19 12:28:05'),
(195, '<a href="../test">@test</a> <a href="../essai">@essai</a> <a href="../search-%23teamgius">#teamgius</a>', '196', '18', '2017-07-19 12:32:59'),
(196, '<a href="../test">@test</a> <a href="../essai">@essai</a> <a href="../search-%23teamgius">#teamgius</a>', '196', '18', '2017-07-19 12:34:57'),
(197, '<a href="../test">@test</a> <a href="../essai">@essai</a> <a href="../search-%23teamgius">#teamgius</a>', '196', '18', '2017-07-19 12:38:18'),
(198, '<a href="../test">@test</a>', '196', '18', '2017-07-20 09:12:04'),
(199, '<a href="../test">@test</a>', '196', '18', '2017-07-20 09:13:25'),
(200, '<a href="../test">@test</a> <a href="../test2">@test2</a>', '196', '17', '2017-07-20 09:16:58'),
(201, '<a href="../test">@test</a> <a href="../test2">@test2</a>', '196', '17', '2017-07-20 09:17:43'),
(207, '<a href="../test">@test</a>', '196', '18', '2017-07-20 09:25:24'),
(208, '<a href="../test">@test</a>', '196', '18', '2017-07-20 09:27:43'),
(209, '<a href="../test">@test</a> <a href="../test2">@test2</a>', '196', '18', '2017-07-20 09:28:14'),
(210, 'quoi ?', '226', '17', '2017-07-24 12:33:26'),
(211, 'va te faire', '226', '18', '2017-07-24 12:35:14'),
(212, 'fgd', '211', '18', '2017-08-07 09:05:22'),
(216, 'dfg', '245', '17', '2017-09-24 09:27:37'),
(215, 'dfg', '243', '17', '2017-09-22 15:32:30'),
(222, 'rtyrt', '95', '18', '2017-09-26 00:00:00'),
(221, 'dfg', '95', '17', '2017-09-30 12:11:51'),
(224, 'en effet', '43', '18', '2017-10-09 15:18:35'),
(227, 're last comm', '43', '17', '2017-11-08 13:07:17'),
(228, 'test', '43', '17', '2017-11-10 14:11:32'),
(231, 'test', '43', '17', '2017-06-20 14:16:54'),
(232, 'test', '43', '17', '2017-06-20 14:16:54'),
(233, 'test', '43', '17', '2017-06-20 14:16:54'),
(234, 'test', '43', '17', '2017-06-20 14:16:54'),
(235, 'omfg ça marche', '310', '18', '2017-11-23 15:33:52');

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(111) NOT NULL,
  `conv` int(111) NOT NULL,
  `participant1` varchar(255) NOT NULL,
  `participant2` varchar(255) NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `conv`, `participant1`, `participant2`, `statut`) VALUES
(43, 1768986576, 'test', 'essai', 1),
(44, 1768986576, 'essai', 'test', 1),
(49, 2078660550, 'test', 'test2', 0),
(50, 2078660550, 'test2', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `hashtag`
--

CREATE TABLE `hashtag` (
  `id` int(111) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `nb_tag` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `hashtag`
--

INSERT INTO `hashtag` (`id`, `tag`, `nb_tag`) VALUES
(1, 'foot', 2),
(2, 'catch', 6),
(3, 'cakephp', 19),
(4, 'laravel', 31),
(5, 'nikkibella', 5),
(6, 'jenniferlopez', 10),
(9, 'symfony', 14),
(10, 'facebook', 46),
(15, 'jloestmoche', 1),
(16, 'venestbeau', 1),
(18, 'osefman156', 1),
(19, 'osef', 2),
(20, 'test', 3),
(21, 'teamgius', 1),
(22, 'gg', 1),
(23, 'lol', 1),
(24, '39', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `destinataire` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created` datetime NOT NULL,
  `conv` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `user_id`, `destinataire`, `message`, `created`, `conv`) VALUES
(151, 'essai', 'test', 'notif', '2017-11-23 15:32:25', 1768986576),
(150, 'test', 'essai', 'new test osef', '2017-11-04 10:22:45', 1768986576),
(149, 'test', 'essai', 'last de nouveau', '2017-11-03 16:06:01', 1768986576),
(148, 'test', 'essai', 'last', '2017-11-01 13:55:38', 1768986576),
(147, 'test', 'essai', 'juju', '2017-11-01 13:38:59', 1768986576),
(146, 'test', 'essai', 'dernier lol', '2017-11-01 13:30:16', 1768986576),
(145, 'test', 'essai', 'xd', '2017-11-01 12:54:54', 1768986576),
(144, 'test', 'essai', 'lol', '2017-11-01 12:54:49', 1768986576),
(143, 'test', 'essai', 'gg', '2017-11-01 12:54:46', 1768986576),
(142, 'test', 'essai', 'osef', '2017-11-01 12:54:43', 1768986576),
(141, 'test', 'essai', 'test', '2017-11-01 12:54:39', 1768986576),
(140, 'essai', 'test', 'test', '2017-10-31 16:51:07', 1768986576),
(139, 'essai', 'test', 'je t\'aime', '2017-10-31 14:23:21', 1768986576),
(138, 'test', 'test2', 'yo 2', '2017-10-31 09:57:34', 2078660550),
(136, 'test', 'essai', 'test', '2017-10-31 09:56:44', 1768986576),
(135, 'test', 'essai', 'test', '2017-10-31 09:52:06', 1768986576),
(133, 'test', 'essai', 'yo', '2017-10-31 09:51:28', 1768986576),
(137, 'test', 'test2', 'yo', '2017-10-31 09:57:23', 2078660550);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notif` int(111) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `created` datetime NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `type_notif` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id_notif`, `user_name`, `notification`, `created`, `statut`, `type_notif`) VALUES
(222, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-26 09:28:06', 1, 'message'),
(223, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-26 09:30:27', 1, 'message'),
(225, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-26 09:30:35', 1, 'message'),
(226, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à partagé votre <a href="/instatux/post/43">post</a> !', '2017-10-27 15:25:52', 1, 'partage'),
(227, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à commenté votre <a href="/instatux/post/248">publication</a><br /><br />clair', '2017-10-27 15:28:39', 1, 'commentaire'),
(228, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à partagé votre <a href="/instatux/post/95">post</a> !', '2017-10-27 15:30:17', 1, 'partage'),
(230, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-30 09:50:57', 1, 'message'),
(231, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-30 09:53:04', 1, 'message'),
(232, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-10-31 09:51:28', 1, 'message'),
(233, 'test2', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-254331977">message</a> !', '2017-10-31 09:51:46', 0, 'message'),
(234, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-10-31 09:52:06', 1, 'message'),
(235, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-10-31 09:56:44', 1, 'message'),
(236, 'test2', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-2078660550">message</a> !', '2017-10-31 09:57:23', 0, 'message'),
(237, 'test2', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-2078660550">message</a> !', '2017-10-31 09:57:34', 0, 'message'),
(240, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:39', 1, 'message'),
(241, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:43', 1, 'message'),
(242, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:46', 1, 'message'),
(243, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:49', 1, 'message'),
(244, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:54', 1, 'message'),
(245, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 13:30:16', 1, 'message'),
(246, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 13:38:59', 1, 'message'),
(247, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 13:55:38', 1, 'message'),
(248, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à vous à cité dans un <a href="/instatux/post/261">tweet</a>', '2017-11-03 10:35:01', 1, 'citation'),
(249, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-03 16:06:01', 1, 'message'),
(268, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à partagé votre <a href="/instatux/post/256">post</a> !', '2017-11-23 15:31:17', 1, 'partage'),
(269, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à vous à cité dans un <a href="/instatux/post/311">tweet</a>', '2017-11-23 15:31:55', 1, 'citation'),
(270, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-23 15:32:25', 1, 'message'),
(271, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a><span class="alias_tweet">@essai</span> s\'est abonné', '2017-11-23 15:33:27', 1, 'abonnement'),
(272, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à commenté votre <a href="/instatux/post/310">publication</a><br /><br />omfg ça marche', '2017-11-23 15:33:52', 1, 'commentaire');

-- --------------------------------------------------------

--
-- Structure de la table `partage`
--

CREATE TABLE `partage` (
  `id_partage` int(11) NOT NULL,
  `tweet_partage` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `partage`
--

INSERT INTO `partage` (`id_partage`, `tweet_partage`, `created`) VALUES
(1, 8, '2017-06-19 19:34:03'),
(2, 43, '2017-06-20 14:00:00'),
(3, 43, '2017-06-20 14:18:08'),
(4, 8, '2017-06-21 09:16:55'),
(5, 8, '2017-06-21 09:18:33'),
(6, 8, '2017-06-21 12:22:47'),
(7, 8, '2017-06-21 12:23:49'),
(8, 8, '2017-06-21 12:25:58'),
(9, 8, '2017-06-22 12:04:30'),
(10, 15, '2017-06-22 12:04:39'),
(11, 87, '2017-06-23 12:56:27'),
(13, 87, '2017-06-26 08:53:33'),
(14, 8, '2017-07-14 15:00:36'),
(16, 8, '2017-07-17 08:05:48'),
(17, 8, '2017-07-17 08:10:31'),
(18, 8, '2017-07-17 08:10:52'),
(19, 8, '2017-07-17 08:12:35'),
(34, 8, '2017-09-11 19:08:09'),
(35, 8, '2017-09-11 19:13:25'),
(36, 8, '2017-09-11 19:14:41'),
(37, 8, '2017-09-11 19:29:41'),
(38, 8, '2017-09-12 08:11:07'),
(39, 8, '2017-09-12 08:13:30'),
(40, 242, '2017-10-05 09:02:23'),
(41, 43, '2017-10-27 15:25:52'),
(42, 95, '2017-10-27 15:30:17'),
(43, 95, '2017-10-27 15:30:24'),
(46, 8, '2017-11-09 10:38:48'),
(47, 241, '2017-11-09 10:38:55'),
(48, 8, '2017-11-09 10:38:59'),
(49, 8, '2017-11-09 13:20:04'),
(50, 241, '2017-11-09 13:23:42'),
(51, 241, '2017-11-09 13:24:04'),
(52, 303, '2017-11-20 12:52:04'),
(53, 256, '2017-11-23 15:31:17');

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
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `type_profil` tinyint(1) NOT NULL DEFAULT 0,
  `notif_cite` varchar(3) NOT NULL DEFAULT 'oui',
  `notif_partage` varchar(3) NOT NULL DEFAULT 'oui',
  `notif_abo` varchar(3) NOT NULL DEFAULT 'oui',
  `notif_comm` varchar(3) NOT NULL DEFAULT 'oui',
  `notif_message` varchar(3) NOT NULL DEFAULT 'oui'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `user_id`, `type_profil`, `notif_cite`, `notif_partage`, `notif_abo`, `notif_comm`, `notif_message`) VALUES
(3, 'test', 0, 'non', 'oui', 'oui', 'oui', 'non'),
(5, 'essai', 0, 'oui', 'oui', 'oui', 'oui', 'oui'),
(6, 'osefman', 0, 'oui', 'oui', 'oui', 'oui', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_timeline` varchar(255) NOT NULL,
  `contenu_tweet` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `share` int(111) DEFAULT 0,
  `nb_commentaire` int(111) DEFAULT 0,
  `nb_partage` int(111) NOT NULL DEFAULT 0,
  `nb_like` int(111) NOT NULL DEFAULT 0,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comment` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tweet`
--

INSERT INTO `tweet` (`id`, `user_id`, `user_timeline`, `contenu_tweet`, `created`, `share`, `nb_commentaire`, `nb_partage`, `nb_like`, `private`, `allow_comment`) VALUES
(8, 'essai', 'essai', '<p>accueil moi</p>', '2016-09-06 19:35:36', 0, 5, 21, 0, 0, 0),
(15, 'test2', 'test2', '<p>accueil test 2 essai</p>', '2016-10-07 08:50:07', 0, 1, 1, 1, 0, 0),
(43, 'test', 'test', '<p>Meilleur framework PHP</p><div data-oembed-url="http://cakephp.org/"><a href="https://cakephp.org/" data-iframely-url="//cdn.iframe.ly/LSanG5">CakePHP - Build fast, grow solid | PHP Framework | Home</a><script async="" src="//cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-02-15 16:03:22', 0, 8, 3, 1, 1, 0),
(87, 'test2', 'test', 'accueuil test 2 essai', '2017-06-22 12:04:39', 1, 0, 2, 1, 0, 0),
(95, 'test', 'test', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-07-01 16:37:56', 0, 1, 2, 0, 0, 1),
(241, 'essai', 'essai', '<p>pas voir</p>', '2017-09-12 08:16:45', 0, 0, 3, 0, 1, 0),
(242, 'essai', 'essai', '<p><a href="search-%23facebook</p>">#facebook</p></a>', '2017-09-14 12:34:31', 0, 0, 1, 1, 0, 1),
(248, 'test', 'essai', '<p>Meilleur framework PHP</p><div data-oembed-url="http://cakephp.org/"><a href="https://cakephp.org/" data-iframely-url="//cdn.iframe.ly/LSanG5">CakePHP - Build fast, grow solid | PHP Framework | Home</a><script async="" src="//cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-10-27 15:25:52', 1, 1, 0, 2, 0, 0),
(249, 'test', 'essai', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-10-27 15:30:17', 1, 0, 0, 1, 0, 0),
(250, 'test', 'essai', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-10-27 15:30:24', 1, 0, 0, 2, 0, 0),
(251, 'test', 'test', '<div data-oembed-url="http://www4.0zz0.com/2017/11/01/14/943111541.jpg"><div style="max-width: 1296px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 124.9074%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/QPjGWAO" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-11-03 10:29:59', 0, 0, 0, 0, 0, 0),
(252, 'test', 'test', '<div data-oembed-url="https://i.redd.it/07gyjkopm2vz.png"><div style="max-width: 1728px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 177.7778%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/G45pTO1" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-11-03 10:30:39', 0, 0, 0, 1, 0, 0),
(253, 'test', 'test', '<div data-oembed-url="https://www.youtube.com/watch?v=_MQQAab97Wc&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/_MQQAab97Wc?rel=0&amp;showinfo=0" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-11-03 10:31:41', 0, 0, 0, 1, 0, 0),
(256, 'test', 'test', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-03 10:33:46', 0, 0, 1, 2, 0, 0),
(262, 'test', 'test', '<div data-oembed-url="https://out.reddit.com/t3_7achq2?url=https%3A%2F%2Fi.imgur.com%2FmyWL1rv.jpg&amp;token=AQAAjFT8WbJ1XM5CjQwefLOmj6P5jaJhoJQt11wdrMz4_K1vhq1Y&amp;app_name=reddit.com"><blockquote class="imgur-embed-pub" data-id="myWL1rv" lang="en"><a href="https://imgur.com/myWL1rv">View post on imgur.com</a></blockquote><script async="" src="//s.imgur.com/min/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-03 10:36:05', 0, 0, 0, 2, 1, 0),
(292, 'essai', 'osefman', '<p>pas voir</p>', '2017-11-09 13:24:04', 1, 0, 0, 0, 0, 0),
(310, 'test', 'essai', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-23 15:31:17', 1, 1, 0, 0, 0, 0),
(311, 'essai', 'essai', '<p><a href="test">@test</a> yo !</p>', '2017-11-23 15:31:55', 0, 0, 0, 0, 0, 0),
(312, 'essai', 'essai', '<p><a href="search-%23facebook</p>">#facebook</p></a>', '2017-11-23 15:34:32', 0, 0, 0, 0, 0, 0);

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
  `avatarprofil` varchar(255) DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `modified`, `description`, `avatarprofil`, `lieu`, `website`) VALUES
(17, 'test', '$2y$10$UIQ9op5aAipqz8pDVruLU.pvOIj1kWtiYDxejEP9J40xE439wn1W6', 'alexa@gmail.com', '2016-09-02 12:08:17', '2017-08-13 18:48:06', 'Développeur WEB, créateur d\'Instatux', 'avatars/1480966833_183.jpg', 'New York', 'https://christophekheder.com/'),
(18, 'essai', '$2y$10$iXLVGo6eGEB2cTKBpg/nieN5xr/VfBLiKl9LFBcQ1nVAfW00I3JOG', 'osef@gmail.com', '2016-09-06 19:03:25', '2016-09-06 19:03:25', 'essai cakephp 3', 'avatars/warcraft.png', NULL, ''),
(19, 'test2', '$2y$10$UDe2RZRiavxk55ebkfOlA.J4TS6HKOlB25.PXLCZl06MZlrhJ3JB6', 'test2@gmail.com', '2016-10-07 08:47:30', '2016-10-07 08:47:30', 'test cakephp 3', 'avatars/default.png', NULL, ''),
(63, 'osefman', '$2y$10$ogM/Rds30RYxjktgdyRRLeQzaD7w8Egon7iysEDFOrz1SNH3D4tMi', 'testred@gmail.com', '2017-11-09 13:23:25', '2017-11-09 13:23:25', NULL, 'avatars/default.png', NULL, NULL);

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
-- Index pour la table `aime`
--
ALTER TABLE `aime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aime_fk` (`tweet_aime`);

--
-- Index pour la table `blocage`
--
ALTER TABLE `blocage`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `hashtag`
--
ALTER TABLE `hashtag`
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
  ADD KEY `tweet_partage` (`tweet_partage`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;
--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;
--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `id_partage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `aime`
--
ALTER TABLE `aime`
  ADD CONSTRAINT `aime_fk` FOREIGN KEY (`tweet_aime`) REFERENCES `tweet` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `partage`
--
ALTER TABLE `partage`
  ADD CONSTRAINT `partage_ibfk_2` FOREIGN KEY (`tweet_partage`) REFERENCES `tweet` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
