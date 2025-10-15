-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-10-2025 a las 08:37:01
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
(10, '1002234567', 'Banco de Bogotá', 'Activo', NULL, 1),
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
(27, '1019234567', 'Nequi', 'Activo', NULL, 1),
(28, '1020234567', 'Daviplata', 'Activo', NULL, 1),
(29, '1021234567', 'RappiPay', 'Activo', NULL, 1),
(30, '1022234567', 'Lulo Bank', 'Activo', NULL, 1),
(31, '1023234567', 'Banco Mundo Mujer', 'Activo', NULL, 1),
(32, '1024234567', 'JP Morgan Colombia', 'Activo', NULL, 1),
(33, '1025234567', 'Nu Colombia', 'Activo', NULL, 1);

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
  `ultimaActualizacion` date DEFAULT NULL,
  `meses_gracia` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `tipoDocumento`, `documentoCliente`, `nombreCliente`, `telefonoCliente`, `correoCliente`, `direccion`, `estadoCliente`, `plan_idPlan`, `creado`, `ultimaActualizacion`, `meses_gracia`) VALUES
(1, 'C.C', '10101', 'Arnulfo Rodriguez', '3005554878', 'arnulfo@gmail.com', 'cll 148 # 98-41', 'Activo', 1, '2023-05-12', '2025-10-04', 0),
(2, 'C.C', '10102', 'Blanca Cordero', '3008562013', 'blanca@gmail.com', 'cr 5 #148 -13', 'Archivado', 2, '2023-05-18', '2023-05-18', 0),
(3, 'C.C', '10103', 'Carolina Crosby', '3122254858', 'caro@gmail.com', 'cll 89 sur # 45-48', 'Archivado', 2, '2023-05-17', '2023-05-17', 0),
(4, 'C.C', '10104', 'Diana Borges', '3103404090', 'diana@gmail.com', 'cr 2 # 98-74', 'Activo', 3, '2023-05-17', '2025-10-04', 0),
(5, 'C.C', '10105', 'Ernesto Gutierrez', '3203103525', 'ernie@gmail.com', 'cll 45 # 10-47', 'Activo', 2, '2023-06-01', '2025-10-04', 0),
(6, 'C.C', '2121', 'Carlos Schick', '300300300', 'lkaro@gmail.com', 'cll 5#98-45', 'Activo', 1, '2023-01-02', '2023-05-16', 0),
(7, 'C.C', '123', 'Mariana Borda', '3236587979', 'Mariana@hotmail.com', 'cr 23 # 125-66', 'Activo', 3, '2023-03-01', '2025-10-07', 0),
(8, 'C.C', '2365', 'Ayane Hayabusa', '878965412', 'ayane@hotmail.com', 'cll 123# 78-41', 'Activo', 4, '2023-01-10', '2025-10-04', 0),
(9, 'C.E', '9863', 'Isabella Montana', '9547893652', 'isabella@gmail.com', 'cll 127 # 98-85', 'Activo', 1, '2022-01-04', '2025-10-04', 0),
(10, 'C.E', '58944444', 'Maria Reyes', '3231039856', 'maria.r@gmail.com', 'cll 145 # 108-63', 'Activo', 3, '2022-07-08', '2025-01-01', 3),
(11, 'C.C', '698', 'Yolanda Tellez', '3216549898', 'y.165@aol.com', 'cll159#10-29', 'Archivado', 4, '2023-06-10', '2023-06-18', 0),
(12, 'C.E', '56', 'Tina Lovecraft', '9548961245', 'tina@gmail.com', 'cll 36#69-89', 'Archivado', 3, '2023-04-05', '2023-06-06', 0),
(13, 'C.C', '1012151563', 'Gabriela Castiblanco', '3103656989', 'gaby@hotmail.com', 'km 5 via cota chia', 'Activo', 3, '2023-04-11', '2025-10-04', 0),
(14, 'C.C', '789', 'Ana Maria Rosales', '7893652123', 'maria@gmail.com', 'cll 13#140-75', 'Activo', 1, '2023-06-23', '2025-03-04', 0),
(15, 'C.C', '2024', 'juanito alimaña', '300886644', 'alimana@gmail.com', 'cll 34 # 20 20', 'Activo', 7, '2024-01-24', '2025-10-04', 0),
(16, 'C.C', '14543', 'Chun li', '1222323', 'chun@gmail.com', 'Cl. 123 #67-87', 'Activo', 1, '2024-02-08', '2025-10-04', 0),
(17, 'C.C', '1222233', 'Jack li', '344455545', 'jack@gmail.com', 'calle#123  65-87', 'Activo', 5, '2024-02-09', '2025-10-04', 0),
(18, 'C.C', '123123', 'Xiao Lin', '6325698958', 'lin@gmail.com', 'cll 148 # 78-98', 'Archivado', 3, '2024-02-05', '2024-02-09', 0),
(19, 'C.C', '852852', 'Xiao Qiao', '123456789', 'Q@hotmail.com', 'CLL139A#23f-89', 'Archivado', 5, '2024-02-12', '2024-02-13', 0),
(20, 'C.C', '10000001', 'Andrés López', '300500001', 'andrés@gmail.com', 'Calle 1 # 2-45', 'Archivado', 2, '2024-01-02', '2024-02-02', 0),
(121, 'C.C', '10000002', 'Beatriz Sánchez', '300500002', 'beatriz@gmail.com', 'Calle 2 # 4-45', 'Activo', 3, '2024-01-03', '2025-10-04', 0),
(122, 'C.C', '10000003', 'Carlos Ramírez', '300500003', 'carlos@gmail.com', 'Calle 3 # 6-45', 'Archivado', 4, '2024-01-04', '2024-02-04', 0),
(123, 'C.C', '10000004', 'Diana Herrera', '300500004', 'diana@gmail.com', 'Calle 4 # 8-45', 'Activo', 5, '2024-01-05', '2025-10-04', 0),
(124, 'C.C', '10000005', 'Elena Gómez', '300500005', 'elena@gmail.com', 'Calle 5 # 10-45', 'Activo', 1, '2024-01-06', '2025-10-04', 0),
(125, 'C.C', '10000006', 'Fernando Castro', '300500006', 'fernando@gmail.com', 'Calle 6 # 12-45', 'Activo', 2, '2024-01-07', '2025-08-04', 0),
(126, 'C.C', '10000007', 'Gabriela Mendoza', '300500007', 'gabriela@gmail.com', 'Calle 7 # 14-45', 'Activo', 3, '2024-01-08', '2025-10-04', 0),
(127, 'C.C', '10000008', 'Hugo Ortega', '300500008', 'hugo@gmail.com', 'Calle 8 # 16-45', 'Activo', 4, '2024-01-09', '2025-10-04', 1),
(128, 'C.C', '10000009', 'Isabel Ríos', '300500009', 'isabel@gmail.com', 'Calle 9 # 18-45', 'Activo', 5, '2024-01-10', '2025-10-04', 0),
(129, 'C.C', '10000010', 'Javier Paredes', '300500010', 'javier@gmail.com', 'Calle 10 # 20-45', 'Activo', 1, '2024-01-11', '2025-10-04', 0),
(130, 'C.C', '10000011', 'Karina Salazar', '300500011', 'karina@gmail.com', 'Calle 11 # 22-45', 'Activo', 4, '2024-01-12', '2025-10-04', 0),
(131, 'C.C', '10000012', 'Luis Torres', '300500012', 'luis@gmail.com', 'Calle 12 # 24-45', 'Archivado', 3, '2024-01-13', '2024-02-13', 0),
(132, 'C.C', '10000013', 'María Navarro', '300500013', 'maría@gmail.com', 'Calle 13 # 26-45', 'Archivado', 4, '2024-01-14', '2024-02-14', 0),
(133, 'C.C', '10000014', 'Nicolás Vega', '300500014', 'nicolás@gmail.com', 'Calle 14 # 28-45', 'Archivado', 5, '2024-01-15', '2024-02-15', 0),
(134, 'C.C', '10000015', 'Olga Carrillo', '300500015', 'olga@gmail.com', 'Calle 15 # 30-45', 'Archivado', 1, '2024-01-16', '2024-02-16', 0),
(135, 'C.C', '10000016', 'Pablo Duarte', '300500016', 'pablo@gmail.com', 'Calle 16 # 32-45', 'Archivado', 2, '2024-01-17', '2024-02-17', 0),
(136, 'C.C', '10000017', 'Quintín Lara', '300500017', 'quintín@gmail.com', 'Calle 17 # 34-45', 'Archivado', 3, '2024-01-18', '2024-02-18', 0),
(137, 'C.C', '10000018', 'Rosa Fuentes', '300500018', 'rosa@gmail.com', 'Calle 18 # 36-45', 'Archivado', 4, '2024-01-19', '2024-02-19', 0),
(138, 'C.C', '10000019', 'Sergio Álvarez', '300500019', 'sergio@gmail.com', 'Calle 19 # 38-45', 'Archivado', 5, '2024-01-20', '2024-02-20', 0),
(139, 'C.C', '10000020', 'Teresa Jiménez', '300500020', 'teresa@gmail.com', 'Calle 20 # 40-45', 'Archivado', 1, '2024-01-21', '2024-02-21', 0),
(140, 'C.C', '10000021', 'Ulises Peña', '300500021', 'ulises@gmail.com', 'Calle 21 # 42-45', 'Archivado', 2, '2024-01-22', '2024-02-22', 0),
(141, 'C.C', '10000022', 'Valentina Solano', '300500022', 'valentina@gmail.com', 'Calle 22 # 44-45', 'Archivado', 3, '2024-01-23', '2024-02-23', 0),
(142, 'C.C', '10000023', 'Walter Castillo', '300500023', 'walter@gmail.com', 'Calle 23 # 46-45', 'Archivado', 4, '2024-01-24', '2024-02-24', 0),
(143, 'C.C', '10000024', 'Ximena Espinoza', '300500024', 'ximena@gmail.com', 'Calle 24 # 48-45', 'Archivado', 5, '2024-01-25', '2024-02-25', 0),
(144, 'C.C', '10000025', 'Yahir Montes', '300500025', 'yahir@gmail.com', 'Calle 25 # 50-45', 'Archivado', 1, '2024-01-26', '2024-02-26', 0),
(145, 'C.C', '10000026', 'Zulema Patiño', '300500026', 'zulema@gmail.com', 'Calle 26 # 52-45', 'Activo', 2, '2024-01-27', '2025-10-04', 0),
(146, 'C.C', '10000027', 'Alfonso Martínez', '300500027', 'alfonso@gmail.com', 'Calle 27 # 54-45', 'Activo', 2, '2024-01-28', '2025-10-04', 0),
(147, 'C.C', '10000028', 'Brenda Villanueva', '300500028', 'brenda@gmail.com', 'Calle 28 # 56-45', 'Activo', 4, '2024-01-01', '2025-10-04', 0),
(148, 'C.C', '10000029', 'Cesar Tapia', '300500029', 'cesar@gmail.com', 'Calle 29 # 58-45', 'Activo', 5, '2024-01-02', '2025-10-04', 0),
(149, 'C.C', '10000030', 'Dolores Silva', '300500030', 'dolores@gmail.com', 'Calle 30 # 60-45', 'Activo', 1, '2024-01-03', '2025-10-04', 0),
(150, 'C.C', '10000031', 'Eduardo Nieto', '300500031', 'eduardo@gmail.com', 'Calle 31 # 62-45', 'Activo', 2, '2024-01-04', '2025-10-04', 0),
(151, 'C.C', '10000032', 'Fabiola Suárez', '300500032', 'fabiola@gmail.com', 'Calle 32 # 64-45', 'Activo', 3, '2024-01-05', '2025-10-04', 0),
(152, 'C.C', '10000033', 'Gerardo Domínguez', '300500033', 'gerardo@gmail.com', 'Calle 33 # 66-45', 'Activo', 4, '2024-01-06', '2025-10-04', 0),
(153, 'C.C', '10000034', 'Hilda Guzmán', '300500034', 'hilda@gmail.com', 'Calle 34 # 68-45', 'Activo', 5, '2024-01-07', '2025-10-04', 0),
(154, 'C.C', '10000035', 'Iván Estrada', '300500035', 'iván@gmail.com', 'Calle 35 # 70-45', 'Activo', 1, '2024-01-08', '2025-10-04', 0),
(155, 'C.C', '10000036', 'Jessica Peralta', '300500036', 'jessica@gmail.com', 'Calle 36 # 72-45', 'Activo', 2, '2024-01-09', '2025-10-04', 0),
(156, 'C.C', '10000037', 'Kevin Flores', '300500037', 'kevin@gmail.com', 'Calle 37 # 74-45', 'Activo', 3, '2024-01-10', '2025-10-04', 0),
(157, 'C.C', '10000038', 'Laura Chávez', '300500038', 'laura@gmail.com', 'Calle 38 # 76-45', 'Archivado', 4, '2024-01-11', '2024-02-11', 0),
(158, 'C.C', '10000039', 'Miguel Palacios', '300500039', 'miguel@gmail.com', 'Calle 39 # 78-45', 'Archivado', 5, '2024-01-12', '2024-02-12', 0),
(159, 'C.C', '10000040', 'Natalia Ocampo', '300500040', 'natalia@gmail.com', 'Calle 40 # 80-45', 'Archivado', 1, '2024-01-13', '2024-02-13', 0),
(160, 'C.C', '10000041', 'Omar Sandoval', '300500041', 'omar@gmail.com', 'Calle 41 # 82-45', 'Archivado', 2, '2024-01-14', '2024-02-14', 0),
(161, 'C.C', '10000042', 'Patricia Reyes', '300500042', 'patricia@gmail.com', 'Calle 42 # 84-45', 'Archivado', 3, '2024-01-15', '2024-02-15', 0),
(162, 'C.C', '10000043', 'Ricardo Medina', '300500043', 'ricardo@gmail.com', 'Calle 43 # 86-45', 'Archivado', 4, '2024-01-16', '2024-02-16', 0),
(163, 'C.C', '10000044', 'Sofía Cordero', '300500044', 'sofía@gmail.com', 'Calle 44 # 88-45', 'Archivado', 5, '2024-01-17', '2024-02-17', 0),
(164, 'C.C', '10000045', 'Tomás Arrieta', '300500045', 'tomás@gmail.com', 'Calle 45 # 90-45', 'Archivado', 1, '2024-01-18', '2024-02-18', 0),
(165, 'C.C', '10000046', 'Ursula Villaseñor', '300500046', 'ursula@gmail.com', 'Calle 46 # 92-45', 'Archivado', 2, '2024-01-19', '2024-02-19', 0),
(166, 'C.C', '10000047', 'Víctor León', '300500047', 'víctor@gmail.com', 'Calle 47 # 94-45', 'Archivado', 3, '2024-01-20', '2024-02-20', 0),
(167, 'C.C', '10000048', 'Wilfredo Padilla', '300500048', 'wilfredo@gmail.com', 'Calle 48 # 96-45', 'Archivado', 4, '2024-01-21', '2024-02-21', 0),
(168, 'C.C', '10000049', 'Xiomara Nájera', '300500049', 'xiomara@gmail.com', 'Calle 49 # 98-45', 'Archivado', 5, '2024-01-22', '2024-02-22', 0),
(169, 'C.C', '10000050', 'Yolanda Barrera', '300500050', 'yolanda@gmail.com', 'Calle 50 # 100-45', 'Archivado', 1, '2024-01-23', '2024-02-23', 0),
(170, 'C.C', '101010', 'joan schick', '3123828822', 'joan@gmail.com', 'cr 3b No. 23 - 49', 'Archivado', 5, '2025-09-12', '2025-10-06', 0),
(174, 'C.C', '4040', 'joan3', '31964354', 'schickperez@gmail.com', 'Carrera 3b #23-49', 'Activo', 3, '2025-08-01', '2025-10-06', 3),
(175, 'C.C', '5050', 'joan4', '3123828822', 'schickperez@gmail.com', 'cr 3b No. 23 - 49', 'Activo', 1, '2025-10-07', '2025-10-07', 3),
(176, 'C.C', '6060', 'joan5', '3196443053', 'schickperez@gmail.com', 'Carrera 3b #23-49', 'Activo', 1, '2023-09-07', '2025-10-07', 0),
(177, 'C.C', '10099020', 'pedro pascal', '', '', '', 'Activo', 4, '2025-10-15', '2025-10-15', 0),
(178, 'C.C', '544854', 'polo polo', '23423423423', 'polopolo@gmail.com', 'Carrera 34 #34-3', 'Activo', 8, '2025-10-02', '2025-10-02', 2);

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
(161, '2025-11-01', 0, 0, 10000, 'Pendiente', 175, 1, '2025-11-06', '2025-11-11', 0);

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
(9, '9', 'rural', '45mb', 'Plan mega', 90000, 'Plan diseñado para las grandes fincas de la region', 'Activo');

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
(22, 'C.C', '999999', 'pedro manuel jimenez', '319644454', 'pedroz@gmail.com', 'Reclamo', 'servi malo', 'Activo', 'ok'),
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
(12, 13, 4);

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
  `rol` varchar(100) NOT NULL,
  `fotoUsuario` varchar(255) DEFAULT 'pic-1.png',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `tipoDocumento`, `documentoUsuario`, `nombresUsuario`, `telefonoUsuario`, `correoUsuario`, `claveUsuario`, `estadoUsuario`, `creado`, `ultimaActualizacion`, `rol`, `fotoUsuario`, `foto`) VALUES
(1, 'C.C', '80065421', 'Karl', '3196443053', 'schickperez@gmail.com', '$2y$10$GYWI1fTwkRejXRABD9WAIu5n5ZdNfQLn6eKaf3uMtroQ559ToOEaO', 'Activo', '2023-05-09', '2023-05-09', 'Administrador', 'pic-1.png', 'user_68edc1aeaa3c7.jpg'),
(2, 'C.C', '1019107974', 'cris', '3017328804', 'cristian@hotmail.com', '$2y$10$H5.gQP65R6mDulyKWFBt/eW.lEjUaKl0QfOaEl/AhSHqh5f0jO7DW', 'Activo', '2023-05-10', '2023-05-10', 'Administrador', 'pic-1.png', 'user_68edc1d8b5716.jpg'),
(3, 'C.C', '1030634046', 'nico', '3006646485', 'nico@gmail.com', '$2y$10$9ruPWqEKJqkmS4KoI1LOTOmfsSi6/lhoTCFL5d4qIVvR8KuD6dxBe', 'Inactivo', '2023-05-12', '2023-05-12', 'Administrador', 'pic-1.png', NULL),
(4, 'C.C', '1019076993', 'Fabian', '3104552020', 'fabiancho@aol.com', '$2y$10$9Usf542i.A/yN7k8e4X.ze/bWor5SgAlrvLDA1PMbuHhIBz9pJK5.', 'Activo', '2023-05-12', '2024-02-10', 'Tecnico', 'pic-1.png', 'user_68edc6dff2c93.jpg'),
(6, 'C.C', '1234', 'Danny1', '3198562333', 'danny@gmail.com', '$2y$10$6jFt.U/ukhOzHUfE1Esg6OB.SWDRbohkxX2SoFhobqXgpcDQ0tdj6', 'Activo', '2023-11-06', '2025-10-13', 'Administrador', 'pic-1.png', NULL),
(7, 'C.C', '1222233', 'linlin', '344455545', 'linlin@gmail.com', '$2y$10$BWe9ZqyPNScYPikJr/APzuxidw.OnZ/R2jwZeT5vZ.sVkNpv1N332', 'Inactivo', '2024-02-09', '2024-02-10', 'Tecnico', 'pic-1.png', NULL),
(8, 'C.C', '1234567', 'pruebausuario', '323232', 'usuario@gmail.com', '$2y$10$VJ8OYng.5L1/yahGz17/2.5yMauza9JM2S8zNJraXU19n6LLlArcS', 'Inactivo', '2024-02-29', '2024-03-01', 'Administrador', 'pic-1.png', NULL),
(9, 'C.C', '258741369', 'pepe', '23456987', 'pepe@gmail.com', '$2y$10$1r8lg5gd6Gvr8AWxAhn9eum1Tq67OncXYSgsNq3H5WZpu.g8yJZmi', 'Inactivo', '2025-03-04', '2025-03-04', 'Tecnico', 'pic-1.png', NULL),
(10, 'C.C', '1098606020', 'jhon m auris', '3161600007', 'maurice@gmail.com', '$2y$10$3HACpJkRqqI1idu9.r4qzOfrd5qMFqo8KFnBytyLXyU1QXzkwUgN6', 'Inactivo', '2025-03-05', '2025-03-06', 'Administrador', 'pic-1.png', NULL),
(12, 'C.C', '100100', 'admon', '', '', '$2y$10$t1VWnXJ/er.iM2lSvOjNyukZm.H3oTAPMLt0iZgFWH.G4GkzKS.qu', 'Activo', '2025-10-04', '2025-10-04', 'Administrador', 'pic-1.png', 'user_68edc186dc10b.jpg');

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
(13, 'Instalacion', 'arreglo', '2025-10-11', 'Activo', 176, NULL);

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
  ADD KEY `fk_plan_cliente` (`plan_idPlan`);

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
-- AUTO_INCREMENT de la tabla `bancario`
--
ALTER TABLE `bancario`
  MODIFY `id_bancario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

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
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `user_visita`
--
ALTER TABLE `user_visita`
  MODIFY `iduser_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `idVisita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  ADD CONSTRAINT `fk_plan_cliente` FOREIGN KEY (`plan_idPlan`) REFERENCES `plan` (`idPlan`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_cliente_factura` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`),
  ADD CONSTRAINT `fk_factura_plan` FOREIGN KEY (`idPlan`) REFERENCES `plan` (`idPlan`);

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
