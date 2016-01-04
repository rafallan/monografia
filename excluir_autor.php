<?php

require_once "conexao.php";

$id = $_GET['id'];

$excluir = $mysqli->query("delete autor from autor where id = '$id'");

if ($excluir) {
	header("location: gerenciar_autores.php");
} else {
	echo "<script>alert('Impossível excluir. Há livro(s) cadastrados para esse autor');window.location.href='gerenciar_autores.php';</script>";
}

?>