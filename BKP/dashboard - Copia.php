<?php

$page= "Dashboard";
include "head.php";
include "topo.php";
include "config.php";

//////////// Variaveis
date_default_timezone_set('America/Sao_Paulo');
$hoje = date("Y-m-d");

include "consultas.php";


	/// Calcular Porcentagem
	
	/*$cash_total_compras = str_replace(".","", $cash_total_compras);
	$cash_total_compras = str_replace(",","", $cash_total_compras);
	$cash_fichas = str_replace(".","", $cash_fichas);
	$cash_fichas = str_replace(",","", $cash_fichas);*/
	
	

	
	
?>



<body >
	

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						
						<div class="page-header">
								<h1>
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									overview
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								
								<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-7 infobox-container">
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-play"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">
													<?php 
													if (empty($dt_mesas)) {
														echo 0; 
													} else {
														echo $mesas;
													}
													?>
												</span>
												<div class="infobox-content">Mesas</div>
											</div>

										</div>

										<div class="infobox infobox-blue">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-location-arrow"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">
													<?php 
													if (empty($assentos)) {
														echo 0; 												
													} else {
														$lugares=($mesas*$assentos); 
														echo $lugares;	
														
													}
													?>
												</span>
												<div class="infobox-content">Lugares</div>
											</div>

										</div>

										<div class="infobox infobox-purple">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-bookmark-o"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">
												<?php 
												if (empty($assentos)) {
													echo 0;								
												} else {
													$livre=("$lugares" - "$c_espera"); 
													echo $livre;	
													
												}	
													?>
												</span>
												<div class="infobox-content">Lugares livres</div>
											</div>
											
										</div>

										<div class="infobox infobox-black">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-hourglass-1"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">
													<?php echo "$f_espera"; ?>
												</span>
												<div class="infobox-content">Fila de espera</div>
											</div>
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-ban"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo "$d_espera"; ?></span>
												<div class="infobox-content"><a href="lista?data=<?php echo $hoje?>">Desist&ecirc;ncias hoje</a></div>
											</div>

											
										</div>

										<div class="infobox infobox-blue2">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="100" data-size="46">
													<span class="percent">								
														<?php 
														if (empty($total)) {
															echo 0; 												
														} else {
															echo $total;	
															
														}
														?>
													</span>
												</div>
											</div>

											<div class="infobox-data">
												<span class="infobox-text">Total de</span>

												<div class="infobox-content">
													<span class="bigger-110"><a href="lista?jogadores=<?php echo $hoje?>">jogadores hoje</span></a>
													
												</div>
											</div>
										</div>
<?php

////////// Function


					if(isset($_GET["sentar"])){
						include "functions.php";
						sentar();
						}						

					if(isset($_GET["desistir"])){
						include "functions.php";
						desistir();
						}
						
					if(isset($_GET["sair"])){
						include "functions.php";
						sair();
						}
					if(isset($_GET["comprar"])){
						include "functions.php";
						comprar();
						}
					if(isset($_GET["pagar"])){
						include "functions.php";
						pagar();
						}
					
////////// Cadastro



if (isset($_POST['enviar'])){

	$v_espera = $_POST['espera'];
	 
	 if ($v_espera=='Nao') {
		 $ativo='1';
	 } else {
		 $ativo='0';
	 }
	 
	 if ($v_espera=='Sim') {
		 $entrada="'0000-00-00 00:00:00'";
	 } else {
		 $entrada='NOW()';
	 }
	 
		
        if ($_POST["nome"]){
			$nome = $_POST['nome'];
			$nome =	strtoupper($nome);
			$espera = $_POST['espera'];
			$poker = $_POST['poker'];

			if ($livre > 0 AND $espera == "Nao") {
				
				$sql = "INSERT INTO cash SET nome='$nome', data=NOW(), espera='$espera', ativo='$ativo', entrada=$entrada, mesa='$poker', caixa='$cx_id' ";
				mysqli_query($conn,$sql);
		
                    echo "<script>alert('Jogador: $nome cadastrado com sucesso.');location.href='dashboard'</script>";
                    unset($nome);
					unset($espera);
					unset($ativo);
					unset($entrada);

			}elseif ($espera == "Sim") {
					echo "<script>alert('Jogador $nome, ser\u00e1 adicionado \u00e0 fila de espera');location.href='dashboard';</script>";
					$sql = "INSERT INTO cash SET nome='$nome', data=NOW(), espera='Sim', ativo='0', mesa='$poker', caixa='$cx_id' ";
					mysqli_query($conn,$sql);
			}else {
					echo "<script>alert('N\u00e3o existe lugar dispon\u00edvel. \\nO jogador $nome, ser\u00e1 adicionado \u00e0 fila de espera');location.href='dashboard';</script>";
					$sql = "INSERT INTO cash SET nome='$nome', data=NOW(), espera='Sim', ativo='0', mesa='$poker', caixa='$cx_id' ";
					mysqli_query($conn,$sql);
								
                    }
        }
}

?>
										<div class="space-6"></div>
										
										<div class="infobox infobox-blue infobox-dark">
											<div class="infobox-chart">
												<span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Fichas</div>
												<div class="infobox-data-number">
													<?php 
													if (empty($cash_fichas)) {
														echo 0; 												
													} else {
													$cash_fichas = number_format($cash_fichas, 2, ',', '.');
													echo $cash_fichas ;
													}
													
													?>
												</div>
											</div>
										</div>

										<div class="infobox infobox-green  infobox-dark">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="<?php if (empty($percent_compra )) { echo 0; } else { echo $percent_compra; } ?>" data-size="49">
													<span class="percent"><?php if (empty($percent_compra )) { echo 0; } else { echo $percent_compra; } ?></span>%
												</div>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Entrada</div>
												<div class="infobox-data-number">R$ 
												<?php 
												if (empty($cash_compras_total)) {
													echo "0";
												}else {
													echo $cash_compras_total; 
												}
											?> </div>
											</div>
										</div> 

										<div class="infobox infobox-grey  infobox-dark">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-download"></i>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Sa&iacute;da</div>
												<div class="infobox-data-number">R$ 
												<?php 
												if (empty($cash_pagamentos_total)) {
													echo "";
												}else {
													echo $cash_pagamentos_total;
												}
												
												?></div>
											</div>
										</div>
									</div>

									<div class="vspace-12-sm"></div>

									
								</div><!-- /.row -->

								<div class="hr hr32 hr-dotted"></div>
								
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-cogs green"></i> <b>Configurar</b> / 
													<a href="#modal-form-config" role="button" class="green" data-toggle="modal" title="Configurar"> 
													<i class="ace-icon fa fa-cog blue"></i> </a>
														- 
													 <b>Fechar Caixa</b> / 
													<a href="#modal-form-fecharcx" role="button" class="green" data-toggle="modal" title="Fechar caixa"> 
													<i class="ace-icon fa fa-times red"></i> </a>
												</h4>
								
								<div class="hr hr32 hr-dotted"></div>
								
								<div class="row" >
									<div class="col-sm-6">
										<div class="widget-box transparent" id="recent-box">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-gamepad red"></i>Controle de Jogadores /  
													<a href="#modal-form" role="button" class="blue" data-toggle="modal" title="Adicionar"> <i class="ace-icon fa fa-plus blue"></i> </a>
													
													</h4>

												<div class="widget-toolbar no-border">
													<ul class="nav nav-tabs" id="recent-tab">
														<li class="active" >
															<a data-toggle="tab" href="#task-tab">Fila de espera</a>
														</li>
																												
														<li>
															<a data-toggle="tab" href="#member-tab">Jogando</a>
														</li>
														<li>
															<a data-toggle="tab" href="#dealers-tab">Dealers</a>
														</li>
														
													</ul>
												</div>
											</div>

										<div class="widget-body">
												<div class="widget-main padding-4">
													<div class="tab-content padding-8">
														<div id="task-tab" class="tab-pane active">
														<div class="widget-box transparent">
											
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-hourglass-1"></i>
													Fila de Espera
												</h4>

												
											</div>

											<div class="widget-body" >
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Nome
																</th>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Mesa
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Tempo
																</th>

																<th class="">
																	<i class="ace-icon fa fa-caret-right blue"></i> A&ccedil;&atilde;o
																</th>
																
																
																</th>
															</tr>
														</thead>
<!-- AQUI -->


<?php

$dt_now = date("Y-m-d H:i:s");
$sql = "SELECT * FROM cash cs 
		left join cash_tmesa tm on tm.tm_id = cs.mesa where espera='Sim' ORDER BY data ASC";
$qry = mysqli_query($conn, $sql);

        while($ar = mysqli_fetch_array($qry)){
                        $fila_id = $ar["id"];
						$nome = $ar["nome"];
						$mesa = $ar["nome_mesa"];
                        //$nome = utf8_encode($nome);
                        $data = $ar["data"];
						$f_data = date('H:i',strtotime($data));
						$to_time=strtotime("$data");
						$from_time=strtotime("$dt_now"); 
						$data = round(abs($to_time - $from_time)/60);

						
						echo "<tbody>
															<tr>
																<td><b>".$nome."</td>
																<td><b>".$mesa."</td>";
?>
																<td nowrap>
																	<a href="" title="<?php echo $f_data; ?>" >
																	
																	<span class=""><i class="ace-icon fa fa-clock-o"></i>
																	</a>
																	<?php 
																			//echo "<span class=\"green\"><b>$data min</b></span>";
																		if ($data < 15 ) {
																			echo "<span class=\"green\"><b>$data min</b></span>";
																		}
																		elseif ($data > 15 && $data < 30) {
																			echo "<span class=\"orange\"><b>$data min</b></span>";
																		}
																		elseif ($data > 30 && $data < 45) {
																			echo "<span class=\"blue\"><b>$data min</b></span>";
																		}
																		elseif ($data > 45 && $data < 60) {
																			echo "<span class=\"purple\"><b>$data min</b></span>";
																		}
																		elseif ($data > 60 && $data < 120) {
																			echo "<span class=\"red\"><b>1 h</b></span>";
																		}
																		elseif ($data > 120 && $data < 180) {
																			echo "<span class=\"red\"><b>2 h</b></span>";
																		}
																		elseif ($data > 180 && $data < 240) {
																			echo "<span  class=\"red\"><b>3 h</b></span>";
																		}
																		elseif ($data > 240 && $data < 300) {
																			echo "<span class=\"red\"><b>4 h</b></span>";
																		}
																		elseif ($data > 300 && $data < 360) {
																			echo "<span class=\"red\"><b>5 h</b></span>";
																		}
																		elseif ($data > 360 && $data < 420) {
																			echo "<span class=\"red\"><b>6 h</b></span>";
																		}
																		elseif ($data > 420 && $data < 480) {
																			echo "<span class=\"red\"><b>7 h</b></span>";
																		}
																		elseif ($data > 480 && $data < 540) {
																			echo "<span class=\"red\"><b>8 h</b></span>";
																		}
																		elseif ($data > 540 && $data < 600) {
																			echo "<span class=\"red\"><b>9 h</b></span>";
																		}
																		elseif ($data > 600 && $data < 660) {
																			echo "<span class=\"red\"><b>10 h</b></span>";
																		}
																	
																	?>
																	</span>
																</td>
						<?php
						echo "
																<td>
																	<div class=\"tools\">
																		
																		<div class=\"action-buttons bigger-125\">
																			<a href=\"dashboard.php?sentar=$fila_id\" title=\"Sentar\" >
																				<i class=\"ace-icon fa fa-check green\"></i>
																			</a>
																			<a href=\"dashboard.php?desistir=$fila_id\" title=\"Desistir\">
																				<i class=\"ace-icon fa fa-undo blue\"></i>
																			</a>
																			<!--<a href=\"#\" title=\"Excluir\">
																				<i class=\"ace-icon fa fa-trash-o red\"></i>
																			</a>-->
																		</div>
																	
																	</div>
																</td>	
															</tr>
";
															}
															
															
																?>

														</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div>	
										</div>

									<div id="member-tab" class="tab-pane">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-trophy blue"></i>
													Jogando
												</h4>

												
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Nome
																</th>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Mesa
																</th>
																
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Valor
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Tempo
																</th>

																<th class="">
																	<i class="ace-icon fa fa-caret-right blue"></i> A&ccedil;&atilde;o
																</th>
																
															</tr>
														</thead>
<!-- AQUI -->
<?php
$dt_now = date("Y-m-d H:i:s");
/*$sql = "SELECT * FROM cash cs 
			left join cash_tmesa tm on tm.tm_id = cs.mesa
			left join cash_entrada ce on cs.id = ce.cmp_id_jogador 
		where ativo='1' 
		AND espera='Nao' 
		ORDER BY data ASC";*/
		
$sql = "SELECT *  FROM cash cs
			LEFT JOIN (SELECT tm_id, nome_mesa FROM cash_tmesa AS tm) tm on tm.tm_id = cs.mesa
			LEFT JOIN (SELECT cmp_id_jogador, sum(cmp_valor) as valor FROM cash_entrada  GROUP BY cmp_id_jogador ) ce ON (cs.id = ce.cmp_id_jogador) 
		where ativo='1' 
		AND espera='Nao' 
		ORDER BY data ASC";		
$qry = mysqli_query($conn, $sql);

        while($ar = mysqli_fetch_array($qry)){
                        $jogador_id = $ar["id"];
						$nome = $ar["nome"];
                        $nome = utf8_encode($nome);
						$mesa = $ar["nome_mesa"];
                        $data = $ar["data"];
						$entrada = $ar["entrada"];
						$valor = $ar["valor"];
						$valor = number_format($valor, 2, ',', '.');
						$c_data = date('H:i',strtotime($data));
						$e_data = date('H:i',strtotime($entrada));
						$to_time=strtotime("$data");
						$entrada_time=strtotime("$entrada");
						$from_time=strtotime("$dt_now"); 
						$data = round(abs($from_time - $to_time)/60);
						$data_e = round(abs($from_time - $entrada_time)/60);
						echo "<tbody>
															<tr>
																<td><b>".$nome." </td>
																<td><b>".$mesa."</td>
																<td><b>R$ ".$valor."</td>";
?>
																<td nowrap>
																		<a href="" title="<?php echo $e_data; ?>" >
																			<span class=""><i class="ace-icon fa fa-clock-o"></i>
																		</a>
																	<?php 
																		
																		//echo "<span class=\"green\"><b>data_e min</b></span>";
																		if ($data_e < 15 ) {
																			echo "<span class=\"green\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 15 && $data_e < 30) {
																			echo "<span class=\"orange\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 30 && $data_e < 45) {
																			echo "<span class=\"blue\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 45 && $data_e < 60) {
																			echo "<span class=\"grey\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 60 && $data_e < 120) {
																			echo "<span class=\"red\"><b>1 h</b></span>";
																		}
																		elseif ($data_e > 120 && $data_e < 180) {
																			echo "<span class=\"red\"><b>2 h</b></span>";
																		}
																		elseif ($data_e > 180 && $data_e < 240) {
																			echo "<span class=\"red\"><b>3 h</b></span>";
																		}
																		elseif ($data_e > 240 && $data_e < 300) {
																			echo "<span class=\"red\"><b>4 h</b></span>";
																		}
																		elseif ($data_e > 300 && $data_e < 360) {
																			echo "<span class=\"red\"><b>5 h</b></span>";
																		}
																		elseif ($data_e > 360 && $data_e < 420) {
																			echo "<span class=\"red\"><b>6 h</b></span>";
																		}
																		elseif ($data_e > 420 && $data_e < 480) {
																			echo "<span class=\"red\"><b>7 h</b></span>";
																		}
																		elseif ($data_e > 480 && $data_e < 540) {
																			echo "<span class=\"red\"><b>8 h</b></span>";
																		}
																		elseif ($data_e > 540 && $data_e < 600) {
																			echo "<span class=\"red\"><b>9 h</b></span>";
																		}
																		elseif ($data_e > 600 && $data_e < 660) {
																			echo "<span class=\"red\"><b>10 h</b></span>";
																		}
																	
																	?>
																	
																	</span>
																</td>

						<?php
						echo "
																<td>
																	<div class=\"tools\">
																	<form method=\"POST\">
																		<div class=\"action-buttons bigger-125\">
																																				
																			 <a href=\"dashboard.php?comprar=$jogador_id\" role=\"button\" class=\"green\" data-toggle=\"modal\" title=\"Compra\">
																			 <i class=\"ace-icon fa fa-money green\"></i>
																			</a>
																			<a href=\"dashboard.php?pagar=$jogador_id\" role=\"button\" class=\"orange\" data-toggle=\"modal\" title=\"Cash Out\">
																			 <i class=\"ace-icon fa fa-sign-out orange\"></i>
																			</a>
																			<a href=\"dashboard.php?sair=$jogador_id\"\" title=\"Sair da mesa\" >
																				<i class=\"ace-icon fa fa-power-off red\"></i>
																			</a>
																			
																		</div>
																	</form>
																	</div>
																</td>	
															</tr>
";
															}
															
															
																?>


														</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div>	
									</div>
									
									<div id="dealers-tab" class="tab-pane">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-trophy blue"></i>
													Dealers
												</h4>

												
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Nome A
																</th>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Mesa
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i> Tempo
																</th>

																<th class="">
																	<i class="ace-icon fa fa-caret-right blue"></i> A&ccedil;&atilde;o
																</th>
																
															</tr>
														</thead>
<!-- AQUI -->
<?php
$dt_now = date("Y-m-d H:i:s");
$sql = "SELECT * FROM cash cs 
		left join cash_tmesa tm on tm.tm_id = cs.mesa where ativo='1' AND espera='Nao' ORDER BY data ASC";
$qry = mysqli_query($conn, $sql);

        while($ar = mysqli_fetch_array($qry)){
                        $dealers_id = $ar["id"];
						$nome = $ar["nome"];
                        $nome = utf8_encode($nome);
						$mesa = $ar["nome_mesa"];
                        $data = $ar["data"];
						$entrada = $ar["entrada"];
						$c_data = date('H:i',strtotime($data));
						$e_data = date('H:i',strtotime($entrada));
						$to_time=strtotime("$data");
						$entrada_time=strtotime("$entrada");
						$from_time=strtotime("$dt_now"); 
						$data = round(abs($from_time - $to_time)/60);
						$data_e = round(abs($from_time - $entrada_time)/60);
						echo "<tbody>
															<tr>
																<td><b>".$nome."</td>
																<td><b>".$mesa."</td>";
?>
																<td nowrap>
																		<a href="" title="<?php echo $e_data; ?>" >
																			<span class=""><i class="ace-icon fa fa-clock-o"></i>
																		</a>
																	<?php 
																		
																		//echo "<span class=\"green\"><b>data_e min</b></span>";
																		if ($data_e < 15 ) {
																			echo "<span class=\"green\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 15 && $data_e < 30) {
																			echo "<span class=\"orange\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 30 && $data_e < 45) {
																			echo "<span class=\"blue\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 45 && $data_e < 60) {
																			echo "<span class=\"grey\"><b>$data_e min</b></span>";
																		}
																		elseif ($data_e > 60 && $data_e < 120) {
																			echo "<span class=\"red\"><b>1 h</b></span>";
																		}
																		elseif ($data_e > 120 && $data_e < 180) {
																			echo "<span class=\"red\"><b>2 h</b></span>";
																		}
																		elseif ($data_e > 180 && $data_e < 240) {
																			echo "<span class=\"red\"><b>3 h</b></span>";
																		}
																		elseif ($data_e > 240 && $data_e < 300) {
																			echo "<span class=\"red\"><b>4 h</b></span>";
																		}
																		elseif ($data_e > 300 && $data_e < 360) {
																			echo "<span class=\"red\"><b>5 h</b></span>";
																		}
																		elseif ($data_e > 360 && $data_e < 420) {
																			echo "<span class=\"red\"><b>6 h</b></span>";
																		}
																		elseif ($data_e > 420 && $data_e < 480) {
																			echo "<span class=\"red\"><b>7 h</b></span>";
																		}
																		elseif ($data_e > 480 && $data_e < 540) {
																			echo "<span class=\"red\"><b>8 h</b></span>";
																		}
																		elseif ($data_e > 540 && $data_e < 600) {
																			echo "<span class=\"red\"><b>9 h</b></span>";
																		}
																		elseif ($data_e > 600 && $data_e < 660) {
																			echo "<span class=\"red\"><b>10 h</b></span>";
																		}
																	
																	?>
																	
																	</span>
																</td>
						<?php
						echo "
																<td>
																	<div class=\"tools\">
																	<form method=\"POST\">
																		<div class=\"action-buttons bigger-125\">
																		
																		
														
																		
																			<a data-target=\"#modal-form-compra\"  href=\"#?fichas=$jogador_id\" data-id=\"$jogador_id\" role=\"button\" class=\"green\" data-toggle=\"modal\" title=\"Compra\" >
																			 <i class=\"ace-icon fa fa-money green\"></i>
																			</a>
																			<a href=\"#modal-form-cashout\" data-id=\"$jogador_id\" role=\"button\" class=\"orange\" data-toggle=\"modal\" title=\"Cash Out\">
																			 <i class=\"ace-icon fa fa-sign-out orange\"></i>
																			</a>
																			<a href=\"dashboard.php?sair=$jogador_id\"\" title=\"Sair da mesa\" >
																				<i class=\"ace-icon fa fa-power-off red\"></i>
																			</a>
																			
																		</div>
																	</form>
																	</div>
																</td>	
															</tr>
";
															}
															
															
																?>


														</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div>	
									</div>
								</div><!-- /.#member-tab -->

								
								<div class="row">
									<div class="col-sm-6">
														
									<div id="modal-form" class="modal" tabindex="-1">
										<form method="post">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Adicionar Jogador</h4>
													</div>

													<div class="modal-body">
														<div class="row">
														
															<div class="col-xs-12 col-sm-7">
																<div class="form-group">
																	<label class="col-sm control-label no-padding-right" for="form-field-1"> Nome </label>
																	
																	<div>
																		<input type="text" id="form-field-1-1" name="nome" style="text-transform:uppercase" class="form-control" required="">	
																															
																	</div>
																</div>

															</div>	
														</div>

														<div class="space-4"></div>
														
														<div class="form-group">
															<label class="col-sm  " for="form-field-1">Mesa</label>
															<div>
																<select name="poker" id="poker" required="">
																<option></option>
																	<?php
																	$sql = "SELECT * FROM cash_tmesa where tm_ativo='1' ORDER BY nome_mesa DESC";
																				$qry = mysqli_query($conn, $sql);

																						while($ar = mysqli_fetch_array($qry)){
																										$t_id = $ar["tm_id"];
																										$t_mesa = $ar["nome_mesa"];	
																	?>
																						<option  value="<?php echo $t_id ?>"><?php echo $t_mesa?></option>
																						
																	<?php }?>
																</select>
															</div>
														</div>
														
														<div class="space-4"></div>

														<div class="">
															   <label class="" for="form-field-1">Fila de espera </label>
															   <br>
																<label>
																	<input type="radio" name="espera" id="espera" value="Sim" class="ace" required="" />
																	<span class="lbl"> Sim </span>
																</label>
														&nbsp;
															<label>
																<input type="radio" name="espera" id="espera" value="Nao" class="ace" />
																<span class="lbl"> Nao	</span>

															</label>
															
														</div>
														
														<div class="space-4"></div>
														
														
														
														

													</div>

													<div class="modal-footer">
														<button class="btn btn-sm" data-dismiss="modal">
															<i class="ace-icon fa fa-times"></i>
															Cancelar
														</button>

														<button name="enviar" value="enviar" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-check"></i>
															Salvar
														</button>
													</div>
													
													
												</div>
											</div>
										</form>
									</div><!-- PAGE CONTENT ENDS -->
									
									
									
									<div id="modal-form-config" class="modal" tabindex="-1">
										<form method="post">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Configurar</h4>
													</div>

													<div class="modal-body">
														<div class="row">
														

															<div class="col-xs-12 col-sm-7">
																
																

																
															<div class="form-group">
															<label for="form-field-username">Quantidade mesas</label>

															<div>
																<input type="text" name="mesas" id="form-field-username"  value="" required/>
															</div>
														</div>

														<div class="space-4"></div>

														<div class="form-group">
															<label for="form-field-first">Quantidade assentos</label>

															<div>
																<input type="text"name="assentos" id="form-field-first"  value="" required/>
																
															</div>
														</div>

														
														<div class="space-4"></div>

														<div class="form-group">
															<label for="form-field-first">Quantidade de fichas</label>

															<div>
																<input type="text"name="qtd_fichas" id="form-field-first"  value="" required/>
																
															</div>
														</div>

																<div class="space-4"></div>
																
																<div class="ace-settings-item"> 
																<label for="form-field-first">Tipo de Mesa</label>
														<div>
															<input type="checkbox" class="ace ace-checkbox-2" name="tipo_mesa[]" id="tipo-1" value="1" />
															<label class="lbl" for="ace-settings-navbar"> 1/2 Omaha</label>
														</div>
														<div class="ace-settings-item">
															<input type="checkbox" class="ace ace-checkbox-2" name="tipo_mesa[]" id="tipo-2" value="2"  />
															<label class="lbl" for="ace-settings-navbar"> 1/2 Texas</label>
														</div>
														<div class="ace-settings-item">
															<input type="checkbox" class="ace ace-checkbox-2" name="tipo_mesa[]" id="tipo-3" value="3"  />
															<label class="lbl" for="ace-settings-navbar"> Dealer Choice</label>
														</div>
														
														<div class="ace-settings-item">
															<input type="checkbox" class="ace ace-checkbox-2" name="tipo_mesa[]" id="tipo-4" value="4" />
															<label class="lbl" for="ace-settings-navbar"> 5 Omaha</label>
														</div>
														<div class="ace-settings-item">
															<input type="checkbox" class="ace ace-checkbox-2" name="tipo_mesa[]" id="tipo-5" value="5" />
															<label class="lbl" for="ace-settings-navbar"> 5 Texas</label>
														</div>
									</div>

																<div class="space-4"></div>
																
															</div>
															
														</div>
														
													</div>

													<div class="modal-footer">
														<button class="btn btn-sm" data-dismiss="modal">
															<i class="ace-icon fa fa-times"></i>
															Cancel
														</button>

														<button name="configurar" value="configurar" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-check"></i>
															Salvar
														</button>
													</div>
												</div>
											</div>
										</form>
									</div><!-- PAGE CONTENT ENDS -->
									
									
									<div id="modal-form-fecharcx" class="modal" tabindex="-1">
										<form method="post">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Fechar Caixa</h4>
													</div>

													<div class="modal-body">
														

																												
																<div class="ace-settings-item"> 
																<label for="form-field-first">Fechar Caixa</label>
														<div>
															<input type="checkbox" class="ace ace-checkbox-2" name="fechar_cx[]" id="tipo-1" value="1" />
															<label class="lbl" for="ace-settings-navbar"> Sim</label>
														</div>
														
																<div class="space-4"></div>
																
															</div>
															
														</div>
														
												</div>

													<div class="modal-footer">
														<button class="btn btn-sm" data-dismiss="modal">
															<i class="ace-icon fa fa-times"></i>
															Cancelar
														</button>

														<button name="cx_fechamento" value="cx_fechamento" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-check"></i>
															Salvar
														</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									
									<!--AQUI-->
									

									
									<div id="modal-form-compra" class="modal" tabindex="-1">
										<form method="post">
											<div class="modal-dialog ">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Compra</h4>
													</div>

													<div class="modal-body">
														<div class="row">
															<div class="col-xs-12 col-sm-7">
															
																<div>
																	<label for="form-field-mask-4">
																		Valor
																		
																	</label>

																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-money"></i>
																		</span>

																		<input class="input-mask-valor" type="number" name="valor" id="form-field-mask-4" required/>
																	</div>
																</div>

																<div class="space-4"></div>
																	<label class="" for="form-field-1">Forma de Pagamento</label>	
																<div class="input-group">
																	
																
																	<span class="input-group-addon">
																			<i class="ace-icon fa fa-credit-card"></i>
																		</span>
																		<select name="pagamento" id="pagamento" required="">
																			<option></option>
																			<?php
																			$sql = "SELECT * FROM f_pagamento where fpg_ativo='1' ORDER BY fpg_nome ASC";
																						$qry = mysqli_query($conn, $sql);

																								while($ar = mysqli_fetch_array($qry)){
																												$fpg_id = $ar["fpg_id"];
																												$f_pagamento = $ar["fpg_nome"];	
																												$f_pagamento = utf8_encode($f_pagamento);
																			?>
																			
																			<option  value="<?php echo $fpg_id ?>"><?php echo $f_pagamento?></option>
																								
																			<?php }?>
																		</select>
																	</div>
																
																</div>
																
															</div>
															
														</div>
														
													</div>

													<div class="modal-footer">
														<button class="btn btn-sm" data-dismiss="modal">
															<i class="ace-icon fa fa-times"></i>
															Cancelar
														</button>

														<button name="compra" value="compra" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-check"></i>
															Salvar
														</button>
													</div>
												</div>
											</div>
										</form>
									</div><!-- PAGE CONTENT ENDS -->
									
									<div id="modal-form-cashout" class="modal" tabindex="-1">
										<form method="post">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal">&times;</button>
														<h4 class="blue bigger">Cash Out</h4>
													</div>

													<div class="modal-body">
														<div class="row">
															<div class="col-xs-12 col-sm-7">
															
																<div>
																	<label for="form-field-mask-4">
																		Valor
																		
																	</label>

																	<div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-money"></i>
																		</span>

																		<input class="input-mask-valor" type="number" name="pgt_valor" id="form-field-mask-4" required/>
																	</div>
																</div>

																<div class="space-4"></div>
																		
																<div class="form-group">
																	<label class="col-sm  " for="form-field-1">Forma de Pagamento</label>
																	
																	<div class="input-group">
																	
																
																	<span class="input-group-addon">
																			<i class="ace-icon fa fa-credit-card"></i>
																		</span>
																		<select name="pgt_pagamento" id="pgt_pagamento" required="">
																			<option></option>
																			<?php
																			$sql = "SELECT * FROM f_pagamento where fpg_ativo='1' ORDER BY fpg_nome ASC";
																						$qry = mysqli_query($conn, $sql);

																								while($ar = mysqli_fetch_array($qry)){
																												$fpg_id = $ar["fpg_id"];
																												$f_pagamento = $ar["fpg_nome"];	
																												$f_pagamento = utf8_encode($f_pagamento);
																			?>		
																			
																			<option  value="<?php echo $fpg_id ?>"><?php echo $f_pagamento?></option>
																								
																			<?php }?>
																		</select>
																	</div>
																</div>
																
															</div>
															
														</div>
														
													</div>

													<div class="modal-footer">
													<a href="dashboard">
														<button class="btn btn-sm" data-dismiss="modal">
															<i class="ace-icon fa fa-times"></i>
															Cancelar
														</button></a>

														<button name="cashout" value="" class="btn btn-sm btn-primary">
															<i class="ace-icon fa fa-check"></i>
															Salvar
														</button>
													</div>
												</div>
											</div>
										</form>
									</div><!-- PAGE CONTENT ENDS -->

									
									</div>
													</div>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">GMAC²</span> - <small>gmac.tecnologia@gmail.com
							&copy; 2017 </small>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="../assets/js/jquery-ui.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../assets/js/jquery.sparkline.min.js"></script>
		<script src="../assets/js/jquery.flot.min.js"></script>
		<script src="../assets/js/jquery.flot.pie.min.js"></script>
		<script src="../assets/js/jquery.flot.resize.min.js"></script>
			
		<script src="../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../assets/js/chosen.jquery.min.js"></script>
		<script src="../assets/js/fuelux.spinner.min.js"></script>
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/js/bootstrap-timepicker.min.js"></script>
		<script src="../assets/js/moment.min.js"></script>
		<script src="../assets/js/daterangepicker.min.js"></script>
		<script src="../assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="../assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="../assets/js/jquery.knob.min.js"></script>
		<script src="../assets/js/jquery.autosize.min.js"></script>
		<script src="../assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../assets/js/jquery.maskedinput.min.js"></script>
		<script src="../assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: /msie\s*(8|7|6)/.test(navigator.userAgent.toLowerCase()) ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if("ontouchstart" in document && /applewebkit/.test(agent) && /android/.test(agent))
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				});
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>
		<script type="text/javascript">
			jQuery(function($) {
			
				$( "#datepicker" ).datepicker({
					showOtherMonths: true,
					selectOtherMonths: false,
					//isRTL:true,
			
					
					/*
					changeMonth: true,
					changeYear: true,
					
					showButtonPanel: true,
					beforeShow: function() {
						//change button colors
						var datepicker = $(this).datepicker( "widget" );
						setTimeout(function(){
							var buttons = datepicker.find('.ui-datepicker-buttonpane')
							.find('button');
							buttons.eq(0).addClass('btn btn-xs');
							buttons.eq(1).addClass('btn btn-xs btn-success');
							buttons.wrapInner('<span class="bigger-110" />');
						}, 0);
					}
			*/
				});
			
			
				//override dialog's title function to allow for HTML titles
				$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
					_title: function(title) {
						var $title = this.options.title || '&nbsp;'
						if( ("title_html" in this.options) && this.options.title_html == true )
							title.html($title);
						else title.text($title);
					}
				}));
			
				$( "#id-btn-dialog1" ).on('click', function(e) {
					e.preventDefault();
			
					var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
						modal: true,
						title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i> jQuery UI Dialog</h4></div>",
						title_html: true,
						buttons: [ 
							{
								text: "Cancel",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							},
							{
								text: "OK",
								"class" : "btn btn-primary btn-minier",
								click: function() {
									$( this ).dialog( "close" ); 
								} 
							}
						]
					});
			
					/**
					dialog.data( "uiDialog" )._title = function(title) {
						title.html( this.options.title );
					};
					**/
				});
			
			
				$( "#id-btn-dialog2" ).on('click', function(e) {
					e.preventDefault();
				
					$( "#dialog-confirm" ).removeClass('hide').dialog({
						resizable: false,
						width: '320',
						modal: true,
						title: "<div class='widget-header'><h4 class='smaller'><i class='ace-icon fa fa-exclamation-triangle red'></i> Empty the recycle bin?</h4></div>",
						title_html: true,
						buttons: [
							{
								html: "<i class='ace-icon fa fa-trash-o bigger-110'></i>&nbsp; Delete all items",
								"class" : "btn btn-danger btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
							,
							{
								html: "<i class='ace-icon fa fa-times bigger-110'></i>&nbsp; Cancel",
								"class" : "btn btn-minier",
								click: function() {
									$( this ).dialog( "close" );
								}
							}
						]
					});
				});
			
			
				
				//autocomplete
				 var availableTags = [
					"ActionScript",
					"AppleScript",
					"Asp",
					"BASIC",
					"C",
					"C++",
					"Clojure",
					"COBOL",
					"ColdFusion",
					"Erlang",
					"Fortran",
					"Groovy",
					"Haskell",
					"Java",
					"JavaScript",
					"Lisp",
					"Perl",
					"PHP",
					"Python",
					"Ruby",
					"Scala",
					"Scheme"
				];
				$( "#tags" ).autocomplete({
					source: availableTags
				});
			
				//custom autocomplete (category selection)
				$.widget( "custom.catcomplete", $.ui.autocomplete, {
					_create: function() {
						this._super();
						this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
					},
					_renderMenu: function( ul, items ) {
						var that = this,
						currentCategory = "";
						$.each( items, function( index, item ) {
							var li;
							if ( item.category != currentCategory ) {
								ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
								currentCategory = item.category;
							}
							li = that._renderItemData( ul, item );
								if ( item.category ) {
								li.attr( "aria-label", item.category + " : " + item.label );
							}
						});
					}
				});
				
				 var data = [
					{ label: "anders", category: "" },
					{ label: "andreas", category: "" },
					{ label: "antal", category: "" },
					{ label: "annhhx10", category: "Products" },
					{ label: "annk K12", category: "Products" },
					{ label: "annttop C13", category: "Products" },
					{ label: "anders andersson", category: "People" },
					{ label: "andreas andersson", category: "People" },
					{ label: "andreas johnson", category: "People" }
				];
				$( "#search" ).catcomplete({
					delay: 0,
					source: data
				});
				
				
				//tooltips
				$( "#show-option" ).tooltip({
					show: {
						effect: "slideDown",
						delay: 250
					}
				});
			
				$( "#hide-option" ).tooltip({
					hide: {
						effect: "explode",
						delay: 250
					}
				});
			
				$( "#open-event" ).tooltip({
					show: null,
					position: {
						my: "left top",
						at: "left bottom"
					},
					open: function( event, ui ) {
						ui.tooltip.animate({ top: ui.tooltip.position().top + 10 }, "fast" );
					}
				});
			
			
				//Menu
				$( "#menu" ).menu();
			
			
				//spinner
				var spinner = $( "#spinner" ).spinner({
					create: function( event, ui ) {
						//add custom classes and icons
						$(this)
						.next().addClass('btn btn-success').html('<i class="ace-icon fa fa-plus"></i>')
						.next().addClass('btn btn-danger').html('<i class="ace-icon fa fa-minus"></i>')
						
						//larger buttons on touch devices
						if('touchstart' in document.documentElement) 
							$(this).closest('.ui-spinner').addClass('ui-spinner-touch');
					}
				});
			
				//slider example
				$( "#slider" ).slider({
					range: true,
					min: 0,
					max: 500,
					values: [ 75, 300 ]
				});
			
			
			
				//jquery accordion
				$( "#accordion" ).accordion({
					collapsible: true ,
					heightStyle: "content",
					animate: 250,
					header: ".accordion-header"
				}).sortable({
					axis: "y",
					handle: ".accordion-header",
					stop: function( event, ui ) {
						// IE doesn't register the blur when sorting
						// so trigger focusout handlers to remove .ui-state-focus
						ui.item.children( ".accordion-header" ).triggerHandler( "focusout" );
					}
				});
				//jquery tabs
				$( "#tabs" ).tabs();
				
				
				//progressbar
				$( "#progressbar" ).progressbar({
					value: 37,
					create: function( event, ui ) {
						$(this).addClass('progress progress-striped active')
							   .children(0).addClass('progress-bar progress-bar-success');
					}
				});
			
				
				//selectmenu
				 $( "#number" ).css('width', '200px')
				.selectmenu({ position: { my : "left bottom", at: "left top" } })
					
			});
		</script>
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
				
				$('textarea[class*=autosize]').autosize({append: "\n"});
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-valor').mask('999.999,99');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//alert($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add a new
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//$('#form-field-tags').autosize({append: "\n"});
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					$('textarea[class*=autosize]').trigger('autosize.destroy');
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
	</body>
</html>
