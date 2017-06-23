<?php
include "head.php";
include "topo_tv.php";
include "config.php";

$sql = "select jck_valor as jackpot from cash_jackpot where jck_ativo='1' ";
$resultset = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($resultset);
if (isset($row))
    extract($row);
$jackpot = number_format($jackpot, 2, ',', '.');
?>

<style>

#jackpot {
position: absolute;
margin-top: 10px;
left: 100px;
}
</style>

<div id="jackpot" class="bolder"><font size="8" color="#ff0000" face="tahoma">R$ <?php echo $jackpot ?></font></div>
<br>
<img src="images/jackpot.gif">
																		 