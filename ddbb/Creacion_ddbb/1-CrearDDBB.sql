-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema prueba-vocacional
-- -----------------------------------------------------
-- Base de datos para la Aplicacion "Prueba Vocacional".
DROP SCHEMA IF EXISTS `prueba-vocacional` ;

-- -----------------------------------------------------
-- Schema prueba-vocacional
--
-- Base de datos para la Aplicacion "Prueba Vocacional".
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `prueba-vocacional` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
SHOW WARNINGS;
USE `prueba-vocacional` ;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`categorias` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`categorias` (
  `cat_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_tipo` CHAR(2) NULL DEFAULT NULL,
  `cat_categoria` VARCHAR(50) NOT NULL,
  `cat_descripcion` VARCHAR(500) NOT NULL COMMENT 'Categorías (SS, EP, V, AP, MS, OG, CI, CL, MC, {AL = Aptitudes /DT = Intereses}) en las cuales se divide el area (Aptitudes o Intereses).',
  `cat_notas` VARCHAR(2000) NULL DEFAULT '',
  `cat_area` CHAR(1) NOT NULL COMMENT 'Area a la que pertenece la categoria',
  `cat_status` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo que puede ser usado, por ejemplo, para \"Activar\" o \"Desactivar\" la pregunta. Valor por defecto \"A\".',
  PRIMARY KEY (`cat_id`))
ENGINE = InnoDB
COMMENT = 'Aqui estan las diferentes categorias para cada una de las areas de INTERESES Y APTITUDES. La tabla contiene las categorias con su codigo, su nombre y su descripcion junto al area al que pertenecen.';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`conclusiones`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`conclusiones` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`conclusiones` (
  `concl_id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `concl_1cat_id` SMALLINT UNSIGNED NOT NULL,
  `concl_2cat_id` SMALLINT UNSIGNED NOT NULL,
  `concl_explicacion` VARCHAR(1000) NULL DEFAULT '',
  `concl_texto` VARCHAR(2000) NOT NULL,
  `concl_area` CHAR(1) NOT NULL,
  `concl_status` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Permite colocar una conclusion en estado Activo \'A\' o Desactivado (otro valor)',
  PRIMARY KEY (`concl_id`))
ENGINE = InnoDB
COMMENT = 'Aqui se encuentran los textos del analisis final de acuerdo a las categorias que fueron mas valoradas durante el examen, encontrandose los selectores en pares de indices segun las categorias mas altas.';

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`preguntas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`preguntas` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`preguntas` (
  `preg_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `preg_categ_id` SMALLINT UNSIGNED NOT NULL,
  `preg_pregunta` VARCHAR(300) NOT NULL,
  `preg_area` CHAR(1) NOT NULL COMMENT 'El AREA solo sera APTITUDES o INTERESES.',
  `preg_status` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo que puede ser usado, por ejemplo, para \"Activar\" o \"Desactivar\" la pregunta. Valor por defecto \"A\".',
  PRIMARY KEY (`preg_id`),
  CONSTRAINT `FK_preguntas_categorias`
    FOREIGN KEY (`preg_categ_id`)
    REFERENCES `prueba-vocacional`.`categorias` (`cat_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE INDEX `idx_preguntas_pregunta` ON `prueba-vocacional`.`preguntas` (`preg_pregunta` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `FK_preguntas_categorias_idx` ON `prueba-vocacional`.`preguntas` (`preg_categ_id` ASC) VISIBLE;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`tipos_usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`tipos_usuario` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`tipos_usuario` (
  `tipousua_id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tipoUsua_codigo` VARCHAR(3) NOT NULL,
  `tipousua_nombre` VARCHAR(20) NOT NULL,
  `tipousua_descripcion` VARCHAR(200) NOT NULL,
  `tipousua_notas` VARCHAR(3000) NULL DEFAULT NULL,
  PRIMARY KEY (`tipousua_id`))
ENGINE = InnoDB;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`usuarios` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`usuarios` (
  `usuarios_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuarios_usuario` VARCHAR(500) NOT NULL,
  `usuarios_password` VARCHAR(500) NOT NULL,
  `usuarios_nombres` VARCHAR(500) NOT NULL,
  `usuarios_apellido1` VARCHAR(500) NOT NULL,
  `usuarios_apellido2` VARCHAR(500) NULL DEFAULT NULL,
  `usuarios_nacimiento` DATE NOT NULL,
  `usuarios_creacionReg` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarios_email` VARCHAR(500) NULL DEFAULT NULL,
  `usuarios_telefono` VARCHAR(500) NULL DEFAULT NULL,
  `usuarios_notas` VARCHAR(10000) NULL DEFAULT NULL,
  `usuarios_status` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo que puede ser usado, por ejemplo, para \"Activar\" o \"Desactivar\" la pregunta. Valor por \"A\".',
  `usuarios_tipoUsuario_id` SMALLINT UNSIGNED NOT NULL,
  `usuarios_fExamenIntereses` DATETIME NULL DEFAULT '1000-01-01 00:00:00',
  `usuarios_fExamenAptitudes` DATETIME NULL DEFAULT '1000-01-01 00:00:00',
  `usuarios_fModificacion` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`usuarios_id`),
  CONSTRAINT `FK_usuarios_tipoUsuario`
    FOREIGN KEY (`usuarios_tipoUsuario_id`)
    REFERENCES `prueba-vocacional`.`tipos_usuario` (`tipousua_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `usuarios_usuario_UNIQUE` ON `prueba-vocacional`.`usuarios` (`usuarios_usuario` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `idx_usuarios_usuario` ON `prueba-vocacional`.`usuarios` (`usuarios_usuario` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `idx_usuarios_email` ON `prueba-vocacional`.`usuarios` (`usuarios_email` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `FK_usuarios_tipoUsuario_idx` ON `prueba-vocacional`.`usuarios` (`usuarios_tipoUsuario_id` ASC) INVISIBLE;

SHOW WARNINGS;
CREATE INDEX `idx_usuarios_fExamenIntereses` ON `prueba-vocacional`.`usuarios` (`usuarios_fExamenIntereses` ASC) INVISIBLE;

SHOW WARNINGS;
CREATE INDEX `idx_usuarios_fExamenAptitudes` ON `prueba-vocacional`.`usuarios` (`usuarios_fExamenAptitudes` ASC) VISIBLE;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`resultado_resumen`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`resultado_resumen` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`resultado_resumen` (
  `resulResumen_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `resulResumen_total` SMALLINT UNSIGNED NOT NULL DEFAULT '0',
  `resulResumen_usuario_id` INT UNSIGNED NOT NULL,
  `resulResumen_categoria_id` SMALLINT UNSIGNED NOT NULL,
  `resulResumen_area` CHAR(1) NOT NULL,
  PRIMARY KEY (`resulResumen_id`),
  CONSTRAINT `FK_resulResumen_categorias`
    FOREIGN KEY (`resulResumen_categoria_id`)
    REFERENCES `prueba-vocacional`.`categorias` (`cat_id`),
  CONSTRAINT `FK_resulResumen_usuarios`
    FOREIGN KEY (`resulResumen_usuario_id`)
    REFERENCES `prueba-vocacional`.`usuarios` (`usuarios_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `UN_resulResumen_usuario_id_categoria_id` ON `prueba-vocacional`.`resultado_resumen` (`resulResumen_usuario_id` ASC, `resulResumen_categoria_id` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `FK_resulResumen_usuarios_idx` ON `prueba-vocacional`.`resultado_resumen` (`resulResumen_usuario_id` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `FK_resulResumen_categorias_idx` ON `prueba-vocacional`.`resultado_resumen` (`resulResumen_categoria_id` ASC) VISIBLE;

SHOW WARNINGS;

-- -----------------------------------------------------
-- Table `prueba-vocacional`.`resultados`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `prueba-vocacional`.`resultados` ;

SHOW WARNINGS;
CREATE TABLE IF NOT EXISTS `prueba-vocacional`.`resultados` (
  `resul_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `resul_area` CHAR(1) NOT NULL COMMENT 'Solo dos posibles valores para el area de aplicacion de la prueba: APTITUDES o INTERESES.',
  `resul_usuario_id` INT UNSIGNED NOT NULL,
  `resul_pregunta_id` SMALLINT UNSIGNED NOT NULL,
  `resul_categoria_id` SMALLINT UNSIGNED NOT NULL,
  `resul_valor` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`resul_id`, `resul_valor`),
  CONSTRAINT `FK_resultados_categorias`
    FOREIGN KEY (`resul_categoria_id`)
    REFERENCES `prueba-vocacional`.`categorias` (`cat_id`),
  CONSTRAINT `FK_resultados_usuarios`
    FOREIGN KEY (`resul_usuario_id`)
    REFERENCES `prueba-vocacional`.`usuarios` (`usuarios_id`))
ENGINE = InnoDB;

SHOW WARNINGS;
CREATE UNIQUE INDEX `UN_resul_usuario_id_pregunta_id` ON `prueba-vocacional`.`resultados` (`resul_usuario_id` ASC, `resul_pregunta_id` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `FK_resultados_categorias_idx` ON `prueba-vocacional`.`resultados` (`resul_categoria_id` ASC) VISIBLE;

SHOW WARNINGS;
CREATE INDEX `FK_resultados_usuarios_idx` ON `prueba-vocacional`.`resultados` (`resul_usuario_id` ASC) VISIBLE;

SHOW WARNINGS;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
