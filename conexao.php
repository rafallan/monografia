<?php

$host = "localhost"; //host
$usuario = "root";
$senha = "root";
$banco = "dados";

$mysqli = new mysqli($host, $usuario, $senha, $banco);

$mysqli->set_charset('utf8');

?>