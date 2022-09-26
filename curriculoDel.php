<?php
session_start();
include_once('conexao_Banco.php');
$Identi = mysqli_real_escape_string($conn,$_POST['ident']);
$querySQL ="DELETE FROM `curriculos_empresas` WHERE `cod_curriculo` ='".$Identi."'";
$result = mysqli_query($conn,$querySQL);
$querySQL ="DELETE FROM `curriculos_conhecimento` WHERE `cod_curriculo` ='".$Identi."'";
$result = mysqli_query($conn,$querySQL);
$querySQL =  "DELETE FROM `tabela_imagens` WHERE `cod_curriculo` = '".$Identi."'";
$result = mysqli_query($conn,$querySQL);
$querySQL =  "DELETE FROM `curriculos_pessoa` WHERE `cod_curriculo` = '".$Identi."'";
$result = mysqli_query($conn,$querySQL);
?>