-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 14 jan. 2020 à 09:54
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Base de données :  `lacaze_aux_sottises`
--
-- --------------------------------------------------------
--
-- Structure de la table `company`
--
DROP TABLE IF EXISTS `company`;

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `updated_at` datetime DEFAULT NULL,
  `is_in_diffusion` tinyint(1) NOT NULL,
  `is_in_creation` tinyint(1) NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `audience` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `more_infos` longtext COLLATE utf8mb4_unicode_ci,
  `duration` int(11) NOT NULL,
  `show_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `image_dimensions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 21 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `company`
--
INSERT INTO
  `company` (
    `id`,
    `name`,
    `description`,
    `updated_at`,
    `is_in_diffusion`,
    `is_in_creation`,
    `website`,
    `video_link`,
    `theme`,
    `audience`,
    `more_infos`,
    `duration`,
    `show_title`,
    `image_name`,
    `image_original_name`,
    `image_mime_type`,
    `image_size`,
    `image_dimensions`
  )
VALUES
  (
    1,
    'Thomas',
    'Asperiores accusamus nihil repellat vero omnis voluptates id amet. Et suscipit qui recusandae totam nulla quam. Voluptatem cupiditate sed natus debitis voluptas. Laudantium sit repudiandae esse perspiciatis dignissimos error et itaque.',
    NULL,
    1,
    1,
    'payet.net',
    'ledoux.com',
    'soluta',
    'Occaecati debitis et saepe.',
    'Sint dolorem delectus enim ipsum inventore sed libero et velit qui suscipit a deserunt laudantium quibusdam enim nostrum soluta qui.',
    24,
    'Tempora velit porro ut velit.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    2,
    'Coulon et Fils',
    'Cumque est ducimus temporibus modi saepe architecto unde. Dicta eveniet exercitationem aut porro sed magni. Sit vitae voluptas sint non voluptates ut.',
    NULL,
    1,
    1,
    'chevalier.net',
    'labbe.net',
    'laborum',
    'Officia id corporis incidunt saepe.',
    'Esse hic eligendi quos culpa ut ab voluptas sed a nam et sint autem inventore aut.',
    105,
    'Quos qui illo error nihil.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    3,
    'Perez S.A.',
    'Ut eum nisi molestiae quidem ut sunt. Quidem est accusamus aut nemo. Est placeat rerum ut et enim ex. Facere sunt quia delectus aut nam et eum.',
    NULL,
    0,
    0,
    'guillou.net',
    'mercier.fr',
    'veritatis',
    'Esse veritatis voluptate.',
    'Possimus omnis aut incidunt sunt cumque asperiores incidunt iure sequi cum culpa rem aut.',
    62,
    'Fugit repellendus illo.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    4,
    'Marchal',
    'Architecto fugiat nemo omnis consequatur recusandae qui cupiditate. Quod veritatis vel optio provident. Incidunt magnam molestias et quibusdam et ab quo voluptatum. Ipsum voluptatibus est accusantium eveniet. Atque possimus aut dolores quis totam incidunt ducimus aperiam.',
    NULL,
    1,
    0,
    'gautier.fr',
    'gallet.com',
    'minima',
    'Similique ut culpa natus.',
    'Reiciendis sit et nihil ut porro amet laborum iure molestiae et dolore quaerat molestiae.',
    24,
    'Est quia assumenda.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    5,
    'Vincent SA',
    'Numquam tempora et quo aperiam natus ut doloribus. Quasi impedit aperiam ea similique. Sed architecto quod nulla maxime. Quibusdam inventore esse harum accusantium rerum nulla voluptatem. Optio quos sed autem voluptatibus eum aut nesciunt.',
    NULL,
    0,
    0,
    'brun.com',
    'pages.com',
    'sit',
    'Similique ut voluptatem.',
    'Perferendis eveniet quam vero fuga corrupti omnis temporibus maxime sint suscipit laudantium quod magni non.',
    79,
    'Sit nisi recusandae eaque molestias.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    6,
    'Aubert S.A.',
    'Quaerat ut aut at consequatur non. In cupiditate voluptas molestiae fuga quod cum. Qui quaerat cupiditate incidunt id sunt dolorem veritatis voluptatem. Molestiae est ut iure. Ab in hic molestiae odio sed vitae maiores.',
    NULL,
    1,
    0,
    'dossantos.com',
    'leleu.org',
    'dolorem',
    'Ducimus omnis molestiae consequatur sint.',
    'Est qui doloremque aperiam qui rerum accusamus beatae dolores enim et doloribus voluptatibus perspiciatis.',
    56,
    'Beatae reprehenderit exercitationem corrupti.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    7,
    'Grenier',
    'Magni rerum consequatur laudantium nisi quo earum. Esse eveniet debitis omnis voluptatem voluptatem et. Praesentium et praesentium est. Molestiae porro consequuntur quos hic.',
    NULL,
    1,
    0,
    'francois.net',
    'diallo.com',
    'similique',
    'Et ipsam omnis saepe.',
    'In perspiciatis sit consectetur temporibus voluptate laborum hic hic reiciendis culpa rerum.',
    41,
    'Nobis doloribus illo velit eius.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    8,
    'Bonneau SAS',
    'Et reprehenderit nesciunt eum. In esse et ut quis. Voluptate ullam placeat non ratione eaque.',
    NULL,
    1,
    0,
    'ferrand.com',
    'lebreton.fr',
    'tempore',
    'Totam iste quidem eum.',
    'Velit voluptatibus in laudantium voluptatem officiis vel dignissimos et dolorem doloremque quam.',
    93,
    'Quia optio explicabo et repellat.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    9,
    'Picard Ferrand et Fils',
    'Aut numquam laboriosam sint enim reiciendis quod ullam at. Non eos sed amet sunt vitae enim. Occaecati natus assumenda reiciendis similique et laudantium vel nisi.',
    NULL,
    1,
    1,
    'perret.com',
    'berger.fr',
    'beatae',
    'Quae sit veniam vel eos.',
    'Et est nisi iusto amet neque deleniti totam aut nisi non omnis voluptatem velit nesciunt eligendi eos sint ut voluptates.',
    95,
    'Itaque est et nihil.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    10,
    'Vidal',
    'Rem est est alias neque. Nihil esse repudiandae pariatur reprehenderit assumenda. Consequatur fugit ad iste minus ullam quidem. Vero soluta nostrum ea dolores doloremque fuga labore.',
    NULL,
    0,
    1,
    'dubois.com',
    'dacosta.com',
    'omnis',
    'Enim quia reprehenderit magni fugiat.',
    'Officiis velit alias et et quis quae distinctio ratione quis voluptates nulla totam eos.',
    90,
    'Et molestias hic minus et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    11,
    'Huet',
    'Tempora repellat corporis excepturi sint dolores quaerat. Quia nisi accusantium natus voluptatem. Explicabo corporis eligendi ut ut sapiente ut qui quidem.',
    NULL,
    1,
    1,
    'gerard.net',
    'coste.net',
    'aut',
    'Sed alias asperiores.',
    'Deserunt omnis inventore mollitia unde id in id porro molestiae in maxime sint doloremque similique aut.',
    117,
    'Optio amet velit.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    12,
    'Lefort SA',
    'Sit facere cupiditate doloremque odio ad asperiores quaerat. Accusamus sint dolorem earum ut.',
    NULL,
    1,
    0,
    'menard.fr',
    'normand.org',
    'delectus',
    'Accusantium autem suscipit.',
    'Et et dolorum quos aliquam delectus accusantium quidem ut eius a corrupti totam.',
    73,
    'Facilis molestias quo omnis minima illo.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    13,
    'De Oliveira Hoarau S.A.S.',
    'Iste similique aut tempore. Et libero explicabo quia sed ea aperiam unde. Tempora beatae neque eum. Molestiae et laboriosam dolor odit omnis vel excepturi.',
    NULL,
    1,
    0,
    'paris.fr',
    'morvan.com',
    'itaque',
    'Ea accusantium temporibus.',
    'Ad est et et cum eius voluptas numquam quam occaecati culpa aut in laudantium omnis et aut laborum.',
    31,
    'Quia quas beatae et nam.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    14,
    'Marie',
    'Aliquid rerum autem qui est velit excepturi et necessitatibus. Doloremque iusto quibusdam fuga beatae voluptas iure rerum voluptas. Eius commodi odio ut aliquid et sit enim. In minus aliquid repudiandae qui voluptatem distinctio.',
    NULL,
    0,
    0,
    'letellier.org',
    'maury.fr',
    'vel',
    'Quia recusandae qui.',
    'Quo voluptas totam asperiores ab tenetur voluptatem repudiandae reiciendis cum accusamus ut et nobis iste accusantium quaerat nostrum.',
    110,
    'Officiis eos suscipit facilis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    15,
    'Martins S.A.S.',
    'Nihil aliquid eos fugit. Quaerat quibusdam alias omnis accusamus aut dolores. Itaque doloribus qui dicta eligendi quae recusandae. Quo beatae deleniti quia molestiae alias quo quis.',
    NULL,
    1,
    0,
    'leroy.fr',
    'petit.net',
    'in',
    'Fugiat dolores placeat.',
    'Nesciunt architecto quas ex similique consequatur nisi fuga dolores aut velit illo illum sint.',
    110,
    'Qui ea sit.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    16,
    'Baudry et Fils',
    'Non et et et fugit. Excepturi enim velit qui nam nesciunt non dolore quis. Eius et et omnis.',
    NULL,
    1,
    0,
    'boulay.com',
    'maury.fr',
    'vel',
    'Explicabo inventore quam suscipit qui.',
    'Eveniet dolorem voluptatem est similique tenetur aut sit aliquam provident et voluptatem eveniet consequatur sit impedit sint nam perferendis sit.',
    73,
    'Pariatur non ea.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    17,
    'Lesage Launay SAS',
    'Ad rerum perferendis fugiat et facere. Et quod velit velit ut rem repellendus ut. Laudantium consequuntur aut et. Quas ut est in reprehenderit reiciendis accusamus.',
    NULL,
    1,
    1,
    'leclercq.com',
    'pons.fr',
    'nostrum',
    'Aut molestiae sapiente.',
    'Consequatur numquam tempore similique ut debitis consequatur facere dolorum doloremque quasi vero nobis error fuga ut perspiciatis quia.',
    18,
    'Quia et mollitia deleniti qui.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    18,
    'Foucher',
    'Ut quis quisquam consequatur asperiores voluptatem magnam nostrum. Corrupti voluptatem molestiae cupiditate rerum ratione. Repellendus ducimus nulla voluptatem aperiam ipsa eius. Adipisci reiciendis voluptas doloremque esse dolor qui illo placeat.',
    NULL,
    0,
    0,
    'schneider.fr',
    'leclerc.com',
    'ut',
    'Deserunt provident natus ipsam.',
    'Est ipsam quia reprehenderit sint mollitia sed facere qui sit delectus ad iusto molestias iusto autem laboriosam nulla earum eius.',
    32,
    'Voluptatem at enim tempora voluptas.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    19,
    'Da Costa Humbert et Fils',
    'Rerum delectus dolorum voluptas cupiditate aut consequatur aut ullam. Ea voluptatem aut cum vitae nostrum non maiores. Omnis aut quos ut ad est quidem eum rerum. Laboriosam ea porro blanditiis eos enim non aut.',
    NULL,
    1,
    0,
    'evrard.fr',
    'simon.com',
    'fuga',
    'Veniam enim.',
    'Voluptas assumenda dolore explicabo nisi a aut architecto et aut.',
    113,
    'Sunt eligendi sapiente et et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    20,
    'Le Gall SA',
    'Iste repellat provident qui debitis nisi ad. Magni nihil voluptatem magnam. Impedit recusandae omnis consequatur ut repellendus.',
    NULL,
    0,
    0,
    'besson.fr',
    'lefebvre.com',
    'magnam',
    'Sed velit aut.',
    'Quod cupiditate culpa nisi eos cupiditate quibusdam eveniet eveniet provident quas omnis voluptatem quia soluta recusandae id quo aut.',
    55,
    'Nihil reprehenderit non ut rem esse.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `event`
--
DROP TABLE IF EXISTS `event`;

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `starting_date` date DEFAULT NULL,
  `ending_date` date DEFAULT NULL,
  `hours` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `program_pdf_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_pdf_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_pdf_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_pdf_size` int(11) DEFAULT NULL,
  `program_pdf_dimensions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  `program_image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_image_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_image_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_image_size` int(11) DEFAULT NULL,
  `program_image_dimensions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 8 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--
INSERT INTO
  `event` (
    `id`,
    `name`,
    `description`,
    `starting_date`,
    `ending_date`,
    `hours`,
    `updated_at`,
    `program_pdf_name`,
    `program_pdf_original_name`,
    `program_pdf_mime_type`,
    `program_pdf_size`,
    `program_pdf_dimensions`,
    `program_image_name`,
    `program_image_original_name`,
    `program_image_mime_type`,
    `program_image_size`,
    `program_image_dimensions`
  )
VALUES
  (
    1,
    'sit',
    'Sint velit rerum autem quia. Ducimus odio fuga vitae expedita. Vero animi fugiat corporis.',
    '2020-02-23',
    '2020-02-23',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    2,
    'et',
    'Qui sit rem consequatur. Incidunt et sunt tempora sunt aliquam mollitia id repudiandae. Doloremque placeat ut esse. Aut ratione cumque commodi.',
    '2020-06-09',
    '2020-06-09',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    3,
    'animi',
    'Est quam provident vel tenetur asperiores. Ipsa dolorum optio odio aspernatur qui dolor. Suscipit ipsum veniam neque omnis dolor. Molestiae quia voluptatem quisquam sed.',
    '2020-01-17',
    '2020-01-17',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    4,
    'vero',
    'Quasi corporis rerum quo ut accusantium omnis quibusdam. Aut culpa dolores consectetur quod. Quisquam aut cupiditate aperiam. Adipisci veritatis vel voluptas voluptatem cumque sed. Odit excepturi accusamus vel quae.',
    '2020-07-16',
    '2020-07-16',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    5,
    'ut',
    'Id consequatur accusantium quia. Minus voluptates dignissimos est officiis est repudiandae est. Odio inventore sed ipsum omnis maiores.',
    '2020-05-18',
    '2020-05-18',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    6,
    'inventore',
    'Exercitationem nisi quaerat numquam voluptatem harum. Quia et aliquid neque voluptas est totam.',
    '2020-06-22',
    '2020-06-22',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    7,
    'est',
    'Minus officia quis consequuntur voluptates non quasi minima. Repudiandae laborum dolor quasi totam qui ipsam iusto. Inventore molestias amet aut qui nihil.',
    '2020-10-11',
    '2020-10-11',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `front_page`
--
DROP TABLE IF EXISTS `front_page`;

CREATE TABLE IF NOT EXISTS `front_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2CDA0C4C8D0C9323` (`tab_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 29 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `front_page`
--
INSERT INTO
  `front_page` (`id`, `tab_id`, `name`, `page_slug`)
VALUES
  (1, 1, 'presentation', 'association/presentation'),
  (
    2,
    1,
    'projets-pluriels',
    'association/projets-pluriels'
  ),
  (
    3,
    1,
    'coopération-territoriale',
    'association/coopération-territoriale'
  ),
  (4, 1, 'équipe', 'association/équipe'),
  (5, 1, 'adhésion', 'association/adhésion'),
  (6, 2, 'programmation', 'saison/programmation'),
  (
    7,
    2,
    'cies-en-diffusion',
    'saison/cies-en-diffusion'
  ),
  (
    8,
    2,
    'cies-en-création',
    'saison/cies-en-création'
  ),
  (
    9,
    2,
    'action-culturelles',
    'saison/action-culturelles'
  ),
  (10, 3, 'présentation', 'festival/présentation'),
  (11, 3, 'programation', 'festival/programation'),
  (
    12,
    3,
    'billetterie-solidaire',
    'festival/billetterie-solidaire'
  ),
  (
    13,
    3,
    'cie-en-diffusion',
    'festival/cie-en-diffusion'
  ),
  (
    14,
    3,
    'rencontres-pro',
    'festival/rencontres-pro'
  ),
  (
    15,
    3,
    'actions-culturelles',
    'festival/actions-culturelles'
  ),
  (
    16,
    3,
    'espace-ludique',
    'festival/espace-ludique'
  ),
  (
    17,
    3,
    'les-ptits-plus',
    'festival/les-ptits-plus'
  ),
  (18, 4, 'prsentation', 'tiers-lieu/prsentation'),
  (19, 4, 'éco-lieu', 'tiers-lieu/éco-lieu'),
  (
    20,
    4,
    'espaces-partagés',
    'tiers-lieu/espaces-partagés'
  ),
  (
    21,
    5,
    'spectacles_vivants',
    'activités-du-lieu/spectacles_vivants'
  ),
  (
    22,
    5,
    'développement-durable',
    'activités-du-lieu/développement-durable'
  ),
  (23, 6, 'locations', 'locations/locations'),
  (24, 7, 'annuel', 'bénévolat/annuel'),
  (25, 7, 'festival', 'bénévolat/festival'),
  (26, 8, 'partenaires', 'partenaires/partenaires'),
  (27, 9, 'soutient', 'soutient/soutient'),
  (28, 10, 'contact', 'contact/contact');

-- --------------------------------------------------------
--
-- Structure de la table `front_tab`
--
DROP TABLE IF EXISTS `front_tab`;

CREATE TABLE IF NOT EXISTS `front_tab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 11 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `front_tab`
--
INSERT INTO
  `front_tab` (`id`, `name`)
VALUES
  (1, 'association'),
  (2, 'saison'),
  (3, 'festival'),
  (4, 'tiers-lieu'),
  (5, 'activités-du-lieu'),
  (6, 'locations'),
  (7, 'bénévolat'),
  (8, 'partenaires'),
  (9, 'soutient'),
  (10, 'contact');

-- --------------------------------------------------------
--
-- Structure de la table `migration_versions`
--
DROP TABLE IF EXISTS `migration_versions`;

CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--
INSERT INTO
  `migration_versions` (`version`, `executed_at`)
VALUES
  ('20200114094325', '2020-01-14 09:43:59');

-- --------------------------------------------------------
--
-- Structure de la table `partners`
--
DROP TABLE IF EXISTS `partners`;

CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_size` int(11) DEFAULT NULL,
  `logo_dimensions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 31 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `partners`
--
INSERT INTO
  `partners` (
    `id`,
    `name`,
    `updated_at`,
    `type`,
    `logo_name`,
    `logo_original_name`,
    `logo_mime_type`,
    `logo_size`,
    `logo_dimensions`
  )
VALUES
  (
    1,
    'Labbe Clement SAS',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    2,
    'Boucher Le Roux SARL',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    3,
    'Gilles',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    4,
    'Roussel SARL',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    5,
    'Delorme',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    6,
    'Barre SAS',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    7,
    'Gilbert',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    8,
    'Wagner',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    9,
    'Hoareau',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    10,
    'Carpentier et Fils',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    11,
    'Boutin',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    12,
    'Lelievre SAS',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    13,
    'Chauvin Vallet et Fils',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    14,
    'Labbe Jacquot S.A.',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    15,
    'Bonnet',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    16,
    'Guilbert',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    17,
    'Launay',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    18,
    'Launay',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    19,
    'Pierre',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    20,
    'Berger SARL',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    21,
    'Legendre',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    22,
    'Perrin',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    23,
    'Clerc SARL',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    24,
    'Vidal et Fils',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    25,
    'Ledoux',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    26,
    'Blanchard SAS',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    27,
    'Huet',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    28,
    'Lambert S.A.',
    NULL,
    'partners',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    29,
    'Deschamps',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    30,
    'Gosselin Weiss S.A.R.L.',
    NULL,
    'prod_dist',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `performance`
--
DROP TABLE IF EXISTS `performance`;

CREATE TABLE IF NOT EXISTS `performance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `city_show` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_show` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_82D7968151458601` (`company_name_id`),
  KEY `IDX_82D7968171F7E88B` (`event_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 51 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `performance`
--
INSERT INTO
  `performance` (
    `id`,
    `company_name_id`,
    `event_id`,
    `city_show`,
    `place_show`,
    `date`
  )
VALUES
  (
    1,
    2,
    3,
    'Levy',
    'chemin de Devaux',
    '2019-09-09 12:18:59'
  ),
  (
    2,
    8,
    5,
    'Chauvet-sur-Monnier',
    '871, place Levy',
    '2020-01-04 18:13:52'
  ),
  (
    3,
    13,
    4,
    'Raynaud',
    '534, place Léon Richard',
    '2019-12-24 02:46:36'
  ),
  (
    4,
    2,
    5,
    'Dos Santos',
    '73, impasse de Francois',
    '2019-07-31 02:17:03'
  ),
  (
    5,
    15,
    6,
    'Gerard',
    '11, rue Vidal',
    '2019-12-27 18:56:12'
  ),
  (
    6,
    1,
    6,
    'Ribeiro-sur-Camus',
    '72, rue de Peltier',
    '2019-07-31 07:48:32'
  ),
  (
    7,
    3,
    5,
    'Le Goff',
    '26, chemin de Etienne',
    '2019-10-31 21:38:50'
  ),
  (
    8,
    6,
    1,
    'Guillet',
    '22, boulevard Blanchard',
    '2019-12-11 17:59:49'
  ),
  (
    9,
    18,
    5,
    'Tanguy',
    'impasse de Lopez',
    '2019-09-08 21:01:25'
  ),
  (
    10,
    16,
    7,
    'JourdanBourg',
    '83, rue de Marie',
    '2019-12-07 18:39:46'
  ),
  (
    11,
    12,
    7,
    'Richard',
    '55, chemin Marques',
    '2019-10-03 12:46:18'
  ),
  (
    12,
    3,
    5,
    'Chevallier',
    '88, impasse Jeanne Pereira',
    '2020-01-13 18:41:29'
  ),
  (
    13,
    10,
    2,
    'Weiss',
    'rue Dupont',
    '2019-08-23 12:04:02'
  ),
  (
    14,
    14,
    1,
    'Potier-sur-Humbert',
    '25, rue Honoré Deschamps',
    '2019-07-12 04:55:32'
  ),
  (
    15,
    5,
    1,
    'Boutin',
    '55, rue Marine Le Roux',
    '2019-09-12 05:06:14'
  ),
  (
    16,
    8,
    3,
    'HubertVille',
    '64, rue Patrick Marie',
    '2019-07-09 16:33:22'
  ),
  (
    17,
    10,
    3,
    'Baudry-sur-Collin',
    '37, place Alexandre Raymond',
    '2019-12-13 19:23:51'
  ),
  (
    18,
    12,
    4,
    'Ramos',
    '4, impasse de Denis',
    '2019-08-16 19:56:52'
  ),
  (
    19,
    15,
    1,
    'Hamel',
    '78, place de Fouquet',
    '2019-10-31 01:07:35'
  ),
  (
    20,
    1,
    5,
    'Germain-la-Forêt',
    'impasse Colin',
    '2019-07-05 00:24:25'
  ),
  (
    21,
    7,
    4,
    'Lacombe-la-Forêt',
    '336, chemin Charles Breton',
    '2019-08-08 22:35:22'
  ),
  (
    22,
    8,
    2,
    'Poirier-les-Bains',
    '14, impasse de Robert',
    '2019-11-09 18:55:54'
  ),
  (
    23,
    1,
    2,
    'GuillonVille',
    '856, avenue Georges',
    '2019-07-22 05:22:20'
  ),
  (
    24,
    17,
    1,
    'Richard',
    '31, impasse de Lesage',
    '2019-12-13 00:48:27'
  ),
  (
    25,
    15,
    7,
    'Ferrand-les-Bains',
    'boulevard Antoine Dubois',
    '2019-12-02 19:12:05'
  ),
  (
    26,
    18,
    3,
    'MartinsVille',
    '96, chemin Morvan',
    '2019-11-15 03:54:14'
  ),
  (
    27,
    2,
    1,
    'Roussel',
    '9, impasse de Aubert',
    '2019-10-11 18:42:30'
  ),
  (
    28,
    18,
    4,
    'Dupuis',
    '55, place Alexandre Marques',
    '2020-01-01 12:17:34'
  ),
  (
    29,
    15,
    3,
    'Lagarde-sur-Launay',
    '40, place Clerc',
    '2019-10-18 00:59:45'
  ),
  (
    30,
    17,
    1,
    'Bazin-les-Bains',
    '472, place de Launay',
    '2019-06-29 04:56:53'
  ),
  (
    31,
    13,
    7,
    'Vincentboeuf',
    '743, rue Raymond Schneider',
    '2019-11-28 11:44:49'
  ),
  (
    32,
    1,
    3,
    'Courtois-sur-Mer',
    'rue Marcel Berthelot',
    '2019-09-17 02:08:25'
  ),
  (
    33,
    2,
    1,
    'Langlois-sur-Mer',
    '72, rue Daniel Duhamel',
    '2019-10-19 13:43:42'
  ),
  (
    34,
    5,
    2,
    'Morin',
    'chemin de Valentin',
    '2019-09-18 20:57:22'
  ),
  (
    35,
    4,
    2,
    'Auger-les-Bains',
    'impasse Leroux',
    '2019-07-27 19:37:12'
  ),
  (
    36,
    3,
    4,
    'Bonneau',
    '95, avenue Corinne Bruneau',
    '2019-08-09 15:47:37'
  ),
  (
    37,
    19,
    1,
    'Lopez',
    '90, chemin Noémi Gallet',
    '2019-09-17 18:55:01'
  ),
  (
    38,
    11,
    2,
    'Lebonnec',
    '45, chemin Dupuis',
    '2019-12-09 09:47:19'
  ),
  (
    39,
    4,
    3,
    'Nguyen-la-Forêt',
    'rue Léon Da Silva',
    '2019-06-29 12:14:39'
  ),
  (
    40,
    15,
    1,
    'Bonnet',
    '1, avenue Alfred Humbert',
    '2019-08-25 18:58:28'
  ),
  (
    41,
    10,
    6,
    'Maceboeuf',
    '8, place Fischer',
    '2019-12-06 05:39:49'
  ),
  (
    42,
    5,
    6,
    'Rodriguezdan',
    'boulevard Alexandre Masson',
    '2019-10-26 03:40:04'
  ),
  (
    43,
    13,
    5,
    'Gillet',
    '6, place Alexandre Etienne',
    '2019-12-11 16:10:13'
  ),
  (
    44,
    12,
    4,
    'Berger',
    '8, chemin Aurore De Sousa',
    '2019-10-30 11:34:29'
  ),
  (
    45,
    20,
    3,
    'Da Silva',
    '18, rue Denis Guillou',
    '2019-11-22 02:23:10'
  ),
  (
    46,
    3,
    5,
    'Allard',
    '835, avenue de Boyer',
    '2019-07-24 03:55:22'
  ),
  (
    47,
    6,
    4,
    'LaporteVille',
    '886, boulevard Célina Michel',
    '2019-07-16 02:37:03'
  ),
  (
    48,
    20,
    7,
    'Duval',
    '28, place Grégoire Mary',
    '2019-12-12 00:04:21'
  ),
  (
    49,
    19,
    6,
    'Texier',
    '19, place Margot Joly',
    '2019-10-17 03:32:12'
  ),
  (
    50,
    16,
    5,
    'Rolland',
    '69, avenue Nathalie Ramos',
    '2019-10-22 12:08:36'
  );

-- --------------------------------------------------------
--
-- Structure de la table `section`
--
DROP TABLE IF EXISTS `section`;

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `belong_to_page_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appearance_order` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int(11) DEFAULT NULL,
  `image_dimensions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`),
  KEY `IDX_2D737AEFD261FDD1` (`belong_to_page_id`)
) ENGINE = InnoDB AUTO_INCREMENT = 101 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `section`
--
INSERT INTO
  `section` (
    `id`,
    `belong_to_page_id`,
    `name`,
    `title`,
    `sub_title`,
    `appearance_order`,
    `content`,
    `updated_at`,
    `image_name`,
    `image_original_name`,
    `image_mime_type`,
    `image_size`,
    `image_dimensions`
  )
VALUES
  (
    1,
    20,
    'Ut culpa aliquam.',
    'Aut magni qui qui.',
    'Quis sint quia quibusdam.',
    7,
    'Et consequatur suscipit saepe quia. Nesciunt nobis aperiam facere non iure nihil quia. Nihil est dolorum voluptas est voluptatem a.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    2,
    16,
    'Aut sit voluptas consequatur rerum.',
    'Porro molestiae est excepturi.',
    'Ex consequatur.',
    1,
    'Necessitatibus necessitatibus qui est et. Odio alias sed eaque.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    3,
    20,
    'Officia reiciendis ipsam voluptatem.',
    'Molestias et minus hic.',
    'Aperiam voluptas corporis fugiat.',
    6,
    'Illum ipsum odit ducimus culpa quae dolores blanditiis. Ut nemo eum vitae impedit recusandae temporibus quam aperiam. Omnis corrupti hic aut qui rem. Unde enim molestiae autem id.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    4,
    9,
    'Aliquid nam ex asperiores neque.',
    'Voluptas ut ut.',
    'Qui sed sint magnam.',
    0,
    'Praesentium exercitationem numquam iste vel perferendis consequuntur assumenda. Labore nesciunt exercitationem animi. Sit repudiandae id aliquam reprehenderit a tempora.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    5,
    22,
    'Vel laudantium qui assumenda a.',
    'Perspiciatis dolor nihil.',
    'Unde nihil ducimus.',
    6,
    'Et perferendis distinctio minima fugit corrupti voluptatem. Excepturi soluta temporibus repellendus. Eum cupiditate in quaerat et. Temporibus quo soluta molestiae optio consectetur.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    6,
    16,
    'A eum natus officia laudantium.',
    'Aliquam deleniti rerum qui vitae.',
    'Et explicabo possimus.',
    1,
    'Officia fugit iste et et. Totam repellendus provident voluptatem. Repellendus necessitatibus hic ipsa doloribus. Qui accusamus et odio explicabo quam accusamus. Sint quia fuga autem impedit perspiciatis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    7,
    9,
    'Odit id quasi.',
    'Omnis quidem.',
    'Reprehenderit commodi aut voluptas.',
    4,
    'At nostrum voluptatem et et ea. Harum tempore ab quis impedit. Assumenda aut aliquid consequatur nulla explicabo commodi praesentium voluptatem. Non optio consequatur occaecati delectus ut amet ipsam magni.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    8,
    7,
    'Dolorem iusto odio alias nemo.',
    'Non ea architecto.',
    'Nulla consectetur beatae.',
    3,
    'Aut blanditiis in pariatur omnis blanditiis consectetur itaque consequuntur. Praesentium itaque et reiciendis quo sapiente est. Quaerat voluptas vitae quia molestiae.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    9,
    26,
    'Velit quo autem id.',
    'Voluptatem est et ipsam.',
    'Ipsam consequatur quaerat minima id.',
    4,
    'Neque et quia saepe itaque. Laborum aut commodi et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    10,
    17,
    'Dolor assumenda ut.',
    'Vitae odit magnam omnis.',
    'Rerum earum.',
    5,
    'Corporis recusandae ad omnis explicabo expedita sed et quis. Facilis a eum et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    11,
    27,
    'Asperiores et reprehenderit.',
    'Dolorum consequuntur sed.',
    'Aut accusamus aut.',
    1,
    'Ex omnis est similique culpa dolorem dolor perspiciatis. Nostrum eum omnis quaerat. Beatae iure necessitatibus qui. Quasi rerum veritatis veritatis nam et quam. Voluptatem qui ut itaque iusto consequuntur.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    12,
    15,
    'Et cupiditate ea.',
    'In ab facere sunt.',
    'Omnis ut et fugiat.',
    6,
    'Animi nihil impedit voluptatum qui. Laboriosam laborum doloribus iusto ipsum suscipit. Qui tempora qui qui alias itaque esse.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    13,
    27,
    'Sed maiores veritatis laudantium.',
    'Incidunt placeat et.',
    'Dolores omnis est accusamus iusto.',
    6,
    'Recusandae vel praesentium aliquam dolor quasi. Et nihil ut ipsam odio quia. Temporibus alias nihil ipsa officia.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    14,
    2,
    'Atque rem eius.',
    'Esse velit voluptas.',
    'Ut magnam repudiandae voluptas.',
    9,
    'Fugiat officia ut omnis nihil dolores et. Tempora non aut aut totam molestiae assumenda fugiat. Ab unde a cumque. Voluptatum molestias facere totam similique voluptatum mollitia.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    15,
    14,
    'Error rerum accusantium laborum veniam iure.',
    'Possimus cumque.',
    'Provident nemo asperiores.',
    5,
    'A molestiae aliquam aut voluptate velit et et. Officia consequatur in et aut hic. Maxime nemo rerum in dolores molestias earum.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    16,
    5,
    'Eos ipsam culpa non.',
    'Ex in nihil quidem.',
    'Eum quia et amet.',
    7,
    'Unde sint magni ea. Sed voluptatibus in laborum est ratione. Perferendis fuga animi nulla possimus et optio.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    17,
    17,
    'Eveniet perspiciatis et et sed.',
    'Maiores et dignissimos.',
    'Mollitia non enim ad.',
    4,
    'Aliquid maiores ipsa esse ullam cupiditate. Voluptatem deserunt doloremque magnam et impedit quo. Vel deserunt eius architecto commodi eum at. Facilis inventore vero animi unde doloribus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    18,
    15,
    'Dolor vel consectetur debitis.',
    'Animi tempore ut ut exercitationem.',
    'Quia ad quas ut.',
    6,
    'Ut ducimus suscipit quia nostrum veritatis saepe ex. Aut neque sit numquam vel est sunt ab. Cupiditate excepturi non saepe in voluptatem vel rem quaerat. Magni aut eaque vel deleniti.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    19,
    9,
    'Deleniti enim rerum sequi.',
    'Et nemo excepturi et.',
    'Vero hic quia ut.',
    1,
    'Cum et facere fugiat sed earum iste suscipit voluptatem. Deserunt nobis doloribus enim ipsa dolores. Asperiores voluptates ut delectus sapiente quo. Rerum nihil sint placeat ipsa id ullam.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    20,
    22,
    'Eveniet debitis voluptatem.',
    'Sed totam aut impedit facere.',
    'Provident aut aut officia ducimus.',
    4,
    'Amet provident sint in eius et reprehenderit aliquam. Id et ab voluptate molestiae ut qui.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    21,
    19,
    'Vel quod dolorem perspiciatis.',
    'Quis asperiores non qui.',
    'Natus qui.',
    8,
    'Deleniti in quis hic. Ab architecto quas illum cum aut.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    22,
    18,
    'Doloremque unde fuga nostrum.',
    'Dolorem dicta repellendus dolorum.',
    'Dolorem molestiae aut.',
    7,
    'Qui dolore nobis in autem dicta adipisci. Perspiciatis ut vel quibusdam voluptatem consequuntur voluptatem. Possimus magnam earum non explicabo voluptas et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    23,
    19,
    'Est animi quaerat laborum autem.',
    'Suscipit vel aut.',
    'Architecto corrupti itaque.',
    0,
    'Autem consequatur consequatur perspiciatis animi. Assumenda debitis est nihil. Blanditiis labore maxime explicabo assumenda sit. Sint nam in pariatur vero fuga consequatur praesentium consequatur. Aut possimus id voluptas similique cumque provident et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    24,
    2,
    'Consequatur provident voluptas.',
    'Omnis nisi dolorem ut.',
    'Delectus magnam repudiandae molestiae et.',
    9,
    'Consequuntur est ut commodi sed. Fugiat repellat harum assumenda sed illo voluptatem nobis fugit.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    25,
    26,
    'At vero consequatur ut.',
    'Sint et inventore.',
    'Ullam ullam dolor.',
    8,
    'Vel possimus est labore et totam adipisci et. Molestiae tempora aut quidem quam. Adipisci rerum beatae laboriosam possimus ut. Et maiores ex ratione facilis consequatur est est et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    26,
    1,
    'Non similique aut suscipit quo.',
    'Quaerat libero provident.',
    'Minus alias eos et.',
    6,
    'Et maiores inventore iure tempora perspiciatis. Numquam veniam sequi dolorem quisquam amet nam ipsa. Et non autem iste praesentium. Porro aut corporis quis in quia asperiores sed.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    27,
    13,
    'Vero excepturi nihil harum sit et.',
    'Rerum quasi possimus.',
    'Qui voluptatem asperiores.',
    9,
    'Soluta distinctio placeat nesciunt quam hic perspiciatis. Est neque ipsam sequi. Error consequatur vero sint qui rerum vel aut provident.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    28,
    18,
    'Qui at molestiae commodi.',
    'Distinctio commodi dolorem voluptas.',
    'Itaque vel voluptatibus vero.',
    0,
    'Et tempore enim eius. Maiores laboriosam qui pariatur nam minus architecto consequatur animi. Nulla voluptate iste enim. Architecto aliquid amet eveniet voluptatem.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    29,
    25,
    'Tempore odit commodi aut culpa totam.',
    'Facere sit et voluptatum.',
    'Aut dolores voluptatem.',
    9,
    'Quis tempora provident et nobis dolore praesentium. Dolores harum cumque aperiam voluptatem necessitatibus nobis vel. Sit voluptatem dolores distinctio velit fugiat quaerat reiciendis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    30,
    4,
    'Reprehenderit quis modi molestias qui expedita.',
    'Accusamus magni qui animi aut.',
    'Deleniti illo blanditiis eum.',
    3,
    'Pariatur enim animi quas laboriosam nisi sed recusandae placeat. Repudiandae nesciunt labore dolores. Dolor est cum sit iusto eius. Perferendis rem molestiae magnam omnis qui.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    31,
    10,
    'Pariatur voluptatem repellat similique voluptatem.',
    'Velit maxime sint natus.',
    'Ullam culpa voluptatem sequi.',
    2,
    'Eveniet architecto non aut itaque. Qui delectus aspernatur maiores atque. Unde dolorum voluptates et eaque praesentium. Consequatur incidunt dolore quasi placeat amet veniam.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    32,
    6,
    'Facilis id soluta quia quidem.',
    'Odit quos voluptate et.',
    'Non corrupti numquam dolore.',
    3,
    'Vero eligendi nemo nisi voluptate nobis vero sit. Unde sapiente atque suscipit quisquam et quos. Nisi est autem dolore expedita. Eos assumenda expedita rerum nesciunt.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    33,
    7,
    'Voluptates et dolores.',
    'Facere numquam expedita.',
    'Quidem earum est.',
    3,
    'Id cupiditate et sunt suscipit. Et et dolores excepturi sed qui dolorum sed. Numquam sunt autem nostrum ad sed eos. Earum natus eum rerum consectetur et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    34,
    22,
    'Qui sunt sapiente.',
    'Est dolore veritatis.',
    'Occaecati sequi quod assumenda.',
    4,
    'Laudantium voluptatem autem ratione hic nihil eligendi error dolore. Autem voluptatum porro consequuntur ullam. Neque odit voluptatem ut quod.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    35,
    17,
    'Qui sit ut sapiente fugit ullam.',
    'Beatae sequi nemo.',
    'Ut quam ut.',
    8,
    'Est quo et id est illum veniam eos. Placeat labore maxime ab aut aut. Fuga occaecati ut ea et. Repellendus amet commodi quia consequuntur quod vel.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    36,
    23,
    'Explicabo optio sit ea consequatur omnis.',
    'Sint reprehenderit labore quo.',
    'Mollitia dignissimos qui.',
    7,
    'Soluta ducimus maiores id non eius ipsa. Qui sed inventore commodi voluptatibus corporis. Rerum aut ipsam magnam sit officia assumenda accusamus aut. Nesciunt est qui minus. Aut iusto quasi molestiae earum commodi placeat qui.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    37,
    7,
    'Et neque officia quidem non excepturi.',
    'Ratione et ea.',
    'Nulla harum explicabo unde.',
    4,
    'Quidem consequatur fugiat nihil at. Nobis in iste impedit rerum. Dolor minima sint rerum pariatur.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    38,
    6,
    'Deleniti molestias sunt modi.',
    'Amet corrupti dolorem rem.',
    'Voluptas aperiam.',
    0,
    'Ex quaerat blanditiis aspernatur et placeat tenetur et minus. Laborum quia architecto temporibus alias ratione facere. Consequatur omnis eum placeat laborum consequatur enim id.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    39,
    26,
    'Aperiam dolor quis velit.',
    'Praesentium est dignissimos.',
    'Hic ducimus expedita et.',
    7,
    'Qui quia hic cupiditate sequi dicta velit. Nihil in magnam iure optio et aut nam aspernatur. Aut quidem modi autem nemo.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    40,
    18,
    'Voluptas aliquid et est.',
    'Maiores ducimus assumenda.',
    'Ex non.',
    8,
    'Earum magnam incidunt modi perferendis ea et non. Aut illo dolor minus non aperiam nemo et porro. Sequi voluptatem quos deserunt omnis in sint est. Tenetur cumque eos ipsum et dolor provident. Nihil laboriosam deleniti quibusdam dolorem.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    41,
    21,
    'Voluptate laborum enim qui.',
    'Earum harum harum sequi.',
    'Ut accusantium dolores.',
    0,
    'Sed commodi officia itaque itaque similique. Aut corporis et molestiae nemo. Ipsam eius magni animi totam enim illum.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    42,
    27,
    'Quas eum in sequi.',
    'Officiis perferendis sit.',
    'Inventore est accusantium placeat.',
    5,
    'Iure corporis nulla repellat delectus qui saepe ipsam. Deleniti iure porro impedit aut. Deserunt sit vitae eligendi omnis ex tempore aut et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    43,
    14,
    'Blanditiis atque ad qui et autem.',
    'Nisi nihil doloremque.',
    'Qui excepturi.',
    5,
    'Qui necessitatibus nostrum consequatur quibusdam voluptas. Dignissimos magni reiciendis labore corporis laudantium dolorem. Aut hic odio ex minus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    44,
    4,
    'Doloribus non et earum.',
    'Voluptates consectetur quas.',
    'Explicabo reiciendis quia temporibus.',
    5,
    'Et dolores et et et adipisci at. Et ullam commodi debitis totam. Repellendus deleniti alias maxime sit sint corrupti. Quas eum ut et nisi eum accusantium.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    45,
    24,
    'Est repellendus nihil cumque est.',
    'Velit sapiente et unde sequi.',
    'Blanditiis id enim dolores.',
    5,
    'Pariatur iure natus quibusdam dolorem ut repellat. Quia praesentium rerum quas error vero voluptates eum. Voluptatem nihil quod sed ipsa doloremque in. Sed voluptatum et quos itaque et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    46,
    16,
    'Nesciunt velit consequatur hic accusantium.',
    'Dolorem ut ex nemo.',
    'Omnis odit quia.',
    8,
    'Odio consequuntur aperiam qui pariatur sit laborum est a. Et porro qui quo perspiciatis repellendus. Reprehenderit excepturi ut fuga. Similique sint est voluptatem laudantium.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    47,
    14,
    'Officia repellat id.',
    'Voluptas iusto animi.',
    'Fugit adipisci.',
    6,
    'Quos illum autem est id voluptatibus sint. Rerum est sequi inventore. Eaque sit provident repudiandae.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    48,
    14,
    'Magni quia ut eaque.',
    'Vero nostrum exercitationem.',
    'Qui a consequatur praesentium.',
    6,
    'Dolorem nihil eius magni aspernatur tenetur rerum. Sequi dolore distinctio est perspiciatis autem tempore. Ut quae iste reprehenderit.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    49,
    16,
    'Aut dolor quam minima est libero.',
    'Doloremque dolores.',
    'Natus ea qui est.',
    2,
    'Voluptatem eius inventore qui quam. Consequatur sapiente rerum sed ea autem voluptas. Saepe et harum beatae.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    50,
    7,
    'Quis ducimus et expedita sed.',
    'Mollitia sed laboriosam assumenda.',
    'Libero reprehenderit aut repellendus.',
    6,
    'Tempore aperiam sit aut et odit non et. Nobis incidunt dicta dolor non quae non. Quas earum ut explicabo ut voluptas.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    51,
    28,
    'Quia magnam perspiciatis.',
    'Eligendi libero est.',
    'At qui quis.',
    5,
    'Modi ullam eum mollitia laborum ipsam eum. Omnis iure possimus quia quod. Et at accusamus repellat corrupti reprehenderit ab tempora. Officia sapiente eos sit corrupti maxime ut tenetur.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    52,
    16,
    'Eius velit adipisci consequuntur fuga id.',
    'Dicta natus nulla.',
    'Non accusantium nam mollitia autem.',
    1,
    'Possimus dolorem quis velit dignissimos corporis. Qui ipsum quia error rerum autem repudiandae. Totam quisquam perferendis quia praesentium eos iure molestiae dolorum. Dolores illum nulla rerum eaque qui consectetur.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    53,
    13,
    'Distinctio provident vero ullam voluptatem dolores.',
    'Quis voluptatem.',
    'Rerum quasi excepturi optio.',
    3,
    'Et ex fuga quis voluptatem quod. Aliquid aut est beatae repellendus esse ratione.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    54,
    6,
    'Soluta fugit tenetur doloremque quae.',
    'Et porro maiores.',
    'Molestias voluptates tenetur aspernatur.',
    7,
    'Reiciendis omnis qui omnis aut aut. Consequatur a praesentium et laborum et itaque voluptate. Dolorum modi qui eos consequatur voluptatibus ut. Quasi perferendis sit veniam nostrum perferendis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    55,
    18,
    'Consequatur est et assumenda qui.',
    'Maxime velit facilis.',
    'Neque odit ratione amet.',
    6,
    'Dolor nobis libero vel minima quia nulla quae. Velit non itaque consequatur dolorum dolorem libero. Ipsum ducimus distinctio explicabo et qui expedita ex possimus. Voluptatum sequi autem consectetur quam. Debitis vero natus laboriosam fuga maxime ad qui mollitia.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    56,
    24,
    'Illo quod vero sint.',
    'Pariatur delectus atque.',
    'Ipsum laboriosam est nihil.',
    2,
    'Deserunt in voluptatem deserunt accusamus qui est quod. Quidem odit unde quis ex. Blanditiis est autem est incidunt a aut dolorem consequatur.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    57,
    12,
    'Velit at dolorem error non laboriosam.',
    'Voluptatem in quis repellat.',
    'Voluptas veritatis earum fuga temporibus.',
    4,
    'Vel minima dolor distinctio et dolores. Aut quis magnam magnam. Ea officia ratione voluptate quo fugiat. Ut repellendus necessitatibus minima earum laborum voluptas voluptates.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    58,
    1,
    'Accusantium consequatur qui ipsum.',
    'Exercitationem iure sunt.',
    'Cupiditate est maxime.',
    4,
    'Aut voluptas aut est officiis nisi distinctio. Iste velit dolor consectetur doloremque quod et. Fugiat rem voluptatum fugiat eum ut. Est repudiandae sint eos.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    59,
    18,
    'Veniam nostrum nostrum quia nobis aut.',
    'Doloremque vel sit.',
    'Itaque totam pariatur commodi.',
    0,
    'Ducimus est mollitia rerum est quod eum quo. Harum sapiente repellat quo qui reprehenderit deleniti dignissimos. Doloribus quis provident molestias aut aspernatur voluptatem.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    60,
    19,
    'Et omnis quos quia accusamus.',
    'Ea alias dolorem.',
    'Quisquam at rerum a aut.',
    4,
    'Est eum eos dolorem itaque voluptate. Sit eaque tenetur cumque dolores et nam rerum. Voluptatibus quisquam quae maxime.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    61,
    8,
    'Voluptates odio ipsam porro aut.',
    'Commodi nihil.',
    'Qui saepe sunt.',
    5,
    'Architecto numquam adipisci quasi accusantium aliquam sequi. Iusto officia quia repudiandae numquam quas ratione. Deleniti ducimus vel tenetur ut vel voluptas.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    62,
    16,
    'Dicta sunt omnis eos expedita recusandae.',
    'Quidem ut nisi quia.',
    'Qui aut.',
    5,
    'Unde temporibus ex esse. Nesciunt dignissimos in similique in facilis temporibus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    63,
    6,
    'Porro nesciunt sint rerum molestias.',
    'Atque harum veniam ut.',
    'Exercitationem aut non.',
    6,
    'Eum odit nihil ut dolores est. Dolore rerum est inventore sunt ipsam magnam. Accusantium architecto et tempore.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    64,
    27,
    'Aspernatur quaerat voluptatem et quia.',
    'Est eum explicabo et.',
    'Eos iusto dolores.',
    6,
    'Nemo quia iusto quas quia maxime veritatis minima. Illum dolorem voluptatem tempore architecto. Voluptas magnam repellendus laborum quo non vel facilis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    65,
    12,
    'Enim quia beatae nobis voluptas rerum.',
    'Molestiae dolores voluptatem.',
    'Excepturi ullam et.',
    0,
    'Nulla sed nobis qui rerum quis qui. Tempora cumque eos alias nihil porro totam voluptatum. Ut optio omnis dolores id.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    66,
    27,
    'Beatae eius aspernatur.',
    'Commodi at neque inventore.',
    'Ducimus autem.',
    3,
    'Aperiam consequatur sequi rem. Delectus architecto vero numquam aut repellendus. Nulla eos quos laboriosam similique ipsam earum vitae qui.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    67,
    26,
    'Accusamus quod ut.',
    'Sed voluptate animi.',
    'Voluptas quisquam temporibus.',
    0,
    'Nihil perferendis delectus veritatis ut. Sed occaecati dignissimos tempore odio enim veniam eum. Ad inventore impedit non assumenda similique quo.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    68,
    18,
    'Tempora voluptas accusantium alias reprehenderit.',
    'Quo eos.',
    'Et magnam est enim totam.',
    8,
    'Vitae quos officiis voluptatibus cupiditate cupiditate enim. In numquam odio quam ipsum. Sit harum repellendus voluptates autem. Qui incidunt aut illo voluptatem.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    69,
    17,
    'Omnis dignissimos maiores.',
    'Esse quasi.',
    'Provident rerum eum.',
    9,
    'Et magnam quia quia a. Tempora quia ex id. Assumenda occaecati temporibus dolore maxime tenetur quis omnis. Rem inventore non labore quam nihil in voluptatibus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    70,
    5,
    'Consequatur possimus cupiditate iure quo.',
    'Ratione beatae.',
    'Quis mollitia et facere.',
    8,
    'Dolor dolorem quis quam ut ea. Ipsa et veniam non doloremque iure molestias aut. Dolor assumenda voluptatibus qui voluptas eos.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    71,
    24,
    'Voluptas illum quaerat qui.',
    'Temporibus facere vel ducimus.',
    'Doloremque dolorem quae omnis.',
    5,
    'Nobis explicabo facere deserunt. Ratione delectus exercitationem odit. Corrupti qui magni ex eum et adipisci.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    72,
    10,
    'Praesentium nihil ut qui.',
    'Velit sit nihil hic excepturi.',
    'Ut nostrum sapiente.',
    8,
    'Eius fugiat voluptatem commodi omnis. Maxime quia sint doloremque quisquam aut voluptas. Blanditiis modi magnam quos dolores quis iste. Ipsa occaecati quod eius dolorum itaque.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    73,
    6,
    'Laudantium dolores non.',
    'Numquam consequatur at iste.',
    'Voluptas aut minus.',
    7,
    'Repellendus sint sed ut expedita numquam. Quidem ullam quasi laboriosam natus fugit quis deserunt. Alias nobis laboriosam quae voluptatem itaque voluptatem sapiente.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    74,
    17,
    'Quis numquam voluptatem culpa totam porro.',
    'Molestias recusandae non.',
    'Qui et libero aperiam commodi.',
    7,
    'Velit provident animi et ex maxime culpa omnis repudiandae. Quasi occaecati aut fugit dolor. Dolorem ea voluptates assumenda.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    75,
    23,
    'Neque delectus itaque aut qui.',
    'Hic hic possimus at.',
    'Doloribus voluptatem voluptatem tempore.',
    2,
    'Doloribus natus a consectetur ipsa voluptatem atque animi quibusdam. Sed porro repudiandae reiciendis quibusdam ut ullam. Sit qui sit et nesciunt et aut. Hic officia magni officia eaque ut.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    76,
    3,
    'In tempora pariatur est.',
    'Quas aut cumque.',
    'Autem suscipit pariatur.',
    5,
    'Repudiandae ea maiores est quae doloribus incidunt. Temporibus asperiores autem exercitationem molestiae unde distinctio officiis. Quia in dolores tempora nemo quaerat quae. Reiciendis ipsa temporibus voluptates alias.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    77,
    7,
    'Nihil repellat officia velit consequuntur dicta.',
    'Veniam ipsum velit.',
    'Quae beatae veritatis illum.',
    3,
    'Culpa ea dolore sit placeat laudantium. Qui voluptatibus aliquam nam sit doloremque omnis nesciunt. Unde blanditiis commodi earum.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    78,
    28,
    'Ipsa est vitae quia sapiente.',
    'Aperiam in magnam quia.',
    'Itaque molestias ea iste.',
    7,
    'Nisi fugit magnam suscipit distinctio aut expedita. Consequatur et officia iusto voluptas. Cumque debitis fuga necessitatibus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    79,
    21,
    'Aut officiis autem consectetur delectus.',
    'Maxime omnis ducimus.',
    'Qui cum temporibus impedit.',
    4,
    'Assumenda recusandae eius ut repudiandae. Placeat sint et quibusdam corporis ratione. Nihil non dolorem et nesciunt. Sed numquam natus ut delectus incidunt.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    80,
    11,
    'Dolores fugiat assumenda tempore.',
    'Ut quia omnis.',
    'Omnis harum tempora.',
    7,
    'Quaerat omnis at repellendus laboriosam enim est. Et aspernatur voluptas exercitationem. Sequi culpa corporis reprehenderit et impedit et hic est.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    81,
    5,
    'Numquam esse id minima.',
    'Est explicabo rerum adipisci.',
    'Ab molestiae quod libero.',
    2,
    'Ab rerum consequuntur atque omnis rerum aspernatur. Vel sint quibusdam excepturi. Nam at quas numquam iste nemo. Enim iusto recusandae repudiandae natus dolores perferendis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    82,
    23,
    'Nihil voluptate eveniet est repellat voluptatem.',
    'Id dolores et odio.',
    'Exercitationem distinctio officia.',
    3,
    'Fugiat quas quia id est. Et quas dolor dignissimos placeat.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    83,
    23,
    'Delectus velit voluptas et.',
    'Amet praesentium voluptatem.',
    'Voluptate labore in voluptas dolor.',
    3,
    'Enim voluptatem accusantium quisquam odio optio occaecati. Quis vitae autem est optio eaque. Omnis incidunt rerum reprehenderit rerum molestiae rerum incidunt.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    84,
    6,
    'Consequatur provident et porro adipisci aut.',
    'Officiis dolorum aliquid magnam.',
    'Magni voluptates.',
    9,
    'Nemo totam doloribus culpa unde. Dolor et a quisquam qui. Culpa voluptatum error eius nam cupiditate.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    85,
    2,
    'Ut nemo harum aut.',
    'Assumenda dignissimos dolorem ab.',
    'Quia esse.',
    6,
    'Aut deleniti ut qui doloremque. Quia vel minus vero et. Soluta non corporis rerum facere rem voluptatum beatae. Dolorum cumque sit et praesentium repellendus aut.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    86,
    20,
    'Ullam perspiciatis sed dolorum sequi.',
    'Doloremque earum vitae.',
    'Et dolores ratione eos.',
    9,
    'Aspernatur iste repellendus aperiam non molestiae sint vel nisi. Vel laudantium et cum et enim odit et. Consequuntur aliquid aut suscipit laudantium sint natus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    87,
    27,
    'Itaque consequuntur aut architecto commodi.',
    'Rem sed numquam sapiente.',
    'Iusto nostrum cum.',
    0,
    'Molestiae aliquam maiores quia numquam ea voluptas aut. Placeat placeat dolor doloremque qui quis. Velit rerum eligendi quis rem nemo natus architecto eum. Id dolor voluptatem ut.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    88,
    16,
    'Et et voluptas rerum atque.',
    'Debitis commodi pariatur.',
    'Ea est illo.',
    4,
    'Ea dolor exercitationem ducimus quidem nesciunt adipisci sunt. Quaerat exercitationem aut quia quod modi. Quas et tenetur voluptatum quae qui.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    89,
    17,
    'Vero aperiam fugit molestias illo.',
    'Modi mollitia sequi voluptas quisquam.',
    'Perferendis autem est id.',
    4,
    'Iure maxime sit nemo omnis quaerat sit. Quos natus aliquid saepe. Sed occaecati enim dolores qui. Aliquid explicabo consectetur eos quo qui sint dolore.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    90,
    20,
    'Architecto quod sunt accusamus.',
    'Aut quibusdam ipsum.',
    'Illo in ipsum.',
    4,
    'Ut quo fugit laudantium eos. Voluptate libero veritatis quaerat ea quaerat. Et non officiis quo minus. In autem perferendis quidem.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    91,
    2,
    'Rerum assumenda quia aut quo.',
    'Et eos et vitae voluptatem.',
    'Illo esse possimus.',
    9,
    'Quae rerum molestias eos quia placeat asperiores autem provident. Aut numquam tempora quidem consequuntur. Soluta quibusdam quis ut quos ducimus. Quos vitae numquam dicta pariatur omnis.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    92,
    18,
    'Modi molestias adipisci qui quam culpa.',
    'Aliquam officia et facilis.',
    'Sed illo quos.',
    8,
    'Sit recusandae ad dolorem sed sunt doloribus ea earum. In ad nam debitis sit. At soluta sint omnis ullam. Eos unde earum ea ratione alias delectus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    93,
    3,
    'Odit deserunt voluptas dignissimos cumque.',
    'A voluptate vitae autem.',
    'Odio dolorem laudantium.',
    7,
    'Eos dolor sit dolor accusamus. Tempora necessitatibus maxime dolor est cupiditate possimus laboriosam cumque. Porro quia ut eligendi ut autem voluptatem sit.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    94,
    26,
    'Dicta eos doloribus eligendi iusto.',
    'Consequatur dolores.',
    'Minima et recusandae.',
    6,
    'Excepturi id nostrum tempora quia qui aspernatur rerum. Inventore libero quae laboriosam voluptatum non facere veritatis. Placeat repellat magni sit commodi saepe quis neque. Aspernatur a unde quis ab voluptatem mollitia. Voluptate odio sunt aut est voluptatem.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    95,
    27,
    'Et sit sunt aut deleniti commodi.',
    'Consequatur quia debitis dolor.',
    'Incidunt ea quam.',
    5,
    'Impedit sed ea quia voluptatem. Porro est doloremque commodi beatae itaque. Est vitae vel rerum aut provident magnam.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    96,
    28,
    'Quaerat et quia voluptate.',
    'Unde vel fugit eveniet.',
    'Quasi rerum quia quia.',
    3,
    'Reprehenderit sint excepturi ea est corrupti tempore. Consequuntur laboriosam dolor dignissimos soluta omnis natus. Quidem id rerum repellat doloribus.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    97,
    17,
    'Nobis adipisci tempore eos.',
    'Facere quos pariatur.',
    'Est amet qui at.',
    3,
    'Vitae et laboriosam magnam et. Sit ratione at itaque. Consequatur exercitationem distinctio quo aut.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    98,
    9,
    'Alias quia sequi perferendis.',
    'Necessitatibus nostrum aut.',
    'Suscipit eius et illo odit.',
    2,
    'Ratione et illo architecto et ut eveniet. Eum aliquid animi omnis at praesentium molestias. Temporibus quo qui ad iste neque.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    99,
    11,
    'Sed maiores consectetur.',
    'Numquam odit eum sint.',
    'Consequuntur laudantium dolor voluptatem tempore.',
    7,
    'Aut nulla impedit modi amet eaque distinctio numquam vitae. Magnam aut autem sunt fugiat quibusdam corporis atque. Quis nobis delectus architecto et quidem earum et.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    100,
    2,
    'Placeat saepe nihil.',
    'Aspernatur quasi est velit.',
    'Reiciendis nisi natus cupiditate.',
    7,
    'Velit eligendi consequatur rem in quos. Eum aut optio omnis officia sit distinctio aut explicabo.',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `team`
--
DROP TABLE IF EXISTS `team`;

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_size` int(11) DEFAULT NULL,
  `photo_dimensions` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 16 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `team`
--
INSERT INTO
  `team` (
    `id`,
    `name`,
    `first_name`,
    `role`,
    `email`,
    `updated_at`,
    `photo_name`,
    `photo_original_name`,
    `photo_mime_type`,
    `photo_size`,
    `photo_dimensions`
  )
VALUES
  (
    1,
    'Hernandez',
    'Benoît',
    'gov_body',
    'nlouis@brunet.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    2,
    'Riou',
    'Zoé',
    'pro',
    'thibault.rossi@philippe.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    3,
    'Sanchez',
    'Émile',
    'volunteer',
    'bhoareau@lefort.org',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    4,
    'Leveque',
    'Dominique',
    'volunteer',
    'danielle.fleury@gilbert.net',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    5,
    'Besnard',
    'Thomas',
    'volunteer',
    'breton.patrick@allain.com',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    6,
    'Hamon',
    'Pauline',
    'volunteer',
    'bguillet@voila.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    7,
    'Rolland',
    'Patricia',
    'gov_body',
    'robert09@jacques.com',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    8,
    'Weiss',
    'Margaud',
    'pro',
    'sylvie.lamy@laposte.net',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    9,
    'Leclerc',
    'Laetitia',
    'volunteer',
    'clerc.jeannine@noos.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    10,
    'Loiseau',
    'Christophe',
    'pro',
    'blanchard.adrien@tiscali.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    11,
    'Hebert',
    'Alice',
    'volunteer',
    'ialbert@tiscali.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    12,
    'Renard',
    'Margot',
    'pro',
    'dominique88@godard.com',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    13,
    'Legrand',
    'Susan',
    'volunteer',
    'fontaine.adrienne@orange.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    14,
    'Fabre',
    'Denise',
    'pro',
    'nchauveau@bouygtel.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  ),
  (
    15,
    'Letellier',
    'Alix',
    'gov_body',
    'philippe.renault@orange.fr',
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL
  );

-- --------------------------------------------------------
--
-- Structure de la table `user`
--
DROP TABLE IF EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE = InnoDB AUTO_INCREMENT = 2 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--
INSERT INTO
  `user` (`id`, `username`, `roles`, `password`)
VALUES
  (
    1,
    'test',
    '[\"ROLE_ADMIN\"]',
    '$argon2id$v=19$m=65536,t=4,p=1$ZmNWTHMuYVJ3N2NoQ2VheA$t9ymY9gyrEEY4F3NthOM7wGWjrfl3uu9a4wzQcsEHgY'
  );

--
-- Contraintes pour les tables déchargées
--
--
-- Contraintes pour la table `front_page`
--
ALTER TABLE
  `front_page`
ADD
  CONSTRAINT `FK_2CDA0C4C8D0C9323` FOREIGN KEY (`tab_id`) REFERENCES `front_tab` (`id`);

--
-- Contraintes pour la table `performance`
--
ALTER TABLE
  `performance`
ADD
  CONSTRAINT `FK_82D7968151458601` FOREIGN KEY (`company_name_id`) REFERENCES `company` (`id`),
ADD
  CONSTRAINT `FK_82D7968171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `section`
--
ALTER TABLE
  `section`
ADD
  CONSTRAINT `FK_2D737AEFD261FDD1` FOREIGN KEY (`belong_to_page_id`) REFERENCES `front_page` (`id`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;