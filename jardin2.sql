-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-12-2013 a las 02:38:46
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `jardin2`
--
CREATE DATABASE IF NOT EXISTS `jardin2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `jardin2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE IF NOT EXISTS `alumno` (
  `rut_alum` varchar(12) NOT NULL,
  `pri_nom_alum` varchar(50) NOT NULL,
  `sec_nom_alum` varchar(50) NOT NULL,
  `apes_alum` varchar(50) NOT NULL,
  `fec_nac` datetime NOT NULL,
  `ciu_alum` varchar(30) NOT NULL,
  `dir_alum` varchar(100) NOT NULL,
  `fon_alum` varchar(15) DEFAULT NULL,
  `per_vive` int(11) NOT NULL,
  PRIMARY KEY (`rut_alum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`rut_alum`, `pri_nom_alum`, `sec_nom_alum`, `apes_alum`, `fec_nac`, `ciu_alum`, `dir_alum`, `fon_alum`, `per_vive`) VALUES
('333-3', 'juanito', 'andres', 'perez perez', '2010-02-10 00:00:00', 'Rancagua', 'matancilla', '2345678', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumsedenivel`
--

CREATE TABLE IF NOT EXISTS `alumsedenivel` (
  `cod_alumsedenivel` int(11) NOT NULL AUTO_INCREMENT,
  `id_sn` int(11) NOT NULL,
  `rut_alum` varchar(12) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cod_alumsedenivel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ante_alimenticios`
--

CREATE TABLE IF NOT EXISTS `ante_alimenticios` (
  `cod_ante_ali` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `molidos` int(11) NOT NULL,
  `enteros` int(11) NOT NULL,
  `solo` int(11) NOT NULL,
  `rech_ali` int(11) NOT NULL,
  `nom_ali_rech` varchar(100) NOT NULL,
  `tip_apetito` varchar(50) NOT NULL,
  `tom_leche` int(11) NOT NULL,
  `form_lactea` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_ante_ali`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ante_pre_pos`
--

CREATE TABLE IF NOT EXISTS `ante_pre_pos` (
  `cod_ante` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `prob_embarazo` varchar(100) DEFAULT NULL,
  `tip_parto` varchar(50) DEFAULT NULL,
  `peso` varchar(10) DEFAULT NULL,
  `talla` varchar(10) DEFAULT NULL,
  `grup_sanguineo` varchar(10) DEFAULT NULL,
  `alergias` varchar(100) DEFAULT NULL,
  `med_prohibido` varchar(100) DEFAULT NULL,
  `fiebre` varchar(100) NOT NULL,
  `nom_pediatra` varchar(50) DEFAULT NULL,
  `vacunas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_ante`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ant_papas`
--

CREATE TABLE IF NOT EXISTS `ant_papas` (
  `cod_papas` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `nom_mama` varchar(100) DEFAULT NULL,
  `fec_nac_mama` date DEFAULT NULL,
  `ocu_mama` varchar(50) DEFAULT NULL,
  `fono_mama` varchar(15) DEFAULT NULL,
  `lug_trabajo_mama` varchar(50) DEFAULT NULL,
  `fono_trab_mama` varchar(15) DEFAULT NULL,
  `nom_papa` varchar(50) DEFAULT NULL,
  `fec_nac_papa` date DEFAULT NULL,
  `ocu_papa` varchar(50) DEFAULT NULL,
  `fono_papa` varchar(15) DEFAULT NULL,
  `lug_trab_papa` varchar(50) DEFAULT NULL,
  `fono_trab_papa` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`cod_papas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asissedenivel`
--

CREATE TABLE IF NOT EXISTS `asissedenivel` (
  `cod_asn` int(11) NOT NULL AUTO_INCREMENT,
  `id_sn` int(11) NOT NULL,
  `rut_empleado` varchar(12) NOT NULL,
  PRIMARY KEY (`cod_asn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `backup`
--

CREATE TABLE IF NOT EXISTS `backup` (
  `manual` date NOT NULL,
  `dia` varchar(10) NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `backup`
--

INSERT INTO `backup` (`manual`, `dia`, `hora`) VALUES
('2013-11-19', '', '00:00:00'),
('0000-00-00', 'viernes', '12:00:00'),
('2013-11-20', '', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `con_esfinter`
--

CREATE TABLE IF NOT EXISTS `con_esfinter` (
  `cod_esfin` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `ves_dirno` int(11) NOT NULL,
  `ves_nocturno` int(11) NOT NULL,
  `ana_diurno` int(11) NOT NULL,
  `ana_nocturno` int(11) NOT NULL,
  PRIMARY KEY (`cod_esfin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emergencia`
--

CREATE TABLE IF NOT EXISTS `emergencia` (
  `cod_emer` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `nom_uno` varchar(50) NOT NULL,
  `fono_uno` varchar(15) NOT NULL,
  `nom_dos` varchar(50) NOT NULL,
  `fono_dos` varchar(15) NOT NULL,
  PRIMARY KEY (`cod_emer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple_domi`
--

CREATE TABLE IF NOT EXISTS `emple_domi` (
  `id_emple_domi` int(11) NOT NULL,
  `rut_empleado` varchar(12) NOT NULL,
  `dir_emple` varchar(100) DEFAULT NULL,
  `fono_emple` int(11) DEFAULT NULL,
  `ciu_emple` varchar(100) DEFAULT NULL,
  `provi_emple` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_emple_domi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple_generales`
--

CREATE TABLE IF NOT EXISTS `emple_generales` (
  `rut_empleado` varchar(12) NOT NULL,
  `fec_ingreso` varchar(20) NOT NULL,
  `prim_nom` varchar(20) NOT NULL,
  `sec_nom` varchar(20) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `genero` varchar(9) NOT NULL,
  `fec_nac` varchar(20) NOT NULL,
  `sede` int(11) NOT NULL,
  `posicion` varchar(50) NOT NULL,
  `exp_com` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`rut_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emple_generales`
--

INSERT INTO `emple_generales` (`rut_empleado`, `fec_ingreso`, `prim_nom`, `sec_nom`, `apellidos`, `email`, `genero`, `fec_nac`, `sede`, `posicion`, `exp_com`, `estado`) VALUES
('11111-1', '16/10/2013', '', 'Andrea', '0', 'cops175@gmail.com', '', '22/08/1988', 87, '', '', 1),
('222222-2', '22/10/2013', 'Juanita', 'juanita', 'Perez vargas', 'cops175@gmail.com', 'female', '21/01/1988', 86, 'Asistente', 'wdefrghjk', 1),
('7777-8', '12/12/2013', 'Juan', 'Andres', 'perez', 'email@mail.com', 'male', '14/01/1988', 89, 'Aseo', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emple_personales`
--

CREATE TABLE IF NOT EXISTS `emple_personales` (
  `id_emple_per` int(11) NOT NULL AUTO_INCREMENT,
  `rut_empleado` varchar(12) NOT NULL,
  `est_marital` varchar(30) DEFAULT NULL,
  `nom_padre` varchar(60) DEFAULT NULL,
  `nom_madre` varchar(60) DEFAULT NULL,
  `hemoclasi` varchar(20) DEFAULT NULL,
  `nacionalidad` varchar(20) DEFAULT NULL,
  `id_img` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_emple_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habi_suenos`
--

CREATE TABLE IF NOT EXISTS `habi_suenos` (
  `cod_sue` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `hr_siesta` time NOT NULL,
  `hrs_duerme` int(11) NOT NULL,
  `est_dormir` varchar(2) NOT NULL,
  PRIMARY KEY (`cod_sue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel`
--

CREATE TABLE IF NOT EXISTS `nivel` (
  `cod_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nom_nivel` varchar(20) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `nivel`
--

INSERT INTO `nivel` (`cod_nivel`, `nom_nivel`, `estado`) VALUES
(1, 'Sala Cuna', 1),
(2, 'Transicion', 1),
(3, 'Medio Menor', 1),
(5, 'Medio Mayor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otros`
--

CREATE TABLE IF NOT EXISTS `otros` (
  `cod_otro` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `otro_est` int(11) DEFAULT NULL,
  `nom_otro_est` varchar(50) DEFAULT NULL,
  `mot_retiro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_otro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE IF NOT EXISTS `pagos` (
  `cod_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `rut_nino` varchar(12) NOT NULL,
  `cod_tippago` int(11) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `enero` varchar(10) NOT NULL,
  `febrero` varchar(10) NOT NULL,
  `marzo` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_pagos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`cod_pagos`, `rut_nino`, `cod_tippago`, `matricula`, `enero`, `febrero`, `marzo`, `estado`) VALUES
(6, '7777-7', 1, 'No Pagado', 'No Pagado', 'No Pagado', 'No Pagado', 0),
(7, '888-8', 2, 'No Pagado', 'No Pagado', 'No Pagado', 'No Pagado', 1),
(8, '87878787-8', 2, 'No Pagado', 'No Pagado', 'No Pagado', 'No Pagado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE IF NOT EXISTS `sede` (
  `cod_sede` int(11) NOT NULL AUTO_INCREMENT,
  `nom_sede` varchar(15) DEFAULT NULL,
  `dir_sede` varchar(40) DEFAULT NULL,
  `tel_sede` int(6) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `rut_empleado` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`cod_sede`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`cod_sede`, `nom_sede`, `dir_sede`, `tel_sede`, `estado`, `rut_empleado`) VALUES
(86, 'Recreo', 'Av. Recreo #234', 3232568, 1, ''),
(87, 'EspaÃ±a', 'Av. EspaÃ±a #345', 66767, 1, ''),
(88, 'San Juan', 'Av. San Juan #876', 447762, 1, ''),
(89, 'Alameda', 'Av. alameda #456', 876543, 1, ''),
(91, 'einstein', 'avenida einstein 345', 987654, 1, ''),
(92, 'Alameda', 'Av. alameda #456', 876543, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedenivel`
--

CREATE TABLE IF NOT EXISTS `sedenivel` (
  `id_sn` int(11) NOT NULL AUTO_INCREMENT,
  `id_sede` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `rut_educadora` varchar(12) NOT NULL,
  PRIMARY KEY (`id_sn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `sedenivel`
--

INSERT INTO `sedenivel` (`id_sn`, `id_sede`, `id_nivel`, `rut_educadora`) VALUES
(1, 86, 5, ''),
(3, 86, 1, ''),
(7, 87, 2, ''),
(8, 87, 5, ''),
(24, 86, 2, ''),
(25, 87, 1, ''),
(26, 89, 1, ''),
(27, 86, 3, ''),
(28, 91, 5, ''),
(29, 88, 2, ''),
(30, 92, 1, ''),
(31, 92, 2, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE IF NOT EXISTS `tipopago` (
  `cod_tipPago` int(11) NOT NULL AUTO_INCREMENT,
  `jornada` varchar(10) NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_tipPago`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`cod_tipPago`, `jornada`, `precio`, `fecha`, `estado`) VALUES
(1, 'Media', 110000, '2012', 1),
(2, 'Completa', 160000, '2012', 1),
(3, 'Media', 115000, '2011', 0),
(4, 'Completa', 140000, '2011', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `rut_usu` varchar(12) NOT NULL,
  `nom_usu` varchar(30) NOT NULL,
  `fec_nac` date NOT NULL,
  `dir_usu` varchar(40) NOT NULL,
  `fono_usu` varchar(9) NOT NULL,
  `rol_usu` varchar(13) NOT NULL,
  `pass_usu` varchar(15) NOT NULL,
  `est_usu` int(1) NOT NULL,
  `cod_sede` int(1) DEFAULT NULL,
  `cod_nivel` int(1) DEFAULT NULL,
  PRIMARY KEY (`rut_usu`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`rut_usu`, `nom_usu`, `fec_nac`, `dir_usu`, `fono_usu`, `rol_usu`, `pass_usu`, `est_usu`, `cod_sede`, `cod_nivel`) VALUES
('17107682-k', 'juan perez', '2012-10-15', 'matancillas 237 manzanal', '53232', 'Administrador', '123456', 1, 0, 0),
('676767-5', 'Juan perez', '2012-10-10', 'matancillas #237 manzanal', '533378', 'Administrador', '123456', 1, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
