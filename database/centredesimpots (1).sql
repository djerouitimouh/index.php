-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 04 juin 2024 à 01:48
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
(152, 18, 'Extraits des Rôles', 'Je soussigné, djerouiti mohamed, titulaire de la carte d\'identité nationale numéro 92389371287398, me permets de solliciter respectueusement  pour extraits des Roles\nJe vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais', '2024-05-30 23:11:21', 'Service Recette'),
(153, 18, 'Etat d\'Environnement', 'Je soussigné, djerouiti mohamed, titulaire de la carte d\'identité nationale numéro 92389371287398, me permets de solliciter respectueusement  pour Etat d\'Environnement\r\nJe vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais', '2024-05-30 23:12:59', 'Service Principal de Gestion'),
(156, 19, 'PV Constat', 'Je soussigné, bentaher issam, titulaire de la carte d\'identité nationale numéro 92389371287398, me permets de solliciter respectueusement  pour PV Constat\r\nJe vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais', '2024-05-31 00:32:41', 'Service de Contrôle et de la Recherche'),
(157, 20, 'C20', 'Je soussignée, arab lyna , titulaire de la carte d\'identité nationale numéro 92389378282, me permets de solliciter respectueusement  pour C20\r\nJe vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais', '2024-05-31 00:50:31', 'Service Principal de Gestion'),
(159, 21, 'Extraits des Rôles', 'Je soussignée, boutmeur liticia, titulaire de la carte d\'identité nationale numéro 128689136078, me permets de solliciter respectueusement  pour PV Constat\r\nJe vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais', '2024-05-31 01:06:14', 'Service Recette'),
(162, 22, 'PV d\'Entrée ou d\'Exploitation', 'Je soussigné, boukhrissa yazid, titulaire de la carte d\'identité nationale numéro 876237823923, me permets de solliciter respectueusement  PV d\'Entree ou d\'Exploitation\r\nJe vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais', '2024-05-31 01:10:00', 'Service Principal de Gestion'),
(170, 21, 'Calendrier de Paiement', 'Je soussignée, liticia boutmeur, titulaire de la carte d\'identité nationale numéro 92531899067137, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(174, 42, 'Calendrier de Paiement', 'Je soussignée, Lyes KHERFI, titulaire de la carte d\'identité nationale numéro 95378128183426, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(178, 46, 'Calendrier de Paiement', 'Je soussignée, Hayet OMANI, titulaire de la carte d\'identité nationale numéro 99614222691966, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(179, 47, 'Calendrier de Paiement', 'Je soussignée, Dalal ZADI, titulaire de la carte d\'identité nationale numéro 99858829155432, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(181, 49, 'Calendrier de Paiement', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 92680902884044, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(184, 52, 'Calendrier de Paiement', 'Je soussignée, Ikram ADDAR, titulaire de la carte d\'identité nationale numéro 94888234021969, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(185, 53, 'Calendrier de Paiement', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 97818084925243, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(186, 54, 'Calendrier de Paiement', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 94425722867646, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(188, 56, 'Calendrier de Paiement', 'Je soussignée, Faiza BOUAFIA, titulaire de la carte d\'identité nationale numéro 994631053595, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(189, 57, 'Calendrier de Paiement', 'Je soussignée, Sabrine KEBIR, titulaire de la carte d\'identité nationale numéro 94450075965793, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(190, 58, 'Calendrier de Paiement', 'Je soussignée, Chahinaz MEDERBEL, titulaire de la carte d\'identité nationale numéro 91966486975519, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(192, 60, 'Calendrier de Paiement', 'Je soussignée, Ines MILOUDI, titulaire de la carte d\'identité nationale numéro 96511575818538, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(196, 64, 'Calendrier de Paiement', 'Je soussignée, Kenza MAHFOUD, titulaire de la carte d\'identité nationale numéro 95805470632208, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(198, 66, 'Calendrier de Paiement', 'Je soussignée, Islam MERZOUK, titulaire de la carte d\'identité nationale numéro 96109899930758, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(199, 67, 'Calendrier de Paiement', 'Je soussignée, Tarek SAAD, titulaire de la carte d\'identité nationale numéro 9433713049100, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(200, 68, 'Calendrier de Paiement', 'Je soussignée, Lounes MANSOURI, titulaire de la carte d\'identité nationale numéro 93838865760563, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(203, 71, 'Calendrier de Paiement', 'Je soussignée, Abdelhak DRAIFI, titulaire de la carte d\'identité nationale numéro 96067194618347, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(209, 77, 'Calendrier de Paiement', 'Je soussignée, Hayet OMANI, titulaire de la carte d\'identité nationale numéro 94282554410661, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(223, 91, 'Calendrier de Paiement', 'Je soussignée, Khaled MECHEKAK, titulaire de la carte d\'identité nationale numéro 93562551609764, me permets de solliciter respectueusement pour Calendrier de Paiement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Recette'),
(230, 18, 'C20', 'Je soussignée, djerouiti mouhamed, titulaire de la carte d\'identité nationale numéro 96328753602065, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(231, 19, 'C20', 'Je soussignée, issam bentaher, titulaire de la carte d\'identité nationale numéro 97342070021985, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(232, 20, 'C20', 'Je soussignée, lyna arab, titulaire de la carte d\'identité nationale numéro 97724089611064, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(233, 21, 'C20', 'Je soussignée, liticia boutmeur, titulaire de la carte d\'identité nationale numéro 96594238296704, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(238, 43, 'C20', 'Je soussignée, Hanane OUSLIMANE, titulaire de la carte d\'identité nationale numéro 98401612926648, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(242, 47, 'C20', 'Je soussignée, Dalal ZADI, titulaire de la carte d\'identité nationale numéro 98040554484390, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(244, 49, 'C20', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 95776032047137, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(245, 50, 'C20', 'Je soussignée, Aimim BENARBIA, titulaire de la carte d\'identité nationale numéro 98941543427241, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(246, 51, 'C20', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 97379621302131, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(247, 52, 'C20', 'Je soussignée, Ikram ADDAR, titulaire de la carte d\'identité nationale numéro 973476536267, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(249, 54, 'C20', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 9922166109943, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(250, 55, 'C20', 'Je soussignée, Abdelghani MAHFOUD, titulaire de la carte d\'identité nationale numéro 99925273610209, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(255, 60, 'C20', 'Je soussignée, Ines MILOUDI, titulaire de la carte d\'identité nationale numéro 96983900570295, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(257, 62, 'C20', 'Je soussignée, Aboubeker GUEALIA, titulaire de la carte d\'identité nationale numéro 94351768730535, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(259, 64, 'C20', 'Je soussignée, Kenza MAHFOUD, titulaire de la carte d\'identité nationale numéro 99828503513548, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(261, 66, 'C20', 'Je soussignée, Islam MERZOUK, titulaire de la carte d\'identité nationale numéro 97575650948635, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(264, 69, 'C20', 'Je soussignée, Nour Elyakine HAMLAOUI, titulaire de la carte d\'identité nationale numéro 98479521124138, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(266, 71, 'C20', 'Je soussignée, Abdelhak DRAIFI, titulaire de la carte d\'identité nationale numéro 94336879052535, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(267, 72, 'C20', 'Je soussignée, Yanis MAZOUZ, titulaire de la carte d\'identité nationale numéro 93819130299444, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(271, 76, 'C20', 'Je soussignée, Lilia DAHMANI, titulaire de la carte d\'identité nationale numéro 96013800302533, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(272, 77, 'C20', 'Je soussignée, Hayet OMANI, titulaire de la carte d\'identité nationale numéro 9318893064110, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(277, 82, 'C20', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 92318985129072, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(278, 83, 'C20', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 92112281547963, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(281, 86, 'C20', 'Je soussignée, Samy DJAROUM, titulaire de la carte d\'identité nationale numéro 97613737143216, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(286, 91, 'C20', 'Je soussignée, Khaled MECHEKAK, titulaire de la carte d\'identité nationale numéro 92168467791907, me permets de solliciter respectueusement pour C20. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(293, 18, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, djerouiti mouhamed, titulaire de la carte d\'identité nationale numéro 98352245593771, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(294, 19, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, issam bentaher, titulaire de la carte d\'identité nationale numéro 92427909320618, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(300, 42, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Lyes KHERFI, titulaire de la carte d\'identité nationale numéro 96701254347992, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(307, 49, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 91396577722762, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(312, 54, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 91038661674632, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(314, 56, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Faiza BOUAFIA, titulaire de la carte d\'identité nationale numéro 97919180335401, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(316, 58, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Chahinaz MEDERBEL, titulaire de la carte d\'identité nationale numéro 91116474066969, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(329, 71, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Abdelhak DRAIFI, titulaire de la carte d\'identité nationale numéro 97338960922638, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(330, 72, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Yanis MAZOUZ, titulaire de la carte d\'identité nationale numéro 95451875436540, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(331, 73, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Lyes KHERFI, titulaire de la carte d\'identité nationale numéro 95242494722122, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(334, 76, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Lilia DAHMANI, titulaire de la carte d\'identité nationale numéro 98213228395407, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(337, 79, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Zahra MECHEKAK, titulaire de la carte d\'identité nationale numéro 95510930116764, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(338, 80, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 95535509479730, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(341, 83, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 92152021473415, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(346, 88, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Nacer Eddine BEHAR, titulaire de la carte d\'identité nationale numéro 9681597293058, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(347, 89, 'Franchise TVA: (F20,F21,F22)', 'Je soussignée, Fatma BELLOUNI, titulaire de la carte d\'identité nationale numéro 98133668357630, me permets de solliciter respectueusement pour Franchise TVA: (F20,F21,F22). Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(358, 20, 'Attestation du NIF', 'Je soussignée, lyna arab, titulaire de la carte d\'identité nationale numéro 96744375132717, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(359, 21, 'Attestation du NIF', 'Je soussignée, liticia boutmeur, titulaire de la carte d\'identité nationale numéro 94995635352093, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(362, 41, 'Attestation du NIF', 'Je soussignée, Yanis MAZOUZ, titulaire de la carte d\'identité nationale numéro 99456608294934, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(368, 47, 'Attestation du NIF', 'Je soussignée, Dalal ZADI, titulaire de la carte d\'identité nationale numéro 96393597597622, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(369, 48, 'Attestation du NIF', 'Je soussignée, Zahra MECHEKAK, titulaire de la carte d\'identité nationale numéro 96951618592209, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(370, 49, 'Attestation du NIF', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 95577300475516, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(373, 52, 'Attestation du NIF', 'Je soussignée, Ikram ADDAR, titulaire de la carte d\'identité nationale numéro 91036726693656, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(376, 55, 'Attestation du NIF', 'Je soussignée, Abdelghani MAHFOUD, titulaire de la carte d\'identité nationale numéro 92351038635103, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(378, 57, 'Attestation du NIF', 'Je soussignée, Sabrine KEBIR, titulaire de la carte d\'identité nationale numéro 95528035252846, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(384, 63, 'Attestation du NIF', 'Je soussignée, Feriel GUECHAIRI, titulaire de la carte d\'identité nationale numéro 98116375755627, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(386, 65, 'Attestation du NIF', 'Je soussignée, Hocine AIT RAHMANE, titulaire de la carte d\'identité nationale numéro 99643422644253, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(390, 69, 'Attestation du NIF', 'Je soussignée, Nour Elyakine HAMLAOUI, titulaire de la carte d\'identité nationale numéro 96584571885489, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(394, 73, 'Attestation du NIF', 'Je soussignée, Lyes KHERFI, titulaire de la carte d\'identité nationale numéro 97391002753182, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(397, 76, 'Attestation du NIF', 'Je soussignée, Lilia DAHMANI, titulaire de la carte d\'identité nationale numéro 95666931584167, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(400, 79, 'Attestation du NIF', 'Je soussignée, Zahra MECHEKAK, titulaire de la carte d\'identité nationale numéro 93797468378951, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(403, 82, 'Attestation du NIF', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 9790333525082, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(404, 83, 'Attestation du NIF', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 95115911490391, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(407, 86, 'Attestation du NIF', 'Je soussignée, Samy DJAROUM, titulaire de la carte d\'identité nationale numéro 93849587537208, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(409, 88, 'Attestation du NIF', 'Je soussignée, Nacer Eddine BEHAR, titulaire de la carte d\'identité nationale numéro 94265151316546, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(412, 91, 'Attestation du NIF', 'Je soussignée, Khaled MECHEKAK, titulaire de la carte d\'identité nationale numéro 92445723882360, me permets de solliciter respectueusement pour Attestation du NIF. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(422, 21, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, liticia boutmeur, titulaire de la carte d\'identité nationale numéro 95300569678936, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(423, 22, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, yazid boukhrissa, titulaire de la carte d\'identité nationale numéro 96351551605715, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(425, 41, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Yanis MAZOUZ, titulaire de la carte d\'identité nationale numéro 9225591985718, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(426, 42, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Lyes KHERFI, titulaire de la carte d\'identité nationale numéro 93559812338612, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(430, 46, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Hayet OMANI, titulaire de la carte d\'identité nationale numéro 91669568365132, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(431, 47, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Dalal ZADI, titulaire de la carte d\'identité nationale numéro 98468512984429, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(435, 51, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 97794864371227, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(437, 53, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 96728567599066, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(440, 56, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Faiza BOUAFIA, titulaire de la carte d\'identité nationale numéro 91720213165246, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(455, 71, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Abdelhak DRAIFI, titulaire de la carte d\'identité nationale numéro 93149386898753, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(466, 82, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 97048219961159, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(468, 84, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 93938734125288, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(470, 86, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Samy DJAROUM, titulaire de la carte d\'identité nationale numéro 91401971496084, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(471, 87, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Amina ACHOURI, titulaire de la carte d\'identité nationale numéro 95078953648990, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(474, 90, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Mazigh GUIRAT, titulaire de la carte d\'identité nationale numéro 99970486517968, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(475, 91, 'PV d\'Entrée ou d\'Exploitation', 'Je soussignée, Khaled MECHEKAK, titulaire de la carte d\'identité nationale numéro 97730203855531, me permets de solliciter respectueusement pour PV d\'Entrée ou d\'Exploitation. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(484, 20, 'Etat d\'Environnement', 'Je soussignée, lyna arab, titulaire de la carte d\'identité nationale numéro 99212462649878, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(486, 22, 'Etat d\'Environnement', 'Je soussignée, yazid boukhrissa, titulaire de la carte d\'identité nationale numéro 92688867889986, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(489, 42, 'Etat d\'Environnement', 'Je soussignée, Lyes KHERFI, titulaire de la carte d\'identité nationale numéro 95135885127946, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(494, 47, 'Etat d\'Environnement', 'Je soussignée, Dalal ZADI, titulaire de la carte d\'identité nationale numéro 96802518131958, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(496, 49, 'Etat d\'Environnement', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 94805308584873, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(498, 51, 'Etat d\'Environnement', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 978202691002, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(501, 54, 'Etat d\'Environnement', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 94106772825221, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(503, 56, 'Etat d\'Environnement', 'Je soussignée, Faiza BOUAFIA, titulaire de la carte d\'identité nationale numéro 96777854530865, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(508, 61, 'Etat d\'Environnement', 'Je soussignée, Youghourta SERIDJ, titulaire de la carte d\'identité nationale numéro 98332557443839, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(509, 62, 'Etat d\'Environnement', 'Je soussignée, Aboubeker GUEALIA, titulaire de la carte d\'identité nationale numéro 91022696309744, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(510, 63, 'Etat d\'Environnement', 'Je soussignée, Feriel GUECHAIRI, titulaire de la carte d\'identité nationale numéro 9115809524539, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(514, 67, 'Etat d\'Environnement', 'Je soussignée, Tarek SAAD, titulaire de la carte d\'identité nationale numéro 95897685062044, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(521, 74, 'Etat d\'Environnement', 'Je soussignée, Hanane OUSLIMANE, titulaire de la carte d\'identité nationale numéro 99671841468356, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(526, 79, 'Etat d\'Environnement', 'Je soussignée, Zahra MECHEKAK, titulaire de la carte d\'identité nationale numéro 98864995966539, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(530, 83, 'Etat d\'Environnement', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 96848899896115, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(531, 84, 'Etat d\'Environnement', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 95611952166642, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(534, 87, 'Etat d\'Environnement', 'Je soussignée, Amina ACHOURI, titulaire de la carte d\'identité nationale numéro 91108071292851, me permets de solliciter respectueusement pour Etat d\'Environnement. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service Principal de Gestion'),
(545, 18, 'PV Constat', 'Je soussignée, djerouiti mouhamed, titulaire de la carte d\'identité nationale numéro 91515832842808, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(549, 22, 'PV Constat', 'Je soussignée, yazid boukhrissa, titulaire de la carte d\'identité nationale numéro 91227330249945, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(559, 49, 'PV Constat', 'Je soussignée, Asma ALIOUAT, titulaire de la carte d\'identité nationale numéro 97871650231882, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(561, 51, 'PV Constat', 'Je soussignée, Lyes RAHAL, titulaire de la carte d\'identité nationale numéro 95902426937504, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(562, 52, 'PV Constat', 'Je soussignée, Ikram ADDAR, titulaire de la carte d\'identité nationale numéro 99801708599367, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(564, 54, 'PV Constat', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 97101186967549, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(565, 55, 'PV Constat', 'Je soussignée, Abdelghani MAHFOUD, titulaire de la carte d\'identité nationale numéro 91602147670092, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(571, 61, 'PV Constat', 'Je soussignée, Youghourta SERIDJ, titulaire de la carte d\'identité nationale numéro 98797821364177, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(577, 67, 'PV Constat', 'Je soussignée, Tarek SAAD, titulaire de la carte d\'identité nationale numéro 93010451572956, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(581, 71, 'PV Constat', 'Je soussignée, Abdelhak DRAIFI, titulaire de la carte d\'identité nationale numéro 92606373683182, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(585, 75, 'PV Constat', 'Je soussignée, Nassim KADA, titulaire de la carte d\'identité nationale numéro 9139676137026, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(589, 79, 'PV Constat', 'Je soussignée, Zahra MECHEKAK, titulaire de la carte d\'identité nationale numéro 96792726876952, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(593, 83, 'PV Constat', 'Je soussignée, Abdelmounaim GACEM, titulaire de la carte d\'identité nationale numéro 98591631910383, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(594, 84, 'PV Constat', 'Je soussignée, Dalila ZEGHMICHE, titulaire de la carte d\'identité nationale numéro 96144912062347, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(598, 88, 'PV Constat', 'Je soussignée, Nacer Eddine BEHAR, titulaire de la carte d\'identité nationale numéro 94653976843370, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(599, 89, 'PV Constat', 'Je soussignée, Fatma BELLOUNI, titulaire de la carte d\'identité nationale numéro 93113039194711, me permets de solliciter respectueusement pour PV Constat. Je vous serais reconnaissant(e) de bien vouloir donner suite à ma demande dans les meilleurs délais.', '2024-05-31 02:00:57', 'Service de Contrôle et de la Recherche'),
(602, 18, 'Extraits des Rôles', 'khjhajkhjkahsfyhjkaghsjkafsd', '2024-06-03 17:19:17', 'Service Recette'),
(603, 18, 'Extraits des Rôles', 'saAaKOLA', '2024-06-04 00:08:37', 'Service Recette'),
(604, 18, 'Extraits des Rôles', 'jashka\r\n', '2024-06-04 00:32:53', 'Service Recette');

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id_notification`, `id_user`, `message`, `is_read`, `created_at`) VALUES
(6, 60, 'Votre demande de Calendrier de Paiement est acceptée.', 0, '2024-06-03 22:30:27'),
(8, 46, 'Votre demande de Calendrier de Paiement a été traitée.Date de récupération : 2024-06-12 08:00', 0, '2024-06-03 22:35:12'),
(10, 64, 'Votre demande de Calendrier de Paiement a été signalée pour la cause suivante : nom fauss', 0, '2024-06-03 22:40:26'),
(12, 18, 'Votre demande de Extraits des Rôles est acceptée.', 0, '2024-06-03 23:33:02');

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
  `motDePasse` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`id`, `nom`, `prenom`, `sexe`, `dateNaissance`, `email`, `motDePasse`, `username`) VALUES
(10, 'centre', 'des impots', 'homme', '1988-01-30', 'centre_des_impots@gmail.com', '$2y$10$q1hkGhgk9VKY48woudg5JOQ/sEj57s0AzExBraQDD1AplodoIYdCe', NULL),
(11, 'Service', 'Recette', 'homme', '1988-02-11', 'Service_Recette@gmail.com', '$2y$10$dWEk9JU/oXDGC2T882CSB.d4d5lBDtI0Xkuae2rIWdnmTWUnfWDEu', NULL),
(12, 'Service ', 'principal de gestion', 'homme', '1988-01-14', 'Service_Pricipale_de_Gestion@gmail.com', '$2y$10$zLSxeUtlKyIrsUiR1X8BZu/WImHvRvYwKBgbp6EllThzY8f0xTALO', NULL),
(13, 'Service ', 'de Contrôle et de la Recherche', 'homme', '1980-01-30', 'Servise_de_Controle_et_de_la_Recherche@gmail.com', '$2y$10$XNbZQ2eYxvkbnMBgNYv7RuJi/y.b5pG/eaeSLEJwJf8FCJLDJ3GZm', NULL),
(18, 'mouhamed', 'djerouiti', 'homme', '2002-01-30', 'm.djerouiti@gmail.com', '$2y$10$RgC5ZBiV1XZM1ebk/bYoNefFikZsFZ1xdM9ryv.YfXMY12vWpxMFy', 'mouhdjerouiti'),
(19, 'bentaher', 'issam', 'homme', '2003-01-14', 'bentaher@gmail.com', '$2y$10$IMnrBEhuI1tPdYQFb3vzGOYm.OAhbLVbVM1wXyWa47Y2krS2syIgO', 'issbentaher'),
(20, 'arab', 'lyna', 'femme', '2003-06-10', 'arab@gmail.com', '$2y$10$xEXmqn3p12DZMMRgYa1T4..pfKyqVl.RA71fSXqJ5yRsT76xp.KnS', 'arablyna'),
(21, 'boutmeur', 'liticia', 'femme', '2003-12-02', 'boutmeur@gmail.com', '$2y$10$tmA4woxdkfOTj7HJbh7vL.Cyr0NN5c8atQ2qTifMmEel2fPeBE.5G', 'litiboutmeur'),
(22, 'boukhrissa', 'yazid', 'homme', '2002-03-23', 'boukhrissa@gmail.com', '$2y$10$YGC1et.9rybXnnBKGinTc.rsDyqkOqk.eU.sC2KAJ1zmQ7hn6KBHC', 'yazidboukhrissa'),
(40, 'DRAIFI', 'Abdelhak', 'homme', '1999-08-20', 'draifi@gmail.com', 'draifi', 'abdelhakdraifi'),
(41, 'MAZOUZ', 'Yanis', 'homme', '2001-09-21', 'mazouz@gmail.com', 'mazouz', 'yanismazouz'),
(42, 'KHERFI', 'Lyes', 'homme', '1998-10-22', 'kherfi@gmail.com', 'kherfi', 'lyeskherfi'),
(43, 'OUSLIMANE', 'Hanane', 'femme', '2002-11-23', 'ouslimane@gmail.com', 'ouslimane', 'hananeouslimane'),
(44, 'KADA', 'Nassim', 'homme', '2003-12-24', 'kada@gmail.com', 'kada', 'nassimkada'),
(46, 'OMANI', 'Hayet', 'femme', '1999-02-26', 'omani@gmail.com', 'omani', 'hayetomani'),
(47, 'ZADI', 'Dalal', 'femme', '2001-03-27', 'zadi@gmail.com', 'zadi', 'dalalzadi'),
(48, 'MECHEKAK', 'Zahra', 'femme', '2002-04-28', 'mechekak@gmail.com', 'mechekak', 'zahramechekak'),
(49, 'ALIOUAT', 'Asma', 'femme', '1998-05-29', 'aliouat@gmail.com', 'aliouat', 'asmaaliouat'),
(50, 'BENARBIA', 'Aimim', 'femme', '2003-06-30', 'benarbia@gmail.com', 'benarbia', 'aimimbenarbia'),
(51, 'RAHAL', 'Lyes', 'homme', '2000-07-31', 'rahal@gmail.com', 'rahal', 'lyesrahal'),
(52, 'ADDAR', 'Ikram', 'femme', '1999-08-01', 'addar@gmail.com', 'addar', 'ikramaddar'),
(53, 'GACEM', 'Abdelmounaim', 'homme', '2001-09-02', 'gacem@gmail.com', 'gacem', 'abdelmounaimgacem'),
(54, 'ZEGHMICHE', 'Dalila', 'femme', '2002-10-03', 'zeghmiche@gmail.com', 'zeghmiche', 'dalilazeghmiche'),
(55, 'MAHFOUD', 'Abdelghani', 'homme', '2000-01-01', 'mahfoud@gmail.com', '4eed24158621f6efdb4dfb784dce5b51825928fb', 'abdelghanimahfoud'),
(56, 'BOUAFIA', 'Faiza', 'femme', '1999-02-02', 'bouafia@gmail.com', '131cecb3a2086afdb565a177c553e442b40ba7aa', 'faizabouafia'),
(57, 'KEBIR', 'Sabrine', 'femme', '2001-03-03', 'kebir@gmail.com', '09a77d2f5adddf57a626726aebd83c88cef72586', 'sabrinekebir'),
(58, 'MEDERBEL', 'Chahinaz', 'femme', '1998-04-04', 'mederbel@gmail.com', '7806d656ac985c6dbfb1a41b9faf0e2bd20e184a', 'chahinazmederbel'),
(59, 'SAHRAOUI', 'Sorya', 'femme', '2002-05-05', 'sahraoui@gmail.com', '09114884aa0b5e25c3ec647cdfe4fc0b86843471', 'soryasahraoui'),
(60, 'MILOUDI', 'Ines', 'femme', '2003-06-06', 'miloudi@gmail.com', 'c2cb57fa0c5f05aab8d849608314e28ca5d58d06', 'inesmiloudi'),
(61, 'SERIDJ', 'Youghourta', 'homme', '1999-08-08', 'seridj@gmail.com', 'ba443afa6565e26a6f41bc98e615377e51414c5b', 'youghourtaseridj'),
(62, 'GUEALIA', 'Aboubeker', 'homme', '1998-10-10', 'guealia@gmail.com', 'bcf27aff814d1ca0e3fcf66b27275e8e1a07e0cd', 'aboubekerguealia'),
(63, 'GUECHAIRI', 'Feriel', 'femme', '2002-11-11', 'guechairi@gmail.com', '1111f0684f56d3beea888ac0ef72413d0aaa4620', 'ferielguechairi'),
(64, 'MAHFOUD', 'Kenza', 'femme', '2003-12-12', 'mahfoud@gmail.com', '4eed24158621f6efdb4dfb784dce5b51825928fb', 'kenzamahfoud'),
(65, 'AIT RAHMANE', 'Hocine', 'homme', '2000-01-13', 'aitrahmane@gmail.com', 'd122b8d0d8d4cc159e0e821202b4e2a0704d2eb1', 'hocineaitrahmane'),
(66, 'MERZOUK', 'Islam', 'homme', '1999-02-14', 'merzouk@gmail.com', '6381032ff77486c08208bd34756d3523eeffaecd', 'islammerzouk'),
(67, 'SAAD', 'Tarek', 'homme', '2001-03-15', 'saad@gmail.com', 'fbd6b3466f628924f9e89af9ea28ac8dbce8890b', 'tareksaad'),
(68, 'MANSOURI', 'Lounes', 'homme', '1998-04-16', 'mansouri@gmail.com', 'c76c139d1da8817f04f1e2ba5fa2dd8d940d8d79', 'lounesmansouri'),
(69, 'HAMLAOUI', 'Nour Elyakine', 'homme', '2002-05-17', 'hamlaoui@gmail.com', 'bcc232b4273cc1eb895666ce944c5a70fb3d206c', 'nourelyakinehamlaoui'),
(70, 'OUALI', 'Roza', 'femme', '2000-07-19', 'ouali@gmail.com', '41d26ac73d4add15483f384a5eb9b84c2ebd4a99', 'rozaouali'),
(71, 'DRAIFI', 'Abdelhak', 'homme', '1999-08-20', 'draifi@gmail.com', '333e5d0e9bf8422e8caa4a7d8f9ba74b3c3c904b', 'abdelhakdraifi'),
(72, 'MAZOUZ', 'Yanis', 'homme', '2001-09-21', 'mazouz@gmail.com', '634b399d0720b96f8367cf08921fa62ff179cf0e', 'yanismazouz'),
(73, 'KHERFI', 'Lyes', 'homme', '1998-10-22', 'kherfi@gmail.com', '24a7032cef26ced22175ee3f69c84edb40242cee', 'lyeskherfi'),
(74, 'OUSLIMANE', 'Hanane', 'femme', '2002-11-23', 'ouslimane@gmail.com', 'a14341ba5d9088640108852861e1c0243a689147', 'hananeouslimane'),
(75, 'KADA', 'Nassim', 'homme', '2003-12-24', 'kada@gmail.com', 'd3fe10f2d47c2fad49aef7d76e09602767133e31', 'nassimkada'),
(76, 'DAHMANI', 'Lilia', 'femme', '2000-01-25', 'dahmani@gmail.com', '8e2c10e90bd0ae1237f7701ff38b26708f69f1bd', 'liliadahmani'),
(77, 'OMANI', 'Hayet', 'femme', '1999-02-26', 'omani@gmail.com', '59c556f7d85bb98b7be427b379c875fc094de333', 'hayetomani'),
(78, 'ZADI', 'Dalal', 'femme', '2001-03-27', 'zadi@gmail.com', '1f69ad92224d2fc53d58da95f35d1baa7b8dce7f', 'dalalzadi'),
(79, 'MECHEKAK', 'Zahra', 'femme', '2002-04-28', 'mechekak@gmail.com', 'f1403ce362102306c0654bcb8e4c387cb64d2b88', 'zahramechekak'),
(80, 'ALIOUAT', 'Asma', 'femme', '1998-05-29', 'aliouat@gmail.com', '50fc15a0109565a9dd81219f9bb92c5fe7e83509', 'asmaaliouat'),
(81, 'BENARBIA', 'Aimim', 'femme', '2003-06-30', 'benarbia@gmail.com', '23aaed983d4b8a7befc21263675c4081377ffd3b', 'aimimbenarbia'),
(82, 'RAHAL', 'Lyes', 'homme', '2000-07-31', 'rahal@gmail.com', '15190cdde2666a22ab0f278e01e351b33d11f40c', 'lyesrahal'),
(83, 'GACEM', 'Abdelmounaim', 'homme', '2001-09-02', 'gacem@gmail.com', '073a06da80eaab554bcc0857f3c1cb13340dec96', 'abdelmounaimgacem'),
(84, 'ZEGHMICHE', 'Dalila', 'femme', '2002-10-03', 'zeghmiche@gmail.com', 'b46f5b00245cf0c6f7bde288312b28cff41c6293', 'dalilazeghmiche'),
(85, 'KADI', 'Razika', 'femme', '2003-11-04', 'kadi@gmail.com', '774a49d2bfc210cca516fe60c3f2bb01b15554f8', 'razikakadi'),
(86, 'DJAROUM', 'Samy', 'homme', '2000-12-05', 'djaroum@gmail.com', '499a3f5fb953ea1347bef75a8081e6ba895acbac', 'samydjaroum'),
(87, 'ACHOURI', 'Amina', 'femme', '1999-01-06', 'achouri@gmail.com', 'f559529da78dabe5a7a70abd76b03673dd69671d', 'aminaachouri'),
(88, 'BEHAR', 'Nacer Eddine', 'homme', '2002-03-08', 'behar@gmail.com', '6117d0ec716149a88794277e0d13ff860908473b', 'nacereddinebehar'),
(89, 'BELLOUNI', 'Fatma', 'femme', '2003-05-10', 'bellouni@gmail.com', 'fa027ad692d74905cd4bfd936e9339380164ce97', 'fatmabellouni'),
(90, 'GUIRAT', 'Mazigh', 'homme', '2000-06-11', 'guirat@gmail.com', '4df9d89075cf31922ecf5b9a67f8949107cf2e45', 'mazighguirat'),
(91, 'MECHEKAK', 'Khaled', 'homme', '1999-07-12', 'mechekak@gmail.com', 'f1403ce362102306c0654bcb8e4c387cb64d2b88', 'khaledmechekak');

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

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id_reponse`, `id_demande`, `reponse`, `traiter`, `date_de_recuperation`, `cause_de_refus`, `recuperez`) VALUES
(231, 230, 'Accepter', 'oui', '2024-06-06 08:30:00', NULL, 'non'),
(232, 293, 'Accepter', 'non', NULL, NULL, 'non'),
(233, 545, 'Accepter', 'oui', '2024-06-06 08:30:00', NULL, 'non'),
(234, 153, 'Accepter', 'non', NULL, NULL, 'non'),
(235, 152, 'Accepter', 'oui', '2024-06-06 09:00:00', NULL, 'oui'),
(236, 159, 'Accepter', 'oui', '2024-06-12 08:00:00', NULL, 'non'),
(237, 170, 'Accepter', 'oui', '2024-06-12 08:00:00', NULL, 'non'),
(238, 174, 'Accepter', 'oui', '2024-06-12 08:00:00', NULL, 'non'),
(239, 178, 'Accepter', 'oui', '2024-06-12 08:00:00', NULL, 'non'),
(240, 602, 'Accepter', 'oui', '2024-06-12 09:30:00', NULL, 'non'),
(241, 179, 'Accepter', 'non', NULL, NULL, 'non'),
(242, 181, 'Accepter', 'non', NULL, NULL, 'non'),
(243, 184, 'Accepter', 'non', NULL, NULL, 'non'),
(244, 185, 'Accepter', 'non', NULL, NULL, 'non'),
(246, 186, 'Refuser', 'non', NULL, 'nom fauus', 'non'),
(248, 188, 'Accepter', 'non', NULL, NULL, 'non'),
(250, 189, 'Accepter', 'non', NULL, NULL, 'non'),
(252, 190, 'Accepter', 'non', NULL, NULL, 'non'),
(254, 192, 'Accepter', 'non', NULL, NULL, 'non'),
(256, 603, 'Accepter', 'non', NULL, NULL, 'non'),
(258, 604, 'Accepter', 'non', NULL, NULL, 'non');

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
(11, 561, 'nom fauss'),
(13, 196, 'nom fauss');

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
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`);

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
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=605;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT pour la table `reponses`
--
ALTER TABLE `reponses`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=260;

--
-- AUTO_INCREMENT pour la table `signale`
--
ALTER TABLE `signale`
  MODIFY `id_signale` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
