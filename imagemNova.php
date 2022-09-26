<?php
session_start();
include_once('conexao_Banco.php');
$evento = mysqli_real_escape_string($conn,$_POST['EVENTO']);
$desc = mysqli_real_escape_string($conn,$_POST['DESCRI']);
$cd = mysqli_real_escape_string($conn,$_POST['cod_curriculo']);
$nome = $_FILES['meuarquivo']['name'];
$tipo = $_FILES['meuarquivo']['type'];
$tamanho = $_FILES['meuarquivo']['size'];
$data = $_FILES['meuarquivo']['tmp_name'];
$fp = fopen($data, "rb");
$conteudo = fread($fp, $tamanho);
$conteudo = addslashes($conteudo);
fclose($fp);
$erro = $_FILES['meuarquivo']['error'];
if($erro < 1){
    $querySQL =  "DELETE FROM `tabela_imagens` WHERE `cod_curriculo` = '".$cd."'";
    $result = mysqli_query($conn,$querySQL);
    $querySQL ="INSERT INTO `tabela_imagens`(`evento`, `descricao`, `nome_imagem`,
                            `tamanho_imagem`, `tipo_imagem`, `imagem`, `cod_curriculo`)
                VALUES ('".$evento."','".$desc."','".$nome."',
                        '".$tamanho."','".$tipo."','".$conteudo."',".$cd.")";
    $result = mysqli_query($conn,$querySQL);
}
?>