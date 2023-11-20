-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 20 nov. 2023 à 21:36
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `site_jeux`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(30) NOT NULL,
  `nom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(4, 'Ambiance'),
(1, 'Cooperatif'),
(2, 'Escape Game'),
(5, 'Familliale'),
(3, 'Gestion'),
(6, 'Logique'),
(8, 'Tactique');

-- --------------------------------------------------------

--
-- Structure de la table `favories`
--

CREATE TABLE `favories` (
  `id` int(30) NOT NULL,
  `id_users` int(30) NOT NULL,
  `id_jeux` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

CREATE TABLE `inscription` (
  `id` int(30) NOT NULL,
  `id_planning` int(30) NOT NULL,
  `id_users` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

CREATE TABLE `jeux` (
  `id` int(30) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `id_categorie` int(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`id`, `nom`, `description`, `id_categorie`) VALUES
(2, 'Cluedo', 'Cluedo (Cluedo en Grande-Bretagne, Clue en Amérique du Nord, littéralement « indice » en français) est un jeu de société dans lequel les joueurs doivent découvrir parmi eux qui est le meurtrier d\'un crime commis dans un manoir anglais, le Manoir Tudor. Imaginé par Anthony Pratt et sa femme, Elva Rosalie Pratt, en 1943 à Birmingham, le jeu est mis en vente pour la première fois par Waddington Games au Royaume-Uni en 1949. ', 2),
(3, 'The Game', 'The Game est un jeu de cartes coopératif de 1 à 5 joueurs dans lequel les joueurs s\'unissent tous ensemble dans le but de parvenir à poser toutes les cartes sur 4 piles : 2 ascendantes, 2 descendantes. Pour les aider dans cette tâche, les joueurs pourront faire des sauts en arrière de 10. Mais cela suffira-t-il pour vaincre le jeu, sachant qu\'ils ne pourront communiquer la valeur de leurs cartes en main ?  Le jeu s\'appelle The Game parce que l\'on joue ensemble contre le jeu. Les joueurs doivent coopérer, prendre des décisions ensemble et ne pas craquer quand la pression monte !', 1),
(4, 'The Mind', 'The Mind est plus qu\'un simple jeu. C\'est une expérience, un voyage, un travail d\'équipe dans lequel on ne peut pas échanger des informations, mais dans lequel il ne faudra faire qu\'un pour vaincre tous les niveaux du jeu.  Plus précisément, le jeu contient des cartes numérotées de 1 à 100, et pendant le jeu, vous essayez de compléter 12, 10 ou 8 niveaux de jeu avec 2, 3 ou 4 joueurs. Dans un niveau, chaque joueur reçoit une main de cartes égale au nombre de cartes du niveau : une carte dans le niveau 1, deux cartes dans le niveau 2, etc. Collectivement, vous devez jouer ces cartes au centre de la table sur une seule pile de défausse dans l\'ordre croissant, mais vous ne pouvez pas communiquer entre vous de quelque façon que ce soit sur les cartes que vous tenez. Vous vous regardez simplement dans les yeux l\'un de l\'autre, et quand vous sentez que le moment est venu, vous jouez votre carte la plus basse. Si personne ne détient une carte plus basse que ce que vous avez joué, c\'est génial, le jeu continue ! Sinon, tous les joueurs se débarrassent de toutes les cartes plus basses que la votre, et vous perdez une vie.', 1),
(5, 'Catane', 'Catan est un jeu où s\'entremêlent différents aspects du jeu de société. Pour vous imposer, vous devrez être à la fois un bon gestionnaire et un excellent négociateur et un bâtisseur chevronné. Lancez les dés et récoltez les ressources qu\'il vous faut pour mettre en place votre stratégie. Mais ce n\'est pas tout, échangez vos ressources via le commerce avec vos concurrents ou le transport maritime. Puis utilisez les ressources nécessaires pour poser votre main sur l\'île de Catane.', 3),
(6, 'Monopoly', 'On ne présente plus le Monopoly. Édité pour la première fois en 1935, ce jeu de société incontournable, ayant pour thème central les transactions immobilières, s\'est imposé au fil des décennies comme étant le plus gros succès du monde ludique.   Le but du jeu est simple : les joueurs doivent acheter, vendre, construire et spéculer pour s\'enrichir un maximum tout en forçant les autres à faire faillite.  Pour être déclaré gagnant, les joueurs devront acheter des propriétés afin de s\'enrichir le plus possible. Plus ils posséderont de propriétés, plus ils auront d\'argent.', 5),
(7, 'Mysterium', 'M. MacDowell, astrologue doué, a détecté la présence d\'un être surnaturel en entrant dans sa nouvelle maison en Écosse. Il a réuni d\'éminents médiums pour une séance extraordinaire. Ces derniers ont sept heures pour contacter le fantôme et enquêter sur son assassinat. Malheureusement, le fantôme est amnésique et ne peut communiquer avec les médiums que par le biais de visions, qui sont représentées dans le jeu par des cartes illustrées. Les médiums doivent déchiffrer les images pour aider le fantôme à se rappeler du drame : Qui a commis le crime ? Où s\'est-il déroulé ? Quelle arme a causé la mort ? Plus les médiums coopèrent et devinent bien, plus il est facile d\'attraper le bon coupable.', 1),
(8, 'Dixit', 'Le principe de Dixit est simple : les joueurs doivent deviner et faire deviner des cartes illustrées. À chaque tour, un joueur devient le conteur qui choisit une carte et la décrit avec une phase, un mot ou un son. Mais attention, pour marquer des points, la carte doit être trouvée seulement par une partie des joueurs. Le message doit donc être à la fois clair et crypté. Un certain mystère doit planer. À vous d\'être inventif et malin ! En plus de devoir trouver le bon dessin, les autres joueurs doivent également choisir une carte dans leur main proche de la description du conteur. Le but ici est d\'induire les autres en erreur. Une fois toutes les cartes récupérées, elles sont dévoilées par le conteur. Les joueurs ont la tâche de débusquer l\'image du conteur.', 5),
(9, 'When I Dream', 'Dans When I Dream, les joueurs incarnent à tour de rôle un rêveur. Lorsque vous endossez ce rôle, votre mission est simple : vous avez un bandeau sur les yeux et vous devez deviner un maximum de mots dans le temps imparti. Mais attention, votre tâche ne s’arrête pas là, car une fois le sablier écoulé, vous devrez raconter votre rêve avec les mots devinés. Soyez donc rapide et habile d’esprit et surtout n’oubliez pas de faire marcher votre mémoire !', 5);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `objet` text NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

CREATE TABLE `planning` (
  `id` int(30) NOT NULL,
  `id_jeux` int(30) NOT NULL,
  `places` int(5) NOT NULL,
  `dateDebut` date NOT NULL COMMENT 'date et heure de début',
  `niveau` text,
  `duree` int(11) NOT NULL COMMENT 'nombre d''heure\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`id`, `id_jeux`, `places`, `dateDebut`, `niveau`, `duree`) VALUES
(2, 2, 20, '2023-11-29', '2', 20);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `pseudo`, `email`, `mdp`, `role`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'jean.dupont@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 1),
(2, 'BOTOVELO MECHICHE', 'Loriane', 'Xena', 'loriane.mechiche@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 0),
(3, 'Macron', 'Emmanuel', 'Manu', 'manudu75@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 0),
(4, 'Teddy', 'Riner', 'Ted', 'teddy.riner@gmail.com', '00d70c561892a94980befd12a400e26aeb4b8599', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categorie` (`nom`);

--
-- Index pour la table `favories`
--
ALTER TABLE `favories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`) USING BTREE,
  ADD KEY `id_jeux` (`id_jeux`) USING BTREE;

--
-- Index pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_planning_2` (`id_planning`,`id_users`) USING BTREE,
  ADD KEY `id_planning` (`id_planning`) USING BTREE,
  ADD KEY `id_users` (`id_users`) USING BTREE;

--
-- Index pour la table `jeux`
--
ALTER TABLE `jeux`
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jeux` (`id_jeux`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `favories`
--
ALTER TABLE `favories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `inscription`
--
ALTER TABLE `inscription`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jeux`
--
ALTER TABLE `jeux`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
