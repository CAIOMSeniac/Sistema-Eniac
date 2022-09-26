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

function consulta_exper(){
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'colegio';
    $conn = new mysqli($servidor, $usuario, $senha, $banco);
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    $querySql = "SELECT DISTINCT `cod_curriculo` FROM `curriculos_empresas`";
    $result = mysqli_query($conn,$querySql);
    $row = mysqli_num_rows($result);
    return $row;
}
function consulta_curriculosSemExp(){
    $servidor = 'localhost';
    $usuario = 'root';
    $senha = '';
    $banco = 'colegio';
    $conn = new mysqli($servidor, $usuario, $senha, $banco);
    if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
    $querySql = "SELECT * FROM `curriculos_pessoa`";
    $result = mysqli_query($conn,$querySql);
    $row = mysqli_num_rows($result);
    return ($row - consulta_exper());
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
<style type="text/css">
.gruda {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 10;
}
.container{
    text-align: center;
    align-items: center;
    background-color: rgba(255, 255, 255, 0.342);
    margin-top: 40px;
    box-shadow: 0 0 10px #0000003a,0 0 20px #0000003a,0 0 30px #0000003a,0 0 50px #0000003a;
    padding: 40px 40px;
    border: 1px solid rgba(255, 225, 255, 0.2);
    border-radius: 20px;
}
</style>
<nav class="navbar navbar-expand-lg bg-light gruda">
    <img src="https://www.eniac.com.br/hs-fs/hubfs/Logos-Eniac-2019-1.png?width=1150&name=Logos-Eniac-2019-1.png" class='figure-img img-fluid rounded' width="200px">
  <div class="container-fluid">
    <div class="navbar-brand">
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <?php echo "<h3>".$_SESSION['cargo']."</h3>";?>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
        </li>
        <?php
        if($_SESSION['cargo'] == "Adm"){
            echo '
           <li class="nav-item">
            <a class="nav-link" href="usuarios.php">Usuários</a>
           </li>';
        }
        ?>
        <li class="nav-item">
          <a class="nav-link" href="curriculo.php">Currículo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br>

<section class="container">
  <h1>Dashboard</h1>
<div id="donutchart" style="width: 900px; height: 500px;"></div>

<div id="piechart" style="width: 900px; height: 500px;"></div>

<div id="columnchart_values" style="width: 900px; height: 300px;"></div>
<br><br><br><br>
</section>
<?php
echo '<script type="text/javascript">
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Tipo", "Hours per Day"],
    ["ativos",     '.consulta_usuarios('`ativo` = 1').'],
    ["desativos",      '.consulta_usuarios('`ativo` = 0').']
  ]);

  var options = {
    title: "Usuarios ativos",
    pieHole: 0.4,
  };

  var chart = new google.visualization.PieChart(document.getElementById("donutchart"));
  chart.draw(data, options);
}
</script>';


echo '<script type="text/javascript">
google.charts.load("current", {"packages":["corechart"]});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

  var data = google.visualization.arrayToDataTable([
    ["Cargo", "Quantidade"],
    ["ADM",     '.consulta_usuarios('`funcao` = "Adm"').'],
    ["USER",    '.consulta_usuarios('`funcao` = "User"').']
  ]);

  var options = {
    title: "Cargos dos usuarios"
  };

  var chart = new google.visualization.PieChart(document.getElementById("piechart"));

  chart.draw(data, options);
}
</script>';

echo '<script type="text/javascript">
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Currículo", "Currículos", { role: "style" } ],
    ["Currículos sem experiência", '.consulta_curriculosSemExp().', "#3266CC"],
    ["Currículos com experiência", '.consulta_exper().', "#DC3812"]
  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "Currículos com experiência",
    width: 600,
    height: 400,
    bar: {groupWidth: "95%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
  chart.draw(view, options);
}
</script>';
?>
</body>
</html>