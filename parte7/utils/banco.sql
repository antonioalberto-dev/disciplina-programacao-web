-- CRIAÇÃO DO BANCO DE DADOS E DELETAR SE JÁ EXISTIR UM BD COM NOME IGUAL

DROP DATABASE IF EXISTS `login_prog_web`;
CREATE DATABASE IF NOT EXISTS `login_prog_web`;
USE `login_prog_web`;

-- CRIAÇÃO DO BANCO DE DADOS E DELETAR SE JÁ EXISTIR UM BD COM NOME IGUAL

DROP TABLE IF EXISTS `user_login`;
CREATE TABLE IF NOT EXISTS `user_login` (
  `cpf` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`cpf`)
);