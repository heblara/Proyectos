-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-07-2013 a las 06:31:28
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyectosciviles`
--
CREATE DATABASE `proyectosciviles` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `proyectosciviles`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE IF NOT EXISTS `entradas` (
  `idEntradas` int(11) NOT NULL AUTO_INCREMENT,
  `idEspecifico` int(11) DEFAULT NULL,
  `idProveedor` int(11) DEFAULT NULL,
  `FechaCompra` datetime DEFAULT NULL,
  `CantidadProducto` int(11) DEFAULT NULL,
  `ValorProducto` float DEFAULT NULL,
  `PorcentajeIVA` int(11) DEFAULT NULL,
  `CalculoIVA` float DEFAULT NULL,
  `StockMinimo` int(11) DEFAULT NULL,
  `StockMaximo` int(11) DEFAULT NULL,
  `Anulada` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idEntradas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `entradas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especifico`
--

CREATE TABLE IF NOT EXISTS `especifico` (
  `idEspecifico` int(11) NOT NULL AUTO_INCREMENT,
  `idLinea` int(11) DEFAULT NULL,
  `Descripcion` varchar(250) DEFAULT NULL,
  `UnidadMedida` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEspecifico`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `especifico`
--

INSERT INTO `especifico` (`idEspecifico`, `idLinea`, `Descripcion`, `UnidadMedida`) VALUES
(1, 1, 'Cemento', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia`
--

CREATE TABLE IF NOT EXISTS `experiencia` (
  `idExperiencia` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idExperiencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `experiencia`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE IF NOT EXISTS `lineas` (
  `idLineas` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) DEFAULT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  `Especifico_idEspecifico` int(11) NOT NULL,
  PRIMARY KEY (`idLineas`,`Especifico_idEspecifico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `lineas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelconfianza`
--

CREATE TABLE IF NOT EXISTS `nivelconfianza` (
  `idNivelConfianza` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idNivelConfianza`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `nivelconfianza`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `idPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `Nombres` varchar(250) DEFAULT NULL,
  `Apellidos` varchar(250) DEFAULT NULL,
  `FechaIngreso` datetime DEFAULT NULL,
  `FechaNacimiento` int(11) DEFAULT NULL,
  `idTipoEmpleado` int(11) DEFAULT NULL,
  `Habilidad1` varchar(150) DEFAULT NULL,
  `Habilidad2` varchar(150) DEFAULT NULL,
  `Habilidad3` varchar(150) DEFAULT NULL,
  `DUI` varchar(9) DEFAULT NULL,
  `NIT` varchar(14) DEFAULT NULL,
  `Pasaporte` varchar(20) DEFAULT NULL,
  `Nacionalidad` varchar(45) DEFAULT NULL,
  `AFP` int(11) DEFAULT NULL,
  `NUP` varchar(20) DEFAULT NULL,
  `ISSS` varchar(15) DEFAULT NULL,
  `SalarioMensual` float DEFAULT NULL,
  PRIMARY KEY (`idPersonal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `personal`
--

INSERT INTO `personal` (`idPersonal`, `Nombres`, `Apellidos`, `FechaIngreso`, `FechaNacimiento`, `idTipoEmpleado`, `Habilidad1`, `Habilidad2`, `Habilidad3`, `DUI`, `NIT`, `Pasaporte`, `Nacionalidad`, `AFP`, `NUP`, `ISSS`, `SalarioMensual`) VALUES
(1, 'dvcxc', 'xcvxcv', '0000-00-00 00:00:00', 7, NULL, 'hkj', 'hkj', 'hkj', 'hkj', 'hkj', 'hkj', 'h', 0, '5', 'kjh', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProveedor` varchar(250) DEFAULT NULL,
  `NIT` varchar(14) DEFAULT NULL,
  `RazonSocial` varchar(250) DEFAULT NULL,
  `Direccion` varchar(250) DEFAULT NULL,
  `Telefonos` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `proveedores`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
  `idProyectos` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProyecto` varchar(250) DEFAULT NULL,
  `FechaInicio` datetime DEFAULT NULL,
  `FechaFin` datetime DEFAULT NULL,
  `idTipoProyecto` int(11) DEFAULT NULL,
  `CostoProyectado` float DEFAULT NULL,
  `idPersonal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProyectos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `proyectos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos_has_personal`
--

CREATE TABLE IF NOT EXISTS `proyectos_has_personal` (
  `Proyectos_idProyectos` int(11) NOT NULL,
  `Personal_idPersonal` int(11) NOT NULL,
  PRIMARY KEY (`Proyectos_idProyectos`,`Personal_idPersonal`),
  KEY `fk_Proyectos_has_Personal_Proyectos1` (`Proyectos_idProyectos`),
  KEY `fk_Proyectos_has_Personal_Personal1` (`Personal_idPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `proyectos_has_personal`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE IF NOT EXISTS `salidas` (
  `idSalidas` int(11) NOT NULL AUTO_INCREMENT,
  `idEspecifico` int(11) DEFAULT NULL,
  `FechaSalida` datetime DEFAULT NULL,
  `idProyecto` int(11) DEFAULT NULL,
  `CantidadUtilizada` int(11) DEFAULT NULL,
  `idPersonal` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSalidas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `salidas`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempleado`
--

CREATE TABLE IF NOT EXISTS `tipoempleado` (
  `idTipoEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(150) DEFAULT NULL,
  `idExperiencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTipoEmpleado`),
  UNIQUE KEY `idExperiencia_UNIQUE` (`idExperiencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `tipoempleado`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproyecto`
--

CREATE TABLE IF NOT EXISTS `tipoproyecto` (
  `idTipoProyecto` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` text,
  `Imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTipoProyecto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `tipoproyecto`
--

INSERT INTO `tipoproyecto` (`idTipoProyecto`, `Nombre`, `Descripcion`, `Imagen`) VALUES
(1, 'Red Vial', 'Contruimos la red vial del país', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `idUnidad` int(11) NOT NULL,
  `Descripcion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idUnidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `unidad`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadesmedida`
--

CREATE TABLE IF NOT EXISTS `unidadesmedida` (
  `idUnidadesMedida` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idUnidadesMedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `unidadesmedida`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(45) DEFAULT NULL,
  `Contrasena` varchar(45) DEFAULT NULL,
  `NivelConfianza` int(11) DEFAULT NULL,
  `Activo` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idPersonal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idPersonal`, `Usuario`, `Contrasena`, `NivelConfianza`, `Activo`) VALUES
(1, 'hlara', 'hlara', 1, b'1');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `proyectos_has_personal`
--
ALTER TABLE `proyectos_has_personal`
  ADD CONSTRAINT `fk_Proyectos_has_Personal_Proyectos1` FOREIGN KEY (`Proyectos_idProyectos`) REFERENCES `proyectos` (`idProyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proyectos_has_Personal_Personal1` FOREIGN KEY (`Personal_idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;
