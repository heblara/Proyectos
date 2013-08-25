-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-08-2013 a las 08:28:39
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE IF NOT EXISTS `entradas` (
  `idEntradas` int(11) NOT NULL AUTO_INCREMENT,
  `idProveedor` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `FechaCompra` date NOT NULL,
  `CantidadProducto` int(11) NOT NULL,
  `ValorProducto` float NOT NULL,
  `PorcentajeIVA` int(11) NOT NULL,
  `CalculoIVA` float NOT NULL,
  `StockMinimo` int(11) NOT NULL,
  `StockMaximo` int(11) NOT NULL,
  `Anulada` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idEntradas`),
  KEY `fk_idproveedor_idx` (`idProveedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`idEntradas`, `idProveedor`, `Descripcion`, `FechaCompra`, `CantidadProducto`, `ValorProducto`, `PorcentajeIVA`, `CalculoIVA`, `StockMinimo`, `StockMaximo`, `Anulada`) VALUES
(1, 1, 'Clavos', '2013-09-11', 100, 0.03, 13, 0.39, 12, 100, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `idEquipos` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `actividad` varchar(250) NOT NULL,
  PRIMARY KEY (`idEquipos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idEquipos`, `nombre`, `actividad`) VALUES
(1, 'Equipo Uno', 'Equipos que trabajaran en la programacion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_personal`
--

CREATE TABLE IF NOT EXISTS `equipo_personal` (
  `idEquipoPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `idEquipos` int(11) NOT NULL,
  `idPersonal` int(11) NOT NULL,
  PRIMARY KEY (`idEquipoPersonal`),
  KEY `fk_personal_equipo_idx` (`idPersonal`),
  KEY `fk_equipo_personal_idx` (`idEquipos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `equipo_personal`
--

INSERT INTO `equipo_personal` (`idEquipoPersonal`, `idEquipos`, `idPersonal`) VALUES
(1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `experiencia`
--

INSERT INTO `experiencia` (`idExperiencia`, `Descripcion`) VALUES
(1, 'Albañil');

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
(1, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE IF NOT EXISTS `personal` (
  `idPersonal` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoEmpleado` int(11) NOT NULL,
  `Nombres` varchar(250) NOT NULL,
  `Apellidos` varchar(250) NOT NULL,
  `FechaIngreso` date NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Habilidad1` varchar(150) DEFAULT NULL,
  `Habilidad2` varchar(150) DEFAULT NULL,
  `Habilidad3` varchar(150) DEFAULT NULL,
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
(1, 1, 'Hom', 'Lop', '2013-05-07', '2013-08-16', 'Albañileria', 'Fontaneria', 'Plomero', '099090909', '0987-123456-12', '0988213123123123', '0920192019201', 2147483647, '67567567567', '97987879', 500, '12');

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
(1, 'Freund', '02021231231231', 'kijsfkjsdkl', 'kjkjksdjf', 'kljsdklfjldskf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyectos`
--

CREATE TABLE IF NOT EXISTS `proyectos` (
  `idProyectos` int(11) NOT NULL AUTO_INCREMENT,
  `idTipoProyecto` int(11) NOT NULL,
  `idEquipos` int(11) NOT NULL,
  `NombreProyecto` varchar(250) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date DEFAULT NULL,
  `CostoProyectado` float NOT NULL,
  `Imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`idProyectos`),
  KEY `fk_tipo_proyecto_idx` (`idTipoProyecto`),
  KEY `fk_proyecto_equipos_idx` (`idEquipos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proyectos`
--

INSERT INTO `proyectos` (`idProyectos`, `idTipoProyecto`, `idEquipos`, `NombreProyecto`, `FechaInicio`, `FechaFin`, `CostoProyectado`, `Imagen`) VALUES
(1, 1, 1, 'Construccion de carretera', '2013-09-01', '2013-09-30', 500000, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE IF NOT EXISTS `salidas` (
  `idSalidas` int(11) NOT NULL AUTO_INCREMENT,
  `idPersonal` int(11) NOT NULL,
  `idProyecto` int(11) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `CantidadUtilizada` int(11) NOT NULL,
  `FechaSalida` date NOT NULL,
  PRIMARY KEY (`idSalidas`),
  KEY `fk_idproyectos_idx` (`idProyecto`),
  KEY `fk_personal_idx` (`idPersonal`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`idSalidas`, `idPersonal`, `idProyecto`, `Descripcion`, `CantidadUtilizada`, `FechaSalida`) VALUES
(1, 1, 1, ' Clavos', 50, '2013-09-02'),
(2, 1, 1, 'Clavos', 10, '2013-09-11');

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
(1, 1, 'Uno');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tipoproyecto`
--

INSERT INTO `tipoproyecto` (`idTipoProyecto`, `Nombre`, `Descripcion`, `Imagen`) VALUES
(1, 'Red Vial', 'Se construyen redes viales en todo el país', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE IF NOT EXISTS `unidad` (
  `idUnidad` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(80) NOT NULL,
  PRIMARY KEY (`idUnidad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Filtros para la tabla `equipo_personal`
--
ALTER TABLE `equipo_personal`
  ADD CONSTRAINT `fk_personal_equipo` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_equipo_personal` FOREIGN KEY (`idEquipos`) REFERENCES `equipos` (`idEquipos`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `especifico`
--
ALTER TABLE `especifico`
  ADD CONSTRAINT `fk_Especifico_Salidas1` FOREIGN KEY (`idSalidas`) REFERENCES `salidas` (`idSalidas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Especifico_Entradas1` FOREIGN KEY (`idEntradas`) REFERENCES `entradas` (`idEntradas`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `fk_proyecto_equipos` FOREIGN KEY (`idEquipos`) REFERENCES `equipos` (`idEquipos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tipo_proyecto` FOREIGN KEY (`idTipoProyecto`) REFERENCES `tipoproyecto` (`idTipoProyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_nivel_confianza` FOREIGN KEY (`idNivelConfianza`) REFERENCES `nivelconfianza` (`idNivelConfianza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_personal` FOREIGN KEY (`idPersonal`) REFERENCES `personal` (`idPersonal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
