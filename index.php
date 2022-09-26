<?php
    session_start();
    include_once('conexao_Banco.php');
    if(isset($_POST['confirmar']))
    {

            $nome = mysqli_real_escape_string($conn,$_POST['nome']);
            $senha = mysqli_real_escape_string($conn,$_POST['senha']);
            $Sqlquery = "
            SELECT * FROM `usuarios` 
            WHERE `senha` = '$senha' 
            AND `nome` = '$nome' 
            OR `email` = '$nome'
            ";
            $result = mysqli_query($conn,$Sqlquery);
            $row = mysqli_num_rows($result);
            if($row == 1) {
                $linha=mysqli_fetch_assoc($result);
                $_SESSION['usuario'] = $usuario;
                $_SESSION['cargo'] = $linha["funcao"];
                header('Location:dashboard.php');
            } else {
                $_SESSION['nao_autenticado'] = true;
                $login_conf=false;
            }
    }

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
<style type="text/css">
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
<section class="container">
<img src="https://www.eniac.com.br/hs-fs/hubfs/Logos-Eniac-2019-1.png?width=1150&name=Logos-Eniac-2019-1.png" class='figure-img img-fluid rounded' width="200px">
<br><br><br><br>
<form action="index.php" method="POST">
        <h1>Login</h1>
        <br><br><br>
        <div class="input-group">
        <div class="input-group-text" id="nomerequerido">requirido</div>
        <input name = 'nome' type="text" class="form-control" placeholder="nome ou email" id="usuarionome" >
        </div>
        <br><br>
        <div class="input-group">
        <div class="input-group-text" id="senharequeriada">requirido</div>
        <input name= 'senha' type="text"  class="form-control" placeholder="senha" id="usuariosenha">
        </div>
        <br><br>
        <input name="confirmar" type="submit" class="btn btn-primary"  value="validar" id="confirmar">
        <br>
</form>
</section>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var campoNome = $("#usuarionome");
    var nomeValido = false;
    const nomeRequerido = $("#nomerequerido");
    var regexNome = /^[a-zA-Z ]+$/;

    campoNome.on("input",function(){
        var txtNome  = $("#usuarionome").val();
        var textonomerequerido;
        nomeValido = regexNome.test(txtNome);
        if(nomeValido){
            nomeRequerido.text("Valido");
        }else{
            nomeRequerido.text("invalido");
        }
    });

</script>
</html>