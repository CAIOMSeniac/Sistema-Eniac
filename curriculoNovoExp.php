<?php
session_start();
include_once('conexao_Banco.php');
$querySQL ="INSERT INTO `curriculos_empresas`(`cod_curriculo`, `razao_Social`, `periodo_ini`, `periodo_fim`, `descricao_empresa`)
VALUES (";
$nome = mysqli_real_escape_string($conn,$_POST['NOME']);
$dataFim = mysqli_real_escape_string($conn,$_POST['DATA_FIM']);
$dataIni = mysqli_real_escape_string($conn,$_POST['DATA_INI']);
$descricao = mysqli_real_escape_string($conn,$_POST['DESCRICAO']);
$cod_curriculo = mysqli_real_escape_string($conn,$_POST['cod_curriculo']);
$querySQL .="'$cod_curriculo','$nome','$dataIni','$dataFim','$descricao')";
$result = mysqli_query($conn,$querySQL);
?>