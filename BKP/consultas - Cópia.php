
<?php
//$nome           = $_SESSION['data']['name'];
//$login          = $_SESSION['data']['login'];

/////////// Consulta
	$sql = 	"select
				(select count(*) as contador from cash where espera='Sim') as f_espera,
				(select count(*) as contador from cash where espera='Nao' and ativo='1') as c_espera,
				(select count(*) as contador from cash where ativo='1') as ativo,
				(select count(*) as contador from cash where data LIKE '%{$hoje}%' and espera='Desistiu') as d_espera,
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
		$cash_compras_total = number_format($cash_total_compras, 2, ',', '.');
		}
	
		
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
	
	
////////// Configurar

if (isset($_POST['configurar'])){

        if ($_POST["mesas"]){
			$mesas = $_POST['mesas'];
			$assentos = $_POST['assentos'];
			$tipo_mesa = $_POST['tipo_mesa'];
			$qtd_fichas = $_POST['qtd_fichas'];
			$cd_fichas = number_format($qtd_fichas, 2, ',', '.');
			$t_lugares = ($mesas * $assentos);
						
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
							echo " <script>
										$(function(){
											$('#modal-mail').modal('show');
										}); 
								</script>";						   
							$titulo = "Configuração";	
							$msg = "<b>Configuração definida:</b> <br><br> Mesas: <b>$mesas</b> <br> Lugares: <b>$t_lugares</b> <br> Quantida de fichas: <b>R$ $cd_fichas</b> <br><br> Abertura do caixa realizada com sucesso!";
                        }
                } else{
                echo "<script>
						$(function(){
						$('#modal-mail').modal('show');
						}); 
					</script>";						   
						$tipo="ERRO";
						$titulo = "Configuração";	
						$msg = "Favor preencher todos os campos.";
				
				
        }
}


												

if (isset($_POST['cx_fechamento'])){

			if ($ativo > 0) {
			
				echo " <script>
										$(function(){
											$('#modal-mail').modal('show');
										}); 
								</script>";						   
							$titulo = "Fechamento de caixa";	
							$msg = "Fechamemto não realizado. <br> Existe <b>$ativo</b> jogador ativo!";
                       

			} else {
				
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
							
							echo " <script>
										$(function(){
											$('#modal-mail').modal('show');
										}); 
								</script>";						   
							$titulo = "Fechamento de caixa";	
							$msg = "Caixa fechado com sucesso!";
                        }
                
				
				
			}
}

if (isset($_POST['compra'])){

        if ($_POST["valor"]){
			$valor = $_POST['valor'];
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
							echo " <script>
										$(function(){
											$('#modal-mail').modal('show');
										}); 
								</script>";						   
							$titulo = "Compra";	
							$msg = "Compra de $valor em fichas.";
                        }
                } else{
                echo "<script>
						$(function(){
						$('#modal-mail').modal('show');
						}); 
					</script>";						   
						$tipo="ERRO";
						$titulo = "Compra";	
						$msg = "Favor preencher todos os campos.";
        }
}

if (isset($_POST['cashout'])){
	
	
	if ($_POST["pgt_valor"]){
			
			$valor = $_POST['pgt_valor'];
			$fpg_id = $_POST['pgt_pagamento'];
			
	if (empty($_GET["pagar"])){
				$id = $_POST['id'];
			} else {
				$id = $_GET["pagar"];
			}
	
	include "functions.php";
	sair();
						$sql = "INSERT INTO cash_saida SET pgt_id_jogador='$id', pgt_valor='$valor', pgt_data=NOW(), pgt_f_pg='$fpg_id', pgt_caixa='$cx_id' ";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
                        else{
							echo " <script>
										$(function(){
											$('#modal-mail').modal('show');
										}); 
								</script>";						   
							$titulo = "Pagamento";	
							$msg = "Pagamento de $valor.!";
                        }
                } else{
                echo "<script>
						$(function(){
						$('#modal-mail').modal('show');
						}); 
					</script>";						   
						$tipo="ERRO";
						$titulo = "Pagamento";	
						$msg = "Favor preencher todos os campos.";
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


						$sql = "INSERT INTO cadastro_pessoa SET cd_nome='$nome', cd_dt_nascimento='$dt_nascimento', cd_cpf='$cpf', cd_situacao='$situacao', cd_rg='$rg', cd_ssp='$ssp', cd_tipo='$tipo', cd_limite='$limite', cd_cep='$cep',
						cd_endereco='$rua, $numero, $complemento', cd_bairro='$bairro', cd_cidade='$cidade', cd_estado='$estado', cd_email='$email', cd_tel_fixo='$fixo', cd_tel_cel='$celular', cd_dt_cadastro=NOW()";
                        mysqli_query($conn,$sql);
						if(!$sql) die(mysqli_error());
                        else{
							echo " <script>
										$(function(){
											$('#modal-mail').modal('show');
										}); 
								</script>";						   
							$titulo = "Cadastro";	
							$msg = "Jogador $nome foi cadastrado com sucesso!";
                        }
                } else{
                echo "<script>
						$(function(){
						$('#modal-mail').modal('show');
						}); 
					</script>";						   
						$tipo="ERRO";
						$titulo = "Cadastro";	
						$msg = "Favor preencher todos os campos.";
				
        }
}

?>


   
