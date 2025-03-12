# Host: localhost:3399  (Version 5.5.5-10.4.22-MariaDB)
# Date: 2023-10-27 12:24:08
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "usuarios"
#

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(11) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `razao_social` varchar(150) DEFAULT NULL,
  `tributo` varchar(20) DEFAULT NULL,
  `nome_fantasia` varchar(50) DEFAULT NULL,
  `telefone_empresa` varchar(10) DEFAULT NULL,
  `cep` varchar(8) DEFAULT NULL,
  `logradouro` varchar(150) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `complemento` varchar(30) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "usuarios"
#

INSERT INTO `usuarios` VALUES (1,'48425476852',NULL,'2006-01-05',NULL,'11111111111','filippettoleonardo@gmail.com','$2y$12$zgwPTCrYSsxV5anaiKfKaeRc0yCDJw7.Dcshkt/pncHC67BXFHJcG','Leonardo Filippetto',NULL,NULL,NULL,NULL,'13081030','rua dos Aimorés','480','Apto. P13','Vila Costa e Silva','Campinas',NULL,'ao lado do mercado Dia'),(5,'51625366876','','2005-05-15',NULL,'19987802721','filipeglima2005@gmail.com','$2y$12$TN7acL87L.t/JUcAHxFJ5e0iImi6nQJL0n0ZRIU6fgonbzscnjY7S','Filipe Gabriel Ferreira de Lima','','','','','13057082','Rua Jessé de Almeida','869','Casa','Citta di Firenze','Campinas',NULL,'Construção de uma creche'),(7,'53172719839','','2005-10-24',NULL,'19982783882','pedrojoao6378@gmail.com','$2y$12$Xn06541qORUabRVUEV29Ve7jUBZOTManM9Or9FgdUaiEP2EZO8NeG','João Pedro Santos ','','','','','13185490','lugar livre destinado à circulação pública de pedestres e veículos, tal como ruas, avenidas, praças, viadutos etc.','80','Bloco B ap.144','Rozolem','hortôlandia',NULL,'Campo de futebol'),(8,'','38199818000158','2023-09-18',NULL,'19994740046','jksgolden@gmail.com','$2y$12$Zv5ayLbb/jYHHoxXgf/F5eKpIXDFalmBKfuVkms7OLcCgl5qCKAHa','Pedro burro','Friv jogos','isento','Ei sou burro para caralho ','1971436845','13107110','José de Alencar ','768','Aaaa','Jacinto pinto','Campinas',NULL,'Aaaaa'),(9,'53242735897','','2005-09-30',NULL,'19997148394','geovanispop@gmail.com','$2y$12$/wTQAXr78XC7AOyDe/qNBeJ3KUFEQjv.yD/IwYbvY5gzHSHIiejqu','Geovani orsoli','','','','','13060287','jd ibirapuera','189','casa','Jardim Ibirapuera','campinas',NULL,'casa '),(10,'43332461800','','2005-09-28',NULL,'19987620650','ribasjonatas@gmail.com','$2y$12$He8lIqxzWliRY4fCdKcYf.CSJr8qQGvCekAqAI7epB/YecfW/jVf2','Jônatas r','','','','','13088032','Rua josé ramon aboim gomes','252','','Vila Nogueira','campinas',NULL,'Casa Ronald McDonald Campinas'),(11,'51625366876','','2005-05-15','Masculino','19987802721','gl8923443@gmail.com','$2y$12$bHn6toilcky3zbR0TmFU1eWU7R7her./ccSFWbBBDqNQEp2jrA8ES','João Santos','','','','','13057082','DAWDASD','869','Casa','Firenze','Campinas',NULL,'Casa');
