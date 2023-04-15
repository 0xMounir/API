-- Créer la table animes

CREATE TABLE IF NOT EXISTS `animes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `synopsis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `season` int NOT NULL,
  `episodes` int NOT NULL,
  `categories_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `studio` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` year NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `categorie_id` (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Créer la table categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Relier les deux tables
ALTER TABLE `animes`
  ADD CONSTRAINT `animes_ibfk_1` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);