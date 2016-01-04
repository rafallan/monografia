<?php
require_once "conexao.php";
session_start();

if (isset($_POST['usuario'])) {
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	if ((trim($usuario) == "") || (trim($senha) == "")) {
		$mensagem = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Login e Senha precisam ser preenchidos</p>';
	} else {
		$sql = "select usuario, senha from usuarios where usuario = '$usuario'";
		$result = $mysqli->query($sql);

		if ($row = $result->fetch_array()) {
			if ($row['senha'] == $senha) {
				// Login realizado com sucesso, salvamos a sessão
				$_SESSION['usuario'] = $usuario;
				// Redirecionamos para a página que lista os veículos cadastrados
				header("location: index.php");
			} else {
				$mensagem = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Senha Incorreta</p>';
			}
		} else {
			$mensagem = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Login Incorreto</p>';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Meu Css -->
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>

  <div class="container">

    <div class="row" id="login">
      <div class="col-sm-offset-4 col-sm-4">

      <div class="mensagem">

         <?php if (isset($mensagem)) {
	echo $mensagem;}
?>

      </div>

        <div class="login">
        <h3>Faça login para acessar o Sistema</h3>
        <form action="login.php" method="post">

          <div class="form-group">

            <label for="usuario" class="control-label"><strong>Usuário:</strong></label>
            <input type="text" name="usuario" size="40" maxlength="60" class="form-control" required placeholder="Usuário">

          </div>

          <div class="form-group">

            <label for="senha"><strong>Senha:</strong></label>
            <input type="password" name="senha" class="form-control" placeholder="Senha">

          </div>

          <button type="submit" class="btn btn-default btn-primary btn-block">Entrar</button>

        </form>
        </div>

      </div><!-- row -->
    </div><!-- col-md-12 col-xs-12 -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    </div><!-- container -->
  </body>
</html>