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
        $cond .= 'AND `nome_Completo` LIKE "%'.$nome.'%" ';
    }}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- LINKS DO BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!--Ajax entre outros-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

<button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#Curriculo' NOMEImg='' CODImg=''>
Mostrar curriculo</button>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AlterarCurriculo">
ALTERA CURRICULO
</button>

<table class="table table-striped">
    <caption>lista de curriculos</caption>
   <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Visualizar</th>
      <th scope="col">Alterar Curriculo</th>
      <th scope="col">Deletar Curriculo</th>
      <th scope="col">Codigo Curriculo</th>

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
        $querySql = "SELECT * FROM  `curriculos_pessoa` WHERE ".$condicao."";
        $res = mysqli_query($conn,$querySql);
        while($linha=mysqli_fetch_assoc($res)){
            echo "<tr>";
            echo "<td>".$linha["nome_Completo"]."</td>";
            echo "<td>
            <button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#Curriculo' 
            NOME='".$linha["nome_Completo"]."' DATANASC='".$linha["data_nasc"]."' ENDERECO='".$linha["endereco"]."' 
            CIDADE='".$linha["cidade"]."' EMAIL='".$linha["email"]."' TELL='".$linha["telefone"]."' 
            CODCURR ='".$linha["cod_curriculo"]."' onclick='carregaImg(".$linha["cod_curriculo"].")'>
            Mostrar curriculo
            </button>
            </td>";
            echo "<td>
            <button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#AtualizaCurriculo' 
            CODCURR ='".$linha["cod_curriculo"]."'>
            Atualizar curriculo
            </button>
            </td>";
            echo "<td>
            <button type='button' class='dropdown-item' data-bs-toggle='modal' data-bs-target='#Curriculo' 
            CODCURR ='".$linha["cod_curriculo"]."'>
            Deletar curriculo
            </button>
            </td>";
            echo "<td>".$linha["cod_curriculo"]."</td>";
            echo "</tr>";
        }
    }
    ?>
  </tbody>
 </table>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
CRIAR NOVO CURRICULO
</button>





<div class="modal fade" id="Curriculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CURRICULO DE:  </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container text-center">
          <div class="row">
            <div class="col-sm-5">
             <?php
              function imagemCurriculo($cod_cur){
                $servidor = 'localhost';
                $usuario = 'root';
                $senha = '';
                $banco = 'colegio';
                $conn = new mysqli($servidor, $usuario, $senha, $banco);
                $querySql = "SELECT * FROM  `tabela_imagens` WHERE `cod_curriculo` = ".$cod_cur."";
                $res = mysqli_query($conn,$querySql);
                while($linha=mysqli_fetch_assoc($res)){
                  echo "<embed src='data:".$linha['tipo_imagem'].";base64,".base64_encode($linha['imagem'])."' class='figure-img img-fluid rounded'/>";
                }
              }
             ?>
            </div>
            <div class="col-sm-7">
              <h5 class="nomeComp">NOME COMPLETO</h5>
              <hr>
              <h6 class="data_nasc">data de nascimento</h6>
              <h6 class="endereco">endereco</h6>
              <h6 class="tell">tel</h6>
              <h6 class="email">email</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-sm btn btn-primary">
              Formação academica
              <hr>
              <h5>NOME COMPLETO</h5>
              <h6>data de nascimento</h6>
              <h6>data de nascimento</h6>
              <h6>data de nascimento</h6>
              <h6>data de nascimento</h6>
            </div>
          </div>
          <div class="row">
            <div class="col-sm btn btn-primary">
              Experiencia profissional
              <hr>
              <h5>NOME COMPLETO</h5>
              <h6>data de nascimento</h6>
              <h6>data de nascimento</h6>
              <h6>data de nascimento</h6>
              <h6>data de nascimento</h6>
            </div>
          </div>
        </div>
    </div>
  </div>
  </div>
  </div>




<div class="modal fade" id="CriaCurriculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrando novo Curriculo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form action="curriculoNovo.php" method="POST">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> NOME COMPLETO:</label>
            <input type="text" name="model-NOME" class="form-control" id="model-NOME">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">RG:</label>
            <input type="text" name="model-RG" class="form-control" id="model-RG">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">CPF:</label>
            <input type="text" name="model-CPF" class="form-control" id="model-CPF">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">UF:</label>
            <input type="text" name="model-UF" class="form-control" id="model-UF">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">DATA NASCIMENTO:</label>
            <input type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_NASC">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">CIDADE:</label>
            <input type="text" name="model-CIDADE" class="form-control" id="model-CIDADE">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">ENDEREÇO:</label>
            <input type="text" name="model-ENDERECO" class="form-control" id="model-ENDERECO" placeholder="RUA, 123 ">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">EMAIL:</label>
            <input type="text" name="model-EMAIL" class="form-control" id="model-EMAIL" placeholder="email@email.com.br">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">TELEFONE:</label>
            <input type="text" name="model-TELEFONE" class="form-control" id="model-TELEFONE" placeholder="+55 11 12345-6789">
          </div>
      </div>
      <div class="modal-footer">
        <button  id="CriaCurr" name='CriaCurr' type="submit" class="btn btn-primary">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>





<div class="modal fade" id="AtualizaCurriculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CURRICULO DE:  </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
      Novo conhecimento/escolaridade
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
      Nova experiencia
      </button>
    </div>
  </div>
  </div>
  </div>







</body>
</html>



<script type="text/javascript">
const CurriculoModal = document.getElementById('Curriculo')
CurriculoModal.addEventListener('show.bs.modal', event => {

  const button = event.relatedTarget;


  const nome = button.getAttribute('NOME');
  const data_nasc = button.getAttribute('DATANASC');
  const endereco = button.getAttribute('ENDERECO');
  const cidade = button.getAttribute('CIDADE');
  const email = button.getAttribute('EMAIL');
  const tell = button.getAttribute('TELL');



  //const modalCod = CurriculoModal.querySelector('#model-cod-u')
  const modalTitle = CurriculoModal.querySelector('.modal-title');
  const modalnomec = CurriculoModal.querySelector('.nomeComp');
  const modaldatanasc = CurriculoModal.querySelector('.data_nasc');
  const modalendereco = CurriculoModal.querySelector('.endereco');
  const modaltelef = CurriculoModal.querySelector('.tell');
  const modalemail = CurriculoModal.querySelector('.email');

  modalTitle.textContent = `Curriculo de: ${nome}`;
  modalnomec.textContent = `${nome}`;
  modaldatanasc.textContent = `data de nascimento: ${data_nasc}`;
  modalendereco.textContent = `${endereco} cidade ${cidade}`;
  modaltelef.textContent = `telefone: ${tell}`;
  modalemail.textContent = `email: ${email}`;
  //modalCod.value = cod
});

function carregaImg(cod){
 
}
</script>