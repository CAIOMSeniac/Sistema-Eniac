<?php
header('Content-Type: application/json');
session_start();
include_once('conexao_Banco.php');
$querySQL ="UPDATE `usuarios` SET ";
if ($_POST['administrador'] == "true") {
        $querySQL .="`funcao`='Adm'";
}else{
        $querySQL .="`funcao`='User'";
}
if ($_POST['ativado'] == "true") {
        $querySQL .=",`ativo`= 1 ";
}else{
        $querySQL .=",`ativo`= 0 ";
}
$nome = mysqli_real_escape_string($conn,$_POST['nome']);
$senha = mysqli_real_escape_string($conn,$_POST['senha']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$codigo = mysqli_real_escape_string($conn,$_POST['id_cod']);
$querySQL .=",`nome`='$nome',
`email`='$email',`senha`='$senha'
WHERE `codigo`='$codigo'";
$result = mysqli_query($conn,$querySQL);
?>