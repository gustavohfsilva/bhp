<?php
$page="TV";
include "head.php";
include "topo_tv.php";

?>
<script>
			$(document).ready(function(){
			setInterval(function(){
			$("#refresh").load('painel.php')
			    });
			});
</script>
<script>
			$(document).ready(function(){
			setInterval(function(){
			$("#refresh").load('painel.php')
			    }, 100000);
			});
</script>

<div id="refresh"></div>