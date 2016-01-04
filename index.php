<?php

require_once "conexao.php";

require_once "autenticacao.php";

$usuario = $_SESSION['usuario']; // Pega o nome usuário que está logado

?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Gerenciamento de Livros</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

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
        <!--<a class="navbar-brand" href="#">CMS</a> -->
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <a href="logout.php" class="btn btn-danger navbar-btn navbar-right sair" title="Sair">
        <span class="glyphicon glyphicon-off"></span>
      Sair </a>

      <h5 class="btn btn-success navbar-btn navbar-right sair" title="Usuário Logado">
        <span class="glyphicon glyphicon-user"> <?php echo $usuario; ?>
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

    <div class="row" id="gerencia">
      <div class="col-xs-12 col-md-12">

      <!-- Breadcrumbs -->

      <ol class="breadcrumb">
        Você está em: <li class="active">Home</li>

      </ol>

       <a href="cadastro_de_livro.php" class="btn btn-primary" title="Adicionar novo">
        <span class="glyphicon glyphicon-plus"></span>
      Novo</a>

      <!-- Paginação -->

      <?php
//$sqli = mysqli_connect("localhost","root","root","ppgsnd");
$sql = "select count(*) from livro inner join autor on livro.id_autor=autor.id";
//select * from livro inner join autor on livro.id_autor = autor.id order by livro.titulo
$result = mysqli_query($mysqli, $sql);
$fetch = mysqli_fetch_assoc($result);

$fetch = array_shift($fetch);

$por_pagina = 5; // Itens a serem exibidos por página
$total = ceil($fetch / $por_pagina);

$pagina = isset($_GET['pagina']) ? ((int) $_GET['pagina'] >= $total ? $total : (int) $_GET['pagina']) : 1;
$pagina = $pagina < 1 ? 1 : $pagina;

$offset = ($pagina - 1) * $por_pagina;

$query = "Select * from livro inner join autor on livro.id_autor = autor.id order by livro.titulo limit {$por_pagina} offset {$offset}";
$resultado = mysqli_query($mysqli, $query);
?>


      <h2 align="center">Gerenciar Livros</h2>

        <table class="table table-striped table-hover table-bordered table-responsive">
          <thread>
            <tr>

              <th>Livro</th>
              <th>Autor</th>
              <th>Ações</th>

            </tr>
          </thread>

          <thbody>

          <?php if ($resultado->num_rows >= 1) {
	?>

            <?php while ($ih = mysqli_fetch_assoc($resultado)) {?>
              <tr>

              <td><?php echo $ih['titulo'] ?></td>
              <td><?php echo $ih['nome'] ?></td>
              <td><a title="Editar" class="glyphicon glyphicon-edit" href="editar_livro.php?id=<?php echo $ih['id'] ?>&titulo=<?php echo $ih['titulo'] ?>"></a> /
              <a title="Excluir" class="glyphicon glyphicon-trash" href="excluir.php?id=<?php echo $ih['id'] ?>&titulo=<?php echo $ih['titulo'] ?>" onclick="return confirm('Deseja excluir?');"></a></td>

            </tr>
            <?php }
	?>

          <?php } else {?>
            <tr>
              <td colspan="3"><?php echo "Nenhum Livro Cadastrado"; ?></td>
            </tr>
           <?php }
?>
          </thbody>

        </table>

        <!--Paginação links; -->

        <div id="link_paginacao">

            <?php

$proximo = $pagina + 1;
$anterior = $pagina - 1;

$proxima_pagina = $proximo <= $total ? true : false;
$anterior_pagina = $anterior >= 1 ? true : false;
?>

<nav>
  <ul class="pager">


<?php
if ($total > 1) {
	if ($anterior_pagina) {

		echo "<li><a href='?pagina={$anterior}'>Anterior</a></li>";
	}

	if ($proxima_pagina) {
		echo "<li><a href='?pagina={$proximo}'>Próximo</a></li>";
	}

}
?>

  </ul>
</nav>

      </div><!-- col-md-12-->
    </div><!-- row gerencia -->

    </div><!-- container -->
  </body>
</html>