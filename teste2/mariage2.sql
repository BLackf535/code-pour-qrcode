-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 04 mai 2024 à 10:52
-- Version du serveur : 8.0.36-0ubuntu0.22.04.1
-- Version de PHP : 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mariage2`
--

-- --------------------------------------------------------

--
-- Structure de la table `listpro`
--

CREATE TABLE `listpro` (
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `listpro`
--

INSERT INTO `listpro` (`nom`, `prenom`, `email`) VALUES
('', '', 'eeee@gmail.com'),
('eeeeegg', 'eeeeeegg', 'eeeegg@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `personne2`
--

CREATE TABLE `personne2` (
  `Nom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `prenom` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `statut` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `personne2`
--

INSERT INTO `personne2` (`Nom`, `prenom`, `email`, `statut`) VALUES
('Nom', 'prenom', 'email', 'statut'),
('akoulou', 'ferdinand', 'black@gmail.com', '0'),
('black', 'blacky', '', '1'),
('watio', 'ange', '', '1'),
('ferdinand', 'blacky', 'black2222@gmail.com', '0'),
('lenora', 'elle ', 'leno2003@gmail.com', '0'),
('aristone', 'sidney', 'black222232@gmail.com', '0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `listpro`
--
ALTER TABLE `listpro`
  ADD UNIQUE KEY `email` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
