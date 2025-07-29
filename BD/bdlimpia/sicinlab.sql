-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: sicinlab
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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `estatus` char(1) DEFAULT 'R' COMMENT 'R reservado, O ocupado, F finalizado',
  PRIMARY KEY (`id_horario`),
  KEY `fk_horario_solicitud1_idx` (`fk_solicitud`),
  CONSTRAINT `fk_horario_solicitud1` FOREIGN KEY (`fk_solicitud`) REFERENCES `solicitud` (`id_solicitud`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Dumping routines for database 'sicinlab'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-28 20:18:39
