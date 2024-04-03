CREATE DATABASE IF NOT EXISTS `tennis`;
USE `tennis`;

DROP TABLE IF EXISTS `tournaments`;
CREATE TABLE `tournaments`(
  `id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `gender` VARCHAR(1) NOT NULL DEFAULT `M`,
  `date`  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` TINYINT DEFAULT 0,
  PRIMARY KEY (`id`),
);

DROP TABLE IF EXISTS `rounds`;
CREATE TABLE `rounds`(
  `id` INT NOT NULL,
  `tournament_id` BIGINT(20) NOT NULL,
  `player1_json` TEXT NOT NULL,
  `player2_json` TEXT,
  `winner` tinyint(1),
  PRIMARY KEY (`id`, `tournament_id`),
  CONSTRAINT `FK_TournamentRound` FOREIGN KEY (`tournament_id`) REFERENCES tournaments(`id`)
);
