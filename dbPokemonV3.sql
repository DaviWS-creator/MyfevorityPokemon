CREATE DATABASE  IF NOT EXISTS `db_pokemon` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_pokemon`;
-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: db_pokemon
-- ------------------------------------------------------
-- Server version	8.0.46

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
-- Table structure for table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pokemon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `tipo` json NOT NULL,
  `urlImg` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon`
--

LOCK TABLES `pokemon` WRITE;
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` VALUES (1,'Bulbasaur','Durante algum tempo após o nascimento, utiliza os nutrientes contidos na semente em suas costas para crescer.','[\"Grama\"]','https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/001.png'),(3,'Wimpod','É o limpador da natureza — come tudo, inclusive lixo e coisas em decomposição. O chão perto do seu ninho está sempre limpo.','[\"Inseto\", \"Água\"]','https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/767.png'),(4,'Davi','Um homen muito perigoso que vive na sociedade moderna','[\"Fogo\", \"Dragão\"]','img/placeholder_pokeball.svg'),(7,'Anne','Inteligente, sagaz','[\"Fada\"]','img/placeholder_pokeball_final.svg'),(8,'Charizard','Se Charizard ficar realmente irritado, a chama na ponta de sua cauda queima em um tom azul claro.','[\"Fogo\", \"Voador\"]','https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/006.png'),(9,'Mega Charizard X','O poder avassalador que preenche todo o seu corpo faz com que ele fique negro e crie intensas chamas azuis.','[\"Fogo\", \"Dragão\"]','https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/006_f2.png');
/*!40000 ALTER TABLE `pokemon` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-03  1:54:55
