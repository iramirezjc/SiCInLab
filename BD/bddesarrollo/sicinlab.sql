-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: lab
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categ`
--

DROP TABLE IF EXISTS `categ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categ` (
  `id_categ` int NOT NULL AUTO_INCREMENT,
  `nombr` varchar(10) NOT NULL,
  PRIMARY KEY (`id_categ`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categ`
--

LOCK TABLES `categ` WRITE;
/*!40000 ALTER TABLE `categ` DISABLE KEYS */;
INSERT INTO `categ` VALUES (1,'Equipos'),(2,'Materiales'),(3,'Mobiliario'),(4,'Reactivos');
/*!40000 ALTER TABLE `categ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compr`
--

DROP TABLE IF EXISTS `compr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compr` (
  `id_compr` int NOT NULL AUTO_INCREMENT,
  `fk_usuar_matri` int NOT NULL,
  `fecha` date NOT NULL,
  `vendr` varchar(45) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_compr`),
  KEY `fk_compr_usuar1_idx` (`fk_usuar_matri`),
  CONSTRAINT `fk_compr_usuar1` FOREIGN KEY (`fk_usuar_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compr`
--

LOCK TABLES `compr` WRITE;
/*!40000 ALTER TABLE `compr` DISABLE KEYS */;
INSERT INTO `compr` VALUES (2,5681,'2019-10-25','office',200.00),(3,5681,'2019-10-25','office',200.00),(4,5681,'2019-10-25','Laboteca',350.00),(5,5681,'2019-10-25','Laboteca',200.00),(6,5681,'2019-10-25','Laboteca',45.00),(7,5681,'2019-11-04','Laboteca',300.00),(8,5681,'2019-10-26','Laboteca',500.00),(14,5681,'2019-11-06','Laboteca',500.00),(15,5681,'2019-11-26','Laboteca',500.00),(16,5681,'2019-12-26','Laboteca',500.00),(17,5601,'2025-06-11','laboteca',500.00);
/*!40000 ALTER TABLE `compr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `desgl_inven`
--

DROP TABLE IF EXISTS `desgl_inven`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `desgl_inven` (
  `id_desgl_inven` int NOT NULL AUTO_INCREMENT,
  `canti_siste` int NOT NULL,
  `canti_exist` int NOT NULL,
  `fk_categ` int NOT NULL,
  `fk_objeto_id` int NOT NULL,
  `fk_inven` int NOT NULL,
  PRIMARY KEY (`id_desgl_inven`),
  KEY `fk_desgl_inven_categ1_idx` (`fk_categ`),
  KEY `fk_desgl_inven_inven1_idx` (`fk_inven`),
  CONSTRAINT `fk_desgl_inven_categ1` FOREIGN KEY (`fk_categ`) REFERENCES `categ` (`id_categ`),
  CONSTRAINT `fk_desgl_inven_inven1` FOREIGN KEY (`fk_inven`) REFERENCES `inven` (`id_inven`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `desgl_inven`
--

LOCK TABLES `desgl_inven` WRITE;
/*!40000 ALTER TABLE `desgl_inven` DISABLE KEYS */;
INSERT INTO `desgl_inven` VALUES (1,75,10,4,1,1),(2,75,3,4,1,2),(3,7,5,1,1,2),(4,20,6,3,23,2),(5,27,8,2,7,2),(6,3,1,1,1,2),(13,3,3,1,1,4),(14,30,30,1,10,4),(15,364,364,1,11,4),(16,25,25,1,12,4),(17,20,20,1,13,4),(18,20,20,1,15,4),(19,20,20,1,16,4),(20,15,15,1,17,4),(21,20,20,1,19,4),(22,20,20,1,20,4),(23,20,20,1,21,4),(24,20,20,1,22,4),(25,20,20,1,23,4),(26,20,20,1,24,4),(27,20,20,1,25,4),(28,65,64,1,26,4),(29,10,10,1,28,4),(30,4,4,1,46,4),(31,15,15,2,1,4),(32,33,33,2,7,4),(33,18,18,2,8,4),(34,33,33,2,9,4),(35,9,9,2,10,4),(36,10,10,2,11,4),(37,2,2,2,12,4),(38,3,3,2,14,4),(39,2,2,3,10,4),(40,1,1,3,11,4),(41,20,20,3,12,4),(42,20,20,3,13,4),(43,3,3,3,14,4),(44,6,6,3,15,4),(45,3,3,3,16,4),(46,3,3,3,17,4),(47,2,2,3,18,4),(48,2,2,3,19,4),(49,1,1,3,20,4),(50,2,2,3,21,4),(51,20,20,3,22,4),(52,20,20,3,23,4),(53,3,3,3,24,4),(54,6,6,3,25,4),(55,3,3,3,26,4),(56,2,2,3,27,4),(57,2,2,3,28,4),(58,2,2,3,29,4),(59,2,2,3,30,4),(60,10,10,3,31,4),(61,0,0,3,33,4),(62,149,149,4,4,4),(63,313,313,4,6,4),(64,2850,2850,4,7,4),(65,1685,1685,4,8,4),(66,1500,1500,4,10,4),(67,500,500,4,11,4),(68,3,3,4,12,4),(69,2,2,4,13,4),(70,600,600,4,5,4),(71,55,55,4,1,4),(72,1840,1840,4,9,4),(73,500,500,4,2,4),(74,288,288,4,3,4);
/*!40000 ALTER TABLE `desgl_inven` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detall_compr`
--

DROP TABLE IF EXISTS `detall_compr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detall_compr` (
  `id_detall_compr` int NOT NULL AUTO_INCREMENT,
  `cant` int NOT NULL,
  `fk_compr` int NOT NULL,
  `fk_categ` int NOT NULL,
  `fk_objeto_id` int NOT NULL,
  PRIMARY KEY (`id_detall_compr`),
  KEY `fk_detall_compr_compr1_idx` (`fk_compr`),
  KEY `fk_detall_compr_categ1_idx` (`fk_categ`),
  CONSTRAINT `fk_detall_compr_categ1` FOREIGN KEY (`fk_categ`) REFERENCES `categ` (`id_categ`),
  CONSTRAINT `fk_detall_compr_compr1` FOREIGN KEY (`fk_compr`) REFERENCES `compr` (`id_compr`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detall_compr`
--

LOCK TABLES `detall_compr` WRITE;
/*!40000 ALTER TABLE `detall_compr` DISABLE KEYS */;
INSERT INTO `detall_compr` VALUES (2,2,2,1,1),(3,1,3,1,1),(4,10,4,1,12),(5,7,4,2,9),(6,2,5,3,30),(7,50,7,1,26),(8,3,16,1,12),(9,2,17,1,10),(10,1,17,3,17),(11,150,17,4,4);
/*!40000 ALTER TABLE `detall_compr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detall_devol`
--

DROP TABLE IF EXISTS `detall_devol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detall_devol` (
  `id_detall_devol` int NOT NULL AUTO_INCREMENT,
  `fk_devol` int NOT NULL,
  `fk_categ` int NOT NULL,
  `fk_objeto_id` int NOT NULL,
  `cant` int NOT NULL,
  PRIMARY KEY (`id_detall_devol`),
  KEY `fk_detall_devol_devol1_idx` (`fk_devol`),
  KEY `fk_detall_devol_categ1_idx` (`fk_categ`),
  CONSTRAINT `fk_detall_devol_categ1` FOREIGN KEY (`fk_categ`) REFERENCES `categ` (`id_categ`),
  CONSTRAINT `fk_detall_devol_devol1` FOREIGN KEY (`fk_devol`) REFERENCES `devol` (`id_devol`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detall_devol`
--

LOCK TABLES `detall_devol` WRITE;
/*!40000 ALTER TABLE `detall_devol` DISABLE KEYS */;
INSERT INTO `detall_devol` VALUES (1,1,1,1,3),(2,2,2,1,5),(3,3,1,1,1),(4,1,1,1,1),(5,1,1,1,1),(6,1,1,1,1),(8,3,1,12,2),(9,3,2,1,2);
/*!40000 ALTER TABLE `detall_devol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detall_prest`
--

DROP TABLE IF EXISTS `detall_prest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detall_prest` (
  `id_detall_prest` int NOT NULL AUTO_INCREMENT,
  `fk_prest` int NOT NULL,
  `fk_categ` int NOT NULL,
  `fk_objeto_id` int NOT NULL,
  `cant` int NOT NULL,
  PRIMARY KEY (`id_detall_prest`),
  KEY `fk_detall_prest_prest1_idx` (`fk_prest`),
  KEY `fk_detall_prest_categ1_idx` (`fk_categ`),
  CONSTRAINT `fk_detall_prest_categ1` FOREIGN KEY (`fk_categ`) REFERENCES `categ` (`id_categ`),
  CONSTRAINT `fk_detall_prest_prest1` FOREIGN KEY (`fk_prest`) REFERENCES `prest` (`id_prest`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detall_prest`
--

LOCK TABLES `detall_prest` WRITE;
/*!40000 ALTER TABLE `detall_prest` DISABLE KEYS */;
INSERT INTO `detall_prest` VALUES (1,1,1,1,0),(2,2,2,1,0),(3,3,1,1,0),(4,3,1,12,10),(5,3,2,1,6),(6,5,1,1,0),(7,5,2,1,0),(8,5,3,11,1),(9,6,1,1,2),(11,6,1,10,3),(12,6,2,10,2),(13,6,3,13,4),(14,7,2,7,3);
/*!40000 ALTER TABLE `detall_prest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detall_prest_consu`
--

DROP TABLE IF EXISTS `detall_prest_consu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detall_prest_consu` (
  `id_detall_prest_consu` int NOT NULL AUTO_INCREMENT,
  `fk_prest_consu` int NOT NULL,
  `fk_react` int NOT NULL,
  `cant` int NOT NULL,
  PRIMARY KEY (`id_detall_prest_consu`),
  KEY `fk_detall_prest_consu_prest_consu1_idx` (`fk_prest_consu`),
  KEY `fk_detall_prest_consu_react1_idx` (`fk_react`),
  CONSTRAINT `fk_detall_prest_consu_prest_consu1` FOREIGN KEY (`fk_prest_consu`) REFERENCES `prest_consu` (`id_prest_consu`),
  CONSTRAINT `fk_detall_prest_consu_react1` FOREIGN KEY (`fk_react`) REFERENCES `react` (`id_react`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detall_prest_consu`
--

LOCK TABLES `detall_prest_consu` WRITE;
/*!40000 ALTER TABLE `detall_prest_consu` DISABLE KEYS */;
INSERT INTO `detall_prest_consu` VALUES (9,21,1,1),(10,27,1,3),(11,27,1,4),(12,27,1,7),(13,27,1,6),(14,29,3,12),(25,30,4,2);
/*!40000 ALTER TABLE `detall_prest_consu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `devol`
--

DROP TABLE IF EXISTS `devol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `devol` (
  `id_devol` int NOT NULL AUTO_INCREMENT,
  `fecha_devol` datetime NOT NULL,
  `obser_devol` varchar(250) NOT NULL,
  `fk_prest` int NOT NULL,
  PRIMARY KEY (`id_devol`),
  KEY `fk_devol_prest1_idx` (`fk_prest`),
  CONSTRAINT `fk_devol_prest1` FOREIGN KEY (`fk_prest`) REFERENCES `prest` (`id_prest`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devol`
--

LOCK TABLES `devol` WRITE;
/*!40000 ALTER TABLE `devol` DISABLE KEYS */;
INSERT INTO `devol` VALUES (1,'2019-10-26 00:00:00','total ',1),(2,'2019-10-25 00:00:00','En perfecto estado',2),(3,'2019-10-31 00:00:00','completo',3);
/*!40000 ALTER TABLE `devol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equip`
--

DROP TABLE IF EXISTS `equip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `equip` (
  `id_equip` int NOT NULL AUTO_INCREMENT,
  `nombr_equip` varchar(50) NOT NULL,
  `canti_equip` int NOT NULL,
  `descr` varchar(200) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  PRIMARY KEY (`id_equip`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equip`
--

LOCK TABLES `equip` WRITE;
/*!40000 ALTER TABLE `equip` DISABLE KEYS */;
INSERT INTO `equip` VALUES (1,'Probeta',1,'                            instrumento volumétrico que consiste en un cilindro graduado de vidrio común que permite contener líquidos y sirve para medir volúmenes de forma aproximada                 ','vidrio'),(10,'Matraz',27,'Tiene un cuello estrecho y se expande hacia su base. Esto permite una fácil mezcla y agitación del matraz sin demasiado riesgo de derrames. ','vidrio'),(11,'Matraz Florencia',364,'Tiene un fondo redondo y un cuello largo. Se utiliza para contener líquidos y se puede girar y calentar fácilmente. Gracias a su forma ovalada permite que las sustancias se calienten de manera uniform','vidrio'),(12,'Tubos de ensayo',25,'Los tubos de ensayo se utilizan para contener muestras pequeñas.\r\nSe usan principalmente para la evaluación y comparación cualitativa.','20'),(13,'Tubos de ensayo Vidrio de reloj',20,'Pieza redonda de vidrio que es ligeramente cóncava/convexa.\r\nSe pueden usar con fines de evaporación y también pueden funcionar como tapa para un vaso de precipitados.','vidrio'),(15,'Pipetas de laboratorio',20,'Son para medir un volumen exacto de líquido y colocarlo en otro contenedor.','Vidrio'),(16,'Bureta de vidrio',20,'Tubo de vidrio que está abierto en la parte superior y llega a una abertura puntiaguda en la parte inferior.','Vidrio'),(17,'Termómetro de laboratorio',12,'Se usa para medir la temperatura de los líquidos.','Vidrio'),(19,'Matraz',20,'Tiene un cuello estrecho y se expande hacia su base. Esto permite una fácil mezcla y agitación del matraz sin demasiado riesgo de derrames. ','vidrio'),(20,'Matraz Florencia',20,'Tiene un fondo redondo y un cuello largo. Se utiliza para contener líquidos y se puede girar y calentar fácilmente. Gracias a su forma ovalada permite que las sustancias se calienten de manera uniform','vidrio'),(21,'Tubos de ensayo',20,'Los tubos de ensayo se utilizan para contener muestras pequeñas.\r\nSe usan principalmente para la evaluación y comparación cualitativa.','20'),(22,'Tubos de ensayo Vidrio de reloj',20,'Pieza redonda de vidrio que es ligeramente cóncava/convexa.\r\nSe pueden usar con fines de evaporación y también pueden funcionar como tapa para un vaso de precipitados.','vidrio'),(23,'Embudo de laboratorio',20,'Es como cualquier otro embudo, excepto que fue diseñado para ser utilizado en un laboratorio.','Plástico'),(24,'Pipetas de laboratorio',20,'Son para medir un volumen exacto de líquido y colocarlo en otro contenedor.','Vidrio'),(25,'Bureta de vidrio',20,'Tubo de vidrio que está abierto en la parte superior y llega a una abertura puntiaguda en la parte inferior.','Vidrio'),(26,'Termómetro de laboratorio',65,'Se usa para medir la temperatura de los líquidos.','Vidrio'),(28,'Balanza de laboratorio',10,'Se usa una balanza para pesar productos quimicos','Plastico'),(46,'Microscopio x20',4,'                    Este microscopio estereoscópico es de gran ayuda en reparación de tarjetas electrónicas (micro soldaduras). Permite la observación de objetos tridimensionales.                ','S/D');
/*!40000 ALTER TABLE `equip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `horario` (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `asunt` varchar(300) NOT NULL,
  `fk_solicitud` int NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `fk_horario_solicitud1_idx` (`fk_solicitud`),
  CONSTRAINT `fk_horario_solicitud1` FOREIGN KEY (`fk_solicitud`) REFERENCES `solicitud` (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (1,'2019-10-25','Actividad',1,'08:00:00','09:00:00'),(2,'2019-10-28','Actividad',1,'08:00:00','09:00:00'),(3,'2019-11-12','Actividad',1,'08:00:00','09:00:00'),(4,'2019-11-26','Actividad',1,'08:00:00','09:00:00'),(5,'2019-11-06','Actividad',1,'08:00:00','09:00:00'),(6,'2025-07-02','prueba',5,'10:00:00','11:00:00'),(7,'2025-07-03','clase en sala',1,'08:00:00','10:00:00'),(8,'2025-07-04','clase en sala',3,'08:00:00','10:00:00'),(9,'2025-07-04','practica laboratorio',6,'10:00:00','11:00:00'),(10,'2025-07-10','clase en sala',1,'08:00:00','09:00:00');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incid`
--

DROP TABLE IF EXISTS `incid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incid` (
  `id_incid` int NOT NULL AUTO_INCREMENT,
  `fecha_incid` datetime NOT NULL,
  `descr` varchar(100) NOT NULL,
  `fk_matri` int NOT NULL,
  PRIMARY KEY (`id_incid`),
  KEY `fk_incid_usuar1_idx` (`fk_matri`),
  CONSTRAINT `fk_incid_usuar1` FOREIGN KEY (`fk_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incid`
--

LOCK TABLES `incid` WRITE;
/*!40000 ALTER TABLE `incid` DISABLE KEYS */;
INSERT INTO `incid` VALUES (1,'2019-10-25 00:00:00','Se derramo acido en una de las mesas del laboratorio',5681),(2,'2025-06-18 00:00:00','Se derramo acido en una de las mesas del laboratorio',5681);
/*!40000 ALTER TABLE `incid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inven`
--

DROP TABLE IF EXISTS `inven`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inven` (
  `id_inven` int NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `fk_usuar_matri` int NOT NULL,
  PRIMARY KEY (`id_inven`),
  KEY `fk_inven_usuar1_idx` (`fk_usuar_matri`),
  CONSTRAINT `fk_inven_usuar1` FOREIGN KEY (`fk_usuar_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inven`
--

LOCK TABLES `inven` WRITE;
/*!40000 ALTER TABLE `inven` DISABLE KEYS */;
INSERT INTO `inven` VALUES (1,'2019-10-25',5681),(2,'2019-10-25',5681),(3,'2019-11-25',5681),(4,'2025-06-26',5681),(8,'2025-07-05',5681);
/*!40000 ALTER TABLE `inven` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mater`
--

DROP TABLE IF EXISTS `mater`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mater` (
  `id_mater` int NOT NULL AUTO_INCREMENT,
  `nombr` varchar(45) NOT NULL,
  `capac` int NOT NULL,
  `canti` int NOT NULL,
  `marca` varchar(25) NOT NULL,
  `fk_unids` int NOT NULL,
  PRIMARY KEY (`id_mater`),
  KEY `fk_mater_unids1_idx` (`fk_unids`),
  CONSTRAINT `fk_mater_unids1` FOREIGN KEY (`fk_unids`) REFERENCES `unids` (`id_unids`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mater`
--

LOCK TABLES `mater` WRITE;
/*!40000 ALTER TABLE `mater` DISABLE KEYS */;
INSERT INTO `mater` VALUES (1,'Matraz',500,12,'Zahfer',4),(7,'Vaso de precipitado',500,30,'Duran',4),(8,'Mortero',300,16,'Ibili',4),(9,'Tubo de ensayo',14,33,'Fisherbrand',4),(10,'Bureta',225,7,'Proton',4),(11,'Pipeta',20,10,'Kimax',4),(12,'Prueba de tabal materiales',34,2,'Prueba',4),(14,'Probeta',50,3,'UNLINE',4);
/*!40000 ALTER TABLE `mater` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mobil`
--

DROP TABLE IF EXISTS `mobil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mobil` (
  `id_mobil` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) NOT NULL,
  `mater` varchar(20) NOT NULL,
  `nombr` varchar(45) NOT NULL,
  `canti` int NOT NULL,
  PRIMARY KEY (`id_mobil`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mobil`
--

LOCK TABLES `mobil` WRITE;
/*!40000 ALTER TABLE `mobil` DISABLE KEYS */;
INSERT INTO `mobil` VALUES (10,'Mesa','Metal','Mesa central',2),(11,'Mesa','Metal con sistema el','Mesa de Balanza',1),(12,'Silla','Acero/tapizado','Sillas de respaldo',20),(13,'Silla','Acero/tapizado','Taburete',20),(14,'Estante','Acero inoxidable/vid','Estante de suelo',3),(15,'Silla','Acero y plastico','Silla baja giratoria',6),(16,'Estantes','lamina de acero/vidr','Mueble para colección de muestras',3),(17,'Fregaderos','Acero  inoxidable','Fregadero',3),(18,'Vitrina','Lamina de acero','Vitrina de gases con superficie de trabajo',2),(19,'Armario','Acero inoxidable','Armario bajo de seguridad para guardar líquid',2),(20,'Mesa','Metal','Mesa central',1),(21,'Mesa','Metal con sistema el','Mesa de Balanza',2),(22,'Silla','Acero/tapizado','Sillas de respaldo',20),(23,'Silla','Acero/tapizado','Taburete',20),(24,'Estante','Acero inoxidable/vid','Estante de suelo',3),(25,'Silla','Acero y plastico','Silla baja giratoria',6),(26,'Estantes','lamina de acero/vidr','Mueble para colección de muestras',3),(27,'Fregaderos','Acero  inoxidable','Fregadero',2),(28,'Vitrina','Lamina de acero','Vitrina de gases con superficie de trabajo',2),(29,'Armario','Acero inoxidable','Armario bajo de seguridad para guardar líquid',2),(30,'Mesa','Metalica','Mesa de exposicion 2x3',2),(31,'Mesa','Metal','Mesa experimental',10),(33,'','','',0);
/*!40000 ALTER TABLE `mobil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_usuar`
--

DROP TABLE IF EXISTS `nivel_usuar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nivel_usuar` (
  `id_nivel_usuar` int NOT NULL AUTO_INCREMENT,
  `nombr_nivel` varchar(20) NOT NULL,
  PRIMARY KEY (`id_nivel_usuar`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_usuar`
--

LOCK TABLES `nivel_usuar` WRITE;
/*!40000 ALTER TABLE `nivel_usuar` DISABLE KEYS */;
INSERT INTO `nivel_usuar` VALUES (1,'Encargado'),(2,'Servicio');
/*!40000 ALTER TABLE `nivel_usuar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prest`
--

DROP TABLE IF EXISTS `prest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prest` (
  `id_prest` int NOT NULL AUTO_INCREMENT,
  `fk_usuar_matri` int NOT NULL,
  `matri_solic` int NOT NULL,
  `fecha_entre` datetime NOT NULL,
  `fecha_devol` datetime NOT NULL,
  PRIMARY KEY (`id_prest`),
  KEY `fk_prest_usuar1_idx` (`fk_usuar_matri`),
  CONSTRAINT `fk_prest_usuar1` FOREIGN KEY (`fk_usuar_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prest`
--

LOCK TABLES `prest` WRITE;
/*!40000 ALTER TABLE `prest` DISABLE KEYS */;
INSERT INTO `prest` VALUES (1,5681,5683,'2019-10-25 00:00:00','2019-10-28 00:00:00'),(2,5681,5677,'2019-10-25 00:00:00','2019-10-29 00:00:00'),(3,5681,5683,'2019-10-25 00:00:00','2019-10-28 00:00:00'),(4,5681,5684,'2019-10-25 00:00:00','2019-10-28 00:00:00'),(5,5681,5677,'2019-10-31 00:00:00','2019-11-01 00:00:00'),(6,5601,5677,'2025-07-09 00:00:00','2025-07-09 00:00:00'),(7,5601,5684,'2025-07-09 00:00:00','2025-07-11 00:00:00');
/*!40000 ALTER TABLE `prest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prest_consu`
--

DROP TABLE IF EXISTS `prest_consu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prest_consu` (
  `id_prest_consu` int NOT NULL AUTO_INCREMENT,
  `fecha_entre` datetime NOT NULL,
  `fk_matri` int NOT NULL,
  `matri_solic` int NOT NULL,
  PRIMARY KEY (`id_prest_consu`),
  KEY `fk_prest_consu_usuar1_idx` (`fk_matri`),
  CONSTRAINT `fk_prest_consu_usuar1` FOREIGN KEY (`fk_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prest_consu`
--

LOCK TABLES `prest_consu` WRITE;
/*!40000 ALTER TABLE `prest_consu` DISABLE KEYS */;
INSERT INTO `prest_consu` VALUES (21,'2019-10-25 12:19:14',5681,5678),(22,'2024-12-29 11:40:35',5601,5601),(23,'2024-12-29 11:48:18',5601,5681),(24,'2024-12-29 12:00:11',5601,5681),(25,'2024-12-29 12:00:23',5601,5681),(26,'2024-12-29 12:00:48',5601,5681),(27,'2024-12-29 12:05:00',5601,5681),(28,'2024-12-29 12:08:57',5601,5681),(29,'2024-12-29 12:09:10',5601,5601),(30,'2025-06-14 00:00:00',5601,5601);
/*!40000 ALTER TABLE `prest_consu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `react`
--

DROP TABLE IF EXISTS `react`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `react` (
  `id_react` int NOT NULL AUTO_INCREMENT,
  `nombr` varchar(100) NOT NULL,
  `formu` varchar(100) DEFAULT NULL,
  `pelig_salud` varchar(1) DEFAULT NULL,
  `pelig_infla` varchar(1) DEFAULT NULL,
  `pelig_ines` varchar(1) DEFAULT NULL,
  `pelig_esp` varchar(10) DEFAULT NULL,
  `fk_unids` int NOT NULL,
  `cant` int NOT NULL,
  PRIMARY KEY (`id_react`),
  KEY `fk_react_unids1_idx` (`fk_unids`),
  CONSTRAINT `fk_react_unids1` FOREIGN KEY (`fk_unids`) REFERENCES `unids` (`id_unids`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `react`
--

LOCK TABLES `react` WRITE;
/*!40000 ALTER TABLE `react` DISABLE KEYS */;
INSERT INTO `react` VALUES (1,'Acetona','C3 H6 O','1','3','0','Inflamable',3,55),(2,'Ãcido acÃ©tico','CH3COOH','3','2','0','COR',4,500),(3,'Ãcido clorhÃ­drico','HCl','3','0','1','COR',4,288),(4,'Cloruro de sodio','NaCl','0','0','0','',1,149),(5,'Fluoruro de potasio','KF','3','0','1','',2,600),(6,'Yoduro de potasio','KI','1','0','0','TOX',1,313),(7,'Yoduro de hidrógeno','HI','3','0','0','COR',1,2850),(8,'Ácido fosfórico','H3PO4','2','0','0','COR',1,1685),(9,'Ãcido sulfÃºrico','H2SO4','3','0','2','COR',3,1840),(10,'Óxido de azufre (VI)','SO3','3','0','2','W',1,1500),(11,'Hidróxido de Sodio','NaOH','3','0','1','W',1,500),(12,'Hidróxido de potasio','KOH','3','0','1','COR',1,3),(13,'Nitrato de plata','AgNO3','3','0','2','OX',1,2);
/*!40000 ALTER TABLE `react` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servi_acces_labor`
--

DROP TABLE IF EXISTS `servi_acces_labor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `servi_acces_labor` (
  `id_acces_lab` int NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `asunto` varchar(200) NOT NULL,
  `fecha_apart` datetime NOT NULL,
  `fk_usuar_matri` int NOT NULL,
  `matric_solic` int NOT NULL,
  PRIMARY KEY (`id_acces_lab`),
  KEY `fk_servi_acces_labor_usuar1_idx` (`fk_usuar_matri`),
  CONSTRAINT `fk_servi_acces_labor_usuar1` FOREIGN KEY (`fk_usuar_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servi_acces_labor`
--

LOCK TABLES `servi_acces_labor` WRITE;
/*!40000 ALTER TABLE `servi_acces_labor` DISABLE KEYS */;
/*!40000 ALTER TABLE `servi_acces_labor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solicitud` (
  `id_solicitud` int NOT NULL AUTO_INCREMENT,
  `solicitante` int NOT NULL,
  `fk_matri` int NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `fk_solicitud_usuar1_idx` (`fk_matri`),
  CONSTRAINT `fk_solicitud_usuar1` FOREIGN KEY (`fk_matri`) REFERENCES `usuar` (`id_matri`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud`
--

LOCK TABLES `solicitud` WRITE;
/*!40000 ALTER TABLE `solicitud` DISABLE KEYS */;
INSERT INTO `solicitud` VALUES (1,5683,5681),(2,5682,5681),(3,5678,5681),(4,456,5681),(5,35678,5681),(6,5677,5681);
/*!40000 ALTER TABLE `solicitud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unids`
--

DROP TABLE IF EXISTS `unids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unids` (
  `id_unids` int NOT NULL AUTO_INCREMENT,
  `nombr` varchar(20) NOT NULL,
  PRIMARY KEY (`id_unids`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unids`
--

LOCK TABLES `unids` WRITE;
/*!40000 ALTER TABLE `unids` DISABLE KEYS */;
INSERT INTO `unids` VALUES (1,'Kg'),(2,'gr'),(3,'L'),(4,'ml'),(5,'pza');
/*!40000 ALTER TABLE `unids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuar`
--

DROP TABLE IF EXISTS `usuar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuar` (
  `id_matri` int NOT NULL,
  `nombr` varchar(100) NOT NULL,
  `apell` varchar(100) NOT NULL,
  `contr` varchar(255) NOT NULL,
  `fecha_nacim` date NOT NULL,
  `num_tel` varchar(18) NOT NULL,
  `fk_nivel_usuar` int NOT NULL,
  `user_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id_matri`),
  KEY `fk_usuar_nivel_usuar_idx` (`fk_nivel_usuar`),
  CONSTRAINT `fk_usuar_nivel_usuar` FOREIGN KEY (`fk_nivel_usuar`) REFERENCES `nivel_usuar` (`id_nivel_usuar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuar`
--

LOCK TABLES `usuar` WRITE;
/*!40000 ALTER TABLE `usuar` DISABLE KEYS */;
INSERT INTO `usuar` VALUES (0,'Administrador','Laboratorio','$argon2id$v=19$m=65536,t=4,p=1$Si93S0NvT0Zia3JzV2lHUg$S+7f5Ag8dfsuj+G/y/rF8q8Gwpu+MF/Fmz1c+nYm1+Q','2025-07-11','0000000000',1,'admin'),(1000,'Developer','Desarrollo','$argon2id$v=19$m=65536,t=4,p=1$U2RicnZkcENBWk5OM2x2eA$UAppp78Z+X4sWYc99dXy4ppREIbWZijd/zKmS5pUCDk','2025-07-11','9961111111',1,'dev'),(5601,'Servicio','Servicio','$argon2id$v=19$m=65536,t=4,p=1$OGZ6T256LzBqNWYuanA4Tg$K9O3QWVe8zY8MH8VTyxPJwcUHdQfkIgYK4wYvIfZk/c','2019-06-05','9960000000',2,'Servicio'),(5681,'Carlos Renato','Dzul Ramirez','solotulosabes','1998-08-08','9961106338',1,'Renato');
/*!40000 ALTER TABLE `usuar` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-15 16:05:10
