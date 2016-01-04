<?php
require_once "conexao.php";

require_once "autenticacao.php";

$usuario = $_SESSION['usuario']; // Pega o nome usuário que está logado

$id = $_GET['id'];
$selecionar = $mysqli->query("select * from autor where id = '$id'");
$autor = $selecionar->fetch_array();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Editar Autor</title>

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
        <!--<a class="navbar-brand" href="#">CMS</a> -->
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <a href="logout.php" class="btn btn-danger navbar-btn navbar-right sair" title="Sair">
        <span class="glyphicon glyphicon-off"></span>
      Sair </a>

      <h5 class="btn btn-success navbar-btn navbar-right sair" title="Usuário Logado">
        <span class="glyphicon glyphicon-user">
          <?php echo $usuario; ?>
        </span>
      </h5>

          <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
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
		<div class="col-md-12">

    <!-- Breadcrumbs -->

      <ol class="breadcrumb">
        Você está em: <li><a href="gerenciar_autores.php">Gerenciar Autores</a></li>
                      <li class="active">Editar Autor</li>
      </ol>


			<h2>Editar Autor</h2>

			<form action="executar_editar_autor.php" method="post" id="form">

				<div class="form-group">

					<label for="nome"><strong>Nome:</strong></label>
					<input type="text" name="nome" id="nome" class="form-control" size="50"
          maxlength="60" required value="<?php echo $autor['nome']; ?>" onkeypress="return somenteLetras(event)"
          onkeyup="alteraMaiusculo()">

				</div>
				<button type="submit" value="Atualizar dados" name="cadastrar" class="btn btn-primary">Atualizar</button>
				<a href="gerenciar_autores.php" class="btn btn-default">Voltar</a>

				<input type="hidden" name="id" value="<?php echo $autor['id']; ?>">

			</form>

		</div>
	</div>

	</div><!-- Container -->

</body>
</html>