-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: universidad
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

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
-- Table structure for table `alumnos_materias`
--

DROP TABLE IF EXISTS `alumnos_materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumnos_materias` (
  `am_id` int(11) NOT NULL AUTO_INCREMENT,
  `alumno_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `calificacion` float DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  PRIMARY KEY (`am_id`),
  KEY `alumnos_materias_ibfk_1` (`alumno_id`),
  KEY `alumnos_materias_ibfk_2` (`materia_id`),
  CONSTRAINT `alumnos_materias_ibfk_1` FOREIGN KEY (`alumno_id`) REFERENCES `usuarios` (`usuario_id`) ON UPDATE CASCADE,
  CONSTRAINT `alumnos_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumnos_materias`
--

LOCK TABLES `alumnos_materias` WRITE;
/*!40000 ALTER TABLE `alumnos_materias` DISABLE KEYS */;
INSERT INTO `alumnos_materias` VALUES (6,3,1,NULL,NULL),(14,18,3,NULL,NULL),(16,18,11,NULL,NULL),(17,18,16,NULL,NULL),(18,18,9,NULL,NULL),(19,5,1,NULL,NULL),(20,5,10,NULL,NULL),(21,5,3,NULL,NULL),(22,3,3,NULL,NULL),(23,3,16,NULL,NULL),(24,3,11,NULL,NULL),(25,18,1,NULL,NULL);
/*!40000 ALTER TABLE `alumnos_materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maestros_materias`
--

DROP TABLE IF EXISTS `maestros_materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maestros_materias` (
  `mm_id` int(11) NOT NULL AUTO_INCREMENT,
  `maestro_id` int(11) DEFAULT NULL,
  `materia_id` int(11) DEFAULT NULL,
  `num_alumnos` int(11) DEFAULT NULL,
  PRIMARY KEY (`mm_id`),
  KEY `materia_id` (`materia_id`),
  KEY `alumnos_materias_ibfk_1` (`maestro_id`),
  CONSTRAINT `maestros_materias_ibfk_1` FOREIGN KEY (`maestro_id`) REFERENCES `usuarios` (`usuario_id`) ON UPDATE CASCADE,
  CONSTRAINT `maestros_materias_ibfk_2` FOREIGN KEY (`materia_id`) REFERENCES `materias` (`materia_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maestros_materias`
--

LOCK TABLES `maestros_materias` WRITE;
/*!40000 ALTER TABLE `maestros_materias` DISABLE KEYS */;
INSERT INTO `maestros_materias` VALUES (1,2,1,NULL),(35,16,10,NULL),(36,15,11,NULL),(38,19,16,NULL),(39,20,15,NULL),(40,20,9,NULL);
/*!40000 ALTER TABLE `maestros_materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materias`
--

DROP TABLE IF EXISTS `materias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `materias` (
  `materia_id` int(11) NOT NULL AUTO_INCREMENT,
  `materia_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`materia_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materias`
--

LOCK TABLES `materias` WRITE;
/*!40000 ALTER TABLE `materias` DISABLE KEYS */;
INSERT INTO `materias` VALUES (1,'Matematicas'),(3,'Programación'),(9,'Guarani'),(10,'Biologia'),(11,'Biomedicina'),(15,'Sin asignar'),(16,'Literatura');
/*!40000 ALTER TABLE `materias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_nombre` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'maestro'),(3,'alumno');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) DEFAULT NULL,
  `contrasena` varchar(250) DEFAULT NULL,
  `usuario_nombre` varchar(150) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'admin@admin','admin','admin',NULL,NULL,1),(2,'maestro@maestro','maestro','maestro',NULL,NULL,2),(3,'alumno@alumno','alumno','alumno','2001-08-03','901 Autumn Leaf Circle',3),(5,'fer@fer','','fernanda ortega','2002-12-12','obregon 19',3),(15,'aldo@aldo','','aldo aldo','1999-01-01','aldo',2),(16,'harold@harold','','harold carazas','1998-01-01','peru',2),(18,'karim@karim','','karim valenzuela','1993-03-31','universo',3),(19,'mario@mario','','mario lopez','1990-04-05','guamuchil',2),(20,'wil@wil','','wil valdez','1995-03-03','rio bravo',2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'universidad'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-05  7:42:08
