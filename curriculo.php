<?php
    session_start();
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
<style type="text/css">
.gruda {
    position: -webkit-sticky;
    position: sticky;
    top: 0;
    z-index: 10;
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
  <!--CONDIÇÕES DE BUSCA/ FILTROS-->
<form  id="filtr" method="POST">
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon1">
ENTRE
</span>
 <span class="input-group-text" id="basic-addon1">
 <input type="text" id="MIN_COD_CURRICULO"class="form-control" placeholder="Min_Cod_Currículo" aria-label="Username" aria-describedby="basic-addon1">
</span><span class="input-group-text" id="basic-addon1">
 ATÉ
</span><span class="input-group-text" id="basic-addon1">
<input type="text" id="MAX_COD_CURRICULO"class="form-control" placeholder="Max_Cod_Currículo" aria-label="Username" aria-describedby="basic-addon1">
</span><span class="input-group-text" id="basic-addon1">Busca</span>
<input type="text" id="buscaNomeFILTRO"class="form-control" placeholder="NOME" aria-label="Username" aria-describedby="basic-addon1">
<span class="input-group-text" id="basic-addon1">
    <button name = 'buscar' class="btn btn-outline-secondary" type="submit">FILTRAR</button>
</span>
</div>
</form>
<table class="table table-striped">
    <caption>lista de currículos</caption>
   <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Visualizar</th>
      <th scope="col">Alterar Currículo</th>
      <th scope="col">Deletar Currículo</th>
      <th scope="col">Codigo Currículo</th>

    </tr>
   </thead>
   <tbody id="comecConsul">

  </tbody>
 </table>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
CRIAR NOVO CURRÍCULO
</button>




<!----------MOSTRA CURRICULOS------------>
<div class="modal fade" id="Curriculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CURRÍCULO DE:  </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container text-center">
          <div class="row">
            <div class="col-sm-5" id="imagemCurr">
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
          <br><br>
          <div class="row">
            <div>
              <h5>Formação academica</h5>
              <div id="formacaoacad"></div>

            </div>
          </div>
          <br><br>
          <div class="row">
            <div >
              <h5>Experiência profissional</h5>
              <div id="experienciaprof"></div>
            </div>
          </div>
        </div>
    </div>
  </div>
  </div>
  </div>



<!----------CRIA CURRICULOS------------>
<div class="modal fade" id="CriaCurriculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrando novo Currículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id="CriaCurriculoForm" method="POST">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> NOME COMPLETO:</label>
            <input required type="text" name="model-NOME" class="form-control" id="model-NOME">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">RG:</label>
            <input required type="text" name="model-RG" class="form-control" id="model-RG">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">CPF:</label>
            <input required type="text" name="model-CPF" class="form-control" id="model-CPF">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">UF:</label>
            <input required type="text" name="model-UF" class="form-control" id="model-UF">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">DATA NASCIMENTO:</label>
            <input required type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_NASC">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">CIDADE:</label>
            <input required type="text" name="model-CIDADE" class="form-control" id="model-CIDADE">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">ENDEREÇO:</label>
            <input required type="text" name="model-ENDERECO" class="form-control" id="model-ENDERECO" placeholder="RUA, 123 ">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">EMAIL:</label>
            <input required type="text" name="model-EMAIL" class="form-control" id="model-EMAIL" placeholder="email@email.com.br">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">TELEFONE:</label>
            <input required type="text" name="model-TELEFONE" class="form-control" id="model-TELEFONE" placeholder="+55 11 12345-6789">
          </div>
      </div>
      <div class="modal-footer">
        <button  id="CriaCurr" name='CriaCurr' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>




<!-----------MENU DE ATUALIZAÇÕES------------>
<div class="modal fade" id="AtualizaCurriculo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CURRÍCULO DE:  </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <button id="btn-NVC" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NovoConhec" >
      Novo conhecimento/escolaridade
      </button>
      <br><br>
      <button id="btn-NVE"type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NovoExper" >
      Nova experiência profissional
      </button>
      <br><br>
      <button id="btn-MDIM" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#MDIMModal" >
      Mudar Imagem
      </button>
      <br><br>
      <button id="btn-MDIP" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AttINFPCurr" >
      Alterar Dados pessoais
      </button>
      <br><br>
      <button id="btn-MDC" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CONHECIMENTOS_MENU" >
      Alterar conhecimento/escolaridade
      </button>
      <br><br>
      <button id="btn-MDE" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#EXPERIEN_MENU" >
      Alterar experiência profissional
      </button>
    </div>
  </div>
  </div>
  </div>






<!----------NOVO CONHECIMENTO CURRICULO------------>
<div class="modal fade" id="NovoConhec" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NOVO CONHECIMENTO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id='NovoConhecForm' method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Nome da instituição:</label>
            <input type="text" name="model-nome" class="form-control" id="model-nome-NVC">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">DATA INICIO:</label>
            <input type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_INI-NVC" required>
            <label for="recipient-name" class="col-form-label">DATA TERMINO:</label>
            <input type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_FIM-NVC">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Descrição do aprendizado:</label>
            <input type="text" name="model-senha" class="form-control" id="model-descr-NVC" required>
          </div>
          <input type="hidden" name="model-codcurriculo" class="form-control" id="model-codcurriculo-NVC">
      </div>
      <div class="modal-footer">
        <button  id="NVC-CURR" type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<!----------NOVA EXPERIENCIA CURRICULO------------>
<div class="modal fade" id="NovoExper" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NOVA EXPERIÊNCIA</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id='NovoExperForm' method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Razão Social:</label>
            <input type="text" name="model-nome" class="form-control" id="model-nome-NVE">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">DATA INICIO:</label>
            <input type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_INI-NVE" required>
            <label for="recipient-name" class="col-form-label">DATA TERMINO:</label>
            <input type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_FIM-NVE">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Descrição:</label>
            <input type="text" name="model-senha" class="form-control" id="model-descr-NVE" required>
          </div>
          <input type="hidden" name="model-codcurriculo" class="form-control" id="model-codcurriculo-NVE">
      </div>
      <div class="modal-footer">
        <button  id="NVE-CURR" type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<!----------MUDA IMAGEM CURRICULO------------>
<div class="modal fade" id="MDIMModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrando nova imagem</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id="MDIMForm" method="POST">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Evento:</label>
            <input type="text" name="model-evento" class="form-control" id="model-evento-MDIM">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Descrição:</label>
            <input type="text" name="model-desc" class="form-control" id="model-desc-MDIM">
          </div>
          <div class="mb-3">
          <label for="formFileSm" class="form-label">Imagem</label>
          <input class="form-control form-control-sm" type="file" name = "meuarquivo" id="meuarquivo" accept="image/*">
          </div>
          <input type="hidden"class="form-control" id="model-codcurriculo-MDIM">
      </div>
      <div class="modal-footer">
        <button  id="env-MDIM" type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<!-----------ATUALIZA DADOS PESSOAIS------------>
<div class="modal fade" id="AttINFPCurr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrando novo Currículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id="AttINFPCurrForm" method="POST">

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> NOME COMPLETO:</label>
            <input required type="text" name="model-NOME" class="form-control" id="model-NOME-MDIP">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">RG:</label>
            <input required type="text" name="model-RG" class="form-control" id="model-RG-MDIP">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">CPF:</label>
            <input required type="text" name="model-CPF" class="form-control" id="model-CPF-MDIP">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">UF:</label>
            <input required type="text" name="model-UF" class="form-control" id="model-UF-MDIP">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">DATA NASCIMENTO:</label>
            <input required type="date" name="model-DATA_NASC" class="form-control" id="model-DATA_NASC-MDIP">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">CIDADE:</label>
            <input required type="text" name="model-CIDADE" class="form-control" id="model-CIDADE-MDIP">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">ENDEREÇO:</label>
            <input required type="text" name="model-ENDERECO" class="form-control" id="model-ENDERECO-MDIP" placeholder="RUA, 123 ">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">EMAIL:</label>
            <input required type="text" name="model-EMAIL" class="form-control" id="model-EMAIL-MDIP" placeholder="email@email.com.br">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">TELEFONE:</label>
            <input required type="text" name="model-TELEFONE" class="form-control" id="model-TELEFONE-MDIP" placeholder="+55 11 12345-6789">
          </div>
          <input type="hidden"class="form-control" id="model-codcurriculo-MDIP">
      </div>
      <div class="modal-footer">
        <button  id="SubMDIP" name='SubMDIP' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>







<!-----------TODOS OS CONHECIMENTOS------------>
<div class="modal fade" id="CONHECIMENTOS_MENU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">CONHECIMENTOS DE:  </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
      <table class="table table-striped">
    <caption>lista de conhecimentos</caption>
   <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nome</th>
      <th scope="col">DELETAR</th>

    </tr>
   </thead>
   <tbody id="corpo-CONMEN">
   </tbody>
  </table>
    </div>
  </div>
  </div>
  </div>
  <div class="modal fade" id="DeletaConhe" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletando Conhecimento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h3>Tem certeza que deseja deletar o conhecimento?</h3>
        <form id="DeletaConheForm" method="POST">
            <input type="hidden" name="model-cod-u" class="form-control" id="model-cod-Conhe">
      </div>
      <div class="modal-footer">
        <button  id="DEL" name='DEL' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<!-----------TODAS AS EXPERIENCIAS------------>
<div class="modal fade" id="EXPERIEN_MENU" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EXPERIÊNCIAS DE:  </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
      <table class="table table-striped">
    <caption>lista de experiencias</caption>
   <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">razão social</th>
      <th scope="col">DELETAR</th>

    </tr>
   </thead>
   <tbody id="corpo-EXPR">
   </tbody>
  </table>
    </div>
  </div>
  </div>
  </div>
  <div class="modal fade" id="DeletaExp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletando Experiência</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3>Tem certeza que deseja deletar a experiência?</h3>
        <form id="DeletaExpForm" method="POST">
            <input type="hidden" name="model-cod-u" class="form-control" id="model-cod-Exp">
      </div>
      <div class="modal-footer">
        <button  id="DEL" name='DEL' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>







<!-----------APAGA CURRICULO------------>
<div class="modal fade" id="DeletaCurr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deletando Currículo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3 id="currInfo">Tem certeza que deseja deletar o currículo?</h3>
        <form id="DeletaCurriculoForm" method="POST">
            <input type="hidden" name="model-cod-u" class="form-control" id="model-cod-DelCurr">
      </div>
      <div class="modal-footer">
        <button  id="DEL" name='DEL' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>

<script type="text/javascript">

//MOSTRA CURRICULO
const CurriculoModal = document.getElementById('Curriculo')
CurriculoModal.addEventListener('show.bs.modal', event => {
  mostraCurric()
});
async function mostraCurric(){
  const button = event.relatedTarget;


  const nome = button.getAttribute('NOME');
  const data_nasc = button.getAttribute('DATANASC');
  const endereco = button.getAttribute('ENDERECO');
  const cidade = button.getAttribute('CIDADE');
  const email = button.getAttribute('EMAIL');
  const tell = button.getAttribute('TELL');
  const cod_curriculo = button.getAttribute('CODCURR');


  //const modalCod = CurriculoModal.querySelector('#model-cod-u')
  const modalTitle = CurriculoModal.querySelector('.modal-title');
  const modalnomec = CurriculoModal.querySelector('.nomeComp');
  const modaldatanasc = CurriculoModal.querySelector('.data_nasc');
  const modalendereco = CurriculoModal.querySelector('.endereco');
  const modaltelef = CurriculoModal.querySelector('.tell');
  const modalemail = CurriculoModal.querySelector('.email');

  modalTitle.textContent = `Currículo de: ${nome}`;
  modalnomec.textContent = `${nome}`;
  modaldatanasc.textContent = `data de nascimento: ${data_nasc}`;
  modalendereco.textContent = `${endereco} cidade ${cidade}`;
  modaltelef.textContent = `telefone: ${tell}`;
  modalemail.textContent = `email: ${email}`;
  //modalCod.value = cod
  CarregaImg(cod_curriculo)
  var formacao = await BuscaRapida(cod_curriculo,'conhecimento')
  if (formacao != null) {
  result = formacao
  $('#formacaoacad').empty();
    for(var i = 0; i < result.length; i++){
      $('#formacaoacad').prepend('<hr><h5>nome da instituição: '+result[i][2]+ '</h5><h7>periodo: '+result[i][3]+ ' até '+result[i][4]+ '</h7><br><h7>descrição: '+result[i][5]+ '</h7>');
    }
  }
  var experien = await BuscaRapida(cod_curriculo,'experiencia')
  if (experien != null) {
  result = experien
  $('#experienciaprof').empty();
    for(var i = 0; i < result.length; i++){
      $('#experienciaprof').prepend('<hr><h5>razão social: '+result[i][2]+ '</h5><h7>periodo: '+result[i][3]+ ' até '+result[i][4]+ '</h7><br><h7>descrição: '+result[i][5]+ '</h7>')
    }
  }
};



//ATUALIZAÇÃO CURRICULO
const CurriculoAttMenModal = document.getElementById('AtualizaCurriculo')
CurriculoAttMenModal.addEventListener('show.bs.modal',event => {
  MenuAtuaCurric()
});

async function MenuAtuaCurric(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const NOME = button.getAttribute('NOME');
  const modalTitle = CurriculoAttMenModal.querySelector('.modal-title');
  const bntNVC = $('#btn-NVC');    // NOVO CONHECIMENTO 
  const bntNVE = $('#btn-NVE');    //NOVA EXPERIENCIA
  const bntMDIM = $('#btn-MDIM');  // MUDA IMAGEM
  const bntMDIP = $('#btn-MDIP');  // MUDA INFORMAÇÃO PESSOAL
  const bntMDC = $('#btn-MDC');  // MUDA CONHECIMENTO
  const bntMDE = $('#btn-MDE'); //MUDA EXPERIENCIA
  modalTitle.textContent = 'MODIFICANDO: '+NOME;
  bntNVC.attr('CODCURR',cod_curriculo)
  bntNVE.attr('CODCURR',cod_curriculo)
  bntMDIM.attr('CODCURR',cod_curriculo)
  bntMDIP.attr('CODCURR',cod_curriculo)
  bntMDC.attr('CODCURR',cod_curriculo)
  bntMDE.attr('CODCURR',cod_curriculo)

}





const CurriculoNVCModal = document.getElementById('NovoConhec')
CurriculoNVCModal.addEventListener('show.bs.modal', event => {NVCCurric()})

async function NVCCurric(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const modalTitle = CurriculoNVCModal.querySelector('.modal-title');
  const modalCod = CurriculoNVCModal.querySelector('#model-codcurriculo-NVC')
  var result = await BuscaRapida(cod_curriculo,'pessoa')
  modalTitle.textContent = 'NOVO CONHECIMENTO DE: '+result[0][1];
  modalCod.value = cod_curriculo;
};






const CurriculoNVEModal = document.getElementById('NovoExper')
CurriculoNVEModal.addEventListener('show.bs.modal', event => {NVECurric()})

async function NVECurric(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const modalTitle = CurriculoNVEModal.querySelector('.modal-title');
  const modalCod = CurriculoNVEModal.querySelector('#model-codcurriculo-NVE')
  var result = await BuscaRapida(cod_curriculo,'pessoa')
  modalTitle.textContent = 'NOVA EXPERIÊNCIA DE: '+result[0][1];
  modalCod.value = cod_curriculo;
};





const CurriculoMDIMModal = document.getElementById('MDIMModal')
CurriculoMDIMModal.addEventListener('show.bs.modal', event => {MDIMCurric()})

async function MDIMCurric(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const modalTitle = CurriculoMDIMModal.querySelector('.modal-title');
  const modalCod = CurriculoMDIMModal.querySelector('#model-codcurriculo-MDIM')
  const modalEVNT = CurriculoMDIMModal.querySelector('#model-evento-MDIM')
  var result = await BuscaRapida(cod_curriculo,'pessoa')
  modalTitle.textContent = 'Registrando nova imagem para: '+result[0][1];
  modalEVNT.value = 'imagem de '+result[0][1];
  modalCod.value = cod_curriculo;
};





const AttINFPCurrModal = document.getElementById('AttINFPCurr')
AttINFPCurrModal.addEventListener('show.bs.modal',event => {
  AtuaCurricMDIP()
});

async function AtuaCurricMDIP(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const modalTitle = AttINFPCurrModal.querySelector('.modal-title');
  const modalCod = AttINFPCurrModal.querySelector('#model-codcurriculo-MDIP')
  const nome = AttINFPCurrModal.querySelector('#model-NOME-MDIP')
  const email = AttINFPCurrModal.querySelector('#model-EMAIL-MDIP')
  const tel = AttINFPCurrModal.querySelector('#model-TELEFONE-MDIP')
  const rg = AttINFPCurrModal.querySelector('#model-RG-MDIP')
  const cpf = AttINFPCurrModal.querySelector('#model-CPF-MDIP')
  const uf = AttINFPCurrModal.querySelector('#model-UF-MDIP')
  const dt_nasc = AttINFPCurrModal.querySelector('#model-DATA_NASC-MDIP')
  const endereco = AttINFPCurrModal.querySelector('#model-ENDERECO-MDIP')
  const cidade = AttINFPCurrModal.querySelector('#model-CIDADE-MDIP')
  var result = await BuscaRapida(cod_curriculo,'pessoa')
  modalCod.value = cod_curriculo;
  modalTitle.textContent = 'Atualizando informações pessoais de: '+result[0][1];
  nome.value = result[0][1]
  cidade.value = result[0][2]
  endereco.value = result[0][3]
  tel.value = result[0][4]
  email.value = result[0][5]
  cpf.value = result[0][6]
  rg.value = result[0][7]
  uf.value = result[0][8]
  dt_nasc.value = result[0][9]
}






const CurriculoTdConhec = document.getElementById('CONHECIMENTOS_MENU')
CurriculoTdConhec.addEventListener('show.bs.modal',event => {
  MenuConhecim()
});
async function MenuConhecim(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const modalTitle = CurriculoTdConhec.querySelector('.modal-title');
  var pessoa = await BuscaRapida(cod_curriculo,'pessoa')
  modalTitle.textContent = 'Conhecimentos de: '+pessoa[0][1];
  var formacao = await BuscaRapida(cod_curriculo,'conhecimento')
  if (formacao != null) {
  result = formacao
  $('#corpo-CONMEN').empty();
    for(var i = 0; i < result.length; i++){
      $('#corpo-CONMEN').prepend('<tr><td>'+  result[i][0] +'</td><td>'+  result[i][2] +'</td><td><button data-bs-toggle="modal" data-bs-target="#DeletaConhe" type="button" class="dropdown-item" IDENTIFICA="'+result[i][0]+'">APAGAR</button></td></tr>');
    }
  }
}
const CurriculoDelConhec = document.getElementById('DeletaConhe')
CurriculoDelConhec.addEventListener('show.bs.modal',event => {
  DelConhecim()
});
async function DelConhecim(){
  const button = event.relatedTarget;
  const cod = button.getAttribute('IDENTIFICA');
  const modalCod = CurriculoDelConhec.querySelector('#model-cod-Conhe')
  modalCod.value = cod;
}







const CurriculoTdExperi = document.getElementById('EXPERIEN_MENU')
CurriculoTdExperi.addEventListener('show.bs.modal',event => {
  MenuConhecim()
});
async function MenuConhecim(){
  const button = event.relatedTarget;
  const cod_curriculo = button.getAttribute('CODCURR');
  const modalTitle = CurriculoTdExperi.querySelector('.modal-title');
  var pessoa = await BuscaRapida(cod_curriculo,'pessoa')
  modalTitle.textContent = 'Experiências de: '+pessoa[0][1];
  var experien = await BuscaRapida(cod_curriculo,'experiencia')
  if (experien != null) {
  result = experien
  $('#corpo-EXPR').empty();
    for(var i = 0; i < result.length; i++){
      $('#corpo-EXPR').prepend('<tr><td>'+  result[i][0] +'</td><td>'+  result[i][2] +'</td><td><button data-bs-toggle="modal" data-bs-target="#DeletaExp" type="button" class="dropdown-item" IDENTIFICA="'+result[i][0]+'">APAGAR</button></td></tr>');
    }
  }
}

const CurriculoDelExp = document.getElementById('DeletaExp')
CurriculoDelExp.addEventListener('show.bs.modal',event => {
  DelExp()
});
async function DelExp(){
  const button = event.relatedTarget;
  const cod = button.getAttribute('IDENTIFICA');
  const modalCod = CurriculoDelExp.querySelector('#model-cod-Exp')
  modalCod.value = cod;
}






const CurriculoDelCurriculo = document.getElementById('DeletaCurr')
CurriculoDelCurriculo.addEventListener('show.bs.modal',event => {
  DelCurriculo()
});
async function DelCurriculo(){
  const button = event.relatedTarget;
  const cod = button.getAttribute('CODCURR');
  const modalCod = CurriculoDelCurriculo.querySelector('#model-cod-DelCurr')
  const modalTitle = CurriculoDelCurriculo.querySelector('.modal-title');
  const modalInfo = CurriculoDelCurriculo.querySelector('#currInfo');
  var pessoa = await BuscaRapida(cod,'pessoa')
  modalTitle.textContent = 'Deletando currículo de: '+pessoa[0][1];
  modalInfo.textContent = 'Tem certeza que deseja deletar o currículo de: '+pessoa[0][1]
  modalCod.value = cod;
}





/// AJAX PUXANDO INFORMAÇÕES
function CarregaImg(id_curriculo){
  $.ajax({
    url: 'curriculoSelecImg.php',
    method: 'POST',
    data: {
      id_cod: id_curriculo
    },
    dataType: 'html'
  }).done(function(result) {
    $('#imagemCurr').empty();
    $('#imagemCurr').prepend(result)

  })
}





$('#filtr').submit(function(e){
  e.preventDefault()
  Consulta()
})
function Consulta(){
  var nomeBuscafi = $('#buscaNomeFILTRO').val();
  var MINCod = $('#MIN_COD_CURRICULO').val();
  var MAXCod = $('#MAX_COD_CURRICULO').val();

  $.ajax({
    url: 'curriculoSelec.php',
    method: 'POST',
    data: {
      NomeCur: nomeBuscafi,
      MINCodigo: MINCod,
      MAXCodigo: MAXCod
    },
    dataType: 'json'
  }).done(function(result) {
    $('#comecConsul').empty();
    for(var i = 0; i < result.length; i++){
      $('#comecConsul').prepend('<tr><td>'+  result[i][1] +'</td><td><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Curriculo" NOME="'+  result[i][1] +'" DATANASC="'+  result[i][9] +'" ENDERECO="'+  result[i][3] +'" CIDADE="'+  result[i][2] +'" EMAIL="'+  result[i][5] +'" TELL="'+  result[i][4] +'" CODCURR ="'+  result[i][0] +'">Mostrar curriculo</button></td><td><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#AtualizaCurriculo" CODCURR ="'+  result[i][0] +'" NOME="'+  result[i][1] +'">Atualizar curriculo</button></td><td><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DeletaCurr" CODCURR ="'+  result[i][0] +'">Deletar curriculo</button></td><td>'+  result[i][0] +'</td></tr>');
    }
  })
}
Consulta()

function BuscaRapida(id_curriculo,Tabela){ //  'conhecimento'     'experiencia'    'pessoa'
  return new Promise(function(resolve) {
  $.ajax({
    url: 'Selec.php',
    method: 'POST',
    data: {
      tb: Tabela,
      idc: id_curriculo
    },
    dataType: 'json'
  }).done(function(result) {
    console.log(result);
    resolve(result);
  })
})

}



//AJAX ENVIOS ALTERAÇÕES TABELA
$('#CriaCurriculoForm').submit(function(e){
  e.preventDefault()
  var nome = $('#model-NOME').val();
  var email = $('#model-EMAIL').val();
  var tel = $('#model-TELEFONE').val();
  var rg = $('#model-RG').val();
  var cpf = $('#model-CPF').val();
  var uf = $('#model-UF').val();
  var dt_nasc = $('#model-DATA_NASC').val();
  var endereco = $('#model-ENDERECO').val();
  var cidade = $('#model-CIDADE').val();

  $.ajax({
    url: 'curriculoNovo.php',
    method: 'POST',
    data: {
      NOME: nome,
      EMAIL: email,
      TELEFONE: tel,
      RG: rg,
      CPF: cpf,
      UF: uf,
      DATA_NASC: dt_nasc,
      ENDERECO: endereco,
      CIDADE: cidade
    },
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

})





$('#NovoConhecForm').submit(function(e){
  e.preventDefault()
  var nome = $('#model-nome-NVC').val();
  var dt_ini = $('#model-DATA_INI-NVC').val();
  var dt_fim = $('#model-DATA_FIM-NVC').val();
  var desc = $('#model-descr-NVC').val();
  var cd_c = $('#model-codcurriculo-NVC').val();
  $.ajax({
    url: 'curriculoNovoCon.php',
    method: 'POST',
    data: {
      NOME: nome,
      DATA_INI: dt_ini,
      DATA_FIM: dt_fim,
      DESCRICAO: desc,
      cod_curriculo: cd_c
    },
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

})



$('#NovoExperForm').submit(function(e){
  e.preventDefault()
  var nome = $('#model-nome-NVE').val();
  var dt_ini = $('#model-DATA_INI-NVE').val();
  var dt_fim = $('#model-DATA_FIM-NVE').val();
  var desc = $('#model-descr-NVE').val();
  var cd_c = $('#model-codcurriculo-NVE').val();
  $.ajax({
    url: 'curriculoNovoExp.php',
    method: 'POST',
    data: {
      NOME: nome,
      DATA_INI: dt_ini,
      DATA_FIM: dt_fim,
      DESCRICAO: desc,
      cod_curriculo: cd_c
    },
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

})





$('#MDIMForm').submit(function(e){
  e.preventDefault()
  var even = $('#model-evento-MDIM').val();
  var desc = $('#model-desc-MDIM').val();
  var cd_c = $('#model-codcurriculo-MDIM').val();
  console.log(even, desc, cd_c)
  Form =  new FormData();
  Form.append('EVENTO', even);
  Form.append('DESCRI', desc);
  Form.append('cod_curriculo', cd_c);
  Form.append("meuarquivo", document.getElementById('meuarquivo').files[0]);
  $.ajax({
    url: 'imagemNova.php',
    method: 'POST',
    //enctype: 'multipart/form-data',
    processData: false,  // Important!
    contentType: false,
    data: Form,
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

});



$('#AttINFPCurrForm').submit(function(e){
  e.preventDefault()
  var nome = $('#model-NOME-MDIP').val();
  var email = $('#model-EMAIL-MDIP').val();
  var tel = $('#model-TELEFONE-MDIP').val();
  var rg = $('#model-RG-MDIP').val();
  var cpf = $('#model-CPF-MDIP').val();
  var uf = $('#model-UF-MDIP').val();
  var dt_nasc = $('#model-DATA_NASC-MDIP').val();
  var endereco = $('#model-ENDERECO-MDIP').val();
  var cidade = $('#model-CIDADE-MDIP').val();
  var cd_c = $('#model-codcurriculo-MDIP').val();
  console.log(nome,email,cidade,endereco,cd_c)
  $.ajax({
    url: 'curriculoAttInfPes.php',
    method: 'POST',
    data: {
      NOME: nome,
      EMAIL: email,
      TELEFONE: tel,
      RG: rg,
      CPF: cpf,
      UF: uf,
      DATA_NASC: dt_nasc,
      ENDERECO: endereco,
      CIDADE: cidade,
      cod_curriculo: cd_c
    },
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

});



$('#DeletaConheForm').submit(function(e){
  e.preventDefault()
  var Id = $('#model-cod-Conhe').val();
  console.log(Id)
  $.ajax({
    url: 'curriculoConDel.php',
    method: 'POST',
    data:{ident: Id},
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

});
$('#DeletaExpForm').submit(function(e){
  e.preventDefault()
  var Id = $('#model-cod-Exp').val();
  $.ajax({
    url: 'curriculoExpDel.php',
    method: 'POST',
    data:{ident: Id},
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

});





$('#DeletaCurriculoForm').submit(function(e){
  e.preventDefault()
  var Id = $('#model-cod-DelCurr').val();
  $.ajax({
    url: 'curriculoDel.php',
    method: 'POST',
    data:{ident: Id},
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

});
</script>