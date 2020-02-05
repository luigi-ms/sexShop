<?php
	include("../classes/ProdutoDAO.php");
	$novoProduto = new ProdutoDAO();

 $verificaVendedor = $_POST['codigoVend'];
 $nomeProduto = $_POST['nome'];
 $codProduto = $_POST['codigo'];
 $precoProduto = $_POST['preco'];
 $estoqueProduto = $_POST['estoque'];
 $setorProduto = addslashes($_POST['setor']);

	$selectVendedor = $novoProduto->conexaoDB()->prepare("SELECT codigo FROM vendedor WHERE codigo= :codigo");
	$selectVendedor->execute(array(':codigo' => $verificaVendedor));

	if($selectVendedor->rowCount() > 0){
		$novoProduto->setNome($nomeProduto);
		$novoProduto->setCodigo($codProduto);
		$novoProduto->setPreco($precoProduto);
		$novoProduto->setEstoque($estoqueProduto);

		switch($setorProduto){
			case '1':
				$setorProduto = 'Brinquedos';
				break;
			case '2':
				$setorProduto = 'Fantasias';
				break;
			case '3':
				$setorProduto = 'Genéricos';
				break;
		}
		$novoProduto->setSetor($setorProduto);

		$novoProduto->cadastrar();

		header("Location:../produto.php");
	} else {
		header("Location:../internals/cadastro-vendedor.html");
	}
?>