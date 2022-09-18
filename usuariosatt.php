<?php
session_start();
include_once('conexao_Banco.php');
if(isset($_POST['Alterar_valor'])){;
        $querySQL ="UPDATE `usuarios` SET ";
        if (isset($_POST['model-cargo'])) {
                $querySQL .="`funcao`='Adm'";
        }else{
                $querySQL .="`funcao`='User'";
        }
        if (isset($_POST['model-ativo'])) {
                $querySQL .=",`ativo`= 1 ";
        }else{
                $querySQL .=",`ativo`= 0 ";
        }
        $nome = mysqli_real_escape_string($conn,$_POST['model-nome']);
        $senha = mysqli_real_escape_string($conn,$_POST['model-senha']);
        $email = mysqli_real_escape_string($conn,$_POST['model-email']);
        $codigo = mysqli_real_escape_string($conn,$_POST['model-cod']);
        $querySQL .=",`nome`='$nome',
        `email`='$email',`senha`='$senha'
        WHERE `codigo`='$codigo'";
        $result = mysqli_query($conn,$querySQL);
        header('Location:usuarios.php');
        }


?>