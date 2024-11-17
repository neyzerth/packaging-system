-- MySQL dump 10.13  Distrib 9.0.1, for Linux (x86_64)
--
-- Host: localhost    Database: packaging
-- ------------------------------------------------------
-- Server version	9.0.1

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
-- Table structure for table `box`
--

DROP TABLE IF EXISTS `box`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `box` (
  `num` int NOT NULL AUTO_INCREMENT,
  `height` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `volume` decimal(10,2) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `box`
--

LOCK TABLES `box` WRITE;
/*!40000 ALTER TABLE `box` DISABLE KEYS */;
INSERT INTO `box` VALUES (1,10.50,12.00,15.00,1890.00,3.50),(2,8.00,10.00,20.00,1600.00,2.80),(3,5.00,7.00,10.00,350.00,1.20),(4,15.00,15.00,15.00,3375.00,5.00),(5,12.00,14.00,16.00,2688.00,4.20);
/*!40000 ALTER TABLE `box` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `calculate_box_volume_insert` BEFORE INSERT ON `box` FOR EACH ROW Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `calculate_box_volume_update` BEFORE UPDATE ON `box` FOR EACH ROW Begin
    SET NEW.volume = NEW.height*NEW.width*NEW.length;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `incident`
--

DROP TABLE IF EXISTS `incident`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incident` (
  `num` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `user` int DEFAULT NULL,
  `traceability` int DEFAULT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `UQ_incident_date` (`date`),
  KEY `fk_user_incident` (`user`),
  KEY `fk_traceability_incident` (`traceability`),
  CONSTRAINT `fk_traceability_incident` FOREIGN KEY (`traceability`) REFERENCES `traceability` (`num`),
  CONSTRAINT `fk_user_incident` FOREIGN KEY (`user`) REFERENCES `user` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident`
--

LOCK TABLES `incident` WRITE;
/*!40000 ALTER TABLE `incident` DISABLE KEYS */;
INSERT INTO `incident` VALUES (21,'2024-10-05','Package damaged during transport',3,1),(22,'2024-10-06','Late delivery',4,2),(23,'2024-10-07','Wrong item delivered',5,3),(24,'2024-10-08','Missing items in package',2,4),(25,'2024-10-09','Package lost in transit',1,5);
/*!40000 ALTER TABLE `incident` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material` (
  `code` varchar(5) NOT NULL,
  `material_name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `available_quantity` int DEFAULT NULL,
  `unit_of_measure` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`code`),
  KEY `fk_unit_of_measure` (`unit_of_measure`),
  CONSTRAINT `fk_unit_of_measure` FOREIGN KEY (`unit_of_measure`) REFERENCES `unit_of_measure` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material`
--

LOCK TABLES `material` WRITE;
/*!40000 ALTER TABLE `material` DISABLE KEYS */;
INSERT INTO `material` VALUES ('alm','Aluminum','Lightweight aluminum',400,'UOM01'),('glas','Glass','Tempered glass',150,'UOM02'),('pla','Plastic','Durable plastic',200,'UOM03'),('stl','Steel','High-quality steel',500,'UOM01'),('wod','Wood','Solid oak wood',300,'UOM03');
/*!40000 ALTER TABLE `material` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `material_package`
--

DROP TABLE IF EXISTS `material_package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_package` (
  `material` varchar(5) NOT NULL,
  `package` int NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`material`,`package`),
  KEY `fk_package_material` (`package`),
  CONSTRAINT `fk_material_package` FOREIGN KEY (`material`) REFERENCES `material` (`code`),
  CONSTRAINT `fk_package_material` FOREIGN KEY (`package`) REFERENCES `package` (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_package`
--

LOCK TABLES `material_package` WRITE;
/*!40000 ALTER TABLE `material_package` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_package` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `material_package_insert` AFTER INSERT ON `material_package` FOR EACH ROW BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `material_packging`
--

DROP TABLE IF EXISTS `material_packging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `material_packging` (
  `packaging` varchar(5) NOT NULL,
  `material` varchar(5) NOT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`material`,`packaging`),
  KEY `fk_packaging_material` (`packaging`),
  CONSTRAINT `fk_material_packaging` FOREIGN KEY (`material`) REFERENCES `material` (`code`),
  CONSTRAINT `fk_packaging_material` FOREIGN KEY (`packaging`) REFERENCES `packaging` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `material_packging`
--

LOCK TABLES `material_packging` WRITE;
/*!40000 ALTER TABLE `material_packging` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_packging` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `material_packging_insert` AFTER INSERT ON `material_packging` FOR EACH ROW BEGIN
    UPDATE material
    SET available_quantity = available_quantity - NEW.quantity
    WHERE code = NEW.material;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `outbound`
--

DROP TABLE IF EXISTS `outbound`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outbound` (
  `num` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `exit_quantity` int DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outbound`
--

LOCK TABLES `outbound` WRITE;
/*!40000 ALTER TABLE `outbound` DISABLE KEYS */;
INSERT INTO `outbound` VALUES (1,'2024-10-01',100),(2,'2024-10-02',150),(3,'2024-10-03',200),(4,'2024-10-04',50),(5,'2024-10-05',75);
/*!40000 ALTER TABLE `outbound` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `package`
--

DROP TABLE IF EXISTS `package`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `package` (
  `num` int NOT NULL AUTO_INCREMENT,
  `product_quantity` int DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `product` varchar(5) DEFAULT NULL,
  `packaging` varchar(5) DEFAULT NULL,
  `box` int DEFAULT NULL,
  `tag` int DEFAULT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `UQ_package_tag` (`tag`),
  KEY `fk_product_package` (`product`),
  KEY `fk_packaging_package` (`packaging`),
  KEY `fk_box_package` (`box`),
  CONSTRAINT `fk_box_package` FOREIGN KEY (`box`) REFERENCES `box` (`num`),
  CONSTRAINT `fk_packaging_package` FOREIGN KEY (`packaging`) REFERENCES `packaging` (`code`),
  CONSTRAINT `fk_product_package` FOREIGN KEY (`product`) REFERENCES `product` (`code`),
  CONSTRAINT `fk_tag_package` FOREIGN KEY (`tag`) REFERENCES `tag` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `package`
--

LOCK TABLES `package` WRITE;
/*!40000 ALTER TABLE `package` DISABLE KEYS */;
INSERT INTO `package` VALUES (1,10,25.50,'S10','PK001',1,1),(2,20,50.00,'P30','PK002',2,2),(3,15,35.20,'X','PK003',3,3),(4,30,60.70,'S23','PK004',4,4),(5,25,45.90,'S24','PK005',5,5);
/*!40000 ALTER TABLE `package` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `calculate_package_weight` BEFORE INSERT ON `package` FOR EACH ROW BEGIN
    DECLARE prod_weight DECIMAL(10, 2);
    SET prod_weight = (
        SELECT SUM(weight) * NEW.product_quantity
        FROM product
        WHERE package = NEW.num
    );
    SET NEW.weight = prod_weight;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `packaging`
--

DROP TABLE IF EXISTS `packaging`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `packaging` (
  `code` varchar(5) NOT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `package_quantity` int DEFAULT NULL,
  `zone` varchar(5) DEFAULT NULL,
  `outbound` int DEFAULT NULL,
  `tag` int DEFAULT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `UQ_packaging_tag` (`tag`),
  KEY `fk_zone_packaging` (`zone`),
  KEY `fk_outbound_packaging` (`outbound`),
  CONSTRAINT `fk_outbound_packaging` FOREIGN KEY (`outbound`) REFERENCES `outbound` (`num`),
  CONSTRAINT `fk_tag_packaging` FOREIGN KEY (`tag`) REFERENCES `tag` (`num`),
  CONSTRAINT `fk_zone_packaging` FOREIGN KEY (`zone`) REFERENCES `zone` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packaging`
--

LOCK TABLES `packaging` WRITE;
/*!40000 ALTER TABLE `packaging` DISABLE KEYS */;
INSERT INTO `packaging` VALUES ('PK001',10.00,15.00,20.00,100,'Z001',1,1),('PK002',12.00,18.00,25.00,150,'Z002',2,2),('PK003',8.00,10.00,15.00,75,'Z003',3,3),('PK004',14.00,16.00,30.00,50,'Z004',4,4),('PK005',9.00,11.00,22.00,60,'Z005',5,5);
/*!40000 ALTER TABLE `packaging` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packaging_protocol`
--

DROP TABLE IF EXISTS `packaging_protocol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `packaging_protocol` (
  `num` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `file_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packaging_protocol`
--

LOCK TABLES `packaging_protocol` WRITE;
/*!40000 ALTER TABLE `packaging_protocol` DISABLE KEYS */;
INSERT INTO `packaging_protocol` VALUES (1,'Protocol_Standard','protocol_st.pdf'),(2,'Protocol_Fragile','protocol_fr.pdf'),(3,'Protocol_Heavy','protocol_h.pdf'),(4,'Protocol_Urgent','protocol_urg.pdf'),(5,'Protocol_Perishable','protocol_per.pdf');
/*!40000 ALTER TABLE `packaging_protocol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product` (
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `height` decimal(10,2) DEFAULT NULL,
  `width` decimal(10,2) DEFAULT NULL,
  `length` decimal(10,2) DEFAULT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `packaging_protocol` int DEFAULT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `UQ_product_name` (`name`),
  KEY `fk_packaging_protocol_product` (`packaging_protocol`),
  CONSTRAINT `fk_packaging_protocol_product` FOREIGN KEY (`packaging_protocol`) REFERENCES `packaging_protocol` (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES ('P30','Huawei P30','Medium-quality product',14.91,7.14,0.76,165.00,2),('S10','Samsung S10','Medium-quality product',14.99,7.04,0.78,157.00,1),('S23','Samsung S23','Standard product',14.63,7.09,0.76,168.00,4),('S24','Samsung S24','Ultra product',16.23,7.90,0.86,232.00,5),('X','iPhone X','Budget product',14.36,7.09,0.77,174.00,3);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report` (
  `folio` int NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `report_date` date DEFAULT NULL,
  `packed_products` int DEFAULT NULL,
  `observations` text,
  `traceability` int DEFAULT NULL,
  PRIMARY KEY (`folio`),
  UNIQUE KEY `UQ_report_report_date` (`report_date`),
  KEY `fk_traceability_report` (`traceability`),
  CONSTRAINT `fk_traceability_report` FOREIGN KEY (`traceability`) REFERENCES `traceability` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (1,'2024-09-01','2024-09-30','2024-10-01',1000,'No major issues',1),(2,'2024-09-01','2024-09-30','2024-10-02',1200,'Delayed deliveries',2),(3,'2024-09-01','2024-09-30','2024-10-03',1100,'Damaged products',3),(4,'2024-09-01','2024-09-30','2024-10-04',1050,'Excellent performance',4),(5,'2024-09-01','2024-09-30','2024-10-05',1150,'Lost packages',5);
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `state` (
  `code` varchar(5) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `state`
--

LOCK TABLES `state` WRITE;
/*!40000 ALTER TABLE `state` DISABLE KEYS */;
INSERT INTO `state` VALUES ('ST01','In Transit'),('ST02','Delivered'),('ST03','In Warehouse'),('ST04','Out for Delivery'),('ST05','Returned');
/*!40000 ALTER TABLE `state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag` (
  `num` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `tag_type` varchar(5) DEFAULT NULL,
  `destination` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `UQ_tag_barcode` (`barcode`),
  KEY `fk_tag_type_tag` (`tag_type`),
  CONSTRAINT `fk_tag_type_tag` FOREIGN KEY (`tag_type`) REFERENCES `tag_type` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'2024-10-01','123456789','TT01',NULL),(2,'2024-10-02','987654321','TT02',NULL),(3,'2024-10-03','112233445','TT03',NULL),(4,'2024-10-04','556677889','TT04',NULL),(5,'2024-10-05','998877665','TT05',NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `before_insert_tag` BEFORE INSERT ON `tag` FOR EACH ROW BEGIN
    DECLARE checksum INT DEFAULT 0;
    DECLARE gs1_code VARCHAR(255);
    DECLARE i INT DEFAULT 1;
    DECLARE len INT;
    DECLARE digito INT;
    DECLARE suma_impar INT DEFAULT 0;
    DECLARE suma_par INT DEFAULT 0;
    -- Generar el código GS1-128 básico (sin checksum)
    SET gs1_code = CONCAT(
        '(17)', DATE_FORMAT(NEW.date, '%y%m%d'),
        '(410)', NEW.destination,
        '(420)', NEW.tag_type
    );
    -- Longitud del código generado
    SET len = CHAR_LENGTH(gs1_code);
    -- Calcular el checksum recorriendo cada carácter
    WHILE i <= len DO
        SET digito = CAST(SUBSTRING(gs1_code, i, 1) AS UNSIGNED);
        IF i % 2 = 1 THEN
            -- Sumar posición impar y multiplicar por 3
            SET suma_impar = suma_impar + digito;
        ELSE
            -- Sumar posición par
            SET suma_par = suma_par + digito;
        END IF;
        SET i = i + 1;
    END WHILE;
    -- Sumar los resultados y calcular el checksum
    SET checksum = (10 - ((suma_impar * 3 + suma_par) % 10)) % 10;
    -- Concatenar el checksum al final del código GS1-128
    SET NEW.barcode = CONCAT(gs1_code, checksum);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `tag_type`
--

DROP TABLE IF EXISTS `tag_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tag_type` (
  `code` varchar(5) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag_type`
--

LOCK TABLES `tag_type` WRITE;
/*!40000 ALTER TABLE `tag_type` DISABLE KEYS */;
INSERT INTO `tag_type` VALUES ('TT01','Standard'),('TT02','Fragile'),('TT03','Heavy'),('TT04','Urgent'),('TT05','Perishable');
/*!40000 ALTER TABLE `tag_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traceability`
--

DROP TABLE IF EXISTS `traceability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `traceability` (
  `num` int NOT NULL AUTO_INCREMENT,
  `product` varchar(5) DEFAULT NULL,
  `box` int DEFAULT NULL,
  `package` int DEFAULT NULL,
  `packaging` varchar(5) DEFAULT NULL,
  `state` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `UQ_traceability_product` (`product`),
  KEY `fk_box_traceability` (`box`),
  KEY `fk_package_traceability` (`package`),
  KEY `fk_packaging_traceability` (`packaging`),
  KEY `fk_state_traceability` (`state`),
  CONSTRAINT `fk_box_traceability` FOREIGN KEY (`box`) REFERENCES `box` (`num`),
  CONSTRAINT `fk_package_traceability` FOREIGN KEY (`package`) REFERENCES `package` (`num`),
  CONSTRAINT `fk_packaging_traceability` FOREIGN KEY (`packaging`) REFERENCES `packaging` (`code`),
  CONSTRAINT `fk_product_traceability` FOREIGN KEY (`product`) REFERENCES `product` (`code`),
  CONSTRAINT `fk_state_traceability` FOREIGN KEY (`state`) REFERENCES `state` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traceability`
--

LOCK TABLES `traceability` WRITE;
/*!40000 ALTER TABLE `traceability` DISABLE KEYS */;
INSERT INTO `traceability` VALUES (1,'S10',1,1,'PK001','ST01'),(2,'P30',2,2,'PK002','ST02'),(3,'X',3,3,'PK003','ST03'),(4,'S23',4,4,'PK004','ST04'),(5,'S24',5,5,'PK005','ST05');
/*!40000 ALTER TABLE `traceability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_of_measure`
--

DROP TABLE IF EXISTS `unit_of_measure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit_of_measure` (
  `code` varchar(5) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_of_measure`
--

LOCK TABLES `unit_of_measure` WRITE;
/*!40000 ALTER TABLE `unit_of_measure` DISABLE KEYS */;
INSERT INTO `unit_of_measure` VALUES ('UOM01','Kilograms'),('UOM02','Liters'),('UOM03','Pieces'),('UOM04','Meters'),('UOM05','Pounds');
/*!40000 ALTER TABLE `unit_of_measure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `num` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `first_surname` varchar(30) NOT NULL,
  `second_surname` varchar(30) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `neighborhood` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `postal_code` int DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `active` bit(1) DEFAULT b'1',
  `user_type` varchar(5) DEFAULT NULL,
  `supervisor` int DEFAULT NULL,
  PRIMARY KEY (`num`),
  UNIQUE KEY `username` (`username`),
  KEY `fk_user_type` (`user_type`),
  KEY `fk_user_supervisor` (`supervisor`),
  CONSTRAINT `fk_user_supervisor` FOREIGN KEY (`supervisor`) REFERENCES `user` (`num`),
  CONSTRAINT `fk_user_type` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin01','adminpass','John','Doe','Smith','1980-05-14','Downtown','Main St',12345,'555-1234','admin01@example.com',_binary '','ADMIN',NULL),(2,'super01','superpass','Jane','Doe',NULL,'1985-07-20','Uptown','Second St',54321,'555-5678','super01@example.com',_binary '','SUPER',1),(3,'emp01','emppass','Alice','Johnson','Brown','1990-03-12','Westside','Third St',23456,'555-9876','alice@example.com',_binary '','EMPLO',2),(4,'emp02','emppass','Bob','Williams',NULL,'1992-11-08','Eastside','Fourth St',65432,'555-6543','bob@example.com',_binary '','EMPLO',2),(5,'emp03','emppass','Charlie','Martinez','Garcia','1995-09-30','Northside','Fifth St',11111,'555-4321','charlie@example.com',_binary '','EMPLO',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_traceability`
--

DROP TABLE IF EXISTS `user_traceability`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_traceability` (
  `user` int NOT NULL,
  `traceability` int NOT NULL,
  PRIMARY KEY (`user`,`traceability`),
  KEY `fk_traceability_user` (`traceability`),
  CONSTRAINT `fk_traceability_user` FOREIGN KEY (`traceability`) REFERENCES `traceability` (`num`),
  CONSTRAINT `fk_user_traceability` FOREIGN KEY (`user`) REFERENCES `user` (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_traceability`
--

LOCK TABLES `user_traceability` WRITE;
/*!40000 ALTER TABLE `user_traceability` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_traceability` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `code` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES ('ADMIN','administrator','User with full access to the system'),('EMPLO','employee','User with limited access to the system'),('SUPER','supervisor','User who oversees other users');
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_box_info`
--

DROP TABLE IF EXISTS `vw_box_info`;
/*!50001 DROP VIEW IF EXISTS `vw_box_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_box_info` AS SELECT 
 1 AS `num`,
 1 AS `height`,
 1 AS `width`,
 1 AS `length`,
 1 AS `volume`,
 1 AS `weight`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_incident_info`
--

DROP TABLE IF EXISTS `vw_incident_info`;
/*!50001 DROP VIEW IF EXISTS `vw_incident_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_incident_info` AS SELECT 
 1 AS `num`,
 1 AS `date`,
 1 AS `description`,
 1 AS `user`,
 1 AS `traceability`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_material_info`
--

DROP TABLE IF EXISTS `vw_material_info`;
/*!50001 DROP VIEW IF EXISTS `vw_material_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_material_info` AS SELECT 
 1 AS `code`,
 1 AS `material_name`,
 1 AS `description`,
 1 AS `available_quantity`,
 1 AS `unit_of_measure`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_outbound_info`
--

DROP TABLE IF EXISTS `vw_outbound_info`;
/*!50001 DROP VIEW IF EXISTS `vw_outbound_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_outbound_info` AS SELECT 
 1 AS `num`,
 1 AS `date`,
 1 AS `exit_quantity`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_package_info`
--

DROP TABLE IF EXISTS `vw_package_info`;
/*!50001 DROP VIEW IF EXISTS `vw_package_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_package_info` AS SELECT 
 1 AS `num`,
 1 AS `product_quantity`,
 1 AS `weight`,
 1 AS `product`,
 1 AS `packaging`,
 1 AS `box`,
 1 AS `tag`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_packaging_info`
--

DROP TABLE IF EXISTS `vw_packaging_info`;
/*!50001 DROP VIEW IF EXISTS `vw_packaging_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_packaging_info` AS SELECT 
 1 AS `code`,
 1 AS `height`,
 1 AS `width`,
 1 AS `length`,
 1 AS `package_quantity`,
 1 AS `zone`,
 1 AS `outbound`,
 1 AS `tag`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_packaging_protocol_info`
--

DROP TABLE IF EXISTS `vw_packaging_protocol_info`;
/*!50001 DROP VIEW IF EXISTS `vw_packaging_protocol_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_packaging_protocol_info` AS SELECT 
 1 AS `num`,
 1 AS `name`,
 1 AS `file_name`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_product_info`
--

DROP TABLE IF EXISTS `vw_product_info`;
/*!50001 DROP VIEW IF EXISTS `vw_product_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_product_info` AS SELECT 
 1 AS `code`,
 1 AS `name`,
 1 AS `description`,
 1 AS `height`,
 1 AS `width`,
 1 AS `length`,
 1 AS `weight`,
 1 AS `packaging_protocol`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_supervisor`
--

DROP TABLE IF EXISTS `vw_supervisor`;
/*!50001 DROP VIEW IF EXISTS `vw_supervisor`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_supervisor` AS SELECT 
 1 AS `num`,
 1 AS `username`,
 1 AS `full_name`,
 1 AS `date_of_birth`,
 1 AS `neighborhood`,
 1 AS `street`,
 1 AS `postal_code`,
 1 AS `phone`,
 1 AS `email`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_tag_info`
--

DROP TABLE IF EXISTS `vw_tag_info`;
/*!50001 DROP VIEW IF EXISTS `vw_tag_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_tag_info` AS SELECT 
 1 AS `num`,
 1 AS `date`,
 1 AS `barcode`,
 1 AS `tag_type`,
 1 AS `destination`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_traceability_info`
--

DROP TABLE IF EXISTS `vw_traceability_info`;
/*!50001 DROP VIEW IF EXISTS `vw_traceability_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_traceability_info` AS SELECT 
 1 AS `num`,
 1 AS `product`,
 1 AS `box`,
 1 AS `package`,
 1 AS `packaging`,
 1 AS `state`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_info`
--

DROP TABLE IF EXISTS `vw_user_info`;
/*!50001 DROP VIEW IF EXISTS `vw_user_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_info` AS SELECT 
 1 AS `num`,
 1 AS `username`,
 1 AS `password`,
 1 AS `active`,
 1 AS `user_type`,
 1 AS `supervisor`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_user_personal_info`
--

DROP TABLE IF EXISTS `vw_user_personal_info`;
/*!50001 DROP VIEW IF EXISTS `vw_user_personal_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_user_personal_info` AS SELECT 
 1 AS `num`,
 1 AS `full_name`,
 1 AS `date_of_birth`,
 1 AS `neighborhood`,
 1 AS `street`,
 1 AS `postal_code`,
 1 AS `phone`,
 1 AS `email`,
 1 AS `user`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `vw_zone_info`
--

DROP TABLE IF EXISTS `vw_zone_info`;
/*!50001 DROP VIEW IF EXISTS `vw_zone_info`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vw_zone_info` AS SELECT 
 1 AS `code`,
 1 AS `area`,
 1 AS `available_capacity`,
 1 AS `total_capacity`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zone` (
  `code` varchar(5) NOT NULL,
  `area` varchar(50) NOT NULL,
  `available_capacity` int DEFAULT NULL,
  `total_capacity` int DEFAULT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `area` (`area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone`
--

LOCK TABLES `zone` WRITE;
/*!40000 ALTER TABLE `zone` DISABLE KEYS */;
INSERT INTO `zone` VALUES ('Z001','Warehouse A',50,100),('Z002','Warehouse B',75,150),('Z003','Section C',30,80),('Z004','Section D',60,120),('Z005','Overflow Area',10,50);
/*!40000 ALTER TABLE `zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `vw_box_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_box_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_box_info` AS select `box`.`num` AS `num`,`box`.`height` AS `height`,`box`.`width` AS `width`,`box`.`length` AS `length`,`box`.`volume` AS `volume`,`box`.`weight` AS `weight` from `box` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_incident_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_incident_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_incident_info` AS select `incident`.`num` AS `num`,`incident`.`date` AS `date`,`incident`.`description` AS `description`,`incident`.`user` AS `user`,`incident`.`traceability` AS `traceability` from `incident` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_material_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_material_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_material_info` AS select `material`.`code` AS `code`,`material`.`material_name` AS `material_name`,`material`.`description` AS `description`,`material`.`available_quantity` AS `available_quantity`,`material`.`unit_of_measure` AS `unit_of_measure` from `material` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_outbound_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_outbound_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_outbound_info` AS select `outbound`.`num` AS `num`,`outbound`.`date` AS `date`,`outbound`.`exit_quantity` AS `exit_quantity` from `outbound` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_package_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_package_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_package_info` AS select `package`.`num` AS `num`,`package`.`product_quantity` AS `product_quantity`,`package`.`weight` AS `weight`,`package`.`product` AS `product`,`package`.`packaging` AS `packaging`,`package`.`box` AS `box`,`package`.`tag` AS `tag` from `package` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_packaging_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_packaging_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_packaging_info` AS select `packaging`.`code` AS `code`,`packaging`.`height` AS `height`,`packaging`.`width` AS `width`,`packaging`.`length` AS `length`,`packaging`.`package_quantity` AS `package_quantity`,`packaging`.`zone` AS `zone`,`packaging`.`outbound` AS `outbound`,`packaging`.`tag` AS `tag` from `packaging` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_packaging_protocol_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_packaging_protocol_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_packaging_protocol_info` AS select `packaging_protocol`.`num` AS `num`,`packaging_protocol`.`name` AS `name`,`packaging_protocol`.`file_name` AS `file_name` from `packaging_protocol` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_product_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_product_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_product_info` AS select `product`.`code` AS `code`,`product`.`name` AS `name`,`product`.`description` AS `description`,`product`.`height` AS `height`,`product`.`width` AS `width`,`product`.`length` AS `length`,`product`.`weight` AS `weight`,`product`.`packaging_protocol` AS `packaging_protocol` from `product` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_supervisor`
--

/*!50001 DROP VIEW IF EXISTS `vw_supervisor`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_supervisor` AS select `user`.`num` AS `num`,`user`.`username` AS `username`,concat(`user`.`name`,' ',`user`.`first_surname`,ifnull(concat(' ',`user`.`second_surname`),'')) AS `full_name`,date_format(`user`.`date_of_birth`,'%M/%d/%y') AS `date_of_birth`,`user`.`neighborhood` AS `neighborhood`,`user`.`street` AS `street`,`user`.`postal_code` AS `postal_code`,`user`.`phone` AS `phone`,`user`.`email` AS `email` from `user` where ((`user`.`supervisor` is null) and (`user`.`user_type` <> 'admin')) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_tag_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_tag_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_tag_info` AS select `tag`.`num` AS `num`,`tag`.`date` AS `date`,`tag`.`barcode` AS `barcode`,`tag`.`tag_type` AS `tag_type`,`tag`.`destination` AS `destination` from `tag` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_traceability_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_traceability_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_traceability_info` AS select `traceability`.`num` AS `num`,`traceability`.`product` AS `product`,`traceability`.`box` AS `box`,`traceability`.`package` AS `package`,`traceability`.`packaging` AS `packaging`,`traceability`.`state` AS `state` from `traceability` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_info` AS select `u`.`num` AS `num`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`active` AS `active`,`u`.`user_type` AS `user_type`,`u`.`supervisor` AS `supervisor` from `user` `u` where (`u`.`active` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_user_personal_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_user_personal_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_user_personal_info` AS select `u`.`num` AS `num`,concat(`u`.`name`,' ',`u`.`first_surname`,ifnull(concat(' ',`u`.`second_surname`),'')) AS `full_name`,date_format(`u`.`date_of_birth`,'%M/%d/%y') AS `date_of_birth`,`u`.`neighborhood` AS `neighborhood`,`u`.`street` AS `street`,`u`.`postal_code` AS `postal_code`,`u`.`phone` AS `phone`,`u`.`email` AS `email`,(select `user_type`.`name` from `user_type` where (`user_type`.`code` = `u`.`user_type`)) AS `user` from `user` `u` where (`u`.`active` = 1) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `vw_zone_info`
--

/*!50001 DROP VIEW IF EXISTS `vw_zone_info`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_zone_info` AS select `zone`.`code` AS `code`,`zone`.`area` AS `area`,`zone`.`available_capacity` AS `available_capacity`,`zone`.`total_capacity` AS `total_capacity` from `zone` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-16 15:48:02
