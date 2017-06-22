<?php

function sentar() {
    include "config.php";
    global $livre;
    if ($livre <= 0) {
        echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#modal-confirmacao').modal('show');
                });
          </script>";
        
        $cod1="<i class=\"ace-icon fa fa-check green bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">SUCESSO</p></font>";
	$cod2="<i class=\"ace-icon fa fa-exclamation-triangle orange bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ALERTA</p></font>";
	$cod3="<i class=\"ace-icon fa fa-times red bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ERRO</p></font>";
        
        $titulo = "<span class=\"pull-left\">Fila de Espera</span><br>";
        $tipo = $cod1;
        $msg = "<h5><span class=\"pull-left\">Não existe lugar disponível.</span></h5><br>";
        include "modal.php";
      
    } else {
        $q = " id = '" . $_GET["sentar"] . "'";
        $sql = " UPDATE cash SET espera='Nao', entrada=NOW(), ativo='1' where $q";
        $qry = mysqli_query($conn, $sql);
        
        echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#modal-confirmacao').modal('show');
                });
          </script>";
        
        $cod1="<i class=\"ace-icon fa fa-check green bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">SUCESSO</p></font>";
	$cod2="<i class=\"ace-icon fa fa-exclamation-triangle orange bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ALERTA</p></font>";
	$cod3="<i class=\"ace-icon fa fa-times red bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ERRO</p></font>";
        
        $titulo = "<span class=\"pull-left\">Fila de Espera</span><br>";
        $tipo = $cod1;
        $msg = "<h5><span class=\"pull-left\">Jogador direcionado à mesa.</span></h5><br>";
        include "modal.php";
        //echo "<script>alert('Jogador direcionado \u00e0 mesa');location.href='dashboard';</script>";
        unset($q);
    }
}

function desistir() {
    include "config.php";
    $q = " id = '" . $_GET["desistir"] . "'";
    $sql = "UPDATE cash SET espera='Desistiu', saida=NOW(), ativo='0' where $q";
    //echo "UPDATE cash SET espera='Desistiu', saida=NOW(), ativo='0' where $q";
    //die;
    $qry = mysqli_query($conn, $sql);
     echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#modal-confirmacao').modal('show');
                });
          </script>";
        
        $cod1="<i class=\"ace-icon fa fa-check green bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">SUCESSO</p></font>";
	$cod2="<i class=\"ace-icon fa fa-exclamation-triangle orange bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ALERTA</p></font>";
	$cod3="<i class=\"ace-icon fa fa-times red bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ERRO</p></font>";
        
        $titulo = "<span class=\"pull-left\">Fila de Espera</span><br>";
        $tipo = $cod1;
        $msg = "<h5><span class=\"pull-left\">Jogador desistiu.</span></h5><br>";
        include "modal.php";
     
    unset($q);
}

function sair() {
    include "config.php";
    
    $q = " id = '" . $_GET["sair"] . "'";
    $sql = " UPDATE cash SET saida=NOW(), ativo='0' where $q ";
    $qry = mysqli_query($conn, $sql);
     echo "<script type='text/javascript'>
                $(document).ready(function(){
                $('#modal-confirmacao').modal('show');
                });
          </script>";
        
        $cod1="<i class=\"ace-icon fa fa-check green bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">SUCESSO</p></font>";
	$cod2="<i class=\"ace-icon fa fa-exclamation-triangle orange bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ALERTA</p></font>";
	$cod3="<i class=\"ace-icon fa fa-times red bigger-150 \"></i> &nbsp;<p align=\"left\"><font size=\"5\">ERRO</p></font>";
        
        $titulo = "<span class=\"pull-left\">Controle de Jogadores</span><br>";
        $tipo = $cod1;
        $msg = "<h5><span class=\"pull-left\">Jogador saiu da mesa.</span></h5><br>";
        include "modal.php";
    //echo "<script>alert('Jogador saiu da mesa');location.href='dashboard';</script>";
    unset($q);
}

function comprar() {
    global $jogador_id;
    global $p_nome;
    global $data_e;

    echo "<script type='text/javascript'>
			$(document).ready(function(){
			$('#modal-form-compra').modal('show');
			});
		  </script>";
}

function pagar() {
    global $jogador_id;

    echo "<script type='text/javascript'>
			$(document).ready(function(){
			$('#modal-form-cashout').modal('show');
			});
		  </script>";
}

//Formatar CNPJ
function mask($val, $mask) {
    $maskared = '';
    $k = 0;
    for ($i = 0; $i <= strlen($mask) - 1; $i++) {
        if ($mask[$i] == '#') {
            if (isset($val[$k]))
                $maskared .= $val[$k++];
        } else {
            if (isset($mask[$i]))
                $maskared .= $mask[$i];
        }
    }
    return $maskared;
}

/*function mask($str,$mask){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        $mask[strpos($mask,"#")] = $str[$i];
    }

    return $mask;

}*/

/// Formatar Moeda

function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
    return $valor; //retorna o valor formatado para gravar no banco
}

?>
