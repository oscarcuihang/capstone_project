SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `rtp` ;
CREATE SCHEMA IF NOT EXISTS `rtp` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `rtp` ;

-- -----------------------------------------------------
-- Table `rtp`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`users` ;

CREATE TABLE IF NOT EXISTS `rtp`.`users` (
  `id` INT NOT NULL,
  `user_email` VARCHAR(45) NULL,
  `user_first_name` VARCHAR(45) NULL,
  `user_last_name` VARCHAR(45) NULL,
  `user_pass_hash` VARCHAR(45) NULL,
  `salt` VARCHAR(15) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`posts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`posts` ;

CREATE TABLE IF NOT EXISTS `rtp`.`posts` (
  `id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `post_date` DATETIME NULL,
  `post_title` VARCHAR(45) NULL,
  `post_content` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_posts_users_idx` (`users_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`post_keywords`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`post_keywords` ;

CREATE TABLE IF NOT EXISTS `rtp`.`post_keywords` (
  `id` INT NOT NULL,
  `posts_id` INT NOT NULL,
  `key1` VARCHAR(45) NULL,
  `key2` VARCHAR(45) NULL,
  `key3` VARCHAR(45) NULL,
  `key4` VARCHAR(45) NULL,
  `key5` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_keywords_posts1_idx` (`posts_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`post_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`post_comments` ;

CREATE TABLE IF NOT EXISTS `rtp`.`post_comments` (
  `id` INT NOT NULL,
  `posts_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `post_info` VARCHAR(45) NULL,
  `post_date` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_comments_posts1_idx` (`posts_id` ASC),
  INDEX `fk_post_comments_users1_idx` (`users_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`locations` ;

CREATE TABLE IF NOT EXISTS `rtp`.`locations` (
  `id` INT NOT NULL,
  `location_longitude` DOUBLE NULL,
  `location_latitude` DOUBLE NULL,
  `location_info` VARCHAR(45) NULL,
  `location_image` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`location_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`location_comments` ;

CREATE TABLE IF NOT EXISTS `rtp`.`location_comments` (
  `id` INT NOT NULL,
  `locations_id` INT NOT NULL,
  `users_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_location_comments_locations1_idx` (`locations_id` ASC),
  INDEX `fk_location_comments_users1_idx` (`users_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`comment_comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`comment_comments` ;

CREATE TABLE IF NOT EXISTS `rtp`.`comment_comments` (
  `id` INT NOT NULL,
  `post_comments_id` INT NOT NULL DEFAULT 0,
  `location_comments_id` INT NOT NULL DEFAULT 0,
  `comment_comment_text` VARCHAR(45) NULL,
  `comment_comment_date` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_comment_comments_post_comments1_idx` (`post_comments_id` ASC),
  INDEX `fk_comment_comments_location_comments1_idx` (`location_comments_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`questions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`questions` ;

CREATE TABLE IF NOT EXISTS `rtp`.`questions` (
  `id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `question_date` DATETIME NULL,
  `question_text` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_questions_users1_idx` (`users_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`answers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`answers` ;

CREATE TABLE IF NOT EXISTS `rtp`.`answers` (
  `id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `questions_id` INT NOT NULL,
  `answer_text` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_answers_users1_idx` (`users_id` ASC),
  INDEX `fk_answers_questions1_idx` (`questions_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`new_locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`new_locations` ;

CREATE TABLE IF NOT EXISTS `rtp`.`new_locations` (
  `id` INT NOT NULL,
  `users_id` INT NOT NULL,
  `new_location_name` VARCHAR(45) NULL,
  `new_location_lonitude` DOUBLE NULL,
  `new_location_latitude` DOUBLE NULL,
  `new_location_category` VARCHAR(45) NULL,
  `new_location_verify` SMALLINT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_new_locations_users1_idx` (`users_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`post_locations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`post_locations` ;

CREATE TABLE IF NOT EXISTS `rtp`.`post_locations` (
  `id` INT NOT NULL,
  `posts_id` INT NOT NULL,
  `locations_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_post_locations_posts1_idx` (`posts_id` ASC),
  INDEX `fk_post_locations_locations1_idx` (`locations_id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `rtp`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `rtp`.`categories` ;

CREATE TABLE IF NOT EXISTS `rtp`.`categories` (
  `id` INT NOT NULL,
  `locations_id` INT NOT NULL,
  `category_name` VARCHAR(45) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_categories_locations1_idx` (`locations_id` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
