<?php
	/*Este script criará um objeto ClienteDAO para remover um cliente do DB. Maiores detalhes no método remover da classe ClienteDAO*/
	include('../classes/ClienteDAO.php');
	$cli = new ClienteDAO();

	$cod = $_POST['codigo'];
	
	$cli->setCodigo($cod);
	$cli->remover();

	header("Location:../internals/alterar-cliente.php");
?>