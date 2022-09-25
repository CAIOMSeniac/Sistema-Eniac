<?php
session_start();
include_once('conexao_Banco.php');
$querySQL ="INSERT INTO `curriculos_pessoa`(`nome_Completo`, `cidade`, `endereco`, `telefone`, `email`, `cpf`, `rg`, `uf`, `data_nasc`)
VALUES (";
$nome = mysqli_real_escape_string($conn,$_POST['NOME']);
$cidade = mysqli_real_escape_string($conn,$_POST['CIDADE']);
$endereco = mysqli_real_escape_string($conn,$_POST['ENDERECO']);
$telefone = mysqli_real_escape_string($conn,$_POST['TELEFONE']);
$email = mysqli_real_escape_string($conn,$_POST['EMAIL']);
$cpf = mysqli_real_escape_string($conn,$_POST['CPF']);
$rg = mysqli_real_escape_string($conn,$_POST['RG']);
$uf = mysqli_real_escape_string($conn,$_POST['UF']);
$data_nasc = mysqli_real_escape_string($conn,$_POST['DATA_NASC']);
$querySQL .="'$nome','$cidade','$endereco','$telefone','$email','$cpf','$rg','$uf','$data_nasc')";
$result = mysqli_query($conn,$querySQL);
?>