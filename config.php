<?php
$host = "127.0.0.1"; //Servidor do mysql
$user = "root"; //Usuario do banco de dados
$senha = ""; //senha do banco de dados
$db = "bhpoker";
$conn = mysqli_connect($host, $user, $senha, $db);
		mysqli_connect($host, $user, $senha, $db) or die (mysqli_error());

?>

