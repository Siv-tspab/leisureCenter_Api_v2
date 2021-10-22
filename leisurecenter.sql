-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 25 sep. 2021 à 13:32
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `leisurecenter_v2`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Kitesurf'),
(2, 'Canoë'),
(3, 'Wakeboard'),
(4, 'Accrobranche'),
(5, 'Escalade'),
(6, 'VTT'),
(7, 'Via Ferrata'),
(8, 'Randonnée'),
(9, 'Battle Tag'),
(10, 'Surf');

-- --------------------------------------------------------

--
-- Structure de la table `center`
--

CREATE TABLE `center` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `center`
--

INSERT INTO `center` (`id`, `name`, `description`, `address`, `url`, `coordinates`) VALUES
(1, 'Solo Escalade', 'SOLO Escalade est une salle de sport pour une remise en forme ludique ou pour un entraînement intensif. Dans une ambiance lumineuse et colorée, bougez en 3 dimensions !', '131, chemin du Sang de Serp 31200 Toulouse', 'http://www.soloescalade.fr/', 'a:2:{i:0;d:1.422459;i:1;d:43.620988;}'),
(2, 'WAM PARK - Toulouse - Sesquières', 'Une base de loisirs nouvelle génération : grand et petit téléski, terrasse, water games et bien plus!', 'Allée des foulques 31200 Toulouse', 'http://www.wampark.fr/', 'a:2:{i:0;d:1.412745;i:1;d:43.653701;}'),
(3, 'Canoë Kayak Toulousain', "Le CKT est une association dont l'activité principale est l'enseignement du Canoë-Kayak. Les adhérents disposent de cours réguliers pour acquérir les techniques dans différentes formes de pratique.", '16 chemin de la Loge 31400 Toulouse', 'http://www.cktoulousain.fr/', 'a:2:{i:0;d:1.434442;i:1;d:43.574347;}'),
(4, 'Biarritz Surf Training', 'Situé à Biarritz au Pays basque, à 300 m de la plage à pied, le surf camp de Surftraining est une école de surf ouverte à tous quelque soit votre niveau, débutant ou confirmé.', 'Plage de la cote des basques Boulevard du prince de Galles 64200 Biarritz', 'http://www.surftraining.com/', 'a:2:{i:0;d:-1.56;i:1;d:43.48;}'),
(5, 'VTT Pyrénées Plaisir', "Encadrement VTT dans les Pyrénées Française et Espagnole: stage pilotage VTT tous niveaux, Stage VTT Enduro Navette, Raids All Mountain, Préparation suspension terrain. Nous gérons toute la logistique, vous n'avez qu'à profiter.", '3 lotissement peruilhet 64570 Issor', 'http://pyreneesplaisir.com/', 'a:2:{i:0;d:-0.703504;i:1;d:43.092468;}'),
(6, "Block'Out Toulouse", "Salle d'escalade de bloc et restaurant ouverts 7 jours sur 7 à Toulouse dans le Languedoc-Roussillon-Midi-Pyrénées, avec salle de musculation, sauna et hammam.", "2 rue de l'Égalité 31200 Toulouse", 'https://www.blockout.fr/bo-toulouse', 'a:2:{i:0;d:1.411612;i:1;d:43.630921;}'),
(7, 'Lorem ipdolor', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime soluta cupiditate qui voluptas sint, odio, aut nam consequatur modi magnam repellendus.', 'Bordeaux', 'https://www.google.com', 'a:2:{i:0;d:-0.57944;i:1;d:44.83778;}'),
(8, 'Dignissimos fugit', ' Dignissimos fugit similique nemo aliquid perferendis eius ipsa, sit architecto iusto nesciunt eligendi qui blanditiis odit deleniti praesentium!', 'Nantes', 'https://www.google.com', 'a:2:{i:0;d:-1.55389;i:1;d:47.21722;}'),
(9, 'Lorem ipsum dol', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime soluta cupiditate qui voluptas sint, odio, aut nam consequatur modi magnam repellendus.', 'Marseille', 'https://www.google.com', 'a:2:{i:0;d:5.37639;i:1;d:43.29667;}'),
(10, 'Beatae, maxime', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime soluta cupiditate qui voluptas sint, odio, aut nam consequatur modi magnam repellendus.', 'Colmar', 'https://www.google.com', 'a:2:{i:0;d:7.355;i:1;d:48.08111;}'),
(11, 'Lorem', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime soluta  Dignissimos fugit similique nemo aliquid perferendis eius ipsa, sit architecto iusto nesciunt deleniti praesentium! repellendus.', 'Tour', 'https://www.google.com', 'a:2:{i:0;d:0.68833;i:1;d:47.39278;}'),
(12, 'Aliquid perferendis', 'Aliquid perferendis eius ipsa, sit . Beatae, maxime soluta Dignissimos fugit similique nemo architecto maxime soluta sint, odio, aut.', 'Albi', 'https://www.google.com', 'a:2:{i:0;d:-84.753;i:1;d:42.2431;}'),
(13, 'Lorem ipsum dolor', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime soluta cupiditate qui voluptas sint, odio, aut nam consequatur modi magnam repellendus.', 'Lyon', 'https://www.google.com', 'a:2:{i:0;d:4.84139;i:1;d:45.75889;}'),
(14, 'Lelit. Beatae', 'Lelit. Beatae, adipisicing elit maxime soluta cupiditate amet consectetur  qui voluptas sint, odio, aut nam consequatur modi magnam repellendus consequatur modi consequatur modi consequatur modi .', 'Clermont-Ferrand', 'https://www.google.com', 'a:2:{i:0;d:3.08694;i:1;d:45.77972;}'),
(15, 'Lorem ipsum ', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, maxime soluta cupiditate qui voluptas sint, odio, aut nam consequatur modi magnam repellendus.', 'Montpellier', 'https://www.google.com', 'a:2:{i:0;d:3.87723;i:1;d:43.61092;}'),
(16, 'Lorem ipsum dolor', 'Lelit. Beatae, adipisicing elit maxime soluta cupiditate amet consectetur  qui voluptas sint, odio, aut nam consequatur modi magnamtur modi magnam repellendus.', 'Tarbes', 'https://www.google.com', 'a:2:{i:0;d:0.07444;i:1;d:43.23278;}'),
(17, 'Auterive Adventures', "Implanté sur un site de 9 hectares sur les deux berges de l'Ariège, ce parc d'aventures est ouvert 'tous les week-ends' et 'tous les jours' pendant toutes les vacances scolaires... Il vous donnera des 'sensations fortes' dans ses parcours très variés dont certains 'très engageants'..", 'auterive 31190', 'https://www.auterive-adventures.com/', 'a:2:{i:0;d:1.48;i:1;d:43.35;}');

-- --------------------------------------------------------

--
-- Structure de la table `center_category`
--

CREATE TABLE `center_category` (
  `center_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `center_category`
--

INSERT INTO `center_category` (`center_id`, `category_id`) VALUES
(1, 5),
(2, 3),
(3, 2),
(4, 10),
(5, 6),
(6, 5),
(7, 8),
(8, 4),
(9, 3),
(10, 10),
(11, 9),
(12, 3),
(13, 1),
(14, 5),
(15, 1),
(16, 7),
(17, 4);


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `center`
--
ALTER TABLE `center`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `center_category`
--
ALTER TABLE `center_category`
  ADD PRIMARY KEY (`center_id`,`category_id`),
  ADD KEY `IDX_1788261C77458AFB` (`center_id`),
  ADD KEY `IDX_1788261CACA9AD4A` (`category_id`);


--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `center`
--
ALTER TABLE `center`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `center_category`
--
ALTER TABLE `center_category`
  ADD CONSTRAINT `FK_1788261C77458AFB` FOREIGN KEY (`center_id`) REFERENCES `center` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1788261CACA9AD4A` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
