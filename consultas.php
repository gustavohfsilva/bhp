<?php

/////////// Consulta
//(select count(*) as contador from cadastro_pessoa where cd_tipo='Fidelidade' ) as fidelidade,
	$sql = 	"select
				(select count(*) as contador from cash cs
						left join cash_caixa cs_cx on cs_cx.cx_id = caixa
						where espera='Sim' AND cs_cx.cx_ativo ='1' ) as f_espera,
				
				(select count(*) as contador from cash where espera='Nao' and ativo='1') as c_espera,
				(select count(*) as contador from cash where ativo='1') as ativo,
				(select count(*) as contador from cash cs
						left join cash_caixa cs_cx on cs_cx.cx_id = caixa
						where espera='Desistiu' AND cs_cx.cx_ativo ='1') as d_espera,
				(select count(*) from cash cs
						left join cash_caixa cs_cx ON cs.caixa=cs_cx.cx_id
						where cs_cx.cx_ativo='1' and espera='Nao') 	as total
			";
					
	$resultset = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($resultset);
	extract($row);

	
	$sql = "select cn_mesas as mesas, cn_data as dt_mesas, cn_assentos as assentos, cn_fichas as cash_fichas from cash_config where cn_ativo='1' ";
	$resultset = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($resultset);
	if (isset($row)) 
		extract($row);
	
	$sql = "select cx_id as cx_id from cash_caixa where cx_ativo='1' ";
	$resultset = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($resultset);
	if (isset($row)) 
		extract($row);
	
	
/////////// Soma de Valores
		//////// Entrada

		
	$sql = "SELECT SUM(cmp_valor) as cash_total_compras FROM cash_entrada cs_e
				   left join cash_caixa cs_cx on cs_cx.cx_id = cs_e.cmp_caixa
			where cs_cx.cx_ativo ='1'  ";
	$resultset = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($resultset);
	if (isset($row)) 
		extract($row);
		
		if ((empty($cash_total_compras)) OR (empty($cash_fichas))) {
		
		} else {
		$percent_compra = number_format(($cash_total_compras/$cash_fichas * 100));
		}
	$cash_compras_total = number_format($cash_total_compras, 2, ',', '.');
	//////// Fidelidade
		
	$sql = "SELECT SUM(cmp_valor) as total_fidelidade FROM cash_entrada cs_e
				   left join cash_caixa cs_cx on cs_cx.cx_id = cs_e.cmp_caixa
			where cs_cx.cx_ativo ='1' AND cs_e.cmp_f_pg='4'  ";		
	$resultset = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($resultset);
	extract($row);
	
	$fidelidade = number_format($total_fidelidade, 2, ',', '.');
	
	//////// Saida
	
	$sql = "SELECT SUM(pgt_valor) as cash_total_pagamentos FROM cash_saida cs_s
				   left join cash_caixa cs_cx on cs_cx.cx_id = cs_s.pgt_caixa
			where cs_cx.cx_ativo ='1'  ";
			
	$resultset = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($resultset);
	extract($row);
	
	$cash_pagamentos_total = number_format($cash_total_pagamentos, 2, ',', '.');
	
	//////// Caixa
	
	$cx_total = ($cash_total_compras - $cash_total_pagamentos);
	$cx_total = number_format($cx_total, 2, ',', '.');
	
	//////// Ficheiro
	$ficheiro = ($cash_fichas - $cash_total_compras );
	
	/////////// Alertas
	
	$cod1="<i class=\"ace-icon fa fa-check green bigger-150 \"></i> &nbsp;<font size=\"5\">SUCESSO</font>";
	$cod2="<i class=\"ace-icon fa fa-exclamation-triangle orange bigger-150 \"></i> &nbsp;<font size=\"5\">ALERTA</font>";
	$cod3="<i class=\"ace-icon fa fa-times red bigger-150 \"></i> &nbsp;<font size=\"5\">ERRO</font>";
	
		   
	////////// Configurar


if (isset($_POST['configurar'])){

        if ($_POST["mesas"]){
			$mesas = $_POST['mesas'];
			$assentos = $_POST['assentos'];
			$tipo_mesa = $_POST['tipo_mesa'];
			$qtd_fichas = $_POST['qtd_fichas'];
			
						
						while(list($key, $val) = each($tipo_mesa)){	
							$sql = "update cash_tmesa set tm_ativo='1' where tm_id ='$val'";
							mysqli_query($conn,$sql);
							if(!$sql) die(mysqli_error());
						}
						
						$sql = "INSERT INTO cash_caixa SET cx_data_abertura=NOW(), cx_ativo='1' ";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
						
						$sql = "INSERT INTO cash_config SET cn_mesas='$mesas', cn_data=NOW(), cn_assentos='$assentos', cn_ativo='1', cn_fichas='$qtd_fichas' ";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
                        else{
							$fichas_total = number_format($qtd_fichas, 2, ',', '.');
							echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Configuração";
								   $tipo=$cod1;
								   $msg="<h5>Parâmentro configurados.</h5> <p><b>Mesas:</b> $mesas </p> <p><b>Lugares:</b> $assentos</p><p><b>Fichas:</b> R$ $fichas_total</p>"; 
							
                                unset($mesas);
								unset($assentos);
								unset($tipo_mesa);
								unset($qtd_fichas);
								
                        }
                } else{
					echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Configuração";
								   $tipo=$cod3;
								   $msg="Favor preencher todos os campos";
                
        }
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
			$valor = $_POST['c_valor'];
			$livre = $_POST['livre'];
			$cmp_f_pg = $_POST['pagamento'];
			
			if ($livre > 0 AND $espera == "Nao") {
				
				$sql = "INSERT INTO cash SET nome='$nome', data=NOW(), espera='$espera', ativo='$ativo', entrada=$entrada, mesa='$poker', caixa='$cx_id' ";
				mysqli_query($conn,$sql);
				
				$ID= mysqli_insert_id($conn);
				$sql = "INSERT INTO cash_entrada SET cmp_id_jogador='$ID', cmp_valor='$valor', cmp_data=NOW(), cmp_f_pg='$cmp_f_pg', cmp_caixa='$cx_id' ";
                mysqli_query($conn,$sql);
		
                   
								echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Controle de Jogadores";
								   $tipo=$cod1;
								   $msg="Jogador $nome, cadastrado com sucesso";
                    unset($nome);
					unset($espera);
					unset($ativo);
					unset($entrada);

			}elseif ($espera == "Sim") {
				
								echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Controle de Jogadores";
								   $tipo=$cod1;
								   $msg="Jogador $nome, será direcionado para fila de espera";
					
					$sql = "INSERT INTO cash SET nome='$nome', data=NOW(), espera='Sim', ativo='0', mesa='$poker', caixa='$cx_id' ";
					mysqli_query($conn,$sql);
			}else {
					echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Controle de Jogadores";
								   $tipo=$cod2;
								   $msg="Não existe mais lugar dispoível, $nome, será direcionado à fila de espera.";
					
					$sql = "INSERT INTO cash SET nome='$nome', data=NOW(), espera='Sim', ativo='0', mesa='$poker', caixa='$cx_id' ";
					mysqli_query($conn,$sql);
								
                    }
        }
}


if (isset($_POST['cx_fechamento'])){

			if ($ativo > 0 ) {
				
				echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Fechar Caixa";
								   $tipo=$cod3;
								   $msg="<h5><p>Existe(m): <b>$ativo</b> jogador(es) ativo(s)</p> <p>O caixa nao será fechado</p><p>Por favor finalize na aba Jogando, todos os jogadores ativos e tente novamente"; 
			
			} elseif ($f_espera > 0) {
				echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Fechar Caixa";
								   $tipo=$cod3;
								   $msg="<h5><p>Existe(m): <b>$f_espera</b> jogador(es) na fila de espera</p> <p>O caixa nao será fechado</p><p>Por favor finalize na aba Jogando, todos os jogadores ativos e tente novamente"; 

				} else {
				
				$sql = "UPDATE cash set espera='Desistiu' where espera='Sim'";
				mysqli_query($conn,$sql);
					if(!$sql) die(mysqli_error());
					
				$sql = "UPDATE cash_config set cn_ativo='0' where cn_ativo='1'";
				mysqli_query($conn,$sql);
					if(!$sql) die(mysqli_error());
							
				$sql = "UPDATE cash_tmesa set tm_ativo='0' where tm_ativo='1' ";
				mysqli_query($conn,$sql);
					if(!$sql) die(mysqli_error());
				
				$sql = "UPDATE cash_caixa set cx_data_fechamento=NOW(), cx_ativo='0' where cx_ativo='1'";
				mysqli_query($conn,$sql);
					if(!$sql) die(mysqli_error());
					else {
								echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Fechar Caixa";
								   $tipo=$cod1;
								   $msg="<h5>Fechamento do caixa realizado com sucesso.</h5>"; 
							unset($mesas);
					}
				
				
			}
}

if (isset($_POST['compra'])){

        if ($_POST["c_valor"]){
			$valor = $_POST['c_valor'];
			$fpg_id = $_POST['pagamento'];

			if (empty($_GET["comprar"])){
				$id = $_POST['id'];
			} else {
				$id = $_GET["comprar"];
			}

						$sql = "INSERT INTO cash_entrada SET cmp_id_jogador='$id', cmp_valor='$valor', cmp_data=NOW(), cmp_f_pg= '$fpg_id', cmp_caixa='$cx_id' ";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
                        else{
							 echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Compra";
								   $tipo=$cod1;
								   $msg="Compra de: R$ $valor realizada com sucesso";
								   
                                
								unset($id);
                                unset($valor);
								unset($pagamento);
								
								
                        }
                } else{
               echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Compra";
								   $tipo=$cod3;
								   $msg="Favor preencher todos os campos";
        }
}

								
if (isset($_POST['cashout'])){
$dt_now = date("Y-m-d H:i:s");
$jogador_id = $_GET["pagar"];

			$sql="select nome as p_nome, entrada as entrada from cash where id='{$jogador_id}' ";
			$resultset = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($resultset);
			extract($row);
				$from_time=strtotime("$dt_now"); 
				$entrada_time=strtotime("$entrada");
				$entrada_mesa = round(abs($from_time - $entrada_time)/60);
				$entrada = date('H:i',strtotime($entrada));
				$saida = strtotime($entrada) + 60*60;
				$saida = date('H:i',$saida);
			
				

	if ($_POST["pgt_valor"]){
			
			$valor = $_POST['pgt_valor'];
			$fpg_id = $_POST['pgt_pagamento'];
			$data_c = $_POST['c_data'];
			
			
			
	if (empty($_GET["pagar"])){
				$id = $_POST['id'];
			} else {
				$id = $_GET["pagar"];
			}
			
					if ($entrada_mesa <= "60" ) {
						echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Pagamento";
								   $tipo=$cod2;
								   $msg="<h5><p>Jogador $p_nome, está ativo a menos de uma hora. <p/> <p>Horário de entrada na mesa: <b>$entrada</b> <p>Permanência na mesa: <i class=\"ace-icon fa fa-clock-o red \"></i><b> $entrada_mesa</b>  </p><p>Horário de saída autorizado: <b>$saida</b> </p><p><b>Pagamento não autorizado</p></b></h5>"; 
					}else {
						$sql = " UPDATE cash SET saida=NOW(), ativo='0' where id='$id' ";
						mysqli_query($conn,$sql);
							
						$sql = "INSERT INTO cash_saida SET pgt_id_jogador='$id', pgt_valor='$valor', pgt_data=NOW(), pgt_f_pg='$fpg_id', pgt_caixa='$cx_id' ";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
                        else{
							
							echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								  
								   $titulo = "Pagamento";
								   $tipo=$cod1;
								   $msg="<h5>Pagamento de: R$ $valor, para: $p_nome</h5>"; 
								unset($id);
                                unset($valor);
								unset($pagamento);
						
						
								
                        }
					}
        }
}
								
								

if (isset($_POST['enviar_cadastro'])){
	

        if ($_POST["nome"]){
			$nome = $_POST['nome'];
			$dt_nascimento = $_POST['data_nascimento'];
			$cpf = $_POST['cpf'];
			$rg = $_POST['rg'];
			$ssp = $_POST['ssp'];
			$tipo = $_POST['tipo'];
			$limite = $_POST['limite'];
			$cep = $_POST['cep'];
			$numero = $_POST['numero'];
			$email = $_POST['email'];
			$celular = $_POST['celular'];
			$fixo = $_POST['fixo'];
			$situacao = $_POST['situacao_cadastral'];
			$dt_nascimento = str_replace('/', '-', $dt_nascimento);
			$dt_nascimento = date('Y-m-d', strtotime($dt_nascimento));
			$complemento = utf8_decode($_POST['complemento']);
			$rua = utf8_decode($_POST['rua']);
			$bairro = utf8_decode($_POST['bairro']);
			$cidade = utf8_decode($_POST['cidade']);
			$bairro = utf8_decode($_POST['bairro']);
			$estado = utf8_decode($_POST['estado']);		
			$cpf = str_replace(".", "", $cpf);
			$cpf = str_replace("-", "", $cpf);
			$rg = str_replace(".", "", $rg);
			$cep = str_replace(".", "", $cep);
			$cep = str_replace("-", "", $cep);
			$fixo = str_replace("(", "", $fixo);
			$fixo = str_replace(")", "", $fixo);
			$fixo = str_replace("-", "", $fixo);
			$fixo = str_replace(" ", "", $fixo);
			$celular = str_replace("(", "", $celular);
			$celular = str_replace(")", "", $celular);
			$celular = str_replace("-", "", $celular);
			$celular = str_replace(" ", "", $celular);

					if($situacao <> "REGULAR") {
							$limite="0";
							echo "<script>alert('CPF com situac\u00e3o irregular, limite para fidelidade n\u00e3o aprovado.');</script>";
					}
						$sql = "INSERT INTO cadastro_pessoa SET cd_nome='$nome', cd_dt_nascimento='$dt_nascimento', cd_cpf='$cpf', cd_situacao='$situacao', cd_rg='$rg', cd_ssp='$ssp', cd_tipo='$tipo', cd_limite='$limite', cd_cep='$cep',
						cd_endereco='$rua, $numero, $complemento', cd_bairro='$bairro', cd_cidade='$cidade', cd_estado='$estado', cd_email='$email', cd_tel_fixo='$fixo', cd_tel_cel='$celular', cd_dt_cadastro=NOW()";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
                        else{
							echo " ";						   
							$titulo = "Cadastro";	
							 $tipo=$cod1;
							$msg = "Cadastro de: $nome foi realizado com sucesso!";
                        }
                } else{
               echo "<script type='text/javascript'>
									$(document).ready(function(){
									$('#modal-confirmacao').modal('show');
									});
								  </script>";
								   $titulo = "Configuração";
								   $tipo=$cod3;
								   $msg="Favor preencher todos os campos";
				
        }
}


?>