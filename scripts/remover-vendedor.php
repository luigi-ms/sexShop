<?php
	/*Este script executará de maneira semelhante ao remover-cliente.php. Vide comentário na linha 2 do mesmo.*/
	include('../classes/VendedorDAO.php');
	$vend = new VendedorDAO();

	$cod = $_POST['codigo'];
	
	$vend->setCodigo($cod);
	$vend->remover();

	header("Location:../vendedor.php");
?>