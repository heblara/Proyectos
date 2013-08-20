-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-08-2013 a las 08:37:48
-- Versión del servidor: 5.5.16
-- Versión de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
  `idProveedor` int(11) NOT NULL,
  `FechaCompra` date NOT NULL,
  `CantidadProducto` int(11) NOT NULL,
  `ValorProducto` float NOT NULL,
  `PorcentajeIVA` int(11) NOT NULL,
  `CalculoIVA` float NOT NULL,
  `StockMinimo` int(11) NOT NULL,
  `StockMaximo` int(11) NOT NULL,
  `Anulada` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idEntradas`),
  KEY `fk_idproveedor_idx` (`idProveedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especifico`
--

CREATE TABLE IF NOT EXISTS `especifico` (
  `idEspecifico` int(11) NOT NULL AUTO_INCREMENT,
  `idSalidas` int(11) NOT NULL,
  `idEntradas` int(11) NOT NULL,
  `idLinea` int(11) NOT NULL,
  `idUnidadMedida` int(11) NOT NULL,
  `Descripcion` varchar(250) NOT NULL,
  PRIMARY KEY (`idEspecifico`),
  KEY `fk_Especifico_Entradas1_idx` (`idEntradas`),
  KEY `fk_Especifico_Salidas1_idx` (`idSalidas`),
  KEY `fk_linea_idx` (`idLinea`),
  KEY `fk_unidad_medida_idx` (`idUnidadMedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia`
--

CREATE TABLE IF NOT EXISTS `experiencia` (
  `idExperiencia` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`idExperiencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `experiencia`
--

INSERT INTO `experiencia` (`idExperiencia`, `Descripcion`) VALUES
(1, 'Albañileria'),
(3, 'h'),
(4, 'uno'),
(5, 'asdasd'),
(6, 'asdad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE IF NOT EXISTS `lineas` (
  `idLineas` int(11) NOT NULL AUTO_INCREMENT,
  `idUnidad` int(11) NOT NULL,
  `Descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`idLineas`),
  KEY `fk_unidad_idx` (`idUnidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivelconfianza`
--

CREATE TABLE IF NOT EXISTS `nivelconfianza` (
  `idNivelConfianza` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idNivelConfianza`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `nivelconfianza`
--

INSERT INTO `nivelconfianza` (`idNivelConfianza`, `Descripcion`) VALUES
(1, 'Uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `idPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoEmpleado` int(11) NOT NULL,
  `Nombres` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Habilidad1` varchar(40) DEFAULT NULL,
  `Habilidad2` varchar(40) DEFAULT NULL,
  `Habilidad3` varchar(40) DEFAULT NULL,
  `DUI` varchar(9) NOT NULL,
  `NIT` varchar(14) NOT NULL,
  `Pasaporte` varchar(20) DEFAULT NULL,
  `Nacionalidad` varchar(45) NOT NULL,
  `AFP` int(11) NOT NULL,
  `NUP` varchar(20) DEFAULT NULL,
  `ISSS` varchar(15) NOT NULL,
  `SalarioMensual` float NOT NULL,
  `Personalcol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idPersonal`),
  KEY `fk_tipo_empleado_idx` (`idTipoEmpleado`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`idPersonal`, `idTipoEmpleado`, `Nombres`, `Apellidos`, `FechaIngreso`, `FechaNacimiento`, `Habilidad1`, `Habilidad2`, `Habilidad3`, `DUI`, `NIT`, `Pasaporte`, `Nacionalidad`, `AFP`, `NUP`, `ISSS`, `SalarioMensual`, `Personalcol`) VALUES
(1, 1, 'Hom', 'Lop', '2012-03-01', '2003-02-01', 'Albañileria', NULL, NULL, '09876543-', '0987-123456-12', '0988213123123123', 'Salvadoreño', 1234567890, '0987654321', '11111876', 500, '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `idProveedor` int(11) NOT NULL AUTO_INCREMENT,
  `NombreProveedor` varchar(250) NOT NULL,
  `NIT` varchar(14) NOT NULL,
  `RazonSocial` varchar(250) DEFAULT NULL,
  `Direccion` varchar(250) NOT NULL,
  `Telefonos` varchar(80) NOT NULL,
  PRIMARY KEY (`idProveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `NombreProveedor`, `NIT`, `RazonSocial`, `Direccion`, `Telefonos`) VALUES
(1, 'Freund', '09809123891289', 'ajdoiasudiou', 'iasuioaduioasdu', 'iaoudsiasudioasudoasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
  `idProyectos` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoProyecto` int(11) NOT NULL,
  `NombreProyecto` varchar(50) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `CostoProyectado` float NOT NULL,
  PRIMARY KEY (`idProyectos`),
  KEY `fk_tipo_proyecto_idx` (`idTipoProyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idProyectos`, `idTipoProyecto`, `NombreProyecto`, `FechaInicio`, `FechaFin`, `CostoProyectado`) VALUES
(1, 1, 'Construcción de vivienda', '2013-08-01', '2013-12-23', 0),
(2, 2, 'asdasd', '2013-08-01', '2013-08-16', 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos_has_personal`
--

CREATE TABLE IF NOT EXISTS `proyectos_has_personal` (
  `Proyectos_idProyectos` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonal` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  PRIMARY KEY (`Proyectos_idProyectos`),
  KEY `fk_Proyectos_has_Personal_Personal1` (`idPersonal`),
  KEY `fk_Proyectos_has_Personal_Proyectos1_idx` (`idProyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proyectos_has_personal`
--

INSERT INTO `proyectos_has_personal` (`Proyectos_idProyectos`, `idPersonal`, `idProyecto`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE IF NOT EXISTS `salidas` (
  `idSalidas` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonal` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `CantidadUtilizada` int(11) NOT NULL,
  `FechaSalida` datetime NOT NULL,
  PRIMARY KEY (`idSalidas`),
  KEY `fk_idproyectos_idx` (`idProyecto`),
  KEY `fk_personal_idx` (`idPersonal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempleado`
--

CREATE TABLE IF NOT EXISTS `tipoempleado` (
  `idTipoEmpleado` int(11) NOT NULL AUTO_INCREMENT,
  `idExperiencia` int(11) NOT NULL,
  `Descripcion` varchar(150) NOT NULL,
  PRIMARY KEY (`idTipoEmpleado`),
  UNIQUE KEY `idExperiencia_UNIQUE` (`idExperiencia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tipoempleado`
--

INSERT INTO `tipoempleado` (`idTipoEmpleado`, `idExperiencia`, `Descripcion`) VALUES
(1, 1, 'Asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoproyecto`
--

CREATE TABLE IF NOT EXISTS `tipoproyecto` (
  `idTipoProyecto` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) NOT NULL,
  `Descripcion` text NOT NULL,
  `Imagen` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTipoProyecto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipoproyecto`
--

INSERT INTO `tipoproyecto` (`idTipoProyecto`, `Nombre`, `Descripcion`, `Imagen`) VALUES
(1, 'Urbano', 'Construcción de areas urbanas', NULL),
(2, 'Red vial', 'Construimos las mejores redes viales del país', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `idUnidad` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`idUnidad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`idUnidad`, `Descripcion`) VALUES
(1, 'uno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidadesmedida`
--

CREATE TABLE IF NOT EXISTS `unidadesmedida` (
  `idUnidadesMedida` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idUnidadesMedida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuarios` int(11) NOT NULL AUTO_INCREMENT,
  `idNivelConfianza` int(11) NOT NULL,
  `idPersonal` int(11) NOT NULL,
  `Usuario` varchar(45) NOT NULL,
  `Contrasena` varchar(45) NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUsuarios`),
  UNIQUE KEY `Usuario_UNIQUE` (`Usuario`),
  KEY `fk_nivel_confianza_idx` (`idNivelConfianza`),
  KEY `fk_id_personal_idx` (`idPersonal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `idNivelConfianza`, `idPersonal`, `Usuario`, `Contrasena`, `Activo`) VALUES
(1, 1, 1, 'hlara', '2641f195611e782b3e472ab286349c81', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_idproveedor` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `especifico`
--
ALTER TABLE `especifico`
  ADD CONSTRAINT `fk_Especifico_Entradas1` FOREIGN KEY (`idEntradas`) REFERENCES `entradas` (`idEntradas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Especifico_Salidas1` FOREIGN KEY (`idSalidas`) REFERENCES `salidas` (`idSalidas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_linea` FOREIGN KEY (`idLinea`) REFERENCES `lineas` (`idLineas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_unidad_medida` FOREIGN KEY (`idUnidadMedida`) REFERENCES `unidadesmedida` (`idUnidadesMedida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `fk_unidad` FOREIGN KEY (`idUnidad`) REFERENCES `unidad` (`idUnidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `fk_tipo_empleado` FOREIGN KEY (`idTipoEmpleado`) REFERENCES `tipoempleado` (`idTipoEmpleado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyectos`
--
ALTER TABLE `proyectos`
  ADD CONSTRAINT `fk_tipo_proyecto` FOREIGN KEY (`idTipoProyecto`) REFERENCES `tipoproyecto` (`idTipoProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyectos_has_personal`
--
ALTER TABLE `proyectos_has_personal`
  ADD CONSTRAINT `fk_Proyectos_has_Personal_Personal1` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Proyectos_has_Personal_Proyectos1` FOREIGN KEY (`idProyecto`) REFERENCES `proyectos` (`idProyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD CONSTRAINT `fk_idproyectos` FOREIGN KEY (`idProyecto`) REFERENCES `proyectos` (`idProyectos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_personal` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tipoempleado`
--
ALTER TABLE `tipoempleado`
  ADD CONSTRAINT `fk_experiencia` FOREIGN KEY (`idExperiencia`) REFERENCES `experiencia` (`idExperiencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_personal` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nivel_confianza` FOREIGN KEY (`idNivelConfianza`) REFERENCES `nivelconfianza` (`idNivelConfianza`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
