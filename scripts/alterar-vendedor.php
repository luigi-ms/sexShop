<?php
	include("../classes/VendedorDAO.php");
	$vendedor = new VendedorDAO();

 $verificarVendedor = $_POST['codigo'];
 $novoNome = $_POST['nome'];
 $novoSetor = addslashes($_POST['setor']);
    
	$vendedor->setNome($novoNome);
	$vendedor->setCodigo($verificarVendedor);

	switch($novoSetor){
		case '1':
			$novoSetor = 'Brinquedos';
			break;
		case '2':
			$novoSetor = 'Fantasias';
			break;
		case '3':
			$novoSetor = 'Genéricos';
			break;
	}
	$vendedor->setSetor($novoSetor);
	
	$vendedor->alterar();

	header("Location:../vendedor.html");
?>