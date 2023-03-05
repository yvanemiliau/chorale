-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2023 at 08:25 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chorale`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220118155336', '2022-01-18 18:53:41', 801),
('DoctrineMigrations\\Version20220119053054', '2022-01-19 10:45:40', 636),
('DoctrineMigrations\\Version20220119082035', '2022-01-19 11:20:50', 927),
('DoctrineMigrations\\Version20220119180639', '2022-01-19 21:06:51', 631),
('DoctrineMigrations\\Version20220119183019', '2022-01-19 21:30:34', 428),
('DoctrineMigrations\\Version20220119183113', '2022-01-19 21:31:42', 422),
('DoctrineMigrations\\Version20220120045702', '2022-01-20 07:57:13', 703),
('DoctrineMigrations\\Version20220122170204', '2022-01-22 20:02:37', 770),
('DoctrineMigrations\\Version20220122181217', '2022-01-22 21:12:28', 368);

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `sexe_id` int(11) NOT NULL,
  `responsable_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_anniversaire` date DEFAULT NULL,
  `voix_id` int(11) DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appelation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirme` tinyint(1) NOT NULL,
  `talents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `responsable`
--

CREATE TABLE `responsable` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responsable`
--

INSERT INTO `responsable` (`id`, `nom`, `abbreviation`) VALUES
(1, 'RAMAHERY Yvan Emiliau', 'Emiliau'),
(2, 'RAMAHEFASON Ndremora', 'Mahefa'),
(3, 'RAKOTONOMENJANAHARY Lalaina Christian', 'Christian');

-- --------------------------------------------------------

--
-- Table structure for table `sexe`
--

CREATE TABLE `sexe` (
  `id` int(11) NOT NULL,
  `nom` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sexe`
--

INSERT INTO `sexe` (`id`, `nom`, `abbreviation`) VALUES
(1, 'Masculin', 'M'),
(2, 'Féminin', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `voix`
--

CREATE TABLE `voix` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `voix`
--

INSERT INTO `voix` (`id`, `nom`, `abbreviation`) VALUES
(1, '1ère voix', 'Soprano'),
(2, '2ème voix', 'Alto'),
(3, '3ème voix', 'Tenor'),
(4, '4ème voix', 'Bass');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F6B4FB29448F3B3C` (`sexe_id`),
  ADD KEY `IDX_F6B4FB2953C59D72` (`responsable_id`),
  ADD KEY `IDX_F6B4FB2948DF068D` (`voix_id`);

--
-- Indexes for table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sexe`
--
ALTER TABLE `sexe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voix`
--
ALTER TABLE `voix`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sexe`
--
ALTER TABLE `sexe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `voix`
--
ALTER TABLE `voix`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_F6B4FB29448F3B3C` FOREIGN KEY (`sexe_id`) REFERENCES `sexe` (`id`),
  ADD CONSTRAINT `FK_F6B4FB2948DF068D` FOREIGN KEY (`voix_id`) REFERENCES `voix` (`id`),
  ADD CONSTRAINT `FK_F6B4FB2953C59D72` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
