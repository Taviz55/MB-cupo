-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: metrobus
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `estacion`
--

DROP TABLE IF EXISTS `estacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `linea_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_estacion_linea1_idx` (`linea_id`),
  CONSTRAINT `fk_estacion_linea1` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estacion`
--

LOCK TABLES `estacion` WRITE;
/*!40000 ALTER TABLE `estacion` DISABLE KEYS */;
INSERT INTO `estacion` VALUES (1,'Tepalcates',2),(2,'Canal de San Juan',2),(3,'General Antonio de León',2),(4,'Nicolás Bravo',2),(5,'Constitución de Apatzingán',2),(6,'CCH Oriente',2),(7,'Leyes de Reforma',2),(8,'Del Moral',2),(9,'Río Frío',2),(10,'Rojo Gómez',2),(11,'Río Mayo',2),(12,'Río Tecolutla',2),(13,'El Rodeo',2),(14,'UPIICSA',2),(15,'Goma',2),(16,'Tlacotal',2),(17,'Canela',2),(18,'Coyuya',2),(19,'La Viga',2),(20,'Andrés Molina',2),(21,'Las Américas',2),(22,'Xola',2),(23,'Álamos',2),(24,'Centro SCOP',2),(25,'Doctor Vértiz',2),(26,'Etiopía',2),(27,'Amores',2),(28,'Viaducto',2),(29,'Nuevo León',2),(30,'Patriotismo',2),(31,'De la Salle',2),(32,'Parque Lira',2),(33,'Antonio Maceo',2),(34,'Tacubaya',2);
/*!40000 ALTER TABLE `estacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea`
--

DROP TABLE IF EXISTS `linea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `linea` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea`
--

LOCK TABLES `linea` WRITE;
/*!40000 ALTER TABLE `linea` DISABLE KEYS */;
INSERT INTO `linea` VALUES (1,'Línea 1'),(2,'Línea 2');
/*!40000 ALTER TABLE `linea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metrobus`
--

DROP TABLE IF EXISTS `metrobus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metrobus` (
  `id` varchar(10) NOT NULL,
  `tipo_metrobus_id` int(11) NOT NULL,
  `linea_id` int(11) NOT NULL,
  `ruta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_metrobus_tipo_metrobus1_idx` (`tipo_metrobus_id`),
  KEY `fk_metrobus_linea1_idx` (`linea_id`),
  KEY `fk_metrobus_ruta1_idx` (`ruta_id`),
  CONSTRAINT `fk_metrobus_linea1` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_metrobus_ruta1` FOREIGN KEY (`ruta_id`) REFERENCES `ruta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_metrobus_tipo_metrobus1` FOREIGN KEY (`tipo_metrobus_id`) REFERENCES `tipo_metrobus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrobus`
--

LOCK TABLES `metrobus` WRITE;
/*!40000 ALTER TABLE `metrobus` DISABLE KEYS */;
INSERT INTO `metrobus` VALUES ('001MB',1,2,1),('002MB',1,2,1),('003MB',2,2,1),('004MB',2,2,1),('005MB',2,2,2),('006MB',2,2,2),('007MB',2,2,1),('008MB',2,2,2),('009MB',3,2,1),('010MB',3,2,2);
/*!40000 ALTER TABLE `metrobus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metrobus_cupo`
--

DROP TABLE IF EXISTS `metrobus_cupo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `metrobus_cupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metrobus_id` varchar(10) NOT NULL,
  `ruta_id` int(11) NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `estacion_id` int(11) NOT NULL,
  `cupo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_metrobus_cupo_estacion1_idx` (`estacion_id`),
  KEY `fk_metrobus_cupo_metrobus1_idx` (`metrobus_id`),
  KEY `fk_metrobus_cupo_ruta1_idx` (`ruta_id`),
  CONSTRAINT `fk_metrobus_cupo_estacion1` FOREIGN KEY (`estacion_id`) REFERENCES `estacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_metrobus_cupo_metrobus1` FOREIGN KEY (`metrobus_id`) REFERENCES `metrobus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_metrobus_cupo_ruta1` FOREIGN KEY (`ruta_id`) REFERENCES `ruta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrobus_cupo`
--

LOCK TABLES `metrobus_cupo` WRITE;
/*!40000 ALTER TABLE `metrobus_cupo` DISABLE KEYS */;
INSERT INTO `metrobus_cupo` VALUES (1,'001MB',1,'Tepalcates',4,95),(2,'002MB',1,'Tepalcates',6,80),(3,'003MB',1,'Tacubaya',2,150),(4,'004MB',1,'Tepalcates',10,130),(5,'005MB',1,'Tacubaya',6,140),(6,'006MB',1,'Tacubaya',31,130),(7,'007MB',1,'Tacubaya',29,157),(8,'008MB',1,'Tepalcates',33,148),(9,'009MB',1,'Tacubaya',25,200),(10,'010MB',1,'Tepalcates',29,235);
/*!40000 ALTER TABLE `metrobus_cupo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasajero`
--

DROP TABLE IF EXISTS `pasajero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasajero` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metrobus_id` varchar(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `estacion_inicio_id` int(10) NOT NULL,
  `estacion_destino_id` int(10) NOT NULL,
  `hora_ingreso` time NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pasajero_metrobus1_idx` (`metrobus_id`),
  CONSTRAINT `fk_pasajero_metrobus1` FOREIGN KEY (`metrobus_id`) REFERENCES `metrobus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasajero`
--

LOCK TABLES `pasajero` WRITE;
/*!40000 ALTER TABLE `pasajero` DISABLE KEYS */;
INSERT INTO `pasajero` VALUES (1,'008MB',2,30,26,'03:27:45','2017-12-19'),(2,'003MB',2,22,27,'03:29:16','2017-12-19'),(3,'005MB',2,16,12,'03:31:17','2017-12-19'),(4,'005MB',2,16,12,'03:33:23','2017-12-19');
/*!40000 ALTER TABLE `pasajero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ruta`
--

DROP TABLE IF EXISTS `ruta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ruta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ruta` varchar(60) NOT NULL,
  `estacion_a_id` int(11) NOT NULL,
  `estacion_b_id` int(11) NOT NULL,
  `linea_id` int(11) NOT NULL,
  `linea_transborde_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ruta1_linea1_idx` (`linea_id`),
  CONSTRAINT `fk_ruta1_linea1` FOREIGN KEY (`linea_id`) REFERENCES `linea` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ruta`
--

LOCK TABLES `ruta` WRITE;
/*!40000 ALTER TABLE `ruta` DISABLE KEYS */;
INSERT INTO `ruta` VALUES (1,'Tepalcates-Tacubaya',1,34,2,NULL),(2,'Tepalcates-Etiopía',1,26,2,NULL),(3,'Del Moral-Col. del Valle',8,0,2,1),(4,'Tepalcates-Col. del Valle',1,0,2,1),(5,'',0,0,2,NULL),(6,'',0,0,2,NULL),(7,'',0,0,2,NULL),(8,'',0,0,2,NULL),(9,'',0,0,2,NULL),(10,'',0,0,2,NULL);
/*!40000 ALTER TABLE `ruta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_metrobus`
--

DROP TABLE IF EXISTS `tipo_metrobus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_metrobus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `capacidad` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_metrobus`
--

LOCK TABLES `tipo_metrobus` WRITE;
/*!40000 ALTER TABLE `tipo_metrobus` DISABLE KEYS */;
INSERT INTO `tipo_metrobus` VALUES (1,'Autobús 12 metros',100),(2,'Autobús Articulado',160),(3,'Autobús Biarticulado',240);
/*!40000 ALTER TABLE `tipo_metrobus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-19  4:13:13
