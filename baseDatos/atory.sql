-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2025 a las 03:31:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.3.17

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaVisita` (IN `id_cliente` INT)   BEGIN
	select * from usuario
                      inner join user_visita
                      inner join visitas
                      Inner join cliente
                      where usuario.`idUsuario`=user_visita.`user_idUser`
                      and user_visita.`visita_idVisita`=visitas.`idVisita`
                      and  cliente.`idCliente`=visitas.`visita_idCliente`
                      and documentoCliente=id_cliente;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GenerarDescuento` (IN `factura_id` INT)   BEGIN
    DECLARE descuento DECIMAL(10,2);
    -- Calcular el 50% de descuento
    SET descuento = (SELECT valorTotalFactura * 0.5 FROM Factura WHERE idFactura = factura_id);
    -- Aplicar el descuento
    UPDATE Factura
    SET valorTotalFactura = valorTotalFactura - descuento
    WHERE idFactura = factura_id;
    -- Ver el descuento
    SELECT valorTotalFactura , nPlan ,nombreCliente FROM factura 
    inner join cliente
    WHERE factura_id = idFactura and idCliente = cliente_idCliente;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `verfactura` (IN `idFactura` INT)   BEGIN
    SELECT fechaFactura FROM factura;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `x` ()   BEGIN
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancario`
--

CREATE TABLE `bancario` (
  `id_bancario` int(5) NOT NULL,
  `num_cuenta` varchar(50) NOT NULL,
  `nomb_banco` varchar(100) NOT NULL,
  `estadoCuenta` varchar(20) NOT NULL DEFAULT 'activo',
  `imagenQR` blob DEFAULT NULL,
  `banco_idempresa` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `bancario`
--

INSERT INTO `bancario` (`id_bancario`, `num_cuenta`, `nomb_banco`, `estadoCuenta`, `imagenQR`, `banco_idempresa`) VALUES
(1, '1235345', 'nequi', 'Activo', NULL, 1),
(2, '3196443053', 'daviplata', 'Activo', NULL, 1),
(8, '123456789', 'nu', 'Activo', NULL, 1),
(9, '1001234567', 'Bancolombia', 'Activo', NULL, 1),
(10, '1002234567', 'Banco de Bogotá', 'Archivado', NULL, 1),
(11, '1003234567', 'Banco Popular', 'Activo', NULL, 1),
(12, '1004234567', 'Banco AV Villas', 'Activo', NULL, 1),
(13, '1005234567', 'Davivienda', 'Activo', NULL, 1),
(14, '1006234567', 'Banco de Occidente', 'Activo', NULL, 1),
(15, '1007234567', 'Banco Caja Social', 'Activo', NULL, 1),
(16, '1008234567', 'BBVA Colombia', 'Activo', NULL, 1),
(17, '1009234567', 'Scotiabank Colpatria', 'Activo', NULL, 1),
(18, '1010234567', 'GNB Sudameris', 'Activo', NULL, 1),
(19, '1011234567', 'Banco Falabella', 'Activo', NULL, 1),
(20, '1012234567', 'Banco Pichincha', 'Activo', NULL, 1),
(21, '1013234567', 'Banco Coopcentral', 'Activo', NULL, 1),
(22, '1014234567', 'Itaú Colombia', 'Activo', NULL, 1),
(23, '1015234567', 'Banco Serfinanza', 'Activo', NULL, 1),
(24, '1016234567', 'Banco Agrario', 'Activo', NULL, 1),
(25, '1017234567', 'Finandina', 'Activo', NULL, 1),
(26, '1018234567', 'Tuya', 'Activo', NULL, 1),
(27, '1019234567', 'Nequi', 'Activo', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `tipoDocumento` varchar(10) NOT NULL DEFAULT 'CC',
  `documentoCliente` varchar(20) NOT NULL,
  `tipoCliente` enum('Residencial','Empresarial','Corporativo','Rural') DEFAULT 'Residencial',
  `nombreCliente` varchar(100) NOT NULL,
  `apellidoCliente` varchar(100) DEFAULT NULL,
  `telefonoCliente` varchar(20) NOT NULL,
  `correoCliente` varchar(100) NOT NULL,
  `correoFacturacion` varchar(100) DEFAULT NULL,
  `pais` varchar(50) DEFAULT 'Colombia',
  `ciudadCliente` varchar(50) DEFAULT NULL,
  `departamentoCliente` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `barrioCliente` varchar(100) DEFAULT NULL,
  `estrato` int(11) DEFAULT NULL,
  `codigoPostalCliente` varchar(10) DEFAULT NULL,
  `coordenadasGPS` varchar(50) DEFAULT NULL COMMENT 'Formato: lat,lng',
  `referenciaUbicacion` text DEFAULT NULL,
  `zonaCobertura` varchar(50) DEFAULT NULL,
  `sucursal` varchar(100) DEFAULT NULL,
  `ciudadDian` varchar(50) DEFAULT NULL COMMENT 'Para facturación electrónica',
  `estadoCliente` varchar(10) NOT NULL DEFAULT 'Activo',
  `motivoSuspension` varchar(100) DEFAULT NULL,
  `vendedor_idUsuario` int(11) DEFAULT NULL COMMENT 'FK: Usuario vendedor',
  `tecnicoAsignado_idUsuario` int(11) DEFAULT NULL COMMENT 'FK: Técnico de zona',
  `referenciadoPor_idCliente` int(11) DEFAULT NULL COMMENT 'FK: Cliente que lo refirió',
  `tieneReferidos` int(11) DEFAULT 0,
  `origenCliente` enum('Referido','Web','Redes','Puerta a puerta','Otro') DEFAULT 'Otro',
  `categoriaCliente` enum('VIP','Regular','Moroso') DEFAULT 'Regular',
  `cantidadSoportesMes` int(11) DEFAULT 0,
  `ultimoSoporte` date DEFAULT NULL,
  `promedioVelocidad` decimal(6,2) DEFAULT NULL COMMENT 'Velocidad real medida',
  `calidadServicio` int(11) DEFAULT 5 COMMENT 'Rating 1-5 estrellas',
  `observaciones` text DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `documentosAdjuntos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`documentosAdjuntos`)),
  `eliminado` tinyint(1) DEFAULT 0,
  `creadoPor` int(11) DEFAULT NULL,
  `actualizadoPor` int(11) DEFAULT NULL,
  `plan_idPlan` int(11) NOT NULL,
  `creado` date DEFAULT NULL,
  `fechaInstalacion` date DEFAULT NULL,
  `fechaActivacion` date DEFAULT NULL,
  `ultimaActualizacion` date DEFAULT NULL,
  `fechaSuspension` date DEFAULT NULL,
  `fechaCorte` date DEFAULT NULL,
  `meses_gracia` int(11) DEFAULT 0,
  `fechaContrato` date DEFAULT NULL,
  `clausulaMeses` int(11) DEFAULT NULL COMMENT 'Meses de permanencia mínima',
  `mesFin` date DEFAULT NULL COMMENT 'Fecha fin del contrato',
  `mesesParaFinalizar` int(11) DEFAULT NULL COMMENT 'Calculado automáticamente',
  `valorAPagar` decimal(10,2) DEFAULT NULL COMMENT 'Penalización por retiro anticipado',
  `valorInstalacion` decimal(10,2) DEFAULT NULL,
  `tipologiaRed` varchar(50) DEFAULT NULL COMMENT 'FTTH, FTTC, Radio, etc.',
  `nodoConexion` varchar(50) DEFAULT NULL COMMENT 'Nodo/Switch',
  `puertoSwitch` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `tipoDocumento`, `documentoCliente`, `tipoCliente`, `nombreCliente`, `apellidoCliente`, `telefonoCliente`, `correoCliente`, `correoFacturacion`, `pais`, `ciudadCliente`, `departamentoCliente`, `direccion`, `barrioCliente`, `estrato`, `codigoPostalCliente`, `coordenadasGPS`, `referenciaUbicacion`, `zonaCobertura`, `sucursal`, `ciudadDian`, `estadoCliente`, `motivoSuspension`, `vendedor_idUsuario`, `tecnicoAsignado_idUsuario`, `referenciadoPor_idCliente`, `tieneReferidos`, `origenCliente`, `categoriaCliente`, `cantidadSoportesMes`, `ultimoSoporte`, `promedioVelocidad`, `calidadServicio`, `observaciones`, `notas`, `documentosAdjuntos`, `eliminado`, `creadoPor`, `actualizadoPor`, `plan_idPlan`, `creado`, `fechaInstalacion`, `fechaActivacion`, `ultimaActualizacion`, `fechaSuspension`, `fechaCorte`, `meses_gracia`, `fechaContrato`, `clausulaMeses`, `mesFin`, `mesesParaFinalizar`, `valorAPagar`, `valorInstalacion`, `tipologiaRed`, `nodoConexion`, `puertoSwitch`) VALUES
(1, 'C.C', '10101', 'Residencial', 'Arnulfo Rodriguez', NULL, '3005554878', 'arnulfo@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 148 # 98-41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2023-05-12', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'C.C', '10102', 'Residencial', 'Blanca Cordero', NULL, '3008562013', 'blanca@gmail.com', NULL, 'Colombia', NULL, NULL, 'cr 5 #148 -13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2023-05-18', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'C.C', '10103', 'Residencial', 'Carolina Crosby', NULL, '3122254858', 'caro@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 89 sur # 45-48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2023-05-17', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'C.C', '10104', 'Residencial', 'Diana Borges', NULL, '3103404090', 'diana@gmail.com', NULL, 'Colombia', NULL, NULL, 'cr 2 # 98-74', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2023-05-17', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'C.C', '10105', 'Residencial', 'Ernesto Gutierrez', NULL, '3203103525', 'ernie@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 45 # 10-47', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2023-06-01', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'C.C', '2121', 'Residencial', 'Carlos Schick', NULL, '300300300', 'lkaro@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 5#98-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2023-01-02', NULL, NULL, '2023-05-16', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'C.C', '123', 'Residencial', 'Mariana Borda', NULL, '3236587979', 'Mariana@hotmail.com', NULL, 'Colombia', NULL, NULL, 'cr 23 # 125-66', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2023-03-01', NULL, NULL, '2025-10-07', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'C.C', '2365', 'Empresarial', 'Ayane Hayabusr', NULL, '878965412', 'ayane@hotmail.com', '', 'Colombia', 'BOGOTA, D.C.', 'BOGOTA, D.C.', 'cll 123# 78-41', '', 3, '110311', '', '', '', '', '', 'Activo', '', NULL, NULL, NULL, 0, 'Otro', 'VIP', 0, NULL, NULL, 5, '', '', NULL, 0, NULL, NULL, 8, '2023-01-10', NULL, NULL, '2025-10-21', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ''),
(9, 'C.E', '9863', 'Residencial', 'Isabella Montana', NULL, '9547893652', 'isabella@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 127 # 98-85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2022-01-04', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'C.E', '58944444', 'Residencial', 'Maria Reyes', NULL, '3231039856', 'maria.r@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 145 # 108-63', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2022-07-08', NULL, NULL, '2025-01-01', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'C.C', '698', 'Residencial', 'Yolanda Tellez', NULL, '3216549898', 'y.165@aol.com', NULL, 'Colombia', NULL, NULL, 'cll159#10-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2023-06-10', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'C.E', '56', 'Residencial', 'Tina Lovecraft', NULL, '9548961245', 'tina@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 36#69-89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2023-04-05', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'C.C', '1012151563', 'Residencial', 'Gabriela Castiblanco', NULL, '3103656989', 'gaby@hotmail.com', NULL, 'Colombia', NULL, NULL, 'km 5 via cota chia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2023-04-11', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'C.C', '789', 'Empresarial', 'Ana Maria', 'Rosales', '7893652123', 'maria@gmail.com', 'maria@gmail.com', 'Colombia', 'BOGOTA, D.C.', 'BOGOTA, D.C.', 'cll 13#140-75', 'bogota', 2, '110311', '', '', '', '', 'BOGOTA, D.C.', 'Activo', '', NULL, NULL, NULL, 0, 'Otro', 'VIP', 0, NULL, NULL, 5, '', '', NULL, 0, NULL, NULL, 7, '2023-06-23', NULL, NULL, '2025-10-22', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ''),
(15, 'C.C', '2024', 'Residencial', 'juanito alimaña', NULL, '300886644', 'alimana@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 34 # 20 20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 7, '2024-01-24', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'C.C', '14543', 'Residencial', 'Chun li', NULL, '1222323', 'chun@gmail.com', NULL, 'Colombia', NULL, NULL, 'Cl. 123 #67-87', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-02-08', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'C.C', '1222233', 'Residencial', 'Jack li', NULL, '344455545', 'jack@gmail.com', NULL, 'Colombia', NULL, NULL, 'calle#123  65-87', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-02-09', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'C.C', '123123', 'Residencial', 'Xiao Lin', NULL, '6325698958', 'lin@gmail.com', NULL, 'Colombia', NULL, NULL, 'cll 148 # 78-98', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Archivado', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-02-05', NULL, NULL, '2024-02-09', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'C.C', '852852', 'Residencial', 'Xiao Qiao', NULL, '123456789', 'Q@hotmail.com', NULL, 'Colombia', NULL, NULL, 'CLL139A#23f-89', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Archivado', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-02-12', NULL, NULL, '2024-02-13', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'C.C', '10000001', 'Residencial', 'Andrés López', NULL, '300500001', 'andrés@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 1 # 2-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-02', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(121, 'C.C', '10000002', 'Residencial', 'Beatriz Sánchez', NULL, '300500002', 'beatriz@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 2 # 4-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-03', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'C.C', '10000003', 'Residencial', 'Carlos Ramírez', NULL, '300500003', 'carlos@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 3 # 6-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-04', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'C.C', '10000004', 'Residencial', 'Diana Herrera', NULL, '300500004', 'diana@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 4 # 8-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-05', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'C.C', '10000005', 'Residencial', 'Elena Gómez', NULL, '300500005', 'elena@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 5 # 10-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-06', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'C.C', '10000006', 'Residencial', 'Fernando Castro', NULL, '300500006', 'fernando@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 6 # 12-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-07', NULL, NULL, '2025-08-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'C.C', '10000007', 'Residencial', 'Gabriela Mendoza', NULL, '300500007', 'gabriela@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 7 # 14-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-08', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'C.C', '10000008', 'Residencial', 'Hugo Ortega', NULL, '300500008', 'hugo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 8 # 16-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-09', NULL, NULL, '2025-10-04', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'C.C', '10000009', 'Residencial', 'Isabel Ríos', NULL, '300500009', 'isabel@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 9 # 18-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-10', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(129, 'C.C', '10000010', 'Residencial', 'Javier Paredes', NULL, '300500010', 'javier@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 10 # 20-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-11', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(130, 'C.C', '10000011', 'Residencial', 'Karina Salazar', NULL, '300500011', 'karina@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 11 # 22-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-12', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(131, 'C.C', '10000012', 'Residencial', 'Luis Torres', NULL, '300500012', 'luis@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 12 # 24-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-13', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(132, 'C.C', '10000013', 'Residencial', 'María Navarro', NULL, '300500013', 'maría@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 13 # 26-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-14', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 'C.C', '10000014', 'Residencial', 'Nicolás Vega', NULL, '300500014', 'nicolás@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 14 # 28-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-15', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'C.C', '10000015', 'Residencial', 'Olga Carrillo', NULL, '300500015', 'olga@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 15 # 30-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-16', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(135, 'C.C', '10000016', 'Residencial', 'Pablo Duarte', NULL, '300500016', 'pablo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 16 # 32-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-17', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 'C.C', '10000017', 'Residencial', 'Quintín Lara', NULL, '300500017', 'quintín@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 17 # 34-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-18', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(137, 'C.C', '10000018', 'Residencial', 'Rosa Fuentes', NULL, '300500018', 'rosa@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 18 # 36-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-19', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(138, 'C.C', '10000019', 'Residencial', 'Sergio Álvarez', NULL, '300500019', 'sergio@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 19 # 38-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-20', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(139, 'C.C', '10000020', 'Residencial', 'Teresa Jiménez', NULL, '300500020', 'teresa@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 20 # 40-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-21', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(140, 'C.C', '10000021', 'Residencial', 'Ulises Peña', NULL, '300500021', 'ulises@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 21 # 42-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-22', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(141, 'C.C', '10000022', 'Residencial', 'Valentina Solano', NULL, '300500022', 'valentina@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 22 # 44-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-23', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(142, 'C.C', '10000023', 'Residencial', 'Walter Castillo', NULL, '300500023', 'walter@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 23 # 46-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-24', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(143, 'C.C', '10000024', 'Residencial', 'Ximena Espinoza', NULL, '300500024', 'ximena@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 24 # 48-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Archivado', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-25', NULL, NULL, '2024-02-25', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(144, 'C.C', '10000025', 'Residencial', 'Yahir Montes', NULL, '300500025', 'yahir@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 25 # 50-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Archivado', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-26', NULL, NULL, '2024-02-26', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(145, 'C.C', '10000026', 'Residencial', 'Zulema Patiño', NULL, '300500026', 'zulema@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 26 # 52-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-27', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(146, 'C.C', '10000027', 'Residencial', 'Alfonso Martínez', NULL, '300500027', 'alfonso@gmail.com', '', 'Colombia', '', '', 'Calle 27 # 54-45', '', 0, '', '', '', '', '', '', 'Activo', '', NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, '', '', NULL, 0, NULL, NULL, 3, '2024-01-28', NULL, NULL, '2025-10-22', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '', '', ''),
(147, 'C.C', '10000028', 'Residencial', 'Brenda Villanueva', NULL, '300500028', 'brenda@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 28 # 56-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-01', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(148, 'C.C', '10000029', 'Residencial', 'Cesar Tapia', NULL, '300500029', 'cesar@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 29 # 58-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-02', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(149, 'C.C', '10000030', 'Residencial', 'Dolores Silva', NULL, '300500030', 'dolores@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 30 # 60-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-03', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(150, 'C.C', '10000031', 'Residencial', 'Eduardo Nieto', NULL, '300500031', 'eduardo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 31 # 62-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-04', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(151, 'C.C', '10000032', 'Residencial', 'Fabiola Suárez', NULL, '300500032', 'fabiola@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 32 # 64-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-05', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(152, 'C.C', '10000033', 'Residencial', 'Gerardo Domínguez', NULL, '300500033', 'gerardo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 33 # 66-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-06', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(153, 'C.C', '10000034', 'Residencial', 'Hilda Guzmán', NULL, '300500034', 'hilda@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 34 # 68-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-07', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(154, 'C.C', '10000035', 'Residencial', 'Iván Estrada', NULL, '300500035', 'iván@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 35 # 70-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-08', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(155, 'C.C', '10000036', 'Residencial', 'Jessica Peralta', NULL, '300500036', 'jessica@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 36 # 72-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-09', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(156, 'C.C', '10000037', 'Residencial', 'Kevin Flores', NULL, '300500037', 'kevin@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 37 # 74-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-10', NULL, NULL, '2025-10-04', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(157, 'C.C', '10000038', 'Residencial', 'Laura Chávez', NULL, '300500038', 'laura@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 38 # 76-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-11', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 'C.C', '10000039', 'Residencial', 'Miguel Palacios', NULL, '300500039', 'miguel@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 39 # 78-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-12', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(159, 'C.C', '10000040', 'Residencial', 'Natalia Ocampo', NULL, '300500040', 'natalia@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 40 # 80-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-13', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(160, 'C.C', '10000041', 'Residencial', 'Omar Sandoval', NULL, '300500041', 'omar@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 41 # 82-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-14', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 'C.C', '10000042', 'Residencial', 'Patricia Reyes', NULL, '300500042', 'patricia@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 42 # 84-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-15', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(162, 'C.C', '10000043', 'Residencial', 'Ricardo Medina', NULL, '300500043', 'ricardo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 43 # 86-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-16', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(163, 'C.C', '10000044', 'Residencial', 'Sofía Cordero', NULL, '300500044', 'sofía@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 44 # 88-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-17', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(164, 'C.C', '10000045', 'Residencial', 'Tomás Arrieta', NULL, '300500045', 'tomás@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 45 # 90-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-18', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(165, 'C.C', '10000046', 'Residencial', 'Ursula Villaseñor', NULL, '300500046', 'ursula@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 46 # 92-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 2, '2024-01-19', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(166, 'C.C', '10000047', 'Residencial', 'Víctor León', NULL, '300500047', 'víctor@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 47 # 94-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2024-01-20', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(167, 'C.C', '10000048', 'Residencial', 'Wilfredo Padilla', NULL, '300500048', 'wilfredo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 48 # 96-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2024-01-21', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(168, 'C.C', '10000049', 'Residencial', 'Xiomara Nájera', NULL, '300500049', 'xiomara@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 49 # 98-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Archivado', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2024-01-22', NULL, NULL, '2024-02-22', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(169, 'C.C', '10000050', 'Residencial', 'Yolanda Barrera', NULL, '300500050', 'yolanda@gmail.com', NULL, 'Colombia', NULL, NULL, 'Calle 50 # 100-45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Archivado', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2024-01-23', NULL, NULL, '2024-02-23', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(170, 'C.C', '101010', 'Residencial', 'joan schick', NULL, '3123828822', 'joan@gmail.com', NULL, 'Colombia', NULL, NULL, 'cr 3b No. 23 - 49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 5, '2025-09-12', NULL, NULL, '2025-10-19', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(174, 'C.C', '4040', 'Residencial', 'joan3', NULL, '31964354', 'schickperez@gmail.com', NULL, 'Colombia', NULL, NULL, 'Carrera 3b #23-49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 3, '2025-08-01', NULL, NULL, '2025-10-06', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(175, 'C.C', '5050', 'Residencial', 'joan4', NULL, '3123828822', 'schickperez@gmail.com', NULL, 'Colombia', NULL, NULL, 'cr 3b No. 23 - 49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2025-10-07', NULL, NULL, '2025-10-07', NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(176, 'C.C', '6060', 'Residencial', 'joan5', NULL, '3196443053', 'schickperez@gmail.com', NULL, 'Colombia', NULL, NULL, 'Carrera 3b #23-49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 1, '2023-09-07', NULL, NULL, '2025-10-07', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(177, 'C.C', '10099020', 'Residencial', 'pedro pascal', NULL, '', '', NULL, 'Colombia', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 4, '2025-10-15', NULL, NULL, '2025-10-15', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(178, 'C.C', '544854', 'Residencial', 'polo polo', NULL, '23423423423', 'polopolo@gmail.com', NULL, 'Colombia', NULL, NULL, 'Carrera 34 #34-3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 8, '2025-10-02', NULL, NULL, '2025-10-02', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(179, 'C.C', '888888', 'Residencial', 'pablo picapiedra', NULL, '31238266565', 'pabkrez@gmail.com', NULL, 'Colombia', NULL, NULL, 'cr 3b 66 - 76', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, 0, 'Otro', 'Regular', 0, NULL, NULL, 5, NULL, NULL, NULL, 0, NULL, NULL, 6, '2025-10-10', NULL, NULL, '2025-10-10', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_equipo`
--

CREATE TABLE `cliente_equipo` (
  `idClienteEquipo` int(11) NOT NULL,
  `cliente_idCliente` int(11) NOT NULL,
  `clienteServicio_id` int(11) DEFAULT NULL COMMENT 'A qué servicio pertenece este equipo',
  `tipoEquipo` enum('Router','ONT','Repetidor','Decodificador','Otro') NOT NULL,
  `modeloEquipo` varchar(50) DEFAULT NULL,
  `marcaEquipo` varchar(50) DEFAULT NULL,
  `serialEquipo` varchar(50) DEFAULT NULL,
  `macEquipo` varchar(17) DEFAULT NULL COMMENT 'MAC address',
  `ipEquipo` varchar(15) DEFAULT NULL COMMENT 'IP local asignada',
  `sufijoEquipo` varchar(15) DEFAULT NULL COMMENT 'Máscara de red',
  `puertaEnlaceEquipo` varchar(15) DEFAULT NULL COMMENT 'Gateway',
  `equipoPropiedad` enum('Cliente','Empresa') DEFAULT 'Empresa',
  `estadoEquipo` enum('Operativo','Dañado','Retirado','Mantenimiento') DEFAULT 'Operativo',
  `fechaInstalacion` date DEFAULT NULL,
  `fechaRetiro` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `creado` datetime DEFAULT current_timestamp(),
  `ultimaActualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Equipos instalados en casa del cliente (routers, ONTs, repetidores, decodificadores)';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_servicio`
--

CREATE TABLE `cliente_servicio` (
  `idClienteServicio` int(11) NOT NULL,
  `cliente_idCliente` int(11) NOT NULL,
  `servicio_idServicio` int(11) NOT NULL,
  `codigoPlan` varchar(20) DEFAULT NULL COMMENT 'Código del plan específico',
  `velocidadContratada` varchar(20) DEFAULT NULL COMMENT 'Ej: 100 Mbps',
  `valorServicio` decimal(10,2) NOT NULL COMMENT 'Valor de este servicio',
  `valorReconexion` decimal(10,2) DEFAULT 0.00,
  `fechaContratacion` date NOT NULL,
  `fechaBaja` date DEFAULT NULL COMMENT 'Fecha de cancelación del servicio',
  `estadoServicio` enum('Activo','Suspendido','Cancelado') DEFAULT 'Activo',
  `esPrincipal` tinyint(1) DEFAULT 0 COMMENT 'Servicio principal del cliente',
  `observaciones` text DEFAULT NULL,
  `creado` datetime DEFAULT current_timestamp(),
  `ultimaActualizacion` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Servicios contratados por cada cliente (un cliente puede tener múltiples servicios)';

--
-- Volcado de datos para la tabla `cliente_servicio`
--

INSERT INTO `cliente_servicio` (`idClienteServicio`, `cliente_idCliente`, `servicio_idServicio`, `codigoPlan`, `velocidadContratada`, `valorServicio`, `valorReconexion`, `fechaContratacion`, `fechaBaja`, `estadoServicio`, `esPrincipal`, `observaciones`, `creado`, `ultimaActualizacion`) VALUES
(1, 1, 1, '1', NULL, 10000.00, 0.00, '2023-05-12', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(2, 2, 1, '2', NULL, 20000.00, 0.00, '2023-05-18', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(3, 3, 1, '2', NULL, 20000.00, 0.00, '2023-05-17', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(4, 4, 1, '3', NULL, 30000.00, 0.00, '2023-05-17', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(5, 5, 1, '2', NULL, 20000.00, 0.00, '2023-06-01', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(6, 6, 1, '1', NULL, 10000.00, 0.00, '2023-01-02', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(7, 7, 1, '3', NULL, 30000.00, 0.00, '2023-03-01', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(8, 8, 1, '8', NULL, 80000.00, 0.00, '2023-01-10', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-20 23:00:02'),
(9, 9, 1, '1', NULL, 10000.00, 0.00, '2022-01-04', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(10, 10, 1, '3', NULL, 30000.00, 0.00, '2022-07-08', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(11, 11, 1, '4', NULL, 40000.00, 0.00, '2023-06-10', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(12, 12, 1, '3', NULL, 30000.00, 0.00, '2023-04-05', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(13, 13, 1, '3', NULL, 30000.00, 0.00, '2023-04-11', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(14, 14, 1, '7', NULL, 70000.00, 0.00, '2023-06-23', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 19:52:25'),
(15, 15, 1, '7', NULL, 70000.00, 0.00, '2024-01-24', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(16, 16, 1, '1', NULL, 10000.00, 0.00, '2024-02-08', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(17, 17, 1, '5', NULL, 50000.00, 0.00, '2024-02-09', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(18, 18, 1, '3', NULL, 30000.00, 0.00, '2024-02-05', NULL, 'Cancelado', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(19, 19, 1, '5', NULL, 50000.00, 0.00, '2024-02-12', NULL, 'Cancelado', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(20, 20, 1, '2', NULL, 20000.00, 0.00, '2024-01-02', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(21, 121, 1, '3', NULL, 30000.00, 0.00, '2024-01-03', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(22, 122, 1, '4', NULL, 40000.00, 0.00, '2024-01-04', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(23, 123, 1, '5', NULL, 50000.00, 0.00, '2024-01-05', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(24, 124, 1, '1', NULL, 10000.00, 0.00, '2024-01-06', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(25, 125, 1, '2', NULL, 20000.00, 0.00, '2024-01-07', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(26, 126, 1, '3', NULL, 30000.00, 0.00, '2024-01-08', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(27, 127, 1, '4', NULL, 40000.00, 0.00, '2024-01-09', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(28, 128, 1, '5', NULL, 50000.00, 0.00, '2024-01-10', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(29, 129, 1, '1', NULL, 10000.00, 0.00, '2024-01-11', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(30, 130, 1, '4', NULL, 40000.00, 0.00, '2024-01-12', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(31, 131, 1, '3', NULL, 30000.00, 0.00, '2024-01-13', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(32, 132, 1, '4', NULL, 40000.00, 0.00, '2024-01-14', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(33, 133, 1, '5', NULL, 50000.00, 0.00, '2024-01-15', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(34, 134, 1, '1', NULL, 10000.00, 0.00, '2024-01-16', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(35, 135, 1, '2', NULL, 20000.00, 0.00, '2024-01-17', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(36, 136, 1, '3', NULL, 30000.00, 0.00, '2024-01-18', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(37, 137, 1, '4', NULL, 40000.00, 0.00, '2024-01-19', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(38, 138, 1, '5', NULL, 50000.00, 0.00, '2024-01-20', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(39, 139, 1, '1', NULL, 10000.00, 0.00, '2024-01-21', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(40, 140, 1, '2', NULL, 20000.00, 0.00, '2024-01-22', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(41, 141, 1, '3', NULL, 30000.00, 0.00, '2024-01-23', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(42, 142, 1, '4', NULL, 40000.00, 0.00, '2024-01-24', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(43, 143, 1, '5', NULL, 50000.00, 0.00, '2024-01-25', NULL, 'Cancelado', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(44, 144, 1, '1', NULL, 10000.00, 0.00, '2024-01-26', NULL, 'Cancelado', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(45, 145, 1, '2', NULL, 20000.00, 0.00, '2024-01-27', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(46, 146, 1, '3', NULL, 30000.00, 0.00, '2024-01-28', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(47, 147, 1, '4', NULL, 40000.00, 0.00, '2024-01-01', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(48, 148, 1, '5', NULL, 50000.00, 0.00, '2024-01-02', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(49, 149, 1, '1', NULL, 10000.00, 0.00, '2024-01-03', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(50, 150, 1, '2', NULL, 20000.00, 0.00, '2024-01-04', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(51, 151, 1, '3', NULL, 30000.00, 0.00, '2024-01-05', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(52, 152, 1, '4', NULL, 40000.00, 0.00, '2024-01-06', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(53, 153, 1, '5', NULL, 50000.00, 0.00, '2024-01-07', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(54, 154, 1, '1', NULL, 10000.00, 0.00, '2024-01-08', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(55, 155, 1, '2', NULL, 20000.00, 0.00, '2024-01-09', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(56, 156, 1, '3', NULL, 30000.00, 0.00, '2024-01-10', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(57, 157, 1, '4', NULL, 40000.00, 0.00, '2024-01-11', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(58, 158, 1, '5', NULL, 50000.00, 0.00, '2024-01-12', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(59, 159, 1, '1', NULL, 10000.00, 0.00, '2024-01-13', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(60, 160, 1, '2', NULL, 20000.00, 0.00, '2024-01-14', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(61, 161, 1, '3', NULL, 30000.00, 0.00, '2024-01-15', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(62, 162, 1, '4', NULL, 40000.00, 0.00, '2024-01-16', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(63, 163, 1, '5', NULL, 50000.00, 0.00, '2024-01-17', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(64, 164, 1, '1', NULL, 10000.00, 0.00, '2024-01-18', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(65, 165, 1, '2', NULL, 20000.00, 0.00, '2024-01-19', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(66, 166, 1, '3', NULL, 30000.00, 0.00, '2024-01-20', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(67, 167, 1, '4', NULL, 40000.00, 0.00, '2024-01-21', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(68, 168, 1, '5', NULL, 50000.00, 0.00, '2024-01-22', NULL, 'Cancelado', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(69, 169, 1, '1', NULL, 10000.00, 0.00, '2024-01-23', NULL, 'Cancelado', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(70, 170, 1, '5', NULL, 50000.00, 0.00, '2025-09-12', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(71, 174, 1, '3', NULL, 30000.00, 0.00, '2025-08-01', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(72, 175, 1, '1', NULL, 10000.00, 0.00, '2025-10-07', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(73, 176, 1, '1', NULL, 10000.00, 0.00, '2023-09-07', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(74, 177, 1, '4', NULL, 40000.00, 0.00, '2025-10-15', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(75, 178, 1, '8', NULL, 80000.00, 0.00, '2025-10-02', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06'),
(76, 179, 1, '6', NULL, 60000.00, 0.00, '2025-10-10', NULL, 'Activo', 1, NULL, '2025-10-21 03:23:06', '2025-10-21 03:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefono`
--

CREATE TABLE `cliente_telefono` (
  `idTelefono` int(11) NOT NULL,
  `cliente_idCliente` int(11) NOT NULL,
  `tipoTelefono` enum('Principal','Secundario','Terciario','Trabajo','Emergencia') NOT NULL DEFAULT 'Principal',
  `numeroTelefono` varchar(20) NOT NULL,
  `nombreContacto` varchar(100) DEFAULT NULL COMMENT 'Si el teléfono es de otra persona',
  `esPrincipal` tinyint(1) DEFAULT 0,
  `activo` tinyint(1) DEFAULT 1,
  `creado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Múltiples teléfonos por cliente';

--
-- Volcado de datos para la tabla `cliente_telefono`
--

INSERT INTO `cliente_telefono` (`idTelefono`, `cliente_idCliente`, `tipoTelefono`, `numeroTelefono`, `nombreContacto`, `esPrincipal`, `activo`, `creado`) VALUES
(1, 1, 'Principal', '3005554878', NULL, 1, 1, '2025-10-21 03:23:06'),
(2, 2, 'Principal', '3008562013', NULL, 1, 1, '2025-10-21 03:23:06'),
(3, 3, 'Principal', '3122254858', NULL, 1, 1, '2025-10-21 03:23:06'),
(4, 4, 'Principal', '3103404090', NULL, 1, 1, '2025-10-21 03:23:06'),
(5, 5, 'Principal', '3203103525', NULL, 1, 1, '2025-10-21 03:23:06'),
(6, 6, 'Principal', '300300300', NULL, 1, 1, '2025-10-21 03:23:06'),
(7, 7, 'Principal', '3236587979', NULL, 1, 1, '2025-10-21 03:23:06'),
(8, 8, 'Principal', '878965412', NULL, 1, 1, '2025-10-21 03:23:06'),
(9, 9, 'Principal', '9547893652', NULL, 1, 1, '2025-10-21 03:23:06'),
(10, 10, 'Principal', '3231039856', NULL, 1, 1, '2025-10-21 03:23:06'),
(11, 11, 'Principal', '3216549898', NULL, 1, 1, '2025-10-21 03:23:06'),
(12, 12, 'Principal', '9548961245', NULL, 1, 1, '2025-10-21 03:23:06'),
(13, 13, 'Principal', '3103656989', NULL, 1, 1, '2025-10-21 03:23:06'),
(14, 14, 'Principal', '7893652123', NULL, 1, 1, '2025-10-21 03:23:06'),
(15, 15, 'Principal', '300886644', NULL, 1, 1, '2025-10-21 03:23:06'),
(16, 16, 'Principal', '1222323', NULL, 1, 1, '2025-10-21 03:23:06'),
(17, 17, 'Principal', '344455545', NULL, 1, 1, '2025-10-21 03:23:06'),
(18, 18, 'Principal', '6325698958', NULL, 1, 1, '2025-10-21 03:23:06'),
(19, 19, 'Principal', '123456789', NULL, 1, 1, '2025-10-21 03:23:06'),
(20, 20, 'Principal', '300500001', NULL, 1, 1, '2025-10-21 03:23:06'),
(21, 121, 'Principal', '300500002', NULL, 1, 1, '2025-10-21 03:23:06'),
(22, 122, 'Principal', '300500003', NULL, 1, 1, '2025-10-21 03:23:06'),
(23, 123, 'Principal', '300500004', NULL, 1, 1, '2025-10-21 03:23:06'),
(24, 124, 'Principal', '300500005', NULL, 1, 1, '2025-10-21 03:23:06'),
(25, 125, 'Principal', '300500006', NULL, 1, 1, '2025-10-21 03:23:06'),
(26, 126, 'Principal', '300500007', NULL, 1, 1, '2025-10-21 03:23:06'),
(27, 127, 'Principal', '300500008', NULL, 1, 1, '2025-10-21 03:23:06'),
(28, 128, 'Principal', '300500009', NULL, 1, 1, '2025-10-21 03:23:06'),
(29, 129, 'Principal', '300500010', NULL, 1, 1, '2025-10-21 03:23:06'),
(30, 130, 'Principal', '300500011', NULL, 1, 1, '2025-10-21 03:23:06'),
(31, 131, 'Principal', '300500012', NULL, 1, 1, '2025-10-21 03:23:06'),
(32, 132, 'Principal', '300500013', NULL, 1, 1, '2025-10-21 03:23:06'),
(33, 133, 'Principal', '300500014', NULL, 1, 1, '2025-10-21 03:23:06'),
(34, 134, 'Principal', '300500015', NULL, 1, 1, '2025-10-21 03:23:06'),
(35, 135, 'Principal', '300500016', NULL, 1, 1, '2025-10-21 03:23:06'),
(36, 136, 'Principal', '300500017', NULL, 1, 1, '2025-10-21 03:23:06'),
(37, 137, 'Principal', '300500018', NULL, 1, 1, '2025-10-21 03:23:06'),
(38, 138, 'Principal', '300500019', NULL, 1, 1, '2025-10-21 03:23:06'),
(39, 139, 'Principal', '300500020', NULL, 1, 1, '2025-10-21 03:23:06'),
(40, 140, 'Principal', '300500021', NULL, 1, 1, '2025-10-21 03:23:06'),
(41, 141, 'Principal', '300500022', NULL, 1, 1, '2025-10-21 03:23:06'),
(42, 142, 'Principal', '300500023', NULL, 1, 1, '2025-10-21 03:23:06'),
(43, 143, 'Principal', '300500024', NULL, 1, 1, '2025-10-21 03:23:06'),
(44, 144, 'Principal', '300500025', NULL, 1, 1, '2025-10-21 03:23:06'),
(45, 145, 'Principal', '300500026', NULL, 1, 1, '2025-10-21 03:23:06'),
(46, 146, 'Principal', '300500027', NULL, 1, 1, '2025-10-21 03:23:06'),
(47, 147, 'Principal', '300500028', NULL, 1, 1, '2025-10-21 03:23:06'),
(48, 148, 'Principal', '300500029', NULL, 1, 1, '2025-10-21 03:23:06'),
(49, 149, 'Principal', '300500030', NULL, 1, 1, '2025-10-21 03:23:06'),
(50, 150, 'Principal', '300500031', NULL, 1, 1, '2025-10-21 03:23:06'),
(51, 151, 'Principal', '300500032', NULL, 1, 1, '2025-10-21 03:23:06'),
(52, 152, 'Principal', '300500033', NULL, 1, 1, '2025-10-21 03:23:06'),
(53, 153, 'Principal', '300500034', NULL, 1, 1, '2025-10-21 03:23:06'),
(54, 154, 'Principal', '300500035', NULL, 1, 1, '2025-10-21 03:23:06'),
(55, 155, 'Principal', '300500036', NULL, 1, 1, '2025-10-21 03:23:06'),
(56, 156, 'Principal', '300500037', NULL, 1, 1, '2025-10-21 03:23:06'),
(57, 157, 'Principal', '300500038', NULL, 1, 1, '2025-10-21 03:23:06'),
(58, 158, 'Principal', '300500039', NULL, 1, 1, '2025-10-21 03:23:06'),
(59, 159, 'Principal', '300500040', NULL, 1, 1, '2025-10-21 03:23:06'),
(60, 160, 'Principal', '300500041', NULL, 1, 1, '2025-10-21 03:23:06'),
(61, 161, 'Principal', '300500042', NULL, 1, 1, '2025-10-21 03:23:06'),
(62, 162, 'Principal', '300500043', NULL, 1, 1, '2025-10-21 03:23:06'),
(63, 163, 'Principal', '300500044', NULL, 1, 1, '2025-10-21 03:23:06'),
(64, 164, 'Principal', '300500045', NULL, 1, 1, '2025-10-21 03:23:06'),
(65, 165, 'Principal', '300500046', NULL, 1, 1, '2025-10-21 03:23:06'),
(66, 166, 'Principal', '300500047', NULL, 1, 1, '2025-10-21 03:23:06'),
(67, 167, 'Principal', '300500048', NULL, 1, 1, '2025-10-21 03:23:06'),
(68, 168, 'Principal', '300500049', NULL, 1, 1, '2025-10-21 03:23:06'),
(69, 169, 'Principal', '300500050', NULL, 1, 1, '2025-10-21 03:23:06'),
(70, 170, 'Principal', '3123828822', NULL, 1, 1, '2025-10-21 03:23:06'),
(71, 174, 'Principal', '31964354', NULL, 1, 1, '2025-10-21 03:23:06'),
(72, 175, 'Principal', '3123828822', NULL, 1, 1, '2025-10-21 03:23:06'),
(73, 176, 'Principal', '3196443053', NULL, 1, 1, '2025-10-21 03:23:06'),
(74, 178, 'Principal', '23423423423', NULL, 1, 1, '2025-10-21 03:23:06'),
(75, 179, 'Principal', '31238266565', NULL, 1, 1, '2025-10-21 03:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL DEFAULT 1,
  `logoEmpr` longblob DEFAULT NULL,
  `rz` varchar(255) DEFAULT NULL,
  `nombEmpresa` varchar(255) DEFAULT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `crc` varchar(255) DEFAULT NULL,
  `nombrepleg` varchar(255) DEFAULT NULL,
  `docurepleg` varchar(50) DEFAULT NULL,
  `dirsede` varchar(255) DEFAULT NULL,
  `telsede` varchar(20) DEFAULT NULL,
  `telsede2` varchar(50) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `paginaWeb` varchar(255) DEFAULT NULL,
  `fechaConstitucion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `logoEmpr`, `rz`, `nombEmpresa`, `nit`, `crc`, `nombrepleg`, `docurepleg`, `dirsede`, `telsede`, `telsede2`, `email`, `paginaWeb`, `fechaConstitucion`) VALUES
(1, NULL, 'PROVEEDORES DE SERVICIO DE INTERNET', 'SKUBOX S.A.S', '989988998-8', '12345566', 'JHON DOU', '907654321', 'Carrera 3b #2349', '08052225226', '08052225226', 'schickperez@gmail.co', 'www.skubox.com', '2024-01-10');

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
  `estadoFactura` enum('Pagada','Pendiente','Gratis','Vencida','Anulada') NOT NULL DEFAULT 'Pendiente',
  `cliente_idCliente` int(11) NOT NULL,
  `idPlan` int(11) DEFAULT NULL,
  `fechaVencimiento` date NOT NULL,
  `fechaSuspencion` date NOT NULL,
  `estadoManual` tinyint(1) DEFAULT 0
) ENGINE=InnoDB AVG_ROW_LENGTH=45 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `fechaFactura`, `impuestoTotal`, `subTotal`, `valorTotalFactura`, `estadoFactura`, `cliente_idCliente`, `idPlan`, `fechaVencimiento`, `fechaSuspencion`, `estadoManual`) VALUES
(1, '2024-03-01', 19000, 81000, 100000, 'Pagada', 7, 3, '2024-03-16', '2024-03-21', 1),
(2, '2024-02-03', 76000, 324000, 400000, 'Pagada', 6, 8, '2024-02-18', '2024-02-23', 0),
(3, '2024-02-01', 9500, 40500, 50000, 'Vencida', 7, 1, '2024-02-16', '2024-02-21', 0),
(4, '2024-01-03', 66500, 283500, 175000, 'Pagada', 6, 9, '2024-01-18', '2024-01-23', 0),
(5, '2024-01-18', 13300, 56700, 35000, 'Pagada', 14, 2, '2024-02-02', '2024-02-07', 0),
(6, '2025-03-05', 13300, 56700, 70000, 'Pagada', 14, 2, '2025-03-20', '2025-03-25', 0),
(7, '2024-03-18', 1900, 10000, 11900, 'Pagada', 8, 1, '2024-04-17', '2024-04-22', 1),
(8, '2025-10-06', 9500, 50000, 59500, 'Gratis', 1, 1, '2025-10-21', '2025-10-26', 1),
(9, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 9, 1, '2025-10-21', '2025-10-26', 0),
(10, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 16, 1, '2025-10-21', '2025-10-26', 0),
(11, '2025-10-06', 9500, 50000, 59500, 'Pagada', 124, 1, '2025-10-21', '2025-10-26', 0),
(12, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 129, 1, '2025-10-21', '2025-10-26', 0),
(13, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 134, 1, '2025-10-21', '2025-10-26', 0),
(14, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 139, 1, '2025-10-21', '2025-10-26', 0),
(15, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 144, 1, '2025-10-21', '2025-10-26', 0),
(16, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 149, 1, '2025-11-06', '2025-11-11', 0),
(17, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 154, 1, '2025-10-21', '2025-10-26', 0),
(18, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 159, 1, '2025-10-21', '2025-10-26', 0),
(19, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 164, 1, '2025-10-21', '2025-10-26', 0),
(20, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 169, 1, '2025-10-21', '2025-10-26', 0),
(21, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 2, 2, '2025-10-21', '2025-10-26', 0),
(22, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 3, 2, '2025-10-21', '2025-10-26', 0),
(23, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 5, 2, '2025-10-21', '2025-10-26', 0),
(24, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 20, 2, '2025-10-21', '2025-10-26', 0),
(25, '2025-08-04', 14250, 75000, 89250, 'Vencida', 125, 2, '2025-09-04', '2025-09-09', 0),
(26, '2025-09-13', 14250, 75000, 89250, 'Vencida', 130, 2, '2025-10-13', '2025-10-18', 0),
(27, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 135, 2, '2025-10-21', '2025-10-26', 0),
(28, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 140, 2, '2025-10-21', '2025-10-26', 0),
(29, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 145, 2, '2025-10-21', '2025-10-26', 0),
(30, '2025-09-01', 14250, 75000, 89250, 'Pagada', 146, 2, '2025-10-01', '2025-10-06', 0),
(31, '2025-10-01', 14250, 75000, 89250, 'Pagada', 150, 2, '2025-11-01', '2025-11-06', 0),
(32, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 155, 2, '2025-10-21', '2025-10-26', 0),
(33, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 160, 2, '2025-10-21', '2025-10-26', 0),
(34, '2025-10-06', 14250, 75000, 89250, 'Pendiente', 165, 2, '2025-10-21', '2025-10-26', 0),
(35, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 4, 3, '2025-10-21', '2025-10-26', 0),
(36, '2025-01-01', 19000, 100000, 119000, 'Vencida', 10, 3, '2025-02-01', '2025-02-06', 0),
(37, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 12, 3, '2025-10-21', '2025-10-26', 0),
(38, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 13, 3, '2025-10-21', '2025-10-26', 0),
(39, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 18, 3, '2025-10-21', '2025-10-26', 0),
(40, '2025-10-06', 19000, 100000, 119000, 'Gratis', 121, 3, '2025-10-21', '2025-10-26', 0),
(41, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 126, 3, '2025-10-21', '2025-10-26', 0),
(42, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 131, 3, '2025-10-21', '2025-10-26', 0),
(43, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 136, 3, '2025-10-21', '2025-10-26', 0),
(44, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 141, 3, '2025-10-21', '2025-10-26', 0),
(45, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 151, 3, '2025-10-21', '2025-10-26', 0),
(46, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 156, 3, '2025-10-21', '2025-10-26', 0),
(47, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 161, 3, '2025-10-21', '2025-10-26', 0),
(48, '2025-10-06', 19000, 100000, 119000, 'Pendiente', 166, 3, '2025-10-21', '2025-10-26', 0),
(49, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 11, 4, '2025-10-21', '2025-10-26', 0),
(50, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 122, 4, '2025-10-21', '2025-10-26', 0),
(51, '2025-10-02', 22800, 120000, 142800, 'Gratis', 127, 4, '2025-11-02', '2025-11-07', 0),
(52, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 132, 4, '2025-10-21', '2025-10-26', 0),
(53, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 137, 4, '2025-10-21', '2025-10-26', 0),
(54, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 142, 4, '2025-10-21', '2025-10-26', 0),
(55, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 147, 4, '2025-10-21', '2025-10-26', 0),
(56, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 152, 4, '2025-10-21', '2025-10-26', 0),
(57, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 157, 4, '2025-10-21', '2025-10-26', 0),
(58, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 162, 4, '2025-10-21', '2025-10-26', 0),
(59, '2025-10-06', 22800, 120000, 142800, 'Pendiente', 167, 4, '2025-10-21', '2025-10-26', 0),
(60, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 17, 5, '2025-10-21', '2025-10-26', 0),
(61, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 19, 5, '2025-10-21', '2025-10-26', 0),
(62, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 123, 5, '2025-10-21', '2025-10-26', 0),
(63, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 128, 5, '2025-10-21', '2025-10-26', 0),
(64, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 133, 5, '2025-10-21', '2025-10-26', 0),
(65, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 138, 5, '2025-10-21', '2025-10-26', 0),
(66, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 143, 5, '2025-10-21', '2025-10-26', 0),
(67, '2025-09-13', 9500, 50000, 59500, 'Vencida', 148, 5, '2025-10-13', '2025-10-18', 0),
(68, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 153, 5, '2025-10-21', '2025-10-26', 0),
(69, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 158, 5, '2025-10-21', '2025-10-26', 0),
(70, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 163, 5, '2025-10-21', '2025-10-26', 0),
(71, '2025-10-06', 9500, 50000, 59500, 'Pendiente', 168, 5, '2025-10-21', '2025-10-26', 0),
(72, '2025-10-06', 12350, 65000, 77350, 'Pendiente', 15, 7, '2025-10-21', '2025-10-26', 0),
(135, '2023-02-15', 19000, 81000, 100000, 'Pagada', 6, 3, '2023-03-02', '2023-03-07', 1),
(136, '2023-05-10', 76000, 324000, 400000, 'Vencida', 7, 8, '2023-05-25', '2023-05-30', 0),
(137, '2023-07-03', 9500, 40500, 50000, 'Pagada', 8, 1, '2023-07-18', '2023-07-23', 0),
(138, '2024-09-01', 13300, 56700, 70000, 'Pagada', 14, 2, '2025-10-01', '2025-10-06', 0),
(139, '2025-09-13', 22800, 97200, 120000, 'Vencida', 8, 4, '2025-10-13', '2025-10-18', 0),
(140, '2025-08-13', 66500, 283500, 350000, 'Vencida', 6, 9, '2025-09-13', '2025-09-18', 0),
(141, '2025-10-20', 0, 30000, 30000, 'Gratis', 174, 3, '2025-11-20', '2025-11-25', 0),
(142, '2025-10-07', 0, 10000, 10000, 'Gratis', 175, 1, '2025-11-06', '2025-11-11', 1),
(143, '2025-10-07', 1900, 10000, 11900, 'Pagada', 176, 1, '2025-11-06', '2025-11-11', 0),
(144, '2025-09-07', 13300, 70000, 83300, 'Pagada', 7, 7, '2025-09-22', '2025-09-27', 1),
(145, '2025-11-21', 0, 0, 10000, 'Pendiente', 1, 1, '2025-11-26', '2025-12-01', 0),
(146, '2025-10-22', 0, 0, 30000, 'Pendiente', 7, 3, '2025-10-27', '2025-11-01', 0),
(147, '2025-11-21', 0, 0, 10000, 'Pendiente', 124, 1, '2025-11-26', '2025-12-01', 0),
(148, '2025-09-01', 0, 0, 20000, 'Pagada', 146, 2, '2025-10-01', '2025-10-06', 0),
(149, '2025-09-01', 0, 0, 10000, 'Gratis', 175, 1, '2025-10-01', '2025-10-06', 0),
(150, '2025-12-06', 0, 0, 10000, 'Pendiente', 176, 1, '2025-12-11', '2025-12-16', 0),
(151, '2025-09-13', 0, 0, 20000, 'Vencida', 146, 2, '2025-10-13', '2025-10-18', 0),
(152, '2025-11-01', 0, 0, 10000, 'Pendiente', 14, 1, '2025-11-06', '2025-11-11', 0),
(153, '2025-10-15', 0, 0, 0, 'Gratis', 177, 4, '2025-11-15', '2025-11-20', 0),
(154, '2025-10-02', 0, 0, 0, 'Gratis', 178, 8, '2025-12-15', '2025-12-20', 0),
(155, '2025-11-21', 0, 0, 30000, 'Pendiente', 121, 3, '2025-11-26', '2025-12-01', 0),
(156, '2025-12-01', 0, 0, 20000, 'Pendiente', 150, 2, '2025-12-06', '2025-12-11', 0),
(157, '2025-12-15', 0, 0, 40000, 'Pendiente', 177, 4, '2025-12-20', '2025-12-25', 0),
(158, '2026-01-15', 0, 0, 80000, 'Pendiente', 178, 8, '2026-01-20', '2026-01-25', 0),
(159, '2025-12-02', 0, 0, 40000, 'Pendiente', 127, 4, '2025-12-07', '2025-12-12', 0),
(160, '2025-12-20', 0, 0, 30000, 'Pendiente', 174, 3, '2025-12-25', '2025-12-30', 0),
(161, '2025-11-01', 0, 0, 10000, 'Pendiente', 175, 1, '2025-11-06', '2025-11-11', 0),
(162, '2025-10-18', 0, 0, 0, 'Gratis', 179, 6, '2025-12-18', '2025-12-23', 0),
(163, '2026-01-18', 0, 0, 60000, 'Pendiente', 179, 6, '2026-01-23', '2026-01-28', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ip_publica`
--

CREATE TABLE `ip_publica` (
  `idIpPublica` int(11) NOT NULL,
  `cliente_idCliente` int(11) NOT NULL,
  `clienteServicio_id` int(11) DEFAULT NULL COMMENT 'Para qué servicio es esta IP',
  `ipPublicaInicial` varchar(15) NOT NULL COMMENT 'IP inicial o única',
  `ipPublicaFinal` varchar(15) DEFAULT NULL COMMENT 'IP final si es rango',
  `fechaAsignacion` date NOT NULL,
  `fechaLiberacion` date DEFAULT NULL COMMENT 'Fecha de liberación',
  `activo` tinyint(1) DEFAULT 1,
  `observaciones` text DEFAULT NULL,
  `creado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Rangos de IPs públicas asignadas a clientes (especialmente empresariales)';

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
(1, '1', 'rural', '5mb', 'Plan economico', 10000, 'Plan económico de 20mb para la cuidad adecuada para casa pequeñas', 'Activo'),
(2, '2', 'rural', '10mb', 'Plan dorado', 20000, 'EL plan dorado urbano es mucho mas rapido ideal para una familia completa, con fibra óptica, ofrece excelente velicidad de internet', 'Activo'),
(3, '3', 'rural', '15mb', 'Plan diamante', 30000, 'Plan de alta velocidad para hogares', 'Activo'),
(4, '4', 'rural', '20mb', 'Plan empresa', 40000, 'Plan Ideal Para empresas pequeñas, por 120000 y de fibra optica puede alcanzar buenas velocidades', 'Activo'),
(5, '5', 'rural', '25 mb', 'Plan Basico', 50000, 'EL plan rural Basico consta de 5 megas de navegación, se hace por medio de radiofrecuencia y es el plan que tiene mayor covertura, recomendado para personas que vivan muy alejadas o en sitios de dificil alcance.', 'Activo'),
(6, '6', 'rural', '30 mb', 'Plan elite empresa', 60000, 'Plan para empresas grande que requieran excelente velocidades de wifi, viene con fibra óptica', 'Activo'),
(7, '7', 'rural', '35 mb', 'Plan dorado', 70000, 'Plan fibra optica rural, un plan con velocidades de internet más rapidas, para sitio rurales cerca a las cuidades más cercanas, toca validar disponibilidad', 'Activo'),
(8, '8', 'rural', '40 mb', 'Plan elite de empresas', 80000, 'Plan elite para las empresas mas grandes que necesitan altas velocidades', 'Activo'),
(9, '9', 'rural', '45mb', 'Plan mega', 90000, 'Plan diseñado para las grandes fincas de la region', 'Archivado');

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
(3, 'C.E', '47', 'fabian schick', '3195899457', 'ff@gmail.com', 'Peticion', 'Mejor velocidad en mi servicio', 'Inactivo', 'Modem en camino'),
(4, 'C.C', '12363235', 'Carlos Rubiano', '7859635874', 'cr56@aol.com', 'Sugerencia', 'Que los técnicos sean mas puntuales', 'Inactivo', NULL),
(5, 'C.C', '1223456', 'Nicolas Borda', '3443456', 'nico@correo.na', 'Reclamo', 'El internet me esta fallando constantemente y necesito un reembolso', 'Inactivo', NULL),
(6, 'C.C', '75', 'Estefania', '987563254', 'cristian.audir8@hotmail.com', 'Reclamo', 'Me llego mal el modem de internet', 'Inactivo', NULL),
(7, 'C.C', '789', 'Ana Maria Rosales', '7895632525', 'maria@gmail.com', 'Reclamo', 'EL modem de internet no esta trabajando correctamente', 'Inactivo', 'Servicio completado satisfactoriamente'),
(8, 'cc', '1625898', 'Daniela FLor', '3198965656', 'dd@gmail.com', 'Peticion', 'Solicito cables de modem', '', ''),
(9, 'C.C', '965874', 'Gabriella Allende', '3251456857', 'ga@hotmail.com', 'Reclamo', 'Internet intermitente constante', NULL, NULL),
(10, 'C.C', '965874', 'Gabriella Allende', '3251456857', 'ga@hotmail.com', 'Sugerencia', 'Ser mas rapidos en responder', NULL, NULL),
(11, 'C.C', '1625898', 'Daniela FLor', '3198965656', 'dd@gmail.com', 'Sugerencia', 'Buen servicio', NULL, NULL),
(12, '', '', '2', '', '', '', '', '', ''),
(13, 'C.C', '5656', 'Isabella Quimaby', '3215698989', 'isabella@gmail.com', 'Peticion', 'reuqerimos cables de conexión', NULL, NULL),
(14, 'C.C', '123456', 'Camilo gil', '33333', 'cami@gmail.com', 'Peticion', 'El internet esta algo lento necesto un reembolso', '', 'Resuelto'),
(15, 'C.C', '111111111', 'Edubin', '33333333', 'edubin@gmail.com', 'Reclamo', 'prueba sustentacion', '', 'Resuelto'),
(16, 'C.C', '123456', 'Camilo gil', '33333', 'cami@gmail.com', 'Peticion', 'El internet esta algo lento prueba de estadooooooooo necesto un reembolso', '', 'Resuelto'),
(17, 'C.C', '123456', 'Daniela FLor', '3333333', 'd@gmail.com', 'Peticion', 'dsdfsdf', NULL, NULL),
(20, 'C.C', '789', 'Juan Torres', '3105874596', 'juan@gmail.com', 'Reclamo', 'La factura me llego por mayor valor', 'Inactivo', 'mas a validar su solicitud'),
(21, '', '', '', '', '', '', '', 'Inactivo', NULL),
(22, 'C.C', '999999', 'pedro manuel jimenez', '319644454', 'pedroz@gmail.com', 'Reclamo', 'servi malo', 'Activo', 'ok bien no se hizo'),
(23, 'C.C', '242424', 'don pruebas', '354443053', 'schickkkkperez@gmail.com', 'Reclamo', 'don pruebas no vino', 'Activo', NULL);

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
(1, 'Modem Asus', '545784545', 'Modem Arris velocidad media fibra optica', 6, 'Inactivo'),
(2, 'Modem Mi alta velocidad', '55448754', 'Modem Mii velocidad media', 10, 'Activo'),
(3, 'Modem MI', '52144452', 'Modem Asus velocidad alta', 10, 'Activo'),
(4, 'Cables fibra optica', '32525225', 'Cables fibra optica', 5, 'Activo'),
(5, 'Modem arris', '5689', 'Modem Arris de fibra optica para alta velocidad', 12, 'Activo'),
(6, 'Cables de fibra optica', '5289645s', 'Cables utilizados para instalaciones fibra óptica', 60, 'Inactivo'),
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
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `idServicio` int(11) NOT NULL,
  `codigoServicio` varchar(20) NOT NULL,
  `nombreServicio` varchar(100) NOT NULL,
  `tipoServicio` enum('Internet','Television','Telefonia','Repetidor','Otro') NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precioBase` decimal(10,2) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `requiereEquipo` tinyint(1) DEFAULT 1,
  `creado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo de servicios disponibles (Internet, TV, Telefonía, etc.)';

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`idServicio`, `codigoServicio`, `nombreServicio`, `tipoServicio`, `descripcion`, `precioBase`, `activo`, `requiereEquipo`, `creado`) VALUES
(1, 'INT-100', 'Internet 100 Mbps', 'Internet', 'Plan residencial 100 Mbps fibra óptica', 50000.00, 1, 1, '2025-10-21 03:23:06'),
(2, 'INT-200', 'Internet 200 Mbps', 'Internet', 'Plan residencial 200 Mbps fibra óptica', 70000.00, 1, 1, '2025-10-21 03:23:06'),
(3, 'TV-BASICO', 'TV Básico', 'Television', '80 canales básicos', 25000.00, 1, 1, '2025-10-21 03:23:06'),
(4, 'TV-PREMIUM', 'TV Premium', 'Television', '150 canales + HBO', 45000.00, 1, 1, '2025-10-21 03:23:06'),
(5, 'TEL-FIJO', 'Telefonía Fija', 'Telefonia', 'Línea fija ilimitada nacional', 15000.00, 1, 0, '2025-10-21 03:23:06'),
(6, 'REP-WIFI', 'Repetidor WiFi', 'Repetidor', 'Extensor de señal WiFi mesh', 10000.00, 1, 1, '2025-10-21 03:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_valor_agregado`
--

CREATE TABLE `servicio_valor_agregado` (
  `idServicioValorAgregado` int(11) NOT NULL,
  `clienteServicio_id` int(11) NOT NULL,
  `valorAgregado_id` int(11) NOT NULL,
  `valorCobrado` decimal(10,2) NOT NULL COMMENT 'Valor cobrado (puede variar del catálogo)',
  `fechaAgregado` date NOT NULL,
  `fechaBaja` date DEFAULT NULL COMMENT 'Fecha de cancelación',
  `activo` tinyint(1) DEFAULT 1,
  `observaciones` text DEFAULT NULL,
  `creado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Valores agregados contratados para servicios específicos del cliente';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `idSolicitud` int(50) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `estadoSolicitud` varchar(50) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`idSolicitud`, `nombres`, `telefono`, `email`, `estadoSolicitud`) VALUES
(1, 'Estefania Flor', '3195852323', 'este@gmail.com', 'Atendido'),
(2, 'Julian Hernandez', '3692582365', 'juli@gmail.com', 'Atendido'),
(3, 'Ayane Hayabusa', '5893652121', 'ayane@hotmail.com', 'Atendido'),
(4, 'Kasumi Hayabusa', '9549638521414', 'kasumi@gmail.com', 'Atendido'),
(5, 'Helena Leau', '9638525858', 'helena@yahoo.com', 'Atendido'),
(6, 'Fabian Quimbay', '3258963254', 'helena@gmail.com', 'Activo'),
(7, 'Ana Maria Rosales', '7893652123', 'maria@gmail.com', 'Atendido'),
(8, 'Juan Rodriguez', '123456', 'juan@aol.com', 'Atendido'),
(9, 'Helena', '7859635874', 'helena@gmail.com', 'Activo'),
(10, 'stephy gomez', '3198988686', 'ste@gmail.com', 'Activo'),
(11, 'juanito alimaña', '300886644', 'alimana@gmail.com', 'Atendido'),
(12, 'Isabella Perez', '3216549898', 'isa.tkm@hotmail.com', 'Activo'),
(13, 'forero wilmar', '31155669988', 'forero@gmail.com', 'Activo'),
(14, '', '', '', 'Activo'),
(15, 'Karl Heinz Schick', '3196443053', 'schickperez@gmail.com', 'Activo'),
(16, 'maurico', '7687676', 'guerra@gmail.com', 'Atendido'),
(17, 'Karl Heinz Schick', '3196443053', 'schickperez@gmail.com', 'Activo');

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
(1, 1, 4),
(2, 2, 6),
(3, 3, 7),
(4, 4, 4),
(5, 5, 4),
(6, 6, 4),
(7, 7, 4),
(8, 8, 9),
(9, 9, 4),
(10, 10, 4),
(11, 12, 4),
(12, 13, 4),
(13, 14, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `tipoDocumento` varchar(20) NOT NULL DEFAULT 'CC',
  `documentoUsuario` varchar(20) NOT NULL,
  `nombresUsuario` varchar(100) NOT NULL,
  `user_usuario` varchar(50) DEFAULT NULL,
  `telefonoUsuario` varchar(20) DEFAULT NULL,
  `telefonoUsuario_dos` varchar(20) DEFAULT NULL,
  `telefonoUsuario_tres` varchar(20) DEFAULT NULL,
  `correoUsuario` varchar(100) NOT NULL,
  `direccionUsuario` varchar(255) DEFAULT NULL,
  `claveUsuario` varchar(150) NOT NULL,
  `estadoUsuario` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `creado` date NOT NULL,
  `ultimaActualizacion` date NOT NULL,
  `rol` varchar(100) NOT NULL,
  `fotoUsuario` varchar(255) DEFAULT 'pic-1.png',
  `foto` varchar(255) DEFAULT NULL,
  `ciudadUsuario` varchar(100) DEFAULT NULL,
  `departamentoUsuario` varchar(100) DEFAULT NULL,
  `paisUsuario` varchar(100) DEFAULT NULL,
  `codigoPostalUsuario` varchar(20) DEFAULT NULL,
  `contactoEmergenciaNombre` varchar(100) DEFAULT NULL,
  `contactoEmergenciaTelefono` varchar(20) DEFAULT NULL,
  `contactoEmergenciaParentesco` varchar(50) DEFAULT NULL,
  `referenciaPersonalNombre` varchar(100) DEFAULT NULL,
  `referenciaPersonalTelefono` varchar(20) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `estadoCivil` varchar(30) DEFAULT NULL,
  `numeroHijos` int(11) DEFAULT 0,
  `cargo` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `fechaIngreso` date DEFAULT NULL,
  `tipoContrato` varchar(50) DEFAULT NULL,
  `salarioBase` decimal(12,2) DEFAULT 0.00,
  `supervisorId` int(11) DEFAULT NULL,
  `idEmpresa` int(11) DEFAULT NULL,
  `idSucursal` int(11) DEFAULT NULL,
  `estadoLaboral` enum('activo','vacaciones','licencia','retirado') DEFAULT 'activo',
  `eps` varchar(100) DEFAULT NULL,
  `arl` varchar(100) DEFAULT NULL,
  `fondoPension` varchar(100) DEFAULT NULL,
  `banco` varchar(100) DEFAULT NULL,
  `numeroCuentaBancaria` varchar(50) DEFAULT NULL,
  `ultimoLogin` datetime DEFAULT NULL,
  `intentosFallidos` int(11) DEFAULT 0,
  `tokenRecuperacion` varchar(255) DEFAULT NULL,
  `tokenExpira` datetime DEFAULT NULL,
  `twoFactorEnabled` tinyint(1) DEFAULT 0,
  `ultimoCambioClave` datetime DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT 0,
  `creadoPor` int(11) DEFAULT NULL,
  `actualizadoPor` int(11) DEFAULT NULL,
  `ipRegistro` varchar(45) DEFAULT NULL,
  `ipUltimoAcceso` varchar(45) DEFAULT NULL,
  `navegadorUltimoAcceso` varchar(255) DEFAULT NULL,
  `documentosAdjuntos` text DEFAULT NULL,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `tipoDocumento`, `documentoUsuario`, `nombresUsuario`, `user_usuario`, `telefonoUsuario`, `telefonoUsuario_dos`, `telefonoUsuario_tres`, `correoUsuario`, `direccionUsuario`, `claveUsuario`, `estadoUsuario`, `creado`, `ultimaActualizacion`, `rol`, `fotoUsuario`, `foto`, `ciudadUsuario`, `departamentoUsuario`, `paisUsuario`, `codigoPostalUsuario`, `contactoEmergenciaNombre`, `contactoEmergenciaTelefono`, `contactoEmergenciaParentesco`, `referenciaPersonalNombre`, `referenciaPersonalTelefono`, `fechaNacimiento`, `estadoCivil`, `numeroHijos`, `cargo`, `area`, `fechaIngreso`, `tipoContrato`, `salarioBase`, `supervisorId`, `idEmpresa`, `idSucursal`, `estadoLaboral`, `eps`, `arl`, `fondoPension`, `banco`, `numeroCuentaBancaria`, `ultimoLogin`, `intentosFallidos`, `tokenRecuperacion`, `tokenExpira`, `twoFactorEnabled`, `ultimoCambioClave`, `eliminado`, `creadoPor`, `actualizadoPor`, `ipRegistro`, `ipUltimoAcceso`, `navegadorUltimoAcceso`, `documentosAdjuntos`, `notas`) VALUES
(1, 'C.C', '100100', 'admon', 'admon', '', NULL, NULL, '', NULL, '$2y$10$KD.W6BS9jW0fpT4BZ7W1v.M/G6VXL4QsuYJG3lSZeKPDFyoQ2E/s.', 'Activo', '2025-10-04', '2025-10-04', 'SuperUsuario', 'pic-1.png', 'user_68f582032daa9.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 'activo', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'C.C', '80065421', 'Karl schick', 'karl_schick', '3196443053', '3115765959', '', 'schickperez@gmail.com', 'Carrera 45 #12-58', '$2y$10$GYWI1fTwkRejXRABD9WAIu5n5ZdNfQLn6eKaf3uMtroQ559ToOEaO', 'Activo', '0000-00-00', '0000-00-00', 'Administrador', 'pic-1.png', 'user_68edc1aeaa3c7.jpg', 'Bogotá', 'Bogotá', 'Colombia', '110111', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1979-08-05', 'Soltero', 2, 'Administrador', 'Administrador', '2023-01-19', 'termino indefinido', 0.00, 0, 0, 0, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '6683554915', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'Datos administrativos completados automáticamente.'),
(3, 'C.C', '1011258369', 'cristian muñoz', 'cristian_muñoz', '3002885522', '3005866321', '345689521', 'cristian@hotmail.com', 'Carrera 45 #12-58', '$2y$10$7CyzdTIMLiFIVigccQCTweXFHSW6BrqxRXTiGaHLzgAm4vSNOxbIy', 'Activo', '2023-05-10', '2023-05-10', 'Administrador', 'pic-1.png', 'user_68edc1d8b5716.jpg', 'Bogotá', 'Bogotá D.C', 'Colombia', '050001', 'María Muñoz', '3205551111', 'Hermana', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, 'Ingeniero de Datos', 'Sistemas', '2024-10-19', 'a término indefinido', 2200000.00, 0, 0, 0, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '5145762986', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Datos administrativos completados automáticamente.'),
(4, 'C.C', '1019076993', 'Fabian ochoa', 'fabiancho', '3104552020', NULL, NULL, 'fabiancho@aol.com', 'Carrera 45 #12-58', '$2y$10$9Usf542i.A/yN7k8e4X.ze/bWor5SgAlrvLDA1PMbuHhIBz9pJK5.', 'Activo', '2023-05-12', '2024-02-10', 'Tecnico', 'pic-1.png', 'user_68edc6dff2c93.jpg', 'Medellín', 'Antioquia', 'Colombia', '050001', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, NULL, NULL, '2024-10-19', NULL, 0.00, NULL, NULL, NULL, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '2953463804', NULL, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Datos administrativos completados automáticamente.'),
(5, 'C.C', '1030634046', 'nicolas perez', 'nico', '3006646485', '315485546', '', 'nico@gmail.com', 'Carrera 45 #12-58', '$2y$10$9ruPWqEKJqkmS4KoI1LOTOmfsSi6/lhoTCFL5d4qIVvR8KuD6dxBe', 'Activo', '2023-05-12', '2023-05-12', 'Administrador', 'pic-1.png', 'pic-1.png', 'bogota', 'bogota', 'Colombia', '050001', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, '', '', '2024-10-19', '', 0.00, 0, 0, 0, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '5678150490', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Datos administrativos completados automáticamente.'),
(6, 'C.C', '1001147852', 'Daniel montañez', 'danny2', '3198562333', '31157456546', '', 'danny@gmail.com', 'Carrera 45 #12-58', '$2y$10$FqJqy.3uUwll3Ucj89zbUuPkkzUkobGeDm61m3cKB8PeBpC1oG8Hq', 'Activo', '2023-11-06', '2025-10-13', 'Administrador', 'pic-1.png', 'pic-1.png', 'bogota', 'bogota', 'Colombia', '050001', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, '', '', '2024-10-19', '', 0.00, 0, 0, 0, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '7732867856', '0000-00-00 00:00:00', 0, '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, 0, '', '', '', '', 'Datos administrativos completados automáticamente.'),
(7, 'C.C', '1222233', 'linda linero', 'linlin', '344455545', NULL, NULL, 'linlin@gmail.com', 'Carrera 45 #12-58', '$2y$10$BWe9ZqyPNScYPikJr/APzuxidw.OnZ/R2jwZeT5vZ.sVkNpv1N332', 'Inactivo', '2024-02-09', '2024-02-10', 'Tecnico', 'pic-1.png', NULL, 'Medellín', 'Antioquia', 'Colombia', '050001', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, NULL, NULL, '2024-10-19', NULL, 0.00, NULL, NULL, NULL, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '9803948177', NULL, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Datos administrativos completados automáticamente.'),
(9, 'C.C', '258741369', 'pedro linero', 'pepe', '23456987', NULL, NULL, 'pepe@gmail.com', 'Carrera 45 #12-58', '$2y$10$1r8lg5gd6Gvr8AWxAhn9eum1Tq67OncXYSgsNq3H5WZpu.g8yJZmi', 'Inactivo', '2025-03-04', '2025-03-04', 'Tecnico', 'pic-1.png', NULL, 'Medellín', 'Antioquia', 'Colombia', '050001', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, NULL, NULL, '2024-10-19', NULL, 0.00, NULL, NULL, NULL, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '9693843916', NULL, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Datos administrativos completados automáticamente.'),
(10, 'C.C', '1098606020', 'jhon m auris', 'mauris', '3161600007', NULL, NULL, 'maurice@gmail.com', 'Carrera 45 #12-58', '$2y$10$3HACpJkRqqI1idu9.r4qzOfrd5qMFqo8KFnBytyLXyU1QXzkwUgN6', 'Inactivo', '2025-03-05', '2025-03-06', 'Administrador', 'pic-1.png', NULL, 'Medellín', 'Antioquia', 'Colombia', '050001', 'María Gómez', '3205551111', 'Hermano', 'Juan Pérez', '3214442222', '1990-01-01', 'Soltero', 0, NULL, NULL, '2024-10-19', NULL, 0.00, NULL, NULL, NULL, 'activo', 'Sanitas EPS', 'Positiva ARL', 'Porvenir', 'Bancolombia', '1005807007', NULL, 0, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Datos administrativos completados automáticamente.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor_agregado`
--

CREATE TABLE `valor_agregado` (
  `idValorAgregado` int(11) NOT NULL,
  `codigoValorAgregado` varchar(20) NOT NULL,
  `nombreValorAgregado` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precioAgregado` decimal(10,2) NOT NULL,
  `tipoServicioAplica` enum('Internet','Television','Telefonia','Repetidor','Todos') DEFAULT 'Todos',
  `activo` tinyint(1) DEFAULT 1,
  `creado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Catálogo de valores agregados (IP estática, canales premium, etc.)';

--
-- Volcado de datos para la tabla `valor_agregado`
--

INSERT INTO `valor_agregado` (`idValorAgregado`, `codigoValorAgregado`, `nombreValorAgregado`, `descripcion`, `precioAgregado`, `tipoServicioAplica`, `activo`, `creado`) VALUES
(1, 'IP-ESTATICA', 'IP Estática', 'Dirección IP fija dedicada', 15000.00, 'Internet', 1, '2025-10-21 03:23:06'),
(2, 'HBO-MAX', 'HBO Max', 'Streaming HBO Max incluido', 20000.00, 'Television', 1, '2025-10-21 03:23:06'),
(3, 'LARGA-DIST', 'Larga Distancia', 'Llamadas internacionales ilimitadas', 10000.00, 'Telefonia', 1, '2025-10-21 03:23:06'),
(4, 'ROUTER-DUAL', 'Router Doble Banda', 'Router AC dual band', 5000.00, 'Internet', 1, '2025-10-21 03:23:06'),
(5, 'DVR', 'DVR Digital', 'Grabador digital de video', 12000.00, 'Television', 1, '2025-10-21 03:23:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `idVisita` int(10) NOT NULL,
  `tipoVisita` varchar(100) NOT NULL DEFAULT 'Instalacion',
  `motivoVisita` varchar(2000) DEFAULT NULL,
  `diaVisita` date DEFAULT NULL,
  `estadoVisita` varchar(100) DEFAULT 'Activo',
  `visita_idCliente` int(11) DEFAULT NULL,
  `comentario` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`idVisita`, `tipoVisita`, `motivoVisita`, `diaVisita`, `estadoVisita`, `visita_idCliente`, `comentario`) VALUES
(1, 'Instalacion', 'plan feo3434343', '2023-06-25', 'Completado', 11, 'hola mundo'),
(2, 'Instalacion', 'Instalacion de plan', '2023-06-27', 'Archivado', 16, NULL),
(3, 'Reparacion', 'el servicio no esta funcionando porque me la pelan todos', '2023-06-29', 'Completado', 7, 'se arreglo el modem y ya'),
(4, 'Instalacion', 'Otra vez el internet me esta fallando', '2023-06-30', 'Archivado', 7, NULL),
(5, 'Instalacion', 'Nuevo motivo de visita', '2024-02-14', 'Archivado', 7, 'Nuevo comentario'),
(6, 'Instalacion', 'cables dañados', '2024-02-07', 'Archivado', 7, NULL),
(7, 'Instalacion', 'cables dañados', '2024-02-22', 'Completado', 7, NULL),
(8, 'Instalacion', 'plan malo', '2024-03-01', 'Archivado', 6, NULL),
(9, 'Desinstalacion', 'error', '0000-00-00', 'Archivado', 7, NULL),
(10, 'Instalacion', 'nuevoplan que hay que modificar', '2024-03-01', 'Archivado', 6, NULL),
(12, 'Instalacion', '', '2025-03-01', 'Archivado', 14, NULL),
(13, 'Instalacion', 'arreglo', '2025-10-11', 'Activo', 176, NULL),
(14, 'Instalacion', 'nuevo plan instalacion', '2025-10-18', 'Activo', 179, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cliente_equipos`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_cliente_equipos` (
`idCliente` int(11)
,`documentoCliente` varchar(20)
,`nombreCliente` varchar(100)
,`tipoEquipo` enum('Router','ONT','Repetidor','Decodificador','Otro')
,`modeloEquipo` varchar(50)
,`macEquipo` varchar(17)
,`estadoEquipo` enum('Operativo','Dañado','Retirado','Mantenimiento')
,`equipoPropiedad` enum('Cliente','Empresa')
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_cliente_servicios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_cliente_servicios` (
`idCliente` int(11)
,`documentoCliente` varchar(20)
,`nombreCliente` varchar(100)
,`estadoCliente` varchar(10)
,`nombreServicio` varchar(100)
,`valorServicio` decimal(10,2)
,`estadoServicio` enum('Activo','Suspendido','Cancelado')
,`fechaContratacion` date
,`esPrincipal` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_resumen_cliente`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_resumen_cliente` (
`idCliente` int(11)
,`documentoCliente` varchar(20)
,`nombreCliente` varchar(100)
,`estadoCliente` varchar(10)
,`ciudadCliente` varchar(50)
,`barrioCliente` varchar(100)
,`zonaCobertura` varchar(50)
,`total_servicios` bigint(21)
,`total_equipos` bigint(21)
,`total_telefonos` bigint(21)
,`valor_total_servicios` decimal(32,2)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cliente_equipos`
--
DROP TABLE IF EXISTS `vista_cliente_equipos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cliente_equipos`  AS SELECT `c`.`idCliente` AS `idCliente`, `c`.`documentoCliente` AS `documentoCliente`, `c`.`nombreCliente` AS `nombreCliente`, `ce`.`tipoEquipo` AS `tipoEquipo`, `ce`.`modeloEquipo` AS `modeloEquipo`, `ce`.`macEquipo` AS `macEquipo`, `ce`.`estadoEquipo` AS `estadoEquipo`, `ce`.`equipoPropiedad` AS `equipoPropiedad` FROM (`cliente` `c` left join `cliente_equipo` `ce` on(`c`.`idCliente` = `ce`.`cliente_idCliente`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_cliente_servicios`
--
DROP TABLE IF EXISTS `vista_cliente_servicios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_cliente_servicios`  AS SELECT `c`.`idCliente` AS `idCliente`, `c`.`documentoCliente` AS `documentoCliente`, `c`.`nombreCliente` AS `nombreCliente`, `c`.`estadoCliente` AS `estadoCliente`, `s`.`nombreServicio` AS `nombreServicio`, `cs`.`valorServicio` AS `valorServicio`, `cs`.`estadoServicio` AS `estadoServicio`, `cs`.`fechaContratacion` AS `fechaContratacion`, `cs`.`esPrincipal` AS `esPrincipal` FROM ((`cliente` `c` left join `cliente_servicio` `cs` on(`c`.`idCliente` = `cs`.`cliente_idCliente`)) left join `servicio` `s` on(`cs`.`servicio_idServicio` = `s`.`idServicio`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_resumen_cliente`
--
DROP TABLE IF EXISTS `vista_resumen_cliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_resumen_cliente`  AS SELECT `c`.`idCliente` AS `idCliente`, `c`.`documentoCliente` AS `documentoCliente`, `c`.`nombreCliente` AS `nombreCliente`, `c`.`estadoCliente` AS `estadoCliente`, `c`.`ciudadCliente` AS `ciudadCliente`, `c`.`barrioCliente` AS `barrioCliente`, `c`.`zonaCobertura` AS `zonaCobertura`, count(distinct `cs`.`idClienteServicio`) AS `total_servicios`, count(distinct `ce`.`idClienteEquipo`) AS `total_equipos`, count(distinct `ct`.`idTelefono`) AS `total_telefonos`, sum(`cs`.`valorServicio`) AS `valor_total_servicios` FROM (((`cliente` `c` left join `cliente_servicio` `cs` on(`c`.`idCliente` = `cs`.`cliente_idCliente` and `cs`.`estadoServicio` = 'Activo')) left join `cliente_equipo` `ce` on(`c`.`idCliente` = `ce`.`cliente_idCliente` and `ce`.`estadoEquipo` = 'Operativo')) left join `cliente_telefono` `ct` on(`c`.`idCliente` = `ct`.`cliente_idCliente` and `ct`.`activo` = 1)) GROUP BY `c`.`idCliente` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancario`
--
ALTER TABLE `bancario`
  ADD PRIMARY KEY (`id_bancario`),
  ADD KEY `banco_idempresa` (`banco_idempresa`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `documentoCliente` (`documentoCliente`),
  ADD KEY `fk_plan_cliente` (`plan_idPlan`),
  ADD KEY `fk_vendedor_cliente` (`vendedor_idUsuario`),
  ADD KEY `fk_referido_cliente` (`referenciadoPor_idCliente`),
  ADD KEY `fk_creador_cliente` (`creadoPor`),
  ADD KEY `fk_actualizador_cliente` (`actualizadoPor`),
  ADD KEY `idx_sucursal` (`sucursal`),
  ADD KEY `idx_zona` (`zonaCobertura`),
  ADD KEY `idx_tecnico` (`tecnicoAsignado_idUsuario`),
  ADD KEY `idx_ciudad` (`ciudadCliente`),
  ADD KEY `idx_tipo` (`tipoCliente`);

--
-- Indices de la tabla `cliente_equipo`
--
ALTER TABLE `cliente_equipo`
  ADD PRIMARY KEY (`idClienteEquipo`),
  ADD UNIQUE KEY `serialEquipo` (`serialEquipo`),
  ADD KEY `clienteServicio_id` (`clienteServicio_id`),
  ADD KEY `idx_cliente_equipo` (`cliente_idCliente`),
  ADD KEY `idx_tipo_equipo` (`tipoEquipo`),
  ADD KEY `idx_estado_equipo` (`estadoEquipo`),
  ADD KEY `idx_serial_equipo` (`serialEquipo`),
  ADD KEY `idx_mac_equipo` (`macEquipo`);

--
-- Indices de la tabla `cliente_servicio`
--
ALTER TABLE `cliente_servicio`
  ADD PRIMARY KEY (`idClienteServicio`),
  ADD KEY `idx_cliente_serv` (`cliente_idCliente`),
  ADD KEY `idx_servicio` (`servicio_idServicio`),
  ADD KEY `idx_estado_serv` (`estadoServicio`),
  ADD KEY `idx_principal_serv` (`esPrincipal`);

--
-- Indices de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  ADD PRIMARY KEY (`idTelefono`),
  ADD KEY `idx_cliente_tel` (`cliente_idCliente`),
  ADD KEY `idx_principal` (`esPrincipal`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_cliente_factura` (`cliente_idCliente`),
  ADD KEY `fk_factura_plan` (`idPlan`);

--
-- Indices de la tabla `ip_publica`
--
ALTER TABLE `ip_publica`
  ADD PRIMARY KEY (`idIpPublica`),
  ADD KEY `clienteServicio_id` (`clienteServicio_id`),
  ADD KEY `idx_cliente_ip` (`cliente_idCliente`),
  ADD KEY `idx_ip_inicial` (`ipPublicaInicial`),
  ADD KEY `idx_activo_ip` (`activo`);

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
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`idServicio`),
  ADD UNIQUE KEY `codigoServicio` (`codigoServicio`),
  ADD KEY `idx_tipo_servicio` (`tipoServicio`),
  ADD KEY `idx_codigo_servicio` (`codigoServicio`),
  ADD KEY `idx_activo_servicio` (`activo`);

--
-- Indices de la tabla `servicio_valor_agregado`
--
ALTER TABLE `servicio_valor_agregado`
  ADD PRIMARY KEY (`idServicioValorAgregado`),
  ADD KEY `idx_cliente_serv_valor` (`clienteServicio_id`),
  ADD KEY `idx_valor_agregado` (`valorAgregado_id`),
  ADD KEY `idx_activo_serv_valor` (`activo`);

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
  ADD UNIQUE KEY `user_usuario` (`user_usuario`),
  ADD KEY `rol_idRol` (`rol`);

--
-- Indices de la tabla `valor_agregado`
--
ALTER TABLE `valor_agregado`
  ADD PRIMARY KEY (`idValorAgregado`),
  ADD UNIQUE KEY `codigoValorAgregado` (`codigoValorAgregado`),
  ADD KEY `idx_codigo_valor` (`codigoValorAgregado`),
  ADD KEY `idx_tipo_aplica` (`tipoServicioAplica`),
  ADD KEY `idx_activo_valor` (`activo`);

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
-- AUTO_INCREMENT de la tabla `bancario`
--
ALTER TABLE `bancario`
  MODIFY `id_bancario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT de la tabla `cliente_equipo`
--
ALTER TABLE `cliente_equipo`
  MODIFY `idClienteEquipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente_servicio`
--
ALTER TABLE `cliente_servicio`
  MODIFY `idClienteServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  MODIFY `idTelefono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de la tabla `ip_publica`
--
ALTER TABLE `ip_publica`
  MODIFY `idIpPublica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `idPlan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pqr2`
--
ALTER TABLE `pqr2`
  MODIFY `idPqr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `servicio_valor_agregado`
--
ALTER TABLE `servicio_valor_agregado`
  MODIFY `idServicioValorAgregado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `user_visita`
--
ALTER TABLE `user_visita`
  MODIFY `iduser_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `valor_agregado`
--
ALTER TABLE `valor_agregado`
  MODIFY `idValorAgregado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `idVisita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bancario`
--
ALTER TABLE `bancario`
  ADD CONSTRAINT `bancario_ibfk_1` FOREIGN KEY (`banco_idempresa`) REFERENCES `empresa` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_actualizador_cliente` FOREIGN KEY (`actualizadoPor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_creador_cliente` FOREIGN KEY (`creadoPor`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_plan_cliente` FOREIGN KEY (`plan_idPlan`) REFERENCES `plan` (`idPlan`),
  ADD CONSTRAINT `fk_referido_cliente` FOREIGN KEY (`referenciadoPor_idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_tecnico_cliente` FOREIGN KEY (`tecnicoAsignado_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `fk_vendedor_cliente` FOREIGN KEY (`vendedor_idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `cliente_equipo`
--
ALTER TABLE `cliente_equipo`
  ADD CONSTRAINT `cliente_equipo_ibfk_1` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `cliente_equipo_ibfk_2` FOREIGN KEY (`clienteServicio_id`) REFERENCES `cliente_servicio` (`idClienteServicio`) ON DELETE SET NULL;

--
-- Filtros para la tabla `cliente_servicio`
--
ALTER TABLE `cliente_servicio`
  ADD CONSTRAINT `cliente_servicio_ibfk_1` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `cliente_servicio_ibfk_2` FOREIGN KEY (`servicio_idServicio`) REFERENCES `servicio` (`idServicio`);

--
-- Filtros para la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  ADD CONSTRAINT `cliente_telefono_ibfk_1` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_cliente_factura` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_factura_plan` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`idPlan`);

--
-- Filtros para la tabla `ip_publica`
--
ALTER TABLE `ip_publica`
  ADD CONSTRAINT `ip_publica_ibfk_1` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `ip_publica_ibfk_2` FOREIGN KEY (`clienteServicio_id`) REFERENCES `cliente_servicio` (`idClienteServicio`) ON DELETE SET NULL;

--
-- Filtros para la tabla `servicio_valor_agregado`
--
ALTER TABLE `servicio_valor_agregado`
  ADD CONSTRAINT `servicio_valor_agregado_ibfk_1` FOREIGN KEY (`clienteServicio_id`) REFERENCES `cliente_servicio` (`idClienteServicio`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicio_valor_agregado_ibfk_2` FOREIGN KEY (`valorAgregado_id`) REFERENCES `valor_agregado` (`idValorAgregado`);

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
