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
																		if ($data <= 15 ) {
																			echo "<span class=\"green\"><b>$data min</b></span>";
																		}
																		elseif ($data > 15 && $data <= 30) {
																			echo "<span class=\"orange\"><b>$data min</b></span>";
																		}
																		elseif ($data > 30 && $data <= 45) {
																			echo "<span class=\"blue\"><b>$data min</b></span>";
																		}
																		elseif ($data > 45 && $data <= 60) {
																			echo "<span class=\"purple\"><b>$data min</b></span>";
																		}
																		elseif ($data > 60 && $data <= 120) {
																			echo "<span class=\"red\"><b>1 h</b></span>";
																		}
																		elseif ($data > 120 && $data <= 180) {
																			echo "<span class=\"red\"><b>2 h</b></span>";
																		}
																		elseif ($data > 180 && $data <= 240) {
																			echo "<span  class=\"red\"><b>3 h</b></span>";
																		}
																		elseif ($data > 240 && $data <= 300) {
																			echo "<span class=\"red\"><b>4 h</b></span>";
																		}
																		elseif ($data > 300 && $data <= 360) {
																			echo "<span class=\"red\"><b>5 h</b></span>";
																		}
																		elseif ($data > 360 && $data <= 420) {
																			echo "<span class=\"red\"><b>6 h</b></span>";
																		}
																		elseif ($data > 420 && $data <= 480) {
																			echo "<span class=\"red\"><b>7 h</b></span>";
																		}
																		elseif ($data > 480 && $data <= 540) {
																			echo "<span class=\"red\"><b>8 h</b></span>";
																		}
																		elseif ($data > 540 && $data <= 600) {
																			echo "<span class=\"red\"><b>9 h</b></span>";
																		}
																		elseif ($data > 600 && $data <= 660) {
																			echo "<span class=\"red\"><b>10 h</b></span>";
																		}
																		elseif ($data > 660 && $data <= 720) {
																			echo "<span class=\"red\"><b>11 h</b></span>";
																		}
																		elseif ($data > 720 && $data <= 780) {
																			echo "<span class=\"red\"><b>12 h</b></span>";
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
												</div>
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
																	<a href="" title="<?php echo $f_data; ?>" >
																	
																	<span class=""><i class="ace-icon fa fa-clock-o"></i>
																	</a>
																	<?php 
																			//echo "<span class=\"green\"><b>$data min</b></span>";
																		if ($data <= 15 ) {
																			echo "<span class=\"green\"><b>$data min</b></span>";
																		}
																		elseif ($data > 15 && $data <= 30) {
																			echo "<span class=\"orange\"><b>$data min</b></span>";
																		}
																		elseif ($data > 30 && $data <= 45) {
																			echo "<span class=\"blue\"><b>$data min</b></span>";
																		}
																		elseif ($data > 45 && $data <= 60) {
																			echo "<span class=\"purple\"><b>$data min</b></span>";
																		}
																		elseif ($data > 60 && $data <= 120) {
																			echo "<span class=\"red\"><b>1 h</b></span>";
																		}
																		elseif ($data > 120 && $data <= 180) {
																			echo "<span class=\"red\"><b>2 h</b></span>";
																		}
																		elseif ($data > 180 && $data <= 240) {
																			echo "<span  class=\"red\"><b>3 h</b></span>";
																		}
																		elseif ($data > 240 && $data <= 300) {
																			echo "<span class=\"red\"><b>4 h</b></span>";
																		}
																		elseif ($data > 300 && $data <= 360) {
																			echo "<span class=\"red\"><b>5 h</b></span>";
																		}
																		elseif ($data > 360 && $data <= 420) {
																			echo "<span class=\"red\"><b>6 h</b></span>";
																		}
																		elseif ($data > 420 && $data <= 480) {
																			echo "<span class=\"red\"><b>7 h</b></span>";
																		}
																		elseif ($data > 480 && $data <= 540) {
																			echo "<span class=\"red\"><b>8 h</b></span>";
																		}
																		elseif ($data > 540 && $data <= 600) {
																			echo "<span class=\"red\"><b>9 h</b></span>";
																		}
																		elseif ($data > 600 && $data <= 660) {
																			echo "<span class=\"red\"><b>10 h</b></span>";
																		}
																		elseif ($data > 660 && $data <= 720) {
																			echo "<span class=\"red\"><b>11 h</b></span>";
																		}
																		elseif ($data > 720 && $data <= 780) {
																			echo "<span class=\"red\"><b>12 h</b></span>";
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
								</div>
							</div>
						</div>