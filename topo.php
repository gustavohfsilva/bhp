<?php
error_reporting(E_ALL & ~ E_NOTICE);
date_default_timezone_set('America/Sao_Paulo');
if ($page == "TV") {
		echo "";
		
} else {
        /*include "auth.php";
$foto           = $_SESSION['data']['foto'];
$nome           = $_SESSION['data']['name'];
$login          = $_SESSION['data']['login'];
$area           = $_SESSION['data']['department'] ;
$email          = $_SESSION['data']['email'];
$cargo          = $_SESSION['data']['title'];
$indo           = $_SESSION['data']['desc'];
$gerente        = $_SESSION['data']['manager'];
$desc           = $_SESSION['data']['desc'];
$ramal          = $_SESSION['data']['ramal'];
$login = ($login=="gustavo.henrique" ? "<a href=\"log\"><font color=\"FFFFFF\"><i class=\"fa fa-cog\"></i> LOG  </font></a>  <b>|</b> ":"" );
*/
}


$hoje = date('Y-m-d');
$hoje = substr($hoje, 0, 10);



?>

<body class="no-skin" leftmargin=0 topmargin=0>
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="dashboard" class="navbar-brand">
						<!--<small>
							<i class="fa fa-leaf"></i>
							Ace Admin
						</small>-->
						<img src="images/logoh.png" widht=""  height="">
					</a>
				</div>



		<div class="navbar-buttons navbar-header  pull-right" role="navigation" id="tasks">
		
			<ul class="nav ace-nav">
		
				
<?php
include "config.php";
$hoje = date("m-d");
$lsdate = date('m-d', strtotime("+7 days"));
$sql = "SELECT cd_nome, cd_dt_nascimento FROM cadastro_pessoa";
$qry = mysqli_query($conn, $sql);

while($ar = mysqli_fetch_array($qry)){
	$bnome 	= $ar["cd_nome"];
    $bnome 	= utf8_encode($bnome);
	$bday = $ar["cd_dt_nascimento"];
	$fbday 	= date('d-m-Y', strtotime($bday));
	$fbday 	= str_replace('-', '/', $fbday);
	$bday 	= date('m-d', strtotime($bday));

	if($bday == $hoje) {
		$aniversariantes+=1;	
		$lista.= "      <li>
							<a href=\"#\" class=\"clearfix\">
				                <span class=\"\">
					                <span class=\"msg-title\">
						                    <span class=\"blue  pull-left\"> <b>$bnome</b></span>
									 <span class=\"orange pull-right \">$fbday</span>
								</span>
							</a>
                        </li>";


	} 
		
}

?>

						<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-birthday-cake icon-animated-vertical"></i>
								<span class="badge badge-grey">
<?php 
if ($aniversariantes == null) { 
	echo "0"; 
} else { 
	echo "$aniversariantes";
}
?>
								</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-gift"></i>
									<?php echo $aniversariantes ?> 
									<?php
									if($aniversariantes == 1) {
										echo "Aniversariante";
									}else{
										echo  "Aniversariantes";
									}
									?> 
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">

									<?php echo $lista ?>

									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										<i class="ace-icon fa fa-close"></i>
									</a>
								</li>
							</ul>
						</li>

					
						<li class="white">
							<!--<a data-toggle="dropdown" href="#" class="dropdown-toggle">-->
							<p>
							<?php
							
								if ($page == "TV") {
									
								} else {
								
								 echo '<img class="nav-user-photo" src="data:image/jpeg;base64,' . base64_encode($foto) . '" width="36" height="36" title="'.$nome.'" />';
								 
								echo "
									<span class=\"user-info\">
										<small>Logado como,</small>
										 $nome
									</span>
											
									<ul>
										<li>
										
										$login
										
										
											<a href=\"logout.php\">
											<font color=\"FFFFFF\">
												<i class=\"fa fa-power-off\"></i>
												  Sair </font>
											</a>
										</li>
									</ul>
									
									";
							}?>
														
						</li> 
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>
