<?php
session_start();
include_once('conexao_Banco.php');
$Identi = mysqli_real_escape_string($conn,$_POST['ident']);
$querySQL ="DELETE FROM `curriculos_conhecimento` WHERE `codigo` ='".$Identi."'";
$result = mysqli_query($conn,$querySQL);
?>