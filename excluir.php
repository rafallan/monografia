<?php  

	require_once "conexao.php";

	$id = $_GET['id'];

	$titulo = $_GET['titulo'];

	$excluir = "delete livro from livro inner join autor on autor.id = livro.id_autor where autor.id = '$id' and livro.titulo = '$titulo'";

	// Apenas os dados da tabela livro são apagados

	$query = $mysqli->query($excluir);

	header("location: index.php");
?>