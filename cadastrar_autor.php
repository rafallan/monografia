<?php
require_once "conexao.php";
require_once "autenticacao.php";

$usuario = $_SESSION['usuario']; // Pega o nome usuário que está logado

if (isset($_POST['cadastrar'])) {
	$validarForm = true;

	$nome = trim($_POST['nome']);
	if (empty($nome) || strlen($nome) <= 5) {
		$msg_nome = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Preencha o primeiro e último nome do autor</p>';
		$validarForm = false;
	}

	if ($validarForm) {

		$selecionar = $mysqli->query("select nome from autor where nome = '$nome'");

		if (mysqli_num_rows($selecionar) >= 1) {
			$msg_nome_cadastrado = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Autor já cadastrado</p>';
			$validarForm = false;
		} else {
			$inserir = $mysqli->query("insert into autor (id, nome) values (null, '$nome')");

			$msg_envio = "Dados cadastrados com sucesso";
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
    <title>Cadastrar Autor</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Validação javascript -->
    <script src="js/valida.js"></script>
     <!-- Meu Css -->
    <link rel="stylesheet" href="css/style.css">

  </head>
  <body>
  	<div class="container">

  	<nav class="navbar navbar-default navbar-inverse" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Navegação</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <a href="logout.php" class="btn btn-danger navbar-btn navbar-right sair">
        <span class="glyphicon glyphicon-off"></span> Sair
      </a>

      <h5 class="btn btn-success navbar-btn navbar-right sair" title="Usuário Logado">
        <span class="glyphicon glyphicon-user">
          <?php echo $usuario; ?>
        </span>
      </h5>

          <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Autor <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                      <li><a href="gerenciar_autores.php">Gerenciar</a></li>
                      <li><a href="cadastrar_autor.php">Cadastrar</a></li>
                  </ul>
              </li>
          </ul>
      </div>

    </div>
    </nav>

    <div class="row">
    	<div class="col-sm-12">

      <!-- Breadcrumbs -->

      <ol class="breadcrumb">
        Você está em: <li><a href="gerenciar_autores.php">Gerenciar Autores</a></li>
                      <li class="active">Cadastrar Autor</li>
      </ol>

      <?php if (isset($msg_nome)) {
	echo $msg_nome;
}

?>

<?php if (isset($msg_nome_cadastrado)) {
	echo $msg_nome_cadastrado;
}

?>

          <?php if (isset($msg_envio)) {
	echo "<p class='alert alert-success alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              $msg_envio</p>";
}

?>

    		<h2>Cadastrar Autor</h2>
			<form action="" method="post" id="form">

          <div class="form-group">

            <label for="nome"><strong>Nome:</strong></label>
            <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome do autor" size="50"
            maxlength="60" onkeypress="return somenteLetras(event)" onkeyup="alteraMaiusculo()">

          </div>

						<button type="submit" name="cadastrar" class="btn btn-default btn-primary">Cadastrar</button>
            <a href="gerenciar_autores.php" class="btn btn-default">Voltar</a>

			</form>


    	</div>
    </div>

    </div><!-- container-- >
  </body>
</html>





