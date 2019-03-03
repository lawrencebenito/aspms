-- MySQL dump 10.13  Distrib 5.7.25, for Win64 (x86_64)
--
-- Host: localhost    Database: db_aspms
-- ------------------------------------------------------
-- Server version	5.7.25-log

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
-- Table structure for table `accessory`
--

DROP TABLE IF EXISTS `accessory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `accessory_type` int(3) NOT NULL COMMENT '1',
  `description` varchar(225) DEFAULT NULL COMMENT '(optional) butons with 3 holes.',
  `color` varchar(45) NOT NULL COMMENT 'transparent white',
  `supplier` varchar(45) NOT NULL COMMENT 'MCU Fabrics Corp.',
  `reference_num` varchar(45) NOT NULL COMMENT '(from supplier) RF91823',
  PRIMARY KEY (`id`),
  KEY `fk_accessory_idx` (`accessory_type`),
  CONSTRAINT `fk_accessory` FOREIGN KEY (`accessory_type`) REFERENCES `accessory_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. Contains information of accessories for products';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessory`
--

LOCK TABLES `accessory` WRITE;
/*!40000 ALTER TABLE `accessory` DISABLE KEYS */;
INSERT INTO `accessory` VALUES (1,4,NULL,'Black','Collar and Cuffs','873924'),(2,8,'2 inch width','White','BHG Accessories','903826'),(3,2,'Small, 5 inch length','Blue','BGH Accessories','73921BYH'),(4,5,'3 inch width','Black','YTF Accessories','ZX2893M'),(6,1,'3 Holes','Transparent White','DC Accessories','MN8392FG');
/*!40000 ALTER TABLE `accessory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accessory_price`
--

DROP TABLE IF EXISTS `accessory_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory_price` (
  `accesory` int(5) NOT NULL COMMENT '1',
  `date_effective` date NOT NULL COMMENT '2018-09-01',
  `price` double NOT NULL COMMENT '100',
  `measurement_type` tinyint(1) NOT NULL COMMENT '0 - per pack/bundle | 1 - per rolls',
  `quantity` double NOT NULL COMMENT '80',
  `unit_price` double NOT NULL COMMENT 'price/quantity = unit_price',
  PRIMARY KEY (`accesory`,`date_effective`),
  CONSTRAINT `fk_ap_accessories` FOREIGN KEY (`accesory`) REFERENCES `accessory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. Contains records with history of prices per accesories.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessory_price`
--

LOCK TABLES `accessory_price` WRITE;
/*!40000 ALTER TABLE `accessory_price` DISABLE KEYS */;
INSERT INTO `accessory_price` VALUES (1,'2018-10-11',15,2,1,15),(2,'2018-10-11',100,0,5,20),(3,'2018-10-11',5,2,1,5),(4,'2018-10-11',10,2,1,10),(6,'2018-10-11',90,1,144,0.63);
/*!40000 ALTER TABLE `accessory_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accessory_type`
--

DROP TABLE IF EXISTS `accessory_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'Button',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='Categorical Table. This table holds all possible types of accessory like button, zipper, string, lining.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessory_type`
--

LOCK TABLES `accessory_type` WRITE;
/*!40000 ALTER TABLE `accessory_type` DISABLE KEYS */;
INSERT INTO `accessory_type` VALUES (9,'Beads'),(1,'Button'),(3,'Chord'),(5,'Collar'),(6,'Cotton Tape'),(4,'Cuff'),(8,'Garter'),(7,'String'),(2,'Zipper');
/*!40000 ALTER TABLE `accessory_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `last_name` varchar(20) NOT NULL COMMENT 'Benito',
  `first_name` varchar(20) NOT NULL COMMENT 'Lawrence John',
  `middle_name` varchar(20) DEFAULT NULL COMMENT 'Pano',
  `company_name` varchar(60) DEFAULT NULL COMMENT 'Globe Telecom Inc.',
  `contact_num` varchar(13) NOT NULL COMMENT '09497580056',
  `email_address` varchar(45) DEFAULT NULL COMMENT 'lawrencejohn.benito@gmail.com',
  `address_line` tinytext NOT NULL COMMENT 'B1 L19 Golden Mile, San Isidro',
  `address_municipality` varchar(45) NOT NULL COMMENT 'Cainta',
  `address_province` varchar(45) NOT NULL COMMENT 'Rizal',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - active | 0 - inactive',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 23:14:08',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`last_name`,`first_name`,`middle_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. This table contains information about the clients of the system.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Benito','Lawrence John','Pano','Smart Communications Inc.','09497580056','lawrencejohn.benito@gmail.com','B1 L19 Brescia St.','Cainta','Rizal',1,'2018-10-13 23:59:33','2019-02-07 23:52:44'),(2,'Nayre','Rachel',NULL,'Polytechnic University of the Philippines','09830182393','rachel.nayre@gmail.com','A. Mabini (Main) Campus, Sta. Mesa','Manila','Metro Manila',1,'2018-10-15 08:39:27','2019-02-07 23:51:44'),(3,'Mirandilla','Geniela',NULL,NULL,'0926858683','magenielamirandilla@gmail.com','34 Pureza Ext, Sta. Mesa','Manila','Metro Manila',1,'2019-02-03 20:14:34','2019-02-03 20:14:34'),(4,'Inovero','Carlo',NULL,'College of Computer and Information Sciences','0935927032','carlo.inovero@gmail.com','25 Teresa St., Sta. Mesa','Manila','Metro Manila',1,'2019-02-09 15:10:35','2019-02-09 15:10:35');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `design`
--

DROP TABLE IF EXISTS `design`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `design` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `design_type` int(3) NOT NULL COMMENT '1',
  `supplier` varchar(45) NOT NULL COMMENT 'ABC Printing Co.',
  `category_size` tinyint(1) NOT NULL COMMENT '0 - Small| 1- Medium | 2- Large',
  `size_range` varchar(45) NOT NULL COMMENT '(user input) 1 sq.in - 4 sq.in',
  `color_count` tinyint(2) NOT NULL COMMENT '2',
  PRIMARY KEY (`id`),
  KEY `fk_design_idx` (`design_type`),
  CONSTRAINT `fk_design_type` FOREIGN KEY (`design_type`) REFERENCES `design_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. This table will contain the base price of the design for the system.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `design`
--

LOCK TABLES `design` WRITE;
/*!40000 ALTER TABLE `design` DISABLE KEYS */;
INSERT INTO `design` VALUES (1,1,'FGH Embroderies',0,'1x1 upto 3x3',1),(2,1,'FGH Embroderies',0,'1x1 upto 3x3',2),(3,3,'WDV Printing',0,'1 sq.in - 3 sq.in',1),(4,2,'JKL Printing',0,'1 sq.in - 4 sq.in',1);
/*!40000 ALTER TABLE `design` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `design_price`
--

DROP TABLE IF EXISTS `design_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `design_price` (
  `design` int(5) NOT NULL COMMENT '1',
  `date_effective` date NOT NULL COMMENT '2018-09-01',
  `unit_price` double NOT NULL COMMENT '100',
  PRIMARY KEY (`design`,`date_effective`),
  CONSTRAINT `fk_dp_design` FOREIGN KEY (`design`) REFERENCES `design` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. Contains records with history of prices per fabric.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `design_price`
--

LOCK TABLES `design_price` WRITE;
/*!40000 ALTER TABLE `design_price` DISABLE KEYS */;
INSERT INTO `design_price` VALUES (1,'2018-10-11',20),(2,'2018-10-11',30),(3,'2018-10-11',20),(4,'2018-10-11',25);
/*!40000 ALTER TABLE `design_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `design_type`
--

DROP TABLE IF EXISTS `design_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `design_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'Embroidery',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Categorical Table. This table holds all possible types of design like Embroidery, Silk Screen, Hot Press, Reburrized, Textile and etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `design_type`
--

LOCK TABLES `design_type` WRITE;
/*!40000 ALTER TABLE `design_type` DISABLE KEYS */;
INSERT INTO `design_type` VALUES (1,'Embroidery'),(3,'Heat Press'),(6,'Label'),(5,'Patch'),(2,'Screen Printing'),(4,'Vinyl');
/*!40000 ALTER TABLE `design_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `last_name` varchar(20) NOT NULL COMMENT 'Benito',
  `first_name` varchar(20) NOT NULL COMMENT 'Lawrence John',
  `middle_name` varchar(20) NOT NULL COMMENT 'Pano',
  `contact_number` varchar(13) NOT NULL COMMENT '09497580056',
  `email_address` varchar(45) NOT NULL COMMENT 'lawrencejohn.benito@gmail.com',
  `address` text NOT NULL COMMENT 'Cainta, Rizal',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - active | 0 - inactive',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`last_name`,`first_name`,`middle_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. This table contains all the information of a employee or a person in the system';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Kent','Clark',' ','09563051376','superman@gmail.com','Pasig City',1,'2019-01-07 22:30:44','2019-03-03 23:23:05');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabric`
--

DROP TABLE IF EXISTS `fabric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fabric` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `type` int(3) NOT NULL COMMENT '1',
  `supplier_name` varchar(45) NOT NULL COMMENT 'D.C.E. Fabrics Corp.',
  `reference_num` varchar(45) NOT NULL COMMENT '(From Supplier) SW29102',
  `color` varchar(45) NOT NULL COMMENT 'White',
  `fabrication` varchar(45) NOT NULL COMMENT '80% Cotton, 20% Linen',
  `gsm` int(3) NOT NULL COMMENT '220',
  `width` int(11) NOT NULL COMMENT '48 (in inches)',
  `pattern` int(3) NOT NULL COMMENT '1',
  PRIMARY KEY (`id`),
  KEY `fk_fabric_type_idx` (`type`),
  KEY `fk_pattern_idx` (`pattern`),
  CONSTRAINT `fk_fabric_type` FOREIGN KEY (`type`) REFERENCES `fabric_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pattern` FOREIGN KEY (`pattern`) REFERENCES `fabric_pattern` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. Contains most of the information of fabric that will be used for the system.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabric`
--

LOCK TABLES `fabric` WRITE;
/*!40000 ALTER TABLE `fabric` DISABLE KEYS */;
INSERT INTO `fabric` VALUES (2,11,'MCU Fabrics','NM2832LN','Gray','100% Cotton',220,60,1),(3,1,'DC Fabrics','BH3802MN','White','100% Cotton',220,60,1),(4,11,'MCU Fabrics','MN2993NM','Pink','100% Cotton',220,60,1),(5,11,'MCU Fabrics','MN3928GH','Black','100% Cotton',220,60,1),(6,5,'DC Fabrics','KM2092FV','Blue','100% Cotton',300,70,1),(7,5,'BMC Garments and Fabrics Corp','2918MNKM','Dark Blue','100% Cotton',300,60,1),(8,1,'Alibaba\'s Fabrics','2018MN3902','White and Red','80% Cotton 20% Polyester',220,60,3),(9,1,'YGF Fabrics','298103098','Blue and White','100% Cotton',280,70,5),(10,1,'Hermes Fabrics Corp','3281039MN','Army Design','80% Cotton 20% Polyester',190,70,6),(11,7,'HGK Fabrics','298302BHN','Red, Blue, White','100% Polyester',190,50,8),(12,1,'MCU Fabrics','GH39820MN','Black','100% Cotton',220,60,1);
/*!40000 ALTER TABLE `fabric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabric_pattern`
--

DROP TABLE IF EXISTS `fabric_pattern`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fabric_pattern` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'Plain',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Category Table. Contains the possible pattern of fabric used. Ex. Plain, Horizontal Stripe, Vertical Stripe, Printed, Abstart, Gradient, etc...';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabric_pattern`
--

LOCK TABLES `fabric_pattern` WRITE;
/*!40000 ALTER TABLE `fabric_pattern` DISABLE KEYS */;
INSERT INTO `fabric_pattern` VALUES (5,'Checkered'),(9,'Chevron'),(4,'Diagonal Stripes'),(8,'Floral'),(10,'Geometric'),(7,'Gradient'),(1,'Plain'),(6,'Printed'),(3,'Stripe (Horizontal)'),(2,'Stripe (Vertical)');
/*!40000 ALTER TABLE `fabric_pattern` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabric_price`
--

DROP TABLE IF EXISTS `fabric_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fabric_price` (
  `fabric` int(5) NOT NULL COMMENT '1',
  `date_effective` date NOT NULL COMMENT '2018-09-01',
  `unit_price` double NOT NULL COMMENT '100',
  `measurement_type` tinyint(1) NOT NULL COMMENT '0 - per kgs | 1 - per yards',
  PRIMARY KEY (`fabric`,`date_effective`),
  CONSTRAINT `fk_fp_fabric` FOREIGN KEY (`fabric`) REFERENCES `fabric` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. Contains records with history of prices per fabric.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabric_price`
--

LOCK TABLES `fabric_price` WRITE;
/*!40000 ALTER TABLE `fabric_price` DISABLE KEYS */;
INSERT INTO `fabric_price` VALUES (2,'2018-10-09',200,0),(3,'2018-10-10',290,0),(4,'2018-10-12',300,0),(5,'2018-10-12',300,0),(6,'2018-10-12',400,0),(7,'2018-10-12',420,0),(8,'2018-10-12',320,0),(9,'2018-10-12',70,1),(10,'2018-10-12',80,1),(11,'2018-07-01',63,1),(11,'2018-09-30',65,1),(11,'2018-10-12',70,1),(12,'2018-10-14',300,0);
/*!40000 ALTER TABLE `fabric_price` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabric_type`
--

DROP TABLE IF EXISTS `fabric_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fabric_type` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'Cotton',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Categorical Table. This table holds all the used types of fabric for the system like Cotton, Twill, Satin, Leather or etc. The user may add new type of fabric.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabric_type`
--

LOCK TABLES `fabric_type` WRITE;
/*!40000 ALTER TABLE `fabric_type` DISABLE KEYS */;
INSERT INTO `fabric_type` VALUES (1,'Cotton'),(5,'Denim'),(6,'Leather'),(3,'Linen'),(8,'Nylon'),(11,'Pique'),(7,'Polyester'),(2,'Silk'),(9,'Spandex'),(10,'Vinyl'),(4,'Wool');
/*!40000 ALTER TABLE `fabric_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garment`
--

DROP TABLE IF EXISTS `garment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `garment` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'T-shirt',
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - active | 0 - inactive',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_garment` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. This table holds basic information of a base garment like T-shirts, Shorts, Pajama, etc. ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garment`
--

LOCK TABLES `garment` WRITE;
/*!40000 ALTER TABLE `garment` DISABLE KEYS */;
INSERT INTO `garment` VALUES (1,'T-Shirt (Round Neck)',1,'2018-10-09 16:15:41','2018-10-09 16:15:41'),(2,'Polo Shirt',1,'2018-10-09 16:16:17','2018-10-09 16:16:17'),(3,'T-Shirt (V-Neck)',1,'2018-10-09 16:17:31','2018-10-09 16:17:31');
/*!40000 ALTER TABLE `garment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `garment_fabric`
--

DROP TABLE IF EXISTS `garment_fabric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `garment_fabric` (
  `garment` int(5) NOT NULL COMMENT '1',
  `fabric` int(3) NOT NULL COMMENT '1',
  PRIMARY KEY (`garment`,`fabric`),
  KEY `fk_gf_fabric_idx` (`fabric`),
  CONSTRAINT `fk_gf_fabric` FOREIGN KEY (`fabric`) REFERENCES `fabric_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_gf_garment` FOREIGN KEY (`garment`) REFERENCES `garment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table will serve as the connection of garment types to fabric types. It list down all possible fabric types for that garment, Ex. Garment(T-shirt) will only have possible fabric type of Cotton, Polyester, Linen etc. This will prevent user to connect Demin or Leather to T-Shirt';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `garment_fabric`
--

LOCK TABLES `garment_fabric` WRITE;
/*!40000 ALTER TABLE `garment_fabric` DISABLE KEYS */;
INSERT INTO `garment_fabric` VALUES (1,1),(2,1),(3,1),(1,3),(1,7),(2,7),(3,7),(1,11),(2,11),(3,11);
/*!40000 ALTER TABLE `garment_fabric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operation`
--

DROP TABLE IF EXISTS `operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operation` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'Leg Bias',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unq` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. This table holds basic information of a certain operation, like O.E, Attach Garter, Leg Bias, Fold-Hem, etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operation`
--

LOCK TABLES `operation` WRITE;
/*!40000 ALTER TABLE `operation` DISABLE KEYS */;
INSERT INTO `operation` VALUES (3,'Attach Garter'),(14,'Bias Neck'),(9,'Bias Neck And Arm Hole'),(1,'Cutting'),(5,'Dapa Garter'),(12,'Fold - Hem'),(13,'Fold - Sleve'),(10,'Hem Leg'),(4,'Leg Bias'),(2,'O.E. (Operation Edging)'),(15,'O.E. - Crotch Side Close'),(7,'O.E. - Shoulder'),(8,'O.E. - Side Close'),(11,'O.E. - Sleeve'),(6,'Tucking');
/*!40000 ALTER TABLE `operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'ORD20180001',
  `date_ordered` date NOT NULL COMMENT '2018-06-26',
  `client` int(11) NOT NULL COMMENT '7',
  `po_number` varchar(45) NOT NULL COMMENT 'PO2018-005 (From Client)',
  `payment_terms` varchar(45) NOT NULL COMMENT '30 Days',
  `remarks` text COMMENT 'Special Request, Shipping Address, Delivery Conditions, Etc.',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_client_date` (`date_ordered`,`client`),
  KEY `fk_client_idx` (`client`),
  CONSTRAINT `fk_client_order` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='This table contains information about the order of the clients to the company.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (0003,'2019-02-09',2,'PO12345','50-50',NULL,1,'2019-02-09 00:10:02','2019-02-09 00:10:02'),(0004,'2019-02-09',3,'PO098763','Fullpayment',NULL,1,'2019-02-09 00:15:46','2019-02-09 00:15:46'),(0005,'2019-02-09',1,'PO09123-2019-01-01','50-50',NULL,1,'2019-02-09 16:11:44','2019-02-09 16:11:44');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_product` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `order` int(4) unsigned zerofill NOT NULL COMMENT 'ORD20180001',
  `product` int(5) NOT NULL COMMENT '9',
  `size` varchar(10) NOT NULL COMMENT 'FS, XS, S, M, L, XL, XXL, XXL',
  `quantity` int(11) NOT NULL COMMENT '500',
  `excess` int(5) DEFAULT NULL COMMENT 'excess qtyt for production, null if no excess',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_ordered_product` (`order`,`product`,`size`),
  KEY `fk_product_idx` (`product`),
  CONSTRAINT `fk_order` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='This table contains the list of ordered products with its quantity, size and excess for production';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_product`
--

LOCK TABLES `order_product` WRITE;
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` VALUES (1,0003,18,'M',200,NULL),(2,0004,21,'M',150,NULL),(3,0004,21,'S',100,NULL),(4,0004,21,'L',100,NULL),(5,0004,21,'XL',100,NULL),(6,0005,20,'M',100,NULL),(7,0005,22,'M',100,NULL);
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '0457',
  `order` int(4) unsigned zerofill NOT NULL COMMENT '0001',
  `date_received` date NOT NULL COMMENT '2018-07-04',
  `payment_mode` varchar(45) NOT NULL COMMENT 'Cash',
  `reference_num` varchar(45) DEFAULT NULL COMMENT 'N/A',
  `amount_received` double NOT NULL COMMENT '2500',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_payment_order_idx` (`order`),
  CONSTRAINT `fk_payment_order` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table will contain information about the payment collection per order.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `style_number` varchar(45) DEFAULT NULL COMMENT 'S328103',
  `date_created` date NOT NULL COMMENT '2018-09-30',
  `garment` int(5) NOT NULL COMMENT '3',
  `client` int(5) NOT NULL COMMENT '1',
  `description` text COMMENT 'ex. IBITS Shirt',
  `min_range` tinyint(1) NOT NULL COMMENT '2 (XS)',
  `max_range` tinyint(1) NOT NULL COMMENT '6 (XL)',
  `consumption_size` tinyint(1) NOT NULL COMMENT '4 (M)',
  `markup` double NOT NULL,
  `total_price` double NOT NULL COMMENT '350.00',
  PRIMARY KEY (`id`),
  KEY `fk_garmet_idx` (`garment`),
  KEY `fk_product_client_idx` (`client`),
  CONSTRAINT `fk_product_client` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_garment_type` FOREIGN KEY (`garment`) REFERENCES `garment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. This table will hold information about the product to be sold and will be placed in quotation, purchase order, or etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (18,'SN20190018','2019-01-25',2,2,'iBITS Shirt',2,6,4,20,135.97),(20,'SN20190020','2019-01-25',3,1,'Plain Casual Shirt',2,6,4,20,82.9),(21,'SN20190021','2019-02-03',1,3,'Plain Shirt w/ Logo',2,6,4,20,77.98),(22,'SN20190022','2019-02-06',1,1,NULL,2,6,4,30,108.13);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_accessory`
--

DROP TABLE IF EXISTS `product_accessory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_accessory` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1',
  `product` int(5) NOT NULL COMMENT '1',
  `accessory` int(5) NOT NULL COMMENT '1',
  `quantity` int(11) NOT NULL COMMENT '100 (in inches or piece)',
  PRIMARY KEY (`id`),
  KEY `fk_pf_product_idx` (`product`),
  KEY `fk_pa_accessory_idx` (`accessory`),
  CONSTRAINT `fk_pa_accessory` FOREIGN KEY (`accessory`) REFERENCES `accessory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pa_product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='This table will hold the needed accessories of the product. quantity will vary by inches or by pieces';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_accessory`
--

LOCK TABLES `product_accessory` WRITE;
/*!40000 ALTER TABLE `product_accessory` DISABLE KEYS */;
INSERT INTO `product_accessory` VALUES (8,18,4,1),(9,18,6,3),(10,18,1,2),(12,20,1,2);
/*!40000 ALTER TABLE `product_accessory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_design`
--

DROP TABLE IF EXISTS `product_design`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_design` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `product` int(5) NOT NULL COMMENT '1',
  `design` int(5) NOT NULL COMMENT '1',
  `actual_size` varchar(45) DEFAULT NULL COMMENT '12 inches x 10 inches',
  `location` varchar(45) DEFAULT NULL COMMENT '10 inches from neckline',
  `sample_image` text COMMENT 'C:/Users/Pictures/design.jpg',
  PRIMARY KEY (`id`),
  KEY `fk_pd_product_idx` (`product`),
  KEY `fk_pd_design_idx` (`design`),
  CONSTRAINT `fk_pd_design` FOREIGN KEY (`design`) REFERENCES `design` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pd_product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='This table will contain the add-on design of the product like logo, design print and etc.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_design`
--

LOCK TABLES `product_design` WRITE;
/*!40000 ALTER TABLE `product_design` DISABLE KEYS */;
INSERT INTO `product_design` VALUES (3,18,4,'3 x 3','Front Right Chest',NULL),(4,21,4,'3 x 3 inches','Right Chest',NULL),(5,22,1,'2 x 2 in','Top Right Chest',NULL);
/*!40000 ALTER TABLE `product_design` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_fabric`
--

DROP TABLE IF EXISTS `product_fabric`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_fabric` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1',
  `product` int(5) NOT NULL COMMENT '1',
  `segment` int(3) NOT NULL COMMENT '1',
  `fabric` int(5) NOT NULL COMMENT '1',
  `length` float NOT NULL COMMENT '100 (in inches)',
  `width` float NOT NULL COMMENT '28 (in inches)',
  `is_pair` tinyint(1) NOT NULL COMMENT '0 - False | 1 - True',
  `allowance` int(11) NOT NULL COMMENT '10 (percentage)',
  PRIMARY KEY (`id`),
  KEY `fk_pf_product_idx` (`product`),
  KEY `fk_pf_segment_idx` (`segment`),
  KEY `fk_pf_fabric_idx` (`fabric`),
  CONSTRAINT `fk_pf_fabric` FOREIGN KEY (`fabric`) REFERENCES `fabric` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pf_product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pf_segment` FOREIGN KEY (`segment`) REFERENCES `segment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='This table will hold the needed fabric/s consumed by the product with, segment as its category, length, witdth, and allowance need for computation. ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_fabric`
--

LOCK TABLES `product_fabric` WRITE;
/*!40000 ALTER TABLE `product_fabric` DISABLE KEYS */;
INSERT INTO `product_fabric` VALUES (15,18,21,2,50,30,1,5),(16,18,21,4,50,20,1,5),(17,18,9,2,20,20,1,5),(20,20,21,12,50,40,1,5),(21,20,9,12,20,15,1,5),(22,21,21,12,50,40,1,5),(23,21,9,12,20,15,1,5),(24,22,21,3,66,53,1,5),(25,22,9,3,35,22,1,5);
/*!40000 ALTER TABLE `product_fabric` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_operation`
--

DROP TABLE IF EXISTS `product_operation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_operation` (
  `product` int(5) NOT NULL COMMENT '1',
  `operation` int(5) NOT NULL COMMENT '4',
  `rate` double NOT NULL COMMENT '0.50',
  PRIMARY KEY (`product`,`operation`),
  KEY `fk_operation_po_idx` (`operation`),
  CONSTRAINT `fk_operation_po` FOREIGN KEY (`operation`) REFERENCES `operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_po` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table connects operations needed for a certain product/garment.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_operation`
--

LOCK TABLES `product_operation` WRITE;
/*!40000 ALTER TABLE `product_operation` DISABLE KEYS */;
INSERT INTO `product_operation` VALUES (18,1,10),(18,2,2),(18,9,3),(20,1,5),(20,2,1.2),(20,14,1),(21,1,5),(21,7,0.8),(21,8,1),(21,9,0.8),(21,11,0.5),(22,1,6);
/*!40000 ALTER TABLE `product_operation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `production_log`
--

DROP TABLE IF EXISTS `production_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `production_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '1',
  `assignment` int(11) NOT NULL COMMENT '8',
  `quantity` int(5) NOT NULL COMMENT '200',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '2',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_assignment_pl_idx` (`assignment`),
  CONSTRAINT `fk_assignment_pl` FOREIGN KEY (`assignment`) REFERENCES `work_assignment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Transaction Table. This table will contains all the log of the employee for task(operation) they did.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `production_log`
--

LOCK TABLES `production_log` WRITE;
/*!40000 ALTER TABLE `production_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `production_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation`
--

DROP TABLE IF EXISTS `quotation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotation` (
  `id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT '0001',
  `client` int(5) NOT NULL COMMENT '4',
  `date_created` date NOT NULL COMMENT '2018-06-25',
  `product_count` int(2) NOT NULL COMMENT '3 (Number of products in the quotation)',
  PRIMARY KEY (`id`),
  KEY `fk_client_quo_idx` (`client`),
  CONSTRAINT `fk_client_quo` FOREIGN KEY (`client`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='This table connects operations needed for a certain product/garment.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation`
--

LOCK TABLES `quotation` WRITE;
/*!40000 ALTER TABLE `quotation` DISABLE KEYS */;
INSERT INTO `quotation` VALUES (0006,2,'2019-02-04',1),(0007,1,'2019-02-04',1),(0008,3,'2019-02-04',1),(0012,1,'2019-02-07',2),(0013,1,'2019-02-09',2);
/*!40000 ALTER TABLE `quotation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotation_product`
--

DROP TABLE IF EXISTS `quotation_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotation_product` (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `quotation` int(4) unsigned zerofill NOT NULL COMMENT '0001',
  `product` int(5) NOT NULL COMMENT '9',
  `price` double NOT NULL COMMENT '100.00',
  `description` text NOT NULL COMMENT 'Product description, fabrics, accessories and/or design',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unq_product` (`product`,`quotation`),
  KEY `fk_qp_product_idx` (`product`),
  KEY `fk_qp_quotation_idx` (`quotation`),
  CONSTRAINT `fk_qp_product` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_qp_quotation` FOREIGN KEY (`quotation`) REFERENCES `quotation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='This table contains the list of products set from the quotation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotation_product`
--

LOCK TABLES `quotation_product` WRITE;
/*!40000 ALTER TABLE `quotation_product` DISABLE KEYS */;
INSERT INTO `quotation_product` VALUES (5,0006,18,135.97,'## Fabrics ##\r\n> Body - Gray Plain Pique (NM2832LN)\r\n> Body - Pink Plain Pique (MN2993NM)\r\n> Sleeves - Gray Plain Pique (NM2832LN)\r\n\r\n## Accessories ##\r\n> Black Collar \r\n> Transparent White Button \r\n> Black Cuff \r\n\r\n## Designs ##\r\n> Screen Printing - 3 x 3 - Front Right Chest'),(6,0007,20,82.9,'## Fabrics ##\r\n> Body - Black Plain Cotton (GH39820MN)\r\n> Sleeves - Black Plain Cotton (GH39820MN)\r\n\r\n## Accessories ##\r\n> Black Cuff'),(7,0008,21,77.98,'## Fabrics ##\r\n> Body - Black Plain Cotton (GH39820MN)\r\n> Sleeves - Black Plain Cotton (GH39820MN)\r\n\r\n## Designs ##\r\n> Screen Printing - 3 x 3 inches - Right Chest'),(11,0012,22,108.13,'## Fabrics ##\r\n> Body - White Plain Cotton (BH3802MN)\r\n> Sleeves - White Plain Cotton (BH3802MN)\r\n\r\n## Designs ##\r\n> Embroidery - 2 x 2 in - Top Right Chest'),(12,0012,20,82.9,'## Fabrics ##\r\n> Body - Black Plain Cotton (GH39820MN)\r\n> Sleeves - Black Plain Cotton (GH39820MN)\r\n\r\n## Accessories ##\r\n> Black Cuff'),(13,0013,22,108.13,'## Fabrics ##\r\n> Body - White Plain Cotton (BH3802MN)\r\n> Sleeves - White Plain Cotton (BH3802MN)\r\n\r\n## Designs ##\r\n> Embroidery - 2 x 2 in - Top Right Chest'),(14,0013,20,82.9,'## Fabrics ##\r\n> Body - Black Plain Cotton (GH39820MN)\r\n> Sleeves - Black Plain Cotton (GH39820MN)\r\n\r\n## Accessories ##\r\n> Black Cuff');
/*!40000 ALTER TABLE `quotation_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `segment`
--

DROP TABLE IF EXISTS `segment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `segment` (
  `id` int(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` varchar(45) NOT NULL COMMENT 'Body',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='Maintenance Table. Contains the segmen(parts/components of a garment) Ex. Body, Sleeves, Collar, Neck Rib, Cuff Rib, Add-on Design, etc';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `segment`
--

LOCK TABLES `segment` WRITE;
/*!40000 ALTER TABLE `segment` DISABLE KEYS */;
INSERT INTO `segment` VALUES (4,'Back'),(5,'Back Left'),(6,'Back Right'),(8,'Back Yoke'),(21,'Body'),(15,'Bottom Rib'),(12,'Collar'),(13,'Collar Rib'),(14,'Cuff Rib'),(1,'Front'),(2,'Front Left'),(3,'Front Right'),(7,'Front Yoke'),(11,'Left Sleeve'),(17,'Pocket'),(18,'Pocket Bag'),(10,'Right Sleeve'),(19,'Secret Pocket'),(9,'Sleeves'),(16,'Waist Band'),(20,'Zipper Ply');
/*!40000 ALTER TABLE `segment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work_assignment`
--

DROP TABLE IF EXISTS `work_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work_assignment` (
  `id` int(5) NOT NULL COMMENT '1',
  `order` int(4) unsigned zerofill NOT NULL COMMENT 'ORD20180001',
  `employee` int(5) NOT NULL COMMENT '5',
  `operation` int(5) NOT NULL COMMENT '6',
  `quantity` int(5) NOT NULL COMMENT '500',
  `due_date` date NOT NULL COMMENT '2018-07-04',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_order_wo_idx` (`order`),
  KEY `fk_employee_wo_idx` (`employee`),
  KEY `fk_operation_wo_idx` (`operation`),
  CONSTRAINT `fk_employee_wo` FOREIGN KEY (`employee`) REFERENCES `employee` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_operation_wo` FOREIGN KEY (`operation`) REFERENCES `operation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_order_wo` FOREIGN KEY (`order`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Transaction Table. This table contains the assigned task(operation) with quantity of a order for a certan worker.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_assignment`
--

LOCK TABLES `work_assignment` WRITE;
/*!40000 ALTER TABLE `work_assignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `work_assignment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-04  0:45:41
