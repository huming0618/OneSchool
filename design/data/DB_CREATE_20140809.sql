SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `cunxiaoo_houtai` ;
CREATE SCHEMA IF NOT EXISTS `cunxiaoo_houtai` DEFAULT CHARACTER SET utf8 ;
USE `cunxiaoo_houtai` ;

-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`address_dictionary`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`address_dictionary` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`address_dictionary` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `province` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `area` VARCHAR(45) NULL DEFAULT NULL,
  `town` VARCHAR(45) NULL DEFAULT NULL,
  `villiage` VARCHAR(45) NULL DEFAULT NULL,
  `level` INT NULL,
  `parent_code` VARCHAR(45) NULL,
  `code` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`address_dictionary` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`users` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '标识',
  `sid` VARCHAR(200) NULL DEFAULT NULL COMMENT '证件号码',
  `type` CHAR(1) NULL,
  `name` VARCHAR(45) NOT NULL,
  `dob` DATE NULL DEFAULT NULL,
  `status` VARCHAR(45) NULL DEFAULT NULL,
  `province` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `area` VARCHAR(45) NULL DEFAULT NULL,
  `town` VARCHAR(45) NULL,
  `villiage` VARCHAR(45) NULL,
  `postcode` VARCHAR(45) NULL DEFAULT NULL,
  `address` VARCHAR(200) NULL DEFAULT NULL,
  `mobile` VARCHAR(45) NULL DEFAULT NULL,
  `email` VARCHAR(45) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `webid1` VARCHAR(100) NULL DEFAULT NULL,
  `webid2` VARCHAR(100) NULL DEFAULT NULL,
  `webid3` VARCHAR(100) NULL DEFAULT NULL,
  `contact_note` VARCHAR(100) NULL DEFAULT NULL,
  `nickname` VARCHAR(200) NULL DEFAULT NULL,
  `remark` VARCHAR(500) NULL DEFAULT NULL,
  `aboutme` VARCHAR(500) NULL DEFAULT NULL,
  `photo` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '用户表';

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`users` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`auth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`auth` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`auth` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `login_name` VARCHAR(50) NOT NULL,
  `pwd` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `auth_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`auth` (`id` ASC);

CREATE UNIQUE INDEX `login_name_UNIQUE` ON `cunxiaoo_houtai`.`auth` (`login_name` ASC);

CREATE INDEX `user_id_idx` ON `cunxiaoo_houtai`.`auth` (`user_id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`bankacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`bankacts` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`bankacts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `type` CHAR(1) NULL DEFAULT NULL,
  `account` VARCHAR(100) NULL DEFAULT NULL,
  `account_name` VARCHAR(100) NULL DEFAULT NULL,
  `account_remark` VARCHAR(100) NULL DEFAULT NULL,
  `address` VARCHAR(120) NULL DEFAULT NULL,
  `bank` VARCHAR(100) NULL DEFAULT NULL,
  `school_id` INT NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `bankact_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`bankacts` (`id` ASC);

CREATE INDEX `bankact_user_id_idx` ON `cunxiaoo_houtai`.`bankacts` (`user_id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`contacts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`contacts` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`contacts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL,
  `school_id` INT(11) NULL DEFAULT NULL,
  `phone` VARCHAR(45) NULL DEFAULT NULL,
  `contact` VARCHAR(100) NULL DEFAULT NULL,
  `type` VARCHAR(45) NULL DEFAULT NULL COMMENT '描述与联系人关系 如 本人， 父亲，母亲，校长，姐姐',
  `remark` VARCHAR(120) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`contacts` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`schools`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`schools` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`schools` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '标识',
  `name` VARCHAR(45) NOT NULL,
  `brief` TEXT NULL DEFAULT NULL COMMENT '学校介绍\n',
  `address` VARCHAR(100) NULL DEFAULT NULL,
  `bankact_address` VARCHAR(45) NULL DEFAULT NULL,
  `province` VARCHAR(45) NULL DEFAULT NULL,
  `city` VARCHAR(45) NULL DEFAULT NULL,
  `area` VARCHAR(45) NULL DEFAULT NULL,
  `main_contact` VARCHAR(100) NULL DEFAULT NULL,
  `other_contact` VARCHAR(100) NULL DEFAULT NULL,
  `cooperate` BIT(1) NOT NULL,
  `facilities` VARCHAR(500) NULL DEFAULT NULL COMMENT '设施',
  `size` VARCHAR(500) NULL DEFAULT NULL COMMENT '规模',
  `comments` VARCHAR(500) NULL DEFAULT NULL COMMENT '评价',
  `feedback_note` VARCHAR(200) NULL DEFAULT NULL,
  `student_contact` VARCHAR(100) NULL DEFAULT NULL COMMENT '学生代表联系信息',
  PRIMARY KEY (`id`, `name`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '学校列表';

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`schools` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`school_schedules`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`school_schedules` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`school_schedules` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `school_id` INT(11) NOT NULL,
  `grade` VARCHAR(45) NOT NULL,
  `semester` VARCHAR(45) NOT NULL,
  `year` INT(11) NOT NULL,
  `startdate` DATE NOT NULL,
  `enddate` DATE NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `schsch_school_id`
    FOREIGN KEY (`school_id`)
    REFERENCES `cunxiaoo_houtai`.`schools` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`school_schedules` (`id` ASC);

CREATE INDEX `schsch_school_id_idx` ON `cunxiaoo_houtai`.`school_schedules` (`school_id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`donations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`donations` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`donations` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `student_id` INT(11) NOT NULL COMMENT 'userid',
  `school_id` INT(11) NOT NULL,
  `schoolsch_id` INT(11) NOT NULL,
  `student_class` VARCHAR(45) NULL DEFAULT NULL,
  `donator_id` INT(11) NOT NULL,
  `status` CHAR(2) NULL DEFAULT NULL,
  `brief` VARCHAR(100) NULL COMMENT '状态说明 如汇款已到 ， 资料已发\n',
  `remark` VARCHAR(200) NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `donation_schsch_id`
    FOREIGN KEY (`schoolsch_id`)
    REFERENCES `cunxiaoo_houtai`.`school_schedules` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `donation_sch_id`
    FOREIGN KEY (`school_id`)
    REFERENCES `cunxiaoo_houtai`.`schools` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `donator_id`
    FOREIGN KEY (`donator_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`donations` (`id` ASC);

CREATE INDEX `donation_sch_id_idx` ON `cunxiaoo_houtai`.`donations` (`school_id` ASC);

CREATE INDEX `donation_schsch_id_idx` ON `cunxiaoo_houtai`.`donations` (`schoolsch_id` ASC);

CREATE INDEX `student_id_idx` ON `cunxiaoo_houtai`.`donations` (`student_id` ASC);

CREATE INDEX `donator_id_idx` ON `cunxiaoo_houtai`.`donations` (`donator_id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`feedbacks`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`feedbacks` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`feedbacks` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NULL DEFAULT NULL COMMENT '关于学生的回访或来信',
  `school_id` INT(11) NULL DEFAULT NULL COMMENT '关于学校的反馈记录\n',
  `type` CHAR(1) NULL DEFAULT NULL COMMENT '来信或是回访',
  `context` TEXT NOT NULL,
  `brief` VARCHAR(100) NULL DEFAULT NULL,
  `subject` VARCHAR(50) NULL DEFAULT NULL,
  `status` CHAR(1) NULL DEFAULT NULL,
  `author_id` INT(11) NULL DEFAULT NULL,
  `submit_on` DATETIME NULL DEFAULT NULL,
  `remark` VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `feedback_author_id`
    FOREIGN KEY (`author_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`feedbacks` (`id` ASC);

CREATE INDEX `feedback_author_id_idx` ON `cunxiaoo_houtai`.`feedbacks` (`author_id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`feedback_replies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`feedback_replies` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`feedback_replies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `feedback_id` INT(11) NOT NULL,
  `author_id` INT(11) NOT NULL,
  `content` VARCHAR(100) NULL DEFAULT NULL,
  `submiton` DATETIME NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fbreply_author_id`
    FOREIGN KEY (`author_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `feedback_id`
    FOREIGN KEY (`feedback_id`)
    REFERENCES `cunxiaoo_houtai`.`feedbacks` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`feedback_replies` (`id` ASC);

CREATE INDEX `feedback_id_idx` ON `cunxiaoo_houtai`.`feedback_replies` (`feedback_id` ASC);

CREATE INDEX `fbreply_author_id_idx` ON `cunxiaoo_houtai`.`feedback_replies` (`author_id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`logs`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`logs` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`logs` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '标识',
  `user_id` VARCHAR(200) NULL DEFAULT NULL COMMENT '证件号码',
  `rec_id` INT(11) NULL DEFAULT NULL,
  `action` VARCHAR(100) NOT NULL,
  `message` TEXT NULL DEFAULT NULL,
  `when` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`id`, `action`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = '系统日志';

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`logs` (`id` ASC);


-- -----------------------------------------------------
-- Table `cunxiaoo_houtai`.`user_role`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cunxiaoo_houtai`.`user_role` ;

CREATE TABLE IF NOT EXISTS `cunxiaoo_houtai`.`user_role` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `user_id` INT(11) NULL DEFAULT NULL,
  `role` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `cunxiaoo_houtai`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `id_UNIQUE` ON `cunxiaoo_houtai`.`user_role` (`id` ASC);

CREATE INDEX `user_id_idx` ON `cunxiaoo_houtai`.`user_role` (`user_id` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
