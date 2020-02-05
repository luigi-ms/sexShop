<?php
	include('../classes/VendedorDAO.php');
	$vend = new VendedorDAO();

	$vend->setNome($_POST['nome']);
	$vend->setCodigo($_POST['codigo']);
	$setor = addslashes($_POST['setor']);

	//Para compreender as linhas seguintes, vide comentário na linha 20 do arquivo alterar-produto.php
	switch($setor){
		case '1':
			$setor = 'Brinquedos';
			break;
		case '2':
			$setor = 'Fantasias';
			break;
		case '3':
			$setor = 'Genéricos';
			break;
	}
	
	$vend->setSetor($setor);
	$vend->cadastrar();

	header("Location:../vendedor.php");
?>