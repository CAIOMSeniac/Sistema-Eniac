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
    if (isset($_POST['buscaNome']) && strlen($_POST['buscaNome']) > 0) {
        $nome = mysqli_real_escape_string($conn,$_POST['buscaNome']);
        $cond .= 'AND `nome` LIKE "%'.$nome.'%" ';
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
<!--CONDIÇÕES DE BUSCA/ FILTROS-->
<form method="POST">
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
            echo '<td>
            <div class="dropdown">
            <div class="btn-group">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              opções
            </button>
            <ul class="dropdown-menu">
            <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#DeletaUser" NOMEUSER="'.$linha["nome"].'" CODUSER="'.$linha["codigo"].'">
            DELETAR</button></li></li>
            <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#alterarValoresUser" NOMEUSER="'.$linha["nome"].'" SENHAUSER="'.$linha["senha"].'" EMAILUSER="'.$linha["email"].'" CARGOUSER="'.$linha["funcao"].'" ATIVOUSER="'.$linha["ativo"].'" CODUSER="'.$linha["codigo"].'">
              ALTERAR</button></li>
            </ul>
          </div>
          </td>';
            echo "</tr>";
        }
    }
    ?>
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


        <form action="usuariosatt.php" method="POST">

        <div class="form-check form-switch">
        <input id="model-cargo" name="model-cargo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ADMINISTRADOR</label>
        </div>
        <div class="form-check form-switch">
        <input id="model-ativo" name="model-ativo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ATIVADO</label>
        </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Nome:</label>
            <input type="text" name="model-nome" class="form-control" id="model-nome">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" name="model-email" class="form-control" id="model-email">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Senha:</label>
            <input type="text" name="model-senha" class="form-control" id="model-senha">
          </div>
            <input type="hidden" name="model-cod" class="form-control" id="model-cod">
      </div>
      <div class="modal-footer">
        <button  id="Alterar_valor" name='Alterar_valor' type="submit" class="btn btn-primary">confirmar</button>
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


        <form action="usuarioNovo.php" method="POST">

        <div class="form-check form-switch">
        <input id="model-cargo" name="model-cargo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ADMINISTRADOR</label>
        </div>
        <div class="form-check form-switch">
        <input id="model-ativo" name="model-ativo" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" checked>
        <label  class="form-check-label" for="flexSwitchCheckDefault">ATIVADO</label>
        </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label"> Nome:</label>
            <input type="text" name="model-nome" class="form-control" id="model-nome">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" name="model-email" class="form-control" id="model-email">
          </div>
          <div class="mb-3">
          <label for="recipient-name" class="col-form-label">Senha:</label>
            <input type="text" name="model-senha" class="form-control" id="model-senha">
          </div>
      </div>
      <div class="modal-footer">
        <button  id="CriarUser" name='CriarUser' type="submit" class="btn btn-primary">confirmar</button>
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


        <form action="usuariosDel.php" method="POST">
            <input type="hidden" name="model-cod-u" class="form-control" id="model-cod-u">
      </div>
      <div class="modal-footer">
        <button  id="DEL_USER" name='DEL_USER' type="submit" class="btn btn-primary">confirmar</button>
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
  const modalNome = exampleModal.querySelector('#model-nome')
  const modalSenha = exampleModal.querySelector('#model-email')
  const modalEmail = exampleModal.querySelector('#model-senha')
  const modalCargo = exampleModal.querySelector('#model-cargo')
  const modalAtivo = exampleModal.querySelector('#model-ativo')
  const modalCod = exampleModal.querySelector('#model-cod')

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
</script>