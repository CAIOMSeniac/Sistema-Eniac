<?php
header('Content-Type: application/json');
session_start();
include_once('conexao_Banco.php');
$cond = "1=1 ";
if ($_POST['ativo'] == "true") {
    $cond .= "AND `ativo` = 1 ";
}
if ($_POST['desat'] == "true") {
    $cond .= "AND `ativo` = 0 ";
}
if ($_POST['adm'] == "true") {
    $cond .= 'AND `funcao` = "Adm" ';
}
if ($_POST['use'] == "true") {
    $cond .= 'AND `funcao` = "User" ';
}
if (strlen($_POST['non']) > 0) {
    $nome = mysqli_real_escape_string($conn,$_POST['non']);
    $cond .= 'AND `nome` LIKE "%'.$nome.'%" ';
}
$querySql = "SELECT * FROM `usuarios` WHERE ".$cond."";
$res = mysqli_query($conn,$querySql);
$resultados=mysqli_fetch_all($res);
echo json_encode($resultados);
?>