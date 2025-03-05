/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.27-MariaDB : Database - atory
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`atory` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;

USE `atory`;

/*Table structure for table `bancario` */

DROP TABLE IF EXISTS `bancario`;

CREATE TABLE `bancario` (
  `id_bancario` int(5) NOT NULL AUTO_INCREMENT,
  `num_cuenta` varchar(50) NOT NULL,
  `nomb_banco` varchar(100) NOT NULL,
  `estadoCuenta` varchar(20) NOT NULL DEFAULT 'activo',
  `imagenQR` blob DEFAULT NULL,
  `banco_idempresa` int(11) DEFAULT 1,
  PRIMARY KEY (`id_bancario`),
  KEY `banco_idempresa` (`banco_idempresa`),
  CONSTRAINT `bancario_ibfk_1` FOREIGN KEY (`banco_idempresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `bancario` */

insert  into `bancario`(`id_bancario`,`num_cuenta`,`nomb_banco`,`estadoCuenta`,`imagenQR`,`banco_idempresa`) values (1,'1235345','nequi','Activo',NULL,1),(2,'3196443053','daviplata','Activo',NULL,1),(3,'4534534534','lulo banc','Activo',NULL,1),(4,'365985','Colpatria','Activo',NULL,1);

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`idCliente`),
  UNIQUE KEY `documentoCliente` (`documentoCliente`),
  KEY `fk_plan_cliente` (`plan_idPlan`),
  CONSTRAINT `fk_plan_cliente` FOREIGN KEY (`plan_idPlan`) REFERENCES `plan` (`idPlan`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `cliente` */

insert  into `cliente`(`idCliente`,`tipoDocumento`,`documentoCliente`,`nombreCliente`,`telefonoCliente`,`correoCliente`,`direccion`,`estadoCliente`,`plan_idPlan`,`creado`,`ultimaActualizacion`) values (1,'C.C','1055325484','Arnulfo Rodriguez','3005554878','arnulfo@gmail.com','cll 148 # 98-41','Archivado',1,'2023-05-12','2023-05-17'),(2,'C.C','1030525484','Blanca Cordero','3008562013','blanca@gmail.com','cr 5 #148 -13','Activo',2,'2023-05-18','2023-05-18'),(3,'C.C','1035585487','Carolina Crosby','3122254858','caro@gmail.com','cll 89 sur # 45-48','Activo',2,'2023-05-17','2023-05-17'),(4,'C.C','9587458','Diana Borges','3103404090','diana@gmail.com','cr 2 # 98-74','Activo',2,'2023-05-17','2023-05-17'),(5,'C.C','1025859658','Ernesto Gutierrez','3203103525','ernie@gmail.com','cll 45 # 10-47','Archivado',2,'2023-06-01','2023-06-04'),(6,'C.C','2121','Carlos Schick','300300300','lkaro@gmail.com','cll 5#98-45','Activo',8,'2023-01-02','2023-05-16'),(7,'C.C','123','Mariana Borda','3236587979','Mariana@hotmail.com','cr 23 # 125-66','Activo',3,'2023-03-01','2023-03-02'),(8,'C.C','2365','Ayane Hayabusa','878965412','ayane@hotmail.com','cll 123# 78-41','Activo',4,'2023-01-10','2023-06-07'),(9,'C.E','9863','Isabella Montana','9547893652','isabella@gmail.com','cll 127 # 98-85','Activo',1,'2022-01-04','2023-01-10'),(10,'C.E','58944444','Maria Reyes','3231039856','maria.r@gmail.com','cll 145 # 108-63','Activo',3,'2022-07-08','2023-03-17'),(11,'C.C','698','Yolanda Tellez','3216549898','y.165@aol.com','cll159#10-29','Activo',4,'2023-06-10','2023-06-18'),(12,'C.E','56','Tina Lovecraft','9548961245','tina@gmail.com','cll 36#69-89','Activo',3,'2023-04-05','2023-06-06'),(13,'C.C','1012151563','Gabriela Castiblanco','3103656989','gaby@hotmail.com','km 5 via cota chia','Activo',3,'2023-04-11','2023-05-28'),(14,'C.C','789','Ana Maria Rosales','7893652123','maria@gmail.com','cll 13#140-75','Activo',2,'2023-06-23','2023-06-23'),(15,'C.C','2024','juanito alimaña','300886644','alimana@gmail.com','cll 34 # 20 20','Activo',7,'2024-01-24','2024-01-24'),(16,'C.C','14543','Chun li','1222323','chun@gmail.com','Cl. 123 #67-87','Activo',1,'2024-02-08','2024-02-09'),(17,'C.C','1222233','Jack li','344455545','jack@gmail.com','calle#123  65-87','Activo',5,'2024-02-09','2024-02-10'),(18,'C.C','123123','Xiao Lin','6325698958','lin@gmail.com','cll 148 # 78-98','Activo',3,'2024-02-05','2024-02-09'),(19,'C.C','852852','Xiao Qiao','123456789','Q@hotmail.com','CLL139A#23f-89','Activo',5,'2024-02-12','2024-02-13');

/*Table structure for table `cuentas` */

DROP TABLE IF EXISTS `cuentas`;

CREATE TABLE `cuentas` (
  `idCuentas` int(11) NOT NULL AUTO_INCREMENT,
  `numCuenta` varchar(200) NOT NULL,
  `nomBanco` varchar(500) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Activo',
  `empresa_idEmpresa` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCuentas`),
  KEY `empresa_idEmpresa` (`empresa_idEmpresa`),
  CONSTRAINT `cuentas_ibfk_1` FOREIGN KEY (`empresa_idEmpresa`) REFERENCES `empresa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `cuentas` */

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

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
  `fechaConstitucion` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `empresa` */

insert  into `empresa`(`id`,`logoEmpr`,`rz`,`nombEmpresa`,`nit`,`crc`,`nombrepleg`,`docurepleg`,`dirsede`,`telsede`,`telsede2`,`email`,`paginaWeb`,`fechaConstitucion`) values (1,NULL,'PROVEEDORES DE SERVICIO DE INTERNET','BITS PLAY SAS','989988998-8','12345566','jhon mauris','907654321','Carrera 3b #2349','08052225226','08052225226','schickperez@gmail.co','www.bits.com','2024-01-10');

/*Table structure for table `factura` */

DROP TABLE IF EXISTS `factura`;

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT,
  `fechaFactura` date NOT NULL,
  `impuestoTotal` decimal(10,0) NOT NULL,
  `subTotal` decimal(10,0) NOT NULL,
  `valorTotalFactura` decimal(10,0) NOT NULL,
  `estadoFactura` varchar(20) NOT NULL DEFAULT 'Pendiente',
  `cliente_idCliente` int(11) NOT NULL,
  `fechaVencimiento` date NOT NULL,
  `fechaSuspencion` date NOT NULL,
  `nPlan` varchar(200) NOT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `fk_cliente_factura` (`cliente_idCliente`),
  CONSTRAINT `fk_cliente_factura` FOREIGN KEY (`cliente_idCliente`) REFERENCES `cliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AVG_ROW_LENGTH=45;

/*Data for the table `factura` */

insert  into `factura`(`idFactura`,`fechaFactura`,`impuestoTotal`,`subTotal`,`valorTotalFactura`,`estadoFactura`,`cliente_idCliente`,`fechaVencimiento`,`fechaSuspencion`,`nPlan`) values (1,'2024-03-01',19000,81000,100000,'Pendiente',7,'2024-03-16','2024-03-21','Plan diamante'),(2,'2024-02-03',76000,324000,400000,'Pendiente',6,'2024-02-18','2024-02-23','Plan elite de empresas'),(3,'2024-02-01',9500,40500,50000,'Pendiente',7,'2024-02-16','2024-02-21','Plan economico'),(4,'2024-01-03',66500,283500,175000,'Pago',6,'2024-01-18','2024-01-23','Plan mega'),(5,'2024-01-18',13300,56700,35000,'Pago',14,'2024-02-02','2024-02-07','Plan dorado');

/*Table structure for table `plan` */

DROP TABLE IF EXISTS `plan`;

CREATE TABLE `plan` (
  `idPlan` int(11) NOT NULL AUTO_INCREMENT,
  `codigoPlan` varchar(20) NOT NULL,
  `tipoPlan` varchar(20) DEFAULT NULL,
  `velocidad` varchar(20) NOT NULL,
  `nombrePlan` varchar(250) NOT NULL,
  `precioPlan` decimal(10,0) NOT NULL,
  `desPlan` varchar(2000) DEFAULT NULL,
  `estadoPlan` varchar(10) NOT NULL,
  PRIMARY KEY (`idPlan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `plan` */

insert  into `plan`(`idPlan`,`codigoPlan`,`tipoPlan`,`velocidad`,`nombrePlan`,`precioPlan`,`desPlan`,`estadoPlan`) values (1,'1','rural','20mb','Plan economico',50000,'Plan económico de 20mb para la cuidad adecuada para casa pequeñas','Activo'),(2,'2','urbano','50mb','Plan dorado',70000,'EL plan dorado urbano es mucho mas rapido ideal para una familia completa, con fibra óptica, ofrece excelente velicidad de internet','Activo'),(3,'3','urbano','70mb','Plan diamante',100000,'Plan de alta velocidad para hogares','Activo'),(4,'4','empresarial','120mb','Plan empresa',120000,'Plan Ideal Para empresas pequeñas, por 120000 y de fibra optica puede alcanzar buenas velocidades','Activo'),(5,'5','urbano','5 mb','Plan Basico',50000,'EL plan rural Basico consta de 5 megas de navegación, se hace por medio de radiofrecuencia y es el plan que tiene mayor covertura, recomendado para personas que vivan muy alejadas o en sitios de dificil alcance.','Activo'),(6,'6','empresarial','150 mb','Plan elite empresa',150000,'Plan para empresas grande que requieran excelente velocidades de wifi, viene con fibra óptica','Activo'),(7,'7','urbano','10 mb','Plan dorado',65000,'Plan fibra optica rural, un plan con velocidades de internet más rapidas, para sitio rurales cerca a las cuidades más cercanas, toca validar disponibilidad','Activo'),(8,'8','empresarial','300','Plan elite de empresas',400000,'Plan elite para las empresas mas grandes que necesitan altas velocidades','Activo'),(9,'9','rural','150','Plan mega',350000,'Plan diseñado para las grandes fincas de la region','Activo');

/*Table structure for table `pqr2` */

DROP TABLE IF EXISTS `pqr2`;

CREATE TABLE `pqr2` (
  `idPqr` int(11) NOT NULL AUTO_INCREMENT,
  `tipoDocumento` varchar(10) DEFAULT NULL,
  `nDocumento` varchar(100) DEFAULT NULL,
  `nombresCliente` varchar(200) DEFAULT NULL,
  `telefonoCliente` varchar(20) DEFAULT NULL,
  `emailCliente` varchar(200) DEFAULT NULL,
  `tPqr` varchar(20) DEFAULT NULL,
  `desPqr` varchar(2000) DEFAULT NULL,
  `estadoPqr` varchar(100) DEFAULT 'Activo',
  `comentario` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`idPqr`),
  KEY `idPqr` (`idPqr`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pqr2` */

insert  into `pqr2`(`idPqr`,`tipoDocumento`,`nDocumento`,`nombresCliente`,`telefonoCliente`,`emailCliente`,`tPqr`,`desPqr`,`estadoPqr`,`comentario`) values (1,'C.C','36','Pastelito de fresa','5263695825','pastelito@gmail.com','Sugerencia','Tener mejores dispositivos y fibra óptica','Inactivo',NULL),(2,'C.E','25','Isabella Perez','6254782323','isaa@aol.com','Peticion','Quiero fibra optica en mi casa','Inactivo','No se pudo instalar fibra optica en su hogar porque no hay cobertura'),(3,'C.E','47','fabian schick','3195899457','ff@gmail.com','Peticion','Mejor velocidad en mi servicio','Activo','Modem en camino'),(4,'C.C','12363235','Carlos Rubiano','7859635874','cr56@aol.com','Sugerencia','Que los técnicos sean mas puntuales','Inactivo',NULL),(5,'C.C','1223456','Nicolas Borda','3443456','nico@correo.na','Reclamo','El internet me esta fallando constantemente y necesito un reembolso','Activo',NULL),(6,'C.C','75','Estefania','987563254','cristian.audir8@hotmail.com','Reclamo','Me llego mal el modem de internet','Activo',NULL),(7,'C.C','789','Ana Maria Rosales','7895632525','maria@gmail.com','Reclamo','EL modem de internet no esta trabajando correctamente','Activo','Servicio completado satisfactoriamente'),(8,'cc','1625898','Daniela FLor','3198965656','dd@gmail.com','Peticion','Solicito cables de modem','',''),(9,'C.C','965874','Gabriella Allende','3251456857','ga@hotmail.com','Reclamo','Internet intermitente constante',NULL,NULL),(10,'C.C','965874','Gabriella Allende','3251456857','ga@hotmail.com','Sugerencia','Ser mas rapidos en responder',NULL,NULL),(11,'C.C','1625898','Daniela FLor','3198965656','dd@gmail.com','Sugerencia','Buen servicio',NULL,NULL),(12,'','','2','','','','','',''),(13,'C.C','5656','Isabella Quimaby','3215698989','isabella@gmail.com','Peticion','reuqerimos cables de conexión',NULL,NULL),(14,'C.C','123456','Camilo gil','33333','cami@gmail.com','Peticion','El internet esta algo lento necesto un reembolso','','Resuelto'),(15,'C.C','111111111','Edubin','33333333','edubin@gmail.com','Reclamo','prueba sustentacion','','Resuelto'),(16,'C.C','123456','Camilo gil','33333','cami@gmail.com','Peticion','El internet esta algo lento prueba de estadooooooooo necesto un reembolso','','Resuelto'),(17,'C.C','123456','Daniela FLor','3333333','d@gmail.com','Peticion','dsdfsdf',NULL,NULL),(20,'C.C','789','Juan Torres','3105874596','juan@gmail.com','Reclamo','La factura me llego por mayor valor','Inactivo','mas a validar su solicitud');

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombreProducto` varchar(200) NOT NULL,
  `serialProducto` varchar(45) NOT NULL,
  `descripcionProducto` varchar(250) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `estadoProducto` varchar(20) NOT NULL DEFAULT 'Activo',
  PRIMARY KEY (`idProducto`),
  UNIQUE KEY `serialProducto` (`serialProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `producto` */

insert  into `producto`(`idProducto`,`nombreProducto`,`serialProducto`,`descripcionProducto`,`cantidad`,`estadoProducto`) values (1,'Modem Asus','545784545','Modem Arris velocidad media fibra optica',5,'Activo'),(2,'Modem Mi alta velocidad','55448754','Modem Mii velocidad media',10,'Activo'),(3,'Modem MI','52144452','Modem Asus velocidad alta',10,'Activo'),(4,'Cables fibra optica','32525225','Cables fibra optica',5,'Inactivo'),(5,'Modem arris','5689','Modem Arris de fibra optica para alta velocidad',12,'Activo'),(6,'Cables de fibra optica','5289645s','Cables utilizados para instalaciones fibra óptica',60,'Activo'),(7,'modem Arris','3656','modem fobra optica',30,'Activo');

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(45) NOT NULL,
  `descrpcionRol` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `rol` */

insert  into `rol`(`idRol`,`nombreRol`,`descrpcionRol`) values (1,'Administrativo','Administrativo - puede modificar todo el sistema'),(2,'Tecnico','Soporte tecnico'),(3,'Auxiliar','Acceso limitado al sistema');

/*Table structure for table `solicitudes` */

DROP TABLE IF EXISTS `solicitudes`;

CREATE TABLE `solicitudes` (
  `idSolicitud` int(50) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `estadoSolicitud` varchar(50) DEFAULT 'Activo',
  PRIMARY KEY (`idSolicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `solicitudes` */

insert  into `solicitudes`(`idSolicitud`,`nombres`,`telefono`,`email`,`estadoSolicitud`) values (1,'Estefania Flor','3195852323','este@gmail.com','Atendido'),(2,'Julian Hernandez','3692582365','juli@gmail.com','Atendido'),(3,'Ayane Hayabusa','5893652121','ayane@hotmail.com','Atendido'),(4,'Kasumi Hayabusa','9549638521414','kasumi@gmail.com','Activo'),(5,'Helena Leau','9638525858','helena@yahoo.com','Atendido'),(6,'Fabian Quimbay','3258963254','helena@gmail.com','Activo'),(7,'Ana Maria Rosales','7893652123','maria@gmail.com','Activo'),(8,'Juan Rodriguez','123456','juan@aol.com','Atendido'),(9,'Helena','7859635874','helena@gmail.com','Activo'),(10,'stephy gomez','3198988686','ste@gmail.com','Activo'),(11,'juanito alimaña','300886644','alimana@gmail.com','Atendido'),(12,'Isabella Perez','3216549898','isa.tkm@hotmail.com','Activo');

/*Table structure for table `user_visita` */

DROP TABLE IF EXISTS `user_visita`;

CREATE TABLE `user_visita` (
  `iduser_visita` int(11) NOT NULL AUTO_INCREMENT,
  `visita_idVisita` int(11) DEFAULT NULL,
  `user_idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`iduser_visita`),
  KEY `user_idUser` (`user_idUser`),
  KEY `visita_idVisita` (`visita_idVisita`),
  CONSTRAINT `user_visita_ibfk_1` FOREIGN KEY (`user_idUser`) REFERENCES `usuario` (`idUsuario`),
  CONSTRAINT `user_visita_ibfk_2` FOREIGN KEY (`visita_idVisita`) REFERENCES `visitas` (`idVisita`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `user_visita` */

insert  into `user_visita`(`iduser_visita`,`visita_idVisita`,`user_idUser`) values (1,1,4),(2,2,6),(3,3,7),(4,4,4),(5,5,4),(6,6,7),(7,7,4),(8,8,6),(9,9,4),(10,10,4);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `documentoUsuario` (`documentoUsuario`,`telefonoUsuario`,`correoUsuario`),
  KEY `rol_idRol` (`rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`idUsuario`,`tipoDocumento`,`documentoUsuario`,`nombresUsuario`,`telefonoUsuario`,`correoUsuario`,`claveUsuario`,`estadoUsuario`,`creado`,`ultimaActualizacion`,`rol`) values (1,'C.C','80065421','Karl','3196443053','schickperez@gmail.com','$2y$10$GKR1Uq.gErAPTPRai5BuYuD0u5dovY47eMsQ5qy/VWr8IAzSntxpu','Activo','2023-05-09','2023-05-09','Administrador'),(2,'C.C','1019107974','cris','3017328804','cristian@hotmail.com','$2y$10$H5.gQP65R6mDulyKWFBt/eW.lEjUaKl0QfOaEl/AhSHqh5f0jO7DW','Activo','2023-05-10','2023-05-10','Administrador'),(3,'C.C','1030634046','nico','3006646485','nico@gmail.com','$2y$10$9ruPWqEKJqkmS4KoI1LOTOmfsSi6/lhoTCFL5d4qIVvR8KuD6dxBe','Activo','2023-05-12','2023-05-12','Administrador'),(4,'C.C','1019076993','Fabian','3104552020','fabiancho@aol.com','$2y$10$CPaJUTIN876IeT.hA9wrJOH1gw4FGjgx.4zC5IDrhIy38SQIDUFmu','Activo','2023-05-12','2024-02-10','Tecnico'),(5,'C.C','23568985','Isa','3215698787','isabella@hotmail.com','$2y$10$iAjfCd5Z/aVTZeXxXvNg2u4JAR20fRGwW9ITHK3EGk/eJQxZhGBK6','Activo','2023-11-05','0223-11-05','Tecnico'),(6,'C.C','1234','Danny','3198562323','danny@gmail.com','$2y$10$HpfbwQQfJWeny3jlSpxxM.Qzg9yiKKSSRgENMq9jVf8jTJTp5PgjS','Activo','2023-11-06','0223-11-06','Tecnico'),(7,'C.C','1222233','linlin','344455545','linlin@gmail.com','$2y$10$BWe9ZqyPNScYPikJr/APzuxidw.OnZ/R2jwZeT5vZ.sVkNpv1N332','Activo','2024-02-09','2024-02-10','Tecnico'),(8,'C.C','1234567','pruebausuario','323232','usuario@gmail.com','$2y$10$VJ8OYng.5L1/yahGz17/2.5yMauza9JM2S8zNJraXU19n6LLlArcS','Activo','2024-02-29','2024-03-01','Administrador');

/*Table structure for table `visitas` */

DROP TABLE IF EXISTS `visitas`;

CREATE TABLE `visitas` (
  `idVisita` int(10) NOT NULL AUTO_INCREMENT,
  `tipoVisita` varchar(100) NOT NULL DEFAULT 'Instalacion',
  `motivoVisita` varchar(2000) DEFAULT NULL,
  `diaVisita` date DEFAULT NULL,
  `estadoVisita` varchar(100) DEFAULT 'Activo',
  `visita_idCliente` int(11) DEFAULT NULL,
  `comentario` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`idVisita`),
  KEY `visita_idCliente` (`visita_idCliente`),
  CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`visita_idCliente`) REFERENCES `cliente` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `visitas` */

insert  into `visitas`(`idVisita`,`tipoVisita`,`motivoVisita`,`diaVisita`,`estadoVisita`,`visita_idCliente`,`comentario`) values (1,'Instalacion','plan feo3434343','2023-06-25','Completado',11,'hola mundo'),(2,'Instalacion','Instalacion de plan','2023-06-27','Activo',16,NULL),(3,'Reparacion','el servicio no esta funcionando porque me la pelan todos','2023-06-29','Completado',7,'se arreglo el modem y ya'),(4,'Instalacion','Otra vez el internet me esta fallando','2023-06-30','Archivado',7,NULL),(5,'Instalacion','Nuevo motivo de visita','2024-02-14','Archivado',7,'Nuevo comentario'),(6,'Desinstalacion','cables dañados','2024-02-22','Activo',7,NULL),(7,'Instalacion','cables dañados','2024-02-22','Completado',7,NULL),(8,'Reparacion','plan malo','2024-03-01','Activo',6,NULL),(9,'Instalacion','','0000-00-00','Archivado',7,NULL),(10,'Instalacion','nuevoplan que hay que modificar','2024-03-01','Activo',6,NULL);

/* Procedure structure for procedure `consultaVisita` */

/*!50003 DROP PROCEDURE IF EXISTS  `consultaVisita` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `consultaVisita`(IN id_cliente INT)
BEGIN
	select * from usuario
                      inner join user_visita
                      inner join visitas
                      Inner join cliente
                      where usuario.`idUsuario`=user_visita.`user_idUser`
                      and user_visita.`visita_idVisita`=visitas.`idVisita`
                      and  cliente.`idCliente`=visitas.`visita_idCliente`
                      and documentoCliente=id_cliente;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `GenerarDescuento` */

/*!50003 DROP PROCEDURE IF EXISTS  `GenerarDescuento` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `GenerarDescuento`(IN factura_id INT)
BEGIN
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
END */$$
DELIMITER ;

/* Procedure structure for procedure `verfactura` */

/*!50003 DROP PROCEDURE IF EXISTS  `verfactura` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `verfactura`(IN idFactura INT)
BEGIN
    SELECT fechaFactura FROM factura;
END */$$
DELIMITER ;

/* Procedure structure for procedure `x` */

/*!50003 DROP PROCEDURE IF EXISTS  `x` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `x`()
BEGIN
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
