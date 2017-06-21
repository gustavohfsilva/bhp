<?php

function sentar() {
    include "config.php";
    include "modal.php";
    global $livre;
    if ($livre <= 0) {
        echo "<script>alert('N\u00e3o existe lugar dispon\u00edvel');location.href='dashboard';</script>";
    } else {
        $q = " id = '" . $_GET["sentar"] . "'";
        $sql = " UPDATE cash SET espera='Nao', entrada=NOW(), ativo='1' where $q";
        $qry = mysqli_query($conn, $sql);
        echo "<script>alert('Jogador direcionado \u00e0 mesa');location.href='dashboard';</script>";
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

    $titulo = "Fila de Espera";
    $tipo = $cod2;
    $msg = "<h5>Jogador Desistiu</h5>";
    
       $cod1="<i class=\"ace-icon fa fa-check green bigger-150 \"></i> &nbsp;<font size=\"5\">SUCESSO</font>";
	$cod2="<i class=\"ace-icon fa fa-exclamation-triangle orange bigger-150 \"></i> &nbsp;<font size=\"5\">ALERTA</font>";
	$cod3="<i class=\"ace-icon fa fa-times red bigger-150 \"></i> &nbsp;<font size=\"5\">ERRO</font>";
    include "modal.php";
     
    unset($q);
}

function sair() {
    include "config.php";
    include "modal.php";



    $q = " id = '" . $_GET["sair"] . "'";
    $sql = " UPDATE cash SET saida=NOW(), ativo='0' where $q ";
    $qry = mysqli_query($conn, $sql);
    echo "<script>alert('Jogador saiu da mesa');location.href='dashboard';</script>";
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

/// Formatar Moeda

function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
    return $valor; //retorna o valor formatado para gravar no banco
}

?>
