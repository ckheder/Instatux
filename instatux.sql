-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 12 Juin 2018 à 14:30
-- Version du serveur :  10.2.15-MariaDB-10.2.15+maria~xenial
-- Version de PHP :  7.1.18-1+ubuntu16.04.1+deb.sury.org+1

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
(233, 'essai', 249),
(234, 'essai', 248),
(235, 'essai', 242),
(240, 'essai', 250),
(243, 'test', 248),
(256, 'test', 252),
(268, 'test', 250),
(275, 'essai', 324),
(276, 'test', 324),
(279, 'test', 242),
(287, 'test', 325),
(289, 'essai', 325);

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
  `id` int(255) NOT NULL,
  `comm` text COLLATE utf8mb4_bin NOT NULL,
  `tweet_id` varchar(11) CHARACTER SET latin1 DEFAULT NULL,
  `user_id` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `edit` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `comm`, `tweet_id`, `user_id`, `created`, `edit`) VALUES
(831, 'test', '325', '17', '2018-06-11 10:16:26', 0),
(830, 'gg', '325', '17', '2018-06-11 10:14:10', 0),
(829, 'et là', '325', '17', '2018-06-11 10:13:01', 0),
(828, 'test', '325', '17', '2018-06-11 10:12:20', 0),
(827, 'osefman', '325', '17', '2018-06-11 10:12:07', 0),
(826, 'osefman', '325', '17', '2018-06-11 10:11:43', 0),
(825, 'cb', '325', '17', '2018-06-11 10:10:13', 0),
(824, 'essai 3', '325', '17', '2018-06-11 10:09:33', 0),
(823, 'essai 2', '325', '17', '2018-06-11 10:08:50', 0),
(822, 'essai', '325', '17', '2018-06-11 10:06:55', 0),
(821, 'test', '325', '17', '2018-06-10 21:59:54', 0),
(820, 'vpyons', '325', '17', '2018-06-10 21:59:49', 0),
(819, 'test', '325', '17', '2018-06-10 21:58:49', 0),
(742, ' cvb', '325', '17', '2018-06-08 14:45:23', 0),
(740, ' cvb', '325', '17', '2018-06-08 14:45:22', 0),
(741, ' cvb', '325', '17', '2018-06-08 14:45:23', 0),
(738, ' cvb', '325', '17', '2018-06-08 14:45:22', 0),
(739, ' cvb', '325', '17', '2018-06-08 14:45:22', 0),
(726, ' cvb', '325', '17', '2018-06-08 14:45:20', 0),
(762, 'test', '325', '17', '2018-06-08 17:54:16', 0),
(761, 'test', '325', '17', '2018-06-08 17:54:16', 0),
(760, 'dsf', '325', '17', '2018-06-08 14:54:27', 0),
(759, 'fr', '325', '17', '2018-06-08 14:54:14', 0),
(758, 'fr', '325', '17', '2018-06-08 14:54:14', 0),
(752, 'test', '325', '17', '2018-06-08 14:51:04', 0),
(735, ' cvb', '325', '17', '2018-06-08 14:45:21', 0),
(736, ' cvb', '325', '17', '2018-06-08 14:45:21', 0),
(737, ' cvb', '325', '17', '2018-06-08 14:45:22', 0),
(724, ' cvb', '325', '17', '2018-06-08 14:45:19', 0),
(688, 'osef', '325', '17', '2018-06-06 10:25:00', 0),
(687, 'test', '325', '17', '2018-06-06 10:24:46', 0),
(686, 'wxc', '325', '17', '2018-06-06 10:24:40', 0),
(685, 'lol', '325', '17', '2018-06-06 10:21:16', 0),
(725, ' cvb', '325', '17', '2018-06-08 14:45:20', 0),
(683, 'gg', '325', '17', '2018-06-06 10:21:07', 0),
(722, 'gg', '325', '17', '2018-06-08 14:41:40', 0),
(751, 'fr', '325', '17', '2018-06-08 14:49:38', 0),
(719, 'de', '325', '17', '2018-06-08 09:53:12', 0),
(720, 'cdf', '325', '17', '2018-06-08 09:53:16', 0),
(721, 'test', '325', '17', '2018-06-08 14:39:02', 0),
(677, 'test', '325', '17', '2018-06-05 17:02:40', 0),
(676, 'fais chier', '252', '18', '2018-06-05 15:31:53', 0),
(675, 'fais chier', '252', '18', '2018-06-05 15:31:53', 0),
(674, 'site de merde', '252', '18', '2018-06-05 15:31:49', 0),
(673, 'site de merde', '252', '18', '2018-06-05 15:30:44', 0),
(716, 'fr', '325', '17', '2018-06-08 09:15:19', 0),
(717, 'test', '325', '17', '2018-06-08 09:51:47', 0),
(670, 'cv', '325', '17', '2018-06-05 15:26:55', 0),
(723, ' cvb', '325', '17', '2018-06-08 14:45:19', 0),
(413, 'sdf', '325', '17', '2018-05-03 14:35:16', 0),
(407, 'sdf', '325', '17', '2018-05-03 14:35:16', 0),
(393, 'test 5', '336', '18', '2018-03-21 14:39:31', 0),
(392, 'test 5', '336', '18', '2018-03-21 14:39:31', 0),
(391, 'test 5', '336', '18', '2018-03-21 14:39:30', 0),
(390, 'test 4', '336', '18', '2018-03-21 14:39:14', 0),
(389, 'test 4', '336', '18', '2018-03-21 14:39:14', 0),
(388, 'test 3', '336', '18', '2018-03-21 14:37:58', 0),
(387, 'test 2', '336', '18', '2018-03-21 10:28:07', 0),
(386, 'test', '336', '18', '2018-03-21 10:16:28', 0),
(362, 'test', '336', '17', '2018-03-12 15:04:29', 0),
(363, 'teret', '336', '17', '2018-03-12 21:15:52', 0),
(364, 'beuhihan', '336', '17', '2018-03-12 21:16:39', 0),
(365, 'wtf ?', '336', '18', '2018-03-12 21:16:44', 0),
(832, 'test', '325', '17', '2018-06-11 10:45:19', 0),
(833, 'gt', '325', '17', '2018-06-11 10:45:24', 0),
(834, 'osef', '325', '17', '2018-06-11 10:45:42', 0),
(835, 'xcwc', '325', '17', '2018-06-11 10:46:32', 0),
(836, 'mon comm', '325', '17', '2018-06-11 10:46:54', 0),
(396623746, 'test', '325', '17', '2018-06-12 09:29:43', 0),
(2018752444, 'ghj', '325', '17', '2018-06-12 10:32:51', 0),
(1637704706, 'test', '325', '17', '2018-06-12 10:34:03', 1),
(960322260, 'test update', '325', '17', '2018-06-12 14:29:24', 0);

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
(50, 2078660550, 'test2', 'test', 1),
(51, 401727966, 'test', 'osefman', 1),
(52, 401727966, 'osefman', 'test', 1);

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
(24, '39', 3),
(25, 'essai', 1);

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
(674, 'test', 'essai', 'bon', '2018-05-23 10:21:53', 1768986576),
(675, 'test', 'essai', 'bon g', '2018-05-23 14:49:49', 1768986576),
(676, 'test', 'essai', 'test', '2018-05-24 10:36:36', 1768986576),
(677, 'test', 'essai', 'test', '2018-05-24 10:37:16', 1768986576),
(678, 'test', 'essai', 'test', '2018-06-04 10:07:16', 1768986576);

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
(15, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 10:18:26', 1),
(16, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 10:19:02', 1),
(17, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 10:21:33', 1),
(18, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 10:22:03', 1),
(19, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 10:22:21', 1),
(20, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 11:22:00', 1),
(21, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 11:24:31', 1),
(22, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 11:26:56', 1),
(23, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 11:27:59', 1),
(24, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 11:28:13', 1),
(25, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 13:40:55', 1),
(26, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/354">post</a> !', '2018-05-01 13:41:00', 1),
(28, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 13:41:37', 1),
(29, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/354">post</a> !', '2018-05-01 13:41:41', 1),
(31, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/355">post</a> !', '2018-05-01 13:42:20', 1),
(32, 'osefman', '<img src="/instatux/img/avatars/1480966833_183.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/354">post</a> !', '2018-05-01 13:42:21', 1),
(86, 'essai', '<img src="/instatux/img/avatars/1526647771_877.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> souhaite s\'abonné\n            <a href="/instatux/abonnement/essai#demande">Gérer mes abonnements</a>', '2018-05-28 10:26:09', 1),
(87, 'essai', '<img src="/instatux/img/avatars/1526647771_877.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/292">post</a> !', '2018-06-07 10:21:10', 1);

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
(4, 8, '2017-06-21 09:16:55'),
(5, 8, '2017-06-21 09:18:33'),
(6, 8, '2017-06-21 12:22:47'),
(7, 8, '2017-06-21 12:23:49'),
(8, 8, '2017-06-21 12:25:58'),
(9, 8, '2017-06-22 12:04:30'),
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
(46, 8, '2017-11-09 10:38:48'),
(47, 241, '2017-11-09 10:38:55'),
(48, 8, '2017-11-09 10:38:59'),
(49, 8, '2017-11-09 13:20:04'),
(50, 241, '2017-11-09 13:23:42'),
(51, 241, '2017-11-09 13:24:04'),
(52, 303, '2017-11-20 12:52:04'),
(54, 252, '2017-11-28 13:09:31'),
(57, 292, '2018-04-30 10:12:31'),
(58, 292, '2018-04-30 10:12:46'),
(59, 292, '2018-04-30 10:12:48'),
(60, 292, '2018-04-30 10:12:49'),
(61, 292, '2018-04-30 15:10:32'),
(63, 292, '2018-04-30 15:11:44'),
(64, 292, '2018-04-30 15:11:57'),
(65, 292, '2018-04-30 15:12:50'),
(66, 292, '2018-05-01 10:10:01'),
(67, 292, '2018-05-01 10:10:10'),
(68, 292, '2018-05-01 10:14:22'),
(69, 292, '2018-05-01 10:15:19'),
(82, 292, '2018-05-01 13:41:03'),
(85, 292, '2018-05-01 13:41:44'),
(91, 292, '2018-06-07 10:21:10');

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
(3, 'test', 0, 'non', 'non', 'non', 'non', 'non'),
(5, 'essai', 1, 'oui', 'oui', 'oui', 'oui', 'non'),
(6, 'osefman', 0, 'oui', 'oui', 'non', 'oui', 'oui');

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
(241, 'essai', 'essai', '<p>pas voir</p>', '2017-09-12 08:16:45', 0, 0, 3, 0, 1, 0),
(242, 'essai', 'essai', '<p><a href="search-%23facebook</p>">#facebook</p></a>', '2017-09-14 12:34:31', 0, 0, 1, 2, 1, 1),
(248, 'test', 'essai', '<p>Meilleur framework PHP</p><div data-oembed-url="http://cakephp.org/"><a href="https://cakephp.org/" data-iframely-url="//cdn.iframe.ly/LSanG5">CakePHP - Build fast, grow solid | PHP Framework | Home</a><script async="" src="//cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-10-27 15:25:52', 1, 1, 0, 2, 0, 0),
(249, 'test', 'essai', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-10-27 15:30:17', 1, 0, 0, 1, 0, 0),
(250, 'test', 'essai', '<div data-oembed-url="https://www.youtube.com/watch?v=2vryJJllAsw&amp;t=0s"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 56.2493%;"><iframe tabindex="-1" src="https://www.youtube.com/embed/2vryJJllAsw?rel=0&amp;showinfo=0&amp;controls=2" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen="" scrolling="no"></iframe></div></div><p>&nbsp;</p>', '2017-10-27 15:30:24', 1, 0, 0, 2, 0, 0),
(252, 'test', 'test', '<div data-oembed-url="https://i.redd.it/07gyjkopm2vz.png"><div style="max-width: 1728px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 177.7778%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/G45pTO1" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-11-03 10:30:39', 0, 4, 1, 1, 0, 0),
(292, 'essai', 'osefman', '<p>pas voir</p>', '2017-11-09 13:24:04', 1, 0, 15, 0, 0, 0),
(310, 'test', 'essai', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-23 15:31:17', 1, 1, 0, 0, 0, 0),
(311, 'essai', 'essai', '<p><a href="test">@test</a> yo !</p>', '2017-11-23 15:31:55', 0, 0, 0, 0, 1, 0),
(312, 'essai', 'essai', '<p><a href="search-%23facebook</p>">#facebook</p></a>', '2017-11-23 15:34:32', 0, 0, 0, 0, 1, 0),
(317, 'test', 'essai', '<div data-oembed-url="https://out.reddit.com/t3_7achq2?url=https%3A%2F%2Fi.imgur.com%2FmyWL1rv.jpg&amp;token=AQAAjFT8WbJ1XM5CjQwefLOmj6P5jaJhoJQt11wdrMz4_K1vhq1Y&amp;app_name=reddit.com"><blockquote class="imgur-embed-pub" data-id="myWL1rv" lang="en"><a href="https://imgur.com/myWL1rv">View post on imgur.com</a></blockquote><script async="" src="//s.imgur.com/min/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-28 16:19:14', 1, 0, 0, 0, 0, 0),
(320, 'test', 'essai', '<div data-oembed-url="https://out.reddit.com/t3_7achq2?url=https%3A%2F%2Fi.imgur.com%2FmyWL1rv.jpg&amp;token=AQAAjFT8WbJ1XM5CjQwefLOmj6P5jaJhoJQt11wdrMz4_K1vhq1Y&amp;app_name=reddit.com"><blockquote class="imgur-embed-pub" data-id="myWL1rv" lang="en"><a href="https://imgur.com/myWL1rv">View post on imgur.com</a></blockquote><script async="" src="//s.imgur.com/min/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-30 10:11:13', 1, 0, 0, 0, 0, 0),
(321, 'test', 'essai', '<div data-oembed-url="http://www.20minutes.fr/"><a href="http://www.20minutes.fr/" data-iframely-url="https://cdn.iframe.ly/cqIqWR5">20 Minutes, information en continu. Actualit&eacute;s, Politique, Football,...</a><script async="" src="https://cdn.iframe.ly/embed.js" charset="utf-8"></script></div><p>&nbsp;</p>', '2017-11-30 10:11:46', 1, 0, 0, 0, 0, 0),
(324, 'essai', 'essai', '<p><a href="test">@test</a> <a href="osefman">@osefman</a></p>', '2017-11-30 10:15:38', 0, 0, 0, 2, 1, 0),
(325, 'test', 'test', '<div data-oembed-url="https://scontent-dft4-3.cdninstagram.com/t51.2885-15/e35/25013083_251948242004274_6743671715026436096_n.jpg"><div style="max-width: 1296px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 100%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/91HD3mZ" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-12-23 09:37:11', 0, 56, 0, 2, 0, 0);

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
(17, 'test', '$2y$10$UIQ9op5aAipqz8pDVruLU.pvOIj1kWtiYDxejEP9J40xE439wn1W6', 'alexa@gmail.com', '2016-09-02 12:08:17', '2018-05-24 10:22:27', 'cakephp 3 <3', 'avatars/1526647771_877.jpg', 'Metz', 'https://cakephp.org/'),
(18, 'essai', '$2y$10$iXLVGo6eGEB2cTKBpg/nieN5xr/VfBLiKl9LFBcQ1nVAfW00I3JOG', 'osef@gmail.com', '2016-09-06 19:03:25', '2018-05-23 10:24:40', 'essai cakephp 3', 'avatars/warcraft.png', 'Metz', ''),
(63, 'osefman', '$2y$10$ogM/Rds30RYxjktgdyRRLeQzaD7w8Egon7iysEDFOrz1SNH3D4tMi', 'testred@gmail.com', '2017-11-09 13:23:25', '2018-05-16 17:09:50', 'test', 'avatars/default/default.png', 'Metz', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;
--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=290;
--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT pour la table `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=679;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `id_partage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
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
