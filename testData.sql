-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2017 at 05:14 PM
-- Server version: 10.0.29-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `name` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `rank`, `name`) VALUES
(1, 0, 'Rec'),
(2, 1, 'Sap'),
(3, 2, 'App'),
(4, 3, 'AppC'),
(5, 4, 'Cpl'),
(6, 5, 'Sgt'),
(7, 6, 'SgtC'),
(8, 7, 'Adj'),
(9, 8, 'Four'),
(10, 9, 'Sgtm'),
(11, 10, 'SgtmC'),
(12, 11, 'Adj sof'),
(13, 12, 'Adj EM'),
(14, 13, 'Adj maj'),
(15, 14, 'Adj Chef'),
(16, 15, 'Lt'),
(17, 16, 'Plt'),
(18, 17, 'Cap'),
(19, 18, 'Maj'),
(20, 19, 'Lt col'),
(21, 20, 'Col');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `ECAnum` text,
  `size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id`, `name`, `ECAnum`, `size_id`) VALUES
(1, 'Veste SP F1', '11.01/0003', 4),
(2, 'Pantalon SP F1', '11.01/0004', 1),
(3, 'Ceinture SP F1', '11.01/0009', NULL),
(4, 'T-shirt', '11.01/0007', 7),
(5, 'Pullover ML', NULL, 7),
(6, 'Polo MC', '11.01/0058', 7),
(7, 'Bandes patronymique', NULL, NULL),
(8, 'Casquette', '11.01/0018', 8),
(9, 'Bonnet', NULL, NULL),
(10, 'Veste feu "Equinox"', '11.02/0007', 6),
(11, 'Pantalon feu "Equinox"', '11.03/0007', 2),
(12, 'Veste feu "phoenix"', '11.02/0008', 5),
(13, 'Pantalon feu "phoenix "', '11.03/0008', 3),
(14, 'Casque f1 blanc', '11.04/0018', NULL),
(15, 'Casque f1 lemon', '11.04/0024', NULL),
(16, 'Casque f1 rouge', '11.04/0025', NULL),
(17, 'Lampe de poche casque LED ', '11.04/0041', NULL),
(18, 'Ostéophone savox', '18.09/0012', NULL),
(19, 'Bottes caoutchouc', '11.05/0001', 10),
(20, 'Bottes cuir', '11.05/0002', 10),
(21, 'Bottes Flash', NULL, 10),
(22, 'Gants cuir avec mousqueton', '11.09/0001', 14),
(23, 'Gants feu avec mousqueton', '11.09/0003', 15),
(24, 'Veste softshell', NULL, 7),
(25, 'Calle en bois', NULL, NULL),
(26, 'Badge ( acces locaux )', NULL, NULL),
(27, 'Clef Kaba 5000 + carrée avec chaînette', NULL, NULL),
(28, 'Badges de manche (Logo SDIS)', NULL, NULL),
(29, 'Cagoule', NULL, NULL),
(30, 'Anneau cousu + Mousequeton', NULL, NULL),
(31, 'Clef panneau détéction', NULL, NULL),
(32, 'Pager & Accessoires', NULL, NULL),
(33, 'Grade Velcro', NULL, 16),
(34, 'Bandes autocollantes casque f1 rouge', NULL, NULL),
(35, 'Bandes autocollantes casque f1 grise', NULL, NULL),
(36, 'Bandes autocollantes casque f1 jaune', NULL, NULL),
(37, 'Tenue de sortie Veste', NULL, NULL),
(38, 'Tenue de sortie Pantalon', NULL, NULL),
(39, 'Tenue de sortie Chemise manches longues', NULL, NULL),
(40, 'Tenue de sortie Chemise manches courtes', NULL, NULL),
(41, 'Tenue de sortie Cravatte', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL COMMENT 'id of the personnel',
  `lastname` varchar(25) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(25) COLLATE utf8_bin NOT NULL,
  `grade_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Enum of grade',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `CIPA` tinyint(1) NOT NULL DEFAULT '0',
  `CISDIS` tinyint(1) NOT NULL DEFAULT '0',
  `driver` tinyint(1) NOT NULL DEFAULT '0',
  `APR` tinyint(1) NOT NULL DEFAULT '0',
  `prepose` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Personnel';

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `lastname`, `firstname`, `grade_id`, `active`, `CIPA`, `CISDIS`, `driver`, `APR`, `prepose`) VALUES
(1, 'Mon Nom', 'Mon prenom', 3, 1, 0, 0, 0, 0, 0),
(2, 'Worth', 'Jonne', 8, 1, 0, 0, 1, 1, 1),
(3, 'Ra', 'Xav', 6, 1, 0, 0, 0, 0, 0),
(4, 'Zorg', 'Manimus', 5, 1, 1, 1, 1, 1, 1),
(5, 'Muller2', 'Jean', 4, 1, 1, 1, 1, 1, 1),
(7, 'Moriez', 'Sandra', 9, 1, 0, 0, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int(11) NOT NULL,
  `sizeName_id` int(11) NOT NULL,
  `size` text NOT NULL,
  `order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `sizeName_id`, `size`, `order`) VALUES
(1, 4, '80CX', 1),
(2, 4, '80C', 2),
(3, 4, '80M', 3),
(4, 4, '80L', 4),
(5, 4, '80XL', 5),
(6, 4, '80XXL', 6),
(7, 4, '84CX', 7),
(8, 4, '84C', 8),
(9, 4, '84M', 9),
(10, 4, '84L', 10),
(11, 4, '84XL', 11),
(12, 4, '84XXL', 12),
(13, 4, '88CX', 13),
(14, 4, '88C', 14),
(15, 4, '88M', 15),
(16, 4, '88L', 16),
(17, 4, '88XL', 17),
(18, 4, '88XXL', 18),
(19, 4, '92CX', 19),
(20, 4, '92C', 20),
(21, 4, '92M', 21),
(22, 4, '92L', 22),
(23, 4, '92XL', 23),
(24, 4, '92XXL', 24),
(25, 4, '96CX', 25),
(26, 4, '96C', 26),
(27, 4, '96M', 27),
(28, 4, '96L', 28),
(29, 4, '96XL', 29),
(30, 4, '96XXL', 30),
(31, 4, '100CX', 31),
(32, 4, '100C', 32),
(33, 4, '100M', 33),
(34, 4, '100L', 34),
(35, 4, '100XL', 35),
(36, 4, '100XXL', 36),
(37, 4, '104CX', 37),
(38, 4, '104C', 38),
(39, 4, '104M', 39),
(40, 4, '104L', 40),
(41, 4, '104XL', 41),
(42, 4, '104XXL', 42),
(43, 4, '108CX', 43),
(44, 4, '108C', 44),
(45, 4, '108M', 45),
(46, 4, '108L', 46),
(47, 4, '108XL', 47),
(48, 4, '108XXL', 48),
(49, 4, '112CX', 49),
(50, 4, '112C', 50),
(51, 4, '112M', 51),
(52, 4, '112L', 52),
(53, 4, '112XL', 53),
(54, 4, '112XXL', 54),
(55, 4, '116CX', 55),
(56, 4, '116C', 56),
(57, 4, '116M', 57),
(58, 4, '116L', 58),
(59, 4, '116XL', 59),
(60, 4, '116XXL', 60),
(61, 4, '120CX', 61),
(62, 4, '120C', 62),
(63, 4, '120M', 63),
(64, 4, '120L', 64),
(65, 4, '120XL', 65),
(66, 4, '120XXL', 66),
(67, 4, '124CX', 67),
(68, 4, '124C', 68),
(69, 4, '124M', 69),
(70, 4, '124L', 70),
(71, 4, '124XL', 71),
(72, 4, '124XXL', 72),
(73, 4, '128CX', 73),
(74, 4, '128C', 74),
(75, 4, '128M', 75),
(76, 4, '128L', 76),
(77, 4, '128XL', 77),
(78, 4, '128XXL', 78),
(79, 4, '132CX', 79),
(80, 4, '132C', 80),
(81, 4, '132M', 81),
(82, 4, '132L', 82),
(83, 4, '132XL', 83),
(84, 4, '132XXL', 84),
(85, 1, '68XC', 1),
(86, 1, '68C', 2),
(87, 1, '68M', 3),
(88, 1, '68L', 4),
(89, 1, '68XL', 5),
(90, 1, '68XXL', 6),
(91, 1, '72XC', 7),
(92, 1, '72C', 8),
(93, 1, '72M', 9),
(94, 1, '72L', 10),
(95, 1, '72XL', 11),
(96, 1, '72XXL', 12),
(97, 1, '76XC', 13),
(98, 1, '76C', 14),
(99, 1, '76M', 15),
(100, 1, '76L', 16),
(101, 1, '76XL', 17),
(102, 1, '76XXL', 18),
(103, 1, '80XC', 19),
(104, 1, '80C', 20),
(105, 1, '80M', 21),
(106, 1, '80L', 22),
(107, 1, '80XL', 23),
(108, 1, '80XXL', 24),
(109, 1, '84XC', 25),
(110, 1, '84C', 26),
(111, 1, '84M', 27),
(112, 1, '84L', 28),
(113, 1, '84XL', 29),
(114, 1, '84XXL', 30),
(115, 1, '88XC', 31),
(116, 1, '88C', 32),
(117, 1, '88M', 33),
(118, 1, '88L', 34),
(119, 1, '88XL', 35),
(120, 1, '88XXL', 36),
(121, 1, '92XC', 37),
(122, 1, '92C', 38),
(123, 1, '92M', 39),
(124, 1, '92L', 40),
(125, 1, '92XL', 41),
(126, 1, '92XXL', 42),
(127, 1, '96XC', 43),
(128, 1, '96C', 44),
(129, 1, '96M', 45),
(130, 1, '96L', 46),
(131, 1, '96XL', 47),
(132, 1, '96XXL', 48),
(133, 1, '100XC', 49),
(134, 1, '100C', 50),
(135, 1, '100M', 51),
(136, 1, '100L', 52),
(137, 1, '100XL', 53),
(138, 1, '100XXL', 54),
(139, 1, '104XC', 55),
(140, 1, '104C', 56),
(141, 1, '104M', 57),
(142, 1, '104L', 58),
(143, 1, '104XL', 59),
(144, 1, '104XXL', 60),
(145, 1, '108XC', 61),
(146, 1, '108C', 62),
(147, 1, '108M', 63),
(148, 1, '108L', 64),
(149, 1, '108XL', 65),
(150, 1, '108XXL', 66),
(151, 1, '112XC', 67),
(152, 1, '112C', 68),
(153, 1, '112M', 69),
(154, 1, '112L', 70),
(155, 1, '112XL', 71),
(156, 1, '112XXL', 72),
(157, 1, '116XC', 73),
(158, 1, '116C', 74),
(159, 1, '116M', 75),
(160, 1, '116L', 76),
(161, 1, '116XL', 77),
(162, 1, '116XXL', 78),
(163, 6, '80S', 1),
(164, 6, '80N', 2),
(165, 6, '80L', 3),
(166, 6, '88S', 4),
(167, 6, '88N', 5),
(168, 6, '88L', 6),
(169, 6, '96S', 7),
(170, 6, '96N', 8),
(171, 6, '96L', 9),
(172, 6, '104S', 10),
(173, 6, '104N', 11),
(174, 6, '104L', 12),
(175, 6, '112S', 13),
(176, 6, '112N', 14),
(177, 6, '112L', 15),
(178, 6, '120S', 16),
(179, 6, '120N', 17),
(180, 6, '120L', 18),
(181, 6, '128S', 19),
(182, 6, '128N', 20),
(183, 6, '128L', 21),
(184, 6, '136S', 22),
(185, 6, '136N', 23),
(186, 6, '136L', 24),
(187, 6, '144S', 25),
(188, 6, '144N', 26),
(189, 6, '144L', 27),
(190, 2, '1S', 1),
(191, 2, '1N', 2),
(192, 2, '1L', 3),
(193, 2, '2S', 4),
(194, 2, '2N', 5),
(195, 2, '2L', 6),
(196, 2, '3S', 7),
(197, 2, '3N', 8),
(198, 2, '3L', 9),
(199, 2, '4S', 10),
(200, 2, '4N', 11),
(201, 2, '4L', 12),
(202, 2, '5S', 13),
(203, 2, '5N', 14),
(204, 2, '5L', 15),
(205, 2, '6S', 16),
(206, 2, '6N', 17),
(207, 2, '6L', 18),
(208, 2, '7S', 19),
(209, 2, '7N', 20),
(210, 2, '7L', 21),
(211, 2, '8S', 22),
(212, 2, '8N', 23),
(213, 2, '8L', 24),
(214, 2, '9S', 25),
(215, 2, '9N', 26),
(216, 2, '9L', 27),
(217, 7, 'XS', 1),
(218, 7, 'S', 2),
(219, 7, 'M', 3),
(220, 7, 'L', 4),
(221, 7, 'XL', 5),
(222, 7, '2XL', 6),
(223, 8, '51-52', 1),
(224, 8, '53-54', 2),
(225, 8, '55-56', 3),
(226, 8, '57-58', 4),
(227, 8, '59-60', 5),
(228, 8, '61-62', 6),
(229, 10, '35', 1),
(230, 10, '36', 2),
(231, 10, '36', 3),
(232, 10, '38', 4),
(233, 10, '39', 5),
(234, 10, '40', 6),
(235, 10, '41', 7),
(236, 10, '42', 8),
(237, 10, '43', 9),
(238, 10, '44', 10),
(239, 10, '45', 11),
(240, 10, '46', 12),
(241, 10, '47', 13),
(242, 10, '48', 14),
(243, 10, '49', 15),
(244, 3, '1XS', 1),
(245, 3, '1S', 2),
(246, 3, '1N', 3),
(247, 3, '1L', 4),
(248, 3, '1XL', 5),
(249, 3, '2XS', 6),
(250, 3, '2S', 7),
(251, 3, '2N', 8),
(252, 3, '2L', 9),
(253, 3, '2XL', 10),
(254, 3, '3XS', 11),
(255, 3, '3S', 12),
(256, 3, '3N', 13),
(257, 3, '3L', 14),
(258, 3, '3XL', 15),
(259, 3, '4XS', 16),
(260, 3, '4S', 17),
(261, 3, '4N', 18),
(262, 3, '4L', 19),
(263, 3, '4XL', 20),
(264, 3, '5XS', 21),
(265, 3, '5S', 22),
(266, 3, '5N', 23),
(267, 3, '5L', 24),
(268, 3, '5XL', 25),
(269, 3, '6XS', 26),
(270, 3, '6S', 27),
(271, 3, '6N', 28),
(272, 3, '6L', 29),
(273, 3, '6XL', 30),
(274, 3, '7XS', 31),
(275, 3, '7S', 32),
(276, 3, '7N', 33),
(277, 3, '7L', 34),
(278, 3, '7XL', 35),
(279, 3, '8XS', 36),
(280, 3, '8S', 37),
(281, 3, '8N', 38),
(282, 3, '8L', 39),
(283, 3, '8XL', 40),
(284, 3, '9XS', 41),
(285, 3, '9S', 42),
(286, 3, '9N', 43),
(287, 3, '9L', 44),
(288, 3, '9XL', 45),
(289, 6, '80XS', 1),
(290, 6, '80S', 2),
(291, 6, '80N', 3),
(292, 6, '80L', 4),
(293, 6, '80XL', 5),
(294, 6, '88XS', 6),
(295, 6, '88S', 7),
(296, 6, '88N', 8),
(297, 6, '88L', 9),
(298, 6, '88XL', 10),
(299, 6, '96XS', 11),
(300, 6, '96S', 12),
(301, 6, '96N', 13),
(302, 6, '96L', 14),
(303, 6, '96XL', 15),
(304, 6, '104XS', 16),
(305, 6, '104S', 17),
(306, 6, '104N', 18),
(307, 6, '104L', 19),
(308, 6, '104XL', 20),
(309, 6, '112XS', 21),
(310, 6, '112S', 22),
(311, 6, '112N', 23),
(312, 6, '112L', 24),
(313, 6, '112XL', 25),
(314, 6, '120XS', 26),
(315, 6, '120S', 27),
(316, 6, '120N', 28),
(317, 6, '120L', 29),
(318, 6, '120XL', 30),
(319, 6, '128XS', 31),
(320, 6, '128S', 32),
(321, 6, '128N', 33),
(322, 6, '128L', 34),
(323, 6, '128XL', 35),
(324, 6, '136XS', 36),
(325, 6, '136S', 37),
(326, 6, '136N', 38),
(327, 6, '136L', 39),
(328, 6, '136XL', 40),
(329, 6, '144XS', 41),
(330, 6, '144S', 42),
(331, 6, '144N', 43),
(332, 6, '144L', 44),
(333, 6, '144XL', 45),
(334, 14, 'T8', 1),
(335, 14, 'T9', 2),
(336, 14, 'T10', 3),
(337, 14, 'T11', 4),
(338, 14, 'T12', 5),
(339, 15, 'T7', 1),
(340, 15, 'T8', 2),
(341, 15, 'T9', 3),
(342, 15, 'T10', 4),
(343, 15, 'T11', 5),
(344, 15, 'T12', 6),
(345, 15, 'T13', 7),
(346, 15, 'T14', 8),
(347, 16, 'Sap', 1),
(348, 16, 'App', 2),
(349, 16, 'AppC', 3),
(350, 16, 'Cpl', 4),
(351, 16, 'Sgt', 5),
(352, 16, 'SgtC', 6),
(353, 16, 'Adj', 7),
(354, 16, 'Four', 8),
(355, 16, 'Sgtm', 9),
(356, 16, 'SgtmC', 10),
(357, 16, 'Adj sof', 11),
(358, 16, 'Adj EM', 12),
(359, 16, 'Adj maj', 13),
(360, 16, 'Adj Chef', 14),
(361, 16, 'Lt', 15),
(362, 16, 'Plt', 16),
(363, 16, 'Cap', 17),
(364, 16, 'Maj', 18),
(365, 16, 'Lt col', 19),
(366, 16, 'Col', 20);

-- --------------------------------------------------------

--
-- Table structure for table `sizeName`
--

CREATE TABLE `sizeName` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizeName`
--

INSERT INTO `sizeName` (`id`, `name`) VALUES
(1, 'Pantalon SP'),
(2, 'Pantalon Equinox'),
(3, 'Pantalon Phoenix'),
(4, 'Veste SP'),
(5, 'Veste Phoenix'),
(6, 'Veste Equinox'),
(7, 'Standard'),
(8, 'Casquette'),
(10, 'Bottes'),
(14, 'Gants cuir'),
(15, 'Gants feu'),
(16, 'grade velcro');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizeName`
--
ALTER TABLE `sizeName`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id of the personnel', AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=367;
--
-- AUTO_INCREMENT for table `sizeName`
--
ALTER TABLE `sizeName`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
