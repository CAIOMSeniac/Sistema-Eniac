<?php
header('Content-Type: application/json');
session_start();
include_once('conexao_Banco.php');
if ($_POST['tb'] == 'pessoa'){
    $cod_curriculo = mysqli_real_escape_string($conn,$_POST['idc']);
    $querySql = "SELECT * FROM  `curriculos_pessoa` WHERE `cod_curriculo` = ".$cod_curriculo."";
    $res = mysqli_query($conn,$querySql);
    $resultados=mysqli_fetch_all($res);
    echo json_encode($resultados);
}

else if ($_POST['tb'] == 'experiencia'){
    $cod_curriculo = mysqli_real_escape_string($conn,$_POST['idc']);
    $querySql = "SELECT * FROM  `curriculos_empresas` WHERE `cod_curriculo` = ".$cod_curriculo."";
    $res = mysqli_query($conn,$querySql);
    $resultados=mysqli_fetch_all($res);
    echo json_encode($resultados);
}

else if ($_POST['tb'] == 'conhecimento'){
    $cod_curriculo = mysqli_real_escape_string($conn,$_POST['idc']);
    $querySql = "SELECT * FROM  `curriculos_conhecimento` WHERE `cod_curriculo` = ".$cod_curriculo."";
    $res = mysqli_query($conn,$querySql);
    $resultados=mysqli_fetch_all($res);
    echo json_encode($resultados);
}
else{
    echo json_encode('erro tabela não encontrada');
}
?>