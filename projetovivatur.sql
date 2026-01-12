-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: projetovivatur
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin','1',1764080419),('gestor','2',1764080419),('gestor','5',1764706232),('gestor','6',1764706608),('turista','3',1764080419),('turista','4',1765195122);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,'Administrador - controlo total do sistema',NULL,NULL,1764080419,1764080419),('atualizarAvaliacoes',2,'Atualizar avaliacoes',NULL,NULL,1764080419,1764080419),('atualizarCategorias',2,'Atualizar categorias',NULL,NULL,1764080419,1764080419),('atualizarComentarios',2,'Atualizar comentarios',NULL,NULL,1764080419,1764080419),('atualizarExperiencias',2,'Atualizar experiencias',NULL,NULL,1764080419,1764080419),('atualizarIdioma',2,'Atualizar idioma',NULL,NULL,1764080419,1764080419),('atualizarLingua',2,'Atualizar lingua',NULL,NULL,1764080419,1764080419),('atualizarPagamento',2,'Atualizar metodo de pagamento',NULL,NULL,1764080419,1764080419),('atualizarPais',2,'Atualizar pais',NULL,NULL,1764080419,1764080419),('atualizarReservas',2,'Atualizar reservas',NULL,NULL,1764080419,1764080419),('createAvaliacoes',2,'Criar avaliacoes',NULL,NULL,1764080419,1764080419),('createCategorias',2,'Criar categorias',NULL,NULL,1764080419,1764080419),('createComentarios',2,'Criar comentarios',NULL,NULL,1764080419,1764080419),('createExperiencias',2,'Criar experiencias',NULL,NULL,1764080419,1764080419),('createFavoritos',2,'Criar favoritos',NULL,NULL,1764080419,1764080419),('createIdioma',2,'Criar idioma',NULL,NULL,1764080419,1764080419),('createLingua',2,'Criar lingua',NULL,NULL,1764080419,1764080419),('createPagamento',2,'Criar metodo de pagamento',NULL,NULL,1764080419,1764080419),('createPais',2,'Criar pais',NULL,NULL,1764080419,1764080419),('createReservas',2,'Criar reservas',NULL,NULL,1764080419,1764080419),('createUsers',2,'Criar users',NULL,NULL,1764080419,1764080419),('deleteUsers',2,'Eliminar users',NULL,NULL,1764080419,1764080419),('editarAvaliacoes',2,'Editar avaliacoes',NULL,NULL,1764080419,1764080419),('editarCategorias',2,'Editar categorias',NULL,NULL,1764080419,1764080419),('editarComentarios',2,'Editar comentarios',NULL,NULL,1764080419,1764080419),('editarExperiencias',2,'Editar experiencias',NULL,NULL,1764080419,1764080419),('editarIdioma',2,'Editar idioma',NULL,NULL,1764080419,1764080419),('editarLingua',2,'Editar lingua',NULL,NULL,1764080419,1764080419),('editarPagamento',2,'Editar metodo de pagamento',NULL,NULL,1764080419,1764080419),('editarPais',2,'Editar pais',NULL,NULL,1764080419,1764080419),('editarReservas',2,'Editar reservas',NULL,NULL,1764080419,1764080419),('editarUsers',2,'Editar users',NULL,NULL,1764080419,1764080419),('eliminarAvaliacoes',2,'Eliminar avaliacoes',NULL,NULL,1764080419,1764080419),('eliminarCategorias',2,'Eliminar categorias',NULL,NULL,1764080419,1764080419),('eliminarComentarios',2,'Eliminar comentarios',NULL,NULL,1764080419,1764080419),('eliminarExperiencias',2,'Eliminar experiencias',NULL,NULL,1764080419,1764080419),('eliminarFavoritos',2,'Eliminar favoritos',NULL,NULL,1764080419,1764080419),('eliminarIdioma',2,'Eliminar idioma',NULL,NULL,1764080419,1764080419),('eliminarLingua',2,'Eliminar lingua',NULL,NULL,1764080419,1764080419),('eliminarPagamento',2,'Eliminar metodo de pagamento',NULL,NULL,1764080419,1764080419),('eliminarPais',2,'Eliminar pais',NULL,NULL,1764080419,1764080419),('eliminarReservas',2,'Eliminar reservas',NULL,NULL,1764080419,1764080419),('gestor',1,'Gestor de Experiências',NULL,NULL,1764080419,1764080419),('turista',1,'Turista com conta',NULL,NULL,1764080419,1764080419),('updateUsers',2,'Atualizar users',NULL,NULL,1764080419,1764080419),('viewAvaliacoes',2,'Visualizar avaliacoes',NULL,NULL,1764080419,1764080419),('viewCategorias',2,'Visualizar categorias',NULL,NULL,1764080419,1764080419),('viewExperiencias',2,'Visualizar experiencias',NULL,NULL,1764080419,1764080419),('viewIdioma',2,'Visualizar idioma',NULL,NULL,1764080419,1764080419),('viewPagamento',2,'Visualizar metodo de pagamento',NULL,NULL,1764080419,1764080419),('viewReservas',2,'Visualizar reservas',NULL,NULL,1764080419,1764080419),('viewUsers',2,'Visualizar users',NULL,NULL,1764080419,1764080419);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','atualizarAvaliacoes'),('turista','atualizarAvaliacoes'),('admin','atualizarCategorias'),('gestor','atualizarCategorias'),('admin','atualizarComentarios'),('gestor','atualizarComentarios'),('turista','atualizarComentarios'),('admin','atualizarExperiencias'),('gestor','atualizarExperiencias'),('admin','atualizarIdioma'),('gestor','atualizarIdioma'),('gestor','atualizarLingua'),('admin','atualizarPagamento'),('gestor','atualizarPagamento'),('admin','atualizarPais'),('gestor','atualizarReservas'),('turista','createAvaliacoes'),('admin','createCategorias'),('gestor','createCategorias'),('gestor','createComentarios'),('turista','createComentarios'),('admin','createExperiencias'),('gestor','createExperiencias'),('turista','createFavoritos'),('admin','createIdioma'),('gestor','createIdioma'),('gestor','createLingua'),('admin','createPagamento'),('gestor','createPagamento'),('admin','createPais'),('turista','createReservas'),('admin','createUsers'),('admin','deleteUsers'),('admin','editarAvaliacoes'),('turista','editarAvaliacoes'),('admin','editarCategorias'),('gestor','editarCategorias'),('admin','editarComentarios'),('gestor','editarComentarios'),('turista','editarComentarios'),('admin','editarExperiencias'),('gestor','editarExperiencias'),('admin','editarIdioma'),('gestor','editarIdioma'),('gestor','editarLingua'),('admin','editarPagamento'),('gestor','editarPagamento'),('admin','editarPais'),('gestor','editarReservas'),('admin','editarUsers'),('admin','eliminarAvaliacoes'),('turista','eliminarAvaliacoes'),('admin','eliminarCategorias'),('gestor','eliminarCategorias'),('admin','eliminarComentarios'),('gestor','eliminarComentarios'),('turista','eliminarComentarios'),('admin','eliminarExperiencias'),('gestor','eliminarExperiencias'),('turista','eliminarFavoritos'),('admin','eliminarIdioma'),('gestor','eliminarIdioma'),('gestor','eliminarLingua'),('admin','eliminarPagamento'),('gestor','eliminarPagamento'),('admin','eliminarPais'),('gestor','eliminarReservas'),('turista','eliminarReservas'),('admin','updateUsers'),('admin','viewAvaliacoes'),('gestor','viewAvaliacoes'),('admin','viewCategorias'),('gestor','viewCategorias'),('turista','viewCategorias'),('admin','viewExperiencias'),('gestor','viewExperiencias'),('turista','viewExperiencias'),('admin','viewIdioma'),('gestor','viewIdioma'),('turista','viewIdioma'),('admin','viewPagamento'),('gestor','viewPagamento'),('turista','viewPagamento'),('admin','viewReservas'),('gestor','viewReservas'),('admin','viewUsers'),('gestor','viewUsers');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avaliacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `estrela` varchar(45) NOT NULL,
  `experiencia_id` int NOT NULL,
  `user_id` int NOT NULL,
  `turista_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_avaliacao_experiencia1_idx` (`experiencia_id`),
  KEY `fk_avaliacao_experiencia_turista_idx` (`turista_id`),
  CONSTRAINT `fk_avaliacao_experiencia1` FOREIGN KEY (`experiencia_id`) REFERENCES `experiencias` (`id`),
  CONSTRAINT `fk_avaliacao_experiencia_turista` FOREIGN KEY (`turista_id`) REFERENCES `turistas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avaliacoes`
--

LOCK TABLES `avaliacoes` WRITE;
/*!40000 ALTER TABLE `avaliacoes` DISABLE KEYS */;
INSERT INTO `avaliacoes` VALUES (1,'3',2,3,0),(2,'2',2,3,0),(3,'4',2,3,0),(4,'2',2,3,0),(5,'2',1,3,0),(6,'3',1,3,1),(7,'2',1,3,1);
/*!40000 ALTER TABLE `avaliacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'aventura'),(3,'teste');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `dataCriacao` varchar(45) NOT NULL,
  `experiencia_id` int NOT NULL,
  `user_id` int NOT NULL,
  `turista_id` int NOT NULL,
  `resposta` varchar(45) DEFAULT NULL,
  `dataResposta` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`descricao`),
  KEY `fk_comentario_experiencia1_idx` (`experiencia_id`),
  KEY `fk_comentario_user1_idx` (`user_id`),
  KEY `fk_comentario_turista_idx` (`turista_id`),
  CONSTRAINT `fk_comentario_experiencia1` FOREIGN KEY (`experiencia_id`) REFERENCES `experiencias` (`id`),
  CONSTRAINT `fk_comentario_turista` FOREIGN KEY (`turista_id`) REFERENCES `turistas` (`id`),
  CONSTRAINT `fk_comentario_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentarios`
--

LOCK TABLES `comentarios` WRITE;
/*!40000 ALTER TABLE `comentarios` DISABLE KEYS */;
INSERT INTO `comentarios` VALUES (1,'Atualizei o comentário','2025-12-11',2,3,0,'','0000-00-00 00:00:00'),(2,'comentarios','2025-12-12',1,3,0,'tetete','2026-01-05 11:59:19'),(3,'Comentário atualizado com sucesso!','2024-12-13',2,3,0,'','0000-00-00 00:00:00'),(4,'eu adorei esta experiência','2025-12-22 21:24:43',1,3,0,'','0000-00-00 00:00:00'),(5,'teste','2025-12-22 21:26:16',6,3,0,'','0000-00-00 00:00:00'),(6,'teste','2025-12-25 21:15:17',1,3,0,'','0000-00-00 00:00:00'),(7,'olaa','2025-12-25 21:18:51',1,3,0,'','0000-00-00 00:00:00'),(8,'teste','2026-01-05 11:49:17',1,3,1,'','0000-00-00 00:00:00'),(9,'121212','2026-01-05 14:53:10',1,3,1,NULL,NULL);
/*!40000 ALTER TABLE `comentarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiencias`
--

DROP TABLE IF EXISTS `experiencias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `experiencias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `horaInicio` varchar(45) NOT NULL,
  `horaFim` varchar(45) NOT NULL,
  `duracao` varchar(45) NOT NULL,
  `local` varchar(45) NOT NULL,
  `dataDisponivel` date NOT NULL,
  `precoPessoa` varchar(45) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `numMaxParticipante` varchar(45) NOT NULL,
  `numMinParticipante` varchar(45) NOT NULL,
  `categoria_id` int NOT NULL,
  `gestor_id` int NOT NULL,
  `pais_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_experiencia_categoria1_idx` (`categoria_id`),
  KEY `fk_experiencia_gestor1_idx` (`gestor_id`),
  KEY `fk_experiencia_pais1_idx` (`pais_id`),
  CONSTRAINT `fk_experiencia_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  CONSTRAINT `fk_experiencia_gestor1` FOREIGN KEY (`gestor_id`) REFERENCES `gestores` (`id`),
  CONSTRAINT `fk_experiencia_pais1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiencias`
--

LOCK TABLES `experiencias` WRITE;
/*!40000 ALTER TABLE `experiencias` DISABLE KEYS */;
INSERT INTO `experiencias` VALUES (1,'teste','Explore as famosas grutas marinhas do Algarve num emocionante passeio de kayak. Descubra praias escondidas e formações rochosas espetaculares. Inclui equipamento e guia experiente.','13:20','14:20','1h','pt','2025-12-01','14','6951a3a1c856a','5','3',1,1,1),(2,'teste1','experiencia com id 2','20:00','21:00','1','leiria','2025-12-02','14','695c56bb39c1e','3','5',1,1,1),(3,'12','experiencia com id 3','20:07','20:07','0h 0min','leiria','2025-12-03','14','6951a3a1c856a','3','5',3,1,1),(4,'3333','experiencia com id 4','20:08','21:08','1','leiria','2025-12-02','14','695c56bb39c1e','3','5',1,1,1),(5,'olaaaa','experiencia com id 5','20:17','21:17','1','leiria','2025-12-02','14','6951a3a1c856a','5','10',1,3,1),(6,'teste12','experiencia com id 6','19:24','20:24','1','leiria','2025-12-09','14','6951a3a1c856a','5','5',1,2,1),(7,'experiencia1','experiencia com id 7','14:30','16:30','2','leiria','2025-12-23','14','6951a3a1c856a','5','2',1,1,1),(8,'experiencia12','experiencia com id 8','14:40','16:40','2','ll','2025-12-23','15','6951a3a1c856a','10','5',1,2,1),(9,'ggggggg','experiencia com id 9','13:05','14:05','01:00:00','leiria','2025-12-26','14','6951a3a1c856a','10','5',1,1,1),(10,'pppppp','experiencia com id 10','13:17','14:17','1h 0m','__','2025-12-26','14','695c56bb39c1e','10','5',1,1,1);
/*!40000 ALTER TABLE `experiencias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `experiencia_id` int NOT NULL,
  `user_id` int NOT NULL,
  `turista_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_favorito_experiencia1_idx` (`experiencia_id`),
  KEY `fk_favorito_user1_idx` (`user_id`),
  KEY `fk_favorito_turista_idx` (`turista_id`),
  CONSTRAINT `fk_favorito_experiencia1` FOREIGN KEY (`experiencia_id`) REFERENCES `experiencias` (`id`),
  CONSTRAINT `fk_favorito_turista` FOREIGN KEY (`turista_id`) REFERENCES `turistas` (`id`),
  CONSTRAINT `fk_favorito_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favoritos`
--

LOCK TABLES `favoritos` WRITE;
/*!40000 ALTER TABLE `favoritos` DISABLE KEYS */;
INSERT INTO `favoritos` VALUES (1,2,3,1),(2,3,2,1);
/*!40000 ALTER TABLE `favoritos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gestores`
--

DROP TABLE IF EXISTS `gestores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gestores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_gestor_user_idx` (`user_id`),
  CONSTRAINT `fk_gestor_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gestores`
--

LOCK TABLES `gestores` WRITE;
/*!40000 ALTER TABLE `gestores` DISABLE KEYS */;
INSERT INTO `gestores` VALUES (1,2),(2,5),(3,6);
/*!40000 ALTER TABLE `gestores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linguas`
--

DROP TABLE IF EXISTS `linguas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linguas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linguas`
--

LOCK TABLES `linguas` WRITE;
/*!40000 ALTER TABLE `linguas` DISABLE KEYS */;
INSERT INTO `linguas` VALUES (1,'pt');
/*!40000 ALTER TABLE `linguas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodopagamentos`
--

DROP TABLE IF EXISTS `metodopagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodopagamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodopagamentos`
--

LOCK TABLES `metodopagamentos` WRITE;
/*!40000 ALTER TABLE `metodopagamentos` DISABLE KEYS */;
INSERT INTO `metodopagamentos` VALUES (1,'mbway'),(2,'visa');
/*!40000 ALTER TABLE `metodopagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1763740629),('m140506_102106_rbac_init',1763740630),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1763740630),('m180523_151638_rbac_updates_indexes_without_prefix',1763740631),('m200409_110543_rbac_update_mssql_trigger',1763740631);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paises`
--

DROP TABLE IF EXISTS `paises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paises` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paises`
--

LOCK TABLES `paises` WRITE;
/*!40000 ALTER TABLE `paises` DISABLE KEYS */;
INSERT INTO `paises` VALUES (1,'pt');
/*!40000 ALTER TABLE `paises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dataReserva` varchar(45) DEFAULT NULL,
  `disponivel` varchar(45) DEFAULT NULL,
  `numPessoas` int DEFAULT NULL,
  `experiencia_id` int NOT NULL,
  `user_id` int NOT NULL,
  `metodoPagamento_id` int NOT NULL,
  `turista_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reserva_experiencia1_idx` (`experiencia_id`),
  KEY `fk_reserva_user1_idx` (`user_id`),
  KEY `fk_reserva_metodoPagamento1_idx` (`metodoPagamento_id`),
  KEY `fk_reserva_turista_idx` (`turista_id`),
  CONSTRAINT `fk_reserva_experiencia1` FOREIGN KEY (`experiencia_id`) REFERENCES `experiencias` (`id`),
  CONSTRAINT `fk_reserva_metodoPagamento1` FOREIGN KEY (`metodoPagamento_id`) REFERENCES `metodopagamentos` (`id`),
  CONSTRAINT `fk_reserva_turista` FOREIGN KEY (`turista_id`) REFERENCES `turistas` (`id`),
  CONSTRAINT `fk_reserva_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,'2/12/2025','sim',NULL,1,3,1,1),(3,'2026-01-05 14:56:55','sim',5,6,3,1,1);
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turistas`
--

DROP TABLE IF EXISTS `turistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turistas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_turista_user` (`user_id`),
  KEY `fk_turista_user_idx` (`user_id`),
  CONSTRAINT `fk_turista_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turistas`
--

LOCK TABLES `turistas` WRITE;
/*!40000 ALTER TABLE `turistas` DISABLE KEYS */;
INSERT INTO `turistas` VALUES (1,3);
/*!40000 ALTER TABLE `turistas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','DC2DzN5_40ZLeuohonyhp9HmBK-PJPol','$2y$13$pe6bvE75YS8HfSUyvMgOJ.TkrSRARAnQbsMpsr2HN9mDgo6OfoLpu',NULL,'admin@gmail.com',10,1763740673,1763740673,'VXjik7mnZEly6bqc58JRHdDD3iN-FoKK_1763740673'),(2,'gestor','QS3uvFPTqwu3W4JomcE_dR5IIYo6fYoQ','$2y$13$lG5Gd1foq7Makx5w8njemezhSrrr2AMI2kAur1.jYFIHEbxT9Vt..',NULL,'gestor@gmail.com',10,1763740687,1763740687,'jitc8Ami6f3nOBYyNKSaCUZO888oYytQ_1763740687'),(3,'turista1','AswynP5F06lGipQCTOeJp-OYRG_4OtvW','$2y$13$ceFy5Y4CL5B7uvwNGU4AxOXxW23CKFsocBMWtbl7giJDTwN/iV4S.',NULL,'turista1@gmail.com',10,1763740710,1763740710,'nhrl3zMvTLu9os2zikRRdfD4MVVCqiMt_1763740710'),(4,'turista2','sN24Wl5R3IStEPGebl-MnDih-LDkLRJc','$2y$13$/gMwde2XZt31HQRV0MRcRO7WuDzSKeG36akpqOHuWmVECQA6W19tq',NULL,'turista2@gmail.com',10,1763740731,1765195122,'EohWd2LHdk0I7tmwVLSkm8oAGsLpK695_1763740731'),(5,'gestor2','GEkePveIZKgd_eda4lXZlMOlemOt8Wn8','$2y$13$Jzfz86HcxQxsNtDdPBNCeus097WmLDNZdDM1GQD5a.qYU1I5B6BMS',NULL,'gestor2@gmail.com',10,1764705774,1764706232,'d9VMehOe6EUk0ZqWp5MuGJeJYZDzp82p_1764705774'),(6,'gestor3','jsCfM0xJJ5tNrSOTlnLwKMJUyEv1yI8P','$2y$13$maHPq.fgvuwlgAWxtnEizuhOTYXE.CC7wKeKlGW9oizn5MqbGIny.',NULL,'gestor3@gmail.com',10,1764706574,1764706608,'D0Q4_XXXw1f1tVzOrmleTHCjUZk1O5qD_1764706574'),(7,'admin2','test-auth-key','$2y$13$nJ7LQbQmPWz5E5y5E5y5E.5E5y5E5y5E5y5E5y5E5y5E5y5E5y5E',NULL,'admin2@example.com',10,1765904076,1765904076,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-06  0:39:10
