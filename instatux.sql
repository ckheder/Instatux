-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 28 Juin 2018 à 15:38
-- Version du serveur :  10.2.16-MariaDB-10.2.16+maria~xenial
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

--
-- Contenu de la table `abonnement`
--

INSERT INTO `abonnement` (`id`, `user_id`, `suivi`, `etat`) VALUES
(307, 'osefman', 'test', 1),
(308, 'essai', 'test', 1);

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
(279, 'test', 242),
(289, 'essai', 325),
(290, 'test', 325);

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
(831, 'test <img src="/instatux/img/emoji/trollface.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-11 10:16:26', 1),
(830, 'gg <img src="/instatux/img/emoji/stuck_out_tongue_winking_eye.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-11 10:14:10', 1),
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
(832, 'test <img src="/instatux/img/emoji/rage.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-11 10:45:19', 1),
(833, 'gt <img src="/instatux/img/emoji/dizzy_face.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-11 10:45:24', 1),
(834, 'osef <img src="/instatux/img/emoji/laughing.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-11 10:45:42', 1),
(835, 'xcwc <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-11 10:46:32', 1),
(836, 'mon comm <img src="/instatux/img/emoji/confused.png" alt="" class="emoji_comm"/>:', '325', '17', '2018-06-11 10:46:54', 1),
(396623746, 'test <img src="/instatux/img/emoji/bowtie.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-12 09:29:43', 1),
(2018752444, 'ghj <img src="/instatux/img/emoji/dizzy_face.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-12 10:32:51', 1),
(1637704706, 'test', '325', '17', '2018-06-12 10:34:03', 1),
(1789336374, 'gg', '325', '17', '2018-06-19 14:32:26', 0),
(1284104919, 'test', '325', '17', '2018-06-19 14:33:00', 0),
(1126997285, 'rebug ?', '325', '17', '2018-06-19 14:33:26', 0),
(43903217, 'test', '390', '17', '2018-06-14 10:43:14', 0),
(1150172858, 'french', '390', '18', '2018-06-14 10:43:42', 0),
(1027986348, 'test', '390', '17', '2018-06-14 10:44:18', 0),
(1692103555, 'alors ?', '390', '18', '2018-06-14 10:46:45', 0),
(1343230564, 'arggg', '390', '18', '2018-06-14 10:49:57', 0),
(295569070, 'tin', '325', '18', '2018-06-19 17:32:59', 0),
(1360565439, 'lol', '325', '17', '2018-06-19 14:31:39', 0),
(1916399052, 'lol', '325', '17', '2018-06-19 14:31:35', 0),
(771569778, 'test', '325', '17', '2018-06-19 17:33:18', 0),
(1055510937, 'felkon', '325', '17', '2018-06-19 17:34:10', 1),
(1976844812, 'ah ben ça marche, modif wtf', '325', '18', '2018-06-19 17:34:19', 1),
(1351168884, 'hen', '325', '17', '2018-06-19 17:34:32', 1),
(1441466898, 'bug', '325', '18', '2018-06-19 17:37:57', 0),
(263120729, 'comm ?', '325', '17', '2018-06-19 19:50:36', 0),
(1386374175, 'comm ok ?', '325', '17', '2018-06-20 10:12:53', 0),
(498473387, 'test', '325', '18', '2018-06-20 10:13:18', 0),
(658387918, 'oui ben comm ok <img src="/instatux/img/emoji/heart_eyes.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 10:13:24', 1),
(1370837179, 'new comm', '325', '17', '2018-06-20 10:14:26', 0),
(1335190183, 'yo vivaldi on ets nul ?', '325', '17', '2018-06-20 10:20:14', 1),
(1977003712, 'bug vivaldi', '325', '18', '2018-06-20 10:20:44', 0),
(918496256, 'hein ? 2', '325', '17', '2018-06-20 10:21:02', 1),
(564640525, 'new', '325', '17', '2018-06-20 14:35:28', 0),
(240989083, 'test 6', '325', '17', '2018-06-20 10:21:52', 1),
(1708241529, 'erf 5', '325', '17', '2018-06-20 10:22:28', 1),
(272504557, 'erf 3', '325', '17', '2018-06-20 10:22:35', 1),
(458474222, 'osef <img src="/instatux/img/emoji/fearful.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 14:35:32', 1),
(316078881, 'test bh', '325', '17', '2018-06-20 14:31:27', 1),
(414880554, 'ta race vivaldi <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 14:42:12', 1),
(601490146, 'comm', '325', '17', '2018-06-20 11:03:21', 0),
(2087830383, 'va chier  <img src="/instatux/img/emoji/bowtie.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 11:04:36', 1),
(1851223844, 'hein 4', '325', '17', '2018-06-20 11:05:26', 1),
(1192168119, 'node de merde', '325', '17', '2018-06-20 14:25:25', 1),
(254672366, 'add 2', '325', '17', '2018-06-25 14:41:37', 0),
(414248952, 'erreur ? bgh', '325', '17', '2018-06-20 14:59:43', 1),
(882934463, 'buggué', '325', '18', '2018-06-20 15:00:17', 0),
(189746303, 'erreur ? <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 15:02:16', 1),
(121858191, 'test', '325', '17', '2018-06-20 14:36:43', 0),
(393289133, 'lol', '325', '17', '2018-06-20 14:36:49', 0),
(958543512, 'comprend rien <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 14:37:42', 1),
(842495140, 'rah$', '325', '17', '2018-06-20 14:38:10', 0),
(1933014971, 'xsd osef', '325', '17', '2018-06-20 14:38:17', 1),
(746665536, 'pff <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '18', '2018-06-20 15:05:08', 1),
(1741614609, 'ah ', '325', '17', '2018-06-20 15:05:19', 0),
(634984492, 'test', '325', '17', '2018-06-20 16:40:57', 0),
(1661270938, 'hein <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '17', '2018-06-20 16:41:04', 1),
(1167160060, 'osef <img src="/instatux/img/emoji/bowtie.png" alt="" class="emoji_comm"/>', '325', '18', '2018-06-20 16:41:46', 1),
(500878733, 'add <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '325', '17', '2018-06-25 14:41:24', 1),
(1115873060, 'pff', '390', '63', '2018-06-21 10:20:17', 0),
(272897399, 'erf', '325', '63', '2018-06-25 14:43:29', 0),
(598981740, 'erf', '390', '63', '2018-06-21 10:37:02', 0),
(1285147589, 'test 3   <img src="/instatux/img/emoji/kissing_heart.png" alt=":kissing_heart:" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_heart.png" alt=":kissing_heart:" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_heart.png" alt=":kissing_heart:" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_heart.png" alt=":kissing_heart:" class="emoji_comm"/>', '325', '17', '2018-06-21 15:04:59', 1),
(1187476270, 'tes 4    <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/><img src="/instatux/img/emoji/blush.png" alt=":blush:" class="emoji_comm"/>', '325', '17', '2018-06-22 11:18:51', 1),
(1142576330, 'test', '325', '17', '2018-06-24 14:43:58', 0),
(195952293, 'https://stackoverflow.com/questions/46349478/socket-emit-to-specific-rooms', '325', '17', '2018-06-28 11:11:54', 0);

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
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
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
(678, 'test', 'essai', 'test', '2018-06-04 10:07:16', 1768986576),
(679, 'osefman', 'test', 'test', '2018-06-14 14:45:27', 401727966),
(680, 'essai', 'test', 'osef', '2018-06-26 09:58:36', 1768986576),
(681, 'test', 'essai', 'erreur ?', '2018-06-26 10:01:33', 1768986576),
(682, 'test', 'essai', 'test', '2018-06-26 10:05:13', 1768986576),
(683, 'test', 'essai', 'french', '2018-06-26 10:14:39', 1768986576),
(684, 'test', 'essai', 'test', '2018-06-26 10:16:20', 1768986576),
(685, 'essai', 'test', 'c\'est bon', '2018-06-26 10:16:28', 1768986576),
(686, 'test', 'essai', 'yes', '2018-06-26 10:16:34', 1768986576),
(687, 'essai', 'test', 'test', '2018-06-26 10:31:37', 1768986576),
(688, 'essai', 'test', 'test 2', '2018-06-26 10:31:58', 1768986576),
(689, 'essai', 'test', 'message', '2018-06-26 10:32:05', 1768986576),
(690, 'essai', 'test', 'test', '2018-06-26 10:34:43', 1768986576),
(691, 'essai', 'test', 'osef', '2018-06-26 10:35:31', 1768986576),
(692, 'test', 'essai', 'osefman ?', '2018-06-26 10:38:18', 1768986576),
(693, 'test', 'essai', 'osefman 2 ?', '2018-06-26 10:43:14', 1768986576),
(694, 'test', 'essai', 'osefman 3 ?', '2018-06-26 10:46:06', 1768986576),
(695, 'test', 'essai', 'french osefman', '2018-06-26 10:51:26', 1768986576),
(696, 'essai', 'test', 'private room', '2018-06-26 10:51:45', 1768986576),
(697, 'essai', 'test', 'tesr', '2018-06-26 10:52:08', 1768986576),
(698, 'test', 'essai', 'test smiley  <img src="/instatux/img/emoji/satisfied.png" alt=":satisfied:" class="emoji_comm"/>', '2018-06-26 18:05:04', 1768986576),
(699, 'test', 'essai', 'wtf  <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 18:05:42', 1768986576),
(700, 'test', 'essai', ' <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 19:38:39', 1768986576),
(701, 'test', 'essai', ' <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 19:41:26', 1768986576),
(702, 'test', 'essai', ' <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 19:41:54', 1768986576),
(703, 'test', 'essai', 'test', '2018-06-26 19:42:31', 1768986576),
(704, 'test', 'essai', 'french', '2018-06-26 19:44:09', 1768986576),
(705, 'test', 'essai', 'test  <img src="/instatux/img/emoji/bowtie.png" alt=":bowtie:" class="emoji_comm"/>', '2018-06-26 19:44:19', 1768986576),
(706, 'test', 'essai', 're test  <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 19:46:03', 1768986576),
(707, 'test', 'essai', ' <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 19:47:32', 1768986576),
(708, 'test', 'essai', 'vnf', '2018-06-26 19:47:40', 1768986576),
(709, 'test', 'essai', 'osef', '2018-06-26 19:51:57', 1768986576),
(710, 'test', 'essai', ' addd <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/> test  <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-26 19:52:17', 1768986576),
(711, 'test', 'essai', 'test  <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-27 10:09:27', 1768986576),
(712, 'test', 'essai', ' <img src="/instatux/img/emoji/blush.png" alt=":blush:" class="emoji_comm"/> osefman <img src="/instatux/img/emoji/wink.png" alt=":wink:" class="emoji_comm"/>', '2018-06-27 10:09:45', 1768986576),
(713, 'essai', 'test', 'smiley  <img src="/instatux/img/emoji/trollface.png" alt=":trollface:" class="emoji_comm"/>', '2018-06-27 10:11:37', 1768986576),
(714, 'test', 'essai', 'test  <img src="/instatux/img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '2018-06-27 10:12:58', 1768986576),
(715, 'test', 'essai', 'smiley vue ?  <img src="/instatux/img/emoji/tired_face.png" alt=":tired_face:" class="emoji_comm"/>', '2018-06-27 10:15:57', 1768986576),
(716, 'essai', 'test', 'eh bien non  <img src="/instatux/img/emoji/stuck_out_tongue_closed_eyes.png" alt=":stuck_out_tongue_closed_eyes:" class="emoji_comm"/>', '2018-06-27 10:16:15', 1768986576),
(717, 'test', 'essai', 'test', '2018-06-27 10:27:01', 1768986576),
(718, 'essai', 'test', 'avatar +  <img src="/instatux/img/emoji/heart_eyes.png" alt=":heart_eyes:" class="emoji_comm"/>', '2018-06-27 10:27:50', 1768986576),
(719, 'test', 'essai', 'ça marche  <img src="/instatux/img/emoji/sunglasses.png" alt=":sunglasses:" class="emoji_comm"/>', '2018-06-27 10:28:05', 1768986576),
(720, 'test', 'essai', 'vcn', '2018-06-27 14:32:30', 1768986576),
(721, 'test', 'essai', 'test', '2018-06-27 14:34:50', 1768986576),
(722, 'test', 'essai', 'test', '2018-06-27 14:35:20', 1768986576),
(723, 'test', 'essai', 'chro', '2018-06-27 14:37:11', 1768986576),
(724, 'essai', 'test', 'essai', '2018-06-27 14:38:59', 1768986576),
(725, 'essai', 'test', 'osef', '2018-06-27 14:39:16', 1768986576),
(726, 'essai', 'test', 'essai', '2018-06-27 14:41:01', 1768986576),
(727, 'essai', 'test', 'lol', '2018-06-27 14:42:01', 1768986576),
(728, 'test', 'essai', 'test', '2018-06-27 19:18:29', 1768986576),
(729, 'test', 'essai', 'lol', '2018-06-27 19:19:20', 1768986576),
(730, 'test', 'essai', 'vcb', '2018-06-27 19:19:37', 1768986576),
(731, 'test', 'essai', 'v,', '2018-06-27 19:22:00', 1768986576),
(732, 'test', 'essai', 'bgt', '2018-06-28 10:40:28', 1768986576),
(733, 'test', 'essai', 'test', '2018-06-28 10:47:03', 1768986576),
(734, 'test', 'essai', 'lol', '2018-06-28 10:47:38', 1768986576),
(735, 'essai', 'test', 'yo', '2018-06-28 10:48:02', 1768986576),
(736, 'essai', 'test', 'yo 2', '2018-06-28 10:48:20', 1768986576),
(737, 'test', 'essai', 'https://stackoverflow.com/questions/46349478/socket-emit-to-specific-rooms', '2018-06-28 11:12:04', 1768986576);

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
(87, 'essai', '<img src="/instatux/img/avatars/1526647771_877.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à partagé votre <a href="/instatux/post/292">post</a> !', '2018-06-07 10:21:10', 1),
(88, 'osefman', '<img src="/instatux/img/avatars/1526647771_877.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à commenté votre <a href="/instatux/post/390">publication</a><br />test', '2018-06-14 10:43:14', 1),
(89, 'osefman', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/essai">essai</a> à commenté votre <a href="/instatux/post/390">publication</a><br />french', '2018-06-14 10:43:42', 1),
(90, 'osefman', '<img src="/instatux/img/avatars/1526647771_877.jpg" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/test">test</a> à commenté votre <a href="/instatux/post/390">publication</a><br />test', '2018-06-14 10:44:18', 1),
(91, 'osefman', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/essai">essai</a> à commenté votre <a href="/instatux/post/390">publication</a><br />alors ?', '2018-06-14 10:46:45', 1),
(92, 'osefman', '<img src="/instatux/img/avatars/warcraft.png" alt="image utilisateur" class="img-thumbail left avatarcomm"/><a href="/instatux/essai">essai</a> à commenté votre <a href="/instatux/post/390">publication</a><br />hey osefman', '2018-06-14 10:47:23', 1);

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
(6, 'osefman', 0, 'oui', 'oui', 'non', 'non', 'oui');

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
(325, 'test', 'test', '<div data-oembed-url="https://scontent-dft4-3.cdninstagram.com/t51.2885-15/e35/25013083_251948242004274_6743671715026436096_n.jpg"><div style="max-width: 1296px;"><div style="left: 0; width: 100%; height: 0; position: relative; padding-bottom: 100%;"><iframe tabindex="-1" src="https://cdn.iframe.ly/91HD3mZ" style="border: 0; top: 0; left: 0; width: 100%; height: 100%; position: absolute;" allowfullscreen=""></iframe></div></div></div><p>&nbsp;</p>', '2017-12-23 09:37:11', 0, 105, 0, 2, 0, 0),
(390, 'osefman', 'osefman', '<p>test comm</p>', '2018-06-14 10:42:20', 0, 7, 0, 0, 0, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=309;
--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;
--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=738;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;
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
