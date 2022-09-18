<?php

session_start();
include_once('conexao_Banco.php');
function consulta_usuarios($condicao){
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'colegio';
    $conn = new mysqli($servidor, $usuario, $senha, $banco);
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    $querySql = "SELECT * FROM  `usuarios` WHERE ".$condicao."";
    $result = mysqli_query($conn,$querySql);
    $row = mysqli_num_rows($result);
    return $row;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- LINKS DO BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!--Google Graph-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!---->
    <link rel="stylesheet" type="text/css" href="styleGen.css">
    <link rel="icon" type="imagem/png" href="https://portalacademico.eniac.edu.br/pluginfile.php/1/theme_snap/favicon/1663305488/favicon-32.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto</title>
</head>
<body>
    <br>
    <?php
    echo "<h1>".$_SESSION['cargo']."</h1>";
    if($_SESSION['cargo'] == "Adm"){
        echo "<a href='usuarios.php' target='_blank'>Alterar usuarios</a>";
    }
    ?>
    <br>
    <a href='#' target='_blank'>curriculos</a>
    <br>
    <a href='imagens.php' target='_blank'>imagens</a>
    <br>
    <a href='logout.php'>logout</a>
<br><br>
<?php
echo "<h5>perfis que:</h5>";
echo "<h5> tem o perfil ativo ".consulta_usuarios('`ativo` = 1')."</h5>";
echo "<h5> tem o perfil desativo ".consulta_usuarios('`ativo` = 0')."</h5>";
echo "<h5> tem a funcao Adm ".consulta_usuarios('`funcao` = "Adm"')."</h5>";
echo "<h5> tem a funcao User ".consulta_usuarios('`funcao` = "User"')."</h5>";
?>
</body>
</html>