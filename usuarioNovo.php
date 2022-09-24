<?php
session_start();
include_once('conexao_Banco.php');;
$querySQL ="INSERT INTO `usuarios`(`funcao`, `ativo`,`nome`, `email`, `senha`)
VALUES (";
if ($_POST['administrador'] == "1") {
        $querySQL .="'Adm' ";
}else{
        $querySQL .="'User' ";
}
if ($_POST['ativado'] == "1") {
        $querySQL .=",1 ";
}else{
        $querySQL .=",0 ";
}
$nome = mysqli_real_escape_string($conn,$_POST['nome']);
$senha = mysqli_real_escape_string($conn,$_POST['senha']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$querySQL .=",'$nome','$email','$senha')";
$result = mysqli_query($conn,$querySQL);


?>