<?php
session_start();
include_once('conexao_Banco.php');
if(isset($_POST['DEL_USER'])){;
        $codigo = mysqli_real_escape_string($conn,$_POST['model-cod-u']);
        $querySQL ="DELETE FROM `usuarios` WHERE `codigo` = $codigo";
        $result = mysqli_query($conn,$querySQL);
        header('Location:usuarios.php');
        }


?>