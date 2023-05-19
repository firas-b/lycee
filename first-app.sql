-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2023 at 10:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `first-app`
--

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id_cours` int NOT NULL,
  `nom_cours` varchar(255) NOT NULL,
  `description` text,
  `date_ajout` date DEFAULT NULL,
  `enseignant` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id_cours`, `nom_cours`, `description`, `date_ajout`, `enseignant`) VALUES
(1, 'science vie et terre', NULL, NULL, 3),
(3, 'physique', 'science physique ', '2023-05-18', 3);

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE `eleve` (
  `utilisateur` int NOT NULL,
  `matricule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`utilisateur`, `matricule`) VALUES
(1, ' eveele'),
(30, '  eveele25'),
(36, 'nadhem12');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `utilisateur` int NOT NULL,
  `matricule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`utilisateur`, `matricule`, `email`) VALUES
(3, '    houieme123', 'zadhgl@gmail.com'),
(35, 'achraf', 'zadhgl@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `examen`
--

CREATE TABLE `examen` (
  `id_examen` int NOT NULL,
  `nom_examen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cours` int NOT NULL,
  `eleve` int DEFAULT '0',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `examen`
--

INSERT INTO `examen` (`id_examen`, `nom_examen`, `cours`, `eleve`, `date`) VALUES
(2, 'synthese', 1, 1, NULL),
(4, 'ds physiqye', 3, 0, '2023-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id_note` int NOT NULL,
  `examen` int NOT NULL,
  `eleve` int NOT NULL,
  `note` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id_note`, `examen`, `eleve`, `note`) VALUES
(6, 2, 1, 10),
(7, 2, 30, 15),
(8, 2, 36, 12),
(9, 4, 1, 2),
(10, 4, 30, 14),
(11, 4, 36, 16),
(12, 4, 1, 2),
(13, 4, 30, 14),
(14, 4, 36, 16);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cin` varchar(255) NOT NULL,
  `num_tel` int NOT NULL,
  `role` varchar(256) NOT NULL,
  `mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `prenom`, `nom`, `cin`, `num_tel`, `role`, `mdp`) VALUES
(1, 'firas', 'boukhchim', '', 50345160, 'eleve', '123'),
(2, 'karim', 'abdellaoui', '', 20549125, '', NULL),
(3, 'ahmed', 'boukchim', '14403505', 98610998, 'enseignant', 'ahmed'),
(20, 'boukhchim', 'firas', '48658221', 24153471, '', '8TxtX48?r'),
(23, 'fidc', 'fifras', '42453', 50345160, '', 'uJB6N!baC'),
(30, 'firas', 'ben', '15155454', 5518424, 'eleve', 'MDqqhY?v4'),
(31, 'admin', 'admin', '00000000', 50345160, 'admin', 'admin'),
(35, 'achref', 'chamkhi', '15155454', 25452515, 'enseignant', 'k&Wk?Rz5N'),
(36, 'nadhem', 'nadhem', '15155454', 5518424, 'eleve', 'V@phf6CvZ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id_cours`),
  ADD KEY `fk_cours_enseignant` (`enseignant`);

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`utilisateur`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`utilisateur`);

--
-- Indexes for table `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id_examen`),
  ADD KEY `fk_examen_cours` (`cours`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id_note`) USING BTREE,
  ADD KEY `fk_note_examen` (`examen`),
  ADD KEY `fk_note_eleve` (`eleve`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `mdp` (`mdp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id_cours` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `examen`
--
ALTER TABLE `examen`
  MODIFY `id_examen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id_note` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_cours_enseignant` FOREIGN KEY (`enseignant`) REFERENCES `enseignant` (`utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `enseignant_ibfk_1` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `fk_examen_cours` FOREIGN KEY (`cours`) REFERENCES `cours` (`id_cours`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `fk_note_eleve` FOREIGN KEY (`eleve`) REFERENCES `eleve` (`utilisateur`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_note_examen` FOREIGN KEY (`examen`) REFERENCES `examen` (`id_examen`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
