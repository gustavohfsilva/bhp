<?php
$cwd=getcwd();
//print_r(getcwd());/
//die;/
$resp="Prezado $nome, voc\u00ea n\u00e3o possui permiss\u00e3o para este acesso";

// A sess�o precisa ser iniciada em cada p�gina diferente
if (!isset($_SESSION)) session_start();

$user = "gustavo.henrique";

// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
	if (($_SESSION['data']['login']) != $user ) {
	  // Destr�i a sess�o por seguran�a
	//  session_destroy();
  	// Redireciona o visitante de volta pro login

	echo ("<script type='text/javascript'> alert('$resp'); location.href='dashboard'; </script>");
	}


?>
