<?php
	include('../classes/ProdutoDAO.php');
	$prod = new ProdutoDAO();

	$codVend = $_POST['codigoVend'];
	$codProd = $_POST['codigo'];

	//Para compreender as linhas seguintes, vide comentário na linha 8 do arquivo alterar-produto.php
	$stmt = $prod->conexaoDB()->prepare("SELECT codigo FROM vendedor WHERE codigo= :codigo");
	$stmt->execute(array(':codigo' => $codVend));

	if($stmt->rowCount()>0){
		$prod->setCodigo($codProd);
		$prod->remover();

		header("Location:../produto.php");
	} else {
		echo "Error";
	}
?>