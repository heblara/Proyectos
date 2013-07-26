SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
CREATE SCHEMA IF NOT EXISTS `ProyectosCiviles` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;
USE `ProyectosCiviles` ;

-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Entradas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Entradas` (
  `idEntradas` INT NOT NULL AUTO_INCREMENT ,
  `idEspecifico` INT NULL DEFAULT NULL ,
  `idProveedor` INT NULL DEFAULT NULL ,
  `FechaCompra` DATETIME NULL DEFAULT NULL ,
  `CantidadProducto` INT NULL DEFAULT NULL ,
  `ValorProducto` FLOAT NULL DEFAULT NULL ,
  `PorcentajeIVA` INT NULL DEFAULT NULL ,
  `CalculoIVA` FLOAT NULL DEFAULT NULL ,
  `StockMinimo` INT NULL DEFAULT NULL ,
  `StockMaximo` INT NULL DEFAULT NULL ,
  `Anulada` BIT NULL DEFAULT NULL ,
  PRIMARY KEY (`idEntradas`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Salidas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Salidas` (
  `idSalidas` INT NOT NULL AUTO_INCREMENT ,
  `idEspecifico` INT NULL DEFAULT NULL ,
  `FechaSalida` DATETIME NULL DEFAULT NULL ,
  `idProyecto` INT NULL DEFAULT NULL ,
  `CantidadUtilizada` INT NULL DEFAULT NULL ,
  `idPersonal` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`idSalidas`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Especifico`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Especifico` (
  `idEspecifico` INT NOT NULL AUTO_INCREMENT ,
  `idLinea` INT NULL DEFAULT NULL ,
  `Descripcion` VARCHAR(250) NULL DEFAULT NULL ,
  `UnidadMedida` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`idEspecifico`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Lineas`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Lineas` (
  `idLineas` INT NOT NULL AUTO_INCREMENT ,
  `idUnidad` INT NULL DEFAULT NULL ,
  `Descripcion` VARCHAR(150) NULL DEFAULT NULL ,
  `Especifico_idEspecifico` INT NOT NULL ,
  PRIMARY KEY (`idLineas`, `Especifico_idEspecifico`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Unidad`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Unidad` (
  `idUnidad` INT NOT NULL ,
  `Descripcion` VARCHAR(80) NULL DEFAULT NULL ,
  PRIMARY KEY (`idUnidad`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Proveedores`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Proveedores` (
  `idProveedor` INT NOT NULL AUTO_INCREMENT ,
  `NombreProveedor` VARCHAR(250) NULL DEFAULT NULL ,
  `NIT` VARCHAR(14) NULL DEFAULT NULL ,
  `RazonSocial` VARCHAR(250) NULL DEFAULT NULL ,
  `Direccion` VARCHAR(250) NULL DEFAULT NULL ,
  `Telefonos` VARCHAR(80) NULL DEFAULT NULL ,
  PRIMARY KEY (`idProveedor`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Proyectos`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Proyectos` (
  `idProyectos` INT NOT NULL AUTO_INCREMENT ,
  `NombreProyecto` VARCHAR(250) NULL DEFAULT NULL ,
  `FechaInicio` DATETIME NULL DEFAULT NULL ,
  `FechaFin` DATETIME NULL DEFAULT NULL ,
  `idTipoProyecto` INT NULL DEFAULT NULL ,
  `CostoProyectado` FLOAT NULL DEFAULT NULL ,
  `idPersonal` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`idProyectos`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Usuarios`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Usuarios` (
  `idPersonal` INT NOT NULL AUTO_INCREMENT ,
  `Usuario` VARCHAR(45) NULL DEFAULT NULL ,
  `Contrasena` VARCHAR(45) NULL DEFAULT NULL ,
  `NivelConfianza` INT NULL DEFAULT NULL ,
  `Activo` BIT NULL DEFAULT NULL ,
  PRIMARY KEY (`idPersonal`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Personal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Personal` (
  `idPersonal` INT NOT NULL AUTO_INCREMENT ,
  `Nombres` VARCHAR(250) NULL DEFAULT NULL ,
  `Apellidos` VARCHAR(250) NULL DEFAULT NULL ,
  `FechaIngreso` DATETIME NULL DEFAULT NULL ,
  `FechaNacimiento` INT NULL DEFAULT NULL ,
  `idTipoEmpleado` INT NULL DEFAULT NULL ,
  `Habilidad1` VARCHAR(150) NULL DEFAULT NULL ,
  `Habilidad2` VARCHAR(150) NULL DEFAULT NULL ,
  `Habilidad3` VARCHAR(150) NULL DEFAULT NULL ,
  `DUI` VARCHAR(9) NULL DEFAULT NULL ,
  `NIT` VARCHAR(14) NULL DEFAULT NULL ,
  `Pasaporte` VARCHAR(20) NULL DEFAULT NULL ,
  `Nacionalidad` VARCHAR(45) NULL DEFAULT NULL ,
  `AFP` INT NULL DEFAULT NULL ,
  `NUP` VARCHAR(20) NULL DEFAULT NULL ,
  `ISSS` VARCHAR(15) NULL DEFAULT NULL ,
  `SalarioMensual` FLOAT NULL DEFAULT NULL ,
  PRIMARY KEY (`idPersonal`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`TipoEmpleado`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`TipoEmpleado` (
  `idTipoEmpleado` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(150) NULL DEFAULT NULL ,
  `idExperiencia` INT NULL DEFAULT NULL ,
  PRIMARY KEY (`idTipoEmpleado`) ,
  UNIQUE INDEX `idExperiencia_UNIQUE` (`idExperiencia` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Experiencia`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Experiencia` (
  `idExperiencia` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(20) NULL DEFAULT NULL ,
  PRIMARY KEY (`idExperiencia`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`UnidadesMedida`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`UnidadesMedida` (
  `idUnidadesMedida` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idUnidadesMedida`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`NivelConfianza`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`NivelConfianza` (
  `idNivelConfianza` INT NOT NULL AUTO_INCREMENT ,
  `Descripcion` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`idNivelConfianza`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`Proyectos_has_Personal`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`Proyectos_has_Personal` (
  `Proyectos_idProyectos` INT NOT NULL ,
  `Personal_idPersonal` INT NOT NULL ,
  PRIMARY KEY (`Proyectos_idProyectos`, `Personal_idPersonal`) ,
  INDEX `fk_Proyectos_has_Personal_Proyectos1` (`Proyectos_idProyectos` ASC) ,
  INDEX `fk_Proyectos_has_Personal_Personal1` (`Personal_idPersonal` ASC) ,
  CONSTRAINT `fk_Proyectos_has_Personal_Proyectos1`
    FOREIGN KEY (`Proyectos_idProyectos` )
    REFERENCES `ProyectosCiviles`.`Proyectos` (`idProyectos` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Proyectos_has_Personal_Personal1`
    FOREIGN KEY (`Personal_idPersonal` )
    REFERENCES `ProyectosCiviles`.`Personal` (`idPersonal` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ProyectosCiviles`.`TipoProyecto`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `ProyectosCiviles`.`TipoProyecto` (
  `idTipoProyecto` INT NOT NULL ,
  `Nombre` VARCHAR(45) NULL ,
  `Descripcion` TEXT NULL ,
  `Imagen` VARCHAR(100) NULL ,
  PRIMARY KEY (`idTipoProyecto`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
