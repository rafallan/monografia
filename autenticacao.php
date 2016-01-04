<?php
session_start();

//Caso o usuário não esteja autenticado, limpa os dados e redireciona
if (!isset($_SESSION['usuario']) and !isset($_SESSION['senha'])) {
	//Destrói
	session_destroy();

	//Limpa
	unset($_SESSION['usuario']);
	unset($_SESSION['senha']);

	//Redireciona para a página de login
	header('location:login.php');
}
?>