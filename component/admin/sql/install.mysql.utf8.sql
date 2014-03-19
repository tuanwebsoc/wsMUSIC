

-- -----------------------------------------------------
-- Table `#__wsmusic_artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__wsmusic_artist` ;

CREATE TABLE IF NOT EXISTS `#__wsmusic_artist` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(100),
  `birthday` DATE,
  `biography` MEDIUMTEXT,
  `birthname` VARCHAR(100),
  `nation` SMALLINT COMMENT 'use php array',
  `company` SMALLINT COMMENT 'use an php array to parse this value like state',
  `related` TEXT COMMENT 'related artist(JSON)',
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `#__wsmusic_track`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__wsmusic_track` ;

CREATE TABLE IF NOT EXISTS `#__wsmusic_track` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `title` VARCHAR(255),
  `asset_id` INT UNSIGNED COMMENT 'FK to the assets table',
  `alias` VARCHAR(255) COLLATE 'utf8_bin',
  `lyrics` MEDIUMTEXT,
  `state` TINYINT(3) DEFAULT 0,
  `catid` TINYINT(3) UNSIGNED DEFAULT 0,
  `created` DATETIME DEFAULT '0000-00-00 00:00:00',
  `created_by` INT UNSIGNED DEFAULT 0,
  `publish_up` DATETIME DEFAULT '0000-00-00 00:00:00',
  `ordering` INT DEFAULT 0,
  `access` INT UNSIGNED DEFAULT 0,
  `hits` INT UNSIGNED DEFAULT 0,
  `downloads` INT UNSIGNED DEFAULT 0,
  `artist` INT UNSIGNED,
  `params` MEDIUMTEXT,
  `modified` DATETIME DEFAULT '0000-00-00 00:00:00',
  `modified_by` INT UNSIGNED DEFAULT 0,
  `featured` TINYINT(3) UNSIGNED DEFAULT 0,
  `source` TEXT COMMENT 'video can even have multible resolution with multiple sourcefile',
  `language` TINYINT(3),
  `video` TINYINT(1) DEFAULT false COMMENT 'true mean this is a video',
  `related` VARCHAR(100),
  PRIMARY KEY (`id`),
  CONSTRAINT `artist`
    FOREIGN KEY (`artist`)
    REFERENCES `#__wsmusic_artist` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

-- -----------------------------------------------------
-- Table `#__wsmusic_playlist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `#__wsmusic_playlist` ;

CREATE TABLE IF NOT EXISTS `#__wsmusic_playlist` (
  `id` INT UNSIGNED AUTO_INCREMENT,
  `name` VARCHAR(45),
  `tracks` MEDIUMTEXT COMMENT 'json array contain track id',
  `hits` INT UNSIGNED,
  `downloads` MEDIUMINT UNSIGNED ,
  `created` DATETIME DEFAULT '0000-00-00 00:00:00',
  `created_by` INT UNSIGNED,
  `state` TINYINT COMMENT 'options:trash,private,publish,archive,invite',
  `catid` INT UNSIGNED,
  `type` TINYINT COMMENT 'option:playlist,favorites,album..',
  `desciption` MEDIUMTEXT,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;
