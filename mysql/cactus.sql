CREATE SCHEMA `cactus` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE cactus;

CREATE TABLE `cactus`.`usuario` (
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  PRIMARY KEY (`email`));
  
CREATE TABLE `cactus`.`notas` (
  `idnotas` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(5000),
  `importancia` TINYINT NOT NULL,
  `cor` VARCHAR(15) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idnotas`));

SELECT * FROM usuario;
SELECT * FROM notas;
DELETE FROM notas;
DELETE FROM usuario;
DROP DATABASE cactus;

