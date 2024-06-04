-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 28 mai 2024 à 14:52
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `centredesimpots`
--

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `id_demande` int(11) NOT NULL,
  `id_personne` int(11) DEFAULT NULL,
  `nom_document` varchar(255) DEFAULT NULL,
  `demande_text` text DEFAULT NULL,
  `date_heure` datetime NOT NULL DEFAULT current_timestamp(),
  `nom_service` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`id_demande`, `id_personne`, `nom_document`, `demande_text`, `date_heure`, `nom_service`) VALUES
(140, 8, 'Extraits des Rôles', 'weqjkkqw', '2024-05-24 19:05:28', 'Service Recette'),
(141, 8, 'Extraits des Rôles', 'wemhjkdash', '2024-05-24 19:05:34', 'Service Recette'),
(142, 8, 'C20', 'dsjakhasdf', '2024-05-24 21:30:15', 'Service Principal de Gestion'),
(143, 8, 'Extraits des Rôles', 'asdddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddjhgjhkgasdjkgadjkfdfjbzdfgldsa;jlkasdfjklasdfjklasdfjklfasjklsafdjklsdajaskljfsdklajasdkljasdfkjfdsakljdaskldsjklsdjksdhjkfsdh', '2024-05-24 21:37:59', 'Service Recette'),
(149, 8, 'Extraits des Rôles', 'sfdaassda', '2024-05-25 01:41:21', 'Service Recette'),
(150, 8, 'Extraits des Rôles', 'grasfgzsfgz', '2024-05-25 01:41:48', 'Service Recette'),
(151, 8, 'C20', 'skflisdasfmakdf', '2024-05-25 19:51:47', 'Service Principal de Gestion');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` enum('homme','femme','autre') NOT NULL,
  `dateNaissance` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `motDePasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `sexe`, `dateNaissance`, `email`, `motDePasse`) VALUES
(8, 'mohamed', 'djerouiti', 'homme', '2002-01-30', 'hhhhh@gmail.com', '$2y$10$/8cCbDBBy2FfgY5sNHy9q.Wi2Bbh8KwXaGZNnuwnX9CYlFCmNiyAW'),
(9, 'bentahar', 'issam', 'homme', '2003-01-14', 'bentaherissam00@gmail.com', '$2y$10$Aw1qwTrngOnK4lLzdQsoxOiJTE.D5pt03c7kqeZ89WrHqeNaXwQPi'),
(10, 'centre', 'des impots', 'homme', '1988-01-30', 'centre_des_impots@gmail.com', '$2y$10$q1hkGhgk9VKY48woudg5JOQ/sEj57s0AzExBraQDD1AplodoIYdCe'),
(11, 'Service', 'Recette', 'homme', '1988-02-11', 'Service_Recette@gmail.com', '$2y$10$dWEk9JU/oXDGC2T882CSB.d4d5lBDtI0Xkuae2rIWdnmTWUnfWDEu'),
(12, 'Service ', 'principal de gestion', 'homme', '1988-01-14', 'Service_Pricipale_de_Gestion@gmail.com', '$2y$10$zLSxeUtlKyIrsUiR1X8BZu/WImHvRvYwKBgbp6EllThzY8f0xTALO'),
(13, 'Service ', 'de Contrôle et de la Recherche', 'homme', '1980-01-30', 'Servise_de_Controle_et_de_la_Recherche@gmail.com', '$2y$10$XNbZQ2eYxvkbnMBgNYv7RuJi/y.b5pG/eaeSLEJwJf8FCJLDJ3GZm');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

CREATE TABLE `reponses` (
  `id_reponse` int(11) NOT NULL,
  `id_demande` int(11) DEFAULT NULL,
  `reponse` varchar(25) NOT NULL,
  `traiter` enum('oui','non') NOT NULL DEFAULT 'non',
  `date_de_recuperation` datetime DEFAULT NULL,
  `cause_de_refus` text DEFAULT NULL,
  `recuperez` varchar(3) DEFAULT 'non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signale`
--

CREATE TABLE `signale` (
  `id_signale` int(11) NOT NULL,
  `id_demande` int(11) NOT NULL,
  `cause_de_signale` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `signale`
--

INSERT INTO `signale` (`id_signale`, `id_demande`, `cause_de_signale`) VALUES
(3, 140, 'sajasdj'),
(4, 142, 'asdhjk'),
(5, 143, 'jkrewa'),
(10, 151, 'ykiuasyuifawre');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `id_personne` (`id_personne`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD PRIMARY KEY (`id_reponse`),
  ADD UNIQUE KEY `unique_demande` (`id_demande`);

--
-- Index pour la table `signale`
--
ALTER TABLE `signale`
  ADD PRIMARY KEY (`id_signale`),
  ADD KEY `id_demande` (`id_demande`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT pour la table `signale`
--
ALTER TABLE `signale`
  MODIFY `id_signale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`id_personne`) REFERENCES `personne` (`id`);

--
-- Contraintes pour la table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `reponses_ibfk_1` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`);

--
-- Contraintes pour la table `signale`
--
ALTER TABLE `signale`
  ADD CONSTRAINT `signale_ibfk_1` FOREIGN KEY (`id_demande`) REFERENCES `demande` (`id_demande`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
