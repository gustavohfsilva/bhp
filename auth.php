<?php

$resp="Sua sess\u00e3o foi desconectada. \\nFavor autenticar-se novamente";

// A sess�o precisa ser iniciada em cada p�gina diferente
if (!isset($_SESSION)) session_start(['cookie_lifetime' => 10800,]);
// Verifica se n�o h� a vari�vel da sess�o que identifica o usu�rio
	if (!isset($_SESSION['data'])) {
	  // Destr�i a sess�o por seguran�a
	  session_destroy();
  	// Redireciona o visitante de volta pro login
	echo ("<script type='text/javascript'> alert('$resp'); location.href='index.php'; </script>");
	}


?>
