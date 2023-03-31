-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2023 at 04:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verrukkulluk`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` int(6) NOT NULL,
  `naam` varchar(100) DEFAULT NULL,
  `omschrijving` varchar(500) DEFAULT NULL,
  `prijs` decimal(4,2) DEFAULT NULL,
  `eenheid` varchar(100) DEFAULT NULL,
  `verpakking` int(11) DEFAULT NULL,
  `kcal` float NOT NULL COMMENT 'per eenheid (stuk, ml, gram)',
  `afbeelding` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `naam`, `omschrijving`, `prijs`, `eenheid`, `verpakking`, `kcal`, `afbeelding`) VALUES
(1, 'Eieren', 'Biologische eieren boerderij kip', '2.20', 'stuks', 6, 90, 'https://flevotrade.nl/wp-content/uploads/2019/11/flevotrade_eggs_product.jpg'),
(2, 'Melk', 'Biologische melk van boerderij leus', '1.00', 'ml', 1000, 0.448, 'https://cdn.hoogvliet.com/Images/Product/XL/083939000.jpg'),
(3, 'Burger broodje', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation', '3.45', 'stuks', 6, 153, 'https://images.squarespace-cdn.com/content/v1/564d0477e4b0b1c72d78148c/1518800646014-2RR2QAHNB6ZNVVA31K5D/21601.jpg?format=1000w'),
(4, 'Burger sauce', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation  ', '2.55', 'ml', 650, 6.65, 'https://aldprdproductimages.azureedge.net/media/resized/$Aldi_GB/ALL_RESIZED3/4088600155890_0_L.png'),
(5, 'Pasta', 'Gedroogde italiaanse pasta van durum', '2.20', 'gram', 500, 3.57, 'https://sc04.alicdn.com/kf/Ua3d1eeeff21d46d1bcacb434e574912ak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `boodschappenlijst`
--

CREATE TABLE `boodschappenlijst` (
  `id` int(6) NOT NULL,
  `user_id` int(6) DEFAULT NULL,
  `artikel_id` int(6) DEFAULT NULL,
  `bestelAantal` varchar(255) DEFAULT NULL,
  `ingebruik` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boodschappenlijst`
--

INSERT INTO `boodschappenlijst` (`id`, `user_id`, `artikel_id`, `bestelAantal`, `ingebruik`) VALUES
(1, 2, 3, '1', '4'),
(2, 2, 4, '1', '60'),
(3, 2, 1, '1', '3'),
(4, 2, 2, '13', '13000'),
(5, 2, 5, '7', '3250'),
(8, 4, 5, '3', '1250'),
(9, 4, 2, '5', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `gerecht`
--

CREATE TABLE `gerecht` (
  `id` int(6) NOT NULL,
  `keuken_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `titel` varchar(75) NOT NULL,
  `korte_omschrijving` varchar(500) NOT NULL,
  `lange_omschrijving` varchar(1000) NOT NULL,
  `afbeelding` varchar(250) DEFAULT NULL,
  `datum_toegevoegd` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gerecht`
--

INSERT INTO `gerecht` (`id`, `keuken_id`, `type_id`, `user_id`, `titel`, `korte_omschrijving`, `lange_omschrijving`, `afbeelding`, `datum_toegevoegd`) VALUES
(21, 1, 5, 2, 'Vegan burger', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'https://www.thespruceeats.com/thmb/e-lll-PpJ5F-MF4C57LYag3IAB8=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/easy-vegan-black-bean-veggie-burgers-3377008-hero-05-f7c0f0d9865e48b6be52a4c76ee22438.jpg', '2023-03-29 05:46:00'),
(22, 8, 7, 2, 'Lasagne', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'https://www.galbani.be/wp-content/uploads/2020/06/shutterstock_142426168-scaled-1-800x600.jpg', '2023-03-29 05:46:43'),
(23, 2, 5, 4, 'Eggs and veggies', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'https://images.eatthismuch.com/img/717738_MTawheed_a35930f8-aef1-4685-aef5-3dee288eea87.jpg', '2023-03-29 05:47:26'),
(24, 4, 6, 3, 'Sushi rolls', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'https://t1.gstatic.com/licensed-image?q=tbn:ANd9GcRI6qsN_ZgCrTsxdnqSaktf4oAjvxseZ9YmZsVqWkr5v3zZfoVmWUX88fzjut_PMyoOWUOTr0p289J3fDc', '2023-03-29 05:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `gerecht_info`
--

CREATE TABLE `gerecht_info` (
  `id` int(6) UNSIGNED NOT NULL,
  `record_type` char(1) DEFAULT NULL,
  `gerecht_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nummeriekveld` int(6) DEFAULT NULL,
  `tekstveld` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gerecht_info`
--

INSERT INTO `gerecht_info` (`id`, `record_type`, `gerecht_id`, `user_id`, `datum`, `nummeriekveld`, `tekstveld`) VALUES
(13, 'B', 21, NULL, '2023-03-31 09:52:28', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(14, 'B', 21, NULL, '2023-03-31 09:52:33', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(15, 'B', 21, NULL, '2023-03-31 10:12:54', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(16, 'F', 21, 3, '2023-03-22 13:55:42', 4, ''),
(17, 'O', 21, 1, '2023-03-22 08:01:16', NULL, 'Super lekker!'),
(18, 'O', 21, 3, '2023-03-31 10:28:51', NULL, 'Te moeilijk!'),
(19, 'F', 21, 2, '2023-03-22 08:01:16', NULL, NULL),
(20, 'F', 24, 1, '2023-03-22 08:01:16', NULL, NULL),
(21, 'W', 21, 1, '2023-03-23 10:46:19', 5, NULL),
(25, 'W', 21, 2, '2023-03-23 07:23:02', 3, NULL),
(36, 'F', 22, 2, '2023-03-23 12:28:12', NULL, NULL),
(109, 'F', 21, 1, '2023-03-30 11:59:14', NULL, NULL),
(110, 'W', 21, NULL, '2023-03-31 07:20:20', 2, NULL),
(111, 'O', 21, 2, '2023-03-31 10:28:35', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing Lorem ipsum dolor sit amet, consectetur adipiscing'),
(112, 'B', 22, 2, '2023-03-31 11:56:16', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(113, 'B', 22, NULL, '2023-03-31 11:56:39', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(114, 'B', 22, NULL, '2023-03-31 11:56:53', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(115, 'B', 22, NULL, '2023-03-31 11:57:13', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(116, 'B', 22, NULL, '2023-03-31 11:57:31', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'),
(117, 'O', 22, 2, '2023-03-31 11:58:06', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(118, 'W', 22, NULL, '2023-03-31 12:04:59', 3, NULL),
(119, 'W', 22, NULL, '2023-03-31 12:05:07', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(6) NOT NULL,
  `gerecht_id` int(11) DEFAULT NULL,
  `artikel_id` int(11) DEFAULT NULL,
  `aantal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient`
--

INSERT INTO `ingredient` (`id`, `gerecht_id`, `artikel_id`, `aantal`) VALUES
(29, 21, 3, 4),
(30, 21, 4, 60),
(31, 22, 5, 250),
(32, 22, 2, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `keuken_type`
--

CREATE TABLE `keuken_type` (
  `id` int(6) NOT NULL,
  `record_type` char(1) NOT NULL,
  `omschrijving` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keuken_type`
--

INSERT INTO `keuken_type` (`id`, `record_type`, `omschrijving`) VALUES
(1, 'K', 'Amerikaans'),
(2, 'K', 'Chinees'),
(3, 'T', 'Vlees'),
(4, 'K', 'Japans'),
(5, 'T', 'Vega'),
(6, 'T', 'Vis'),
(7, 'T', 'Pasta'),
(8, 'K', 'Italiaans');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(6) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `afbeelding` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `afbeelding`) VALUES
(1, 'Kees', 'KEES1998', 'kees@example.com', 'https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8dXNlcnxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=900&q=60'),
(2, 'Mexx', 'xxxx', 'mexx@example.com', 'https://www.boredpanda.com/blog/wp-content/uploads/2017/04/these-beautiful-portraits-show-that-redheads-arent-only-from-ireland-scotland-13-58e8aa9753431__880.jpg'),
(3, 'Soraya', 'xxxxx', 'soraya@example.com', 'https://miro.medium.com/v2/resize:fit:1200/1*Ss70nvjqEXusREvoyutFuA.jpeg'),
(4, 'Lush', 'xxxxx', 'lush@example.com', 'https://www.example.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boodschappenlijst`
--
ALTER TABLE `boodschappenlijst`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- Indexes for table `gerecht`
--
ALTER TABLE `gerecht`
  ADD PRIMARY KEY (`id`),
  ADD KEY `keuken_id` (`keuken_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerecht_id` (`gerecht_id`);

--
-- Indexes for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gerecht_id` (`gerecht_id`),
  ADD KEY `artikel_id` (`artikel_id`);

--
-- Indexes for table `keuken_type`
--
ALTER TABLE `keuken_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `boodschappenlijst`
--
ALTER TABLE `boodschappenlijst`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gerecht`
--
ALTER TABLE `gerecht`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gerecht_info`
--
ALTER TABLE `gerecht_info`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `keuken_type`
--
ALTER TABLE `keuken_type`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `boodschappenlijst`
--
ALTER TABLE `boodschappenlijst`
  ADD CONSTRAINT `boodschappenlijst_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `boodschappenlijst_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `gerecht`
--
ALTER TABLE `gerecht`
  ADD CONSTRAINT `gerecht_ibfk_1` FOREIGN KEY (`keuken_id`) REFERENCES `keuken_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `gerecht_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `keuken_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `gerecht_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `gerecht_info`
--
ALTER TABLE `gerecht_info`
  ADD CONSTRAINT `gerecht_info_ibfk_1` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`gerecht_id`) REFERENCES `gerecht` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`artikel_id`) REFERENCES `artikel` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
