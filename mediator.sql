-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Hôte : db5000329061.hosting-data.io
-- Généré le : mer. 18 mars 2020 à 15:52
-- Version du serveur :  5.7.28-log
-- Version de PHP : 7.0.33-0+deb9u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs320724`
--

-- --------------------------------------------------------

--
-- Structure de la table `LikedMovies`
--

CREATE TABLE `LikedMovies` (
  `MovieID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `LikedSeries`
--

CREATE TABLE `LikedSeries` (
  `SeriesID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Movies`
--

CREATE TABLE `Movies` (
  `MovieID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `ReleaseDate` date DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `Genres` varchar(255) DEFAULT NULL,
  `Grade` float DEFAULT NULL,
  `Synopsis` text,
  `Review` text,
  `PosterPath` varchar(255) DEFAULT NULL,
  `BackdropPath` varchar(255) DEFAULT NULL,
  `TrailerPath` varchar(255) DEFAULT NULL,
  `Requester` int(11) DEFAULT NULL,
  `RequestDate` datetime DEFAULT NULL,
  `AddDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Movies`
--

INSERT INTO `Movies` (`MovieID`, `Title`, `Rating`, `ReleaseDate`, `Duration`, `Genres`, `Grade`, `Synopsis`, `Review`, `PosterPath`, `BackdropPath`, `TrailerPath`, `Requester`, `RequestDate`, `AddDate`) VALUES
(1, 'Joker', 3, '2019-10-02', 122, 'Crime, Thriller, Drame', 83.75, 'Dans les années 1980, à Gotham City, Arthur Fleck, un humoriste de stand-up raté, bascule dans la folie et devient le Joker.', '', 'tgcrYiyG75iDcyk3en9NzZis0dh.jpg', 'n6bUvigpRFqSwmPp1m2YADdbRBc.jpg', 'Z1hR4L24fZ4', 1, '2020-03-15 18:06:44', '2020-03-18 00:13:56'),
(2, 'Ad Astra', 1, '2019-09-17', 123, 'Science-Fiction, Drame, Thriller, Aventure, Mystère', 63, 'L’astronaute Roy McBride s’aventure jusqu’aux confins du système solaire à la recherche de son père disparu et pour résoudre un mystère qui menace la survie de notre planète. Lors de son voyage, il sera confronté à des révélations mettant en cause la nature même de l’existence humaine, et notre place dans l’univers.', '', 'xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg', '5BwqwxMEjeFtdknRV792Svo0K1v.jpg', 'ES9mm9blUyM', 3, '2020-03-15 18:06:44', '2020-03-18 00:15:32'),
(3, 'Spider-Man : New Generation', 1, '2018-12-06', 117, 'Action, Aventure, Animation, Science-Fiction, Comédie', 84, 'Spider-Man : New Generation présente Miles Morales, un adolescent vivant à Brooklyn, et révèle les possibilités illimitées du Spider-Verse, un univers où plus d’un peut porter le masque…', '', 'jw9TRNYIMI1KsTjgQ3wVYSMXxlh.jpg', 'uUiId6cG32JSRI6RyBQSvQtLjz2.jpg', 'fv-J6MTrxxM', 1, '2020-03-15 18:10:28', '2020-03-18 00:11:50'),
(4, 'Logan', 3, '2017-02-28', 138, 'Action, Drame, Science-Fiction', 78.75, 'Dans un futur proche, un certain Logan, épuisé de fatigue, s’occupe d’un Professeur X souffrant, dans un lieu gardé secret à la frontière Mexicaine. Mais les tentatives de Logan pour se retrancher du monde et rompre avec son passé vont s’épuiser lorsqu’une jeune mutante traquée par de sombres individus va se retrouver soudainement face à lui.', '', 't6zkHwQ8nmU1N6X1OOouXIpyeYz.jpg', 'yEv8c6i79vk06sZDC3Z9D8HQLVV.jpg', '1RNCpj2cvPw', 1, '2020-03-17 12:04:23', '2020-03-18 00:23:57'),
(5, 'Batman Begins', 3, '2005-06-10', 139, 'Action, Crime, Drame', 77.5, 'Comment un homme seul peut-il changer le monde ? Telle est la question qui hante Bruce Wayne depuis cette nuit tragique où ses parents furent abattus sous ses yeux, dans une ruelle de Gotham City. Torturé par un profond sentiment de colère et de culpabilité, le jeune héritier de cette richissime famille fuit Gotham pour un long et discret voyage à travers le monde. Le but de ses pérégrinations : sublimer sa soif de vengeance en trouvant de nouveaux moyens de lutter contre l\'injustice.', '', 'dr6x4GyyegBWtinPBzipY02J2lV.jpg', '9myrRcegWGGp24mpVfkD4zhUfhi.jpg', 'jXrFsn9pcZY', 1, '2020-03-17 12:04:31', '2020-03-18 00:26:56'),
(6, 'The Dark Knight : Le chevalier noir', 3, '2008-07-16', 147, 'Drame, Action, Crime, Thriller', 86, 'Dans ce nouveau volet, Batman augmente les mises dans sa guerre contre le crime. Avec l\'appui du lieutenant de police Jim Gordon et du procureur de Gotham, Harvey Dent, Batman vise à éradiquer le crime organisé qui pullule dans la ville. Leur association est très efficace mais elle sera bientôt bouleversée par le chaos déclenché par un criminel extraordinaire que les citoyens de Gotham connaissent sous le nom de Joker.', '', '30bVZPX7ZRkoOhh7hCXAoDomDgQ.jpg', 'hqkIcbrOHL86UncnHIsHVcVmzue.jpg', '6n4Vy7n7oqw', 1, '2020-03-17 12:04:37', '2020-03-18 00:29:50'),
(7, 'The Dark Knight Rises', 3, '2012-07-16', 164, 'Action, Crime, Drame, Thriller', 79, 'Afin que l\'image de l\'ex-procureur Harvey Dent reste un modèle du genre pour les citoyens de Gotham City, Batman a endossé les crimes de ce dernier et a été chassé de la ville par les autorités.  Huit ans plus tard, alors que Gotham City est de nouveau sûre, le commissaire Gordon tombe sur un complot qui vise à détruire la ville de l\'intérieur.  Il fait appel à Batman. Ce dernier devra faire face à la mystérieuse Selina Kyle et à Bane, un adversaire mortel, qui veut mettre en pièce le symbole Batman.', '', '66IUkB2clp7dlSe8egV8APzqpwe.jpg', 'f6ljQGv7WnJuwBPty017oPWfqjx.jpg', 'OiqPQ7L_C00', 1, '2020-03-17 12:04:42', '2020-03-18 00:35:13'),
(8, 'Le seigneur des anneaux : La communauté de l\'anneau', 3, '2001-12-18', 165, 'Aventure, Fantastique, Action', 85.25, 'Le jeune et timide Hobbit, Frodon Sacquet, hérite d\'un anneau. Bien loin d\'être une simple babiole, il s\'agit de l\'Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. À moins que Frodon, aidé d\'une Compagnie constituée de Hobbits, d\'Hommes, d\'un Magicien, d\'un Nain, et d\'un Elfe, ne parvienne à emporter l\'Anneau à travers la Terre du Milieu jusqu\'à la Crevasse du Destin, lieu où il a été forgé, et à le détruire pour toujours. Un tel périple signifie s\'aventurer très loin en Mordor, les terres du Seigneur des ténèbres, où est rassemblée son armée d\'Orques maléfiques... La Compagnie doit non seulement combattre les forces extérieures du mal mais aussi les dissensions internes et l\'influence corruptrice qu\'exerce l\'Anneau lui-même.', '', '1rF04Kk1eunZHk9OHPFwv8hllRF.jpg', 'pIUvQ9Ed35wlWhY2oU6OmwEsmzG.jpg', 'vvx7m22GGtA', 2, '2020-03-17 12:04:50', '2020-03-18 00:38:17'),
(9, 'Le seigneur des anneaux : Les deux tours', 3, '2002-12-18', 178, 'Aventure, Fantastique, Action', 84.75, 'Après la mort de Boromir et la disparition de Gandalf, la Communauté s\'est scindée en trois. Perdus dans les collines d\'Emyn Muil, Frodon et Sam découvrent qu\'ils sont suivis par Gollum, une créature versatile corrompue par l\'Anneau. Celui-ci promet de conduire les Hobbits jusqu\'à la Porte Noire du Mordor. À travers la Terre du Milieu, Aragorn, Legolas et Gimli font route vers le Rohan, le royaume assiégé de Theoden. Cet ancien grand roi, manipulé par l\'espion de Saroumane, le sinistre Langue de Serpent, est désormais tombé sous la coupe du malfaisant Magicien. Eowyn, la nièce du Roi, reconnaît en Aragorn un meneur d\'hommes. Entretemps, les Hobbits Merry et Pippin, prisonniers des Uruk-hai, se sont échappés et ont découvert dans la mystérieuse Forêt de Fangorn un allié inattendu : Sylvebarbe, gardien des arbres, représentant d\'un ancien peuple végétal dont Saroumane a décimé la forêt...', '', '7RLrUQH2qnCw4To5nVwRAdywGVy.jpg', 'dG4BmM32XJmKiwopLDQmvXEhuHB.jpg', 'xS8lwH02tAA', 2, '2020-03-17 12:04:55', '2020-03-18 00:39:55'),
(10, 'Le seigneur des anneaux : Le retour du roi', 3, '2003-12-01', 201, 'Aventure, Fantastique, Action', 86, 'Les armées de Sauron ont attaqué Minas Tirith, la capitale de Gondor.  Jamais ce royaume autrefois puissant n\'a eu autant besoin de son roi.  Mais Aragorn trouvera-t-il en lui la volonté d\'accomplir sa destinée ?  Tandis que Gandalf s\'efforce de soutenir les forces brisées de Gondor, Théoden exhorte les guerriers de Rohan à se joindre au combat.  Mais malgré leur courage et leur loyauté, les forces des Hommes ne sont pas de taille à lutter contre les innombrables légions d\'ennemis qui s\'abattent sur le royaume...  Chaque victoire se paye d\'immenses sacrifices.  Malgré ses pertes, la Communauté se jette dans la bataille pour la vie, ses membres faisant tout pour détourner l\'attention de Sauron afin de donner à Frodon une chance d\'accomplir sa quête.  Voyageant à travers les terres ennemies, ce dernier doit se reposer sur Sam et Gollum, tandis que l\'Anneau continue de le tenter...', '', 'nZVMVULm6nFZQ7QTHnWoH0Wp2ck.jpg', '8BPZO0Bf8TeAy8znF43z8soK3ys.jpg', 'rc6snEBb-_g', 2, '2020-03-17 12:05:00', '2020-03-18 00:42:25'),
(11, 'Avengers : Infinity War', 3, '2018-04-25', 149, 'Aventure, Action, Science-Fiction', 81.75, 'Les Avengers et leurs alliés devront être prêts à tout sacrifier pour neutraliser le redoutable Thanos avant que son attaque éclair ne conduise à la destruction complète de l’univers.', '', '7WsyChQLEftFiDOVTGkv3hFpyyt.jpg', 'bOGkgRGdhrBYJSLpXaxhXVstddV.jpg', 'DjYBTqgj8uE', 1, '2020-03-17 12:05:04', '2020-03-18 00:46:21'),
(12, 'El Camino : Un film \"Breaking Bad\"', 1, '2019-10-11', 120, 'Crime, Drame, Thriller, Action', 70.25, 'À la suite de sa tragique évasion, Jesse doit accepter son passé s\'il veut se construire un avenir... ou quelque chose qui y ressemble plus ou moins.', '', '6uyjWFzl59NSl4A7cORMpZ2X4Fu.jpg', '2GUcUDSGqQSyIxe7xDxnVTfWQgq.jpg', '40cJaRRxNPU', 1, '2020-03-17 12:05:09', '2020-03-18 00:49:17'),
(13, 'Les petits mouchoirs', 1, '2010-10-20', 154, 'Comédie, Drame', 68, 'A la suite d\'un événement bouleversant, une bande de copains décide, malgré tout, de partir en vacances au bord de la mer comme chaque année. Leur amitié, leurs certitudes, leur culpabilité, leurs amours en seront ébranlées. Ils vont enfin devoir lever les \"petits mouchoirs\" qu\'ils ont posés sur leurs secrets et leurs mensonges.', '', 'eDBxDW83BWYWEEqKbPOiasNBZ40.jpg', 'j2RxIz3HYDiG6vjZ1CwVdbN6de3.jpg', 'mxKMVFBPUQo', 4, '2020-03-17 12:05:13', '2020-03-18 00:51:56'),
(14, 'Avengers : Endgame', 3, '2019-04-24', 181, 'Aventure, Science-Fiction, Action', 79.5, 'Après leur défaite face au Titan Thanos qui dans le film précédent s\'est approprié toutes les pierres du Gant de l\'infini , les Avengers et les Gardiens de la Galaxie ayant survécu à son claquement de doigts qui a pulvérisé « la moitié de toute forme de vie dans l\'Univers », Captain America, Thor, Bruce Banner, Natasha Romanoff, War Machine, Tony Stark, Nébula et Rocket, vont essayer de trouver une solution pour ramener leurs coéquipiers disparus et vaincre Thanos en se faisant aider par Ronin alias Clint Barton, Captain Marvel et Ant-Man.', '', 'ulzhLuWrPK07P1YkdWQLZnQh1JL.jpg', '7RyHsO4yDXtBv1zUU3mTpHeQ0d5.jpg', 'bgTlt5-l-AA', 1, '2020-03-17 12:05:21', '2020-03-18 00:53:49'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:05:40', NULL),
(16, 'Je suis une légende', 3, '2007-12-14', 100, 'Drame, Horreur, Action, Thriller, Science-Fiction', 70, 'Robert Neville était un savant de haut niveau et de réputation mondiale, mais il en aurait fallu plus pour stopper les ravages de cet incurable et terrifiant virus d\'origine humaine. Mystérieusement immunisé contre le mal, Neville est aujourd\'hui le dernier homme à hanter les ruines de New York. Peut-être le dernier homme sur Terre… Depuis trois ans, il diffuse chaque jour des messages radio dans le fol espoir de trouver d\'autres survivants. Nul n\'a encore répondu. Mais Neville n\'est pas seul. Des mutants, victimes de cette peste moderne - on les appelle les « Infectés » - rôdent dans les ténèbres, observant ses moindres gestes, guettent sa première erreur. Devenu l\'ultime espoir de l\'humanité, Neville se consacre tout entier à sa mission : venir à bout du virus, en annuler les terribles effets en se servant de son propre sang. Ses innombrables ennemis lui en laisseront-ils le temps ? Le compte à rebours touche à sa fin…', '', 'pVc73MJKaXuI7nJ55Z5fMTEKid1.jpg', 'u6Qg7TH7Oh1IFWCQSRr4htFFt0A.jpg', 'jyrYjhjS7w0', 3, '2020-03-17 12:05:46', '2020-03-18 00:56:53'),
(17, 'Le roi lion', 1, '2019-07-12', 118, 'Aventure, Familial', 70, 'Au fond de la savane africaine, tous les animaux célèbrent la naissance de Simba, leur futur roi. Les mois passent. Simba idolâtre son père, le roi Mufasa, qui prend à cœur de lui faire comprendre les enjeux de sa royale destinée. Mais tout le monde ne semble pas de cet avis. Scar, le frère de Mufasa, l\'ancien héritier du trône, a ses propres plans. La bataille pour la prise de contrôle de la Terre des Lions est ravagée par la trahison, la tragédie et le drame, ce qui finit par entraîner l\'exil de Simba. Avec l\'aide de deux nouveaux amis, Timon et Pumbaa, le jeune lion va devoir trouver comment grandir et reprendre ce qui lui revient de droit.', '', 'pOG7JuPrz1Q5NtuQHAt5jzgtQzN.jpg', 'nRXO2SnOA75OsWhNhXstHB8ZmI3.jpg', 'tjIndbOmPIo', 1, '2020-03-17 12:06:01', '2020-03-18 00:58:42'),
(18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:06:10', NULL),
(19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:06:15', NULL),
(20, 'La French', 1, '2014-12-03', 135, 'Action, Crime, Thriller', 72.5, 'Marseille. 1975. Pierre Michel, jeune magistrat venu de Metz avec femme et enfants, est nommé juge du grand banditisme. Il décide de s’attaquer à la French Connection, organisation mafieuse qui exporte l’héroïne dans le monde entier. N’écoutant aucune mise en garde, le juge Michel part seul en croisade contre Gaëtan Zampa, figure emblématique du milieu et parrain intouchable. Mais il va rapidement comprendre que, pour obtenir des résultats, il doit changer ses méthodes.', '', 'wscTUxeEHV2sdC9To4a0Zkz4cFN.jpg', 'c5JKUU69HtWseqoPgYbBKVpQrKm.jpg', 'DdID1uYq0V0', 3, '2020-03-17 12:06:19', '2020-03-18 01:07:48'),
(21, 'Sous un autre jour', 3, '2019-01-10', 126, 'Comédie, Drame', 61.5, 'Dell, un ancien détenu en liberté conditionnelle qui n’a pas sa langue dans sa poche, est engagé pour s’occuper de Philip, un milliardaire tétraplégique désabusé. Grâce à l’humour contagieux de Dell, Philip reprend goût à la vie. Ensemble, ils sont désormais prêts à tout … pour le meilleur et pour le pire !  Remake américain du film Intouchables.', '', 'tUowmVL4uaXAQiKA9OyHSJGUL4U.jpg', 'mdGUvN7yCyExPNO5f4zAzifk1l1.jpg', '6c56xKepHn8', 3, '2020-03-17 12:06:27', '2020-03-18 01:04:59'),
(22, 'Les animaux fantastiques', 3, '2016-11-16', 133, 'Aventure, Familial, Fantastique', 73.25, 'New York 1926. Une force mystérieuse sème le chaos dans les rues, menaçant de révéler l’existence de la communauté des sorciers. Au même moment, Norbert Dragonneau débarque dans la ville au terme d’un périple à travers le monde. Il a répertorié un bestiaire d’animaux fantastiques dont certains sont dissimulés dans sa valise. Mais quand Jacob Kowalski, Non-Maj qui ne se doute de rien libère accidentellement quelques-unes de ces créatures, ils vont devoir s’unir pour les retrouver avant qu’il ne soit trop tard. Ces héros improbables ne se doutent alors pas que leur mission les mènera à affronter les forces de ténèbres.', '', '7641iyvTdREC0eO2YUPmIk4PtrO.jpg', '7GrpqAs0oDcFcwFwyygnUI7BrZA.jpg', 'KPl31ctRNH4', 2, '2020-03-17 12:06:33', '2020-03-18 01:10:27'),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:06:37', NULL),
(24, 'L\'apparition', 1, '2018-02-14', 140, 'Drame', 64.5, 'Jacques, grand reporter pour un quotidien français reçoit un jour un mystérieux coup de téléphone du Vatican. Dans une petite ville du sud-est de la France une jeune fille de 18 ans a affirmé avoir eu une apparition de la Vierge Marie. La rumeur s’est vite répandue et le phénomène a pris une telle ampleur que des milliers de pèlerins viennent désormais se recueillir sur le lieu des apparitions présumées. Jacques qui n’a rien à voir avec ce monde-là accepte de faire partie d’une commission d’enquête chargée de faire la lumière sur ces événements.', '', 'fd4oUkMxzLNBlfcdj83SffNZujj.jpg', 'y64dXLCrhAYYBLJYdpCYyi2ETIv.jpg', '2ILaJ57qcDw', 3, '2020-03-17 12:06:42', '2020-03-18 01:12:46'),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:06:48', NULL),
(26, 'Nous finirons ensemble', 1, '2019-05-01', 135, 'Comédie, Drame', 66.25, 'Préoccupé, Max est parti dans sa maison au bord de la mer pour se ressourcer. Sa bande de potes, qu’il n’a pas vue depuis plus de 3 ans débarque par surprise pour lui fêter son anniversaire ! La surprise est entière mais l’accueil l’est beaucoup moins... Max s’enfonce alors dans une comédie du bonheur qui sonne faux, et qui mettra le groupe dans des situations pour le moins inattendues. Les enfants ont grandi, d’autres sont nés, les parents n’ont plus les mêmes priorités... Les séparations, les accidents de la vie... Quand tous décident de ne plus mettre de petits mouchoirs sur les gros bobards, que reste-t-il de l’amitié ?', '', 'fzUvcARz82u9ZL1MIQPJXhSwBhB.jpg', '8YQNMRm5gPAtdj5CTqYjfbRI4Zw.jpg', '7rmMBB4DQ5s', 4, '2020-03-17 12:06:52', '2020-03-18 01:14:47'),
(27, 'Les animaux fantastiques - Les crimes de Grindelwald', 3, '2018-11-14', 134, 'Aventure, Fantastique, Familial', 65.75, '1927 : Quelques mois après sa capture, le célèbre sorcier Gellert Grindelwald s\'évade comme il l\'avait promis et de façon spectaculaire. Réunissant de plus en plus de partisans, il est à l\'origine d\'attaque d\'humains normaux par des sorciers et seul celui qu\'il considérait autrefois comme un ami, Albus Dumbledore, semble capable de l\'arrêter. Mais Dumbledore va devoir faire appel au seul sorcier ayant déjoué les plans de Grindelwald auparavant : son ancien élève Norbert Dragonneau. L\'aventure qui les attend réunit Norbert avec Tina, Queenie et Jacob, mais cette mission va également tester la loyauté de chacun face aux nouveaux dangers qui se dressent sur leur chemin, dans un monde magique plus dangereux et divisé que jamais.', '', '9kC0guEMrYAXWN1sgNtY6ki1Gb8.jpg', 'qrtRKRzoNkf5vemO9tJ2Y4DrHxQ.jpg', 'iYAb5hiTW6E', 2, '2020-03-17 12:06:58', '2020-03-18 01:17:43'),
(28, 'Léon', 1, '1994-09-14', 103, 'Crime, Drame, Action', 82.25, 'Un tueur à gages répondant au nom de Léon prend sous son aile Mathilda, une petite fille de douze ans, seule rescapée du massacre de sa famille. Bientôt, Léon va faire de Mathilda une \"nettoyeuse\", comme lui. Et Mathilda pourra venger son petit frère...', '', 'gbw7Tm7SUyiTMhI2B8yHk4OcT9I.jpg', 'dXQ7HILRK1Tg33RT64JwbQI7Osh.jpg', 'KvORebZLsrI', 3, '2020-03-17 12:07:03', '2020-03-18 01:19:55'),
(29, 'Mia et le lion blanc', 1, '2018-12-26', 98, 'Aventure, Familial', 70.25, 'Mia a 11 ans quand elle noue une relation hors du commun avec Charlie, un lionceau blanc né dans la ferme d\'élevage de félins de ses parents en Afrique du Sud. Pendant trois ans, ils vont grandir ensemble et vivre une amitié fusionnelle. Quand Mia atteint l\'âge de 14 ans et que Charlie est devenu un magnifique lion adulte, elle découvre l’insoutenable vérité: son père a décidé de le vendre à des chasseurs de trophées. Désespérée, Mia n’a pas d’autre choix que de fuir avec Charlie pour le sauver.', '', 'lmrgXnG90DFZYeLrNhuEKUo7nKk.jpg', 'aiyXOx5rU7UqYbToD3yDqoFY1gD.jpg', 'AUbjSVTFsjc', 1, '2020-03-17 12:07:08', '2020-03-18 01:21:57'),
(30, 'L\'empereur de Paris', 1, '2018-12-19', 121, 'Histoire, Aventure, Crime', 62.25, 'Sous le règne de Napoléon, François Vidocq, le seul homme à s\'être échappé des plus grands bagnes du pays, est une légende des bas-fonds parisiens. Laissé pour mort après sa dernière évasion spectaculaire, l\'ex-bagnard essaye de se faire oublier sous les traits d\'un simple commerçant. Son passé le rattrape pourtant, et, après avoir été accusé d\'un meurtre qu\'il n\'a pas commis, il propose un marché au chef de la sûreté : il rejoint la police pour combattre la pègre, en échange de sa liberté. Malgré des résultats exceptionnels, il provoque l\'hostilité de ses confrères policiers et la fureur de la pègre qui a mis sa tête à prix...', '', 'oO7pMcnuMFN0kLZ6iVgsT65TPpV.jpg', '2E2bGNMDOEmTpgiwdI4w7G6mxli.jpg', 'a7p3urtMM8U', 3, '2020-03-17 12:07:13', '2020-03-18 01:23:34'),
(31, 'Astérix - Le secret de la potion magique', 1, '2018-05-12', 85, 'Animation, Familial, Comédie, Aventure', 71.25, 'À la suite d’une chute lors de la cueillette du gui, le druide Panoramix décide qu’il est temps d’assurer l’avenir du village. Accompagné d’Astérix et Obélix, il entreprend de parcourir le monde gaulois à la recherche d’un jeune druide talentueux à qui transmettre le Secret de la Potion Magique…', '', 'bMYpBVc0bS0ykEXSjRXIat6ooJf.jpg', '9cPMIuB2tv4IP0LbeNhrK5OyDy5.jpg', 'k8eAW7agoPA', 3, '2020-03-17 12:07:18', '2020-03-18 01:26:14'),
(32, 'La 7ème cible', 1, '1984-12-19', 108, 'Thriller, Drame, Romance', 61.75, 'Bastien Grimaldi, écrivain réputé, est agressé un soir dans la rue. Apparemment, l\'agression est gratuite. Mais les coups de téléphone répétés, les lettres anonymes s\'accumulent. Grimaldi mène sa propre enquête pour comprendre qui est à l\'origine de ces menaces.', '', 'w51PuoCXiJSYcW8vbqPWch0qLya.jpg', 'fI3nkliWkGUFRNla0Hf1iWEchWW.jpg', 'Nm9X58DWojY', 3, '2020-03-17 12:07:22', '2020-03-18 01:29:55'),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:07:33', NULL),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-03-17 12:08:51', NULL),
(35, 'Gemini Man', 3, '2019-10-02', 117, 'Action, Thriller', 56.75, 'Henry Brogan, un tueur professionnel, est soudainement pris pour cible et poursuivi par un mystérieux et jeune agent qui peut prédire chacun de ses mouvements.', '', 'uTALxjQU8e1lhmNjP9nnJ3t2pRU.jpg', 'sfW7GcOuwZFuCxVoU5ULlkiDJ7Q.jpg', 'nHcgIvOI548', 1, '2020-03-17 12:08:56', '2020-03-18 01:32:33'),
(36, 'Les évadés', 1, '1994-09-23', 140, 'Drame, Crime', 87.75, 'En 1947, Andy Dufresne, un jeune banquier, est condamné à la prison à vie pour le meurtre de sa femme et de son amant. Ayant beau clamer son innocence, il est emprisonné à Shawshank, le pénitencier le plus sévère de l’État du Maine. Il y fait la rencontre de Red, un noir désabusé, détenu depuis vingt ans. Commence alors une grande histoire d\'amitié entre les deux hommes...', '', '4P2ffljT2w5Kjvxj9S0wOoRlm0E.jpg', '65nAfGikljrOkfIrcfmrNTJTAXF.jpg', '45Sss4oNd5k', 1, '2020-03-17 12:09:01', '2020-03-18 01:34:18'),
(37, 'Shutter Island', 1, '2010-02-14', 138, 'Drame, Thriller, Mystère', 81.5, 'En 1954, le marshal Teddy Daniels et son coéquipier Chuck Aule sont envoyés enquêter sur l\'île de Shutter Island, dans un hôpital psychiatrique où sont internés de dangereux criminels. L\'une des patientes, Rachel Solando, a inexplicablement disparu. Comment la meurtrière a-t-elle pu sortir d\'une cellule fermée de l\'extérieur ? Le seul indice retrouvé dans la pièce est une feuille de papier sur laquelle on peut lire une suite de chiffres et de lettres sans signification apparente. Œuvre cohérente d\'une malade, ou cryptogramme ?', '', 'zumLrxQmbpqhGcjpYcmZ1YXCCvI.jpg', 'bcb3FYtLbuPgNYO4M1IY7rfeMal.jpg', 'Hz0ToXuAxag', 1, '2020-03-17 12:09:07', '2020-03-18 01:36:38'),
(38, 'Once Upon a Time… in Hollywood', 1, '2019-07-25', 162, 'Drame, Comédie, Thriller', 74, 'En 1969, Rick Dalton – star déclinante d\'une série télévisée de western – et Cliff Booth – sa doublure de toujours – assistent à la métamorphose artistique d\'un Hollywood qu\'ils ne reconnaissent plus du tout en essayant de relancer leurs carrières. De plus, en plein été, le 9 août, Hollywood sera à jamais marqué par un fait divers barbare : l\'assassinat de l\'actrice Sharon Tate enceinte de 8 mois, épouse du cinéaste franco-polonais Roman Polanski et voisine de Rick Dalton, ainsi que de ses amis dans sa villa, par les disciples du gourou Charles Manson.', '', '8j58iEBw9pOXFD2L0nt0ZXeHviB.jpg', 'er1S5nJyDSkmy7i2KkPMBjbwK8x.jpg', 'zPXvmJ7sgYA', 1, '2020-03-17 12:09:12', '2020-03-18 01:38:06'),
(39, 'Primal', 1, '2019-12-27', 97, 'Action', 48.25, 'Frank Walsh, chasseur pour les zoos fait une traversée avec plusieurs de ses \"prises\", parmi lesquelles un jaguar blanc très rare. Lorsqu\'un assassin politique s\'échappe de sa cabine et relâche les animaux captifs, c\'est la panique à bord ! Frank doit désormais sauver l\'équipage de ces dangereuses créatures et du criminel.', '', 'v0Air5GTsfgtjsnZyji2lH6r2b8.jpg', 'A3DD0R6vZ5SwD0qGKaU7HL5KVat.jpg', NULL, 3, '2020-03-17 12:09:23', '2020-03-18 01:40:46'),
(40, 'L\'intervention', 1, '2019-01-30', 98, 'Action, Drame, Guerre, Histoire', 66.25, 'Inspiré de faits réels. 1976 à Djibouti, dernière colonie française. Des terroristes prennent en otage un bus d’enfants de militaires français et s’enlisent à une centaine de mètres de la frontière avec la Somalie. La France envoie sur place pour débloquer la situation une unité de tireurs d\'élite de la Gendarmerie. Cette équipe, aussi hétéroclite qu’indisciplinée, va mener une opération à haut risque qui marquera la naissance du GIGN.', '', 'e7Nhv8nLTfX0osUU8BZLGCS8TUV.jpg', 'oW8MhnoFeZCIbisl44SKAS2gwVl.jpg', 'bEgVHVK2TUM', 3, '2020-03-17 12:09:28', '2020-03-18 01:42:29'),
(41, 'La chute du Président', 1, '2019-08-21', 122, 'Action, Thriller', 60.75, 'Victime d’un coup monté, Mike Banning, agent des services secrets, est accusé d’être le cerveau d’une tentative d’assassinat envers le président américain, Allan Trumbull. Poursuivi par le FBI, il va devoir combattre pour survivre et trouver l’identité de celui qui menace la vie du président…', '', '50Tr3TMGYv5tPPChkno5Ef1qepm.jpg', '7uCHvw3j0G5ns5X2rWuU1BXRmoJ.jpg', 'j6PUJVc_rI8', 3, '2020-03-17 12:09:32', '2020-03-18 01:44:11'),
(42, 'Parasite', 1, '2019-05-30', 135, 'Comédie, Thriller, Drame', 86, 'Toute la famille de Ki-taek est au chômage. Elle s’intéresse particulièrement au train de vie de la richissime famille Park. Mais un incident se produit et les 2 familles se retrouvent mêlées, sans le savoir, à une bien étrange histoire…', '', 'x23Fqkt00uqV2TzfSiB60hrc3HY.jpg', 'TU9NIjwzjoKPwQHoHshkFcQUCG.jpg', '3LYiLq4EHjA', 4, '2020-03-17 12:09:39', '2020-03-18 13:14:19'),
(43, 'Les filles du docteur March', 1, '2019-12-25', 135, 'Drame, Romance', 79.75, 'Une nouvelle adaptation du classique de Louisa May Alcott, narrant l\'histoire de quatre filles de la classe moyenne durant la Guerre de Sécession.', '', 'A1OAKgItnKEilZkInZxUiKADhmZ.jpg', '3uTxPIdVEXxHpsHOHdJC24QebBV.jpg', 'hrT638GKNrU', 2, '2020-03-17 12:09:45', '2020-03-18 13:15:53'),
(44, '1917', 1, '2019-12-25', 115, 'Guerre, Drame', 82.25, 'Pris dans la tourmente de la Première Guerre Mondiale, Schofield et Blake, deux jeunes soldats britanniques, se voient assigner une mission à proprement parler impossible. Porteurs d’un message qui pourrait empêcher une attaque dévastatrice et la mort de centaines de soldats, dont le frère de Blake, ils se lancent dans une véritable course contre la montre, derrière les lignes ennemies.', '', 'iZf0KyrE25z1sage4SYFLCCrMi9.jpg', 'cqa3sa4c4jevgnEJwq3CMF8UfTG.jpg', 'VlYtMvT6BYs', 3, '2020-03-17 12:09:49', '2020-03-18 13:17:01'),
(45, 'Jojo Rabbit', 3, '2019-10-18', 108, 'Comédie, Guerre, Drame', 80.5, 'Jojo est un petit allemand solitaire. Sa vision du monde est mise à l’épreuve quand il découvre que sa mère cache une jeune fille juive dans leur grenier. Avec la seule aide de son ami aussi grotesque qu\'imaginaire, Adolf Hitler, Jojo va devoir faire face à son nationalisme aveugle.', '', '7GsM4mtM0worCtIVeiQt28HieeN.jpg', 'agoBZfL1q5G79SD0npArSlJn8BH.jpg', '_d6Q4-H1_ds', 2, '2020-03-17 12:09:58', '2020-03-18 13:18:10'),
(46, 'Le Mans 66', 3, '2019-11-13', 152, 'Drame, Action', 80.25, 'Relate l’histoire vraie qui a conduit l’ingénieur automobile visionnaire américain Caroll Shelby à faire équipe avec le pilote de course britannique surdoué Ken Miles. Bravant l’ordre établi, défiant les lois de la physique et luttant contre leurs propres démons, les deux hommes n’avaient qu’un seul but: construire pour le compte de Ford Motor Company un bolide révolutionnaire capable de renverser la suprématie de l’écurie d’Enzo Ferrari sur le mythique circuit des 24 heures du Mans en 1966…', '', '8yyRujXGSNCa3yrM3qoLZXUW3WY.jpg', 'n3UanIvmnBlH531pykuzNs4LbH6.jpg', 'maxybmxQuTE', 3, '2020-03-17 12:10:02', '2020-03-18 13:19:22'),
(47, 'Le voyage du Dr Dolittle', 1, '2020-01-01', 106, 'Comédie, Fantastique, Aventure, Familial', 59.5, 'Après la perte de sa femme sept ans plus tôt, l’excentrique Dr. John Dolittle, célèbre docteur et vétérinaire de l’Angleterre de la Reine Victoria s’isole derrière les murs de son manoir, avec pour seule compagnie sa ménagerie d’animaux exotiques.  Mais quand la jeune Reine tombe gravement malade, Dr. Dolittle, d’abord réticent, se voit forcé de lever les voiles vers une île mythique dans une épique aventure à la recherche d’un remède à la maladie.', '', 'dSFLgSQffeAgJWhVlH3HBTWVPYe.jpg', 'lG802rseTZcN9mtLsQPVfApEVzM.jpg', '1Kukjr0u5lI', 2, '2020-03-17 12:10:06', '2020-03-18 13:20:50'),
(48, 'Colonia', 1, '2016-02-12', 110, 'Drame, Romance, Thriller, Histoire', 74.25, 'Chili, 1973. Le Général Pinochet s’empare du pouvoir par la force. Les opposants au coup d’Etat descendent dans la rue. Parmi les manifestants, un jeune couple, Daniel et Lena. Daniel est arrêté par la nouvelle police politique. Il est conduit dans un camp secret, caché dans un lieu reculé au sein d’une secte dirigée par un ancien nazi. Une prison dont personne n’est jamais sorti. Pour retrouver son amant, Lena va pourtant rentrer dans la Colonia Dignidad.', '', 'we8KIRBJuHM2hxbM92ZJoGhogbq.jpg', '3Sfjr8UCYrbtDubyDA0MCFjDccI.jpg', '170825698', 2, '2020-03-17 12:10:11', '2020-03-18 01:48:32'),
(49, 'Miss Peregrine et les enfants particuliers', 3, '2016-09-28', 127, 'Drame, Fantastique, Aventure, Familial', 68.75, 'À la mort de son grand-père, Jacob découvre l\'existence d\'un monde mystérieux. Plusieurs indices le mènent dans ce lieu magique : la Maison de Miss Peregrine pour Enfants Particuliers. Mais le mystère et le danger s\'amplifient quand il apprend à connaître les résidents, leurs étranges pouvoirs... et leurs puissants ennemis. Finalement, Jacob découvre que seule sa propre « particularité » peut sauver ses nouveaux amis.', '', '47LYbEI38IqjtePmEZiOTyw8V06.jpg', 'iiWLJMRaEjaBf4WFmKAktn0IfbF.jpg', 'n2W8JddwcuI', 4, '2020-03-17 12:10:16', '2020-03-18 01:50:45'),
(50, 'Je vais bien, ne t\'en fais pas', 1, '2006-09-06', 96, 'Drame', 73, 'Comme elle rentre de vacances, Lili, 19 ans, apprend par ses parents que Loïc, son frère jumeau, suite à une violente dispute avec son père, a quitté la maison. Loïc ne lui donnant pas de nouvelles, Lili finit par se persuader qu\'il lui est arrivé quelque chose et part à sa recherche. Ce qu\'elle va découvrir dépasse l\'entendement.', '', '4XdZcs24ht6bz3n1ItxGVJ1jUV.jpg', 'bb280OO3Omgn8q5iM5xTbI06dUo.jpg', 'PEgJhjd0mqs', 4, '2020-03-17 12:10:20', '2020-03-18 01:52:12'),
(51, 'Florence Foresti : Épilogue', 1, '2019-12-18', 87, 'Comédie', 62.75, 'Après trois ans d\'absence, Florence Foresti remonte sur scène avec ce nouveau spectacle qui décline les travers de la société et porte un regard amusé sur ses contemporains. L\'humoriste, quadragénaire, évoque également la manière dont elle vit le décalage générationnel avec les jeunes. Servi par des textes percutants ce stand up épingle les éléments de la vie que nous ne remarquons plus : les réseaux sociaux, les smartphones, l\'amour, les enfants, l\'éducation ou encore l\'école... Avec humour et nostalgie elle raconte l\'épilogue d\'une jeunesse, d\'une époque peut-être plus simple.', '', 'j2QDgRjPfWt9RolzZrIMndX915Z.jpg', 'oxxJpwl56d5x6zK9clciV9h0PSs.jpg', 'EklH-MVPgMc', 4, '2020-03-17 12:10:24', '2020-03-18 13:24:06'),
(52, 'alien', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2020-03-18 14:15:41', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Persons`
--

CREATE TABLE `Persons` (
  `PersonID` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `BirthPlace` varchar(255) DEFAULT NULL,
  `DeathDate` date DEFAULT NULL,
  `DeathPlace` varchar(255) DEFAULT NULL,
  `Biography` text,
  `Awards` varchar(255) DEFAULT NULL,
  `PicturePath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Ratings`
--

CREATE TABLE `Ratings` (
  `MovieRatingID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Ratings`
--

INSERT INTO `Ratings` (`MovieRatingID`, `Name`, `Description`) VALUES
(1, 'Tous publics', 'Le film ou le programme ne comporte aucune scène pouvant nuire au jeune public, il peut donc être vu par tous les publics.'),
(2, 'Interdit aux moins de 10 ans', 'Le film ou le programme est un reflet de la télévision, certaines scènes peuvent heurter la sensibilité des moins de 10 ans.'),
(3, 'Interdit aux moins de 12 ans', 'Le film ou le programme comporte un scénario qui recourt aux scènes à caractère sexuel, à la sexualité et à la violence physique ou psychologique qui peut choquer et troubler les moins de 12 ans.'),
(4, 'Interdit aux moins de 16 ans', 'Le film ou le programme est à caractère érotique ou de grande violence pouvant nuire aux moins de 16 ans.'),
(5, 'Interdit aux moins de 18 ans', 'Le film ou le programme est à caractère pornographique ou de violence extrême et réservés à un public adulte averti, pouvant nuire aux moins de 18 ans.');

-- --------------------------------------------------------

--
-- Structure de la table `Roles`
--

CREATE TABLE `Roles` (
  `PersonID` int(11) NOT NULL,
  `TypeID` int(11) NOT NULL,
  `ContentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `SeenMovies`
--

CREATE TABLE `SeenMovies` (
  `MovieID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `SeenSeries`
--

CREATE TABLE `SeenSeries` (
  `SeriesID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Series`
--

CREATE TABLE `Series` (
  `SeriesID` int(11) NOT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `Genres` varchar(255) DEFAULT NULL,
  `Grade` int(11) DEFAULT NULL,
  `Synopsis` text,
  `Review` text,
  `PosterPath` varchar(255) DEFAULT NULL,
  `BackdropPath` varchar(255) DEFAULT NULL,
  `TrailerPath` varchar(255) DEFAULT NULL,
  `Requester` int(11) DEFAULT NULL,
  `RequestDate` datetime DEFAULT NULL,
  `AddDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Series`
--

INSERT INTO `Series` (`SeriesID`, `Title`, `Rating`, `StartDate`, `EndDate`, `Genres`, `Grade`, `Synopsis`, `Review`, `PosterPath`, `BackdropPath`, `TrailerPath`, `Requester`, `RequestDate`, `AddDate`) VALUES
(1, 'Game of Thrones', 4, '2011-04-17', '2019-05-19', 'Science-Fiction & Fantastique, Drame', 88, 'Il y a très longtemps, à une époque oubliée, une force a détruit l\'équilibre des saisons. Dans un pays où l\'été peut durer plusieurs années et l\'hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes. La confrérie de la Garde de Nuit, protégeant le Royaume de toute créature pouvant provenir d\'au-delà du Mur protecteur, n\'a plus les ressources nécessaires pour assurer la sécurité de tous. Après un été de dix années, un hiver rigoureux s\'abat sur le Royaume avec la promesse d\'un avenir des plus sombres. Pendant ce temps, complots et rivalités se jouent sur le continent pour s\'emparer du Trône de fer, le symbole du pouvoir absolu.', '', 'gwPSoYUHAKmdyVywgLpKKA4BjRr.jpg', 'mUkuc2wyV9dHLG0D0Loaw5pO2s8.jpg', 'aAF12LNAeNI', 1, '2020-03-15 18:06:44', '2020-03-18 00:07:26'),
(2, 'Breaking Bad', 4, '2008-01-20', '2013-09-29', 'Drame', 90, 'Un professeur de chimie de lycée mourant d\'un cancer fait équipe avec un ancien élève pour assurer l\'avenir de sa famille en fabriquant et en vendant de la méthamphétamine en cristaux.', '', 'ggFHVNu6YYI5L9pCfOacjizRGt.jpg', 'hbgPoI0GBrXJfGjYNV2fMQU0xou.jpg', 'CoWsuFdqeYE', 1, '2020-03-15 18:06:44', '2020-03-18 00:09:49'),
(3, 'The Walking Dead', 4, '2010-10-31', '2020-03-15', 'Action & Adventure, Drame, Science-Fiction & Fantastique', 78, 'Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe d\'hommes et de femmes mené par l\'officier Rick Grimes tente de survivre. Ensemble, ils vont devoir tant bien que mal faire face à ce nouveau monde.', '', '5l10EjdgPxu8Gbl5Ww6SWkVQH6T.jpg', 'wXXaPMgrv96NkH8KD1TMdS2d7iq.jpg', 'AbtiqJGhWyY', 1, '2020-03-17 14:58:56', '2020-03-18 00:04:39'),
(4, 'Legion', 1, '2017-02-08', '2019-08-12', 'Action & Adventure, Science-Fiction & Fantastique', 79, 'Un homme diagnostiqué schizophrène rencontre une patiente qui va changer sa vie : et si derrière ses troubles se cachaient des puissants pouvoirs ?', '', 'vT0Zsbm4GWd7llNjgWEtwY0CqOv.jpg', '87eP7ITTrOWvkA4EqCuoRdyjzLy.jpg', 'KksjK80NibU', 1, '2020-03-17 15:01:21', '2020-03-18 12:45:32'),
(5, 'Rick et Morty', 3, '2013-12-02', '2019-12-15', 'Animation, Comédie, Science-Fiction & Fantastique', 88, 'Rick est un scientifique âgé et déséquilibré qui a récemment renoué avec sa famille. Il passe le plus clair de son temps à entraîner son petit-fils Morty dans des aventures extraordinaires et dangereuses, à travers l\'espace et dans des univers parallèles. Ajoutés à la vie de famille déjà instable de Morty, ces événements n\'amènent qu\'un surcroît de stress pour Morty, à la maison et au collège.', '', '7SzW3al4H2kr9eLvENpcLMzgUvm.jpg', 'mzzHr6g1yvZ05Mc7hNj3tUdy2bM.jpg', 'Jnllmv3wZsc', 1, '2020-03-17 15:03:43', '2020-03-18 12:48:08'),
(6, 'The Big Bang Theory', 3, '2007-09-24', '2019-05-16', 'Comédie', 75, 'Leonard et Sheldon pourraient vous dire tout ce que vous voudriez savoir à propos de la physique quantique. Mais ils seraient bien incapables de vous expliquer quoi que ce soit sur la vie \"réelle\", le quotidien ou les relations humaines... Mais tout va changer avec l\'arrivée de la superbe Penny, leur voisine. Ce petit bout de femme, actrice à ses heures et serveuse pour le beurre, va devenir leur professeur de vie !', '', 'ooBGRQBdbGzBxAVfExiO8r7kloA.jpg', 'ngoiHQul4QetfA62SdmZZOdDFAP.jpg', 'RJknrSi3eUQ', 2, '2020-03-17 15:05:04', '2020-03-18 12:51:05'),
(7, 'The Last Kingdom', 1, '2015-10-10', '2018-11-19', 'Action & Adventure, Drame', 80, 'Tandis qu\'Alfred le Grand défend son royaume contre l\'envahisseur viking, Uhtred, né saxon, mais élevé en Viking, cherche à récupérer le rang qui lui revient de droit.', '', '52fBNs8N0xZXHcCm1MDs0nvLQKK.jpg', 'QbtctI8EzlhsyFDMUMyG3fli8B.jpg', '4u4_uJhsiiI', 2, '2020-03-17 15:10:42', '2020-03-18 12:53:26'),
(8, 'Mars', 1, '2016-11-14', '2018-12-17', 'Documentaire, Science-Fiction & Fantastique, Action & Adventure', 72, 'Le vaisseau spatial Daedalus a prévu d\'atterrir sur Mars au mois de novembre de l\'an 2033, comprenant l\'équipage de six astronautes qui va effectuer sa première tentative afin d\'établir une colonie permanente sur la Planète Rouge.', '', 'nmr6NwbmyWX6gKmFKtsySMlgwE7.jpg', '1jDtLLBlxqh53v8P0NpjqQedPEt.jpg', 'BU3ZYSw5l0E', 3, '2020-03-17 15:23:12', '2020-03-18 12:55:49'),
(9, 'The Witcher', 1, '2019-12-20', '2019-12-20', 'Drame, Action & Adventure', 78, 'Le sorcier Geralt, un chasseur de monstres mutant, se bat pour trouver sa place dans un monde où les humains se révèlent souvent plus vicieux que les bêtes.', '', 'zrPpUlehQaBf8YX2NrVrKK8IEpf.jpg', 'bKETHQDD3QoIRTMOP4dfKwisL3g.jpg', 'R381qGPN2Ik', 2, '2020-03-17 15:24:41', '2020-03-18 12:57:33'),
(10, 'Friends', 3, '1994-09-22', '2004-05-06', 'Comédie, Drame', 82, 'Les péripéties de 6 jeunes newyorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori...', '', '7buCWBTpiPrCF5Lt023dSC60rgS.jpg', 'efiX8iir6GEBWCD0uCFIi5NAyYA.jpg', NULL, 5, '2020-03-17 15:31:11', '2020-03-18 12:59:14'),
(11, 'Broadchurch', 1, '2013-03-04', '2017-04-17', 'Crime, Drame, Mystère', 83, 'L’assassinat d\'un jeune garçon, Danny Latimer, met sous le feu des projecteurs la communauté de Broadchurch, petite ville côtière du comté de Dorset. L\'inspecteur principal Alec Hardy, récemment nommé à son poste, est chargé de l\'enquête avec le lieutenant Ellie Miller, proche de la famille Latimer.', '', 'f5gQRyTZ3v4asugU2F5HXE2FIDg.jpg', 'zo75wtgVsbh8YoI6sYN2thwFFJm.jpg', NULL, 4, '2020-03-18 11:47:56', '2020-03-18 13:00:34'),
(12, 'Stranger Things', 3, '2016-07-15', '2019-07-04', 'Mystère, Science-Fiction & Fantastique, Drame', 85, 'Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.', '', 'esKFbCWAGyUUNshT5HE5BIpvbcL.jpg', '56v2KjBlU4XaOv9rVYEQypROD7P.jpg', 'wbxXagCMIbU', 4, '2020-03-18 11:48:02', '2020-03-18 13:02:04'),
(13, 'Sex Education', 1, '2019-01-11', '2020-01-17', 'Comédie, Drame', 80, 'Le timide Otis connaît pourtant tout sur le sexe... grâce à sa maman thérapeute. La rebelle Maeve le décide donc à ouvrir un cabinet de conseil clandestin au lycée.', '', '4Bph0hhnDH6dpc0SZIV522bLm4P.jpg', 'u23G9KZregWHs1use6ir1fX27gl.jpg', 'uX2i9sLP39U', 7, '2020-03-18 13:04:11', '2020-03-18 13:06:40'),
(14, 'The Mandalorian', 3, '2019-11-12', '2019-12-27', 'Science-Fiction & Fantastique, Action & Adventure', 82, 'Après la chute de l\'Empire et avant l\'émergence du Premier Ordre. Nous suivons les voyages d\'un manieur de pistolet solitaire dans les contrées extérieures de la galaxie, loin de l\'autorité de la Nouvelle République...', '', 'BbNvKCuEF4SRzFXR16aK6ISFtR.jpg', 'o7qi2v4uWQ8bZ1tW3KI0Ztn2epk.jpg', 'RmVbyWvyx3U', 7, '2020-03-18 13:04:23', '2020-03-18 13:09:26'),
(15, 'american horror story', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2020-03-18 14:14:36', NULL),
(16, 'friends', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '2020-03-18 14:17:54', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `LikedMovies`
--
ALTER TABLE `LikedMovies`
  ADD PRIMARY KEY (`MovieID`,`UserID`);

--
-- Index pour la table `LikedSeries`
--
ALTER TABLE `LikedSeries`
  ADD PRIMARY KEY (`SeriesID`,`UserID`);

--
-- Index pour la table `Movies`
--
ALTER TABLE `Movies`
  ADD PRIMARY KEY (`MovieID`);

--
-- Index pour la table `Persons`
--
ALTER TABLE `Persons`
  ADD PRIMARY KEY (`PersonID`);

--
-- Index pour la table `Ratings`
--
ALTER TABLE `Ratings`
  ADD PRIMARY KEY (`MovieRatingID`);

--
-- Index pour la table `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`PersonID`,`TypeID`,`ContentID`);

--
-- Index pour la table `SeenMovies`
--
ALTER TABLE `SeenMovies`
  ADD PRIMARY KEY (`MovieID`,`UserID`);

--
-- Index pour la table `SeenSeries`
--
ALTER TABLE `SeenSeries`
  ADD PRIMARY KEY (`SeriesID`,`UserID`);

--
-- Index pour la table `Series`
--
ALTER TABLE `Series`
  ADD PRIMARY KEY (`SeriesID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Movies`
--
ALTER TABLE `Movies`
  MODIFY `MovieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT pour la table `Persons`
--
ALTER TABLE `Persons`
  MODIFY `PersonID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Ratings`
--
ALTER TABLE `Ratings`
  MODIFY `MovieRatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `Series`
--
ALTER TABLE `Series`
  MODIFY `SeriesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
