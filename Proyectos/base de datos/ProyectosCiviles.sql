SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `ProyectosCiviles` ;
CREATE SCHEMA IF NOT EXISTS `ProyectosCiviles` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ProyectosCiviles` ;

-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Entradas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Entradas` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Entradas` (
  `idEntradas` INT NOT NULL AUTO_INCREMENT ,
  `idEspecifico` INT NULL ,
  `idProveedor` INT NULL ,
  `FechaCompra` DATETIME NULL ,
  `CantidadProducto` INT NULL ,
  `ValorProducto` FLOAT NULL ,
  `PorcentajeIVA` INT NULL ,
  `CalculoIVA` FLOAT NULL ,
  `StockMinimo` INT NULL ,
  `StockMaximo` INT NULL ,
  `Anulada` BIT NULL ,
  PRIMARY KEY (`idEntradas`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Salidas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Salidas` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Salidas` (
  `idSalidas` INT NOT NULL AUTO_INCREMENT ,
  `idEspecifico` INT NULL ,
  `FechaSalida` DATETIME NULL ,
  `idProyecto` INT NULL ,
  `CantidadUtilizada` INT NULL ,
  `idPersonal` INT NULL ,
  PRIMARY KEY (`idSalidas`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Especifico`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Especifico` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Especifico` (
  `idEspecifico` INT NOT NULL AUTO_INCREMENT ,
  `idLinea` INT NULL ,
  `Descripcion` VARCHAR(250) NULL ,
  `UnidadMedida` INT NULL ,
  PRIMARY KEY (`idEspecifico`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Lineas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Lineas` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Lineas` (
  `idLineas` INT NOT NULL AUTO_INCREMENT ,
  `idUnidad` INT NULL ,
  `Descripcion` VARCHAR(150) NULL ,
  PRIMARY KEY (`idLineas`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Unidad`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Unidad` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Unidad` (
  `idUnidad` INT NOT NULL ,
  `Descripcion` VARCHAR(80) NULL ,
  PRIMARY KEY (`idUnidad`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Proveedores`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Proveedores` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Proveedores` (
  `idProveedor` INT NOT NULL AUTO_INCREMENT ,
  `NombreProveedor` VARCHAR(250) NULL ,
  `NIT` VARCHAR(14) NULL ,
  `RazonSocial` VARCHAR(250) NULL ,
  `Direccion` VARCHAR(250) NULL ,
  `Telefonos` VARCHAR(80) NULL ,
  PRIMARY KEY (`idProveedor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Proyectos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Proyectos` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Proyectos` (
  `idProyectos` INT NOT NULL AUTO_INCREMENT ,
  `NombreProyecto` VARCHAR(250) NULL ,
  `FechaInicio` DATETIME NULL ,
  `FechaFin` DATETIME NULL ,
  `idTipoProyecto` INT NULL ,
  `CostoProyectado` FLOAT NULL ,
  `idPersonal` INT NULL ,
  PRIMARY KEY (`idProyectos`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Usuarios`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Usuarios` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Usuarios` (
  `idPersonal` INT NOT NULL AUTO_INCREMENT ,
  `Usuario` VARCHAR(45) NULL ,
  `Contrasena` VARCHAR(45) NULL ,
  `NivelConfianza` INT NULL ,
  `Activo` BIT NULL ,
  PRIMARY KEY (`idPersonal`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Personal`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Personal` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Personal` (
  `idPersonal` INT NOT NULL AUTO_INCREMENT ,
  `Nombres` VARCHAR(250) NULL ,
  `Apellidos` VARCHAR(250) NULL ,
  `FechaIngreso` DATETIME NULL ,
  `FechaNacimiento` INT NULL ,
  `idTipoEmpleado` INT NULL ,
  `Habilidad1` VARCHAR(150) NULL ,
  `Habilidad2` VARCHAR(150) NULL ,
  `Habilidad3` VARCHAR(150) NULL ,
  `DUI` VARCHAR(9) NULL ,
  `NIT` VARCHAR(14) NULL ,
  `Pasaporte` VARCHAR(20) NULL ,
  `Nacionalidad` VARCHAR(45) NULL ,
  `AFP` INT NULL ,
  `NUP` VARCHAR(20) NULL ,
  `ISSS` VARCHAR(15) NULL ,
  `SalarioMensual` FLOAT NULL ,
  PRIMARY KEY (`idPersonal`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`TipoEmpleado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`TipoEmpleado` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`TipoEmpleado` (
  `idTipoEmpleado` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(150) NULL ,
  `idExperiencia` INT NULL ,
  PRIMARY KEY (`idTipoEmpleado`) )
ENGINE = InnoDB;

CREATE UNIQUE INDEX `idExperiencia_UNIQUE` ON `ProyectosCiviles`.`TipoEmpleado` (`idExperiencia` ASC) ;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Experiencia`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`Experiencia` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Experiencia` (
  `idExperiencia` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(20) NULL ,
  PRIMARY KEY (`idExperiencia`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`UnidadesMedida`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`UnidadesMedida` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`UnidadesMedida` (
  `idUnidadesMedida` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`idUnidadesMedida`) )
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`NivelConfianza`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ProyectosCiviles`.`NivelConfianza` ;

CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`NivelConfianza` (
  `idNivelConfianza` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(45) NULL ,
  PRIMARY KEY (`idNivelConfianza`) )
ENGINE = InnoDB;

USE `ProyectosCiviles` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
