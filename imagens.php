<?php

session_start();
include_once('conexao_Banco.php');
$cond = "1=1 ";
if(isset($_POST['buscar'])){
    if (isset($_POST['MIN_COD_CURRICULO']) && strlen($_POST['MIN_COD_CURRICULO']) > 0) {
        $min = mysqli_real_escape_string($conn,$_POST['MIN_COD_CURRICULO']);
        $cond .= "AND `cod_curriculo` > $min ";
    }
    if (isset($_POST['MAX_COD_CURRICULO']) && strlen($_POST['MAX_COD_CURRICULO']) > 0) {
        $max = mysqli_real_escape_string($conn,$_POST['MAX_COD_CURRICULO']);
        $cond .= "AND `cod_curriculo` < $max ";
    }
    if (isset($_POST['buscaNome'] ) && strlen($_POST['buscaNome']) > 0) {
        $nome = mysqli_real_escape_string($conn,$_POST['buscaNome']);
        $cond .= 'AND `evento` LIKE "%'.$nome.'%" ';
    }}
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
<!--CONDIÇÕES DE BUSCA/ FILTROS-->
<form  method="POST">
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon1">
ENTRE
</span>
 <span class="input-group-text" id="basic-addon1">
 <input type="text" name="MIN_COD_CURRICULO"class="form-control" placeholder="MIN_COD_CURRICULO" aria-label="Username" aria-describedby="basic-addon1">
</span><span class="input-group-text" id="basic-addon1">
 ATÉ
</span><span class="input-group-text" id="basic-addon1">
<input type="text" name="MAX_COD_CURRICULO"class="form-control" placeholder="MAX_COD_CURRICULO" aria-label="Username" aria-describedby="basic-addon1">
</span><span class="input-group-text" id="basic-addon1">Busca</span>
<input type="text" name="buscaNome"class="form-control" placeholder="NOME" aria-label="Username" aria-describedby="basic-addon1">
<span class="input-group-text" id="basic-addon1">
    <button name = 'buscar' class="btn btn-outline-secondary" type="submit">FILTRAR</button>
</span>
</div>
</form>



<table class="table table-striped">
    <caption>lista de usuarios</caption>
   <thead>
    <tr>
      <th scope="col">Evento</th>
      <th scope="col">Descrição</th>
      <th scope="col">Nome da imagem</th>
      <th scope="col">Tipo de imagem</th>
      <th scope="col">Imagem</th>
      <th scope="col">Codigo Curriculo</th>
      <th scope="col">Opção</th>
    </tr>
   </thead>
   <tbody>

    <?php
    ListarUsuarios($cond);
    function ListarUsuarios($condicao){
        $servidor = 'localhost';
        $usuario = 'root';
        $senha = '';
        $banco = 'colegio';
        $conn = new mysqli($servidor, $usuario, $senha, $banco);
        if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());
        $querySql = "SELECT * FROM  `tabela_imagens` WHERE ".$condicao."";
        $res = mysqli_query($conn,$querySql);
        while($linha=mysqli_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$linha["evento"]."</td>";
            echo "<td>".$linha["descricao"]."</td>";
            echo "<td>".$linha["nome_imagem"]."</td>";
            echo "<td>".$linha["tipo_imagem"]."</td>";
            echo "<td><embed src='data:".$linha['tipo_imagem'].";base64,".base64_encode($linha['imagem'])."' width='200' class='rounded'/> </td>";
            echo "<td>".$linha["cod_curriculo"]."</td>";
            echo "<td><button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#DeletaImg' NOMEImg='".$linha["evento"]."' CODImg='".$linha["codigo"]."'>
            DELETAR</button></td>";
            echo "</tr>";
        }
    }
    ?>
  </tbody>
 </table>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaImg">
CRIAR NOVA
</button>





<div class="modal fade" id="CriaImg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrando nova imagem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form action="imagemNova.php" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Evento:</label>
            <input type="text" name="model-evento" class="form-control" id="model-evento">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Descrição:</label>
            <input type="text" name="model-desc" class="form-control" id="model-desc">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Cod_Curriculo:</label>
            <input type="text" name="model-codcurriculo" class="form-control" id="model-codcurriculo">
          </div>
          <div class="mb-3">
          <label for="formFileSm" class="form-label">Imagem</label>
          <input class="form-control form-control-sm" id="formFileSm" type="file" name = "meuarquivo" id="meuarquivo" accept="image/*">
          </div>
      </div>
      <div class="modal-footer">
        <button  id="CriaImg" name='CriaImg' type="submit" class="btn btn-primary">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>





<div class="modal fade" id="DeletaImg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DELETANDO USUARIO: </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h7>TEM CERTEZA QUE DESEJA DELETAR ESTÁ IMAGEM?</h7>
        <form action="imagemDel.php" method="POST">
            <input type="hidden" name="model-cod-u" class="form-control" id="model-cod-u">
      </div>
      <div class="modal-footer">
        <button  id="DEL_IMG" name='DEL_IMG' type="submit" class="btn btn-primary">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<script>
const DelModal = document.getElementById('DeletaImg')
DelModal.addEventListener('show.bs.modal', event => {

  const button = event.relatedTarget


  const nome = button.getAttribute('NOMEImg')
  const cod = button.getAttribute('CODImg')


  const modalTitle = DelModal.querySelector('.modal-title')
  const modalCod = DelModal.querySelector('#model-cod-u')

  modalTitle.textContent = `DELETANDO IMAGEM: ${nome}`
  modalCod.value = cod
});

</script>