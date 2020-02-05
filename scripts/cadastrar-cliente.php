<?php
	include('../classes/ClienteDAO.php');
	$novoCliente = new ClienteDAO();

 $nomeCliente = $_POST['nome'];
 $cpfCliente = $_POST['cpf'];
 $codCliente = $_POST['codigo'];
 $senhaCliente = $_POST['senha'];

	$novoCliente->setNome($nomeCliente);
	$novoCliente->setCpf($cpfCliente);
	$novoCliente->setCodigo($codCliente);
	$novoCliente->setSenha($senhaCliente);

	$novoCliente->cadastrar();

	header('Location:../internals/login.html');
?>