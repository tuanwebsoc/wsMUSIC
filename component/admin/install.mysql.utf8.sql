

-- -----------------------------------------------------
-- Table `com_wsmusic_artist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `com_wsmusic_artist` ;

CREATE TABLE IF NOT EXISTS `com_wsmusic_artist` (
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


-- -----------------------------------------------------
-- Table `com_wsmusic_track`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `com_wsmusic_track` ;

CREATE TABLE IF NOT EXISTS `com_wsmusic_track` (
  `id` INT(10) NULL,
  `title` VARCHAR(255) NULL,
  `asset_id` INT(10) NULL COMMENT 'FK to the assets table',
  `alias` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL,
  `lyrics` MEDIUMTEXT NULL,
  `state` TINYINT(3) NULL,
  `catid` TINYINT(3) NULL,
  `created` DATETIME NULL DEFAULT 0000-00-00 00:00:00,
  `created_by` INT(10) NULL,
  `publish_up` DATETIME NULL DEFAULT 0000-00-00 00:00:00,
  `ordering` INT(11) NULL,
  `access` INT(10) NULL,
  `hits` INT(10) NULL DEFAULT 0,
  `downloads` INT(10) NULL DEFAULT 0,
  `artist` INT(10) NULL,
  `params` MEDIUMTEXT NULL,
  `modified` DATETIME NULL DEFAULT 0000-00-00 00:00:00,
  `modified_by` INT(10) NULL,
  `featured` TINYINT(3) NULL,
  `source` TEXT NULL COMMENT 'video can even have multible resolution with multiple sourcefile',
  `language` TINYINT(3) NULL,
  `video` TINYINT(1) NULL DEFAULT false COMMENT 'true mean this is video',
  `related` VARCHAR(100) NULL,
  PRIMARY KEY (`id`),
  INDEX `artist_idx` (`artist` ASC),
  CONSTRAINT `artist`
    FOREIGN KEY (`artist`)
    REFERENCES `com_wsmusic_artist` (`id`)
    ON DELETE SET NULL
    ON UPDATE SET NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `playlist`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `playlist` ;

CREATE TABLE IF NOT EXISTS `playlist` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `tracks` MEDIUMTEXT NULL COMMENT 'json array contain track id',
  `hits` INT NULL,
  `downloads` MEDIUMINT NULL,
  `created` DATETIME NULL,
  `created_by` INT NULL,
  `state` TINYINT NULL COMMENT 'options:trash,private,publish,archive,invite',
  `catid` INT NULL,
  `type` TINYINT COMMENT 'option:playlist,favorites,album..'
  'created_by' INT 
  `desciption` MEDIUMTEXT NULL)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;

