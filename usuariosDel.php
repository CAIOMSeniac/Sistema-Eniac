<?php
header('Content-Type: application/json');
session_start();
include_once('conexao_Banco.php');
$codigo = mysqli_real_escape_string($conn,$_POST['id_cod']);
$querySQL ="DELETE FROM `usuarios` WHERE `codigo` = $codigo";
$result = mysqli_query($conn,$querySQL);
?>