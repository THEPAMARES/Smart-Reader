-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 14 fév. 2022 à 01:02
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `smart_reader`
--

-- --------------------------------------------------------

--
-- Structure de la table `dealing`
--

CREATE TABLE `dealing` (
  `id_deal` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_book` varchar(255) NOT NULL,
  `dealing_position` enum('offer','request') NOT NULL,
  `point_offers` int(11) NOT NULL,
  `done` enum('0','1') NOT NULL DEFAULT '0',
  `dealing_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `exchange`
--

CREATE TABLE `exchange` (
  `id_exchange` int(11) NOT NULL,
  `id_deal` int(11) NOT NULL,
  `id_purchaser` int(11) NOT NULL,
  `id_book` varchar(255) NOT NULL,
  `id_owner` int(11) NOT NULL,
  `dealing_point` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `inscription_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `point` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL,
  `disabled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `name`, `firstname`, `pseudo`, `pw`, `email`, `birthdate`, `address`, `inscription_date`, `point`, `photo`, `admin`, `disabled`) VALUES
(26, 'VI LU HUYNH', 'Caroline', 'MingTih', '$2y$10$DO9jB/XGjmhuSzUo3R3MweJZ7HNe3dWyK5NMGwgfFheerkZ6gVPA.', 'caroline.vlhuynh@gmail.com', '1990-04-17', '25 avenue Youri Gagarine', '2022-02-14 00:01:10', 0, 'C:\\xampp\\htdocs\\smart_reader\\config/../public\\uploads\\photo_profil\\MingTih-1644796870-chat-potte-shrek-07.jpg', 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dealing`
--
ALTER TABLE `dealing`
  ADD PRIMARY KEY (`id_deal`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `exchange`
--
ALTER TABLE `exchange`
  ADD PRIMARY KEY (`id_exchange`),
  ADD KEY `id_purchaser` (`id_purchaser`),
  ADD KEY `id_deal` (`id_deal`),
  ADD KEY `id_owner` (`id_owner`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dealing`
--
ALTER TABLE `dealing`
  MODIFY `id_deal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `exchange`
--
ALTER TABLE `exchange`
  MODIFY `id_exchange` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `dealing`
--
ALTER TABLE `dealing`
  ADD CONSTRAINT `link_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Contraintes pour la table `exchange`
--
ALTER TABLE `exchange`
  ADD CONSTRAINT `purchaser_link` FOREIGN KEY (`id_purchaser`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
