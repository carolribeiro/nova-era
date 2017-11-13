SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `nova_era` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `nova_era` ;

-- -----------------------------------------------------
-- Table `nova_era`.`tb_tipo_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nova_era`.`tb_tipo_usuarios` (
  `id_tipo` INT NOT NULL AUTO_INCREMENT ,
  `ds_tipo` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_tipo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nova_era`.`tb_usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nova_era`.`tb_usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT ,
  `ds_nome` VARCHAR(100) NOT NULL ,
  `ds_email` VARCHAR(100) NOT NULL ,
  `ds_senha` VARCHAR(100) NOT NULL ,
  `cd_tipo` INT NOT NULL ,
  PRIMARY KEY (`id_usuario`) ,
  INDEX `fk_tb_usuarios_tb_tipo_usuarios_idx` (`cd_tipo` ASC) ,
  CONSTRAINT `fk_tb_usuarios_tb_tipo_usuarios`
    FOREIGN KEY (`cd_tipo` )
    REFERENCES `nova_era`.`tb_tipo_usuarios` (`id_tipo` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nova_era`.`tb_noticias`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nova_era`.`tb_noticias` (
  `id_noticia` INT NOT NULL AUTO_INCREMENT ,
  `ds_titulo` VARCHAR(100) NULL ,
  `ds_subtitulo` VARCHAR(100) NULL ,
  `ds_imagem` VARCHAR(100) NULL ,
  `ds_noticia` LONGTEXT NULL ,
  `ds_fonte` VARCHAR(100) NULL ,
  `ds_link_fonte` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_noticia`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `nova_era`.`tb_documentos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `nova_era`.`tb_documentos` (
  `id_documento` INT NOT NULL AUTO_INCREMENT ,
  `ds_titulo` VARCHAR(100) NULL ,
  `ds_arquivo` VARCHAR(100) NULL ,
  PRIMARY KEY (`id_documento`) )
ENGINE = InnoDB;

USE `nova_era` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
