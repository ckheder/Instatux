-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 24 Décembre 2017 à 11:25
-- Version du serveur :  10.2.11-MariaDB-10.2.11+maria~xenial
-- Version de PHP :  7.1.12-3+ubuntu16.04.1+deb.sury.org+1

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
(266, 'test', 87),
(267, 'test', 15),
(268, 'test', 250),
(269, 'test', 43),
(274, 'test', 242),
(275, 'essai', 324),
(276, 'test', 324);

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
  `comm` text COLLATE utf8mb4_bin NOT NULL,
  `tweet_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `comm`, `tweet_id`, `user_id`, `created`) VALUES
(264, 'omfg ça marche', '262', '17', '2017-12-22 09:01:30'),
(288, 'test  <img src="/instatux/js/emoji/packs/basic/images/smile.png" alt="" class="emoji_comm" />', '262', '17', '2017-12-22 16:30:04'),
(280, ' <img src="/instatux/js/emoji/packs/basic/images/smile.png" alt="" class="emoji_comm" />', '262', '17', '2017-12-22 16:14:21'),
(281, ' <img src="/instatux/js/emoji/packs/basic/images/smile.png" alt="" class="emoji_comm" />', '262', '17', '2017-12-22 16:15:35'),
(293, ' <img src="/instatux/img/emoji/smile.png" alt="" class="emoji_comm" />', '325', '17', '2017-12-23 14:00:23'),
(289, 'test  <img src="/instatux/js/emoji/packs/basic/images/smile.png" alt="" class="emoji_comm" />', '262', '17', '2017-12-22 20:30:29'),
(292, ' <img src="/instatux/img/emoji/smile.png" alt="" class="emoji_comm" />', '325', '17', '2017-12-23 13:57:17'),
(291, ' <img src="/instatux/js/emoji/packs/basic/images/smile.png" alt="" class="emoji_comm" />', '256', '17', '2017-12-22 20:36:57'),
(294, ' <img src="/instatux/img/emoji/smile.png" alt="" class="emoji_comm" /> <a href="../search-%23facebook">#facebook</a> <a href="../test">@test</a>', '325', '17', '2017-12-23 19:33:21'),
(295, ' <img src="/instatux/img/emoji/smile.png" alt="" class="emoji_comm" /> <img src="/instatux/img/emoji/laughing.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/blush.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/smiley.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/relaxed.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-23 19:47:06'),
(296, ' <img src="/instatux/img/emoji/smirk.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/heart_eyes.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_heart.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_closed_eyes.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/flushed.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-23 19:47:22'),
(305, 'qfqfqf <img src="/instatux/img/emoji/smile.png" alt="" class="emoji_comm" />', '325', '17', '2017-12-24 09:54:28'),
(298, ' <img src="/instatux/img/emoji/anguished.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-23 19:48:02'),
(299, ' <img src="/instatux/img/emoji/astonished.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/bowtie.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/broken_heart.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/clap.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/confused.png" alt="" class="emoji_comm"/>:', '325', '17', '2017-12-23 19:48:16'),
(300, ' <img src="/instatux/img/emoji/disappointed.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/dizzy_face.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/fearful.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/grinning.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/hushed.png" alt="" class="emoji_comm" />', '325', '17', '2017-12-23 19:48:36'),
(301, ' <img src="/instatux/img/emoji/neutral_face.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/open_mouth.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/rage.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/scream.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/sleeping.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-23 19:48:47'),
(302, ' <img src="/instatux/img/emoji/stuck_out_tongue.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/sunglasses.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/tired_face.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/stuck_out_tongue_winking_eye.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/stuck_out_tongue_closed_eyes.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-23 19:49:15'),
(303, ' <img src="/instatux/img/emoji/trollface.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/unamused.png" alt="" class="emoji_comm"/> <img src="/instatux/img/emoji/worried.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-23 19:49:32'),
(304, ' <img src="/instatux/img/emoji/trollface.png" alt="" class="emoji_comm"/>', '325', '17', '2017-12-24 09:46:50');

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
(155, 'essai', 'test', 'test notif on veut pas', '2017-11-28 12:57:57', 1768986576),
(156, 'essai', 'test', 'test notif on veut pas', '2017-11-28 12:58:24', 1768986576),
(157, 'essai', 'test', 'test pas notif', '2017-11-28 12:58:34', 1768986576),
(158, 'essai', 'test', 'test ok', '2017-11-28 12:59:22', 1768986576),
(159, 'essai', 'test', 'dernier test', '2017-11-28 12:59:54', 1768986576),
(160, 'essai', 'test', 'ça crains ?', '2017-11-28 13:00:46', 1768986576),
(154, 'essai', 'test', 'test notif on veut pas', '2017-11-28 12:57:42', 1768986576),
(153, 'essai', 'test', 'test notif on veut pas', '2017-11-28 12:57:27', 1768986576),
(152, 'essai', 'test', 'test notif on veut pas', '2017-11-28 12:57:10', 1768986576),
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
(137, 'test', 'test2', 'yo', '2017-10-31 09:57:23', 2078660550),
(161, 'essai', 'test', 'testons', '2017-11-28 13:01:40', 1768986576),
(162, 'essai', 'test', 'test ?', '2017-11-28 13:02:27', 1768986576),
(163, 'test', 'essai', 'message de test', '2017-11-28 13:03:46', 1768986576),
(164, 'essai', 'test', 'message de essai', '2017-11-28 13:04:17', 1768986576),
(165, 'essai', 'test', 'new notif ?', '2017-11-28 16:05:53', 1768986576),
(166, 'essai', 'test', 'là oui :)', '2017-11-28 16:06:55', 1768986576),
(167, 'essai', 'test', 'test final :)', '2017-11-30 10:10:11', 1768986576),
(168, 'essai', 'test', 'test final 2', '2017-11-30 10:10:40', 1768986576),
(169, 'essai', 'test', 'lol ?', '2017-12-13 17:33:12', 1768986576),
(170, 'essai', 'test', 'sds', '2017-12-13 17:33:35', 1768986576),
(171, 'essai', 'test', 'beuhihan', '2017-12-14 10:12:54', 1768986576);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notif` int(111) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `created` datetime NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id_notif`, `user_name`, `notification`, `created`, `statut`) VALUES
(222, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-26 09:28:06', 1),
(223, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-26 09:30:27', 1),
(225, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-26 09:30:35', 1),
(226, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à partagé votre <a href="/instatux/post/43">post</a> !', '2017-10-27 15:25:52', 1),
(227, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à commenté votre <a href="/instatux/post/248">publication</a><br /><br />clair', '2017-10-27 15:28:39', 1),
(228, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à partagé votre <a href="/instatux/post/95">post</a> !', '2017-10-27 15:30:17', 1),
(230, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-30 09:50:57', 1),
(231, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1372035574">message</a> !', '2017-10-30 09:53:04', 1),
(232, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-10-31 09:51:28', 1),
(233, 'test2', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-254331977">message</a> !', '2017-10-31 09:51:46', 0),
(234, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-10-31 09:52:06', 1),
(235, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-10-31 09:56:44', 1),
(236, 'test2', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-2078660550">message</a> !', '2017-10-31 09:57:23', 0),
(237, 'test2', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-2078660550">message</a> !', '2017-10-31 09:57:34', 0),
(240, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:39', 1),
(241, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:43', 1),
(242, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:46', 1),
(243, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:49', 1),
(244, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 12:54:54', 1),
(245, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 13:30:16', 1),
(246, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 13:38:59', 1),
(247, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-01 13:55:38', 1),
(248, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> à vous à cité dans un <a href="/instatux/post/261">tweet</a>', '2017-11-03 10:35:01', 1),
(249, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-03 16:06:01', 1),
(268, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à partagé votre <a href="/instatux/post/256">post</a> !', '2017-11-23 15:31:17', 1),
(269, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> à vous à cité dans un <a href="/instatux/post/311">tweet</a>', '2017-11-23 15:31:55', 1),
(270, 'test', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/essai">essai</a> vous à envoyé un <a href="/instatux/conversation-1768986576">message</a> !', '2017-11-23 15:32:25', 1),
(293, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> s\'est abonné', '2017-12-08 16:38:09', 1),
(294, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> s\'est abonné', '2017-12-08 16:39:26', 1),
(295, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> s\'est abonné', '2017-12-08 16:40:54', 1),
(296, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> souhaite s\'abonné\n            <a href="/instatux/abonnement/">Gérer mes abonnements</a>', '2017-12-08 16:41:23', 1),
(298, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> souhaite s\'abonné\n            <a href="/instatux/abonnement/">Gérer mes abonnements</a>', '2017-12-08 20:18:27', 1),
(299, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> souhaite s\'abonné\n            <a href="/instatux/abonnement#tab-3">Gérer mes abonnements</a>', '2017-12-08 20:22:16', 1),
(300, 'essai', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail vcenter"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> souhaite s\'abonné\n            <a href="/instatux/abonnement#tabs-3">Gérer mes abonnements</a>', '2017-12-08 20:23:17', 1);

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
(53, 256, '2017-11-23 15:31:17'),
(54, 252, '2017-11-28 13:09:31');

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
(3, 'test', 1, 'non', 'non', 'non', 'oui', 'oui'),
(5, 'essai', 1, 'oui', 'oui', 'oui', 'oui', 'oui'),
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
(95, 'test', 'test', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-07-01 16:37:56', 0, 1, 2, 0, 1, 1),
(241, 'essai', 'essai', '<p>pas voir</p>', '2017-09-12 08:16:45', 0, 0, 3, 0, 1, 0),
(242, 'essai', 'essai', '<p><a href="search-%23facebook</p>">#facebook</p></a>', '2017-09-14 12:34:31', 0, 0, 1, 2, 0, 1),
(248, 'test', 'essai', '<p>Meilleur framework PHP</p><div data-oembed-url="http://cakephp.org/"><a href="https://cakephp.org/" data-iframely-url="//cdn.iframe.ly/LSanG5">CakePHP - Build fast, grow solid | PHP Framework | Home</a><script async="" src="//cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-10-27 15:25:52', 1, 1, 0, 2, 1, 0),
(249, 'test', 'essai', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-10-27 15:30:17', 1, 0, 0, 1, 1, 0),
(250, 'test', 'essai', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-10-27 15:30:24', 1, 0, 0, 2, 1, 0),
(251, 'test', 'test', '<div data-oembed-url="http://www4.0zz0.com/2017/11/01/14/943111541.jpg"><div style="max-width: 1296px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 124.9074%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/QPjGWAO" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-11-03 10:29:59', 0, 0, 0, 0, 1, 0),
(252, 'test', 'test', '<div data-oembed-url="https://i.redd.it/07gyjkopm2vz.png"><div style="max-width: 1728px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 177.7778%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/G45pTO1" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-11-03 10:30:39', 0, 0, 1, 1, 1, 0),
(253, 'test', 'test', '<div data-oembed-url="https://www.youtube.com/watch?v=_MQQAab97Wc&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/_MQQAab97Wc?rel=0&amp;showinfo=0" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-11-03 10:31:41', 0, 0, 0, 1, 1, 0),
(256, 'test', 'test', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-03 10:33:46', 0, 1, 1, 2, 1, 0),
(292, 'essai', 'osefman', '<p>pas voir</p>', '2017-11-09 13:24:04', 1, 0, 0, 0, 0, 0),
(310, 'test', 'essai', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-23 15:31:17', 1, 1, 0, 0, 1, 0),
(311, 'essai', 'essai', '<p><a href="test">@test</a> yo !</p>', '2017-11-23 15:31:55', 0, 0, 0, 0, 0, 0),
(312, 'essai', 'essai', '<p><a href="search-%23facebook</p>">#facebook</p></a>', '2017-11-23 15:34:32', 0, 0, 0, 0, 0, 0),
(317, 'test', 'essai', '<div data-oembed-url="https://out.reddit.com/t3_7achq2?url=https%3A%2F%2Fi.imgur.com%2FmyWL1rv.jpg&amp;token=AQAAjFT8WbJ1XM5CjQwefLOmj6P5jaJhoJQt11wdrMz4_K1vhq1Y&amp;app_name=reddit.com"><blockquote class="imgur-embed-pub" data-id="myWL1rv" lang="en"><a href="https://imgur.com/myWL1rv">View post on imgur.com</a></blockquote><script async="" src="//s.imgur.com/min/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-28 16:19:14', 1, 0, 0, 0, 1, 0),
(320, 'test', 'essai', '<div data-oembed-url="https://out.reddit.com/t3_7achq2?url=https%3A%2F%2Fi.imgur.com%2FmyWL1rv.jpg&amp;token=AQAAjFT8WbJ1XM5CjQwefLOmj6P5jaJhoJQt11wdrMz4_K1vhq1Y&amp;app_name=reddit.com"><blockquote class="imgur-embed-pub" data-id="myWL1rv" lang="en"><a href="https://imgur.com/myWL1rv">View post on imgur.com</a></blockquote><script async="" src="//s.imgur.com/min/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-30 10:11:13', 1, 0, 0, 0, 1, 0),
(321, 'test', 'essai', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-30 10:11:46', 1, 0, 0, 0, 1, 0),
(324, 'essai', 'essai', '<p><a href="test">@test</a> <a href="osefman">@osefman</a></p>', '2017-11-30 10:15:38', 0, 0, 0, 2, 0, 0),
(325, 'test', 'test', '<div data-oembed-url="https://scontent-dft4-3.cdninstagram.com/t51.2885-15/e35/25013083_251948242004274_6743671715026436096_n.jpg"><div style="max-width: 1296px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 100%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/91HD3mZ" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-12-23 09:37:11', 0, 13, 0, 0, 1, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;
--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=306;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=305;
--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `id_partage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
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
