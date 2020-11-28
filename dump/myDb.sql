-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 28 nov. 2020 à 17:04
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
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `name` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `name`) VALUES
(1, 'Weather'),
(2, 'Youtube'),
(3, 'Steam'),
(4, 'Cinema'),
(5, 'Get a Joke');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `token` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `confirmation` int NOT NULL DEFAULT '0',
  `oauth_uid` varchar(255) DEFAULT NULL,
  `username` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_data`
--

CREATE TABLE `user_data` (
  `user` int NOT NULL,
  `services` text,
  `widgets` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_instance_data`
--

CREATE TABLE `user_instance_data` (
  `id` int NOT NULL,
  `user` int NOT NULL,
  `service` int NOT NULL,
  `widget` tinytext NOT NULL,
  `refresh_rate` int NOT NULL,
  `arg` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `widget`
--

CREATE TABLE `widget` (
  `id` int NOT NULL,
  `service` int NOT NULL,
  `name` tinytext NOT NULL,
  `description` mediumtext NOT NULL,
  `arg_count` int DEFAULT NULL,
  `args` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `widget`
--

INSERT INTO `widget` (`id`, `service`, `name`, `description`, `arg_count`, `args`) VALUES
(1, 1, 'City weather', 'Display temperature for a city with small description.', 1, 'Paris'),
(1, 2, 'Load Video', 'Load a Youtube video by Id.', 1, 'https://www.youtube.com/watch?v=RI86k9rsGZ0'),
(2, 2, 'Get Video Views', 'Get a Youtube video\'s views by Id.', 1, 'https://www.youtube.com/watch?v=RI86k9rsGZ0'),
(1, 3, 'Player Infos', 'Get a Steam player informations by Id.', 1, 'lightningvalipss'),
(1, 4, 'Get Movie Infos', 'Get movie\'s informations by name.', 1, 'Forest Gump'),
(1, 5, 'Get a Joke', 'Get a Chuck Norris\' joke by word.', 1, 'prout');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`user`);

--
-- Index pour la table `user_instance_data`
--
ALTER TABLE `user_instance_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user_instance_data`
--
ALTER TABLE `user_instance_data`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
