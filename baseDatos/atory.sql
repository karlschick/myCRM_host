-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-03-2025 a las 07:07:37
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
  `ultimaActualizacion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `tipoDocumento`, `documentoCliente`, `nombreCliente`, `telefonoCliente`, `correoCliente`, `direccion`, `estadoCliente`, `plan_idPlan`, `creado`, `ultimaActualizacion`) VALUES
(1, 'C.C', '1055325484', 'Arnulfo Rodriguez', '3005554878', 'arnulfo@gmail.com', 'cll 148 # 98-41', 'Archivado', 1, '2023-05-12', '2023-05-17'),
(2, 'C.C', '1030525484', 'Blanca Cordero', '3008562013', 'blanca@gmail.com', 'cr 5 #148 -13', 'Activo', 2, '2023-05-18', '2023-05-18'),
(3, 'C.C', '1035585487', 'Carolina Crosby', '3122254858', 'caro@gmail.com', 'cll 89 sur # 45-48', 'Activo', 2, '2023-05-17', '2023-05-17'),
(4, 'C.C', '9587458', 'Diana Borges', '3103404090', 'diana@gmail.com', 'cr 2 # 98-74', 'Activo', 3, '2023-05-17', '2025-03-04'),
(5, 'C.C', '1025859658', 'Ernesto Gutierrez', '3203103525', 'ernie@gmail.com', 'cll 45 # 10-47', 'Archivado', 2, '2023-06-01', '2023-06-04'),
(6, 'C.C', '2121', 'Carlos Schick', '300300300', 'lkaro@gmail.com', 'cll 5#98-45', 'Activo', 8, '2023-01-02', '2023-05-16'),
(7, 'C.C', '123', 'Mariana Borda', '3236587979', 'Mariana@hotmail.com', 'cr 23 # 125-66', 'Activo', 3, '2023-03-01', '2023-03-02'),
(8, 'C.C', '2365', 'Ayane Hayabusa', '878965412', 'ayane@hotmail.com', 'cll 123# 78-41', 'Activo', 4, '2023-01-10', '2023-06-07'),
(9, 'C.E', '9863', 'Isabella Montana', '9547893652', 'isabella@gmail.com', 'cll 127 # 98-85', 'Activo', 1, '2022-01-04', '2023-01-10'),
(10, 'C.E', '58944444', 'Maria Reyes', '3231039856', 'maria.r@gmail.com', 'cll 145 # 108-63', 'Activo', 3, '2022-07-08', '2023-03-17'),
(11, 'C.C', '698', 'Yolanda Tellez', '3216549898', 'y.165@aol.com', 'cll159#10-29', 'Activo', 4, '2023-06-10', '2023-06-18'),
(12, 'C.E', '56', 'Tina Lovecraft', '9548961245', 'tina@gmail.com', 'cll 36#69-89', 'Activo', 3, '2023-04-05', '2023-06-06'),
(13, 'C.C', '1012151563', 'Gabriela Castiblanco', '3103656989', 'gaby@hotmail.com', 'km 5 via cota chia', 'Activo', 3, '2023-04-11', '2023-05-28'),
(14, 'C.C', '789', 'Ana Maria Rosales', '7893652123', 'maria@gmail.com', 'cll 13#140-75', 'Activo', 2, '2023-06-23', '2025-03-04'),
(15, 'C.C', '2024', 'juanito alimaña', '300886644', 'alimana@gmail.com', 'cll 34 # 20 20', 'Activo', 7, '2024-01-24', '2024-01-24'),
(16, 'C.C', '14543', 'Chun li', '1222323', 'chun@gmail.com', 'Cl. 123 #67-87', 'Activo', 1, '2024-02-08', '2024-02-09'),
(17, 'C.C', '1222233', 'Jack li', '344455545', 'jack@gmail.com', 'calle#123  65-87', 'Activo', 5, '2024-02-09', '2024-02-10'),
(18, 'C.C', '123123', 'Xiao Lin', '6325698958', 'lin@gmail.com', 'cll 148 # 78-98', 'Activo', 3, '2024-02-05', '2024-02-09'),
(19, 'C.C', '852852', 'Xiao Qiao', '123456789', 'Q@hotmail.com', 'CLL139A#23f-89', 'Activo', 5, '2024-02-12', '2024-02-13'),
(120, 'C.C', '10000001', 'Andrés López', '300500001', 'andrés@gmail.com', 'Calle 1 # 2-45', 'Activo', 2, '2024-01-02', '2024-02-02'),
(121, 'C.C', '10000002', 'Beatriz Sánchez', '300500002', 'beatriz@gmail.com', 'Calle 2 # 4-45', 'Activo', 3, '2024-01-03', '2024-02-03'),
(122, 'C.C', '10000003', 'Carlos Ramírez', '300500003', 'carlos@gmail.com', 'Calle 3 # 6-45', 'Activo', 4, '2024-01-04', '2024-02-04'),
(123, 'C.C', '10000004', 'Diana Herrera', '300500004', 'diana@gmail.com', 'Calle 4 # 8-45', 'Activo', 5, '2024-01-05', '2024-02-05'),
(124, 'C.C', '10000005', 'Elena Gómez', '300500005', 'elena@gmail.com', 'Calle 5 # 10-45', 'Activo', 1, '2024-01-06', '2024-02-06'),
(125, 'C.C', '10000006', 'Fernando Castro', '300500006', 'fernando@gmail.com', 'Calle 6 # 12-45', 'Activo', 2, '2024-01-07', '2024-02-07'),
(126, 'C.C', '10000007', 'Gabriela Mendoza', '300500007', 'gabriela@gmail.com', 'Calle 7 # 14-45', 'Activo', 3, '2024-01-08', '2024-02-08'),
(127, 'C.C', '10000008', 'Hugo Ortega', '300500008', 'hugo@gmail.com', 'Calle 8 # 16-45', 'Activo', 4, '2024-01-09', '2024-02-09'),
(128, 'C.C', '10000009', 'Isabel Ríos', '300500009', 'isabel@gmail.com', 'Calle 9 # 18-45', 'Activo', 5, '2024-01-10', '2024-02-10'),
(129, 'C.C', '10000010', 'Javier Paredes', '300500010', 'javier@gmail.com', 'Calle 10 # 20-45', 'Activo', 1, '2024-01-11', '2024-02-11'),
(130, 'C.C', '10000011', 'Karina Salazar', '300500011', 'karina@gmail.com', 'Calle 11 # 22-45', 'Activo', 2, '2024-01-12', '2024-02-12'),
(131, 'C.C', '10000012', 'Luis Torres', '300500012', 'luis@gmail.com', 'Calle 12 # 24-45', 'Activo', 3, '2024-01-13', '2024-02-13'),
(132, 'C.C', '10000013', 'María Navarro', '300500013', 'maría@gmail.com', 'Calle 13 # 26-45', 'Activo', 4, '2024-01-14', '2024-02-14'),
(133, 'C.C', '10000014', 'Nicolás Vega', '300500014', 'nicolás@gmail.com', 'Calle 14 # 28-45', 'Activo', 5, '2024-01-15', '2024-02-15'),
(134, 'C.C', '10000015', 'Olga Carrillo', '300500015', 'olga@gmail.com', 'Calle 15 # 30-45', 'Activo', 1, '2024-01-16', '2024-02-16'),
(135, 'C.C', '10000016', 'Pablo Duarte', '300500016', 'pablo@gmail.com', 'Calle 16 # 32-45', 'Activo', 2, '2024-01-17', '2024-02-17'),
(136, 'C.C', '10000017', 'Quintín Lara', '300500017', 'quintín@gmail.com', 'Calle 17 # 34-45', 'Activo', 3, '2024-01-18', '2024-02-18'),
(137, 'C.C', '10000018', 'Rosa Fuentes', '300500018', 'rosa@gmail.com', 'Calle 18 # 36-45', 'Activo', 4, '2024-01-19', '2024-02-19'),
(138, 'C.C', '10000019', 'Sergio Álvarez', '300500019', 'sergio@gmail.com', 'Calle 19 # 38-45', 'Activo', 5, '2024-01-20', '2024-02-20'),
(139, 'C.C', '10000020', 'Teresa Jiménez', '300500020', 'teresa@gmail.com', 'Calle 20 # 40-45', 'Activo', 1, '2024-01-21', '2024-02-21'),
(140, 'C.C', '10000021', 'Ulises Peña', '300500021', 'ulises@gmail.com', 'Calle 21 # 42-45', 'Activo', 2, '2024-01-22', '2024-02-22'),
(141, 'C.C', '10000022', 'Valentina Solano', '300500022', 'valentina@gmail.com', 'Calle 22 # 44-45', 'Activo', 3, '2024-01-23', '2024-02-23'),
(142, 'C.C', '10000023', 'Walter Castillo', '300500023', 'walter@gmail.com', 'Calle 23 # 46-45', 'Activo', 4, '2024-01-24', '2024-02-24'),
(143, 'C.C', '10000024', 'Ximena Espinoza', '300500024', 'ximena@gmail.com', 'Calle 24 # 48-45', 'Activo', 5, '2024-01-25', '2024-02-25'),
(144, 'C.C', '10000025', 'Yahir Montes', '300500025', 'yahir@gmail.com', 'Calle 25 # 50-45', 'Activo', 1, '2024-01-26', '2024-02-26'),
(145, 'C.C', '10000026', 'Zulema Patiño', '300500026', 'zulema@gmail.com', 'Calle 26 # 52-45', 'Activo', 2, '2024-01-27', '2024-02-27'),
(146, 'C.C', '10000027', 'Alfonso Martínez', '300500027', 'alfonso@gmail.com', 'Calle 27 # 54-45', 'Activo', 3, '2024-01-28', '2024-02-28'),
(147, 'C.C', '10000028', 'Brenda Villanueva', '300500028', 'brenda@gmail.com', 'Calle 28 # 56-45', 'Activo', 4, '2024-01-01', '2024-02-01'),
(148, 'C.C', '10000029', 'César Tapia', '300500029', 'césar@gmail.com', 'Calle 29 # 58-45', 'Activo', 5, '2024-01-02', '2024-02-02'),
(149, 'C.C', '10000030', 'Dolores Silva', '300500030', 'dolores@gmail.com', 'Calle 30 # 60-45', 'Activo', 1, '2024-01-03', '2024-02-03'),
(150, 'C.C', '10000031', 'Eduardo Nieto', '300500031', 'eduardo@gmail.com', 'Calle 31 # 62-45', 'Activo', 2, '2024-01-04', '2024-02-04'),
(151, 'C.C', '10000032', 'Fabiola Suárez', '300500032', 'fabiola@gmail.com', 'Calle 32 # 64-45', 'Activo', 3, '2024-01-05', '2024-02-05'),
(152, 'C.C', '10000033', 'Gerardo Domínguez', '300500033', 'gerardo@gmail.com', 'Calle 33 # 66-45', 'Activo', 4, '2024-01-06', '2024-02-06'),
(153, 'C.C', '10000034', 'Hilda Guzmán', '300500034', 'hilda@gmail.com', 'Calle 34 # 68-45', 'Activo', 5, '2024-01-07', '2024-02-07'),
(154, 'C.C', '10000035', 'Iván Estrada', '300500035', 'iván@gmail.com', 'Calle 35 # 70-45', 'Activo', 1, '2024-01-08', '2024-02-08'),
(155, 'C.C', '10000036', 'Jessica Peralta', '300500036', 'jessica@gmail.com', 'Calle 36 # 72-45', 'Activo', 2, '2024-01-09', '2024-02-09'),
(156, 'C.C', '10000037', 'Kevin Flores', '300500037', 'kevin@gmail.com', 'Calle 37 # 74-45', 'Activo', 3, '2024-01-10', '2024-02-10'),
(157, 'C.C', '10000038', 'Laura Chávez', '300500038', 'laura@gmail.com', 'Calle 38 # 76-45', 'Activo', 4, '2024-01-11', '2024-02-11'),
(158, 'C.C', '10000039', 'Miguel Palacios', '300500039', 'miguel@gmail.com', 'Calle 39 # 78-45', 'Activo', 5, '2024-01-12', '2024-02-12'),
(159, 'C.C', '10000040', 'Natalia Ocampo', '300500040', 'natalia@gmail.com', 'Calle 40 # 80-45', 'Activo', 1, '2024-01-13', '2024-02-13'),
(160, 'C.C', '10000041', 'Omar Sandoval', '300500041', 'omar@gmail.com', 'Calle 41 # 82-45', 'Activo', 2, '2024-01-14', '2024-02-14'),
(161, 'C.C', '10000042', 'Patricia Reyes', '300500042', 'patricia@gmail.com', 'Calle 42 # 84-45', 'Activo', 3, '2024-01-15', '2024-02-15'),
(162, 'C.C', '10000043', 'Ricardo Medina', '300500043', 'ricardo@gmail.com', 'Calle 43 # 86-45', 'Activo', 4, '2024-01-16', '2024-02-16'),
(163, 'C.C', '10000044', 'Sofía Cordero', '300500044', 'sofía@gmail.com', 'Calle 44 # 88-45', 'Activo', 5, '2024-01-17', '2024-02-17'),
(164, 'C.C', '10000045', 'Tomás Arrieta', '300500045', 'tomás@gmail.com', 'Calle 45 # 90-45', 'Activo', 1, '2024-01-18', '2024-02-18'),
(165, 'C.C', '10000046', 'Ursula Villaseñor', '300500046', 'ursula@gmail.com', 'Calle 46 # 92-45', 'Activo', 2, '2024-01-19', '2024-02-19'),
(166, 'C.C', '10000047', 'Víctor León', '300500047', 'víctor@gmail.com', 'Calle 47 # 94-45', 'Activo', 3, '2024-01-20', '2024-02-20'),
(167, 'C.C', '10000048', 'Wilfredo Padilla', '300500048', 'wilfredo@gmail.com', 'Calle 48 # 96-45', 'Activo', 4, '2024-01-21', '2024-02-21'),
(168, 'C.C', '10000049', 'Xiomara Nájera', '300500049', 'xiomara@gmail.com', 'Calle 49 # 98-45', 'Activo', 5, '2024-01-22', '2024-02-22'),
(169, 'C.C', '10000050', 'Yolanda Barrera', '300500050', 'yolanda@gmail.com', 'Calle 50 # 100-45', 'Activo', 1, '2024-01-23', '2024-02-23');

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
(1, NULL, 'PROVEEDORES DE SERVICIO DE INTERNET', 'BITS PLAY SAS', '989988998-8', '12345566', 'jhon mauris', '907654321', 'Carrera 3b #2349', '08052225226', '08052225226', 'schickperez@gmail.co', 'www.bits.com', '2024-01-10');

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
  `cliente_idCliente` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `fechaSuspencion` date NOT NULL,
  `nPlan` varchar(200) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=45 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `fechaFactura`, `impuestoTotal`, `subTotal`, `valorTotalFactura`, `estadoFactura`, `cliente_idCliente`, `fechaVencimiento`, `fechaSuspencion`, `nPlan`) VALUES
(1, '2024-03-01', 19000, 81000, 100000, 'Pendiente', 7, '2024-03-16', '2024-03-21', 'Plan diamante'),
(2, '2024-02-03', 76000, 324000, 400000, 'Pendiente', 6, '2024-02-18', '2024-02-23', 'Plan elite de empresas'),
(3, '2024-02-01', 9500, 40500, 50000, 'Pendiente', 7, '2024-02-16', '2024-02-21', 'Plan economico'),
(4, '2024-01-03', 66500, 283500, 175000, 'Pendiente', 6, '2024-01-18', '2024-01-23', 'Plan mega'),
(5, '2024-01-18', 13300, 56700, 35000, 'Pago', 14, '2024-02-02', '2024-02-07', 'Plan dorado'),
(6, '2025-03-05', 13300, 56700, 70000, 'Pendiente', 14, '2025-03-20', '2025-03-25', 'Plan dorado'),
(7, '2025-03-04', 22800, 97200, 120000, 'Pendiente', 8, '2025-03-19', '2025-03-24', 'Plan empresa');

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
(7, '7', 'urbano', '10 mb', 'Plan dorado', 65000, 'Plan fibra optica rural, un plan con velocidades de internet más rapidas, para sitio rurales cerca a las cuidades más cercanas, toca validar disponibilidad', 'Activo'),
(8, '8', 'empresarial', '300', 'Plan elite de empresas', 400000, 'Plan elite para las empresas mas grandes que necesitan altas velocidades', 'Activo'),
(9, '9', 'rural', '150', 'Plan mega', 350000, 'Plan diseñado para las grandes fincas de la region', 'Activo');

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
(12, '', '', '2', '', '', '', '', '', ''),
(13, 'C.C', '5656', 'Isabella Quimaby', '3215698989', 'isabella@gmail.com', 'Peticion', 'reuqerimos cables de conexión', NULL, NULL),
(14, 'C.C', '123456', 'Camilo gil', '33333', 'cami@gmail.com', 'Peticion', 'El internet esta algo lento necesto un reembolso', '', 'Resuelto'),
(15, 'C.C', '111111111', 'Edubin', '33333333', 'edubin@gmail.com', 'Reclamo', 'prueba sustentacion', '', 'Resuelto'),
(16, 'C.C', '123456', 'Camilo gil', '33333', 'cami@gmail.com', 'Peticion', 'El internet esta algo lento prueba de estadooooooooo necesto un reembolso', '', 'Resuelto'),
(17, 'C.C', '123456', 'Daniela FLor', '3333333', 'd@gmail.com', 'Peticion', 'dsdfsdf', NULL, NULL),
(20, 'C.C', '789', 'Juan Torres', '3105874596', 'juan@gmail.com', 'Reclamo', 'La factura me llego por mayor valor', 'Inactivo', 'mas a validar su solicitud'),
(21, '', '', '', '', '', '', '', 'Inactivo', NULL);

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
(7, 'modem Arris', '3656', 'modem fobra optica', 30, 'Activo'),
(8, 'asssa', '433534', 'fgdfgfdgdfg', 4, 'Inactivo');

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
(14, '', '', '', 'Activo');

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
(11, 12, 4);

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
(1, 'C.C', '80065421', 'Karl', '3196443053', 'schickperez@gmail.com', '$2y$12$hd5kGGfwRtVgk1JpCptMP.NFDSLhMQDzcaJ0p9bTp7z6aG.FiUyPW', 'Activo', '2023-05-09', '2023-05-09', 'Administrador'),
(2, 'C.C', '1019107974', 'cris', '3017328804', 'cristian@hotmail.com', '$2y$10$H5.gQP65R6mDulyKWFBt/eW.lEjUaKl0QfOaEl/AhSHqh5f0jO7DW', 'Activo', '2023-05-10', '2023-05-10', 'Administrador'),
(3, 'C.C', '1030634046', 'nico', '3006646485', 'nico@gmail.com', '$2y$10$9ruPWqEKJqkmS4KoI1LOTOmfsSi6/lhoTCFL5d4qIVvR8KuD6dxBe', 'Activo', '2023-05-12', '2023-05-12', 'Administrador'),
(4, 'C.C', '1019076993', 'Fabian', '3104552020', 'fabiancho@aol.com', '$2y$10$CPaJUTIN876IeT.hA9wrJOH1gw4FGjgx.4zC5IDrhIy38SQIDUFmu', 'Activo', '2023-05-12', '2024-02-10', 'Tecnico'),
(5, 'C.C', '23568985', 'Isa', '3215698787', 'isabella@hotmail.com', '$2y$10$iAjfCd5Z/aVTZeXxXvNg2u4JAR20fRGwW9ITHK3EGk/eJQxZhGBK6', 'Inactivo', '2023-11-05', '0223-11-05', 'Tecnico'),
(6, 'C.C', '1234', 'Danny', '3198562323', 'danny@gmail.com', '$2y$10$HpfbwQQfJWeny3jlSpxxM.Qzg9yiKKSSRgENMq9jVf8jTJTp5PgjS', 'Inactivo', '2023-11-06', '0223-11-06', 'Tecnico'),
(7, 'C.C', '1222233', 'linlin', '344455545', 'linlin@gmail.com', '$2y$10$BWe9ZqyPNScYPikJr/APzuxidw.OnZ/R2jwZeT5vZ.sVkNpv1N332', 'Inactivo', '2024-02-09', '2024-02-10', 'Tecnico'),
(8, 'C.C', '1234567', 'pruebausuario', '323232', 'usuario@gmail.com', '$2y$10$VJ8OYng.5L1/yahGz17/2.5yMauza9JM2S8zNJraXU19n6LLlArcS', 'Inactivo', '2024-02-29', '2024-03-01', 'Administrador'),
(9, 'C.C', '258741369', 'pepe', '23456987', 'pepe@gmail.com', '$2y$10$1r8lg5gd6Gvr8AWxAhn9eum1Tq67OncXYSgsNq3H5WZpu.g8yJZmi', 'Activo', '2025-03-04', '2025-03-04', 'Tecnico'),
(10, 'C.C', '1098606020', 'jhon m auris', '3161600007', 'maurice@gmail.com', '$2y$10$3HACpJkRqqI1idu9.r4qzOfrd5qMFqo8KFnBytyLXyU1QXzkwUgN6', 'Activo', '2025-03-05', '2025-03-06', 'Administrador');

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
(2, 'Instalacion', 'Instalacion de plan', '2023-06-27', 'Activo', 16, NULL),
(3, 'Reparacion', 'el servicio no esta funcionando porque me la pelan todos', '2023-06-29', 'Completado', 7, 'se arreglo el modem y ya'),
(4, 'Instalacion', 'Otra vez el internet me esta fallando', '2023-06-30', 'Archivado', 7, NULL),
(5, 'Instalacion', 'Nuevo motivo de visita', '2024-02-14', 'Archivado', 7, 'Nuevo comentario'),
(6, 'Instalacion', 'cables dañados', '2024-02-07', 'Archivado', 7, NULL),
(7, 'Instalacion', 'cables dañados', '2024-02-22', 'Completado', 7, NULL),
(8, 'Instalacion', 'plan malo', '2024-03-01', 'Activo', 6, NULL),
(9, 'Desinstalacion', 'error', '0000-00-00', 'Activo', 7, NULL),
(10, 'Instalacion', 'nuevoplan que hay que modificar', '2024-03-01', 'Activo', 6, NULL),
(12, 'Instalacion', '', '2025-03-01', 'Activo', 14, NULL);

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
-- AUTO_INCREMENT de la tabla `bancario`
--
ALTER TABLE `bancario`
  MODIFY `id_bancario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `plan`
--
ALTER TABLE `plan`
  MODIFY `idPlan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pqr2`
--
ALTER TABLE `pqr2`
  MODIFY `idPqr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `idSolicitud` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `user_visita`
--
ALTER TABLE `user_visita`
  MODIFY `iduser_visita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `idVisita` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
