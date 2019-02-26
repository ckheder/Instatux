-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 21 Février 2019 à 10:35
-- Version du serveur :  10.2.22-MariaDB-10.2.22+maria~xenial
-- Version de PHP :  7.1.26-1+ubuntu16.04.1+deb.sury.org+1

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
(660, 'test', 'osefman', 1),
(636, 'test', 'essai', 0),
(635, 'osefman', 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `aime`
--

CREATE TABLE `aime` (
  `id` int(111) NOT NULL,
  `username` varchar(255) NOT NULL,
  `tweet_aime` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `aime`
--

INSERT INTO `aime` (`id`, `username`, `tweet_aime`, `created`) VALUES
(406, 'osefman', 617954580, '2019-02-12 10:34:10'),
(411, 'essai', 617954580, '2019-02-08 10:06:51'),
(414, 'test', 1666176494, '2019-02-14 20:52:44'),
(457, 'test', 363060505, '2019-02-21 10:03:10'),
(460, 'test', 1536874538, '2019-02-21 10:05:58'),
(490, 'test', 1327034712, '2019-02-21 10:30:45');

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
(290939056, 'osef', '325', '18', '2018-07-14 14:56:46', 0),
(1334880537, 'moi', '325', '63', '2018-07-14 14:59:33', 0),
(393, 'test 5', '336', '18', '2018-03-21 14:39:31', 0),
(392, 'test 5', '336', '18', '2018-03-21 14:39:31', 0),
(391, 'test 5', '336', '18', '2018-03-21 14:39:30', 0),
(390, 'test 4', '336', '18', '2018-03-21 14:39:14', 0),
(389, 'test 4', '336', '18', '2018-03-21 14:39:14', 0),
(388, 'test 3', '336', '18', '2018-03-21 14:37:58', 0),
(387, 'test 2', '336', '18', '2018-03-21 10:28:07', 0),
(386, 'test', '336', '18', '2018-03-21 10:16:28', 0),
(365, 'wtf ?', '336', '18', '2018-03-12 21:16:44', 0),
(295569070, 'tin', '325', '18', '2018-06-19 17:32:59', 0),
(1976844812, 'ah ben ça marche, modif wtf', '325', '18', '2018-06-19 17:34:19', 1),
(1441466898, 'bug', '325', '18', '2018-06-19 17:37:57', 0),
(498473387, 'test', '325', '18', '2018-06-20 10:13:18', 0),
(1977003712, 'bug vivaldi', '325', '18', '2018-06-20 10:20:44', 0),
(882934463, 'buggué', '325', '18', '2018-06-20 15:00:17', 0),
(746665536, 'pff <img src="/instatux/img/emoji/satisfied.png" alt="" class="emoji_comm"/>', '325', '18', '2018-06-20 15:05:08', 1),
(1167160060, 'osef <img src="/instatux/img/emoji/bowtie.png" alt="" class="emoji_comm"/>', '325', '18', '2018-06-20 16:41:46', 1),
(272897399, 'erf', '325', '63', '2018-06-25 14:43:29', 0),
(1915498756, 'osefman ?', '325', '63', '2018-07-14 14:56:20', 0),
(825724234, 'dfgh', '325', '18', '2018-07-14 14:22:12', 0),
(642223717, 'ghkl', '325', '18', '2018-07-14 14:22:16', 0),
(1013530438, 'xcv', '325', '18', '2018-07-14 14:26:03', 0),
(1294495213, 'osef', '325', '63', '2018-07-14 14:52:42', 0),
(1002771262, 'sdfp', '325', '63', '2018-07-14 10:58:44', 0),
(1199199233, 'test', '325', '18', '2018-07-14 14:18:06', 0),
(469034435, 'dfgh', '325', '18', '2018-07-14 14:21:29', 0),
(369701159, 'test', '325', '18', '2018-07-15 14:14:47', 0),
(1655700237, 'test', '325', '63', '2018-07-15 14:18:53', 0),
(18604357, 'french', '325', '18', '2018-07-15 14:20:26', 0),
(1045537601, 'test', '325', '18', '2018-07-15 14:24:38', 0),
(657586974, 'test', '178', '192', '2018-12-06 20:23:51', 0),
(38381733, 'fg', '179', '192', '2018-12-06 10:19:52', 0),
(1299162870, 'test', '179', '192', '2018-12-06 10:18:38', 0),
(818680801, 'test', '230', '192', '2018-12-15 11:39:58', 0),
(1607038356, 'test', '270', '192', '2019-02-07 09:55:49', 0),
(461816182, 'lol', '245', '192', '2019-02-05 21:16:38', 0),
(1155551227, 'test notif', '270', '63', '2019-02-06 10:29:16', 0),
(1317785123, 'test', '245', '192', '2019-02-05 21:16:35', 0),
(1944631191, 'test', '245', '192', '2019-02-05 21:15:35', 0),
(1993473083, 'lol', '245', '192', '2019-02-05 21:15:37', 0),
(599982926, 'test', '236', '192', '2019-02-05 21:13:21', 0),
(336568906, 'test', '245', '192', '2019-02-05 21:14:56', 0),
(510108122, 'lol', '245', '192', '2019-02-05 21:15:03', 0),
(1479545489, 'test', '236', '192', '2019-02-05 10:24:14', 0),
(1464948044, '+1', '236', '192', '2019-02-05 21:11:06', 0),
(680411768, '+1', '236', '192', '2019-02-05 21:12:59', 0),
(1434105634, 'lol', '269', '192', '2019-02-04 10:23:00', 0),
(322871466, 'test', '269', '192', '2019-02-04 10:28:44', 0),
(808141912, 'go', '269', '192', '2019-02-04 10:29:01', 0),
(99693561, 'avatar ?', '269', '192', '2019-02-04 10:10:41', 0),
(536466084, 'test', '269', '192', '2019-02-04 10:13:00', 0),
(1115525175, 'add <img src="/instatux/img/emoji/heart_eyes.png" alt=":heart_eyes:" class="emoji_comm"/>', '269', '192', '2019-02-04 10:00:13', 1),
(1757231552, 'test', '269', '192', '2019-02-04 10:04:05', 0),
(1602958797, 'pour la science', '269', '192', '2019-02-04 10:04:42', 0),
(1219092142, 'yo', '241', '18', '2019-02-04 10:01:16', 0),
(1840513501, 'lol', '269', '192', '2019-02-04 10:05:24', 0);

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
(75, 622503430, 'test', 'osefman', 1),
(76, 622503430, 'osefman', 'test', 1),
(77, 1371584839, 'essai', 'test', 1),
(78, 1371584839, 'test', 'essai', 1);

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

CREATE TABLE `media` (
  `id_media` int(11) NOT NULL,
  `nom_media` text NOT NULL,
  `tweet_media` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `media`
--

INSERT INTO `media` (`id_media`, `nom_media`, `tweet_media`, `user_id`, `created`) VALUES
(25, '30430200_2191784560839404_2075229341_n.jpg', 268, 'test', '2019-01-22 14:37:17');

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
(759, 'test', 'essai', ' <img src="/instatux/img/emoji/relieved.png" alt="relieved" class="emoji_comm"/> <img src="/instatux/img/emoji/satisfied.png" alt="satisfied" class="emoji_comm"/> <img src="/instatux/img/emoji/grin.png" alt="grin" class="emoji_comm"/> <img src="/instatux/img/emoji/wink.png" alt="wink" class="emoji_comm"/> <img src="/instatux/img/emoji/anguished.png" alt="anguished" class="emoji_comm"/>', '2018-06-30 18:41:31', 986523447),
(758, 'test', 'essai', ' <img src="/instatux/img/emoji/astonished.png" alt="astonished" class="emoji_comm"/> <img src="/instatux/img/emoji/bowtie.png" alt="bowtie" class="emoji_comm"/> <img src="/instatux/img/emoji/broken_heart.png" alt="broken_heart" class="emoji_comm"/> <img src="/instatux/img/emoji/clap.png" alt="clap" class="emoji_comm"/> <img src="/instatux/img/emoji/confused.png" alt="confused" class="emoji_comm"/>', '2018-06-30 18:41:06', 986523447),
(757, 'test', 'essai', ' <img src="/instatux/img/emoji/disappointed.png" alt="disappointed" class="emoji_comm"/> <img src="/instatux/img/emoji/dizzy_face.png" alt="dizzy_face" class="emoji_comm"/> <img src="/instatux/img/emoji/fearful.png" alt="fearful" class="emoji_comm"/> <img src="/instatux/img/emoji/grinning.png" alt="grinning" class="emoji_comm"/> <img src="/instatux/img/emoji/hushed.png" alt="hushed" class="emoji_comm"/>', '2018-06-30 18:40:35', 986523447),
(756, 'test', 'essai', ' <img src="/instatux/img/emoji/neutral_face.png" alt="neutral_face" class="emoji_comm"/> <img src="/instatux/img/emoji/open_mouth.png" alt="open_mouth" class="emoji_comm"/> <img src="/instatux/img/emoji/rage.png" alt="rage" class="emoji_comm"/> <img src="/instatux/img/emoji/scream.png" alt="scream" class="emoji_comm"/> <img src="/instatux/img/emoji/sleeping.png" alt="sleeping" class="emoji_comm"/>', '2018-06-30 18:40:23', 986523447),
(755, 'test', 'essai', ' <img src="/instatux/img/emoji/stuck_out_tongue_winking_eye.png" alt="stuck_out_tongue_winking_eye" class="emoji_comm"/> <img src="/instatux/img/emoji/stuck_out_tongue_closed_eyes.png" alt="stuck_out_tongue_closed_eyes" class="emoji_comm"/> <img src="/instatux/img/emoji/stuck_out_tongue.png" alt="stuck_out_tongue" class="emoji_comm"/> <img src="/instatux/img/emoji/sunglasses.png" alt="sunglasses" class="emoji_comm"/> <img src="/instatux/img/emoji/tired_face.png" alt="tired_face" class="emoji_comm"/>', '2018-06-30 18:40:10', 986523447),
(754, 'test', 'essai', ' <img src="/instatux/img/emoji/unamused.png" alt="unamused" class="emoji_comm"/> <img src="/instatux/img/emoji/worried.png" alt="worried" class="emoji_comm"/>', '2018-06-30 18:39:55', 986523447),
(753, 'test', 'essai', ' <img src="/instatux/img/emoji/trollface.png" alt="trollface" class="emoji_comm"/>', '2018-06-30 18:39:48', 986523447),
(752, 'test', 'essai', ' <img src="/instatux/img/emoji/smile.png" alt="smile" class="emoji_comm"/> <img src="/instatux/img/emoji/laughing.png" alt="laughing" class="emoji_comm"/> <img src="/instatux/img/emoji/blush.png" alt="blush" class="emoji_comm"/> <img src="/instatux/img/emoji/smiley.png" alt="smiley" class="emoji_comm"/> <img src="/instatux/img/emoji/relaxed.png" alt="relaxed" class="emoji_comm"/> <img src="/instatux/img/emoji/smirk.png" alt="smirk" class="emoji_comm"/> <img src="/instatux/img/emoji/heart_eyes.png" alt="heart_eyes" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_heart.png" alt="kissing_heart" class="emoji_comm"/> <img src="/instatux/img/emoji/kissing_closed_eyes.png" alt="kissing_closed_eyes" class="emoji_comm"/> <img src="/instatux/img/emoji/flushed.png" alt="flushed" class="emoji_comm"/>', '2018-06-30 18:39:39', 986523447),
(751, 'test', 'essai', 'premier coup  <img src="/instatux/img/emoji/laughing.png" alt="laughing" class="emoji_comm"/> test  <img src="/instatux/img/emoji/kissing_heart.png" alt="kissing_heart" class="emoji_comm"/>', '2018-06-30 18:38:43', 986523447),
(749, 'test', 'essai', 'essai', '2018-06-29 10:26:48', 986523447),
(750, 'test', 'essai', 'test  <img src="/instatux/img/emoji/smile.png" alt="smile" class="emoji_comm"/>', '2018-06-30 18:38:08', 986523447),
(760, 'test', 'essai', 'test', '2018-06-30 18:43:23', 986523447),
(761, 'test', 'essai', '<a href="../essai">@essai</a> #facebook test  :laughing:', '2018-06-30 18:44:22', 986523447),
(762, 'test', 'essai', '<a href="../essai">@essai</a> #facebook  <img src="/instatux/img/emoji/blush.png" alt="blush" class="emoji_comm"/>', '2018-06-30 18:44:57', 986523447),
(763, 'test', 'essai', '<a href="../essai">@essai</a>', '2018-06-30 18:52:38', 986523447),
(764, 'test', 'essai', '<a href="../essai">@essai</a> <a href="../search-%23facebook">#facebook</a> lo o  <img src="/instatux/img/emoji/satisfied.png" alt="satisfied" class="emoji_comm"/>', '2018-06-30 18:54:03', 986523447),
(765, 'test', 'essai', ' <img src="/instatux/img/emoji/laughing.png" alt="laughing" class="emoji_comm"/> <a href="https://www.youtube.com/watch?v=Hiro44tZn64">https://www.youtube.com/watch?v=Hiro44tZn64</a>', '2018-07-02 10:27:26', 986523447),
(766, 'test', 'essai', '<a href="https://www.youtube.com/watch?v=Hiro44tZn64">https://www.youtube.com/watch?v=Hiro44tZn64</a>  <img src="/instatux/img/emoji/kissing_heart.png" alt="kissing_heart" class="emoji_comm"/>', '2018-07-02 10:28:41', 986523447),
(767, 'test', 'essai', '<a href="./essai">@essai</a>', '2018-07-02 10:31:04', 986523447),
(768, 'test', 'essai', '<a href="../search-%23facebook">#facebook</a>', '2018-07-02 10:31:17', 986523447),
(769, 'test', 'essai', '<a href="./search-%23facebook">#facebook</a>', '2018-07-02 10:31:41', 986523447),
(770, 'test', 'essai', '<a href="https://www.youtube">https://www.youtube</a>.', '2018-07-02 10:41:05', 986523447),
(771, 'test', 'essai', '<a href="https://www.youtube.com/watch?v=Hiro44tZn64">https://www.youtube.com/watch?v=Hiro44tZn64</a>', '2018-07-02 10:45:58', 986523447),
(772, 'test', 'essai', 'https://www.youtube.com/watch?v=Hiro44tZn64', '2018-07-02 10:48:24', 986523447),
(773, 'test', 'essai', 'https://www.youtube.com/watch?v=Hiro44tZn64', '2018-07-02 10:48:51', 986523447),
(774, 'test', 'essai', 'http://www.youtube.com/watch?v=Hiro44tZn64', '2018-07-02 10:49:13', 986523447),
(775, 'test', 'essai', 'http://www.youtube.com/watch?v=Hiro44tZn64', '2018-07-02 10:49:27', 986523447),
(776, 'test', 'essai', '<a href="https://www.youtube.com/watch?v=Hiro44tZn64">https://www.youtube.com/watch?v=Hiro44tZn64</a>', '2018-07-02 10:50:50', 986523447),
(777, 'test', 'osefman', 'test', '2018-07-02 15:05:37', 328523323),
(778, 'essai', 'test', 'salut', '2018-07-03 10:19:20', 986523447),
(779, 'test', 'essai', 'salut ça va ?  <img src="/instatux/img/emoji/smile.png" alt="smile" class="emoji_comm"/>', '2018-07-03 10:19:34', 986523447),
(780, 'essai', 'test', 'bien et toi ?  <img src="/instatux/img/emoji/satisfied.png" alt="satisfied" class="emoji_comm"/>', '2018-07-03 10:19:45', 986523447),
(781, 'test', 'essai', 'tu as vu les nouveautés de CakePHP 3.6 ?', '2018-07-03 10:20:02', 986523447),
(782, 'essai', 'test', 'oui  <img src="/instatux/img/emoji/clap.png" alt="clap" class="emoji_comm"/> meilleur framework', '2018-07-03 10:20:16', 986523447),
(783, 'osefman', 'test', 'dernier message', '2018-07-03 08:00:00', 328523323),
(784, 'test', 'osefman', 'là dernier', '2018-07-04 06:00:00', 328523323),
(785, 'test', 'osefman', 'test', '2018-07-04 10:38:30', 328523323),
(786, 'osefman', 'test', 'message aussi', '2018-07-04 15:11:57', 328523323),
(789, 'test', 'essai', 'CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP.', '2018-07-05 15:29:22', 986523447),
(790, 'test', 'essai', 'CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP.', '2018-07-05 15:31:00', 986523447),
(791, 'test', 'essai', ' CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP. ', '2018-07-05 20:39:34', 986523447),
(788, 'test', 'essai', '<a href="https://www.youtube.com/watch?v=Hiro44tZn64">https://www.youtube.com/watch?v=Hiro44tZn64</a>', '2018-07-05 15:27:58', 986523447),
(792, 'test', 'essai', ' CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP. ', '2018-07-05 20:40:56', 986523447),
(793, 'test', 'essai', ' CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP. ', '2018-07-05 20:41:19', 986523447),
(794, 'essai', 'test', 'CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP.', '2018-07-06 10:17:12', 986523447),
(795, 'essai', 'test', 'CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easier and, of course, tastier. Build fast, grow solid with CakePHP.', '2018-07-06 10:18:01', 986523447),
(796, 'test', 'essai', 'test', '2018-07-27 10:13:21', 986523447),
(797, 'essai', 'test', 'marche bien  <img src="/instatux/img/emoji/laughing.png" alt="laughing" class="emoji_comm"/>', '2018-07-27 10:13:32', 986523447),
(798, 'jean', 'test', 'test', '2018-08-13 10:45:59', 2130869297),
(799, 'jean', 'test', 'oseg', '2018-08-13 10:46:40', 2130869297),
(800, 'jean', 'test', 'test', '2018-08-13 10:52:16', 794910404),
(801, 'jean', 'test', 'tesr', '2018-08-13 10:53:12', 794910404),
(802, 'test', 'jean', 'french', '2018-08-13 10:53:57', 794910404),
(803, 'jean', 'test', 'gh', '2018-08-13 10:54:09', 794910404),
(804, 'test', 'osefman', '<a href="./search-%23test">#test</a>', '2018-11-24 15:26:55', 328523323),
(805, 'test', 'osefman', '<a href="./search-%23test">#test</a>', '2018-11-24 15:28:17', 328523323),
(806, 'test', 'osefman', '<a href="../search/hashtag/test">#test</a>', '2018-11-24 15:30:34', 328523323),
(807, 'test', 'osefman', '<a href="../instatux/search/hashtag/test">#test</a>', '2018-11-24 15:31:40', 328523323),
(808, 'test', 'osefman', '<a href="https://book.cakephp.org/3.0/fr/index.html">https://book.cakephp.org/3.0/fr/index.html</a>', '2018-11-24 15:32:03', 328523323),
(809, 'test', 'osefman', '<a href="../instatux/search/hashtag/test">#test</a> messagerie', '2018-11-24 18:16:47', 328523323),
(810, 'osefman', 'test', 'test', '2018-11-27 20:47:08', 328523323),
(811, 'osefman', 'test', 'pas bouger', '2018-11-27 20:48:09', 328523323),
(812, 'folder', 'test', 'test', '2018-12-07 09:48:16', 620845979),
(813, 'test', 'folder', 'oui quoi', '2018-12-07 09:48:33', 620845979),
(814, 'folder', 'test', 'hey', '2018-12-07 10:04:28', 1171075610),
(815, 'test', 'folder', 'quoi', '2018-12-07 10:04:35', 1171075610),
(816, 'test', 'osefman', 'test', '2018-12-16 21:04:13', 622503430),
(817, 'test', 'osefman', 'test', '2018-12-18 09:41:48', 622503430),
(818, 'osefman', 'test', 'réponse', '2018-12-18 09:42:16', 622503430),
(819, 'osefman', 'test', 'test', '2018-12-18 09:43:53', 622503430),
(820, 'test', 'osefman', 'sdf', '2018-12-18 09:44:04', 622503430),
(821, 'osefman', 'test', 'cool', '2018-12-18 09:55:11', 622503430),
(822, 'test', 'osefman', 'so cool', '2018-12-18 09:55:20', 622503430),
(823, 'osefman', 'test', 'notif', '2018-12-18 10:47:50', 622503430),
(824, 'osefman', 'test', 'xcv', '2018-12-18 10:47:53', 622503430),
(825, 'osefman', 'test', 'cvf', '2018-12-18 10:50:27', 622503430),
(826, 'osefman', 'test', 'fgh', '2018-12-18 10:50:29', 622503430),
(827, 'osefman', 'test', 'xwc', '2018-12-18 10:51:38', 622503430),
(828, 'osefman', 'test', 'xcv', '2018-12-18 10:51:39', 622503430),
(829, 'osefman', 'test', 'xv', '2018-12-18 10:52:16', 622503430),
(830, 'osefman', 'test', 'fdg', '2018-12-18 10:52:17', 622503430),
(831, 'osefman', 'test', 'wcw', '2018-12-18 10:55:26', 622503430),
(832, 'osefman', 'test', 'sdfs', '2018-12-18 10:55:27', 622503430),
(833, 'osefman', 'test', 'cbcb', '2018-12-19 10:15:04', 622503430),
(834, 'osefman', 'test', 'sdf', '2018-12-19 10:15:11', 622503430),
(835, 'test', 'osefman', 'test', '2018-12-19 14:47:13', 622503430),
(836, 'test', 'osefman', 'test', '2018-12-20 10:21:03', 622503430),
(837, 'test', 'osefman', 'ghf', '2018-12-20 10:25:55', 622503430),
(838, 'test', 'osefman', 'dfg', '2018-12-20 10:36:34', 622503430),
(839, 'test', 'osefman', 'test', '2018-12-20 14:32:38', 622503430),
(840, 'test', 'osefman', 'test redirect', '2018-12-21 10:22:53', 622503430),
(841, 'test', 'osefman', 'test', '2018-12-21 10:23:40', 622503430),
(842, 'test', 'osefman', 'test', '2018-12-21 10:24:18', 622503430),
(843, 'test', 'osefman', 'dfg', '2018-12-21 10:25:02', 622503430),
(844, 'test', 'osefman', 'fdg', '2018-12-21 10:25:21', 622503430),
(845, 'test', 'osefman', 'fgh', '2018-12-21 10:28:01', 622503430),
(846, 'test', 'osefman', 'ghj', '2018-12-21 10:38:15', 622503430),
(847, 'test', 'osefman', 'fgh', '2018-12-21 10:38:32', 622503430),
(848, 'test', 'osefman', 'test', '2018-12-21 10:38:45', 622503430),
(849, 'test', 'osefman', 'test', '2018-12-21 10:39:19', 622503430),
(850, 'test', 'osefman', 'osef', '2018-12-21 10:39:56', 622503430),
(851, 'test', 'osefman', 'test', '2018-12-21 10:40:05', 622503430),
(852, 'test', 'osefman', 'ghj', '2018-12-21 10:40:17', 622503430),
(853, 'test', 'osefman', 'dfghd', '2018-12-21 10:41:43', 622503430),
(854, 'test', 'osefman', 'wxcw', '2018-12-21 10:43:08', 622503430),
(855, 'test', 'osefman', 'dqds', '2018-12-21 10:43:50', 622503430),
(856, 'test', 'osefman', 'ghj', '2018-12-21 10:44:28', 622503430),
(857, 'test', 'osefman', 'ghf', '2018-12-21 10:45:31', 622503430),
(858, 'test', 'osefman', 'test', '2018-12-21 10:45:36', 622503430),
(859, 'test', 'osefman', 'bxb', '2018-12-21 10:45:44', 622503430),
(860, 'test', 'osefman', 'fghf', '2018-12-21 10:46:30', 622503430),
(861, 'test', 'osefman', 'fghf', '2018-12-21 10:46:38', 622503430),
(862, 'test', 'osefman', 'test', '2018-12-21 10:46:43', 622503430),
(863, 'test', 'osefman', 'conv', '2018-12-21 10:47:10', 622503430),
(864, 'test', 'osefman', 'profil', '2018-12-21 10:47:19', 622503430),
(865, 'test', 'osefman', 'messagerie', '2018-12-21 10:47:31', 622503430),
(866, 'test', 'osefman', 'test', '2019-01-07 10:22:41', 622503430),
(867, 'osefman', 'test', 'test', '2019-01-07 13:00:00', 622503430),
(868, 'test', 'osefman', 'test', '2019-01-08 10:20:50', 622503430),
(869, 'test', 'osefman', 'test', '2019-01-08 10:22:02', 622503430),
(870, 'test', 'osefman', 'ça marche', '2019-01-08 10:25:33', 622503430),
(871, 'test', 'osefman', 'grt', '2019-01-08 10:26:00', 622503430),
(872, 'test', 'osefman', 'test', '2019-01-08 10:32:35', 622503430),
(873, 'osefman', 'test', 'reponse', '2019-01-08 10:32:43', 622503430),
(874, 'test', 'osefman', 'oui', '2019-01-08 10:33:29', 622503430),
(875, 'osefman', 'test', 'emission', '2019-01-08 10:35:21', 622503430),
(876, 'test', 'osefman', 'test', '2019-01-08 10:37:21', 622503430),
(877, 'osefman', 'test', 'test', '2019-01-08 10:37:46', 622503430),
(878, 'test', 'osefman', 'test', '2019-01-08 10:39:51', 622503430),
(879, 'osefman', 'test', 'reponse', '2019-01-08 10:40:00', 622503430),
(880, 'osefman', 'test', 'osefman', '2019-01-08 10:42:48', 622503430),
(881, 'osefman', 'test', 'osefman 2', '2019-01-08 10:43:24', 622503430),
(882, 'osefman', 'test', 'osefman 3', '2019-01-08 10:44:11', 622503430),
(883, 'test', 'osefman', 'test', '2019-01-08 10:44:33', 622503430),
(884, 'test', 'osefman', 'test', '2019-01-08 10:46:55', 622503430),
(885, 'osefman', 'test', 'reponse', '2019-01-08 10:47:02', 622503430),
(886, 'osefman', 'test', 'test', '2019-01-08 14:37:21', 622503430),
(887, 'test', 'osefman', 'test', '2019-01-08 14:55:12', 622503430),
(888, 'osefman', 'test', 'go', '2019-01-09 10:19:53', 622503430),
(889, 'osefman', 'test', 'test', '2019-01-09 10:25:44', 622503430),
(890, 'osefman', 'test', 'test', '2019-01-09 10:26:51', 622503430),
(891, 'osefman', 'test', 'go', '2019-01-09 11:12:26', 622503430),
(892, 'osefman', 'test', 're go', '2019-01-09 11:12:38', 622503430),
(893, 'osefman', 'test', 'test', '2019-01-09 15:59:01', 622503430),
(894, 'osefman', 'test', 'bloqué\r\n', '2019-01-10 10:28:31', 622503430),
(895, 'osefman', 'test', 'sdfs', '2019-01-10 10:37:20', 622503430),
(896, 'essai', 'test', 'bonjour', '2019-02-07 10:42:37', 1371584839),
(897, 'test', 'essai', 'bonjour à toi  :laughing:', '2019-02-07 10:43:16', 1371584839),
(898, 'osefman', 'test', 'yo', '2019-02-07 10:43:31', 622503430),
(899, 'test', 'osefman', 'yo', '2019-02-07 10:43:37', 622503430),
(900, 'osefman', 'test', 'emoji  <img src="/instatux/img/emoji/fearful.png" alt=":fearful:" class="emoji_comm"/>', '2019-02-07 10:46:26', 622503430),
(901, 'test', 'osefman', 'c\'est good  <img src="/instatux/img/emoji/stuck_out_tongue_winking_eye.png" alt=":stuck_out_tongue_winking_eye:" class="emoji_comm"/>', '2019-02-07 10:46:38', 622503430);

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
(381, 'essai', '<img src="/instatux/img/avatar/test.jpg" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> s\'est abonné', '2019-01-10 10:41:06', 1),
(382, 'essai', '<img src="/instatux/img/avatar/test.jpg" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/test">test</a><span class="alias_tweet">@test</span> s\'est abonné', '2019-01-10 10:41:06', 1),
(470, 'osefman', '<img src="/instatux/img/avatar/test.jpg" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-622503430">message</a> !', '2019-02-07 10:43:37', 0),
(472, 'osefman', '<img src="/instatux/img/avatar/test.jpg" alt="image utilisateur" class="img-thumbail"/><a href="/instatux/test">test</a> vous à envoyé un <a href="/instatux/conversation-622503430">message</a> !', '2019-02-07 10:46:38', 0);

-- --------------------------------------------------------

--
-- Structure de la table `partage`
--

CREATE TABLE `partage` (
  `id_partage` int(11) NOT NULL,
  `sharer` varchar(50) NOT NULL,
  `tweet_partage` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `partage`
--

INSERT INTO `partage` (`id_partage`, `sharer`, `tweet_partage`, `created`) VALUES
(219, 'test', 2100750165, '2019-01-07 10:26:09'),
(220, 'osefman', 1132315017, '2019-01-07 10:47:41'),
(221, 'osefman', 103914207, '2019-01-07 10:47:42'),
(222, 'essai', 2100750165, '2019-01-07 10:48:08'),
(225, 'test', 1666176494, '2019-01-08 21:01:09');

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
(5, 'essai', 1, 'oui', 'oui', 'oui', 'oui', 'non'),
(6, 'osefman', 0, 'oui', 'oui', 'non', 'oui', 'oui'),
(101, 'osefgirl', 0, 'oui', 'oui', 'oui', 'oui', 'oui'),
(135, 'test', 0, 'oui', 'oui', 'oui', 'oui', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `tweet`
--

CREATE TABLE `tweet` (
  `id_tweet` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `user_timeline` varchar(255) NOT NULL,
  `contenu_tweet` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `share` int(11) NOT NULL DEFAULT 0,
  `nb_commentaire` int(111) DEFAULT 0,
  `nb_partage` int(111) NOT NULL DEFAULT 0,
  `nb_like` int(111) NOT NULL DEFAULT 0,
  `private` tinyint(1) NOT NULL DEFAULT 0,
  `allow_comment` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tweet`
--

INSERT INTO `tweet` (`id_tweet`, `id`, `user_id`, `user_timeline`, `contenu_tweet`, `created`, `share`, `nb_commentaire`, `nb_partage`, `nb_like`, `private`, `allow_comment`) VALUES
(122, 1327034712, 'osefman', 'osefman', '<p><p>test</p></p>', '2018-12-04 18:03:45', 0, 1, 0, 2, 0, 0),
(177, 1132315017, 'test', 'test', '<p><p>test</p></p>', '2018-12-06 10:16:26', 0, 1, 0, 2, 0, 0),
(201, 103914207, 'test', 'test', '<p><p>sdfs</p></p>', '2018-12-07 15:43:29', 0, 0, 0, 0, 0, 0),
(202, 619198963, 'test', 'test', '<p><p>dfgd</p></p>', '2018-12-07 15:44:19', 0, 0, 0, 0, 0, 0),
(203, 1429727289, 'test', 'test', '<p><p>sqd</p></p>', '2018-12-07 15:44:27', 0, 0, 0, 0, 0, 0),
(209, 480605778, 'test', 'test', '<p><p>test</p></p>', '2018-12-08 18:30:46', 0, 0, 0, 0, 0, 0),
(210, 1607198138, 'test', 'test', '<p><p>test</p></p>', '2018-12-08 18:30:55', 0, 0, 0, 0, 0, 0),
(212, 123620011, 'test', 'test', '<p><p>dimanche 2</p></p>', '2018-12-09 10:32:41', 0, 0, 0, 0, 0, 0),
(213, 1031274847, 'test', 'test', '<p><p>dimanche 3</p></p>', '2018-12-09 10:33:59', 0, 0, 0, 0, 0, 0),
(215, 1214937471, 'test', 'test', '<p><p>sdf</p></p>', '2018-12-09 10:37:01', 0, 0, 0, 0, 0, 0),
(216, 632774517, 'test', 'test', '<p><p>dhdh</p></p>', '2018-12-09 10:47:48', 0, 0, 0, 0, 0, 0),
(217, 1484761430, 'test', 'test', '<p><p>fghf</p></p>', '2018-12-09 10:47:53', 0, 0, 0, 0, 0, 0),
(231, 1441527878, 'test', 'test', '<p><p>CakePHP makes building web applications simpler, faster, while requiring less code. A modern PHP 7 framework offering a flexible database access layer and a powerful scaffolding system that makes building both small and complex systems simpler, easie</p></p>', '2018-12-11 11:13:04', 0, 0, 0, 0, 0, 0),
(232, 2100750165, 'osefman', 'osefman', '<p><p>test</p></p>', '2018-12-17 10:36:48', 0, 0, 0, 0, 0, 0),
(233, 2100750165, 'osefman', 'test', '<p><p>test</p></p>', '2019-01-07 10:26:09', 1, 0, 0, 0, 0, 0),
(234, 1132315017, 'test', 'osefman', '<p><p>test</p></p>', '2019-01-07 10:47:41', 1, 0, 0, 0, 0, 0),
(235, 103914207, 'test', 'osefman', '<p><p>sdfs</p></p>', '2019-01-07 10:47:42', 1, 0, 0, 0, 0, 0),
(236, 2100750165, 'osefman', 'essai', '<p><p>test</p></p>', '2019-01-07 10:48:08', 1, 4, 0, 0, 0, 0),
(240, 1666176494, 'osefman', 'osefman', '<p><p><a href="test">@test</a> yo</p></p>', '2019-01-08 14:39:28', 0, 0, 0, 1, 0, 0),
(241, 1666176494, 'osefman', 'test', '<p><p><a href="test">@test</a> yo</p></p>', '2019-01-08 21:01:09', 1, 1, 0, 1, 0, 0),
(243, 1861778861, 'osefman', 'osefman', '<p><p><a href="test">@test</a> re</p></p>', '2019-01-10 10:32:05', 0, 0, 0, 0, 0, 0),
(244, 1892192761, 'osefman', 'osefman', '<p><p><a href="test">@test</a> reconnu</p></p>', '2019-01-10 10:34:33', 0, 0, 0, 0, 0, 0),
(245, 249051394, 'osefman', 'osefman', '<p><p><a href="test">@test</a> lol</p></p>', '2019-01-10 10:37:17', 0, 6, 0, 1, 0, 0),
(268, 363060505, 'test', 'test', '<p><p><img src="http://localhost/instatux/img/media/test/30430200_2191784560839404_2075229341_n.jpg" width="100%" alt="image introuvable" /> </p></p>', '2019-01-22 14:37:17', 0, 0, 0, 1, 0, 0),
(269, 1536874538, 'test', 'test', '<p><p>tweet vierge</p></p>', '2019-01-24 10:16:57', 0, 9, 0, 1, 0, 0),
(270, 617954580, 'test', 'test', '<p><p>test lien modal</p></p>', '2019-02-06 10:27:27', 0, 2, 0, 2, 0, 0);

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
  `lieu` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `modified`, `description`, `lieu`, `website`) VALUES
(18, 'essai', '$2y$10$iXLVGo6eGEB2cTKBpg/nieN5xr/VfBLiKl9LFBcQ1nVAfW00I3JOG', 'osef@gmail.com', '2016-09-06 19:03:25', '2018-05-23 10:24:40', 'essai cakephp 3', 'Metz', ''),
(63, 'osefman', '$2y$10$ogM/Rds30RYxjktgdyRRLeQzaD7w8Egon7iysEDFOrz1SNH3D4tMi', 'testred@gmail.com', '2017-11-09 13:23:25', '2018-05-16 17:09:50', 'test', 'Metz', NULL),
(158, 'osefgirl', '$2y$10$1F5/vA34QCFmrMfOvLjyzeQmULVjaGbsIJZ3Vs/1axJ4QZOZnaaYS', 'deletetest@gmail.com', '2018-09-27 20:21:44', '2018-09-27 20:21:44', NULL, NULL, NULL),
(192, 'test', '$2y$10$FKQ3FoC4zIW.zOSZuOQLeOitFLX.8DUPrdFshEuyqWdB4J2oSLaQi', 'christophekheder@gmail.com', '2018-12-06 09:59:09', '2019-01-16 14:35:24', 'Développeur CakePHP 3', 'Metz', NULL);

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
  ADD KEY `tweet_aime` (`tweet_aime`);

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
-- Index pour la table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id_media`),
  ADD KEY `tweet_media` (`tweet_media`);

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
  ADD KEY `tweet_constraint_share` (`tweet_partage`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id_tweet`),
  ADD KEY `user_key` (`user_id`),
  ADD KEY `id` (`id`);
ALTER TABLE `tweet` ADD FULLTEXT KEY `search_tweet` (`contenu_tweet`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=661;
--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=491;
--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=902;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=473;
--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `id_partage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `aime`
--
ALTER TABLE `aime`
  ADD CONSTRAINT `tweet_aime` FOREIGN KEY (`tweet_aime`) REFERENCES `tweet` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `tweet_constraint_media` FOREIGN KEY (`tweet_media`) REFERENCES `tweet` (`id_tweet`) ON DELETE CASCADE;

--
-- Contraintes pour la table `partage`
--
ALTER TABLE `partage`
  ADD CONSTRAINT `tweet_constraint_share` FOREIGN KEY (`tweet_partage`) REFERENCES `tweet` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
