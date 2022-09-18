<?php
session_start();
include_once('conexao_Banco.php');
$cond = "1=1 ";
if(isset($_POST['buscar'])){
    if (isset($_POST['ATIVOS'])) {
        $cond .= "AND `ativo` = 1 ";
    }
    if (isset($_POST['DESATIVOS'])) {
        $cond .= "AND `ativo` = 0 ";
    }
    if (isset($_POST['ADM'])) {
        $cond .= 'AND `funcao` = "Adm" ';
    }
    if (isset($_POST['USER'])) {
        $cond .= 'AND `funcao` = "User" ';
    }
};
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- LINKS DO BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
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
<form action="usuarios.php" method="POST">
<div class="input-group mb-3">
 <span class="input-group-text" id="basic-addon1">
    <input name='ATIVOS' type="checkbox" class="btn-check" id="btn-check"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check">ATIVOS</label>
</span><span class="input-group-text" id="basic-addon1">
    <input name="DESATIVOS" type="checkbox" class="btn-check" id="btn-check-2"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check-2">NÃO ATIVOS</label>
</span><span class="input-group-text" id="basic-addon1">
    <input name="ADM" type="checkbox" class="btn-check" id="btn-check-3"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check-3">ADMINISTRADORES</label>
</span><span class="input-group-text" id="basic-addon1">
    <input name="USER" type="checkbox" class="btn-check" id="btn-check-4"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check-4">USUARIOS</label>
</span><span class="input-group-text" id="basic-addon1">Busca</span>
<input type="text" id="buscaNome"class="form-control" placeholder="NOME" aria-label="Username" aria-describedby="basic-addon1">
<span class="input-group-text" id="basic-addon1">
    <button name = 'buscar' class="btn btn-outline-secondary" type="submit">FILTRAR</button>
</span>
</div>
</form>
<table class="table table-striped">
    <caption>lista de usuarios</caption>
   <thead>
    <tr>
      <th scope="col">nome</th>
      <th scope="col">email</th>
      <th scope="col">senha</th>
      <th scope="col">cargo</th>
      <th scope="col">ativo</th>
      <th scope="col">opções</th>
    </tr>
   </thead>
   <tbody>
    <?php
    ListarUsuarios($cond);
    function ListarUsuarios($condicao){
        ob_start();
        ob_end_clean();
        $servidor = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'colegio';
        $conn = new mysqli($servidor, $usuario, $senha, $banco);
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
        $querySql = "SELECT * FROM `usuarios` WHERE ".$condicao."";
        $res = mysqli_query($conn,$querySql);
        while($linha=mysqli_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$linha["nome"]."</td>";
            echo "<td>".$linha["email"]."</td>";
            echo "<td>".$linha["senha"]."</td>";
            echo "<td>".$linha["funcao"]."</td>";
            echo "<td>".$linha["ativo"]."</td>";
            echo '<td><div class="dropdown">
            <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Small button
            </button>
            <ul class="dropdown-menu">
            <li class="dropdown-item">teste</li>
            <li class="dropdown-item"></li>
            <li><hr class="dropdown-divider"></li>
            <li class="dropdown-item"></li>
            </ul>
          </div>
          </td>';
            echo "</tr>";
        }
    }
    ?>
  </tbody>
 </table>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>