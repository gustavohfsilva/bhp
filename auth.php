<?php

$resp="Sua sess\u00e3o foi desconectada. \\nFavor autenticar-se novamente";

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start(['cookie_lifetime' => 10800,]);
// Verifica se não há a variável da sessão que identifica o usuário
	if (!isset($_SESSION['data'])) {
	  // Destrói a sessão por segurança
	  session_destroy();
  	// Redireciona o visitante de volta pro login
	echo ("<script type='text/javascript'> alert('$resp'); location.href='index.php'; </script>");
	}


?>
