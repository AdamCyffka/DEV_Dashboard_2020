-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : jeu. 19 nov. 2020 à 15:30
-- Version du serveur :  8.0.22
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `myDb`
--

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `date`) VALUES
(3, 'Cyffka', 'adam.cyffka@epitech.eu,', '0a5b3913cbc9a9092311630e869b4442', '2020-11-19 14:38:39'),
(4, 'dadad', 'test@test.com,', '0a5b3913cbc9a9092311630e869b4442', '2020-11-19 15:02:44'),
(5, 'Cyffka', 'adam.cyffka@epitech.eu,', '0a5b3913cbc9a9092311630e869b4442', '2020-11-19 15:21:15'),
(6, 'dadada', 'adda@gmail.com,', '44d9dbb60b6c2c24922cd62d249412f9', '2020-11-19 15:25:04');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
