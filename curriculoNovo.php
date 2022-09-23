<?php
session_start();
include_once('conexao_Banco.php');
if(isset($_POST['CriaCurr'])){;
        $querySQL ="INSERT INTO `curriculos_pessoa`(`nome_Completo`, `cidade`, `endereco`, `telefone`, `email`, `cpf`, `rg`, `uf`, `data_nasc`)
        VALUES (";
        $nome = mysqli_real_escape_string($conn,$_POST['model-NOME']);
        $cidade = mysqli_real_escape_string($conn,$_POST['model-CIDADE']);
        $endereco = mysqli_real_escape_string($conn,$_POST['model-ENDERECO']);
        $telefone = mysqli_real_escape_string($conn,$_POST['model-TELEFONE']);
        $email = mysqli_real_escape_string($conn,$_POST['model-EMAIL']);
        $cpf = mysqli_real_escape_string($conn,$_POST['model-CPF']);
        $rg = mysqli_real_escape_string($conn,$_POST['model-RG']);
        $uf = mysqli_real_escape_string($conn,$_POST['model-UF']);
        $data_nasc = mysqli_real_escape_string($conn,$_POST['model-DATA_NASC']);
        $querySQL .="'$nome','$cidade','$endereco','$telefone','$email','$cpf','$rg','$uf','$data_nasc')";
        echo $querySQL;
        $result = mysqli_query($conn,$querySQL);
        header('Location:curriculo.php');
        }


?>