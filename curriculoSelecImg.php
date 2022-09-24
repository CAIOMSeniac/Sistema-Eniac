<?php
header('Content-Type: application/json');
session_start();
include_once('conexao_Banco.php');
$cod_curriculo = mysqli_real_escape_string($conn,$_POST['id_cod']);
$querySql = "SELECT * FROM  `tabela_imagens` WHERE `cod_curriculo` = ".$cod_curriculo."";
$res = mysqli_query($conn,$querySql);
$linha=mysqli_fetch_assoc($res);
echo "<embed src='data:".$linha['tipo_imagem'].";base64,".base64_encode($linha['imagem'])."' class='figure-img img-fluid rounded'/> ";
?>