SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `cunxiaoo_houtai` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `cunxiaoo_houtai` ;

-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`school`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`school` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`school` (
  `id` INT NOT NULL COMMENT '标识',
  `name` VARCHAR(45) NOT NULL,
  `brief` TEXT NULL COMMENT '学校介绍\n',
  `address` VARCHAR(100) NULL,
  `bankact_address` VARCHAR(45) NULL,
  `province` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `area` VARCHAR(45) NULL,
  `contact_id` INT NULL,
  `schedule_id` INT NULL,
  PRIMARY KEY (`id`, `name`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`school` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`user` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`user` (
  `id` INT NOT NULL COMMENT '标识',
  `sid` VARCHAR(200) NULL COMMENT '证件号码',
  `name` VARCHAR(45) NOT NULL,
  `dob` DATE NULL,
  `status` VARCHAR(45) NULL,
  `contact_id` VARCHAR(45) NULL,
  `province` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `area` VARCHAR(45) NULL,
  `postcode` VARCHAR(45) NULL,
  `address` VARCHAR(200) NULL,
  `mobile` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `phone` VARCHAR(45) NULL,
  `webid1` VARCHAR(100) NULL,
  `webid2` VARCHAR(100) NULL,
  `webid3` VARCHAR(100) NULL,
  `nickname` VARCHAR(200) NULL,
  `remark` VARCHAR(500) NULL,
  `aboutme` VARCHAR(500) NULL,
  PRIMARY KEY (`id`, `name`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`user` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`contact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`contact` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`contact` (
  `id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `type` VARCHAR(45) NULL COMMENT '描述与联系人关系 如 本人， 父亲，母亲，校长，姐姐',
  `remark` VARCHAR(45) NULL,
  `contactcol` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`contact` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`role` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`role` (
  `user_id` INT NOT NULL COMMENT '角色 如被捐助 ',
  `role` VARCHAR(10) NOT NULL)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`auth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`auth` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`auth` (
  `id` INT NOT NULL COMMENT '角色 如被捐助 ',
  `user_id` INT NULL,
  `login_name` VARCHAR(50) NOT NULL,
  `pwd` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`, `login_name`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`auth` (`id` ASC);

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`auth_role` (
  `id` INT NOT NULL COMMENT ' ',
  `user_id` INT NULL,
  `role` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`auth_role` (`id` ASC);

-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`log`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`log` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`log` (
  `id` INT NOT NULL COMMENT '标识',
  `user_id` VARCHAR(200) NULL COMMENT '证件号码',
  `rec_id` INT NULL,
  `action` VARCHAR(100) NOT NULL,
  `message` TEXT NULL,
  `when` DATETIME NULL,
  PRIMARY KEY (`id`, `action`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`log` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`schoolsch`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`schoolsch` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`schoolsch` (
  `id` INT NOT NULL,
  `school_id` INT NULL,
  `grade` VARCHAR(45) NULL,
  `semester` VARCHAR(45) NULL,
  `year` INT NOT NULL,
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`schoolsch` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`donation`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`donation` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`donation` (
  `id` INT NOT NULL,
  `student_id` INT NOT NULL COMMENT 'userid',
  `school_id` INT NOT NULL,
  `semester_id` INT NOT NULL,
  `student_class` VARCHAR(45) NULL,
  `donator_id` INT NOT NULL,
  `status` CHAR(2) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`donation` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`feedback`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`feedback` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`feedback` (
  `id` INT NOT NULL,
  `user_id` VARCHAR(45) NOT NULL,
  `type` CHAR(1) NULL COMMENT '来信或是回访',
  `context` TEXT NOT NULL,
  `brief` VARCHAR(100) NULL,
  `subject` VARCHAR(50) NULL,
  `status` CHAR(1) NULL,
  `submiton` DATETIME NULL,
  `remark` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`feedback` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`feedback_reply`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`feedback_reply` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`feedback_reply` (
  `id` INT NOT NULL,
  `feedback_id` INT NOT NULL,
  `user_id` INT NOT NULL COMMENT '来信或是回访',
  `content` VARCHAR(100) NULL,
  `submiton` DATETIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`feedback_reply` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`bankact`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`bankact` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`bankact` (
  `id` INT NOT NULL,
  `user_id` INT NULL,
  `type` CHAR NULL,
  `account` VARCHAR(45) NULL,
  `account_name` VARCHAR(100) NULL,
  `account_remark` VARCHAR(100) NULL,
  `address` VARCHAR(45) NULL,
  `bank` VARCHAR(45) NULL,
  `school_id` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`bankact` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`addressdic`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`addressdic` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`addressdic` (
  `id` INT NOT NULL,
  `province` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `area` VARCHAR(45) NULL,
  `township` VARCHAR(45) NULL,
  `town` VARCHAR(45) NULL,
  `villiage` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`addressdic` (`id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
