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
<form  id="filtr" method="POST">
<div class="input-group mb-3">
<span class="input-group-text" id="basic-addon1">
ENTRE
</span>
 <span class="input-group-text" id="basic-addon1">
 <input type="text" id="MIN_COD_CURRICULO"class="form-control" placeholder="MIN_COD_CURRICULO" aria-label="Username" aria-describedby="basic-addon1">
</span><span class="input-group-text" id="basic-addon1">
 ATÉ
</span><span class="input-group-text" id="basic-addon1">
<input type="text" id="MAX_COD_CURRICULO"class="form-control" placeholder="MAX_COD_CURRICULO" aria-label="Username" aria-describedby="basic-addon1">
</span><span class="input-group-text" id="basic-addon1">Busca</span>
<input type="text" id="buscaNomeFILTRO"class="form-control" placeholder="NOME" aria-label="Username" aria-describedby="basic-addon1">
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
   <tbody id="comecConsul">

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
      Nova experiencia profissional
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
      Mudar Imagem
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
      Alterar Dados pessoais
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
      Alterar conhecimento/escolaridade
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaCurriculo" >
      Alterar experiencia profissional
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
  const cod_curriculo = button.getAttribute('CODCURR');


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
  CarregaImg(cod_curriculo)
});

function CarregaImg(id_curriculo){
  $.ajax({
    url: 'curriculoSelecImg.php',
    method: 'POST',
    data: {
      id_cod: id_curriculo
    },
    dataType: 'html'
  }).done(function(result) {
    console.log(result);
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
      $('#comecConsul').prepend('<tr><td>'+  result[i][1] +'</td><td><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Curriculo" NOME="'+  result[i][1] +'" DATANASC="'+  result[i][9] +'" ENDERECO="'+  result[i][3] +'" CIDADE="'+  result[i][2] +'" EMAIL="'+  result[i][5] +'" TELL="'+  result[i][4] +'" CODCURR ="'+  result[i][0] +'">Mostrar curriculo</button></td><td><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#AtualizaCurriculo" CODCURR ="'+  result[i][0] +'">Atualizar curriculo</button></td><td><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Curriculo" CODCURR ="'+  result[i][0] +'">Deletar curriculo</button></td><td>'+  result[i][0] +'</td></tr>');
    }
  })
}
Consulta()
</script>