<?php
require_once("ladp.php");
require_once("config.php");

    if(isset($_POST['logar'])){

        $login = $_REQUEST['login'].$ldap_dominio;
        $pass  = $_REQUEST['senha'];

        $success_login = true;

        if($login && $pass){

            if (valida_ldap($login, $pass)){
                $_SESSION["data"] = get_data_ldap( $_REQUEST['login'], $pass);
		$dados = get_data_ldap( $_REQUEST['login'], $pass);
		grava_log($dados);

                header("Location: dashboard");
            }else {
                $success_login = false;
                session_destroy();
            }
        }
    }
        if(isset($_GET['action'])){
            $action = $_GET['action'];
        }

            if(isset($action) && $action === "logout"){
                session_destroy();
                header("Location: login");
            }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title> BH Poker Sports </title>
    <link href="../assets/login/bootstrap.css" rel="stylesheet" />
    <link href="../assets/login/endless.css" rel="stylesheet" />
	<link rel="shortcut icon" type="images/png" href="images/favicon.png"/>

</head>
<body>
<div id="formAutenticacao">
    <div class="pace pace-inactive">
        <div data-progress="99" data-progress-text="100%" style="width: 100%;" class="pace-progress">
            <div class="pace-progress-inner"></div>
        </div>
        <div class="pace-activity"></div>
    </div>

    <div class="login-wrapper">
        <div class="text-center">
            <?php if(isset($success_login) && $success_login === false){
                echo '<div class="alert alert-danger" style="width: 25%;margin-left: 38%;">
											<button type="button" class="close" data-dismiss="alert">
												<i class="icon-remove"></i>
											</button>

											<strong>
												<i class="icon-remove"></i>
												Usu&aacute;rio ou senha incorretos!
											</strong>
											<br>
										</div>';
            }
            ?>
            <h2 class="fadeInUp animation-delay8" style="font-weight: bold">
                <img src="images/logo.png" width="170" height="211"/>
            </h2>
        </div>
        <div class="login-widget animation-delay1">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST" action="">

                        <div class="form-group">
                            <label>Usu&aacute;rio</label>
                            <input type="text" name="login" placeholder="Digite o login de rede" class="form-control input-sm bounceIn animation-delay2"  />
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="senha" placeholder="Digite a senha de rede" class="form-control input-sm bounceIn animation-delay4"  />
                        </div>
                        <div class="seperator"></div>
                        <hr>
                        <input type="submit" id="btnEntrar" name="logar" value="Entrar" class="btn btn-danger btn-sm bounceIn animation-delay5 login-link pull-right" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
