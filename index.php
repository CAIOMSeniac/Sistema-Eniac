<?php

    if(isset($_POST['submit']))
    {
        include_once('conexao_Banco.php');
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];

        $result = mysqli_query($conexao, "INSERT INTO `usuarios`(`codigo`, `nome`, `email`, `senha`, `funcao`, `ativo`) VALUES
        VALUES (15, '$nome', '$email@e.com', '$senha', 'Adm', 1)");
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- LINKS DO BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <!---->
    <link rel="icon" type="imagem/png" href="https://portalacademico.eniac.edu.br/pluginfile.php/1/theme_snap/favicon/1663305488/favicon-32.png" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto</title>
</head>
<body>
    <section class="container">
       <form action="index.php" method="POST">
        <h1>CADASTRAR USUARIO NOVO</h1>
        <div class="input-group">
        <div class="input-group-text" id="nomerequerido">requirido</div>
        <input name = 'nome' type="text" class="form-control" placeholder="nome" id="usuarionome" >
        </div>
        <br>
        <div class="input-group">
        <div class="input-group-text" id="senharequeriada">requirido</div>
        <input name= 'senha' type="text"  class="form-control" placeholder="senha" id="usuariosenha">
        </div>
        <br>
        <input type="submit" class="btn btn-primary"  value="validar" id="confirmar">
        <br>
        </form>
    </section>
</body>
</html>