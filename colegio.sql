-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Set-2022 às 13:44
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `colegio`
--
CREATE DATABASE `colegio`;


--
-- Estrutura da tabela `tabela_imagens`
--

CREATE TABLE `tabela_imagens` (
  `evento` varchar(50) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `nome_imagem` varchar(25) NOT NULL,
  `tamanho_imagem` varchar(25) NOT NULL,
  `tipo_imagem` varchar(25) NOT NULL,
  `imagem` longblob NOT NULL,
  `cod_curriculo` int,
  PRIMARY KEY (`cod_curriculo`)
);

--
-- Extraindo dados da tabela `tabela_imagens`
--

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `codigo` int PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `funcao` varchar(25) NOT NULL,
  `ativo` tinyint(1) NOT NULL);

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`codigo`, `nome`, `email`, `senha`, `funcao`, `ativo`) VALUES
(1, 'nome', 'email', 'senha', 'Adm', 1),
(2, 'nome 2', 'email2', 'senha', 'user', 1),
(3, 'LUCIO LUZETTI CRIADO', 'lucio.luzetti@eniac.edu.br', '123', 'user', 1),
(5, 'teste novo', 'teste@novo.com', '123', 'user', 0),
(6, 'teste', 'teste@teste', '123456', 'Adm', 0);



CREATE TABLE `curriculos_pessoa`(
    `cod_curriculo` int PRIMARY KEY AUTO_INCREMENT,
    `nome_Completo` varchar(150) NOT NULL,
    `cidade` varchar(50) NOT NULL,
    `endereco` text NOT NULL,
    `telefone` varchar(50) NOT NULL,
    `email` varchar(50) NOT NULL,
    `cpf` varchar(50) NOT NULL,
    `rg` varchar(50) NOT NULL,
    `uf` varchar(50) NOT NULL,
    `data_nasc` DATE NOT NULL);

CREATE TABLE `curriculos_empresas`(
    `codigo` int PRIMARY KEY AUTO_INCREMENT,
    `cod_curriculo` int NOT NULL,
    `razao_Social` varchar(50) NOT NULL,
    `periodo_ini` DATE NOT NULL,
    `periodo_fim` DATE NOT NULL,
    `descricao_empresa` TEXT NOT NULL);

CREATE TABLE `curriculos_conhecimento`(
    `codigo` int PRIMARY KEY AUTO_INCREMENT,
    `cod_curriculo` int NOT NULL,
    `Nome_instituicao` varchar(50) NOT NULL,
    `periodo_ini` DATE NOT NULL,
    `periodo_fim` DATE NOT NULL,
    `descricao_academica` TEXT NOT NULL);