<?php
	include("../classes/ClienteDAO.php");
	$cliente = new ClienteDAO();

 $verificarCliente = $_POST['codigo'];
 $novoNome = $_POST['nome'];
 $novoCpf = $_POST['cpf'];
 $novaSenha = $_POST['senha'];

	$cliente->setNome($novoNome);
	$cliente->setCpf($novoCpf);
	$cliente->setCodigo($verificarCliente);
	$cliente->setSenha($novaSenha);

	$cliente->alterar();

	header("Location:../internals/alterar-cliente.php");
?>