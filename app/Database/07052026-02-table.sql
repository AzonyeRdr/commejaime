-- Active: 1770031521814@@127.0.0.1@3306@commejaime
CREATE TABLE `user` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` TEXT NOT NULL,
    `mdp` TEXT NOT NULL,
    `roleId` INT UNSIGNED NOT NULL,
    `montant` DECIMAL(8, 2) NOT NULL DEFAULT 0
);

CREATE TABLE `role` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `lib` TEXT NOT NULL
);

CREATE TABLE `objectif` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `lib` TEXT NOT NULL
);

CREATE TABLE `regime` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nomPlat` TEXT NOT NULL,
    `poidsTotalPlat` DOUBLE NOT NULL
);

CREATE TABLE `programme` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nom` TEXT NOT NULL,
    `objId` INT UNSIGNED NOT NULL,
    `nombreJour` INT NOT NULL,
    `poids` DECIMAL(8, 2) NOT NULL
);

CREATE TABLE `progammeRegime` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `programmeId` INT UNSIGNED NOT NULL,
    `regimeId` INT UNSIGNED NOT NULL,
    `jour` INT NOT NULL
);

CREATE TABLE `sport` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `exercices` TEXT NOT NULL
);

CREATE
TABLE `programmeSport` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `programmeId` INT UNSIGNED NOT NULL,
    `sportId` INT UNSIGNED NOT NULL,
    `jour` INT NOT NULL
);

CREATE TABLE `ingredients` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `lib` TEXT NOT NULL,
    `prixG` DOUBLE NOT NULL
);

CREATE TABLE `ingredientRegime` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `regimeId` INT UNSIGNED NOT NULL,
    `ingredientId` INT UNSIGNED NOT NULL,
    `pourcentage` DOUBLE NOT NULL
);

CREATE TABLE `avantage` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `roleId` INT UNSIGNED NOT NULL,
    `reduction` DECIMAL(8, 2) NOT NULL
);

CREATE
or
REPLACE
TABLE `code` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `lib` TEXT NOT NULL,
    `status` BOOLEAN NOT NULL,
    `userId` INT UNSIGNED NOT NULL,
    `montant` DECIMAL(8, 2) NOT NULL DEFAULT 0
);

ALTER TABLE `ingredientRegime`
ADD CONSTRAINT `ingredientregime_regimeid_foreign` FOREIGN KEY (`regimeId`) REFERENCES `regime` (`id`);

ALTER TABLE `progammeRegime`
ADD CONSTRAINT `progammeregime_programmeid_foreign` FOREIGN KEY (`programmeId`) REFERENCES `programme` (`id`);

ALTER TABLE `programmeSport`
ADD CONSTRAINT `programmesport_programmeid_foreign` FOREIGN KEY (`programmeId`) REFERENCES `programme` (`id`);

ALTER TABLE `code`
ADD CONSTRAINT `code_userid_foreign` FOREIGN KEY (`userid`) REFERENCES `user` (`id`);

ALTER TABLE `user`
ADD CONSTRAINT `user_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

ALTER TABLE `programme`
ADD CONSTRAINT `programme_objid_foreign` FOREIGN KEY (`objId`) REFERENCES `objectif` (`id`);

ALTER TABLE `progammeRegime`
ADD CONSTRAINT `progammeregime_regimeid_foreign` FOREIGN KEY (`regimeId`) REFERENCES `regime` (`id`);

ALTER TABLE `ingredientRegime`
ADD CONSTRAINT `ingredientregime_ingredientid_foreign` FOREIGN KEY (`ingredientId`) REFERENCES `ingredients` (`id`);

ALTER TABLE `avantage`
ADD CONSTRAINT `avantage_roleid_foreign` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

ALTER TABLE `programmeSport`
ADD CONSTRAINT `programmesport_sportid_foreign` FOREIGN KEY (`sportid`) REFERENCES `sport` (`id`);

CREATE TABLE `inscriptionProgramme` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userId` INT UNSIGNED NOT NULL,
    `programmeId` INT UNSIGNED NOT NULL,
    `dateInscription` DATE,
    Foreign Key (userId) REFERENCES `user` (id),
    Foreign Key (programmeId) REFERENCES programme (id)
);

CREATE table infoUser (
    id int auto_increment primary key,
    userId int unsigned not null,
    prenom text not null,
    age int not null,
    poids double not null,
    taille double not null,
    Foreign Key (userId) REFERENCES `user` (id)
)

ALTER TABLE `user`
ADD CONSTRAINT `unique_user_email` UNIQUE (`email`);