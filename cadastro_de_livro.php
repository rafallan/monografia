<?php

require_once "conexao.php";

require_once "autenticacao.php";

$usuario = $_SESSION['usuario']; // Pega o nome usuário que está logado

$autores = $mysqli->query("select * from autor order by nome");

// Validação do form

if (isset($_POST['cadastrar'])) {
	$validarForm = true;

	$nome = trim($_POST['nome']);
	if (empty($nome) || strlen($nome) <= 5) {
		$msg_nome = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Preencha o nome do livro completo</p>';
		$validarForm = false;
	}

	$autor = trim($_POST['autor']);
	if (empty($autor) || ($autor == "Selecione o autor")) {
		$msg_autor = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Selecione o autor do livro</p>';
		$validarForm = false;
	}

	if ($validarForm) {

		$selecionar = $mysqli->query("select titulo from livro inner join autor on autor.id = livro.id_autor where livro.titulo = '$nome' and livro.id_autor = '$autor'");

		if (mysqli_num_rows($selecionar) >= 1) {
			$msg_livro_cadastrado = '<p class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           Livro já cadastrado para esse autor</p>';
			$validarForm = false;
		} else {
			$inserir = $mysqli->query("insert into livro (id, titulo, id_autor) values (null, '$nome', '$autor')");

			$msg_envio = "Dados cadastrados com sucesso";
		}

	}
}

// Fim validação do form

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cadastro de Livro</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- validação javascript -->
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

      <a href="logout.php" class="btn btn-danger navbar-btn navbar-right sair" title="Sair">
        <span class="glyphicon glyphicon-off"></span>
      Sair</a>

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

    <div class="row" id="conteudo">
      <div class="col-md-12 col-xs-12">

      <!-- Breadcrumbs -->

      <ol class="breadcrumb">
        Você está em: <li><a href="index.php">Home</a></li>
                      <li class="active">Cadastrar Livro</li>
      </ol>


<?php if (isset($msg_nome)) {
	echo $msg_nome;
}
?>

<?php if (isset($msg_autor)) {
	echo $msg_autor;
}
?>

<?php if (isset($msg_livro_cadastrado)) {
	echo $msg_livro_cadastrado;
}
?>

<?php if (isset($msg_envio)) {
	echo "<p class='alert alert-success alert-dismissible' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              $msg_envio</p>";
}
?>

        <h2>Cadastro de Livro</h2>
        <form action="" method="post" id="form">

          <div class="form-group">

            <label for="nome"><strong>Nome:</strong></label>
            <input type="text" name="nome" id="nome" size="40"
            maxlength="60" class="form-control" placeholder="Nome do livro" onkeyup="alteraMaiusculo()">

          </div>

          <div class="form-group">

            <label for="autor"><strong>Autor:</strong></label>
            <select name="autor" id="autor" class="form-control">
              <option>Selecione o autor</option>

                <?php while ($ih = $autores->fetch_array()) {?>
                <option value="<?php echo $ih['id'] ?>"><?php echo $ih['nome'] ?></option>
                <?php }
?>
            </select>

          </div>

              <button type="submit" name="cadastrar" class="btn btn-default btn-primary">Cadastrar</button>
              <a href="index.php" class="btn btn-default">Voltar</a>

        </form>

      </div><!-- row -->
    </div><!-- col-md-12 col-xs-12 -->

</div><!-- container -->
</body>
</html>