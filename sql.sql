SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `xh` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `xh` ;

-- -----------------------------------------------------
-- Table `xh`.`xh_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(120) NULL ,
  `password` CHAR(128) NULL ,
  `registertime` INT UNSIGNED NULL ,
  `lastlogin` INT UNSIGNED NULL ,
  `ip` INT UNSIGNED NULL ,
  `lock` TINYINT NULL DEFAULT 0 ,
  `email` VARCHAR(120) NOT NULL ,
  `regfromuid` INT UNSIGNED NULL COMMENT 'regfromuid:引荐人\nlock:账户是否冻结' ,
  `hot` INT NULL DEFAULT 0 ,
  `havepic` TINYINT NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `hot_UNIQUE` (`hot` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `xh`.`xh_user_basicinfo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_user_basicinfo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uid` INT UNSIGNED NOT NULL ,
  `birthday` DATE NULL ,
  `hometown` VARCHAR(32) NULL ,
  `livecity` VARCHAR(32) NULL ,
  `oicq` INT UNSIGNED NULL ,
  `email` VARCHAR(120) NULL ,
  `mobile` INT UNSIGNED NULL ,
  `blog` VARCHAR(180) NULL ,
  `weibo` VARCHAR(180) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `xh`.`xh_user_propety`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_user_propety` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uid` INT UNSIGNED NULL ,
  `tall` INT UNSIGNED NULL ,
  `weight` INT UNSIGNED NULL ,
  `hobby` VARCHAR(255) NULL ,
  `education` VARCHAR(16) NULL ,
  `salary` INT UNSIGNED NULL ,
  `work` VARCHAR(24) NULL ,
  `photo` VARCHAR(255) NULL ,
  `demand` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_user_friend`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_user_friend` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uid` INT UNSIGNED NULL ,
  `friend` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_message`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_message` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'reid是指针对某条消息的回复' ,
  `content` TEXT NULL ,
  `from` INT UNSIGNED NULL ,
  `to` INT UNSIGNED NULL ,
  `pubtime` INT UNSIGNED NULL ,
  `reid` INT UNSIGNED NULL ,
  `readed` TINYINT UNSIGNED NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_invite`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_invite` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '邀请码' ,
  `content` CHAR(32) NOT NULL ,
  `use` TINYINT UNSIGNED NOT NULL DEFAULT 0 ,
  `haveit` INT UNSIGNED NULL COMMENT 'grant拥有者\nuseruid使用人ID' ,
  `useruid` INT UNSIGNED NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_article`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_article` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `pubtime` INT UNSIGNED NULL ,
  `uid` INT UNSIGNED NULL ,
  `content` MEDIUMTEXT NULL ,
  `keywords` VARCHAR(255) NULL ,
  `tags` VARCHAR(255) NULL ,
  `vistorcount` INT UNSIGNED NULL ,
  `pubstatus` TINYINT UNSIGNED NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_article_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_article_comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `aid` INT UNSIGNED NULL ,
  `uid` INT UNSIGNED NULL ,
  `content` TEXT NULL ,
  `to` INT NULL COMMENT 'to针对的评论ID' ,
  `pubtime` INT UNSIGNED NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_feedback`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_feedback` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uid` INT UNSIGNED NULL ,
  `pubtime` INT UNSIGNED NULL ,
  `content` TEXT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_activity`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_activity` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uid` INT UNSIGNED NULL ,
  `takepartin` VARCHAR(255) NULL ,
  `content` MEDIUMTEXT NULL ,
  `add` VARCHAR(255) NULL ,
  `taketime` INT UNSIGNED NULL ,
  `city` VARCHAR(24) NULL ,
  `pubtime` INT UNSIGNED NULL ,
  `subject` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `xh`.`xh_post`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `pubtime` INT UNSIGNED NULL ,
  `uid` INT UNSIGNED NULL ,
  `content` MEDIUMTEXT NULL ,
  `keywords` VARCHAR(255) NULL ,
  `tags` VARCHAR(255) NULL ,
  `vistorcount` INT UNSIGNED NULL ,
  `pubstatus` TINYINT UNSIGNED NULL DEFAULT 0 ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `xh`.`xh_post_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `xh`.`xh_post_comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `aid` INT UNSIGNED NULL ,
  `uid` INT UNSIGNED NULL ,
  `content` TEXT NULL ,
  `to` INT NULL COMMENT 'to针对的评论ID' ,
  `pubtime` INT UNSIGNED NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

USE `xh` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
