-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-02-2024 a las 04:52:06
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `atory`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `x` ()   BEGIN
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `tipoDocumento` varchar(10) NOT NULL DEFAULT 'CC',
  `documentoCliente` varchar(20) NOT NULL,
  `nombreCliente` varchar(100) NOT NULL,
  `telefonoCliente` varchar(20) NOT NULL,
  `correoCliente` varchar(100) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `estadoCliente` varchar(10) NOT NULL DEFAULT 'Activo',
  `plan_idPlan` int(11) NOT NULL,
  `creado` date DEFAULT NULL,
  `ultimaActualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `tipoDocumento`, `documentoCliente`, `nombreCliente`, `telefonoCliente`, `correoCliente`, `direccion`, `estadoCliente`, `plan_idPlan`, `creado`, `ultimaActualizacion`) VALUES
(1, 'C.C', '1055325484', 'Arnulfo Rodriguez', '3005554878', 'arnulfo@gmail.com', 'cll 148 # 98-41', 'Archivado', 1, '2023-05-12', '2023-05-17'),
(2, 'C.C', '1030525484', 'Blanca Cordero', '3008562013', 'blanca@gmail.com', 'cr 5 #148 -13', 'Activo', 2, '2023-05-18', '2023-05-18'),
(3, 'C.C', '1035585487', 'Carolina Crosby', '3122254858', 'caro@gmail.com', 'cll 89 sur # 45-48', 'Activo', 2, '2023-05-17', '2023-05-17'),
(4, 'C.C', '9587458', 'Diana Borges', '3103404090', 'diana@gmail.com', 'cr 2 # 98-74', 'Activo', 2, '2023-05-17', '2023-05-17'),
(5, 'C.C', '1025859658', 'Ernesto Gutierrez', '3203103525', 'ernie@gmail.com', 'cll 45 # 10-47', 'Archivado', 2, '2023-06-01', '2023-06-04'),
(6, 'C.C', '2121', 'Carlos Schick', '300300300', 'lkaro@gmail.com', 'cll 5#98-45', 'Activo', 3, '2023-01-02', '2023-05-16'),
(7, 'C.C', '123', 'Mariana Borda', '3236587979', 'Mariana@hotmail.com', 'cr 23 # 125-66', 'Archivado', 1, '2023-03-01', '2023-03-02'),
(8, 'C.C', '2365', 'Ayane Hayabusa', '878965412', 'ayane@hotmail.com', 'cll 123# 78-41', 'Activo', 4, '2023-01-10', '2023-06-07'),
(9, 'C.E', '9863', 'Isabella Montana', '9547893652', 'isabella@gmail.com', 'cll 127 # 98-85', 'Activo', 1, '2022-01-04', '2023-01-10'),
(10, 'C.E', '58944444', 'Maria Reyes', '3231039856', 'maria.r@gmail.com', 'cll 145 # 108-63', 'Activo', 3, '2022-07-08', '2023-03-17'),
(11, 'C.C', '698', 'Yolanda Tellez', '3216549898', 'y.165@aol.com', 'cll159#10-29', 'Activo', 4, '2023-06-10', '2023-06-18'),
(12, 'C.E', '56', 'Tina Lovecraft', '9548961245', 'tina@gmail.com', 'cll 36#69-89', 'Activo', 3, '2023-04-05', '2023-06-06'),
(13, 'C.C', '1012151563', 'Gabriela Castiblanco', '3103656989', 'gaby@hotmail.com', 'km 5 via cota chia', 'Activo', 3, '2023-04-11', '2023-05-28'),
(14, 'C.C', '789', 'Ana Maria Rosales', '7893652123', 'maria@gmail.com', 'cll 13#140-75', 'Activo', 2, '2023-06-23', '2023-06-23'),
(15, 'C.C', '2024', 'juanito alimaña', '300886644', 'alimana@gmail.com', 'cll 34 # 20 20', 'Activo', 7, '2024-01-24', '2024-01-24'),
(19, 'C.C', '14543', 'Chun li', '1222323', 'chun@gmail.com', 'calle#123  67-87', 'Activo', 4, '2024-02-08', '2024-02-09'),
(20, 'C.C', '1222233', 'Jack li', '344455545', 'jack@gmail.com', 'calle#123  65-87', 'Activo', 5, '2024-02-09', '2024-02-10'),
(21, 'C.C', '123123', 'Xiao Lin', '6325698958', 'lin@gmail.com', 'cll 148 # 78-98', 'Activo', 3, '2024-02-05', '2024-02-09'),
(22, 'C.C', '852852', 'Xiao Qiao', '123456789', 'Q@hotmail.com', 'CLL139A#23f-89', 'Activo', 5, '2024-02-12', '2024-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `fechaFactura` date NOT NULL,
  `impuestoTotal` decimal(10,0) NOT NULL,
  `subTotal` decimal(10,0) NOT NULL,
  `valorTotalFactura` decimal(10,0) NOT NULL,
  `estadoFactura` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `cliente_idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=45 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `fechaFactura`, `impuestoTotal`, `subTotal`, `valorTotalFactura`, `estadoFactura`, `cliente_idCliente`) VALUES
(1, '2023-05-17', 10000, 50000, 60000, 'Pago', 1),
(2, '2023-05-17', 15000, 60000, 75000, 'Pago', 1),
(3, '2023-05-17', 50000, 500000, 550000, 'Pago', 1),
(4, '2023-05-16', 30000, 200000, 130000, 'Pago', 1),
(5, '2023-03-12', 7000, 15000, 22000, 'Pago', 1),
(6, '2023-04-12', 6000, 21000, 27000, 'Pago', 1),
(7, '2023-05-12', 6000, 15000, 21000, 'Pago', 1),
(8, '2023-02-12', 5000, 15000, 20000, 'Pendiente', 6),
(9, '2023-05-22', 70000, 350000, 420000, 'Pago', 2),
(10, '2023-02-13', 7000, 25000, 32000, 'Pendiente', 3),
(11, '2023-06-29', 20000, 20000, 40000, 'Pago', 4),
(12, '2023-01-09', 6000, 45000, 51000, 'Pendiente', 5),
(13, '2023-03-30', 90000, 450000, 54000, 'Pendiente', 6),
(14, '2023-02-10', 100000, 500000, 600000, 'Pendiente', 5),
(15, '2022-12-17', 50000, 250000, 30000, 'Pendiente', 4),
(16, '2022-11-25', 85000, 225000, 310000, 'Pendiente', 3),
(17, '2023-01-18', 6000, 30000, 36000, 'Pendiente', 2),
(18, '2023-03-09', 20000, 75000, 95000, 'Pago', 1),
(19, '2023-06-18', 15000, 75000, 90000, 'Pago', 1),
(20, '2023-06-30', 7000, 30000, 37000, 'Pendiente', 2),
(21, '2024-02-05', 50000, 150000, 200000, 'Pendiente', 3),
(22, '2024-02-19', 19000, 81000, 100000, 'Pendiente', 6),
(23, '2024-02-23', 13300, 56700, 70000, 'Pendiente', 14),
(24, '2024-03-04', 13300, 56700, 70000, 'Pendiente', 14),
(25, '2024-02-19', 19000, 81000, 100000, 'Pendiente', 21),
(26, '2024-03-04', 9500, 40500, 50000, 'Pendiente', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan`
--

CREATE TABLE `plan` (
  `idPlan` int(11) NOT NULL,
  `codigoPlan` varchar(20) NOT NULL,
  `tipoPlan` varchar(20) DEFAULT NULL,
  `velocidad` varchar(20) NOT NULL,
  `nombrePlan` varchar(250) NOT NULL,
  `precioPlan` decimal(10,0) NOT NULL,
  `desPlan` varchar(2000) DEFAULT NULL,
  `estadoPlan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `plan`
--

INSERT INTO `plan` (`idPlan`, `codigoPlan`, `tipoPlan`, `velocidad`, `nombrePlan`, `precioPlan`, `desPlan`, `estadoPlan`) VALUES
(1, '1', 'rural', '20mb', 'Plan economico', 50000, 'Plan económico de 20mb para la cuidad adecuada para casa pequeñas', 'Activo'),
(2, '2', 'urbano', '50mb', 'Plan dorado', 70000, 'EL plan dorado urbano es mucho mas rapido ideal para una familia completa, con fibra óptica, ofrece excelente velicidad de internet', 'Activo'),
(3, '3', 'urbano', '70mb', 'Plan diamante', 100000, 'Plan de alta velocidad para hogares', 'Activo'),
(4, '4', 'empresarial', '120mb', 'Plan empresa', 120000, 'Plan Ideal Para empresas pequeñas, por 120000 y de fibra optica puede alcanzar buenas velocidades', 'Activo'),
(5, '5', 'urbano', '5 mb', 'Plan Basico', 50000, 'EL plan rural Basico consta de 5 megas de navegación, se hace por medio de radiofrecuencia y es el plan que tiene mayor covertura, recomendado para personas que vivan muy alejadas o en sitios de dificil alcance.', 'Activo'),
(6, '6', 'empresarial', '150 mb', 'Plan elite empresa', 150000, 'Plan para empresas grande que requieran excelente velocidades de wifi, viene con fibra óptica', 'Activo'),
(7, '7', 'urbano', '10 mb', 'Plan dorado', 65000, 'Plan fibra optica rural, un plan con velocidades de internet más rapidas, para sitio rurales cerca a las cuidades más cercanas, toca validar disponibilidad', 'Archivado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqr2`
--

CREATE TABLE `pqr2` (
  `idPqr` int(11) NOT NULL,
  `tipoDocumento` varchar(10) DEFAULT NULL,
  `nDocumento` varchar(100) DEFAULT NULL,
  `nombresCliente` varchar(200) DEFAULT NULL,
  `telefonoCliente` varchar(20) DEFAULT NULL,
  `emailCliente` varchar(200) DEFAULT NULL,
  `tPqr` varchar(20) DEFAULT NULL,
  `desPqr` varchar(2000) DEFAULT NULL,
  `estadoPqr` varchar(100) DEFAULT 'Activo',
  `comentario` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pqr2`
--

INSERT INTO `pqr2` (`idPqr`, `tipoDocumento`, `nDocumento`, `nombresCliente`, `telefonoCliente`, `emailCliente`, `tPqr`, `desPqr`, `estadoPqr`, `comentario`) VALUES
(1, 'C.C', '36', 'Pastelito de fresa', '5263695825', 'pastelito@gmail.com', 'Sugerencia', 'Tener mejores dispositivos y fibra óptica', 'Inactivo', NULL),
(2, 'C.E', '25', 'Isabella Perez', '6254782323', 'isaa@aol.com', 'Peticion', 'Quiero fibra optica en mi casa', 'Inactivo', 'No se pudo instalar fibra optica en su hogar porque no hay cobertura'),
(3, 'C.E', '47', 'fabian schick', '3195899457', 'ff@gmail.com', 'Peticion', 'Mejor velocidad en mi servicio', 'Activo', 'Modem en camino'),
(4, 'C.C', '12363235', 'Carlos Rubiano', '7859635874', 'cr56@aol.com', 'Sugerencia', 'Que los técnicos sean mas puntuales', 'Inactivo', NULL),
(5, 'C.C', '1223456', 'Nicolas Borda', '3443456', 'nico@correo.na', 'Reclamo', 'El internet me esta fallando constantemente y necesito un reembolso', 'Activo', NULL),
(6, 'C.C', '75', 'Estefania', '987563254', 'cristian.audir8@hotmail.com', 'Reclamo', 'Me llego mal el modem de internet', 'Activo', NULL),
(7, 'C.C', '789', 'Ana Maria Rosales', '7895632525', 'maria@gmail.com', 'Reclamo', 'EL modem de internet no esta trabajando correctamente', 'Activo', 'Servicio completado satisfactoriamente'),
(8, 'cc', '1625898', 'Daniela FLor', '3198965656', 'dd@gmail.com', 'Peticion', 'Solicito cables de modem', '', ''),
(9, 'C.C', '965874', 'Gabriella Allende', '3251456857', 'ga@hotmail.com', 'Reclamo', 'Internet intermitente constante', NULL, NULL),
(10, 'C.C', '965874', 'Gabriella Allende', '3251456857', 'ga@hotmail.com', 'Sugerencia', 'Ser mas rapidos en responder', NULL, NULL),
(11, 'C.C', '1625898', 'Daniela FLor', '3198965656', 'dd@gmail.com', 'Sugerencia', 'Buen servicio', NULL, NULL),
(14, '', '', '2', '', '', '', '', '', ''),
(15, 'C.C', '5656', 'Isabella Quimaby', '3215698989', 'isabella@gmail.com', 'Peticion', 'reuqerimos cables de conexión', NULL, NULL),
(16, 'C.C', '123456', 'Camilo gil', '33333', 'cami@gmail.com', 'Peticion', 'El internet esta algo lento necesto un reembolso', '', 'Resuelto'),
(17, 'C.C', '111111111', 'Edubin', '33333333', 'edubin@gmail.com', 'Reclamo', 'prueba sustentacion', '', 'Resuelto'),
(18, 'C.C', '123456', 'Camilo gil', '33333', 'cami@gmail.com', 'Peticion', 'El internet esta algo lento prueba de estadooooooooo necesto un reembolso', '', 'Resuelto'),
(19, 'C.C', '123456', 'Daniela FLor', '3333333', 'd@gmail.com', 'Peticion', 'dsdfsdf', NULL, NULL),
(20, 'C.C', '789', 'Juan Torres', '3105874596', 'juan@gmail.com', 'Reclamo', 'La factura me llego por mayor valor', 'Inactivo', 'mas a validar su solicitud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(200) NOT NULL,
  `serialProducto` varchar(45) NOT NULL,
  `descripcionProducto` varchar(250) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `estadoProducto` varchar(20) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombreProducto`, `serialProducto`, `descripcionProducto`, `cantidad`, `estadoProducto`) VALUES
(1, 'Modem Asus', '545784545', 'Modem Arris velocidad media fibra optica', 5, 'Activo'),
(2, 'Modem Mi alta velocidad', '55448754', 'Modem Mii velocidad media', 10, 'Activo'),
(3, 'Modem MI', '52144452', 'Modem Asus velocidad alta', 10, 'Activo'),
(4, 'Cables fibra optica', '32525225', 'Cables fibra optica', 5, 'Inactivo'),
(5, 'Modem arris', '5689', 'Modem Arris de fibra optica para alta velocidad', 12, 'Activo'),
(6, 'Cables de fibra optica', '5289645s', 'Cables utilizados para instalaciones fibra óptica', 60, 'Activo'),
(7, 'modem Arris', '3656', 'modem fobra optica', 30, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(45) NOT NULL,
  `descrpcionRol` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`, `descrpcionRol`) VALUES
(1, 'Administrativo', 'Administrativo - puede modificar todo el sistema'),
(2, 'Tecnico', 'Soporte tecnico'),
(3, 'Auxiliar', 'Acceso limitado al sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idSolicitud` int(50) NOT NULL,
  `tipoDocumento` varchar(50) DEFAULT NULL,
  `numeroDocumento` varchar(50) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `estadoSolicitud` varchar(50) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idSolicitud`, `tipoDocumento`, `numeroDocumento`, `nombres`, `telefono`, `email`, `estadoSolicitud`) VALUES
(1, 'C.C', '202', 'Estefania Flor', '3195852323', 'este@gmail.com', 'Atendido'),
(2, 'C.E', '963', 'Julian Hernandez', '3692582365', 'juli@gmail.com', 'Atendido'),
(3, 'C.C', '3654', 'Ayane Hayabusa', '5893652121', 'ayane@hotmail.com', 'Atendido'),
(4, 'C.C', '15263635', 'Kasumi Hayabusa', '9549638521414', 'kasumi@gmail.com', 'Activo'),
(5, 'C.C', '45', 'Helena Leau', '9638525858', 'helena@yahoo.com', 'Atendido'),
(6, 'C.C', '89', 'Fabian Quimbay', '3258963254', 'helena@gmail.com', 'Activo'),
(7, 'C.C', '789', 'Ana Maria Rosales', '7893652123', 'maria@gmail.com', 'Activo'),
(8, 'C.C', '3636', 'Juan Rodriguez', '123456', 'juan@aol.com', 'Atendido'),
(9, 'C.C', '56', 'Helena', '7859635874', 'helena@gmail.com', 'Activo'),
(10, 'C.E', '987', 'stephy gomez', '3198988686', 'ste@gmail.com', 'Activo'),
(11, 'C.C', '987654', 'juanito alimaña', '300886644', 'alimana@gmail.com', 'Atendido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_visita`
--

CREATE TABLE `user_visita` (
  `iduser_visita` int(11) NOT NULL,
  `visita_idVisita` int(11) DEFAULT NULL,
  `user_idUser` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `user_visita`
--

INSERT INTO `user_visita` (`iduser_visita`, `visita_idVisita`, `user_idUser`) VALUES
(1, 2, 4),
(2, 3, 5),
(3, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `tipoDocumento` varchar(20) NOT NULL DEFAULT 'CC',
  `documentoUsuario` varchar(20) NOT NULL,
  `nombresUsuario` varchar(100) NOT NULL,
  `telefonoUsuario` varchar(20) DEFAULT NULL,
  `correoUsuario` varchar(100) NOT NULL,
  `claveUsuario` varchar(150) NOT NULL,
  `estadoUsuario` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `creado` date NOT NULL,
  `ultimaActualizacion` date NOT NULL,
  `rol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `tipoDocumento`, `documentoUsuario`, `nombresUsuario`, `telefonoUsuario`, `correoUsuario`, `claveUsuario`, `estadoUsuario`, `creado`, `ultimaActualizacion`, `rol`) VALUES
(1, 'C.C', '806554878', 'Karl', '3103209913', 'karl@gmail.com', '$2y$10$GKR1Uq.gErAPTPRai5BuYuD0u5dovY47eMsQ5qy/VWr8IAzSntxpu', 'Activo', '2023-05-09', '2023-05-09', 'Administrador'),
(2, 'C.C', '1023554584', 'cris', '3017328804', 'cristian@hotmail.com', '$2y$10$H5.gQP65R6mDulyKWFBt/eW.lEjUaKl0QfOaEl/AhSHqh5f0jO7DW', 'Activo', '2023-05-10', '2023-05-10', 'Administrador'),
(3, 'C.C', '1030634046', 'nico', '3006646485', 'nico@gmail.com', '$2y$10$9ruPWqEKJqkmS4KoI1LOTOmfsSi6/lhoTCFL5d4qIVvR8KuD6dxBe', 'Activo', '2023-05-12', '2023-05-12', 'Administrador'),
(4, 'C.C', '1020554483', 'Fabian', '3104552020', 'fabiancho@aol.com', '$2y$10$CPaJUTIN876IeT.hA9wrJOH1gw4FGjgx.4zC5IDrhIy38SQIDUFmu', 'Activo', '2023-05-12', '2024-02-10', 'Tecnico'),
(5, 'C.C', '23568985', 'Isa', '3215698787', 'isabella@hotmail.com', '$2y$10$iF19xxjou9ksjLdu3PNMKeywN78.9FKwKTVFWyJ10Gys0HmEQpt5.', 'Activo', '2023-11-05', '0223-11-05', 'Administrador'),
(6, 'C.C', '1234', 'Danny', '3198562323', 'danny@gmail.com', '$2y$10$JHazT8DBylBQFg83f17iM.6g5lhBkE/jSDD9WsJryPMqRnk6kMz3.', 'Activo', '2023-11-06', '0223-11-06', 'Administrador'),
(9, 'C.C', '1222233', 'linlin', '344455545', 'linlin@gmail.com', '$2y$10$n3tdZBrtIUPu5uiz2R3yMe97yZ5vdZNWngtkTt/MJno0ywKjfSI6.', 'Activo', '2024-02-09', '2024-02-10', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `idVisita` int(10) NOT NULL,
  `motivoVisita` varchar(2000) DEFAULT NULL,
  `diaVisita` date DEFAULT NULL,
  `estadoVisita` varchar(100) DEFAULT 'Activo',
  `visita_idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`idVisita`, `motivoVisita`, `diaVisita`, `estadoVisita`, `visita_idCliente`) VALUES
(1, 'El modem no esta funcionando apropiadamente (internet lento)', '2021-06-22', 'Activo', 11),
(2, 'Instalacion de plan', '2023-06-27', 'Activo', 21),
(3, 'el servicio no esta funcionando', '2023-06-29', 'Activo', 7),
(4, 'Otra vez el internet me esta fallando', '2023-06-30', 'Activo', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `documentoCliente` (`documentoCliente`),
  ADD KEY `fk_plan_cliente` (`plan_idPlan`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_cliente_factura` (`cliente_idCliente`);

--
-- Indices de la tabla `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`idPlan`);

--
-- Indices de la tabla `pqr2`
--
ALTER TABLE `pqr2`
  ADD PRIMARY KEY (`idPqr`),
  ADD KEY `idPqr` (`idPqr`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `serialProducto` (`serialProducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`idSolicitud`);

--
-- Indices de la tabla `user_visita`
--
ALTER TABLE `user_visita`
  ADD PRIMARY KEY (`iduser_visita`),
  ADD KEY `user_idUser` (`user_idUser`),
  ADD KEY `visita_idVisita` (`visita_idVisita`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `documentoUsuario` (`documentoUsuario`,`telefonoUsuario`,`correoUsuario`),
  ADD KEY `rol_idRol` (`rol`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`idVisita`),
  ADD KEY `visita_idCliente` (`visita_idCliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `idPlan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pqr2`
--
ALTER TABLE `pqr2`
  MODIFY `idPqr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user_visita`
--
ALTER TABLE `user_visita`
  MODIFY `iduser_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `idVisita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_plan_cliente` FOREIGN KEY (`plan_idPlan`) REFERENCES `plan` (`idPlan`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_cliente_factura` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`);

--
-- Filtros para la tabla `user_visita`
--
ALTER TABLE `user_visita`
  ADD CONSTRAINT `user_visita_ibfk_1` FOREIGN KEY (`user_idUser`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `user_visita_ibfk_2` FOREIGN KEY (`visita_idVisita`) REFERENCES `visitas` (`idVisita`);

--
-- Filtros para la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`visita_idCliente`) REFERENCES `cliente` (`idCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
