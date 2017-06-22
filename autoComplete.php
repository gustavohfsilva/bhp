<?php
include "config.php";

$sql = "select DISTINCT cd_id, cd_nome from cadastro_pessoa where cd_tipo='Fidelidade'";
$qry = mysqli_query($conn, $sql);

ile ($ar = mysqli_fetch_array($qry)) {
    $a_id = $ar['cd_id'];
    $a_nome = $ar['cd_nome'];
    
    echo "$a_nome \n";
    }



?>