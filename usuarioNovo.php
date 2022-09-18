<?php
session_start();
include_once('conexao_Banco.php');
if(isset($_POST['CriarUser'])){;
        $querySQL ="INSERT INTO `usuarios`(`funcao`, `ativo`,`nome`, `email`, `senha`)
        VALUES (";
        if (isset($_POST['model-cargo'])) {
                $querySQL .="'Adm' ";
        }else{
                $querySQL .="'User' ";
        }
        if (isset($_POST['model-ativo'])) {
                $querySQL .=",1 ";
        }else{
                $querySQL .=",0 ";
        }
        $nome = mysqli_real_escape_string($conn,$_POST['model-nome']);
        $senha = mysqli_real_escape_string($conn,$_POST['model-senha']);
        $email = mysqli_real_escape_string($conn,$_POST['model-email']);
        $codigo = mysqli_real_escape_string($conn,$_POST['model-cod']);
        $querySQL .=",'$nome','$email','$senha')";
        $result = mysqli_query($conn,$querySQL);
        header('Location:usuarios.php');
        }


?>