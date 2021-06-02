-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 01 juin 2021 à 16:16
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `infinite_measures`
--
CREATE DATABASE IF NOT EXISTS `infinite_measures`;
USE `infinite_measures`;
-- --------------------------------------------------------

--
-- Structure de la table `audition`
--

CREATE TABLE `audition` (
  `auditionId` int(11) NOT NULL,
  `auditionScore` int(11) NOT NULL,
  `testId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `bonus`
--

CREATE TABLE `bonus` (
  `bonusId` int(11) NOT NULL,
  `bonusIp` varchar(30) NOT NULL,
  `bonusDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `faqId` int(11) NOT NULL,
  `faqQuestion` text NOT NULL,
  `faqAnswer` text NOT NULL,
  `faqLanguage` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`faqId`, `faqQuestion`, `faqAnswer`, `faqLanguage`) VALUES
(1, 'Qui sommes-nous ?', 'Fondée en 2020, Infinite Measures est une entreprise ayant pour but de concevoir un système de mesure s\'adressant à des auto-écoles pour vérifier si une personne est apte à conduire.&nbsp;', 'fr'),
(2, 'Who are we ?', 'Founded in 2020, Infinite Measures is a company that aims to develop a measurement system for driving schools to check whether a person is fit to drive.&nbsp;', 'en');

-- --------------------------------------------------------

--
-- Structure de la table `memory`
--

CREATE TABLE `memory` (
  `memoryId` int(11) NOT NULL,
  `memoryRythm` int(11) NOT NULL,
  `testId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reflex`
--

CREATE TABLE `reflex` (
  `reflexId` int(11) NOT NULL,
  `reflexVisual` int(11) NOT NULL,
  `reflexSound` int(11) NOT NULL,
  `testId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stress`
--

CREATE TABLE `stress` (
  `stressId` int(11) NOT NULL,
  `stressBPM` int(11) NOT NULL,
  `stressTemp` decimal(9,2) NOT NULL,
  `testId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `testId` int(11) NOT NULL,
  `testDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `usersId` int(11) NOT NULL,
  `testType` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `usersId` int(11) NOT NULL,
  `usersUsername` varchar(20) NOT NULL,
  `usersEmail` varchar(128) NOT NULL,
  `usersPassword` varchar(128) NOT NULL,
  `usersGender` varchar(30) NOT NULL,
  `usersBirth` date NOT NULL,
  `usersAccess` int(11) NOT NULL,
  `usersLanguage` int(11) NOT NULL DEFAULT 0,
  `usersManager` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`usersId`, `usersUsername`, `usersEmail`, `usersPassword`, `usersGender`, `usersBirth`, `usersAccess`, `usersLanguage`, `usersManager`) VALUES
(1, 'IM_Admin', 'infinitemeasures@gmail.com', '$2y$10$4MdOR8UdZ1IJo/j6U/qDgeYcjFMiKK2jxYvkuo8F65i1by5rIu6fm', 'Male', '1979-03-22', 0, 0, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `audition`
--
ALTER TABLE `audition`
  ADD PRIMARY KEY (`auditionId`),
  ADD KEY `audition_ibfk_1` (`testId`);

--
-- Index pour la table `bonus`
--
ALTER TABLE `bonus`
  ADD PRIMARY KEY (`bonusId`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faqId`);

--
-- Index pour la table `memory`
--
ALTER TABLE `memory`
  ADD PRIMARY KEY (`memoryId`),
  ADD KEY `memory_ibfk_1` (`testId`);

--
-- Index pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Index pour la table `reflex`
--
ALTER TABLE `reflex`
  ADD PRIMARY KEY (`reflexId`),
  ADD KEY `reflex_ibfk_1` (`testId`);

--
-- Index pour la table `stress`
--
ALTER TABLE `stress`
  ADD PRIMARY KEY (`stressId`),
  ADD KEY `stress_ibfk_1` (`testId`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`testId`),
  ADD KEY `usersId` (`usersId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `audition`
--
ALTER TABLE `audition`
  MODIFY `auditionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bonus`
--
ALTER TABLE `bonus`
  MODIFY `bonusId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `faqId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `memory`
--
ALTER TABLE `memory`
  MODIFY `memoryId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reflex`
--
ALTER TABLE `reflex`
  MODIFY `reflexId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stress`
--
ALTER TABLE `stress`
  MODIFY `stressId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `test`
--
ALTER TABLE `test`
  MODIFY `testId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `usersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `audition`
--
ALTER TABLE `audition`
  ADD CONSTRAINT `audition_ibfk_1` FOREIGN KEY (`testId`) REFERENCES `test` (`testId`) ON DELETE CASCADE;

--
-- Contraintes pour la table `memory`
--
ALTER TABLE `memory`
  ADD CONSTRAINT `memory_ibfk_1` FOREIGN KEY (`testId`) REFERENCES `test` (`testId`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reflex`
--
ALTER TABLE `reflex`
  ADD CONSTRAINT `reflex_ibfk_1` FOREIGN KEY (`testId`) REFERENCES `test` (`testId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
