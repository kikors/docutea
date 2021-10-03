-- --------------------------------------------------------
-- Host:                         imprimia.es
-- Versión del servidor:         5.6.38 - MySQL Community Server (GPL)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             9.4.0.5168
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura para tabla imprimia_test.care_pack_profit
CREATE TABLE IF NOT EXISTS `care_pack_profit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.care_pack_profit: ~4 rows (aproximadamente)
DELETE FROM `care_pack_profit`;
/*!40000 ALTER TABLE `care_pack_profit` DISABLE KEYS */;
INSERT INTO `care_pack_profit` (`id`, `duration`, `profit`) VALUES
	(1, '12', '60'),
	(2, '24', '40'),
	(3, '36', '20'),
	(4, '48', '0');
/*!40000 ALTER TABLE `care_pack_profit` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.chroma_type
CREATE TABLE IF NOT EXISTS `chroma_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.chroma_type: ~2 rows (aproximadamente)
DELETE FROM `chroma_type`;
/*!40000 ALTER TABLE `chroma_type` DISABLE KEYS */;
INSERT INTO `chroma_type` (`id`, `description`, `default_value`) VALUES
	(1, 'Color', 0),
	(2, 'Blanco y Negro', 1);
/*!40000 ALTER TABLE `chroma_type` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.contract_time
CREATE TABLE IF NOT EXISTS `contract_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `durationInMonths` int(11) NOT NULL,
  `default` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.contract_time: ~4 rows (aproximadamente)
DELETE FROM `contract_time`;
/*!40000 ALTER TABLE `contract_time` DISABLE KEYS */;
INSERT INTO `contract_time` (`id`, `durationInMonths`, `default`) VALUES
	(1, 12, 0),
	(2, 24, 0),
	(3, 36, 0),
	(4, 48, 1);
/*!40000 ALTER TABLE `contract_time` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cif` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `directions` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.customer: ~0 rows (aproximadamente)
DELETE FROM `customer`;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.drum
CREATE TABLE IF NOT EXISTS `drum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_id` int(11) DEFAULT NULL,
  `capacity_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `page_volume` int(11) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `aditional_info` longtext COLLATE utf8_unicode_ci,
  `recom_volume` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A33E93207ADA1FB5` (`color_id`),
  KEY `IDX_A33E932066B6F0BA` (`capacity_id`),
  CONSTRAINT `FK_A33E932066B6F0BA` FOREIGN KEY (`capacity_id`) REFERENCES `toner_capacity` (`id`),
  CONSTRAINT `FK_A33E93207ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `toner_color` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.drum: ~4 rows (aproximadamente)
DELETE FROM `drum`;
/*!40000 ALTER TABLE `drum` DISABLE KEYS */;
INSERT INTO `drum` (`id`, `color_id`, `capacity_id`, `code`, `description`, `price`, `page_volume`, `enabled`, `aditional_info`, `recom_volume`) VALUES
	(3, 1, 2, 'CF358A', 'HP Tambor Negro CF358A (M880zm)', 39.76, 30000, 1, NULL, 30000),
	(4, 2, 2, 'CF359A', 'HP Tambor Cyan CF359A (M880zm)', 117.73, 30000, 1, NULL, 30000),
	(5, 4, 2, 'CF364A', 'HP Tambor Amarillo CF364A (M880zm)', 117.73, 30000, 1, NULL, 30000),
	(6, 3, 2, 'CF365A', 'HP Tambor Magenta CF365A (M880zm)', 117.73, 30000, 1, NULL, 30000);
/*!40000 ALTER TABLE `drum` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.format_type
CREATE TABLE IF NOT EXISTS `format_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.format_type: ~2 rows (aproximadamente)
DELETE FROM `format_type`;
/*!40000 ALTER TABLE `format_type` DISABLE KEYS */;
INSERT INTO `format_type` (`id`, `description`, `default_value`) VALUES
	(1, 'A3', 0),
	(2, 'A4', 1);
/*!40000 ALTER TABLE `format_type` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.functionality_type
CREATE TABLE IF NOT EXISTS `functionality_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.functionality_type: ~2 rows (aproximadamente)
DELETE FROM `functionality_type`;
/*!40000 ALTER TABLE `functionality_type` DISABLE KEYS */;
INSERT INTO `functionality_type` (`id`, `description`, `default_value`) VALUES
	(1, 'Impresora', 1),
	(2, 'Multifunción', 0);
/*!40000 ALTER TABLE `functionality_type` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) DEFAULT NULL,
  `create_at` date NOT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `invoice_year` int(11) NOT NULL,
  `invoice_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `invoice_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_90651744C023F51C` (`sales_order_id`),
  KEY `IDX_90651744F6B75B26` (`machine_id`),
  CONSTRAINT `FK_90651744C023F51C` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_order` (`id`),
  CONSTRAINT `FK_90651744F6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.invoice: ~0 rows (aproximadamente)
DELETE FROM `invoice`;
/*!40000 ALTER TABLE `invoice` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.ker_pack
CREATE TABLE IF NOT EXISTS `ker_pack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maker_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7B1E752968DA5EC3` (`maker_id`),
  CONSTRAINT `FK_7B1E752968DA5EC3` FOREIGN KEY (`maker_id`) REFERENCES `maker` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.ker_pack: ~18 rows (aproximadamente)
DELETE FROM `ker_pack`;
/*!40000 ALTER TABLE `ker_pack` DISABLE KEYS */;
INSERT INTO `ker_pack` (`id`, `maker_id`, `description`, `duration`, `price`) VALUES
	(1, 1, 'HP CarePack U9CQ1E (M501dn)', 48, 79),
	(2, 1, 'HP CarePack U8HQ3E (M605dnm)', 48, 183),
	(3, 1, 'HP CarePack U8CH0E (M533dnm)', 48, 142.79),
	(4, 1, 'HP CarePack U8HK5E (M880zm)', 48, 2032.04),
	(5, 1, 'HP Care Pack U6Z06E (M712)', 48, 511.12),
	(7, 1, 'HP Care Pack U8CH0E (HP M553)', 48, 114),
	(8, 1, 'HP Care Pack U9AB7E (HP PW55250)', 48, 97),
	(9, 1, 'HP CarePack U8HP4E (M651)', 48, 341),
	(10, 1, 'HP CarePack UT990E (CP5225)', 48, 445),
	(11, 1, 'HP CarePack UX899E (M750)', 48, 699),
	(12, 1, 'HP CarePack U9LL8E (P75050)', 48, 450),
	(13, 1, 'HP CarePack U8TR0E (M426)', 48, 130),
	(14, 1, 'HP CarePack U8ZE7E (M527mfp)', 48, 445),
	(15, 1, 'HP CarePack U8HH7E (M725mfp)', 48, 839),
	(16, 1, 'HP CarePack U8HJ6E (M830mfp)', 48, 1616),
	(17, 1, 'HP CarePack U8TP1E (M477mfp)', 48, 142),
	(18, 1, 'HP CarePack U8HL7E (M680mfp)', 48, 961),
	(19, 1, 'HP CarePack U9DA2E (PW E58650)', 48, 459),
	(20, 1, 'HP CarePack U8HG8E (M775mfp)', 48, 1310),
	(21, 1, 'HP Care Pack U9CP0E (HP P57750)', 48, 154.94),
	(22, 1, 'HP Care Pack U9LM8E (P77740)', 48, 1200),
	(23, 1, 'CarePack 0€', 48, 0);
/*!40000 ALTER TABLE `ker_pack` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.machine
CREATE TABLE IF NOT EXISTS `machine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `functionality_id` int(11) DEFAULT NULL,
  `format_id` int(11) DEFAULT NULL,
  `chroma_type_id` int(11) DEFAULT NULL,
  `maker_id` int(11) DEFAULT NULL,
  `technology_id` int(11) DEFAULT NULL,
  `page_range_id` int(11) DEFAULT NULL,
  `cod` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `recom_volume` int(11) DEFAULT NULL,
  `print_speed` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `aditional_info` longtext COLLATE utf8_unicode_ci,
  `price` double NOT NULL,
  `aditional_main_info` longtext COLLATE utf8_unicode_ci,
  `image_front` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_perspective` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `care_pack_id` int(11) DEFAULT NULL,
  `profit` double NOT NULL,
  `instalation_price` double NOT NULL,
  `monitorization_price` double NOT NULL,
  `recomended` tinyint(1) NOT NULL,
  `image_lateral` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `air_print` tinyint(1) DEFAULT NULL,
  `cloud` tinyint(1) DEFAULT NULL,
  `wifi` tinyint(1) DEFAULT NULL,
  `nfc` tinyint(1) DEFAULT NULL,
  `page_profit` double NOT NULL,
  `sheet` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1505DF8439EDDC8` (`functionality_id`),
  KEY `IDX_1505DF84D629F605` (`format_id`),
  KEY `IDX_1505DF84C58D0F33` (`chroma_type_id`),
  KEY `IDX_1505DF8468DA5EC3` (`maker_id`),
  KEY `IDX_1505DF844235D463` (`technology_id`),
  KEY `IDX_1505DF84AA1DD791` (`page_range_id`),
  KEY `IDX_1505DF8459782C22` (`care_pack_id`),
  KEY `IDX_1505DF84DCD6110` (`stock_id`),
  CONSTRAINT `FK_1505DF8439EDDC8` FOREIGN KEY (`functionality_id`) REFERENCES `functionality_type` (`id`),
  CONSTRAINT `FK_1505DF844235D463` FOREIGN KEY (`technology_id`) REFERENCES `technology` (`id`),
  CONSTRAINT `FK_1505DF8459782C22` FOREIGN KEY (`care_pack_id`) REFERENCES `ker_pack` (`id`),
  CONSTRAINT `FK_1505DF8468DA5EC3` FOREIGN KEY (`maker_id`) REFERENCES `maker` (`id`),
  CONSTRAINT `FK_1505DF84AA1DD791` FOREIGN KEY (`page_range_id`) REFERENCES `page_range` (`id`),
  CONSTRAINT `FK_1505DF84C58D0F33` FOREIGN KEY (`chroma_type_id`) REFERENCES `chroma_type` (`id`),
  CONSTRAINT `FK_1505DF84D629F605` FOREIGN KEY (`format_id`) REFERENCES `format_type` (`id`),
  CONSTRAINT `FK_1505DF84DCD6110` FOREIGN KEY (`stock_id`) REFERENCES `stock_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.machine: ~19 rows (aproximadamente)
DELETE FROM `machine`;
/*!40000 ALTER TABLE `machine` DISABLE KEYS */;
INSERT INTO `machine` (`id`, `functionality_id`, `format_id`, `chroma_type_id`, `maker_id`, `technology_id`, `page_range_id`, `cod`, `description`, `recom_volume`, `print_speed`, `enabled`, `aditional_info`, `price`, `aditional_main_info`, `image_front`, `image_perspective`, `care_pack_id`, `profit`, `instalation_price`, `monitorization_price`, `recomended`, `image_lateral`, `air_print`, `cloud`, `wifi`, `nfc`, `page_profit`, `sheet`, `stock_id`) VALUES
	(19, 1, 1, 2, 1, 1, 1, 'CF236A', 'HP LaserJet Enterprise M712dn', 7000, NULL, 1, NULL, 1432.84, NULL, 'M712dn-1.png', NULL, 5, 20, 75, 48, 1, 'M712dn-2.png', 0, 0, 0, 0, 20, NULL, 1),
	(20, 1, 1, 2, 1, 1, 2, 'CF236A', 'HP LaserJet Enterprise M712', 7000, NULL, 1, '<p><strong>Permita la impresi&oacute;n de gran volumen, en blanco y negro, en tama&ntilde;os de</strong></p>\r\n\r\n<p><strong>papel de hasta A3. Controle los </strong><strong>costes con funciones de ahorro de energ&iacute;a y la impresi&oacute;n a doble cara.</strong></p>\r\n\r\n<p><strong>Proteja los datos confidenciales de la empresa y gestione de forma</strong></p>\r\n\r\n<p><strong>centralizada las pol&iacute;ticas de impresi&oacute;n.</strong></p>', 1432.84, NULL, 'M712dn-1.png', NULL, 5, 20, 90, 48, 1, 'M712dn-2.png', 0, 0, 0, 0, 20, NULL, 1),
	(22, 1, 2, 2, 1, 1, 1, 'J8H61A', 'HP Laserjet M501dn', 2500, NULL, 1, '<p>Consiga impresionantes velocidades de impresi&oacute;n y rendimiento en su oficina.</p>\r\n\r\n<p>Esta impresora de ahorro de energ&iacute;a se inicia de forma m&aacute;s r&aacute;pida y ofrece</p>\r\n\r\n<p>funciones de seguridad que ofrecen protecci&oacute;n frente a las amenazas. Los</p>\r\n\r\n<p>cartuchos de t&oacute;ner original HP con JetIntelligence generan m&aacute;s p&aacute;ginas.</p>', 270, NULL, 'M501dn-0.png', 'M501dn-2.png', 1, 20, 90, 48, 0, 'M501dn-1.png', 1, 0, 1, 0, 20, NULL, 1),
	(23, 1, 2, 2, 1, 1, 2, 'L3U53A', 'HP Laserjet M605dn', 10000, NULL, 1, '<p>Acelere los resultados de su empresa con calidad de impresi&oacute;n excepcional.</p>\r\n\r\n<p>Afronte trabajos grandes y equipe a su personal para lograr el &eacute;xito, donde</p>\r\n\r\n<p>sea que lo lleve su negocio. Gestione f&aacute;cilmente y ampl&iacute;e esta impresora</p>\r\n\r\n<p>impresionantemente r&aacute;pida y vers&aacute;til, y ayude a reducir el impacto medioambiental.</p>', 598.69, NULL, 'M605dn-0.png', 'M605dn-2.png', 2, 20, 90, 48, 1, 'M605dn-1.png', 0, 0, 0, 0, 0, NULL, 1),
	(24, 1, 2, 1, 1, 1, 1, 'B5L38A', 'HP LaserJet Managed Color M553dn', 5000, NULL, 1, '<p><strong>Velocidad y color son la pareja perfecta para tu empresa. Es por eso que esta</strong></p>\r\n\r\n<p><strong>impresora est&aacute; dotada de una elevada eficiencia energ&eacute;tica y cartuchos de</strong></p>\r\n\r\n<p><strong>t&oacute;ner originales de HP con JetIntelligence, que se combinan para producir</strong></p>\r\n\r\n<p><strong>vibrantes documentos profesionales justo cuando los necesitas.</strong></p>', 524.11, NULL, 'HPM533dn-1.png', 'HPM533dn-2.png', 7, 20, 90, 48, 1, 'HPM533dn-3.png', 0, 0, 0, 0, 0, NULL, 1),
	(25, 1, 2, 1, 1, 2, 1, 'J6U55B', 'HP Pagewide Managed Color P55250DW', 5000, NULL, 1, '<p><strong>Ideal para equipos de trabajo de peque&ntilde;as y medianas empresas que</strong></p>\r\n\r\n<p><strong>necesitan impresiones de calidad profesional a bajo coste por p&aacute;gina y a gran</strong></p>\r\n\r\n<p><strong>velocidad, con la flexibilidad de la conectividad inal&aacute;mbrica/ m&oacute;vil, acceso a</strong></p>\r\n\r\n<p><strong>pantalla t&aacute;ctil y gesti&oacute;n de la impresora basada en web.</strong></p>', 435.5, NULL, 'P55250DW-1.png', 'P55250DW-3.png', 8, 20, 90, 48, 1, 'P55250DW-2.png', 0, 0, 0, 0, 20, NULL, 1),
	(26, 2, 1, 1, 1, 1, 2, 'L3U51A', 'HP Laserjet Managed Color M880ZM', 20000, NULL, 1, NULL, 3906.93, NULL, 'L3U51A.jpg', NULL, 4, 20, 90, 48, 1, NULL, 0, 0, 0, 0, 0, NULL, 1),
	(31, 1, 2, 1, 1, 1, 2, 'L8Z07A', 'HP LaserJet Managed Color M65dn', 20000, NULL, 1, NULL, 982.22, NULL, 'M651dn-1.png', 'M651dn-3.png', 9, 20, 90, 48, 1, 'M651dn-2.png', 0, 0, 0, 0, 20, NULL, 1),
	(33, 1, 1, 1, 1, 1, 2, 'D3L09A', 'HP Laserjet Enterprise Color M750DN', 15000, NULL, 1, '<p><strong>Imprima grandes vol&uacute;menes de documentos en color de alta calidad en una</strong></p>\r\n\r\n<p><strong>gran variedad de tama&ntilde;os de papel. Mantenga la productividad con</strong></p>\r\n\r\n<p><strong>herramientas intuitivas de gesti&oacute;n f&aacute;ciles de usar. Imprima c&oacute;moda y</strong></p>\r\n\r\n<p><strong>directamente desde PC port&aacute;tiles, smartphones o tablets.</strong></p>', 1945.77, NULL, 'M750-1.png', 'M750-3.png', 11, 20, 90, 48, 1, 'M750-2.png', 0, 0, 0, 0, 20, NULL, 1),
	(37, 1, 1, 1, 1, 1, 1, 'CE712A', 'HP Laserjet Pro Color CP5225dn', 5000, NULL, 1, '<p><strong>Cubra todas sus necesidades de impresi&oacute;n empresarial en color desde</strong></p>\r\n\r\n<p><strong>postales a documentos de gran tama&ntilde;o, con esta impresora A3 de sobremesa</strong></p>\r\n\r\n<p><strong>vers&aacute;til y asequible. Obtenga una calidad de impresi&oacute;n superior con el t&oacute;ner</strong></p>\r\n\r\n<p><strong>HP ColorSphere, velocidades superiores y facilidad de uso con una fiabilidad</strong></p>\r\n\r\n<p><strong>inigualable.</strong></p>', 1076.79, NULL, 'CP5225-10.png', 'CP5225-30.png', 10, 20, 90, 48, 0, 'CP5225-20.png', 0, 0, 0, 0, 20, NULL, 1),
	(38, 1, 1, 1, 1, 2, 1, 'Y3Z47B', 'HP PageWide Managed P75050dw', 20000, NULL, 1, '<p>Cubra todas sus necesidades de impresi&oacute;n empresarial en color desde postales a documentos de gran tama&ntilde;o, con esta impresora A3 de sobremesa vers&aacute;til y asequible. Obtenga una calidad de impresi&oacute;n superior con el t&oacute;ner HP ColorSphere, velocidades superiores y facilidad de uso con una fiabilidad inigualable.</p>', 1579, NULL, 'PW75050-2.png', 'PW75050-3.png', 12, 20, 90, 48, 1, 'PW75050-1.png', 0, 0, 0, 0, 20, NULL, 1),
	(41, 2, 2, 2, 1, 1, 1, 'F6W15A', 'HP Laserjet Pro M426FDW', 4000, NULL, 1, '<p>Rendimiento de impresi&oacute;n, escaneo y copia r&aacute;pidos en un paquete peque&ntilde;o pero robusto. Esta impresora multifuncional termina las tareas clave m&aacute;s r&aacute;pidamente y lo protege contra las amenazas.1 Los cartuchos de t&oacute;ner original HP con JetIntelligence le dan m&aacute;s p&aacute;ginas</p>', 311.93, NULL, 'M426-10.png', 'M426-30.png', 13, 20, 90, 48, 1, 'M426-20.png', 0, 0, 0, 0, 20, NULL, 1),
	(42, 2, 2, 2, 1, 1, 2, 'F2A79A', 'HP Laserjet Managed M527DNM', 7500, NULL, 1, '<p>Acabe los trabajos m&aacute;s r&aacute;pido con una impresora multifuncional que comienza de forma inmediata y ayuda a ahorrar energ&iacute;a.1 La seguridad de dispositivo multinivel ayuda a proteger contra amenazas.2 Los cartuchos de t&oacute;ner original HP con JetIntelligence y esta impresora producen m&aacute;s p&aacute;ginas de gran calidad</p>', 961.42, NULL, 'M527-1.png', 'M527-1.png', 14, 20, 90, 48, 1, 'M527-1.png', 0, 0, 0, 0, 20, NULL, 1),
	(44, 2, 1, 2, 1, 1, 1, 'L3U64A', 'HP LaserJet Managed M725ZM', 20000, NULL, 1, '<p>Habilita la impresi&oacute;n de gran volumen en una gran variedad de tama&ntilde;os de papel: hasta A3 con una capacidad m&aacute;xima para 4.600 hojas. 1 Ofrece la vista previa y edita los trabajos de escaneado; gestiona de forma centralizada las pol&iacute;ticas de impresi&oacute;n; protege la informaci&oacute;n confidencial de la empresa.</p>', 3003.26, NULL, 'M725-3.png', 'M725-3.png', 15, 20, 90, 48, 1, 'M725-3.png', 0, 0, 0, 0, 20, NULL, 1),
	(45, 2, 1, 2, 1, 1, 2, 'L3U65A', 'HP Laserjet Managed M830ZM', 50000, NULL, 1, '<p>Esta potente impresora multifunci&oacute;n impulsa la productividad con opciones de env&iacute;o flexibles, herramientas vers&aacute;tiles para el manejo del papel, escaneo a doble cara y toques de acabado m&aacute;s profesionales, o papeles hasta A3. La impresi&oacute;n m&oacute;vil es sencilla con la impresi&oacute;n directa inal&aacute;mbrica1 y la tecnolog&iacute;a de toque para imprimir2</p>', 5784, NULL, 'M830-1.png', 'M830-3.png', 16, 20, 90, 48, 1, 'M830-2.png', 1, 1, 0, 1, 20, NULL, 1),
	(46, 2, 2, 1, 1, 1, 1, 'CF379A', 'HP Laserjet Pro Color M477FDW', 4000, NULL, 1, '<p>Impresi&oacute;n, escaneo, copia y rendimiento de fax sin comparaci&oacute;n, adem&aacute;s de seguridad s&oacute;lida e integral para su forma de trabajar. Esta impresora multifuncional color termina las tareas clave m&aacute;s r&aacute;pidamente y lo protege contra las amenazas.1 Los cartuchos de t&oacute;ner original HP con JetIntelligence imprimen m&aacute;s p&aacute;ginas</p>', 366.48, NULL, 'M477-1.png', 'M477-1.png', 17, 20, 90, 48, 0, 'M477-1.png', 1, 1, 1, 0, 20, NULL, 1),
	(48, 2, 2, 1, 1, 1, 2, 'L3U47A', 'HP Laserjet Managed Color M680DNM', 20000, NULL, 1, '<p>Afronte trabajos de gran volumen con esta impresora multifunc. color alto rendimiento. Impresi&oacute;n y copia, escaneo y fax1. Car. de escaneo mejoradas y pantalla t&aacute;ctil en color de 20 cm (8 pulgadas) con flujo de trabajo optimizado. Opciones de impr. m&oacute;vil para mantener la produc. en sus viajes2</p>', 2223.29, NULL, 'M680-10.png', 'M680-30.png', 18, 20, 90, 48, 1, 'M680-20.png', 1, 0, 0, 0, 20, NULL, 1),
	(49, 2, 2, 1, 1, 2, 2, 'L3U42A', 'HP Pagewide Managed Color E58650DN', 10000, NULL, 1, '<p>La rentabilidad definitiva para las empresas de hoy en d&iacute;a; la tecnolog&iacute;a HP PageWide ofrece las velocidades m&aacute;s r&aacute;pidas1 y la m&aacute;xima seguridad2 con el menor coste total de propiedad de su categor&iacute;a.3 Potencie la productividad con funciones de flujo de trabajo uniformes.</p>', 1248, NULL, 'E58650-1.png', 'E58650-1.png', 19, 20, 90, 48, 1, 'E58650-1.png', 0, 0, 0, 0, 20, NULL, 1),
	(51, 2, 1, 1, 1, 1, 1, 'L3U49A', 'HP Laserjet Managed Color M775FM', 15000, NULL, 1, '<p>Permite la impresi&oacute;n profesional de gran volumen en color en tama&ntilde;os de papel de hasta A3, con una capacidad de hasta 4350 hojas2. Obtener una vista previa y editar trabajos de escaneado. Gestionar de forma centralizada las pol&iacute;ticas de impresi&oacute;n. Proteger informaci&oacute;n confidencial de la empresa.</p>', 2693, NULL, 'M775-10.png', 'M775-20.png', 20, 20, 90, 48, 0, 'M775-20.png', 0, 0, 0, 0, 20, NULL, 1),
	(52, 2, 2, 1, 1, 2, 1, 'J9V82B', 'HP Pagewide Managed P57750DW', 5000, NULL, 1, '<p><strong>Ideal para equipos de trabajo de peque&ntilde;as y medianas empresas que</strong></p>\r\n\r\n<p><strong>necesitan impresiones de calidad profesional a bajo coste por p&aacute;gina y a gran</strong></p>\r\n\r\n<p><strong>velocidad, con la flexibilidad de la conectividad inal&aacute;mbrica/ m&oacute;vil,</strong></p>\r\n\r\n<p><strong>capacidades de copiado/ escaneado/ fax y gesti&oacute;n de la impresora basada en</strong></p>\r\n\r\n<p><strong>web.</strong></p>', 375, NULL, 'P57750-2.png', 'P57750-3.png', 23, 20, 90, 48, 1, 'P57750-1.png', 0, 0, 0, 0, 20, NULL, 1),
	(53, 2, 1, 1, 1, 2, 1, 'Y3Z57B', 'HP PageWide Managed P77740dn', 20000, NULL, 1, '<p>Los negocios se mueven r&aacute;pido y una ralentizaci&oacute;n implicar&iacute;a quedarse atr&aacute;s. HP ha creado la pr&oacute;xima generaci&oacute;n de HP PageWide Pro para potenciar la productividad con una impresora multifunci&oacute;n eficiente e inteligente que ofrece el menor coste por p&aacute;gina en color2, el m&aacute;ximo tiempo de funcionamiento y una gran seguridad.</p>', 1300, NULL, 'P77740-1.png', 'P77740-3.png', 22, 20, 90, 48, 1, 'P77740-2.png', 0, 0, 0, 0, 20, NULL, 1);
/*!40000 ALTER TABLE `machine` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.machine_drum
CREATE TABLE IF NOT EXISTS `machine_drum` (
  `machine_id` int(11) NOT NULL,
  `drum_id` int(11) NOT NULL,
  PRIMARY KEY (`machine_id`,`drum_id`),
  KEY `IDX_F5347859F6B75B26` (`machine_id`),
  KEY `IDX_F5347859C5014701` (`drum_id`),
  CONSTRAINT `FK_F5347859C5014701` FOREIGN KEY (`drum_id`) REFERENCES `drum` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F5347859F6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.machine_drum: ~4 rows (aproximadamente)
DELETE FROM `machine_drum`;
/*!40000 ALTER TABLE `machine_drum` DISABLE KEYS */;
INSERT INTO `machine_drum` (`machine_id`, `drum_id`) VALUES
	(26, 3),
	(26, 4),
	(26, 5),
	(26, 6);
/*!40000 ALTER TABLE `machine_drum` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.machine_part
CREATE TABLE IF NOT EXISTS `machine_part` (
  `machine_id` int(11) NOT NULL,
  `part_id` int(11) NOT NULL,
  PRIMARY KEY (`machine_id`,`part_id`),
  KEY `IDX_1F059BBFF6B75B26` (`machine_id`),
  KEY `IDX_1F059BBF4CE34BEC` (`part_id`),
  CONSTRAINT `FK_1F059BBF4CE34BEC` FOREIGN KEY (`part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1F059BBFF6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.machine_part: ~31 rows (aproximadamente)
DELETE FROM `machine_part`;
/*!40000 ALTER TABLE `machine_part` DISABLE KEYS */;
INSERT INTO `machine_part` (`machine_id`, `part_id`) VALUES
	(7, 1),
	(7, 2),
	(19, 6),
	(20, 6),
	(23, 3),
	(24, 1),
	(24, 2),
	(25, 9),
	(26, 4),
	(26, 5),
	(31, 10),
	(31, 11),
	(31, 12),
	(33, 14),
	(33, 15),
	(33, 16),
	(38, 17),
	(38, 18),
	(38, 19),
	(42, 20),
	(44, 21),
	(45, 22),
	(45, 23),
	(48, 24),
	(48, 25),
	(48, 26),
	(48, 27),
	(49, 28),
	(49, 29),
	(51, 30),
	(51, 31),
	(51, 32),
	(53, 33),
	(53, 34),
	(53, 35);
/*!40000 ALTER TABLE `machine_part` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.machine_toner
CREATE TABLE IF NOT EXISTS `machine_toner` (
  `machine_id` int(11) NOT NULL,
  `toner_id` int(11) NOT NULL,
  PRIMARY KEY (`machine_id`,`toner_id`),
  KEY `IDX_6472FCECF6B75B26` (`machine_id`),
  KEY `IDX_6472FCECBDC9E2D` (`toner_id`),
  CONSTRAINT `FK_6472FCECBDC9E2D` FOREIGN KEY (`toner_id`) REFERENCES `toner` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6472FCECF6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.machine_toner: ~60 rows (aproximadamente)
DELETE FROM `machine_toner`;
/*!40000 ALTER TABLE `machine_toner` DISABLE KEYS */;
INSERT INTO `machine_toner` (`machine_id`, `toner_id`) VALUES
	(7, 4),
	(7, 5),
	(7, 6),
	(7, 7),
	(19, 13),
	(20, 13),
	(22, 3),
	(23, 8),
	(24, 14),
	(24, 15),
	(24, 16),
	(24, 17),
	(25, 18),
	(25, 19),
	(25, 20),
	(25, 21),
	(26, 9),
	(26, 10),
	(26, 11),
	(26, 12),
	(31, 22),
	(31, 23),
	(31, 24),
	(31, 25),
	(33, 35),
	(33, 36),
	(33, 37),
	(33, 38),
	(37, 31),
	(37, 32),
	(37, 33),
	(37, 34),
	(38, 39),
	(38, 40),
	(38, 41),
	(38, 42),
	(41, 43),
	(42, 44),
	(44, 45),
	(45, 46),
	(46, 47),
	(46, 48),
	(46, 49),
	(46, 50),
	(48, 51),
	(48, 52),
	(48, 53),
	(48, 54),
	(49, 55),
	(49, 56),
	(49, 57),
	(49, 58),
	(51, 59),
	(51, 60),
	(51, 61),
	(51, 62),
	(52, 18),
	(52, 19),
	(52, 20),
	(52, 21),
	(53, 63),
	(53, 64),
	(53, 65),
	(53, 66);
/*!40000 ALTER TABLE `machine_toner` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.maker
CREATE TABLE IF NOT EXISTS `maker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.maker: ~4 rows (aproximadamente)
DELETE FROM `maker`;
/*!40000 ALTER TABLE `maker` DISABLE KEYS */;
INSERT INTO `maker` (`id`, `description`, `default_value`) VALUES
	(1, 'HP', 1),
	(2, 'LEXMARK', 0),
	(3, 'SAMSUNG', 0),
	(4, 'RICOH', 0);
/*!40000 ALTER TABLE `maker` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.ofert
CREATE TABLE IF NOT EXISTS `ofert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machine_id` int(11) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `color_percent` double NOT NULL,
  `create_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C77018C4F6B75B26` (`machine_id`),
  CONSTRAINT `FK_C77018C4F6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.ofert: ~9 rows (aproximadamente)
DELETE FROM `ofert`;
/*!40000 ALTER TABLE `ofert` DISABLE KEYS */;
INSERT INTO `ofert` (`id`, `machine_id`, `duration`, `pages`, `color_percent`, `create_at`) VALUES
	(10, 3, 60, 250, 0, '2017-08-21'),
	(11, 3, 60, 250, 0, '2017-08-21'),
	(12, 3, 60, 250, 0, '2017-08-21'),
	(13, 3, 60, 250, 0, '2017-08-21'),
	(14, 3, 60, 250, 0, '2017-08-21'),
	(15, 3, 60, 250, 0, '2017-08-21'),
	(16, 3, 60, 250, 0, '2017-08-21'),
	(17, 3, 60, 250, 0, '2017-08-21'),
	(18, 3, 60, 250, 0, '2017-08-21');
/*!40000 ALTER TABLE `ofert` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.packs
CREATE TABLE IF NOT EXISTS `packs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maker_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `years` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B9FE602768DA5EC3` (`maker_id`),
  CONSTRAINT `FK_B9FE602768DA5EC3` FOREIGN KEY (`maker_id`) REFERENCES `maker` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.packs: ~0 rows (aproximadamente)
DELETE FROM `packs`;
/*!40000 ALTER TABLE `packs` DISABLE KEYS */;
/*!40000 ALTER TABLE `packs` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.page_range
CREATE TABLE IF NOT EXISTS `page_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `start` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  `default_value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.page_range: ~2 rows (aproximadamente)
DELETE FROM `page_range`;
/*!40000 ALTER TABLE `page_range` DISABLE KEYS */;
INSERT INTO `page_range` (`id`, `description`, `start`, `end`, `default_value`) VALUES
	(1, '0 - 2800', 0, 2800, 1),
	(2, '2801 - ∞', 2801, 1000000, 1);
/*!40000 ALTER TABLE `page_range` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.part
CREATE TABLE IF NOT EXISTS `part` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `page_volume` int(11) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL,
  `recom_volume` int(11) DEFAULT NULL,
  `aditional_info` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_490F70C6C54C8C93` (`type_id`),
  CONSTRAINT `FK_490F70C6C54C8C93` FOREIGN KEY (`type_id`) REFERENCES `part_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.part: ~31 rows (aproximadamente)
DELETE FROM `part`;
/*!40000 ALTER TABLE `part` DISABLE KEYS */;
INSERT INTO `part` (`id`, `code`, `description`, `price`, `page_volume`, `type_id`, `enabled`, `recom_volume`, `aditional_info`) VALUES
	(1, 'B5L36A', 'HP Kit de Mantenimiento Fusor B5L36A (HP M533dnm)', 114.56, 150000, NULL, 1, 150000, NULL),
	(2, 'B5L37A', 'HP Kit Tóner Residual B5L37A (HP M533DN)', 12.6, 54000, NULL, 1, 54000, NULL),
	(3, 'F2G77A', 'HP Kit Fusor F2G77A (M605)', 234.4, 225000, NULL, 1, 225000, NULL),
	(4, 'C1N58A', 'HP Kit Fusor C1N58A (M880zm)', 96.38, 100000, NULL, 1, 100000, NULL),
	(5, 'D7H14A', 'HP Kit Transferencia D7H14A (M880zm)', 128.51, 150000, NULL, 1, 150000, NULL),
	(6, 'CF254A', 'HP Kit mantenimiento Fusor CF254A (M712)', 97.84, 200000, NULL, 1, 200, NULL),
	(7, 'B5L36A', 'HP Kit Fusor B5L36A (HP M553)', 114.56, 150000, NULL, 1, 150000, NULL),
	(8, 'B5L37A', 'HP Kit Tóner Residual B5L37A (HP M553)', 12.6, 54000, NULL, 1, 54000, NULL),
	(9, 'B5L09A', 'HP Kit Tóner Residual B5L09A (HP PW55250)', 29.42, 115000, NULL, 1, 115000, NULL),
	(10, 'CE247A', 'HP Kit Fusor CE247A (HP M651)', 126.67, 150000, NULL, 1, 150000, NULL),
	(11, 'CE249A', 'HP Kit Transferencia CE249A (HP M651)', 191.47, 150000, NULL, 1, 150000, NULL),
	(12, 'CE265A', 'HP Kit Tóner Residual CE265A (HP M651)', 15.72, 36000, NULL, 1, 36000, NULL),
	(14, 'CE978A', 'HP Kit mantenimiento Fusor CE978A (M750)', 193.46, 150000, NULL, 1, 150000, NULL),
	(15, 'CE516A', 'HP Kit Transferencia CE516A (HP M750)', 139.26, 150000, NULL, 1, 150000, NULL),
	(16, 'CE980A', 'HP Kit Tóner Residual CE980A (HP M750)', 20.41, 150000, NULL, 1, 150000, NULL),
	(17, 'W1B43A', 'HP Kit del limpiador del cabezal W1B43A (PW 50/60)', 46, 150000, NULL, 1, 150000, NULL),
	(18, 'W1B44A', 'HP Kit recipiente para líquidos de servicio W1B44A (PW 50/60)', 79, 150000, NULL, 1, 150000, NULL),
	(19, 'W1B45A', 'HP Kit de rodillos W1B45A (PW50/60)', 9, 150000, NULL, 1, 150000, NULL),
	(20, 'B5L52A', 'HP Kit de rodillos B5L52A (M527mfp)', 26, 75000, NULL, 1, 75000, NULL),
	(21, 'CF254A', 'HP Kit mantenimiento Fusor CF254A (M725mfp)', 97.84, 270000, NULL, 1, 270000, NULL),
	(22, 'C2H57A', 'HP Kit mantenimiento Fusor C2H57A (M830mfp)', 190.55, 240000, NULL, 1, 240000, NULL),
	(23, 'C1P70A', 'HP Kit de rodillos C1P70A (M830mfp)', 32.35, 100000, NULL, 1, 100000, NULL),
	(24, 'CE247A', 'HP Kit mantenimiento Fusor CE247A (M680mfp)', 126.67, 187500, NULL, 1, 187500, NULL),
	(25, 'CE249A', 'HP Kit Transferencia CE249A (HP M680mfp)', 191.47, 150000, NULL, 1, 150000, NULL),
	(26, 'CE265A', 'HP Kit Tóner Residual CE265A (HP M680mfp)', 15.72, 36000, NULL, 1, 36000, NULL),
	(27, 'CE248A', 'HP Kit de mantenimiento ADF CE248A (M680mfp)', 49.22, 90000, NULL, 1, 90000, NULL),
	(28, 'B5L09A', 'HP Kit Tóner Residual B5L09A (PW E58650)', 29.42, 115000, NULL, 1, 115000, NULL),
	(29, 'L2718A', 'HP Kit de mantenimiento ADF L2718A (PW E58650)', 21, 100000, NULL, 1, 100000, NULL),
	(30, 'CE515A', 'HP Kit mantenimiento Fusor CE515A (M775mfp)', 160.6, 150000, NULL, 1, 150000, NULL),
	(31, 'CE516A', 'HP Kit Transferencia CE516A (M775mfp)', 139.26, 150000, NULL, 1, 150000, NULL),
	(32, 'CE980A', 'HP Kit Tóner Residual CE980A (M775mfp)', 20.41, 150000, NULL, 1, 150000, NULL),
	(33, 'W1B43A', 'HP Kit limpiador del cabezal W1B43A (P77740)', 46.01, 150000, NULL, 1, 150000, NULL),
	(34, 'W1B44A', 'HP Kit recipiente para líquidos de servicio W1B44A (P77740)', 79.18, 150000, NULL, 1, 150000, NULL),
	(35, 'W1B45A', 'HP Kit de rodillos W1B45A (P77740)', 8.56, 150000, NULL, 1, 150000, NULL);
/*!40000 ALTER TABLE `part` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.part_type
CREATE TABLE IF NOT EXISTS `part_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.part_type: ~0 rows (aproximadamente)
DELETE FROM `part_type`;
/*!40000 ALTER TABLE `part_type` DISABLE KEYS */;
INSERT INTO `part_type` (`id`, `description`) VALUES
	(1, 'Prueba1');
/*!40000 ALTER TABLE `part_type` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.product: ~0 rows (aproximadamente)
DELETE FROM `product`;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
/*!40000 ALTER TABLE `product` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.sales_order
CREATE TABLE IF NOT EXISTS `sales_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `costumer_id` int(11) DEFAULT NULL,
  `machine_id` int(11) DEFAULT NULL,
  `costumes_adress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `pages` int(11) NOT NULL,
  `color_percent` double NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fixed_price` double NOT NULL,
  `month_price` double NOT NULL,
  `varible_price` double NOT NULL,
  `page_color_price` double NOT NULL,
  `page_black_price` double NOT NULL,
  `created_at` date NOT NULL,
  `accepted_at` date DEFAULT NULL,
  `observations` longtext COLLATE utf8_unicode_ci,
  `contract_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `toner_year_amount_color` double NOT NULL,
  `toner_year_amount_black` double NOT NULL,
  `profit_duration` double NOT NULL,
  `profit_fixed` double NOT NULL,
  `profit_variable` double NOT NULL,
  `parent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_fixed_price` double NOT NULL,
  `black_recomended_volume` int(11) NOT NULL,
  `color_recomended_volume` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_36D222E60B71152` (`costumer_id`),
  KEY `IDX_36D222EF6B75B26` (`machine_id`),
  CONSTRAINT `FK_36D222E60B71152` FOREIGN KEY (`costumer_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_36D222EF6B75B26` FOREIGN KEY (`machine_id`) REFERENCES `machine` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.sales_order: ~0 rows (aproximadamente)
DELETE FROM `sales_order`;
/*!40000 ALTER TABLE `sales_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_order` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.sent_consumable
CREATE TABLE IF NOT EXISTS `sent_consumable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sales_order_id` int(11) DEFAULT NULL,
  `toner_id` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `sent_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_576C8F12C023F51C` (`sales_order_id`),
  KEY `IDX_576C8F12BDC9E2D` (`toner_id`),
  CONSTRAINT `FK_576C8F12BDC9E2D` FOREIGN KEY (`toner_id`) REFERENCES `toner` (`id`),
  CONSTRAINT `FK_576C8F12C023F51C` FOREIGN KEY (`sales_order_id`) REFERENCES `sales_order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.sent_consumable: ~0 rows (aproximadamente)
DELETE FROM `sent_consumable`;
/*!40000 ALTER TABLE `sent_consumable` DISABLE KEYS */;
/*!40000 ALTER TABLE `sent_consumable` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.static_pages
CREATE TABLE IF NOT EXISTS `static_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.static_pages: ~0 rows (aproximadamente)
DELETE FROM `static_pages`;
/*!40000 ALTER TABLE `static_pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `static_pages` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.stock_type
CREATE TABLE IF NOT EXISTS `stock_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.stock_type: ~0 rows (aproximadamente)
DELETE FROM `stock_type`;
/*!40000 ALTER TABLE `stock_type` DISABLE KEYS */;
INSERT INTO `stock_type` (`id`, `description`) VALUES
	(1, '3 días');
/*!40000 ALTER TABLE `stock_type` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.technology
CREATE TABLE IF NOT EXISTS `technology` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `default_value` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.technology: ~2 rows (aproximadamente)
DELETE FROM `technology`;
/*!40000 ALTER TABLE `technology` DISABLE KEYS */;
INSERT INTO `technology` (`id`, `description`, `default_value`) VALUES
	(1, 'Láser', 1),
	(2, 'Tinta Pro', 0);
/*!40000 ALTER TABLE `technology` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.toner
CREATE TABLE IF NOT EXISTS `toner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `color_id` int(11) DEFAULT NULL,
  `capacity_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `aditional_info` longtext COLLATE utf8_unicode_ci,
  `recom_volume` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4DFD3F9F7ADA1FB5` (`color_id`),
  KEY `IDX_4DFD3F9F66B6F0BA` (`capacity_id`),
  CONSTRAINT `FK_4DFD3F9F66B6F0BA` FOREIGN KEY (`capacity_id`) REFERENCES `toner_capacity` (`id`),
  CONSTRAINT `FK_4DFD3F9F7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `toner_color` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.toner: ~51 rows (aproximadamente)
DELETE FROM `toner`;
/*!40000 ALTER TABLE `toner` DISABLE KEYS */;
INSERT INTO `toner` (`id`, `color_id`, `capacity_id`, `code`, `description`, `price`, `enabled`, `aditional_info`, `recom_volume`) VALUES
	(3, 1, 2, 'CF287XC', 'HP Tóner Negro CF287XC (HP M501)', 110.05, 1, NULL, 18000),
	(4, 1, 2, 'CF360XC', 'HP Tóner Negro CF360XC (M533dnm)', 73.24, 1, NULL, 14900),
	(5, 2, 2, 'CF361XC', 'HP Tóner Cyan CF361XC (M533dn)', 132.85, 1, NULL, 11700),
	(6, 4, 2, 'CF362XC', 'HP Tóner Amarillo CF362XC (M533dn)', 132.85, 1, NULL, 11700),
	(7, 3, 2, 'CF363XC', 'HP Tóner Magenta CF363XC (M533dn)', 132.85, 1, NULL, 11700),
	(8, 1, 2, 'CF281XC', 'HP Tóner Negro CF281XC (M605dnm)', 98.18, 1, NULL, 35000),
	(9, 1, 2, 'CF300AC', 'HP Toner Negro CF300AC (M880zm)', 28.59, 1, NULL, 29500),
	(10, 2, 2, 'CF301AC', 'HP Toner Cyan CF301AC (M880zm)', 145.34, 1, NULL, 32000),
	(11, 4, 2, 'CF302AC', 'HP Toner Amarillo CF302AC (M880zm)', 145.34, 1, NULL, 32000),
	(12, 3, 2, 'CF303AC', 'HP Toner Magenta CF303AC (M880zm)', 145.34, 1, NULL, 32000),
	(13, 1, 2, 'CF214XC', 'HP Tóner Negro CF214XC (M712)', 70.34, 1, NULL, 17500),
	(14, 1, 2, 'CF360XC', 'HP Tóner Negro CF360XC (HP M553)', 75.53, 1, NULL, 12500),
	(15, 2, 2, 'CF361XC', 'HP Tóner Cyan CF361XC (HP M553)', 136.84, 1, NULL, 9500),
	(16, 4, 2, 'CF362XC', 'HP Tóner Amarillo CF362XC (HP M553)', 136.84, 1, NULL, 9500),
	(17, 3, 2, 'CF363XC', 'HP Tóner Magenta CF363XC (HP M553)', 136.84, 1, NULL, 9500),
	(18, 1, 2, 'L0S20YC', 'HP Cartucho Negro L0S20YC (PW55250; P57750)', 120.44, 1, NULL, 21000),
	(19, 2, 2, 'L0S29YC', 'HP Cartucho Cyan L0S29YC (PW55250; P57750)', 139.75, 1, NULL, 16000),
	(20, 3, 2, 'L0S30YC', 'HP Cartucho Magenta L0S30YC (PW55250; P57750)', 139.75, 1, NULL, 16000),
	(21, 4, 2, 'L0S31YC', 'HP Cartucho Amarillo L0S31YC ((PW55250; P57750))', 139.75, 1, NULL, 16000),
	(22, 1, 2, 'CF330XC', 'HP Tóner Negro CF330XC (HP M651)', 123.37, 1, NULL, 20500),
	(23, 2, 2, 'CF331AC', 'HP Tóner Cian CF331AC (HP M651)', 169.52, 1, NULL, 15000),
	(24, 4, 2, 'CF332AC', 'HP Tóner Amarillo CF332AC (HP M651)', 169.52, 1, NULL, 15000),
	(25, 3, 2, 'CF333AC', 'HP Tóner Magenta CF333AC (HP M651)', 169.52, 1, NULL, 15000),
	(31, 1, 2, 'CE740A', 'HP Tóner Negro CE740A (CP5225)', 79.17, 1, NULL, 7000),
	(32, 2, 2, 'CE741A', 'HP Tóner Cyan CE741A (CP5225)', 140.62, 1, NULL, 7300),
	(33, 4, 2, 'CE742A', 'HP Tóner Amarillo CE742A (CP5225)', 140.62, 1, NULL, 7300),
	(34, 1, 2, 'CE743A', 'HP Tóner Magenta CE743A (CP5225)', 140.62, 1, NULL, 7300),
	(35, 1, 2, 'CE270AC', 'HP Tóner Negro CE270AC (M750dn)', 96.55, 1, NULL, 13500),
	(36, 2, 2, 'CE271AC', 'HP Tóner Cian CE271AC (M750dn)', 187.92, 1, NULL, 15000),
	(37, 4, 2, 'CE272AC', 'HP Tóner Amarillo CE272AC (M750dn)', 187.92, 1, NULL, 15000),
	(38, 3, 2, 'CE273AC', 'HP Tóner Magenta CE273AC (M750dn)', 187.92, 1, NULL, 15000),
	(39, 1, 2, 'M0K29XC', 'HP Cartucho Negro M0K29XC (PW 50/60)', 39, 1, NULL, 22000),
	(40, 2, 2, 'M0K06XC', 'HP Cartucho Cian M0K06XC (PW 50/60)', 56, 1, NULL, 16000),
	(41, 4, 2, 'M0K25XC', 'HP Cartucho Amarillo M0K25XC (PW 50/60)', 56, 1, NULL, 16000),
	(42, 3, 2, 'M0K10XC', 'HP Cartucho Magenta M0K10XC (PW 50/60)', 56, 1, NULL, 16000),
	(43, 1, 2, 'CF226XC', 'HP Tóner Negro CF226XC (M426)', 81.09, 1, NULL, 9000),
	(44, 1, 2, 'CF287XC', 'HP Tóner Negro CF287XC (HP M527mfp)', 110.05, 1, NULL, 20600),
	(45, 1, 2, 'CF214XC', 'HP Tóner Negro CF214XC (HP M725mfp)', 72.45, 1, NULL, 25000),
	(46, 1, 1, 'CF325XC', 'HP Tóner Negro CF325XC (HP M830mfp)', 106.87, 1, NULL, 42600),
	(47, 1, 1, 'CF410XC', 'HP Tóner Negro CF410XC (HP M477mfp)', 58.69, 1, NULL, 6500),
	(48, 2, 1, 'CF411XC', 'HP Tóner Cian CF411XC (HP M477mfp)', 96.13, 1, NULL, 5000),
	(49, 4, 1, 'CF412XC', 'HP Tóner Amarillo CF412XC (HP M477mfp)', 96.13, 1, NULL, 5000),
	(50, 3, 1, 'CF413XC', 'HP Tóner Magenta CF413XC (HP M477mfp)', 96.13, 1, NULL, 5000),
	(51, 1, 2, 'CF320XC', 'HP Tóner Negro CF320XC (HP M680mfp)', 77.45, 1, NULL, 22300),
	(52, 2, 2, 'CF321AC', 'HP Tóner Cian CF321AC (HP M680mfp)', 158.82, 1, NULL, 19900),
	(53, 4, 2, 'CF322AC', 'HP Tóner Amarillo CF322AC (HP M680mfp)', 158.82, 1, NULL, 19900),
	(54, 3, 2, 'CF323AC', 'HP Tóner Magenta CF323AC (HP M680mfp)', 158.82, 1, NULL, 19900),
	(55, 1, 2, 'L0R16A', 'HP Cartucho Negro L0R16A (PW E58650)', 84, 1, NULL, 20000),
	(56, 2, 2, 'L0R13A', 'HP Cartucho Cian L0R13A (PW E58650)', 109.76, 1, NULL, 16000),
	(57, 3, 2, 'L0R14A', 'HP Cartucho Magenta L0R14A (PW E58650)', 109.76, 1, NULL, 16000),
	(58, 4, 2, 'L0R15A', 'HP Cartucho Amarillo L0R15A (PW E58650)', 109.76, 1, NULL, 16000),
	(59, 1, 2, 'CE340AC', 'HP Tóner Negro CE340AC (HP M775mfp)', 26.32, 1, NULL, 14800),
	(60, 2, 2, 'CE341AC', 'HP Tóner Cian CE341AC (HP M775mfp)', 188.93, 1, NULL, 20200),
	(61, 4, 2, 'CE342AC', 'HP Tóner Amarillo CE342AC (HP M775mfp)', 188.93, 1, NULL, 20200),
	(62, 3, 2, 'CE343AC', 'HP Tóner Magenta CE343AC (HP M775mfp)', 188.93, 1, NULL, 20200),
	(63, 1, 2, 'X4D19AC', 'HP Cartucho Negro X4D19AC (P77740)', 38.52, 1, NULL, 20000),
	(64, 2, 2, 'X4D10AC', 'HP Cartucho Cian X4D10AC (P77740)', 57.78, 1, NULL, 16000),
	(65, 4, 2, 'X4D16AC', 'HP Cartucho Amarillo X4D16AC (P77740)', 57.78, 1, NULL, 16000),
	(66, 3, 2, 'X4D13AC', 'HP Cartucho Magenta X4D13AC (P77740)', 57.78, 1, NULL, 16000);
/*!40000 ALTER TABLE `toner` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.toner_capacity
CREATE TABLE IF NOT EXISTS `toner_capacity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.toner_capacity: ~2 rows (aproximadamente)
DELETE FROM `toner_capacity`;
/*!40000 ALTER TABLE `toner_capacity` DISABLE KEYS */;
INSERT INTO `toner_capacity` (`id`, `description`) VALUES
	(1, 'Normal'),
	(2, 'Alta');
/*!40000 ALTER TABLE `toner_capacity` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.toner_color
CREATE TABLE IF NOT EXISTS `toner_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.toner_color: ~4 rows (aproximadamente)
DELETE FROM `toner_color`;
/*!40000 ALTER TABLE `toner_color` DISABLE KEYS */;
INSERT INTO `toner_color` (`id`, `description`) VALUES
	(1, 'Negro'),
	(2, 'Azul'),
	(3, 'Magenta'),
	(4, 'Amarillo');
/*!40000 ALTER TABLE `toner_color` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.toner_type
CREATE TABLE IF NOT EXISTS `toner_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.toner_type: ~0 rows (aproximadamente)
DELETE FROM `toner_type`;
/*!40000 ALTER TABLE `toner_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `toner_type` ENABLE KEYS */;

-- Volcando estructura para tabla imprimia_test.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addres` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iban_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_expiration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `card_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `population` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_ndd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_ndd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla imprimia_test.user: ~6 rows (aproximadamente)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `name`, `cif`, `addres`, `owner_name`, `iban_code`, `card_number`, `card_expiration`, `card_code`, `population`, `province`, `cp`, `phone`, `id_ndd`, `password_ndd`) VALUES
	(1, 'javi', 'javi', 'javi@example.com', 'javi@example.com', 1, NULL, '$2y$13$ub82vtQFMYroRu.J4MwCnOZy/yqncoJ1nRzSkm8YC4nIFEdE3sl4i', '2017-11-29 11:48:00', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, 'macueva', 'macueva', 'miguel.cueva@gdoadapta.es', 'miguel.cueva@gdoadapta.es', 1, NULL, '$2y$13$54aXBauMcrQJsuqCLf9pT.bEPhUQAQ8KkpSOrhaYMJxgvs14j2Ts.', '2017-10-07 13:12:00', NULL, NULL, 'a:1:{i:0;s:10:"ROLE_ADMIN";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(14, 'javier1972c@yahoo.es', 'javier1972c@yahoo.es', 'javier1972c@yahoo.es', 'javier1972c@yahoo.es', 0, 'oa6bjiptn3ko440k00w8ocg8o0o08oo', '$2y$13$/mBYlCgfQcrCJaQn9P2Ifujvserglkymigow3joWuUmHIbl/nWCAG', NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 'Javi SA', 'y3416998v', 'Calle Pañería, 4, Bajo, Izquierda', 'Javier Mares', NULL, NULL, NULL, NULL, 'Madrid', NULL, '28037', '691666829', NULL, NULL),
	(17, 'javi@yo.cu', 'javi@yo.cu', 'javi@yo.cu', 'javi@yo.cu', 0, 't6silmsoias0o0s4kowocw8skkgockw', '$2y$13$3qIwPCYO1RIpLBTD0YO17etdJvfd6s8gPTy6fZmUeosb5nzghGbmy', NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 'Empresa1', 'Y3416998v', 'Calle Pañería, 4, Bajo, Izquierda', 'Javi', NULL, NULL, NULL, NULL, 'Madrid', NULL, '23456', '691666829', NULL, NULL),
	(18, 'macueva23@gmail.com', 'macueva23@gmail.com', 'macueva23@gmail.com', 'macueva23@gmail.com', 0, 'r2ls0rp72aswgggosk04gcwssocco04', '$2y$13$HvMsLI4Hs7/jYNZd1JZB0uFRrJ8GVWblbCw4ZPleoNlSkUBDXBFC.', NULL, NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 'GDO PRUEBA3, S.L', 'B85192136', 'C/ AMADO NERVO 4', 'MIGUEL A. DE LA CUEVA', NULL, NULL, NULL, NULL, 'madrid', NULL, '28007', '616547006', NULL, NULL),
	(19, 'prueba5@gmail.com', 'prueba5@gmail.com', 'prueba5@gmail.com', 'prueba5@gmail.com', 1, NULL, '$2y$13$31AE/3jOIj2PRj..thpfeehH8iwsTY3wHUqOVVINJgS0kU/UVbJfi', '2017-10-22 23:36:26', NULL, NULL, 'a:1:{i:0;s:9:"ROLE_USER";}', 'PRUEBA5', 'B85192136', 'C/ PRUEBA 5', 'PRUEBA5', NULL, NULL, NULL, NULL, 'MADRID', NULL, '28007', '616547005', NULL, NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
