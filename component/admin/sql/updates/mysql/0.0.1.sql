

-- -----------------------------------------------------
-- Table `#__wsmusic_artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__wsmusic_artist` ;

CREATE TABLE IF NOT EXISTS `#__wsmusic_artist` (
  `id` INT(10) NULL,
  `name` VARCHAR(100) NULL,
  `birthday` DATE NULL,
  `biography` MEDIUMTEXT NULL,
  `birthname` VARCHAR(100) NULL,
  `nation` SMALLINT NULL COMMENT 'use php array',
  `company` SMALLINT NULL COMMENT 'use an php array to parse this value like state',
  `related` TEXT NULL COMMENT 'related artist(JSON)',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

