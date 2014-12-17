CREATE DATABASE IF NOT EXISTS jardin2;

USE jardin2;

DROP TABLE IF EXISTS alumno;

CREATE TABLE `alumno` (
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

INSERT INTO alumno VALUES("333-3","juanito","andres","perez perez","2010-02-10 00:00:00","Rancagua","matancilla","2345678","2");



DROP TABLE IF EXISTS alumsedenivel;

CREATE TABLE `alumsedenivel` (
  `cod_alumsedenivel` int(11) NOT NULL AUTO_INCREMENT,
  `id_sn` int(11) NOT NULL,
  `rut_alum` varchar(12) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`cod_alumsedenivel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS ant_papas;

CREATE TABLE `ant_papas` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS ante_alimenticios;

CREATE TABLE `ante_alimenticios` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS ante_pre_pos;

CREATE TABLE `ante_pre_pos` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS asissedenivel;

CREATE TABLE `asissedenivel` (
  `cod_asn` int(11) NOT NULL AUTO_INCREMENT,
  `id_sn` int(11) NOT NULL,
  `rut_empleado` varchar(12) NOT NULL,
  PRIMARY KEY (`cod_asn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS backup;

CREATE TABLE `backup` (
  `manual` date NOT NULL,
  `dia` varchar(10) NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO backup VALUES("2013-11-19","","00:00:00");
INSERT INTO backup VALUES("0000-00-00","viernes","12:00:00");
INSERT INTO backup VALUES("2013-11-20","","00:00:00");



DROP TABLE IF EXISTS con_esfinter;

CREATE TABLE `con_esfinter` (
  `cod_esfin` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `ves_dirno` int(11) NOT NULL,
  `ves_nocturno` int(11) NOT NULL,
  `ana_diurno` int(11) NOT NULL,
  `ana_nocturno` int(11) NOT NULL,
  PRIMARY KEY (`cod_esfin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS emergencia;

CREATE TABLE `emergencia` (
  `cod_emer` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `nom_uno` varchar(50) NOT NULL,
  `fono_uno` varchar(15) NOT NULL,
  `nom_dos` varchar(50) NOT NULL,
  `fono_dos` varchar(15) NOT NULL,
  PRIMARY KEY (`cod_emer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS emple_domi;

CREATE TABLE `emple_domi` (
  `id_emple_domi` int(11) NOT NULL,
  `rut_empleado` varchar(12) NOT NULL,
  `dir_emple` varchar(100) DEFAULT NULL,
  `fono_emple` int(11) DEFAULT NULL,
  `ciu_emple` varchar(100) DEFAULT NULL,
  `provi_emple` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_emple_domi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS emple_generales;

CREATE TABLE `emple_generales` (
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

INSERT INTO emple_generales VALUES("11111-1","16/10/2013","Maria","Ignacia","Gonzalez Perez","cops175@gmail.com","female","22/08/1988","86","Asistente","QWERTYUJHBGFCDS","1");
INSERT INTO emple_generales VALUES("222222-2","22/10/2013","Juanita","juanita","Perez vargas","cops175@gmail.com","female","21/01/1988","86","Asistente","wdefrghjk","1");
INSERT INTO emple_generales VALUES("7777-8","12/12/2013","Juan","Andres","perez","email@mail.com","male","14/01/1988","89","Aseo","","1");



DROP TABLE IF EXISTS emple_personales;

CREATE TABLE `emple_personales` (
  `id_emple_per` int(11) NOT NULL AUTO_INCREMENT,
  `rut_empleado` varchar(12) NOT NULL,
  `est_marital` varchar(30) DEFAULT NULL,
  `nom_padre` varchar(60) DEFAULT NULL,
  `nom_madre` varchar(60) DEFAULT NULL,
  `hemoclasi` varchar(20) DEFAULT NULL,
  `nacionalidad` varchar(20) DEFAULT NULL,
  `id_img` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_emple_per`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS habi_suenos;

CREATE TABLE `habi_suenos` (
  `cod_sue` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `hr_siesta` time NOT NULL,
  `hrs_duerme` int(11) NOT NULL,
  `est_dormir` varchar(2) NOT NULL,
  PRIMARY KEY (`cod_sue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS nivel;

CREATE TABLE `nivel` (
  `cod_nivel` int(11) NOT NULL AUTO_INCREMENT,
  `nom_nivel` varchar(20) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO nivel VALUES("1","Sala Cuna","1");
INSERT INTO nivel VALUES("2","Transicion","1");
INSERT INTO nivel VALUES("3","Medio Menor","1");
INSERT INTO nivel VALUES("5","Medio Mayor","1");



DROP TABLE IF EXISTS otros;

CREATE TABLE `otros` (
  `cod_otro` int(11) NOT NULL AUTO_INCREMENT,
  `rut_alum` varchar(12) NOT NULL,
  `otro_est` int(11) DEFAULT NULL,
  `nom_otro_est` varchar(50) DEFAULT NULL,
  `mot_retiro` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_otro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS pagos;

CREATE TABLE `pagos` (
  `cod_pagos` int(11) NOT NULL AUTO_INCREMENT,
  `rut_nino` varchar(12) NOT NULL,
  `cod_tippago` int(11) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `enero` varchar(10) NOT NULL,
  `febrero` varchar(10) NOT NULL,
  `marzo` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_pagos`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO pagos VALUES("6","7777-7","1","No Pagado","No Pagado","No Pagado","No Pagado","0");
INSERT INTO pagos VALUES("7","888-8","2","No Pagado","No Pagado","No Pagado","No Pagado","1");
INSERT INTO pagos VALUES("8","87878787-8","2","No Pagado","No Pagado","No Pagado","No Pagado","1");



DROP TABLE IF EXISTS sede;

CREATE TABLE `sede` (
  `cod_sede` int(11) NOT NULL AUTO_INCREMENT,
  `nom_sede` varchar(15) DEFAULT NULL,
  `dir_sede` varchar(40) DEFAULT NULL,
  `tel_sede` int(6) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  `rut_empleado` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`cod_sede`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

INSERT INTO sede VALUES("86","Recreo","Av. Recreo #234","3232568","1","");
INSERT INTO sede VALUES("87","EspaÃ±a","Av. EspaÃ±a #345","66767","1","");
INSERT INTO sede VALUES("88","San Juan","Av. San Juan #876","447762","1","");
INSERT INTO sede VALUES("89","Alameda","Av. alameda #456","876543","1","");
INSERT INTO sede VALUES("91","einstein","avenida einstein 345","987654","1","");
INSERT INTO sede VALUES("92","Alameda","Av. alameda #456","876543","1","");
INSERT INTO sede VALUES("93","miguel ramirez","sdfvd","12345","1","");



DROP TABLE IF EXISTS sedenivel;

CREATE TABLE `sedenivel` (
  `id_sn` int(11) NOT NULL AUTO_INCREMENT,
  `id_sede` int(11) NOT NULL,
  `id_nivel` int(11) NOT NULL,
  `rut_educadora` varchar(12) NOT NULL,
  PRIMARY KEY (`id_sn`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

INSERT INTO sedenivel VALUES("1","86","5","11111-1");
INSERT INTO sedenivel VALUES("3","86","1","");
INSERT INTO sedenivel VALUES("7","87","2","");
INSERT INTO sedenivel VALUES("8","87","5","");
INSERT INTO sedenivel VALUES("24","86","2","11111-1");
INSERT INTO sedenivel VALUES("25","87","1","");
INSERT INTO sedenivel VALUES("26","89","1","");
INSERT INTO sedenivel VALUES("27","86","3","");
INSERT INTO sedenivel VALUES("28","91","5","");
INSERT INTO sedenivel VALUES("29","88","2","");
INSERT INTO sedenivel VALUES("30","92","1","");
INSERT INTO sedenivel VALUES("31","92","2","");
INSERT INTO sedenivel VALUES("50","11110","5","");
INSERT INTO sedenivel VALUES("51","11110","5","");
INSERT INTO sedenivel VALUES("52","11110","5","");
INSERT INTO sedenivel VALUES("53","0","0","");
INSERT INTO sedenivel VALUES("54","88","3","");



DROP TABLE IF EXISTS tipopago;

CREATE TABLE `tipopago` (
  `cod_tipPago` int(11) NOT NULL AUTO_INCREMENT,
  `jornada` varchar(10) NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`cod_tipPago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tipopago VALUES("1","Media","110000","2012","1");
INSERT INTO tipopago VALUES("2","Completa","160000","2012","1");
INSERT INTO tipopago VALUES("3","Media","115000","2011","0");
INSERT INTO tipopago VALUES("4","Completa","140000","2011","0");



DROP TABLE IF EXISTS usuarios;

CREATE TABLE `usuarios` (
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

INSERT INTO usuarios VALUES("17107682-k","juan perez","2012-10-15","matancillas 237 manzanal","53232","Administrador","123456","1","0","0");
INSERT INTO usuarios VALUES("676767-5","Juan perez","2012-10-10","matancillas #237 manzanal","533378","Administrador","123456","1","0","0");



