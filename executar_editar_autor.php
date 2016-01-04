<?php

require_once "conexao.php";

$id = $_POST['id'];

$nome = $_POST['nome'];

$validarForm = true;

if (empty($nome) || strlen($nome) <= 5) {

	$validarForm = false;
	echo "<script>alert('Preencha o nome do autor completo');window.location.href='gerenciar_autores.php';</script>";
}

if ($validarForm) {

	$selecionar = $mysqli->query("select nome from autor where nome = '$nome'");

	if (mysqli_num_rows($selecionar) >= 1) {

		$validarForm = false;
		echo "<script>alert('Autor já cadastrado');window.location.href='gerenciar_autores.php';</script>";

	} else {
		$editar = "update autor set nome ='$nome' where id = '$id'";

		$query = $mysqli->query($editar);

		echo "<script>alert('Dados atualizados com sucesso');window.location.href='gerenciar_autores.php';</script>";
	}

}

?>