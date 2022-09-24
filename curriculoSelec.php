<?php
header('Content-Type: application/json');
session_start();
include_once('conexao_Banco.php');
$cond = "1=1 ";
if (isset($_POST['NomeCur'] ) && strlen($_POST['NomeCur']) > 0) {
    $nome = mysqli_real_escape_string($conn,$_POST['NomeCur']);
    $cond .= 'AND `nome_Completo` LIKE "%'.$nome.'%" ';
}
if (isset($_POST['MINCodigo']) && strlen($_POST['MINCodigo']) > 0) {
    $min = mysqli_real_escape_string($conn,$_POST['MINCodigo']);
    $cond .= "AND `cod_curriculo` >= $min ";
}
if (isset($_POST['MAXCodigo']) && strlen($_POST['MAXCodigo']) > 0) {
    $max = mysqli_real_escape_string($conn,$_POST['MAXCodigo']);
    $cond .= "AND `cod_curriculo` <= $max ";
}

$querySql = "SELECT * FROM  `curriculos_pessoa` WHERE ".$cond."";
$res = mysqli_query($conn,$querySql);
$resultados=mysqli_fetch_all($res);
echo json_encode($resultados);
?>