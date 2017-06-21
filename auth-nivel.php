<?php
$cwd=getcwd();
//print_r(getcwd());/
//die;/
$resp="Prezado $nome, voc\u00ea n\u00e3o possui permiss\u00e3o para este acesso";

// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$user = "gustavo.henrique";

// Verifica se não há a variável da sessão que identifica o usuário
	if (($_SESSION['data']['login']) != $user ) {
	  // Destrói a sessão por segurança
	//  session_destroy();
  	// Redireciona o visitante de volta pro login

	echo ("<script type='text/javascript'> alert('$resp'); location.href='dashboard'; </script>");
	}


?>
