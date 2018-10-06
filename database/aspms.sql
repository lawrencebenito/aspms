-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema db_aspms
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema db_aspms
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `db_aspms` DEFAULT CHARACTER SET utf8 ;
USE `db_aspms` ;

-- -----------------------------------------------------
-- Table `db_aspms`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`client` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `last_name` VARCHAR(20) NOT NULL COMMENT 'Benito',
  `first_name` VARCHAR(20) NOT NULL COMMENT 'Lawrence John',
  `middle_name` VARCHAR(20) NULL COMMENT 'Pano',
  `company_name` VARCHAR(40) NULL COMMENT 'Globe Telecom Inc.',
  `contact_num` VARCHAR(13) NOT NULL COMMENT '09497580056',
  `email_address` VARCHAR(45) NULL COMMENT 'lawrencejohn.benito@gmail.com',
  `address_line` TEXT(45) NOT NULL COMMENT 'B1 L19 Golden Mile, San Isidro',
  `address_municipality` VARCHAR(45) NOT NULL COMMENT 'Cainta',
  `address_province` VARCHAR(45) NOT NULL COMMENT 'Rizal',
  `active` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 - active | 0 - inactive',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 23:14:08',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unique_name` (`last_name` ASC, `first_name` ASC, `middle_name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table contains information about the clients of the system.';


-- -----------------------------------------------------
-- Table `db_aspms`.`employee`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`employee` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `last_name` VARCHAR(20) NOT NULL COMMENT 'Benito',
  `first_name` VARCHAR(20) NOT NULL COMMENT 'Lawrence John',
  `middle_name` VARCHAR(20) NOT NULL COMMENT 'Pano',
  `contact_number` VARCHAR(13) NOT NULL COMMENT '09497580056',
  `email_address` VARCHAR(45) NOT NULL COMMENT 'lawrencejohn.benito@gmail.com',
  `address` TEXT NOT NULL COMMENT 'Cainta, Rizal',
  `active` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 - active | 0 - inactive',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unique_name` (`last_name` ASC, `first_name` ASC, `middle_name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table contains all the information of a employee or a person in the system';


-- -----------------------------------------------------
-- Table `db_aspms`.`fabric_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`fabric_type` (
  `id` INT(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'Cotton',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unique_name` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Categorical Table. This table holds all the used types of fabric for the system like Cotton, Twill, Satin, Leather or etc. The user may add new type of fabric.';


-- -----------------------------------------------------
-- Table `db_aspms`.`garment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`garment` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'T-shirt',
  `active` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1 - active | 0 - inactive',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unq_garment` (`name` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table holds basic information of a base garment like T-shirts, Shorts, Pajama, etc. ';


-- -----------------------------------------------------
-- Table `db_aspms`.`operation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`operation` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'Leg Bias',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_unq` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table holds basic information of a certain operation, like O.E, Attach Garter, Leg Bias, Fold-Hem, etc.';


-- -----------------------------------------------------
-- Table `db_aspms`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`order` (
  `id` INT(4) ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'ORD20180001',
  `date_ordered` DATE NOT NULL COMMENT '2018-06-26',
  `client` INT(11) NOT NULL COMMENT '7',
  `po_number` VARCHAR(45) NOT NULL COMMENT 'PO2018-005 (From Client)',
  `payment_terms` VARCHAR(45) NOT NULL COMMENT '30 Days',
  `remarks` TEXT NULL COMMENT 'Special Request, Shipping Address, Delivery Conditions, Etc.',
  `status` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_client_idx` (`client` ASC),
  UNIQUE INDEX `unq_client_date` (`date_ordered` ASC, `client` ASC),
  CONSTRAINT `fk_client_order`
    FOREIGN KEY (`client`)
    REFERENCES `db_aspms`.`client` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table contains information about the order of the clients to the company.';


-- -----------------------------------------------------
-- Table `db_aspms`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`payment` (
  `id` INT(4) ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '0457',
  `order` INT(4) ZEROFILL NOT NULL COMMENT '0001',
  `date_received` DATE NOT NULL COMMENT '2018-07-04',
  `payment_mode` VARCHAR(45) NOT NULL COMMENT 'Cash',
  `reference_num` VARCHAR(45) NULL DEFAULT NULL COMMENT 'N/A',
  `amount_received` DOUBLE NOT NULL COMMENT '2500',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_payment_order_idx` (`order` ASC),
  CONSTRAINT `fk_payment_order`
    FOREIGN KEY (`order`)
    REFERENCES `db_aspms`.`order` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table will contain information about the payment collection per order.';


-- -----------------------------------------------------
-- Table `db_aspms`.`fabric_pattern`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`fabric_pattern` (
  `id` INT(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'Plain',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Category Table. Contains the possible pattern of fabric used. Ex. Plain, Horizontal Stripe, Vertical Stripe, Printed, Abstart, Gradient, etc...';


-- -----------------------------------------------------
-- Table `db_aspms`.`fabric`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`fabric` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `type` INT(3) NOT NULL COMMENT '1',
  `supplier_name` VARCHAR(45) NOT NULL COMMENT 'D.C.E. Fabrics Corp.',
  `reference_num` VARCHAR(45) NOT NULL COMMENT '(From Supplier) SW29102',
  `color` VARCHAR(45) NOT NULL COMMENT 'White',
  `fabrication` VARCHAR(45) NOT NULL COMMENT '80% Cotton, 20% Linen',
  `gsm` INT(3) NOT NULL COMMENT '220',
  `width` INT NOT NULL COMMENT '48 (in inches)',
  `pattern` INT(3) NOT NULL COMMENT '1',
  PRIMARY KEY (`id`),
  INDEX `fk_fabric_type_idx` (`type` ASC),
  INDEX `fk_pattern_idx` (`pattern` ASC),
  CONSTRAINT `fk_fabric_type`
    FOREIGN KEY (`type`)
    REFERENCES `db_aspms`.`fabric_type` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pattern`
    FOREIGN KEY (`pattern`)
    REFERENCES `db_aspms`.`fabric_pattern` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Maintenance Table. Contains most of the information of fabric that will be used for the system.';


-- -----------------------------------------------------
-- Table `db_aspms`.`product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`product` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1\n',
  `style_number` VARCHAR(45) NOT NULL COMMENT 'S328103',
  `garment` INT(5) NOT NULL COMMENT '3',
  `client` INT(5) NOT NULL COMMENT '1',
  `main_fabrication` INT(5) NOT NULL COMMENT '1',
  `description` TEXT NULL COMMENT 'ex. IBITS Shirt',
  `min_range` TINYINT(1) NOT NULL COMMENT '2 (XS)',
  `max_range` TINYINT(1) NOT NULL COMMENT '6 (XL)',
  `consumption_size` TINYINT(1) NOT NULL COMMENT '4 (M)',
  `total_price` DOUBLE NOT NULL COMMENT '350.00',
  PRIMARY KEY (`id`),
  INDEX `fk_garmet_idx` (`garment` ASC),
  INDEX `fk_fabric_prod_idx` (`main_fabrication` ASC),
  CONSTRAINT `fk_fabric_prod`
    FOREIGN KEY (`main_fabrication`)
    REFERENCES `db_aspms`.`fabric` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_garment_prod`
    FOREIGN KEY (`garment`)
    REFERENCES `db_aspms`.`garment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table will hold information about the product to be sold and will be placed in quotation, purchase order, or etc.';


-- -----------------------------------------------------
-- Table `db_aspms`.`order_product`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`order_product` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `order` INT(4) ZEROFILL NOT NULL COMMENT 'ORD20180001',
  `product` INT(5) NOT NULL COMMENT '9',
  `size` VARCHAR(10) NOT NULL COMMENT 'FS, XS, S, M, L, XL, XXL, XXL',
  `quantity` INT(11) NOT NULL COMMENT '500',
  `excess` INT(5) NULL COMMENT 'excess qtyt for production, null if no excess',
  PRIMARY KEY (`id`),
  INDEX `fk_product_idx` (`product` ASC),
  UNIQUE INDEX `unq_ordered_product` (`order` ASC, `product` ASC, `size` ASC),
  CONSTRAINT `fk_order`
    FOREIGN KEY (`order`)
    REFERENCES `db_aspms`.`order` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product`
    FOREIGN KEY (`product`)
    REFERENCES `db_aspms`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table contains the list of ordered products with its quantity, size and excess for production';


-- -----------------------------------------------------
-- Table `db_aspms`.`product_operation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`product_operation` (
  `product` INT(5) NOT NULL COMMENT '1',
  `operation` INT(5) NOT NULL COMMENT '4',
  `rate` DOUBLE NOT NULL COMMENT '0.50',
  PRIMARY KEY (`product`, `operation`),
  INDEX `fk_operation_po_idx` (`operation` ASC),
  CONSTRAINT `fk_operation_po`
    FOREIGN KEY (`operation`)
    REFERENCES `db_aspms`.`operation` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_product_po`
    FOREIGN KEY (`product`)
    REFERENCES `db_aspms`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table connects operations needed for a certain product/garment.';


-- -----------------------------------------------------
-- Table `db_aspms`.`work_assignment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`work_assignment` (
  `id` INT(5) NOT NULL COMMENT '1',
  `order` INT(4) ZEROFILL NOT NULL COMMENT 'ORD20180001',
  `employee` INT(5) NOT NULL COMMENT '5',
  `operation` INT(5) NOT NULL COMMENT '6',
  `quantity` INT(5) NOT NULL COMMENT '500',
  `due_date` DATE NOT NULL COMMENT '2018-07-04',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_order_wo_idx` (`order` ASC),
  INDEX `fk_employee_wo_idx` (`employee` ASC),
  INDEX `fk_operation_wo_idx` (`operation` ASC),
  CONSTRAINT `fk_employee_wo`
    FOREIGN KEY (`employee`)
    REFERENCES `db_aspms`.`employee` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_operation_wo`
    FOREIGN KEY (`operation`)
    REFERENCES `db_aspms`.`operation` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_order_wo`
    FOREIGN KEY (`order`)
    REFERENCES `db_aspms`.`order` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Transaction Table. This table contains the assigned task(operation) with quantity of a order for a certan worker.';


-- -----------------------------------------------------
-- Table `db_aspms`.`production_log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`production_log` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '1',
  `assignment` INT(11) NOT NULL COMMENT '8',
  `quantity` INT(5) NOT NULL COMMENT '200',
  `status` TINYINT(2) NOT NULL DEFAULT '2' COMMENT '2',
  `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '2018-06-25 23:14:08',
  `date_modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '2018-07-19 20:00:00',
  PRIMARY KEY (`id`),
  INDEX `fk_assignment_pl_idx` (`assignment` ASC),
  CONSTRAINT `fk_assignment_pl`
    FOREIGN KEY (`assignment`)
    REFERENCES `db_aspms`.`work_assignment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Transaction Table. This table will contains all the log of the employee for task(operation) they did.';


-- -----------------------------------------------------
-- Table `db_aspms`.`quotation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`quotation` (
  `id` INT(4) ZEROFILL NOT NULL AUTO_INCREMENT COMMENT '1',
  `client` INT(5) NOT NULL COMMENT '4',
  `date_created` DATE NOT NULL COMMENT '2018-06-25',
  `product_count` INT(2) NOT NULL COMMENT '3 (Number of products in the quotation)',
  PRIMARY KEY (`id`),
  INDEX `fk_client_quo_idx` (`client` ASC),
  CONSTRAINT `fk_client_quo`
    FOREIGN KEY (`client`)
    REFERENCES `db_aspms`.`client` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table connects operations needed for a certain product/garment.';


-- -----------------------------------------------------
-- Table `db_aspms`.`segment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`segment` (
  `id` INT(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'Body',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC))
ENGINE = InnoDB
COMMENT = 'Maintenance Table. Contains the segmen(parts/components of a garment) Ex. Body, Sleeves, Collar, Neck Rib, Cuff Rib, Add-on Design, etc';


-- -----------------------------------------------------
-- Table `db_aspms`.`fabric_price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`fabric_price` (
  `fabric` INT(5) NOT NULL COMMENT '1',
  `date_effective` DATE NOT NULL COMMENT '2018-09-01',
  `unit_price` DOUBLE NOT NULL COMMENT '100',
  `measurement_type` TINYINT(1) NOT NULL COMMENT '0 - per kgs | 1 - per yards',
  PRIMARY KEY (`fabric`, `date_effective`),
  CONSTRAINT `fk_fp_fabric`
    FOREIGN KEY (`fabric`)
    REFERENCES `db_aspms`.`fabric` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Maintenance Table. Contains records with history of prices per fabric.';


-- -----------------------------------------------------
-- Table `db_aspms`.`product_fabric`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`product_fabric` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '1',
  `product` INT(5) NOT NULL COMMENT '1',
  `segment` INT(3) NOT NULL COMMENT '1',
  `fabric` INT(5) NOT NULL COMMENT '1',
  `length` FLOAT NOT NULL COMMENT '100 (in inches)',
  `width` FLOAT NOT NULL COMMENT '28 (in inches)',
  `allowance` INT NOT NULL COMMENT '10 (percentage)',
  PRIMARY KEY (`id`),
  INDEX `fk_pf_product_idx` (`product` ASC),
  INDEX `fk_pf_segment_idx` (`segment` ASC),
  INDEX `fk_pf_fabric_idx` (`fabric` ASC),
  CONSTRAINT `fk_pf_product`
    FOREIGN KEY (`product`)
    REFERENCES `db_aspms`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pf_segment`
    FOREIGN KEY (`segment`)
    REFERENCES `db_aspms`.`segment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pf_fabric`
    FOREIGN KEY (`fabric`)
    REFERENCES `db_aspms`.`fabric` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'This table will hold the needed fabric/s consumed by the product with, segment as its category, length, witdth, and allowance need for computation. ';


-- -----------------------------------------------------
-- Table `db_aspms`.`garment_segment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`garment_segment` (
  `garment` INT(5) NOT NULL COMMENT '1',
  `segment` INT(3) NOT NULL COMMENT '1',
  PRIMARY KEY (`garment`, `segment`),
  INDEX `fk_gs_segment_idx` (`segment` ASC),
  CONSTRAINT `fk_gs_garment`
    FOREIGN KEY (`garment`)
    REFERENCES `db_aspms`.`garment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_gs_segment`
    FOREIGN KEY (`segment`)
    REFERENCES `db_aspms`.`segment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table connects all the required segment per garment.';


-- -----------------------------------------------------
-- Table `db_aspms`.`garment_operation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`garment_operation` (
  `garment` INT(5) NOT NULL COMMENT '1',
  `operation` INT(5) NOT NULL COMMENT '1',
  `rate` DOUBLE NOT NULL COMMENT '2.00',
  PRIMARY KEY (`garment`, `operation`),
  INDEX `fk_go_operation_idx` (`operation` ASC),
  CONSTRAINT `fk_go_garment`
    FOREIGN KEY (`garment`)
    REFERENCES `db_aspms`.`garment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_go_operation`
    FOREIGN KEY (`operation`)
    REFERENCES `db_aspms`.`operation` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'Maintenance Table. This table connects all the required operations per garment.';


-- -----------------------------------------------------
-- Table `db_aspms`.`accessory_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`accessory_type` (
  `id` INT(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'Button',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unique_name` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Categorical Table. This table holds all possible types of accessory like button, zipper, string, lining.';


-- -----------------------------------------------------
-- Table `db_aspms`.`accessory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`accessory` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `accessory_type` INT(3) NOT NULL COMMENT '1',
  `description` VARCHAR(225) NULL COMMENT '(optional) butons with 3 holes.',
  `color` VARCHAR(45) NOT NULL COMMENT 'transparent white',
  `supplier` VARCHAR(45) NOT NULL,
  `reference_num` VARCHAR(45) NOT NULL COMMENT '(from supplier) RF91823',
  PRIMARY KEY (`id`),
  INDEX `fk_accessory_idx` (`accessory_type` ASC),
  CONSTRAINT `fk_accessory`
    FOREIGN KEY (`accessory_type`)
    REFERENCES `db_aspms`.`accessory_type` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Maintenance Table. Contains information of accessories for products';


-- -----------------------------------------------------
-- Table `db_aspms`.`accessory_price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`accessory_price` (
  `accesory` INT(5) NOT NULL COMMENT '1',
  `date_effective` DATE NOT NULL COMMENT '2018-09-01',
  `price` DOUBLE NOT NULL COMMENT '100',
  `measurement_type` TINYINT(1) NOT NULL COMMENT '0 - per pack/bundle | 1 - per rolls',
  `quantity` DOUBLE NOT NULL COMMENT '80',
  `unit_price` DOUBLE NOT NULL COMMENT 'price/quantity = unit_price',
  PRIMARY KEY (`accesory`, `date_effective`),
  CONSTRAINT `fk_ap_accessories`
    FOREIGN KEY (`accesory`)
    REFERENCES `db_aspms`.`accessory` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Maintenance Table. Contains records with history of prices per accesories.';


-- -----------------------------------------------------
-- Table `db_aspms`.`product_accessory`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`product_accessory` (
  `id` INT NOT NULL AUTO_INCREMENT COMMENT '1',
  `product` INT(5) NOT NULL COMMENT '1',
  `accessory` INT(5) NOT NULL COMMENT '1',
  `quantity` INT NOT NULL COMMENT '100 (in inches or piece)',
  PRIMARY KEY (`id`),
  INDEX `fk_pf_product_idx` (`product` ASC),
  INDEX `fk_pa_accessory_idx` (`accessory` ASC),
  CONSTRAINT `fk_pa_product`
    FOREIGN KEY (`product`)
    REFERENCES `db_aspms`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pa_accessory`
    FOREIGN KEY (`accessory`)
    REFERENCES `db_aspms`.`accessory` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'This table will hold the needed accessories of the product. quantity will vary by inches or by pieces';


-- -----------------------------------------------------
-- Table `db_aspms`.`design_type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`design_type` (
  `id` INT(3) NOT NULL AUTO_INCREMENT COMMENT '1',
  `name` VARCHAR(45) NOT NULL COMMENT 'Embroidery',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `unique_name` (`name` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Categorical Table. This table holds all possible types of design like Embroidery, Silk Screen, Hot Press, Reburrized, Textile and etc.';


-- -----------------------------------------------------
-- Table `db_aspms`.`design`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`design` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `design_type` INT(3) NOT NULL COMMENT '1',
  `supplier` VARCHAR(45) NOT NULL,
  `category_size` TINYINT(1) NOT NULL COMMENT '0 - Small| 1- Medium | 2- Large',
  `size_range` VARCHAR(45) NOT NULL COMMENT '(user input) 1 sq.in - 4 sq.in',
  `color_count` TINYINT(2) NOT NULL COMMENT '2',
  PRIMARY KEY (`id`),
  INDEX `fk_design_idx` (`design_type` ASC),
  CONSTRAINT `fk_design_type`
    FOREIGN KEY (`design_type`)
    REFERENCES `db_aspms`.`design_type` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Maintenance Table. This table will contain the base price of the design for the system.';


-- -----------------------------------------------------
-- Table `db_aspms`.`product_design`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`product_design` (
  `id` INT(5) NOT NULL AUTO_INCREMENT COMMENT '1',
  `product` INT(5) NOT NULL COMMENT '1',
  `design` INT(5) NOT NULL COMMENT '1',
  `actual size` VARCHAR(45) NOT NULL COMMENT '12 inches x 10 inches',
  `location` VARCHAR(45) NULL COMMENT '10 inches from neckline',
  `sample_image` TEXT NULL COMMENT 'C:/Users/Pictures/design.jpg',
  PRIMARY KEY (`id`),
  INDEX `fk_pd_product_idx` (`product` ASC),
  INDEX `fk_pd_design_idx` (`design` ASC),
  CONSTRAINT `fk_pd_product`
    FOREIGN KEY (`product`)
    REFERENCES `db_aspms`.`product` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_pd_design`
    FOREIGN KEY (`design`)
    REFERENCES `db_aspms`.`design` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'This table will contain the add-on design of the product like logo, design print and etc.';


-- -----------------------------------------------------
-- Table `db_aspms`.`garment_fabric`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`garment_fabric` (
  `garment` INT(5) NOT NULL COMMENT '1',
  `fabric` INT(3) NOT NULL COMMENT '1',
  PRIMARY KEY (`garment`, `fabric`),
  INDEX `fk_gf_fabric_idx` (`fabric` ASC),
  CONSTRAINT `fk_gf_garment`
    FOREIGN KEY (`garment`)
    REFERENCES `db_aspms`.`garment` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_gf_fabric`
    FOREIGN KEY (`fabric`)
    REFERENCES `db_aspms`.`fabric_type` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = utf8
COMMENT = 'This table will serve as the connection of garment types to fabric types. It list down all possible fabric types for that garment, Ex. Garment(T-shirt) will only have possible fabric type of Cotton, Polyester, Linen etc. This will prevent user to connect Demin or Leather to T-Shirt';


-- -----------------------------------------------------
-- Table `db_aspms`.`design_price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `db_aspms`.`design_price` (
  `design` INT(5) NOT NULL COMMENT '1',
  `date_effective` DATE NOT NULL COMMENT '2018-09-01',
  `unit_price` DOUBLE NOT NULL COMMENT '100',
  PRIMARY KEY (`design`, `date_effective`),
  CONSTRAINT `fk_dp_design`
    FOREIGN KEY (`design`)
    REFERENCES `db_aspms`.`design` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
COMMENT = 'Maintenance Table. Contains records with history of prices per fabric.';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `db_aspms`.`fabric_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_aspms`;
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (1, 'Cotton');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (2, 'Silk');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (3, 'Linen');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (4, 'Wool');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (5, 'Denim');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (6, 'Leather');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (7, 'Polyester');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (8, 'Nylon');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (9, 'Spandex');
INSERT INTO `db_aspms`.`fabric_type` (`id`, `name`) VALUES (10, 'Vinyl');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_aspms`.`operation`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_aspms`;
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (1, 'Cutting');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (2, 'O.E. (Operation Edging)');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (3, 'Attach Garter');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (4, 'Leg Bias');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (5, 'Dapa Garter');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (6, 'Tucking');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (7, 'O.E. - Shoulder');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (8, 'O.E. - Side Close');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (9, 'Bias Neck And Arm Hole');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (10, 'Hem Leg');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (11, 'O.E. - Sleeve');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (12, 'Fold - Hem');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (13, 'Fold - Sleve');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (14, 'Bias Neck');
INSERT INTO `db_aspms`.`operation` (`id`, `name`) VALUES (15, 'O.E. - Crotch Side Close');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_aspms`.`fabric_pattern`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_aspms`;
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (1, 'Plain');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (2, 'Stripe (Vertical)');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (3, 'Stripe (Horizontal)');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (4, 'Diagonal Stripes');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (5, 'Checkered');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (6, 'Printed');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (7, 'Gradient');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (8, 'Floral');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (9, 'Chevron');
INSERT INTO `db_aspms`.`fabric_pattern` (`id`, `name`) VALUES (10, 'Geometric');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_aspms`.`segment`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_aspms`;
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (1, 'Front');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (2, 'Front Left');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (3, 'Front Right');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (4, 'Back');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (5, 'Back Left');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (6, 'Back Right');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (7, 'Front Yoke');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (8, 'Back Yoke');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (9, 'Sleeves');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (10, 'Right Sleeve');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (11, 'Left Sleeve');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (12, 'Collar');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (13, 'Collar Rib');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (14, 'Cuff Rib');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (15, 'Bottom Rib');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (16, 'Waist Band');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (17, 'Pocket');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (18, 'Pocket Bag');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (19, 'Secret Pocket');
INSERT INTO `db_aspms`.`segment` (`id`, `name`) VALUES (20, 'Zipper Ply');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_aspms`.`accessory_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_aspms`;
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (1, 'Button');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (2, 'Zipper');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (3, 'Chord');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (4, 'Cuff');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (5, 'Collar');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (6, 'Cotton Tape');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (7, 'String');
INSERT INTO `db_aspms`.`accessory_type` (`id`, `name`) VALUES (8, 'Garter');

COMMIT;


-- -----------------------------------------------------
-- Data for table `db_aspms`.`design_type`
-- -----------------------------------------------------
START TRANSACTION;
USE `db_aspms`;
INSERT INTO `db_aspms`.`design_type` (`id`, `name`) VALUES (DEFAULT, 'Embroidery');
INSERT INTO `db_aspms`.`design_type` (`id`, `name`) VALUES (DEFAULT, 'Screen Printing');
INSERT INTO `db_aspms`.`design_type` (`id`, `name`) VALUES (DEFAULT, 'Heat Press');
INSERT INTO `db_aspms`.`design_type` (`id`, `name`) VALUES (DEFAULT, 'Vinyl');
INSERT INTO `db_aspms`.`design_type` (`id`, `name`) VALUES (DEFAULT, 'Patch');
INSERT INTO `db_aspms`.`design_type` (`id`, `name`) VALUES (DEFAULT, 'Label');

COMMIT;

