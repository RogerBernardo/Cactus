CREATE SCHEMA `cactus` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;

USE darkbook;

CREATE TABLE `cactus`.`usuario` (
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NULL,
  PRIMARY KEY (`email`));
  
CREATE TABLE `cactus`.`notas` (
  `idnotas` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(1500) NULL,
  `urgencia` TINYINT NOT NULL,
  `cor` VARCHAR(15) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idnotas`));

