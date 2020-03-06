-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 24 Février 2020 à 10:50
-- Version du serveur :  10.2.30-MariaDB-10.2.30+maria~xenial
-- Version de PHP :  7.2.28-3+ubuntu16.04.1+deb.sury.org+1

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
(833, 'christophe_kheder', 'demos', 1),
(832, 'christophe_kheder', 'alexa', 1),
(829, 'demos', 'christophe_kheder', 1);

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
(505, 'christophe_kheder', 454031184, '2020-02-06 21:16:41'),
(506, 'christophe_kheder', 2142021215, '2020-02-13 09:55:31'),
(507, 'alexa', 2142021215, '2020-02-13 09:55:55'),
(508, 'christophe_kheder', 1929751166, '2020-02-20 11:07:53');

-- --------------------------------------------------------

--
-- Structure de la table `blocage`
--

CREATE TABLE `blocage` (
  `id` int(11) NOT NULL,
  `bloqueur` varchar(255) NOT NULL,
  `bloquer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `blocage`
--

INSERT INTO `blocage` (`id`, `bloqueur`, `bloquer`) VALUES
(98, 'demos', 'alexa'),
(99, 'alexa', 'demos');

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
(1090933889, 'osefman', '505', '284', '2020-02-24 10:43:55', 1),
(225047215, '<p><p>test 2</p></p>', '501', '284', '2020-02-24 10:32:08', 0),
(1083923135, 'yo', '485', '284', '2020-02-20 14:10:50', 0),
(122604623, '<p><p> <img src="./img/emoji/smile.png" alt=":smile:" class="emoji_comm"/> test</p></p>', '501', '284', '2020-02-24 10:29:58', 0),
(180059815, 'french', '485', '284', '2020-02-20 11:14:30', 0),
(2023327818, 're modifier là !!', '485', '282', '2020-02-20 11:05:51', 1),
(250805484, 'modifié  <img src="./img/emoji/laughing.png" alt=":laughing:" class="emoji_comm"/>', '485', '282', '2020-02-20 11:02:03', 1);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `id` int(111) NOT NULL,
  `conv` int(111) NOT NULL,
  `user_conv` varchar(50) NOT NULL,
  `type_conv` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `conversation`
--

INSERT INTO `conversation` (`id`, `conv`, `user_conv`, `type_conv`) VALUES
(188, 379531875, 'demos', 'multiple'),
(189, 379531875, 'christophe_kheder', 'multiple'),
(190, 989777856, 'demos', 'duo'),
(191, 989777856, 'alexa', 'duo'),
(192, 1960482688, 'folder', 'multiple'),
(193, 1960482688, 'demos', 'multiple'),
(194, 1960482688, 'alexa', 'multiple'),
(195, 111924588, 'christophe_kheder', 'duo'),
(196, 111924588, 'alexa', 'duo'),
(198, 82379965, 'folder', 'duo'),
(200, 379531875, 'alexa', 'multiple');

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
(118, '1680x1050_the-lord-of-the-rings-gandalf-guardians-of-middle-earth.jpg', 479, 'christophe_kheder', '2020-02-02 14:42:44'),
(119, 'EOmmruhXsAQiGM3.jpeg', 480, 'alexa', '2020-02-02 14:46:51'),
(120, 'EOmmruhXsAQiGM3.jpeg', 486, 'christophe_kheder', '2020-02-09 10:41:46'),
(121, 'siege-of-orgrimmar-1680x1050-world-of-warcraft-artwork-6.jpg', 487, 'christophe_kheder', '2020-02-09 10:44:10'),
(123, 'siege-of-orgrimmar-1680x1050-world-of-warcraft-artwork-6.jpg', 501, 'christophe_kheder', '2020-02-21 10:20:37');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE `messagerie` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `created` datetime NOT NULL,
  `conv` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`id`, `user_id`, `message`, `created`, `conv`) VALUES
(12, 'demos', '<p><p>bienvenue sur Instatux </p></p>', '2020-02-02 14:51:49', 989777856),
(11, 'alexa', '<p><p>mais très bien et toi ? </p></p>', '2020-02-02 14:51:30', 989777856),
(10, 'demos', '<p><p>Hello tu va bien ?</p></p>', '2020-02-02 14:50:09', 989777856),
(9, 'demos', '<p><p>Bonjour à toi</p></p>', '2020-02-02 14:49:53', 379531875),
(13, 'alexa', '<p><p>merci</p></p>', '2020-02-02 14:52:04', 989777856),
(14, 'demos', '<p><p>de rien, je peut te suivre ?</p></p>', '2020-02-02 14:52:41', 989777856),
(15, 'alexa', '<p><p>Bien sur je ferais de même</p></p>', '2020-02-02 14:52:53', 989777856),
(16, 'christophe_kheder', '<p><p>Salut bienvenue sur INstatux</p></p>', '2020-02-02 14:54:18', 379531875),
(17, 'demos', '<p><p>Merci à toi  <img src="./img/emoji/smile.png" alt=":smile:" class="emoji_comm"/></p></p>', '2020-02-02 14:54:30', 379531875),
(18, 'christophe_kheder', '<p><p>hello</p></p>', '2020-02-11 10:29:34', 379531875),
(19, 'folder', '<p><p>bonjour</p></p>', '2020-02-19 11:04:55', 1960482688),
(20, 'demos', '<p><p>bonjour à toi</p></p>', '2020-02-19 11:06:55', 1960482688),
(21, 'demos', '<p><p>test envoi</p></p>', '2020-02-19 11:12:39', 1960482688),
(22, 'alexa', '<p><p>reçu</p></p>', '2020-02-19 11:12:46', 1960482688),
(23, 'alexa', '<p><p>reçu<br />\r\n</p></p>', '2020-02-19 11:12:58', 1960482688),
(24, 'folder', '<p><p>reçu</p></p>', '2020-02-19 11:13:12', 1960482688),
(25, 'folder', '<p><p>test</p></p>', '2020-02-19 11:13:34', 1960482688),
(26, 'christophe_kheder', '<p><p>test</p></p>', '2020-02-21 10:24:00', 111924588),
(27, 'christophe_kheder', '<p><p>yo</p></p>', '2020-02-21 10:32:44', 82379965),
(28, 'alexa', '<p><p>bonjour</p></p>', '2020-02-22 10:07:46', 379531875),
(29, 'demos', '<p><p>yo</p></p>', '2020-02-22 10:08:08', 379531875),
(30, 'demos', '<p><p>test</p></p>', '2020-02-22 10:20:51', 379531875),
(31, 'christophe_kheder', '<p><p>test aussi</p></p>', '2020-02-22 10:20:56', 379531875),
(32, 'alexa', '<p><p>test de même</p></p>', '2020-02-22 10:21:01', 379531875),
(33, 'alexa', '<p><p>hey</p></p>', '2020-02-22 10:22:33', 379531875),
(34, 'demos', '<p><p>yo</p></p>', '2020-02-22 10:22:39', 379531875);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notif` int(111) NOT NULL,
  `username` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `created` datetime NOT NULL,
  `statut` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `notifications`
--

INSERT INTO `notifications` (`id_notif`, `username`, `notification`, `created`, `statut`) VALUES
(860, 'christophe_kheder', '<img src="/instatux/img/avatar/demos.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/demos">demos</a> vous à envoyé un <a href="#" class="joinconv" data-idconv = "379531875">message.</a>', '2020-02-02 14:54:30', 1),
(865, 'folder', '<img src="/instatux/img/avatar/demos.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/demos">demos</a> vous à envoyé un <a href="#" class="joinconv" data-idconv = "1960482688">message.</a>', '2020-02-19 11:06:55', 0),
(867, 'folder', '<img src="/instatux/img/avatar/demos.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/demos">demos</a> vous à envoyé un <a href="#" class="joinconv" data-idconv = "1960482688">message.</a>', '2020-02-19 11:12:39', 0),
(882, 'demos', '<img src="/instatux/img/avatar/christophe_kheder.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/christophe_kheder">christophe_kheder</a> à commenté votre <a href="" data-idtweet="485" data-toggle="modal" data-target="#viewtweet" data-remote="false">publication.</a>', '2020-02-20 14:10:50', 1),
(883, 'demos', '<img src="/instatux/img/avatar/alexa.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/alexa">alexa</a> à vous à cité dans un <a href="" data-idtweet="495" data-toggle="modal" data-target="#viewtweet" data-remote="false">publication.</a>', '2020-02-20 14:36:08', 1),
(885, 'demos', '<img src="/instatux/img/avatar/alexa.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/alexa">alexa</a> à accepté votre demande d\'abonnement', '2020-02-20 14:36:30', 1),
(886, 'alexa', '<img src="/instatux/img/avatar/christophe_kheder.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/christophe_kheder">christophe_kheder</a> vous à envoyé un <a href="#" class="joinconv" data-idconv = "111924588">message.</a>', '2020-02-21 10:24:00', 0),
(887, 'folder', '<img src="/instatux/img/avatar/christophe_kheder.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/christophe_kheder">christophe_kheder</a> vous à envoyé un <a href="#" class="joinconv" data-idconv = "82379965">message.</a>', '2020-02-21 10:32:44', 0),
(888, 'alexa', '<img src="/instatux/img/avatar/christophe_kheder.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/christophe_kheder" >christophe_kheder</a> vous à invité à rejoindre une conversation : <a href="#" class="joinconv" data-idconv = "379531875">Rejoindre</a>', '2020-02-22 10:06:43', 0),
(889, 'alexa', '<img src="/instatux/img/avatar/christophe_kheder.jpg" alt="image utilisateur" class="img-thumbail notif_img"/><a href="/instatux/christophe_kheder" >christophe_kheder</a> vous à invité à rejoindre une conversation : <a href="#" class="joinconv" data-idconv = "379531875">Rejoindre</a>', '2020-02-22 10:22:26', 0);

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
(260, 'christophe_kheder', 1929751166, '2020-02-20 11:08:12');

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
(225, 'demos', 0, 'oui', 'oui', 'oui', 'oui', 'oui'),
(226, 'alexa', 1, 'oui', 'oui', 'oui', 'oui', 'oui'),
(227, 'christophe_kheder', 0, 'oui', 'oui', 'oui', 'oui', 'oui'),
(228, 'folder', 1, 'oui', 'oui', 'oui', 'oui', 'oui');

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
(477, 1422863330, 'christophe_kheder', 'christophe_kheder', '<p><p>Superbe vidéo sur CakePHP 4  <img src="./img/emoji/smiley.png" alt=":smiley:" class="emoji_comm"/><br />\r\n<br />\r\n<iframe src="https://www.youtube.com/embed/0SkEU6KP7HM" width="100%" height="360" frameborder="0" allowfullscreen></iframe> </p></p>', '2020-02-02 14:33:08', 0, 0, 0, 0, 0, 0),
(478, 454031184, 'christophe_kheder', 'christophe_kheder', '<p><p>Découvrez et testez Symfony 4 : <a href="https://symfony.com/" target="_blank">https://symfony.com/</a></p></p>', '2020-02-02 14:41:46', 0, 0, 0, 1, 0, 0),
(479, 579470484, 'christophe_kheder', 'christophe_kheder', '<p><p>Mon fond d\'écran <br />\r\n<img src="/instatux/img/media/christophe_kheder/1680x1050_the-lord-of-the-rings-gandalf-guardians-of-middle-earth.jpg" class="tweet_media" width="100%" alt="image introuvable" /> </p></p>', '2020-02-02 14:42:44', 0, 0, 0, 0, 0, 0),
(480, 1630733131, 'alexa', 'alexa', '<p><p><a href="./search/hashtag/needcoffee">%23needcoffee</a><br />\r\n<br />\r\n<img src="/instatux/img/media/alexa/EOmmruhXsAQiGM3.jpeg" class="tweet_media" width="100%" alt="image introuvable" /> </p></p>', '2020-02-02 14:46:51', 0, 0, 0, 0, 1, 0),
(481, 1780979209, 'alexa', 'alexa', '<p><p><a href="./search/hashtag/test">%23test</a></p></p>', '2020-02-02 14:47:42', 0, 0, 0, 0, 1, 0),
(482, 1847038062, 'demos', 'demos', '<p><p><a href="./search/hashtag/test">%23test</a></p></p>', '2020-02-08 15:17:30', 0, 0, 0, 0, 0, 0),
(483, 484272516, 'demos', 'demos', '<p><p><a href="./search/hashtag/test">#test</a></p></p>', '2020-02-08 15:19:33', 0, 0, 0, 0, 0, 0),
(484, 1362457463, 'demos', 'demos', '<p><p><iframe src="https://www.youtube.com/embed/r8BRMfxxJnY"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> </p></p>', '2020-02-08 15:21:34', 0, 0, 0, 0, 0, 0),
(485, 1929751166, 'demos', 'demos', '<p><p><a href="https://www.youtube.com/watch?v=r8BRMfxxJnY" target="_blank">https://www.youtube.com/watch?v=r8BRMfxxJnY</a></p></p>', '2020-02-08 15:22:07', 0, 4, 0, 1, 0, 0),
(486, 578128526, 'christophe_kheder', 'christophe_kheder', '<p><p><img src="/instatux/img/media/christophe_kheder/EOmmruhXsAQiGM3.jpeg" class="tweet_media" width="100%" alt="image introuvable" /> </p></p>', '2020-02-09 10:41:46', 0, 0, 0, 0, 0, 0),
(487, 1051704162, 'christophe_kheder', 'christophe_kheder', '<p><p><img src="/instatux/img/media/christophe_kheder/siege-of-orgrimmar-1680x1050-world-of-warcraft-artwork-6.jpg" class="tweet_media" width="100%" alt="image introuvable" /> </p></p>', '2020-02-09 10:44:10', 0, 0, 0, 0, 0, 0),
(488, 2142021215, 'christophe_kheder', 'christophe_kheder', '<p><p><iframe src="https://www.youtube.com/embed/9OUsrUi9r_Y"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> </p></p>', '2020-02-09 10:45:48', 0, 0, 0, 2, 0, 0),
(490, 1611699539, 'folder', 'folder', '<p><p><a href="https://twitter.com/Alliestrasza" target="_blank">https://twitter.com/Alliestrasza</a> <iframe src="https://www.youtube.com/embed/9Mj39qQj2Ok"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> </p></p>', '2020-02-19 10:39:31', 0, 0, 0, 0, 1, 0),
(492, 22453340, 'christophe_kheder', 'christophe_kheder', '<p><p><a href="./demos">@demos</a> salut</p></p>', '2020-02-20 10:14:45', 0, 0, 0, 0, 0, 0),
(493, 169961474, 'christophe_kheder', 'christophe_kheder', '<p><p><a href="./demos">@demos</a> hello</p></p>', '2020-02-20 10:57:28', 0, 0, 0, 0, 0, 0),
(494, 1929751166, 'demos', 'christophe_kheder', '<p><p><a href="https://www.youtube.com/watch?v=r8BRMfxxJnY" target="_blank">https://www.youtube.com/watch?v=r8BRMfxxJnY</a></p></p>', '2020-02-20 11:08:12', 1, 0, 0, 0, 0, 0),
(495, 583730374, 'alexa', 'alexa', '<p><p><a href="./demos">@demos</a>  <img src="./img/emoji/heart_eyes.png" alt=":heart_eyes:" class="emoji_comm"/><br />\r\n</p></p>', '2020-02-20 14:36:08', 0, 0, 0, 0, 1, 0),
(496, 1692793241, 'christophe_kheder', 'christophe_kheder', '<p><p><iframe src="https://www.youtube.com/embed/r8BRMfxxJnY"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> meilleur test </p></p>', '2020-02-21 10:13:29', 0, 0, 0, 0, 0, 0),
(497, 1170050915, 'christophe_kheder', 'christophe_kheder', '<p><p><iframe src="https://www.youtube.com/embed/r8BRMfxxJnY"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> best test ever</p></p>', '2020-02-21 10:17:21', 0, 0, 0, 0, 0, 0),
(498, 1680602461, 'christophe_kheder', 'christophe_kheder', '<p><p><iframe src="https://www.youtube.com/embed/r8BRMfxxJnY"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> osef</p></p>', '2020-02-21 10:18:18', 0, 0, 0, 0, 0, 0),
(499, 1608345809, 'christophe_kheder', 'christophe_kheder', '<p><p><iframe src="https://www.youtube.com/embed/r8BRMfxxJnY"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> ter</p></p>', '2020-02-21 10:19:07', 0, 0, 0, 0, 0, 0),
(500, 245570903, 'christophe_kheder', 'christophe_kheder', '<p><p><iframe src="https://www.youtube.com/embed/r8BRMfxxJnY"  width="100%" height="360" frameborder="0" allowfullscreen></iframe> fin</p></p>', '2020-02-21 10:20:25', 0, 0, 0, 0, 0, 0),
(501, 285603784, 'christophe_kheder', 'christophe_kheder', '<p><p><img src="/instatux/img/media/christophe_kheder/siege-of-orgrimmar-1680x1050-world-of-warcraft-artwork-6.jpg" class="tweet_media" width="100%" alt="image introuvable" /> </p></p>', '2020-02-21 10:20:37', 0, 2, 0, 0, 0, 0),
(504, 1055568600, 'christophe_kheder', 'christophe_kheder', '<p><iframe src="https://www.youtube.com/embed/67SaQXmED4E"  width="100%" height="360" frameborder="0" allowfullscreen></iframe></p> mamoky', '2020-02-24 10:38:46', 0, 0, 0, 0, 0, 0),
(505, 882012276, 'christophe_kheder', 'christophe_kheder', '<p><iframe src="https://www.youtube.com/embed/67SaQXmED4E"  width="100%" height="360" frameborder="0" allowfullscreen></iframe></p> ', '2020-02-24 10:39:01', 0, 1, 0, 0, 0, 0);

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
  `description` text DEFAULT NULL,
  `lieu` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `description`, `lieu`, `website`) VALUES
(282, 'demos', '$2y$10$548XMQEz.nsprwLrvZSwqu2YkqUgR1pI3AoIFGdJ.QvHnxrPk02hW', 'demo@gmail.com', '2020-02-02 14:25:54', NULL, NULL, NULL),
(283, 'alexa', '$2y$10$5sR8OU3v.CWcHPXQhzhsL.Bd7nvxx3os7H6sQYZFsGIGFZ0Ghsv.O', 'alexa@gmail.com', '2020-02-02 14:26:29', 'Lexi Kaufman / 3x Raw & 2x Smackdown live women\'s champion / 1/2 WWE Women’s Tag Champion / From Columbus,Ohio . <a href="./search/hashtag/littlemissbliss">#littlemissbliss</a> <a href="./search/hashtag/fivefeetoffury">#fivefeetoffury</a>', 'Columbus, Ohio', 'https://www.instagram.com/alexa_bliss_wwe_/'),
(284, 'christophe_kheder', '$2y$10$CKr1XePXT2mo2aU2OuPI6OHFn0Hby/eqW7RdIhkWK/2DrPI38TrEC', 'christophekheder@gmail.com', '2020-02-02 14:27:00', 'Développeur d\'Instatux', 'Metz', 'https://christophekheder.com/'),
(285, 'folder', '$2y$10$IOjWjSkK9JfdeUpHgnR8UOq/dwbf3ZjRamJ4EYp7GHFyuBWiMDbaC', 'folder1@gmail.com', '2020-02-19 10:26:05', '<a href="./Twitch">@Twitch</a>\r\n Broadcaster \r\n Business Email: alliestrasza@gmail.com \r\n<a href="http://instagram.com/Alliestrasza_">http://instagram.com/Alliestrasza_</a> ', 'Metz', 'https://twitter.com/Alliestrasza');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant1` (`user_conv`),
  ADD KEY `participant1_2` (`user_conv`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=839;
--
-- AUTO_INCREMENT pour la table `aime`
--
ALTER TABLE `aime`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=509;
--
-- AUTO_INCREMENT pour la table `blocage`
--
ALTER TABLE `blocage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- AUTO_INCREMENT pour la table `media`
--
ALTER TABLE `media`
  MODIFY `id_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT pour la table `messagerie`
--
ALTER TABLE `messagerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=890;
--
-- AUTO_INCREMENT pour la table `partage`
--
ALTER TABLE `partage`
  MODIFY `id_partage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;
--
-- AUTO_INCREMENT pour la table `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id_tweet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
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
