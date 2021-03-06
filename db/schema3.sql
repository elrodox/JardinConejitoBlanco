-- MySQL Script generated by MySQL Workbench
-- 11/19/15 23:04:06
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema jardin
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema jardin
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `jardin` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `jardin` ;

-- -----------------------------------------------------
-- Table `jardin`.`educadora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`educadora` (
  `id_educadora` INT NOT NULL AUTO_INCREMENT,
  `rut_educadora` VARCHAR(8) NOT NULL,
  `password` VARCHAR(15) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(80) NOT NULL,
  `administrador` TINYINT(1) NULL,
  `eliminado` TINYINT(1) NULL,
  `token` VARCHAR(15) NULL,
  PRIMARY KEY (`id_educadora`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`parvulo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`parvulo` (
  `id_parvulo` INT NOT NULL AUTO_INCREMENT,
  `rut_parvulo` VARCHAR(8) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `talla` INT NULL,
  `peso` FLOAT NULL,
  `eliminado` TINYINT(1) NULL,
  `token` VARCHAR(15) NULL,
  PRIMARY KEY (`id_parvulo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`noticia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`noticia` (
  `id_noticia` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(500) NOT NULL,
  `importante` TINYINT(1) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_noticia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`foto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`foto` (
  `id_foto` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(100) NOT NULL,
  `link` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`id_foto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`asistencia` (
  `id_asistencia` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_asistencia`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`hito`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`hito` (
  `id_hito` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(500) NOT NULL,
  `fecha` DATE NOT NULL,
  `id_parvulo` INT NOT NULL,
  PRIMARY KEY (`id_hito`),
  INDEX `fk_hito_parvulo1_idx` (`id_parvulo` ASC),
  CONSTRAINT `fk_hito_parvulo1`
    FOREIGN KEY (`id_parvulo`)
    REFERENCES `jardin`.`parvulo` (`id_parvulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`imprevisto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`imprevisto` (
  `id_imprevisto` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(500) NOT NULL,
  `fecha` DATE NOT NULL,
  `id_parvulo` INT NOT NULL,
  PRIMARY KEY (`id_imprevisto`),
  INDEX `fk_imprevisto_parvulo1_idx` (`id_parvulo` ASC),
  CONSTRAINT `fk_imprevisto_parvulo1`
    FOREIGN KEY (`id_parvulo`)
    REFERENCES `jardin`.`parvulo` (`id_parvulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`documento` (
  `id_documento` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `link` VARCHAR(250) NOT NULL,
  `fecha` DATE NOT NULL,
  PRIMARY KEY (`id_documento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`parvulo_asistencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`parvulo_asistencia` (
  `id_asistencia` INT NOT NULL,
  `id_parvulo` INT NOT NULL,
  PRIMARY KEY (`id_asistencia`, `id_parvulo`),
  INDEX `fk_asistencia_has_parvulo_parvulo1_idx` (`id_parvulo` ASC),
  INDEX `fk_asistencia_has_parvulo_asistencia1_idx` (`id_asistencia` ASC),
  CONSTRAINT `fk_asistencia_has_parvulo_asistencia1`
    FOREIGN KEY (`id_asistencia`)
    REFERENCES `jardin`.`asistencia` (`id_asistencia`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asistencia_has_parvulo_parvulo1`
    FOREIGN KEY (`id_parvulo`)
    REFERENCES `jardin`.`parvulo` (`id_parvulo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `jardin`.`logs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `jardin`.`logs` (
  `id_educadora` INT NOT NULL,
  `id_elemento_accedido` INT NOT NULL,
  `tipo_log` VARCHAR(45) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `tabla_elemento_accedido` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_educadora`, `id_elemento_accedido`, `tipo_log`, `fecha`, `tabla_elemento_accedido`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
