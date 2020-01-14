CREATE SCHEMA `cactus` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE cactus;

CREATE TABLE `cactus`.`usuario` (
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`email`));
  
CREATE TABLE `cactus`.`notas` (
  `idnotas` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(50) NOT NULL,
  `descricao` VARCHAR(5000),
  `importancia` TINYINT NOT NULL,
  `cor` VARCHAR(15) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idnotas`));

SELECT * FROM usuario WHERE email = "rogerbernardo007@gmail.com";
SELECT * FROM notas where email = 'rogerbernardo007@gmail.com' and urgencia = '1';
SELECT * FROM usuario;
DELETE FROM notas;
DELETE FROM usuario;
DROP DATABASE cactus;

INSERT INTO usuario (nome, email, senha) VALUES ('Roger Bernardo', 'rogerbernardo007@gmail.com', '00000');