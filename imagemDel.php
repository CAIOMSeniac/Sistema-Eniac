<?php
session_start();
include_once('conexao_Banco.php');
if(isset($_POST['DEL_IMG'])){;
        $codigo = mysqli_real_escape_string($conn,$_POST['model-cod-u']);
        $querySQL ="DELETE FROM `tabela_imagens` WHERE `codigo` = $codigo";
        $result = mysqli_query($conn,$querySQL);
        header('Location:curriculo.php');
        }


?>