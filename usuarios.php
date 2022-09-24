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
<!--CONDIÇÕES DE BUSCA/ FILTROS-->
<form id="filtr"method="POST">
<div class="input-group mb-3">
 <span class="input-group-text" id="basic-addon1">
    <input name='ATIVOSFILTRO' type="checkbox" class="btn-check1" id="ATIVOSFILTRO"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check">ATIVOS</label>
</span><span class="input-group-text" id="basic-addon1">
    <input name="DESATIVOSFILTRO" type="checkbox" class="btn-check2" id="DESATIVOSFILTRO"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check-2">NÃO ATIVOS</label>
</span><span class="input-group-text" id="basic-addon1">
    <input name="ADMFILTRO" type="checkbox" class="btn-check3" id="ADMFILTRO"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check-3">ADMINISTRADORES</label>
</span><span class="input-group-text" id="basic-addon1">
    <input name="USERFILTRO" type="checkbox" class="btn-check4" id="USERFILTRO"  autocomplete="off">
    <label class="btn btn-primary" for="btn-check-4">USUARIOS</label>
</span><span class="input-group-text" id="basic-addon1">Busca</span>
<input type="text" id="buscaNomeFILTRO" name="buscaNomeFILTRO"class="form-control" placeholder="NOME" aria-label="Username" aria-describedby="basic-addon1">
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
   <tbody id="comecConsul">
  </tbody>
 </table>
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriaUser">
CRIAR NOVO USUARIO
</button>



 <div class="modal fade" id="alterarValoresUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ALTERANDO VALOR DE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id="attUserForm" method="POST">

        <div class="form-check form-switch">
        <input value="1" id="model-cargo-a" name="model-cargo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ADMINISTRADOR</label>
        </div>
        <div class="form-check form-switch">
        <input value="1" id="model-ativo-a" name="model-ativo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ATIVADO</label>
        </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Nome:</label>
            <input type="text" name="model-nome" class="form-control" id="model-nome-a">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" name="model-email" class="form-control" id="model-email-a">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Senha:</label>
            <input type="text" name="model-senha" class="form-control" id="model-senha-a">
          </div>
            <input type="hidden" name="model-cod" class="form-control" id="model-cod-a">
      </div>
      <div class="modal-footer">
        <button  id="Alterar_valor" name='Alterar_valor' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>




<div class="modal fade" id="CriaUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ALTERANDO VALOR DE</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id='criaUserForm' method="POST">

        <div class="form-check form-switch">
        <input id="model-cargo-c"  name="model-cargo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ADMINISTRADOR</label>
        </div>
        <div class="form-check form-switch">
        <input id="model-ativo-c"  name="model-ativo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ATIVADO</label>
        </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Nome:</label>
            <input type="text" name="model-nome" class="form-control" id="model-nome-c">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" name="model-email" class="form-control" id="model-email-c">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Senha:</label>
            <input type="text" name="model-senha" class="form-control" id="model-senha-c">
          </div>
      </div>
      <div class="modal-footer">
        <button  id="CriarUser" name='CriarUser' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>






<div class="modal fade" id="DeletaUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DELETANDO USUARIO: </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


        <form id="deletaUserForm" method="POST">
            <input type="hidden" name="model-cod-u" class="form-control" id="model-cod-u">
      </div>
      <div class="modal-footer">
        <button  id="DEL_USER" name='DEL_USER' type="submit" class="btn btn-primary" data-bs-dismiss="modal">confirmar</button>
      </div>
      </form>
    </div>
  </div>
</div>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
const exampleModal = document.getElementById('alterarValoresUser')
exampleModal.addEventListener('show.bs.modal', event => {

  const button = event.relatedTarget


  const nome = button.getAttribute('NOMEUSER')
  const senha = button.getAttribute('SENHAUSER')
  const email = button.getAttribute('EMAILUSER')
  const cargo = button.getAttribute('CARGOUSER')
  const ativo = button.getAttribute('ATIVOUSER')
  const cod = button.getAttribute('CODUSER')


  const modalTitle = exampleModal.querySelector('.modal-title')
  const modalNome = exampleModal.querySelector('#model-nome-a')
  const modalEmail = exampleModal.querySelector('#model-email-a')
  const modalSenha = exampleModal.querySelector('#model-senha-a')
  const modalCargo = exampleModal.querySelector('#model-cargo-a')
  const modalAtivo = exampleModal.querySelector('#model-ativo-a')
  const modalCod = exampleModal.querySelector('#model-cod-a')
  modalTitle.textContent = `ALTERANDO VALORES DE ${nome}`
  modalNome.value = nome
  modalSenha.value = senha
  modalEmail.value = email
  modalCod.value = cod
  if (cargo == "Adm") {
    modalCargo.checked = true;
} else {
    modalCargo.checked = false;
}
if (ativo == 1) {
    modalAtivo.checked = true;
} else {
    modalAtivo.checked = false;
}
});
const DelModal = document.getElementById('DeletaUser')
DelModal.addEventListener('show.bs.modal', event => {

  const button = event.relatedTarget


  const nome = button.getAttribute('NOMEUSER')
  const cod = button.getAttribute('CODUSER')


  const modalTitle = DelModal.querySelector('.modal-title')
  const modalCod = DelModal.querySelector('#model-cod-u')

  modalTitle.textContent = `DELETANDO USUARIO: ${nome}`
  modalCod.value = cod
});

$('#deletaUserForm').submit(function(e){
  e.preventDefault()
  var codigo = $('#model-cod-u').val();
  $.ajax({
    url: 'usuariosDel.php',
    method: 'POST',
    data: {id_cod: codigo},
    dataType: 'json'
  }).done(function(a) {
    alert('aaaa')
    Consulta()
  })

})

$('#criaUserForm').submit(function(e){
  e.preventDefault()
  var nomeuser = $('#model-nome-c').val();
  var emailuser = $('#model-email-c').val();
  var senhauser = $('#model-senha-c').val();
  var ativadouser = $('#model-ativo-c').is(":checked");
  var admuser = $('#model-cargo-c').is(":checked");
  $.ajax({
    url: 'usuarioNovo.php',
    method: 'POST',
    data: {
      nome: nomeuser,
      email: emailuser,
      senha: senhauser,
      ativado: ativadouser,
      administrador: admuser
    },
    dataType: 'json'
  }).done(function(b) {
    alert('aaaa')
    Consulta()
  })

})


$('#attUserForm').submit(function(e){
  e.preventDefault()
  var nomeuser = $('#model-nome-a').val();
  var emailuser = $('#model-email-a').val();
  var senhauser = $('#model-senha-a').val();
  var ativadouser = $('#model-ativo-a').is(":checked");
  var admuser = $('#model-cargo-a').is(":checked");
  var coduser = $('#model-cod-a').val();
  console.log(nomeuser)
  $.ajax({
    url: 'usuariosatt.php',
    method: 'POST',
    data: {
      id_cod: coduser,
      nome: nomeuser,
      email: emailuser,
      senha: senhauser,
      ativado: ativadouser,
      administrador: admuser
    },
    dataType: 'json'
  }).done(function(b) {
    Consulta()
  })

})
$('#filtr').submit(function(e){
  e.preventDefault()
  Consulta()
})

function Consulta(){
  var ativosfiltro = $('#ATIVOSFILTRO').is(":checked");
  var desativosfiltro = $('#DESATIVOSFILTRO').is(":checked");
  var admfiltro = $('#ADMFILTRO').is(":checked");
  var userfiltro = $('#USERFILTRO').is(":checked");
  var nomeBuscafi = $('#buscaNomeFILTRO').val();
  console.log(nomeBuscafi)
  $.ajax({
    url: 'usuariosSelec.php',
    method: 'POST',
    data: {
      ativo:ativosfiltro,
      desat:desativosfiltro,
      adm:admfiltro,
      use:userfiltro,
      non: nomeBuscafi
    },
    dataType: 'json'
  }).done(function(result) {
    console.log(nomeBuscafi)
    $('#comecConsul').empty();
    for(var i = 0; i < result.length; i++){
      $('#comecConsul').prepend('<tr><td>'+  result[i][1] +'</td><td>'+  result[i][2] +'</td><td>'+  result[i][3] +'</td><td>'+  result[i][4] +'</td><td>'+  result[i][5] +'</td><td><div class="dropdown"><div class="btn-group"><button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">opções</button><ul class="dropdown-menu"><li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DeletaUser" NOMEUSER="'+  result[i][1] +'" CODUSER="'+  result[i][0] +'">DELETAR</button></li></li><li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#alterarValoresUser" NOMEUSER="'+  result[i][1] +'" SENHAUSER="'+  result[i][3] +'" EMAILUSER="'+  result[i][2] +'" CARGOUSER="'+  result[i][4] +'" ATIVOUSER="'+  result[i][5] +'" CODUSER="'+  result[i][0] +'">ALTERAR</button></li></ul></div></td></tr>');
    }
  })
}
Consulta()
</script>