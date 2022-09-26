<?php
session_start();
include_once('conexao_Banco.php');
$querySQL ="UPDATE `curriculos_pessoa` SET ";
$nome = mysqli_real_escape_string($conn,$_POST['NOME']);
$cidade = mysqli_real_escape_string($conn,$_POST['CIDADE']);
$endereco = mysqli_real_escape_string($conn,$_POST['ENDERECO']);
$telefone = mysqli_real_escape_string($conn,$_POST['TELEFONE']);
$email = mysqli_real_escape_string($conn,$_POST['EMAIL']);
$cpf = mysqli_real_escape_string($conn,$_POST['CPF']);
$rg = mysqli_real_escape_string($conn,$_POST['RG']);
$uf = mysqli_real_escape_string($conn,$_POST['UF']);
$data_nasc = mysqli_real_escape_string($conn,$_POST['DATA_NASC']);
$cd = mysqli_real_escape_string($conn,$_POST['cod_curriculo']);
$querySQL .="`nome_Completo`='$nome',`cidade`='$cidade',`endereco`='$endereco',`telefone`='$telefone',
`email`='$email',`cpf`='$cpf',`rg`='$rg',`uf`='$uf',`data_nasc`='$data_nasc'
WHERE `cod_curriculo`='$cd'";
$result = mysqli_query($conn,$querySQL);
?>